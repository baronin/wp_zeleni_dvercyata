<?php
/**
 * Manage link administration actions.
 *
 * This page is accessed by the link management pages and handles the forms and
 * Ajax processes for link actions.
 *
 * @package WordPress
 * @subpackage Administration
 */

/** Load WordPress Administration Bootstrap */
require_once __DIR__ . "/admin.php";

$action = !empty($_REQUEST["action"])
    ? sanitize_text_field($_REQUEST["action"])
    : "";
$cat_id = !empty($_REQUEST["cat_id"]) ? absint($_REQUEST["cat_id"]) : 0;
$link_id = !empty($_REQUEST["link_id"]) ? absint($_REQUEST["link_id"]) : 0;

if (!current_user_can("manage_links")) {
    wp_link_manager_disabled_message();
}

if (!empty($_POST["deletebookmarks"])) {
    $action = "deletebookmarks";
}
if (!empty($_POST["move"])) {
    $action = "move";
}
if (!empty($_POST["linkcheck"])) {
    $linkcheck = $_POST["linkcheck"];
}

$this_file = admin_url("link-manager.php");

switch ($action) {
    case "deletebookmarks":
        check_admin_referer("bulk-bookmarks");

        // For each link id (in $linkcheck[]) change category to selected value.
        if (count($linkcheck) === 0) {
            wp_redirect($this_file);
            exit();
        }

        $deleted = 0;
        foreach ($linkcheck as $link_id) {
            $link_id = (int) $link_id;

            if (wp_delete_link($link_id)) {
                ++$deleted;
            }
        }

        wp_redirect("$this_file?deleted=$deleted");
        exit();

    case "move":
        check_admin_referer("bulk-bookmarks");

        // For each link id (in $linkcheck[]) change category to selected value.
        if (count($linkcheck) === 0) {
            wp_redirect($this_file);
            exit();
        }
        $all_links = implode(",", $linkcheck);
        /*
         * Should now have an array of links we can change:
         *     $q = $wpdb->query("update $wpdb->links SET link_category='$category' WHERE link_id IN ($all_links)");
         */

        wp_redirect($this_file);
        exit();

    case "add":
        check_admin_referer("add-bookmark");

        $redir = wp_get_referer();
        if (add_link()) {
            $redir = add_query_arg("added", "true", $redir);
        }

        wp_redirect($redir);
        exit();

    case "save":
        $link_id = (int) $_POST["link_id"];
        check_admin_referer("update-bookmark_" . $link_id);

        edit_link($link_id);

        wp_redirect($this_file);
        exit();

    case "delete":
        $link_id = (int) $_GET["link_id"];
        check_admin_referer("delete-bookmark_" . $link_id);

        wp_delete_link($link_id);

        wp_redirect($this_file);
        exit();

    case "edit":
        wp_enqueue_script("link");
        wp_enqueue_script("xfn");

        if (wp_is_mobile()) {
            wp_enqueue_script("jquery-touch-punch");
        }

        $parent_file = "link-manager.php";
        $submenu_file = "link-manager.php";
        // Used in the HTML title tag.
        $title = __("Edit Link");

        $link_id = (int) $_GET["link_id"];

        $link = get_link_to_edit($link_id);
        if (!$link) {
            wp_die(__("Link not found."));
        }

        require ABSPATH . "wp-admin/edit-link-form.php";
        require_once ABSPATH . "wp-admin/admin-footer.php";
        break;

    default:
        break;
}
