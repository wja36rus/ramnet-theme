<?php
/**
 * Theme Setup Functions
 *
 * @package RAMNET
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Настройки темы после активации
 */
function ramnet_theme_setup() {
    
    // Поддержка переводов
    load_theme_textdomain( 'ramnet', RAMNET_THEME_DIR . '/languages' );

    // Регистрация меню
    register_nav_menus(
        array(
            'primary' => esc_html__( 'Главное меню', 'ramnet' ),
            'footer'  => esc_html__( 'Меню в подвале', 'ramnet' ),
        )
    );

    // Поддержка миниатюр записей
    add_theme_support( 'post-thumbnails' );
    
    // Добавляем свои размеры изображений
    add_image_size( 'ramnet-project-thumb', 600, 400, true );
    add_image_size( 'ramnet-service-thumb', 800, 600, true );
    add_image_size( 'ramnet-testimonial-thumb', 100, 100, true );

    // Поддержка кастомного логотипа
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 62,
            'width'       => 141,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => array( 'site-title', 'site-description' ),
        )
    );

    // Поддержка HTML5
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Поддержка Title Tag
    add_theme_support( 'title-tag' );

    // Поддержка кастомного фона
    add_theme_support(
        'custom-background',
        array(
            'default-color' => '282828',
        )
    );

    // Поддержка кастомного хедера
    add_theme_support(
        'custom-header',
        array(
            'default-image' => '',
            'width'         => 1920,
            'height'        => 1080,
            'flex-height'   => true,
        )
    );

    // Поддержка широких изображений
    add_theme_support( 'align-wide' );

    // Поддержка редактора блоков (Gutenberg)
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'responsive-embeds' );
    
    // Отключаем поддержку блоков, если не нужны
    // remove_theme_support( 'core-block-patterns' );

    // Поддержка виджетов
    add_theme_support( 'widgets' );

    // Поддержка RSS лент
    add_theme_support( 'automatic-feed-links' );

    // Поддержка selective refresh для виджетов
    add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'ramnet_theme_setup' );

/**
 * Установка контента по умолчанию при активации темы
 */
function ramnet_default_content() {
    // Создаем главную страницу, если её нет
    if ( ! get_option( 'page_on_front' ) ) {
        $front_page = array(
            'post_type'    => 'page',
            'post_title'   => 'Главная',
            'post_content' => '',
            'post_status'  => 'publish',
            'post_author'  => 1,
        );
        
        $front_page_id = wp_insert_post( $front_page );
        
        if ( $front_page_id && ! is_wp_error( $front_page_id ) ) {
            update_option( 'page_on_front', $front_page_id );
            update_option( 'show_on_front', 'page' );
        }
    }
}
add_action( 'after_switch_theme', 'ramnet_default_content' );

/**
 * Установка максимальной ширины контента
 */
function ramnet_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'ramnet_content_width', 1280 );
}
add_action( 'after_setup_theme', 'ramnet_content_width', 0 );