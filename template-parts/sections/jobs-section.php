<?php
/**
 * Jobs section template (Как остекляем)
 *
 * @package RAMNET
 */

 // Получаем услуги из базы данных
$services = new WP_Query(array(
    'post_type'      => 'ramnet_job',
    'posts_per_page' => -1, // Показываем все услуги
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'post_status'    => 'publish',
));
?>

<section class="jobs" id="jobs">
    <div class="jobs__container">
        <h4 class="title__job"><?php echo esc_html__( 'Как остекляем', 'ramnet' ); ?></h4>

        <!-- Левая колонка с названиями технологий -->
        <div class="jobs__wrapper">

        <?php if ( $services->have_posts() ) : ?>
            <?php 
            $counter = 1;
            while ( $services->have_posts() ) : $services->the_post();
                                
                // Используем заголовок как название услуги
                $service_title = get_the_title();
                
            ?>
            <div data-attribute="<?php echo $counter;?>" class="jobs__items <?php if($counter === 1) {echo "active";}?>">
                 <?php echo esc_html__( wp_strip_all_tags($service_title), 'ramnet' ); ?>
            </div>
        
        <?php 
            $counter++;
        endwhile;
        wp_reset_postdata();
        ?>
        <?php endif; ?>
        </div>

        <?php if ( $services->have_posts() ) : ?>
            <?php 
            $counters = 1;
            while ( $services->have_posts() ) : $services->the_post();
                                
                // Используем заголовок как название услуги
                $service_title = get_the_title();
                
                // Используем контент или отрывок как описание
                $service_description = has_excerpt() ? get_the_excerpt() : get_the_content();
                if ( empty($service_description) ) {
                    $service_description = __( 'Панорамное остекление для комфортного отдыха в любое время года', 'ramnet' );
                }
                
            ?>
        <div id="jobs<?php echo $counters;?>" style="background-image: url(<?php if (has_post_thumbnail()) {
                        $url = get_the_post_thumbnail_url();
                        echo $url;
                    }?>)" class="jobs__item__card <?php if($counters === 1) {echo "active";}?>">
            <div class="jobs__cards">
                <div class="cards__title">
                    <?php echo esc_html__( wp_strip_all_tags($service_title), 'ramnet' ); ?>
                </div>
                <hr class="jobs__hr">
                <div class="cards__text">
                    <?php echo esc_html__( the_content($service_description), 'ramnet' ); ?>
                </div>
                <?php $projects_page_url = get_permalink( 141 );?>
                <div class="button__container__jobs">
                    <button class="button__main" onclick="window.location.href='<?php echo esc_url( add_query_arg( array('project_id' => get_the_ID()), $projects_page_url) ); ?>'">
                        <p class="button__text"><?php echo esc_html__( 'ПОДРОБНЕЕ', 'ramnet' ); ?></p>
                    </button>
                </div>
            </div>
        </div>
        <?php 
            $counters++;
            endwhile;
            wp_reset_postdata();
            ?>
        <?php endif; ?>

    </div>
</section>