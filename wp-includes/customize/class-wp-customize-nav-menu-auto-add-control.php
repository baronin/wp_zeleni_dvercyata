<?php
/**
 * Customize API: WP_Customize_Nav_Menu_Auto_Add_Control class
 *
 * @package WordPress
 * @subpackage Customize
 * @since 4.4.0
 */

/**
 * Customize control to represent the auto_add field for a given menu.
 *
 * @since 4.3.0
 *
 * @see WP_Customize_Control
 */
class WP_Customize_Nav_Menu_Auto_Add_Control extends WP_Customize_Control
{
    /**
     * Type of control, used by JS.
     *
     * @since 4.3.0
     * @var string
     */
    public $type = "nav_menu_auto_add";

    /**
     * No-op since we're using JS template.
     *
     * @since 4.3.0
     */
    protected function render_content() {}

    /**
     * Render the Underscore template for this control.
     *
     * @since 4.3.0
     */
    protected function content_template()
    {
        ?>
		<# var elementId = _.uniqueId( 'customize-nav-menu-auto-add-control-' ); #>
		<span class="customize-control-title"><?php _e("Menu Options"); ?></span>
		<span class="customize-inside-control-row">
			<input id="{{ elementId }}" type="checkbox" class="auto_add" />
			<label for="{{ elementId }}">
				<?php _e("Automatically add new top-level pages to this menu"); ?>
			</label>
		</span>
		<?php
    }
}
