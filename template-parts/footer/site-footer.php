<?php
/**
 * Site footer template
 *
 * @package RAMNET
 */



// Получаем настройки из Customizer
$phone = get_theme_mod( 'ramnet_phone', '+7 (XXX) XXX-XX-XX' );
$email = get_theme_mod( 'ramnet_email', 'info@zasteklim.ru' );
$address = get_theme_mod( 'ramnet_address', 'Воронеж, ул. Примерная, д. 10' );
$work_hours = get_theme_mod( 'ramnet_work_hours', 'Пн-Пт: 9:30 - 20:00, Сб-Вс: 10:00 - 18:00' );
?>

<footer id="contact">
    <div class="footer__flex">

        <!-- Логотип и описание -->
        <div class="footer__logo">
            <img class="footer__logo__image"
                src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/logo_footer.svg' ); ?>"
                alt="<?php bloginfo( 'name' ); ?>">
            <p class="footer__text"><?php echo esc_html__( 'РАМ.НЕТ', 'ramnet' ); ?></p>
            <p class="footer__text"><?php echo esc_html__( 'Производственная компания с 2011 года', 'ramnet' ); ?></p>
            <p class="footer__text">
                <?php echo esc_html__( 'Производство и монтаж систем панорамного остекления в Воронеже и регионах РФ', 'ramnet' ); ?>
            </p>
        </div>

        <!-- Навигация по услугам -->
        <div class="footer__nav">
            <h2><?php echo esc_html__( 'Услуги', 'ramnet' ); ?></h2>
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'     => false,
                    'items_wrap'     => '%3$s',
                    'depth'          => 1,
                    'fallback_cb'    => 'ramnet_footer_menu_fallback',
                )
            );
            
            function ramnet_footer_menu_fallback() {
            $services = new WP_Query(array(
                'post_type'      => 'ramnet_job',
                'posts_per_page' => -1,
                'orderby'        => 'meta_value_num',
                'order'          => 'ASC',
                'post_status'    => 'publish',
            ));

        if ( $services->have_posts() ) {
            while ( $services->have_posts() ) { 
                $services->the_post();
                $service_title = get_the_title();
                $projects_page_url = get_permalink( 141 );
            
            echo '<a class="footer__nav__item" href='.esc_url( add_query_arg( array('project_id' => get_the_ID()), $projects_page_url) ).'>'.esc_html__( wp_strip_all_tags($service_title), 'ramnet' ),'</a>';

            wp_reset_postdata();
                    }
                }
            }
    ?>
    </div>

        <!-- Контактная информация -->
        <div class="footer__info">

            <!-- Адрес -->
            <div class="footer__info__flex">
                <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/place.svg' ); ?>" alt="">
                <h2><?php echo esc_html__( 'Адрес', 'ramnet' ); ?></h2>
            </div>
            <div class="footer__info__text"><?php echo esc_html( $address ); ?></div>
            <div class="footer__info__text"><?php echo esc_html__( 'Работаем по Воронежу и области', 'ramnet' ); ?>
            </div>

            <!-- Телефон -->
            <div class="footer__info__flex">
                <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/phone.svg' ); ?>" alt="">
                <h2><?php echo esc_html__( 'Телефон', 'ramnet' ); ?></h2>
            </div>
            <div class="footer__info__text">
                <a class="footer__info__href"
                    href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a>
            </div>
            <div class="footer__info__text"><?php echo esc_html__( 'Ежедневно с 9:30 до 20:00', 'ramnet' ); ?></div>

            <!-- Email -->
            <div class="footer__info__flex">
                <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/email.svg' ); ?>" alt="">
                <h2><?php echo esc_html__( 'Email', 'ramnet' ); ?></h2>
            </div>
            <div class="footer__info__text">
                <a class="footer__info__href"
                    href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
            </div>

            <!-- Режим работы -->
            <div class="footer__info__flex">
                <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/time.svg' ); ?>" alt="">
                <h2><?php echo esc_html__( 'Режим работы', 'ramnet' ); ?></h2>
            </div>
            <div class="footer__info__text"><?php echo esc_html( $work_hours ); ?></div>

        </div>
    </div>

    <!-- Копирайт -->
    <div class="footer__offer">
        <p class="footer__offer__text">
            <?php echo esc_html__( 'Вся представленная информация на сайте не является публичной офертой.', 'ramnet' ); ?>
        </p>
        <a href="#" target="_blank" class="footer__docs">
            <?php echo esc_html__( 'Политика в отношении обработки персональных данных', 'ramnet' ); ?>
        </a>
        <br>
        <br>
        <p class="footer_offer__text"><?php echo esc_html( '2026. ' . __( 'Все права защищены.', 'ramnet' ) ); ?></p>
        <p class="footer_offer__text"><?php echo esc_html__( 'Источник изображений:', 'ramnet' ); ?></p>
    </div>
</footer>

<!-- Telegram иконка -->
<div class="telegramm__to__go">
    <div class="telegramm__text"><?php echo esc_html__( 'Напишите нам', 'ramnet' ); ?></div>
    <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/telegramm.svg' ); ?>" alt="Telegram">
</div>