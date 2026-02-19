<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package RAMNET
 */

get_header(); ?>

<main id="primary" class="site-main">

    <section class="error-404 not-found">

        <header class="page-header">
            <h1 class="page-title"><?php esc_html_e( '404', 'ramnet' ); ?></h1>
            <h2 class="page-subtitle"><?php esc_html_e( 'Страница не найдена', 'ramnet' ); ?></h2>
        </header><!-- .page-header -->

        <div class="page-content">
            <p><?php esc_html_e( 'К сожалению, страница, которую вы ищете, не существует или была перемещена.', 'ramnet' ); ?>
            </p>

            <div class="button__container__main">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="button__main">
                    <p class="button__text"><?php esc_html_e( 'ВЕРНУТЬСЯ НА ГЛАВНУЮ', 'ramnet' ); ?></p>
                </a>
            </div>

        </div><!-- .page-content -->

    </section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();