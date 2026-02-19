<?php
/**
 * The template for displaying search results pages
 *
 * @package RAMNET
 */

get_header(); ?>

<main id="primary" class="site-main">

    <?php if ( have_posts() ) : ?>

    <header class="page-header">
        <h1 class="page-title">
            <?php
                /* translators: %s: search query. */
                printf( esc_html__( 'Результаты поиска: %s', 'ramnet' ), '<span>' . get_search_query() . '</span>' );
                ?>
        </h1>
    </header><!-- .page-header -->

    <?php
        /* Start the Loop */
        while ( have_posts() ) :
            the_post();
            
            /**
             * Run the loop for the search to output the results.
             */
            get_template_part( 'template-parts/content/content', 'search' );
            
        endwhile;
        
        the_posts_navigation();
        
    else :
        
        get_template_part( 'template-parts/content/content', 'none' );
        
    endif;
    ?>

</main><!-- #main -->

<?php
get_footer();