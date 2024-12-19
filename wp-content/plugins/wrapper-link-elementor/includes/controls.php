<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}




/**
 * @param \Elementor\Controls_Stack $element    The element type.
 * @param string                    $section_id Section ID.
 * @param array                     $args       Section arguments.
 */
function ewl_custom_controls( $element, $section_id, $args ) {
    //var_dump($element->get_name());

	if ( 'section' === $element->get_name() || 'column' === $element->get_name()) {
        if ('section_background' === $section_id || 'section_style' === $section_id) {
              // echo '<script>console.log('.var_dump($args).')</script>';
    //var_dump($section_id);
    
    $element->start_controls_section(
        'wrapper_link_section',
        [
            'tab' => \Elementor\Controls_Manager::TAB_ADVANCED,
            'label' => esc_html__( 'Wrapper Link', 'wrapper-link-elementor' ),
        ]
    );

    $element->add_control(
        'implementation_link_type',
        [
          'label' => __( 'Implementation', 'wrapper-link-elementor' ),
          'type' => \Elementor\Controls_Manager::SELECT,
          'default' => '',
          'options' => [
            'html' => __( 'HTML <a> tag', 'wrapper-link-elementor' ),
            'js' => __( 'JS', 'wrapper-link-elementor'),
          ],
        ]
      );


    $element->add_control(
        'wrapper_link_control',
        [
            'type' => \Elementor\Controls_Manager::URL,
            'label' => esc_html__( 'Set the link', 'wrapper-link-elementor' ),
            'placeholder' => __('https://yourlink.com', 'wrapper-link-elementor'),
            'dynamic' => [
                'active' => true,
            ],
        ]
    );

    $element->end_controls_section();



        }
	}



} // final inject controls




