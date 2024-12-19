<?php
namespace InstagramFeed\Integrations\Elementor;

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use InstagramFeed\Builder\SBI_Db;
use InstagramFeed\Builder\SBI_Feed_Builder;
use InstagramFeed\Integrations\SBI_Integration;

if (!defined('ABSPATH')){
    exit; // Exit if accessed directly
}

class SBI_Elementor_Widget  extends Widget_Base {

	public function get_name() {
        return 'sbi-widget';
    }
    public function get_title() {
        return esc_html__('Instagram Feed', 'instagram-feed');
    }
    public function get_icon() {
        return 'sb-elem-icon sb-elem-instagram';
    }
    public function get_categories() {
        return array('smash-balloon');
    }
    public function get_script_depends() {
        return [
            'sbiscripts',
            'elementor-preview'
        ];
    }



    protected function register_controls() {
    	/********************************************
                    CONTENT SECTION
        ********************************************/
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Instagram Feed Settings', 'instagram-feed'),
            ]
        );
        $this->add_control(
            'feed_id', [
                'label' => esc_html__('Select a Feed', 'instagram-feed'),
                'type' => 'sbi_feed_control',
                'label_block' => true,
                'dynamic' => ['active' => true],
                'options' =>  SBI_Db::elementor_feeds_query(),
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if( isset($settings['feed_id']) && !empty($settings['feed_id']) ){
            $output = do_shortcode( shortcode_unautop( '[instagram-feed feed='.$settings['feed_id'].']' ) );
        }else{
            $output = is_admin() ? SBI_Integration::get_widget_cta() : '';
        }
        echo apply_filters('sbi_output', $output, $settings);
    }





}