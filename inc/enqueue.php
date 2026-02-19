<?php
/**
 * Enqueue Scripts and Styles
 *
 * @package RAMNET
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Подключение стилей и скриптов
 */
function ramnet_enqueue_scripts() {
    
    // Подключаем шрифты Google
    wp_enqueue_style( 
        'ramnet-google-fonts', 
        'https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap', 
        array(), 
        null 
    );

    // Подключаем основные стили
    wp_enqueue_style( 
        'ramnet-main-style', 
        get_stylesheet_uri(), 
        array(), 
        RAMNET_VERSION 
    );
    
    wp_enqueue_style( 
        'ramnet-index-style', 
        RAMNET_THEME_URI . '/assets/css/index.css', 
        array('ramnet-main-style'), 
        RAMNET_VERSION 
    );
    
    wp_enqueue_style( 
        'ramnet-adaptive-style', 
        RAMNET_THEME_URI . '/assets/css/adaptive.css', 
        array('ramnet-index-style'), 
        RAMNET_VERSION 
    );

    // Подключаем jQuery (используем встроенную версию WordPress)
    wp_enqueue_script( 'jquery' );

    // Подключаем наш главный JS файл
    wp_enqueue_script( 
        'ramnet-main-script', 
        RAMNET_THEME_URI . '/assets/js/main.js', 
        array('jquery'), 
        RAMNET_VERSION, 
        true 
    );

    // Передаем данные из PHP в JavaScript
    wp_localize_script( 
        'ramnet-main-script', 
        'ramnet_ajax', 
        array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'ramnet_nonce' ),
            'site_url' => site_url(),
            'theme_url' => RAMNET_THEME_URI,
        )
    );

    // Подключаем комментарии (если нужны)
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'ramnet_enqueue_scripts' );

/**
 * Подключение стилей для админки
 */
function ramnet_admin_styles() {
    wp_enqueue_style( 
        'ramnet-admin-style', 
        RAMNET_THEME_URI . '/assets/css/admin.css', 
        array(), 
        RAMNET_VERSION 
    );
}
add_action( 'admin_enqueue_scripts', 'ramnet_admin_styles' );

/**
 * Подключение скриптов для кастомайзера
 */
function ramnet_customizer_preview() {
    wp_enqueue_script( 
        'ramnet-customizer-preview', 
        RAMNET_THEME_URI . '/assets/js/customizer-preview.js', 
        array( 'jquery', 'customize-preview' ), 
        RAMNET_VERSION, 
        true 
    );
}
add_action( 'customize_preview_init', 'ramnet_customizer_preview' );

/**
 * Удаляем лишние стили и скрипты
 */
function ramnet_remove_unused_styles() {
    // Удаляем стили для Emoji, если не нужны
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    
    // Удаляем версию WordPress из параметров запроса
    function ramnet_remove_wp_version( $src ) {
        if ( strpos( $src, 'ver=' ) ) {
            $src = remove_query_arg( 'ver', $src );
        }
        return $src;
    }
    add_filter( 'style_loader_src', 'ramnet_remove_wp_version', 9999 );
    add_filter( 'script_loader_src', 'ramnet_remove_wp_version', 9999 );
}
add_action( 'wp_enqueue_scripts', 'ramnet_remove_unused_styles', 9999 );

/**
 * Добавляем defer для скриптов (оптимизация загрузки)
 */
function ramnet_add_defer_attribute( $tag, $handle ) {
    $scripts_to_defer = array( 'ramnet-main-script' );
    
    if ( in_array( $handle, $scripts_to_defer ) ) {
        return str_replace( ' src', ' defer src', $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'ramnet_add_defer_attribute', 10, 2 );