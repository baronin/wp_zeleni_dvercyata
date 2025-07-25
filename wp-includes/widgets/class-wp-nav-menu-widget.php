<?php
/**
 * Widget API: WP_Nav_Menu_Widget class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement the Navigation Menu widget.
 *
 * @since 3.0.0
 *
 * @see WP_Widget
 */
class WP_Nav_Menu_Widget extends WP_Widget
{
    /**
     * Sets up a new Navigation Menu widget instance.
     *
     * @since 3.0.0
     */
    public function __construct()
    {
        $widget_ops = [
            "description" => __("Add a navigation menu to your sidebar."),
            "customize_selective_refresh" => true,
            "show_instance_in_rest" => true,
        ];
        parent::__construct("nav_menu", __("Navigation Menu"), $widget_ops);
    }

    /**
     * Outputs the content for the current Navigation Menu widget instance.
     *
     * @since 3.0.0
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Navigation Menu widget instance.
     */
    public function widget($args, $instance)
    {
        // Get menu.
        $nav_menu = !empty($instance["nav_menu"])
            ? wp_get_nav_menu_object($instance["nav_menu"])
            : false;

        if (!$nav_menu) {
            return;
        }

        $default_title = __("Menu");
        $title = !empty($instance["title"]) ? $instance["title"] : "";

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters(
            "widget_title",
            $title,
            $instance,
            $this->id_base
        );

        echo $args["before_widget"];

        if ($title) {
            echo $args["before_title"] . $title . $args["after_title"];
        }

        $format = current_theme_supports("html5", "navigation-widgets")
            ? "html5"
            : "xhtml";

        /**
         * Filters the HTML format of widgets with navigation links.
         *
         * @since 5.5.0
         *
         * @param string $format The type of markup to use in widgets with navigation links.
         *                       Accepts 'html5', 'xhtml'.
         */
        $format = apply_filters("navigation_widgets_format", $format);

        if ("html5" === $format) {
            // The title may be filtered: Strip out HTML and make sure the aria-label is never empty.
            $title = trim(strip_tags($title));
            $aria_label = $title ? $title : $default_title;

            $nav_menu_args = [
                "fallback_cb" => "",
                "menu" => $nav_menu,
                "container" => "nav",
                "container_aria_label" => $aria_label,
                "items_wrap" => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            ];
        } else {
            $nav_menu_args = [
                "fallback_cb" => "",
                "menu" => $nav_menu,
            ];
        }

        /**
         * Filters the arguments for the Navigation Menu widget.
         *
         * @since 4.2.0
         * @since 4.4.0 Added the `$instance` parameter.
         *
         * @param array   $nav_menu_args {
         *     An array of arguments passed to wp_nav_menu() to retrieve a navigation menu.
         *
         *     @type callable|bool $fallback_cb Callback to fire if the menu doesn't exist. Default empty.
         *     @type mixed         $menu        Menu ID, slug, or name.
         * }
         * @param WP_Term $nav_menu      Nav menu object for the current menu.
         * @param array   $args          Display arguments for the current widget.
         * @param array   $instance      Array of settings for the current widget.
         */
        wp_nav_menu(
            apply_filters(
                "widget_nav_menu_args",
                $nav_menu_args,
                $nav_menu,
                $args,
                $instance
            )
        );

        echo $args["after_widget"];
    }

    /**
     * Handles updating settings for the current Navigation Menu widget instance.
     *
     * @since 3.0.0
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = [];
        if (!empty($new_instance["title"])) {
            $instance["title"] = sanitize_text_field($new_instance["title"]);
        }
        if (!empty($new_instance["nav_menu"])) {
            $instance["nav_menu"] = (int) $new_instance["nav_menu"];
        }
        return $instance;
    }

    /**
     * Outputs the settings form for the Navigation Menu widget.
     *
     * @since 3.0.0
     *
     * @global WP_Customize_Manager $wp_customize
     *
     * @param array $instance Current settings.
     */
    public function form($instance)
    {
        global $wp_customize;
        $title = isset($instance["title"]) ? $instance["title"] : "";
        $nav_menu = isset($instance["nav_menu"]) ? $instance["nav_menu"] : "";

        // Get menus.
        $menus = wp_get_nav_menus();

        $empty_menus_style = "";
        $not_empty_menus_style = "";
        if (empty($menus)) {
            $empty_menus_style = ' style="display:none" ';
        } else {
            $not_empty_menus_style = ' style="display:none" ';
        }

        $nav_menu_style = "";
        if (!$nav_menu) {
            $nav_menu_style = "display: none;";
        }
        // If no menus exists, direct the user to go and create some.
        ?>
		<p class="nav-menu-widget-no-menus-message" <?php echo $not_empty_menus_style; ?>>
			<?php
   if ($wp_customize instanceof WP_Customize_Manager) {
       $url = 'javascript: wp.customize.panel( "nav_menus" ).focus();';
   } else {
       $url = admin_url("nav-menus.php");
   }

   printf(
       /* translators: %s: URL to create a new menu. */
       __('No menus have been created yet. <a href="%s">Create some</a>.'),
       // The URL can be a `javascript:` link, so esc_attr() is used here instead of esc_url().
       esc_attr($url)
   );
   ?>
		</p>
		<div class="nav-menu-widget-form-controls" <?php echo $empty_menus_style; ?>>
			<p>
				<label for="<?php echo $this->get_field_id(
        "title"
    ); ?>"><?php _e("Title:"); ?></label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id(
        "title"
    ); ?>" name="<?php echo $this->get_field_name("title"); ?>" value="<?php echo esc_attr($title); ?>" />
			</p>
			<p>
				<label for="<?php echo $this->get_field_id(
        "nav_menu"
    ); ?>"><?php _e("Select Menu:"); ?></label>
				<select id="<?php echo $this->get_field_id(
        "nav_menu"
    ); ?>" name="<?php echo $this->get_field_name("nav_menu"); ?>">
					<option value="0"><?php _e("&mdash; Select &mdash;"); ?></option>
					<?php foreach ($menus as $menu): ?>
						<option value="<?php echo esc_attr($menu->term_id); ?>" <?php selected(
    $nav_menu,
    $menu->term_id
); ?>>
							<?php echo esc_html($menu->name); ?>
						</option>
					<?php endforeach; ?>
				</select>
			</p>
			<?php if ($wp_customize instanceof WP_Customize_Manager): ?>
				<p class="edit-selected-nav-menu" style="<?php echo $nav_menu_style; ?>">
					<button type="button" class="button"><?php _e("Edit Menu"); ?></button>
				</p>
			<?php endif; ?>
		</div>
		<?php
    }
}
