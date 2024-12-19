<?php
/**
 * Instagram Feed block with live preview.
 *
 * @since 2.3/5.4
 */

use InstagramFeed\Helpers\Util;
use InstagramFeed\Builder\SBI_Db;
use InstagramFeed\Builder\SBI_Feed_Builder;
use InstagramFeed\Admin\SBI_Admin_Notices;

class SB_Instagram_Blocks {

	/**
	 * Indicates if current integration is allowed to load.
	 *
	 * @since 1.8
	 *
	 * @return bool
	 */
	public function allow_load() {
		return function_exists( 'register_block_type' );
	}

	/**
	 * Loads an integration.
	 *
	 * @since 2.3/5.4
	 */
	public function load() {
		$this->hooks();
	}

	/**
	 * Integration hooks.
	 *
	 * @since 2.3/5.4
	 */
	protected function hooks() {
		add_action( 'init', array( $this, 'register_block' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_block_editor_assets' ) );
	}

	/**
	 * Register Instagram Feed Gutenberg block on the backend.
	 *
	 * @since 2.3/5.4
	 */
	public function register_block() {

		wp_register_style(
			'sbi-blocks-styles',
			trailingslashit( SBI_PLUGIN_URL ) . 'css/sb-blocks.css',
			array( 'wp-edit-blocks' ),
			SBIVER
		);

		$attributes = array(
			'shortcodeSettings' => array(
				'type' => 'string',
			),
			'noNewChanges'      => array(
				'type' => 'boolean',
			),
			'executed'          => array(
				'type' => 'boolean',
			),
		);

		register_block_type(
			'sbi/sbi-feed-block',
			array(
				'attributes'      => $attributes,
				'render_callback' => array( $this, 'get_feed_html' ),
			)
		);
	}

	/**
	 * Load Instagram Feed Gutenberg block scripts.
	 *
	 * @since 2.3/5.4
	 */
	public function enqueue_block_editor_assets() {
		sb_instagram_scripts_enqueue( true );

		wp_enqueue_style( 'sbi-blocks-styles' );
		wp_enqueue_script(
			'sbi-feed-block',
			trailingslashit( SBI_PLUGIN_URL ) . 'js/sb-blocks.js',
			array( 'wp-blocks', 'wp-i18n', 'wp-element' ),
			SBIVER,
			true
		);

		$shortcode_settings = '';

		$i18n = array(
			'addSettings'       => esc_html__( 'Add Settings', 'instagram-feed' ),
			'shortcodeSettings' => esc_html__( 'Shortcode Settings', 'instagram-feed' ),
			'example'           => esc_html__( 'Example', 'instagram-feed' ),
			'preview'           => esc_html__( 'Apply Changes', 'instagram-feed' ),

		);

		if ( ! empty( $_GET['sbi_wizard'] ) ) {
			$shortcode_settings = 'feed="' . (int) $_GET['sbi_wizard'] . '"';
		}

		wp_localize_script(
			'sbi-feed-block',
			'sbi_block_editor',
			array(
				'wpnonce'           => wp_create_nonce( 'sb-instagram-blocks' ),
				'configureLink'     => get_admin_url() . '?page=sb-instagram-feed',
				'shortcodeSettings' => $shortcode_settings,
				'i18n'              => $i18n,
			)
		);
	}

	/**
	 * Get form HTML to display in a Instagram Feed Gutenberg block.
	 *
	 * @param array $attr Attributes passed by Instagram Feed Gutenberg block.
	 *
	 * @since 2.3/5.4
	 *
	 * @return string
	 */
	public function get_feed_html( $attr ) {
		$feeds_count = SBI_Db::feeds_count();
		$shortcode_settings = isset( $attr['shortcodeSettings'] ) ? $attr['shortcodeSettings'] : '';
		
		if ( $feeds_count <= 0 ) {
			$sbi_license_status = get_option( 'sbi_license_status' );
			$license_expired = sbi_builder_pro()->license_service->is_license_expired;
			$license_status = $license_expired ? 'expired' : ( $sbi_license_status ? $sbi_license_status : 'inactive' );
			return $this->plain_block_design( $license_status );
		}

		$return = '';
		$return .= $this->get_license_expired_notice();

		$shortcode_settings = isset( $attr['shortcodeSettings'] ) ? $attr['shortcodeSettings'] : '';
		$sbi_statuses       = get_option( 'sbi_statuses', array() );

		if ( empty( $sbi_statuses['support_legacy_shortcode'] ) ) {
			if ( empty( $shortcode_settings ) || strpos( $shortcode_settings, 'feed=' ) === false ) {
				$feeds = \InstagramFeed\Builder\SBI_Feed_Builder::get_feed_list();
				if ( ! empty( $feeds[0]['id'] ) ) {
					$shortcode_settings = 'feed="' . (int) $feeds[0]['id'] . '"';
				}
			}
		}
		$shortcode_settings = str_replace( array( '[instagram-feed', ']' ), '', $shortcode_settings );

		$return .= do_shortcode( '[instagram-feed ' . $shortcode_settings . ']' );

		return $return;

	}

	public function get_license_expired_notice() {
		// Check that the license exists and the user hasn't already clicked to ignore the message
		if ( empty( sbi_builder_pro()->license_service->get_license_key ) ) {
			return $this->get_license_expired_notice_content( 'inactive' );
		}
		// If license not expired then return;
		if ( !sbi_builder_pro()->license_service->is_license_expired ) {
			return;
		}
		// Grace period ended?
		if ( ! sbi_builder_pro()->license_service->is_license_grace_period_ended( true ) ) {
			return;
		}
		
		return $this->get_license_expired_notice_content();
	}

	/**
	 * Output the license expired notice content on top of the embed block 
	 * 
	 * @since 6.2.0
	 */
	public function get_license_expired_notice_content( $license_state = 'expired' ) {
		if ( !is_admin() && !defined( 'REST_REQUEST' ) ) {
			return;
		}

		$icons = SBI_Feed_Builder::builder_svg_icons();

		$output = '<div class="sbi-block-license-expired-notice-ctn sbi-bln-license-state-'. $license_state .'">';
			$output .= '<div class="sbi-blen-header">';
				$output .= $icons['eye2'];
				$output .= '<span>' . __('Only Visible to WordPress Admins', 'instagram-feed') . '</span>';
			$output .= '</div>';
			$output .= '<div class="sbi-blen-resolve">';
				$output .= '<div class="sbi-left">';
					$output .= $icons['info'];
					if ( $license_state == 'inactive' ) {
						$output .= '<span>' . __('Your license key is inactive. Activate it to enable Pro features.', 'instagram-feed') . '</span>';
					} else {
						$output .= '<span>' . __('Your license has expired! Renew it to reactivate Pro features.', 'instagram-feed') . '</span>';
					}
				$output .= '</div>';
				$output .= '<div class="sbi-right">';
					$output .= '<a href="'. SBI_Admin_Notices::get_renew_url( $license_state ) .'" target="_blank">'. __('Resolve Now', 'instagram-feed') .'</a>';
					$output .= $icons['chevronRight'];
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';

		return $output;
	}

	/**
	 * Plain block design when theres no feeds.
	 * 
	 * @since 6.2.0
	 */
	public function plain_block_design( $license_state = 'expired' ) {
		if ( !is_admin() && !defined( 'REST_REQUEST' ) ) {
			return;
		}
		$other_plugins = $this->get_others_plugins();
		$icons = SBI_Feed_Builder::builder_svg_icons();
		$output = '<div class="sbi-license-expired-plain-block-wrapper '. $license_state .'">';

		if( $license_state == 'expired' || $license_state == 'inactive' ) {
			$output .= '<div class="sbi-lepb-header">
					<div class="sb-left">';
			$output .= $icons['info'];

			if ( $license_state == 'expired' ) {
				$output .= sprintf('<p>%s</p>', __('Your license has expired! Renew it to reactivate Pro features.', 'instagram-feed'));
			} elseif ( $license_state == 'inactive' ) {
				$output .= sprintf('<p>%s</p>', __('Your license key is inactive. Activate it to enable Pro features.', 'instagram-feed'));
			}

			$output .= '</div>
				<div class="sb-right">
					<a href="'. SBI_Admin_Notices::get_renew_url( $license_state ) .'">
						Resolve Now
						'. $icons['chevronRight'] .'
					</a>
				</div>
			</div>';
		}
		
		$output .= '<div class="sbi-lepb-body">
				'. $icons['blockEditorSBILogo'] .'
				<p class="sbi-block-body-title">Get started with your first feed from <br/> your Instagram profile</p>';
		
		$output .= sprintf(
					'<a href="%s" class="sbi-btn sbi-btn-blue">%s '. $icons['chevronRight'] .'</a>', 
					admin_url('admin.php?page=sbi-feed-builder'), 
					__('Create a Instagram Feed', SBI_TEXT_DOMAIN)
				);
		$output .= '</div>
			<div class="sbi-lepd-footer">
				<p class="sbi-lepd-footer-title">Did you know? </p>
				<p>You can add posts from '. $other_plugins .' using our free plugins</p>
			</div>
		</div>';

		return $output;
	}

	/**
	 * Get other Smash Balloon plugins list
	 * 
	 * @since 6.2.0
	 */
	public function get_others_plugins() {
		$active_plugins = Util::get_sb_active_plugins_info();

		$other_plugins = array(
			'is_instagram_installed' => array(
				'title' => 'Instagram',
				'url'	=> 'https://smashballoon.com/instagram-feed/?utm_campaign=youtube-pro&utm_source=block-feed-embed&utm_medium=did-you-know',
			),
			'is_facebook_installed' => array(
				'title' => 'Facebook',
				'url'	=> 'https://smashballoon.com/custom-facebook-feed/?utm_campaign=youtube-pro&utm_source=block-feed-embed&utm_medium=did-you-know',
			),
			'is_twitter_installed' => array(
				'title' => 'Twitter',
				'url'	=> 'https://smashballoon.com/custom-twitter-feeds/?utm_campaign=youtube-pro&utm_source=block-feed-embed&utm_medium=did-you-know',
			),
			'is_youtube_installed' => array(
				'title' => 'YouTube',
				'url'	=> 'https://smashballoon.com/youtube-feed/?utm_campaign=youtube-pro&utm_source=block-feed-embed&utm_medium=did-you-know',
			),
		);

		if ( ! empty( $active_plugins ) ) {
			foreach ( $active_plugins as $name => $plugin ) {
				if ( $plugin != false ) {
					unset( $other_plugins[$name] );
				}
			}
		}

		$other_plugins_html = array();
		foreach( $other_plugins as $plugin ) {
			$other_plugins_html[] = '<a href="'. $plugin['url'] .'">'. $plugin['title'] .'</a>';
		}
		
		return \implode(", ", $other_plugins_html);
	}

	/**
	 * Checking if is Gutenberg REST API call.
	 *
	 * @since 2.3/5.4
	 *
	 * @return bool True if is Gutenberg REST API call.
	 */
	public static function is_gb_editor() {

		// TODO: Find a better way to check if is GB editor API call.
		return defined( 'REST_REQUEST' ) && REST_REQUEST && ! empty( $_REQUEST['context'] ) && 'edit' === $_REQUEST['context']; // phpcs:ignore
	}

}
