<?php
/**
 * Boss Custom Post Type
 *
 * @package RAMNET
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Register Boss Custom Post Type
 */
function ramnet_register_boss_cpt() {
    
    $labels = array(
        'name'                  => __( 'О компании', 'ramnet' ),
        'singular_name'         => __( 'Пост', 'ramnet' ),
        'menu_name'             => __( 'О компании', 'ramnet' ),
        'name_admin_bar'        => __( 'Пост', 'ramnet' ),
        'add_new'               => __( 'Добавить пост', 'ramnet' ),
        'add_new_item'          => __( 'Добавить новый пост', 'ramnet' ),
        'edit_item'             => __( 'Редактировать пост', 'ramnet' ),
        'new_item'              => __( 'Новый пост', 'ramnet' ),
        'view_item'             => __( 'Просмотреть пост', 'ramnet' ),
        'search_items'          => __( 'Поиск постов', 'ramnet' ),
        'not_found'             => __( 'Посты не найдены', 'ramnet' ),
        'not_found_in_trash'    => __( 'В корзине постов нет', 'ramnet' ),
        'featured_image'        => __( 'Изображение поста', 'ramnet' ),
        'set_featured_image'    => __( 'Установить изображение поста', 'ramnet' ),
        'remove_featured_image' => __( 'Удалить изображение поста', 'ramnet' ),
        'use_featured_image'    => __( 'Использовать как изображение поста', 'ramnet' ),
        'archives'              => __( 'Архив постов', 'ramnet' ),
        'insert_into_item'      => __( 'Вставить в пост', 'ramnet' ),
        'uploaded_to_this_item' => __( 'Загружено для этой поста', 'ramnet' ),
        'filter_items_list'     => __( 'Фильтр постов', 'ramnet' ),
        'items_list_navigation' => __( 'Навигация по постам', 'ramnet' ),
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
            'slug'       => 'boss',
            'with_front' => false,
        ),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 22,
        'menu_icon'           => 'dashicons-admin-multisite',
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'custom-fields',
            'page-attributes',
        ),
    );
    
    register_post_type( 'ramnet_boss', $args );
}
add_action( 'init', 'ramnet_register_boss_cpt' );

/**
 * Modify columns in boss list
 */
function ramnet_boss_columns( $columns ) {
    return array(
        'cb'         => '<input type="checkbox" />',
        'title'      => __( 'Название поста', 'ramnet' ),
        'thumbnail' => __( 'Изображение', 'ramnet' ),

    );
}
add_filter( 'manage_ramnet_boss_posts_columns', 'ramnet_boss_columns' );

/**
 * Display custom column data for boss
 */
function ramnet_boss_custom_column( $column, $post_id ) {
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
add_action( 'manage_ramnet_boss_posts_custom_column', 'ramnet_boss_custom_column', 10, 2 );