<?php
/**
 * Customizer Builder
 * Heading Text Control
 *
 * @since 6.0
 */
namespace InstagramFeed\Builder\Controls;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class SB_Heading_Control extends SB_Controls_Base {

	/**
	 * Get control type.
	 *
	 * Getting the Control Type
	 *
	 * @since 6.0
	 * @access public
	 *
	 * @return string
	*/
	public function get_type() {
		return 'heading';
	}

	/**
	 * Output Control
	 *
	 *
	 * @since 6.0
	 * @access public
	*/
	public function get_control_output( $controlEditingTypeModel ) {}

}
