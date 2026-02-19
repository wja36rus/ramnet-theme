<?php
/**
 * The template for displaying archive pages
 *
 * @package RAMNET
 */

get_header(); ?>

<main id="primary" class="site-main">

    <?php if ( have_posts() ) : ?>

    <header class="page-header">
        <?php
            the_archive_title( '<h1 class="page-title">', '</h1>' );
            the_archive_description( '<div class="archive-description">', '</div>' );
            ?>
    </header><!-- .page-header -->

    <?php
        /* Start the Loop */
        while ( have_posts() ) :
            the_post();
            
            /*
             * Include the Post-Type-specific template for the content.
             */
            get_template_part( 'template-parts/content/content', get_post_type() );
            
        endwhile;
        
        the_posts_navigation();
        
    else :
        
        get_template_part( 'template-parts/content/content', 'none' );
        
    endif;
    ?>

</main><!-- #main -->

<?php
get_footer();