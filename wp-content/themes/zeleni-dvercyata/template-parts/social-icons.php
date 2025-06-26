<?php
/**
 * Шаблонна частина для виводу іконок соціальних мереж.
 */
$options = get_theme_options();
$social_links = $options['social_links'] ?? [];

if ($social_links) :
?>
    <ul class="social-links-list">
        <?php foreach ($social_links as $link_item) :
            $network_choice = $link_item['social_network_choice'] ?? '';
            $network_url = $link_item['social_network_url'] ?? '';

            if ($network_choice && $network_url) :
        ?>
            <li class="social-links-list__item social-links-list__item--<?php echo esc_attr($network_choice); ?>">
                <a href="<?php echo esc_url($network_url); ?>" target="_blank" rel="noopener noreferrer" aria-label="Посилання на нашу сторінку в <?php echo esc_attr(ucfirst($network_choice)); ?>">

                    <?php
                    // Цей трюк динамічно підключає файл іконки SVG
                    // на основі значення, яке ми обрали ('instagram', 'facebook' і т.д.)
                    get_template_part('template-parts/icons/icon', $network_choice);
                    ?>

                </a>
            </li>
        <?php
            endif;
            endforeach;
        ?>
    </ul>
<?php endif; ?>
