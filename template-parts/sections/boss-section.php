<?php
/**
 * Boss section template (О компании)
 *
 * @package RAMNET
 */
// Получаем услуги из базы данных
$services = new WP_Query(array(
    'post_type'      => 'ramnet_boss',
    'posts_per_page' => -1, // Показываем все услуги
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'post_status'    => 'publish',
));

// echo "<pre>";
// print_r($services);
// echo "</pre>";
?>

<section class="boss" id="boss">
    <div class="boss__container">
        <h4 class="title__boss"><?php echo esc_html__( 'О компании', 'ramnet' ); ?></h4>

        <div class="boss__lines">
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
            <!-- Фото основателя -->
            <?php the_post_thumbnail('full'); ?>

            <div class="boss__card">
                <h1 class="boss__title">
                <?php echo esc_html__( $service_title, 'ramnet' ); ?>
                </h1>

                <div class="boss__text__flex">
                    <div class="boss__text">
                       <?php echo esc_html__( the_content($service_description), 'ramnet' ); ?>
            </div>
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