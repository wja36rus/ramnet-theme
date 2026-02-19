<?php
/**
 * Testimonials Custom Post Type
 *
 * @package RAMNET
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Register Testimonials Custom Post Type
 */
function ramnet_register_testimonials_cpt() {
    
    $labels = array(
        'name'                  => __( 'Отзывы', 'ramnet' ),
        'singular_name'         => __( 'Отзыв', 'ramnet' ),
        'menu_name'             => __( 'Отзывы', 'ramnet' ),
        'name_admin_bar'        => __( 'Отзыв', 'ramnet' ),
        'add_new'               => __( 'Добавить отзыв', 'ramnet' ),
        'add_new_item'          => __( 'Добавить новый отзыв', 'ramnet' ),
        'edit_item'             => __( 'Редактировать отзыв', 'ramnet' ),
        'new_item'              => __( 'Новый отзыв', 'ramnet' ),
        'view_item'             => __( 'Просмотреть отзыв', 'ramnet' ),
        'search_items'          => __( 'Поиск отзывов', 'ramnet' ),
        'not_found'             => __( 'Отзывы не найдены', 'ramnet' ),
        'not_found_in_trash'    => __( 'В корзине отзывов нет', 'ramnet' ),
        'featured_image'        => __( 'Фото клиента', 'ramnet' ),
        'set_featured_image'    => __( 'Установить фото клиента', 'ramnet' ),
        'remove_featured_image' => __( 'Удалить фото клиента', 'ramnet' ),
        'use_featured_image'    => __( 'Использовать как фото клиента', 'ramnet' ),
        'archives'              => __( 'Архив отзывов', 'ramnet' ),
        'insert_into_item'      => __( 'Вставить в отзыв', 'ramnet' ),
        'uploaded_to_this_item' => __( 'Загружено для этого отзыва', 'ramnet' ),
        'filter_items_list'     => __( 'Фильтр отзывов', 'ramnet' ),
        'items_list_navigation' => __( 'Навигация по отзывам', 'ramnet' ),
        'items_list'            => __( 'Список отзывов', 'ramnet' ),
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
            'slug'       => 'testimonials',
            'with_front' => false,
        ),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 21,
        'menu_icon'           => 'dashicons-testimonial',
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'custom-fields',
        ),
    );
    
    register_post_type( 'ramnet_testimonial', $args );
}
add_action( 'init', 'ramnet_register_testimonials_cpt' );

/**
 * Add custom meta boxes for testimonials
 */
function ramnet_add_testimonial_meta_boxes() {
    add_meta_box(
        'ramnet_testimonial_details',
        __( 'Детали отзыва', 'ramnet' ),
        'ramnet_testimonial_details_callback',
        'ramnet_testimonial',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'ramnet_add_testimonial_meta_boxes' );

/**
 * Testimonial details meta box callback
 */
function ramnet_testimonial_details_callback( $post ) {
    wp_nonce_field( 'ramnet_testimonial_details', 'ramnet_testimonial_details_nonce' );
    
    $client_position = get_post_meta( $post->ID, '_client_position', true );
    $client_company = get_post_meta( $post->ID, '_client_company', true );
    $client_location = get_post_meta( $post->ID, '_client_location', true );
    $rating = get_post_meta( $post->ID, '_rating', true );
    $rating = $rating ? $rating : 5;
    ?>

<style>
.testimonial-meta-field {
    margin-bottom: 15px;
}

.testimonial-meta-field label {
    display: block;
    font-weight: 600;
    margin-bottom: 5px;
}

.testimonial-meta-field input[type="text"],
.testimonial-meta-field input[type="number"],
.testimonial-meta-field select {
    width: 100%;
    max-width: 400px;
}

.rating-stars {
    display: flex;
    gap: 5px;
    margin-top: 5px;
}

.rating-star {
    font-size: 24px;
    color: #ffd700;
    cursor: pointer;
}

.rating-star:hover,
.rating-star.selected {
    color: #ffb400;
}
</style>

<div class="testimonial-meta-field">
    <label for="client_position"><?php _e( 'Должность клиента:', 'ramnet' ); ?></label>
    <input type="text" id="client_position" name="client_position" value="<?php echo esc_attr( $client_position ); ?>"
        class="widefat" placeholder="<?php _e( 'Например: директор', 'ramnet' ); ?>">
</div>

<div class="testimonial-meta-field">
    <label for="client_company"><?php _e( 'Компания клиента:', 'ramnet' ); ?></label>
    <input type="text" id="client_company" name="client_company" value="<?php echo esc_attr( $client_company ); ?>"
        class="widefat" placeholder="<?php _e( 'Например: Природный парк «Олений»', 'ramnet' ); ?>">
</div>

<div class="testimonial-meta-field">
    <label for="client_location"><?php _e( 'Локация:', 'ramnet' ); ?></label>
    <input type="text" id="client_location" name="client_location" value="<?php echo esc_attr( $client_location ); ?>"
        class="widefat" placeholder="<?php _e( 'Например: Липецкая обл.', 'ramnet' ); ?>">
</div>

<div class="testimonial-meta-field">
    <label for="rating"><?php _e( 'Рейтинг:', 'ramnet' ); ?></label>
    <input type="number" id="rating" name="rating" value="<?php echo esc_attr( $rating ); ?>" min="1" max="5" step="1"
        style="width: 80px;">
    <div class="rating-stars">
        <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
        <span class="rating-star <?php echo $i <= $rating ? 'selected' : ''; ?>" data-value="<?php echo $i; ?>">★</span>
        <?php endfor; ?>
    </div>
</div>

<script>
jQuery(document).ready(function($) {
    $('.rating-star').on('click', function() {
        var value = $(this).data('value');
        $('#rating').val(value);

        $('.rating-star').removeClass('selected');
        $('.rating-star').each(function(index) {
            if (index < value) {
                $(this).addClass('selected');
            }
        });
    });
});
</script>

<?php
}

/**
 * Save testimonial meta box data
 */
function ramnet_save_testimonial_meta( $post_id ) {
    
    if ( ! isset( $_POST['ramnet_testimonial_details_nonce'] ) ) {
        return;
    }
    
    if ( ! wp_verify_nonce( $_POST['ramnet_testimonial_details_nonce'], 'ramnet_testimonial_details' ) ) {
        return;
    }
    
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    
    $fields = array(
        'client_position',
        'client_company',
        'client_location',
        'rating',
    );
    
    foreach ( $fields as $field ) {
        if ( isset( $_POST[$field] ) ) {
            update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[$field] ) );
        }
    }
}
add_action( 'save_post_ramnet_testimonial', 'ramnet_save_testimonial_meta' );

/**
 * Modify columns in testimonials list
 */
function ramnet_testimonial_columns( $columns ) {
    return array(
        'cb'        => '<input type="checkbox" />',
        'title'     => __( 'Клиент', 'ramnet' ),
        'company'   => __( 'Компания', 'ramnet' ),
        'position'  => __( 'Должность', 'ramnet' ),
        'location'  => __( 'Локация', 'ramnet' ),
        'rating'    => __( 'Рейтинг', 'ramnet' ),
        'thumbnail' => __( 'Фото', 'ramnet' ),
        'date'      => __( 'Дата', 'ramnet' ),
    );
}
add_filter( 'manage_ramnet_testimonial_posts_columns', 'ramnet_testimonial_columns' );

/**
 * Display custom column data for testimonials
 */
function ramnet_testimonial_custom_column( $column, $post_id ) {
    switch ( $column ) {
        case 'company':
            echo esc_html( get_post_meta( $post_id, '_client_company', true ) );
            break;
            
        case 'position':
            echo esc_html( get_post_meta( $post_id, '_client_position', true ) );
            break;
            
        case 'location':
            echo esc_html( get_post_meta( $post_id, '_client_location', true ) );
            break;
            
        case 'rating':
            $rating = get_post_meta( $post_id, '_rating', true );
            $rating = $rating ? $rating : 5;
            for ( $i = 1; $i <= 5; $i++ ) {
                echo $i <= $rating ? '★' : '☆';
            }
            break;
            
        case 'thumbnail':
            if ( has_post_thumbnail( $post_id ) ) {
                echo get_the_post_thumbnail( $post_id, array( 50, 50 ) );
            } else {
                echo '—';
            }
            break;
    }
}
add_action( 'manage_ramnet_testimonial_posts_custom_column', 'ramnet_testimonial_custom_column', 10, 2 );