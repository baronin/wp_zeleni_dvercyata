<?php

/**
 * SimplePie
 *
 * A PHP-Based RSS and Atom Feed Framework.
 * Takes the hard work out of managing a complete RSS/Atom solution.
 *
 * Copyright (c) 2004-2022, Ryan Parman, Sam Sneddon, Ryan McCue, and contributors
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification, are
 * permitted provided that the following conditions are met:
 *
 * 	* Redistributions of source code must retain the above copyright notice, this list of
 * 	  conditions and the following disclaimer.
 *
 * 	* Redistributions in binary form must reproduce the above copyright notice, this list
 * 	  of conditions and the following disclaimer in the documentation and/or other materials
 * 	  provided with the distribution.
 *
 * 	* Neither the name of the SimplePie Team nor the names of its contributors may be used
 * 	  to endorse or promote products derived from this software without specific prior
 * 	  written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND ANY EXPRESS
 * OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY
 * AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS
 * AND CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR
 * OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package SimplePie
 * @copyright 2004-2016 Ryan Parman, Sam Sneddon, Ryan McCue
 * @author Ryan Parman
 * @author Sam Sneddon
 * @author Ryan McCue
 * @link http://simplepie.org/ SimplePie
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 */

namespace SimplePie;

/**
 * Used for feed auto-discovery
 *
 *
 * This class can be overloaded with {@see \SimplePie\SimplePie::set_locator_class()}
 *
 * @package SimplePie
 */
class Locator implements RegistryAware
{
    public $useragent;
    public $timeout;
    public $file;
    public $local = [];
    public $elsewhere = [];
    public $cached_entities = [];
    public $http_base;
    public $base;
    public $base_location = 0;
    public $checked_feeds = 0;
    public $max_checked_feeds = 10;
    public $force_fsockopen = false;
    public $curl_options = [];
    public $dom;
    protected $registry;

    public function __construct(
        \SimplePie\File $file,
        $timeout = 10,
        $useragent = null,
        $max_checked_feeds = 10,
        $force_fsockopen = false,
        $curl_options = []
    ) {
        $this->file = $file;
        $this->useragent = $useragent;
        $this->timeout = $timeout;
        $this->max_checked_feeds = $max_checked_feeds;
        $this->force_fsockopen = $force_fsockopen;
        $this->curl_options = $curl_options;

        if (class_exists("DOMDocument") && $this->file->body != "") {
            $this->dom = new \DOMDocument();

            set_error_handler(["SimplePie\Misc", "silence_errors"]);
            try {
                $this->dom->loadHTML($this->file->body);
            } catch (\Throwable $ex) {
                $this->dom = null;
            }
            restore_error_handler();
        } else {
            $this->dom = null;
        }
    }

    public function set_registry(\SimplePie\Registry $registry)
    {
        /* : void */ $this->registry = $registry;
    }

    public function find(
        $type = \SimplePie\SimplePie::LOCATOR_ALL,
        &$working = null
    ) {
        if ($this->is_feed($this->file)) {
            return $this->file;
        }

        if ($this->file->method & \SimplePie\SimplePie::FILE_SOURCE_REMOTE) {
            $sniffer = $this->registry->create(Content\Type\Sniffer::class, [
                $this->file,
            ]);
            if ($sniffer->get_type() !== "text/html") {
                return null;
            }
        }

        if ($type & ~\SimplePie\SimplePie::LOCATOR_NONE) {
            $this->get_base();
        }

        if (
            $type & \SimplePie\SimplePie::LOCATOR_AUTODISCOVERY &&
            ($working = $this->autodiscovery())
        ) {
            return $working[0];
        }

        if (
            $type &
                (\SimplePie\SimplePie::LOCATOR_LOCAL_EXTENSION |
                    \SimplePie\SimplePie::LOCATOR_LOCAL_BODY |
                    \SimplePie\SimplePie::LOCATOR_REMOTE_EXTENSION |
                    \SimplePie\SimplePie::LOCATOR_REMOTE_BODY) &&
            $this->get_links()
        ) {
            if (
                $type & \SimplePie\SimplePie::LOCATOR_LOCAL_EXTENSION &&
                ($working = $this->extension($this->local))
            ) {
                return $working[0];
            }

            if (
                $type & \SimplePie\SimplePie::LOCATOR_LOCAL_BODY &&
                ($working = $this->body($this->local))
            ) {
                return $working[0];
            }

            if (
                $type & \SimplePie\SimplePie::LOCATOR_REMOTE_EXTENSION &&
                ($working = $this->extension($this->elsewhere))
            ) {
                return $working[0];
            }

            if (
                $type & \SimplePie\SimplePie::LOCATOR_REMOTE_BODY &&
                ($working = $this->body($this->elsewhere))
            ) {
                return $working[0];
            }
        }
        return null;
    }

    public function is_feed($file, $check_html = false)
    {
        if ($file->method & \SimplePie\SimplePie::FILE_SOURCE_REMOTE) {
            $sniffer = $this->registry->create(Content\Type\Sniffer::class, [
                $file,
            ]);
            $sniffed = $sniffer->get_type();
            $mime_types = [
                "application/rss+xml",
                "application/rdf+xml",
                "text/rdf",
                "application/atom+xml",
                "text/xml",
                "application/xml",
                "application/x-rss+xml",
            ];
            if ($check_html) {
                $mime_types[] = "text/html";
            }

            return in_array($sniffed, $mime_types);
        } elseif ($file->method & \SimplePie\SimplePie::FILE_SOURCE_LOCAL) {
            return true;
        } else {
            return false;
        }
    }

    public function get_base()
    {
        if ($this->dom === null) {
            throw new \SimplePie\Exception(
                "DOMDocument not found, unable to use locator"
            );
        }
        $this->http_base = $this->file->url;
        $this->base = $this->http_base;
        $elements = $this->dom->getElementsByTagName("base");
        foreach ($elements as $element) {
            if ($element->hasAttribute("href")) {
                $base = $this->registry->call(Misc::class, "absolutize_url", [
                    trim($element->getAttribute("href")),
                    $this->http_base,
                ]);
                if ($base === false) {
                    continue;
                }
                $this->base = $base;
                $this->base_location = method_exists($element, "getLineNo")
                    ? $element->getLineNo()
                    : 0;
                break;
            }
        }
    }

    public function autodiscovery()
    {
        $done = [];
        $feeds = [];
        $feeds = array_merge(
            $feeds,
            $this->search_elements_by_tag("link", $done, $feeds)
        );
        $feeds = array_merge(
            $feeds,
            $this->search_elements_by_tag("a", $done, $feeds)
        );
        $feeds = array_merge(
            $feeds,
            $this->search_elements_by_tag("area", $done, $feeds)
        );

        if (!empty($feeds)) {
            return array_values($feeds);
        }

        return null;
    }

    protected function search_elements_by_tag($name, &$done, $feeds)
    {
        if ($this->dom === null) {
            throw new \SimplePie\Exception(
                "DOMDocument not found, unable to use locator"
            );
        }

        $links = $this->dom->getElementsByTagName($name);
        foreach ($links as $link) {
            if ($this->checked_feeds === $this->max_checked_feeds) {
                break;
            }
            if ($link->hasAttribute("href") && $link->hasAttribute("rel")) {
                $rel = array_unique(
                    $this->registry->call(
                        Misc::class,
                        "space_separated_tokens",
                        [strtolower($link->getAttribute("rel"))]
                    )
                );
                $line = method_exists($link, "getLineNo")
                    ? $link->getLineNo()
                    : 1;

                if ($this->base_location < $line) {
                    $href = $this->registry->call(
                        Misc::class,
                        "absolutize_url",
                        [trim($link->getAttribute("href")), $this->base]
                    );
                } else {
                    $href = $this->registry->call(
                        Misc::class,
                        "absolutize_url",
                        [trim($link->getAttribute("href")), $this->http_base]
                    );
                }
                if ($href === false) {
                    continue;
                }

                if (
                    (!in_array($href, $done) && in_array("feed", $rel)) ||
                    (in_array("alternate", $rel) &&
                        !in_array("stylesheet", $rel) &&
                        $link->hasAttribute("type") &&
                        in_array(
                            strtolower(
                                $this->registry->call(
                                    Misc::class,
                                    "parse_mime",
                                    [$link->getAttribute("type")]
                                )
                            ),
                            [
                                "text/html",
                                "application/rss+xml",
                                "application/atom+xml",
                            ]
                        ) &&
                        !isset($feeds[$href]))
                ) {
                    $this->checked_feeds++;
                    $headers = [
                        "Accept" =>
                            "application/atom+xml, application/rss+xml, application/rdf+xml;q=0.9, application/xml;q=0.8, text/xml;q=0.8, text/html;q=0.7, unknown/unknown;q=0.1, application/unknown;q=0.1, */*;q=0.1",
                    ];
                    $feed = $this->registry->create(File::class, [
                        $href,
                        $this->timeout,
                        5,
                        $headers,
                        $this->useragent,
                        $this->force_fsockopen,
                        $this->curl_options,
                    ]);
                    if (
                        $feed->success &&
                        ($feed->method &
                            (\SimplePie\SimplePie::FILE_SOURCE_REMOTE === 0) ||
                            ($feed->status_code === 200 ||
                                ($feed->status_code > 206 &&
                                    $feed->status_code < 300))) &&
                        $this->is_feed($feed, true)
                    ) {
                        $feeds[$href] = $feed;
                    }
                }
                $done[] = $href;
            }
        }

        return $feeds;
    }

    public function get_links()
    {
        if ($this->dom === null) {
            throw new \SimplePie\Exception(
                "DOMDocument not found, unable to use locator"
            );
        }

        $links = $this->dom->getElementsByTagName("a");
        foreach ($links as $link) {
            if ($link->hasAttribute("href")) {
                $href = trim($link->getAttribute("href"));
                $parsed = $this->registry->call(Misc::class, "parse_url", [
                    $href,
                ]);
                if (
                    $parsed["scheme"] === "" ||
                    preg_match('/^(https?|feed)?$/i', $parsed["scheme"])
                ) {
                    if (
                        method_exists($link, "getLineNo") &&
                        $this->base_location < $link->getLineNo()
                    ) {
                        $href = $this->registry->call(
                            Misc::class,
                            "absolutize_url",
                            [trim($link->getAttribute("href")), $this->base]
                        );
                    } else {
                        $href = $this->registry->call(
                            Misc::class,
                            "absolutize_url",
                            [
                                trim($link->getAttribute("href")),
                                $this->http_base,
                            ]
                        );
                    }
                    if ($href === false) {
                        continue;
                    }

                    $current = $this->registry->call(Misc::class, "parse_url", [
                        $this->file->url,
                    ]);

                    if (
                        $parsed["authority"] === "" ||
                        $parsed["authority"] === $current["authority"]
                    ) {
                        $this->local[] = $href;
                    } else {
                        $this->elsewhere[] = $href;
                    }
                }
            }
        }
        $this->local = array_unique($this->local);
        $this->elsewhere = array_unique($this->elsewhere);
        if (!empty($this->local) || !empty($this->elsewhere)) {
            return true;
        }
        return null;
    }

    public function get_rel_link($rel)
    {
        if ($this->dom === null) {
            throw new \SimplePie\Exception(
                "DOMDocument not found, unable to use " . "locator"
            );
        }
        if (!class_exists("DOMXpath")) {
            throw new \SimplePie\Exception(
                "DOMXpath not found, unable to use " . "get_rel_link"
            );
        }

        $xpath = new \DOMXpath($this->dom);
        $query = "//a[@rel and @href] | //link[@rel and @href]";
        foreach ($xpath->query($query) as $link) {
            $href = trim($link->getAttribute("href"));
            $parsed = $this->registry->call(Misc::class, "parse_url", [$href]);
            if (
                $parsed["scheme"] === "" ||
                preg_match('/^https?$/i', $parsed["scheme"])
            ) {
                if (
                    method_exists($link, "getLineNo") &&
                    $this->base_location < $link->getLineNo()
                ) {
                    $href = $this->registry->call(
                        Misc::class,
                        "absolutize_url",
                        [trim($link->getAttribute("href")), $this->base]
                    );
                } else {
                    $href = $this->registry->call(
                        Misc::class,
                        "absolutize_url",
                        [trim($link->getAttribute("href")), $this->http_base]
                    );
                }
                if ($href === false) {
                    return null;
                }
                $rel_values = explode(
                    " ",
                    strtolower($link->getAttribute("rel"))
                );
                if (in_array($rel, $rel_values)) {
                    return $href;
                }
            }
        }
        return null;
    }

    public function extension(&$array)
    {
        foreach ($array as $key => $value) {
            if ($this->checked_feeds === $this->max_checked_feeds) {
                break;
            }
            if (
                in_array(strtolower(strrchr($value, ".")), [
                    ".rss",
                    ".rdf",
                    ".atom",
                    ".xml",
                ])
            ) {
                $this->checked_feeds++;

                $headers = [
                    "Accept" =>
                        "application/atom+xml, application/rss+xml, application/rdf+xml;q=0.9, application/xml;q=0.8, text/xml;q=0.8, text/html;q=0.7, unknown/unknown;q=0.1, application/unknown;q=0.1, */*;q=0.1",
                ];
                $feed = $this->registry->create(File::class, [
                    $value,
                    $this->timeout,
                    5,
                    $headers,
                    $this->useragent,
                    $this->force_fsockopen,
                    $this->curl_options,
                ]);
                if (
                    $feed->success &&
                    ($feed->method &
                        (\SimplePie\SimplePie::FILE_SOURCE_REMOTE === 0) ||
                        ($feed->status_code === 200 ||
                            ($feed->status_code > 206 &&
                                $feed->status_code < 300))) &&
                    $this->is_feed($feed)
                ) {
                    return [$feed];
                } else {
                    unset($array[$key]);
                }
            }
        }
        return null;
    }

    public function body(&$array)
    {
        foreach ($array as $key => $value) {
            if ($this->checked_feeds === $this->max_checked_feeds) {
                break;
            }
            if (preg_match("/(feed|rss|rdf|atom|xml)/i", $value)) {
                $this->checked_feeds++;
                $headers = [
                    "Accept" =>
                        "application/atom+xml, application/rss+xml, application/rdf+xml;q=0.9, application/xml;q=0.8, text/xml;q=0.8, text/html;q=0.7, unknown/unknown;q=0.1, application/unknown;q=0.1, */*;q=0.1",
                ];
                $feed = $this->registry->create(File::class, [
                    $value,
                    $this->timeout,
                    5,
                    null,
                    $this->useragent,
                    $this->force_fsockopen,
                    $this->curl_options,
                ]);
                if (
                    $feed->success &&
                    ($feed->method &
                        (\SimplePie\SimplePie::FILE_SOURCE_REMOTE === 0) ||
                        ($feed->status_code === 200 ||
                            ($feed->status_code > 206 &&
                                $feed->status_code < 300))) &&
                    $this->is_feed($feed)
                ) {
                    return [$feed];
                } else {
                    unset($array[$key]);
                }
            }
        }
        return null;
    }
}

class_alias("SimplePie\Locator", "SimplePie_Locator", false);
