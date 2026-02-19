<?php
/**
 * Template Name: Главная страница
 *
 * @package RAMNET
 */

get_header(); ?>

<main>
    <?php
    // Подключаем секции главной страницы в правильном порядке
    get_template_part( 'template-parts/sections/hero-section' );
    get_template_part( 'template-parts/sections/service-section' );
    get_template_part( 'template-parts/sections/jobs-section' );
    get_template_part( 'template-parts/sections/business-section' );
    get_template_part( 'template-parts/sections/boss-section' );
    get_template_part( 'template-parts/sections/time-section' );
    get_template_part( 'template-parts/sections/say-section' );
    get_template_part( 'template-parts/sections/project-section' );
    get_template_part( 'template-parts/sections/people-section' );
    get_template_part( 'template-parts/sections/quietion-section' );
    get_template_part( 'template-parts/sections/form-section' );
    ?>
</main>

<?php
get_footer();