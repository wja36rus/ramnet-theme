<?php
/**
 * Services Custom Post Type
 *
 * @package RAMNET
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Register Services Custom Post Type
 */
function ramnet_register_services_cpt() {
    
    $labels = array(
        'name'                  => __( 'Услуги', 'ramnet' ),
        'singular_name'         => __( 'Услуга', 'ramnet' ),
        'menu_name'             => __( 'Услуги', 'ramnet' ),
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
            'slug'       => 'services',
            'with_front' => false,
        ),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => 22,
        'menu_icon'           => 'dashicons-hammer',
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
            'excerpt',
            'custom-fields',
            'page-attributes',
        ),
    );
    
    register_post_type( 'ramnet_service', $args );
}
add_action( 'init', 'ramnet_register_services_cpt' );

/**
 * Register Service Category Taxonomy
 */
function ramnet_register_service_category() {
    
    $labels = array(
        'name'              => __( 'Категории услуг', 'ramnet' ),
        'singular_name'     => __( 'Категория услуги', 'ramnet' ),
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
            'slug' => 'service-category',
        ),
    );
    
    register_taxonomy( 'service_category', array( 'ramnet_service' ), $args );
}
add_action( 'init', 'ramnet_register_service_category' );

/**
 * Add custom meta boxes for services
 */
function ramnet_add_service_meta_boxes() {
    add_meta_box(
        'ramnet_service_details',
        __( 'Детали услуги', 'ramnet' ),
        'ramnet_service_details_callback',
        'ramnet_service',
        'normal',
        'high'
    );
    
    add_meta_box(
        'ramnet_service_features',
        __( 'Особенности услуги', 'ramnet' ),
        'ramnet_service_features_callback',
        'ramnet_service',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'ramnet_add_service_meta_boxes' );

/**
 * Service details meta box callback
 */
function ramnet_service_details_callback( $post ) {
    wp_nonce_field( 'ramnet_service_details', 'ramnet_service_details_nonce' );
    
    $service_icon = get_post_meta( $post->ID, '_service_icon', true );
    $service_price = get_post_meta( $post->ID, '_service_price', true );
    $service_duration = get_post_meta( $post->ID, '_service_duration', true );
    $service_order = get_post_meta( $post->ID, '_service_order', true );
    ?>

<style>
.service-meta-field {
    margin-bottom: 20px;
    padding: 10px;
    background: #f9f9f9;
    border-radius: 5px;
}

.service-meta-field label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: #333;
}

.service-meta-field input[type="text"],
.service-meta-field input[type="number"],
.service-meta-field select,
.service-meta-field textarea {
    width: 100%;
    max-width: 500px;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.service-meta-field input[type="text"]:focus,
.service-meta-field input[type="number"]:focus,
.service-meta-field select:focus,
.service-meta-field textarea:focus {
    border-color: #007cba;
    box-shadow: 0 0 0 1px #007cba;
}

.icon-preview {
    margin-top: 10px;
    max-width: 100px;
    max-height: 100px;
}

.upload-icon-button {
    margin-top: 10px;
}
</style>

<div class="service-meta-field">
    <label for="service_icon"><?php _e( 'Иконка услуги (URL или медиафайл):', 'ramnet' ); ?></label>
    <input type="text" id="service_icon" name="service_icon" value="<?php echo esc_attr( $service_icon ); ?>"
        class="widefat">
    <button type="button" class="button upload-icon-button"><?php _e( 'Выбрать иконку', 'ramnet' ); ?></button>
    <?php if ( $service_icon ) : ?>
    <div class="icon-preview">
        <img src="<?php echo esc_url( $service_icon ); ?>" alt="" style="max-width: 100px; max-height: 100px;">
    </div>
    <?php endif; ?>
</div>

<div class="service-meta-field">
    <label for="service_price"><?php _e( 'Цена (от):', 'ramnet' ); ?></label>
    <input type="text" id="service_price" name="service_price" value="<?php echo esc_attr( $service_price ); ?>"
        placeholder="<?php _e( 'Например: от 15 000 ₽/м²', 'ramnet' ); ?>" class="widefat">
</div>

<div class="service-meta-field">
    <label for="service_duration"><?php _e( 'Срок выполнения:', 'ramnet' ); ?></label>
    <input type="text" id="service_duration" name="service_duration"
        value="<?php echo esc_attr( $service_duration ); ?>"
        placeholder="<?php _e( 'Например: 7-14 дней', 'ramnet' ); ?>" class="widefat">
</div>

<div class="service-meta-field">
    <label for="service_order"><?php _e( 'Порядок вывода:', 'ramnet' ); ?></label>
    <input type="number" id="service_order" name="service_order"
        value="<?php echo esc_attr( $service_order ? $service_order : 0 ); ?>" min="0" step="1" style="width: 100px;">
    <p class="description"><?php _e( 'Чем меньше число, тем выше будет отображаться услуга', 'ramnet' ); ?></p>
</div>

<script>
jQuery(document).ready(function($) {
    $('.upload-icon-button').on('click', function(e) {
        e.preventDefault();

        var button = $(this);
        var input = $('#service_icon');

        var frame = wp.media({
            title: '<?php _e( 'Выберите или загрузите иконку', 'ramnet' ); ?>',
            button: {
                text: '<?php _e( 'Использовать эту иконку', 'ramnet' ); ?>'
            },
            multiple: false
        });

        frame.on('select', function() {
            var attachment = frame.state().get('selection').first().toJSON();
            input.val(attachment.url);

            var previewDiv = button.siblings('.icon-preview');
            if (previewDiv.length) {
                previewDiv.find('img').attr('src', attachment.url);
            } else {
                button.after('<div class="icon-preview"><img src="' + attachment.url +
                    '" style="max-width: 100px; max-height: 100px;"></div>');
            }
        });

        frame.open();
    });
});
</script>

<?php
}

/**
 * Service features meta box callback
 */
function ramnet_service_features_callback( $post ) {
    $features = get_post_meta( $post->ID, '_service_features', true );
    $features = is_array( $features ) ? $features : array( '' );
    ?>

<div id="service-features-wrapper">
    <p><strong><?php _e( 'Особенности услуги:', 'ramnet' ); ?></strong></p>
    <p class="description"><?php _e( 'Добавьте ключевые особенности вашей услуги', 'ramnet' ); ?></p>

    <div id="features-list">
        <?php foreach ( $features as $index => $feature ) : ?>
        <div class="feature-item" style="margin-bottom: 10px; display: flex; gap: 10px; align-items: center;">
            <input type="text" name="service_features[]" value="<?php echo esc_attr( $feature ); ?>"
                style="flex: 1; padding: 8px;" placeholder="<?php _e( 'Например: Монтаж за 3 дня', 'ramnet' ); ?>">
            <button type="button" class="button remove-feature"
                <?php echo $index === 0 ? 'disabled' : ''; ?>><?php _e( 'Удалить', 'ramnet' ); ?></button>
        </div>
        <?php endforeach; ?>
    </div>

    <button type="button" class="button add-feature"
        style="margin-top: 10px;"><?php _e( 'Добавить особенность', 'ramnet' ); ?></button>
</div>

<script>
jQuery(document).ready(function($) {
    $('.add-feature').on('click', function() {
        var newItem = $('<div class="feature-item" style="margin-bottom: 10px; display: flex; gap: 10px; align-items: center;">\
                <input type="text" name="service_features[]" value="" style="flex: 1; padding: 8px;">\
                <button type="button" class="button remove-feature"><?php _e( 'Удалить', 'ramnet' ); ?></button>\
            </div>');

        $('#features-list').append(newItem);
    });

    $(document).on('click', '.remove-feature', function() {
        if ($('.feature-item').length > 1) {
            $(this).closest('.feature-item').remove();
        }
    });
});
</script>

<?php
}

/**
 * Save service meta box data
 */
function ramnet_save_service_meta( $post_id ) {
    
    // Проверяем nonce для деталей
    if ( isset( $_POST['ramnet_service_details_nonce'] ) && 
         wp_verify_nonce( $_POST['ramnet_service_details_nonce'], 'ramnet_service_details' ) ) {
        
        $fields = array(
            'service_icon',
            'service_price',
            'service_duration',
            'service_order',
        );
        
        foreach ( $fields as $field ) {
            if ( isset( $_POST[$field] ) ) {
                update_post_meta( $post_id, '_' . $field, sanitize_text_field( $_POST[$field] ) );
            }
        }
    }
    
    // Сохраняем особенности
    if ( isset( $_POST['service_features'] ) && is_array( $_POST['service_features'] ) ) {
        $features = array_map( 'sanitize_text_field', $_POST['service_features'] );
        $features = array_filter( $features ); // Удаляем пустые значения
        update_post_meta( $post_id, '_service_features', $features );
    }
}
add_action( 'save_post_ramnet_service', 'ramnet_save_service_meta' );

/**
 * Modify columns in services list
 */
function ramnet_service_columns( $columns ) {
    return array(
        'cb'         => '<input type="checkbox" />',
        'title'      => __( 'Название услуги', 'ramnet' ),
        'icon'       => __( 'Иконка', 'ramnet' ),
        'price'      => __( 'Цена', 'ramnet' ),
        'duration'   => __( 'Срок', 'ramnet' ),
        'order'      => __( 'Порядок', 'ramnet' ),
        'date'       => __( 'Дата', 'ramnet' ),
    );
}
add_filter( 'manage_ramnet_service_posts_columns', 'ramnet_service_columns' );

/**
 * Display custom column data for services
 */
function ramnet_service_custom_column( $column, $post_id ) {
    switch ( $column ) {
        case 'icon':
            $icon = get_post_meta( $post_id, '_service_icon', true );
            if ( $icon ) {
                echo '<img src="' . esc_url( $icon ) . '" style="max-width: 40px; max-height: 40px;">';
            } else {
                echo '—';
            }
            break;
            
        case 'price':
            echo esc_html( get_post_meta( $post_id, '_service_price', true ) );
            break;
            
        case 'duration':
            echo esc_html( get_post_meta( $post_id, '_service_duration', true ) );
            break;
            
        case 'order':
            echo esc_html( get_post_meta( $post_id, '_service_order', true ) );
            break;
    }
}
add_action( 'manage_ramnet_service_posts_custom_column', 'ramnet_service_custom_column', 10, 2 );