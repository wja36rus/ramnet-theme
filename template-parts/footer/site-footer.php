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
            
            // Fallback меню, если меню не создано
            function ramnet_footer_menu_fallback() {
                $services = array(
                    'Подъемное гильотинное остекление',
                    'Раздвижное безрамное остекление',
                    'Раздвижное остекление со стеклопакетом',
                    'Безрамное остекление «книжка», «гармошка»',
                    'Панорамные раздвижные двери HS, LS (порталы)',
                    'Панорамные складные двери «гармошка»',
                    'Алюминиевые окна и двери',
                    'Стеклянные ограждения',
                    'Стеклянные крыши и фасады',
                );
                
                foreach ( $services as $service ) {
                    echo '<a href="#" class="footer__nav__item">' . esc_html( $service ) . '</a>';
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