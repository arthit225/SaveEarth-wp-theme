<?php
/**
 * Plugin shortcodes for PHP 5.3+
 *
 * @package Page scroll to id
 */

$pl_shortcodes[$i]=function($atts,$content=null) use ($i, $shortcode_class){
    extract(shortcode_atts(array( 
        'i' => $i,
        'shortcode_class' => '_'.$shortcode_class,
        'url' => '',
        'offset' => '',
        'id' => '',
        'target' => '',
        'class' => '',
        'aria_label' => '',
    ), $atts));
    $aria_label_markup=isset($aria_label) && !empty($aria_label) ? ' aria-label="'.esc_attr($aria_label).'"' : '';
    $target_markup=isset($target) && !empty($target) ? ' data-ps2id-target="'.esc_attr($target).'"' : '';
    if($id!==""){
        if($content){
            return '<div id="'.esc_attr($id).'"'.$target_markup.$aria_label_markup.'>'.do_shortcode($content).'</div>';
        }else{
            return '<a id="'.esc_attr($id).'"'.$target_markup.$aria_label_markup.'></a>';
        }
    }else{
        $element_classes=$class!=='' ? $shortcode_class.' '.$class : $shortcode_class;
        $offset_markup=isset($offset) && !empty($offset) ? ' data-ps2id-offset="'.esc_attr($offset).'"' : '';
        return '<a href="'.esc_url_raw($url).'" class="'.esc_attr($element_classes).'"'.$offset_markup.$aria_label_markup.'>'.do_shortcode($content).'</a>';
    }
};
add_shortcode($tag, $pl_shortcodes[$i]);
$pl_shortcodes_b[$i]=function($atts,$content=null) use ($i){
    extract(shortcode_atts(array( 
        'i' => $i,
        'id' => '',
        'target' => '',
        'aria_label' => '',
    ), $atts));
    if($id!==''){
        $aria_label_markup=isset($aria_label) && !empty($aria_label) ? ' aria-label="'.esc_attr($aria_label).'"' : '';
        $target_markup=isset($target) && !empty($target) ? ' data-ps2id-target="'.esc_attr($target).'"' : '';
        return '<div id="'.esc_attr($id).'"'.$target_markup.$aria_label_markup.'>'.do_shortcode($content).'</div>';
    }
};
add_shortcode($tag_b, $pl_shortcodes_b[$i]);
?>