<?php
namespace TheplusAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Background;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

$this->start_controls_section('tpebl_section_needhelp', 
    [
        'label' => esc_html__( 'Need Help ?', 'tpebl' ),
        'tab' => Controls_Manager::TAB_CONTENT,
    ]
);
$this->add_control('tpebl_help_raise_a_ticket',
    [
        'type' => Controls_Manager::RAW_HTML,
        'raw' => wp_kses_post( "<a class='tp-docs-link' href='https://wordpress.org/support/plugin/the-plus-addons-for-elementor-page-builder/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Raise a Ticket </a>" ),
    ]
);
$this->add_control('tpebl_help_read_documentation',
    [
        'type' => Controls_Manager::RAW_HTML,
        'raw' => wp_kses_post( "<a class='tp-docs-link' href='https://theplusaddons.com/docs?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=widget' target='_blank' rel='noopener noreferrer'> Read Documentation </a>" ),
    ]
);
$this->add_control('tpebl_help_watch_video_tutorials',
    [
        'type' => Controls_Manager::RAW_HTML,
        'raw' => wp_kses_post( "<a class='tp-docs-link' href='https://www.youtube.com/@posimyth?sub_confirmation=1' target='_blank'  rel='noopener noreferrer'> Watch Video Tutorials </a>" ),
    ]
);
$this->add_control('tpebl_help_suggest_feature',
    [
        'type' => Controls_Manager::RAW_HTML,
        'raw' => wp_kses_post( "<a class='tp-docs-link' href='https://roadmap.theplusaddons.com/boards/feature-request' target='_blank' rel='noopener noreferrer'> Suggest Feature </a>" ),
    ]
);
$this->add_control('tpebl_help_plugin_roadmap',
    [
        'type' => Controls_Manager::RAW_HTML,
        'raw' => wp_kses_post( "<a class='tp-docs-link' href='https://roadmap.theplusaddons.com/roadmap' target='_blank' rel='noopener noreferrer'> Plugin Roadmap </a>" ),
    ]
);
$this->add_control('tpebl_help_join_facebook_community',
    [
        'type' => Controls_Manager::RAW_HTML,
        'raw' => wp_kses_post( "<a class='tp-docs-link' href='https://www.facebook.com/groups/theplus4elementor' target='_blank' rel='noopener noreferrer'> Join Facebook Community </a>" ),
    ]
);
$this->add_control('tpebl_help_Didnt_work_bug_reports',
    [
        'type' => Controls_Manager::RAW_HTML,
        'raw' => wp_kses_post( "<a class='tp-docs-link' href='https://roadmap.theplusaddons.com/boards/bug-reports' target='_blank' rel='noopener noreferrer'> Didn't work like you wanted? Report Issue </a>" ),
    ]
);
$this->end_controls_section();
