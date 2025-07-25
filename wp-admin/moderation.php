<?php
/**
 * Comment Moderation Administration Screen.
 *
 * Redirects to edit-comments.php?comment_status=moderated.
 *
 * @package WordPress
 * @subpackage Administration
 */
require_once dirname(__DIR__) . "/wp-load.php";
wp_redirect(admin_url("edit-comments.php?comment_status=moderated"));
exit();
