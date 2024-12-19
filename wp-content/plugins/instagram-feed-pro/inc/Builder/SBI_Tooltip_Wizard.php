<?php
/**
 * SBI Tooltip Wizard
 *
 *
 * @since 6.0
 */
namespace InstagramFeed\Builder;

class SBI_Tooltip_Wizard {

	/**
	 * Constructor.
	 *
	 * @since 6.0
	 */
	public function __construct() {
		$this->init();
	}


	/**
	 * Initialize class.
	 *
	 * @since 6.0
	 */
	public function init() {
		$this->hooks();
	}

	/**
	 * Register hooks.
	 *
	 * @since 6.0
	 */
	public function hooks() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueues' ) );
		add_action( 'admin_footer', array( $this, 'output' ) );
	}


	/**
	 * Enqueue assets.
	 *
	 * @since 6.0
	 */
	public function enqueues() {

		wp_enqueue_style(
			'sbi_tooltipster',
			SBI_PLUGIN_URL . 'admin/builder/assets/css/tooltipster.css',
			null,
			SBIVER
		);

		wp_enqueue_script(
			'sbi_tooltipster',
			SBI_PLUGIN_URL . 'admin/builder/assets/js/jquery.tooltipster.min.js',
			array( 'jquery' ),
			SBIVER,
			true
		);

		wp_enqueue_script(
			'sbi-admin-tooltip-wizard',
			SBI_PLUGIN_URL . 'admin/builder/assets/js/tooltip-wizard.js',
			array( 'jquery' ),
			SBIVER,
			true
		);

		$wp_localize_data = array();
		if ( $this->check_gutenberg_wizard() ) {
			$wp_localize_data['sbi_wizard_gutenberg'] = true;
		}

		wp_localize_script(
			'sbi-admin-tooltip-wizard',
			'sbi_admin_tooltip_wizard',
			$wp_localize_data
		);
	}

	/**
	 * Output HTML.
	 *
	 * @since 6.0
	 */
	public function output() {
		if ( $this->check_gutenberg_wizard() ) {
			$this->gutenberg_tooltip_output();
		}

	}

	/**
	 * Gutenberg Tooltip Output HTML.
	 *
	 * @since 6.0
	 */
	public function check_gutenberg_wizard() {
		global $pagenow;
		return ( ( $pagenow === 'post.php' ) || ( get_post_type() === 'page' ) )
				&& ! empty( $_GET['sbi_wizard'] );
	}


	/**
	 * Gutenberg Tooltip Output HTML.
	 *
	 * @since 6.0
	 */
	public function gutenberg_tooltip_output() {
		?>
		<div id="sbi-gutenberg-tooltip-content">
			<div class="sbi-tlp-wizard-cls sbi-tlp-wizard-close"></div>
			<div class="sbi-tlp-wizard-content">
				<strong class="sbi-tooltip-wizard-head"><?php esc_html_e( 'Add a Block', 'instagram-feed' ); ?></strong>
				<p class="sbi-tooltip-wizard-txt"><?php esc_html_e( 'Click the plus button, search for Instagram Feed', 'instagram-feed' ); ?>
					<br/><?php esc_html_e( 'Feed, and click the block to embed it.', 'instagram-feed' ); ?> <a href="https://smashballoon.com/doc/wordpress-5-block-page-editor-gutenberg/?facebook" rel="noopener" target="_blank"><?php esc_html_e( 'Learn More', 'instagram-feed' ); ?></a></p>
				<div class="sbi-tooltip-wizard-actions">
					<button class="sbi-tlp-wizard-close"><?php esc_html_e( 'Done', 'instagram-feed' ); ?></button>
				</div>
			</div>
		</div>
		<?php
	}


}
