<?php
/**
 * WordPress Theme Installation Administration API
 *
 * @package WordPress
 * @subpackage Administration
 */

$themes_allowedtags = [
    "a" => [
        "href" => [],
        "title" => [],
        "target" => [],
    ],
    "abbr" => ["title" => []],
    "acronym" => ["title" => []],
    "code" => [],
    "pre" => [],
    "em" => [],
    "strong" => [],
    "div" => [],
    "p" => [],
    "ul" => [],
    "ol" => [],
    "li" => [],
    "h1" => [],
    "h2" => [],
    "h3" => [],
    "h4" => [],
    "h5" => [],
    "h6" => [],
    "img" => [
        "src" => [],
        "class" => [],
        "alt" => [],
    ],
];

$theme_field_defaults = [
    "description" => true,
    "sections" => false,
    "tested" => true,
    "requires" => true,
    "rating" => true,
    "downloaded" => true,
    "downloadlink" => true,
    "last_updated" => true,
    "homepage" => true,
    "tags" => true,
    "num_ratings" => true,
];

/**
 * Retrieves the list of WordPress theme features (aka theme tags).
 *
 * @since 2.8.0
 *
 * @deprecated 3.1.0 Use get_theme_feature_list() instead.
 *
 * @return array
 */
function install_themes_feature_list()
{
    _deprecated_function(__FUNCTION__, "3.1.0", "get_theme_feature_list()");

    $cache = get_transient("wporg_theme_feature_list");
    if (!$cache) {
        set_transient("wporg_theme_feature_list", [], 3 * HOUR_IN_SECONDS);
    }

    if ($cache) {
        return $cache;
    }

    $feature_list = themes_api("feature_list", []);
    if (is_wp_error($feature_list)) {
        return [];
    }

    set_transient(
        "wporg_theme_feature_list",
        $feature_list,
        3 * HOUR_IN_SECONDS
    );

    return $feature_list;
}

/**
 * Displays search form for searching themes.
 *
 * @since 2.8.0
 *
 * @param bool $type_selector
 */
function install_theme_search_form($type_selector = true)
{
    $type = isset($_REQUEST["type"]) ? wp_unslash($_REQUEST["type"]) : "term";
    $term = isset($_REQUEST["s"]) ? wp_unslash($_REQUEST["s"]) : "";
    if (!$type_selector) {
        echo '<p class="install-help">' .
            __("Search for themes by keyword.") .
            "</p>";
    }
    ?>
<form id="search-themes" method="get">
	<input type="hidden" name="tab" value="search" />
	<?php if ($type_selector): ?>
	<label class="screen-reader-text" for="typeselector">
		<?php /* translators: Hidden accessibility text. */
  _e("Type of search"); ?>
	</label>
	<select	name="type" id="typeselector">
	<option value="term" <?php selected("term", $type); ?>><?php _e(
    "Keyword"
); ?></option>
	<option value="author" <?php selected("author", $type); ?>><?php _e(
    "Author"
); ?></option>
	<option value="tag" <?php selected("tag", $type); ?>><?php _ex(
    "Tag",
    "Theme Installer"
); ?></option>
	</select>
	<label class="screen-reader-text" for="s">
		<?php switch ($type) {
      case "term":
          /* translators: Hidden accessibility text. */
          _e("Search by keyword");
          break;
      case "author":
          /* translators: Hidden accessibility text. */
          _e("Search by author");
          break;
      case "tag":
          /* translators: Hidden accessibility text. */
          _e("Search by tag");
          break;
  } ?>
	</label>
	<?php
     /* translators: Hidden accessibility text. */

     else: ?>
	<label class="screen-reader-text" for="s">
		<?php _e("Search by keyword"); ?>
	</label>
	<?php endif; ?>
	<input type="search" name="s" id="s" size="30" value="<?php echo esc_attr(
     $term
 ); ?>" autofocus="autofocus" />
	<?php submit_button(__("Search"), "", "search", false); ?>
</form>
	<?php
}

/**
 * Displays tags filter for themes.
 *
 * @since 2.8.0
 */
function install_themes_dashboard()
{
    install_theme_search_form(false); ?>
<h4><?php _e("Feature Filter"); ?></h4>
<p class="install-help"><?php _e(
    "Find a theme based on specific features."
); ?></p>

<form method="get">
	<input type="hidden" name="tab" value="search" />
	<?php
 $feature_list = get_theme_feature_list();
 echo '<div class="feature-filter">';

 foreach ((array) $feature_list as $feature_name => $features) {

     $feature_name = esc_html($feature_name);
     echo '<div class="feature-name">' . $feature_name . "</div>";

     echo '<ol class="feature-group">';
     foreach ($features as $feature => $feature_name) {

         $feature_name = esc_html($feature_name);
         $feature = esc_attr($feature);
         ?>

<li>
	<input type="checkbox" name="features[]" id="feature-id-<?php echo $feature; ?>" value="<?php echo $feature; ?>" />
	<label for="feature-id-<?php echo $feature; ?>"><?php echo $feature_name; ?></label>
</li>

<?php
     }
     ?>
</ol>
<br class="clear" />
		<?php
 }
 ?>

</div>
<br class="clear" />
	<?php submit_button(__("Find Themes"), "", "search"); ?>
</form>
	<?php
}

/**
 * Displays a form to upload themes from zip files.
 *
 * @since 2.8.0
 */
function install_themes_upload()
{
    ?>
<p class="install-help"><?php _e(
    "If you have a theme in a .zip format, you may install or update it by uploading it here."
); ?></p>
<form method="post" enctype="multipart/form-data" class="wp-upload-form" action="<?php echo esc_url(
    self_admin_url("update.php?action=upload-theme")
); ?>">
	<?php wp_nonce_field("theme-upload"); ?>
	<label class="screen-reader-text" for="themezip">
		<?php /* translators: Hidden accessibility text. */
  _e("Theme zip file"); ?>
	</label>
	<input type="file" id="themezip" name="themezip" accept=".zip" />
	<?php submit_button(
     _x("Install Now", "theme"),
     "",
     "install-theme-submit",
     false
 ); ?>
</form>
	<?php
}

/**
 * Prints a theme on the Install Themes pages.
 *
 * @deprecated 3.4.0
 *
 * @global WP_Theme_Install_List_Table $wp_list_table
 *
 * @param object $theme
 */
function display_theme($theme)
{
    _deprecated_function(__FUNCTION__, "3.4.0");
    global $wp_list_table;
    if (!isset($wp_list_table)) {
        $wp_list_table = _get_list_table("WP_Theme_Install_List_Table");
    }
    $wp_list_table->prepare_items();
    $wp_list_table->single_row($theme);
}

/**
 * Displays theme content based on theme list.
 *
 * @since 2.8.0
 *
 * @global WP_Theme_Install_List_Table $wp_list_table
 */
function display_themes()
{
    global $wp_list_table;

    if (!isset($wp_list_table)) {
        $wp_list_table = _get_list_table("WP_Theme_Install_List_Table");
    }
    $wp_list_table->prepare_items();
    $wp_list_table->display();
}

/**
 * Displays theme information in dialog box form.
 *
 * @since 2.8.0
 *
 * @global WP_Theme_Install_List_Table $wp_list_table
 */
function install_theme_information()
{
    global $wp_list_table;

    $theme = themes_api("theme_information", [
        "slug" => wp_unslash($_REQUEST["theme"]),
    ]);

    if (is_wp_error($theme)) {
        wp_die($theme);
    }

    iframe_header(__("Theme Installation"));
    if (!isset($wp_list_table)) {
        $wp_list_table = _get_list_table("WP_Theme_Install_List_Table");
    }
    $wp_list_table->theme_installer_single($theme);
    iframe_footer();
    exit();
}
