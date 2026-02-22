<?php
/**
 * Say section template (Наша философия)
 *
 * @package RAMNET
 */

 // Получаем услуги из базы данных
$services = new WP_Query(array(
    'post_type'      => 'ramnet_say',
    'posts_per_page' => -1, // Показываем все услуги
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'post_status'    => 'publish',
));
?>

<section class="say">
    <div class="say__container">
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
        <h4 class="title__say">
            <?php echo esc_html__( wp_strip_all_tags($service_title), 'ramnet' ); ?>
        </h4>

        <h1 class="say_hero">
            <?php echo esc_html__( the_content($service_description), 'ramnet' ); ?>
        </h1>
            <?php 
                $counter++;
            endwhile;
            wp_reset_postdata();
            ?>
        <?php endif; ?>
    </div>
</section>