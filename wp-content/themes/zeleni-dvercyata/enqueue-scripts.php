<?php
function theme_enqueue_scripts() {
    $theme_directory = get_template_directory_uri();
    $version = time();
    $inFooter = false;
    wp_enqueue_style('header', $theme_directory. '/src/css/header.css', [], $version);
    wp_enqueue_style('index', $theme_directory. '/src/css/index.css', [], $version);

    wp_enqueue_script('accept-cookie', $theme_directory . '/src/js/accept-cookie.js', [], $version, $inFooter);
    wp_enqueue_script('dialog-info', $theme_directory . '/src/js/dialog-info/index.js', [], $version, $inFooter);
    wp_enqueue_script('service-list', $theme_directory . '/src/js/service-list.js', [], $version, $inFooter);
    wp_enqueue_script('vendor', $theme_directory . '/src/js/vendor/modernizr-3.11.2.min.js', [], $version, $inFooter);
    wp_enqueue_script('plugins', $theme_directory . '/src/js/plugins.js', [], $version, $inFooter);
    
    add_filter( 'script_loader_tag', 'add_type_module', 10, 3 );
}
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');

function add_type_module($tag, $handle) {
    if ('vendor' === $handle || 'plugins' === $handle || 'accept-cookie' === $handle || 'dialog-info' === $handle || 'service-list' === $handle) {
        return str_replace('type="text/javascript"', 'type="module"', $tag);
    }
    return $tag;
}
?>