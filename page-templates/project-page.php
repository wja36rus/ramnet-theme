<?php
/**
 * Template Name: Страница одного проекта
 *
 * @package RAMNET
 */

get_header(); ?>

<main>
    <?php
    get_template_part( 'template-parts/sections/service-page-section' );
    get_template_part( 'template-parts/sections/form-project-section' );
    ?>
</main>

<?php
get_footer();