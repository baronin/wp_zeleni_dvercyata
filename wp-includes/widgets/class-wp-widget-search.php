<?php
/**
 * Widget API: WP_Widget_Search class
 *
 * @package WordPress
 * @subpackage Widgets
 * @since 4.4.0
 */

/**
 * Core class used to implement a Search widget.
 *
 * @since 2.8.0
 *
 * @see WP_Widget
 */
class WP_Widget_Search extends WP_Widget
{
    /**
     * Sets up a new Search widget instance.
     *
     * @since 2.8.0
     */
    public function __construct()
    {
        $widget_ops = [
            "classname" => "widget_search",
            "description" => __("A search form for your site."),
            "customize_selective_refresh" => true,
            "show_instance_in_rest" => true,
        ];
        parent::__construct(
            "search",
            _x("Search", "Search widget"),
            $widget_ops
        );
    }

    /**
     * Outputs the content for the current Search widget instance.
     *
     * @since 2.8.0
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Search widget instance.
     */
    public function widget($args, $instance)
    {
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

        // Use active theme search form if it exists.
        get_search_form();

        echo $args["after_widget"];
    }

    /**
     * Outputs the settings form for the Search widget.
     *
     * @since 2.8.0
     *
     * @param array $instance Current settings.
     */
    public function form($instance)
    {
        $instance = wp_parse_args((array) $instance, ["title" => ""]);
        $title = $instance["title"];
        ?>
		<p>
			<label for="<?php echo $this->get_field_id(
       "title"
   ); ?>"><?php _e("Title:"); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id(
       "title"
   ); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<?php
    }

    /**
     * Handles updating settings for the current Search widget instance.
     *
     * @since 2.8.0
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $new_instance = wp_parse_args((array) $new_instance, ["title" => ""]);
        $instance["title"] = sanitize_text_field($new_instance["title"]);
        return $instance;
    }
}
