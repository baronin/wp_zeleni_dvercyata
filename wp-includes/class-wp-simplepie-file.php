<?php
/**
 * Feed API: WP_SimplePie_File class
 *
 * @package WordPress
 * @subpackage Feed
 * @since 4.7.0
 */

/**
 * Core class for fetching remote files and reading local files with SimplePie.
 *
 * This uses Core's HTTP API to make requests, which gives plugins the ability
 * to hook into the process.
 *
 * @since 2.8.0
 */
#[AllowDynamicProperties]
class WP_SimplePie_File extends SimplePie\File
{
    /**
     * Timeout.
     *
     * @var int How long the connection should stay open in seconds.
     */
    public $timeout = 10;

    /**
     * Constructor.
     *
     * @since 2.8.0
     * @since 3.2.0 Updated to use a PHP5 constructor.
     * @since 5.6.1 Multiple headers are concatenated into a comma-separated string,
     *              rather than remaining an array.
     *
     * @param string       $url             Remote file URL.
     * @param int          $timeout         Optional. How long the connection should stay open in seconds.
     *                                      Default 10.
     * @param int          $redirects       Optional. The number of allowed redirects. Default 5.
     * @param string|array $headers         Optional. Array or string of headers to send with the request.
     *                                      Default null.
     * @param string       $useragent       Optional. User-agent value sent. Default null.
     * @param bool         $force_fsockopen Optional. Whether to force opening internet or unix domain socket
     *                                      connection or not. Default false.
     */
    public function __construct(
        $url,
        $timeout = 10,
        $redirects = 5,
        $headers = null,
        $useragent = null,
        $force_fsockopen = false
    ) {
        $this->url = $url;
        $this->timeout = $timeout;
        $this->redirects = $redirects;
        $this->headers = $headers;
        $this->useragent = $useragent;

        $this->method = SimplePie\SimplePie::FILE_SOURCE_REMOTE;

        if (preg_match("/^http(s)?:\/\//i", $url)) {
            $args = [
                "timeout" => $this->timeout,
                "redirection" => $this->redirects,
            ];

            if (!empty($this->headers)) {
                $args["headers"] = $this->headers;
            }

            if (SimplePie\Misc::get_default_useragent() !== $this->useragent) {
                // Use default WP user agent unless custom has been specified.
                $args["user-agent"] = $this->useragent;
            }

            $res = wp_safe_remote_request($url, $args);

            if (is_wp_error($res)) {
                $this->error = "WP HTTP Error: " . $res->get_error_message();
                $this->success = false;
            } else {
                $this->headers = wp_remote_retrieve_headers($res);

                /*
                 * SimplePie expects multiple headers to be stored as a comma-separated string,
                 * but `wp_remote_retrieve_headers()` returns them as an array, so they need
                 * to be converted.
                 *
                 * The only exception to that is the `content-type` header, which should ignore
                 * any previous values and only use the last one.
                 *
                 * @see SimplePie\HTTP\Parser::new_line().
                 */
                foreach ($this->headers as $name => $value) {
                    if (!is_array($value)) {
                        continue;
                    }

                    if ("content-type" === $name) {
                        $this->headers[$name] = array_pop($value);
                    } else {
                        $this->headers[$name] = implode(", ", $value);
                    }
                }

                $this->body = wp_remote_retrieve_body($res);
                $this->status_code = wp_remote_retrieve_response_code($res);
            }
        } else {
            $this->error = "";
            $this->success = false;
        }
    }
}
