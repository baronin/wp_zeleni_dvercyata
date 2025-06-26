<?php

if (function_exists('acf_add_options_page')) {
  acf_add_options_page([
    'page_title' => 'Загальні налаштування теми',
    'menu_title' => 'Налаштування теми',
    'menu_slug' => 'theme-general-settings',
    'capability' => 'edit_posts',
    'redirect' => false,
  ]);
}
?>
