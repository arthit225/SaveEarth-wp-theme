<?php
/**
 * The file that defines the core plugin class
 *
 * @link    https://posimyth.com/
 * @since   1.0.0
 *
 * @package the-plus-addons-for-elementor-page-builder
 */

namespace TheplusAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Background;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$this->start_controls_section(
	'tpebl_section_profeatures',
	array(
		'label' => wp_kses_post( '<div class="tpae-prosec-text">Pro Features <img src="' . L_THEPLUS_ASSETS_URL . 'images/pro-features/crown.png">', 'tpebl' ),
	)
);
$this->add_control(
	'tpebl_offer_tag',
	array(
		'type' => Controls_Manager::RAW_HTML,
		'raw'  => wp_kses_post( "<div class='tpae-offer-tag'><span>BLACK FRIDAY SALE IS LIVE - UPTO 40% OFF</span></div>" ),
	)
);
$this->add_control(
	'tpebl_offer_sections',
	array(
		'type' => Controls_Manager::RAW_HTML,
		'raw'  => wp_kses_post( "<div class='tpae-offer-sections'><div class='tpae-diamond-image'></div><div class='tpae-offer-title'>Upgrade to <br>The Plus Addons for<br> Elementor Pro</div><div class='tpae-offer-description'>Go limitless with the premium version of The Plus Addons for Elementor to unlock  more features and create unique websites.</div><a class='tpae-upgrade-btn' href='https://theplusaddons.com/pricing/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=links' target='_blank' rel='noopener noreferrer'>Upgrade PRO</a><div class='tpae-btn-desc'>Limited Time Price Drop</div></div>" ),
	)
);
$this->add_control(
	'tpebl_features_points',
	array(
		'type' => Controls_Manager::RAW_HTML,
		'raw'  => wp_kses_post( '<div class="tpae-features-points"><img src="' . L_THEPLUS_ASSETS_URL . 'images/pro-features/tick-icon.png"> 120+ Elementor Widgets </div><div class="tpae-features-points"><img src="' . L_THEPLUS_ASSETS_URL . 'images/pro-features/tick-icon.png">1000+ Ready to Use Elementor Templates </div><div class="tpae-features-points"><img src="' . L_THEPLUS_ASSETS_URL . 'images/pro-features/tick-icon.png">Premium Support </div><div class="tpae-features-points"><img src="' . L_THEPLUS_ASSETS_URL . 'images/pro-features/tick-icon.png">Blog Post, WooCommerce & Popup Builder </div><div class="tpae-features-points"><img src="' . L_THEPLUS_ASSETS_URL . 'images/pro-features/tick-icon.png">Ajax Search & Grid Builder with 15+ Filters </div><div class="tpae-features-points"><img src="' . L_THEPLUS_ASSETS_URL . 'images/pro-features/tick-icon.png">Social Feed, Reviews & Embed </div><div class="tpae-features-points"><img src="' . L_THEPLUS_ASSETS_URL . 'images/pro-features/tick-icon.png">Header, Mobile & Mega Menu Builder </div>' ),
	)
);
$this->add_control(
	'view_all_features',
	array(
		'type' => Controls_Manager::RAW_HTML,
		'raw'  => wp_kses_post( '<div class="tpae-features-btn"> <a href="https://theplusaddons.com/free-vs-pro/?utm_source=wpbackend&utm_medium=elementoreditor&utm_campaign=links" class="tpae-feabtn-text" target="_blank" rel="noopener noreferrer"> View All Features </a></div>' ),
	)
);

$this->end_controls_section();
