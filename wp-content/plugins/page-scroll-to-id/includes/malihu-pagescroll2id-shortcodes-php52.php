<?php
/**
 * Plugin shortcodes for PHP 5.2
 *
 * @package Page scroll to id
 */

$pl_shortcodes[$i]=create_function('$atts,$content=null','
    extract(shortcode_atts(array( 
        "i" => "'.$i.'",
        "shortcode_class" => "_'.$shortcode_class.'",
        "url" => "",
        "offset" => "",
        "id" => "",
        "target" => "",
        "class" => "",
    ), $atts));
    if($id!==""){
        if($content){
            return "<div id=\"".esc_attr($id)."\" data-ps2id-target=\"".esc_attr($target)."\">".do_shortcode($content)."</div>";
        }else{
            return "<a id=\"".esc_attr($id)."\" data-ps2id-target=\"".esc_attr($target)."\"></a>";
        }
    }else{
        $element_classes=$class!=="" ? $shortcode_class." ".$class : $shortcode_class;
        return "<a href=\"".esc_url_raw($url)."\" class=\"".esc_attr($element_classes)."\" data-ps2id-offset=\'".esc_attr($offset)."\'>".do_shortcode($content)."</a>";
    }
');
add_shortcode($tag, $pl_shortcodes[$i]);
$pl_shortcodes_b[$i]=create_function('$atts,$content=null','
    extract(shortcode_atts(array( 
        "i" => "'.$i.'",
        "id" => "",
        "target" => "",
    ), $atts));
    if($id!==""){
        return "<div id=\"".esc_attr($id)."\" data-ps2id-target=\"".esc_attr($target)."\">".do_shortcode($content)."</div>";
    }
');
add_shortcode($tag_b, $pl_shortcodes_b[$i]);
?>