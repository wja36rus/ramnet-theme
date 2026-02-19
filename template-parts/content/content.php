<?php
/**
 * Template part for displaying posts
 *
 * @package RAMNET
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="entry-header">
        <?php
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        endif;
        
        if ( 'post' === get_post_type() ) :
            ?>
        <div class="entry-meta">
            <?php
                ramnet_posted_on();
                ramnet_posted_by();
                ?>
        </div>
        <?php endif; ?>
    </header>

    <?php if ( has_post_thumbnail() && ! is_singular() ) : ?>
    <div class="post-thumbnail">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail( 'large' ); ?>
        </a>
    </div>
    <?php endif; ?>

    <div class="entry-content">
        <?php
        if ( is_singular() ) :
            the_content(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. */
                        __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'ramnet' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    the_title( '<span class="screen-reader-text">"', '"</span>', false )
                )
            );
            
            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ramnet' ),
                    'after'  => '</div>',
                )
            );
        else :
            the_excerpt();
            ?>
        <a href="<?php the_permalink(); ?>" class="read-more">
            <?php esc_html_e( 'Read More', 'ramnet' ); ?>
        </a>
        <?php endif; ?>
    </div>

    <footer class="entry-footer">
        <?php ramnet_entry_footer(); ?>
    </footer>

</article><!-- #post-<?php the_ID(); ?> -->