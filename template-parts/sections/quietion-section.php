<?php
/**
 * Quietion section template (Вопрос-ответ)
 *
 * @package RAMNET
 */

 // Получаем услуги из базы данных
$services = new WP_Query(array(
    'post_type'      => 'ramnet_question',
    'posts_per_page' => -1, // Показываем все услуги
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'post_status'    => 'publish',
));
?>

<section class="quietion">
    <div class="quietion__container">

        <h4 class="title__quietion"><?php echo esc_html__( 'Вопрос-ответ', 'ramnet' ); ?></h4>

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

            <div class="quietion__card">
                <div class="quietion_flex">
                    <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/cross_q.svg' ); ?>" alt="">
                    <p class="quietion__quietion">
                        <?php echo esc_html__( wp_strip_all_tags($service_title), 'ramnet' ); ?>
                    </p>
                </div>
                <p class="quietion__answer <?php if($counter == 1) {echo "active";}?>" >
                    <?php echo esc_html__( wp_strip_all_tags($service_description), 'ramnet' ); ?>
                </p>
            </div>

            <?php 
                $counter++;
            endwhile;
            wp_reset_postdata();
            ?>
            <?php endif; ?>

    </div>
</section>