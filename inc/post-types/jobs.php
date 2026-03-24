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
    $job_title_second = get_post_meta( $post->ID, '_job_title_second', true );
    $job_subtitle = get_post_meta( $post->ID, '_job_subtitle', true );
    
    // Поля списка
    $list_line_1 = get_post_meta( $post->ID, '_list_line_1', true );
    $list_line_2 = get_post_meta( $post->ID, '_list_line_2', true );
    $list_line_3 = get_post_meta( $post->ID, '_list_line_3', true );
    $list_line_4 = get_post_meta( $post->ID, '_list_line_4', true );
    
    // Дополнительные поля
    $running_line = get_post_meta( $post->ID, '_running_line', true );
    $promotion_date = get_post_meta( $post->ID, '_promotion_date', true );
    $call_to_purchase = get_post_meta( $post->ID, '_call_to_purchase', true );
    $description_title = get_post_meta( $post->ID, '_description_title', true );
    $description_subtitle = get_post_meta( $post->ID, '_description_subtitle', true );
    $description_paragraph = get_post_meta( $post->ID, '_description_paragraph', true );
    $service_types = get_post_meta( $post->ID, '_service_types', true );
    $type_1 = get_post_meta( $post->ID, '_type_1', true );
    $type_2 = get_post_meta( $post->ID, '_type_2', true );
    $questions_title = get_post_meta( $post->ID, '_questions_title', true );
    $questions_title_second = get_post_meta( $post->ID, '_questions_title_second', true );
    $answer_1 = get_post_meta( $post->ID, '_answer_1', true );
    $answer_1_explanation = get_post_meta( $post->ID, '_answer_1_explanation', true );
    $answer_2 = get_post_meta( $post->ID, '_answer_2', true );
    $answer_2_explanation = get_post_meta( $post->ID, '_answer_2_explanation', true );
    $answer_3 = get_post_meta( $post->ID, '_answer_3', true );
    $answer_3_explanation = get_post_meta( $post->ID, '_answer_3_explanation', true );
    $answer_4 = get_post_meta( $post->ID, '_answer_4', true );
    $answer_4_explanation = get_post_meta( $post->ID, '_answer_4_explanation', true );
    $characteristics = get_post_meta( $post->ID, '_characteristics', true );
    $characteristics_second_line = get_post_meta( $post->ID, '_characteristics_second_line', true );
    $specifications_description = get_post_meta( $post->ID, '_specifications_description', true );
    $features = get_post_meta( $post->ID, '_features', true );
    $features_description = get_post_meta( $post->ID, '_features_description', true );
    $features_description_about_1 = get_post_meta( $post->ID, '_features_description_about_1', true );
    $features_description_about_2 = get_post_meta( $post->ID, '_features_description_about_2', true );
    $features_description_about_3 = get_post_meta( $post->ID, '_features_description_about_3', true );
    $features_description_about_4 = get_post_meta( $post->ID, '_features_description_about_4', true );
    $features_description_about_5 = get_post_meta( $post->ID, '_features_description_about_5', true );
    $features_description_about_1_text_1 = get_post_meta( $post->ID, '_features_description_about_1_text_1', true );
    $features_description_about_1_text_2 = get_post_meta( $post->ID, '_features_description_about_1_text_2', true );
    $features_description_about_1_text_3 = get_post_meta( $post->ID, '_features_description_about_1_text_3', true );
    $features_description_about_1_text_4 = get_post_meta( $post->ID, '_features_description_about_1_text_4', true );
    $features_description_about_1_text_5 = get_post_meta( $post->ID, '_features_description_about_1_text_5', true );
    $features_description_about_1_text_6 = get_post_meta( $post->ID, '_features_description_about_1_text_6', true );
    $features_description_about_2_text_1 = get_post_meta( $post->ID, '_features_description_about_2_text_1', true );
    $features_description_about_2_text_2 = get_post_meta( $post->ID, '_features_description_about_2_text_2', true );
    $features_description_about_2_text_3 = get_post_meta( $post->ID, '_features_description_about_2_text_3', true );
    $features_description_about_2_text_4 = get_post_meta( $post->ID, '_features_description_about_2_text_4', true );
    $features_description_about_2_text_5 = get_post_meta( $post->ID, '_features_description_about_2_text_5', true );
    $features_description_about_2_text_6 = get_post_meta( $post->ID, '_features_description_about_2_text_6', true );
    $features_description_about_3_text_1 = get_post_meta( $post->ID, '_features_description_about_3_text_1', true );
    $features_description_about_3_text_2 = get_post_meta( $post->ID, '_features_description_about_3_text_2', true );
    $features_description_about_3_text_3 = get_post_meta( $post->ID, '_features_description_about_3_text_3', true );
    $features_description_about_3_text_4 = get_post_meta( $post->ID, '_features_description_about_3_text_4', true );
    $features_description_about_3_text_5 = get_post_meta( $post->ID, '_features_description_about_3_text_5', true );
    $features_description_about_3_text_6 = get_post_meta( $post->ID, '_features_description_about_3_text_6', true );
    $features_description_about_4_text_1 = get_post_meta( $post->ID, '_features_description_about_4_text_1', true );
    $features_description_about_4_text_2 = get_post_meta( $post->ID, '_features_description_about_4_text_2', true );
    $features_description_about_4_text_3 = get_post_meta( $post->ID, '_features_description_about_4_text_3', true );
    $features_description_about_4_text_4 = get_post_meta( $post->ID, '_features_description_about_4_text_4', true );
    $features_description_about_4_text_5 = get_post_meta( $post->ID, '_features_description_about_4_text_5', true );
    $features_description_about_4_text_6 = get_post_meta( $post->ID, '_features_description_about_4_text_6', true );
    $features_description_about_5_text_1 = get_post_meta( $post->ID, '_features_description_about_5_text_1', true );
    $features_description_about_5_text_2 = get_post_meta( $post->ID, '_features_description_about_5_text_2', true );
    $features_description_about_5_text_3 = get_post_meta( $post->ID, '_features_description_about_5_text_3', true );
    $features_description_about_5_text_4 = get_post_meta( $post->ID, '_features_description_about_5_text_4', true );
    $features_description_about_5_text_5 = get_post_meta( $post->ID, '_features_description_about_5_text_5', true );
    $features_description_about_5_text_6 = get_post_meta( $post->ID, '_features_description_about_5_text_6', true );
    $gallery_title = get_post_meta( $post->ID, '_gallery_title', true );
    $gallery_title_second = get_post_meta( $post->ID, '_gallery_title_second', true );
    $people_answer_say = get_post_meta( $post->ID, '_people_answer_say', true );
    $people_answer_text = get_post_meta( $post->ID, '_people_answer_text', true );
    $how_we_work = get_post_meta( $post->ID, '_how_we_work', true );
    $how_we_work_1_stage_1 = get_post_meta( $post->ID, '_how_we_work_1_stage_1', true );
    $how_we_work_1_stage_2 = get_post_meta( $post->ID, '_how_we_work_1_stage_2', true );
    $how_we_work_1_stage_3 = get_post_meta( $post->ID, '_how_we_work_1_stage_3', true );
    $how_we_work_2_stage_1 = get_post_meta( $post->ID, '_how_we_work_2_stage_1', true );
    $how_we_work_2_stage_2 = get_post_meta( $post->ID, '_how_we_work_2_stage_2', true );
    $how_we_work_2_stage_3 = get_post_meta( $post->ID, '_how_we_work_2_stage_3', true );
    $how_we_work_3_stage_1 = get_post_meta( $post->ID, '_how_we_work_3_stage_1', true );
    $how_we_work_3_stage_2 = get_post_meta( $post->ID, '_how_we_work_3_stage_2', true );
    $how_we_work_3_stage_3 = get_post_meta( $post->ID, '_how_we_work_3_stage_3', true );
    $how_we_work_4_stage_1 = get_post_meta( $post->ID, '_how_we_work_4_stage_1', true );
    $how_we_work_4_stage_2 = get_post_meta( $post->ID, '_how_we_work_4_stage_2', true );
    $how_we_work_4_stage_3 = get_post_meta( $post->ID, '_how_we_work_4_stage_3', true );
    $form_title = get_post_meta( $post->ID, '_form_title', true );
    $form_title_second = get_post_meta( $post->ID, '_form_title_second', true );
    ?>

    <h3><?php _e( 'Основная информация', 'ramnet' ); ?></h3>
    <p>
        <label for="job_title"><?php _e( 'Заголовок:', 'ramnet' ); ?></label>
        <input type="text" id="job_title" name="job_title" value="<?php echo esc_attr( $job_title ); ?>" class="widefat">
    </p>
    <p>
        <label for="job_title_second"><?php _e( 'Заголовок вторая строка:', 'ramnet' ); ?></label>
        <input type="text" id="job_title_second" name="job_title_second" value="<?php echo esc_attr( $job_title_second ); ?>" class="widefat">
    </p>
    <p>
        <label for="job_subtitle"><?php _e( 'Подзаголовок:', 'ramnet' ); ?></label>
        <input type="text" id="job_subtitle" name="job_subtitle" value="<?php echo esc_attr( $job_subtitle ); ?>" class="widefat">
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

    <h3><?php _e( 'Дополнительная информация', 'ramnet' ); ?></h3>
    <p>
        <label for="running_line"><?php _e( 'Бегущая строка:', 'ramnet' ); ?></label>
        <input type="text" id="running_line" name="running_line" value="<?php echo esc_attr( $running_line ); ?>" class="widefat">
    </p>
    <p>
        <label for="promotion_date"><?php _e( 'Дата акции:', 'ramnet' ); ?></label>
        <input type="text" id="promotion_date" name="promotion_date" value="<?php echo esc_attr( $promotion_date ); ?>" class="widefat">
    </p>
    <p>
        <label for="call_to_purchase"><?php _e( 'Призыв к покупке:', 'ramnet' ); ?></label>
        <input type="text" id="call_to_purchase" name="call_to_purchase" value="<?php echo esc_attr( $call_to_purchase ); ?>" class="widefat">
    </p>
    <p>
        <label for="description_title"><?php _e( 'Заголовок описания:', 'ramnet' ); ?></label>
        <input type="text" id="description_title" name="description_title" value="<?php echo esc_attr( $description_title ); ?>" class="widefat">
    </p>
    <p>
        <label for="description_subtitle"><?php _e( 'Подзаголовок описания:', 'ramnet' ); ?></label>
        <input type="text" id="description_subtitle" name="description_subtitle" value="<?php echo esc_attr( $description_subtitle ); ?>" class="widefat">
    </p>
    <p>
        <label for="description_paragraph"><?php _e( 'Абзац описания:', 'ramnet' ); ?></label>
        <textarea id="description_paragraph" name="description_paragraph" rows="4" class="widefat"><?php echo esc_textarea( $description_paragraph ); ?></textarea>
    </p>
    <p>
        <label for="service_types"><?php _e( 'Типы услуги:', 'ramnet' ); ?></label>
        <input type="text" id="service_types" name="service_types" value="<?php echo esc_attr( $service_types ); ?>" class="widefat">
    </p>
    <p>
        <label for="type_1"><?php _e( 'Тип 1:', 'ramnet' ); ?></label>
        <input type="text" id="type_1" name="type_1" value="<?php echo esc_attr( $type_1 ); ?>" class="widefat">
    </p>
    <p>
        <label for="type_2"><?php _e( 'Тип 2:', 'ramnet' ); ?></label>
        <input type="text" id="type_2" name="type_2" value="<?php echo esc_attr( $type_2 ); ?>" class="widefat">
    </p>

    <h3><?php _e( 'Вопросы и ответы', 'ramnet' ); ?></h3>
    <p>
        <label for="questions_title"><?php _e( 'Заголовок вопросов:', 'ramnet' ); ?></label>
        <input type="text" id="questions_title" name="questions_title" value="<?php echo esc_attr( $questions_title ); ?>" class="widefat">
    </p>
    <p>
        <label for="questions_title_second"><?php _e( 'Заголовок вторая строка:', 'ramnet' ); ?></label>
        <input type="text" id="questions_title_second" name="questions_title_second" value="<?php echo esc_attr( $questions_title_second ); ?>" class="widefat">
    </p>
    <p>
        <label for="answer_1"><?php _e( 'Ответ 1:', 'ramnet' ); ?></label>
        <textarea id="answer_1" name="answer_1" rows="3" class="widefat"><?php echo esc_textarea( $answer_1 ); ?></textarea>
    </p>
    <p>
        <label for="answer_1_explanation"><?php _e( 'Пояснения ответа 1:', 'ramnet' ); ?></label>
        <textarea id="answer_1_explanation" name="answer_1_explanation" rows="2" class="widefat"><?php echo esc_textarea( $answer_1_explanation ); ?></textarea>
    </p>
    <p>
        <label for="answer_2"><?php _e( 'Ответ 2:', 'ramnet' ); ?></label>
        <textarea id="answer_2" name="answer_2" rows="3" class="widefat"><?php echo esc_textarea( $answer_2 ); ?></textarea>
    </p>
    <p>
        <label for="answer_2_explanation"><?php _e( 'Пояснения ответа 2:', 'ramnet' ); ?></label>
        <textarea id="answer_2_explanation" name="answer_2_explanation" rows="2" class="widefat"><?php echo esc_textarea( $answer_2_explanation ); ?></textarea>
    </p>
    <p>
        <label for="answer_3"><?php _e( 'Ответ 3:', 'ramnet' ); ?></label>
        <textarea id="answer_3" name="answer_3" rows="3" class="widefat"><?php echo esc_textarea( $answer_3 ); ?></textarea>
    </p>
    <p>
        <label for="answer_3_explanation"><?php _e( 'Пояснения ответа 3:', 'ramnet' ); ?></label>
        <textarea id="answer_3_explanation" name="answer_3_explanation" rows="2" class="widefat"><?php echo esc_textarea( $answer_3_explanation ); ?></textarea>
    </p>
    <p>
        <label for="answer_4"><?php _e( 'Ответ 4:', 'ramnet' ); ?></label>
        <textarea id="answer_4" name="answer_4" rows="3" class="widefat"><?php echo esc_textarea( $answer_4 ); ?></textarea>
    </p>
    <p>
        <label for="answer_4_explanation"><?php _e( 'Пояснения ответа 4:', 'ramnet' ); ?></label>
        <textarea id="answer_4_explanation" name="answer_4_explanation" rows="2" class="widefat"><?php echo esc_textarea( $answer_4_explanation ); ?></textarea>
    </p>

    <h3><?php _e( 'Характеристики', 'ramnet' ); ?></h3>
    <p>
        <label for="characteristics"><?php _e( 'Характеристики:', 'ramnet' ); ?></label>
        <textarea id="characteristics" name="characteristics" rows="4" class="widefat"><?php echo esc_textarea( $characteristics ); ?></textarea>
    </p>
    <p>
        <label for="characteristics_second_line"><?php _e( 'Характеристики вторая строка:', 'ramnet' ); ?></label>
        <textarea id="characteristics_second_line" name="characteristics_second_line" rows="4" class="widefat"><?php echo esc_textarea( $characteristics_second_line ); ?></textarea>
    </p>
    <p>
        <label for="specifications_description"><?php _e( 'Описание:', 'ramnet' ); ?></label>
        <textarea id="specifications_description" name="specifications_description" rows="4" class="widefat"><?php echo esc_textarea( $specifications_description ); ?></textarea>
    </p>

    <h3><?php _e( 'Особенности', 'ramnet' ); ?></h3>
    <p>
        <label for="features"><?php _e( 'Особенности:', 'ramnet' ); ?></label>
        <textarea id="features" name="features" rows="4" class="widefat"><?php echo esc_textarea( $features ); ?></textarea>
    </p>
    <p>
        <label for="features_description"><?php _e( 'Описание особенностей:', 'ramnet' ); ?></label>
        <textarea id="features_description" name="features_description" rows="4" class="widefat"><?php echo esc_textarea( $features_description ); ?></textarea>
    </p>
    <h3><?php _e( 'Особенности перечисление', 'ramnet' ); ?></h3>
    <p>
        <label for="features_description_about_1"><?php _e( 'Особенность 1 заголовок:', 'ramnet' ); ?></label>
        <input id="features_description_about_1" name="features_description_about_1" class="widefat" value="<?php echo esc_attr( $features_description_about_1 ); ?>"/>
    </p>
    <div class="flex gap-1">
        <p>
            <label for="features_description_about_1_text_1"><?php _e( 'Особенность 1-1:', 'ramnet' ); ?></label>
            <input id="features_description_about_1_text_1" name="features_description_about_1_text_1" class="widefat" value="<?php echo esc_attr( $features_description_about_1_text_1 ); ?>"/>
            
        </p>
        <p>
            <label for="features_description_about_1_text_2"><?php _e( 'Особенность 1-2:', 'ramnet' ); ?></label>
            <input id="features_description_about_1_text_2" name="features_description_about_1_text_2" class="widefat" value="<?php echo esc_attr( $features_description_about_1_text_2 ); ?>"/>
            
        </p>
        <p>
            <label for="features_description_about_1_text_3"><?php _e( 'Особенность 1-3:', 'ramnet' ); ?></label>
            <input id="features_description_about_1_text_3" name="features_description_about_1_text_3" class="widefat" value="<?php echo esc_attr( $features_description_about_1_text_3 ); ?>"/>
            
        </p>
        <p>
            <label for="features_description_about_1_text_4"><?php _e( 'Особенность 1-4:', 'ramnet' ); ?></label>
            <input id="features_description_about_1_text_4" name="features_description_about_1_text_4" class="widefat" value="<?php echo esc_attr( $features_description_about_1_text_4 ); ?>"/>
            
        </p>
        <p>
            <label for="features_description_about_1_text_5"><?php _e( 'Особенность 1-5:', 'ramnet' ); ?></label>
            <input id="features_description_about_1_text_5" name="features_description_about_1_text_5" class="widefat" value="<?php echo esc_attr( $features_description_about_1_text_5 ); ?>"/>
            
        </p>
        <p>
            <label for="features_description_about_1_text_6"><?php _e( 'Особенность 1-6:', 'ramnet' ); ?></label>
            <input id="features_description_about_1_text_6" name="features_description_about_1_text_6" class="widefat" value="<?php echo esc_attr( $features_description_about_1_text_6 ); ?>"/>
            
        </p>
</div>

        <p>
            <label for="features_description_about_2"><?php _e( 'Особенность 2 заголовок:', 'ramnet' ); ?></label>
            <input id="features_description_about_2" name="features_description_about_2" class="widefat" value="<?php echo esc_attr( $features_description_about_2 ); ?>"/>
        </p>
        <div class="flex gap-1">
        <p>
            <label for="features_description_about_2_text_1"><?php _e( 'Особенность 2-1:', 'ramnet' ); ?></label>
            <input id="features_description_about_2_text_1" name="features_description_about_2_text_1" class="widefat" value="<?php echo esc_attr( $features_description_about_2_text_1 ); ?>"/>
        </p>
        <p>
            <label for="features_description_about_2_text_2"><?php _e( 'Особенность 2-2:', 'ramnet' ); ?></label>
            <input id="features_description_about_2_text_2" name="features_description_about_2_text_2" class="widefat" value="<?php echo esc_attr( $features_description_about_2_text_2 ); ?>"/>
        </p>
        <p>
            <label for="features_description_about_2_text_3"><?php _e( 'Особенность 2-3:', 'ramnet' ); ?></label>
            <input id="features_description_about_2_text_3" name="features_description_about_2_text_3" class="widefat" value="<?php echo esc_attr( $features_description_about_2_text_3 ); ?>"/>
       </p>
        <p>
            <label for="features_description_about_2_text_4"><?php _e( 'Особенность 2-4:', 'ramnet' ); ?></label>
            <input id="features_description_about_2_text_4" name="features_description_about_2_text_4" class="widefat" value="<?php echo esc_attr( $features_description_about_2_text_4 ); ?>"/>
        </p>
        <p>
            <label for="features_description_about_2_text_5"><?php _e( 'Особенность 2-5:', 'ramnet' ); ?></label>
            <input id="features_description_about_2_text_5" name="features_description_about_2_text_5" class="widefat" value="<?php echo esc_attr( $features_description_about_2_text_5 ); ?>"/>
        </p>
        <p>
            <label for="features_description_about_2_text_6"><?php _e( 'Особенность 2-6:', 'ramnet' ); ?></label>
            <input id="features_description_about_2_text_6" name="features_description_about_2_text_6" class="widefat" value="<?php echo esc_attr( $features_description_about_2_text_6 ); ?>"/>
        </p>
</div>
        <p>
            <label for="features_description_about_3"><?php _e( 'Особенность 3 заголовок:', 'ramnet' ); ?></label>
            <input id="features_description_about_3" name="features_description_about_3" class="widefat" value="<?php echo esc_attr( $features_description_about_3 ); ?>"/>
        </p>
        <div class="flex gap-1">
        <p>
            <label for="features_description_about_3_text_1"><?php _e( 'Особенность 3-1:', 'ramnet' ); ?></label>
            <input id="features_description_about_3_text_1" name="features_description_about_3_text_1" class="widefat" value="<?php echo esc_attr( $features_description_about_3_text_1 ); ?>"/>
        </p>
        <p>
            <label for="features_description_about_3_text_2"><?php _e( 'Особенность 3-2:', 'ramnet' ); ?></label>
            <input id="features_description_about_3_text_2" name="features_description_about_3_text_2" class="widefat" value="<?php echo esc_attr( $features_description_about_3_text_2 ); ?>"/>
        </p>
        <p>
            <label for="features_description_about_3_text_3"><?php _e( 'Особенность 3-3:', 'ramnet' ); ?></label>
            <input id="features_description_about_3_text_3" name="features_description_about_3_text_3" class="widefat" value="<?php echo esc_attr( $features_description_about_3_text_3 ); ?>"/>
        </p>
        <p>
            <label for="features_description_about_3_text_4"><?php _e( 'Особенность 3-4:', 'ramnet' ); ?></label>
            <input id="features_description_about_3_text_4" name="features_description_about_3_text_4" class="widefat" value="<?php echo esc_attr( $features_description_about_3_text_4 ); ?>"/>
        </p>
        <p>
            <label for="features_description_about_3_text_5"><?php _e( 'Особенность 3-5:', 'ramnet' ); ?></label>
            <input id="features_description_about_3_text_5" name="features_description_about_3_text_5" class="widefat" value="<?php echo esc_attr( $features_description_about_3_text_5 ); ?>"/>
        </p>
        <p>
            <label for="features_description_about_3_text_6"><?php _e( 'Особенность 3-6:', 'ramnet' ); ?></label>
            <input id="features_description_about_3_text_6" name="features_description_about_3_text_6" class="widefat" value="<?php echo esc_attr( $features_description_about_3_text_6 ); ?>"/>
        </p>
</div>
        <p>
            <label for="features_description_about_4"><?php _e( 'Особенность 4 заголовок:', 'ramnet' ); ?></label>
            <input id="features_description_about_4" name="features_description_about_4" class="widefat" value="<?php echo esc_attr( $features_description_about_4 ); ?>"/>
        </p>
        <div class="flex gap-1">
        <p>
            <label for="features_description_about_4_text_1"><?php _e( 'Особенность 4-1:', 'ramnet' ); ?></label>
            <input id="features_description_about_4_text_1" name="features_description_about_4_text_1" class="widefat" value="<?php echo esc_attr( $features_description_about_4_text_1 ); ?>"/>
        </p>
        <p>
            <label for="features_description_about_4_text_2"><?php _e( 'Особенность 4-2:', 'ramnet' ); ?></label>
            <input id="features_description_about_4_text_2" name="features_description_about_4_text_2" class="widefat" value="<?php echo esc_attr( $features_description_about_4_text_2 ); ?>"/>
        </p>
        <p>
            <label for="features_description_about_4_text_3"><?php _e( 'Особенность 4-3:', 'ramnet' ); ?></label>
            <input id="features_description_about_4_text_3" name="features_description_about_4_text_3" class="widefat" value="<?php echo esc_attr( $features_description_about_4_text_3 ); ?>"/>
      </p>
        <p>
            <label for="features_description_about_4_text_4"><?php _e( 'Особенность 4-4:', 'ramnet' ); ?></label>
            <input id="features_description_about_4_text_4" name="features_description_about_4_text_4" class="widefat" value="<?php echo esc_attr( $features_description_about_4_text_4 ); ?>"/>
        </p>
        <p>
            <label for="features_description_about_4_text_5"><?php _e( 'Особенность 4-5:', 'ramnet' ); ?></label>
            <input id="features_description_about_4_text_5" name="features_description_about_4_text_5" class="widefat" value="<?php echo esc_attr( $features_description_about_4_text_5 ); ?>"/>
        </p>
        <p>
            <label for="features_description_about_4_text_6"><?php _e( 'Особенность 4-6:', 'ramnet' ); ?></label>
            <input id="features_description_about_4_text_6" name="features_description_about_4_text_6" class="widefat" value="<?php echo esc_attr( $features_description_about_4_text_6 ); ?>"/>
        </p>
</div>
        <p>
            <label for="features_description_about_5"><?php _e( 'Особенность 5 заголовок:', 'ramnet' ); ?></label>
            <input id="features_description_about_5" name="features_description_about_5" class="widefat" value="<?php echo esc_attr( $features_description_about_5 ); ?>"/>
        </p>
        <div class="flex gap-1">
        <p>
            <label for="features_description_about_5_text_1"><?php _e( 'Особенность 5-1:', 'ramnet' ); ?></label>
            <input id="features_description_about_5_text_1" name="features_description_about_5_text_1" class="widefat" value="<?php echo esc_attr( $features_description_about_5_text_1 ); ?>"/>
        </p>
        <p>
            <label for="features_description_about_5_text_2"><?php _e( 'Особенность 5-2:', 'ramnet' ); ?></label>
            <input id="features_description_about_5_text_2" name="features_description_about_5_text_2" class="widefat" value="<?php echo esc_attr( $features_description_about_5_text_2 ); ?>"/>
        </p>
        <p>
            <label for="features_description_about_5_text_3"><?php _e( 'Особенность 5-3:', 'ramnet' ); ?></label>
            <input id="features_description_about_5_text_3" name="features_description_about_5_text_3" class="widefat" value="<?php echo esc_attr( $features_description_about_5_text_3 ); ?>"/>
        </p>
        <p>
            <label for="features_description_about_5_text_4"><?php _e( 'Особенность 5-4:', 'ramnet' ); ?></label>
            <input id="features_description_about_5_text_4" name="features_description_about_5_text_4" class="widefat" value="<?php echo esc_attr( $features_description_about_5_text_4 ); ?>"/>
        </p>
        <p>
            <label for="features_description_about_5_text_5"><?php _e( 'Особенность 5-5:', 'ramnet' ); ?></label>
            <input id="features_description_about_5_text_5" name="features_description_about_5_text_5" class="widefat" value="<?php echo esc_attr( $features_description_about_5_text_5 ); ?>"/>
        </p>
        <p>
            <label for="features_description_about_5_text_6"><?php _e( 'Особенность 5-6:', 'ramnet' ); ?></label>
            <input id="features_description_about_5_text_6" name="features_description_about_5_text_6" class="widefat" value="<?php echo esc_attr( $features_description_about_5_text_6 ); ?>"/>
        </p>
</div>

<h3><?php _e( 'Заголовок галереи', 'ramnet' ); ?></h3>

    <p>
        <label for="gallery_title"><?php _e( 'Заголовок:', 'ramnet' ); ?></label>
        <textarea id="gallery_title" name="gallery_title" rows="1" class="widefat"><?php echo esc_textarea( $gallery_title ); ?></textarea>
    </p>
    <p>
        <label for="gallery_title_second"><?php _e( 'Заголовок вторая строка:', 'ramnet' ); ?></label>
        <textarea id="gallery_title_second" name="gallery_title_second" rows="1" class="widefat"><?php echo esc_textarea( $gallery_title_second ); ?></textarea>
    </p>

<h3><?php _e( 'Отзывы', 'ramnet' ); ?></h3>

<p>
    <label for="people_answer_say"><?php _e( 'Отзыв:', 'ramnet' ); ?></label>
    <textarea id="people_answer_say" name="people_answer_say" rows="1" class="widefat"><?php echo esc_textarea( $people_answer_say ); ?></textarea>
</p>
<p>
    <label for="people_answer_text"><?php _e( 'Призыв читать отзывы:', 'ramnet' ); ?></label>
    <textarea id="people_answer_text" name="people_answer_text" rows="1" class="widefat"><?php echo esc_textarea( $people_answer_text ); ?></textarea>
</p>

<h3><?php _e( 'Как мы работаем', 'ramnet' ); ?></h3>
<p>
    <label for="how_we_work"><?php _e( 'Заголовок:', 'ramnet' ); ?></label>
    <textarea id="how_we_work" name="how_we_work" rows="1" class="widefat"><?php echo esc_textarea( $how_we_work ); ?></textarea>
</p>
<p>
    <label for="how_we_work_1_stage_1"><?php _e( 'Номер:', 'ramnet' ); ?></label>
    <textarea id="how_we_work_1_stage_1" name="how_we_work_1_stage_1" rows="1" class="widefat"><?php echo esc_textarea( $how_we_work_1_stage_1 ); ?></textarea>
</p>
<p>
    <label for="how_we_work_1_stage_2"><?php _e( 'Стейдж 1-1:', 'ramnet' ); ?></label>
    <textarea id="how_we_work_1_stage_2" name="how_we_work_1_stage_2" rows="1" class="widefat"><?php echo esc_textarea( $how_we_work_1_stage_2 ); ?></textarea>
</p>
<p>
    <label for="how_we_work_1_stage_3"><?php _e( 'Стейдж 1-2:', 'ramnet' ); ?></label>
    <textarea id="how_we_work_1_stage_3" name="how_we_work_1_stage_3" rows="1" class="widefat"><?php echo esc_textarea( $how_we_work_1_stage_3 ); ?></textarea>
</p>


<p>
    <label for="how_we_work_2_stage_1"><?php _e( 'Номер:', 'ramnet' ); ?></label>
    <textarea id="how_we_work_2_stage_1" name="how_we_work_2_stage_1" rows="1" class="widefat"><?php echo esc_textarea( $how_we_work_2_stage_1 ); ?></textarea>
</p>
<p>
    <label for="how_we_work_2_stage_2"><?php _e( 'Стейдж 2-1:', 'ramnet' ); ?></label>
    <textarea id="how_we_work_2_stage_2" name="how_we_work_2_stage_2" rows="1" class="widefat"><?php echo esc_textarea( $how_we_work_2_stage_2 ); ?></textarea>
</p>
<p>
    <label for="how_we_work_2_stage_3"><?php _e( 'Стейдж 2-2:', 'ramnet' ); ?></label>
    <textarea id="how_we_work_2_stage_3" name="how_we_work_2_stage_3" rows="1" class="widefat"><?php echo esc_textarea( $how_we_work_2_stage_3 ); ?></textarea>
</p>

<hr>
<p>
    <label for="how_we_work_3_stage_1"><?php _e( 'Номер:', 'ramnet' ); ?></label>
    <textarea id="how_we_work_3_stage_1" name="how_we_work_3_stage_1" rows="1" class="widefat"><?php echo esc_textarea( $how_we_work_3_stage_1 ); ?></textarea>
</p>
<p>
    <label for="how_we_work_3_stage_2"><?php _e( 'Стейдж 3-1:', 'ramnet' ); ?></label>
    <textarea id="how_we_work_3_stage_2" name="how_we_work_3_stage_2" rows="1" class="widefat"><?php echo esc_textarea( $how_we_work_3_stage_2 ); ?></textarea>
</p>
<p>
    <label for="how_we_work_3_stage_3"><?php _e( 'Стейдж 3-2:', 'ramnet' ); ?></label>
    <textarea id="how_we_work_3_stage_3" name="how_we_work_3_stage_3" rows="1" class="widefat"><?php echo esc_textarea( $how_we_work_3_stage_3 ); ?></textarea>
</p>

<hr>
<p>
    <label for="how_we_work_4_stage_1"><?php _e( 'Номер:', 'ramnet' ); ?></label>
    <textarea id="how_we_work_4_stage_1" name="how_we_work_4_stage_1" rows="1" class="widefat"><?php echo esc_textarea( $how_we_work_4_stage_1 ); ?></textarea>
</p>
<p>
    <label for="how_we_work_4_stage_2"><?php _e( 'Стейдж 4-1:', 'ramnet' ); ?></label>
    <textarea id="how_we_work_4_stage_2" name="how_we_work_4_stage_2" rows="1" class="widefat"><?php echo esc_textarea( $how_we_work_4_stage_2 ); ?></textarea>
</p>
<p>
    <label for="how_we_work_4_stage_3"><?php _e( 'Стейдж 4-2:', 'ramnet' ); ?></label>
    <textarea id="how_we_work_4_stage_3" name="how_we_work_4_stage_3" rows="1" class="widefat"><?php echo esc_textarea( $how_we_work_4_stage_3 ); ?></textarea>
</p>

<h3><?php _e( 'Заголовок формы', 'ramnet' ); ?></h3>
<p>
    <label for="form_title"><?php _e( 'Текст:', 'ramnet' ); ?></label>
    <textarea id="form_title" name="form_title" rows="1" class="widefat"><?php echo esc_textarea( $form_title ); ?></textarea>
</p>
<p>
    <label for="form_title_second"><?php _e( 'Текст вторая строка:', 'ramnet' ); ?></label>
    <textarea id="form_title_second" name="form_title_second" rows="1" class="widefat"><?php echo esc_textarea( $form_title_second ); ?></textarea>
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
        'job_title_second',
        'job_subtitle',
        
        // Поля списка
        'list_line_1',
        'list_line_2',
        'list_line_3',
        'list_line_4',
        
        // Дополнительные поля
        'running_line',
        'promotion_date',
        'call_to_purchase',
        'description_title',
        'description_subtitle',
        'description_paragraph',
        'service_types',
        'type_1',
        'type_2',
        
        // Вопросы и ответы
        'questions_title',
        'questions_title_second',
        'answer_1',
        'answer_1_explanation',
        'answer_2',
        'answer_2_explanation',
        'answer_3',
        'answer_3_explanation',
        'answer_4',
        'answer_4_explanation',
        
        // Характеристики и особенности
        'characteristics',
        'characteristics_second_line',
        'specifications_description',
        'features',
        'features_description',
        'features_description_about_1',
        'features_description_about_1_text_1',
        'features_description_about_1_text_2',
        'features_description_about_1_text_3',
        'features_description_about_1_text_4',
        'features_description_about_1_text_5',
        'features_description_about_1_text_6',
        'features_description_about_2',
        'features_description_about_2_text_1',
        'features_description_about_2_text_2',
        'features_description_about_2_text_3',
        'features_description_about_2_text_4',
        'features_description_about_2_text_5',
        'features_description_about_2_text_6',
        'features_description_about_3',
        'features_description_about_3_text_1',
        'features_description_about_3_text_2',
        'features_description_about_3_text_3',
        'features_description_about_3_text_4',
        'features_description_about_3_text_5',
        'features_description_about_3_text_6',
        'features_description_about_4',
        'features_description_about_4_text_1',
        'features_description_about_4_text_2',
        'features_description_about_4_text_3',
        'features_description_about_4_text_4',
        'features_description_about_4_text_5',
        'features_description_about_4_text_6',
        'features_description_about_5',
        'features_description_about_5_text_1',
        'features_description_about_5_text_2',
        'features_description_about_5_text_3',
        'features_description_about_5_text_4',
        'features_description_about_5_text_5',
        'features_description_about_5_text_6',

        //Галерея
        'gallery_title',
        'gallery_title_second',

        //Отзывы
        'people_answer_say',
        'people_answer_text',

        //Как мы работаем
        'how_we_work',
        'how_we_work_1_stage_1',
        'how_we_work_1_stage_2',
        'how_we_work_1_stage_3',
        'how_we_work_2_stage_1',
        'how_we_work_2_stage_2',
        'how_we_work_2_stage_3',
        'how_we_work_3_stage_1',
        'how_we_work_3_stage_2',
        'how_we_work_3_stage_3',
        'how_we_work_4_stage_1',
        'how_we_work_4_stage_2',
        'how_we_work_4_stage_3',

        //ФОрма
        'form_title',
        'form_title_second',
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