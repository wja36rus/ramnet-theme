<?php
/**
 * Widgets registration and custom widgets
 *
 * @package RAMNET
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Register widget areas
 */
function ramnet_widgets_init() {
    
    // Sidebar for blog
    register_sidebar(
        array(
            'name'          => __( 'Боковая панель блога', 'ramnet' ),
            'id'            => 'sidebar-blog',
            'description'   => __( 'Добавьте виджеты для боковой панели блога', 'ramnet' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
    
    // Footer widgets area
    register_sidebar(
        array(
            'name'          => __( 'Подвал - колонка 1', 'ramnet' ),
            'id'            => 'footer-1',
            'description'   => __( 'Первая колонка в подвале', 'ramnet' ),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="footer-widget-title">',
            'after_title'   => '</h4>',
        )
    );
    
    register_sidebar(
        array(
            'name'          => __( 'Подвал - колонка 2', 'ramnet' ),
            'id'            => 'footer-2',
            'description'   => __( 'Вторая колонка в подвале', 'ramnet' ),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="footer-widget-title">',
            'after_title'   => '</h4>',
        )
    );
    
    register_sidebar(
        array(
            'name'          => __( 'Подвал - колонка 3', 'ramnet' ),
            'id'            => 'footer-3',
            'description'   => __( 'Третья колонка в подвале', 'ramnet' ),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="footer-widget-title">',
            'after_title'   => '</h4>',
        )
    );
    
    // Home page sections (optional)
    register_sidebar(
        array(
            'name'          => __( 'Главная - перед секциями', 'ramnet' ),
            'id'            => 'home-top',
            'description'   => __( 'Область перед секциями на главной странице', 'ramnet' ),
            'before_widget' => '<div id="%1$s" class="home-widget home-top-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="home-widget-title">',
            'after_title'   => '</h2>',
        )
    );
    
    register_sidebar(
        array(
            'name'          => __( 'Главная - после секций', 'ramnet' ),
            'id'            => 'home-bottom',
            'description'   => __( 'Область после секций на главной странице', 'ramnet' ),
            'before_widget' => '<div id="%1$s" class="home-widget home-bottom-widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="home-widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'ramnet_widgets_init' );

/**
 * Custom Widget: Recent Projects
 */
class Ramnet_Recent_Projects_Widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'ramnet_recent_projects',
            __( 'РАМ.НЕТ: Последние проекты', 'ramnet' ),
            array(
                'description' => __( 'Отображает последние реализованные проекты', 'ramnet' ),
                'classname'   => 'widget-recent-projects',
            )
        );
    }
    
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        
        $number = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : 3;
        
        $projects = new WP_Query( array(
            'post_type'      => 'ramnet_project',
            'posts_per_page' => $number,
            'orderby'        => 'date',
            'order'          => 'DESC',
            'post_status'    => 'publish',
        ) );
        
        if ( $projects->have_posts() ) :
            echo '<div class="recent-projects-list">';
            
            while ( $projects->have_posts() ) : $projects->the_post();
                ?>
<div class="recent-project-item">
    <?php if ( has_post_thumbnail() ) : ?>
    <div class="project-thumb">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail( 'thumbnail' ); ?>
        </a>
    </div>
    <?php endif; ?>

    <div class="project-info">
        <h4 class="project-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h4>

        <?php
                        $location = get_post_meta( get_the_ID(), '_project_location', true );
                        $year = get_post_meta( get_the_ID(), '_project_year', true );
                        
                        if ( $location || $year ) :
                            ?>
        <div class="project-meta">
            <?php if ( $location ) : ?>
            <span class="project-location"><?php echo esc_html( $location ); ?></span>
            <?php endif; ?>

            <?php if ( $year ) : ?>
            <span class="project-year"><?php echo esc_html( $year ); ?></span>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php
            endwhile;
            
            echo '</div>';
            
            if ( ! empty( $instance['show_link'] ) ) :
                ?>
<div class="widget-footer">
    <a href="<?php echo get_post_type_archive_link( 'ramnet_project' ); ?>" class="widget-link">
        <?php _e( 'Все проекты →', 'ramnet' ); ?>
    </a>
</div>
<?php
            endif;
            
            wp_reset_postdata();
        endif;
        
        echo $args['after_widget'];
    }
    
    public function form( $instance ) {
        $title     = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $number    = ! empty( $instance['number'] ) ? $instance['number'] : 3;
        $show_link = ! empty( $instance['show_link'] ) ? (bool) $instance['show_link'] : false;
        ?>

<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
        <?php _e( 'Заголовок:', 'ramnet' ); ?>
    </label>
    <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' )); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
</p>

<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'number' ) ); ?>">
        <?php _e( 'Количество проектов:', 'ramnet' ); ?>
    </label>
    <input type="number" class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' )); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'number' ) ); ?>" value="<?php echo esc_attr( $number ); ?>"
        min="1" max="10" step="1">
</p>

<p>
    <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_link' ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'show_link' ) ); ?>" <?php checked( $show_link ); ?>>
    <label for="<?php echo esc_attr( $this->get_field_id( 'show_link' ) ); ?>">
        <?php _e( 'Показать ссылку на все проекты', 'ramnet' ); ?>
    </label>
</p>

<?php
    }
    
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        
        $instance['title']     = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['number']    = ! empty( $new_instance['number'] ) ? absint( $new_instance['number'] ) : 3;
        $instance['show_link'] = ! empty( $new_instance['show_link'] ) ? (bool) $new_instance['show_link'] : false;
        
        return $instance;
    }
}

/**
 * Custom Widget: Contact Info
 */
class Ramnet_Contact_Widget extends WP_Widget {
    
    public function __construct() {
        parent::__construct(
            'ramnet_contact',
            __( 'РАМ.НЕТ: Контактная информация', 'ramnet' ),
            array(
                'description' => __( 'Отображает контактную информацию компании', 'ramnet' ),
                'classname'   => 'widget-contact',
            )
        );
    }
    
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }
        
        $phone = get_theme_mod( 'ramnet_phone', '+7 (XXX) XXX-XX-XX' );
        $email = get_theme_mod( 'ramnet_email', 'info@zasteklim.ru' );
        $address = get_theme_mod( 'ramnet_address', 'Воронеж, ул. Примерная, д. 10' );
        $work_hours = get_theme_mod( 'ramnet_work_hours', 'Пн-Пт: 9:30 - 20:00' );
        ?>

<div class="contact-widget-content">

    <?php if ( ! empty( $instance['show_phone'] ) && $phone ) : ?>
    <div class="contact-item contact-phone">
        <span class="contact-icon">📞</span>
        <div class="contact-info">
            <strong><?php _e( 'Телефон:', 'ramnet' ); ?></strong>
            <a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a>
        </div>
    </div>
    <?php endif; ?>

    <?php if ( ! empty( $instance['show_email'] ) && $email ) : ?>
    <div class="contact-item contact-email">
        <span class="contact-icon">✉️</span>
        <div class="contact-info">
            <strong><?php _e( 'Email:', 'ramnet' ); ?></strong>
            <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
        </div>
    </div>
    <?php endif; ?>

    <?php if ( ! empty( $instance['show_address'] ) && $address ) : ?>
    <div class="contact-item contact-address">
        <span class="contact-icon">📍</span>
        <div class="contact-info">
            <strong><?php _e( 'Адрес:', 'ramnet' ); ?></strong>
            <span><?php echo esc_html( $address ); ?></span>
        </div>
    </div>
    <?php endif; ?>

    <?php if ( ! empty( $instance['show_hours'] ) && $work_hours ) : ?>
    <div class="contact-item contact-hours">
        <span class="contact-icon">🕒</span>
        <div class="contact-info">
            <strong><?php _e( 'Режим работы:', 'ramnet' ); ?></strong>
            <span><?php echo esc_html( $work_hours ); ?></span>
        </div>
    </div>
    <?php endif; ?>

</div>

<?php
        echo $args['after_widget'];
    }
    
    public function form( $instance ) {
        $title       = ! empty( $instance['title'] ) ? $instance['title'] : '';
        $show_phone  = ! empty( $instance['show_phone'] ) ? (bool) $instance['show_phone'] : true;
        $show_email  = ! empty( $instance['show_email'] ) ? (bool) $instance['show_email'] : true;
        $show_address = ! empty( $instance['show_address'] ) ? (bool) $instance['show_address'] : true;
        $show_hours  = ! empty( $instance['show_hours'] ) ? (bool) $instance['show_hours'] : true;
        ?>

<p>
    <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
        <?php _e( 'Заголовок:', 'ramnet' ); ?>
    </label>
    <input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' )); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
</p>

<p>
    <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_phone' ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'show_phone' ) ); ?>" <?php checked( $show_phone ); ?>>
    <label for="<?php echo esc_attr( $this->get_field_id( 'show_phone' ) ); ?>">
        <?php _e( 'Показать телефон', 'ramnet' ); ?>
    </label>
</p>

<p>
    <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_email' ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'show_email' ) ); ?>" <?php checked( $show_email ); ?>>
    <label for="<?php echo esc_attr( $this->get_field_id( 'show_email' ) ); ?>">
        <?php _e( 'Показать email', 'ramnet' ); ?>
    </label>
</p>

<p>
    <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_address' ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'show_address' ) ); ?>" <?php checked( $show_address ); ?>>
    <label for="<?php echo esc_attr( $this->get_field_id( 'show_address' ) ); ?>">
        <?php _e( 'Показать адрес', 'ramnet' ); ?>
    </label>
</p>

<p>
    <input type="checkbox" class="checkbox" id="<?php echo esc_attr( $this->get_field_id( 'show_hours' ) ); ?>"
        name="<?php echo esc_attr( $this->get_field_name( 'show_hours' ) ); ?>" <?php checked( $show_hours ); ?>>
    <label for="<?php echo esc_attr( $this->get_field_id( 'show_hours' ) ); ?>">
        <?php _e( 'Показать режим работы', 'ramnet' ); ?>
    </label>
</p>

<?php
    }
    
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        
        $instance['title']       = ! empty( $new_instance['title'] ) ? sanitize_text_field( $new_instance['title'] ) : '';
        $instance['show_phone']  = ! empty( $new_instance['show_phone'] ) ? (bool) $new_instance['show_phone'] : false;
        $instance['show_email']  = ! empty( $new_instance['show_email'] ) ? (bool) $new_instance['show_email'] : false;
        $instance['show_address'] = ! empty( $new_instance['show_address'] ) ? (bool) $new_instance['show_address'] : false;
        $instance['show_hours']  = ! empty( $new_instance['show_hours'] ) ? (bool) $new_instance['show_hours'] : false;
        
        return $instance;
    }
}

/**
 * Register custom widgets
 */
function ramnet_register_widgets() {
    register_widget( 'Ramnet_Recent_Projects_Widget' );
    register_widget( 'Ramnet_Contact_Widget' );
}
add_action( 'widgets_init', 'ramnet_register_widgets' );