<?php
/**
 * Customize API: WP_Customize_Nav_Menu_Item_Setting class
 *
 * @package WordPress
 * @subpackage Customize
 * @since 4.4.0
 */

/**
 * Customize Setting to represent a nav_menu.
 *
 * Subclass of WP_Customize_Setting to represent a nav_menu taxonomy term, and
 * the IDs for the nav_menu_items associated with the nav menu.
 *
 * @since 4.3.0
 *
 * @see WP_Customize_Setting
 */
class WP_Customize_Nav_Menu_Item_Setting extends WP_Customize_Setting
{
    const ID_PATTERN = '/^nav_menu_item\[(?P<id>-?\d+)\]$/';

    const POST_TYPE = "nav_menu_item";

    const TYPE = "nav_menu_item";

    /**
     * Setting type.
     *
     * @since 4.3.0
     * @var string
     */
    public $type = self::TYPE;

    /**
     * Default setting value.
     *
     * @since 4.3.0
     * @var array
     *
     * @see wp_setup_nav_menu_item()
     */
    public $default = [
        // The $menu_item_data for wp_update_nav_menu_item().
        "object_id" => 0,
        "object" => "", // Taxonomy name.
        "menu_item_parent" => 0, // A.K.A. menu-item-parent-id; note that post_parent is different, and not included.
        "position" => 0, // A.K.A. menu_order.
        "type" => "custom", // Note that type_label is not included here.
        "title" => "",
        "url" => "",
        "target" => "",
        "attr_title" => "",
        "description" => "",
        "classes" => "",
        "xfn" => "",
        "status" => "publish",
        "original_title" => "",
        "nav_menu_term_id" => 0, // This will be supplied as the $menu_id arg for wp_update_nav_menu_item().
        "_invalid" => false,
    ];

    /**
     * Default transport.
     *
     * @since 4.3.0
     * @since 4.5.0 Default changed to 'refresh'
     * @var string
     */
    public $transport = "refresh";

    /**
     * The post ID represented by this setting instance. This is the db_id.
     *
     * A negative value represents a placeholder ID for a new menu not yet saved.
     *
     * @since 4.3.0
     * @var int
     */
    public $post_id;

    /**
     * Storage of pre-setup menu item to prevent wasted calls to wp_setup_nav_menu_item().
     *
     * @since 4.3.0
     * @var array|null
     */
    protected $value;

    /**
     * Previous (placeholder) post ID used before creating a new menu item.
     *
     * This value will be exported to JS via the customize_save_response filter
     * so that JavaScript can update the settings to refer to the newly-assigned
     * post ID. This value is always negative to indicate it does not refer to
     * a real post.
     *
     * @since 4.3.0
     * @var int
     *
     * @see WP_Customize_Nav_Menu_Item_Setting::update()
     * @see WP_Customize_Nav_Menu_Item_Setting::amend_customize_save_response()
     */
    public $previous_post_id;

    /**
     * When previewing or updating a menu item, this stores the previous nav_menu_term_id
     * which ensures that we can apply the proper filters.
     *
     * @since 4.3.0
     * @var int
     */
    public $original_nav_menu_term_id;

    /**
     * Whether or not update() was called.
     *
     * @since 4.3.0
     * @var bool
     */
    protected $is_updated = false;

    /**
     * Status for calling the update method, used in customize_save_response filter.
     *
     * See {@see 'customize_save_response'}.
     *
     * When status is inserted, the placeholder post ID is stored in $previous_post_id.
     * When status is error, the error is stored in $update_error.
     *
     * @since 4.3.0
     * @var string updated|inserted|deleted|error
     *
     * @see WP_Customize_Nav_Menu_Item_Setting::update()
     * @see WP_Customize_Nav_Menu_Item_Setting::amend_customize_save_response()
     */
    public $update_status;

    /**
     * Any error object returned by wp_update_nav_menu_item() when setting is updated.
     *
     * @since 4.3.0
     * @var WP_Error
     *
     * @see WP_Customize_Nav_Menu_Item_Setting::update()
     * @see WP_Customize_Nav_Menu_Item_Setting::amend_customize_save_response()
     */
    public $update_error;

    /**
     * Constructor.
     *
     * Any supplied $args override class property defaults.
     *
     * @since 4.3.0
     *
     * @throws Exception If $id is not valid for this setting type.
     *
     * @param WP_Customize_Manager $manager Customizer bootstrap instance.
     * @param string               $id      A specific ID of the setting.
     *                                      Can be a theme mod or option name.
     * @param array                $args    Optional. Setting arguments.
     */
    public function __construct(
        WP_Customize_Manager $manager,
        $id,
        array $args = []
    ) {
        if (empty($manager->nav_menus)) {
            throw new Exception(
                'Expected WP_Customize_Manager::$nav_menus to be set.'
            );
        }

        if (!preg_match(self::ID_PATTERN, $id, $matches)) {
            throw new Exception("Illegal widget setting ID: $id");
        }

        $this->post_id = (int) $matches["id"];
        add_action(
            "wp_update_nav_menu_item",
            [$this, "flush_cached_value"],
            10,
            2
        );

        parent::__construct($manager, $id, $args);

        // Ensure that an initially-supplied value is valid.
        if (isset($this->value)) {
            $this->populate_value();
            foreach (
                array_diff(array_keys($this->default), array_keys($this->value))
                as $missing
            ) {
                throw new Exception(
                    "Supplied nav_menu_item value missing property: $missing"
                );
            }
        }
    }

    /**
     * Clear the cached value when this nav menu item is updated.
     *
     * @since 4.3.0
     *
     * @param int $menu_id       The term ID for the menu.
     * @param int $menu_item_id  The post ID for the menu item.
     */
    public function flush_cached_value($menu_id, $menu_item_id)
    {
        unset($menu_id);
        if ($menu_item_id === $this->post_id) {
            $this->value = null;
        }
    }

    /**
     * Get the instance data for a given nav_menu_item setting.
     *
     * @since 4.3.0
     *
     * @see wp_setup_nav_menu_item()
     *
     * @return array|false Instance data array, or false if the item is marked for deletion.
     */
    public function value()
    {
        if (
            $this->is_previewed &&
            get_current_blog_id() === $this->_previewed_blog_id
        ) {
            $undefined = new stdClass(); // Symbol.
            $post_value = $this->post_value($undefined);

            if ($undefined === $post_value) {
                $value = $this->_original_value;
            } else {
                $value = $post_value;
            }
            if (!empty($value) && empty($value["original_title"])) {
                $value["original_title"] = $this->get_original_title(
                    (object) $value
                );
            }
        } elseif (isset($this->value)) {
            $value = $this->value;
        } else {
            $value = false;

            // Note that an ID of less than one indicates a nav_menu not yet inserted.
            if ($this->post_id > 0) {
                $post = get_post($this->post_id);
                if ($post && self::POST_TYPE === $post->post_type) {
                    $is_title_empty = empty($post->post_title);
                    $value = (array) wp_setup_nav_menu_item($post);
                    if ($is_title_empty) {
                        $value["title"] = "";
                    }
                }
            }

            if (!is_array($value)) {
                $value = $this->default;
            }

            // Cache the value for future calls to avoid having to re-call wp_setup_nav_menu_item().
            $this->value = $value;
            $this->populate_value();
            $value = $this->value;
        }

        if (!empty($value) && empty($value["type_label"])) {
            $value["type_label"] = $this->get_type_label((object) $value);
        }

        return $value;
    }

    /**
     * Get original title.
     *
     * @since 4.7.0
     *
     * @param object $item Nav menu item.
     * @return string The original title.
     */
    protected function get_original_title($item)
    {
        $original_title = "";
        if ("post_type" === $item->type && !empty($item->object_id)) {
            $original_object = get_post($item->object_id);
            if ($original_object) {
                /** This filter is documented in wp-includes/post-template.php */
                $original_title = apply_filters(
                    "the_title",
                    $original_object->post_title,
                    $original_object->ID
                );

                if ("" === $original_title) {
                    /* translators: %d: ID of a post. */
                    $original_title = sprintf(
                        __("#%d (no title)"),
                        $original_object->ID
                    );
                }
            }
        } elseif ("taxonomy" === $item->type && !empty($item->object_id)) {
            $original_term_title = get_term_field(
                "name",
                $item->object_id,
                $item->object,
                "raw"
            );
            if (!is_wp_error($original_term_title)) {
                $original_title = $original_term_title;
            }
        } elseif ("post_type_archive" === $item->type) {
            $original_object = get_post_type_object($item->object);
            if ($original_object) {
                $original_title = $original_object->labels->archives;
            }
        }
        $original_title = html_entity_decode(
            $original_title,
            ENT_QUOTES,
            get_bloginfo("charset")
        );
        return $original_title;
    }

    /**
     * Get type label.
     *
     * @since 4.7.0
     *
     * @param object $item Nav menu item.
     * @return string The type label.
     */
    protected function get_type_label($item)
    {
        if ("post_type" === $item->type) {
            $object = get_post_type_object($item->object);
            if ($object) {
                $type_label = $object->labels->singular_name;
            } else {
                $type_label = $item->object;
            }
        } elseif ("taxonomy" === $item->type) {
            $object = get_taxonomy($item->object);
            if ($object) {
                $type_label = $object->labels->singular_name;
            } else {
                $type_label = $item->object;
            }
        } elseif ("post_type_archive" === $item->type) {
            $type_label = __("Post Type Archive");
        } else {
            $type_label = __("Custom Link");
        }
        return $type_label;
    }

    /**
     * Ensure that the value is fully populated with the necessary properties.
     *
     * Translates some properties added by wp_setup_nav_menu_item() and removes others.
     *
     * @since 4.3.0
     *
     * @see WP_Customize_Nav_Menu_Item_Setting::value()
     */
    protected function populate_value()
    {
        if (!is_array($this->value)) {
            return;
        }

        if (isset($this->value["menu_order"])) {
            $this->value["position"] = $this->value["menu_order"];
            unset($this->value["menu_order"]);
        }
        if (isset($this->value["post_status"])) {
            $this->value["status"] = $this->value["post_status"];
            unset($this->value["post_status"]);
        }

        if (!isset($this->value["original_title"])) {
            $this->value["original_title"] = $this->get_original_title(
                (object) $this->value
            );
        }

        if (!isset($this->value["nav_menu_term_id"]) && $this->post_id > 0) {
            $menus = wp_get_post_terms(
                $this->post_id,
                WP_Customize_Nav_Menu_Setting::TAXONOMY,
                [
                    "fields" => "ids",
                ]
            );
            if (!empty($menus)) {
                $this->value["nav_menu_term_id"] = array_shift($menus);
            } else {
                $this->value["nav_menu_term_id"] = 0;
            }
        }

        foreach (
            ["object_id", "menu_item_parent", "nav_menu_term_id"]
            as $key
        ) {
            if (!is_int($this->value[$key])) {
                $this->value[$key] = (int) $this->value[$key];
            }
        }
        foreach (["classes", "xfn"] as $key) {
            if (is_array($this->value[$key])) {
                $this->value[$key] = implode(" ", $this->value[$key]);
            }
        }

        if (!isset($this->value["title"])) {
            $this->value["title"] = "";
        }

        if (!isset($this->value["_invalid"])) {
            $this->value["_invalid"] = false;
            $is_known_invalid =
                (("post_type" === $this->value["type"] ||
                    "post_type_archive" === $this->value["type"]) &&
                    !post_type_exists($this->value["object"])) ||
                ("taxonomy" === $this->value["type"] &&
                    !taxonomy_exists($this->value["object"]));
            if ($is_known_invalid) {
                $this->value["_invalid"] = true;
            }
        }

        // Remove remaining properties available on a setup nav_menu_item post object which aren't relevant to the setting value.
        $irrelevant_properties = [
            "ID",
            "comment_count",
            "comment_status",
            "db_id",
            "filter",
            "guid",
            "ping_status",
            "pinged",
            "post_author",
            "post_content",
            "post_content_filtered",
            "post_date",
            "post_date_gmt",
            "post_excerpt",
            "post_mime_type",
            "post_modified",
            "post_modified_gmt",
            "post_name",
            "post_parent",
            "post_password",
            "post_title",
            "post_type",
            "to_ping",
        ];
        foreach ($irrelevant_properties as $property) {
            unset($this->value[$property]);
        }
    }

    /**
     * Handle previewing the setting.
     *
     * @since 4.3.0
     * @since 4.4.0 Added boolean return value.
     *
     * @see WP_Customize_Manager::post_value()
     *
     * @return bool False if method short-circuited due to no-op.
     */
    public function preview()
    {
        if ($this->is_previewed) {
            return false;
        }

        $undefined = new stdClass();
        $is_placeholder = $this->post_id < 0;
        $is_dirty = $undefined !== $this->post_value($undefined);
        if (!$is_placeholder && !$is_dirty) {
            return false;
        }

        $this->is_previewed = true;
        $this->_original_value = $this->value();
        $this->original_nav_menu_term_id =
            $this->_original_value["nav_menu_term_id"];
        $this->_previewed_blog_id = get_current_blog_id();

        add_filter(
            "wp_get_nav_menu_items",
            [$this, "filter_wp_get_nav_menu_items"],
            10,
            3
        );

        $sort_callback = [__CLASS__, "sort_wp_get_nav_menu_items"];
        if (!has_filter("wp_get_nav_menu_items", $sort_callback)) {
            add_filter(
                "wp_get_nav_menu_items",
                [__CLASS__, "sort_wp_get_nav_menu_items"],
                1000,
                3
            );
        }

        // @todo Add get_post_metadata filters for plugins to add their data.

        return true;
    }

    /**
     * Filters the wp_get_nav_menu_items() result to supply the previewed menu items.
     *
     * @since 4.3.0
     *
     * @see wp_get_nav_menu_items()
     *
     * @param WP_Post[] $items An array of menu item post objects.
     * @param WP_Term   $menu  The menu object.
     * @param array     $args  An array of arguments used to retrieve menu item objects.
     * @return WP_Post[] Array of menu item objects.
     */
    public function filter_wp_get_nav_menu_items($items, $menu, $args)
    {
        $this_item = $this->value();
        $current_nav_menu_term_id = null;
        if (isset($this_item["nav_menu_term_id"])) {
            $current_nav_menu_term_id = $this_item["nav_menu_term_id"];
            unset($this_item["nav_menu_term_id"]);
        }

        $should_filter =
            $menu->term_id === $this->original_nav_menu_term_id ||
            $menu->term_id === $current_nav_menu_term_id;
        if (!$should_filter) {
            return $items;
        }

        // Handle deleted menu item, or menu item moved to another menu.
        $should_remove =
            false === $this_item ||
            (isset($this_item["_invalid"]) &&
                true === $this_item["_invalid"]) ||
            ($this->original_nav_menu_term_id === $menu->term_id &&
                $current_nav_menu_term_id !== $this->original_nav_menu_term_id);
        if ($should_remove) {
            $filtered_items = [];
            foreach ($items as $item) {
                if ($item->db_id !== $this->post_id) {
                    $filtered_items[] = $item;
                }
            }
            return $filtered_items;
        }

        $mutated = false;
        $should_update =
            is_array($this_item) &&
            $current_nav_menu_term_id === $menu->term_id;
        if ($should_update) {
            foreach ($items as $item) {
                if ($item->db_id === $this->post_id) {
                    foreach (
                        get_object_vars($this->value_as_wp_post_nav_menu_item())
                        as $key => $value
                    ) {
                        $item->$key = $value;
                    }
                    $mutated = true;
                }
            }

            // Not found so we have to append it..
            if (!$mutated) {
                $items[] = $this->value_as_wp_post_nav_menu_item();
            }
        }

        return $items;
    }

    /**
     * Re-apply the tail logic also applied on $items by wp_get_nav_menu_items().
     *
     * @since 4.3.0
     *
     * @see wp_get_nav_menu_items()
     *
     * @param WP_Post[] $items An array of menu item post objects.
     * @param WP_Term   $menu  The menu object.
     * @param array     $args  An array of arguments used to retrieve menu item objects.
     * @return WP_Post[] Array of menu item objects.
     */
    public static function sort_wp_get_nav_menu_items($items, $menu, $args)
    {
        // @todo We should probably re-apply some constraints imposed by $args.
        unset($args["include"]);

        // Remove invalid items only in front end.
        if (!is_admin()) {
            $items = array_filter($items, "_is_valid_nav_menu_item");
        }

        if (ARRAY_A === $args["output"]) {
            $items = wp_list_sort($items, [
                $args["output_key"] => "ASC",
            ]);
            $i = 1;

            foreach ($items as $k => $item) {
                $items[$k]->{$args["output_key"]} = $i++;
            }
        }

        return $items;
    }

    /**
     * Get the value emulated into a WP_Post and set up as a nav_menu_item.
     *
     * @since 4.3.0
     *
     * @return WP_Post With wp_setup_nav_menu_item() applied.
     */
    public function value_as_wp_post_nav_menu_item()
    {
        $item = (object) $this->value();
        unset($item->nav_menu_term_id);

        $item->post_status = $item->status;
        unset($item->status);

        $item->post_type = "nav_menu_item";
        $item->menu_order = $item->position;
        unset($item->position);

        if (empty($item->original_title)) {
            $item->original_title = $this->get_original_title($item);
        }
        if (empty($item->title) && !empty($item->original_title)) {
            $item->title = $item->original_title;
        }
        if ($item->title) {
            $item->post_title = $item->title;
        }

        // 'classes' should be an array, as in wp_setup_nav_menu_item().
        if (isset($item->classes) && is_scalar($item->classes)) {
            $item->classes = explode(" ", $item->classes);
        }

        $item->ID = $this->post_id;
        $item->db_id = $this->post_id;
        $post = new WP_Post((object) $item);

        if (empty($post->post_author)) {
            $post->post_author = get_current_user_id();
        }

        if (!isset($post->type_label)) {
            $post->type_label = $this->get_type_label($post);
        }

        // Ensure nav menu item URL is set according to linked object.
        if ("post_type" === $post->type && !empty($post->object_id)) {
            $post->url = get_permalink($post->object_id);
        } elseif (
            "taxonomy" === $post->type &&
            !empty($post->object) &&
            !empty($post->object_id)
        ) {
            $post->url = get_term_link((int) $post->object_id, $post->object);
        } elseif (
            "post_type_archive" === $post->type &&
            !empty($post->object)
        ) {
            $post->url = get_post_type_archive_link($post->object);
        }
        if (is_wp_error($post->url)) {
            $post->url = "";
        }

        /** This filter is documented in wp-includes/nav-menu.php */
        $post->attr_title = apply_filters(
            "nav_menu_attr_title",
            $post->attr_title
        );

        /** This filter is documented in wp-includes/nav-menu.php */
        $post->description = apply_filters(
            "nav_menu_description",
            wp_trim_words($post->description, 200)
        );

        /** This filter is documented in wp-includes/nav-menu.php */
        $post = apply_filters("wp_setup_nav_menu_item", $post);

        return $post;
    }

    /**
     * Sanitize an input.
     *
     * Note that parent::sanitize() erroneously does wp_unslash() on $value, but
     * we remove that in this override.
     *
     * @since 4.3.0
     * @since 5.9.0 Renamed `$menu_item_value` to `$value` for PHP 8 named parameter support.
     *
     * @param array $value The menu item value to sanitize.
     * @return array|false|null|WP_Error Null or WP_Error if an input isn't valid. False if it is marked for deletion.
     *                                   Otherwise the sanitized value.
     */
    public function sanitize($value)
    {
        // Restores the more descriptive, specific name for use within this method.
        $menu_item_value = $value;

        // Menu is marked for deletion.
        if (false === $menu_item_value) {
            return $menu_item_value;
        }

        // Invalid.
        if (!is_array($menu_item_value)) {
            return null;
        }

        $default = [
            "object_id" => 0,
            "object" => "",
            "menu_item_parent" => 0,
            "position" => 0,
            "type" => "custom",
            "title" => "",
            "url" => "",
            "target" => "",
            "attr_title" => "",
            "description" => "",
            "classes" => "",
            "xfn" => "",
            "status" => "publish",
            "original_title" => "",
            "nav_menu_term_id" => 0,
            "_invalid" => false,
        ];
        $menu_item_value = array_merge($default, $menu_item_value);
        $menu_item_value = wp_array_slice_assoc(
            $menu_item_value,
            array_keys($default)
        );
        $menu_item_value["position"] = (int) $menu_item_value["position"];

        foreach (
            ["object_id", "menu_item_parent", "nav_menu_term_id"]
            as $key
        ) {
            // Note we need to allow negative-integer IDs for previewed objects not inserted yet.
            $menu_item_value[$key] = (int) $menu_item_value[$key];
        }

        foreach (["type", "object", "target"] as $key) {
            $menu_item_value[$key] = sanitize_key($menu_item_value[$key]);
        }

        foreach (["xfn", "classes"] as $key) {
            $value = $menu_item_value[$key];
            if (!is_array($value)) {
                $value = explode(" ", $value);
            }
            $menu_item_value[$key] = implode(
                " ",
                array_map("sanitize_html_class", $value)
            );
        }

        $menu_item_value["original_title"] = sanitize_text_field(
            $menu_item_value["original_title"]
        );

        // Apply the same filters as when calling wp_insert_post().

        /** This filter is documented in wp-includes/post.php */
        $menu_item_value["title"] = wp_unslash(
            apply_filters("title_save_pre", wp_slash($menu_item_value["title"]))
        );

        /** This filter is documented in wp-includes/post.php */
        $menu_item_value["attr_title"] = wp_unslash(
            apply_filters(
                "excerpt_save_pre",
                wp_slash($menu_item_value["attr_title"])
            )
        );

        /** This filter is documented in wp-includes/post.php */
        $menu_item_value["description"] = wp_unslash(
            apply_filters(
                "content_save_pre",
                wp_slash($menu_item_value["description"])
            )
        );

        if ("" !== $menu_item_value["url"]) {
            $menu_item_value["url"] = sanitize_url($menu_item_value["url"]);
            if ("" === $menu_item_value["url"]) {
                return new WP_Error("invalid_url", __("Invalid URL.")); // Fail sanitization if URL is invalid.
            }
        }
        if ("publish" !== $menu_item_value["status"]) {
            $menu_item_value["status"] = "draft";
        }

        $menu_item_value["_invalid"] = (bool) $menu_item_value["_invalid"];

        /** This filter is documented in wp-includes/class-wp-customize-setting.php */
        return apply_filters(
            "customize_sanitize_{$this->id}",
            $menu_item_value,
            $this
        );
    }

    /**
     * Creates/updates the nav_menu_item post for this setting.
     *
     * Any created menu items will have their assigned post IDs exported to the client
     * via the {@see 'customize_save_response'} filter. Likewise, any errors will be
     * exported to the client via the customize_save_response() filter.
     *
     * To delete a menu, the client can send false as the value.
     *
     * @since 4.3.0
     *
     * @see wp_update_nav_menu_item()
     *
     * @param array|false $value The menu item array to update. If false, then the menu item will be deleted
     *                           entirely. See WP_Customize_Nav_Menu_Item_Setting::$default for what the value
     *                           should consist of.
     * @return null|void
     */
    protected function update($value)
    {
        if ($this->is_updated) {
            return;
        }

        $this->is_updated = true;
        $is_placeholder = $this->post_id < 0;
        $is_delete = false === $value;

        // Update the cached value.
        $this->value = $value;

        add_filter("customize_save_response", [
            $this,
            "amend_customize_save_response",
        ]);

        if ($is_delete) {
            // If the current setting post is a placeholder, a delete request is a no-op.
            if ($is_placeholder) {
                $this->update_status = "deleted";
            } else {
                $r = wp_delete_post($this->post_id, true);

                if (false === $r) {
                    $this->update_error = new WP_Error("delete_failure");
                    $this->update_status = "error";
                } else {
                    $this->update_status = "deleted";
                }
                // @todo send back the IDs for all associated nav menu items deleted, so these settings (and controls) can be removed from Customizer?
            }
        } else {
            // Handle saving menu items for menus that are being newly-created.
            if ($value["nav_menu_term_id"] < 0) {
                $nav_menu_setting_id = sprintf(
                    "nav_menu[%s]",
                    $value["nav_menu_term_id"]
                );
                $nav_menu_setting = $this->manager->get_setting(
                    $nav_menu_setting_id
                );

                if (
                    !$nav_menu_setting ||
                    !(
                        $nav_menu_setting instanceof
                        WP_Customize_Nav_Menu_Setting
                    )
                ) {
                    $this->update_status = "error";
                    $this->update_error = new WP_Error(
                        "unexpected_nav_menu_setting"
                    );
                    return;
                }

                if (false === $nav_menu_setting->save()) {
                    $this->update_status = "error";
                    $this->update_error = new WP_Error(
                        "nav_menu_setting_failure"
                    );
                    return;
                }

                if (
                    (int) $value["nav_menu_term_id"] !==
                    $nav_menu_setting->previous_term_id
                ) {
                    $this->update_status = "error";
                    $this->update_error = new WP_Error(
                        "unexpected_previous_term_id"
                    );
                    return;
                }

                $value["nav_menu_term_id"] = $nav_menu_setting->term_id;
            }

            // Handle saving a nav menu item that is a child of a nav menu item being newly-created.
            if ($value["menu_item_parent"] < 0) {
                $parent_nav_menu_item_setting_id = sprintf(
                    "nav_menu_item[%s]",
                    $value["menu_item_parent"]
                );
                $parent_nav_menu_item_setting = $this->manager->get_setting(
                    $parent_nav_menu_item_setting_id
                );

                if (
                    !$parent_nav_menu_item_setting ||
                    !(
                        $parent_nav_menu_item_setting instanceof
                        WP_Customize_Nav_Menu_Item_Setting
                    )
                ) {
                    $this->update_status = "error";
                    $this->update_error = new WP_Error(
                        "unexpected_nav_menu_item_setting"
                    );
                    return;
                }

                if (false === $parent_nav_menu_item_setting->save()) {
                    $this->update_status = "error";
                    $this->update_error = new WP_Error(
                        "nav_menu_item_setting_failure"
                    );
                    return;
                }

                if (
                    (int) $value["menu_item_parent"] !==
                    $parent_nav_menu_item_setting->previous_post_id
                ) {
                    $this->update_status = "error";
                    $this->update_error = new WP_Error(
                        "unexpected_previous_post_id"
                    );
                    return;
                }

                $value["menu_item_parent"] =
                    $parent_nav_menu_item_setting->post_id;
            }

            // Insert or update menu.
            $menu_item_data = [
                "menu-item-object-id" => $value["object_id"],
                "menu-item-object" => $value["object"],
                "menu-item-parent-id" => $value["menu_item_parent"],
                "menu-item-position" => $value["position"],
                "menu-item-type" => $value["type"],
                "menu-item-title" => $value["title"],
                "menu-item-url" => $value["url"],
                "menu-item-description" => $value["description"],
                "menu-item-attr-title" => $value["attr_title"],
                "menu-item-target" => $value["target"],
                "menu-item-classes" => $value["classes"],
                "menu-item-xfn" => $value["xfn"],
                "menu-item-status" => $value["status"],
            ];

            $r = wp_update_nav_menu_item(
                $value["nav_menu_term_id"],
                $is_placeholder ? 0 : $this->post_id,
                wp_slash($menu_item_data)
            );

            if (is_wp_error($r)) {
                $this->update_status = "error";
                $this->update_error = $r;
            } else {
                if ($is_placeholder) {
                    $this->previous_post_id = $this->post_id;
                    $this->post_id = $r;
                    $this->update_status = "inserted";
                } else {
                    $this->update_status = "updated";
                }
            }
        }
    }

    /**
     * Export data for the JS client.
     *
     * @since 4.3.0
     *
     * @see WP_Customize_Nav_Menu_Item_Setting::update()
     *
     * @param array $data Additional information passed back to the 'saved' event on `wp.customize`.
     * @return array Save response data.
     */
    public function amend_customize_save_response($data)
    {
        if (!isset($data["nav_menu_item_updates"])) {
            $data["nav_menu_item_updates"] = [];
        }

        $data["nav_menu_item_updates"][] = [
            "post_id" => $this->post_id,
            "previous_post_id" => $this->previous_post_id,
            "error" => $this->update_error
                ? $this->update_error->get_error_code()
                : null,
            "status" => $this->update_status,
        ];
        return $data;
    }
}
