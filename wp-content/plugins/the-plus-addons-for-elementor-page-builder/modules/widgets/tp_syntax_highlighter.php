<?php
/**
 * Widget Name: Syntax Highlighter
 * Description: Syntax Highlighter
 * Author: Theplus
 * Author URI: https://posimyth.com
 *
 * @package ThePlus
 */

namespace TheplusAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
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
 * Class L_ThePlus_Post_Title.
 */
class L_ThePlus_Syntax_Highlighter extends Widget_Base {

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
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-syntax-highlighter';
	}

	/**
	 * Get Widget Title.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Syntax Highlighter', 'tpebl' );
	}

	/**
	 * Get Widget Icon.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa- tp-syntax-highlighter theplus_backend_icon';
	}

	/**
	 * Get Custom url.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**      
	 * Get Widget keywords.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Syntax Highlighter', 'code highlighter', 'code syntax', 'code editor', 'code formatting', 'code styling', 'code display', 'code snippet', 'code block' );
	}

	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'syn_content_section',
			array(
				'label' => esc_html__( 'Source Code', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'languageType',
			array(
				'label'   => esc_html__( 'Language', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'markup',
				'options' => array(
					'markup'       => esc_html__( 'HTML Markup', 'tpebl' ),
					'basic'        => esc_html__( 'Basic', 'tpebl' ),
					'c'            => esc_html__( 'C', 'tpebl' ),
					'c#'           => esc_html__( 'C#', 'tpebl' ),
					'cpp'          => esc_html__( 'CPP', 'tpebl' ),
					'css'          => esc_html__( 'CSS', 'tpebl' ),
					'css-extras'   => esc_html__( 'CSS Extra', 'tpebl' ),
					'gcode'        => esc_html__( 'Gcode', 'tpebl' ),
					'git'          => esc_html__( 'Git', 'tpebl' ),
					'http'         => esc_html__( 'Http', 'tpebl' ),
					'java'         => esc_html__( 'Java', 'tpebl' ),
					'javadoc'      => esc_html__( 'Java Doc', 'tpebl' ),
					'javadoclike'  => esc_html__( 'Java Doc-Like', 'tpebl' ),
					'javascript'   => esc_html__( 'Javascript', 'tpebl' ),
					'jsdoc'        => esc_html__( 'JSDoc', 'tpebl' ),
					'js-extras'    => esc_html__( 'JS Extra', 'tpebl' ),
					'js-templates' => esc_html__( 'JS Templates', 'tpebl' ),
					'json'         => esc_html__( 'Json', 'tpebl' ),
					'jsonp'        => esc_html__( 'Jsonp', 'tpebl' ),
					'json5'        => esc_html__( 'Json5', 'tpebl' ),
					'perl'         => esc_html__( 'Perl', 'tpebl' ),
					'php'          => esc_html__( 'Php', 'tpebl' ),
					'phpdoc'       => esc_html__( 'Phpdoc', 'tpebl' ),
					'php-extras'   => esc_html__( 'Php Extra', 'tpebl' ),
					'plsql'        => esc_html__( 'PL/SQL', 'tpebl' ),
					'python'       => esc_html__( 'Python', 'tpebl' ),
					'react'        => esc_html__( 'React', 'tpebl' ),
					'ruby'         => esc_html__( 'Ruby', 'tpebl' ),
					'sas'          => esc_html__( 'Sas', 'tpebl' ),
					'sass'         => esc_html__( 'Sass', 'tpebl' ),
					'scss'         => esc_html__( 'Scss', 'tpebl' ),
					'scheme'       => esc_html__( 'Scheme', 'tpebl' ),
					'sql'          => esc_html__( 'SQL', 'tpebl' ),
					'vbnet'        => esc_html__( 'VB.Net', 'tpebl' ),
					'visual-basic' => esc_html__( 'Visual Basic', 'tpebl' ),
					'wiki'         => esc_html__( 'Wiki', 'tpebl' ),
					'xquery'       => esc_html__( 'Xquery', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'themeType',
			array(
				'label'   => esc_html__( 'Theme', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'prism-default',
				'options' => array(
					'prism-default'        => esc_html__( 'Default', 'tpebl' ),
					'prism-coy'            => esc_html__( 'Coy', 'tpebl' ),
					'prism-dark'           => esc_html__( 'Dark', 'tpebl' ),
					'prism-funky'          => esc_html__( 'Funky', 'tpebl' ),
					'prism-okaidia'        => esc_html__( 'Okaidia', 'tpebl' ),
					'prism-solarizedlight' => esc_html__( 'Solarized Light', 'tpebl' ),
					'prism-tomorrownight'  => esc_html__( 'Tomorrow', 'tpebl' ),
					'prism-twilight'       => esc_html__( 'Twilight', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'sourceCode',
			array(
				'label'   => esc_html__( 'Source Code', 'tpebl' ),
				'type'    => Controls_Manager::CODE,
				'dynamic' => array( 'active' => true ),
				'default' => '<h1>Welcome To Posimyth Innovation</h1>',
			)
		);
		$this->add_responsive_control(
			'synTxtAlign',
			array(
				'label'     => esc_html__( 'Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'tpebl' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'tpebl' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'tpebl' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => 'left',
				'selectors' => array(
					'{{WRAPPER}} .tp-code-highlighter pre,
					{{WRAPPER}} .tp-code-highlighter pre code' => 'text-align: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'syn_options_section',
			array(
				'label' => esc_html__( 'Options', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'lanugaetext',
			array(
				'label'       => esc_html__( 'Language Text', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Text', 'tpebl' ),
				'label_block' => true,
			)
		);
		$this->add_control(
			'cpybtntext',
			array(
				'label'       => esc_html__( 'Copy Text', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Copy', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter Text', 'tpebl' ),
				'label_block' => true,
				'separator'   => 'before',
			)
		);
		$this->add_control(
			'cpybtnicon',
			array(
				'label'   => esc_html__( 'Copy Icon', 'tpebl' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'far fa-copy',
					'library' => 'solid',
				),
			)
		);
		$this->add_control(
			'copiedbtntext',
			array(
				'label'       => esc_html__( 'Copied Text', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Copied!', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter Text', 'tpebl' ),
				'label_block' => true,
			)
		);
		$this->add_control(
			'copiedbtnicon',
			array(
				'label'   => esc_html__( 'Copied Icon', 'tpebl' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-copy',
					'library' => 'solid',
				),
			)
		);
		$this->add_control(
			'cpyerrbtntext',
			array(
				'label'       => esc_html__( 'Copy Error Text', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => esc_html__( 'Error', 'tpebl' ),
				'placeholder' => esc_html__( 'Enter Text', 'tpebl' ),
				'label_block' => true,
			)
		);
		$this->add_control(
			'lineNumber',
			array(
				'label'     => wp_kses_post( "Line Number <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "highlight-any-specific-line-in-syntax-highlight-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'lineHighlight',
			array(
				'label'       => esc_html__( 'Line Highlight', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'default'     => '',
				'placeholder' => esc_html__( 'Ex: 1,2,3,4-15', 'tpebl' ),
				'label_block' => true,
			)
		);
		$this->add_control(
			'dnloadBtn',
			array(
				'label'     => wp_kses_post( "Download Button <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-download-button-in-code-highlighter-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Enable', 'tpebl' ),
				'label_off' => esc_html__( 'Disable', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'dwnldBtnText',
			array(
				'label'     => esc_html__( 'Button Text', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array( 'active' => true ),
				'default'   => esc_html__( 'Download', 'tpebl' ),
				'condition' => array(
					'dnloadBtn' => 'yes',
				),
			)
		);
		$this->add_control(
			'dwnldBtnIcon',
			array(
				'label' => esc_html__( 'Button Icon', 'tpebl' ),
				'type'  => Controls_Manager::ICONS,
			)
		);
		$this->add_control(
			'fileLink',
			array(
				'label'         => __( 'Link', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'show_external' => true,
				'dynamic'       => array( 'active' => true ),
				'default'       => array(
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition'     => array(
					'dnloadBtn' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'syn_scode_styling',
			array(
				'label' => esc_html__( 'Source Code', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'scodeMargin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-code-highlighter pre' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'scodePadding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-code-highlighter pre' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'scodeHeight',
			array(
				'type'       => Controls_Manager::SLIDER,
				'label'      => esc_html__( 'Height', 'tpebl' ),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 10,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => '',
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-code-highlighter pre' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'syn_lineno_styling',
			array(
				'label'     => esc_html__( 'Line Number', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'lineNumber' => 'yes',
				),
			)
		);
		$this->add_control(
			'numberColor',
			array(
				'label'     => esc_html__( 'Number Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .line-numbers-rows > span:before' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'lineNumber' => 'yes',
				),
			)
		);
		$this->add_control(
			'bdrColor',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .line-numbers .line-numbers-rows' => 'border-right: 1px solid {{VALUE}};',
				),
				'condition' => array(
					'lineNumber' => 'yes',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'syn_lineHgt_styling',
			array(
				'label'     => esc_html__( 'Line Highlight', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'lineHighlight!' => '',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'highlightBG',
				'label'     => esc_html__( 'Background', 'tpebl' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .line-highlight',
				'condition' => array(
					'lineHighlight!' => '',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'syn_langtxt_styling',
			array(
				'label' => esc_html__( 'Language Text', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'langtxtPadding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar .toolbar-item > span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'langtxtMargin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar .toolbar-item > span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'langtxtTypo',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar .toolbar-item > span',
			)
		);
		$this->start_controls_tabs( 'tabs_langtxt' );
		$this->start_controls_tab(
			'tab_langtxt_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'langtxtNColor',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar .toolbar-item > span' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'langtxtNmlBG',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar .toolbar-item > span',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'langtxtBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar .toolbar-item > span',
			)
		);
		$this->add_responsive_control(
			'langtxtNRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar .toolbar-item > span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'langtxtNShadow',
				'selector' => '{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar .toolbar-item > span',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_langtxt_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'langtxtColor',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar .toolbar-item > span:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'langtxtHvrBG',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar .toolbar-item > span:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'langtxtHBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar .toolbar-item > span:hover',
			)
		);
		$this->add_responsive_control(
			'langtxtHRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar .toolbar-item > span:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'langtxtHShadow',
				'selector' => '{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar .toolbar-item > span:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'syn_cpdnbtn_styling',
			array(
				'label' => esc_html__( 'Copy/Download Button', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'copyDwlBtnPadding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .toolbar-item button,{{WRAPPER}} .toolbar-item a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'copyDwlBtnMargin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .toolbar-item button,{{WRAPPER}} .toolbar-item a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'copyDwlBtnTypo',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				),
				'selector' => '{{WRAPPER}} .toolbar-item button,{{WRAPPER}} .toolbar-item a',
			)
		);
		$this->add_control(
			'copyDwlBtnIconSize',
			array(
				'label'      => esc_html__( 'Icon Size', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 13,
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar a i,{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar button i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar a svg,{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar button svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_cpdnbtn' );
		$this->start_controls_tab(
			'tab_cpdnbtn_n',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'copyDwlBtnNColor',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .toolbar-item button,{{WRAPPER}} .toolbar-item a' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'copyDwlBtniconNColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar a i,{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar button i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar a svg,{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar button svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'copyDwlBtnNmlBG',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .toolbar-item button,{{WRAPPER}} .toolbar-item a',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'copyDwlBtnNBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .toolbar-item button,{{WRAPPER}} .toolbar-item a',
			)
		);
		$this->add_responsive_control(
			'copyDwlBtnNRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .toolbar-item button,{{WRAPPER}} .toolbar-item a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'copyDwlBtnNShadow',
				'selector' => '{{WRAPPER}} .toolbar-item button,{{WRAPPER}} .toolbar-item a',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_cpdnbtn_h',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'copyDwlBtnHColor',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .toolbar-item button:hover,{{WRAPPER}} .toolbar-item a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .toolbar-item a:hover svg,{{WRAPPER}} .toolbar-item button:hover svg' => 'fill: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'copyDwlBtniconHColor',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar a:hover i,{{WRAPPER}} .tp-code-highlighter div.code-toolbar>.toolbar button:hover i' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'copyDwlBtnHvrBG',
				'label'    => esc_html__( 'Background', 'tpebl' ),
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .toolbar-item button:hover,{{WRAPPER}} .toolbar-item a:hover',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'copyDwlBtnHBorder',
				'label'    => esc_html__( 'Border', 'tpebl' ),
				'selector' => '{{WRAPPER}} .toolbar-item button:hover,{{WRAPPER}} .toolbar-item a:hover',
			)
		);
		$this->add_responsive_control(
			'copyDwlBtnHRadius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .toolbar-item button:hover,{{WRAPPER}} .toolbar-item a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'copyDwlBtnHShadow',
				'selector' => '{{WRAPPER}} .toolbar-item button:hover,{{WRAPPER}} .toolbar-item a:hover',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'content_scrolling_bar_section_styling',
			array(
				'label' => esc_html__( 'Scrolling Bar', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,

			)
		);
		$this->add_control(
			'display_scrolling_bar',
			array(
				'label'     => esc_html__( 'Scrolling Bar', 'tpebl' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
			)
		);

		$this->start_controls_tabs( 'tabs_scrolling_bar_style' );
		$this->start_controls_tab(
			'tab_scrolling_bar_scrollbar',
			array(
				'label'     => esc_html__( 'Scrollbar', 'tpebl' ),
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_control(
			'scroll_scrollbar_width',
			array(
				'label'      => esc_html__( 'ScrollBar Width', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-code-highlighter .code-toolbar pre::-webkit-scrollbar' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_control(
			'scroll_scrollbar_height',
			array(
				'label'      => esc_html__( 'ScrollBar Height', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 10,
				),
				'selectors'  => array(
					'{{WRAPPER}} .tp-code-highlighter .code-toolbar pre::-webkit-scrollbar' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_scrolling_bar_thumb',
			array(
				'label'     => esc_html__( 'Thumb', 'tpebl' ),
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'scroll_thumb_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-code-highlighter .code-toolbar pre::-webkit-scrollbar-thumb',
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'scroll_thumb_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-code-highlighter .code-toolbar pre::-webkit-scrollbar-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'scroll_thumb_shadow',
				'selector'  => '{{WRAPPER}} .tp-code-highlighter .code-toolbar pre::-webkit-scrollbar-thumb',
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_scrolling_bar_track',
			array(
				'label'     => esc_html__( 'Track', 'tpebl' ),
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'scroll_track_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .tp-code-highlighter .code-toolbar pre::-webkit-scrollbar-track',
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'scroll_track_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .tp-code-highlighter .code-toolbar pre::-webkit-scrollbar-track' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'scroll_track_shadow',
				'selector'  => '{{WRAPPER}} .tp-code-highlighter .code-toolbar pre::-webkit-scrollbar-track',
				'condition' => array(
					'display_scrolling_bar' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		include L_THEPLUS_PATH . 'modules/widgets/theplus-needhelp.php';
		include L_THEPLUS_PATH . 'modules/widgets/theplus-profeatures.php';
	}

	/**
	 * Render Accrordion.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function render() {

		$settings  = $this->get_settings_for_display();
		$uid_synhg = uniqid( 'tp-synhg' );

		$language_type = ! empty( $settings['languageType'] ) ? $settings['languageType'] : 'markup';
		$theme_type    = ! empty( $settings['themeType'] ) ? $settings['themeType'] : 'prism-default';
		$source_code   = ! empty( $settings['sourceCode'] ) ? $settings['sourceCode'] : '';
		$line_number   = ! empty( 'yes' === $settings['lineNumber'] ) ? true : false;

		$line_highlight = ! empty( $settings['lineHighlight'] ) ? $settings['lineHighlight'] : '';
		$dnload_btn     = ! empty( 'yes' === $settings['dnloadBtn'] ) ? true : false;
		$dwnld_btn_text = ! empty( $settings['dwnldBtnText'] ) ? $settings['dwnldBtnText'] : '';
		$file_link      = ! empty( $settings['fileLink']['url'] ) ? $settings['fileLink']['url'] : '';

		$cpybtnicon    = '';
		$copiedbtnicon = '';

		$cpybtniconclass = '';
		$dowbtniconclass = '';

		$cpybtntext = ! empty( $settings['cpybtntext'] ) ? $settings['cpybtntext'] : '';

		if ( ! empty( $settings['cpybtnicon']['value'] ) || ! empty( $settings['copiedbtnicon']['value'] ) ) {
			$cpybtniconclass = ' tpcpicon';
		}

		if ( ! empty( $settings['cpybtnicon'] ) ) {
			ob_start();
			\Elementor\Icons_Manager::render_icon( $settings['cpybtnicon'], array( 'aria-hidden' => 'true' ) );
			$cpybtnicon = ob_get_contents();
			ob_end_clean();
		}

		$copiedbtntext = ! empty( $settings['copiedbtntext'] ) ? $settings['copiedbtntext'] : '';
		if ( ! empty( $settings['copiedbtnicon'] ) ) {
			ob_start();
			\Elementor\Icons_Manager::render_icon( $settings['copiedbtnicon'], array( 'aria-hidden' => 'true' ) );
			$copiedbtnicon = ob_get_contents();
			ob_end_clean();
		}

		$cpyerrbtntext = ! empty( $settings['cpyerrbtntext'] ) ? $settings['cpyerrbtntext'] : '';

		$line_num_class = '';
		if ( 'yes' === $line_number ) {
			$line_num_class = 'line-numbers';
		}

		$dwnld_btn_class = '';
		$dwnld_btn_icon  = '';
		if ( 'yes' === $dnload_btn ) {
			$dwnld_btn_class = 'data-src=' . esc_url( $file_link ) . ' data-download-link data-download-link-label=' . esc_attr( $dwnld_btn_text ) . '';

			if ( ! empty( $settings['dwnldBtnIcon']['value'] ) ) {
				$dowbtniconclass = ' tpdowicon';
			}

			if ( ! empty( $settings['dwnldBtnIcon'] ) ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon( $settings['dwnldBtnIcon'], array( 'aria-hidden' => 'true' ) );
				$dwnld_btn_icon = ob_get_contents();
				ob_end_clean();
			}
		}

		$langtext = '';
		if ( ! empty( $settings['lanugaetext'] ) ) {
			$langtext = 'data-label="' . esc_html( $settings['lanugaetext'] ) . '"';
		}

		$output = '<div class="tp-code-highlighter code-' . esc_attr( $theme_type ) . ' tp-widget-' . esc_attr( $uid_synhg ) . ' ' . esc_attr( $cpybtniconclass ) . ' ' . esc_attr( $dowbtniconclass ) . '" data-prismjs-copy="' . esc_html( $cpybtntext ) . '"  data-copyicon="' . esc_html( $cpybtnicon ) . '" data-prismjs-copy-success="' . esc_html( $copiedbtntext ) . '" data-copiedbtnicon="' . esc_html( $copiedbtnicon ) . '" data-download-text="' . esc_html( $dwnld_btn_text ) . '" data-download-iconsh="' . esc_html( $dwnld_btn_icon ) . '">';

			$output .= '<pre class="language-' . esc_attr( $language_type ) . ' ' . esc_attr( $line_num_class ) . '" data-line="' . esc_attr( $line_highlight ) . '" ' . esc_attr( $dwnld_btn_class ) . ' ' . $langtext . ' data-previewers="angle color gradient easing time">';

				$output .= '<code class="language-' . esc_attr( $language_type ) . '" data-prismjs-copy="' . esc_attr( $cpybtntext ) . '" data-prismjs-copy-error="' . esc_attr( $cpyerrbtntext ) . '" data-prismjs-copy-success="' . esc_attr( $copiedbtntext ) . '">';

					$output .= esc_html( $source_code );

				$output .= '</code>';

			$output .= '</pre>';

		$output .= '</div>';

		echo $output;
	}

	/**
	 * Render content_template.
	 *
	 * @since 1.0.0
	 * @version 5.4.2
	 */
	protected function content_template() {}
}
