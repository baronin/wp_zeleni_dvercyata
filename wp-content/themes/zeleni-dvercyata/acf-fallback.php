<?php
/**
 * ACF compatibility layer.
 *
 * Prevents fatal errors when Advanced Custom Fields plugin is not installed
 * or not active.
 */

if (!function_exists('get_field')) {
    function get_field($selector, $post_id = false, $format_value = true, $escape_html = false)
    {
        return null;
    }
}

if (!function_exists('the_field')) {
    function the_field($selector, $post_id = false, $format_value = true)
    {
        echo '';
    }
}

if (!function_exists('have_rows')) {
    function have_rows($selector, $post_id = false)
    {
        return false;
    }
}

if (!function_exists('the_row')) {
    function the_row()
    {
        return null;
    }
}

if (!function_exists('get_sub_field')) {
    function get_sub_field($selector, $format_value = true, $escape_html = false)
    {
        return null;
    }
}

if (!function_exists('the_sub_field')) {
    function the_sub_field($selector, $format_value = true)
    {
        echo '';
    }
}
