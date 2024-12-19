<?php
namespace InstagramFeed\Integrations\Elementor;
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
if (!defined('ABSPATH')){
    exit; // Exit if accessed directly
}

class CTF_Elementor_Widget extends Widget_Base {

	public function get_name() {
        return 'ctf-widget';
    }
    public function get_title() {
        return esc_html__('Twitter Feed', 'instagram-feed');
    }
    public function get_icon() {
        return 'sb-elem-icon sb-elem-inactive sb-elem-twitter';
    }
    public function get_categories() {
        return array('smash-balloon');
    }
    public function get_script_depends() {
        return [
            'elementor-handler'
        ];
    }
}
