<?php
namespace TheplusAddons\L_WPML;
use L_WPML_Elementor_Module_With_Items;

if ( ! defined('ABSPATH') ) exit; // No access of directly access

class Tp_Flip_Box extends L_WPML_Elementor_Module_With_Items {

	/**
	 * Get widget field name.
	 * 
	 * @return string
	 */
	public function get_items_field() {
		return 'loop_content';
	}

	/**
	 * Get the fields inside the repeater.
	 *
	 * @return array
	 */
	public function get_fields() {
		return array(
			'loop_title',
			'loop_button_text'
		);
	}

  	/**
     * @param string $field
	 * 
	 * Get the field title string
     *
     * @return string
     */
	protected function get_title( $field ) {
		switch($field) {
			case 'loop_title':
				return esc_html__( 'Flip Box : Title', 'tpebl' );

			case 'loop_button_text':
				return esc_html__( 'Flip Box : Button Text', 'tpebl' );
			
			default:
				return '';
		}
	}

	/**
	 * @param string $field
	 * 
	 * Get perspective field types.
	 *
	 * @return string
	 */
	protected function get_editor_type( $field ) {
		switch($field) {
			case 'loop_title':
				return 'LINE';

			case 'loop_button_text':
				return 'LINE';

			default:
				return '';
		}
	}

}
