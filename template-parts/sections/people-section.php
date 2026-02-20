<?php
/**
 * People section template (Отзывы)
 *
 * @package RAMNET
 */

 // Получаем отзывы из базы данных
$services = new WP_Query(array(
    'post_type'      => 'ramnet_testimonial',
    'posts_per_page' => -1, // Показываем все отзывы
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'post_status'    => 'publish',
));
?>

<section class="people">
    <div class="people__container">

        <h4 class="title__people"><?php echo esc_html__( 'Отзывы', 'ramnet' ); ?></h4>

        <div class="people__card__wrapper">
        <?php if ( $services->have_posts() ) : ?>
            <?php 
            $counter = 1;
            while ( $services->have_posts() ) : $services->the_post();
                
                // Получаем мета-поля услуги
                $client_position = get_post_meta( get_the_ID(), '_client_position', true );
                $client_location = get_post_meta( get_the_ID(), '_client_location', true );
                $rating = get_post_meta( get_the_ID(), '_rating', true );
                
                // Используем заголовок как название услуги
                $service_title = get_the_title();
                
                // Используем контент или отрывок как описание
                $service_description = has_excerpt() ? get_the_excerpt() : get_the_content();
                if ( empty($service_description) ) {
                    $service_description = __( 'Панорамное остекление для комфортного отдыха в любое время года', 'ramnet' );
                }
                
                
            ?>

            <div class="people__card">
                <div class="people__card__logo_line">
                    <div class="people__card__logo"></div>
                    <div class="people__card__starline">
                        <div class="people__card__title__and__start">
                            <h1 class="people__card__title">
                                <?php echo esc_html__( wp_strip_all_tags($service_title), 'ramnet' ); ?>
                            </h1>
                            <div class="people__stars">
                            <?php
                            for ( $i = 1; $i <= 5; $i++ ) {
                                echo $i <= $rating ? '★' : '☆';
                            }
                            ?>
                            </div>
                            <!-- <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/star.svg' ); ?>"
                                alt=""> -->
                        </div>
                        <p class="people__card__boss">
                            <?php echo esc_html__( wp_strip_all_tags($client_position), 'ramnet' ); ?>
                        </p>
                        <p class="people__card__place">
                            <?php echo esc_html__( wp_strip_all_tags($client_location), 'ramnet' ); ?>
                        </p>
                    </div>
                </div>
                <div class="people__card__text">
                    <?php echo esc_html__( wp_strip_all_tags($service_description), 'ramnet' ); ?>
                </div>
            </div>

            <?php 
                $counter++;
            endwhile;
            wp_reset_postdata();
            ?>
            <?php endif; ?>
            

        </div>

        <!-- Кнопка "Читать все отзывы" -->
        <div class="button__container__people" id="show__people">
            <button class="button__main__black">
                <p class="button__text"><?php echo esc_html__( 'ЧИТАТЬ ВСЕ ОТЗЫВЫ', 'ramnet' ); ?></p>
            </button>
        </div>

    </div>
</section>