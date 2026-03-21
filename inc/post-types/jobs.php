<?php
/**
 * Jobs Custom Post Type
 *
 * @package RAMNET
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Register Jobs Custom Post Type
 */
function ramnet_register_jobs_cpt() {
    
    $labels = array(
        'name'                  => __( 'Как остекляем', 'ramnet' ),
        'singular_name'         => __( 'Услуга', 'ramnet' ),
        'menu_name'             => __( 'Как остекляем', 'ramnet' ),
        'name_admin_bar'        => __( 'Услуга', 'ramnet' ),
        'add_new'               => __( 'Добавить услугу', 'ramnet' ),
        'add_new_item'          => __( 'Добавить новую услугу', 'ramnet' ),
        'edit_item'             => __( 'Редактировать услугу', 'ramnet' ),
        'new_item'              => __( 'Новая услуга', 'ramnet' ),
        'view_item'             => __( 'Просмотреть услугу', 'ramnet' ),
        'search_items'          => __( 'Поиск услуг', 'ramnet' ),
        'not_found'             => __( 'Услуги не найдены', 'ramnet' ),
        'not_found_in_trash'    => __( 'В корзине услуг нет', 'ramnet' ),
        'featured_image'        => __( 'Изображение услуги', 'ramnet' ),
        'set_featured_image'    => __( 'Установить изображение услуги', 'ramnet' ),
        'remove_featured_image' => __( 'Удалить изображение услуги', 'ramnet' ),
        'use_featured_image'    => __( 'Использовать как изображение услуги', 'ramnet' ),
        'archives'              => __( 'Архив услуг', 'ramnet' ),
        'insert_into_item'      => __( 'Вставить в услугу', 'ramnet' ),
        'uploaded_to_this_item' => __( 'Загружено для этой услуги', 'ramnet' ),
        'filter_items_list'     => __( 'Фильтр услуг', 'ramnet' ),
        'items_list_navigation' => __( 'Навигация по услугам', 'ramnet' ),
        'items_list'            => __( 'Список услуг', 'ramnet' ),
    );
    
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'show_in_rest'        => true,
        'query_var'           => true,
        'rewrite'             => array(
            'slug'       => 'jobs',
            'with_front' => false,
        ),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 22,
        'menu_icon'           => 'dashicons-media-text',
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'custom-fields',
            'page-attributes',
        ),
    );
    
    register_post_type( 'ramnet_job', $args );
}
add_action( 'init', 'ramnet_register_jobs_cpt' );

/**
 * Add custom meta boxes for jobs
 */
function ramnet_add_job_meta_boxes() {
    add_meta_box(
        'ramnet_job_details',
        __( 'Наполнение страницы услуги', 'ramnet' ),
        'ramnet_job_details_callback',
        'ramnet_job',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'ramnet_add_job_meta_boxes' );

/**
 * Job details meta box callback
 */
function ramnet_job_details_callback( $post ) {
    wp_nonce_field( 'ramnet_job_details', 'ramnet_job_details_nonce' );
    
    // Основные поля
    $job_title = get_post_meta( $post->ID, '_job_title', true );
    
    // Поля списка
    $list_line_1 = get_post_meta( $post->ID, '_list_line_1', true );
    $list_line_2 = get_post_meta( $post->ID, '_list_line_2', true );
    $list_line_3 = get_post_meta( $post->ID, '_list_line_3', true );
    $list_line_4 = get_post_meta( $post->ID, '_list_line_4', true );
    ?>

    <h3><?php _e( 'Основная информация', 'ramnet' ); ?></h3>
    <p>
        <label for="job_title"><?php _e( 'Заголовок:', 'ramnet' ); ?></label>
        <input type="text" id="job_title" name="job_title" value="<?php echo esc_attr( $job_title ); ?>" class="widefat">
    </p>

    <h3><?php _e( 'Список', 'ramnet' ); ?></h3>
    <p>
        <label for="list_line_1"><?php _e( 'Список строка 1:', 'ramnet' ); ?></label>
        <input type="text" id="list_line_1" name="list_line_1" value="<?php echo esc_attr( $list_line_1 ); ?>" class="widefat">
    </p>
    <p>
        <label for="list_line_2"><?php _e( 'Список строка 2:', 'ramnet' ); ?></label>
        <input type="text" id="list_line_2" name="list_line_2" value="<?php echo esc_attr( $list_line_2 ); ?>" class="widefat">
    </p>
    <p>
        <label for="list_line_3"><?php _e( 'Список строка 3:', 'ramnet' ); ?></label>
        <input type="text" id="list_line_3" name="list_line_3" value="<?php echo esc_attr( $list_line_3 ); ?>" class="widefat">
    </p>
    <p>
        <label for="list_line_4"><?php _e( 'Список строка 4:', 'ramnet' ); ?></label>
        <input type="text" id="list_line_4" name="list_line_4" value="<?php echo esc_attr( $list_line_4 ); ?>" class="widefat">
    </p>

<?php
}

/**
 * Save job meta box data
 */
function ramnet_save_job_meta( $post_id ) {
    
    if ( ! isset( $_POST['ramnet_job_details_nonce'] ) ) {
        return;
    }
    
    if ( ! wp_verify_nonce( $_POST['ramnet_job_details_nonce'], 'ramnet_job_details' ) ) {
        return;
    }
    
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    $fields = array(
        // Основные поля
        'job_title',
        
        // Поля списка
        'list_line_1',
        'list_line_2',
        'list_line_3',
        'list_line_4',
    );
    
    foreach ( $fields as $field ) {
        if ( isset( $_POST[$field] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[$field] ) );
        }
    }
}
add_action( 'save_post_ramnet_job', 'ramnet_save_job_meta' );

/**
 * Modify columns in jobs list
 */
function ramnet_job_columns( $columns ) {
    return array(
        'cb'         => '<input type="checkbox" />',
        'title'      => __( 'Название услуги', 'ramnet' ),
        'thumbnail' => __( 'Изображение', 'ramnet' ),
    );
}
add_filter( 'manage_ramnet_job_posts_columns', 'ramnet_job_columns' );

/**
 * Display custom column data for jobs
 */
function ramnet_job_custom_column( $column, $post_id ) {
    switch ( $column ) {
        case 'thumbnail':
            if ( has_post_thumbnail( $post_id ) ) {
                echo get_the_post_thumbnail( $post_id, 'thumbnail' );
            } else {
                echo '—';
            }
            break;
    }
}
add_action( 'manage_ramnet_job_posts_custom_column', 'ramnet_job_custom_column', 10, 2 );