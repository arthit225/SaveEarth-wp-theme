<?php
/**
 * Widget Name: Post Content
 * Description: Post Content
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use TheplusAddons\L_Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Post_Content
 */
class L_ThePlus_Post_Content extends Widget_Base {

	/**
	 * Document Link For Need help.
	 *
	 * @since 5.3.3
	 *
	 * @version 5.4.2
	 *
	 * @var TpDoc of the class.
	 */
	public $tp_doc = L_THEPLUS_TPDOC;

	/**
	 * Helpdesk Link For Need help.
	 *
	 * @var tp_help of the class.
	 */
	public $tp_help = L_THEPLUS_HELP;

	/**
	 * Get Widget Name.
	 *
	 * @since 1.0.0
	 *
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-post-content';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 *
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Post Content', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 *
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-file-text-o theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.0
	 *
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-builder' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 *
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Protected Content', 'Password Protected Content', 'Content Protection', 'Secure Content', 'Restricted Content' );
	}

	/**
	 * Get Widget Custom Help Url.
	 *
	 * @since 1.0.0
	 *
	 * @version 5.4.2
	 */
	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.0
	 *
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Post Content', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'posttype',
			array(
				'label'   => esc_html__( 'Post Types', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'singlepage',
				'options' => array(
					'singlepage'  => esc_html__( 'Single Page', 'tpebl' ),
					'archivepage' => esc_html__( 'Archive Page', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'postContentType',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Content Type', 'tpebl' ),
				'default'   => 'default',
				'options'   => array(
					'default' => esc_html__( 'Full Content', 'tpebl' ),
					'excerpt' => esc_html__( 'Excerpt', 'tpebl' ),
				),
				'condition' => array(
					'posttype' => 'singlepage',
				),
			)
		);
		$this->add_control(
			'postContentEditorType',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Content', 'tpebl' ),
				'default'   => 'default',
				'options'   => array(
					'default'   => esc_html__( 'Elementor', 'tpebl' ),
					'wordpress' => esc_html__( 'Wordpress', 'tpebl' ),
				),
				'condition' => array(
					'posttype' => 'singlepage',
				),
			)
		);
		$this->add_responsive_control(
			'alignment',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'flex-start',
				'options'   => array(
					'flex-start' => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'     => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'flex-end'   => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .elementor-widget-container' => 'justify-content: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_excerpts_style',
			array(
				'label' => esc_html__( 'Excerpts', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} > .elementor-widget-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'excerptstypography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} > .elementor-widget-container',
			)
		);
		$this->start_controls_tabs( 'tabs_excerpts_style' );
		$this->start_controls_tab(
			'tab_excerpts_normal',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'NormalColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} > .elementor-widget-container' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'boxBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} > .elementor-widget-container',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'boxBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} > .elementor-widget-container',
			)
		);
		$this->add_responsive_control(
			'boxBorderRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} > .elementor-widget-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'boxBoxShadow',
				'selector' => '{{WRAPPER}} > .elementor-widget-container',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_title_hover',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'HoverColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} > .elementor-widget-container:hover:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'boxBgHover',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} > .elementor-widget-container:hover:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'boxBorderHover',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} > .elementor-widget-container:hover:hover',
			)
		);
		$this->add_responsive_control(
			'boxBorderRadiusHover',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} > .elementor-widget-container:hover:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'boxBoxShadowHover',
				'selector' => '{{WRAPPER}} > .elementor-widget-container:hover:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		include L_THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
		include L_THEPLUS_PATH . 'modules/widgets/theplus-profeatures.php';
	}

	/**
	 * Render Progress Bar
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.0
	 *
	 * @version 5.4.2
	 *
	 * @param array|bool $wrapper An optional wrapper for the progress bar.
	 */
	protected function render( $wrapper = false ) {
		$settings          = $this->get_settings_for_display();
		$posttype          = ! empty( $settings['posttype'] ) ? $settings['posttype'] : 'singlepage';
		$post_content_type = ! empty( $settings['postContentType'] ) ? $settings['postContentType'] : 'default';

		$post_content_editor_type = ! empty( $settings['postContentEditorType'] ) ? $settings['postContentEditorType'] : 'default';

		if ( 'singlepage' === $posttype ) {

			if ( 'default' === $post_content_type ) {

				if ( strtolower( 'WordPress' ) === strtolower( $post_content_editor_type ) ) {

					static $views_ids = array();
					$post_id          = get_the_ID();
					if ( ! isset( $post_id ) ) {
						return '';
					}
					if ( isset( $views_ids[ $post_id ] ) ) {
						$is_debug = defined( 'WP_DEBUG' ) && WP_DEBUG &&
							defined( 'WP_DEBUG_DISPLAY' ) && WP_DEBUG_DISPLAY;

						return $is_debug ?
							esc_html__( 'Block Re-rendering halted', 'tpebl' ) :
							'';
					}

					$views_ids[ $post_id ] = true;

					global $current_screen;
					if ( isset( $current_screen ) && method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) {
						$content = wp_strip_all_tags( get_the_content( '', true, $post ) );
					} else {
						$post = get_post( $post_id );
						if ( ! $post || 'nxt_builder' === $post->post_type ) {
							return '';
						}

						if ( ( 'publish' !== $post->post_status && 'draft' !== $post->post_status && 'private' !== $post->post_status ) || ! empty( $post->post_password ) ) {
							return '';
						}

						$content = apply_filters( 'the_content', $post->post_content );
						echo '<div class="tp-post-content tp-wp-content">' . balanceTags( $content, true ) . '</div>';
					}
					unset( $views_ids[ $post_id ] );
				} else {
					static $posts = array();
					$post         = get_post();

					if ( post_password_required( $post->ID ) ) {
						echo get_the_password_form( $post->ID );
						return;
					}
					if ( isset( $posts[ $post->ID ] ) ) {
						return;
					}

					$posts[ $post->ID ] = true;
					$editor             = L_Theplus_Element_Load::elementor()->editor;
					$editmode           = $editor->is_edit_mode();

					if ( L_Theplus_Element_Load::elementor()->preview->is_preview_mode( $post->ID ) ) {
						$content = L_Theplus_Element_Load::elementor()->preview->builder_wrapper( '' );
					} else {
						$document = L_Theplus_Element_Load::elementor()->documents->get( $post->ID );
						if ( $document ) {
							$preview_type = $document->get_settings( 'preview_type' );
							$preview_id   = $document->get_settings( 'preview_id' );

							if ( ! empty( $preview_type ) && 0 === strpos( $preview_type, 'single' ) && ! empty( $preview_id ) ) {
								$post = get_post( $preview_id );

								if ( ! $post ) {
									return;
								}
							}
						}
						$editor->set_edit_mode( false );
						$content = L_Theplus_Element_Load::elementor()->frontend->get_builder_content( $post->ID, true );

						if ( empty( $content ) ) {
							L_Theplus_Element_Load::elementor()->frontend->remove_content_filter();
							setup_postdata( $post );

							$content = apply_filters( 'the_content', get_the_content() );

							wp_link_pages(
								array(
									'before'      => '<div class="page-links elementor-page-links"><span class="page-links-title elementor-page-links-title">' . __( 'Pages:', 'tpebl' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
									'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'tpebl' ) . ' </span>%',
									'separator'   => '<span class="screen-reader-text">, </span>',
								)
							);

							L_Theplus_Element_Load::elementor()->frontend->add_content_filter();

							return;
						} else {
							$content = apply_filters( 'the_content', $content );
						}
					}
					L_Theplus_Element_Load::elementor()->editor->set_edit_mode( $editmode );

					if ( $wrapper ) {
						echo '<div class="tp-post-content">' . balanceTags( $content, true ) . '</div>';
					} else {
						echo $content;
					}
				}
			} elseif ( 'excerpt' === $post_content_type ) {

				the_excerpt( get_the_ID() );
			}
		} elseif ( 'archivepage' === $posttype ) {

			if ( is_category() || is_tag() || is_tax() ) {
				echo term_description();
			}
		}
	}
}