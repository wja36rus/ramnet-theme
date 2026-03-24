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
        $images = [];
        $gallery = [];

        
        if ($services->have_posts()):
            while ($services->have_posts()):
                $services->the_post();
                $content = get_the_content();
                
                $dom = new DOMDocument();
                libxml_use_internal_errors(true);
                $dom->loadHTML('<?xml encoding="UTF-8">' . $content);
                libxml_clear_errors();
                $xpath = new DOMXPath($dom);
                $galleryBlocks = $xpath->query('//*[contains(@class, "wp-block-gallery")]//img/@src');
                $imgBlocks = $xpath->query('//*[contains(@class, "wp-block-image")]//img/@src');
  
                foreach ($imgBlocks as $block){
                    $src = $block->textContent;
        
                    $images[] = [
                        'src' => $src,
                    ];
                }

                foreach ($galleryBlocks as $block){
                    $src = $block->textContent;
        
                    $gallery[] = [
                        'src' => $src,
                    ];
                }

                $pageData = [
                    'job_title' => get_post_meta( get_the_ID(), '_job_title', true ),
                    'job_title_second' => get_post_meta( get_the_ID(), '_job_title_second', true ),
                    'job_subtitle' => get_post_meta( get_the_ID(), '_job_subtitle', true ),
                    'list_line_1' => get_post_meta( get_the_ID(), '_list_line_1', true ),
                    'list_line_2' => get_post_meta( get_the_ID(), '_list_line_2', true ),
                    'list_line_3' => get_post_meta( get_the_ID(), '_list_line_3', true ),
                    'list_line_4' => get_post_meta( get_the_ID(), '_list_line_4', true ),
                    'running_line' => get_post_meta( get_the_ID(), '_running_line', true ),
                    'promotion_date' => get_post_meta( get_the_ID(), '_promotion_date', true ),
                    'call_to_purchase' => get_post_meta( get_the_ID(), '_call_to_purchase', true ),
                    'description_title' => get_post_meta( get_the_ID(), '_description_title', true ),
                    'description_subtitle' => get_post_meta( get_the_ID(), '_description_subtitle', true ),
                    'description_paragraph' => get_post_meta( get_the_ID(), '_description_paragraph', true ),
                    'service_types' => get_post_meta( get_the_ID(), '_service_types', true ),
                    'type_1' => get_post_meta( get_the_ID(), '_type_1', true ),
                    'type_2' => get_post_meta( get_the_ID(), '_type_2', true ),
                    'questions_title' => get_post_meta( get_the_ID(), '_questions_title', true ),
                    'answer_1' => get_post_meta( get_the_ID(), '_answer_1', true ),
                    'answer_1_explanation' => get_post_meta( get_the_ID(), '_answer_1_explanation', true ),
                    'answer_2' => get_post_meta( get_the_ID(), '_answer_2', true ),
                    'answer_2_explanation' => get_post_meta( get_the_ID(), '_answer_2_explanation', true ),
                    'answer_3' => get_post_meta( get_the_ID(), '_answer_3', true ),
                    'answer_3_explanation' => get_post_meta( get_the_ID(), '_answer_3_explanation', true ),
                    'answer_4' => get_post_meta( get_the_ID(), '_answer_4', true ),
                    'answer_4_explanation' => get_post_meta( get_the_ID(), '_answer_4_explanation', true ),
                    'characteristics' => get_post_meta( get_the_ID(), '_characteristics', true ),
                    'characteristics_second_line' => get_post_meta( get_the_ID(), '_characteristics_second_line', true ),
                    'specifications_description' => get_post_meta( get_the_ID(), '_specifications_description', true ),
                    'features' => get_post_meta( get_the_ID(), '_features', true ),
                    'features_second_line' => get_post_meta( get_the_ID(), '_features_second_line', true ),
                    'features_description' => get_post_meta( get_the_ID(), '_features_description', true ),
                    'features_description_about_1' => get_post_meta( get_the_ID(), '_features_description_about_1', true ),
                    'features_description_about_1_text_1' => get_post_meta( get_the_ID(), '_features_description_about_1_text_1', true ),
                    'features_description_about_1_text_2' => get_post_meta( get_the_ID(), '_features_description_about_1_text_2', true ),
                    'features_description_about_1_text_3' => get_post_meta( get_the_ID(), '_features_description_about_1_text_3', true ),
                    'features_description_about_1_text_4' => get_post_meta( get_the_ID(), '_features_description_about_1_text_4', true ),
                    'features_description_about_1_text_5' => get_post_meta( get_the_ID(), '_features_description_about_1_text_5', true ),
                    'features_description_about_1_text_6' => get_post_meta( get_the_ID(), '_features_description_about_1_text_6', true ),
                    'features_description_about_2' => get_post_meta( get_the_ID(), '_features_description_about_2', true ),
                    'features_description_about_2_text_1' => get_post_meta( get_the_ID(), '_features_description_about_2_text_1', true ),
                    'features_description_about_2_text_2' => get_post_meta( get_the_ID(), '_features_description_about_2_text_2', true ),
                    'features_description_about_2_text_3' => get_post_meta( get_the_ID(), '_features_description_about_2_text_3', true ),
                    'features_description_about_2_text_4' => get_post_meta( get_the_ID(), '_features_description_about_2_text_4', true ),
                    'features_description_about_2_text_5' => get_post_meta( get_the_ID(), '_features_description_about_2_text_5', true ),
                    'features_description_about_2_text_6' => get_post_meta( get_the_ID(), '_features_description_about_2_text_6', true ),
                    'features_description_about_3' => get_post_meta( get_the_ID(), '_features_description_about_3', true ),
                    'features_description_about_3_text_1' => get_post_meta( get_the_ID(), '_features_description_about_3_text_1', true ),
                    'features_description_about_3_text_2' => get_post_meta( get_the_ID(), '_features_description_about_3_text_2', true ),
                    'features_description_about_3_text_3' => get_post_meta( get_the_ID(), '_features_description_about_3_text_3', true ),
                    'features_description_about_3_text_4' => get_post_meta( get_the_ID(), '_features_description_about_3_text_4', true ),
                    'features_description_about_3_text_5' => get_post_meta( get_the_ID(), '_features_description_about_3_text_5', true ),
                    'features_description_about_3_text_6' => get_post_meta( get_the_ID(), '_features_description_about_3_text_6', true ),
                    'features_description_about_4' => get_post_meta( get_the_ID(), '_features_description_about_4', true ),
                    'features_description_about_4_text_1' => get_post_meta( get_the_ID(), '_features_description_about_4_text_1', true ),
                    'features_description_about_4_text_2' => get_post_meta( get_the_ID(), '_features_description_about_4_text_2', true ),
                    'features_description_about_4_text_3' => get_post_meta( get_the_ID(), '_features_description_about_4_text_3', true ),
                    'features_description_about_4_text_4' => get_post_meta( get_the_ID(), '_features_description_about_4_text_4', true ),
                    'features_description_about_4_text_5' => get_post_meta( get_the_ID(), '_features_description_about_4_text_5', true ),
                    'features_description_about_4_text_6' => get_post_meta( get_the_ID(), '_features_description_about_4_text_6', true ),
                    'features_description_about_5' => get_post_meta( get_the_ID(), '_features_description_about_5', true ),
                    'features_description_about_5_text_1' => get_post_meta( get_the_ID(), '_features_description_about_5_text_1', true ),
                    'features_description_about_5_text_2' => get_post_meta( get_the_ID(), '_features_description_about_5_text_2', true ),
                    'features_description_about_5_text_3' => get_post_meta( get_the_ID(), '_features_description_about_5_text_3', true ),
                    'features_description_about_5_text_4' => get_post_meta( get_the_ID(), '_features_description_about_5_text_4', true ),
                    'features_description_about_5_text_5' => get_post_meta( get_the_ID(), '_features_description_about_5_text_5', true ),
                    'features_description_about_5_text_6' => get_post_meta( get_the_ID(), '_features_description_about_5_text_6', true ),
                    'gallery_title' => get_post_meta( get_the_ID(), '_gallery_title', true ),
                    'gallery_title_second' => get_post_meta( get_the_ID(), '_gallery_title_second', true ),
                    'people_answer_say' => get_post_meta( get_the_ID(), '_people_answer_say', true ),
                    'people_answer_text' => get_post_meta( get_the_ID(), '_people_answer_text', true ),
                    'how_we_work_1' => get_post_meta( get_the_ID(), '_how_we_work_1', true ),
                    'how_we_work_1_stage_1' => get_post_meta( get_the_ID(), '_how_we_work_1_stage_1', true ),
                    'how_we_work_1_stage_2' => get_post_meta( get_the_ID(), '_how_we_work_1_stage_2', true ),
                    'how_we_work_1_stage_3' => get_post_meta( get_the_ID(), '_how_we_work_1_stage_3', true ),
                    'how_we_work_1_stage_4' => get_post_meta( get_the_ID(), '_how_we_work_1_stage_4', true ),
                    'how_we_work_2_stage_1' => get_post_meta( get_the_ID(), '_how_we_work_2_stage_1', true ),
                    'how_we_work_2_stage_2' => get_post_meta( get_the_ID(), '_how_we_work_2_stage_2', true ),
                    'how_we_work_2_stage_3' => get_post_meta( get_the_ID(), '_how_we_work_2_stage_3', true ),
                    'how_we_work_2_stage_4' => get_post_meta( get_the_ID(), '_how_we_work_2_stage_4', true ),
                    'how_we_work_3_stage_1' => get_post_meta( get_the_ID(), '_how_we_work_3_stage_1', true ),
                    'how_we_work_3_stage_2' => get_post_meta( get_the_ID(), '_how_we_work_3_stage_2', true ),
                    'how_we_work_3_stage_3' => get_post_meta( get_the_ID(), '_how_we_work_3_stage_3', true ),
                    'how_we_work_3_stage_4' => get_post_meta( get_the_ID(), '_how_we_work_3_stage_4', true ),
                    'how_we_work_4_stage_1' => get_post_meta( get_the_ID(), '_how_we_work_4_stage_1', true ),
                    'how_we_work_4_stage_2' => get_post_meta( get_the_ID(), '_how_we_work_4_stage_2', true ),
                    'how_we_work_4_stage_3' => get_post_meta( get_the_ID(), '_how_we_work_4_stage_3', true ),
                    'how_we_work_4_stage_4' => get_post_meta( get_the_ID(), '_how_we_work_4_stage_4', true ),
                    'form_title' => get_post_meta( get_the_ID(), '_form_title', true ),
                    'form_title_second' => get_post_meta( get_the_ID(), '_form_title_second', true )
                ];

                function getDataInArrayPage($pageData, $key) {
                    if(isset($pageData[$key])) {
                        return $pageData[$key];
                    }
                }

                
                ?>

        <!-- 1-й экран -->
        <section class="page-hero">
            <div class="page-hero__container">
                <div class="page-hero__content">
                    <h1 class="page-hero__title">
                        <?php echo getDataInArrayPage($pageData, 'job_title'); ?>
                    </h1>
                    <h1 class="page-hero__title__second">
                        <?php echo getDataInArrayPage($pageData, 'job_title_second'); ?>
                    </h1>
                    <h2 class="page-hero__title__small">
                        <?php echo getDataInArrayPage($pageData, 'job_subtitle'); ?>
                    </h2>
                    <div class="hero__stats">
                        <div class="hero__stat-item">
                            <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg');?>" alt="">
                            <p>
                                <?php echo getDataInArrayPage($pageData, 'list_line_1'); ?>
                            </p>
                        </div>
                        <div class="hero__stat-item">
                            <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg');?>" alt="">
                            <p>
                                <?php echo getDataInArrayPage($pageData, 'list_line_2'); ?>
                            </p>
                        </div>
                        <div class="hero__stat-item">
                            <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg');?>" alt="">
                            <p>
                                <?php echo getDataInArrayPage($pageData, 'list_line_3'); ?>
                            </p>
                        </div>
                        <div class="hero__stat-item">
                            <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg');?>" alt="">
                            <p>
                                <?php echo getDataInArrayPage($pageData, 'list_line_4'); ?>
                            </p>
                        </div>

                        <div class="button__container__main" style="width: auto; text-align: left; padding-top: 50px;">
                        <button class="button__main call__open__form"><p class="button__text">ПОЛУЧИТЬ КОНСУЛЬТАЦИЮ</p></button>
                    </div>
</div>

                </div>
            </div>
            <div class="page-hero__image" style="background-image: url('<?php echo esc_html__( wp_strip_all_tags($images[0]['src']), 'ramnet' ); ?>');"></div>
            <span class="hero__lines">
                <?php $line = getDataInArrayPage($pageData, 'running_line');
                echo $line; ?>
            </span>
            <span class="hero__lines__second">
                <?php echo $line; ?>
            </span>
            <span class="hero__lines__third">
                <?php echo $line; ?>
            </span>
        </section>



        <section class="action">
            <div class="action__container">
        <div class="hero__promo" style="background-image: url('<?php echo esc_html__( wp_strip_all_tags($images[1]['src']), 'ramnet' ); ?>');">
            <?php echo getDataInArrayPage($pageData, 'promotion_date'); ?>
            <span><?php echo getDataInArrayPage($pageData, 'call_to_purchase'); ?></span>
                    

 <div class="button__container__main" style="width: 50%; text-align: center; padding-top: 20px;">
                        <button class="button__main__black call__open__form"><p class="button__text">ЗАКАЗАТЬ</p></button>
                    </div>

                    </div>
                    </div>
        </section>

        <!-- Современное решение -->
        <section class="solution">
            <div class="solution__container">
                <h2 class="solution__title">
                <?php echo getDataInArrayPage($pageData, 'h2'); ?>
                <br>
                <strong><?php echo getDataInArrayPage($pageData, 'h2'); ?></strong>
                </h2>
                <p class="solution__text">
                    <?php echo getDataInArrayPage($pageData, 'p'); ?>
                </p>
                <br>
                <p class="solution__text">
                    <?php echo getDataInArrayPage($pageData, 'p'); ?>
                </p>
                <br>
                
                <p class="solution__text__flex">
                    <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/cross_q.svg' ); ?>" alt="">
                    <?php echo getDataInArrayPage($pageData, 'li'); ?>
                </p>
                    <br>
                <p class="solution__text__flex">
                <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/cross_q.svg' ); ?>" alt="">
                <?php echo getDataInArrayPage($pageData, 'li'); ?>
            </p>
            </div>
        </section>

        <!-- ПОЧЕМУ ВЫБИРАЮТ -->
        <section class="benefits">
            <div class="benefits__container">
                <h2 class="section__title">
                    <?php echo getDataInArrayPage($pageData, 'h2'); ?>
                    <br>
                    <?php echo getDataInArrayPage($pageData, 'h2'); ?>
                </h2>
                <div class="benefits__grid">
                    <div class="benefit__item">
                        <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg')?>" alt="">
                        <div class="benefit__content">
                            <h3><?php echo getDataInArrayPage($pageData, 'h2'); ?></h3>
                            <p><?php echo getDataInArrayPage($pageData, 'p'); ?></p>
                        </div>
                    </div>
                    <div class="benefit__item">
                        <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg');?>" alt="">
                        <div class="benefit__content">
                            <h3><?php echo getDataInArrayPage($pageData, 'h2'); ?></h3>
                            <p><?php echo getDataInArrayPage($pageData, 'p'); ?></p>
                        </div>
                    </div>
                    <div class="benefit__item">
                        <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg');?>" alt="">
                        <div class="benefit__content">
                            <h3><?php echo getDataInArrayPage($pageData, 'h2'); ?></h3>
                            <p><?php echo getDataInArrayPage($pageData, 'p'); ?></p>
                        </div>
                    </div>
                    <div class="benefit__item">
                        <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg')?>" alt="">
                        <div class="benefit__content">
                            <h3><?php echo getDataInArrayPage($pageData, 'h2'); ?></h3>
                            <p><?php echo getDataInArrayPage($pageData, 'p'); ?></p>
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
                        <h2 class="specs-features__section-title"><?php echo getDataInArrayPage($pageData, 'h2'); ?></h2>
                        <h2 class="specs-features__section-title"><?php echo getDataInArrayPage($pageData, 'h2'); ?></h2>
                    </div>
                    <p class="specs-features__desc"><?php echo getDataInArrayPage($pageData, 'p'); ?></p>
                </div>

                <div class="spec__flex__second">
                <div>
                <h2 class="specs-features__section-title"><?php echo getDataInArrayPage($pageData, 'h2'); ?></h2>
                <p class="specs-features__desc"><?php echo getDataInArrayPage($pageData, 'p'); ?></p>
                </div>

                <div class="features__list">
                    <div class="feature__group">
                        <h4><?php echo getDataInArrayPage($pageData, 'h2'); ?></h4>
                        <div class="feature__tags">
                            <span class="feature__tag"><?php echo getDataInArrayPage($pageData, 'li'); ?></span>
                            <span class="feature__tag"><?php echo getDataInArrayPage($pageData, 'li'); ?></span>
                            <span class="feature__tag"><?php echo getDataInArrayPage($pageData, 'li'); ?></span>
                        </div>
                    </div>
                    <div class="feature__group">
                        <h4><?php echo getDataInArrayPage($pageData, 'h2'); ?></h4>
                        <div class="feature__tags">
                            <span class="feature__tag"><?php echo getDataInArrayPage($pageData, 'li'); ?></span>
                            <span class="feature__tag"><?php echo getDataInArrayPage($pageData, 'li'); ?></span>
                        </div>
                    </div>
                    <div class="feature__group">
                        <h4><?php echo getDataInArrayPage($pageData, 'h2'); ?></h4>
                        <div class="feature__tags">
                            <span class="feature__tag"><?php echo getDataInArrayPage($pageData, 'li'); ?></span>
                            <span class="feature__tag"><?php echo getDataInArrayPage($pageData, 'li'); ?></span>
                            <span class="feature__tag"><?php echo getDataInArrayPage($pageData, 'li'); ?></span>
                        </div>
                    </div>
                    <div class="feature__group">
                        <h4><?php echo getDataInArrayPage($pageData, 'h2'); ?></h4>
                        <div class="feature__tags">
                            <span class="feature__tag"><?php echo getDataInArrayPage($pageData, 'li'); ?></span>
                            <span class="feature__tag"><?php echo getDataInArrayPage($pageData, 'li'); ?></span>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </section>

        <!-- Галерея проектов -->
        <section class="gallery">
            <div class="gallery__container">
                <h2 class="section__title"><?php echo getDataInArrayPage($pageData, 'h2'); ?><br><?php echo getDataInArrayPage($pageData, 'h2'); ?></h2>
</div>
                <div class="flexslider">
  <ul class="slides">
    <?php foreach($gallery as $value):?>
        <li>
            <div
                class="gallery__item"
                style="
                background-image: url(<?php echo $value['src'] ?>);
                ">
            </div>
            </li>
        <?php endforeach; ?>
    
  </ul>
</div>
<div class="gallery__container">

                <!-- Блок с отзывами внутри галереи, как в ТЗ -->
                <div style="display: flex; justify-content: space-between; align-items: center; gap: 40px; margin-top: 40px;">
                    <div>
                        <h3 style="color: white; font-size: 26px; font-weight: 400; font-style: italic; max-width: 700px;">
                        <?php echo getDataInArrayPage($pageData, 'h2'); ?></h3>
                        <p style="color: rgba(255,255,255,0.6); margin-top: 10px;"><?php echo getDataInArrayPage($pageData, 'p'); ?></p>
                    </div>
                    <a href="<?= home_url()?>/#people" style="text-decoration: none;"><button class="button__main"><p class="button__text">ОТЗЫВЫ</p></button></a>
                </div>
            </div>
        </section>

        <!-- Как мы работаем -->
        <section class="work-steps">
            <div class="work-steps__container">
                <h2 class="section__title"><?php echo getDataInArrayPage($pageData, 'h2'); ?></h2>
                <div class="steps__grid">
                    <div class="step__card">
                        <div class="step__number"><?php echo getDataInArrayPage($pageData, 'li'); ?></div>
                        <div class="step__title"><?php echo getDataInArrayPage($pageData, 'li'); ?></div>
                        <div class="step__desc"><?php echo getDataInArrayPage($pageData, 'li'); ?></div>
                    </div>
                    <div class="step__card">
                        <div class="step__number"><?php echo getDataInArrayPage($pageData, 'li'); ?></div>
                        <div class="step__title"><?php echo getDataInArrayPage($pageData, 'li'); ?></div>
                        <div class="step__desc"><?php echo getDataInArrayPage($pageData, 'li'); ?></div>
                    </div>
                    <div class="step__card">
                        <div class="step__number"><?php echo getDataInArrayPage($pageData, 'li'); ?></div>
                        <div class="step__title"><?php echo getDataInArrayPage($pageData, 'li'); ?></div>
                        <div class="step__desc"><?php echo getDataInArrayPage($pageData, 'li'); ?></div>
                    </div>
                    <div class="step__card">
                        <div class="step__number"><?php echo getDataInArrayPage($pageData, 'li'); ?></div>
                        <div class="step__title"><?php echo getDataInArrayPage($pageData, 'li'); ?></div>
                        <div class="step__desc"><?php echo getDataInArrayPage($pageData, 'li'); ?></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="form">
    <div class="form__container">
        <div class="form__inner">


            <h1 class="form__title__second">
            <?php echo getDataInArrayPage($pageData, 'h2'); ?><br>
            <?php echo getDataInArrayPage($pageData, 'h2'); ?><br>
            </h1>

            <form id="form" novalidate>
                <input type="text" name="username" class="form__input"
                    placeholder="<?php echo esc_attr__( 'Имя', 'ramnet' ); ?>">
                <input name="phone" type="text" class="form__input phone-mask" placeholder="+7">
                <span>
                    <?php echo esc_html('Нажимая на кнопку, Вы даете согласие ');?><br>
                    <?php echo esc_html('на обработку персональных данных');?>
                </span>
                <div class="button__container__project">
                    <button id="form__submit" class="button__main call__open__form">
                        <p class="button__text"><?php echo esc_html( 'РАССЧИТАТЬ СТОИМОСТЬ', 'ramnet' ); ?></p>
                    </button>
                </div>
            </form>

        </div>
        <?php  $img = $images[count($images) - 1]['src']; ?>
        <img class="form__images" src="<?php echo $img; ?>" alt="">
        <img class="form__images__fon" src="<?php echo $img; ?>" alt="">
    </div>
</section>

        <?php endwhile; ?>
        <?php endif; ?>

    </main>

<?php get_footer(); ?>