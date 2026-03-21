<?php
/**
 * Service page section template (Подробнее о том что остекляем)
 * Выводит услугу из custom post type ramnet_service
 *
 * @package RAMNET
 */
$project_id = isset( $_GET['project_id'] ) ? intval( $_GET['project_id'] ) : 0;

// Получаем услуги из базы данных
$services = new WP_Query(array(
    'post_type'      => 'ramnet_project',
    'posts_per_page' => -1, 
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'post_status'    => 'publish',
    'p' => $project_id
));


?>

<section class="page__job">
        <div class="page__job__container">
        
        <?php if ( $services->have_posts() ) : ?>
            <?php 
            $counter = 1;
            while ( $services->have_posts() ) : $services->the_post();
                                
                // Используем заголовок как название услуги
                $service_title = get_the_title();
                
                // Используем контент или отрывок как описание
                $service_description = has_excerpt() ? get_the_excerpt() : get_the_content();
                if ( empty($service_description) ) {
                    $service_description = __( '', 'ramnet' );
                }
                
            ?>
                
                    <!-- Название услуги -->
                    <h4 class="page__service__card__title">
                        <?php echo esc_html__( wp_strip_all_tags($service_title), 'ramnet' ); ?>
                    </h4>
                    <a href="" class="no__decoration">
                    <div class="paje__job__back"><img class="page__service__back" src="https://static.tildacdn.com/tild6334-3239-4032-b166-633565623864/left.svg" alt="">Вернуться ко всем проектам</div>
            </a>
            </div>

            <div class="paje__job__bg_project" style="background-image: url(<?php 
                    if (has_post_thumbnail()) {
                        $url = get_the_post_thumbnail_url();
                        echo $url;
                    } 
                ?>)"></div>
                        
                        <div class="page__job__container">

                        <div class="page__job__about">
                            <h1 class="page__job__about__title">О проекте</h1>
                        <!-- Описание -->
                        <div class="page__service__card__text">
                            
                            <?php
                            $content = get_the_content();
                            $content = preg_replace('/<img[^>]+>/', '', $content);
                            $content = preg_replace('/<figure[^>]*>.*?<\/figure>/s', '', $content);
                            echo apply_filters('the_content', $content);
                            ?>
                        </div>
                        </div>
                        </div>
                        
                </div>

                <div class="page__job__gallery">
                    <div class="arrow__gallery"><</div>
                <?php
                    $gallery = get_post_gallery(get_the_ID(), false);
                        if ($gallery):
                            $count = 0;
                            foreach($gallery['src'] as $value):
                            $count++;
                            if ($count >= 4) {
                                break;
                            }
                    ?>
                    <img src="<?= $value; ?>" class="page__job__gallery__image" alt="">
                    <?php
                        endforeach;
                        endif;
                    ?>
                    <div class="arrow__gallery">></div>
            </div>
            <?php 
                $counter++;
            endwhile;
            wp_reset_postdata();
            ?>
        
            
        <?php endif; ?>
        </div>
</section>