<?php
/**
 * Widget Name: Countdown
 * Description: Display countdown.
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @since   6.0.0
 * @package ThePlus
 */

/**Exit if accessed directly.*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Tpae_Testimonial_Options' ) ) {

	/**
	 * Tpae_Testimonial_Options
	 *
	 * @since 6.0.0
	 */
	class Tpae_Testimonial_Options {

		/**
		 * Member Variable
		 *
		 * @var instance
		 */
		private static $instance;

		/**
		 *  Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Define the core functionality of the plugin.
		 *
		 * @since 6.0.0
		 */
		public function __construct() {
			add_action( 'add_meta_boxes', array( $this, 'add_testimonial_meta_box' ) );
			add_action( 'save_post', array( $this, 'save_testimonial_meta_data' ) );
		}

		/**
		 * Set Testimonial post name
		 *
		 * @since 6.0.0
		 */
		public function l_theplus_testimonial_post_name() {
			$post_name = apply_filters( 'tpae_get_post_type', 'post_type', 'testimonial_plugin_name' );
			if ( isset( $post_name ) && ! empty( $post_name ) ) {
				$post_name = apply_filters( 'tpae_get_post_type', 'post_type', 'testimonial_plugin_name' );
			} else {
				$post_name = 'theplus_testimonial';
			}

			return $post_name;
		}

		/**
		 * Set Testimonial meta box
		 *
		 * @since 6.0.0
		 */
		public function add_testimonial_meta_box() {
			$post_type = $this->l_theplus_testimonial_post_name();

			add_meta_box(
				'tpae_testimonial_options',
				esc_html__( 'ThePlus Testimonial Options', 'tpebl' ),
				array( $this, 'render_testimonial_meta_box' ),
				$post_type,
				'normal',
				'high'
			);
		}

		/**
		 * Render Testimonial meta box
		 *
		 * @since 6.0.0
		 */
		public function render_testimonial_meta_box( $post ) {
			wp_nonce_field( 'tpae_save_testimonial_meta_box', 'tpae_testimonial_nonce' );

			$prefix      = 'theplus_testimonial_';
			$author_text = get_post_meta( $post->ID, $prefix . 'author_text', true );
			$title       = get_post_meta( $post->ID, $prefix . 'title', true );
			$logo        = get_post_meta( $post->ID, $prefix . 'logo', true );
			$designation = get_post_meta( $post->ID, $prefix . 'designation', true );

			?>

			<style>
				#tpae_testimonial_options .tpae_testimonialopt_main{
					display: flex;
					padding: 10px;
				}
				.tpae_testimonialopt_main .tpae_testimonialopt_wrap{
					width: 100%;
					display: flex;
					flex-direction: column;
					padding: 15px 7px;
					gap: 15px;
				}
				.tpae_testimonialopt_wrap > .tpae_testimonial_field {
					width: 100%;
					display: flex;
					border-bottom: 1px solid #e9e9e9;
					padding: 15px 7px;
				}
				.tpae_testimonial_field > label {
					width: 15%;
					display: flex;
					align-items: center;
					font-size: 14px;
					font-weight: 500;
				}
				.tpae_testimonial_field > .wp-editor-wrap {
					width: 80%;
				}
				.tpae_testimonial_field > button.button {
					margin-left: 25px;
				}
			</style>
			<div class="tpae_testimonialopt_main">	
				<div class="tpae_testimonialopt_wrap">
					<div class="tpae_testimonial_field">
						<label for="author_text"><?php echo esc_html__( 'Author Text:', 'tpebl' ); ?></label>
						<?php
							$settings = array(
								'media_buttons' => false,
								'textarea_rows' => 7,
							);
							wp_editor( $author_text, 'theplus_testimonial_author_text', $settings );
							?>
					</div>
					<div class="tpae_testimonial_field">
						<label for="title"><?php echo esc_html__( 'Title:', 'tpebl' ); ?></label>
						<input type="text" id="title" name="theplus_testimonial_title" value="<?php echo esc_attr( $title ); ?>" style="width:50%;" />
						</div>
					<div class="tpae_testimonial_field">
						<label for="logo"><?php echo esc_html__( 'Logo Upload:', 'tpebl' ); ?></label>
						<input type="text" id="logo" name="theplus_testimonial_logo" value="<?php echo esc_url( $logo ); ?>" style="width:60%;" />
						<button type="button" class="button upload_logo_button"><?php echo esc_html__( 'Upload Logo', 'tpebl' ); ?></button>
						</div>
					<div class="tpae_testimonial_field">
						<label for="designation"><?php echo esc_html__( 'Designation:', 'tpebl' ); ?></label>
						<input type="text" id="designation" name="theplus_testimonial_designation" value="<?php echo esc_attr( $designation ); ?>" style="width:50%;" />
					</div>
				</div>
			</div>
			
			<script>
				jQuery(document).ready(function($){
					$('.upload_logo_button').click(function(e) {
						e.preventDefault();
						var image = wp.media({
							title: '<?php echo esc_html__( 'Upload Logo', 'tpebl' ); ?>',
							multiple: false
						}).open()
						.on('select', function(e){
							var uploaded_image = image.state().get('selection').first();
							var image_url = uploaded_image.toJSON().url;
							$('#logo').val(image_url);
						});
					});
				});
			</script>
			<?php
		}

		/**
		 * Save Testimonial meta data
		 *
		 * @since 6.0.0
		 */
		public function save_testimonial_meta_data( $post_id ) {
			if ( ! isset( $_POST['tpae_testimonial_nonce'] ) || ! wp_verify_nonce( $_POST['tpae_testimonial_nonce'], 'tpae_save_testimonial_meta_box' ) ) {
				return;
			}

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}

			$fields = array(
				'author_text',
				'title',
				'logo',
				'designation',
			);
			$prefix = 'theplus_testimonial_';

			foreach ( $fields as $field ) {
				if ( isset( $_POST[ $prefix . $field ] ) ) {
					$value = ( 'author_text' === $field ) ? wp_kses_post( $_POST[ $prefix . $field ] ) : sanitize_text_field( $_POST[ $prefix . $field ] );
					update_post_meta( $post_id, $prefix . $field, $value );
				}
			}
		}
	}

	Tpae_Testimonial_Options::get_instance();
}
