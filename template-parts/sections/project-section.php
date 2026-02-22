<?php
/**
 * Project section template (Некоторые реализованные нами проекты)
 *
 * @package RAMNET
 */

 // Получаем услуги из базы данных
$services = new WP_Query(array(
    'post_type'      => 'ramnet_project',
    'posts_per_page' => -1, // Показываем все услуги
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'post_status'    => 'publish',
));
?>

<section class="project" id="project">
    <div class="project__wrapper">
            

            <div class="project__left__columns">  
            <h1 class="project__title">
                <?php echo esc_html__( 'Некоторые реализованные нами проекты', 'ramnet' ); ?>
            </h1>
            <?php if ( $services->have_posts() ) : ?>
            <?php 
            $counter = 1;
            while ( $services->have_posts() ) : $services->the_post();
                                
                // Используем заголовок как название услуги
                $service_title = get_the_title();

                // Получаем мета-поля услуги
                $location = get_post_meta( get_the_ID(), '_project_location', true );
                $year = get_post_meta( get_the_ID(), '_project_year', true );

                // Используем контент или отрывок как описание
                $service_description = has_excerpt() ? get_the_excerpt() : get_the_content();
                if ( empty($service_description) ) {
                    $service_description = __( 'Панорамное остекление для комфортного отдыха в любое время года', 'ramnet' );
                }
                
            ?>

            <?php 
            if($counter % 2 != 0):
            ?>
            <!-- Проект 1 -->
            <div id="project<?php echo $counter;?>" style="background-image: url(<?php if (has_post_thumbnail()) {
                        $url = get_the_post_thumbnail_url();
                        echo $url;
                    }?>)" class="project__card">
                <div class="project__card__inset">
                    <h1 class="project__card__title">
                        <?php echo esc_html__( wp_strip_all_tags($service_title), 'ramnet' ); ?>
                    </h1>
                    <div class="project__about">
                        <?php echo esc_html__( the_content($service_description), 'ramnet' ); ?>
                    </div>
                    <p class="project__place">
                        <?php echo esc_html__( wp_strip_all_tags($location), 'ramnet' ); ?>,
                        <?php echo esc_html__( wp_strip_all_tags($year), 'ramnet' ); ?>
                    </p>
                </div>
            </div>
            <?php endif; ?> 
            <?php 
                $counter++;
            endwhile;
            wp_reset_postdata();
            ?>
            <?php endif; ?>
            

        </div>
        <div class="project__right__columns">
             <?php if ( $services->have_posts() ) : ?>
            <?php 
            $counters = 1;
            while ( $services->have_posts() ) : $services->the_post();
                                
                // Используем заголовок как название услуги
                $service_title = get_the_title();

                // Получаем мета-поля услуги
                $location = get_post_meta( get_the_ID(), '_project_location', true );
                $year = get_post_meta( get_the_ID(), '_project_year', true );

                // Используем контент или отрывок как описание
                $service_description = has_excerpt() ? get_the_excerpt() : get_the_content();
                if ( empty($service_description) ) {
                    $service_description = __( 'Панорамное остекление для комфортного отдыха в любое время года', 'ramnet' );
                }
                
            ?>

            <?php 
            if($counters % 2 == 0):
            ?>
            <!-- Проект 1 -->
            <div id="project<?php echo $counters;?>" style="background-image: url(<?php if (has_post_thumbnail()) {
                        $url = get_the_post_thumbnail_url();
                        echo $url;
                    }?>)" class="project__card">
                <div class="project__card__inset">
                    <h1 class="project__card__title">
                        <?php echo esc_html__( wp_strip_all_tags($service_title), 'ramnet' ); ?>
                    </h1>
                    <div class="project__about">
                        <?php echo esc_html__( the_content($service_description), 'ramnet' ); ?>
                    </div>
                    <p class="project__place">
                        <?php echo esc_html__( wp_strip_all_tags($location), 'ramnet' ); ?>,
                        <?php echo esc_html__( wp_strip_all_tags($year), 'ramnet' ); ?>
                    </p>
                </div>
            </div>

            <?php endif; ?> 
            <?php 
                $counters++;
            endwhile;
            wp_reset_postdata();
            ?>
            <?php endif; ?>
            <!-- Кнопка "Смотреть все проекты" -->
            <div class="button__container__project">
                <button class="button__main">
                    <p class="button__text"><?php echo esc_html__( 'СМОТРЕТЬ ВСЕ ПРОЕКТЫ', 'ramnet' ); ?></p>
                </button>
            </div>
        </div>
        </div>
    </div>
</section>