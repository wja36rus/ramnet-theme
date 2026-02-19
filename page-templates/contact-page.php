<?php
/**
 * Template Name: Контакты
 *
 * @package RAMNET
 */

get_header(); ?>

<main id="primary" class="site-main contact-page">

    <?php
    while ( have_posts() ) :
        the_post();
        ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <div class="contact__container">

            <div class="contact__info">

                <header class="contact__header">
                    <h1 class="contact__title"><?php the_title(); ?></h1>
                    <?php if ( has_excerpt() ) : ?>
                    <p class="contact__subtitle"><?php echo get_the_excerpt(); ?></p>
                    <?php endif; ?>
                </header>

                <div class="contact__details">

                    <!-- Телефон -->
                    <div class="contact__detail-item">
                        <div class="contact__detail-icon">
                            <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/phone.svg' ); ?>"
                                alt="">
                        </div>
                        <div class="contact__detail-content">
                            <h3><?php echo esc_html__( 'Телефон', 'ramnet' ); ?></h3>
                            <p>
                                <a
                                    href="tel:<?php echo esc_attr( get_theme_mod( 'ramnet_phone', '+7 (XXX) XXX-XX-XX' ) ); ?>">
                                    <?php echo esc_html( get_theme_mod( 'ramnet_phone', '+7 (XXX) XXX-XX-XX' ) ); ?>
                                </a>
                            </p>
                            <p class="contact__note"><?php echo esc_html__( 'Ежедневно с 9:30 до 20:00', 'ramnet' ); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="contact__detail-item">
                        <div class="contact__detail-icon">
                            <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/email.svg' ); ?>"
                                alt="">
                        </div>
                        <div class="contact__detail-content">
                            <h3><?php echo esc_html__( 'Email', 'ramnet' ); ?></h3>
                            <p>
                                <a
                                    href="mailto:<?php echo esc_attr( get_theme_mod( 'ramnet_email', 'info@zasteklim.ru' ) ); ?>">
                                    <?php echo esc_html( get_theme_mod( 'ramnet_email', 'info@zasteklim.ru' ) ); ?>
                                </a>
                            </p>
                        </div>
                    </div>

                    <!-- Адрес -->
                    <div class="contact__detail-item">
                        <div class="contact__detail-icon">
                            <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/place.svg' ); ?>"
                                alt="">
                        </div>
                        <div class="contact__detail-content">
                            <h3><?php echo esc_html__( 'Адрес', 'ramnet' ); ?></h3>
                            <p><?php echo esc_html( get_theme_mod( 'ramnet_address', 'Воронеж, ул. Примерная, д. 10' ) ); ?>
                            </p>
                            <p class="contact__note">
                                <?php echo esc_html__( 'Работаем по Воронежу и области', 'ramnet' ); ?></p>
                        </div>
                    </div>

                    <!-- Режим работы -->
                    <div class="contact__detail-item">
                        <div class="contact__detail-icon">
                            <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/time.svg' ); ?>"
                                alt="">
                        </div>
                        <div class="contact__detail-content">
                            <h3><?php echo esc_html__( 'Режим работы', 'ramnet' ); ?></h3>
                            <?php 
                                $work_hours = get_theme_mod( 'ramnet_work_hours', 'Пн-Пт: 9:30 - 20:00, Сб-Вс: 10:00 - 18:00' );
                                $hours_array = explode( ',', $work_hours );
                                foreach ( $hours_array as $hours ) : 
                                ?>
                            <p><?php echo esc_html( trim( $hours ) ); ?></p>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>

                <!-- Социальные сети -->
                <?php 
                    $telegram = get_theme_mod( 'ramnet_telegram' );
                    $whatsapp = get_theme_mod( 'ramnet_whatsapp' );
                    
                    if ( $telegram || $whatsapp ) : 
                    ?>
                <div class="contact__social">
                    <h3><?php echo esc_html__( 'Мы в соцсетях', 'ramnet' ); ?></h3>
                    <div class="contact__social-links">
                        <?php if ( $telegram ) : ?>
                        <a href="<?php echo esc_url( $telegram ); ?>" class="contact__social-link" target="_blank"
                            rel="noopener">
                            <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/telegramm.svg' ); ?>"
                                alt="Telegram">
                        </a>
                        <?php endif; ?>

                        <?php if ( $whatsapp ) : ?>
                        <a href="<?php echo esc_url( $whatsapp ); ?>" class="contact__social-link" target="_blank"
                            rel="noopener">
                            <img src="<?php echo esc_url( RAMNET_THEME_URI . '/assets/images/icon/whatsapp.svg' ); ?>"
                                alt="WhatsApp">
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

            </div>

            <div class="contact__form-wrapper">
                <h2><?php echo esc_html__( 'Напишите нам', 'ramnet' ); ?></h2>
                <p class="contact__form-description">
                    <?php echo esc_html__( 'Оставьте свои контактные данные и мы свяжемся с вами в ближайшее время', 'ramnet' ); ?>
                </p>

                <?php get_template_part( 'template-parts/sections/form-section' ); ?>
            </div>

        </div>

        <?php the_content(); ?>

    </article>

    <?php
    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php
get_footer();