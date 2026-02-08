<?php get_header(); ?>

<?php
$options = get_theme_options();
$main_about_us = $options['main_about_us'];
$about_us = $options['about_us'];

?>

<main class="main">
  <!-- HERO block -->
    <section class="hero color-font-primary">
      <div class="container hero__container">
        <div class="hero__logo-wrap">
          <picture>
            <source media="(max-width: 768px)" srcset="<?php echo get_template_directory_uri(); ?> /src/img/logo.png">
            <source media="(min-width: 769px)" srcset="<?php echo get_template_directory_uri(); ?> /src/img/logo-desktop.png" width="700">
            <img src="<?php echo get_template_directory_uri() . '/src/img/logo.png'; ?>" alt="логотип зелені дверцята">
          </picture>
        </div>
        <h1 class="hero__title"><?php echo get_bloginfo('description'); ?></h1>
        <?php if ($main_about_us) { ?>
          <?php echo $main_about_us; ?>
        <?php } ?>
      </div>
    </section>
    <!-- END hero block -->

    <!-- Our Services block -->
    <section class="our-service">
      <div class="container">
        <h2 class="title">Наші послуги</h2>
        <ul class="our-service__list service-list">
           <?php
              // Створюємо новий запит для отримання всіх записів типу 'service'
              $services_query = new WP_Query([
                  'post_type' => 'service',
                  'posts_per_page' => -1,
                  'orderby' => 'menu_order',
                  'order' => 'ASC',
              ]);

              if ($services_query->have_posts()) :
                  while ($services_query->have_posts()) : $services_query->the_post();
                    // Отримуємо всі потрібні нам дані з ACF для поточної послуги
                    $post_id = get_the_ID();
                    $age_range = get_field('service_age_range');
                    $price_short = get_field('service_price_short');
            ?>
          <li class="service-list__item">
            <div class="service-info">
              <span class="service-info__label"><?php echo esc_html($age_range); ?></span>
              <?php
                $service_image_array = get_field('service_background_card');
                if ($service_image_array) :

                    // 3. Якщо так, беремо з масиву URL та alt-текст
                    $image_url = $service_image_array['url'];
                    $image_alt = $service_image_array['alt'];

                    // 4. Виводимо тег <img> з динамічними даними
                ?>
                <img class="service-info__image" src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>">

                <?php else :
                    // Якщо зображення не завантажено, показуємо заглушку
                ?>
                <img class="service-info__image" src="<?php echo get_template_directory_uri(); ?>/src/img/service-info/drawing.jpg" alt="Зображення послуги відсутнє">
              <?php endif; ?>

              <h3 class="service-info__desc"><?php the_title(); ?></h3>
              <p class="service-info__price-from"><?php echo esc_html($price_short); ?></p>

              <button type="button" class="service-info__btn-learn-more" data-dialog-target="#dialog-<?php echo $post_id; ?>">
                  дізнатись більше
              </button>

              <dialog class="lesson-info" id="dialog-<?php echo $post_id; ?>">
                  <div class="lesson-info__container">
                      <button type="button" autofocus class="lesson-info__button-close">&#x2715</button>
                      <p><b>ВІК: <?php echo esc_html($age_range); ?></b></p>
                      <h3 class="lesson-info__title"><?php the_title(); ?></h3>

                      <div class="lesson-info__list">
                          <?php the_content(); // Сюди виводиться весь текст з основного редактора WordPress ?>
                      </div>

                      <?php if (have_rows('service_schedule')) : ?>
                          <h3>Коли?</h3>
                          <dl class="lesson-info__list-working-time">
                              <?php while (have_rows('service_schedule')) : the_row();
                                  $group_title = get_sub_field('group_title');
                                  $group_schedule = get_sub_field('group_schedule');
                              ?>
                                  <div class="lesson-info__working-time">
                                      <dt><h5><?php echo esc_html($group_title); ?></h5></dt>
                                      <dd>
                                          <?php echo $group_schedule; // Тут можна виводити форматований текст з <p> і <time> прямо з ACF поля (тип Text Area) ?>
                                      </dd>
                                  </div>
                              <?php endwhile; ?>
                          </dl>
                      <?php endif; ?>

                      <?php if (have_rows('service_pricing_details')) : ?>
                          <dl class="lesson-info__price">
                              <div>
                                  <dt><h3>Ціна:</h3></dt>
                                  <dd>
                                      <?php while (have_rows('service_pricing_details')) : the_row();
                                          $price_item = get_sub_field('price_item');
                                          $price_cost = get_sub_field('price_cost');
                                      ?>
                                          <p><strong><?php echo esc_html($price_item); ?> - <?php echo esc_html($price_cost); ?></strong></p>
                                      <?php endwhile; ?>
                                  </dd>
                              </div>
                          </dl>
                      <?php endif; ?>
                  </div>
              </dialog>
            </div>
          </li>
        <?php endwhile;
          wp_reset_postdata(); // Обов'язково скидаємо запит
          endif;
        ?>
        </ul>
      </div>
    </section>
    <!-- END Our Services block -->

    <!-- About Us block -->
    <div class="about">
      <div class="container">
        <?php if ($about_us) { ?>
          <?php echo $about_us; ?>
        <?php } ?>
      </div>
    </div>
    <!-- END About Us block -->

    <!-- Contact info -->
    <section class="contacts">
      <div class="container contacts__container">
         <?php
          get_template_part('template-parts/contacts', null, [
              'show_icons' => true
          ]);
          ?>
      </div>
      <iframe class="address-list__map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d229.4449123211731!2d33.412942698449456!3d49.06902441962153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d75326b31c653d%3A0xb0bf30888fdc31a!2z0YPQuy4g0JzQsNC50L7RgNCwINCR0L7RgNC40YnQsNC60LAsIDEyLCDQmtGA0LXQvNC10L3Rh9GD0LMsINCf0L7Qu9GC0LDQstGB0LrQsNGPINC-0LHQu9Cw0YHRgtGMLCAzOTYwMA!5e0!3m2!1sru!2sua!4v1697393460645!5m2!1sru!2sua" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
    <!-- END Contact info block -->
  </main>

<?php get_footer(); ?>
