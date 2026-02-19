<?php
/**
 * Custom Walker for Navigation Menus
 *
 * @package RAMNET
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Custom walker for main navigation menu
 */
class Ramnet_Walker_Nav_Menu extends Walker_Nav_Menu {
    
    /**
     * Starts the list before the elements are added.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        
        $indent = str_repeat( $t, $depth );
        
        // Default class for submenus
        $classes = array( 'sub-menu' );
        
        // Add depth-specific class
        if ( $depth === 0 ) {
            $classes[] = 'sub-menu-depth-0';
        } elseif ( $depth === 1 ) {
            $classes[] = 'sub-menu-depth-1';
        }
        
        $class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        
        $output .= "{$n}{$indent}<ul$class_names>{$n}";
    }
    
    /**
     * Starts the element output.
     */
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        
        $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';
        
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Add active class for current menu item
        if ( in_array( 'current-menu-item', $classes ) || in_array( 'current-menu-parent', $classes ) ) {
            $classes[] = 'active';
        }
        
        // Add class for items with children
        $args = (object) $args;
        if ( $args->walker->has_children ) {
            $classes[] = 'menu-item-has-children';
            
            // Add depth-specific class for parent items
            if ( $depth === 0 ) {
                $classes[] = 'parent-depth-0';
            } elseif ( $depth === 1 ) {
                $classes[] = 'parent-depth-1';
            }
        }
        
        // Add class for megamenu (if enabled via custom field)
        $is_megamenu = get_post_meta( $item->ID, '_menu_item_megamenu', true );
        if ( $is_megamenu === 'yes' ) {
            $classes[] = 'megamenu-item';
        }
        
        // Add class for icon (if enabled via custom field)
        $menu_icon = get_post_meta( $item->ID, '_menu_item_icon', true );
        if ( ! empty( $menu_icon ) ) {
            $classes[] = 'has-icon';
        }
        
        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
        $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
        
        $id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
        $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
        
        $output .= $indent . '<li' . $id . $class_names . '>';
        
        // Add icon before link if exists
        $icon_html = '';
        if ( ! empty( $menu_icon ) ) {
            $icon_html = '<span class="menu-icon"><img src="' . esc_url( $menu_icon ) . '" alt=""></span>';
        }
        
        // Add badge if exists
        $badge_text = get_post_meta( $item->ID, '_menu_item_badge', true );
        $badge_html = '';
        if ( ! empty( $badge_text ) ) {
            $badge_html = '<span class="menu-badge">' . esc_html( $badge_text ) . '</span>';
        }
        
        $atts = array();
        $atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
        $atts['target'] = ! empty( $item->target ) ? $item->target : '';
        $atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
        $atts['href']   = ! empty( $item->url ) ? $item->url : '';
        
        $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
        
        $attributes = '';
        foreach ( $atts as $attr => $value ) {
            if ( ! empty( $value ) ) {
                $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        /** This filter is documented in wp-includes/post-template.php */
        $title = apply_filters( 'the_title', $item->title, $item->ID );
        $title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );
        
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $icon_html;
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= $badge_html;
        
        // Add arrow for items with children
        if ( $args->walker->has_children ) {
            $item_output .= '<span class="menu-arrow"></span>';
        }
        
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
    
    /**
     * Ends the element output, if needed.
     */
    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        
        $output .= "</li>{$n}";
    }
    
    /**
     * Ends the list of after the elements are added.
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        
        $indent = str_repeat( $t, $depth );
        $output .= "$indent</ul>{$n}";
    }
}

/**
 * Add custom fields to menu items
 */
function ramnet_add_menu_item_custom_fields( $item_id, $item, $depth, $args ) {
    ?>
<div class="menu-item-custom-fields" style="margin: 10px 0; padding: 10px; background: #f5f5f5;">
    <p>
        <label>
            <input type="checkbox" name="menu-item-megamenu[<?php echo esc_attr( $item_id ); ?>]" value="yes"
                <?php checked( get_post_meta( $item_id, '_menu_item_megamenu', true ), 'yes' ); ?>>
            <?php _e( 'Сделать мега-меню', 'ramnet' ); ?>
        </label>
    </p>

    <p>
        <label>
            <?php _e( 'Иконка меню (URL):', 'ramnet' ); ?><br>
            <input type="text" name="menu-item-icon[<?php echo esc_attr( $item_id ); ?>]"
                value="<?php echo esc_attr( get_post_meta( $item_id, '_menu_item_icon', true ) ); ?>" class="widefat">
        </label>
    </p>

    <p>
        <label>
            <?php _e( 'Текст бейджа:', 'ramnet' ); ?><br>
            <input type="text" name="menu-item-badge[<?php echo esc_attr( $item_id ); ?>]"
                value="<?php echo esc_attr( get_post_meta( $item_id, '_menu_item_badge', true ) ); ?>" class="widefat"
                placeholder="например: NEW">
        </label>
    </p>
</div>
<?php
}
add_action( 'wp_nav_menu_item_custom_fields', 'ramnet_add_menu_item_custom_fields', 10, 4 );

/**
 * Save custom menu item fields
 */
function ramnet_update_menu_item_custom_fields( $menu_id, $menu_item_db_id, $args ) {
    // Save megamenu checkbox
    $megamenu_value = isset( $_POST['menu-item-megamenu'][ $menu_item_db_id ] ) ? 'yes' : 'no';
    update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $megamenu_value );
    
    // Save icon
    if ( isset( $_POST['menu-item-icon'][ $menu_item_db_id ] ) ) {
        update_post_meta( $menu_item_db_id, '_menu_item_icon', esc_url_raw( $_POST['menu-item-icon'][ $menu_item_db_id ] ) );
    }
    
    // Save badge
    if ( isset( $_POST['menu-item-badge'][ $menu_item_db_id ] ) ) {
        update_post_meta( $menu_item_db_id, '_menu_item_badge', sanitize_text_field( $_POST['menu-item-badge'][ $menu_item_db_id ] ) );
    }
}
add_action( 'wp_update_nav_menu_item', 'ramnet_update_menu_item_custom_fields', 10, 3 );

/**
 * Add custom walker to wp_nav_menu
 */
function ramnet_custom_nav_menu_args( $args ) {
    if ( isset( $args['theme_location'] ) && $args['theme_location'] === 'primary' ) {
        $args['walker'] = new Ramnet_Walker_Nav_Menu();
    }
    return $args;
}
add_filter( 'wp_nav_menu_args', 'ramnet_custom_nav_menu_args' );