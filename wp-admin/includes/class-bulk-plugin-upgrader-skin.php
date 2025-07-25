<?php
/**
 * Upgrader API: Bulk_Plugin_Upgrader_Skin class
 *
 * @package WordPress
 * @subpackage Upgrader
 * @since 4.6.0
 */

/**
 * Bulk Plugin Upgrader Skin for WordPress Plugin Upgrades.
 *
 * @since 3.0.0
 * @since 4.6.0 Moved to its own file from wp-admin/includes/class-wp-upgrader-skins.php.
 *
 * @see Bulk_Upgrader_Skin
 */
class Bulk_Plugin_Upgrader_Skin extends Bulk_Upgrader_Skin
{
    /**
     * Plugin info.
     *
     * The Plugin_Upgrader::bulk_upgrade() method will fill this in
     * with info retrieved from the get_plugin_data() function.
     *
     * @since 3.0.0
     * @var array Plugin data. Values will be empty if not supplied by the plugin.
     */
    public $plugin_info = [];

    /**
     * Sets up the strings used in the update process.
     *
     * @since 3.0.0
     */
    public function add_strings()
    {
        parent::add_strings();
        /* translators: 1: Plugin name, 2: Number of the plugin, 3: Total number of plugins being updated. */
        $this->upgrader->strings["skin_before_update_header"] = __(
            'Updating Plugin %1$s (%2$d/%3$d)'
        );
    }

    /**
     * Performs an action before a bulk plugin update.
     *
     * @since 3.0.0
     *
     * @param string $title
     */
    public function before($title = "")
    {
        parent::before($this->plugin_info["Title"]);
    }

    /**
     * Performs an action following a bulk plugin update.
     *
     * @since 3.0.0
     *
     * @param string $title
     */
    public function after($title = "")
    {
        parent::after($this->plugin_info["Title"]);
        $this->decrement_update_count("plugin");
    }

    /**
     * Displays the footer following the bulk update process.
     *
     * @since 3.0.0
     */
    public function bulk_footer()
    {
        parent::bulk_footer();

        $update_actions = [
            "plugins_page" => sprintf(
                '<a href="%s" target="_parent">%s</a>',
                self_admin_url("plugins.php"),
                __("Go to Plugins page")
            ),
            "updates_page" => sprintf(
                '<a href="%s" target="_parent">%s</a>',
                self_admin_url("update-core.php"),
                __("Go to WordPress Updates page")
            ),
        ];

        if (!current_user_can("activate_plugins")) {
            unset($update_actions["plugins_page"]);
        }

        /**
         * Filters the list of action links available following bulk plugin updates.
         *
         * @since 3.0.0
         *
         * @param string[] $update_actions Array of plugin action links.
         * @param array    $plugin_info    Array of information for the last-updated plugin.
         */
        $update_actions = apply_filters(
            "update_bulk_plugins_complete_actions",
            $update_actions,
            $this->plugin_info
        );

        if (!empty($update_actions)) {
            $this->feedback(implode(" | ", (array) $update_actions));
        }
    }
}
