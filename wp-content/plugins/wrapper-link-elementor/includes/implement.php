<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


function ewl_attributes( $element ) {

    if (  $element->get_settings( 'wrapper_link_control' ) && $element->get_settings( 'implementation_link_type' ) ) {
         

        if(isset($element->get_settings()['__dynamic__']['wrapper_link_control'])) {
            //$dynamic = urldecode($element->get_settings()['__dynamic__']['wrapper_link_control']);
            $dynamic = urldecode($element->get_settings()['__dynamic__']['wrapper_link_control']);
            $dynamicDecode = preg_match_all("/\\{(.*?)\\}/", $dynamic, $matches); 
            $matchString = implode($matches[0]);
            $urlDynamic = preg_match_all('!\d+!', $matchString, $postID);
            
            $post_id = implode($postID[0]); //specify post id here
            //echo $post_id;
            $post = get_post($post_id); 
            $slug = $post->post_name;
            $EWLurl = get_site_url() . '/' . $slug;
            //echo $EWLurl;
            
        }

        else {
            $EWLurl = $element->get_settings("wrapper_link_control")['url'];
        }

        
        
        
        //var_dump($element->get_settings());
        
        $EWLtype = $element->get_settings("implementation_link_type");
        $EWLexternal = $element->get_settings("wrapper_link_control")['is_external'];

        $element->add_render_attribute(
            '_wrapper',
            [
                'class' => 'EWLimplement',
                'data-ewl-url' => $EWLurl,
                'data-ewl-type' => $EWLtype,
                'data-ewl-external' => $EWLexternal
            ]
        );

        //echo '<script>console.log('.var_dump($element->get_settings("wrapper_link_control")).')</script>';
        //echo '<script>console.log('.var_dump($element->get_settings("implementation_link_type")).')</script>';

    }

    

}


function ewl_scripts() {

	wp_register_script( 'EWLimplementation', plugins_url( '../assets/js/EWLscript.js', __FILE__ ) );
	wp_enqueue_script( 'EWLimplementation' );

}


function ewl_stylesheets() {

	wp_register_style( 'EWLstyle', plugins_url( '../assets/css/EWLstyle.css', __FILE__ ) );
	wp_enqueue_style( 'EWLstyle' );

}
