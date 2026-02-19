<?php
/**
 * AJAX Handlers for the theme
 *
 * @package RAMNET
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Handle form submission via AJAX
 */
function ramnet_handle_form_submission() {
    
    // Verify nonce
    if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'ramnet_nonce' ) ) {
        wp_send_json_error( 'Invalid nonce' );
    }
    
    // Sanitize input
    $name = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
    $phone = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';
    
    // Validate
    if ( empty( $name ) || empty( $phone ) ) {
        wp_send_json_error( 'Name and phone are required' );
    }
    
    // Prepare email
    $to = get_option( 'admin_email' );
    $subject = sprintf( __( 'Новая заявка с сайта %s', 'ramnet' ), get_bloginfo( 'name' ) );
    
    $message = sprintf( 
        __( 'Имя: %s\nТелефон: %s\nДата: %s', 'ramnet' ),
        $name,
        $phone,
        current_time( 'mysql' )
    );
    
    $headers = array(
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . get_bloginfo( 'name' ) . ' <' . get_option( 'admin_email' ) . '>'
    );
    
    // Send email
    $mail_sent = wp_mail( $to, $subject, $message, $headers );
    
    // Save to database (optional)
    $post_data = array(
        'post_title'   => sprintf( 'Заявка от %s - %s', $name, current_time( 'd.m.Y H:i' ) ),
        'post_content' => $message,
        'post_status'  => 'publish',
        'post_type'    => 'ramnet_lead',
    );
    
    $post_id = wp_insert_post( $post_data );
    
    if ( $post_id ) {
        update_post_meta( $post_id, '_lead_name', $name );
        update_post_meta( $post_id, '_lead_phone', $phone );
        update_post_meta( $post_id, '_lead_date', current_time( 'mysql' ) );
    }
    
    if ( $mail_sent ) {
        wp_send_json_success( array(
            'message' => __( 'Спасибо! Мы свяжемся с вами в ближайшее время.', 'ramnet' ),
            'post_id' => $post_id
        ) );
    } else {
        wp_send_json_error( __( 'Ошибка при отправке. Пожалуйста, попробуйте позже.', 'ramnet' ) );
    }
}
add_action( 'wp_ajax_ramnet_submit_form', 'ramnet_handle_form_submission' );
add_action( 'wp_ajax_nopriv_ramnet_submit_form', 'ramnet_handle_form_submission' );

/**
 * Register custom post type for leads
 */
function ramnet_register_lead_post_type() {
    
    $labels = array(
        'name'               => __( 'Заявки', 'ramnet' ),
        'singular_name'      => __( 'Заявка', 'ramnet' ),
        'menu_name'          => __( 'Заявки', 'ramnet' ),
        'add_new'            => __( 'Добавить заявку', 'ramnet' ),
        'add_new_item'       => __( 'Добавить новую заявку', 'ramnet' ),
        'edit_item'          => __( 'Редактировать заявку', 'ramnet' ),
        'new_item'           => __( 'Новая заявка', 'ramnet' ),
        'view_item'          => __( 'Просмотреть заявку', 'ramnet' ),
        'search_items'       => __( 'Поиск заявок', 'ramnet' ),
        'not_found'          => __( 'Заявки не найдены', 'ramnet' ),
        'not_found_in_trash' => __( 'В корзине заявок нет', 'ramnet' ),
    );
    
    $args = array(
        'labels'              => $labels,
        'public'              => false,
        'publicly_queryable'  => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => false,
        'rewrite'             => false,
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => 25,
        'menu_icon'           => 'dashicons-email-alt',
        'supports'            => array( 'title', 'editor', 'custom-fields' ),
    );
    
    register_post_type( 'ramnet_lead', $args );
}
add_action( 'init', 'ramnet_register_lead_post_type' );

/**
 * Add custom columns to leads list
 */
function ramnet_lead_columns( $columns ) {
    return array(
        'cb'       => '<input type="checkbox" />',
        'title'    => __( 'Заявка', 'ramnet' ),
        'name'     => __( 'Имя', 'ramnet' ),
        'phone'    => __( 'Телефон', 'ramnet' ),
        'date'     => __( 'Дата', 'ramnet' ),
    );
}
add_filter( 'manage_ramnet_lead_posts_columns', 'ramnet_lead_columns' );

/**
 * Display custom column data
 */
function ramnet_lead_custom_column( $column, $post_id ) {
    switch ( $column ) {
        case 'name':
            echo esc_html( get_post_meta( $post_id, '_lead_name', true ) );
            break;
        case 'phone':
            echo esc_html( get_post_meta( $post_id, '_lead_phone', true ) );
            break;
    }
}
add_action( 'manage_ramnet_lead_posts_custom_column', 'ramnet_lead_custom_column', 10, 2 );