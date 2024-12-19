<?php

namespace Templately\Builder\Types;

use Elementor\Plugin;

abstract class ThemeTemplate extends BaseTemplate {

	public function get_location() {
		return $this->get_property( 'location' );
	}

	public function print_content() {
		if ( $this->is_elementor_template() && class_exists( 'Elementor\Plugin' ) ) {
			$plugin = Plugin::$instance;

			if ( $plugin->preview->is_preview_mode( $this->get_main_id() ) ) {
				// PHPCS - the method builder_wrapper is safe.
				echo $plugin->preview->builder_wrapper( '' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			} else {
				// PHPCS - the method get_content is safe.
				echo $this->get_content(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}


			return;
		}
		$content = $this->get_content();
		echo do_blocks( $content ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

		if(function_exists('wp_script_modules')){
			add_action( 'wp_footer', array( wp_script_modules(), 'print_import_map' ) );
			add_action( 'wp_footer', array( wp_script_modules(), 'print_enqueued_script_modules' ) );
			add_action( 'wp_footer', array( wp_script_modules(), 'print_script_module_preloads' ) );
		}
	}
}