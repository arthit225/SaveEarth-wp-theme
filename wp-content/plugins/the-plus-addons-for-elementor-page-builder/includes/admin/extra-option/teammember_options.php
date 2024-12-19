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

if ( ! class_exists( 'Tpae_Teammember_Options' ) ) {

	/**
	 * Tpae_Teammember_Options
	 *
	 * @since 6.0.0
	 */
	class Tpae_Teammember_Options {

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
			add_action( 'add_meta_boxes', array( $this, 'add_team_member_meta_box' ) );
			add_action( 'save_post', array( $this, 'save_team_member_meta_data' ) );
		}

		/**
		 * Set TeamMember post name
		 *
		 * @since 6.0.0
		 */
		public function l_theplus_team_member_post_name() {
			$post_name = apply_filters( 'tpae_get_post_type', 'post_type', 'team_member_plugin_name' );
			if ( isset( $post_name ) && ! empty( $post_name ) ) {
				$post_name = apply_filters( 'tpae_get_post_type', 'post_type', 'team_member_plugin_name' );
			} else {
				$post_name = 'theplus_team_member';
			}

			return $post_name;
		}

		/**
		 * Set TeamMember meta box
		 *
		 * @since 6.0.0
		 */
		public function add_team_member_meta_box() {
			$post_type = $this->l_theplus_team_member_post_name();

			add_meta_box(
				'tpae_team_member_options',
				__( 'TP Team Member Options', 'tpebl' ),
				array( $this, 'render_team_member_meta_box' ),
				$post_type,
				'normal',
				'high'
			);
		}

		/**
		 * Render TeamMember meta box
		 *
		 * @since 6.0.0
		 */
		public function render_team_member_meta_box( $post ) {
			wp_nonce_field( 'tpaep_save_team_member_meta_box', 'tpaep_team_member_nonce' );

			$prefix         = 'theplus_tm_';
			$custom_url     = get_post_meta( $post->ID, $prefix . 'custom_url', true );
			$designation    = get_post_meta( $post->ID, $prefix . 'designation', true );
			$website_url    = get_post_meta( $post->ID, $prefix . 'website_url', true );
			$facebook_link  = get_post_meta( $post->ID, $prefix . 'face_link', true );
			$google_link    = get_post_meta( $post->ID, $prefix . 'googgle_link', true );
			$instagram_link = get_post_meta( $post->ID, $prefix . 'insta_link', true );
			$twitter_link   = get_post_meta( $post->ID, $prefix . 'twit_link', true );
			$linkedin_link  = get_post_meta( $post->ID, $prefix . 'linked_link', true );
			$email          = get_post_meta( $post->ID, $prefix . 'email_link', true );
			$phone          = get_post_meta( $post->ID, $prefix . 'phone_link', true );

			?>

			<style>
				#tpae_team_member_options .tpae_team_member_main{
					display: flex;
					padding: 10px;
				}
				.tpae_team_member_main .tpae_team_member_wrap{
					width: 100%;
					display: flex;
					flex-direction: column;
					padding: 15px 7px;
					gap: 15px;
				}
				.tpae_team_member_wrap > .tpae_team_member_field {
					width: 100%;
					display: flex;
					border-bottom: 1px solid #e9e9e9;
					padding: 15px 7px;
				}
				.tpae_team_member_field > label {
					width: 15%;
					display: flex;
					align-items: center;
					font-size: 14px;
					font-weight: 500;
				}
				.tpae_team_member_field > input {
					width: 60%;
				}
				.tpae_team_member_field > button.button {
					margin-left: 25px;
				}
			</style>

			<div class="tpae_team_member_main">	
				<div class="tpae_team_member_wrap">
					<div class="tpae_team_member_field">
						<label for="custom_url"><?php echo esc_html__( 'Custom URL:', 'tpebl' ); ?></label>
						<input type="url" id="custom_url" name="theplus_tm_custom_url" value="<?php echo esc_url( $custom_url ); ?>" />
					</div>
					<div class="tpae_team_member_field">
						<label for="designation"><?php echo esc_html__( 'Designation:', 'tpebl' ); ?></label>
						<input type="text" id="designation" name="theplus_tm_designation" value="<?php echo esc_attr( $designation ); ?>" />
					</div>
					<div class="tpae_team_member_field">
						<label for="website_url"><?php echo esc_html__( 'Website URL:', 'tpebl' ); ?></label>
						<input type="url" id="website_url" name="theplus_tm_website_url" value="<?php echo esc_url( $website_url ); ?>" />
					</div>
					<div class="tpae_team_member_field">
						<label for="facebook_link"><?php echo esc_html__( 'Facebook Link:', 'tpebl' ); ?></label>
						<input type="url" id="facebook_link" name="theplus_tm_face_link" value="<?php echo esc_url( $facebook_link ); ?>" />
					</div>
					<div class="tpae_team_member_field">
						<label for="google_link"><?php echo esc_html__( 'Google Plus Link:', 'tpebl' ); ?></label>
						<input type="url" id="google_link" name="theplus_tm_googgle_link" value="<?php echo esc_url( $google_link ); ?>" />
					</div>
					<div class="tpae_team_member_field">
						<label for="instagram_link"><?php echo esc_html__( 'Instagram Link:', 'tpebl' ); ?></label>
						<input type="url" id="instagram_link" name="theplus_tm_insta_link" value="<?php echo esc_url( $instagram_link ); ?>" />
					</div>
					<div class="tpae_team_member_field">
						<label for="twitter_link"><?php echo esc_html__( 'Twitter Link:', 'tpebl' ); ?></label>
						<input type="url" id="twitter_link" name="theplus_tm_twit_link" value="<?php echo esc_url( $twitter_link ); ?>" />
					</div>
					<div class="tpae_team_member_field">
						<label for="linkedin_link"><?php echo esc_html__( 'LinkedIn Link:', 'tpebl' ); ?></label>
						<input type="url" id="linkedin_link" name="theplus_tm_linked_link" value="<?php echo esc_url( $linkedin_link ); ?>" />
					</div>
					<div class="tpae_team_member_field">
						<label for="email"><?php echo esc_html__( 'Email:', 'tpebl' ); ?></label>
						<input type="email" id="email" name="theplus_tm_email_link" value="<?php echo esc_attr( $email ); ?>" />
					</div>
					<div class="tpae_team_member_field">
						<label for="phone"><?php echo esc_html__( 'Phone:', 'tpebl' ); ?></label>
						<input type="tel" id="phone" name="theplus_tm_phone_link" value="<?php echo esc_attr( $phone ); ?>" />
					</div>
				</div>
			</div>
			<?php
		}

		/**
		 * Save TeamMember meta data
		 *
		 * @since 6.0.0
		 */
		public function save_team_member_meta_data( $post_id ) {
			if ( ! isset( $_POST['tpaep_team_member_nonce'] ) || ! wp_verify_nonce( $_POST['tpaep_team_member_nonce'], 'tpaep_save_team_member_meta_box' ) ) {
				return;
			}

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}

			$fields = array(
				'custom_url',
				'designation',
				'website_url',
				'face_link',
				'googgle_link',
				'insta_link',
				'twit_link',
				'linked_link',
				'email_link',
				'phone_link',
			);
			$prefix = 'theplus_tm_';

			foreach ( $fields as $field ) {
				if ( isset( $_POST[ $prefix . $field ] ) ) {
					update_post_meta( $post_id, $prefix . $field, sanitize_text_field( $_POST[ $prefix . $field ] ) );
				}
			}
		}
	}

	Tpae_Teammember_Options::get_instance();
}
