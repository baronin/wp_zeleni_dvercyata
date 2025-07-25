<?php
/**
 * Build Network Administration Menu.
 *
 * @package WordPress
 * @subpackage Multisite
 * @since 3.1.0
 */

// Don't load directly.
if (!defined("ABSPATH")) {
    die("-1");
}

/* translators: Network menu item. */
$menu[2] = [
    __("Dashboard"),
    "manage_network",
    "index.php",
    "",
    "menu-top menu-top-first menu-icon-dashboard",
    "menu-dashboard",
    "dashicons-dashboard",
];

$submenu["index.php"][0] = [__("Home"), "read", "index.php"];

if (current_user_can("update_core")) {
    $cap = "update_core";
} elseif (current_user_can("update_plugins")) {
    $cap = "update_plugins";
} elseif (current_user_can("update_themes")) {
    $cap = "update_themes";
} else {
    $cap = "update_languages";
}

$update_data = wp_get_update_data();
if ($update_data["counts"]["total"]) {
    $submenu["index.php"][10] = [
        sprintf(
            /* translators: %s: Number of available updates. */
            __("Updates %s"),
            sprintf(
                '<span class="update-plugins count-%s"><span class="update-count">%s</span></span>',
                $update_data["counts"]["total"],
                number_format_i18n($update_data["counts"]["total"])
            )
        ),
        $cap,
        "update-core.php",
    ];
} else {
    $submenu["index.php"][10] = [__("Updates"), $cap, "update-core.php"];
}

unset($cap);

$submenu["index.php"][15] = [
    __("Upgrade Network"),
    "upgrade_network",
    "upgrade.php",
];

$menu[4] = ["", "read", "separator1", "", "wp-menu-separator"];

/* translators: Sites menu item. */
$menu[5] = [
    __("Sites"),
    "manage_sites",
    "sites.php",
    "",
    "menu-top menu-icon-site",
    "menu-site",
    "dashicons-admin-multisite",
];
$submenu["sites.php"][5] = [__("All Sites"), "manage_sites", "sites.php"];
$submenu["sites.php"][10] = [__("Add Site"), "create_sites", "site-new.php"];

$menu[10] = [
    __("Users"),
    "manage_network_users",
    "users.php",
    "",
    "menu-top menu-icon-users",
    "menu-users",
    "dashicons-admin-users",
];
$submenu["users.php"][5] = [
    __("All Users"),
    "manage_network_users",
    "users.php",
];
$submenu["users.php"][10] = [__("Add User"), "create_users", "user-new.php"];

if (current_user_can("update_themes") && $update_data["counts"]["themes"]) {
    $menu[15] = [
        sprintf(
            /* translators: %s: Number of available theme updates. */
            __("Themes %s"),
            sprintf(
                '<span class="update-plugins count-%s"><span class="theme-count">%s</span></span>',
                $update_data["counts"]["themes"],
                number_format_i18n($update_data["counts"]["themes"])
            )
        ),
        "manage_network_themes",
        "themes.php",
        "",
        "menu-top menu-icon-appearance",
        "menu-appearance",
        "dashicons-admin-appearance",
    ];
} else {
    $menu[15] = [
        __("Themes"),
        "manage_network_themes",
        "themes.php",
        "",
        "menu-top menu-icon-appearance",
        "menu-appearance",
        "dashicons-admin-appearance",
    ];
}
$submenu["themes.php"][5] = [
    __("Installed Themes"),
    "manage_network_themes",
    "themes.php",
];
$submenu["themes.php"][10] = [
    __("Add Theme"),
    "install_themes",
    "theme-install.php",
];
$submenu["themes.php"][15] = [
    __("Theme File Editor"),
    "edit_themes",
    "theme-editor.php",
];

if (current_user_can("update_plugins") && $update_data["counts"]["plugins"]) {
    $menu[20] = [
        sprintf(
            /* translators: %s: Number of available plugin updates. */
            __("Plugins %s"),
            sprintf(
                '<span class="update-plugins count-%s"><span class="plugin-count">%s</span></span>',
                $update_data["counts"]["plugins"],
                number_format_i18n($update_data["counts"]["plugins"])
            )
        ),
        "manage_network_plugins",
        "plugins.php",
        "",
        "menu-top menu-icon-plugins",
        "menu-plugins",
        "dashicons-admin-plugins",
    ];
} else {
    $menu[20] = [
        __("Plugins"),
        "manage_network_plugins",
        "plugins.php",
        "",
        "menu-top menu-icon-plugins",
        "menu-plugins",
        "dashicons-admin-plugins",
    ];
}
$submenu["plugins.php"][5] = [
    __("Installed Plugins"),
    "manage_network_plugins",
    "plugins.php",
];
$submenu["plugins.php"][10] = [
    __("Add Plugin"),
    "install_plugins",
    "plugin-install.php",
];
$submenu["plugins.php"][15] = [
    __("Plugin File Editor"),
    "edit_plugins",
    "plugin-editor.php",
];

$menu[25] = [
    __("Settings"),
    "manage_network_options",
    "settings.php",
    "",
    "menu-top menu-icon-settings",
    "menu-settings",
    "dashicons-admin-settings",
];
if (
    defined("MULTISITE") &&
    defined("WP_ALLOW_MULTISITE") &&
    WP_ALLOW_MULTISITE
) {
    $submenu["settings.php"][5] = [
        __("Network Settings"),
        "manage_network_options",
        "settings.php",
    ];
    $submenu["settings.php"][10] = [
        __("Network Setup"),
        "setup_network",
        "setup.php",
    ];
}
unset($update_data);

$menu[99] = ["", "exist", "separator-last", "", "wp-menu-separator"];

require_once ABSPATH . "wp-admin/includes/menu.php";
