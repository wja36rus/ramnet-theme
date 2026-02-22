<?php
/**
 * Hero section template
 *
 * @package RAMNET
 */

// Получаем настройки из Customizer
$hero_title_1 = get_theme_mod( 'ramnet_hero_title_1', 'СИСТЕМЫ' );
$hero_title_2 = get_theme_mod( 'ramnet_hero_title_2', 'ОСТЕКЛЕНИЯ' );
$hero_subtitle_1 = get_theme_mod( 'ramnet_hero_subtitle_1', 'от производителя за 30 дней' );
$hero_subtitle_2 = get_theme_mod( 'ramnet_hero_subtitle_2', 'в Воронеже и ВО' );

// Получаем фоновое изображение
$hero_bg_url = get_theme_mod( 'background_image' );
?>

<section class="hero">
    <div class="hero__background">
        <img src="<?php echo esc_url( $hero_bg_url ); ?>"
            alt="<?php esc_attr_e( 'Фоновое изображение остекления', 'ramnet' ); ?>" class="hero__background-image">
    </div>

    <div class="hero__content">
        <h1 class="hero__title">
            <span class="hero__title-line"><?php echo esc_html( $hero_title_1 ); ?></span>
            <span class="hero__title-line-second"><?php echo esc_html( $hero_title_2 ); ?></span>
            <span class="hero__subtitle"><?php echo esc_html( $hero_subtitle_1 ); ?></span>
            <span class="hero__subtitle_second"><?php echo esc_html( $hero_subtitle_2 ); ?></span>
        </h1>

        <ul class="features">
            <li class="features__item">
                <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/divider.svg' ); ?>" alt="">
                <span
                    class="features__text"><?php echo esc_html__( 'Эстетика, функциональность и комфорт Вашего пространства', 'ramnet' ); ?></span>
            </li>
            <li class="features__item">
                <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/divider.svg' ); ?>" alt="">
                <span
                    class="features__text"><?php echo esc_html__( 'Под ключ: от проекта до изготовления и монтажа конструкций', 'ramnet' ); ?></span>
            </li>
            <li class="features__item">
                <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/divider.svg' ); ?>" alt="">
                <span
                    class="features__text"><?php echo esc_html__( 'Сервисное обслуживание 12 месяцев БЕСПЛАТНО', 'ramnet' ); ?></span>
            </li>
        </ul>

        <div class="button__container__main">
            <button class="button__main">
                <p class="button__text"><?php echo esc_html__( 'РАССЧИТАТЬ СТОИМОСТЬ', 'ramnet' ); ?></p>
            </button>
        </div>
    </div>
</section>