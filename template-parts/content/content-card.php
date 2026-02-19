<?php
/**
 * Template part for displaying posts in card layout
 *
 * @package RAMNET
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'content-card' ); ?>>

    <?php if ( has_post_thumbnail() ) : ?>
    <div class="card-image">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail( 'ramnet-project-thumb' ); ?>
        </a>
    </div>
    <?php endif; ?>

    <div class="card-content">

        <header class="card-header">
            <?php
            the_title( '<h3 class="card-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
            
            if ( 'post' === get_post_type() ) :
                ?>
            <div class="card-meta">
                <span class="posted-on">
                    <?php echo get_the_date(); ?>
                </span>
            </div>
            <?php endif; ?>
        </header>

        <div class="card-excerpt">
            <?php the_excerpt(); ?>
        </div>

        <div class="card-footer">
            <a href="<?php the_permalink(); ?>" class="button__main card-button">
                <p class="button__text"><?php esc_html_e( 'ПОДРОБНЕЕ', 'ramnet' ); ?></p>
            </a>

            <?php if ( has_term( '', 'project-category' ) ) : ?>
            <div class="card-categories">
                <?php the_terms( get_the_ID(), 'project-category', '', ', ' ); ?>
            </div>
            <?php endif; ?>
        </div>

    </div>

</article><!-- #post-<?php the_ID(); ?> -->