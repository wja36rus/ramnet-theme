<?php
/**
 * WordPress Customizer Settings
 *
 * @package RAMNET
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Добавление секций и настроек в Customizer
 */
function ramnet_customize_register( $wp_customize ) {
    
    /* ========== Секция: Основные настройки ========== */
    $wp_customize->add_section( 'ramnet_main_settings', array(
        'title'       => __( 'Основные настройки', 'ramnet' ),
        'priority'    => 30,
        'description' => __( 'Настройте основные параметры сайта', 'ramnet' ),
    ) );

    // Телефон
    $wp_customize->add_setting( 'ramnet_phone', array(
        'default'           => '+7 (XXX) XXX-XX-XX',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'ramnet_phone', array(
        'label'       => __( 'Телефон', 'ramnet' ),
        'section'     => 'ramnet_main_settings',
        'type'        => 'text',
    ) );

    // Email
    $wp_customize->add_setting( 'ramnet_email', array(
        'default'           => 'info@zasteklim.ru',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'ramnet_email', array(
        'label'       => __( 'Email', 'ramnet' ),
        'section'     => 'ramnet_main_settings',
        'type'        => 'email',
    ) );

    // Адрес
    $wp_customize->add_setting( 'ramnet_address', array(
        'default'           => 'Воронеж, ул. Примерная, д. 10',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'ramnet_address', array(
        'label'       => __( 'Адрес', 'ramnet' ),
        'section'     => 'ramnet_main_settings',
        'type'        => 'text',
    ) );

    // Режим работы
    $wp_customize->add_setting( 'ramnet_work_hours', array(
        'default'           => 'Пн-Пт: 9:30 - 20:00, Сб-Вс: 10:00 - 18:00',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( 'ramnet_work_hours', array(
        'label'       => __( 'Режим работы', 'ramnet' ),
        'section'     => 'ramnet_main_settings',
        'type'        => 'text',
    ) );

    /* ========== Секция: Социальные сети ========== */
    $wp_customize->add_section( 'ramnet_social_settings', array(
        'title'       => __( 'Социальные сети', 'ramnet' ),
        'priority'    => 31,
    ) );

    // Telegram
    $wp_customize->add_setting( 'ramnet_telegram', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'ramnet_telegram', array(
        'label'       => __( 'Telegram', 'ramnet' ),
        'section'     => 'ramnet_social_settings',
        'type'        => 'url',
    ) );

    // WhatsApp
    $wp_customize->add_setting( 'ramnet_whatsapp', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( 'ramnet_whatsapp', array(
        'label'       => __( 'WhatsApp', 'ramnet' ),
        'section'     => 'ramnet_social_settings',
        'type'        => 'url',
    ) );

    /* ========== Секция: Hero секция ========== */
    $wp_customize->add_section( 'ramnet_hero_settings', array(
        'title'       => __( 'Главный экран (Hero)', 'ramnet' ),
        'priority'    => 32,
    ) );

    // Заголовок
    $wp_customize->add_setting( 'ramnet_hero_title_1', array(
        'default'           => 'СИСТЕМЫ',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'ramnet_hero_title_1', array(
        'label'       => __( 'Заголовок (первая строка)', 'ramnet' ),
        'section'     => 'ramnet_hero_settings',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'ramnet_hero_title_2', array(
        'default'           => 'ОСТЕКЛЕНИЯ',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'ramnet_hero_title_2', array(
        'label'       => __( 'Заголовок (вторая строка)', 'ramnet' ),
        'section'     => 'ramnet_hero_settings',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'ramnet_hero_subtitle_1', array(
        'default'           => 'от производителя за 30 дней',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'ramnet_hero_subtitle_1', array(
        'label'       => __( 'Подзаголовок (первая строка)', 'ramnet' ),
        'section'     => 'ramnet_hero_settings',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'ramnet_hero_subtitle_2', array(
        'default'           => 'в Воронеже и ВО',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'ramnet_hero_subtitle_2', array(
        'label'       => __( 'Подзаголовок (вторая строка)', 'ramnet' ),
        'section'     => 'ramnet_hero_settings',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'ramnet_hero_about_line_1', array(
        'default'           => 'эстетика, функциональность и комфорт Вашего пространства',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'ramnet_hero_about_line_1', array(
        'label'       => __( 'Описание (первая строка)', 'ramnet' ),
        'section'     => 'ramnet_hero_settings',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'ramnet_hero_about_line_2', array(
        'default'           => 'под ключ: от проекта до изготовления и монтажа конструкций',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'ramnet_hero_about_line_2', array(
        'label'       => __( 'Описание (первая строка)', 'ramnet' ),
        'section'     => 'ramnet_hero_settings',
        'type'        => 'text',
    ) );

    $wp_customize->add_setting( 'ramnet_hero_about_line_3', array(
        'default'           => 'сервисное обслуживание 12 месяцев БЕСПЛАТНО',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'ramnet_hero_about_line_3', array(
        'label'       => __( 'Описание (первая строка)', 'ramnet' ),
        'section'     => 'ramnet_hero_settings',
        'type'        => 'text',
    ) );

    // Фоновое изображение
    $wp_customize->add_setting( 'ramnet_hero_background', array(
        'default'           => '',
        'sanitize_callback' => 'absint',
    ) );

    $wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ramnet_hero_background', array(
        'label'       => __( 'Фоновое изображение', 'ramnet' ),
        'section'     => 'ramnet_hero_settings',
        'mime_type'   => 'image',
    ) ) );

    /* ========== Секция: Цвета ========== */
    $wp_customize->add_setting( 'ramnet_primary_color', array(
        'default'           => '#282828',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ramnet_primary_color', array(
        'label'       => __( 'Основной цвет', 'ramnet' ),
        'section'     => 'colors',
        'settings'    => 'ramnet_primary_color',
    ) ) );

    $wp_customize->add_setting( 'ramnet_accent_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport'         => 'postMessage',
    ) );

    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'ramnet_accent_color', array(
        'label'       => __( 'Акцентный цвет', 'ramnet' ),
        'section'     => 'colors',
        'settings'    => 'ramnet_accent_color',
    ) ) );
}
add_action( 'customize_register', 'ramnet_customize_register' );

/**
 * Вывод настроек Customizer в CSS
 */
function ramnet_customizer_css() {
    ?>
<style type="text/css">
:root {
    --primary-color: <?php echo get_theme_mod('ramnet_primary_color', '#282828');
    ?>;
    --accent-color: <?php echo get_theme_mod('ramnet_accent_color', '#ffffff');
    ?>;
}

.header {
    background-color: var(--primary-color);
}

.button__main {
    border-top-color: var(--accent-color);
    border-right-color: var(--accent-color);
}

.button__main:after {
    background: var(--accent-color);
}
</style>
<?php
}
add_action( 'wp_head', 'ramnet_customizer_css' );