<?php
/**
 * Template Name: Страница проекта
 *
 * @package RAMNET
 */
$project_id = isset( $_GET['project_id'] ) ? intval( $_GET['project_id'] ) : 0;

 // Получаем услуги из базы данных
 $services = new WP_Query(array(
    'post_type'      => 'ramnet_job',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'post_status'    => 'publish',
    'p' => $project_id
));

// print_r($services);
get_header(); ?>

    <main>
        <?php
        $body = [];
        // $lists = [];
        // $paragraf = [];
        // $images = [];

        if ($services->have_posts()):
            while ($services->have_posts()):
                $services->the_post();
                
                $content = get_the_content();
                
                // Создаем DOMDocument
                $dom = new DOMDocument();
                libxml_use_internal_errors(true); // Подавляем ошибки HTML5
                $dom->loadHTML('<?xml encoding="UTF-8">' . $content);
                libxml_clear_errors();
                
                // Ищем все блоки с классом wp-block-heading
                $xpath = new DOMXPath($dom);
                // $headingBlocks = $xpath->query('//*[contains(@class, "wp-block-heading")]');
                // $paragrafBlock = $xpath->query('//p');
                // $imgBlocks = $xpath->query('//img');
                // $listBlock = $xpath->query('//li');
                
                $combined_query = '//*[contains(@class, "wp-block-heading")] | ' .
                      '//img | ' .
                      '//li | ' .
                      '//p';

                $elements = $xpath->query($combined_query);

                foreach ($elements as $block){
                    $src = $block->getAttribute('src');

                    $body[] = [
                        'text' => trim($block->textContent),
                        'tag' => $block->tagName,
                        'src' => $src,
                    ];
                }

                
                // foreach ($listBlock as $block){
                    
                //     $lists[] = [
                //         'text' => trim($block->textContent),
                //         'tag' => $block->tagName,
                //     ];
                // }

                // foreach ($paragrafBlock as $block){
                //     $paragraf[] = [
                //         'text' => trim($block->textContent),
                //         'tag' => $block->tagName,
                //     ];
                // }


                // foreach ($imgBlocks as $block){
                //     $src = $block->getAttribute('src');

                //     $images[] = [
                //         'src' => $src,
                //         'tag' => $block->tagName,
                //     ];
                // }

                $count = 0;


                function findFirstByTag(&$array, $searchTag) {
                    foreach ($array as $key => $item) {
                        if (isset($item['tag']) && $item['tag'] === $searchTag) {
                            if ($searchTag === 'img') {
                                unset($array[$key]);
                                $array = array_values($array);

                                return $item['src'];
                            } else {
                                unset($array[$key]);
                                $array = array_values($array);

                                return $item['text'];
                            }
                        }
                    }
                    return null; // Если элемент не найден
                }

        ?>

        <!-- 1-й экран -->
        <section class="page-hero">
            <div class="page-hero__container">
                <div class="page-hero__content">
                    <h1 class="page-hero__title">
                        <?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?>
                    </h1>
                    <h1 class="page-hero__title__second">
                        <?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?>
                    </h1>
                    <h2 class="page-hero__title__small">
                        <?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'p')), 'ramnet' ); ?>
                    </h2>
                    <div class="hero__stats">
                        <div class="hero__stat-item">
                            <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg');?>" alt="">
                            <p>
                                <?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?>
                            </p>
                        </div>
                        <div class="hero__stat-item">
                            <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg');?>" alt="">
                            <p>
                                <?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?>
                            </p>
                        </div>
                        <div class="hero__stat-item">
                            <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg');?>" alt="">
                            <p>
                                <?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?>
                            </p>
                        </div>
                        <div class="hero__stat-item">
                            <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg');?>" alt="">
                            <p>
                                <?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?>
                            </p>
                        </div>

                        <div class="button__container__main" style="width: auto; text-align: left; padding-top: 50px;">
                        <button class="button__main call__open__form"><p class="button__text">ПОЛУЧИТЬ КОНСУЛЬТАЦИЮ</p></button>
                    </div>
</div>

                </div>
            </div>
            <div class="page-hero__image" style="background-image: url('<?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'img')), 'ramnet' ); ?>');"></div>
            <span class="hero__lines">
                <?php $line = findFirstByTag($body, 'p');
                echo esc_html__( wp_strip_all_tags($line), 'ramnet' ); ?>
            </span>
            <span class="hero__lines__second">
                <?php echo esc_html__( wp_strip_all_tags($line), 'ramnet' ); ?>
            </span>
            <span class="hero__lines__third">
                <?php echo esc_html__( wp_strip_all_tags($line), 'ramnet' ); ?>
            </span>
        </section>



        <section class="action">
            <div class="action__container">
        <div class="hero__promo">
            <?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'p')), 'ramnet' ); ?>
            <span><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'p')), 'ramnet' ); ?></span>
                    

 <div class="button__container__main" style="width: auto; text-align: center; padding-top: 20px;">
                        <button class="button__main__black call__open__form"><p class="button__text">ЗАКАЗАТЬ</p></button>
                    </div>

                    </div>
                    <div class="page-hero__image__sale" style="background-image: url('<?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'img')), 'ramnet' ); ?>');"></div>

                    </div>
        </section>

        <!-- Современное решение -->
        <section class="solution">
            <div class="solution__container">
                <h2 class="solution__title">
                <?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?>
                <br>
                <strong><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?></strong>
                </h2>
                <p class="solution__text">
                    <?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'p')), 'ramnet' ); ?>
                </p>
                <br>
                <p class="solution__text">
                    <?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'p')), 'ramnet' ); ?>
                </p>
                <br>
                
                <p class="solution__text__flex">
                    <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/cross_q.svg' ); ?>" alt="">
                    <?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?>
                </p>
                    <br>
                <p class="solution__text__flex">
                <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/cross_q.svg' ); ?>" alt="">
                <?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?>
            </p>
            </div>
        </section>

        <!-- ПОЧЕМУ ВЫБИРАЮТ -->
        <section class="benefits">
            <div class="benefits__container">
                <h2 class="section__title">
                    <?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?>
                    <br>
                    <?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?>
                </h2>
                <div class="benefits__grid">
                    <div class="benefit__item">
                        <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg')?>" alt="">
                        <div class="benefit__content">
                            <h3><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?></h3>
                            <p><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'p')), 'ramnet' ); ?></p>
                        </div>
                    </div>
                    <div class="benefit__item">
                        <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg');?>" alt="">
                        <div class="benefit__content">
                            <h3><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?></h3>
                            <p><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'p')), 'ramnet' ); ?></p>
                        </div>
                    </div>
                    <div class="benefit__item">
                        <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg');?>" alt="">
                        <div class="benefit__content">
                            <h3><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?></h3>
                            <p><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'p')), 'ramnet' ); ?></p>
                        </div>
                    </div>
                    <div class="benefit__item">
                        <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg')?>" alt="">
                        <div class="benefit__content">
                            <h3><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?></h3>
                            <p><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'p')), 'ramnet' ); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Технические характеристики и особенности -->
        <section class="specs-features">
            <div class="specs-features__container">
                <div class="spec__flex">
                    <div>
                        <h2 class="specs-features__section-title"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?></h2>
                        <h2 class="specs-features__section-title"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?></h2>
                    </div>
                    <p class="specs-features__desc">К<?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'p')), 'ramnet' ); ?></p>
                </div>

                <div class="spec__flex__second">
                <div>
                <h2 class="specs-features__section-title"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?></h2>
                <p class="specs-features__desc"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'p')), 'ramnet' ); ?></p>
                </div>

                <div class="features__list">
                    <div class="feature__group">
                        <h4><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?></h4>
                        <div class="feature__tags">
                            <span class="feature__tag"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></span>
                            <span class="feature__tag"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></span>
                            <span class="feature__tag"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></span>
                        </div>
                    </div>
                    <div class="feature__group">
                        <h4><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?></h4>
                        <div class="feature__tags">
                            <span class="feature__tag"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></span>
                            <span class="feature__tag"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></span>
                        </div>
                    </div>
                    <div class="feature__group">
                        <h4><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?></h4>
                        <div class="feature__tags">
                            <span class="feature__tag"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></span>
                            <span class="feature__tag"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></span>
                            <span class="feature__tag"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></span>
                        </div>
                    </div>
                    <div class="feature__group">
                        <h4><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?></h4>
                        <div class="feature__tags">
                            <span class="feature__tag"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></span>
                            <span class="feature__tag"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></span>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </section>

        <!-- Галерея проектов -->
        <section class="gallery">
            <div class="gallery__container">
                <h2 class="section__title"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?><br><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?></h2>
</div>
                <div class="flexslider">
  <ul class="slides">
    <li>
      <div
        class="gallery__item"
        style="
          background-image: url(<?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'img')), 'ramnet' ); ?>);
        "
      ></div>
    </li>
    <li>
      <div
        class="gallery__item"
        style="
          background-image: url(<?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'img')), 'ramnet' ); ?>);
        "
      ></div>
    </li>
    <li>
      <div
        class="gallery__item"
        style="
          background-image: url(<?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'img')), 'ramnet' ); ?>);
        "
      ></div>
    </li>
    <li>
      <div
        class="gallery__item"
        style="
          background-image: url(<?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'img')), 'ramnet' ); ?>);
        "
      ></div>
    </li>
    <li>
      <div
        class="gallery__item"
        style="
          background-image: url(<?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'img')), 'ramnet' ); ?>);
        "
      ></div>
    </li>
    <li>
      <div
        class="gallery__item"
        style="
          background-image: url(<?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'img')), 'ramnet' ); ?>);
        "
      ></div>
    </li>
  </ul>
</div>
<div class="gallery__container">

                <!-- Блок с отзывами внутри галереи, как в ТЗ -->
                <div style="display: flex; justify-content: space-between; align-items: center; gap: 40px; margin-top: 40px;">
                    <div>
                        <h3 style="color: white; font-size: 26px; font-weight: 400; font-style: italic; max-width: 700px;">
                        <?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?></h3>
                        <p style="color: rgba(255,255,255,0.6); margin-top: 10px;"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'p')), 'ramnet' ); ?></p>
                    </div>
                    <a href="<?= home_url()?>/#people" style="text-decoration: none;"><button class="button__main"><p class="button__text">ОТЗЫВЫ</p></button></a>
                </div>
            </div>
        </section>

        <!-- Как мы работаем -->
        <section class="work-steps">
            <div class="work-steps__container">
                <h2 class="section__title"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?>?</h2>
                <div class="steps__grid">
                    <div class="step__card">
                        <div class="step__number"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></div>
                        <div class="step__title"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></div>
                        <div class="step__desc"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></div>
                    </div>
                    <div class="step__card">
                        <div class="step__number"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></div>
                        <div class="step__title"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></div>
                        <div class="step__desc"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></div>
                    </div>
                    <div class="step__card">
                        <div class="step__number"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></div>
                        <div class="step__title"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></div>
                        <div class="step__desc"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></div>
                    </div>
                    <div class="step__card">
                        <div class="step__number"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></div>
                        <div class="step__title"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></div>
                        <div class="step__desc"><?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'li')), 'ramnet' ); ?></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="form">
    <div class="form__container">
        <div class="form__inner">


            <h1 class="form__title__second">
            <?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?><br>
            <?php echo esc_html__( wp_strip_all_tags(findFirstByTag($body, 'h2')), 'ramnet' ); ?><br>
            </h1>

            <form id="form" novalidate>
                <input type="text" name="username" class="form__input"
                    placeholder="<?php echo esc_attr__( 'Имя', 'ramnet' ); ?>">
                <input name="phone" type="text" class="form__input phone-mask" placeholder="+7">
                <span>
                    <?php echo esc_html__('Нажимая на кнопку, Вы даете согласие ');?><br>
                    <?php echo esc_html__('на обработку персональных данных');?>
                </span>
                <div class="button__container__project">
                    <button id="form__submit" class="button__main">
                        <p class="button__text"><?php echo esc_html__( 'РАССЧИТАТЬ СТОИМОСТЬ', 'ramnet' ); ?></p>
                    </button>
                </div>
            </form>

        </div>
        <?php  $img = findFirstByTag($body, 'img');?>
        <img class="form__images" src="<?php echo esc_html__( wp_strip_all_tags($img), 'ramnet' ); ?>" alt="">
        <img class="form__images__fon" src="<?php echo esc_html__( wp_strip_all_tags($img), 'ramnet' ); ?>" alt="">
    </div>
</section>

        <?php endwhile; ?>
        <?php endif; ?>

    </main>

<?php get_footer(); ?>