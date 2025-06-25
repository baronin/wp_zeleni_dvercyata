<?php
    function zeleni_dvercyata_register_nav_menus() {
        register_nav_menus([
            'header-menu' => __('Головне меню', 'zeleni-dvercyata'),
            'footer-menu' => __('Меню в футері', 'zeleni-dvercyata'),
        ]);
    }
    add_action('after_setup_theme', 'zeleni_dvercyata_register_nav_menus');