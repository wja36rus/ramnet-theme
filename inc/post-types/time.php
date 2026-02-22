<?php
/**
 * Time Custom Post Type
 *
 * @package RAMNET
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Register Time Custom Post Type
 */
function ramnet_register_time_cpt() {
    
    $labels = array(
        'name'                  => __( 'Ценности', 'ramnet' ),
        'singular_name'         => __( 'Пост', 'ramnet' ),
        'menu_name'             => __( 'Ценности', 'ramnet' ),
        'name_admin_bar'        => __( 'Пост', 'ramnet' ),
        'add_new'               => __( 'Добавить пост', 'ramnet' ),
        'add_new_item'          => __( 'Добавить новый пост', 'ramnet' ),
        'edit_item'             => __( 'Редактировать пост', 'ramnet' ),
        'new_item'              => __( 'Новый пост', 'ramnet' ),
        'view_item'             => __( 'Просмотреть пост', 'ramnet' ),
        'search_items'          => __( 'Поиск постов', 'ramnet' ),
        'not_found'             => __( 'Посты не найдены', 'ramnet' ),
        'not_found_in_trash'    => __( 'В корзине постов нет', 'ramnet' ),
        'archives'              => __( 'Архив постов', 'ramnet' ),
        'insert_into_item'      => __( 'Вставить в пост', 'ramnet' ),
        'uploaded_to_this_item' => __( 'Загружено для этого поста', 'ramnet' ),
        'filter_items_list'     => __( 'Фильтр постов', 'ramnet' ),
        'items_list_navigation' => __( 'Навигация по услугам', 'ramnet' ),
        'items_list'            => __( 'Список постов', 'ramnet' ),
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
            'slug'       => 'time',
            'with_front' => false,
        ),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 22,
        'menu_icon'           => 'dashicons-star-filled',
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'custom-fields',
            'page-attributes',
        ),
    );
    
    register_post_type( 'ramnet_time', $args );
}
add_action( 'init', 'ramnet_register_time_cpt' );



/**
 * Modify columns in time list
 */
function ramnet_time_columns( $columns ) {
    return array(
        'cb'         => '<input type="checkbox" />',
        'title'      => __( 'Название поста', 'ramnet' ),
        'content'       => __( 'Описание', 'ramnet' ),
    );
}
add_filter( 'manage_ramnet_time_posts_columns', 'ramnet_time_columns' );