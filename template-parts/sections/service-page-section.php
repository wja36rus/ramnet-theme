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
    'post_type'      => 'ramnet_job',
    'posts_per_page' => -1, 
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'post_status'    => 'publish',
    'p' => $project_id
));


?>

<section class="page__job">
        <div class="page__job__container">
        <a class="page__job__back" href="<?php echo esc_url( home_url( '/' ) ); ?>">Назад</a>
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

                <img class="page__service__card__bg" src="<?php 
                    if (has_post_thumbnail()) {
                        $url = get_the_post_thumbnail_url();
                        echo $url;
                    } 
                ?>" alt="<?php echo esc_html__( wp_strip_all_tags($service_title), 'ramnet' ); ?>">
                

                    <!-- Название услуги -->
                    <h4 class="page__service__card__title">
                        <?php echo esc_html__( wp_strip_all_tags($service_title), 'ramnet' ); ?>
                    </h4>
                    
                        
                        <!-- Описание -->
                        <p class="page__service__card__text">
                            <?php echo esc_html__( wp_strip_all_tags($service_description), 'ramnet' ); ?>
                        </p>

                        



            
            <?php 
                $counter++;
            endwhile;
            wp_reset_postdata();
            ?>
        
            
        <?php endif; ?>
        </div>
</section>