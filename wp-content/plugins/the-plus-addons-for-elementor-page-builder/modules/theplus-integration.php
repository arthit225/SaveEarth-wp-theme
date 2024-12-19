<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
if ( ! class_exists( 'L_Theplus_Elements_Integration' ) ) {

	/**
	 * Define L_Theplus_Elements_Integration class
	 */
	class L_Theplus_Elements_Integration {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Check if processing elementor widget
		 *
		 * @var boolean
		 */
		 /**
		 * Localize data array
		 *
		 * @var array
		 */
		public $localize_data = array();

		/**
		 * Initalize integration hooks
		 *
		 * @return void
		 */
		public function init() {
			
			add_action( 'elementor/controls/controls_registered', array( $this, 'add_controls' ), 10 );

			// Frontend messages
			$this->localize_data['messages'] = array(
				'invalidMail' => esc_html__( 'Please specify a valid e-mail', 'tpebl' ),
			);
		}
		
		/**
		 * Add new controls.
		 *
		 * @param  object $controls_manager Controls manager instance.
		 * @return void
		 */
		public function add_controls( $controls_manager ) {
						
			$grouped_control = array(
				'plus-equal-height' => 'L_Theplus_Equal_Height',
				'plus-section-column-link' => 'L_Theplus_Section_Column_Link',
				'plus-glass-morphism' => 'L_Theplus_Glass_Morphism',
				'plus-adv-shadow' => 'L_Theplus_Advanced_Shadow',
			);
			foreach ( $grouped_control as $control_id => $class_name ) {
				if ( $this->include_control( $control_id, true ) ) {
					new $class_name();
				}
			}
			
			$plus_control = array(
				'plus-query' => 'L_Theplus_Query',
			);
			foreach ( $plus_control as $control_id => $class_name ) {
				if ( $this->include_plus_control( $control_id, true ) ) {
					//new $class_name();
					//$controls_manager->register_control( $control_id, new $class_name() );
					if ( version_compare( ELEMENTOR_VERSION, '3.5.0', '>=' ) ) {						
                        $controls_manager->register( new $class_name()  );
                    } else {
                        $controls_manager->register_control( $control_id, new $class_name() );
                    }
				}
			}

		}
		
		/**
		 * Include control file by class name.
		 *
		 * @param  [type] $class_name [description]
		 * @return [type]             [description]
		 */
		public function include_control( $control_id, $grouped = false ) {

			$filename = sprintf('modules/controls/group/'.$control_id.'.php');

			if ( ! file_exists( L_THEPLUS_PATH.$filename ) ) {
				return false;
			}

			require L_THEPLUS_PATH.$filename;
			return true;
		}
		
		/**
		 * Include plus control file by class name.
		 *
		 * @param  [type] $class_name [description]
		 * @return [type]             [description]
		 */
		public function include_plus_control( $control_id, $grouped = false ) {

			$filename = sprintf('modules/controls/'.$control_id.'.php');

			if ( ! file_exists( L_THEPLUS_PATH.$filename ) ) {
				return false;
			}

			require L_THEPLUS_PATH.$filename;
			return true;
		}
		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance( $shortcodes = array() ) {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self( $shortcodes );
			}
			return self::$instance;
		}
	}
}

/**
 * Returns instance of L_Theplus_Elements_Integration
 *
 * @return object
 */
function L_Theplus_Elements_Integration() {
	return L_Theplus_Elements_Integration::get_instance();
}