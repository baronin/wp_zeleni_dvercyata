<?php
/**
 * Update/Install Plugin/Theme network administration panel.
 *
 * @package WordPress
 * @subpackage Multisite
 * @since 3.1.0
 */

if (
    isset($_GET["action"]) &&
    in_array(
        $_GET["action"],
        ["update-selected", "activate-plugin", "update-selected-themes"],
        true
    )
) {
    define("IFRAME_REQUEST", true);
}

/** Load WordPress Administration Bootstrap */
require_once __DIR__ . "/admin.php";

require ABSPATH . "wp-admin/update.php";
