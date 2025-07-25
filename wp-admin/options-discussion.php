<?php
/**
 * Discussion settings administration panel.
 *
 * @package WordPress
 * @subpackage Administration
 */
/** WordPress Administration Bootstrap */
require_once __DIR__ . "/admin.php";

if (!current_user_can("manage_options")) {
    wp_die(__("Sorry, you are not allowed to manage options for this site."));
}

// Used in the HTML title tag.
$title = __("Discussion Settings");
$parent_file = "options-general.php";

add_action("admin_print_footer_scripts", "options_discussion_add_js");

get_current_screen()->add_help_tab([
    "id" => "overview",
    "title" => __("Overview"),
    "content" =>
        "<p>" .
        __(
            "This screen provides many options for controlling the management and display of comments and links to your posts/pages. So many, in fact, they will not all fit here! :) Use the documentation links to get information on what each discussion setting does."
        ) .
        "</p>" .
        "<p>" .
        __(
            "You must click the Save Changes button at the bottom of the screen for new settings to take effect."
        ) .
        "</p>",
]);

get_current_screen()->set_help_sidebar(
    "<p><strong>" .
        __("For more information:") .
        "</strong></p>" .
        "<p>" .
        __(
            '<a href="https://wordpress.org/documentation/article/settings-discussion-screen/">Documentation on Discussion Settings</a>'
        ) .
        "</p>" .
        "<p>" .
        __(
            '<a href="https://wordpress.org/support/forums/">Support forums</a>'
        ) .
        "</p>"
);

require_once ABSPATH . "wp-admin/admin-header.php";
?>

<div class="wrap">
<h1><?php echo esc_html($title); ?></h1>

<form method="post" action="options.php">
<?php settings_fields("discussion"); ?>

<table class="form-table indent-children" role="presentation">
<tr>
<th scope="row"><?php _e("Default post settings"); ?></th>
<td><fieldset><legend class="screen-reader-text"><span>
	<?php /* translators: Hidden accessibility text. */
 _e("Default post settings"); ?>
</span></legend>
<label for="default_pingback_flag">
<input name="default_pingback_flag" type="checkbox" id="default_pingback_flag" value="1" <?php checked(
    "1",
    get_option("default_pingback_flag")
); ?> />
<?php _e("Attempt to notify any blogs linked to from the post"); ?></label>
<br />
<label for="default_ping_status">
<input name="default_ping_status" type="checkbox" id="default_ping_status" value="open" <?php checked(
    "open",
    get_option("default_ping_status")
); ?> />
<?php _e(
    "Allow link notifications from other blogs (pingbacks and trackbacks) on new posts"
); ?></label>
<br />
<label for="default_comment_status">
<input name="default_comment_status" type="checkbox" id="default_comment_status" value="open" <?php checked(
    "open",
    get_option("default_comment_status")
); ?> />
<?php _e("Allow people to submit comments on new posts"); ?></label>
<br />
<p class="description"><?php _e(
    "Individual posts may override these settings. Changes here will only be applied to new posts."
); ?></p>
</fieldset></td>
</tr>
<tr>
<th scope="row"><?php _e("Other comment settings"); ?></th>
<td><fieldset><legend class="screen-reader-text"><span>
	<?php /* translators: Hidden accessibility text. */
 _e("Other comment settings"); ?>
</span></legend>
<label for="require_name_email"><input type="checkbox" name="require_name_email" id="require_name_email" value="1" <?php checked(
    "1",
    get_option("require_name_email")
); ?> /> <?php _e("Comment author must fill out name and email"); ?></label>
<br />
<label for="comment_registration">
<input name="comment_registration" type="checkbox" id="comment_registration" value="1" <?php checked(
    "1",
    get_option("comment_registration")
); ?> />
<?php _e("Users must be registered and logged in to comment"); ?>
<?php if (!get_option("users_can_register") && is_multisite()) {
    echo " " .
        __(
            "(Signup has been disabled. Only members of this site can comment.)"
        );
} ?>
</label>
<br />
<input name="close_comments_for_old_posts" type="checkbox" id="close_comments_for_old_posts" value="1" <?php checked(
    "1",
    get_option("close_comments_for_old_posts")
); ?> /> <label for="close_comments_for_old_posts"><?php _e(
     "Automatically close comments on old posts"
 ); ?></label>
<ul>
	<li>
		<label for="close_comments_days_old"><?php _e(
      "Close comments when post is how many days old"
  ); ?></label>
		<input name="close_comments_days_old" type="number" step="1" min="0" id="close_comments_days_old" value="<?php echo esc_attr(
      get_option("close_comments_days_old")
  ); ?>" class="small-text" />
	</li>
</ul>

<input name="show_comments_cookies_opt_in" type="checkbox" id="show_comments_cookies_opt_in" value="1" <?php checked(
    "1",
    get_option("show_comments_cookies_opt_in")
); ?> />
<label for="show_comments_cookies_opt_in"><?php _e(
    "Show comments cookies opt-in checkbox, allowing comment author cookies to be set"
); ?></label>
<br />
<input name="thread_comments" type="checkbox" id="thread_comments" value="1" <?php checked(
    "1",
    get_option("thread_comments")
); ?> />
<label for="thread_comments"><?php _e(
    "Enable threaded (nested) comments"
); ?></label>

<?php
/**
 * Filters the maximum depth of threaded/nested comments.
 *
 * @since 2.7.0
 *
 * @param int $max_depth The maximum depth of threaded comments. Default 10.
 */ $maxdeep = (int) apply_filters("thread_comments_depth_max", 10);
$thread_comments_depth =
    '<select name="thread_comments_depth" id="thread_comments_depth">';
for ($i = 2; $i <= $maxdeep; $i++) {
    $thread_comments_depth .= "<option value='" . esc_attr($i) . "'";
    if ((int) get_option("thread_comments_depth") === $i) {
        $thread_comments_depth .= " selected='selected'";
    }
    $thread_comments_depth .= ">$i</option>";
}
$thread_comments_depth .= "</select>";
?>
<ul>
	<li>
		<label for="thread_comments_depth"><?php _e(
      "Number of levels for threaded (nested) comments"
  ); ?></label>
		<?php echo $thread_comments_depth; ?>
	</li>
</ul>
</fieldset></td>
</tr>

<tr>
<th scope="row"><?php _e("Comment Pagination"); ?></th>
<td><fieldset><legend class="screen-reader-text"><span>
	 /* translators: Hidden accessibility text. */<?php

_e("Comment Pagination"); ?>
</span></legend>
<input name="page_comments" type="checkbox" id="page_comments" value="1" <?php checked(
    "1",
    get_option("page_comments")
); ?> />
<label for="page_comments"><?php _e("Break comments into pages"); ?></label>
<ul>
	<li>
		<label for="comments_per_page"><?php _e(
      "Top level comments per page"
  ); ?></label>
		<input name="comments_per_page" type="number" step="1" min="0" id="comments_per_page" value="<?php echo esc_attr(
      get_option("comments_per_page")
  ); ?>" class="small-text" />
	</li>
	<li>
		<label for="default_comments_page"><?php _e(
      "Comments page to display by default"
  ); ?></label>
		<select name="default_comments_page" id="default_comments_page">
			<option value="newest" <?php selected(
       "newest",
       get_option("default_comments_page")
   ); ?>><?php _e("last page"); ?></option>
			<option value="oldest" <?php selected(
       "oldest",
       get_option("default_comments_page")
   ); ?>><?php _e("first page"); ?></option>
		</select>
	</li>
	<li>
		<label for="comment_order"><?php _e(
      "Comments to display at the top of each page"
  ); ?></label>
		<select name="comment_order" id="comment_order">
			<option value="asc" <?php selected(
       "asc",
       get_option("comment_order")
   ); ?>><?php _e("older"); ?></option>
			<option value="desc" <?php selected(
       "desc",
       get_option("comment_order")
   ); ?>><?php _e("newer"); ?></option>
		</select>
	</li>
</ul>
</fieldset></td>
</tr>
<tr>
<th scope="row"><?php _e("Email me whenever"); ?></th>
<td><fieldset><legend class="screen-reader-text"><span>
	 /* translators: Hidden accessibility text. */<?php

_e("Email me whenever"); ?>
</span></legend>
<label for="comments_notify">
<input name="comments_notify" type="checkbox" id="comments_notify" value="1" <?php checked(
    "1",
    get_option("comments_notify")
); ?> />
<?php _e("Anyone posts a comment"); ?> </label>
<br />
<label for="moderation_notify">
<input name="moderation_notify" type="checkbox" id="moderation_notify" value="1" <?php checked(
    "1",
    get_option("moderation_notify")
); ?> />
<?php _e("A comment is held for moderation"); ?> </label>
</fieldset></td>
</tr>
<tr>
<th scope="row"><?php _e("Before a comment appears"); ?></th>
<td><fieldset><legend class="screen-reader-text"><span>
	 /* translators: Hidden accessibility text. */<?php

_e("Before a comment appears"); ?>
</span></legend>
<label for="comment_moderation">
<input name="comment_moderation" type="checkbox" id="comment_moderation" value="1" <?php checked(
    "1",
    get_option("comment_moderation")
); ?> />
<?php _e("Comment must be manually approved"); ?> </label>
<br />
<label for="comment_previously_approved"><input type="checkbox" name="comment_previously_approved" id="comment_previously_approved" value="1" <?php checked(
    "1",
    get_option("comment_previously_approved")
); ?> /> <?php _e(
     "Comment author must have a previously approved comment"
 ); ?></label>
</fieldset></td>
</tr>
<tr>
<th scope="row"><?php _e("Comment Moderation"); ?></th>
<td><fieldset><legend class="screen-reader-text"><span>
	 /* translators: Hidden accessibility text. */<?php

_e("Comment Moderation"); ?>
</span></legend>
<p><label for="comment_max_links">
<?php printf /* translators: %s: Number of links. */(
    __(
        "Hold a comment in the queue if it contains %s or more links. (A common characteristic of comment spam is a large number of hyperlinks.)"
    ),
    '<input name="comment_max_links" type="number" step="1" min="0" id="comment_max_links" value="' .
        esc_attr(get_option("comment_max_links")) .
        '" class="small-text" />'
); ?>
</label></p>

<p><label for="moderation_keys"><?php _e(
    'When a comment contains any of these words in its content, author name, URL, email, IP address, or browser&#8217;s user agent string, it will be held in the <a href="edit-comments.php?comment_status=moderated">moderation queue</a>. One word or IP address per line. It will match inside words, so &#8220;press&#8221; will match &#8220;WordPress&#8221;.'
); ?></label></p>
<p>
<textarea name="moderation_keys" rows="10" cols="50" id="moderation_keys" class="large-text code"><?php echo esc_textarea(
    get_option("moderation_keys")
); ?></textarea>
</p>
</fieldset></td>
</tr>
<tr>
<th scope="row"><?php _e("Disallowed Comment Keys"); ?></th>
<td><fieldset><legend class="screen-reader-text"><span>
	 /* translators: Hidden accessibility text. */<?php

_e("Disallowed Comment Keys"); ?>
</span></legend>
<p><label for="disallowed_keys"><?php _e(
    "When a comment contains any of these words in its content, author name, URL, email, IP address, or browser&#8217;s user agent string, it will be put in the Trash. One word or IP address per line. It will match inside words, so &#8220;press&#8221; will match &#8220;WordPress&#8221;."
); ?></label></p>
<p>
<textarea name="disallowed_keys" rows="10" cols="50" id="disallowed_keys" class="large-text code"><?php echo esc_textarea(
    get_option("disallowed_keys")
); ?></textarea>
</p>
</fieldset></td>
</tr>
<?php do_settings_fields("discussion", "default"); ?>
</table>

<h2 class="title"><?php _e("Avatars"); ?></h2>

<p><?php _e(
    "An avatar is an image that can be associated with a user across multiple websites. In this area, you can choose to display avatars of users who interact with the site."
); ?></p>

<?php // The above would be a good place to link to the documentation on the Gravatar functions, for putting it in themes. Anything like that?


$show_avatars = get_option("show_avatars");
$show_avatars_class = "";
if (!$show_avatars) {
    $show_avatars_class = " hide-if-js";
}
?>

<table class="form-table" role="presentation">
<tr>
<th scope="row"><?php _e("Avatar Display"); ?></th>
<td>
	<label for="show_avatars">
		<input type="checkbox" id="show_avatars" name="show_avatars" value="1" <?php checked(
      $show_avatars,
      1
  ); ?> />
		<?php _e("Show Avatars"); ?>
	</label>
</td>
</tr>
<tr class="avatar-settings<?php echo $show_avatars_class; ?>">
<th scope="row"><?php _e("Maximum Rating"); ?></th>
<td><fieldset><legend class="screen-reader-text"><span>
	 /* translators: Hidden accessibility text. */<?php

_e("Maximum Rating"); ?>
</span></legend>

<?php
$ratings = [
    /* translators: Content suitability rating: https://en.wikipedia.org/wiki/Motion_Picture_Association_of_America_film_rating_system */ "G" => __(
        "G &#8212; Suitable for all audiences"
    ) /* translators: Content suitability rating: https://en.wikipedia.org/wiki/Motion_Picture_Association_of_America_film_rating_system */,
    "PG" => __(
        "PG &#8212; Possibly offensive, usually for audiences 13 and above"
    ) /* translators: Content suitability rating: https://en.wikipedia.org/wiki/Motion_Picture_Association_of_America_film_rating_system */,
    "R" => __(
        "R &#8212; Intended for adult audiences above 17"
    ) /* translators: Content suitability rating: https://en.wikipedia.org/wiki/Motion_Picture_Association_of_America_film_rating_system */,
    "X" => __("X &#8212; Even more mature than above"),
];
foreach ($ratings as $key => $rating):
    $selected = get_option("avatar_rating") === $key ? 'checked="checked"' : "";
    echo "\n\t<label><input type='radio' name='avatar_rating' value='" .
        esc_attr($key) .
        "' $selected/> $rating</label><br />";
endforeach;
?>

</fieldset></td>
</tr>
<tr class="avatar-settings<?php echo $show_avatars_class; ?>">
<th scope="row"><?php _e("Default Avatar"); ?></th>
<td class="defaultavatarpicker"><fieldset><legend class="screen-reader-text"><span>
	 /* translators: Hidden accessibility text. */<?php

_e("Default Avatar"); ?>
</span></legend>

<p>
<?php _e(
    "For users without a custom avatar of their own, you can either display a generic logo or a generated one based on their email address."
); ?><br />
</p>

<?php
$avatar_defaults = [
    "mystery" => __("Mystery Person"),
    "blank" => __("Blank"),
    "gravatar_default" => __("Gravatar Logo"),
    "identicon" => __("Identicon (Generated)"),
    "wavatar" => __("Wavatar (Generated)"),
    "monsterid" => __("MonsterID (Generated)"),
    "retro" => __("Retro (Generated)"),
    "robohash" => __("RoboHash (Generated)"),
]; /**
 * Filters the default avatars.
 *
 * Avatars are stored in key/value pairs, where the key is option value,
 * and the name is the displayed avatar name.
 *
 * @since 2.6.0
 *
 * @param string[] $avatar_defaults Associative array of default avatars.
 */
$avatar_defaults = apply_filters("avatar_defaults", $avatar_defaults);
$default = get_option("avatar_default", "mystery");
$avatar_list = ""; // Force avatars on to display these choices.
add_filter("pre_option_show_avatars", "__return_true", 100);
foreach ($avatar_defaults as $default_key => $default_name) {
    $selected = $default === $default_key ? 'checked="checked" ' : "";
    $avatar_list .=
        "\n\t<label><input type='radio' name='avatar_default' id='avatar_{$default_key}' value='" .
        esc_attr($default_key) .
        "' {$selected}/> ";
    $avatar_list .= get_avatar($user_email, 32, $default_key, "", [
        "force_default" => true,
    ]);
    $avatar_list .= " " . $default_name . "</label>";
    $avatar_list .= "<br />";
}
remove_filter("pre_option_show_avatars", "__return_true", 100); /**
 * Filters the HTML output of the default avatar list.
 *
 * @since 2.6.0
 *
 * @param string $avatar_list HTML markup of the avatar list.
 */
echo apply_filters("default_avatar_select", $avatar_list);
?>

</fieldset></td>
</tr>
<?php do_settings_fields("discussion", "avatars"); ?>
</table>

<?php do_settings_sections("discussion"); ?>

<?php submit_button(); ?>
</form>
</div>

<?php require_once ABSPATH . "wp-admin/admin-footer.php"; ?>
