<?php
namespace TheplusAddons\Widgets;
use TheplusAddons\L_Theplus_Element_Load;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
// Get Elementor Template 
function l_theplus_get_templates() {
    $templates = L_Theplus_Element_Load::elementor()->templates_manager->get_source( 'local' )->get_items();
    $types     = [];

    if ( empty( $templates ) ) {
        $options = [ '0' => esc_html__( 'You Haven’t Saved Templates Yet.', 'tpebl' ) ];
    } else {
        $options = [ '0' => esc_html__( 'Select Template', 'tpebl' ) ];
        
        foreach ( $templates as $template ) {
            $options[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
            $types[ $template['template_id'] ] = $template['type'];
        }
    }

    return $options;
}

/*-custom post taxonomies-*/
function l_theplus_get_post_taxonomies() {
	$args = array(
		'public'   => true,
     'show_ui' => true
	);
	$output = 'names'; // or objects
	$operator = 'and'; // 'and' or 'or'
	
	$taxonomies = get_taxonomies( $args, $output, $operator );
	if ( $taxonomies ) {		
		foreach ( $taxonomies  as $taxonomy ) {
			 $options[$taxonomy] = $taxonomy;				
		}
		return $options;
	}	
}
/*-custom post taxonomies-*/

/**
 * Prevent JS senitizer
 * 
 * @since 5.5.5
 * 
 * */
function tp_senitize_role( $capability ) {

	$id = get_the_author_meta( 'ID' );

	return user_can( $id, $capability );
}

/**
 * Prevent JS senitizer
 * 
 * @since 5.5.0
 * 
 * */
function tp_senitize_js_input( $input ) {

	$input = preg_replace('/(on|hr)\w+=/', '', $input);

	return $input;
}

//Navigation Get Menu
function l_theplus_navigation_menulist() {
    $menus = wp_get_nav_menus();
    $items = ['0' => esc_html__( 'Select Menu', 'tpebl' ) ];
    foreach ( $menus as $menu ) {
        $items[ $menu->slug ] = $menu->name;
    }

    return $items;
}
class L_Theplus_Navigation_NavWalker extends \Walker_Nav_Menu {

	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$dropdown_menu = "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
		$dropdown_menu = apply_filters( 'theplus_nav_menu_start_lvl', $dropdown_menu, $indent, $args );
		$output .= $dropdown_menu;
	}

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
	
		if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="divider">';
		} else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {
			$output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );
		} else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {
			$output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';
		} else {

			$class_names = $value = '';

			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'animate-dropdown menu-item-' . $item->ID;

			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args , $depth) );

			if ( $args->has_children ) {
				if ( $args->theme_location == 'departments-menu' && $depth === 0 ) {
					$class_names .= ' depth-'.$depth.' dropdown-submenu';
				} elseif ( $depth === 0 ) {
					$class_names .= ' depth-'.$depth.' dropdown';
				} else {
					$class_names .= ' depth-'.$depth.' dropdown-submenu';
				}
			}
			

			if ( in_array( 'current-menu-item', $classes ) )
				$class_names .= ' active';

			$plus_data_attr = '';
			$tp_megamenu_type = get_post_meta( $item->ID, 'menu-item-tp-megamenu-type', true );
			$tp_menu_alignment = get_post_meta( $item->ID, 'menu-item-tp-menu-alignment', true );
			if( !empty( $tp_megamenu_type ) && $tp_megamenu_type == 'default' ) {
				$tp_dropdown_width = get_post_meta( $item->ID, 'menu-item-tp-dropdown-width', true );
				if( !empty( $tp_dropdown_width ) ) {
					$class_names .= ' plus-dropdown-default';
					$plus_data_attr .= ' data-dropdown-width="'.esc_attr($tp_dropdown_width).'px"';
				}
			}else if( !empty( $tp_megamenu_type ) && $tp_megamenu_type != 'default' ) {
				$class_names .= ' plus-dropdown-'.esc_attr($tp_megamenu_type);
			}
			if( !empty( $tp_megamenu_type ) && $tp_megamenu_type == 'default' ) {
				$class_names .= ' plus-dropdown-menu-'.$tp_menu_alignment;
			}
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $value . $class_names .' '.$plus_data_attr.'>';

			$atts = array();
			$atts['title']  = ! empty( $item->title )	? $item->title	: '';
			$atts['target'] = ! empty( $item->target )	? $item->target	: '';
			$atts['rel']    = ! empty( $item->xfn )		? $item->xfn	: '';

			// If item has_children add atts to a.
			if ( $args->has_children && $depth === 0 ) {
				$atts['href']   		= $item->url ;				
				//$atts['data-toggle'] = 'dropdown';
				$atts['class']			= 'dropdown-toggle';
				$atts['aria-haspopup']	= 'true';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}

			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}
			
			$icon_class_type = get_post_meta( $item->ID, 'menu-item-tp-menu-icon-type', true );
			if(!empty($icon_class_type) && $icon_class_type == 'icon_class' ){
				$icon_class = get_post_meta( $item->ID, 'menu-item-tp-icon-class', true );
				$icon = empty( $icon_class ) ? '' : '<i class="plus-nav-icon-menu ' . esc_attr( $icon_class ) . '"></i>';
			}else if(!empty($icon_class_type) && $icon_class_type == 'icon_image' ){
				$attachment_id = get_post_meta( $item->ID, 'tp-menu-icon-img', true );
				$icon_thumb = wp_get_attachment_image_src( $attachment_id, 'full' );
				$icon = empty( $icon_thumb[0] ) ? '' : '<img class="plus-nav-icon-menu icon-img" src="' . esc_attr( $icon_thumb[0] ) . '" />';
			}else{
				$icon ='';
			}
			
			$tp_text_label = get_post_meta( $item->ID, 'menu-item-tp-text-label', true );
			if(!empty($tp_text_label)){
				$tp_text_label_color = get_post_meta( $item->ID, 'menu-item-tp-label-color', true );
				$tp_text_label_bgcolor = get_post_meta( $item->ID, 'menu-item-tp-label-bg-color', true );
				$label_style = ($tp_text_label_color) ?  'color:'.esc_attr($tp_text_label_color).';' : '';
				$label_style .= ($tp_text_label_bgcolor) ?  'background-color:'.esc_attr($tp_text_label_bgcolor).';' : '';
				
				$label_style = ($label_style) ? 'style="'.$label_style.'"' : '';
				$text_label = '<span class="plus-nav-label-text" '.$label_style.'>'.esc_html($tp_text_label).'</span>';
			}else{
				$text_label ='';
			}
			
			
			
			$item_output = $args->before;
			
			if( 'plus-mega-menu' == $item->object ){
				
				$page_data = get_post($item->object_id);
				if (!empty($page_data) && isset($page_data->post_status) && strcmp($page_data->post_status,'publish')===0) {
					
					$elementor_instance = \Elementor\Plugin::instance();
					$content = $elementor_instance->frontend->get_builder_content_for_display( $item->object_id );
					$item_output .= '<div class="plus-megamenu-content">' . $content . '</div>';					
					
				}
			} else {
				if ( ! empty( $item->attr_title ) && !ctype_space($item->attr_title)) {					
					$item_output .= '<a'. $attributes .'><span class="' . esc_attr( $item->attr_title ) . '"></span>';
				} else {
					$item_output .= '<a'. $attributes .' data-text="' . esc_attr( $item->title ) . '">';
				}
				
				$item_output .= $icon;
				$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
				$item_output .= $text_label;
				
				if($args->has_children && 0 === $depth ){
				$item_output .='</a>';
				}else if($args->has_children && 1 <= $depth ){
					$item_output .='</a>';
				}else{
					$item_output .='</a>';
				}
				
				$item_output .= $args->after;
			}
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if ( ! $element )
            return;
			
        $id_field = $this->db_fields['id'];

        if ( is_object( $args[0] ) )
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	public static function fallback( $args ) {
		if ( current_user_can( 'manage_options' ) ) {

			extract( $args );

			$fb_output = null;

			if ( $container ) {
				$fb_output = '<' . $container;

				if ( $container_id )
					$fb_output .= ' id="' . $container_id . '"';

				if ( $container_class )
					$fb_output .= ' class="' . $container_class . '"';

				$fb_output .= '>';
			}

			$fb_output .= '<ul';

			if ( $menu_id )
				$fb_output .= ' id="' . $menu_id . '"';

			if ( $menu_class )
				$fb_output .= ' class="' . $menu_class . '"';

			$fb_output .= '>';
			$fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">' . esc_html__( 'Add a menu', 'tpebl' ) . '</a></li>';
			$fb_output .= '</ul>';

			if ( $container )
				$fb_output .= '</' . $container . '>';

			echo wp_kses_post( $fb_output );
		}
	}
	
}

/*Widget Error Html*/
function l_theplus_get_widgetError( $Title, $Massage ) {
	$sanitized_title = sanitize_text_field($Title);
    $sanitized_massage = sanitize_text_field($Massage);

	$HTML = "<div class='tp-widget-error-notice'>
				<div class='tp-widget-error-thumb'>
					<svg width='56' height='56' viewBox='0 0 56 56' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M28 0L52.2487 14V42L28 56L3.75129 42V14L28 0Z' fill='#DD4646'/><path d='M7.71539 16.2887L28 4.57735L48.2846 16.2887V39.7113L28 51.4226L7.71539 39.7113V16.2887Z' stroke='white'/><path fill-rule='evenodd' clip-rule='evenodd' d='M27.1016 15C25.9578 15 25.047 15.9575 25.1041 17.0999L25.9516 34.0499C25.9783 34.5822 26.4175 35 26.9504 35H29.0479C29.5807 35 30.02 34.5822 30.0466 34.0499L30.8941 17.0999C30.9513 15.9575 30.0405 15 28.8967 15H27.1016ZM26.9991 38C26.4468 38 25.9991 38.4477 25.9991 39V41C25.9991 41.5523 26.4468 42 26.9991 42H28.9991C29.5514 42 29.9991 41.5523 29.9991 41V39C29.9991 38.4477 29.5514 38 28.9991 38H26.9991Z' fill='white'/></svg>
				</div>
				<div class='tp-widget-error-content'>
					<span>{$sanitized_title}</span>
					<span>{$sanitized_massage}</span>
				</div>
			</div>";

	return $HTML;
}

function l_theplus_get_style_list($max=4,$none='') {
	$options=array();
	if($none=='yes'){
		$options[ 'none' ] = 'None';
	}
	for( $i=1;$i<=$max;$i++) {
		$options[ 'style-'.$i ] = 'Style '.$i;
	}
    return $options;
}

function l_theplus_get_style_list_custom($max=4,$none='') {
	$options=array();
	if($none=='yes'){
		$options[ 'none' ] = 'None';
	}
	for( $i=1;$i<=$max;$i++) {
		$options[ 'style-'.$i ] = 'Style '.$i;
	}
	$options[ 'custom' ] = esc_html__('Custom Skin','tpebl');
	
    return $options;
}

function l_theplus_get_numbers()
{
	$options=array();	
	$options[ 'all-open' ] = 'All Open';
	for( $i=0;$i<=20;$i++) {
            $options[ $i ] = $i;
        }
    return $options;
}

function l_theplus_get_gradient_styles()
{
    return array(
		'linear' => esc_html__('Linear', 'tpebl'),
		'radial' => esc_html__('Radial', 'tpebl'),
    );
}
function l_theplus_get_border_style()
{
    return array(
        'solid' => esc_html__( 'Solid', 'tpebl' ),
		'dashed' => esc_html__( 'Dashed', 'tpebl' ),
		'dotted' => esc_html__( 'Dotted', 'tpebl' ),
		'groove' => esc_html__( 'Groove',  'tpebl' ),
		'inset' => esc_html__( 'Inset','tpebl' ),
		'outset' => esc_html__( 'Outset','tpebl' ),
		'ridge' => esc_html__( 'Ridge', 'tpebl' ),
    );
}
function l_theplus_get_list_layout_style()
{
    return array(
        'grid'  => esc_html__( 'Grid', 'tpebl' ),
		'masonry' => esc_html__( 'Masonry', 'tpebl' ),
		'metro' => esc_html__( 'Metro', 'tpebl' ),
		'carousel' => esc_html__( 'Carousel', 'tpebl' ),
    );
}
function l_theplus_get_columns_list()
{
    return array(
        '2' => esc_html__( 'Column 6', 'tpebl' ),
		'3' => esc_html__( 'Column 4', 'tpebl' ),
		'4' => esc_html__( 'Column 3', 'tpebl' ),
		'5' => esc_html__( 'Column 5', 'tpebl' ),
		'6' => esc_html__( 'Column 2', 'tpebl' ),
		'12'  => esc_html__( 'Column 1', 'tpebl' ),
	);
}

function l_theplus_get_categories() {

	$categories = get_categories();

	if ( empty( $categories ) || ! is_array( $categories ) ) {
		return array();
	}
	return wp_list_pluck( $categories, 'name', 'term_id' );
	
}
function l_theplus_get_tags() {

	$tags = get_tags();
	
	if ( empty( $tags ) || ! is_array( $tags ) ) {
		return array();
	}
	return wp_list_pluck( $tags, 'name', 'term_id' );
	
}

function l_theplus_orderby_arr() {
	return array(
		'none'          => esc_html__( 'None', 'tpebl' ),
		'ID'            => esc_html__( 'ID', 'tpebl' ),
		'author'        => esc_html__( 'Author', 'tpebl' ),
		'title'         => esc_html__( 'Title', 'tpebl' ),
		'name'          => esc_html__( 'Name (slug)', 'tpebl' ),
		'date'          => esc_html__( 'Date', 'tpebl' ),
		'modified'      => esc_html__( 'Modified', 'tpebl' ),
		'rand'          => esc_html__( 'Random', 'tpebl' ),
		'comment_count' => esc_html__( 'Comment Count', 'tpebl' ),
		'menu_order' => esc_html__( 'Default Menu Order', 'tpebl' ),
	);
}
function l_theplus_order_arr() {

	return array(
		'DESC' => esc_html__( 'Descending', 'tpebl' ),
		'ASC'  => esc_html__( 'Ascending', 'tpebl' ),
	);

}

function l_theplus_post_loading_option() {

	return array(
		'none' => esc_html__( 'Select Options', 'tpebl' ),
		'pagination'  => esc_html__( 'Pagination', 'tpebl' ),
		'load_more'  => esc_html__( 'Load More', 'tpebl' ),
		'lazy_load'  => esc_html__( 'Lazy Load', 'tpebl' ),
	);

}
function l_theplus_metro_style_layout($columns='1',$metro_column='3',$metro_style='style-1'){
	$i=($columns!='') ? $columns : 1;
	if(!empty($metro_column)){
		//style-3
		if($metro_column=='3' && $metro_style=='style-1'){
			$i=($i<=10) ? $i : ($i%10);			
		}
	}
	return $i;
}
function l_theplus_get_layout_list_class($layout=''){
	$layout_class='';
	
	$layout_class=' list-isotope ';
	if($layout=='grid'){
		$layout_class=' list-isotope ';
	}else if($layout=='masonry'){
		$layout_class=' list-isotope ';
	}else if($layout=='metro'){
		$layout_class=' list-isotope-metro ';
	}
	
	return $layout_class;
}

function l_theplus_get_layout_list_attr($layout=''){
	$layout_attr='';
	if($layout=='grid'){
		$layout_attr .=' data-layout-type="fitRows" ';
	}else if($layout=='masonry'){
		$layout_attr .=' data-layout-type="masonry" ';
	}else if($layout=='metro'){
		$layout_attr .=' data-layout-type="metro" ';		
	}
	return $layout_attr;
}

function l_theplus_get_position_options()
{
    return array(
        'center center' => esc_html__( 'Center Center', 'tpebl' ),
		'center left' => esc_html__( 'Center Left', 'tpebl' ),
		'center right' => esc_html__( 'Center Right', 'tpebl' ),
		'top center' => esc_html__( 'Top Center',  'tpebl' ),
		'top left' => esc_html__( 'Top Left','tpebl' ),
		'top right' => esc_html__( 'Top Right','tpebl' ),
		'bottom center' => esc_html__( 'Bottom Center', 'tpebl' ),
		'bottom left' => esc_html__( 'Bottom Left','tpebl' ),
		'bottom right' => esc_html__( 'Bottom Right','tpebl' ),
    );
}

function l_theplus_get_content_hover_effect_options()
{
    return array(
		''   => esc_html__( 'Select Hover Effect', 'tpebl' ),
		'grow'  => esc_html__( 'Grow (PRO)', 'tpebl' ),
		'push' => esc_html__( 'Push', 'tpebl' ),
		'bounce-in' => esc_html__( 'Bounce In (PRO)', 'tpebl' ),
		'float' => esc_html__( 'Float (PRO)', 'tpebl' ),
		'wobble_horizontal' => esc_html__( 'Wobble Horizontal (PRO)', 'tpebl' ),
		'wobble_vertical' => esc_html__( 'Wobble Vertical (PRO)', 'tpebl' ),
		'float_shadow' => esc_html__( 'Float Shadow (PRO)', 'tpebl' ),
		'grow_shadow' => esc_html__( 'Grow Shadow (PRO)', 'tpebl' ),
		'shadow_radial' => esc_html__( 'Shadow Radial (PRO)', 'tpebl' ),
    );
}
function l_theplus_get_content_hover_effect_all_options()
{
    return array(
		''   => esc_html__( 'Select Hover Effect', 'tpebl' ),
		'grow'  => esc_html__( 'Grow', 'tpebl' ),
		'push' => esc_html__( 'Push', 'tpebl' ),
		'bounce-in' => esc_html__( 'Bounce In', 'tpebl' ),
		'float' => esc_html__( 'Float', 'tpebl' ),
		'wobble_horizontal' => esc_html__( 'Wobble Horizontal', 'tpebl' ),
		'wobble_vertical' => esc_html__( 'Wobble Vertical', 'tpebl' ),
		'float_shadow' => esc_html__( 'Float Shadow', 'tpebl' ),
		'grow_shadow' => esc_html__( 'Grow Shadow', 'tpebl' ),
		'shadow_radial' => esc_html__( 'Shadow Radial', 'tpebl' ),
    );
}
function l_theplus_get_animation_options()
{
    return array(
        'no-animation' => esc_html__( 'No-animation', 'tpebl' ),
		'transition.fadeIn' => esc_html__( 'FadeIn', 'tpebl' ),
		'transition.flipXIn' => esc_html__( 'FlipXIn', 'tpebl' ),
		'transition.flipYIn' => esc_html__( 'FlipYIn', 'tpebl' ),
		'transition.flipBounceXIn' => esc_html__( 'FlipBounceXIn', 'tpebl' ),
		'transition.flipBounceYIn' => esc_html__( 'FlipBounceYIn', 'tpebl' ),
		'transition.swoopIn' => esc_html__( 'SwoopIn', 'tpebl' ),
		'transition.whirlIn' => esc_html__( 'WhirlIn', 'tpebl' ),
		'transition.shrinkIn' => esc_html__( 'ShrinkIn', 'tpebl' ),
		'transition.expandIn' => esc_html__( 'ExpandIn', 'tpebl' ),
		'transition.bounceIn' => esc_html__( 'BounceIn', 'tpebl' ),
		'transition.bounceUpIn' => esc_html__( 'BounceUpIn', 'tpebl' ),
		'transition.bounceDownIn' => esc_html__( 'BounceDownIn', 'tpebl' ),
		'transition.bounceLeftIn' => esc_html__( 'BounceLeftIn', 'tpebl' ),
		'transition.bounceRightIn' => esc_html__( 'BounceRightIn', 'tpebl' ),
		'transition.slideUpIn' => esc_html__( 'SlideUpIn', 'tpebl' ),
		'transition.slideDownIn' => esc_html__( 'SlideDownIn', 'tpebl' ),
		'transition.slideLeftIn' => esc_html__( 'SlideLeftIn', 'tpebl' ),
		'transition.slideRightIn' => esc_html__( 'SlideRightIn', 'tpebl' ),
		'transition.slideUpBigIn' => esc_html__( 'SlideUpBigIn', 'tpebl' ),
		'transition.slideDownBigIn' => esc_html__( 'SlideDownBigIn', 'tpebl' ),
		'transition.slideLeftBigIn' => esc_html__( 'SlideLeftBigIn', 'tpebl' ),
		'transition.slideRightBigIn' => esc_html__( 'SlideRightBigIn', 'tpebl' ),
		'transition.perspectiveUpIn' => esc_html__( 'PerspectiveUpIn', 'tpebl' ),
		'transition.perspectiveDownIn' => esc_html__( 'PerspectiveDownIn', 'tpebl' ),
		'transition.perspectiveLeftIn' => esc_html__( 'PerspectiveLeftIn', 'tpebl' ),
		'transition.perspectiveRightIn' => esc_html__( 'PerspectiveRightIn', 'tpebl' ),
    );
	
}
function l_theplus_get_out_animation_options()
{
    return array(
        'no-animation' => esc_html__( 'No-animation', 'tpebl' ),
		'transition.fadeOut' => esc_html__( 'FadeOut', 'tpebl' ),
		'transition.flipXOut' => esc_html__( 'FlipXOut', 'tpebl' ),
		'transition.flipYOut' => esc_html__( 'FlipYOut', 'tpebl' ),
		'transition.flipBounceXOut' => esc_html__( 'FlipBounceXOut', 'tpebl' ),
		'transition.flipBounceYOut' => esc_html__( 'FlipBounceYOut', 'tpebl' ),
		'transition.swoopOut' => esc_html__( 'SwoopOut', 'tpebl' ),
		'transition.whirlOut' => esc_html__( 'WhirlOut', 'tpebl' ),
		'transition.shrinkOut' => esc_html__( 'ShrinkOut', 'tpebl' ),
		'transition.expandOut' => esc_html__( 'ExpandOut', 'tpebl' ),
		'transition.bounceOut' => esc_html__( 'BounceOut', 'tpebl' ),
		'transition.bounceUpOut' => esc_html__( 'BounceUpOut', 'tpebl' ),
		'transition.bounceDownOut' => esc_html__( 'BounceDownOut', 'tpebl' ),
		'transition.bounceLeftOut' => esc_html__( 'BounceLeftOut', 'tpebl' ),
		'transition.bounceRightOut' => esc_html__( 'BounceRightOut', 'tpebl' ),
		'transition.slideUpOut' => esc_html__( 'SlideUpOut', 'tpebl' ),
		'transition.slideDownOut' => esc_html__( 'SlideDownOut', 'tpebl' ),
		'transition.slideLeftOut' => esc_html__( 'SlideLeftOut', 'tpebl' ),
		'transition.slideRightOut' => esc_html__( 'SlideRightOut', 'tpebl' ),
		'transition.slideUpBigOut' => esc_html__( 'SlideUpBigOut', 'tpebl' ),
		'transition.slideDownBigOut' => esc_html__( 'SlideDownBigOut', 'tpebl' ),
		'transition.slideLeftBigOut' => esc_html__( 'SlideLeftBigOut', 'tpebl' ),
		'transition.slideRightBigOut' => esc_html__( 'SlideRightBigOut', 'tpebl' ),
		'transition.perspectiveUpOut' => esc_html__( 'PerspectiveUpOut', 'tpebl' ),
		'transition.perspectiveDownOut' => esc_html__( 'PerspectiveDownOut', 'tpebl' ),
		'transition.perspectiveLeftOut' => esc_html__( 'PerspectiveLeftOut', 'tpebl' ),
		'transition.perspectiveRightOut' => esc_html__( 'PerspectiveRightOut', 'tpebl' ),
    );
	
}

function l_theplus_get_tags_options($href='')
{
    $html_tag = array(
        'h1' => esc_html__( 'H1', 'tpebl' ),
		'h2' => esc_html__( 'H2', 'tpebl' ),
		'h3' => esc_html__( 'H3', 'tpebl' ),
		'h4' => esc_html__( 'H4', 'tpebl' ),
		'h5' => esc_html__( 'H5', 'tpebl' ),
		'h6' => esc_html__( 'H6', 'tpebl' ),
		'h6' => esc_html__( 'H6', 'tpebl' ),
		'div' => esc_html__( 'div', 'tpebl' ),
		'p' => esc_html__( 'p', 'tpebl' ),
    );
	if(!empty($href)){
		$html_tag['a'] = esc_html__( 'a', 'tpebl' );
	}
	return $html_tag;
}

function l_theplus_get_image_position_options()
{
    return array(
        '' => esc_html__( 'Default','tpebl' ),
		'top left' => esc_html__( 'Top Left','tpebl' ),
		'top center' => esc_html__( 'Top Center','tpebl' ),
		'top right' => esc_html__( 'Top Right','tpebl' ),
		'center left' => esc_html__( 'Center Left','tpebl' ),
		'center center' => esc_html__( 'Center Center','tpebl' ),
		'center right' => esc_html__( 'Center Right', 'tpebl' ),
		'bottom left' => esc_html__( 'Bottom Left', 'tpebl' ),
		'bottom center' => esc_html__( 'Bottom Center','tpebl' ),
		'bottom right' => esc_html__( 'Bottom Right','tpebl' ),
    );
}
function l_theplus_get_image_attachment_options()
{
    return array(
        '' => esc_html__( 'Default', 'tpebl' ),
		'scroll' => esc_html__( 'Scroll', 'tpebl' ),
		'fixed' => esc_html__( 'Fixed', 'tpebl' ),
    );
}
function l_theplus_get_image_reapeat_options()
{
    return array(
        '' => esc_html__( 'Default', 'tpebl' ),
		'no-repeat' => esc_html__( 'No-repeat', 'tpebl' ),
		'repeat' => esc_html__( 'Repeat', 'tpebl' ),
		'repeat-x' => esc_html__( 'Repeat-x','tpebl' ),
		'repeat-y' => esc_html__( 'Repeat-y','tpebl' ),
    );
}
function l_theplus_get_image_size_options()
{
    return array(
        '' => esc_html__( 'Default', 'tpebl' ),
		'auto' => esc_html__( 'Auto', 'tpebl' ),
		'cover' => esc_html__( 'Cover', 'tpebl' ),
		'contain' => esc_html__( 'Contain', 'tpebl' ),
    );
}

function theplus_pro_ver_notice(){
	return '<div class="theplus-pro-features-wrapper">
		<div class="tp-pf-icon-text"><i class="fa fa-lock" aria-hidden="true"></i> Pro Feature</div>
		<div class="tp-pf-info">Go with our pro version to use all our widgets & features with It\'s fullest potential. Pro version will improve your elementor work flow drastically.</div>
		<div class="tp-pf-links">
			<a class="tp-pf-links-buy" href="https://theplusaddons.com/pricing/" target="_blank">Buy Pro</a>
			<a class="tp-pf-links-compare" href="https://theplusaddons.com/free-vs-pro" target="_blank">Free VS Pro</a>
		</div>	
	</div>';
}

function theplus_pro_ver_group_control_notice(){
	return '<div class="theplus-pro-features-wrapper">
		<div class="tp-pf-icon-text"><i class="fa fa-lock" aria-hidden="true"></i> Pro Feature</div>
		<div class="tp-pf-info">Go with our pro version to use all our widgets & features with It\'s fullest potential. Pro version will improve your elementor work flow drastically.</div>
		<div class="tp-pf-links">
			<a class="tp-pf-links-buy" href="https://theplusaddons.com/pricing/" target="_blank">Buy Pro</a>
			<a class="tp-pf-links-compare" href="https://theplusaddons.com/free-vs-pro" target="_blank">Free VS Pro</a>
		</div>	
	</div>';
}