<?php
/**
 * Template Name: Страница проекта
 *
 * @package RAMNET
 */

get_header(); ?>

<main>
    <?php
    get_template_part( 'template-parts/sections/service-page-section' );
    get_template_part( 'template-parts/sections/form-service-section' );
    ?>
</main>

<?php
get_footer();