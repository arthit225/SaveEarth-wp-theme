<?php
/**
 * It is Main File to load all Notice, Upgrade Menu and all
 *
 * @link       https://posimyth.com/
 * @since      5.3.4
 *
 * @package    Theplus
 * @subpackage ThePlus/Notices
 * */

namespace Theplus\Notices;

/**
 * Exit if accessed directly.
 * */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tp_Onbording' ) ) {

	/**
	 * This class used for only load All Notice Files
	 *
	 * @since 5.3.4
	 */
	class Tp_Onbording {

		/**
		 * Instance
		 *
		 * @since 5.3.4
		 * @access private
		 * @static
		 * @var instance of the class.
		 */
		private static $instance = null;

		/**
		 * Onbording APi
		 *
		 * @since 5.3.4
		 * @access public
		 * @static
		 * @var onbording_api of the class.
		 */
		public $onbording_api = 'https://api.posimyth.com/wp-json/tpae/v2/tpae_store_user_data';

		/**
		 * Singleton Instance Creation Method.
		 *
		 * This public static method ensures that only one instance of the class is loaded or can be loaded.
		 * It follows the Singleton design pattern to create or return the existing instance of the class.
		 *
		 * @since 5.3.4
		 * @access public
		 * @static
		 * @return self Instance of the class.
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
		 * @since 5.3.4
		 * @access public
		 */
		public function __construct() {
			$this->tp_deactivate_feedback();

			add_action( 'wp_ajax_tpae_boarding_store', array( $this, 'tpae_boarding_store' ) );
			add_action( 'wp_ajax_tpae_install_nexter', array( $this, 'tpae_install_nexter' ) );
			add_action( 'wp_ajax_tpae_onbording_close', array( $this, 'tpae_onbording_close' ) );
		}

		/**
		 * Check if the Current Screen is Related to Plugin Management.
		 *
		 * @since 5.3.3
		 * @access private
		 *
		 * @return bool True if the current screen is for managing plugins, otherwise false.
		 */
		private function tp_plugins_screen() {

			$pages = array( 'toplevel_page_theplus_welcome_page' );

			return in_array( get_current_screen()->id, $pages, true );
		}

		/**
		 * Initialize Hooks for Deactivation Feedback Functionality.
		 *
		 * Fired by the `current_screen` action hook.
		 *
		 * @since 5.3.4
		 * @access public
		 */
		public function tp_deactivate_feedback() {

			add_action(
				'current_screen',
				function () {

					if ( ! $this->tp_plugins_screen() ) {
						return;
					}

					add_action( 'admin_enqueue_scripts', array( $this, 'tpae_onboarding_assets' ) );
					add_action( 'admin_footer', array( $this, 'tpae_onboarding_content_func' ) );
				}
			);
		}

		/**
		 * Perform some compatibility checks to make sure basic requirements are meet.
		 *
		 * @since 5.3.4
		 * @access public
		 */
		public function tpae_onboarding_assets() {
			$nonce = wp_create_nonce( 'tpae_onboarding_nonce' );

			wp_enqueue_style( 'tp-onboarding-css', L_THEPLUS_URL . 'assets/css/admin/tp-onbording.css', array(), L_THEPLUS_VERSION );

			wp_enqueue_script( 'tp-onboarding-js', L_THEPLUS_URL . 'assets/js/admin/tp-onbording.js', array(), L_THEPLUS_VERSION, false );
			wp_localize_script(
				'tp-onboarding-js',
				'tp_onboarding_vars',
				array(
					'nonce' => $nonce,
				)
			);
		}

		/**
		 * Perform some compatibility checks to make sure basic requirements are meet.
		 *
		 * @since 5.3.4
		 * @access public
		 */
		public function tpae_onboarding_content_func() {

			$web_com = array(
				array(
					'title' => esc_html__( 'Basic', 'tpebl' ),
					'svg'   => '<svg class="select-svg" xmlns="http://www.w3.org/2000/svg" fill="none"><path class="bg" fill="#ED4569" d="M4 48h64v4H4z"/><path fill-rule="evenodd" d="M4.781 6.89H67.22v38.672H4.78V6.892Zm0 41.485v2.813H67.22v-2.813H4.78ZM1.97 6.891A2.813 2.813 0 0 1 4.78 4.078H67.22a2.812 2.812 0 0 1 2.812 2.813v44.297A2.812 2.812 0 0 1 67.22 54H42.33c.07 1.655.625 3.24 1.3 4.52.602 1.14 1.228 1.907 1.56 2.23h3.465c.466 0 .844.378.844.844v3.656h21.094a1.406 1.406 0 0 1 0 2.813H1.406a1.406 1.406 0 0 1 0-2.813H22.5v-3.656c0-.466.378-.844.844-.844h3.466c.33-.323.957-1.09 1.559-2.23.675-1.28 1.23-2.865 1.3-4.52H4.78a2.813 2.813 0 0 1-2.812-2.813V6.892ZM32.483 54h7.034c.07 2.231.803 4.272 1.627 5.833.169.32.345.626.526.917h-.608a.844.844 0 0 0-.843.844v3.656H31.78v-3.656a.844.844 0 0 0-.843-.844h-.608c.18-.29.357-.598.526-.917.824-1.561 1.557-3.602 1.627-5.833Zm14.205 11.25H43.03v-1.688h3.657v1.688Zm-17.72 0v-1.688h-3.655v1.688h3.656Zm11.523-38.24h7.255v6.837l-6.319-1.693a1 1 0 0 0-1.22 1.243l1.007 3.496h-8.96v-6.01h.585v-2h-2.187v1.032h-.398V32.5H20V17h23.5v8.01h-4.835v.922h-.174v1.98h2v-.902ZM43.5 15H20v-3h23.5v3ZM30.255 37.893V34.5H19a1 1 0 0 1-1-1V11a1 1 0 0 1 1-1h25.5a1 1 0 0 1 1 1v14.01h3.245a1 1 0 0 1 1 1v8.373l.528.141a1 1 0 0 1 .278 1.81l-1.151.732 2.723 2.724a1 1 0 0 1 0 1.414l-2.503 2.504a1 1 0 0 1-1.415 0l-2.743-2.743-.79 1.636a1 1 0 0 1-1.861-.158l-1.022-3.55H31.254a1 1 0 0 1-1-1Zm12.364-3.349 1.39 4.83.264-.547a1 1 0 0 1 1.608-.272l3.031 3.031 1.09-1.089-2.898-2.898a1 1 0 0 1 .17-1.55l.284-.182-4.94-1.323ZM24 19h1v.99h-.907V21H23v-2h1Zm2.28 1v-1h2.186v2H26.28v-1Zm4.372 0v-1h2.187v2h-2.187v-1Zm4.373 0v-1h2.186v2h-2.186v-1Zm3.466-.01V19h2v2h-1.093v-1.01h-.907Zm2 1.98v1.981h-2v-1.98h2ZM23 29.884v-1h1.093v1.01H25v.99h-2v-1Zm16.398 1h-.907v-.99h.907v-1.01h1.093v2h-1.093Zm-2.187-1v1h-2.186v-2h2.186v1Zm-8.745 0v1H26.28v-2h2.186v1ZM24 27.913h-1v-1.981h2v1.98h-1Zm0-3.962h-1v-1.98h2v1.98h-1Z" clip-rule="evenodd"/></svg>',
				),
				array(
					'title' => esc_html__( 'Moderate', 'tpebl' ),
					'svg'   => '<svg class="select-svg" xmlns="http://www.w3.org/2000/svg" fill="none"><path class="bg" fill="#ED4569" d="M4 48h64v4H4z"/><path fill-rule="evenodd" d="M4.781 6.891h62.438v38.672H4.781V6.891zm0 41.484v2.813h62.438v-2.812H4.781zM1.969 6.891a2.812 2.812 0 0 1 2.813-2.812H67.22a2.812 2.812 0 0 1 2.812 2.813v44.297a2.813 2.813 0 0 1-2.812 2.813H42.331c.069 1.655.624 3.24 1.3 4.52.602 1.14 1.228 1.907 1.559 2.23h3.466c.466 0 .844.378.844.844v3.656h21.094a1.406 1.406 0 0 1 0 2.812H1.406a1.406 1.406 0 0 1 0-2.814H22.5v-3.656c0-.466.378-.844.844-.844h3.466c.331-.323.957-1.09 1.559-2.23.676-1.28 1.231-2.866 1.3-4.52H4.781a2.812 2.812 0 0 1-2.812-2.812V6.891zM32.483 54h7.034c.07 2.231.803 4.272 1.627 5.833l.525.917h-.607a.844.844 0 0 0-.844.844v3.656H31.78v-3.656a.844.844 0 0 0-.844-.844h-.607l.525-.917c.824-1.562 1.557-3.602 1.627-5.833zm14.205 11.25h-3.656v-1.687h3.656v1.688zm-17.719 0v-1.687h-3.656v1.688h3.656zm9.874-52.031H36.03l-1.406 11.25h2.813l1.406-11.25zM31.4 14.906l1.989 1.989-1.993 1.993 1.993 1.993L31.4 22.87l-3.977-3.977.005-.005-.005-.005 3.977-3.978zm10.697 0-1.989 1.989 1.993 1.993-1.993 1.993 1.989 1.989 3.977-3.977-.005-.005.005-.005-3.977-3.978zM16.594 31.5c0-.777.63-1.406 1.406-1.406h27.563a1.406 1.406 0 0 1 0 2.812H18c-.777 0-1.406-.63-1.406-1.406zM18 35.719a1.406 1.406 0 0 0 0 2.812h17.297a1.406 1.406 0 0 0 0-2.812H18zm21.516 1.406c0-.777.63-1.406 1.406-1.406h4.641a1.406 1.406 0 0 1 0 2.812h-4.641c-.777 0-1.406-.63-1.406-1.406zM18 24.469a1.406 1.406 0 0 0 0 2.812h4.641a1.406 1.406 0 0 0 0-2.812H18z"/></svg>',
				),
				array(
					'title' => esc_html__( 'Advanced', 'tpebl' ),
					'svg'   => '<svg class="select-svg" xmlns="http://www.w3.org/2000/svg" fill="none"><path class="bg" fill="#ED4569" d="M4 48h64v4H4z"/><path fill-rule="evenodd" d="M67.219 6.891H4.781v38.672h6.703c.017-.112.047-.224.092-.333.163-.392.401-.749.701-1.049h.001l.046-.046c.013-.014.022-.032.025-.051s.001-.041-.007-.059l-.006-.014c-.008-.018-.021-.034-.037-.045s-.035-.017-.055-.017h-.151a3.235 3.235 0 1 1 0-6.468h.056a.102.102 0 0 0 .086-.067l.033-.082a.102.102 0 0 0-.018-.11l-.046-.046-.001-.001a3.23 3.23 0 0 1-.947-2.288c0-.425.084-.846.246-1.239s.401-.749.702-1.049a3.24 3.24 0 0 1 3.527-.701c.393.163.749.401 1.049.701l.046.046c.014.013.032.022.051.025s.041.001.059-.007a1.39 1.39 0 0 1 .137-.052.093.093 0 0 0 .012-.046v-.151a3.237 3.237 0 0 1 3.234-3.234 3.235 3.235 0 0 1 3.234 3.234v.078c0 .02.006.038.017.055s.027.03.045.037l.014.006a.102.102 0 0 0 .11-.018l.046-.046h.001a3.23 3.23 0 0 1 2.288-.948 3.234 3.234 0 0 1 2.989 1.997 3.245 3.245 0 0 1 0 2.478 3.237 3.237 0 0 1-.702 1.05l-.046.046c-.013.014-.022.032-.025.051s-.001.041.007.059c.02.045.037.09.052.137a.12.12 0 0 0 .046.012h.151a3.237 3.237 0 0 1 3.234 3.234 3.235 3.235 0 0 1-3.234 3.234h-.078a.102.102 0 0 0-.092.062l-.006.014a.102.102 0 0 0 .018.11l.046.046c.301.3.539.657.702 1.05.055.133.088.27.101.406h37.981V6.891zm-41.21 38.672H14.75a2.922 2.922 0 0 0 .169-2.668 2.913 2.913 0 0 0-2.665-1.76h-.161a.42.42 0 1 1 0-.842h.115a2.915 2.915 0 0 0 2.651-1.866 2.917 2.917 0 0 0-.6-3.174l-.011-.011-.055-.055v-.001a.407.407 0 0 1-.124-.299.43.43 0 0 1 .124-.299l.001-.001a.407.407 0 0 1 .299-.124.43.43 0 0 1 .299.124v.001l.055.055.011.011a2.915 2.915 0 0 0 2.956.682c.109-.018.216-.05.318-.094a2.908 2.908 0 0 0 1.766-2.667v-.161a.42.42 0 0 1 .422-.422.42.42 0 0 1 .422.422V32.502a2.914 2.914 0 0 0 1.76 2.665 2.923 2.923 0 0 0 3.208-.586l.011-.011.055-.055.001-.001a.407.407 0 0 1 .299-.124.43.43 0 0 1 .299.124l.001.001a.407.407 0 0 1 .124.299.43.43 0 0 1-.124.299l-.055.055-.011.011a2.915 2.915 0 0 0-.682 2.956 1.41 1.41 0 0 0 .094.318 2.919 2.919 0 0 0 2.668 1.766h.161a.42.42 0 0 1 .422.422.42.42 0 0 1-.422.422H28.463a2.921 2.921 0 0 0-2.863 3.449c.068.376.209.732.413 1.051zM4.781 51.188v-2.812h62.438v2.813H4.781zm0-47.109a2.812 2.812 0 0 0-2.812 2.813v44.297A2.812 2.812 0 0 0 4.781 54h24.887c-.069 1.655-.624 3.24-1.3 4.52-.602 1.14-1.228 1.907-1.559 2.23h-3.466a.844.844 0 0 0-.844.844v3.656H1.406a1.407 1.407 0 0 0 0 2.812h69.189a1.406 1.406 0 0 0 0-2.812H49.5v-3.656a.844.844 0 0 0-.844-.844H45.19c-.331-.323-.957-1.09-1.559-2.23-.676-1.28-1.231-2.866-1.3-4.52h24.887a2.812 2.812 0 0 0 2.812-2.812V6.891a2.812 2.812 0 0 0-2.812-2.812H4.781zm36.363 55.755.525.917h-.607a.844.844 0 0 0-.844.844v3.656H31.78v-3.656a.844.844 0 0 0-.844-.844h-.607l.525-.917c.824-1.562 1.557-3.602 1.627-5.833h7.034c.07 2.231.803 4.272 1.627 5.833zM10.688 13.641a1.406 1.406 0 0 0 0 2.812H38.25a1.406 1.406 0 0 0 0-2.812H10.688zm-1.406 7.031c0-.777.63-1.406 1.406-1.406h17.297a1.406 1.406 0 0 1 0 2.812H10.688c-.777 0-1.406-.63-1.406-1.406zm24.328-1.406a1.406 1.406 0 0 0 0 2.812h4.641a1.406 1.406 0 0 0 0-2.812H33.61zM9.281 26.297c0-.777.63-1.406 1.406-1.406h4.641a1.406 1.406 0 0 1 0 2.812h-4.641c-.777 0-1.406-.63-1.406-1.406zm9.703 14.344a1.336 1.336 0 1 1 2.672 0 1.336 1.336 0 0 1-2.672 0zm1.336-4.148a4.15 4.15 0 0 0-4.148 4.148 4.15 4.15 0 0 0 4.148 4.148 4.15 4.15 0 0 0 4.149-4.148 4.15 4.15 0 0 0-4.149-4.148zm30.616 6.961 1.406-11.25H49.53l-1.406 11.25h2.813zm-6.037-9.562 1.989 1.989-1.993 1.993 1.993 1.993-1.989 1.989-3.977-3.977.005-.005-.005-.005 3.977-3.977zm10.697 0-1.989 1.989 1.993 1.993-1.993 1.993 1.989 1.989 3.977-3.977-.005-.005.005-.005-3.977-3.977zM46.688 65.25h-3.656v-1.687h3.656v1.688zm-17.719 0v-1.687h-3.656v1.688h3.656zm30.656-41.766v3.375h-4.5v-3.375h4.5zm0-2.812v-3.375h-4.5v3.375h4.5zm-2.25-7.608 1.279 1.421h-2.557l1.279-1.421zm5.063 4.233V29.673H52.314V14.487l3.171-3.523 1.892-2.102 1.892 2.102 3.171 3.523V17.3z"/></svg>',
				),
			);

			$web_type = array(
				array(
					'title' => esc_html__( 'Blog/Magazine', 'tpebl' ),
					'svg'   => '<svg class="select-svg" xmlns="http://www.w3.org/2000/svg" fill="none"><path class="bg" fill="#ED4569" d="M5 5h38v5H5z"/><path fill-rule="evenodd" d="M5 5v4.5h38V5H5zm0 38V11.5h38V43H5zM4.5 3A1.5 1.5 0 0 0 3 4.5v39A1.5 1.5 0 0 0 4.5 45h39a1.5 1.5 0 0 0 1.5-1.5v-39A1.5 1.5 0 0 0 43.5 3h-39zM27 20a1 1 0 1 0 0 2h12a1 1 0 1 0 0-2H27zm-1 6.25a1 1 0 0 1 1-1h3a1 1 0 1 1 0 2h-3a1 1 0 0 1-1-1zm8.5-1a1 1 0 1 0 0 2H39a1 1 0 1 0 0-2h-4.5zm-17.1-1.272 4.6-4.6v9.2l-4.6-4.6zm-1.414 1.414 4.599 4.599h-9.198l4.599-4.599zm-1.414-1.414L9.5 29.05V18.906l5.072 5.072zm1.414-1.414 5.072-5.073H10.913l5.073 5.073zM9 15.491a1.5 1.5 0 0 0-1.5 1.5v13.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-13.5a1.5 1.5 0 0 0-1.5-1.5H9zM9 37a1 1 0 1 0 0 2h31a1 1 0 1 0 0-2H9z"/></svg>',
				),
				array(
					'title' => esc_html__( 'eCommerce', 'tpebl' ),
					'svg'   => '<svg class="select-svg" xmlns="http://www.w3.org/2000/svg" fill="none"><g clip-path="url(#a)"><path d="M27.768 22.857H45.34a2.66 2.66 0 0 0 2.661-2.661V4.661A2.66 2.66 0 0 0 45.34 2H4.641c-1.468 0-2.652 1.204-2.64 2.645v15.552a2.66 2.66 0 0 0 2.661 2.661h19.796l4.285 2.386-.974-2.386zm4.98 6.906-8.81-4.906H4.662a4.66 4.66 0 0 1-4.661-4.661V4.661C-.02 2.106 2.065 0 4.641 0H45.34a4.66 4.66 0 0 1 4.661 4.661v15.536a4.66 4.66 0 0 1-4.661 4.661H30.745l2.003 4.906z"/><path class="bg" fill="#ED4569" d="M9.248 6.059c.202-.274.505-.419.91-.448.737-.058 1.155.289 1.256 1.04l1.458 7.668 3.162-6.021c.289-.549.65-.838 1.083-.866.635-.043 1.025.361 1.184 1.213.361 1.921.823 3.552 1.372 4.938.375-3.668 1.011-6.31 1.906-7.942.217-.404.534-.606.953-.635.332-.029.635.072.91.289a1.13 1.13 0 0 1 .448.823 1.25 1.25 0 0 1-.144.693c-.563 1.04-1.025 2.787-1.401 5.213-.361 2.354-.491 4.188-.404 5.502.029.361-.029.679-.173.953-.173.318-.433.491-.765.52-.375.029-.765-.144-1.141-.534-1.343-1.372-2.411-3.422-3.191-6.151l-2.079 4.159c-.852 1.632-1.574 2.469-2.18 2.512-.39.029-.722-.303-1.011-.996-.736-1.892-1.531-5.545-2.383-10.96a1.23 1.23 0 0 1 .231-.967zM40.28 8.326c-.52-.91-1.285-1.458-2.31-1.675a3.79 3.79 0 0 0-.78-.087c-1.386 0-2.512.722-3.393 2.166a7.65 7.65 0 0 0-1.126 4.072c0 1.112.231 2.065.693 2.859.52.91 1.285 1.458 2.31 1.675a3.79 3.79 0 0 0 .78.087c1.401 0 2.527-.722 3.393-2.166a7.736 7.736 0 0 0 1.126-4.086c.014-1.126-.231-2.065-.693-2.845zm-1.819 4c-.202.953-.563 1.661-1.097 2.137-.419.375-.809.534-1.17.462-.347-.072-.635-.375-.852-.938a3.671 3.671 0 0 1-.26-1.314c0-.361.029-.722.101-1.054a4.67 4.67 0 0 1 .765-1.718c.477-.708.982-.996 1.502-.895.347.072.635.375.852.939.173.448.26.895.26 1.314 0 .376-.029.736-.101 1.069zm-7.22-4c-.52-.91-1.3-1.458-2.31-1.675a3.79 3.79 0 0 0-.78-.087c-1.386 0-2.512.722-3.393 2.166a7.65 7.65 0 0 0-1.126 4.072c0 1.112.231 2.065.693 2.859.52.91 1.285 1.458 2.31 1.675.274.058.534.087.78.087 1.401 0 2.527-.722 3.393-2.166a7.736 7.736 0 0 0 1.126-4.086c0-1.126-.231-2.065-.693-2.845zm-1.834 4c-.202.953-.563 1.661-1.097 2.137-.419.375-.809.534-1.17.462-.347-.072-.635-.375-.852-.938a3.671 3.671 0 0 1-.26-1.314 5.02 5.02 0 0 1 .101-1.054 4.66 4.66 0 0 1 .765-1.718c.476-.708.982-.996 1.502-.895.346.072.635.375.852.939.173.448.26.895.26 1.314.015.376-.029.736-.101 1.069z"/></g><defs><clipPath id="a"><path d="M0 0h50v29.883H0z"/></clipPath></defs></svg>',
				),
				array(
					'title' => esc_html__( 'Landing Page', 'tpebl' ),
					'svg'   => '<svg class="select-svg" xmlns="http://www.w3.org/2000/svg" fill="none"><path class="bg" fill="#ED4569" d="M20.5 28h3l1.5 4.5-7 3 2.5-7.5z"/><path fill-rule="evenodd" d="M44.994 3.891a1 1 0 0 0-.287-.599.993.993 0 0 0-.636-.29 1 1 0 0 0-.423.061L3.67 17.056a1 1 0 0 0-.076 1.858l17.062 7.583-4.559 9.573a1 1 0 0 0 1.35 1.324l7.056-3.528 4.579 10.532a1 1 0 0 0 1.861-.068L44.937 4.351a1 1 0 0 0 .058-.46zm-4.8 2.5L6.711 18.111l15.067 6.697L40.194 6.392zM23.2 26.214 41.609 7.806l-11.71 33.455-3.982-9.159-.009-.02-2.708-5.867zm-4.048 8.092 2.833-5.95 1.7 3.683-4.533 2.267z"/></svg>',
				),
				array(
					'title' => esc_html__( 'Dynamic', 'tpebl' ),
					'svg'   => '<svg class="select-svg" xmlns="http://www.w3.org/2000/svg" fill="none"><path class="bg" fill="#ED4569" d="M2 3h44v5H2z"/><path fill-rule="evenodd" d="M2.75 7.719V3.594h42.5v4.125H2.75zm0 2v34.687h42.5V9.719H2.75zm-2-6.625a1.5 1.5 0 0 1 1.5-1.5h43.5a1.5 1.5 0 0 1 1.5 1.5v41.812a1.5 1.5 0 0 1-1.5 1.5H2.25a1.5 1.5 0 0 1-1.5-1.5V3.094zM8 14.5V27h12.5V14.5H8zm-1.062-2a.94.94 0 0 0-.937.938v14.625a.94.94 0 0 0 .938.938h14.625a.94.94 0 0 0 .938-.937V13.438a.94.94 0 0 0-.937-.937H6.938zM8 38.5v-5h12.5v5H8zm-2-6.062a.94.94 0 0 1 .938-.937h14.625a.94.94 0 0 1 .938.938v7.125a.94.94 0 0 1-.937.938H6.938A.94.94 0 0 1 6 39.563v-7.125zM27.5 14.5V27H40V14.5H27.5zm-1.062-2a.94.94 0 0 0-.937.938v14.625a.94.94 0 0 0 .938.938h14.625a.94.94 0 0 0 .938-.937V13.438a.94.94 0 0 0-.937-.937H26.438zm1.063 26v-5H40v5H27.5zm-2-6.062a.94.94 0 0 1 .938-.937h14.625a.94.94 0 0 1 .938.938v7.125a.94.94 0 0 1-.937.938H26.438a.94.94 0 0 1-.937-.937V32.44z"/></svg>',
				),
				array(
					'title' => esc_html__( 'Business', 'tpebl' ),
					'svg'   => '<svg class="select-svg" xmlns="http://www.w3.org/2000/svg" fill="none"><path class="bg" fill="#ED4569" d="M15 15h18v10.5H15z"/><path fill-rule="evenodd" d="M27.068 3.068a.5.5 0 0 0-.705-.456L16.79 6.914l10.277-1.832V3.068zm2 1.657V3.068c0-1.814-1.871-3.024-3.525-2.28L8.59 8.407 8 8.672V44.25a2.5 2.5 0 0 0 2.5 2.5h26.701a2.5 2.5 0 0 0 2.5-2.5V10.82a2.5 2.5 0 0 0-2.5-2.5h-4.05V6.982a2.5 2.5 0 0 0-2.939-2.461l-1.144.204zm2.083 3.594V6.982a.5.5 0 0 0-.588-.492l-2.319.414-7.937 1.415H31.15zm-21.15 2h27.2a.5.5 0 0 1 .5.5V44.25a.5.5 0 0 1-.5.5H10.5a.5.5 0 0 1-.5-.5V10.32zM16 16v8h16v-8H16zm-.5-2a1.5 1.5 0 0 0-1.5 1.5v9a1.5 1.5 0 0 0 1.5 1.5h17a1.5 1.5 0 0 0 1.5-1.5v-9a1.5 1.5 0 0 0-1.5-1.5h-17zm.5 16a1 1 0 1 0 0-2 1 1 0 1 0 0 2zm1 4a1 1 0 1 1-2 0 1 1 0 1 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 1 0 0 2zm1-6a1 1 0 1 1-2 0 1 1 0 1 1 2 0zm3 6a1 1 0 1 0 0-2 1 1 0 1 0 0 2zm1-6a1 1 0 1 1-2 0 1 1 0 1 1 2 0zm3 6a1 1 0 1 0 0-2 1 1 0 1 0 0 2zm1-6a1 1 0 1 1-2 0 1 1 0 1 1 2 0zm3 6a1 1 0 1 0 0-2 1 1 0 1 0 0 2zm1-6a1 1 0 1 1-2 0 1 1 0 1 1 2 0zM14.45 39a.45.45 0 0 0-.45.45v1.1a.45.45 0 0 0 .45.45h19.1a.45.45 0 0 0 .45-.45v-1.1a.45.45 0 0 0-.45-.45h-19.1z"/></svg>',
				),
				array(
					'title' => esc_html__( 'Personal', 'tpebl' ),
					'svg'   => '<svg class="select-svg" xmlns="http://www.w3.org/2000/svg" fill="none"><path class="bg" fill="#ED4569" d="M3.005 34.587c17.305 18.739 34.917 8.122 42.193-.187a1.35 1.35 0 0 0 .229-1.445c-2.485-5.51-8.452-6.813-11.767-7.351a1.58 1.58 0 0 0-1.188.308c-6.249 4.635-13.704 2.003-17.083-.154a1.458 1.458 0 0 0-.857-.246c-4.751.25-9.389 4.226-11.66 7.319-.391.532-.314 1.271.134 1.756z"/><path fill-rule="evenodd" d="M34 12c0 5.523-4.477 10-10 10s-10-4.477-10-10S18.477 2 24 2s10 4.477 10 10zm2 0c0 6.627-5.373 12-12 12s-12-5.373-12-12S17.373 0 24 0s12 5.373 12 12zM14.584 26.511a.47.47 0 0 1 .267.09c3.505 2.237 11.464 5.123 18.217.114a.583.583 0 0 1 .432-.124c3.336.542 8.769 1.793 11.016 6.775a.35.35 0 0 1-.07.375c-3.539 4.042-9.574 8.613-16.761 9.911-7.107 1.284-15.501-.6-23.945-9.744-.156-.169-.141-.378-.062-.485 1.073-1.461 2.721-3.149 4.664-4.495 1.949-1.351 4.118-2.305 6.243-2.417zm1.343-1.596a2.45 2.45 0 0 0-1.447-.401c-2.626.138-5.152 1.297-7.277 2.77-2.132 1.478-3.938 3.324-5.136 4.955-.702.956-.534 2.226.205 3.026 8.861 9.595 17.926 11.772 25.77 10.355 7.764-1.403 14.174-6.295 17.91-10.562a2.35 2.35 0 0 0 .388-2.515c-2.724-6.039-9.225-7.392-12.518-7.927a2.575 2.575 0 0 0-1.944.492c-5.744 4.261-12.697 1.882-15.949-.194z"/></svg>',
				),
				array(
					'title' => esc_html__( 'Portfolio', 'tpebl' ),
					'svg'   => '<svg class="select-svg" xmlns="http://www.w3.org/2000/svg" fill="none"><path class="bg" fill="#ED4569" d="m41.224 13.913 2.819 1.614-13.581 23.71-2.819-1.614z"/><path fill-rule="evenodd" d="M4.182 4.22c-.123 0-.222.1-.222.222v39.113c0 .123.1.222.222.222h31.779a.221.221 0 0 0 .222-.222v-6.111a1 1 0 1 1 2 0v6.111a2.222 2.222 0 0 1-2.222 2.222H4.182a2.222 2.222 0 0 1-2.222-2.222V4.442c0-1.227.995-2.222 2.222-2.222h31.779c1.227 0 2.222.995 2.222 2.222v8.556a1 1 0 1 1-2 0V4.442c0-.123-.1-.222-.222-.222H4.182zM24.624 19.5a6.47 6.47 0 0 0 1.376-4 6.5 6.5 0 1 0-13 0 6.47 6.47 0 0 0 1.376 4l.042-.105.117-.264a5.5 5.5 0 0 1 1.075-1.52 5.52 5.52 0 0 1 1.178-.897A3.491 3.491 0 0 1 16 14.5a3.5 3.5 0 1 1 7 0c0 .84-.296 1.611-.789 2.214.431.244.827.545 1.178.897a5.5 5.5 0 0 1 1.075 1.52l.117.264.042.105zM21 14.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 1 1 3 0zm2.056 6.442-.053-.086a1.573 1.573 0 0 1-.146-.343 3.49 3.49 0 0 0-.124-.352l-.096-.212a3.5 3.5 0 0 0-1.797-1.682 3.5 3.5 0 0 0-2.678 0 3.5 3.5 0 0 0-1.797 1.682l-.096.212a3.49 3.49 0 0 0-.124.352 1.594 1.594 0 0 1-.146.343l-.053.086A6.47 6.47 0 0 0 19.5 22a6.47 6.47 0 0 0 3.556-1.058zM19.5 24a8.5 8.5 0 1 0 0-17 8.5 8.5 0 1 0 0 17zM14 28a1 1 0 1 0 0 2h11.445a1 1 0 1 0 0-2H14zm-6 1a1 1 0 1 1 2 0 1 1 0 1 1-2 0zm1 4a1 1 0 1 0 0 2 1 1 0 1 0 0-2zm4 1a1 1 0 0 1 1-1h11.445a1 1 0 1 1 0 2H14a1 1 0 0 1-1-1zm29.404-21.265a2.223 2.223 0 0 0-3.028.821l-1.615 2.804-9.389 16.307-.074.129-.034.145-1.398 6.057c-.354 1.534 1.477 2.613 2.648 1.56l4.671-4.204.118-.106.079-.138 9.272-16.105 1.727-3a2.222 2.222 0 0 0-.823-3.038l-2.155-1.232zm-1.295 1.819a.222.222 0 0 1 .303-.082l2.156 1.232a.222.222 0 0 1 .082.304l-1.206 2.095-2.472-1.573 1.137-1.975zm-2.136 3.71 2.472 1.573-8.298 14.412-2.541-1.452 8.367-14.532zM29.91 34.702l1.909 1.091-2.727 2.455.818-3.545z"/></svg>',
				),
				array(
					'title' => esc_html__( 'Other', 'tpebl' ),
					'svg'   => '<svg class="select-svg" xmlns="http://www.w3.org/2000/svg" fill="none" fill-rule="evenodd"><path d="M33 12.5H15C8.649 12.5 3.5 17.649 3.5 24S8.649 35.5 15 35.5h18c6.351 0 11.5-5.149 11.5-11.5S39.351 12.5 33 12.5zm-18-2C7.544 10.5 1.5 16.544 1.5 24S7.544 37.5 15 37.5h18c7.456 0 13.5-6.044 13.5-13.5S40.456 10.5 33 10.5H15z"/><path class="bg" fill="#ED4569" d="M17 24a2 2 0 1 1-4 0 2 2 0 1 1 4 0zm9 0a2 2 0 1 1-4 0 2 2 0 1 1 4 0zm7 2a2 2 0 1 0 0-4 2 2 0 1 0 0 4z"/></svg>',
				),
			);

			$output              = '<div class="tpae-boarding-pop" data-type="onboarding-process">';
				$output         .= '<div class="tpae-board-pop-inner">';
					$output     .= '<div class="tpae-boarding-paging">';
						$output .= '<div class="tpae-pagination">1/8</div>';
					$output     .= '</div>';
					$output     .= '<button class="tpae-close-button"><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 384 512"><path fill="#fff" d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z"/></svg></button>';

					$output                 .= '<section class="tpae-on-boarding active" data-step="1">';
						$output             .= '<div class="tpae-onboarding-content">';
							$output         .= '<div class="tpae-onboarding-details">';
								$output     .= '<div class="tpae-section-data mt-50">';
									$output .= '<img class="tpae-img" src="' . esc_url( L_THEPLUS_ASSETS_URL . 'images/on-boarding/page1.png' ) . '" />';
									$user    = wp_get_current_user();
			if ( $user ) {
				$output .= '<div class="tpae-title tpae-wd-70 mt-15">' . esc_html__( 'Well done!', 'tpebl' ) . ' <img class="tpae-circle-img" src="' . esc_url( get_avatar_url( $user->ID ) ) . '" /> ' . esc_html( $user->display_name ) . esc_html__( ' on installing The Plus Addons for Elementor.', 'tpebl' ) . '</div>';
			}
									$output .= '<div class="tpae-check-content mt-15">' . esc_html__( 'We suggest you to complete this flow to make sure you enjoy a smooth experience with the plugin', 'tpebl' ) . '</div>';
								$output     .= '</div>';
							$output         .= '</div>';
						$output             .= '</div>';
					$output                 .= '</section>';

					$output             .= '<section class="tpae-on-boarding" data-step="2">';
						$output         .= '<div class="tpae-onboarding-content">';
							$output     .= '<div class="tpae-onboarding-details">';
								$output .= '<div class="tpae-boarding-title mt-35">' . esc_html__( 'Select your website complexity', 'tpebl' ) . '</div>';
								$output .= '<div class="tpae-boarding-content mt-10">' . esc_html__( 'Based on your website requirements we will activate only the necessary Widgets.', 'tpebl' ) . '</div>';
								$output .= '<div class="tpae-select-3 mt-25">';
			foreach ( $web_com as $name => $data ) {
				$output         .= '<div class="tpae-select-box ' . ( 0 === $name ? ' active' : '' ) . ' ">';
					$output     .= '<div class="checkbox">';
						$output .= '<svg class="check" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 4.5L3.64706 7L10 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
					$output     .= '</div>';
					$output     .= ! empty( $data['svg'] ) ? $data['svg'] : '';
					$output     .= '<div class="select-title mt-25">' . esc_html( $data['title'] ) . '</div>';
				$output         .= '</div>';
			}
								$output .= '</div>';
							$output     .= '</div>';
						$output         .= '</div>';
					$output             .= '</section>';

					$output             .= '<section class="tpae-on-boarding" data-step="3">';
						$output         .= '<div class="tpae-onboarding-content">';
							$output     .= '<div class="tpae-onboarding-details">';
								$output .= '<div class="tpae-boarding-title mt-35">' . esc_html__( 'Select your website type', 'tpebl' ) . '</div>';
								$output .= '<div class="tpae-select-8 mt-35">';
			foreach ( $web_type as $key => $value ) {
				$output     .= '<div class="tpae-select-box ' . ( 0 === $key ? ' active' : '' ) . '">';
					$output .= '<div class="checkbox"><svg class="check" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 4.5L3.64706 7L10 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></div>';
					$output .= $value['svg'];
					$output .= '<div class="select-title mt-10">' . esc_html( $value['title'] ) . '</div>';
				$output     .= '</div>';
			}
								$output .= '</div>';
							$output     .= '</div>';
						$output         .= '</div>';
					$output             .= '</section>';

					$output                             .= '<section class="tpae-on-boarding" data-step="4">';
						$output                         .= '<div class="tpae-onboarding-content">';
							$output                     .= '<div class="tpae-onboarding-details slider">';
								$output                 .= '<div class="tpae-boarding-title mt-25">' . esc_html__( 'Know Your Addon (1/5)', 'tpebl' ) . '</div>';
								$output                 .= '<div class="tpae-theme-details mt-15">';
									$output             .= '<div class="tpae-theme-left tpae-wd-45 jc-center">';
										$output         .= '<div class="left-title tpae-wd-75 tpae-hg-55">' . esc_html__( "Great, We're almost done, now let's explore the features", 'tpebl' ) . '</div>';
									$output             .= '</div>';
									$output             .= '<div class="tpae-theme-right tpae-wd-55">';
										$output         .= '<img class="theme-img ml-20" src="' . esc_url( L_THEPLUS_ASSETS_URL . 'images/on-boarding/slider1.png' ) . '" />';
										$output         .= '<div class="tpae-learn-more" href="">' . esc_html__( 'Click here to learn more about features', 'tpebl' ) . '</div>';
									$output             .= '</div>';
								$output                 .= '</div>';
								$output                 .= '<button class="tpae-slide-right" onclick="tp_plusPage(1)">';
									$output             .= '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" fill="none"><path fill="#fff" d="M1 5.25a.75.75 0 1 0 0 1.5v-1.5zm16.53 1.28a.75.75 0 0 0 0-1.061L12.757.697a.75.75 0 1 0-1.061 1.061L15.939 6l-4.243 4.243a.75.75 0 1 0 1.061 1.061L17.53 6.53zM1 6.75h16v-1.5H1v1.5z"/></svg>';
								$output                 .= '</button>';
							$output                     .= '</div>';
							$output                     .= '<div class="tpae-onboarding-details slider">';
								$output                 .= '<div class="tpae-boarding-title mt-25">' . esc_html__( 'Know Your Addon (2/5)', 'tpebl' ) . '</div>';
								$output                 .= '<div class="tpae-theme-details mt-15">';
									$output             .= '<div class="tpae-theme-left tpae-wd-50 mt-15">';
										$output         .= '<div class="left-title tpae-wd-70 mt-25">' . esc_html__( 'Will so many features slow down my site?', 'tpebl' ) . '</div>';
										$output         .= '<div class="tpae-bgwhite-details mt-15"><img src="' . esc_url( L_THEPLUS_ASSETS_URL . 'images/on-boarding/Crown-1.png' ) . '" style="position: relative;display: flex;top: -2px;"/>' . esc_html__( 'First Elementor Addon', 'tpebl' ) . '</div>';
										$output         .= '<div class="left-content tpae-wd-90 mt-15">' . esc_html__( 'Not at all! We bring you the power of scanning unused widgets for The Plus & Core Elementor widgets. Use this once you complete making your website. This will ensure that no extra code is loaded on your website.', 'tpebl' ) . '</div>';
									$output             .= '</div>';
									$output             .= '<div class="tpae-theme-right tpae-wd-50">';
										$output         .= '<img class="theme-img" src="' . esc_url( L_THEPLUS_ASSETS_URL . 'images/on-boarding/slider2.png' ) . '" />';
									$output             .= '</div>';
								$output                 .= '</div>';
								$output                 .= '<button class="slide-left" onclick="tp_plusPage(-1)">';
									$output             .= '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" fill="none"><path fill="#fff" d="M17 6.75a.75.75 0 1 0 0-1.5v1.5zM.47 5.47a.75.75 0 0 0 0 1.061l4.773 4.773a.75.75 0 0 0 1.061-1.061L2.061 6l4.243-4.243A.75.75 0 1 0 5.243.697L.47 5.47zM17 5.25H1v1.5h16v-1.5z"/></svg>';
								$output                 .= '</button>';
								$output                 .= '<button class="tpae-slide-right" onclick="tp_plusPage(1)">';
									$output             .= '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" fill="none"><path fill="#fff" d="M1 5.25a.75.75 0 1 0 0 1.5v-1.5zm16.53 1.28a.75.75 0 0 0 0-1.061L12.757.697a.75.75 0 1 0-1.061 1.061L15.939 6l-4.243 4.243a.75.75 0 1 0 1.061 1.061L17.53 6.53zM1 6.75h16v-1.5H1v1.5z"/></svg>';
								$output                 .= '</button>';
							$output                     .= '</div>';
							$output                     .= '<div class="tpae-onboarding-details slider">';
								$output                 .= '<div class="tpae-boarding-title mt-25">' . esc_html__( 'Know Your Addon (3/5)', 'tpebl' ) . '</div>';
								$output                 .= '<div class="tpae-theme-details tpae-theme-height mt-15">';
									$output             .= '<div class="tpae-theme-left tpae-wd-45 mt-15">';
										$output         .= '<div class="left-title tpae-wd-80">' . esc_html__( 'Progressive CSS & JS delivery', 'tpebl' ) . '</div>';
										$output         .= '<div class="left-content tpae-wd-95 mt-15">' . esc_html__( 'Regardless of any number of Widgets you use, our plugin will load only 1 CSS and 1 JS file dynamically for each page. This reduces the overall request counts and guarantees better speed.', 'tpebl' ) . '</div>';
									$output             .= '</div>';
									$output             .= '<div class="tpae-theme-right tpae-wd-55">';
										$output         .= '<img class="design-img" src="' . esc_url( L_THEPLUS_ASSETS_URL . 'images/on-boarding/slider3.png' ) . '" />';
									$output             .= '</div>';
								$output                 .= '</div>';
								$output                 .= '<button class="slide-left" onclick="tp_plusPage(-1)">';
									$output             .= '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" fill="none"><path fill="#fff" d="M17 6.75a.75.75 0 1 0 0-1.5v1.5zM.47 5.47a.75.75 0 0 0 0 1.061l4.773 4.773a.75.75 0 0 0 1.061-1.061L2.061 6l4.243-4.243A.75.75 0 1 0 5.243.697L.47 5.47zM17 5.25H1v1.5h16v-1.5z"/></svg>';
								$output                 .= '</button>';
								$output                 .= '<button class="tpae-slide-right" onclick="tp_plusPage(1)">';
									$output             .= '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" fill="none"><path fill="#fff" d="M1 5.25a.75.75 0 1 0 0 1.5v-1.5zm16.53 1.28a.75.75 0 0 0 0-1.061L12.757.697a.75.75 0 1 0-1.061 1.061L15.939 6l-4.243 4.243a.75.75 0 1 0 1.061 1.061L17.53 6.53zM1 6.75h16v-1.5H1v1.5z"/></svg>';
								$output                 .= '</button>';
								$output                 .= '<div class="tpae-bgwhite-details tpae-wd-90 m-auto">' . esc_html__( 'Note: Not to be confused with Cache plugin, you would still require them, as this only affects our plus files. We are compatible to all the Popular Cache plugins.', 'tpebl' ) . '</div>';
							$output                     .= '</div>';
							$output                     .= '<div class="tpae-onboarding-details slider">';
								$output                 .= '<div class="tpae-boarding-title mt-25">' . esc_html__( 'Know Your Addon (4/5)', 'tpebl' ) . '</div>';
								$output                 .= '<div class="tpae-theme-details mt-15">';
									$output             .= '<div class="tpae-theme-left tpae-wd-45 mt-15">';
										$output         .= '<div class="left-title tpae-wd-80">' . esc_html__( 'System Requirements :', 'tpebl' ) . '</div>';
											$output     .= '<div class="left-content tpae-wd-90 mt-15">' . esc_html__( 'Make sure the following system requirements are met so that you enjoy a smoother experience', 'tpebl' ) . '</div>';
											$output     .= '<div class="tpae-system-details mt-15">';
												$output .= '<div class="tpae-feature-box">';

													$wp_check_req    = '';
													$check_wrong_req = '<svg class="cross" xmlns="http://www.w3.org/2000/svg" fill="none"><path fill="#fff" fill-rule="evenodd" d="M1.314 2.728a1 1 0 0 1 1.372-1.456l2.49 2.35 2.49-2.35A1 1 0 1 1 9.04 2.728L6.634 4.996l2.405 2.268a1 1 0 1 1-1.372 1.455L5.177 6.37 2.686 8.72a1 1 0 0 1-1.373-1.455l2.405-2.268-2.405-2.268Z" clip-rule="evenodd"/></svg>';
													$check_right_req = '<svg class="check" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 4.5L3.64706 7L10 1" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path></svg>';

			if ( version_compare( get_bloginfo( 'version' ), '5.0.0', '>=' ) ) {
				$wp_check_req = $check_right_req;
			} else {
				$wp_check_req = $check_wrong_req;
			}

													$output       .= '<div class="tpae-checkbox">' . $wp_check_req . '</div>';
													$output       .= '<div class="tpae-feature-text">' . esc_html__( 'WordPress: v5 or above', 'tpebl' ) . '</div>';
												$output           .= '</div>';
												$output           .= '<div class="tpae-feature-box">';
													$php_check_req = '';
			if ( version_compare( phpversion(), '7.0', '>' ) ) {
				$php_check_req = $check_right_req;
			} else {
				$php_check_req = $check_wrong_req;
			}

													$output .= '<div class="tpae-checkbox">' . $php_check_req . '</div>';
													$output .= '<div class="tpae-feature-text">' . esc_html__( 'PHP : v7.2 or above ', 'tpebl' ) . '</div>';
												$output     .= '</div>';
												$output     .= '<div class="tpae-feature-box">';

													$memory_check_req = '';
													$memory_limit     = ini_get( 'memory_limit' );
			if ( preg_match( '/^(\d+)(.)$/', $memory_limit, $matches ) ) {
				if ( 'M' === $matches[2] ) {
					$memory_limit = $matches[1] * 1024 * 1024;
				} elseif ( 'K' === $matches[2] ) {
					$memory_limit = $matches[1] * 1024;
				}
			}

			if ( $memory_limit >= 256 * 1024 * 1024 ) {
				$memory_check_req = $check_right_req;
			} else {
				$memory_check_req = $check_wrong_req;
			}

			$output     .= '<div class="tpae-checkbox">' . $memory_check_req . '</div>';
				$output .= '<div class="tpae-feature-text">' . esc_html__( 'Memory Limit : ', 'tpebl' ) . esc_html( ini_get( 'memory_limit' ) ) . '</div>';
			$output     .= '</div>';

			$output .= '<div class="tpae-feature-box">';

			$php_time   = ini_get( 'max_execution_time' );
			$check_time = '';

			if ( $php_time >= 200 ) {
				$check_time = $check_right_req;
			} else {
				$check_time = $check_wrong_req;
			}

							$output     .= '<div class="tpae-checkbox">' . $check_time . '</div>';
								$output .= '<div class="tpae-feature-text">' . esc_html__( 'Max Execution Time: 300 or above', 'tpebl' ) . '</div>';
							$output     .= '</div>';

											$output .= '</div>';
									$output         .= '</div>';
									$output         .= '<div class="tpae-theme-right tpae-wd-55">';
										$output     .= '<img class="theme-img" src="' . esc_url( L_THEPLUS_ASSETS_URL . 'images/on-boarding/slider4.png' ) . '" />';
									$output         .= '</div>';
								$output             .= '</div>';
								$output             .= '<button class="slide-left" onclick="tp_plusPage(-1)">';
									$output         .= '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" fill="none"><path fill="#fff" d="M17 6.75a.75.75 0 1 0 0-1.5v1.5zM.47 5.47a.75.75 0 0 0 0 1.061l4.773 4.773a.75.75 0 0 0 1.061-1.061L2.061 6l4.243-4.243A.75.75 0 1 0 5.243.697L.47 5.47zM17 5.25H1v1.5h16v-1.5z"/></svg>';
								$output             .= '</button>';
								$output             .= '<button class="tpae-slide-right" onclick="tp_plusPage(1)">';
									$output         .= '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" fill="none"><path fill="#fff" d="M1 5.25a.75.75 0 1 0 0 1.5v-1.5zm16.53 1.28a.75.75 0 0 0 0-1.061L12.757.697a.75.75 0 1 0-1.061 1.061L15.939 6l-4.243 4.243a.75.75 0 1 0 1.061 1.061L17.53 6.53zM1 6.75h16v-1.5H1v1.5z"/></svg>';
								$output             .= '</button>';
							$output                 .= '</div>';
							$output                 .= '<div class="tpae-onboarding-details slider">';
								$output             .= '<div class="tpae-boarding-title mt-25">' . esc_html__( 'Know Your Addon (5/5)', 'tpebl' ) . '</div>';
								$output             .= '<div class="tpae-help-section mt-30">';
									$output         .= '<div class="tpae-section-title">' . esc_html__( "We're here to help:", 'tpebl' ) . '</div>';
									$output         .= '<div class="help-section mt-20">';
										$output     .= '<div class="tpae-help-box">';
											$output .= '<div class="tpae-title">' . esc_html__( 'Get Support', 'tpebl' ) . '</div>';
											$output .= '<div class="tpae-content">' . esc_html__( 'Facing issue? Feel free to reach us at helpdesk, our team will get back to you typically within 24 working hours', 'tpebl' ) . '</div>';
											$output .= '<a href="' . esc_url( 'https://store.posimyth.com/helpdesk' ) . '" class="hs-btn">' . esc_html__( 'RAISE A TICKET', 'tpebl' ) . '</a>';
										$output     .= '</div>';
										$output     .= '<div class="tpae-help-box">';
											$output .= '<div class="tpae-title">' . esc_html__( 'Suggest Feature', 'tpebl' ) . '</div>';
											$output .= '<div class="tpae-content">' . esc_html__( 'Feels something missing? We`re open to hear your feedback, please share your ideas with us to shape your perfect addon.', 'tpebl' ) . '</div>';
											$output .= '<a href="' . esc_url( 'https://roadmap.theplusaddons.com/boards/feature-request' ) . '" class="hs-btn">' . esc_html__( 'REQUEST FEATURE', 'tpebl' ) . '</a>';
										$output     .= '</div>';
										$output     .= '<div class="tpae-help-box">';
											$output .= '<div class="tpae-title">' . esc_html__( 'Detailed Docs', 'tpebl' ) . '</div>';
											$output .= '<div class="tpae-content">' . esc_html__( 'Stuck somewhere? Follow our step-by-step detailed documentation to know everything about a Widgets. ', 'tpebl' ) . '</div>';
											$output .= '<a href="' . esc_url( 'https://theplusaddons.com/docs/' ) . '" class="hs-btn">' . esc_html__( 'READ DOCS', 'tpebl' ) . '</a>';
										$output     .= '</div>';
										$output     .= '<div class="tpae-help-box">';
											$output .= '<div class="tpae-title">' . esc_html__( 'Video Tutorials', 'tpebl' ) . '</div>';
											$output .= '<div class="tpae-content">' . esc_html__( 'Love watching videos? We create weekly in-depth video tutorials showing you the amazing possibilities of The Plus Addons for Elementor.', 'tpebl' ) . '</div>';
											$output .= '<a href="' . esc_url( 'https://www.youtube.com/@posimyth?sub_confirmation=1' ) . '" class="hs-btn">' . esc_html__( 'WATCH VIDEO', 'tpebl' ) . '</a>';
										$output     .= '</div>';
									$output         .= '</div>';
									$output         .= '</button>';
								$output             .= '</div>';
								$output             .= '<button class="slide-left" onclick="tp_plusPage(-1)">';
									$output         .= '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" fill="none"><path fill="#fff" d="M17 6.75a.75.75 0 1 0 0-1.5v1.5zM.47 5.47a.75.75 0 0 0 0 1.061l4.773 4.773a.75.75 0 0 0 1.061-1.061L2.061 6l4.243-4.243A.75.75 0 1 0 5.243.697L.47 5.47zM17 5.25H1v1.5h16v-1.5z"/></svg>';
								$output             .= '</button>';
							$output                 .= '</div>';
						$output                     .= '</div>';
						$output                     .= '<div class="tpae-slider-btns">';
							$output                 .= '<div class="tpae-slider-btn" onclick="tp_currentPage(1)"></div>';
							$output                 .= '<div class="tpae-slider-btn" onclick="tp_currentPage(2)"></div>';
							$output                 .= '<div class="tpae-slider-btn" onclick="tp_currentPage(3)"></div>';
							$output                 .= '<div class="tpae-slider-btn" onclick="tp_currentPage(4)"></div>';
							$output                 .= '<div class="tpae-slider-btn" onclick="tp_currentPage(5)"></div>';
						$output                     .= '</div>';
					$output                         .= '</section>';

					$output                         .= '<section class="tpae-on-boarding" data-step="5">';
						$output                     .= '<div class="tpae-onboarding-content">';
							$output                 .= '<div class="tpae-onboarding-details">';
								$output             .= '<div class="tpae-theme-details mt-15">';
									$output         .= '<div class="tpae-theme-left tpae-wd-45 mt-20">';
										$output     .= '<div class="left-title tpae-wd-80">' . esc_html__( 'Level Up with NexterWP Theme!', 'tpebl' ) . '</div>';
										$output     .= '<div class="left-redefine-text mt-10">' . esc_html__( 'WordPress Redefined', 'tpebl' ) . '<img class="star-img" src="' . esc_url( L_THEPLUS_ASSETS_URL . 'images/on-boarding/Star.png' ) . '" /></div>';
										$output     .= '<div class="left-content tpae-wd-85 mt-10">' . esc_html__( 'Using WordPress will never be the same, as Nexter Theme backs you with a Theme Builder, Fastest Performance & Better Security.', 'tpebl' ) . '</div>';
										$output     .= '<a class="theme-btn" href="https://nexterwp.com/" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Learn More', 'tpebl' ) . '</a>';
										$output     .= '<div class="tpae-nexter-content">';
											$output .= '<div class="tpae-nexter-text">' . esc_html__( 'Why use Nexter Theme?', 'tpebl' ) . '</div>';
											$output .= '<img class="nexter-vector" src="' . esc_url( L_THEPLUS_ASSETS_URL . 'images/on-boarding/rightvector.svg' ) . '" />';
										$output     .= '</div>';
										// $output     .= '<div class="tpae-bgwhite-details">
										// 					<input id="in-nexter" type="checkbox">' . esc_html__( 'Agree to install & activate', 'tpebl' ) . 
										// 					'<b>' . esc_html__( 'Nexter', 'tpebl' ) . 
										// 					'</b>' . esc_html__( 'Theme ', 'tpebl' ) . 
										// 					' <span>' . esc_html__( 'Recommended', 'tpebl' ) . 
										// 					'</span>';
										// 	$output     .= '<div class="tpae-nxt-load"><img decoding="async" src="' . esc_url( L_THEPLUS_ASSETS_URL . 'images/on-boarding/spinner.gif' ) . '" alt="spinner.gif"></div>';
										// $output     .= '</div>';
									$output         .= '</div>';
									$output         .= '<div class="tpae-theme-right tpae-wd-55">';
										$output     .= '<img class="full-img" src="' . esc_url( L_THEPLUS_ASSETS_URL . 'images/on-boarding/page5.png' ) . '" />';
										$output     .= '<a href="https://nexterwp.com/features/" target="_blank" rel="noopener noreferrer" class="feature-btn">' . esc_html__( 'Check All Features', 'tpebl' ) . '</a>';
									$output         .= '</div>';
								$output             .= '<div>';
							$output                 .= '</div>';
						$output                     .= '</div>';

						$output .= '<div class="tpae-wrong-msg-notice"></div>';
					$output     .= '</section>';

					$output                         .= '<section class="tpae-on-boarding" data-step="6">';
						$output                     .= '<div class="tpae-onboarding-content">';
							$output                 .= '<div class="tpae-onboarding-details">';
								$output             .= '<div class="tpae-theme-details tpae-hg-90 mt-45">';
									$output         .= '<div class="tpae-theme-left tpae-wd-45 mt-10">';
										$output     .= '<div class="left-title">' . esc_html__( 'Stay Updated!', 'tpebl' ) . '</div>';
										$output     .= '<div class="left-content tpae-wd-85 mt-10">' . esc_html__( 'Never miss whats happening in the World of WordPress, we send monthly emails with WordPress News, Product Updates, Speed & Security Tips, Special Offers and more', 'tpebl' ) . '</div>';
										$output     .= '<input id="tpae-onb-name" type="text" placeholder="' . esc_attr__( 'Name', 'tpebl' ) . '">';
										$output     .= '<input id="tpae-onb-email" type="text" placeholder="' . esc_attr__( 'Email', 'tpebl' ) . '">';
										$output     .= '<p class="tpae-input-note">' . esc_html__( 'Please enter your email correctly', 'tpebl' ) . '</p>';
										$output     .= '<div class="tpae-nospam-text mt-10">';
											$output .= '<svg class="nospam-img" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" xmlns:v="https://vecta.io/nano"><path d="M10.934 1.962L6.434.087C6.319.039 6.125 0 6.001 0s-.318.039-.433.087l-4.5 1.875c-.42.173-.694.583-.694 1.017C.375 9.028 4.809 12 5.998 12c1.2 0 5.627-3.005 5.627-9.021 0-.434-.274-.844-.691-1.017zM8.25 4.687a.56.56 0 0 1-.135.366l-2.25 2.625c-.157.185-.366.175-.427.175-.149 0-.292-.059-.398-.165L3.915 6.564c-.111-.088-.165-.234-.165-.398 0-.3.241-.562.563-.562a.56.56 0 0 1 .398.165l.696.696L7.261 4.3a.56.56 0 0 1 .428-.196c.431.021.562.41.562.583z" fill="#fff"/></svg>' . esc_html__( 'NO SPAM GUARANTEE', 'tpebl' );
										$output     .= '</div>';
										$output     .= '<button class="tpae-submit-btn">' . esc_html__( 'Submit', 'tpebl' ) . '</button>';
									$output         .= '</div>';
									$output         .= '<div class="tpae-theme-right tpae-wd-55">';
										$output     .= '<img class="gmail-img" src="' . esc_url( L_THEPLUS_ASSETS_URL . 'images/on-boarding/gmail.png' ) . '" />';
									$output         .= '</div>';
								$output             .= '<div>';
							$output                 .= '</div>';
						$output                     .= '</div>';
					$output                         .= '</section>';

					$output                         .= '<section class="tpae-on-boarding" data-step="7">';
						$output                     .= '<div class="tpae-onboarding-content">';
							$output                 .= '<div class="tpae-onboarding-details">';
								$output             .= '<div class="tpae-feature-details mt-45">';
									$output         .= '<div class="tpae-theme-left tpae-wd-50 jc-center">';
										$output     .= '<div class="tpae-feature-title">' . esc_html__( 'Limited Time FLASH DEAL!', 'tpebl' ) . '</div>';
										$output     .= '<div class="code-text mt-15">' . esc_html__( 'USE CODE ', 'tpebl' );
											$output .= '<span class="code"> <span class="offer-code">' . esc_html__( 'FIRSTTIME20', 'tpebl' ) . '</span><img class="code-img" src="' . esc_url( L_THEPLUS_ASSETS_URL . 'images/on-boarding/copycode.png' ) . '" /><span class="tpae-copy-icon"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="#ED4569" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/></svg></span></span>';
										$output     .= esc_html__( ' to get FLAT 20% OFF', 'tpebl' ) . '</div>';
										$output     .= '<div class="upgrade-content mt-15">';
											$output .= '<a class="upgrade-btn" href="https://theplusaddons.com/pricing/?utm_source=wpbackend&utm_medium=widgets&utm_campaign=links" target="_blank" rel="noopener noreferrer" >' . esc_html__( 'UPGRADE NOW ', 'tpebl' ) . '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8.667v4A1.333 1.333 0 0 1 10.667 14H3.333A1.333 1.333 0 0 1 2 12.667V5.333a1.33 1.33 0 0 1 .391-.943c.251-.25.589-.39.942-.39h4M10 2h4v4M6.667 9.333 14 2"/></svg></a>';
											$output .= '<a class="compare-text" href="https://theplusaddons.com/free-vs-pro/?utm_source=wpbackend&utm_medium=widgets&utm_campaign=links" target="_blank" rel="noopener noreferrer" >' . esc_html__( 'Compare FREE vs PRO', 'tpebl' ) . '<svg class="upgrade-img" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8.667v4A1.333 1.333 0 0 1 10.667 14H3.333A1.333 1.333 0 0 1 2 12.667V5.333a1.33 1.33 0 0 1 .391-.943c.251-.25.589-.39.942-.39h4M10 2h4v4M6.667 9.333 14 2"/></svg></a>';
										$output     .= '</div>';
										$output     .= '<div class="offer-text mt-15">';
											$output .= '<svg class="nospam-img" xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" xmlns:v="https://vecta.io/nano"><path d="M10.934 1.962L6.434.087C6.319.039 6.125 0 6.001 0s-.318.039-.433.087l-4.5 1.875c-.42.173-.694.583-.694 1.017C.375 9.028 4.809 12 5.998 12c1.2 0 5.627-3.005 5.627-9.021 0-.434-.274-.844-.691-1.017zM8.25 4.687a.56.56 0 0 1-.135.366l-2.25 2.625c-.157.185-.366.175-.427.175-.149 0-.292-.059-.398-.165L3.915 6.564c-.111-.088-.165-.234-.165-.398 0-.3.241-.562.563-.562a.56.56 0 0 1 .398.165l.696.696L7.261 4.3a.56.56 0 0 1 .428-.196c.431.021.562.41.562.583z" fill="#fff"/></svg>' . esc_html__( '60 DAYS MONEY-BACK GUARANTEE', 'tpebl' );
										$output     .= '</div>';
										$output     .= '<img class="tpae-offer-img" src="' . esc_url( L_THEPLUS_ASSETS_URL . 'images/on-boarding/offer-1.svg' ) . '" />';
									$output         .= '</div>';
									$output         .= '<div class="tpae-theme-right tpae-wd-50">';
										$output     .= '<img class="tpae-feature-img" src="' . esc_url( L_THEPLUS_ASSETS_URL . 'images/on-boarding/page7.png' ) . '" />';
									$output         .= '</div>';
								$output             .= '<div>';
							$output                 .= '</div>';
						$output                     .= '</div>';
					$output                         .= '</section>';

					$output                             .= '<section class="tpae-on-boarding" data-step="8">';
						$output                         .= '<div class="tpae-onboarding-content">';
							$output                     .= '<div class="tpae-onboarding-details">';
								$output                 .= '<div class="tpae-section-data mt-30">';
									$output             .= '<img class="tpae-img" src="' . esc_url( L_THEPLUS_ASSETS_URL . 'images/on-boarding/page8.png' ) . '" />';
									$output             .= '<div class="tpae-title mt-5"> ' . esc_html__( 'Congratulations All set!', 'tpebl' ) . '</div>';
									$output             .= '<div class="tpae-content tpae-wd-80 mt-10">' . esc_html__( 'We have configured The Plus Addons for Elementor based on your site requirements, where only necessary widgets are activated & rest are disabled.', 'tpebl' );
									$output             .= '</div>';
									$output             .= '<div class="tpae-check-content tpae-wd-70 blk-color mt-10"><input id="tpae_ondata" type="checkbox" checked><span>' . esc_html__( 'Agree to contribute to make The Plus Addons for Elementor better by sharing non-sensitive details. ', 'tpebl' ) . '<span class="tpae-show-details">' . esc_html__( ' See what details are shared ', 'tpebl' ) . '</span></span>';
										$output         .= '<div class="tpae-details">';
											$output     .= '<div class="tpae-details-inner">';
												$output .= '<span class="tpae-collect-txt">' . esc_html__( 'We collect :', 'tpebl' ) . '</span>';

												$output     .= '<ul class="tpae-details-list">';
													$output .= '<li>' . esc_html__( 'PHP Version', 'tpebl' ) . '</li>';
													$output .= '<li>' . esc_html__( 'Server Details', 'tpebl' ) . '</li>';
													$output .= '<li>' . esc_html__( 'WordPress Version', 'tpebl' ) . '</li>';
													$output .= '<li>' . esc_html__( 'Plugins & Theme Used', 'tpebl' ) . '</li>';
													$output .= '<li>' . esc_html__( 'No. of Plus Widgets Used', 'tpebl' ) . '</li>';
													$output .= '<li>' . esc_html__( 'Site Language', 'tpebl' ) . '</li>';
													$output .= '<li>' . esc_html__( 'Email', 'tpebl' ) . '</li>';
												$output     .= '</ul>';

												$output .= '<span class="tpae-collect-txt">' . esc_html__( 'The following details will help us serve you better, and will not be shared with any third-party or used to spam you in anyway.', 'tpebl' ) . '</span>';
											$output     .= '</div>';
										$output         .= '</div>';
									$output             .= '</div>';
								$output                 .= '</div>';
							$output                     .= '</div>';
						$output                         .= '</div>';
					$output                             .= '</section>';

					$output     .= '<div class="tpae-boarding-progress"></div>';
					$output     .= '<div class="tpae-onboarding-button">';
						$output .= '<div class="tpae-boarding-back">' . esc_html__( 'Back', 'tpebl' ) . '</div>';
						$output .= '<button class="tpae-boarding-proceed">' . esc_html__( 'Proceed', 'tpebl' ) . '</button>';
					$output     .= '</div>';
				$output         .= '</div>';
			$output             .= '</div>';

			echo $output;
		}

		/**
		 * On Boarding Data
		 *
		 * @since 2.0.9
		 * @var cuton_data
		 * @var load
		 */
		public function tpae_boarding_store() {

			check_ajax_referer( 'tpae_onboarding_nonce', 'security' );

			$tponb_data = ! empty( $_POST['boardingData'] ) ? $_POST['boardingData'] : array();
			$user_data  = array();
			$load = '';

			if ( isset( $tponb_data ) && ! empty( $tponb_data ) ) {

				$user_data['website_complexity'] = ( isset( $tponb_data['tpae_web_com'] ) ) ? $tponb_data['tpae_web_com'] : '';
				$user_data['website_type']       = ( isset( $tponb_data['tpae_web_Type'] ) ) ? $tponb_data['tpae_web_Type'] : '';

				unset( $tponb_data['tpae_web_com'] );
				unset( $tponb_data['tpae_web_Type'] );

				if ( isset( $tponb_data['tpae_get_data'] ) && 'true' === $tponb_data['tpae_get_data'] ) {
					$s_e_r_v_e_r_s_o_f_t_w_a_r_e = ! empty( $_SERVER['SERVER_SOFTWARE'] ) ? sanitize_text_field( wp_unslash( $_SERVER['SERVER_SOFTWARE'] ) ) : '';

					$user_data['web_server'] = $s_e_r_v_e_r_s_o_f_t_w_a_r_e;

					// Memory Limit.
					$user_data['memory_limit'] = ini_get( 'memory_limit' );

					// Memory Limit.
					$user_data['max_execution_time'] = ini_get( 'max_execution_time' );

					// Php Version.
					$user_data['php_version'] = phpversion();

					// WordPress Version.
					$user_data['wp_version'] = get_bloginfo( 'version' );

					// Active Theme.
					$acthemeobj = wp_get_theme();
					if ( $acthemeobj->get( 'Name' ) !== null && ! empty( $acthemeobj->get( 'Name' ) ) ) {
						$user_data['theme'] = $acthemeobj->get( 'Name' );
					}

					// Active Plugin Name.
					$act_plugin = array();
					$actplu     = get_option( 'active_plugins' );
					if ( ! function_exists( 'get_plugins' ) ) {
						require_once ABSPATH . 'wp-admin/includes/plugin.php';
					}
					$plugins = get_plugins();
					foreach ( $actplu as $p ) {
						if ( isset( $plugins[ $p ] ) ) {
							$act_plugin[] = $plugins[ $p ]['Name'];
						}
					}
					$user_data['plugin'] = wp_json_encode( $act_plugin );

					// No Of TPAE Block Used.
					$get_widgets_list = get_option( 'theplus_options' );
					$check_elements   = ! empty( $get_widgets_list['check_elements'] ) ? $get_widgets_list['check_elements'] : array();
					if ( ! empty( $get_widgets_list ) && ! empty( $check_elements ) ) {
						$user_data['no_block']    = count( $check_elements );
						$user_data['used_blocks'] = wp_json_encode( $check_elements );
					} else {
						$user_data['no_block']    = 0;
						$user_data['used_blocks'] = array();
					}

					// User Email.
					$user_data['email'] = get_option( 'admin_email' );

					// Site Url.
					$user_data['site_url'] = get_option( 'siteurl' );

					// Site Url.
					$user_data['site_language'] = get_bloginfo( 'language' );

					$response = wp_remote_post(
						$this->onbording_api,
						array(
							'method' => 'POST',
							'body'   => wp_json_encode( $user_data ),
						)
					);

					if ( is_wp_error( $response ) ) {
						wp_send_json( array( 'onBoarding' => false ) );
					} else {
						$status_one = wp_remote_retrieve_response_code( $response );
						if ( 200 === $status_one ) {
							$get_data_one = wp_remote_retrieve_body( $response );
							$get_data_one = (array) json_decode( json_decode( $get_data_one, true ) );

							if ( isset( $get_data_one['success'] ) && ! empty( $get_data_one['success'] ) ) {
								$tpae_exoption = get_option( 'tpae_onbording_end' );

								if ( ! empty( $tpae_exoption ) ) {
									update_option( 'tpae_onbording_end', true );
								} else {
									$tpae_exoption['tpgb_share_details'] = 'enable';
									add_option( 'tpae_onbording_end', true );
								}

								if ( 'normal' === $load ) {
									wp_send_json( array( 'onBoarding' => true ) );

									wp_die();
								} else {
									wp_send_json( array( 'onBoarding' => true ) );
									wp_die();
								}
							}
						}
					}
				}
			}

			wp_send_json( array( 'onBoarding' => false ) );
			wp_die();
		}

		/**
		 * OnBoarding Install Nexter Theme
		 *
		 * @since 2.0.9
		 */
		public function tpae_install_nexter() {

			check_ajax_referer( 'tpae_onboarding_nonce', 'security' );

			if ( ! current_user_can( 'manage_options' ) ) {
				wp_send_json_error( __( 'You are not allowed to do this action', 'tpebl' ) );
			}

			$theme_slug    = 'nexter';
			$theme_api_url = 'https://api.wordpress.org/themes/info/1.0/';

			// Parameters for the request.
			$args = array(
				'body' => array(
					'action'  => 'theme_information',
					'request' => serialize(
						(object) array(
							'slug'   => 'nexter',
							'fields' => array(
								'description'     => false,
								'sections'        => false,
								'rating'          => true,
								'ratings'         => false,
								'downloaded'      => true,
								'download_link'   => true,
								'last_updated'    => true,
								'homepage'        => true,
								'tags'            => true,
								'template'        => true,
								'active_installs' => false,
								'parent'          => false,
								'versions'        => false,
								'screenshot_url'  => true,
							),
						)
					),
				),
			);

			// Make the request.
			$response = wp_remote_post( $theme_api_url, $args );

			// Check for errors.
			if ( is_wp_error( $response ) ) {
				$error_message = $response->get_error_message();

				wp_send_json(
					array(
						'nexter'  => false,
						'message' => 'Something went wrong : ' . $error_message . '',
					)
				);
			} else {
				$theme_info    = unserialize( $response['body'] );
				$theme_name    = $theme_info->name;
				$theme_zip_url = $theme_info->download_link;
				global $wp_filesystem;
				// Install the theme.
				$theme = wp_remote_get( $theme_zip_url );
				if ( ! function_exists( 'WP_Filesystem' ) ) {
					require_once wp_normalize_path( ABSPATH . '/wp-admin/includes/file.php' );
				}

				WP_Filesystem();

				$active_theme = wp_get_theme();
				$theme_name   = $active_theme->get( 'Name' );
				if ( isset( $theme_name ) && ! empty( $theme_name ) && 'Nexter' === $theme_name ) {
					wp_send_json(
						array(
							'nexter'  => true,
							'message' => 'Nexter Already installed',
						)
					);
				} elseif ( file_exists( WP_CONTENT_DIR . '/themes/' . $theme_slug ) && 'Nexter' !== $theme_name ) {

					switch_theme( $theme_slug );
					wp_send_json(
						array(
							'nexter'  => true,
							'message' => 'Nexter Activated successfully!',
						)
					);
				} else {

					$wp_filesystem->put_contents( WP_CONTENT_DIR . '/themes/' . $theme_slug . '.zip', $theme['body'] );
					$zip = new \ZipArchive();
					if ( $zip->open( WP_CONTENT_DIR . '/themes/' . $theme_slug . '.zip' ) === true ) {

						$zip->extractTo( WP_CONTENT_DIR . '/themes/' );
						$zip->close();
					}
					$wp_filesystem->delete( WP_CONTENT_DIR . '/themes/' . $theme_slug . '.zip' );
					switch_theme( $theme_slug );

					wp_send_json(
						array(
							'nexter'  => true,
							'message' => 'Nexter installed and activated successfully!',
						)
					);
				}
			}

			wp_die();
		}

		/**
		 * On Boarding Data
		 *
		 * @since 2.0.9
		 * @var cuton_data
		 * @var load
		 */
		public function tpae_onbording_close() {

			check_ajax_referer( 'tpae_onboarding_nonce', 'security' );

			$tpae_exoption = get_option( 'tpae_onbording_end' );

			if ( ! empty( $tpae_exoption ) ) {
				update_option( 'tpae_onbording_end', true );
			} else {
				add_option( 'tpae_onbording_end', true );
			}

			$result = array(
				'onBoarding' => true,
			);

			wp_send_json( $result );
			wp_die();
		}
	}

	Tp_Onbording::instance();
}
