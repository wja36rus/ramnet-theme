<?php
/**
 * Question Custom Post Type
 *
 * @package RAMNET
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Register Question Custom Post Type
 */
function ramnet_register_question_cpt() {
    
    $labels = array(
        'name'                  => __( 'Вопрос-ответ', 'ramnet' ),
        'singular_name'         => __( 'Пост', 'ramnet' ),
        'menu_name'             => __( 'Вопрос-ответ', 'ramnet' ),
        'name_admin_bar'        => __( 'Пост', 'ramnet' ),
        'add_new'               => __( 'Добавить вопрос', 'ramnet' ),
        'add_new_item'          => __( 'Добавить новый вопрос', 'ramnet' ),
        'edit_item'             => __( 'Редактировать вопрос', 'ramnet' ),
        'new_item'              => __( 'Новый вопрос', 'ramnet' ),
        'view_item'             => __( 'Просмотреть вопрос', 'ramnet' ),
        'search_items'          => __( 'Поиск вопросов', 'ramnet' ),
        'not_found'             => __( 'Посты не найдены', 'ramnet' ),
        'not_found_in_trash'    => __( 'В корзине вопросов нет', 'ramnet' ),
        'archives'              => __( 'Архив вопросов', 'ramnet' ),
        'insert_into_item'      => __( 'Вставить в вопрос', 'ramnet' ),
        'uploaded_to_this_item' => __( 'Загружено для этого вопроса', 'ramnet' ),
        'filter_items_list'     => __( 'Фильтр вопросов', 'ramnet' ),
        'items_list_navigation' => __( 'Навигация по вопросам', 'ramnet' ),
        'items_list'            => __( 'Список вопросов', 'ramnet' ),
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
            'slug'       => 'question',
            'with_front' => false,
        ),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 21,
        'menu_icon'           => 'dashicons-info',
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'custom-fields',
        ),
    );
    
    register_post_type( 'ramnet_question', $args );
}
add_action( 'init', 'ramnet_register_question_cpt' );


/**
 * Modify columns in question list
 */
function ramnet_question_columns( $columns ) {
    return array(
        'cb'        => '<input type="checkbox" />',
        'title'     => __( 'Вопрос', 'ramnet' ),
    );
}
add_filter( 'manage_ramnet_question_posts_columns', 'ramnet_question_columns' );