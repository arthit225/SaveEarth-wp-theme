<?php
/**
 * Widget Name: Table
 * Description: Content of table.
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
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

use TheplusAddons\L_Theplus_Element_Load;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class ThePlus_Data_Table
 */
class L_ThePlus_Data_Table extends Widget_Base {

	/**
	 * Document Link For Need help
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
	 * Get Widget Name
	 *
	 * @since 1.4.0
	 * @version 5.4.2
	 */
	public function get_name() {
		return 'tp-table';
	}

	/**
	 * Get Widget Title
	 *
	 * @since 1.4.0
	 * @version 5.4.2
	 */
	public function get_title() {
		return esc_html__( 'Table', 'tpebl' );
	}

	/**
	 * Get Widget Icon
	 *
	 * @since 1.4.0
	 * @version 5.4.2
	 */
	public function get_icon() {
		return 'fa fa-table theplus_backend_icon';
	}

	/**
	 * Get Custom URL
	 *
	 * @since 1.4.0
	 * @version 5.4.2
	 */
	public function get_custom_help_url() {
		$help_url = $this->tp_help;

		return esc_url( $help_url );
	}

	/**
	 * Get Widget Categories
	 *
	 * @since 1.4.0
	 * @version 5.4.2
	 */
	public function get_categories() {
		return array( 'plus-essential' );
	}

	/**
	 * Get Widget Keywords
	 *
	 * @since 1.4.0
	 * @version 5.4.2
	 */
	public function get_keywords() {
		return array( 'Table', 'Data Table', 'Table Widget', 'Table', 'Table Addon', 'Table Plugin', 'Elementor Table', 'Elementor Data Table', 'Table Design', 'Table Layout' );
	}

	/**
	 * Register controls.
	 *
	 * @since 1.4.0
	 * @version 5.4.2
	 */
	protected function register_controls() {

		/** Content Section Start*/
		$this->start_controls_section(
			'section_table',
			array(
				'label' => esc_html__( 'Table', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);
		$this->add_control(
			'table_selection',
			array(
				'label'   => wp_kses_post( "Content Table <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "table-elementor-widget-settings-overview/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => array(
					'custom'       => esc_html__( 'Custom', 'tpebl' ),
					'csv_file'     => esc_html__( 'CSV File (Pro)', 'tpebl' ),
					'google_sheet' => esc_html__( 'Google Sheet (Pro)', 'tpebl' ),
				),
			)
		);
		$this->add_control(
			'csv_content_Table',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'table_selection' => array( 'csv_file' ),
				),
			)
		);
		$this->add_control(
			'google_content_Table',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'table_selection' => array( 'google_sheet' ),
				),
			)
		);
		$this->add_control(
			'how_it_works',
			array(
				'type'        => Controls_Manager::RAW_HTML,
				'raw'         => "<p class='tp-controller-notice'><a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "comparison-data-table-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Learn how to create Comparison Table <i class='eicon-help-o'></i> </a></https://theplusaddons.com/docs/table-elementor-widget-settings-overview/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widgetp>",
				'label_block' => true,
				'condition' => array(
				'table_selection' => 'custom',
			), 
			)
			
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_table_header',
			array(
				'label'     => esc_html__( 'Table Header', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
				'condition' => array(
					'table_selection' => 'custom',
				),
			)
		);
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'header_content_type',
			array(
				'label'   => esc_html__( 'Action', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'cell',
				'options' => array(
					'row'  => esc_html__( 'Start New Row', 'tpebl' ),
					'cell' => esc_html__( 'Cell Content', 'tpebl' ),
				),
			)
		);

		/** Table TH heading Row/Cell Note*/
		$repeater->add_control(
			'add_head_cell_row_description',
			array(
				'label'     => '',
				'dynamic'   => array(
					'active' => true,
				),
				'type'      => Controls_Manager::RAW_HTML,
				'raw'       => sprintf( '<p style="font-size: 12px;font-style: italic;line-height: 1.4;color: #a4afb7;">%s</p>', __( 'Your new row have been initiated. Add content of cells by selecting <b>"Cell Content"</b> in your next repeater tab.', 'tpebl' ) ),
				'condition' => array(
					'header_content_type' => 'row',
				),
			)
		);
		$repeater->start_controls_tabs( 'items_repeater' );
		$repeater->start_controls_tab(
			'tab_head_content',
			array(
				'label'     => esc_html__( 'CONTENT', 'tpebl' ),
				'condition' => array(
					'header_content_type' => 'cell',
				),
			)
		);
		$repeater->add_control(
			'heading_text',
			array(
				'label'     => esc_html__( 'Text', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'header_content_type' => 'cell',
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'tab_head_icon',
			array(
				'label'     => esc_html__( 'ICON / IMAGE', 'tpebl' ),
				'condition' => array(
					'header_content_type' => 'cell',
				),
			)
		);
		$repeater->add_control(
			'header_content_icon_image',
			array(
				'label'   => esc_html__( 'Select', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'  => esc_html__( 'None', 'tpebl' ),
					'icon'  => esc_html__( 'Icon', 'tpebl' ),
					'image' => esc_html__( 'Image', 'tpebl' ),
				),
			)
		);
		$repeater->add_control(
			'icons_image',
			array(
				'label'      => esc_html__( 'Use Image As icon', 'tpebl' ),
				'type'       => Controls_Manager::MEDIA,
				'default'    => array(
					'url' => '',
				),
				'media_type' => 'image',
				'dynamic'    => array( 'active' => true ),
				'condition'  => array(
					'header_content_icon_image' => 'image',
				),
			)
		);
		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'icons_image_thumbnail',
				'default'   => 'full',
				'separator' => 'before',
				'condition' => array(
					'header_content_icon_image' => 'image',
				),
			)
		);
		$repeater->add_control(
			'icon_font_style',
			array(
				'label'     => esc_html__( 'Icon Font', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					'font_awesome' => esc_html__( 'Font Awesome', 'tpebl' ),
					'icon_mind'    => esc_html__( 'Icons Mind', 'tpebl' ),
				),
				'condition' => array(
					'header_content_icon_image' => 'icon',
				),
			)
		);
		$repeater->add_control(
			'icon_fontawesome',
			array(
				'label'     => esc_html__( 'Icon Library', 'tpebl' ),
				'type'      => Controls_Manager::ICON,
				'default'   => 'fa fa-bank',
				'condition' => array(
					'header_content_icon_image' => 'icon',
					'icon_font_style'           => 'font_awesome',
				),
			)
		);
		$repeater->add_control(
			'icons_mind',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'header_content_icon_image' => 'icon',
					'icon_font_style'           => 'icon_mind',
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'tab_head_advance',
			array(
				'label'     => esc_html__( 'ADVANCE', 'tpebl' ),
				'condition' => array(
					'header_content_type' => 'cell',
				),
			)
		);
		$repeater->add_control(
			'heading_col_span',
			array(
				'label'     => esc_html__( 'Column Span', 'tpebl' ),
				'title'     => esc_html__( 'Number of columns for this column span COLSPAN.', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1,
				'min'       => 1,
				'max'       => 20,
				'step'      => 1,
				'condition' => array(
					'header_content_type' => 'cell',
				),
			)
		);
		$repeater->add_control(
			'heading_row_span',
			array(
				'label'     => esc_html__( 'Row Span', 'tpebl' ),
				'title'     => esc_html__( 'Number of rows for this column span ROWSPAN. Note : Put Row Span first and Column Span second in list.', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1,
				'min'       => 1,
				'max'       => 20,
				'step'      => 1,
				'separator' => 'below',
				'condition' => array(
					'header_content_type' => 'cell',
				),
			)
		);
		$repeater->add_control(
			'heading_row_width',
			array(
				'label'      => esc_html__( 'Column Width', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 500,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'size_units' => array( 'px', '%' ),
				'separator'  => 'below',
				'selectors'  => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}.plus-table-col' => 'width: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'header_content_type' => 'cell',
				),
			)
		);
		$repeater->add_control(
			'single_heading_color',
			array(
				'label'     => esc_html__( 'Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-table-row {{CURRENT_ITEM}} .plus-table__text' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'header_content_type' => 'cell',
				),
			)
		);
		$repeater->add_control(
			'single_heading_background_color',
			array(
				'label'     => esc_html__( 'Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} thead .plus-table-row {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'header_content_type' => 'cell',
				),
			)
		);
		$repeater->add_responsive_control(
			'cell_align_head_indi',
			array(
				'label'     => esc_html__( 'Text Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => '',
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
				'condition' => array(
					'header_content_type' => 'cell',
				),
				'selectors' => array(
					'{{WRAPPER}} th{{CURRENT_ITEM}} span' => 'justify-content:{{VALUE}};',
				),
			)
		);
		$repeater->end_controls_tab();
		$repeater->end_controls_tab();
		$this->add_control(
			'table_headings',
			array(
				'type'        => Controls_Manager::REPEATER,
				'show_label'  => true,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{ header_content_type }}: {{{ heading_text }}}',
				'default'     => array(
					array(
						'header_content_type' => 'row',
					),
					array(
						'header_content_type' => 'cell',
						'heading_text'        => esc_html__( 'ID', 'tpebl' ),
					),
					array(
						'header_content_type' => 'cell',
						'heading_text'        => esc_html__( 'Title 1', 'tpebl' ),
					),
					array(
						'header_content_type' => 'cell',
						'heading_text'        => esc_html__( 'Title 2', 'tpebl' ),
					),
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_table_content',
			array(
				'label'     => esc_html__( 'Table Body', 'tpebl' ),
				'condition' => array(
					'table_selection' => 'custom',
				),
			)
		);
		$repeater_row_col = new \Elementor\Repeater();
		$repeater_row_col->add_control(
			'content_type',
			array(
				'label'   => esc_html__( 'Action', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'cell',
				'options' => array(
					'row'  => esc_html__( 'Start New Row', 'tpebl' ),
					'cell' => esc_html__( 'Cell Content', 'tpebl' ),
				),
			)
		);

		/** Table heading border Row/Cell Note*/
		$repeater_row_col->add_control(
			'add_body_cell_row_description',
			array(
				'type'      => Controls_Manager::RAW_HTML,
				'raw'       => sprintf( '<p style="font-size: 12px;font-style: italic;line-height: 1.4;color: #a4afb7;">%s</p>', __( 'Your new row have been initiated. Add content of cells by selecting <b>"Cell Content"</b> in your next repeater tab.', 'tpebl' ) ),
				'condition' => array(
					'content_type' => 'row',
				),
			)
		);
		$repeater_row_col->start_controls_tabs( 'items_repeater' );
		$repeater_row_col->start_controls_tab(
			'tab_content',
			array(
				'label'     => esc_html__( 'Content', 'tpebl' ),
				'condition' => array(
					'content_type' => 'cell',
				),
			)
		);
		$repeater_row_col->add_control(
			'cell_text',
			array(
				'label'     => esc_html__( 'Text', 'tpebl' ),
				'type'      => Controls_Manager::TEXTAREA,
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'content_type' => 'cell',
				),
			)
		);
		$repeater_row_col->add_control(
			'link',
			array(
				'label'       => esc_html__( 'Link', 'tpebl' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => '#',
				'dynamic'     => array(
					'active' => true,
				),
				'default'     => array(
					'url' => '',
				),
				'condition'   => array(
					'content_type' => 'cell',
				),
			)
		);
		$repeater_row_col->add_control(
			'cell_display_button',
			array(
				'label'     => wp_kses_post( "Button <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "insert-button-inside-elementor-table/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'content_type' => 'cell',
				),
				'separator' => 'before',
			)
		);
		$repeater_row_col->add_control(
			'cell_button_style',
			array(
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Button Style', 'tpebl' ),
				'default'   => 'style-8',
				'options'   => array(
					'style-8' => esc_html__( 'Style 1', 'tpebl' ),
				),
				'condition' => array(
					'content_type'        => 'cell',
					'cell_display_button' => 'yes',
				),
			)
		);
		$repeater_row_col->add_control(
			'cell_button_text',
			array(
				'label'     => esc_html__( 'Button Text', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Click here', 'tpebl' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'content_type'        => 'cell',
					'cell_display_button' => 'yes',
				),
			)
		);
		$repeater_row_col->add_control(
			'cell_button_link',
			array(
				'label'         => esc_html__( 'URL/Link', 'tpebl' ),
				'type'          => Controls_Manager::URL,
				'show_external' => true,
				'default'       => array(
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				),
				'dynamic'       => array( 'active' => true ),
				'condition'     => array(
					'content_type'        => 'cell',
					'cell_display_button' => 'yes',
				),
			)
		);
		$repeater_row_col->add_control(
			'button_custom_attributes',
			array(
				'label'     => __( 'Add Custom Attributes', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Yes', 'tpebl' ),
				'label_off' => esc_html__( 'No', 'tpebl' ),
				'default'   => 'no',
				'condition' => array(
					'content_type'        => 'cell',
					'cell_display_button' => 'yes',
				),
			)
		);
		$repeater_row_col->add_control(
			'custom_attributes',
			array(
				'label'       => __( 'Custom Attributes', 'tpebl' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => array(
					'active' => true,
				),
				'placeholder' => __( 'key|value', 'tpebl' ),
				'condition'   => array(
					'content_type'             => 'cell',
					'cell_display_button'      => 'yes',
					'button_custom_attributes' => 'yes',
				),
			)
		);
		$repeater_row_col->end_controls_tab();
		$repeater_row_col->start_controls_tab(
			'tab_media',
			array(
				'label'     => esc_html__( 'ICON / IMAGE', 'tpebl' ),
				'condition' => array(
					'content_type' => 'cell',
				),
			)
		);
		$repeater_row_col->add_control(
			'cell_content_icon_image',
			array(
				'label'   => esc_html__( 'Select', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => array(
					'none'  => esc_html__( 'None', 'tpebl' ),
					'icon'  => esc_html__( 'Icon', 'tpebl' ),
					'image' => esc_html__( 'Image', 'tpebl' ),
				),
			)
		);
		$repeater_row_col->add_control(
			'icon_font_style',
			array(
				'label'     => esc_html__( 'Icon Font', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => array(
					'font_awesome' => esc_html__( 'Font Awesome', 'tpebl' ),
					'icon_mind'    => esc_html__( 'Icons Mind', 'tpebl' ),
				),
				'condition' => array(
					'content_type'            => 'cell',
					'cell_content_icon_image' => 'icon',
				),
			)
		);
		$repeater_row_col->add_control(
			'cell_icon',
			array(
				'label'       => esc_html__( 'Icon', 'tpebl' ),
				'type'        => Controls_Manager::ICON,
				'label_block' => false,
				'default'     => '',
				'condition'   => array(
					'content_type'            => 'cell',
					'icon_font_style'         => 'font_awesome',
					'cell_content_icon_image' => 'icon',
				),
			)
		);
		$repeater_row_col->add_control(
			'cell_icons_mind',
			array(
				'label'       => esc_html__( 'Unlock more possibilities', 'tpebl' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'description' => theplus_pro_ver_notice(),
				'classes'     => 'plus-pro-version',
				'condition'   => array(
					'content_type'            => 'cell',
					'cell_content_icon_image' => 'icon',
					'icon_font_style'         => 'icon_mind',
				),
			)
		);
		$repeater_row_col->add_control(
			'cell_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => array(
					'content_type'            => 'cell',
					'cell_content_icon_image' => 'icon',
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-table-row td.plus-table-col{{CURRENT_ITEM}} .plus-table__text i' => 'color: {{VALUE}};',
				),
			)
		);
		$repeater_row_col->add_control(
			'image',
			array(
				'label'     => wp_kses_post( "Choose Image <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "insert-images-in-table-content-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'content_type'            => 'cell',
					'cell_content_icon_image' => 'image',
				),
			)
		);
		$repeater_row_col->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image_thumbnail',
				'default'   => 'full',
				'separator' => 'before',
				'condition' => array(
					'content_type'            => 'cell',
					'cell_content_icon_image' => 'image',
				),
			)
		);
		$repeater_row_col->end_controls_tab();
		$repeater_row_col->start_controls_tab(
			'tab_advance_cells',
			array(
				'label'     => esc_html__( 'Advance', 'tpebl' ),
				'condition' => array(
					'content_type' => 'cell',
				),
			)
		);
		$repeater_row_col->add_responsive_control(
			'cell_align',
			array(
				'label'     => esc_html__( 'Text Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => '',
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
				'condition' => array(
					'content_type' => 'cell',
				),
				'selectors' => array(
					'{{WRAPPER}} td{{CURRENT_ITEM}} .plus-table__text,{{WRAPPER}} td{{CURRENT_ITEM}}' => 'text-align: {{VALUE}};',
				),
			)
		);
		$repeater_row_col->add_control(
			'cell_span',
			array(
				'label'     => esc_html__( 'Column Span', 'tpebl' ),
				'title'     => esc_html__( 'Number of columns for this column span.', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1,
				'min'       => 1,
				'max'       => 20,
				'step'      => 1,
				'condition' => array(
					'content_type' => 'cell',
				),
			)
		);
		$repeater_row_col->add_control(
			'cell_row_span',
			array(
				'label'     => esc_html__( 'Row Span', 'tpebl' ),
				'title'     => esc_html__( 'Number of rows for this column span.', 'tpebl' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 1,
				'min'       => 1,
				'max'       => 20,
				'step'      => 1,
				'separator' => 'below',
				'condition' => array(
					'content_type' => 'cell',
				),
			)
		);
		$repeater_row_col->add_control(
			'table_th_td',
			array(
				'label'       => esc_html__( 'Mark this cell as a Table Heading?', 'tpebl' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => array(
					'td' => esc_html__( 'No', 'tpebl' ),
					'th' => esc_html__( 'Yes', 'tpebl' ),
				),
				'default'     => 'td',
				'condition'   => array(
					'content_type' => 'cell',
				),
				'label_block' => true,
			)
		);
		$repeater_row_col->end_controls_tab();
		$repeater_row_col->end_controls_tabs();
		$this->add_control(
			'table_content',
			array(
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'content_type' => 'row',
					),
					array(
						'content_type' => 'cell',
						'cell_text'    => esc_html__( 'Sample #1', 'tpebl' ),
					),
					array(
						'content_type' => 'cell',
						'cell_text'    => esc_html__( 'Row 1, Content 1', 'tpebl' ),
					),
					array(
						'content_type' => 'cell',
						'cell_text'    => esc_html__( 'Row 1, Content 2', 'tpebl' ),
					),
					array(
						'content_type' => 'row',
					),
					array(
						'content_type' => 'cell',
						'cell_text'    => esc_html__( 'Sample #2', 'tpebl' ),
					),
					array(
						'content_type' => 'cell',
						'cell_text'    => esc_html__( 'Row 2, Content 1', 'tpebl' ),
					),
					array(
						'content_type' => 'cell',
						'cell_text'    => esc_html__( 'Row 2, Content 2', 'tpebl' ),
					),
					array(
						'content_type' => 'row',
					),
					array(
						'content_type' => 'cell',
						'cell_text'    => esc_html__( 'Sample #3', 'tpebl' ),
					),
					array(
						'content_type' => 'cell',
						'cell_text'    => esc_html__( 'Row 3, Content 1', 'tpebl' ),
					),
					array(
						'content_type' => 'cell',
						'cell_text'    => esc_html__( 'Row 3, Content 2', 'tpebl' ),
					),
				),
				'fields'      => $repeater_row_col->get_controls(),
				'title_field' => '{{ content_type }}: {{{ cell_text }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_advance_settings',
			array(
				'label' => esc_html__( 'Extra Settings', 'tpebl' ),
			)
		);
		$this->add_control(
			'scrollbar',
			array(
				'label'        => wp_kses_post( "Table Vertical Scrollbar <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-vertical-scrollbar-to-elementor-table/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'tpebl' ),
				'label_off'    => esc_html__( 'Off', 'tpebl' ),
				'return_value' => 'yes',
			)
		);
		$this->add_responsive_control(
			'height',
			array(
				'label'      => esc_html__( 'Height (px)', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1024,
						'step' => 5,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 100,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-table-wrapper' => 'height: {{SIZE}}{{UNIT}};overflow-y: scroll;',
				),
				'condition'  => array(
					'scrollbar' => 'yes',
				),
			)
		);
		$this->add_control(
			'searchable',
			array(
				'label'        => wp_kses_post( "Table Searchable <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "add-a-search-in-elementor-table/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'tpebl' ),
				'label_off'    => esc_html__( 'Off', 'tpebl' ),
				'separator'    => 'before',
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);
		$this->add_control(
			'searchable_label',
			array(
				'label'     => esc_html__( 'Search Field Label', 'tpebl' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'Search', 'tpebl' ),
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'searchable' => 'yes',
				),
			)
		);
		$this->add_control(
			'sortable',
			array(
				'label'        => wp_kses_post( "Table Sortable <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "enable-sorting-in-elementor-tables/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'tpebl' ),
				'label_off'    => esc_html__( 'Off', 'tpebl' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			)
		);
		$this->add_control(
			'show_entries',
			array(
				'label'        => wp_kses_post( "Entry Filter Dropdown <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "limit-the-number-of-rows-in-elementor-table/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'description'  => esc_html__( 'Controls the number of entries in a table.', 'tpebl' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'tpebl' ),
				'label_off'    => esc_html__( 'Off', 'tpebl' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			)
		);
		$this->add_control(
			'mobile_responsive_table',
			array(
				'label'     => wp_kses_post( "Mobile Responsive <a class='tp-docs-link' href='" . esc_url( $this->tp_doc ) . "make-data-tables-mobile-responsive-in-elementor/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> <i class='eicon-help-o'></i> </a>" ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'default',
				'options'   => array(
					'default'    => esc_html__( 'Swipe Responsive', 'tpebl' ),
					'one-by-one' => esc_html__( 'One by One Responsive', 'tpebl' ),
				),
				'separator' => 'before',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_header_style',
			array(
				'label' => esc_html__( 'Table Header', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'cell_align_head_normal',
			array(
				'label'     => esc_html__( 'Text Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => '',
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
				'condition' => array(
					'table_selection' => 'custom',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'header_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} th.plus-table-col',
			)
		);
		$this->add_responsive_control(
			'cell_padding_head',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '15',
					'bottom'   => '15',
					'left'     => '15',
					'right'    => '15',
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} th.plus-table-col' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_header_colors_row' );
		$this->start_controls_tab(
			'tab_header_colors_row',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'header_cell_color_row',
			array(
				'label'     => esc_html__( 'Row Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => Global_Colors::COLOR_TEXT,
				),
				'selectors' => array(
					'{{WRAPPER}} thead .plus-table-row th .plus-table__text' => 'color: {{VALUE}};',
					'{{WRAPPER}} th'                       => 'color: {{VALUE}};',
					'{{WRAPPER}} tbody .plus-table-row th' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'header_cell_background_row',
			array(
				'label'     => esc_html__( 'Row Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} thead .plus-table-row th' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} tbody .plus-table-row th' => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'header_border_styling',
			array(
				'label'        => esc_html__( 'Apply Border To', 'tpebl' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'CELL', 'tpebl' ),
				'label_off'    => esc_html__( 'ROW', 'tpebl' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'prefix_class' => 'plus-border-',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'           => 'row_border_head',
				'label'          => esc_html__( 'Row Border', 'tpebl' ),
				'fields_options' => array(
					'border' => array(
						'default' => 'solid',
					),
					'width'  => array(
						'default' => array(
							'top'      => '1',
							'right'    => '1',
							'bottom'   => '1',
							'left'     => '1',
							'isLinked' => true,
						),
					),
					'color'  => array(
						'default' => '#bbb',
					),
				),
				'selector'       => '{{WRAPPER}} thead tr.plus-table-row, {{WRAPPER}} tbody .plus-table-row th',
				'condition'      => array(
					'header_border_styling!' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'           => 'cell_border_head',
				'label'          => esc_html__( 'Cell Border', 'tpebl' ),
				'selector'       => '{{WRAPPER}} th.plus-table-col',
				'fields_options' => array(
					'border' => array(
						'default' => 'solid',
					),
					'width'  => array(
						'default' => array(
							'top'      => '1',
							'right'    => '1',
							'bottom'   => '1',
							'left'     => '1',
							'isLinked' => true,
						),
					),
					'color'  => array(
						'default' => '#bbb',
					),
				),
				'condition'      => array(
					'header_border_styling' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_header_hover_colors_row',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'header_cell_hover_color_row',
			array(
				'label'     => esc_html__( 'Row Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} thead .plus-table-row:hover .plus-table__text' => 'color: {{VALUE}};',
					'{{WRAPPER}} tbody .plus-table-row:hover th .plus-table__text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .plus-table-row:hover th' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'header_cell_hover_background_row',
			array(
				'label'     => esc_html__( 'Row Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} thead .plus-table-row:hover > th' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .plus-table tbody .plus-table-row:hover > th' => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'header_cell_hover_color',
			array(
				'label'     => esc_html__( 'Cell Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} thead th.plus-table-col:hover .plus-table__text' => 'color: {{VALUE}};',
					'{{WRAPPER}} tbody .plus-table-row th.plus-table-col:hover .plus-table__text' => 'color: {{VALUE}};',
					'{{WRAPPER}} tr.plus-table-row th.plus-table-col:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'header_cell_hover_background',
			array(
				'label'     => esc_html__( 'Cell Hover Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} thead .plus-table-row th.plus-table-col:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .plus-table tbody .plus-table-row:hover >  th.plus-table-col:hover' => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_table_mobile_res_style',
			array(
				'label'     => esc_html__( 'Header Mobile Responsive Style', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'mobile_responsive_table' => 'one-by-one',
				),
			)
		);
		$this->add_control(
			'mob_cell_align_head',
			array(
				'label'     => esc_html__( 'Text Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => '',
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
				'selectors' => array(
					'{{WRAPPER}} .plus-table-mob-res span.plus-table-mob-row' => 'text-align: {{VALUE}};width: 100%;',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'mob_header_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .plus-table-mob-res span.plus-table-mob-row',
			)
		);
		$this->add_responsive_control(
			'mob_cell_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '15',
					'bottom'   => '15',
					'left'     => '15',
					'right'    => '15',
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-table-mob-res span.plus-table-mob-row,{{WRAPPER}} .plus-table-mob-res .plus-table-mob-wrap span.plus-table__text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_control(
			'mob_cell_head_width',
			array(
				'label'      => esc_html__( 'Heading Cell Width', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 50,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 120,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-table.plus-table-mob-res .plus-table-mob-wrap span.plus-table-mob-row' => '-webkit-flex-basis: {{SIZE}}{{UNIT}};-ms-flex-preferred-size: {{SIZE}}{{UNIT}};flex-basis: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_mob_head_colors_row' );
		$this->start_controls_tab(
			'tab_mob_head_colors_row',
			array(
				'label' => esc_html__( 'Normal', 'tpebl' ),
			)
		);
		$this->add_control(
			'mob_head_cell_color_row',
			array(
				'label'     => esc_html__( 'Heading Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => Global_Colors::COLOR_TEXT,
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-table-mob-res span.plus-table-mob-row' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'mob_head_cell_background_row',
			array(
				'label'     => esc_html__( 'Heading Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-table-mob-res span.plus-table-mob-row' => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'mob_cell_border_width',
			array(
				'label'          => esc_html__( 'Border Width', 'tpebl' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => array( 'px' ),
				'range'          => array(
					'px' => array(
						'min'  => 0,
						'max'  => 20,
						'step' => 1,
					),
				),
				'mobile_default' => array(
					'size' => 1,
					'unit' => 'px',
				),
				'devices'        => array( 'mobile' ),
				'selectors'      => array(
					'{{WRAPPER}} .plus-table.plus-table-mob-res tbody tr td.plus-table-col' => 'border-bottom-width: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .plus-table-mob-wrap span.plus-table-mob-row' => 'border-right-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus-table.plus-table-mob-res tbody  tr.plus-table-row' => 'border-width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'mob_cell_border_color',
			array(
				'label'     => esc_html__( 'Cell Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'devices'   => array( 'mobile' ),
				'selectors' => array(
					'{{WRAPPER}} .plus-table.plus-table-mob-res tbody tr td.plus-table-col' => 'border-bottom-color: {{VALUE}} !important;',
					'{{WRAPPER}} .plus-table-mob-wrap span.plus-table-mob-row' => 'border-right-color: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'mob_row_border_color',
			array(
				'label'     => esc_html__( 'Row Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'devices'   => array( 'mobile' ),
				'selectors' => array(
					'{{WRAPPER}} .plus-table.plus-table-mob-res tbody  tr.plus-table-row' => 'border-color: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'mob_row_space',
			array(
				'label'          => esc_html__( 'Row Space', 'tpebl' ),
				'type'           => Controls_Manager::SLIDER,
				'size_units'     => array( 'px' ),
				'range'          => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'mobile_default' => array(
					'size' => 8,
					'unit' => 'px',
				),
				'devices'        => array( 'mobile' ),
				'selectors'      => array(
					'{{WRAPPER}} .plus-table.plus-table-mob-res tbody  tr.plus-table-row' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .plus-table.plus-table-mob-res tbody  tr.plus-table-row:last-child' => 'margin-bottom: 0px;',
				),
			)
		);
		$this->add_responsive_control(
			'mob_row_border_radius',
			array(
				'label'      => esc_html__( 'Row Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'devices'    => array( 'mobile' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-table.plus-table-mob-res tbody  tr.plus-table-row' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_mob_head_hover_colors_row',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'mob_head_cell_hover_color_row',
			array(
				'label'     => esc_html__( 'Heading Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-table-mob-res span.plus-table-mob-row:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'mob_head_cell_hover_background_row',
			array(
				'label'     => esc_html__( 'Heading Hover Background', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-table-mob-res span.plus-table-mob-row:hover' => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_table_body_style',
			array(
				'label' => esc_html__( 'Table Body', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'cell_align',
			array(
				'label'     => esc_html__( 'Text Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => '',
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
				'selectors' => array(
					'{{WRAPPER}} td .plus-table__text,{{WRAPPER}} td' => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'cell_valign',
			array(
				'label'     => esc_html__( 'Vertical Alignment', 'tpebl' ),
				'type'      => Controls_Manager::CHOOSE,
				'default'   => 'middle',
				'options'   => array(
					'top'    => array(
						'title' => esc_html__( 'Top', 'tpebl' ),
						'icon'  => 'eicon-v-align-top',
					),
					'middle' => array(
						'title' => esc_html__( 'Middle', 'tpebl' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'bottom' => array(
						'title' => esc_html__( 'Bottom', 'tpebl' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-table-row .plus-table-col' => 'vertical-align: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'cell_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} td .plus-table__text-inner,{{WRAPPER}} td .plus-align-icon--left,{{WRAPPER}} td .plus-align-icon--right,
				{{WRAPPER}} td',
			)
		);
		$this->add_responsive_control(
			'cell_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '15',
					'bottom'   => '15',
					'left'     => '15',
					'right'    => '15',
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} td.plus-table-col' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_cell_colors' );
		$this->start_controls_tab( 'tab_cell_colors', array( 'label' => esc_html__( 'Normal', 'tpebl' ) ) );
		$this->add_control(
			'cell_color',
			array(
				'label'     => esc_html__( 'Row Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => Global_Colors::COLOR_TEXT,
				),
				'selectors' => array(
					'{{WRAPPER}} tbody td.plus-table-col .plus-table__text,{{WRAPPER}} tbody td.plus-table-col' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'striped_effect_feature',
			array(
				'label'        => esc_html__( 'Stripped Effect', 'tpebl' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'YES', 'tpebl' ),
				'label_off'    => esc_html__( 'NO', 'tpebl' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->add_control(
			'striped_effect_odd',
			array(
				'label'     => esc_html__( 'Stripe Rows Color 1', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#eaeaea',
				'selectors' => array(
					'{{WRAPPER}} tbody tr:nth-child(odd)' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'striped_effect_feature' => 'yes',
				),
			)
		);
		$this->add_control(
			'striped_effect_even',
			array(
				'label'     => esc_html__( 'Stripe Rows Color 2', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} tbody tr:nth-child(even)' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'striped_effect_feature' => 'yes',
				),
			)
		);
		$this->add_control(
			'cell_background',
			array(
				'label'     => esc_html__( 'Row Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} tbody .plus-table-row' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'striped_effect_feature!' => 'yes',
				),
			)
		);
		$this->add_control(
			'body_border_styling',
			array(
				'label'        => esc_html__( 'Apply Border To', 'tpebl' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'CELL', 'tpebl' ),
				'label_off'    => esc_html__( 'ROW', 'tpebl' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'           => 'row_border',
				'label'          => esc_html__( 'Border', 'tpebl' ),
				'selector'       => '{{WRAPPER}} tbody .plus-table-row',
				'fields_options' => array(
					'border' => array(
						'default' => 'solid',
					),
					'width'  => array(
						'default' => array(
							'top'      => '1',
							'right'    => '1',
							'bottom'   => '1',
							'left'     => '1',
							'isLinked' => true,
						),
					),
					'color'  => array(
						'default' => '#bbb',
					),
				),
				'condition'      => array(
					'body_border_styling!' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'           => 'cell_border_body',
				'label'          => esc_html__( 'Cell Border', 'tpebl' ),
				'selector'       => '{{WRAPPER}} td.plus-table-col',
				'fields_options' => array(
					'border' => array(
						'default' => 'solid',
					),
					'width'  => array(
						'default' => array(
							'top'      => '1',
							'right'    => '1',
							'bottom'   => '1',
							'left'     => '1',
							'isLinked' => true,
						),
					),
					'color'  => array(
						'default' => '#bbb',
					),
				),
				'condition'      => array(
					'body_border_styling' => 'yes',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_cell_hover_colors',
			array(
				'label' => esc_html__( 'Hover', 'tpebl' ),
			)
		);
		$this->add_control(
			'row_hover_color',
			array(
				'label'     => esc_html__( 'Row Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} tbody .plus-table-row:hover td.plus-table-col .plus-table__text,
					{{WRAPPER}} tbody .plus-table-row:hover td.plus-table-col' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'row_hover_background',
			array(
				'label'     => esc_html__( 'Row Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} tbody .plus-table-row:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} tbody .plus-table-row:hover > .plus-table-col:hover' => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'cell_hover_color',
			array(
				'label'     => esc_html__( 'Cell Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-table tbody td.plus-table-col:hover .plus-table__text,
					{{WRAPPER}} .plus-table tbody td.plus-table-col:hover' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'cell_hover_background',
			array(
				'label'     => esc_html__( 'Cell Hover Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-table tbody .plus-table-row:hover > td.plus-table-col:hover' => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->add_control(
			'tbody_button_heading',
			array(
				'label'     => esc_html__( 'Button', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => esc_html__( 'Button Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'default'    => array(
					'top'      => '15',
					'right'    => '30',
					'bottom'   => '15',
					'left'     => '30',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-table-col .pt_plus_button .button-link-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_responsive_control(
			'button_width',
			array(
				'label'          => esc_html__( 'Button Width', 'tpebl' ),
				'type'           => Controls_Manager::SLIDER,
				'range'          => array(
					'px' => array(
						'min'  => 0,
						'max'  => 300,
						'step' => 2,
					),
				),
				/** 'devices' => [ 'tablet', 'mobile' ],*/
				'tablet_default' => array(
					'size' => 120,
					'unit' => 'px',
				),
				'mobile_default' => array(
					'size' => 120,
					'unit' => 'px',
				),
				'selectors'      => array(
					'{{WRAPPER}} .plus-table-col .pt_plus_button .button-link-wrap' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'      => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'button_typography',
				'selector'  => '{{WRAPPER}} .plus-table-col .pt_plus_button .button-link-wrap',
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->start_controls_tabs( 'tabs_button_style' );
		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label'     => esc_html__( 'Normal', 'tpebl' ),
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_control(
			'btn_text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'button_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap',
				'separator' => 'after',
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_control(
			'button_border_style',
			array(
				'label'     => esc_html__( 'Border Style', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'solid',
				'options'   => array(
					'none'   => esc_html__( 'None', 'tpebl' ),
					'solid'  => esc_html__( 'Solid', 'tpebl' ),
					'dotted' => esc_html__( 'Dotted', 'tpebl' ),
					'dashed' => esc_html__( 'Dashed', 'tpebl' ),
					'groove' => esc_html__( 'Groove', 'tpebl' ),
				),
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-style: {{VALUE}};',
				),
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_responsive_control(
			'button_border_width',
			array(
				'label'      => esc_html__( 'Border Width', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'top'    => 1,
					'right'  => 1,
					'bottom' => 1,
					'left'   => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_control(
			'button_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-color: {{VALUE}};',
				),
				'separator' => 'after',
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_responsive_control(
			'button_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_shadow',
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap',
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label'     => esc_html__( 'Hover', 'tpebl' ),
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_control(
			'btn_text_hover_color',
			array(
				'label'     => esc_html__( 'Text Hover Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button .button-link-wrap:hover' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'button_hover_background',
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover',
				'separator' => 'after',
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_control(
			'button_border_hover_color',
			array(
				'label'     => esc_html__( 'Hover Border Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#313131',
				'selectors' => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover' => 'border-color: {{VALUE}};',
				),
				'separator' => 'after',
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_responsive_control(
			'button_hover_radius',
			array(
				'label'      => esc_html__( 'Hover Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_hover_shadow',
				'selector'  => '{{WRAPPER}} .pt_plus_button.button-style-8 .button-link-wrap:hover',
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_image_style',
			array(
				'label'     => esc_html__( 'Icon / Image Options', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_control(
			'icon_styling_heading',
			array(
				'label'     => esc_html__( 'Icon', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_control(
			'all_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-align-icon--left i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .plus-align-icon--right i' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_responsive_control(
			'all_icon_size',
			array(
				'label'     => esc_html__( 'Icon Size', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 30,
				),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					// Item.
					'{{WRAPPER}} .plus-align-icon--left i' => 'font-size: {{SIZE}}px;    vertical-align: middle;',
					'{{WRAPPER}} .plus-align-icon--right i' => 'font-size: {{SIZE}}px;vertical-align: middle;',
				),
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_control(
			'all_icon_align',
			array(
				'label'     => esc_html__( 'Icon Position', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'  => esc_html__( 'Before', 'tpebl' ),
					'right' => esc_html__( 'After', 'tpebl' ),
				),
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_responsive_control(
			'all_icon_indent',
			array(
				'label'     => esc_html__( 'Icon Spacing', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 10,
				),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .plus-align-icon--left'  => 'margin-right: {{SIZE}}px;',
					'{{WRAPPER}} .plus-align-icon--right' => 'margin-left: {{SIZE}}px;',
				),
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_control(
			'image_styling_heading',
			array(
				'label'     => esc_html__( 'Image', 'tpebl' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_responsive_control(
			'all_image_size',
			array(
				'label'      => esc_html__( 'Image Size', 'tpebl' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 30,
				),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 500,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-col-img--left'  => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .plus-col-img--right' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_control(
			'all_image_align',
			array(
				'label'     => esc_html__( 'Image Position', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'  => esc_html__( 'Before', 'tpebl' ),
					'right' => esc_html__( 'After', 'tpebl' ),
				),
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_responsive_control(
			'all_image_indent',
			array(
				'label'     => esc_html__( 'Image Spacing', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 10,
				),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					// Item.
					'{{WRAPPER}} .plus-col-img--left'  => 'margin-right: {{SIZE}}px;',
					'{{WRAPPER}} .plus-col-img--right' => 'margin-left: {{SIZE}}px;',
				),
				'condition' => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->add_responsive_control(
			'all_image_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-col-img--left'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .plus-col-img--right' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'table_selection!' => 'csv_file',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_search_style',
			array(
				'label' => esc_html__( 'Search Bar / Show Entries', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'label_color',
			array(
				'label'     => esc_html__( 'Label Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-advance-heading label' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'input_color',
			array(
				'label'     => esc_html__( 'Input Value Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-advance-heading select, {{WRAPPER}} .plus-advance-heading input' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'label_typography',
				'label'    => esc_html__( 'Typography', 'tpebl' ),
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_TEXT,
				),
				'selector' => '{{WRAPPER}} .plus-advance-heading label, {{WRAPPER}} .plus-advance-heading select, {{WRAPPER}} .plus-advance-heading input',
			)
		);
		$this->add_control(
			'label_bg_color',
			array(
				'label'     => esc_html__( 'Input Background Color', 'tpebl' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .plus-advance-heading select, {{WRAPPER}} .plus-advance-heading input' => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'input_padding',
			array(
				'label'      => esc_html__( 'Input Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '10',
					'bottom'   => '10',
					'left'     => '10',
					'right'    => '10',
					'unit'     => 'px',
					'isLinked' => false,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-advance-heading select, {{WRAPPER}} .plus-advance-heading input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'           => 'input_border',
				'label'          => esc_html__( 'Input Border', 'tpebl' ),
				'fields_options' => array(
					'border' => array(
						'default' => 'solid',
					),
					'width'  => array(
						'default' => array(
							'top'      => '1',
							'right'    => '1',
							'bottom'   => '1',
							'left'     => '1',
							'isLinked' => true,
						),
					),
					'color'  => array(
						'default' => '#bbb',
					),
				),
				'selector'       => '{{WRAPPER}} .plus-advance-heading select, {{WRAPPER}} .plus-advance-heading input',
			)
		);
		$this->add_responsive_control(
			'input_border_radius',
			array(
				'label'      => esc_html__( 'Input Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px' ),
				'default'    => array(
					'top'      => '2',
					'bottom'   => '2',
					'left'     => '2',
					'right'    => '2',
					'unit'     => 'px',
					'isLinked' => true,
				),
				'selectors'  => array(
					'{{WRAPPER}} .plus-advance-heading select, {{WRAPPER}} .plus-advance-heading input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'search_input_size',
			array(
				'label'     => esc_html__( 'Search Bar Width', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 200,
				),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 400,
						'step' => 1,
					),
				),
				'devices'   => array( 'desktop', 'tablet', 'mobile' ),
				'selectors' => array(
					'{{WRAPPER}} .plus-advance-heading .plus-tbl-search-wrapper input' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_responsive_control(
			'entry_page_input_size',
			array(
				'label'     => esc_html__( 'Show Entries Width', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 200,
				),
				'range'     => array(
					'px' => array(
						'min'  => 1,
						'max'  => 400,
						'step' => 1,
					),
				),
				'devices'   => array( 'desktop', 'tablet', 'mobile' ),
				'selectors' => array(
					'{{WRAPPER}} .plus-advance-heading .plus-tbl-entry-wrapper select' => 'width: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->add_control(
			'bottom_spacing',
			array(
				'label'     => esc_html__( 'Bottom Space', 'tpebl' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 15,
					'unit' => 'px',
				),
				'selectors' => array(
					// Item.
					'{{WRAPPER}} .plus-advance-heading' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'ScrollBarTab',
			array(
				'label'     => esc_html__( 'Scroll Bar', 'tpebl' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'scrollbar' => 'yes',
				),
			)
		);
		$this->add_control(
			'ContentScroll',
			array(
				'label' => esc_html__( 'Content Scrolling Bar', 'tpebl' ),
				'type'  => Controls_Manager::HEADING,
			)
		);
		$this->start_controls_tabs( 'scrollC_style' );
		$this->start_controls_tab(
			'scrollC_Bar',
			array(
				'label' => esc_html__( 'Scrollbar', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'ScrollBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-table-wrapper::-webkit-scrollbar',
			)
		);
		$this->add_responsive_control(
			'ScrollWidth',
			array(
				'type'        => Controls_Manager::SLIDER,
				'label'       => esc_html__( 'Width', 'tpebl' ),
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
					'{{WRAPPER}} .plus-table-wrapper::-webkit-scrollbar' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'scrollC_Tmb',
			array(
				'label' => esc_html__( 'Thumb', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'ThumbBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-table-wrapper::-webkit-scrollbar-thumb',
			)
		);
		$this->add_responsive_control(
			'ThumbBrs',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-table-wrapper::-webkit-scrollbar-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'ThumbBsw',
				'selector' => '{{WRAPPER}} .plus-table-wrapper::-webkit-scrollbar-thumb',
			)
		);
		$this->end_controls_tab();
		$this->start_controls_tab(
			'scrollC_Trk',
			array(
				'label' => esc_html__( 'Track', 'tpebl' ),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'TrackBg',
				'types'    => array( 'classic', 'gradient' ),
				'selector' => '{{WRAPPER}} .plus-table-wrapper::-webkit-scrollbar-track',
			)
		);
		$this->add_responsive_control(
			'TrackBRs',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-table-wrapper::-webkit-scrollbar-track' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'TrackBsw',
				'selector' => '{{WRAPPER}} .plus-table-wrapper::-webkit-scrollbar-track',
			)
		);
		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_table_option_styling',
			array(
				'label' => esc_html__( 'Table Option', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'tos_margin',
			array(
				'label'      => esc_html__( 'Margin', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-table-wrapper .dataTables_wrapper,{{wrapper}} .plus-table-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_responsive_control(
			'tos_padding',
			array(
				'label'      => esc_html__( 'Padding', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-table-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'tos_background',
				'label'     => esc_html__( 'Background', 'tpebl' ),
				'types'     => array( 'classic', 'gradient' ),
				'selector'  => '{{WRAPPER}} .plus-table-wrapper',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'tos_border_check',
			array(
				'label'     => esc_html__( 'Display Border', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'tos_border',
				'label'     => esc_html__( 'Border', 'tpebl' ),
				'selector'  => '{{WRAPPER}} .plus-table-wrapper',
				'condition' => array(
					'tos_border_check' => 'yes',
				),
			)
		);
		$this->add_responsive_control(
			'tos_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'tpebl' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .plus-table-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'tos_border_check' => 'yes',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'tos_box_shadow',
				'selector'  => '{{WRAPPER}} .plus-table-wrapper .plus-table',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'table_overflow',
			array(
				'label'     => esc_html__( 'Overflow', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_on'  => esc_html__( 'Show', 'tpebl' ),
				'label_off' => esc_html__( 'Hide', 'tpebl' ),
				'default'   => 'no',
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .plus-table-wrapper .plus-table' => 'overflow:visible;',
				),
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_animation_styling',
			array(
				'label' => esc_html__( 'On Scroll View Animation', 'tpebl' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'animation_effects',
			array(
				'label'   => esc_html__( 'In Animation Effect', 'tpebl' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no-animation',
				'options' => l_theplus_get_animation_options(),
			)
		);
		$this->add_control(
			'animation_delay',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Animation Delay', 'tpebl' ),
				'default'   => array(
					'unit' => '',
					'size' => 50,
				),
				'range'     => array(
					'' => array(
						'min'  => 0,
						'max'  => 4000,
						'step' => 15,
					),
				),
				'condition' => array(
					'animation_effects!' => 'no-animation',
				),
			)
		);
		$this->add_control(
			'animation_duration_default',
			array(
				'label'     => esc_html__( 'Animation Duration', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'animation_effects!' => 'no-animation',
				),
			)
		);
		$this->add_control(
			'animate_duration',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Duration Speed', 'tpebl' ),
				'default'   => array(
					'unit' => 'px',
					'size' => 50,
				),
				'range'     => array(
					'px' => array(
						'min'  => 100,
						'max'  => 10000,
						'step' => 100,
					),
				),
				'condition' => array(
					'animation_effects!'         => 'no-animation',
					'animation_duration_default' => 'yes',
				),
			)
		);
		$this->add_control(
			'animation_out_effects',
			array(
				'label'     => esc_html__( 'Out Animation Effect', 'tpebl' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'no-animation',
				'options'   => l_theplus_get_out_animation_options(),
				'separator' => 'before',
				'condition' => array(
					'animation_effects!' => 'no-animation',
				),
			)
		);
		$this->add_control(
			'animation_out_delay',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Out Animation Delay', 'tpebl' ),
				'default'   => array(
					'unit' => '',
					'size' => 50,
				),
				'range'     => array(
					'' => array(
						'min'  => 0,
						'max'  => 4000,
						'step' => 15,
					),
				),
				'condition' => array(
					'animation_effects!'     => 'no-animation',
					'animation_out_effects!' => 'no-animation',
				),
			)
		);
		$this->add_control(
			'animation_out_duration_default',
			array(
				'label'     => esc_html__( 'Out Animation Duration', 'tpebl' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'animation_effects!'     => 'no-animation',
					'animation_out_effects!' => 'no-animation',
				),
			)
		);
		$this->add_control(
			'animation_out_duration',
			array(
				'type'      => Controls_Manager::SLIDER,
				'label'     => esc_html__( 'Duration Speed', 'tpebl' ),
				'default'   => array(
					'unit' => 'px',
					'size' => 50,
				),
				'range'     => array(
					'px' => array(
						'min'  => 100,
						'max'  => 10000,
						'step' => 100,
					),
				),
				'condition' => array(
					'animation_effects!'             => 'no-animation',
					'animation_out_effects!'         => 'no-animation',
					'animation_out_duration_default' => 'yes',
				),
			)
		);
		$this->end_controls_section();
	}

	/**
	 * Render Table
	 *
	 * @since 1.4.0
	 * @version 5.4.2
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$widget_id      = $this->get_id();
		$is_editor_mode = \Elementor\Plugin::instance()->editor->is_edit_mode();

		$sortable    = ! empty( $settings['sortable'] ) ? $settings['sortable'] : '';
		$searchable  = ! empty( $settings['searchable'] ) ? $settings['searchable'] : '';
		$mResponsive = ! empty( $settings['mobile_responsive_table'] ) ? $settings['mobile_responsive_table'] : 'default';
		$showEntries = ! empty( $settings['show_entries'] ) ? $settings['show_entries'] : '';

		$tableSelection  = ! empty( $settings['table_selection'] ) ? $settings['table_selection'] : '';
		$searchableLabel = ! empty( $settings['searchable_label'] ) ? $settings['searchable_label'] : '';

		$cell_align_head_desktop = ! empty( $settings['cell_align_head_normal'] ) ? $settings['cell_align_head_normal'] : '';
		$cell_align_head_tablet  = ! empty( $settings['cell_align_head_normal_tablet'] ) ? $settings['cell_align_head_normal_tablet'] : '';
		$cell_align_head_mobile  = ! empty( $settings['cell_align_head_normal_mobile'] ) ? $settings['cell_align_head_normal_mobile'] : '';

		$tmdefaultclass = '';
		if ( 'default' === $mResponsive ) {
			$tmdefaultclass = ' tp-table-mobresswipe';
		}

		ob_start();

		// Table Wrapper.
		$this->add_render_attribute( 'plus_table_wrapper', 'class', 'plus-table-wrapper' . esc_attr( $tmdefaultclass ) );

		if ( ! empty( $animation_attr ) ) {
			$this->add_render_attribute( 'plus_table_wrapper', $animation_attr );
		}

		$this->add_render_attribute( 'plus_table_wrapper', 'itemtype', 'http://schema.org/Table' );

		$this->add_render_attribute( 'plus_table_id', 'id', 'plus-table-id-' . $widget_id );
		$this->add_render_attribute( 'plus_table_id', 'class', 'plus-table' );
		$this->add_render_attribute( 'plus_table_id', 'class', 'plus-text-break' );
		$this->add_render_attribute( 'plus_table_id', 'class', 'plus-column-rules' );

		if ( 'one-by-one' === $mResponsive ) {
			$this->add_render_attribute( 'plus_table_id', 'class', 'plus-table-mob-res' );
		}

		// <Tr> (Row).
		$this->add_render_attribute( 'plus_table_row', 'class', 'plus-table-row' );

		// Text span.
		$this->add_render_attribute( 'plus_table__text', 'class', 'plus-table__text' );

		// Table Sortable.
		if ( 'yes' === $sortable ) {
			$this->add_render_attribute( 'plus_table_id', 'data-sort-table', $sortable );
		} else {
			$this->add_render_attribute( 'plus_table_id', 'data-sort-table', 'no' );
		}

		// Table Show entries.
		if ( 'yes' === $showEntries ) {
			$this->add_render_attribute( 'plus_table_id', 'data-show-entry', $showEntries );
		} else {
			$this->add_render_attribute( 'plus_table_id', 'data-show-entry', 'no' );
		}

		// Table Searchable.
		if ( 'yes' === $searchable ) {
			$this->add_render_attribute( 'plus_table_id', 'data-searchable', $searchable );
			$this->add_render_attribute( 'plus_table_id', 'data-searchable-label', $searchableLabel );
		} else {
			$this->add_render_attribute( 'plus_table_id', 'data-searchable', 'no' );
		}

		// Table CSV File.
		?>
			<div itemscope <?php echo $this->get_render_attribute_string( 'plus_table_wrapper' ); ?>>

				<table <?php echo $this->get_render_attribute_string( 'plus_table_id' ); ?>>
					<?php
					$first_row_th   = true;
					$cell_col_count = 0;
					$counter_row    = 1;
					$inline_count   = 0;
					$row_count_tb   = count( (array) $settings['table_headings'] );
					$data_entry_col = 0;
					$header_text    = array();

					if ( $row_count_tb > 1 ) {
						?>
						<thead> 
						<?php
						if ( $settings['table_headings'] ) {
							$headi = 0;
							foreach ( $settings['table_headings'] as $index => $head ) {

								// Header text prepview editing.
								$repeater_heading_text = $this->get_repeater_setting_key( 'heading_text', 'table_headings', $inline_count );
								$this->add_render_attribute( $repeater_heading_text, 'class', 'plus-table__text-inner' );
								$this->add_inline_editing_attributes( $repeater_heading_text );

								// TH.
								if ( true === $first_row_th ) {
									$this->add_render_attribute( 'current_' . $head['_id'], 'data-sort', $cell_col_count );
								}

								$this->add_render_attribute( 'current_' . $head['_id'], 'class', 'sort-this' );
								$this->add_render_attribute( 'current_' . $head['_id'], 'class', 'elementor-repeater-item-' . $head['_id'] );
								$this->add_render_attribute( 'current_' . $head['_id'], 'class', 'plus-table-col' );

								if ( 1 < $head['heading_col_span'] ) {
									$this->add_render_attribute( 'current_' . $head['_id'], 'colspan', $head['heading_col_span'] );
								}
								if ( 1 < $head['heading_row_span'] ) {
									$this->add_render_attribute( 'current_' . $head['_id'], 'rowspan', $head['heading_row_span'] );
								}

								// Sort Icon.
								if ( 'yes' === $settings['sortable'] && true === $first_row_th ) {
									$this->add_render_attribute( 'icon_sort_' . $head['_id'], 'class', 'plus-sort-icon' );
								}

								if ( ! empty( $head['icons_image']['url'] ) ) {
									$icons_image = $head['icons_image']['id'];
									$img         = wp_get_attachment_image_src( $icons_image, $head['icons_image_thumbnail_size'] );

									$icons_image_Src = $img[0];
									$this->add_render_attribute( 'plus_head_col_img' . $head['_id'], 'src', $icons_image_Src );
									$this->add_render_attribute( 'plus_head_col_img' . $head['_id'], 'class', 'plus-col-img--' . $settings['all_image_align'] );
									$this->add_render_attribute( 'plus_head_col_img' . $head['_id'], 'title', get_the_title( $head['icons_image']['id'] ) );
									$this->add_render_attribute( 'plus_head_col_img' . $head['_id'], 'alt', get_the_title( $head['icons_image']['id'] ) );
								}

								// ICON.
								if ( 'icon' === $head['header_content_icon_image'] && 'font_awesome' === $head['icon_font_style'] ) {
									$this->add_render_attribute( 'plus_heading_icon' . $head['_id'], 'class', $head['icon_fontawesome'] );
								}

								$this->add_render_attribute( 'plus_heading_icon_align' . $head['_id'], 'class', 'plus-align-icon--' . $settings['all_icon_align'] );

								// tooltip.
								$_tooltip = '_tooltip_' . $headi;

								$uniqid = uniqid( 'tooltip' );

								$toolbox    = '';
								$toolicon   = '';
								$tt_on_icon = '';
								if ( ! empty( $show_tooltips_on ) && 'icon' === $show_tooltips_on ) {
									$toolbox  = $this->get_render_attribute_string( 'current_' . $head['_id'] );
									$toolicon = 'id="' . esc_attr( $uniqid ) . '" class="plus-icon-list-item elementor-repeater-item-' . esc_attr( $head['_id'] ) . '" data-local="true" ' . $this->get_render_attribute_string( $_tooltip ) . '';

									ob_start();
									\Elementor\Icons_Manager::render_icon( $settings['tt_on_icon'], array( 'aria-hidden' => 'true' ) );
									$tt_on_icon = ob_get_contents();
									ob_end_clean();

								} else {
									$toolbox = 'id="' . esc_attr( $uniqid ) . '"' . $this->get_render_attribute_string( 'current_' . $head['_id'] ) . ' data-local="true" ' . $this->get_render_attribute_string( $_tooltip ) . '';
								}

								if ( 'cell' === $head['header_content_type'] ) {
									?>
										<th <?php echo $toolbox; ?> scope="col">
											<span class="sort-style">
											<span <?php echo $this->get_render_attribute_string( 'plus_table__text' ); ?>>
											<?php
											if ( 'icon' === $head['header_content_icon_image'] ) {
												if ( 'left' === $settings['all_icon_align'] ) {
													?>
														<span <?php echo $this->get_render_attribute_string( 'plus_heading_icon_align' . $head['_id'] ); ?>>
															<i <?php echo $this->get_render_attribute_string( 'plus_heading_icon' . $head['_id'] ); ?>></i>
														</span> 
														<?php
												}
											} elseif ( ! empty( $head['icons_image']['url'] ) ) {
												if ( 'left' === $settings['all_image_align'] ) {
													?>
															<img <?php echo $this->get_render_attribute_string( 'plus_head_col_img' . $head['_id'] ); ?>>
														<?php
												}
											}
											?>
												<span <?php echo $this->get_render_attribute_string( $repeater_heading_text ); ?>><?php echo $head['heading_text']; ?></span>
											<?php
											if ( 'icon' === $head['header_content_icon_image'] ) {
												if ( 'right' === $settings['all_icon_align'] ) {
													?>
													<span <?php echo $this->get_render_attribute_string( 'plus_heading_icon_align' . $head['_id'] ); ?>>
														<i <?php echo $this->get_render_attribute_string( 'plus_heading_icon' . $head['_id'] ); ?>></i>
													</span> 
													<?php
												}
											} elseif ( ! empty( $head['icons_image']['url'] ) ) {
												if ( 'right' === $settings['all_image_align'] ) {
													?>
															<img <?php echo $this->get_render_attribute_string( 'plus_head_col_img' . $head['_id'] ); ?>>
														<?php
												}
											}
											?>
											</span> 
											
											<?php
											if ( 'yes' === $settings['sortable'] && true === $first_row_th ) {
												?>
												<span <?php echo $this->get_render_attribute_string( 'icon_sort_' . $head['_id'] ); ?>></span>
											<?php } ?>
											</span>
										</th>
										<?php
										$inline_tippy_js = '';

										$header_text[ $cell_col_count ]['heading_text']            = $head['heading_text'];
										$header_text[ $cell_col_count ]['icon_image']              = $head['header_content_icon_image'];
										$header_text[ $cell_col_count ]['plus_heading_icon_align'] = 'plus_heading_icon_align' . $head['_id'];
										$header_text[ $cell_col_count ]['plus_heading_icon']       = 'plus_heading_icon' . $head['_id'];
										$header_text[ $cell_col_count ]['icons_image_url']         = ! empty( $head['icons_image']['url'] ) ? esc_url( $head['icons_image']['url'] ) : '';
										$header_text[ $cell_col_count ]['plus_head_col_img']       = 'plus_head_col_img' . $head['_id'];
										++$cell_col_count;
								} else {
									if ( $counter_row > 1 && $counter_row < $row_count_tb ) {
										?>
										</tr><tr <?php echo $this->get_render_attribute_string( 'plus_table_row' ); ?>> 
										<?php
										$first_row_th = false;
									} elseif ( 1 === $counter_row && false === $this->table_first_row() ) {
										?>
										<tr <?php echo $this->get_render_attribute_string( 'plus_table_row' ); ?>> 
														<?php
									}

									$cell_col_count = 0;
								}

								++$headi;
								++$counter_row;
								++$inline_count;
							}
						}
						?>
						</thead> 
						<?php
					}
					?>

						<tbody>
							<!-- ROWS -->
							<?php
							$cell_counter_c    = 0;
							$counter           = 1;
							$cell_inline_count = 0;

							$row_count         = count( (array) $settings['table_content'] );
							$attr_id           = 'cell';
							$ij                = 0;

							if ( $settings['table_content'] ) {
								$rowi = 0;
								foreach ( $settings['table_content'] as $index => $row ) {
									// Cell text inline classes.
									++$ij;

									$repeater_cell_text = $this->get_repeater_setting_key( 'cell_text', 'table_content', $cell_inline_count );
									$this->add_render_attribute( $repeater_cell_text, 'class', 'plus-table__text-inner' );
									$this->add_inline_editing_attributes( $repeater_cell_text );
									$this->add_render_attribute( 'plus_cell_icon_align' . $row['_id'], 'class', 'plus-align-icon--' . $settings['all_icon_align'] );

									$button = '';
									if ( ! empty( $row['cell_display_button'] ) && 'yes' === $row['cell_display_button'] ) {
										$link_key = 'link_' . $ij;
										if ( ! empty( $row['cell_button_link']['url'] ) ) {
											$this->add_render_attribute( $link_key, 'href', esc_url($row['cell_button_link']['url']) );
											if ( $row['cell_button_link']['is_external'] ) {
												$this->add_render_attribute( $link_key, 'target', '_blank' );
											}
											if ( $row['cell_button_link']['nofollow'] ) {
												$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
											}
										}
										$this->add_render_attribute( $link_key, 'class', 'button-link-wrap' );
										$this->add_render_attribute( $link_key, 'role', 'button' );

										/*button attributes start*/
										$button_custom_attributes = $row['button_custom_attributes'];
										$custom_attributes        = tp_senitize_js_input ($row['custom_attributes']);

										$cst_att = '';
										if ( ( ! empty( $button_custom_attributes ) && 'yes' === $button_custom_attributes ) && ! empty( $custom_attributes ) ) {
											$cst_att = $custom_attributes;
										}
										/*button attributes end*/

										$button_style = $row['cell_button_style'];
										$button_text  = $row['cell_button_text'];
										$btn_uid      = uniqid( 'btn' );
										$data_class   = $btn_uid;
										$data_class  .= ' button-' . esc_attr( $button_style ) . ' ';
										$button      .= '<div class="pt_plus_button ' . esc_attr( $data_class ) . '">';

											$button .= '<a ' . $this->get_render_attribute_string( $link_key ) . ' ' . $cst_att . ' >';
											$button .= esc_html( $button_text );
											$button .= '</a>';

										$button .= '</div>';
									}

									if ( 'icon' === $row['cell_content_icon_image'] && 'font_awesome' === $row['icon_font_style'] ) {
										$this->add_render_attribute( 'plus_cell_icon' . $row['_id'], 'class', $row['cell_icon'] );
									} elseif ( 'icon' === $row['cell_content_icon_image'] && 'icon_mind' === $row['icon_font_style'] ) {
										$this->add_render_attribute( 'plus_cell_icon' . $row['_id'], 'class', $row['cell_icons_mind'] );
									}

									$this->add_render_attribute( 'plus_table_col' . $row['_id'], 'class', 'plus-table-col' );
									$this->add_render_attribute( 'plus_table_col' . $row['_id'], 'class', 'elementor-repeater-item-' . $row['_id'] );

									if ( 1 < $row['cell_span'] ) {
										$this->add_render_attribute( 'plus_table_col' . $row['_id'], 'colspan', $row['cell_span'] );
									}
									if ( 1 < $row['cell_row_span'] ) {
										$this->add_render_attribute( 'plus_table_col' . $row['_id'], 'rowspan', $row['cell_row_span'] );
									}

									if ( ! empty( $row['image']['url'] ) ) {
										$image = $row['image']['id'];
										$img   = wp_get_attachment_image_src( $image, $row['image_thumbnail_size'] );

										$image_Src = $img[0];

										$this->add_render_attribute( 'plus_col_img' . $row['_id'], 'src', $image_Src );
										$this->add_render_attribute( 'plus_col_img' . $row['_id'], 'class', 'plus-col-img--' . $settings['all_image_align'] );
										$this->add_render_attribute( 'plus_col_img' . $row['_id'], 'title', get_the_title( $row['image']['id'] ) );
										$this->add_render_attribute( 'plus_col_img' . $row['_id'], 'alt', get_the_title( $row['image']['id'] ) );
									}

									if ( ! empty( $row['link']['url'] ) ) {
										$this->add_render_attribute( 'col-link-' . $row['_id'], 'href', esc_url($row['link']['url']) );
										if ( $row['link']['is_external'] ) {
											$this->add_render_attribute( 'col-link-' . $row['_id'], 'target', '_blank' );
										}
										if ( $row['link']['nofollow'] ) {
											$this->add_render_attribute( 'col-link-' . $row['_id'], 'rel', 'nofollow' );
										}
										$this->add_render_attribute( 'col-link-' . $row['_id'], 'class', 'tb-col-link' );
									}

									if ( 'cell' === $row['content_type'] ) {
										// Fetch corresponding header cell text.
										if ( isset( $header_text[ $cell_counter_c ]['heading_text'] ) && $header_text[ $cell_counter_c ]['heading_text'] ) {
											$this->add_render_attribute( 'plus_table_col' . $row['_id'], 'data-title', $header_text[ $cell_counter_c ]['heading_text'] );
										}

										// tooltip.
										$_tooltip = '_tooltip_' . $rowi;

										$uniqid = uniqid( 'tooltip' );

										$show_tooltips_on = ! empty( $row['body_show_tooltips_on'] ) ? $row['body_show_tooltips_on'] : 'box';

										$toolbox    = '';
										$toolicon   = '';
										$tt_on_icon = '';
										if ( ! empty( $show_tooltips_on ) && 'icon' === $show_tooltips_on ) {
											$toolbox  = $this->get_render_attribute_string( 'plus_table_col' . $row['_id'] );
											$toolicon = 'id="' . esc_attr( $uniqid ) . '" ' . $this->get_render_attribute_string( 'plus_table_col' . $row['_id'] ) . ' data-local="true" ' . $this->get_render_attribute_string( $_tooltip ) . '';

											ob_start();
											\Elementor\Icons_Manager::render_icon( $settings['tt_on_icon'], array( 'aria-hidden' => 'true' ) );
											$tt_on_icon = ob_get_contents();
											ob_end_clean();

										} else {
											$toolbox = 'id="' . esc_attr( $uniqid ) . '"' . $this->get_render_attribute_string( 'plus_table_col' . $row['_id'] ) . $this->get_render_attribute_string( $_tooltip );
										}

										?>
										<<?php echo esc_attr( $row['table_th_td'] ); ?> <?php echo $toolbox; ?>>
											<?php if ( ! empty( $row['link']['url'] ) ) { ?>
											<a <?php echo $this->get_render_attribute_string( 'col-link-' . $row['_id'] ); ?>>
											<?php } ?>
												<?php if ( ! empty( $settings['mobile_responsive_table'] ) && 'one-by-one' === $settings['mobile_responsive_table'] ) { ?>
													<div class="plus-table-mob-wrap">
													<span class="plus-table-mob-row">
														<?php
														if ( 'icon' === $header_text[ $cell_counter_c ]['icon_image'] ) {
															if ( 'left' === $settings['all_icon_align'] ) {
																?>

																<span <?php echo $this->get_render_attribute_string( $header_text[ $cell_counter_c ]['plus_heading_icon_align'] ); ?>>
																	<i <?php echo $this->get_render_attribute_string( $header_text[ $cell_counter_c ]['plus_heading_icon'] ); ?>></i>
																</span> 
																<?php
															}
														} elseif ( $header_text[ $cell_counter_c ]['icons_image_url'] ) {
															if ( 'left' === $settings['all_image_align'] ) {
																?>
																	<img <?php echo $this->get_render_attribute_string( $header_text[ $cell_counter_c ]['plus_head_col_img'] ); ?>>
																	<?php
															}
														}

														if ( isset( $header_text[ $cell_counter_c ]['heading_text'] ) && $header_text[ $cell_counter_c ]['heading_text'] ) {
															echo '<span class="mob-heading-text">' . $header_text[ $cell_counter_c ]['heading_text'] . '</span>';
														}

														if ( 'icon' === $header_text[ $cell_counter_c ]['icon_image'] ) {
															if ( 'right' === $settings['all_icon_align'] ) {
																?>
															<span <?php echo $this->get_render_attribute_string( $header_text[ $cell_counter_c ]['plus_heading_icon_align'] ); ?>>
																<i <?php echo $this->get_render_attribute_string( $header_text[ $cell_counter_c ]['plus_heading_icon'] ); ?>></i>
															</span>
																<?php
															}
														} elseif ( $header_text[ $cell_counter_c ]['icons_image_url'] ) {
															if ( 'right' === $settings['all_image_align'] ) {
																?>
																	<img <?php echo $this->get_render_attribute_string( $header_text[ $cell_counter_c ]['plus_head_col_img'] ); ?>>
																	<?php
															}
														}
														?>
													</span> 
												<?php } ?>
													<span <?php echo $this->get_render_attribute_string( 'plus_table__text' ); ?>>
														<?php if ( 'icon' === $row['cell_content_icon_image'] ) { ?>
															
																<?php if ( 'left' === $settings['all_icon_align'] ) { ?>
															<span <?php echo $this->get_render_attribute_string( 'plus_cell_icon_align' . $row['_id'] ); ?>>
																<i <?php echo $this->get_render_attribute_string( 'plus_cell_icon' . $row['_id'] ); ?>></i>
															</span>
															<?php } ?>
															
														<?php } else { ?>
															<?php if ( ! empty( $row['image'] ) && ! empty( $row['image']['url'] ) ) { ?>
																<?php if ( 'left' === $settings['all_image_align'] ) { ?>
																<img <?php echo $this->get_render_attribute_string( 'plus_col_img' . $row['_id'] ); ?>>
															<?php } ?>
															<?php } ?>
														<?php } ?>
														<?php if ( ! empty( $row['cell_text'] ) ) { ?>
															<span <?php echo $this->get_render_attribute_string( $repeater_cell_text ); ?>><?php echo wp_kses_post($row['cell_text']); ?></span>
														<?php } ?>
														<?php if ( 'icon' === $row['cell_content_icon_image'] ) { ?>
															
																<?php if ( 'right' === $settings['all_icon_align'] ) { ?>
															<span <?php echo $this->get_render_attribute_string( 'plus_cell_icon_align' . $row['_id'] ); ?>>
																<i <?php echo $this->get_render_attribute_string( 'plus_cell_icon' . $row['_id'] ); ?>></i>
															</span>
															<?php } ?>
															
														<?php } else { ?>
															<?php if ( ! empty( $row['image']['url'] ) ) { ?>
																<?php if ( 'right' === $settings['all_image_align'] ) { ?>
																<img <?php echo $this->get_render_attribute_string( 'plus_col_img' . $row['_id'] ); ?>>
															<?php } ?>
															<?php } ?>
														<?php } ?>
														<?php echo $button; ?>
													</span>
												<?php if ( ! empty( $settings['mobile_responsive_table'] ) && 'one-by-one' === $settings['mobile_responsive_table'] ) { ?>
													</div>
													<?php
												}
												if ( ! empty( $show_tooltips_on ) && 'icon' === $show_tooltips_on ) {
													echo '<span class="tp-tooltip-on-icon" ' . $toolicon . '>' . $tt_on_icon . '</span>';
												}
												?>
											<?php if ( ! empty( $row['link']['url'] ) ) { ?>
											</a>
											<?php } ?>
										</<?php echo $row['table_th_td']; ?>>
											<?php
											// Increment to next cell.
											++$cell_counter_c;
									} else {
										if ( $counter > 1 && $counter < $row_count ) {
											// Break into new row.
											++$data_entry_col;
											?>
											</tr><tr data-entry="<?php echo esc_attr( $data_entry_col ); ?>" <?php echo $this->get_render_attribute_string( 'plus_table_row' ); ?>>
											<?php
										} elseif ( 1 === $counter && false === $this->table_first_row() ) {
											$data_entry_col = 1;
											?>
											<tr data-entry="<?php echo esc_attr( $data_entry_col ); ?>" <?php echo $this->get_render_attribute_string( 'plus_table_row' ); ?>>
											<?php
										}
										$cell_counter_c = 0;
									}
									++$rowi;
									++$counter;
									++$cell_inline_count;
								}
							}
							?>
						</tbody>
				</table>

			</div> 
			<?php


		$html = ob_get_clean();

		echo $html;

		$css_rule = '<style>';
		if ( ! empty( $cell_align_head_desktop ) ) {
			$css_rule .= '#plus-table-id-' . esc_attr( $widget_id ) . ' th,#plus-table-id-' . esc_attr( $widget_id ) . ' th .plus-table__text{ ';
			if ( 'left' === $cell_align_head_desktop ) {
				$css_rule .= 'margin:0 auto;text-align:left;margin-left:0;';
			}
			if ( 'center' === $cell_align_head_desktop ) {
				$css_rule .= 'margin:0 auto;text-align:center;';
			}
			if ( 'right' === $cell_align_head_desktop ) {
				$css_rule .= 'margin:0 auto;text-align:right;margin-right:0;';
			}
			$css_rule .= '}';
		}

		if ( ! empty( $cell_align_head_tablet ) ) {
			$css_rule .= '@media (max-width:1024px){#plus-table-id-' . esc_attr( $widget_id ) . ' th,#plus-table-id-' . esc_attr( $widget_id ) . ' th .plus-table__text{';

			if ( 'left' === $cell_align_head_tablet ) {
				$css_rule .= 'margin:0 auto;text-align:left;margin-left:0;';
			}
			if ( 'center' === $cell_align_head_tablet ) {
				$css_rule .= 'margin:0 auto;text-align:center;';
			}
			if ( 'right' === $cell_align_head_tablet ) {
				$css_rule .= 'margin:0 auto;text-align:right;margin-right:0;';
			}
			$css_rule .= '}}';
		}

		if ( ! empty( $cell_align_head_mobile ) ) {
			$css_rule .= '@media (max-width:767px){#plus-table-id-' . esc_attr( $widget_id ) . ' th,#plus-table-id-' . esc_attr( $widget_id ) . ' th .plus-table__text{';

			if ( 'left' === $cell_align_head_mobile ) {
				$css_rule .= 'margin:0 auto;text-align:left;margin-left:0;';
			}
			if ( 'center' === $cell_align_head_mobile ) {
				$css_rule .= 'margin:0 auto;text-align:center;';
			}
			if ( 'right' === $cell_align_head_mobile ) {
				$css_rule .= 'margin:0 auto;text-align:right;margin-right:0;';
			}
			$css_rule .= '}}';
		}

		$css_rule .= '</style>';

		echo $css_rule;
	}

	/**
	 * Function to identify if it is a table first row or not.
	 *
	 * If yes returns false no returns true.
	 *
	 * @since 1.4.0
	 * @version 5.4.2
	 * @access protected
	 */
	protected function table_first_row() {

		$settings = $this->get_settings_for_display();

		if ( 'row' === $settings['table_content'][0]['content_type'] ) {
			return false;
		}

		return true;
	}

	/**
	 * Function to It is use for call api
	 *
	 * If yes returns Array Data
	 *
	 * @since 1.4.0
	 * @version 5.4.2
	 */
	protected function tp_table_api( $a_p_i ) {
		$settings = $this->get_settings_for_display();
		$final    = array();

		$u_r_l      = wp_remote_get( $a_p_i );
		$statuscode = wp_remote_retrieve_response_code( $u_r_l );
		$getdataone = wp_remote_retrieve_body( $u_r_l );
		$statuscode = array( 'HTTP_CODE' => $statuscode );

		$response = json_decode( $getdataone, true );
		if ( is_array( $statuscode ) && is_array( $response ) ) {
			$final = array_merge( $statuscode, $response );
		}

		return $final;
	}
	
	/**
	 * Render content_template
	 *
	 * @since 1.4.0
	 * @version 5.4.2
	 */
	protected function content_template() {}
}
