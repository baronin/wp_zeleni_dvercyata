<?php
/**
 * Atom Syndication Format PHP Library
 *
 * @package AtomLib
 * @link http://code.google.com/p/phpatomlib/
 *
 * @author Elias Torres <elias@torrez.us>
 * @version 0.4
 * @since 2.3.0
 */

/**
 * Structure that store common Atom Feed Properties
 *
 * @package AtomLib
 */
class AtomFeed
{
    /**
     * Stores Links
     * @var array
     * @access public
     */
    var $links = [];
    /**
     * Stores Categories
     * @var array
     * @access public
     */
    var $categories = [];
    /**
     * Stores Entries
     *
     * @var array
     * @access public
     */
    var $entries = [];
}

/**
 * Structure that store Atom Entry Properties
 *
 * @package AtomLib
 */
class AtomEntry
{
    /**
     * Stores Links
     * @var array
     * @access public
     */
    var $links = [];
    /**
     * Stores Categories
     * @var array
     * @access public
     */
    var $categories = [];
}

/**
 * AtomLib Atom Parser API
 *
 * @package AtomLib
 */
class AtomParser
{
    var $NS = "http://www.w3.org/2005/Atom";
    var $ATOM_CONTENT_ELEMENTS = [
        "content",
        "summary",
        "title",
        "subtitle",
        "rights",
    ];
    var $ATOM_SIMPLE_ELEMENTS = ["id", "updated", "published", "draft"];

    var $debug = false;

    var $depth = 0;
    var $indent = 2;
    var $in_content;
    var $ns_contexts = [];
    var $ns_decls = [];
    var $content_ns_decls = [];
    var $content_ns_contexts = [];
    var $is_xhtml = false;
    var $is_html = false;
    var $is_text = true;
    var $skipped_div = false;

    var $FILE = "php://input";

    var $feed;
    var $current;
    var $map_attrs_func;
    var $map_xmlns_func;
    var $error;
    var $content;

    /**
     * PHP5 constructor.
     */
    function __construct()
    {
        $this->feed = new AtomFeed();
        $this->current = null;
        $this->map_attrs_func = [__CLASS__, "map_attrs"];
        $this->map_xmlns_func = [__CLASS__, "map_xmlns"];
    }

    /**
     * PHP4 constructor.
     */
    public function AtomParser()
    {
        self::__construct();
    }

    /**
     * Map attributes to key="val"
     *
     * @param string $k Key
     * @param string $v Value
     * @return string
     */
    public static function map_attrs($k, $v)
    {
        return "$k=\"$v\"";
    }

    /**
     * Map XML namespace to string.
     *
     * @param indexish $p XML Namespace element index
     * @param array $n Two-element array pair. [ 0 => {namespace}, 1 => {url} ]
     * @return string 'xmlns="{url}"' or 'xmlns:{namespace}="{url}"'
     */
    public static function map_xmlns($p, $n)
    {
        $xd = "xmlns";
        if (0 < strlen($n[0])) {
            $xd .= ":{$n[0]}";
        }
        return "{$xd}=\"{$n[1]}\"";
    }

    function _p($msg)
    {
        if ($this->debug) {
            print str_repeat(" ", $this->depth * $this->indent) . $msg . "\n";
        }
    }

    function error_handler($log_level, $log_text, $error_file, $error_line)
    {
        $this->error = $log_text;
    }

    function parse()
    {
        set_error_handler([&$this, "error_handler"]);

        array_unshift($this->ns_contexts, []);

        if (!function_exists("xml_parser_create_ns")) {
            trigger_error(
                __(
                    "PHP's XML extension is not available. Please contact your hosting provider to enable PHP's XML extension."
                )
            );
            return false;
        }

        $parser = xml_parser_create_ns();
        xml_set_element_handler(
            $parser,
            [$this, "start_element"],
            [$this, "end_element"]
        );
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 0);
        xml_set_character_data_handler($parser, [$this, "cdata"]);
        xml_set_default_handler($parser, [$this, "_default"]);
        xml_set_start_namespace_decl_handler($parser, [$this, "start_ns"]);
        xml_set_end_namespace_decl_handler($parser, [$this, "end_ns"]);

        $this->content = "";

        $ret = true;

        $fp = fopen($this->FILE, "r");
        while ($data = fread($fp, 4096)) {
            if ($this->debug) {
                $this->content .= $data;
            }

            if (!xml_parse($parser, $data, feof($fp))) {
                /* translators: 1: Error message, 2: Line number. */
                trigger_error(
                    sprintf(
                        __('XML Error: %1$s at line %2$s') . "\n",
                        xml_error_string(xml_get_error_code($parser)),
                        xml_get_current_line_number($parser)
                    )
                );
                $ret = false;
                break;
            }
        }
        fclose($fp);

        xml_parser_free($parser);
        unset($parser);

        restore_error_handler();

        return $ret;
    }

    function start_element($parser, $name, $attrs)
    {
        $name_parts = explode(":", $name);
        $tag = array_pop($name_parts);

        switch ($name) {
            case $this->NS . ":feed":
                $this->current = $this->feed;
                break;
            case $this->NS . ":entry":
                $this->current = new AtomEntry();
                break;
        }

        $this->_p("start_element('$name')");
        #$this->_p(print_r($this->ns_contexts,true));
        #$this->_p('current(' . $this->current . ')');

        array_unshift($this->ns_contexts, $this->ns_decls);

        $this->depth++;

        if (!empty($this->in_content)) {
            $this->content_ns_decls = [];

            if ($this->is_html || $this->is_text) {
                trigger_error(
                    "Invalid content in element found. Content must not be of type text or html if it contains markup."
                );
            }

            $attrs_prefix = [];

            // resolve prefixes for attributes
            foreach ($attrs as $key => $value) {
                $with_prefix = $this->ns_to_prefix($key, true);
                $attrs_prefix[$with_prefix[1]] = $this->xml_escape($value);
            }

            $attrs_str = join(
                " ",
                array_map(
                    $this->map_attrs_func,
                    array_keys($attrs_prefix),
                    array_values($attrs_prefix)
                )
            );
            if (strlen($attrs_str) > 0) {
                $attrs_str = " " . $attrs_str;
            }

            $with_prefix = $this->ns_to_prefix($name);

            if (!$this->is_declared_content_ns($with_prefix[0])) {
                array_push($this->content_ns_decls, $with_prefix[0]);
            }

            $xmlns_str = "";
            if (count($this->content_ns_decls) > 0) {
                array_unshift(
                    $this->content_ns_contexts,
                    $this->content_ns_decls
                );
                $xmlns_str .= join(
                    " ",
                    array_map(
                        $this->map_xmlns_func,
                        array_keys($this->content_ns_contexts[0]),
                        array_values($this->content_ns_contexts[0])
                    )
                );
                if (strlen($xmlns_str) > 0) {
                    $xmlns_str = " " . $xmlns_str;
                }
            }

            array_push($this->in_content, [
                $tag,
                $this->depth,
                "<" . $with_prefix[1] . "{$xmlns_str}{$attrs_str}" . ">",
            ]);
        } elseif (
            in_array($tag, $this->ATOM_CONTENT_ELEMENTS) ||
            in_array($tag, $this->ATOM_SIMPLE_ELEMENTS)
        ) {
            $this->in_content = [];
            $this->is_xhtml = $attrs["type"] == "xhtml";
            $this->is_html =
                $attrs["type"] == "html" || $attrs["type"] == "text/html";
            $this->is_text =
                !in_array("type", array_keys($attrs)) ||
                $attrs["type"] == "text";
            $type = $this->is_xhtml
                ? "XHTML"
                : ($this->is_html
                    ? "HTML"
                    : ($this->is_text
                        ? "TEXT"
                        : $attrs["type"]));

            if (in_array("src", array_keys($attrs))) {
                $this->current->$tag = $attrs;
            } else {
                array_push($this->in_content, [$tag, $this->depth, $type]);
            }
        } elseif ($tag == "link") {
            array_push($this->current->links, $attrs);
        } elseif ($tag == "category") {
            array_push($this->current->categories, $attrs);
        }

        $this->ns_decls = [];
    }

    function end_element($parser, $name)
    {
        $name_parts = explode(":", $name);
        $tag = array_pop($name_parts);

        $ccount = count($this->in_content);

        # if we are *in* content, then let's proceed to serialize it
        if (!empty($this->in_content)) {
            # if we are ending the original content element
            # then let's finalize the content
            if (
                $this->in_content[0][0] == $tag &&
                $this->in_content[0][1] == $this->depth
            ) {
                $origtype = $this->in_content[0][2];
                array_shift($this->in_content);
                $newcontent = [];
                foreach ($this->in_content as $c) {
                    if (count($c) == 3) {
                        array_push($newcontent, $c[2]);
                    } else {
                        if ($this->is_xhtml || $this->is_text) {
                            array_push($newcontent, $this->xml_escape($c));
                        } else {
                            array_push($newcontent, $c);
                        }
                    }
                }
                if (in_array($tag, $this->ATOM_CONTENT_ELEMENTS)) {
                    $this->current->$tag = [$origtype, join("", $newcontent)];
                } else {
                    $this->current->$tag = join("", $newcontent);
                }
                $this->in_content = [];
            } elseif (
                $this->in_content[$ccount - 1][0] == $tag &&
                $this->in_content[$ccount - 1][1] == $this->depth
            ) {
                $this->in_content[$ccount - 1][2] =
                    substr($this->in_content[$ccount - 1][2], 0, -1) . "/>";
            } else {
                # else, just finalize the current element's content
                $endtag = $this->ns_to_prefix($name);
                array_push($this->in_content, [
                    $tag,
                    $this->depth,
                    "</$endtag[1]>",
                ]);
            }
        }

        array_shift($this->ns_contexts);

        $this->depth--;

        if ($name == $this->NS . ":entry") {
            array_push($this->feed->entries, $this->current);
            $this->current = null;
        }

        $this->_p("end_element('$name')");
    }

    function start_ns($parser, $prefix, $uri)
    {
        $this->_p("starting: " . $prefix . ":" . $uri);
        array_push($this->ns_decls, [$prefix, $uri]);
    }

    function end_ns($parser, $prefix)
    {
        $this->_p("ending: #" . $prefix . "#");
    }

    function cdata($parser, $data)
    {
        $this->_p("data: #" . str_replace(["\n"], ["\\n"], trim($data)) . "#");
        if (!empty($this->in_content)) {
            array_push($this->in_content, $data);
        }
    }

    function _default($parser, $data)
    {
        # when does this gets called?
    }

    function ns_to_prefix($qname, $attr = false)
    {
        # split 'http://www.w3.org/1999/xhtml:div' into ('http','//www.w3.org/1999/xhtml','div')
        $components = explode(":", $qname);

        # grab the last one (e.g 'div')
        $name = array_pop($components);

        if (!empty($components)) {
            # re-join back the namespace component
            $ns = join(":", $components);
            foreach ($this->ns_contexts as $context) {
                foreach ($context as $mapping) {
                    if ($mapping[1] == $ns && strlen($mapping[0]) > 0) {
                        return [$mapping, "$mapping[0]:$name"];
                    }
                }
            }
        }

        if ($attr) {
            return [null, $name];
        } else {
            foreach ($this->ns_contexts as $context) {
                foreach ($context as $mapping) {
                    if (strlen($mapping[0]) == 0) {
                        return [$mapping, $name];
                    }
                }
            }
        }
    }

    function is_declared_content_ns($new_mapping)
    {
        foreach ($this->content_ns_contexts as $context) {
            foreach ($context as $mapping) {
                if ($new_mapping == $mapping) {
                    return true;
                }
            }
        }
        return false;
    }

    function xml_escape($content)
    {
        return str_replace(
            ["&", '"', "'", "<", ">"],
            ["&amp;", "&quot;", "&apos;", "&lt;", "&gt;"],
            $content
        );
    }
}
