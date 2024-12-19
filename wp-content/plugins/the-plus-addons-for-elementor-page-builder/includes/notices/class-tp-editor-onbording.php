<?php
/**
 * It is Main File to load all Notice, Upgrade Menu and all
 *
 * @link       https://posimyth.com/
 * @since      5.6.5
 *
 * @package    Theplus
 * @subpackage ThePlus/Notices
 **/

/**
 * Exit if accessed directly.
 * */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tp_Editor_onbording' ) ) {

	/**
	 * This class used for Wdesign-kit releted
	 *
	 * @since 5.6.5
	 */
	class Tp_Editor_Onbording {

		/**
		 * Instance
		 *
		 * @since 5.6.5
		 * @static
		 * @var instance of the class.
		 */
		private static $instance = null;

		/**
		 * White label Option
		 *
		 * @var string
		 */
		public $whitelabel = '';

		/**
		 * White label Option
		 *
		 * @var string
		 */
		public $hidden_label = '';

		/**
		 * It is store wp_options table with name tp_wdkit_preview_popup
		 *
		 * @since 5.6.5
		 * @var db_preview_popup_key
		 */
		public $db_editor_onbording_key = 'tp_editor_onbording_popup';

		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.
		 *
		 * @since 5.6.5
		 * @static
		 * @return instance of the class.
		 */
		public static function instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor
		 *
		 * Perform some compatibility checks to make sure basic requirements are meet.
		 *
		 * @since 5.6.5
		 */
		public function __construct() {
            add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'tp_editor_onbording_sripts' ) );
            add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'tp_editor_onbording_style' ) );

            add_action( 'wp_ajax_tp_onbording_skip', array( $this, 'tp_onbording_skip' ) );
            add_action( 'wp_ajax_tp_open_preview_popup', array( $this, 'tp_open_preview_popup' ) );

            add_action( 'elementor/editor/footer', array( $this, 'tp_onbording_html_popup' ) );
		}

		/**
		 * Loded Wdesignkit Template Logo CSS
		 *
		 * @since 5.6.5
		 */
		public function tp_editor_onbording_style() {
			wp_enqueue_style( 'tp-editor-onbording-css', L_THEPLUS_URL . 'assets/css/wdesignkit/tp-editor-onbording.css', array(), L_THEPLUS_VERSION );
		}

		/**
		 * Loded Wdesignkit Template Js
		 *
		 * @since 5.6.5
		 */
		public function tp_editor_onbording_sripts() {

			wp_enqueue_script( 'tp-editor-onbording-js', L_THEPLUS_URL . 'assets/js/wdesignkit/tp-editor-onbording.js', array( 'jquery', 'wp-i18n' ), L_THEPLUS_VERSION, true );

			wp_localize_script(
				'tp-editor-onbording-js',
				'tp_editor_onbording_popup',
				array(
					'nonce'    => wp_create_nonce( 'tp_onbording_popup' ),
					'ajax_url' => admin_url( 'admin-ajax.php' ),
				)
			);
		}

		/**
		 * Close Popup Permanently
		 *
		 * @since 5.6.5
		 */
		public function tp_onbording_skip() {

			check_ajax_referer( 'tp_onbording_popup', 'security' );

			$option_value = get_option( $this->db_editor_onbording_key );
			if ( ! empty( $option_value ) && 'yes' === $option_value ) {
				update_option( $this->db_editor_onbording_key, 'yes' );
			} else {
				add_option( $this->db_editor_onbording_key, 'yes' );
			}

			$result = $this->tp_response( 'Success', '', true, [] );

			wp_send_json( $result );
		}

        /**
		 * Import Template
		 *
		 * @since 5.6.5
		 */
		public function tp_open_preview_popup() {
            
			check_ajax_referer( 'tp_onbording_popup', 'security' );

            $option_value = get_option( $this->db_editor_onbording_key );

			if ( ! empty( $option_value ) && 'yes' === $option_value ) {
				update_option( $this->db_editor_onbording_key, 'yes' );
			} else {
				add_option( $this->db_editor_onbording_key, 'yes' );
			}
            
            $result = [];
            if ( defined( 'WDKIT_VERSION' ) ) {
                $result['wdkit_popup'] = 'yes';
			}else{
                delete_option('tp_wdkit_preview_popup');

                $result['preview_popup'] = 'yes';
            }

			wp_send_json($result);
        }
        
		/**
		 * It is WDesignKit Popup Design for Download and install
		 *
		 * @since 5.6.5
		 */
		public function tp_onbording_html_popup() {

            if ( ! defined( 'WDKIT_VERSION' ) ) {
                delete_option('tp_wdkit_preview_popup');
			}

            ?>

			<div id="tp-onbording-wrap" class="tp-editor-onbording" style="display:none">
               <div class="tp-onbording-image">
                    <img src="<?php echo esc_url( L_THEPLUS_URL .  "assets/images/wdesignkit/tp-wdkit-Frame.png" ) ?>" alt="tp-onbording-image">
               </div>
                <div class="tp-descriptions">
                    <div class="top-descriptons">
                        <?php echo esc_html__( 'Introducing 1000+ Elementor Templates Made with The Plus Addons for Elementor Widgets', 'tpebl' ); ?>
                    </div>
                    <div class="bottom-descriptons">
                        <?php echo esc_html__( 'The long wait is finally over! We bring you over 1000 Templates & Sections made using The Plus Addons for Elementor, showcasing its fullest customizable potential. Try it now!', 'tpebl' ); ?>
                    </div>
                </div>
                <div class="tp-button-wrap">
                    <a href="#" class="tp-skip-button"><?php echo esc_html__( 'Skip', 'tpebl' ); ?></a>
                    <a href="#" class="tp-button tp-do-it-button"><?php echo esc_html__( 'Import Templates', 'tpebl' ); ?></a>
                </div>
			</div> <?php
		}

        /**
		 * Response
		 *
		 * @param string  $message pass message.
		 * @param string  $description pass message.
		 * @param boolean $success pass message.
		 * @param string  $data pass message.
		 *
		 * @since 5.4.0
		 */
		public function tp_response( $message = '', $description = '', $success = false, $data = '' ) {

			return array(
				'message'     => $message,
				'description' => $description,
				'success'     => $success,
				'data'        => $data,
			);
		}
	}

	Tp_Editor_onbording::instance();
}
