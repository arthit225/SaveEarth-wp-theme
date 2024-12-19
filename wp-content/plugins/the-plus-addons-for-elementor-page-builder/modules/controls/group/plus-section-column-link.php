<?php
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class L_Theplus_Section_Column_Link extends Elementor\Widget_Base {

	public function __construct() {
		$theplus_options=get_option('theplus_options');
		$plus_extras=l_theplus_get_option('general','extras_elements');		
		
		if((isset($plus_extras) && empty($plus_extras) && empty($theplus_options)) || (!empty($plus_extras) && in_array('plus_section_column_link',$plus_extras))){
		
			add_action( 'elementor/element/column/_section_responsive/after_section_end', [ $this, 'tp_section_column_link' ], 10, 2 );
			add_action( 'elementor/element/section/_section_responsive/after_section_end', [ $this, 'tp_section_column_link' ], 10, 2 );
			add_action( 'elementor/element/common/section_custom_css_pro/after_section_end', [ $this, 'tp_section_column_link' ], 10, 2 );
			
			$experiments_manager = Plugin::$instance->experiments;		
			if($experiments_manager->is_feature_active( 'container' )){		
				add_action( 'elementor/element/container/section_layout/after_section_end', [ $this, 'tp_section_column_link' ], 10, 2  );
			}

			add_action( 'elementor/frontend/before_render', [ $this, 'plus_before_render'], 10, 1 );
			
			add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'tp_enqueue_scripts' ], 10 );
		}		
	}

	public function get_name() {
		return 'plus-section-column-link';
	}

	public function tp_section_column_link($element) {
		
		$element->start_controls_section(
			'plus_sc_link_section',
			[
				'label' => esc_html__( 'Plus Extras : Wrapper Link', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_ADVANCED,
			]
		);
		$element->add_control(
			'sc_link_switch',
			[
				'label'        => esc_html__( 'Link', 'tpebl' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default' 		=> 'no',
			]
		);
		$element->add_control(
			'sc_link',
			[
				'label' => esc_html__( 'Link', 'tpebl' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],				
				'placeholder' => esc_html__( 'https://www.demo-link.com', 'tpebl' ),
				'condition' => [
					'sc_link_switch' => 'yes',
				],
			]
		);
		$element->end_controls_section();
	}

	public function tp_enqueue_scripts() {
		wp_enqueue_script('plus-section-column-link',L_THEPLUS_ASSETS_URL . 'js/main/section-column-link/plus-section-column-link.min.js',array( 'jquery' ),L_THEPLUS_VERSION,true);	
	}

	public function plus_before_render($element) {		
		// $settings = $element->get_settings();
		$settings = $element->get_settings_for_display();

		if((!empty($settings['sc_link_switch']) && $settings['sc_link_switch']=='yes') && !empty($settings['sc_link']) && !empty($settings['sc_link']['url'])){			
			$element->add_render_attribute( '_wrapper', 
			array(			
				'data-tp-sc-link' => esc_url($settings['sc_link']['url']),
				'data-tp-sc-link-external' => esc_attr($settings['sc_link']['is_external']),
				'style' => 'cursor: pointer'
			) );
		}

	}
}