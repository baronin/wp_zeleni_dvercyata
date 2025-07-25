<?php
/**
 * Revisions administration panel
 *
 * Requires wp-admin/includes/revision.php.
 *
 * @package WordPress
 * @subpackage Administration
 * @since 2.6.0
 */

/** WordPress Administration Bootstrap */
require_once __DIR__ . "/admin.php";

require ABSPATH . "wp-admin/includes/revision.php";

/**
 * @global int    $revision Optional. The revision ID.
 * @global string $action   The action to take.
 *                          Accepts 'restore', 'view' or 'edit'.
 * @global int    $from     The revision to compare from.
 * @global int    $to       Optional, required if revision missing. The revision to compare to.
 */

$revision_id = !empty($_REQUEST["revision"])
    ? absint($_REQUEST["revision"])
    : 0;
$action = !empty($_REQUEST["action"])
    ? sanitize_text_field($_REQUEST["action"])
    : "";
$from =
    !empty($_REQUEST["from"]) && is_numeric($_REQUEST["from"])
        ? absint($_REQUEST["from"])
        : null;
$to =
    !empty($_REQUEST["to"]) && is_numeric($_REQUEST["to"])
        ? absint($_REQUEST["to"])
        : null;

if (!$revision_id) {
    $revision_id = $to;
}

$redirect = "edit.php";

switch ($action) {
    case "restore":
        $revision = wp_get_post_revision($revision_id);
        if (!$revision) {
            break;
        }

        if (!current_user_can("edit_post", $revision->post_parent)) {
            break;
        }

        $post = get_post($revision->post_parent);
        if (!$post) {
            break;
        }

        // Don't restore if revisions are disabled and this is not an autosave.
        if (!wp_revisions_enabled($post) && !wp_is_post_autosave($revision)) {
            $redirect = "edit.php?post_type=" . $post->post_type;
            break;
        }

        // Don't restore if the post is locked.
        if (wp_check_post_lock($post->ID)) {
            break;
        }

        check_admin_referer("restore-post_{$revision->ID}");

        /*
         * Ensure the global $post remains the same after revision is restored.
         * Because wp_insert_post() and wp_transition_post_status() are called
         * during the process, plugins can unexpectedly modify $post.
         */
        $backup_global_post = clone $post;

        wp_restore_post_revision($revision->ID);

        // Restore the global $post as it was before.
        $post = $backup_global_post;

        $redirect = add_query_arg(
            [
                "message" => 5,
                "revision" => $revision->ID,
            ],
            get_edit_post_link($post->ID, "url")
        );
        break;
    case "view":
    case "edit":
    default:
        $revision = wp_get_post_revision($revision_id);
        if (!$revision) {
            break;
        }

        $post = get_post($revision->post_parent);
        if (!$post) {
            break;
        }

        if (
            !current_user_can("read_post", $revision->ID) ||
            !current_user_can("edit_post", $revision->post_parent)
        ) {
            break;
        }

        // Bail if revisions are disabled and this is not an autosave.
        if (!wp_revisions_enabled($post) && !wp_is_post_autosave($revision)) {
            $redirect = "edit.php?post_type=" . $post->post_type;
            break;
        }

        $post_edit_link = get_edit_post_link();
        $post_title =
            '<a href="' .
            esc_url($post_edit_link) .
            '">' .
            _draft_or_post_title() .
            "</a>";
        /* translators: %s: Post title. */
        $h1 = sprintf(__("Compare Revisions of &#8220;%s&#8221;"), $post_title);
        $return_to_post =
            '<a href="' .
            esc_url($post_edit_link) .
            '">' .
            __("&larr; Go to editor") .
            "</a>";
        // Used in the HTML title tag.
        $title = __("Revisions");

        $redirect = false;
        break;
}

// Empty post_type means either malformed object found, or no valid parent was found.
if (!$redirect && empty($post->post_type)) {
    $redirect = "edit.php";
}

if (!empty($redirect)) {
    wp_redirect($redirect);
    exit();
}

// This is so that the correct "Edit" menu item is selected.
if (!empty($post->post_type) && "post" !== $post->post_type) {
    $parent_file = "edit.php?post_type=" . $post->post_type;
} else {
    $parent_file = "edit.php";
}
$submenu_file = $parent_file;

wp_enqueue_script("revisions");
wp_localize_script(
    "revisions",
    "_wpRevisionsSettings",
    wp_prepare_revisions_for_js($post, $revision_id, $from)
);

/* Revisions Help Tab */

$revisions_overview =
    "<p>" .
    __("This screen is used for managing your content revisions.") .
    "</p>";
$revisions_overview .=
    "<p>" .
    __(
        "Revisions are saved copies of your post or page, which are periodically created as you update your content. The red text on the left shows the content that was removed. The green text on the right shows the content that was added."
    ) .
    "</p>";
$revisions_overview .=
    "<p>" .
    __("From this screen you can review, compare, and restore revisions:") .
    "</p>";
$revisions_overview .=
    "<ul><li>" .
    __(
        "To navigate between revisions, <strong>drag the slider handle left or right</strong> or <strong>use the Previous or Next buttons</strong>."
    ) .
    "</li>";
$revisions_overview .=
    "<li>" .
    __(
        "Compare two different revisions by <strong>selecting the &#8220;Compare any two revisions&#8221; box</strong> to the side."
    ) .
    "</li>";
$revisions_overview .=
    "<li>" .
    __("To restore a revision, <strong>click Restore This Revision</strong>.") .
    "</li></ul>";

get_current_screen()->add_help_tab([
    "id" => "revisions-overview",
    "title" => __("Overview"),
    "content" => $revisions_overview,
]);

$revisions_sidebar =
    "<p><strong>" . __("For more information:") . "</strong></p>";
$revisions_sidebar .=
    "<p>" .
    __(
        '<a href="https://wordpress.org/documentation/article/revisions/">Revisions Management</a>'
    ) .
    "</p>";
$revisions_sidebar .=
    "<p>" .
    __('<a href="https://wordpress.org/support/forums/">Support forums</a>') .
    "</p>";

get_current_screen()->set_help_sidebar($revisions_sidebar);

require_once ABSPATH . "wp-admin/admin-header.php";
?>

<div class="wrap">
	<h1 class="long-header"><?php echo $h1; ?></h1>
	<?php echo $return_to_post; ?>
</div>
<?php
wp_print_revision_templates();

require_once ABSPATH . "wp-admin/admin-footer.php";

