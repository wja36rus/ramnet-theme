<?php
/**
 * Site header template
 *
 * @package RAMNET
 */
?>

<header class="header">
    <div class="header__container">

        <!-- Кнопка заказа звонка -->
        <div class="call__to__action">
            <button class="call__to__action__button"><?php echo esc_html__( 'заказать звонок', 'ramnet' ); ?></button>
            <span class="call__to__action__underline"></span>

            <!-- Форма заказа звонка -->
            <form id="call__to__action__form" novalidate>
                <div class="call__to__action__form__inset">
                    <img class="call__to__action__close"
                        src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/close.svg' ); ?>"
                        alt="<?php esc_attr_e( 'Закрыть', 'ramnet' ); ?>">
                    <h1><?php echo esc_html__( 'Напишите нам и мы вам перезвоним!', 'ramnet' ); ?></h1>

                    <input type="text" name="username" class="form__input"
                        placeholder="<?php echo esc_attr__( 'Имя', 'ramnet' ); ?>">
                    <input name="phone" type="text" class="form__input" placeholder="+7">

                    <div class="button__container__call">
                        <button class="button__main" id="call__to__action__submit">
                            <p class="button__text"><?php echo esc_html__( 'ОТПРАВИТЬ', 'ramnet' ); ?></p>
                        </button>
                    </div>
                </div>

                <div class="call__to__action__form__success">
                    <img class="call__to__action__form__success__image"
                        src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/success.svg' ); ?>"
                        alt="<?php esc_attr_e( 'Успешно', 'ramnet' ); ?>">
                    <h1><?php echo esc_html__( 'Ваше сообщение получено!', 'ramnet' ); ?></h1>
                    <h3><?php echo esc_html__( 'Мы скоро с Вами свяжемся', 'ramnet' ); ?></h3>
                </div>
            </form>
        </div>

        <!-- Логотип -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
            <?php 
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else {
                ?>
            <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/logo.svg' ); ?>"
                alt="<?php bloginfo( 'name' ); ?>" class="logo__image">
            <?php
            }
            ?>
        </a>

        <!-- Меню -->
        <div class="menu" id="menu">
            <button class="menu__toggle" aria-label="<?php esc_attr_e( 'Открыть меню', 'ramnet' ); ?>">
                <span class="menu__icon">
                    <span class="menu__line"></span>
                    <span class="menu__line menu__line--middle"></span>
                    <span class="menu__line"></span>
                </span>
                <span class="menu__text"><?php echo esc_html__( 'меню', 'ramnet' ); ?></span>
            </button>

            <nav class="nav__menu">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => false,
                        'items_wrap'     => '%3$s',
                        'depth'          => 1,
                        'fallback_cb'    => false,
                    )
                );
                ?>
            </nav>
        </div>
    </div>
</header>