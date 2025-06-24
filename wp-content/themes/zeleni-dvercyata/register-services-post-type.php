<?php

function register_services_post_type() {
  $labels = [
      'name'                  => 'Послуги',
      'singular_name'         => 'Послуга',
      'menu_name'             => 'Послуги',
      'add_new_item'          => 'Додати нову послугу',
      'add_new'               => 'Додати нову',
      'edit_item'             => 'Редагувати послугу',
      'update_item'           => 'Оновити послугу',
      'search_items'          => 'Шукати послугу',
      'not_found'             => 'Не знайдено',
      'not_found_in_trash'    => 'Не знайдено в кошику',
  ];

  $args = [
    'label'                 => 'Послуга',
    'description'           => 'Послуги дитячого центру',
    'labels'                => $labels,
    'supports'              => ['title', 'editor', 'thumbnail'], // Включаем заголовок, редактор и миниатюру
    'public'                => true,
    'show_in_menu'          => true,
    'menu_position'         => 5,
    'menu_icon'             => 'dashicons-welcome-learn-more', // Иконка в админ-меню
    'show_in_admin_bar'     => true,
    'show_in_nav_menus'     => true,
    'can_export'            => true,
    'has_archive'           => true,
    'exclude_from_search'   => false,
    'publicly_queryable'    => true,
    'capability_type'       => 'post',
  ];

  register_post_type('service', $args);
}

add_action('init', 'register_services_post_type');
?>
