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
 * Add SVG favicon
 */
function ramnet_add_favicon() {
    // Путь к папке favicon в корне темы
    $favicon_path = get_template_directory_uri() . '/favicon/';
    
    // Проверяем существует ли SVG файл
    $svg_favicon = $favicon_path . 'favicon.svg';
    
    echo '<link rel="icon" type="image/svg+xml" href="' . esc_url($svg_favicon) . '">' . "\n";
    echo '<link rel="alternate icon" href="' . esc_url($favicon_path . 'favicon.ico') . '">' . "\n";
    echo '<link rel="apple-touch-icon" href="' . esc_url($favicon_path . 'apple-touch-icon.png') . '">' . "\n";
    
    // Для современных браузеров
    echo '<link rel="manifest" href="' . esc_url($favicon_path . 'site.webmanifest') . '">' . "\n";
}
add_action('wp_head', 'ramnet_add_favicon');

/**
 * Также добавляем фавикон в админку
 */
function ramnet_admin_favicon() {
    $favicon_path = get_template_directory_uri() . '/favicon/favicon.svg';
    echo '<link rel="icon" type="image/svg+xml" href="' . esc_url($favicon_path) . '">' . "\n";
}
add_action('admin_head', 'ramnet_admin_favicon');

/**
 * И для страницы входа
 */
function ramnet_login_favicon() {
    $favicon_path = get_template_directory_uri() . '/favicon/favicon.svg';
    echo '<link rel="icon" type="image/svg+xml" href="' . esc_url($favicon_path) . '">' . "\n";
}
add_action('login_head', 'ramnet_login_favicon');

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

/**
 * Add duplicate action link to posts list
 */
function ramnet_add_duplicate_action_link( $actions, $post ) {
    if ( $post->post_type === 'ramnet_job' && current_user_can( 'edit_posts' ) ) {
        $actions['duplicate'] = '<a href="' . wp_nonce_url( admin_url( 'admin.php?action=ramnet_duplicate_job&post=' . $post->ID ), 'ramnet_duplicate_job_' . $post->ID ) . '" title="' . __( 'Дублировать услугу', 'ramnet' ) . '">' . __( 'Дублировать', 'ramnet' ) . '</a>';
    }
    return $actions;
}
add_filter( 'post_row_actions', 'ramnet_add_duplicate_action_link', 10, 2 );

/**
 * Handle duplicate action
 */
function ramnet_duplicate_job_action() {
    if ( ! isset( $_GET['post'] ) || ! isset( $_GET['_wpnonce'] ) ) {
        wp_die( __( 'Недостаточно параметров для дублирования.', 'ramnet' ) );
    }
    
    $post_id = absint( $_GET['post'] );
    
    if ( ! wp_verify_nonce( $_GET['_wpnonce'], 'ramnet_duplicate_job_' . $post_id ) ) {
        wp_die( __( 'Неверный nonce.', 'ramnet' ) );
    }
    
    if ( ! current_user_can( 'edit_posts' ) ) {
        wp_die( __( 'У вас нет прав для дублирования.', 'ramnet' ) );
    }
    
    $post = get_post( $post_id );
    
    if ( ! $post || $post->post_type !== 'ramnet_job' ) {
        wp_die( __( 'Пост не найден или неверный тип.', 'ramnet' ) );
    }
    
    // Создаем дубликат поста
    $new_post_id = ramnet_create_post_duplicate( $post );
    
    if ( $new_post_id && ! is_wp_error( $new_post_id ) ) {
        // Перенаправляем на страницу редактирования нового поста
        wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id . '&duplicated=1' ) );
        exit;
    } else {
        wp_die( __( 'Ошибка при дублировании поста.', 'ramnet' ) );
    }
}
add_action( 'admin_action_ramnet_duplicate_job', 'ramnet_duplicate_job_action' );

/**
 * Create duplicate of post with all meta data
 */
function ramnet_create_post_duplicate( $post ) {
    // Подготавливаем данные для нового поста
    $new_post_args = array(
        'post_title'     => $post->post_title . ' (Копия)',
        'post_name'      => '',
        'post_status'    => 'draft', // Создаем как черновик
        'post_type'      => $post->post_type,
        'post_author'    => get_current_user_id(),
        'post_content'   => $post->post_content,
        'post_excerpt'   => $post->post_excerpt,
        'post_parent'    => $post->post_parent,
        'menu_order'     => $post->menu_order,
        'comment_status' => $post->comment_status,
        'ping_status'    => $post->ping_status,
    );
    
    // Вставляем новый пост
    $new_post_id = wp_insert_post( $new_post_args );
    
    if ( $new_post_id && ! is_wp_error( $new_post_id ) ) {
        // Копируем все мета-поля
        $meta_fields = get_post_meta( $post->ID );
        
        foreach ( $meta_fields as $meta_key => $meta_values ) {
            // Пропускаем системные поля
            if ( in_array( $meta_key, array( '_edit_lock', '_edit_last', '_wp_old_slug' ) ) ) {
                continue;
            }
            
            foreach ( $meta_values as $meta_value ) {
                add_post_meta( $new_post_id, $meta_key, maybe_unserialize( $meta_value ) );
            }
        }
        
        // Копируем миниатюру (featured image)
        $thumbnail_id = get_post_thumbnail_id( $post->ID );
        if ( $thumbnail_id ) {
            set_post_thumbnail( $new_post_id, $thumbnail_id );
        }
        
        // Копируем таксономии (категории, метки и т.д.)
        $taxonomies = get_object_taxonomies( $post->post_type );
        foreach ( $taxonomies as $taxonomy ) {
            $terms = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'slugs' ) );
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                wp_set_object_terms( $new_post_id, $terms, $taxonomy );
            }
        }
        
        // Копируем галерею из ACF или других полей (если нужно)
        // Здесь можно добавить дополнительную логику для копирования галерей
    }
    
    return $new_post_id;
}

/**
 * Add notice when post is duplicated
 */
function ramnet_duplicate_post_notice() {
    if ( isset( $_GET['duplicated'] ) && $_GET['duplicated'] == 1 ) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p><?php _e( 'Пост успешно продублирован!', 'ramnet' ); ?></p>
        </div>
        <?php
    }
}
add_action( 'admin_notices', 'ramnet_duplicate_post_notice' );

/**
 * Optional: Add duplicate button to admin bar when editing post
 */
function ramnet_add_duplicate_button_to_admin_bar( $wp_admin_bar ) {
    global $post;
    
    if ( ! is_admin() && ! is_singular( 'ramnet_job' ) ) {
        return;
    }
    
    if ( ! current_user_can( 'edit_posts' ) ) {
        return;
    }
    
    $post_id = is_admin() && isset( $_GET['post'] ) ? absint( $_GET['post'] ) : ( isset( $post->ID ) ? $post->ID : 0 );
    
    if ( ! $post_id ) {
        return;
    }
    
    $duplicate_url = wp_nonce_url( admin_url( 'admin.php?action=ramnet_duplicate_job&post=' . $post_id ), 'ramnet_duplicate_job_' . $post_id );
    
    $wp_admin_bar->add_node( array(
        'id'    => 'duplicate_post',
        'title' => __( 'Дублировать услугу', 'ramnet' ),
        'href'  => $duplicate_url,
        'meta'  => array(
            'class' => 'duplicate-post-link',
        ),
    ) );
}
add_action( 'admin_bar_menu', 'ramnet_add_duplicate_button_to_admin_bar', 100 );

/**
 * Add menu_order column to admin list
 */
function ramnet_add_menu_order_column( $columns ) {
    $columns['menu_order'] = __( 'Порядок', 'ramnet' );
    return $columns;
}
add_filter( 'manage_ramnet_job_posts_columns', 'ramnet_add_menu_order_column' );

/**
 * Display menu_order value in column
 */
function ramnet_display_menu_order_column( $column, $post_id ) {
    if ( $column === 'menu_order' ) {
        $order = get_post_field( 'menu_order', $post_id );
        echo $order ? esc_html( $order ) : '0';
    }
}
add_action( 'manage_ramnet_job_posts_custom_column', 'ramnet_display_menu_order_column', 10, 2 );

/**
 * Make menu_order column sortable
 */
function ramnet_make_menu_order_sortable( $columns ) {
    $columns['menu_order'] = 'menu_order';
    return $columns;
}
add_filter( 'manage_edit-ramnet_job_sortable_columns', 'ramnet_make_menu_order_sortable' );