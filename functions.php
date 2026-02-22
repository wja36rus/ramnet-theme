<?php
/**
 * RAM.NET Theme Functions
 *
 * @package RAMNET
 */

// Защита от прямого доступа к файлу
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Определяем константы темы для удобства
 */
define( 'RAMNET_VERSION', '1.0.0' );
define( 'RAMNET_THEME_DIR', get_template_directory() );
define( 'RAMNET_THEME_URI', get_template_directory_uri() );

/**
 * Подключаем файлы с настройками темы
 */
require_once RAMNET_THEME_DIR . '/inc/setup.php';
require_once RAMNET_THEME_DIR . '/inc/enqueue.php';
require_once RAMNET_THEME_DIR . '/inc/customizer.php';

/**
 * Добавляем поддержку пользовательских типов записей (Custom Post Types)
 */
require_once RAMNET_THEME_DIR . '/inc/post-types/projects.php';
require_once RAMNET_THEME_DIR . '/inc/post-types/testimonials.php';
require_once RAMNET_THEME_DIR . '/inc/post-types/services.php';
require_once RAMNET_THEME_DIR . '/inc/post-types/question.php';
require_once RAMNET_THEME_DIR . '/inc/post-types/time.php';
require_once RAMNET_THEME_DIR . '/inc/post-types/boss.php';
require_once RAMNET_THEME_DIR . '/inc/post-types/jobs.php';
require_once RAMNET_THEME_DIR . '/inc/post-types/say.php';
require_once RAMNET_THEME_DIR . '/inc/post-types/business.php';
require_once RAMNET_THEME_DIR . '/inc/ajax-handlers.php';

/**
 * Добавляем классы для навигации
 */
require_once RAMNET_THEME_DIR . '/inc/classes/class-walker-nav.php';

/**
 * Изменяем HTML структуру меню под нашу верстку
 */
function ramnet_modify_menu_classes($classes, $item, $args) {
    if($args->theme_location == 'primary') {
        // Оставляем только нужные классы
        $classes = array();
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'ramnet_modify_menu_classes', 10, 3);

function ramnet_modify_menu_link_attrs($atts, $item, $args) {
    if($args->theme_location == 'primary') {
        // Добавляем наш класс к ссылке
        $atts['class'] = 'nav__menu__item';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'ramnet_modify_menu_link_attrs', 10, 3);

function ramnet_modify_menu_wrap($items, $args) {
    if($args->theme_location == 'primary') {
        // Убираем li и оставляем только ссылки
        $items = strip_tags($items, '<a>');
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'ramnet_modify_menu_wrap', 10, 2);