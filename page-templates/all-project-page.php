<?php
/**
 * Template Name: Страница всех проектов
 *
 * @package RAMNET
 */

get_header(); ?>

<main>
    <?php
    get_template_part( 'template-parts/sections/all-project-section' );
    get_template_part( 'template-parts/sections/form-project-section' );
    ?>
</main>

<?php
get_footer();