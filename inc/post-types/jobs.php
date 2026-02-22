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
 * Modify columns in jobs list
 */
function ramnet_job_columns( $columns ) {
    return array(
        'cb'         => '<input type="checkbox" />',
        'title'      => __( 'Название услуги', 'ramnet' ),
    );
}
add_filter( 'manage_ramnet_job_posts_columns', 'ramnet_job_columns' );
