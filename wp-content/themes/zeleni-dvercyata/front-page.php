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
        <h1><?php echo get_bloginfo('description'); ?></h1>
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
          <li class="service-list__item">
            <div class="service-info">
              <span class="service-info__label">від 1,5 до 5,5 років</span>
              <img src="<?php echo get_template_directory_uri(); ?>/src/img/service-info/early-development.jpg" alt="Ранній розвиток">
              <h3 class="service-info__desc">🧸Ранній розвиток</h3>
              <p class="service-info__price-from">від 120 грн</p>
              <button type="button" class="service-info__btn-learn-more">дізнатись більше</button>
              <dialog class="lesson-info">
                <div class="lesson-info__container">
                  <button type="button" autofocus class="lesson-info__button-close">&#x2715</button>
                  <p><b>ВІК: 1.5 - 5.5 років</b></p>
                  <h3 class="lesson-info__title">
                    🧸РАННІЙ РОЗВИТОК <br>
                  </h3>
                  <ul class="lesson-info__list">
                    <li>На розвиваючих заняттях ми працюємо над розвитком мислення, мовлення;</li>
                    <li>граємо в ігри на збільшення словникового запасу,на розвиток дрібної моторики,а також займаємося  розвитком пам'яті, уваги та уяви;🥎</li>
                    <li>Проводимо динамічні паузи, які включають вправи на масажній доріжці, елементи логоритмики, грубої та тонкої моторики; 🛝</li>
                    <li>Займаємось творчою діяльністю(ліпимо, клеїмо, вирізаємо, малюємо, творимо та витворяємо);🎨🧑🏼‍🔬👨🏼‍🎨</li>
                    <li>Граємо в сюжетно - рольові гри і просто весело проводимо час з малюками;🦸🏼‍♀️🎠</li>
                  </ul>
                  <h3>Коли?</h3>
                  <dl class="lesson-info__list-working-time">
                    <div class="lesson-info__working-time">
                      <dt><h5>МАЛЮКИ 1,6 - 3 роки</h5></dt>
                      <dd>
                        <p>Вт, Чт: <time datetime="18:00">18:00</time> - <time datetime="19:00">19:00</time></p>
                        <p>Ср, Пт: <time datetime="16:00">16:00</time> - <time datetime="17:00">17:00</time>.</p>
                      </dd>
                    </div>
                    <div class="lesson-info__working-time">
                      <dt><h5>СТАРШІ 3 - 5 років</h5></dt>
                      <dd>
                        <p>Пн, Пт: <time datetime="16:15">16:15</time> - <time datetime="18:15">18:15</time></p>
                        <p>Ср, Пт: <time datetime="17:00">17:00</time> - <time datetime="18:00">18:00</time>.</p>
                      </dd>
                    </div>
                  </dl>
                  <dl class="lesson-info__price">
                    <div>
                      <dt>
                        <h3>Ціна:</h3>
                      </dt>
                      <dd>
                        <p><strong>1 год - 120 грн</strong></p>
                        <p><strong>2 год - 160 грн</strong></p>
                      </dd>
                    </div>
                  </dl>
                </div>
              </dialog>
            </div>
          </li>
          <li class="service-list__item">
            <div class="service-info">
              <span class="service-info__label"> від 5.5 років</span>
              <img src="<?php echo get_template_directory_uri(); ?>/src/img/service-info/preparation-for-school.jpg" alt="Підготовка до школи">
              <h3 class="service-info__desc">📚ПІДГОТОВКА ДО ШКОЛИ</h3>
              <p class="service-info__price-from">від 140 грн</p>
              <button type="button" class="service-info__btn-learn-more">дізнатись більше</button>
              <dialog class="lesson-info">
                <div class="lesson-info__container">
                  <button type="button" autofocus class="lesson-info__button-close">&#x2715</button>
                  <p><b>ВІК: від 5.5 років</b></p>
                  <h3 class="lesson-info__title">
                    📚ПІДГОТОВКА ДО ШКОЛИ
                  </h3>
                  <ul class="lesson-info__list">
                    <li>Підготовка до школи важливий етап у розвитку кожної дитини.👱‍♀️👱‍♂️</li>
                    <li>Мовлення, письмо, читання, соціальна адаптація-усе це невід'ємні складові розвитку дитини.</li>
                    <li>
                      Ми пропонуємо підготовчі заняття до школи за унікальною авторською методикою, які передбачають:
                        <ul class="lesson-info__list-advantages">
                          <li>читання;📙</li>
                          <li>математику;🧮</li>
                          <li>знання про навколишній світ;🌏</li>
                          <li>розвиток уміння навчатися, здатності до аналізу та синтезу, узагальнення і формування понять;</li>
                          <li>розвиток організованості, упевненості.</li>
                        </ul>
                    </li>
                    <li>А також заняття з АНГЛІЙСЬКОЇ МОВИ 📚в ігровій формі,які допоможуть дитині упевнено почуватися на уроках англійської в першому класі і надалі.📝</li>
                    <li>Діти вивчають всю основну лексику, вчаться розуміти на слух просте мовлення, говорять англійською за зразком,вчать вірші та грають в ігри за темою.✨</li>
                    <li>Усі заняття цікаві та ефективні!</li>
                  </ul>
                  <dl class="lesson-info__price">
                    <div>
                      <dt>
                        <h3>Ціна:</h3>
                      </dt>
                      <dd>
                        <p><strong>45 хв - 140 грн лише англійська</strong></p>
                        <p><strong>1 год - 140 грн без англійської</strong></p>
                        <p><strong>2 год - 240 грн підготовка з англійською</strong></p>
                      </dd>
                    </div>
                  </dl>
                </div>
              </dialog>
            </div>
          </li>
          <li class="service-list__item">
            <div class="service-info">
              <span class="service-info__label"> від 3.5 - 17 років</span>
              <img src="<?php echo get_template_directory_uri(); ?>/src/img/service-info/english.jpg" alt="Англійска">
              <h3 class="service-info__desc">🇬🇧 АНГЛІЙСЬКА МОВА</h3>
              <p class="service-info__price-from">від 120 грн</p>
              <button type="button" class="service-info__btn-learn-more">дізнатись більше</button>
              <dialog class="lesson-info">
                <div class="lesson-info__container">
                  <button type="button" autofocus class="lesson-info__button-close">&#x2715</button>
                  <p><b>ВІК: від 5.5 років</b></p>
                  <h3 class="lesson-info__title">
                    🇬🇧 АНГЛІЙСЬКА МОВА
                  </h3>
                  <h4>Рідко зустрінеш школяра, який щиро любить проводити багато часу за підручниками та в захваті від навчання. Як зацікавити дитину ще й додатковими уроками англійської мови? Ми знаємо відповідь на це питання!</h4>
                  <ul class="lesson-info__list">
                    <li>📌 По-перше ми проводимо ефективні заняття з гарною репутацією та відгуками.</li>
                    <li>📌 По-друге ми надаємо захопливу самостійну роботу, завдяки якій дитина полюбить іноземну та буде з радістю її вивчати.</li>
                    <li>📌 По-третє працюємо за сучасними методиками, в формі гри вивчаємо нові слова, вчимося вести діалог, ставити та відповідати на питання, розуміти на слух просте мовлення, вчимо вірші та граємо в ігри за темою. І постійно вдосконалюємось!</li>
                    <li>Усі заняття цікаві та ефективні!</li>
                    <li>Також маємо індивідуальний підхід до кожної дитини та підлаштовуємось під її потреби в знаннях.</li>
                    <li>В групі-5-7 дітей</li>
                  </ul>
                  <dl class="lesson-info__price">
                    <div>
                      <dt>
                        <h3>Ціна:</h3>
                      </dt>
                      <dd>
                        <p><strong>45 хв - 140 грн</strong></p>
                        <p><strong>45 хв - 120 грн (для тих, хто відвідує декілька гуртків)</strong></p>
                      </dd>
                    </div>
                  </dl>
                </div>
              </dialog>
            </div>
          </li>
          <li class="service-list__item">
            <div class="service-info">
              <span class="service-info__label"> від 4.5 - 12 років</span>
              <img src="<?php echo get_template_directory_uri(); ?>/src/img/service-info/music.jpeg" alt="музика">
              <h3 class="service-info__desc">🎹 МУЗИКА</h3>
              <p class="service-info__price-from">45хв - 140 грн</p>
              <button type="button" class="service-info__btn-learn-more">дізнатись більше</button>
              <dialog class="lesson-info">
                <div class="lesson-info__container">
                  <button type="button" autofocus class="lesson-info__button-close">&#x2715</button>
                  <p><b>ВІК: від 4.5 до 12 років</b></p>
                  <h3 class="lesson-info__title"> 🎹 МУЗИКА </h3>
                  <p>А чи знаєте ви, що таке музичне виховання і яка його роль у розвитку дітей?</p>
                  <p>Ні, це не набридле вивчення гам і повторення нот. Це цілий світ, що звучить кольоровими мелодіями, заповнює світ дитини казковими фантазіями, веде в загадкову казку.</p>
                  <p>Це розвиток слуху, який так необхідний для засвоєння не тільки рідної, а й іноземної мови, розвиток пам’яті і уваги та артистичних здібностей.</p>
                  <p>Спів оздоровлює весь організм. Під час заняття вокалом ми використовуємо все тіло як музичний інструмент: розвивається дихальна система, покращується робота серця та нормалізується тиск. Також доведено, що люди, які регулярно займаються вокалом, рідше хворіють на застуду та підхоплюють інші хвороби, адже спів підвищує імунітет.</p>
                  <ul class="lesson-info__list">
                    <li>1 етап - донотний період</li>
                    <li>2 етап - засвоєння нотної грамоти</li>
                    <li>3 етап - ази освоєння гри на синтезаторі</li>
                  </ul>
                  <dl class="lesson-info__price">
                    <div>
                      <dt><h3>Ціна:</h3></dt>
                      <dd><p><strong>45 хв - 140 грн</strong></p> </dd>
                    </div>
                  </dl>
                </div>
              </dialog>
            </div>
          </li>
          <li class="service-list__item">
            <div class="service-info">
              <span class="service-info__label"> від 1.5 до 5.5 років</span>
              <img src="<?php echo get_template_directory_uri(); ?>/src/img/service-info/kindergarten.jpg" alt="дитячий садок">
              <h3 class="service-info__desc">🧩ДИТЯЧИЙ САДОК ТА САДОК ВИХІДНОГО ДНЯ</h3>
              <p class="service-info__price-from">180 грн</p>
              <button type="button" class="service-info__btn-learn-more">дізнатись більше</button>
              <dialog class="lesson-info">
                <div class="lesson-info__container">
                  <button type="button" autofocus class="lesson-info__button-close">&#x2715</button>
                  <p><b>ВІК: від 1.5 до 5.5 років</b></p>
                  <h3 class="lesson-info__title">🧩ДИТЯЧИЙ САДОК ТА САДОК ВИХІДНОГО ДНЯ</h3>
                  <h4>В нашому садочку ми проводимо заняття за темами тижня, які направлені на розвиток звʼязного мовлення.</h4>
                  <ul class="lesson-info__list">
                    <li>Займаємось логоритмікою. </li>
                    <li>Проводимо заняття на укріплення скелету та основних мʼязів за допомогою фізичних вправ, вчимо відтворювати танцювальні рухи під музику.💃🏼</li>
                    <li>Працюємо над розвитком елементарних математичних уявлень.</li>
                  </ul>
                  <h4>А також у складі занять використовуємо:</h4>
                  <ul class="lesson-info__list">
                    <li>психогімнастику</li>
                    <li>пальчикову та нейрогімнастику </li>
                    <li>обовʼязкові творчі частини, де діти із задоволенням клеють, вирізають, ліплять, малюють та створюють щось нове та неповторне!🎨✂️🖌️</li>
                    <li>Проводимо різноманітні досліди,експерименти тематичні вечірки та свята!🦹🏼‍♀️👯‍♂️</li>
                  </ul>
                  <h4>Наше головне завдання щоб заняття для дошкільнят викликали в дітей інтерес до пізнання світу.
                    Без харчування, лише вода та печиво.</h4>
                  <dl class="lesson-info__price">
                    <div>
                      <dt><h3>Ціна:</h3></dt>
                      <dd>
                        <p><strong>180 грн</strong></p>
                        <p>Понеділок та Суббота: <br> з <time datetime="09:00">09:00</time> до <time datetime="13:00">13:00</time></p>
                      </dd>
                    </div>
                  </dl>
                </div>
              </dialog>
            </div>
          </li>
          <li class="service-list__item">
            <div class="service-info">
              <span class="service-info__label"> від 2.5 до 14 років</span>
              <img src="<?php echo get_template_directory_uri(); ?>/src/img/service-info/drawing.jpg" alt="студія малювання">
              <h3 class="service-info__desc">🎨СТУДІЯ МАЛЮВАННЯ ТА ЛІПЛЕННЯ</h3>
              <p class="service-info__price-from">180 грн</p>
              <button type="button" class="service-info__btn-learn-more">дізнатись більше</button>
              <dialog class="lesson-info">
                <div class="lesson-info__container">
                  <button type="button" autofocus class="lesson-info__button-close">&#x2715</button>
                  <p><b>ВІК: від 2.5 до 14 років</b></p>
                  <h3 class="lesson-info__title">🎨СТУДІЯ МАЛЮВАННЯ ТА ЛІПЛЕННЯ</h3>
                  <h4>Чудова можливість провести весело та з користю час і принести додому власну картину!</h4>
                  <ul class="lesson-info__list">
                    <li>🖼️ На заняттях діти вдосконалюють дрібну моторику, розвивають кругозір та весело проводять час в колі однолітків! </li>
                    <li>А також можуть побути не лише в ролі художника,а і скульптора та поліпити з полімерної глини.</li>
                    <li>Сучасний підхід до розвитку особистості. 🖌️     </li>
                    <li>Всі матеріали наші💞</li>
                  </ul>
                  <dl class="lesson-info__price">
                    <div>
                      <dt><h3>Ціна:</h3></dt>
                      <dd>
                        <p><strong>180 грн - 2години</strong></p>
                        <hr>
                        <p><strong>Вт - Чт</strong> <br> з <time datetime="16:40">16:40</time> до <time datetime="18:40">18:40</time></p>
                        <p><strong>Пт:</strong> <br> з <time datetime="15:00">15:00</time> до <time datetime="17:00">17:00</time></p>
                        <p><strong>Сб:</strong> <br> з <time datetime="10:00">10:00</time> до <time datetime="12:00">12:00</time></p>
                      </dd>
                    </div>
                  </dl>
                </div>
              </dialog>
            </div>
          </li>
          <li class="service-list__item">
            <div class="service-info">
              <span class="service-info__label"> від 2-х років</span>
              <img src="<?php echo get_template_directory_uri(); ?>/src/img/service-info/speech-therapist.jpg" alt="Заняття с логопедом">
              <h3 class="service-info__desc">🗣️ПСИХОЛОГ, ЛОГОПЕД, ДЕФЕКТОЛОГ</h3>
              <p class="service-info__price-from">- грн</p>
              <button type="button" class="service-info__btn-learn-more">дізнатись більше</button>
              <dialog class="lesson-info">
                <div class="lesson-info__container">
                  <button type="button" autofocus class="lesson-info__button-close">&#x2715</button>
                  <p><b>ВІК: від 2-х років</b></p>
                  <h3 class="lesson-info__title">🗣️ПСИХОЛОГ, ЛОГОПЕД, ДЕФЕКТОЛОГ</h3>
                  <p>Наш психолог допоможе Вам знайти спільну мову з підлітками, роз'яснить моменти, які викликають труднощі у відносинах батьків і дітей, впорається з дитячими страхами, тривожністю, фобіями, комплексами та проблемами, які пов'язані з адаптацією у дитячому колективі садочка чи школи та багатьма іншими запитами.👥</p>
                  <p>Ваша дитина буде психологічно підготовлена,соціалізована і адаптована до життя в колективі!🌈</p>
                  <p>Є консультації для ДІТЕЙ та ДОРОСЛИХ а також комплексні корекційні  заняття з логопедом і дефектологом, які пов'зані з корекцією розвитку когнітивної сфери при певних затримках.</p>
                  <p>Наші логопеди займаються корекцією звуковимови, певними труднощами при запуску мовлення чи затримці мовленнєвого розвитку. Мають допуск до проведення логопедичного масажу.👅</p>
                  <p>Наш дефектолог, на відміну від логопеда не виправляє дефекти мовлення, а допомагає малюку правильно висловлювати власні думки. Він за допомогою гри та ігрових вправ коригує відхилення, викликані різноманітними порушеннями.</p>
                </div>
              </dialog>
            </div>
          </li>
          <li class="service-list__item">
            <div class="service-info">
              <span class="service-info__label"> від 4.5  до 12 років</span>
              <img src="<?php echo get_template_directory_uri(); ?>/src/img/service-info/6.jpg" alt="Заняття">
              <h3 class="service-info__desc">💻СТУДІЯ ТЕХНОША</h3>
              <p class="service-info__price-from">- грн</p>
              <button type="button" class="service-info__btn-learn-more">дізнатись більше</button>
              <dialog class="lesson-info">
                <div class="lesson-info__container">
                  <button type="button" autofocus class="lesson-info__button-close">&#x2715</button>
                  <p><b>ВІК: від 2-х років</b></p>
                  <h3 class="lesson-info__title">💻СТУДІЯ ТЕХНОША</h3>
                  <ul class="lesson-info__list">
                    <li>
                      <h4>🎮Робототехніка для малят (від 4,5 до 7 років)</h4>
                      <p>Курс робототехніки для маленьких геніїв дає чудову змогу розвивати свою дитину в незвичному напрямку змалку. Тут наші найменші учні будують роботів, навчаються працювати із комп'ютером, та в ігровій формі вивчають доволі складні поняття у програмуванні роботів. На заняттях ми розвиваємо дрібну моторику (а вона відповідає за розвиток мозкової діяльності), увагу, уяву, мислення, посидючість, вміння спілкуватись у колективі. Долучайтесь, набір маленьких геніїв триває!</p>
                    </li>
                    <li>
                      <h4>🎮Робототехніка для юних геніїв (8-10 років)</h4>
                      <p>Робототехніка для юних геніїв - чудовий розвиваючий курс для дітей віком від 7 до 10 років. Тут ми будуємо роботів та вчимося їх програмувати, вивчаємо основи механіки та базові закони фізики, вчимося свої знання застосовувати на практиці, а також найголовніше: вживу спілкуємось в колективі одноліток- однодумців (що особливо цінне саме зараз!) У нас дітям цікаво, корисно, розвиваюче і обов'язково весело.</p>
                    </li>
                    <li>
                      <h4>🎮Робототехніка для майже дорослих геніїв (вік 11+)</h4>
                      <p>Курс робототехніки для вже майже дорослих геніїв (від 11 років). Для багатьох дорослих людей - це вже просто космос, якась інша галактика... А для наших учнів - можливість розвивати математичні, інженерні, програмувальні навички у дууууже цікавій, захоплюючій формі! Запрошуємо, долучайте своїх дітей до мега-крутих розвиваючих занять!</p>
                    </li>
                    <li>
                      <h4>🎮Курси програмування мають дві вікових групи:</h4>
                      <p>перша - до 12 років ( поглиблене вивчення блокової програми Scratch), друга - до 16 років (вже доросла мова програмування Python)
                        Яка особливість наших курсів програмування? - в нас мега-крутий викладач, який вміє ну дууууже доступно, на цікавих і простих прикладах із життя донести дітям складні поняття. І це прямо супер класно! Запрошуємо! Долучайте своїх юних комп'ютерних геніїв до світу програмування, створення власних анімованих листівок, казок, історій та ігор!</p>
                    </li>
                    <li>
                      <h4>🎮Інтегрований курс для учнів 2-4 класів</h4>
                      <p>"Робототехніка+ програмування"</p>
                    </li>
                    <li>
                      <h4>🎮Графічний дизайн</h4>
                      <p>
                        На курсі графічного дизайну діти вчаться обробляти фото, створювати власні картинки, колажі, малювати у графічних редакторах. Починаємо від  самого початку і поступово йдемо до більш складних робіт.
                      </p>
                    </li>
                  </ul>
                  <div>
                    Деталі за тел: <a href="tel:+380977566132">097 75 66 132</a>
                  </div>
                </div>
              </dialog>
            </div>
          </li>
          <li class="service-list__item">
            <div class="service-info">
              <span class="service-info__label">від 6 до 11 років(1-5 класс)</span>
              <img src="<?php echo get_template_directory_uri(); ?>/src/img/service-info/4.jpg" alt="Заняття у классі">
              <h3 class="service-info__desc">📝ДОПОМОГА ШКОЛІ</h3>
              <p class="service-info__price-from">- грн/година</p>
              <button type="button" class="service-info__btn-learn-more">дізнатись більше</button>
              <dialog class="lesson-info">
                <div class="lesson-info__container">
                  <button type="button" autofocus class="lesson-info__button-close">&#x2715</button>
                  <p><b>ВІК: від 6 до 11 років(1-5 класс)</b></p>
                  <h3 class="lesson-info__title">📝ДОПОМОГА ШКОЛІ</h3>
                  <h4>Якщо Ваша дитина має прогалини в знаннях, щось не встигає чи не розуміє на уроках, запрошуємо до наших репетиторів!</h4>
                  <ul class="lesson-info__list">
                    <li>Ми навчимо правильно і швидко рахувати та вирішувати логічні завдання.🧮</li>
                    <li>Навчимо читати по складам, цілими словами та розвитку зв’язного мовлення, артикуляційної гімнастики.📚</li>
                    <li>Навчимо аналізу, синтезу, узагальнення та формування понять;</li>
                  </ul>
                </div>
              </dialog>
            </div>
          </li>
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
