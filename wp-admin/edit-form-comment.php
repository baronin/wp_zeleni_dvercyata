<?php
/**
 * Edit comment form for inclusion in another file.
 *
 * @package WordPress
 * @subpackage Administration
 */

// Don't load directly.
if (!defined("ABSPATH")) {
    die("-1");
}

/**
 * @global WP_Comment $comment Global comment object.
 */
global $comment;
?>
<form name="post" action="comment.php" method="post" id="post">
<?php wp_nonce_field("update-comment_" . $comment->comment_ID); ?>
<div class="wrap">
<h1><?php _e("Edit Comment"); ?></h1>

<div id="poststuff">
<input type="hidden" name="action" value="editedcomment" />
<input type="hidden" name="comment_ID" value="<?php echo esc_attr(
    $comment->comment_ID
); ?>" />
<input type="hidden" name="comment_post_ID" value="<?php echo esc_attr(
    $comment->comment_post_ID
); ?>" />

<div id="post-body" class="metabox-holder columns-2">
<div id="post-body-content" class="edit-form-section edit-comment-section">
<?php if (
    "approved" === wp_get_comment_status($comment) &&
    $comment->comment_post_ID > 0
):
    $comment_link = get_comment_link($comment); ?>
<div class="inside">
	<div id="comment-link-box">
		<strong><?php _ex("Permalink:", "comment"); ?></strong>
		<span id="sample-permalink">
			<a href="<?php echo esc_url($comment_link); ?>">
				<?php echo esc_html($comment_link); ?>
			</a>
		</span>
	</div>
</div>
<?php
endif; ?>
<div id="namediv" class="stuffbox">
<div class="inside">
<h2 class="edit-comment-author"><?php _e("Author"); ?></h2>
<fieldset>
<legend class="screen-reader-text">
	<?php /* translators: Hidden accessibility text. */
 _e("Comment Author"); ?>
</legend>
<table class="form-table editcomment" role="presentation">
<tbody>
<tr>
	<td class="first"><label for="name"><?php _e("Name"); ?></label></td>
	<td><input type="text" name="newcomment_author" size="30" value="<?php echo esc_attr(
     $comment->comment_author
 ); ?>" id="name" /></td>
</tr>
<tr>
	<td class="first"><label for="email"><?php _e("Email"); ?></label></td>
	<td>
		<input type="text" name="newcomment_author_email" size="30" value="<?php echo esc_attr(
      $comment->comment_author_email
  ); ?>" id="email" />
	</td>
</tr>
<tr>
	<td class="first"><label for="newcomment_author_url"><?php _e(
     "URL"
 ); ?></label></td>
	<td>
		<input type="text" id="newcomment_author_url" name="newcomment_author_url" size="30" class="code" value="<?php echo esc_url(
      $comment->comment_author_url
  ); ?>" />
	</td>
</tr>
</tbody>
</table>
</fieldset>
</div>
</div>

<div id="postdiv" class="postarea">
<label for="content" class="screen-reader-text">
	<?php /* translators: Hidden accessibility text. */
 _e("Comment"); ?>
</label>
<?php
$quicktags_settings = [
    "buttons" => "strong,em,link,block,del,ins,img,ul,ol,li,code,close",
];
wp_editor($comment->comment_content, "content", [
    "media_buttons" => false,
    "tinymce" => false,
    "quicktags" => $quicktags_settings,
]);
wp_nonce_field("closedpostboxes", "closedpostboxesnonce", false);
?>
</div>
</div><!-- /post-body-content -->

<div id="postbox-container-1" class="postbox-container">
<div id="submitdiv" class="stuffbox" >
<h2><?php _e("Save"); ?></h2>
<div class="inside">
<div class="submitbox" id="submitcomment">
<div id="minor-publishing">

<div id="misc-publishing-actions">

<div class="misc-pub-section misc-pub-comment-status" id="comment-status">
<?php _e("Status:"); ?> <span id="comment-status-display">
<?php switch ($comment->comment_approved) {
    case "1":
        _e("Approved");
        break;
    case "0":
        _e("Pending");
        break;
    case "spam":
        _e("Spam");
        break;
} ?>
</span>

<fieldset id="comment-status-radio">
<legend class="screen-reader-text">
	<?php /* translators: Hidden accessibility text. */
 _e("Comment status"); ?>
</legend>
<label><input type="radio"<?php checked(
    $comment->comment_approved,
    "1"
); ?> name="comment_status" value="1" /><?php _ex(
     "Approved",
     "comment status"
 ); ?></label><br />
<label><input type="radio"<?php checked(
    $comment->comment_approved,
    "0"
); ?> name="comment_status" value="0" /><?php _ex(
     "Pending",
     "comment status"
 ); ?></label><br />
<label><input type="radio"<?php checked(
    $comment->comment_approved,
    "spam"
); ?> name="comment_status" value="spam" /><?php _ex(
     "Spam",
     "comment status"
 ); ?></label>
</fieldset>
</div><!-- .misc-pub-section -->

<div class="misc-pub-section curtime misc-pub-curtime">
<?php $submitted = sprintf(
    /* translators: 1: Comment date, 2: Comment time. */
    __('%1$s at %2$s'),
    /* translators: Publish box date format, see https://www.php.net/manual/datetime.format.php */
    date_i18n(
        _x("M j, Y", "publish box date format"),
        strtotime($comment->comment_date)
    ),
    /* translators: Publish box time format, see https://www.php.net/manual/datetime.format.php */
    date_i18n(
        _x("H:i", "publish box time format"),
        strtotime($comment->comment_date)
    )
); ?>
<span id="timestamp">
<?php /* translators: %s: Comment date. */
printf(__("Submitted on: %s"), "<b>" . $submitted . "</b>"); ?>
</span>
<a href="#edit_timestamp" class="edit-timestamp hide-if-no-js"><span aria-hidden="true"><?php _e(
    "Edit"
); ?></span> <span class="screen-reader-text">
	<?php /* translators: Hidden accessibility text. */
 _e("Edit date and time"); ?>
</span></a>
<fieldset id='timestampdiv' class='hide-if-js'>
<legend class="screen-reader-text">
	<?php /* translators: Hidden accessibility text. */
 _e("Date and time"); ?>
</legend>
<?php
/**
 * @global string $action
 */
global $action;

touch_time("editcomment" === $action, 0);
?>
</fieldset>
</div>

<?php
$post_id = $comment->comment_post_ID;
if (current_user_can("edit_post", $post_id)) {
    $post_link = "<a href='" . esc_url(get_edit_post_link($post_id)) . "'>";
    $post_link .= esc_html(get_the_title($post_id)) . "</a>";
} else {
    $post_link = esc_html(get_the_title($post_id));
}
?>

<div class="misc-pub-section misc-pub-response-to">
	<?php printf(
     /* translators: %s: Post link. */
     __("In response to: %s"),
     "<b>" . $post_link . "</b>"
 ); ?>
</div>

<?php if ($comment->comment_parent):
    $parent = get_comment($comment->comment_parent);
    if ($parent):

        $parent_link = esc_url(get_comment_link($parent));
        $name = get_comment_author($parent);
        ?>
	<div class="misc-pub-section misc-pub-reply-to">
		<?php printf(
      /* translators: %s: Comment link. */
      __("In reply to: %s"),
      '<b><a href="' . $parent_link . '">' . $name . "</a></b>"
  ); ?>
	</div>
		<?php
    endif;
endif; ?>

<?php /**
 * Filters miscellaneous actions for the edit comment form sidebar.
 *
 * @since 4.3.0
 *
 * @param string     $html    Output HTML to display miscellaneous action.
 * @param WP_Comment $comment Current comment object.
 */
echo apply_filters("edit_comment_misc_actions", "", $comment); ?>

</div> <!-- misc actions -->
<div class="clear"></div>
</div>

<div id="major-publishing-actions">
<div id="delete-action">
<?php echo "<a class='submitdelete deletion' href='" .
    wp_nonce_url(
        "comment.php?action=" .
            (!EMPTY_TRASH_DAYS ? "deletecomment" : "trashcomment") .
            "&amp;c=$comment->comment_ID&amp;_wp_original_http_referer=" .
            urlencode(wp_get_referer()),
        "delete-comment_" . $comment->comment_ID
    ) .
    "'>" .
    (!EMPTY_TRASH_DAYS ? __("Delete Permanently") : __("Move to Trash")) .
    "</a>\n"; ?>
</div>
<div id="publishing-action">
<?php submit_button(__("Update"), "primary large", "save", false); ?>
</div>
<div class="clear"></div>
</div>
</div>
</div>
</div><!-- /submitdiv -->
</div>

<div id="postbox-container-2" class="postbox-container">
<?php
/** This action is documented in wp-admin/includes/meta-boxes.php */
do_action("add_meta_boxes", "comment", $comment);

/**
 * Fires when comment-specific meta boxes are added.
 *
 * @since 3.0.0
 *
 * @param WP_Comment $comment Comment object.
 */
do_action("add_meta_boxes_comment", $comment);

do_meta_boxes(null, "normal", $comment);

$referer = wp_get_referer();
?>
</div>

<input type="hidden" name="c" value="<?php echo esc_attr(
    $comment->comment_ID
); ?>" />
<input type="hidden" name="p" value="<?php echo esc_attr(
    $comment->comment_post_ID
); ?>" />
<input name="referredby" type="hidden" id="referredby" value="<?php echo $referer
    ? esc_url($referer)
    : ""; ?>" />
<?php wp_original_referer_field(true, "previous"); ?>
<input type="hidden" name="noredir" value="1" />

</div><!-- /post-body -->
</div>
</div>
</form>

<?php if (!wp_is_mobile()): ?>
<script type="text/javascript">
try{document.post.name.focus();}catch(e){}
</script>
	<?php endif;
