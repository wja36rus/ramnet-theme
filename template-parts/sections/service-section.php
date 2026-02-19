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
    'meta_key'       => '_service_order',
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
                
                // Получаем мета-поля услуги
                $service_icon = get_post_meta( get_the_ID(), '_service_icon', true );
                $service_price = get_post_meta( get_the_ID(), '_service_price', true );
                $service_duration = get_post_meta( get_the_ID(), '_service_duration', true );
                $features = get_post_meta( get_the_ID(), '_service_features', true );
                
                // Используем заголовок как название услуги
                $service_title = get_the_title();
                
                // Используем контент или отрывок как описание
                $service_description = has_excerpt() ? get_the_excerpt() : get_the_content();
                if ( empty($service_description) ) {
                    $service_description = __( 'Панорамное остекление для комфортного отдыха в любое время года', 'ramnet' );
                }
                
                
            ?>
            
            <div id="service__card_<?php echo $counter; ?>" class="service__card " data-service-id="<?php the_ID(); ?>">
                
                <!-- Номер услуги -->
                <h3 class="service__number"><?php echo str_pad($counter, 2, '0', STR_PAD_LEFT); ?></h3>
                
                <!-- Название услуги -->
                <h4 class="service__card__title"><?php echo esc_html__( wp_strip_all_tags($service_title), 'ramnet' ); ?></h4>
                
                <!-- Скрытый блок с деталями (появляется при наведении) -->
                <div class="service__card__hidden">
                    
                    <hr class="service__hr">
                    
                    <!-- Описание -->
                    <p class="service__card__text">
                        <?php echo esc_html__( wp_strip_all_tags($service_description), 'ramnet' ); ?>
                    </p>
                    
                    <!-- Дополнительная информация, если есть -->
                    <?php if ( ! empty( $service_price ) ) : ?>
                        <p class="service__price"><?php echo esc_html__( $service_price ); ?></p>
                    <?php endif; ?>
                    
                    <!-- Кнопка -->
                    <div class="button__container__service">
                        <button class="button__main" onclick="window.location.href='<?php echo esc_url( get_permalink() ); ?>'">
                            <p class="button__text"><?php echo esc_html__( 'ПОДРОБНЕЕ', 'ramnet' ); ?></p>
                        </button>
                    </div>
                    
                </div>
            </div>
            
            <?php 
                $counter++;
            endwhile;
            wp_reset_postdata();
            ?>
            
        <?php else : ?>
            <!-- Резервный вывод, если услуг нет -->
            
            <!-- Карточка 1: Террасы, веранды -->
            <div id="service__card_1" class="service__card">
                <h3 class="service__number">01</h3>
                <h4 class="service__card__title"><?php echo esc_html__( 'ТЕРРАСЫ, ВЕРАНДЫ', 'ramnet' ); ?></h4>
                <div class="service__card__hidden">
                    <hr class="service__hr">
                    <p class="service__card__text">
                        <?php echo esc_html__( 'Панорамное остекление открытых террас и веранд для комфортного отдыха в любое время года', 'ramnet' ); ?>
                    </p>
                    <div class="button__container__service">
                        <button class="button__main">
                            <p class="button__text"><?php echo esc_html__( 'ПОДРОБНЕЕ', 'ramnet' ); ?></p>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Карточка 2: Беседки -->
            <div id="service__card_2" class="service__card">
                <h3 class="service__number">02</h3>
                <h4 class="service__card__title"><?php echo esc_html__( 'БЕСЕДКИ', 'ramnet' ); ?></h4>
                <div class="service__card__hidden">
                    <hr class="service__hr">
                    <p class="service__card__text">
                        <?php echo esc_html__( 'Панорамное остекление открытых террас и веранд для комфортного отдыха в любое время года', 'ramnet' ); ?>
                    </p>
                    <div class="button__container__service">
                        <button class="button__main">
                            <p class="button__text"><?php echo esc_html__( 'ПОДРОБНЕЕ', 'ramnet' ); ?></p>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Остальные карточки... (можно добавить) -->
            
        <?php endif; ?>
        
    </div>
</section>