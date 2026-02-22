<?php
/**
 * Time section template (На протяжении 15+ лет ценности компании остаются неизменны)
 *
 * @package RAMNET
 */

 // Получаем посты из базы данных
$services = new WP_Query(array(
    'post_type'      => 'ramnet_time',
    'posts_per_page' => -1, // Показываем все посты
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'post_status'    => 'publish',
));
?>

<section class="time">
    <div class="time__container">

        <h1 class="time__hero">
            <?php echo esc_html__( 'На протяжении 15+ лет', 'ramnet' ); ?><br>
            <?php echo esc_html__( 'ценности компании остаются неизменны', 'ramnet' ); ?>
        </h1>

        <div class="time__cards">
        <?php if ( $services->have_posts() ) : ?>
            <?php 
            while ( $services->have_posts() ) : $services->the_post();
                
                // Используем заголовок как название услуги
                $service_title = get_the_title();
                
                // Используем контент или отрывок как описание
                $service_description = has_excerpt() ? get_the_excerpt() : get_the_content();
                if ( empty($service_description) ) {
                    $service_description = __( '', 'ramnet' );
                }
                
            ?>

            <div class="time__card">
                <h1 class="time__card__title">
                        <?php echo esc_html__( $service_title, 'ramnet' ); ?>
                </h1>
                <div class="time__card__text">
                        <?php echo esc_html__( the_content($service_description), 'ramnet' ); ?>
                </div>
            </div>

            
            <?php 
            endwhile;
            wp_reset_postdata();
            ?>

            <?php endif; ?>
        </div>
    </div>
</section>