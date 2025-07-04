<?php

/**
 * Получает и кеширует глобальные данные темы из страницы настроек ACF
 *
 * @return array - Массив с глобальными данными темы
 */

 function get_theme_options() {
    // Статическая переменная для хранения кешированных данных
    // Она будет использоваться для хранения данных, если они уже были получены
    static $cached_options = null;

    // Если данные уже были получены, возвращаем их из кеша
    if ($cached_options !== null) {
        return $cached_options;
    }

    $phone_href = '';

    // Если данные еще не были получены, получаем их из страницы настроек ACF
    $contact_info = get_field('contact_info', 'option');
    $main_about_us = get_field('main_about_us', 'option');
    $about_us = get_field('about_us', 'option');
    $contact_phone = get_field('contact_phone', 'option') ?? '';
    $google_map_link = get_field('google_map_link', 'option') ?? '';
    $working_hours_structured   = get_field('working_hours_structured', 'option') ?? [];
    $service_background_card = get_field('service_background_card', 'option') ?? [];
    $social_links = get_field('social_links', 'option') ?? [];



    // Обработка номера телефона
    if (!empty($contact_phone)) {
        $phone_cleaned = preg_replace('/[^0-9]/', '', $contact_phone);
        if (substr($phone_cleaned, 0, 1) === '0') {
            $phone_href = '+38' . $phone_cleaned;
        } elseif (substr($phone_cleaned, 0, 2) === '38') {
            $phone_href = '+' . $phone_cleaned;
        } else {
            $phone_href = '+380' . $phone_cleaned;
        }
    }

    // Создаем массив с данными
    $cached_options = [
        'contact_info' => $contact_info,
        'main_about_us' => $main_about_us,
        'about_us' => $about_us,
        'contact_phone' => $contact_phone,
        'phone_href' => $phone_href,
        'google_map_link' => $google_map_link,
        'working_hours_structured' => $working_hours_structured,
        'service_background_card' => $service_background_card,
        'social_links' => $social_links,
    ];

    return $cached_options;
}
