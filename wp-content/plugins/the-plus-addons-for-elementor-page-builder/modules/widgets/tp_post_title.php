<?php
/**
 * Widget Name: Post Title
 * Description: Post Title
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

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class L_ThePlus_Post_Title
 */
class L_ThePlus_Post_Title extends Widget_Base {

	/**
	 * Document Link For Need help.
	 *
	 * @since 5.3.3
	 * @version 5.4.2
	 *
	 * @var tp_doc of the class.
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
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-post-title';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Post Title', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-underline theplus_backend_icon';
	}

	/**
	 * Get Widget categories.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-builder' );
	}

	/**
	 * Get Widget keywords.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Post Title', 'Title', 'Blog Title', 'Article Title', 'Page Title', 'Post Name', 'Article Name', 'Page Name' );
	}

	/**
	 * Get Widget Help URL.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => esc_html__( 'Post Title', 'tpebl' ),
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
			'titleprefix',
			array(
				'label'   => esc_html__( 'Prefix Text', 'tpebl' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'dynamic' => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'titlepostfix',
			array(
				'label'   => esc_html__( 'Postfix Text', 'tpebl' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
				'dynamic' => array(
					'active' => true,
				),
			)
		);
		$this->add_control(
			'titleTag',
			array(
				'label'   => esc_html__( 'Tag', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => array(
					'h1'   => esc_html__( 'H1', 'tpebl' ),
					'h2'   => esc_html__( 'H2', 'tpebl' ),
					'h3'   => esc_html__( 'H3', 'tpebl' ),
					'h4'   => esc_html__( 'H4', 'tpebl' ),
					'h5'   => esc_html__( 'H5', 'tpebl' ),
					'h6'   => esc_html__( 'H6', 'tpebl' ),
					'div'  => esc_html__( 'Div', 'tpebl' ),
					'span' => esc_html__( 'Span', 'tpebl' ),
					'p'    => esc_html__( 'P', 'tpebl' ),
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
					'{{WRAPPER}} .tp-post-title' => 'justify-content: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'extra_opt_section',
			array(
				'label' => esc_html__( 'Extra Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'titleLink',
			array(
				'label'     => esc_html__( 'Link', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
			)
		);
		$this->add_control(
			'limitCountType',
			array(
				'label'   => esc_html__( 'Length Limit', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => array(
					'default'       => esc_html__( 'No Limit', 'tpebl' ),
					'limitByLetter' => esc_html__( 'Based on Letters', 'tpebl' ),
					'limitByWord'   => esc_html__( 'Based on Words', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'titleLimit',
			array(
				'label'     => esc_html__( 'Limit of Words/Character', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 5000,
				'step'      => 1,
				'default'   => 10,
				'condition' => array(
					'limitCountType!' => 'default',
				),
			)
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => esc_html__( 'Title', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'textAlignment',
			array(
				'label'     => esc_html__( 'Text Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'left',
				'options'   => array(
					'left'    => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
					'justify' => array(
						'title' => esc_html__( 'Justify', 'tpebl' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .tp-post-title' => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-title a,{{WRAPPER}} .tp-post-title .tp-entry-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-post-title a,{{WRAPPER}} .tp-post-title .tp-entry-title',
			)
		);
		$this->start_controls_tabs( 'tabs_title_style' );
		$this->start_controls_tab(
			'tab_title_normal',
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
					'{{WRAPPER}} .tp-post-title a,{{WRAPPER}} .tp-post-title .tp-entry-title' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'boxBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-title a,{{WRAPPER}} .tp-post-title .tp-entry-title',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'boxBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-title a,{{WRAPPER}} .tp-post-title .tp-entry-title',
			)
		);
		$this->add_responsive_control(
			'boxBorderRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-title a,{{WRAPPER}} .tp-post-title .tp-entry-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'boxBoxShadow',
				'selector' => '{{WRAPPER}} .tp-post-title a,{{WRAPPER}} .tp-post-title .tp-entry-title',
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
					'{{WRAPPER}} .tp-post-title a:hover,{{WRAPPER}} .tp-post-title .tp-entry-title:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'boxBgHover',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-title a:hover,{{WRAPPER}} .tp-post-title .tp-entry-title:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'boxBorderHover',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-title a:hover,{{WRAPPER}} .tp-post-title .tp-entry-title:hover',
			)
		);
		$this->add_responsive_control(
			'boxBorderRadiusHover',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-title a:hover,{{WRAPPER}} .tp-post-title .tp-entry-title:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'boxBoxShadowHover',
				'selector' => '{{WRAPPER}} .tp-post-title a:hover,{{WRAPPER}} .tp-post-title .tp-entry-title:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
		$this->start_controls_section(
			'section_prepost_style',
			array(
				'label'      => esc_html__( 'Prefix/Postfix', 'tpebl' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'titleprefix',
							'operator' => '!=',
							'value'    => '',
						),
						array(
							'name'     => 'titlepostfix',
							'operator' => '!=',
							'value'    => '',
						),
					),
				),
			)
		);
		$this->add_responsive_control(
			'prepostpadding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-title .tp-post-title-prepost' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'after',
			)
		);
		$this->add_responsive_control(
			'preoffset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Prefix Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-post-title .tp-post-title-prepost.tp-prefix' => 'margin-right: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'postoffset',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Postfix Offset', 'tpebl' ),
				'size_units'  => array( 'px' ),
				'range'       => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'render_type' => 'ui',
				'selectors'   => array(
					'{{WRAPPER}} .tp-post-title .tp-post-title-prepost.tp-postfix' => 'margin-left: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'preposttypography',
				'label'     => esc_html__( 'Typography', 'tpebl' ),
				'global'    => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector'  => '{{WRAPPER}} .tp-post-title .tp-post-title-prepost',
				'separator' => 'after',
			)
		);
		$this->add_control(
			'prepostColor',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-post-title .tp-post-title-prepost' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'prepostboxBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-post-title .tp-post-title-prepost',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'prepostboxBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-post-title .tp-post-title-prepost',
			)
		);
		$this->add_responsive_control(
			'prepostboxBorderRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-post-title .tp-post-title-prepost' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'prepostboxBoxShadow',
				'selector' => '{{WRAPPER}} .tp-post-title .tp-post-title-prepost',
			)
		);
		$this->end_controls_section();

		include L_THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
		include L_THEPLUS_PATH . 'modules/widgets/theplus-profeatures.php';
	}

	/**
	 * Render
	 *
	 * Written in PHP and HTML.
	 *
	 * @since 1.0.1
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$post_id  = get_the_ID();

		$titletag         = ( ! empty( $settings['titleTag'] ) ) ? $settings['titleTag'] : 'h3';
		$title_link       = ( ! empty( $settings['titleLink'] ) ) ? $settings['titleLink'] : 'no';
		$limit_count_type = ( ! empty( $settings['limitCountType'] ) ) ? $settings['limitCountType'] : '';
		$text_limit       = ( ! empty( $settings['titleLimit'] ) ) ? $settings['titleLimit'] : '';
		$titleprefix      = ( ! empty( $settings['titleprefix'] ) ) ? $settings['titleprefix'] : '';
		$titlepostfix     = ( ! empty( $settings['titlepostfix'] ) ) ? $settings['titlepostfix'] : '';
		$posttype         = ! empty( $settings['posttype'] ) ? $settings['posttype'] : '';

		if ( 'archivepage' === $posttype ) {
			add_filter(
				'get_the_archive_title',
				function ( $title ) {
					if ( is_category() ) {
						$title = single_cat_title( '', false );
					} elseif ( is_tag() ) {
						$title = single_tag_title( '', false );
					} elseif ( is_author() ) {
						$title = '<span class="vcard">' . get_the_author() . '</span>';
					} elseif ( is_tax() ) {
						// Translators: %1$s is replaced with the title.
                        $title = sprintf( __( 'Title: %1$s', 'tpebl' ), single_term_title( '', false ) );
					} elseif ( is_post_type_archive() ) {
						$title = post_type_archive_title( '', false );
					} elseif ( is_search() ) {
						$title = get_search_query();
					}
					return $title;
				}
			);
		}

		if ( ! empty( $posttype ) ) {
			if ( 'limitByWord' === $limit_count_type ) {
				if ( 'singlepage' === $posttype ) {
					$title = wp_trim_words( get_the_title( $post_id ), $text_limit );
				} elseif ( 'archivepage' === $posttype ) {
					$title = wp_trim_words( get_the_archive_title(), $text_limit );
				}
			} elseif ( 'limitByLetter' === $limit_count_type ) {
				if ( 'singlepage' === $posttype ) {
					$title = substr( wp_trim_words( get_the_title( $post_id ) ), 0, $text_limit ) . '...';
				} elseif ( 'archivepage' === $posttype ) {
					$title = substr( wp_trim_words( get_the_archive_title() ), 0, $text_limit ) . '...';
				}
			} elseif ( 'singlepage' === $posttype ) {
					$title = get_the_title( $post_id );
			} elseif ( 'archivepage' === $posttype ) {
				$title = get_the_archive_title();
			}
		}

		$output = '<div class="tp-post-title">';
		if ( ! empty( $titleprefix ) ) {
			$output .= '<span class="tp-post-title-prepost tp-prefix">' . esc_html( $titleprefix ) . '</span>';
		}
		if ( 'yes' === $title_link ) {
			$output .= '<a href="' . get_the_permalink() . '" >';
		}
			$output             .= '<' . l_theplus_validate_html_tag( $titletag ) . ' class="tp-entry-title">';
						$output .= $title;
			$output             .= '</' . l_theplus_validate_html_tag( $titletag ) . '>';
		if ( 'yes' === $title_link ) {
			$output .= '</a>';
		}
		if ( ! empty( $titlepostfix ) ) {
			$output .= '<span class="tp-post-title-prepost tp-postfix">' . esc_html( $titlepostfix ) . '</span>';
		}
		$output .= '</div>';

		echo $output;
	}
}