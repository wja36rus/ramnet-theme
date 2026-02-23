<?php
/**
 * Service section template (Что остекляем)
 * Выводит услуги из custom post type ramnet_service
 *
 * @package RAMNET
 */

// Получаем услуги из базы данных
$services = new WP_Query(array(
    'post_type'      => 'ramnet_service',
    'posts_per_page' => -1, // Показываем все услуги
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'post_status'    => 'publish',
));
?>

<section class="service" id="service">
    
    <h4 class="title__service"><?php echo esc_html__( 'Что остекляем', 'ramnet' ); ?></h4>
    
    <div class="service__grid">
        <?php if ( $services->have_posts() ) : ?>
            <?php 
            $counter = 1;
            while ( $services->have_posts() ) : $services->the_post();
                                
                // Используем заголовок как название услуги
                $service_title = get_the_title();
                
                // Используем контент или отрывок как описание
                $service_description = has_excerpt() ? get_the_excerpt() : get_the_content();
                if ( empty($service_description) ) {
                    $service_description = __( 'Панорамное остекление для комфортного отдыха в любое время года', 'ramnet' );
                }
                
            ?>

            
        
            <div class="service__card__bg__wrapper">
                <img id="service__card__bg_<?php echo $counter; ?>" class="service__card__bg" src="<?php 
                    if (has_post_thumbnail()) {
                        $url = get_the_post_thumbnail_url();
                        echo $url;
                    } 
                ?>" alt="<?php echo esc_html__( wp_strip_all_tags($service_title), 'ramnet' ); ?>">
                
                <div id="service__card_<?php echo $counter; ?>" class="service__card" data-service-id="<?php the_ID(); ?>">
                    
                    <!-- Номер услуги -->
                    <h3 class="service__number">
                        <?php echo str_pad($counter, 2, '0', STR_PAD_LEFT); ?></h3>
                    
                    <!-- Название услуги -->
                    <h4 class="service__card__title">
                        <?php echo esc_html__( wp_strip_all_tags($service_title), 'ramnet' ); ?>
                    </h4>
                    
                    <!-- Скрытый блок с деталями (появляется при наведении) -->
                    <div class="service__card__hidden">
                        
                        <hr class="service__hr">
                        
                        <!-- Описание -->
                        <p class="service__card__text">
                            <?php echo esc_html__( wp_strip_all_tags($service_description), 'ramnet' ); ?>
                        </p>
                        
                    </div>
                </div>
            </div>
            
            <?php 
                $counter++;
            endwhile;
            wp_reset_postdata();
            ?>
            
        
            
        <?php endif; ?>
        
    </div>
</section>