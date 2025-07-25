<?php
/**
 * Customize API: WP_Customize_Selective_Refresh class
 *
 * @package WordPress
 * @subpackage Customize
 * @since 4.5.0
 */

/**
 * Core Customizer class for implementing selective refresh.
 *
 * @since 4.5.0
 */
#[AllowDynamicProperties]
final class WP_Customize_Selective_Refresh
{
    /**
     * Query var used in requests to render partials.
     *
     * @since 4.5.0
     */
    const RENDER_QUERY_VAR = "wp_customize_render_partials";

    /**
     * Customize manager.
     *
     * @since 4.5.0
     * @var WP_Customize_Manager
     */
    public $manager;

    /**
     * Registered instances of WP_Customize_Partial.
     *
     * @since 4.5.0
     * @var WP_Customize_Partial[]
     */
    protected $partials = [];

    /**
     * Log of errors triggered when partials are rendered.
     *
     * @since 4.5.0
     * @var array
     */
    protected $triggered_errors = [];

    /**
     * Keep track of the current partial being rendered.
     *
     * @since 4.5.0
     * @var string|null
     */
    protected $current_partial_id;

    /**
     * Plugin bootstrap for Partial Refresh functionality.
     *
     * @since 4.5.0
     *
     * @param WP_Customize_Manager $manager Customizer bootstrap instance.
     */
    public function __construct(WP_Customize_Manager $manager)
    {
        $this->manager = $manager;
        require_once ABSPATH .
            WPINC .
            "/customize/class-wp-customize-partial.php";

        add_action("customize_preview_init", [$this, "init_preview"]);
    }

    /**
     * Retrieves the registered partials.
     *
     * @since 4.5.0
     *
     * @return array Partials.
     */
    public function partials()
    {
        return $this->partials;
    }

    /**
     * Adds a partial.
     *
     * @since 4.5.0
     *
     * @see WP_Customize_Partial::__construct()
     *
     * @param WP_Customize_Partial|string $id   Customize Partial object, or Partial ID.
     * @param array                       $args Optional. Array of properties for the new Partials object.
     *                                          See WP_Customize_Partial::__construct() for information
     *                                          on accepted arguments. Default empty array.
     * @return WP_Customize_Partial The instance of the partial that was added.
     */
    public function add_partial($id, $args = [])
    {
        if ($id instanceof WP_Customize_Partial) {
            $partial = $id;
        } else {
            $class = "WP_Customize_Partial";

            /** This filter is documented in wp-includes/customize/class-wp-customize-selective-refresh.php */
            $args = apply_filters("customize_dynamic_partial_args", $args, $id);

            /** This filter is documented in wp-includes/customize/class-wp-customize-selective-refresh.php */
            $class = apply_filters(
                "customize_dynamic_partial_class",
                $class,
                $id,
                $args
            );

            $partial = new $class($this, $id, $args);
        }

        $this->partials[$partial->id] = $partial;
        return $partial;
    }

    /**
     * Retrieves a partial.
     *
     * @since 4.5.0
     *
     * @param string $id Customize Partial ID.
     * @return WP_Customize_Partial|null The partial, if set. Otherwise null.
     */
    public function get_partial($id)
    {
        if (isset($this->partials[$id])) {
            return $this->partials[$id];
        } else {
            return null;
        }
    }

    /**
     * Removes a partial.
     *
     * @since 4.5.0
     *
     * @param string $id Customize Partial ID.
     */
    public function remove_partial($id)
    {
        unset($this->partials[$id]);
    }

    /**
     * Initializes the Customizer preview.
     *
     * @since 4.5.0
     */
    public function init_preview()
    {
        add_action("template_redirect", [
            $this,
            "handle_render_partials_request",
        ]);
        add_action("wp_enqueue_scripts", [$this, "enqueue_preview_scripts"]);
    }

    /**
     * Enqueues preview scripts.
     *
     * @since 4.5.0
     */
    public function enqueue_preview_scripts()
    {
        wp_enqueue_script("customize-selective-refresh");
        add_action("wp_footer", [$this, "export_preview_data"], 1000);
    }

    /**
     * Exports data in preview after it has finished rendering so that partials can be added at runtime.
     *
     * @since 4.5.0
     */
    public function export_preview_data()
    {
        $partials = [];

        foreach ($this->partials() as $partial) {
            if ($partial->check_capabilities()) {
                $partials[$partial->id] = $partial->json();
            }
        }

        $switched_locale = switch_to_user_locale(get_current_user_id());
        $l10n = [
            "shiftClickToEdit" => __("Shift-click to edit this element."),
            "clickEditMenu" => __("Click to edit this menu."),
            "clickEditWidget" => __("Click to edit this widget."),
            "clickEditTitle" => __("Click to edit the site title."),
            "clickEditMisc" => __("Click to edit this element."),
            /* translators: %s: document.write() */
            "badDocumentWrite" => sprintf(
                __("%s is forbidden"),
                "document.write()"
            ),
        ];
        if ($switched_locale) {
            restore_previous_locale();
        }

        $exports = [
            "partials" => $partials,
            "renderQueryVar" => self::RENDER_QUERY_VAR,
            "l10n" => $l10n,
        ];

        // Export data to JS.
        wp_print_inline_script_tag(
            sprintf(
                "var _customizePartialRefreshExports = %s;",
                wp_json_encode($exports)
            )
        );
    }

    /**
     * Registers dynamically-created partials.
     *
     * @since 4.5.0
     *
     * @see WP_Customize_Manager::add_dynamic_settings()
     *
     * @param string[] $partial_ids Array of the partial IDs to add.
     * @return WP_Customize_Partial[] Array of added WP_Customize_Partial instances.
     */
    public function add_dynamic_partials($partial_ids)
    {
        $new_partials = [];

        foreach ($partial_ids as $partial_id) {
            // Skip partials already created.
            $partial = $this->get_partial($partial_id);
            if ($partial) {
                continue;
            }

            $partial_args = false;
            $partial_class = "WP_Customize_Partial";

            /**
             * Filters a dynamic partial's constructor arguments.
             *
             * For a dynamic partial to be registered, this filter must be employed
             * to override the default false value with an array of args to pass to
             * the WP_Customize_Partial constructor.
             *
             * @since 4.5.0
             *
             * @param false|array $partial_args The arguments to the WP_Customize_Partial constructor.
             * @param string      $partial_id   ID for dynamic partial.
             */
            $partial_args = apply_filters(
                "customize_dynamic_partial_args",
                $partial_args,
                $partial_id
            );
            if (false === $partial_args) {
                continue;
            }

            /**
             * Filters the class used to construct partials.
             *
             * Allow non-statically created partials to be constructed with custom WP_Customize_Partial subclass.
             *
             * @since 4.5.0
             *
             * @param string $partial_class WP_Customize_Partial or a subclass.
             * @param string $partial_id    ID for dynamic partial.
             * @param array  $partial_args  The arguments to the WP_Customize_Partial constructor.
             */
            $partial_class = apply_filters(
                "customize_dynamic_partial_class",
                $partial_class,
                $partial_id,
                $partial_args
            );

            $partial = new $partial_class($this, $partial_id, $partial_args);

            $this->add_partial($partial);
            $new_partials[] = $partial;
        }
        return $new_partials;
    }

    /**
     * Checks whether the request is for rendering partials.
     *
     * Note that this will not consider whether the request is authorized or valid,
     * just that essentially the route is a match.
     *
     * @since 4.5.0
     *
     * @return bool Whether the request is for rendering partials.
     */
    public function is_render_partials_request()
    {
        return !empty($_POST[self::RENDER_QUERY_VAR]);
    }

    /**
     * Handles PHP errors triggered during rendering the partials.
     *
     * These errors will be relayed back to the client in the Ajax response.
     *
     * @since 4.5.0
     *
     * @param int    $errno   Error number.
     * @param string $errstr  Error string.
     * @param string $errfile Error file.
     * @param int    $errline Error line.
     * @return true Always true.
     */
    public function handle_error(
        $errno,
        $errstr,
        $errfile = null,
        $errline = null
    ) {
        $this->triggered_errors[] = [
            "partial" => $this->current_partial_id,
            "error_number" => $errno,
            "error_string" => $errstr,
            "error_file" => $errfile,
            "error_line" => $errline,
        ];
        return true;
    }

    /**
     * Handles the Ajax request to return the rendered partials for the requested placements.
     *
     * @since 4.5.0
     */
    public function handle_render_partials_request()
    {
        if (!$this->is_render_partials_request()) {
            return;
        }

        /*
         * Note that is_customize_preview() returning true will entail that the
         * user passed the 'customize' capability check and the nonce check, since
         * WP_Customize_Manager::setup_theme() is where the previewing flag is set.
         */
        if (!is_customize_preview()) {
            wp_send_json_error("expected_customize_preview", 403);
        } elseif (!isset($_POST["partials"])) {
            wp_send_json_error("missing_partials", 400);
        }

        // Ensure that doing selective refresh on 404 template doesn't result in fallback rendering behavior (full refreshes).
        status_header(200);

        $partials = json_decode(wp_unslash($_POST["partials"]), true);

        if (!is_array($partials)) {
            wp_send_json_error("malformed_partials");
        }

        $this->add_dynamic_partials(array_keys($partials));

        /**
         * Fires immediately before partials are rendered.
         *
         * Plugins may do things like call wp_enqueue_scripts() and gather a list of the scripts
         * and styles which may get enqueued in the response.
         *
         * @since 4.5.0
         *
         * @param WP_Customize_Selective_Refresh $refresh  Selective refresh component.
         * @param array                          $partials Placements' context data for the partials rendered in the request.
         *                                                 The array is keyed by partial ID, with each item being an array of
         *                                                 the placements' context data.
         */
        do_action("customize_render_partials_before", $this, $partials);

        set_error_handler([$this, "handle_error"], error_reporting());

        $contents = [];

        foreach ($partials as $partial_id => $container_contexts) {
            $this->current_partial_id = $partial_id;

            if (!is_array($container_contexts)) {
                wp_send_json_error("malformed_container_contexts");
            }

            $partial = $this->get_partial($partial_id);

            if (!$partial || !$partial->check_capabilities()) {
                $contents[$partial_id] = null;
                continue;
            }

            $contents[$partial_id] = [];

            // @todo The array should include not only the contents, but also whether the container is included?
            if (empty($container_contexts)) {
                // Since there are no container contexts, render just once.
                $contents[$partial_id][] = $partial->render(null);
            } else {
                foreach ($container_contexts as $container_context) {
                    $contents[$partial_id][] = $partial->render(
                        $container_context
                    );
                }
            }
        }
        $this->current_partial_id = null;

        restore_error_handler();

        /**
         * Fires immediately after partials are rendered.
         *
         * Plugins may do things like call wp_footer() to scrape scripts output and return them
         * via the {@see 'customize_render_partials_response'} filter.
         *
         * @since 4.5.0
         *
         * @param WP_Customize_Selective_Refresh $refresh  Selective refresh component.
         * @param array                          $partials Placements' context data for the partials rendered in the request.
         *                                                 The array is keyed by partial ID, with each item being an array of
         *                                                 the placements' context data.
         */
        do_action("customize_render_partials_after", $this, $partials);

        $response = [
            "contents" => $contents,
        ];

        if (defined("WP_DEBUG_DISPLAY") && WP_DEBUG_DISPLAY) {
            $response["errors"] = $this->triggered_errors;
        }

        $setting_validities = $this->manager->validate_setting_values(
            $this->manager->unsanitized_post_values()
        );
        $exported_setting_validities = array_map(
            [$this->manager, "prepare_setting_validity_for_js"],
            $setting_validities
        );
        $response["setting_validities"] = $exported_setting_validities;

        /**
         * Filters the response from rendering the partials.
         *
         * Plugins may use this filter to inject `$scripts` and `$styles`, which are dependencies
         * for the partials being rendered. The response data will be available to the client via
         * the `render-partials-response` JS event, so the client can then inject the scripts and
         * styles into the DOM if they have not already been enqueued there.
         *
         * If plugins do this, they'll need to take care for any scripts that do `document.write()`
         * and make sure that these are not injected, or else to override the function to no-op,
         * or else the page will be destroyed.
         *
         * Plugins should be aware that `$scripts` and `$styles` may eventually be included by
         * default in the response.
         *
         * @since 4.5.0
         *
         * @param array $response {
         *     Response.
         *
         *     @type array $contents Associative array mapping a partial ID its corresponding array of contents
         *                           for the containers requested.
         *     @type array $errors   List of errors triggered during rendering of partials, if `WP_DEBUG_DISPLAY`
         *                           is enabled.
         * }
         * @param WP_Customize_Selective_Refresh $refresh  Selective refresh component.
         * @param array                          $partials Placements' context data for the partials rendered in the request.
         *                                                 The array is keyed by partial ID, with each item being an array of
         *                                                 the placements' context data.
         */
        $response = apply_filters(
            "customize_render_partials_response",
            $response,
            $this,
            $partials
        );

        wp_send_json_success($response);
    }
}
