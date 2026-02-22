<?php
/**
 * Projects Custom Post Type
 *
 * @package RAMNET
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Register Projects Custom Post Type
 */
function ramnet_register_projects_cpt() {
    
    $labels = array(
        'name'                  => __( 'Проекты', 'ramnet' ),
        'singular_name'         => __( 'Проект', 'ramnet' ),
        'menu_name'             => __( 'Проекты', 'ramnet' ),
        'name_admin_bar'        => __( 'Проект', 'ramnet' ),
        'add_new'               => __( 'Добавить проект', 'ramnet' ),
        'add_new_item'          => __( 'Добавить новый проект', 'ramnet' ),
        'edit_item'             => __( 'Редактировать проект', 'ramnet' ),
        'new_item'              => __( 'Новый проект', 'ramnet' ),
        'view_item'             => __( 'Просмотреть проект', 'ramnet' ),
        'search_items'          => __( 'Поиск проектов', 'ramnet' ),
        'not_found'             => __( 'Проекты не найдены', 'ramnet' ),
        'not_found_in_trash'    => __( 'В корзине проектов нет', 'ramnet' ),
        'featured_image'        => __( 'Изображение проекта', 'ramnet' ),
        'set_featured_image'    => __( 'Установить изображение проекта', 'ramnet' ),
        'remove_featured_image' => __( 'Удалить изображение проекта', 'ramnet' ),
        'use_featured_image'    => __( 'Использовать как изображение проекта', 'ramnet' ),
        'archives'              => __( 'Архив проектов', 'ramnet' ),
        'insert_into_item'      => __( 'Вставить в проект', 'ramnet' ),
        'uploaded_to_this_item' => __( 'Загружено для этого проекта', 'ramnet' ),
        'filter_items_list'     => __( 'Фильтр проектов', 'ramnet' ),
        'items_list_navigation' => __( 'Навигация по проектам', 'ramnet' ),
        'items_list'            => __( 'Список проектов', 'ramnet' ),
    );
    
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'show_in_rest'        => true, // Включает поддержку Gutenberg
        'query_var'           => true,
        'rewrite'             => array(
            'slug'       => 'projects',
            'with_front' => false,
            'pages'      => true,
            'feeds'      => true,
        ),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-portfolio',
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'custom-fields',
            'revisions',
            'page-attributes',
        ),
        'taxonomies'          => array( 'project_category' ),
    );
    
    register_post_type( 'ramnet_project', $args );
}
add_action( 'init', 'ramnet_register_projects_cpt' );

/**
 * Register Project Category Taxonomy
 */
function ramnet_register_project_category() {
    
    $labels = array(
        'name'              => __( 'Категории проектов', 'ramnet' ),
        'singular_name'     => __( 'Категория проекта', 'ramnet' ),
        'search_items'      => __( 'Поиск категорий', 'ramnet' ),
        'all_items'         => __( 'Все категории', 'ramnet' ),
        'parent_item'       => __( 'Родительская категория', 'ramnet' ),
        'parent_item_colon' => __( 'Родительская категория:', 'ramnet' ),
        'edit_item'         => __( 'Редактировать категорию', 'ramnet' ),
        'update_item'       => __( 'Обновить категорию', 'ramnet' ),
        'add_new_item'      => __( 'Добавить новую категорию', 'ramnet' ),
        'new_item_name'     => __( 'Название новой категории', 'ramnet' ),
        'menu_name'         => __( 'Категории', 'ramnet' ),
    );
    
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'query_var'         => true,
        'rewrite'           => array(
            'slug' => 'project-category',
        ),
    );
    
    register_taxonomy( 'project_category', array( 'ramnet_project' ), $args );
}
add_action( 'init', 'ramnet_register_project_category' );

/**
 * Add custom meta boxes for projects
 */
function ramnet_add_project_meta_boxes() {
    add_meta_box(
        'ramnet_project_details',
        __( 'Детали проекта', 'ramnet' ),
        'ramnet_project_details_callback',
        'ramnet_project',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'ramnet_add_project_meta_boxes' );

/**
 * Project details meta box callback
 */
function ramnet_project_details_callback( $post ) {
    wp_nonce_field( 'ramnet_project_details', 'ramnet_project_details_nonce' );
    
    $project_location = get_post_meta( $post->ID, '_project_location', true );
    $project_year = get_post_meta( $post->ID, '_project_year', true );
    ?>

<p>
    <label for="project_location"><?php _e( 'Локация:', 'ramnet' ); ?></label>
    <input type="text" id="project_location" name="project_location"
        value="<?php echo esc_attr( $project_location ); ?>" class="widefat">
</p>

<p>
    <label for="project_year"><?php _e( 'Год реализации:', 'ramnet' ); ?></label>
    <input type="text" id="project_year" name="project_year" value="<?php echo esc_attr( $project_year ); ?>"
        class="widefat">
</p>

<?php
}

/**
 * Save project meta box data
 */
function ramnet_save_project_meta( $post_id ) {
    
    if ( ! isset( $_POST['ramnet_project_details_nonce'] ) ) {
        return;
    }
    
    if ( ! wp_verify_nonce( $_POST['ramnet_project_details_nonce'], 'ramnet_project_details' ) ) {
        return;
    }
    
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    $fields = array(
        'project_location',
        'project_year',
    );
    
    foreach ( $fields as $field ) {
        if ( isset( $_POST[$field] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[$field] ) );
        }
    }
}
add_action( 'save_post_ramnet_project', 'ramnet_save_project_meta' );

/**
 * Modify columns in projects list
 */
function ramnet_project_columns( $columns ) {
    return array(
        'cb'        => '<input type="checkbox" />',
        'title'     => __( 'Название проекта', 'ramnet' ),
        'location'  => __( 'Локация', 'ramnet' ),
        'year'      => __( 'Год', 'ramnet' ),
        'thumbnail' => __( 'Изображение', 'ramnet' ),
        'date'      => __( 'Дата', 'ramnet' ),
    );
}
add_filter( 'manage_ramnet_project_posts_columns', 'ramnet_project_columns' );

/**
 * Display custom column data for projects
 */
function ramnet_project_custom_column( $column, $post_id ) {
    switch ( $column ) {
        case 'location':
            echo esc_html( get_post_meta( $post_id, '_project_location', true ) );
            break;
            
        case 'year':
            echo esc_html( get_post_meta( $post_id, '_project_year', true ) );
            break;
            
        case 'thumbnail':
            if ( has_post_thumbnail( $post_id ) ) {
                echo get_the_post_thumbnail( $post_id, 'thumbnail' );
            } else {
                echo '—';
            }
            break;
    }
}
add_action( 'manage_ramnet_project_posts_custom_column', 'ramnet_project_custom_column', 10, 2 );