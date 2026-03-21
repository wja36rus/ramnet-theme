<?php
/**
 * Project section template
 *
 * @package RAMNET
 */

 // Получаем услуги из базы данных
$services = new WP_Query(array(
    'post_type'      => 'ramnet_project',
    'posts_per_page' => -1, // Показываем все услуги
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'post_status'    => 'publish',
));
?>

<section class="project" id="project">
    <div class="all__project__container">
<h1 class="all__project__title">
                <?php echo esc_html__( 'Реализованные проекты', 'ramnet' ); ?>
            </h1>
</div>
    <div class="project__wrapper">
            

            <div class="project__columns">  
            
            <?php if ( $services->have_posts() ) : ?>
            <?php 
            while ( $services->have_posts() ) : $services->the_post();
                                
                // Используем заголовок как название услуги
                $service_title = get_the_title();

                // Получаем мета-поля услуги
                $location = get_post_meta( get_the_ID(), '_project_location', true );
                $year = get_post_meta( get_the_ID(), '_project_year', true );

                // Используем контент или отрывок как описание
                $service_description = has_excerpt() ? get_the_excerpt() : get_the_content();
                if ( empty($service_description) ) {
                    $service_description = __( 'Панорамное остекление для комфортного отдыха в любое время года', 'ramnet' );
                }
                
            ?>

            <?php $projects_page_url = get_permalink( 192 );?>
            <!-- Проект 1 -->
            <div onclick="window.location.href='<?php echo esc_url( add_query_arg( array('project_id' => get_the_ID()), $projects_page_url) ); ?>'" style="background-image: url(<?php if (has_post_thumbnail()) {
                        $url = get_the_post_thumbnail_url();
                        echo $url;
                    }?>)" class="all__project__card">
                <div class="all__project__card__inset">
                    <h1 class="all__project__about">
                        <?php echo esc_html__( wp_strip_all_tags($service_title), 'ramnet' ); ?>
                    </h1>
                </div>
            </div>
            
            <?php 
            endwhile;
            wp_reset_postdata();
            ?>
        <?php endif; ?> 
        </div>
        </div>
    </div>
</section>