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
 * Handles `<atom:source>`
 *
 * Used by {@see \SimplePie\Item::get_source()}
 *
 * This class can be overloaded with {@see \SimplePie::set_source_class()}
 *
 * @package SimplePie
 * @subpackage API
 */
class Source implements RegistryAware
{
    public $item;
    public $data = [];
    protected $registry;

    public function __construct($item, $data)
    {
        $this->item = $item;
        $this->data = $data;
    }

    public function set_registry(\SimplePie\Registry $registry)
    {
        /* : void */ $this->registry = $registry;
    }

    public function __toString()
    {
        return md5(serialize($this->data));
    }

    public function get_source_tags($namespace, $tag)
    {
        if (isset($this->data["child"][$namespace][$tag])) {
            return $this->data["child"][$namespace][$tag];
        }

        return null;
    }

    public function get_base($element = [])
    {
        return $this->item->get_base($element);
    }

    public function sanitize($data, $type, $base = "")
    {
        return $this->item->sanitize($data, $type, $base);
    }

    public function get_item()
    {
        return $this->item;
    }

    public function get_title()
    {
        if (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_ATOM_10,
                "title"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                $this->registry->call(Misc::class, "atom_10_construct_type", [
                    $return[0]["attribs"],
                ]),
                $this->get_base($return[0])
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_ATOM_03,
                "title"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                $this->registry->call(Misc::class, "atom_03_construct_type", [
                    $return[0]["attribs"],
                ]),
                $this->get_base($return[0])
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_RSS_10,
                "title"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_MAYBE_HTML,
                $this->get_base($return[0])
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_RSS_090,
                "title"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_MAYBE_HTML,
                $this->get_base($return[0])
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_RSS_20,
                "title"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_MAYBE_HTML,
                $this->get_base($return[0])
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_DC_11,
                "title"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_TEXT
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_DC_10,
                "title"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_TEXT
            );
        }

        return null;
    }

    public function get_category($key = 0)
    {
        $categories = $this->get_categories();
        if (isset($categories[$key])) {
            return $categories[$key];
        }

        return null;
    }

    public function get_categories()
    {
        $categories = [];

        foreach (
            (array) $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_ATOM_10,
                "category"
            )
            as $category
        ) {
            $term = null;
            $scheme = null;
            $label = null;
            if (isset($category["attribs"][""]["term"])) {
                $term = $this->sanitize(
                    $category["attribs"][""]["term"],
                    \SimplePie\SimplePie::CONSTRUCT_TEXT
                );
            }
            if (isset($category["attribs"][""]["scheme"])) {
                $scheme = $this->sanitize(
                    $category["attribs"][""]["scheme"],
                    \SimplePie\SimplePie::CONSTRUCT_TEXT
                );
            }
            if (isset($category["attribs"][""]["label"])) {
                $label = $this->sanitize(
                    $category["attribs"][""]["label"],
                    \SimplePie\SimplePie::CONSTRUCT_TEXT
                );
            }
            $categories[] = $this->registry->create(Category::class, [
                $term,
                $scheme,
                $label,
            ]);
        }
        foreach (
            (array) $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_RSS_20,
                "category"
            )
            as $category
        ) {
            // This is really the label, but keep this as the term also for BC.
            // Label will also work on retrieving because that falls back to term.
            $term = $this->sanitize(
                $category["data"],
                \SimplePie\SimplePie::CONSTRUCT_TEXT
            );
            if (isset($category["attribs"][""]["domain"])) {
                $scheme = $this->sanitize(
                    $category["attribs"][""]["domain"],
                    \SimplePie\SimplePie::CONSTRUCT_TEXT
                );
            } else {
                $scheme = null;
            }
            $categories[] = $this->registry->create(Category::class, [
                $term,
                $scheme,
                null,
            ]);
        }
        foreach (
            (array) $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_DC_11,
                "subject"
            )
            as $category
        ) {
            $categories[] = $this->registry->create(Category::class, [
                $this->sanitize(
                    $category["data"],
                    \SimplePie\SimplePie::CONSTRUCT_TEXT
                ),
                null,
                null,
            ]);
        }
        foreach (
            (array) $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_DC_10,
                "subject"
            )
            as $category
        ) {
            $categories[] = $this->registry->create(Category::class, [
                $this->sanitize(
                    $category["data"],
                    \SimplePie\SimplePie::CONSTRUCT_TEXT
                ),
                null,
                null,
            ]);
        }

        if (!empty($categories)) {
            return array_unique($categories);
        }

        return null;
    }

    public function get_author($key = 0)
    {
        $authors = $this->get_authors();
        if (isset($authors[$key])) {
            return $authors[$key];
        }

        return null;
    }

    public function get_authors()
    {
        $authors = [];
        foreach (
            (array) $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_ATOM_10,
                "author"
            )
            as $author
        ) {
            $name = null;
            $uri = null;
            $email = null;
            if (
                isset(
                    $author["child"][\SimplePie\SimplePie::NAMESPACE_ATOM_10][
                        "name"
                    ][0]["data"]
                )
            ) {
                $name = $this->sanitize(
                    $author["child"][\SimplePie\SimplePie::NAMESPACE_ATOM_10][
                        "name"
                    ][0]["data"],
                    \SimplePie\SimplePie::CONSTRUCT_TEXT
                );
            }
            if (
                isset(
                    $author["child"][\SimplePie\SimplePie::NAMESPACE_ATOM_10][
                        "uri"
                    ][0]["data"]
                )
            ) {
                $uri = $this->sanitize(
                    $author["child"][\SimplePie\SimplePie::NAMESPACE_ATOM_10][
                        "uri"
                    ][0]["data"],
                    \SimplePie\SimplePie::CONSTRUCT_IRI,
                    $this->get_base(
                        $author["child"][
                            \SimplePie\SimplePie::NAMESPACE_ATOM_10
                        ]["uri"][0]
                    )
                );
            }
            if (
                isset(
                    $author["child"][\SimplePie\SimplePie::NAMESPACE_ATOM_10][
                        "email"
                    ][0]["data"]
                )
            ) {
                $email = $this->sanitize(
                    $author["child"][\SimplePie\SimplePie::NAMESPACE_ATOM_10][
                        "email"
                    ][0]["data"],
                    \SimplePie\SimplePie::CONSTRUCT_TEXT
                );
            }
            if ($name !== null || $email !== null || $uri !== null) {
                $authors[] = $this->registry->create(Author::class, [
                    $name,
                    $uri,
                    $email,
                ]);
            }
        }
        if (
            $author = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_ATOM_03,
                "author"
            )
        ) {
            $name = null;
            $url = null;
            $email = null;
            if (
                isset(
                    $author[0]["child"][
                        \SimplePie\SimplePie::NAMESPACE_ATOM_03
                    ]["name"][0]["data"]
                )
            ) {
                $name = $this->sanitize(
                    $author[0]["child"][
                        \SimplePie\SimplePie::NAMESPACE_ATOM_03
                    ]["name"][0]["data"],
                    \SimplePie\SimplePie::CONSTRUCT_TEXT
                );
            }
            if (
                isset(
                    $author[0]["child"][
                        \SimplePie\SimplePie::NAMESPACE_ATOM_03
                    ]["url"][0]["data"]
                )
            ) {
                $url = $this->sanitize(
                    $author[0]["child"][
                        \SimplePie\SimplePie::NAMESPACE_ATOM_03
                    ]["url"][0]["data"],
                    \SimplePie\SimplePie::CONSTRUCT_IRI,
                    $this->get_base(
                        $author[0]["child"][
                            \SimplePie\SimplePie::NAMESPACE_ATOM_03
                        ]["url"][0]
                    )
                );
            }
            if (
                isset(
                    $author[0]["child"][
                        \SimplePie\SimplePie::NAMESPACE_ATOM_03
                    ]["email"][0]["data"]
                )
            ) {
                $email = $this->sanitize(
                    $author[0]["child"][
                        \SimplePie\SimplePie::NAMESPACE_ATOM_03
                    ]["email"][0]["data"],
                    \SimplePie\SimplePie::CONSTRUCT_TEXT
                );
            }
            if ($name !== null || $email !== null || $url !== null) {
                $authors[] = $this->registry->create(Author::class, [
                    $name,
                    $url,
                    $email,
                ]);
            }
        }
        foreach (
            (array) $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_DC_11,
                "creator"
            )
            as $author
        ) {
            $authors[] = $this->registry->create(Author::class, [
                $this->sanitize(
                    $author["data"],
                    \SimplePie\SimplePie::CONSTRUCT_TEXT
                ),
                null,
                null,
            ]);
        }
        foreach (
            (array) $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_DC_10,
                "creator"
            )
            as $author
        ) {
            $authors[] = $this->registry->create(Author::class, [
                $this->sanitize(
                    $author["data"],
                    \SimplePie\SimplePie::CONSTRUCT_TEXT
                ),
                null,
                null,
            ]);
        }
        foreach (
            (array) $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_ITUNES,
                "author"
            )
            as $author
        ) {
            $authors[] = $this->registry->create(Author::class, [
                $this->sanitize(
                    $author["data"],
                    \SimplePie\SimplePie::CONSTRUCT_TEXT
                ),
                null,
                null,
            ]);
        }

        if (!empty($authors)) {
            return array_unique($authors);
        }

        return null;
    }

    public function get_contributor($key = 0)
    {
        $contributors = $this->get_contributors();
        if (isset($contributors[$key])) {
            return $contributors[$key];
        }

        return null;
    }

    public function get_contributors()
    {
        $contributors = [];
        foreach (
            (array) $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_ATOM_10,
                "contributor"
            )
            as $contributor
        ) {
            $name = null;
            $uri = null;
            $email = null;
            if (
                isset(
                    $contributor["child"][
                        \SimplePie\SimplePie::NAMESPACE_ATOM_10
                    ]["name"][0]["data"]
                )
            ) {
                $name = $this->sanitize(
                    $contributor["child"][
                        \SimplePie\SimplePie::NAMESPACE_ATOM_10
                    ]["name"][0]["data"],
                    \SimplePie\SimplePie::CONSTRUCT_TEXT
                );
            }
            if (
                isset(
                    $contributor["child"][
                        \SimplePie\SimplePie::NAMESPACE_ATOM_10
                    ]["uri"][0]["data"]
                )
            ) {
                $uri = $this->sanitize(
                    $contributor["child"][
                        \SimplePie\SimplePie::NAMESPACE_ATOM_10
                    ]["uri"][0]["data"],
                    \SimplePie\SimplePie::CONSTRUCT_IRI,
                    $this->get_base(
                        $contributor["child"][
                            \SimplePie\SimplePie::NAMESPACE_ATOM_10
                        ]["uri"][0]
                    )
                );
            }
            if (
                isset(
                    $contributor["child"][
                        \SimplePie\SimplePie::NAMESPACE_ATOM_10
                    ]["email"][0]["data"]
                )
            ) {
                $email = $this->sanitize(
                    $contributor["child"][
                        \SimplePie\SimplePie::NAMESPACE_ATOM_10
                    ]["email"][0]["data"],
                    \SimplePie\SimplePie::CONSTRUCT_TEXT
                );
            }
            if ($name !== null || $email !== null || $uri !== null) {
                $contributors[] = $this->registry->create(Author::class, [
                    $name,
                    $uri,
                    $email,
                ]);
            }
        }
        foreach (
            (array) $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_ATOM_03,
                "contributor"
            )
            as $contributor
        ) {
            $name = null;
            $url = null;
            $email = null;
            if (
                isset(
                    $contributor["child"][
                        \SimplePie\SimplePie::NAMESPACE_ATOM_03
                    ]["name"][0]["data"]
                )
            ) {
                $name = $this->sanitize(
                    $contributor["child"][
                        \SimplePie\SimplePie::NAMESPACE_ATOM_03
                    ]["name"][0]["data"],
                    \SimplePie\SimplePie::CONSTRUCT_TEXT
                );
            }
            if (
                isset(
                    $contributor["child"][
                        \SimplePie\SimplePie::NAMESPACE_ATOM_03
                    ]["url"][0]["data"]
                )
            ) {
                $url = $this->sanitize(
                    $contributor["child"][
                        \SimplePie\SimplePie::NAMESPACE_ATOM_03
                    ]["url"][0]["data"],
                    \SimplePie\SimplePie::CONSTRUCT_IRI,
                    $this->get_base(
                        $contributor["child"][
                            \SimplePie\SimplePie::NAMESPACE_ATOM_03
                        ]["url"][0]
                    )
                );
            }
            if (
                isset(
                    $contributor["child"][
                        \SimplePie\SimplePie::NAMESPACE_ATOM_03
                    ]["email"][0]["data"]
                )
            ) {
                $email = $this->sanitize(
                    $contributor["child"][
                        \SimplePie\SimplePie::NAMESPACE_ATOM_03
                    ]["email"][0]["data"],
                    \SimplePie\SimplePie::CONSTRUCT_TEXT
                );
            }
            if ($name !== null || $email !== null || $url !== null) {
                $contributors[] = $this->registry->create(Author::class, [
                    $name,
                    $url,
                    $email,
                ]);
            }
        }

        if (!empty($contributors)) {
            return array_unique($contributors);
        }

        return null;
    }

    public function get_link($key = 0, $rel = "alternate")
    {
        $links = $this->get_links($rel);
        if (isset($links[$key])) {
            return $links[$key];
        }

        return null;
    }

    /**
     * Added for parity between the parent-level and the item/entry-level.
     */
    public function get_permalink()
    {
        return $this->get_link(0);
    }

    public function get_links($rel = "alternate")
    {
        if (!isset($this->data["links"])) {
            $this->data["links"] = [];
            if (
                $links = $this->get_source_tags(
                    \SimplePie\SimplePie::NAMESPACE_ATOM_10,
                    "link"
                )
            ) {
                foreach ($links as $link) {
                    if (isset($link["attribs"][""]["href"])) {
                        $link_rel = isset($link["attribs"][""]["rel"])
                            ? $link["attribs"][""]["rel"]
                            : "alternate";
                        $this->data["links"][$link_rel][] = $this->sanitize(
                            $link["attribs"][""]["href"],
                            \SimplePie\SimplePie::CONSTRUCT_IRI,
                            $this->get_base($link)
                        );
                    }
                }
            }
            if (
                $links = $this->get_source_tags(
                    \SimplePie\SimplePie::NAMESPACE_ATOM_03,
                    "link"
                )
            ) {
                foreach ($links as $link) {
                    if (isset($link["attribs"][""]["href"])) {
                        $link_rel = isset($link["attribs"][""]["rel"])
                            ? $link["attribs"][""]["rel"]
                            : "alternate";
                        $this->data["links"][$link_rel][] = $this->sanitize(
                            $link["attribs"][""]["href"],
                            \SimplePie\SimplePie::CONSTRUCT_IRI,
                            $this->get_base($link)
                        );
                    }
                }
            }
            if (
                $links = $this->get_source_tags(
                    \SimplePie\SimplePie::NAMESPACE_RSS_10,
                    "link"
                )
            ) {
                $this->data["links"]["alternate"][] = $this->sanitize(
                    $links[0]["data"],
                    \SimplePie\SimplePie::CONSTRUCT_IRI,
                    $this->get_base($links[0])
                );
            }
            if (
                $links = $this->get_source_tags(
                    \SimplePie\SimplePie::NAMESPACE_RSS_090,
                    "link"
                )
            ) {
                $this->data["links"]["alternate"][] = $this->sanitize(
                    $links[0]["data"],
                    \SimplePie\SimplePie::CONSTRUCT_IRI,
                    $this->get_base($links[0])
                );
            }
            if (
                $links = $this->get_source_tags(
                    \SimplePie\SimplePie::NAMESPACE_RSS_20,
                    "link"
                )
            ) {
                $this->data["links"]["alternate"][] = $this->sanitize(
                    $links[0]["data"],
                    \SimplePie\SimplePie::CONSTRUCT_IRI,
                    $this->get_base($links[0])
                );
            }

            $keys = array_keys($this->data["links"]);
            foreach ($keys as $key) {
                if (
                    $this->registry->call(Misc::class, "is_isegment_nz_nc", [
                        $key,
                    ])
                ) {
                    if (
                        isset(
                            $this->data["links"][
                                \SimplePie\SimplePie::IANA_LINK_RELATIONS_REGISTRY .
                                    $key
                            ]
                        )
                    ) {
                        $this->data["links"][
                            \SimplePie\SimplePie::IANA_LINK_RELATIONS_REGISTRY .
                                $key
                        ] = array_merge(
                            $this->data["links"][$key],
                            $this->data["links"][
                                \SimplePie\SimplePie::IANA_LINK_RELATIONS_REGISTRY .
                                    $key
                            ]
                        );
                        $this->data["links"][$key] =
                            &$this->data["links"][
                                \SimplePie\SimplePie::IANA_LINK_RELATIONS_REGISTRY .
                                    $key
                            ];
                    } else {
                        $this->data["links"][
                            \SimplePie\SimplePie::IANA_LINK_RELATIONS_REGISTRY .
                                $key
                        ] = &$this->data["links"][$key];
                    }
                } elseif (
                    substr($key, 0, 41) ===
                    \SimplePie\SimplePie::IANA_LINK_RELATIONS_REGISTRY
                ) {
                    $this->data["links"][substr($key, 41)] =
                        &$this->data["links"][$key];
                }
                $this->data["links"][$key] = array_unique(
                    $this->data["links"][$key]
                );
            }
        }

        if (isset($this->data["links"][$rel])) {
            return $this->data["links"][$rel];
        }

        return null;
    }

    public function get_description()
    {
        if (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_ATOM_10,
                "subtitle"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                $this->registry->call(Misc::class, "atom_10_construct_type", [
                    $return[0]["attribs"],
                ]),
                $this->get_base($return[0])
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_ATOM_03,
                "tagline"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                $this->registry->call(Misc::class, "atom_03_construct_type", [
                    $return[0]["attribs"],
                ]),
                $this->get_base($return[0])
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_RSS_10,
                "description"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_MAYBE_HTML,
                $this->get_base($return[0])
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_RSS_090,
                "description"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_MAYBE_HTML,
                $this->get_base($return[0])
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_RSS_20,
                "description"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_MAYBE_HTML,
                $this->get_base($return[0])
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_DC_11,
                "description"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_TEXT
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_DC_10,
                "description"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_TEXT
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_ITUNES,
                "summary"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_HTML,
                $this->get_base($return[0])
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_ITUNES,
                "subtitle"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_HTML,
                $this->get_base($return[0])
            );
        }

        return null;
    }

    public function get_copyright()
    {
        if (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_ATOM_10,
                "rights"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                $this->registry->call(Misc::class, "atom_10_construct_type", [
                    $return[0]["attribs"],
                ]),
                $this->get_base($return[0])
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_ATOM_03,
                "copyright"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                $this->registry->call(Misc::class, "atom_03_construct_type", [
                    $return[0]["attribs"],
                ]),
                $this->get_base($return[0])
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_RSS_20,
                "copyright"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_TEXT
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_DC_11,
                "rights"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_TEXT
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_DC_10,
                "rights"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_TEXT
            );
        }

        return null;
    }

    public function get_language()
    {
        if (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_RSS_20,
                "language"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_TEXT
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_DC_11,
                "language"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_TEXT
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_DC_10,
                "language"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_TEXT
            );
        } elseif (isset($this->data["xml_lang"])) {
            return $this->sanitize(
                $this->data["xml_lang"],
                \SimplePie\SimplePie::CONSTRUCT_TEXT
            );
        }

        return null;
    }

    public function get_latitude()
    {
        if (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_W3C_BASIC_GEO,
                "lat"
            )
        ) {
            return (float) $return[0]["data"];
        } elseif (
            ($return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_GEORSS,
                "point"
            )) &&
            preg_match(
                '/^((?:-)?[0-9]+(?:\.[0-9]+)) ((?:-)?[0-9]+(?:\.[0-9]+))$/',
                trim($return[0]["data"]),
                $match
            )
        ) {
            return (float) $match[1];
        }

        return null;
    }

    public function get_longitude()
    {
        if (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_W3C_BASIC_GEO,
                "long"
            )
        ) {
            return (float) $return[0]["data"];
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_W3C_BASIC_GEO,
                "lon"
            )
        ) {
            return (float) $return[0]["data"];
        } elseif (
            ($return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_GEORSS,
                "point"
            )) &&
            preg_match(
                '/^((?:-)?[0-9]+(?:\.[0-9]+)) ((?:-)?[0-9]+(?:\.[0-9]+))$/',
                trim($return[0]["data"]),
                $match
            )
        ) {
            return (float) $match[2];
        }

        return null;
    }

    public function get_image_url()
    {
        if (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_ITUNES,
                "image"
            )
        ) {
            return $this->sanitize(
                $return[0]["attribs"][""]["href"],
                \SimplePie\SimplePie::CONSTRUCT_IRI
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_ATOM_10,
                "logo"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_IRI,
                $this->get_base($return[0])
            );
        } elseif (
            $return = $this->get_source_tags(
                \SimplePie\SimplePie::NAMESPACE_ATOM_10,
                "icon"
            )
        ) {
            return $this->sanitize(
                $return[0]["data"],
                \SimplePie\SimplePie::CONSTRUCT_IRI,
                $this->get_base($return[0])
            );
        }

        return null;
    }
}

class_alias("SimplePie\Source", "SimplePie_Source");
