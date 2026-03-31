<?php
/**
 * Template Name: Страница проекта
 *
 * @package RAMNET
 */
$project_id = isset( $_GET['project_id'] ) ? intval( $_GET['project_id'] ) : 0;

 // Получаем услуги из базы данных
 $services = new WP_Query(array(
    'post_type'      => 'ramnet_job',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'post_status'    => 'publish',
    'p' => $project_id
));

get_header(); ?>

    <main>
        <?php
        $images = [];
        $gallery = [];

        
        if ($services->have_posts()):
            while ($services->have_posts()):
                $services->the_post();
                $content = get_the_content();
                
                $dom = new DOMDocument();
                libxml_use_internal_errors(true);
                $dom->loadHTML('<?xml encoding="UTF-8">' . $content);
                libxml_clear_errors();
                $xpath = new DOMXPath($dom);
                $galleryBlocks = $xpath->query('//*[contains(@class, "wp-block-gallery")]//img/@src');
                $imgBlocks = $xpath->query('//*[contains(@class, "wp-block-image")]//img/@src');
  
                foreach ($imgBlocks as $block){
                    $src = $block->textContent;
        
                    $images[] = [
                        'src' => $src,
                    ];
                }

                foreach ($galleryBlocks as $block){
                    $src = $block->textContent;
        
                    $gallery[] = [
                        'src' => $src,
                    ];
                }

                $pageData = [
                    'job_title' => ['data' => get_post_meta( get_the_ID(), '_job_title', true ), 'tag' => 'h1', 'class' => 'page-hero__title'],
                    'job_title_second' => ['data' => get_post_meta( get_the_ID(), '_job_title_second', true ), 'tag' => 'h1', 'class' => 'page-hero__title__second'],
                    'job_subtitle' => ['data' => get_post_meta( get_the_ID(), '_job_subtitle', true ), 'tag' => 'h2', 'class' => 'page-hero__title__small'],
                    'list_line_1' => ['data' => get_post_meta( get_the_ID(), '_list_line_1', true ), 'tag' => 'p', 'class' => ''],
                    'list_line_2' => ['data' => get_post_meta( get_the_ID(), '_list_line_2', true ), 'tag' => 'p', 'class' => ''],
                    'list_line_3' => ['data' => get_post_meta( get_the_ID(), '_list_line_3', true ), 'tag' => 'p', 'class' => ''],
                    'list_line_4' => ['data' => get_post_meta( get_the_ID(), '_list_line_4', true ), 'tag' => 'p', 'class' => ''],
                    'running_line' => get_post_meta( get_the_ID(), '_running_line', true ),
                    'promotion_date' => ['data' => get_post_meta( get_the_ID(), '_promotion_date', true ), 'tag' => 'p', 'class' => ''],
                    'call_to_purchase' => ['data' => get_post_meta( get_the_ID(), '_call_to_purchase', true ), 'tag' => 'span', 'class' => ''],
                    'description_title' => ['data' => get_post_meta( get_the_ID(), '_description_title', true ), 'tag' => '_', 'class' => ''],
                    'description_title_second' => ['data' => get_post_meta( get_the_ID(), '_description_title_second', true ), 'tag' => '_', 'class' => ''],
                    'description_subtitle' => ['data' => get_post_meta( get_the_ID(), '_description_subtitle', true ), 'tag' => '_', 'class' => ''],
                    'description_paragraph' => ['data' => get_post_meta( get_the_ID(), '_description_paragraph', true ), 'tag' => 'p', 'class' => 'solution__text'],
                    'description_paragraph_second' => ['data' => get_post_meta( get_the_ID(), '_description_paragraph_second', true ), 'tag' => 'p', 'class' => 'solution__text'],
                    'service_types' => ['data' => get_post_meta( get_the_ID(), '_service_types', true ), 'tag' => 'p', 'class' => 'solution__text'],
                    'type_1' => ['data' => get_post_meta( get_the_ID(), '_type_1', true ), 'tag' => '_', 'class' => ''],
                    'type_2' => ['data' => get_post_meta( get_the_ID(), '_type_2', true ), 'tag' => '_', 'class' => ''],
                    'questions_title' => ['data' => get_post_meta( get_the_ID(), '_questions_title', true ), 'tag' => '_', 'class' => ''],
                    'questions_title_second' => ['data' => get_post_meta( get_the_ID(), '_questions_title_second', true ), 'tag' => '_', 'class' => ''],
                    'answer_1' => ['data' => get_post_meta( get_the_ID(), '_answer_1', true ), 'tag' => 'h3', 'class' => ''],
                    'answer_1_explanation' => ['data' => get_post_meta( get_the_ID(), '_answer_1_explanation', true ), 'tag' => 'p', 'class' => ''],
                    'answer_2' => ['data' => get_post_meta( get_the_ID(), '_answer_2', true ), 'tag' => 'h3', 'class' => ''],
                    'answer_2_explanation' => ['data' => get_post_meta( get_the_ID(), '_answer_2_explanation', true ), 'tag' => 'p', 'class' => ''],
                    'answer_3' => ['data' => get_post_meta( get_the_ID(), '_answer_3', true ), 'tag' => 'h3', 'class' => ''],
                    'answer_3_explanation' => ['data' => get_post_meta( get_the_ID(), '_answer_3_explanation', true ), 'tag' => 'p', 'class' => ''],
                    'answer_4' => ['data' => get_post_meta( get_the_ID(), '_answer_4', true ), 'tag' => 'h3', 'class' => ''],
                    'answer_4_explanation' => ['data' => get_post_meta( get_the_ID(), '_answer_4_explanation', true ), 'tag' => 'p', 'class' => ''],
                    'characteristics' => ['data' => get_post_meta( get_the_ID(), '_characteristics', true ), 'tag' => 'h2', 'class' => 'specs-features__section-title'],
                    'characteristics_second_line' => ['data' => get_post_meta( get_the_ID(), '_characteristics_second_line', true ), 'tag' => 'h2', 'class' => 'specs-features__section-title'],
                    'specifications_description' => ['data' => get_post_meta( get_the_ID(), '_specifications_description', true ), 'tag' => 'p', 'class' => 'specs-features__desc'],
                    'features' => ['data' => get_post_meta( get_the_ID(), '_features', true ), 'tag' => 'h2', 'class' => 'specs-features__section-title'],
                    'features_description' => ['data' => get_post_meta( get_the_ID(), '_features_description', true ), 'tag' => 'p', 'class' => 'specs-features__desc'],
                    'features_description_about_1' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_1', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_1_text_1' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_1_text_1', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_1_text_2' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_1_text_2', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_1_text_3' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_1_text_3', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_1_text_4' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_1_text_4', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_1_text_5' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_1_text_5', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_1_text_6' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_1_text_6', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_2' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_2', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_2_text_1' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_2_text_1', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_2_text_2' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_2_text_2', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_2_text_3' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_2_text_3', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_2_text_4' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_2_text_4', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_2_text_5' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_2_text_5', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_2_text_6' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_2_text_6', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_3' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_3', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_3_text_1' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_3_text_1', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_3_text_2' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_3_text_2', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_3_text_3' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_3_text_3', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_3_text_4' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_3_text_4', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_3_text_5' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_3_text_5', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_3_text_6' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_3_text_6', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_4' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_4', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_4_text_1' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_4_text_1', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_4_text_2' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_4_text_2', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_4_text_3' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_4_text_3', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_4_text_4' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_4_text_4', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_4_text_5' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_4_text_5', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_4_text_6' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_4_text_6', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_5' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_5', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_5_text_1' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_5_text_1', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_5_text_2' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_5_text_2', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_5_text_3' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_5_text_3', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_5_text_4' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_5_text_4', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_5_text_5' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_5_text_5', true ), 'tag' => '_', 'class' => ''],
                    'features_description_about_5_text_6' => ['data' => get_post_meta( get_the_ID(), '_features_description_about_5_text_6', true ), 'tag' => '_', 'class' => ''],
                    'gallery_title' => ['data' => get_post_meta( get_the_ID(), '_gallery_title', true ), 'tag' => '_', 'class' => ''],
                    'gallery_title_second' => ['data' => get_post_meta( get_the_ID(), '_gallery_title_second', true ), 'tag' => '_', 'class' => ''],
                    'people_answer_say' => ['data' => get_post_meta( get_the_ID(), '_people_answer_say', true ), 'tag' => '_', 'class' => ''],
                    'people_answer_text' => ['data' => get_post_meta( get_the_ID(), '_people_answer_text', true ), 'tag' => '_', 'class' => ''],
                    'how_we_work' => ['data' => get_post_meta( get_the_ID(), '_how_we_work', true ), 'tag' => '_', 'class' => ''],
                    'how_we_work_1_stage_1' => ['data' => get_post_meta( get_the_ID(), '_how_we_work_1_stage_1', true ), 'tag' => '_', 'class' => ''],
                    'how_we_work_1_stage_2' => ['data' => get_post_meta( get_the_ID(), '_how_we_work_1_stage_2', true ), 'tag' => '_', 'class' => ''],
                    'how_we_work_1_stage_3' => ['data' => get_post_meta( get_the_ID(), '_how_we_work_1_stage_3', true ), 'tag' => '_', 'class' => ''],
                    'how_we_work_2_stage_1' => ['data' => get_post_meta( get_the_ID(), '_how_we_work_2_stage_1', true ), 'tag' => '_', 'class' => ''],
                    'how_we_work_2_stage_2' => ['data' => get_post_meta( get_the_ID(), '_how_we_work_2_stage_2', true ), 'tag' => '_', 'class' => ''],
                    'how_we_work_2_stage_3' => ['data' => get_post_meta( get_the_ID(), '_how_we_work_2_stage_3', true ), 'tag' => '_', 'class' => ''],
                    'how_we_work_3_stage_1' => ['data' => get_post_meta( get_the_ID(), '_how_we_work_3_stage_1', true ), 'tag' => '_', 'class' => ''],
                    'how_we_work_3_stage_2' => ['data' => get_post_meta( get_the_ID(), '_how_we_work_3_stage_2', true ), 'tag' => '_', 'class' => ''],
                    'how_we_work_3_stage_3' => ['data' => get_post_meta( get_the_ID(), '_how_we_work_3_stage_3', true ), 'tag' => '_', 'class' => ''],
                    'how_we_work_4_stage_1' => ['data' => get_post_meta( get_the_ID(), '_how_we_work_4_stage_1', true ), 'tag' => '_', 'class' => ''],
                    'how_we_work_4_stage_2' => ['data' => get_post_meta( get_the_ID(), '_how_we_work_4_stage_2', true ), 'tag' => '_', 'class' => ''],
                    'how_we_work_4_stage_3' => ['data' => get_post_meta( get_the_ID(), '_how_we_work_4_stage_3', true ), 'tag' => '_', 'class' => ''],
                    'form_title' => ['data' => get_post_meta( get_the_ID(), '_form_title', true ), 'tag' => '_', 'class' => ''],
                    'form_title_second' => ['data' => get_post_meta( get_the_ID(), '_form_title_second', true ), 'tag' => '_', 'class' => '']
                ];

                function getDataInArrayPage($pageData, $key, $tag = "", $class = "") {
                    if(isset($pageData[$key])) {
                        // Если данные пришли как массив с data, tag, class
                        if (is_array($pageData[$key]) && isset($pageData[$key]['data'])) {
                            $data = $pageData[$key]['data'];
                            $tag = isset($pageData[$key]['tag']) ? $pageData[$key]['tag'] : $tag;
                            $class = isset($pageData[$key]['class']) ? $pageData[$key]['class'] : $class;
                        } else {
                            $data = $pageData[$key];
                        }
                        
                        if(empty($data)) {
                            return '';
                        }

                        if ($tag !== '_' && $tag !== '') {
                            $tags = $tag;
                            if($class !== "") {
                                $startTag = "<$tags class='$class'>";
                            } else { 
                                $startTag = "<$tags>";
                            }
                  
                            $endTag = "</$tags>";
    
                            return "$startTag$data$endTag";
                        } else {
                            return $data;
                        }
                    }
                    return '';
                }

                function isExistData($pageData, $key) {
                    if(isset($pageData[$key])) {
                        $data = is_array($pageData[$key]) ? $pageData[$key]['data'] : $pageData[$key];
                        return !empty($data);
                    }
                    return false;
                }

                
                ?>

        <!-- 1-й экран -->
        <section class="page-hero">
            <div class="page-hero__container">
                <div class="page-hero__content">
                    <?php echo getDataInArrayPage($pageData, 'job_title'); ?>
                    <?php echo getDataInArrayPage($pageData, 'job_title_second'); ?>
                    <?php echo getDataInArrayPage($pageData, 'job_subtitle'); ?>
                    <div class="hero__stats">
                        <?php if(isExistData($pageData, 'list_line_1')):?>
                        <div class="hero__stat-item">
                            <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg');?>" alt="">
                            <?php echo getDataInArrayPage($pageData, 'list_line_1'); ?>
                        </div>
                        <?php endif;?>
                        
                        <?php if(isExistData($pageData, 'list_line_2')):?>
                        <div class="hero__stat-item">
                            <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg');?>" alt="">
                            <?php echo getDataInArrayPage($pageData, 'list_line_2'); ?>
                        </div>
                        <?php endif;?>
                        
                        <?php if(isExistData($pageData, 'list_line_3')):?>
                        <div class="hero__stat-item">
                            <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg');?>" alt="">
                            <?php echo getDataInArrayPage($pageData, 'list_line_3'); ?>
                        </div>
                        <?php endif;?>
                        
                        <?php if(isExistData($pageData, 'list_line_4')):?>
                        <div class="hero__stat-item">
                            <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg');?>" alt="">
                            <?php echo getDataInArrayPage($pageData, 'list_line_4'); ?>
                        </div>
                        <?php endif;?>

                        <div class="button__container__main" style="width: auto; text-align: left; padding-top: 50px;">
                            <button class="button__main call__open__form"><p class="button__text">ПОЛУЧИТЬ КОНСУЛЬТАЦИЮ</p></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(!empty($images[0]['src'])):?>
            <div class="page-hero__image" style="background-image: url('<?php echo esc_url($images[0]['src']); ?>');"></div>
            <?php endif;?>
            
            <?php echo getDataInArrayPage($pageData, 'running_line','span', "hero__lines");?>
            <?php echo getDataInArrayPage($pageData, 'running_line','span', "hero__lines__second");?>
            <?php echo getDataInArrayPage($pageData, 'running_line','span', "hero__lines__third");?>
        </section>

        <?php if(isExistData($pageData, 'promotion_date') || isExistData($pageData, 'call_to_purchase')):?>
        <section class="action">
            <div class="action__container">
                <div class="hero__promo" <?php echo !empty($images[1]['src']) ? 'style="background-image: url(' . esc_url($images[1]['src']) . ');"' : ''; ?>>
                    <?php echo getDataInArrayPage($pageData, 'promotion_date'); ?>
                    <?php echo getDataInArrayPage($pageData, 'call_to_purchase'); ?>
                    
                    <div class="button__container__main" style="width: 50%; text-align: center; padding-top: 20px;">
                        <button class="button__main__black call__open__form"><p class="button__text">ЗАКАЗАТЬ</p></button>
                    </div>
                </div>
            </div>
        </section>
        <?php endif;?>

        <?php if(isExistData($pageData, 'description_title') || isExistData($pageData, 'description_paragraph')):?>
        <!-- Современное решение -->
        <section class="solution">
            <div class="solution__container">
                <?php if(isExistData($pageData, 'description_title') || isExistData($pageData, 'description_subtitle')):?>
                <h2 class="solution__title">
                    <?php echo getDataInArrayPage($pageData, 'description_title'); ?>
                    <?php if(isExistData($pageData, 'description_title_second')):?><br><?php echo getDataInArrayPage($pageData, 'description_title_second'); ?><?php endif;?>
                    <?php if(isExistData($pageData, 'description_subtitle')):?><br>
                    <strong><?php echo getDataInArrayPage($pageData, 'description_subtitle'); ?></strong>
                    <?php endif;?>
                </h2>
                <?php endif;?>
                
                <?php echo getDataInArrayPage($pageData, 'description_paragraph'); ?>
                
                <?php if(isExistData($pageData, 'description_paragraph_second')):?>
                <br>
                <?php echo getDataInArrayPage($pageData, 'description_paragraph_second'); ?>
                <?php endif;?>
                
                <?php if(isExistData($pageData, 'service_types')):?>
                <br>
                <?php echo getDataInArrayPage($pageData, 'service_types'); ?>
                <?php endif;?>
                
                <?php if(isExistData($pageData, 'type_1')):?>
                <br>
                <p class="solution__text__flex">
                    <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/cross_q.svg' ); ?>" alt="">
                    <?php echo getDataInArrayPage($pageData, 'type_1'); ?>
                </p>
                <?php endif;?>
                
                <?php if(isExistData($pageData, 'type_2')):?>
                <br>
                <p class="solution__text__flex">
                    <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/cross_q.svg' ); ?>" alt="">
                    <?php echo getDataInArrayPage($pageData, 'type_2'); ?>
                </p>
                <?php endif;?>
            </div>
        </section>
        <?php endif;?>

        <?php if(isExistData($pageData, 'questions_title') || isExistData($pageData, 'answer_1')):?>
        <!-- ПОЧЕМУ ВЫБИРАЮТ -->
        <section class="benefits">
            <div class="benefits__container">
                <?php if(isExistData($pageData, 'questions_title')):?>
                <h2 class="section__title">
                    <?php echo getDataInArrayPage($pageData, 'questions_title'); ?>
                    <?php if(isExistData($pageData, 'questions_title_second')):?><br><?php echo getDataInArrayPage($pageData, 'questions_title_second'); ?><?php endif;?>
                </h2>
                <?php endif;?>
                
                <div class="benefits__grid">
                    <?php if(isExistData($pageData, 'answer_1')):?>
                    <div class="benefit__item">
                        <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg')?>" alt="">
                        <div class="benefit__content">
                            <?php echo getDataInArrayPage($pageData, 'answer_1'); ?>
                            <?php echo getDataInArrayPage($pageData, 'answer_1_explanation'); ?>
                        </div>
                    </div>
                    <?php endif;?>
                    
                    <?php if(isExistData($pageData, 'answer_2')):?>
                    <div class="benefit__item">
                        <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg');?>" alt="">
                        <div class="benefit__content">
                            <?php echo getDataInArrayPage($pageData, 'answer_2'); ?>
                            <?php echo getDataInArrayPage($pageData, 'answer_2_explanation'); ?>
                        </div>
                    </div>
                    <?php endif;?>
                    
                    <?php if(isExistData($pageData, 'answer_3')):?>
                    <div class="benefit__item">
                        <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg');?>" alt="">
                        <div class="benefit__content">
                            <?php echo getDataInArrayPage($pageData, 'answer_3'); ?>
                            <?php echo getDataInArrayPage($pageData, 'answer_3_explanation'); ?>
                        </div>
                    </div>
                    <?php endif;?>
                    
                    <?php if(isExistData($pageData, 'answer_4')):?>
                    <div class="benefit__item">
                        <img src="<?php echo esc_url( RAMNET_THEME_URI.'/assets/images/icon/divider.svg')?>" alt="">
                        <div class="benefit__content">
                            <?php echo getDataInArrayPage($pageData, 'answer_4'); ?>
                            <?php echo getDataInArrayPage($pageData, 'answer_4_explanation'); ?>
                        </div>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </section>
        <?php endif;?>

        <?php if(isExistData($pageData, 'characteristics') || isExistData($pageData, 'features')):?>
        <!-- Технические характеристики и особенности -->
        <section class="specs-features">
            <div class="specs-features__container">
                <?php if(isExistData($pageData, 'characteristics') || isExistData($pageData, 'specifications_description')):?>
                <div class="spec__flex">
                    <?php if(isExistData($pageData, 'characteristics')):?>
                    <div>
                        <?php echo getDataInArrayPage($pageData, 'characteristics'); ?>
                        <?php echo getDataInArrayPage($pageData, 'characteristics_second_line'); ?>
                    </div>
                    <?php endif;?>
                    <?php echo getDataInArrayPage($pageData, 'specifications_description'); ?>
                </div>
                <?php endif;?>

                <?php if(isExistData($pageData, 'features')):?>
                <div class="spec__flex__second">
                    <div>
                        <?php echo getDataInArrayPage($pageData, 'features'); ?>
                        <?php echo getDataInArrayPage($pageData, 'features_description'); ?>
                    </div>

                    <div class="features__list">
                        <?php if(isExistData($pageData, 'features_description_about_1')):?>
                        <div class="feature__group">
                            <h4><?php echo getDataInArrayPage($pageData, 'features_description_about_1'); ?></h4>
                            <div class="feature__tags">
                                <?php for($i = 1; $i <= 6; $i++):?>
                                    <?php $textKey = 'features_description_about_1_text_' . $i;?>
                                    <?php if(isExistData($pageData, $textKey)):?>
                                        <span class="feature__tag">
                                            <?php echo getDataInArrayPage($pageData, $textKey);?>
                                        </span>
                                    <?php endif;?>
                                <?php endfor;?>
                            </div>
                        </div>
                        <?php endif;?>
                        
                        <?php if(isExistData($pageData, 'features_description_about_2')):?>
                        <div class="feature__group">
                            <h4><?php echo getDataInArrayPage($pageData, 'features_description_about_2'); ?></h4>
                            <div class="feature__tags">
                                <?php for($i = 1; $i <= 6; $i++):?>
                                    <?php $textKey = 'features_description_about_2_text_' . $i;?>
                                    <?php if(isExistData($pageData, $textKey)):?>
                                        <span class="feature__tag">
                                            <?php echo getDataInArrayPage($pageData, $textKey);?>
                                        </span>
                                    <?php endif;?>
                                <?php endfor;?>
                            </div>
                        </div>
                        <?php endif;?>
                        
                        <?php if(isExistData($pageData, 'features_description_about_3')):?>
                        <div class="feature__group">
                            <h4><?php echo getDataInArrayPage($pageData, 'features_description_about_3'); ?></h4>
                            <div class="feature__tags">
                                <?php for($i = 1; $i <= 6; $i++):?>
                                    <?php $textKey = 'features_description_about_3_text_' . $i;?>
                                    <?php if(isExistData($pageData, $textKey)):?>
                                        <span class="feature__tag">
                                            <?php echo getDataInArrayPage($pageData, $textKey);?>
                                        </span>
                                    <?php endif;?>
                                <?php endfor;?>
                            </div>
                        </div>
                        <?php endif;?>
                        
                        <?php if(isExistData($pageData, 'features_description_about_4')):?>
                        <div class="feature__group">
                            <h4><?php echo getDataInArrayPage($pageData, 'features_description_about_4'); ?></h4>
                            <div class="feature__tags">
                                <?php for($i = 1; $i <= 6; $i++):?>
                                    <?php $textKey = 'features_description_about_4_text_' . $i;?>
                                    <?php if(isExistData($pageData, $textKey)):?>
                                        <span class="feature__tag">
                                            <?php echo getDataInArrayPage($pageData, $textKey);?>
                                        </span>
                                    <?php endif;?>
                                <?php endfor;?>
                            </div>
                        </div>
                        <?php endif;?>
                        
                        <?php if(isExistData($pageData, 'features_description_about_5')):?>
                        <div class="feature__group">
                            <h4><?php echo getDataInArrayPage($pageData, 'features_description_about_5'); ?></h4>
                            <div class="feature__tags">
                                <?php for($i = 1; $i <= 6; $i++):?>
                                    <?php $textKey = 'features_description_about_5_text_' . $i;?>
                                    <?php if(isExistData($pageData, $textKey)):?>
                                        <span class="feature__tag">
                                            <?php echo getDataInArrayPage($pageData, $textKey);?>
                                        </span>
                                    <?php endif;?>
                                <?php endfor;?>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
                <?php endif;?>
            </div>
        </section>
        <?php endif;?>

        <?php if(!empty($gallery)):?>
        <!-- Галерея проектов -->
        <section class="gallery">
            <div class="gallery__container">
                <?php if(isExistData($pageData, 'gallery_title')):?>
                <h2 class="section__title">
                    <?php echo getDataInArrayPage($pageData, 'gallery_title'); ?>
                    <?php if(isExistData($pageData, 'gallery_title_second')):?><br><?php echo getDataInArrayPage($pageData, 'gallery_title_second'); ?><?php endif;?>
                </h2>
                <?php endif;?>
            </div>
            <div class="flexslider">
                <ul class="slides">
                    <?php foreach($gallery as $value):?>
                        <li>
                            <div class="gallery__item" style="background-image: url(<?php echo esc_url($value['src']); ?>);">
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="gallery__container">
                <!-- Блок с отзывами внутри галереи, как в ТЗ -->
                <?php if(isExistData($pageData, 'people_answer_say') || isExistData($pageData, 'people_answer_text')):?>
                <div style="display: flex; justify-content: space-between; align-items: center; gap: 40px; margin-top: 40px;">
                    <div>
                        <?php if(isExistData($pageData, 'people_answer_say')):?>
                        <h3 style="color: white; font-size: 26px; font-weight: 400; font-style: italic; max-width: 700px;">
                            <?php echo getDataInArrayPage($pageData, 'people_answer_say'); ?>
                        </h3>
                        <?php endif;?>
                        <?php if(isExistData($pageData, 'people_answer_text')):?>
                        <p style="color: rgba(255,255,255,0.6); margin-top: 10px;"><?php echo getDataInArrayPage($pageData, 'people_answer_text'); ?></p>
                        <?php endif;?>
                    </div>
                    <a href="<?= home_url()?>/#people" style="text-decoration: none;"><button class="button__main"><p class="button__text">ОТЗЫВЫ</p></button></a>
                </div>
                <?php endif;?>
            </div>
        </section>
        <?php endif;?>

        <?php if(isExistData($pageData, 'how_we_work')):?>
        <!-- Как мы работаем -->
        <section class="work-steps">
            <div class="work-steps__container">
                <h2 class="section__title"><?php echo getDataInArrayPage($pageData, 'how_we_work'); ?></h2>
                <div class="steps__grid">
                    <?php if(isExistData($pageData, 'how_we_work_1_stage_1') || isExistData($pageData, 'how_we_work_1_stage_2')):?>
                    <div class="step__card">
                        <div class="step__number"><?php echo getDataInArrayPage($pageData, 'how_we_work_1_stage_1'); ?></div>
                        <div class="step__title"><?php echo getDataInArrayPage($pageData, 'how_we_work_1_stage_2'); ?></div>
                        <div class="step__desc"><?php echo getDataInArrayPage($pageData, 'how_we_work_1_stage_3'); ?></div>
                    </div>
                    <?php endif;?>
                    
                    <?php if(isExistData($pageData, 'how_we_work_2_stage_1') || isExistData($pageData, 'how_we_work_2_stage_2')):?>
                    <div class="step__card">
                        <div class="step__number"><?php echo getDataInArrayPage($pageData, 'how_we_work_2_stage_1'); ?></div>
                        <div class="step__title"><?php echo getDataInArrayPage($pageData, 'how_we_work_2_stage_2'); ?></div>
                        <div class="step__desc"><?php echo getDataInArrayPage($pageData, 'how_we_work_2_stage_3'); ?></div>
                    </div>
                    <?php endif;?>
                    
                    <?php if(isExistData($pageData, 'how_we_work_3_stage_1') || isExistData($pageData, 'how_we_work_3_stage_2')):?>
                    <div class="step__card">
                        <div class="step__number"><?php echo getDataInArrayPage($pageData, 'how_we_work_3_stage_1'); ?></div>
                        <div class="step__title"><?php echo getDataInArrayPage($pageData, 'how_we_work_3_stage_2'); ?></div>
                        <div class="step__desc"><?php echo getDataInArrayPage($pageData, 'how_we_work_3_stage_3'); ?></div>
                    </div>
                    <?php endif;?>
                    
                    <?php if(isExistData($pageData, 'how_we_work_4_stage_1') || isExistData($pageData, 'how_we_work_4_stage_2')):?>
                    <div class="step__card">
                        <div class="step__number"><?php echo getDataInArrayPage($pageData, 'how_we_work_4_stage_1'); ?></div>
                        <div class="step__title"><?php echo getDataInArrayPage($pageData, 'how_we_work_4_stage_2'); ?></div>
                        <div class="step__desc"><?php echo getDataInArrayPage($pageData, 'how_we_work_4_stage_3'); ?></div>
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </section>
        <?php endif;?>

        <?php if(isExistData($pageData, 'form_title') && !empty($images)):?>
        <section class="form">
            <div class="form__container">
                <div class="form__inner">
                    <h1 class="form__title__second">
                        <?php echo getDataInArrayPage($pageData, 'form_title'); ?><br>
                        <?php echo getDataInArrayPage($pageData, 'form_title_second'); ?><br>
                    </h1>

                    <form id="form" novalidate>
                        <input type="text" name="username" class="form__input"
                            placeholder="<?php echo esc_attr__( 'Имя', 'ramnet' ); ?>">
                        <input name="phone" type="text" class="form__input phone-mask" placeholder="+7">
                        <span>
                            <?php echo esc_html('Нажимая на кнопку, Вы даете согласие ');?><br>
                            <?php echo esc_html('на обработку персональных данных');?>
                        </span>
                        <div class="button__container__project">
                            <button id="form__submit" class="button__main call__open__form">
                                <p class="button__text"><?php echo esc_html( 'РАССЧИТАТЬ СТОИМОСТЬ', 'ramnet' ); ?></p>
                            </button>
                        </div>
                    </form>
                </div>
                <?php $img = $images[count($images) - 1]['src']; ?>
                <img class="form__images" src="<?php echo esc_url($img); ?>" alt="">
                <img class="form__images__fon" src="<?php echo esc_url($img); ?>" alt="">
            </div>
        </section>
        <?php endif;?>

        <?php endwhile; ?>
        <?php endif; ?>

    </main>

<?php get_footer(); ?>