<?php
/**
 * Business section template (Для бизнеса)
 *
 * @package RAMNET
 */

 // Получаем услуги из базы данных
$services = new WP_Query(array(
    'post_type'      => 'ramnet_busines',
    'posts_per_page' => -1, // Показываем все услуги
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'post_status'    => 'publish',
));
?>

<section class="business" id="business">
    <div class="bus__container">
        <h4 class="title__business"><?php echo esc_html__( 'Для бизнеса', 'ramnet' ); ?></h4>

        <h1 class="bus__hero">
            <?php echo esc_html__( 'Мы превратили процесс работы', 'ramnet' ); ?><br>
            <?php echo esc_html__( 'в удобный сервис', 'ramnet' ); ?>
        </h1>

        <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/business.jpg' ); ?>"
            alt="<?php esc_attr_e( 'Бизнес остекление', 'ramnet' ); ?>" class="bus__hero__image">

        <div class="bus__cards__wrapper">
        <?php if ( $services->have_posts() ) : ?>
            <?php 
            while ( $services->have_posts() ) : $services->the_post();
                                
                // Используем заголовок как название услуги
                $service_title = get_the_title();
                
                // Используем контент или отрывок как описание
                $service_description = has_excerpt() ? get_the_excerpt() : get_the_content();
                if ( empty($service_description) ) {
                    $service_description = __( 'Панорамное остекление для комфортного отдыха в любое время года', 'ramnet' );
                }
                
            ?>
            <!-- Карточка 1: Энергоэффективность -->
            <div class="bus__card">
                <img class="ml-2" style="width: 55px"
                    src="<?php if (has_post_thumbnail()) {
                        $url = get_the_post_thumbnail_url();
                        echo $url;
                    }?>" alt="<?php echo esc_html__( wp_strip_all_tags($service_title), 'ramnet' ); ?>">
                <span class="bus__title ml-2">
                    <?php echo esc_html__( wp_strip_all_tags($service_title), 'ramnet' ); ?>
                </span>

                <div class="bus__hr__flex">
                    <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/cross.svg' ); ?>" alt="">
                    <div class="bus__hr"></div>
                </div>

                <div class="bus__text ml-2">
                    <?php echo esc_html__( the_content($service_description), 'ramnet' ); ?>
                </div>
            </div>
            <?php 
            endwhile;
            wp_reset_postdata();
            ?>
            <?php endif; ?>

        </div>

        <div class="call__open__form  button__container__bus">
            <button class="button__main__black">
                <p class="button__text"><?php echo esc_html__( 'ПОЛУЧИТЬ КОНСУЛЬТАЦИЮ', 'ramnet' ); ?></p>
            </button>
        </div>
    </div>
</section>