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
                                
                // Получаем мета-поля услуги
                $service_title = get_post_meta( get_the_ID(), '_job_title', true );
                $service_description1 = get_post_meta( get_the_ID(), '_list_line_1', true );
                $service_description2 = get_post_meta( get_the_ID(), '_list_line_2', true );
                $service_description3 = get_post_meta( get_the_ID(), '_list_line_3', true );
                $service_description4 = get_post_meta( get_the_ID(), '_list_line_4', true );
                
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
                <?php if($service_description1):?>
                    <?php echo esc_html__( wp_strip_all_tags($service_description1), 'ramnet' ); ?>
                <?php endif; ?>
                <?php if($service_description2):?>
                    <?php echo esc_html__( wp_strip_all_tags($service_description2), 'ramnet' ); ?>
                <?php endif; ?>
                <?php if($service_description3):?>
                    <?php echo esc_html__( wp_strip_all_tags($service_description3), 'ramnet' ); ?>
                <?php endif; ?>
                <?php if($service_description4):?>
                    <?php echo esc_html__( wp_strip_all_tags($service_description4), 'ramnet' ); ?>
                <?php endif; ?>
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