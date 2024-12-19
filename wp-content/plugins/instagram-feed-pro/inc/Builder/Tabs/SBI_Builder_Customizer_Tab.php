<?php
/**
 * Builder Customizer Tab
 *
 *
 * @since 6.0
 */
namespace InstagramFeed\Builder\Tabs;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


class SBI_Builder_Customizer_Tab {

	/**
	 * Get Tabs Data
	 *
	 *
	 * @since 6.0
	 * @access public
	 *
	 * @return array
	*/
	public static function get_customizer_tabs() {
		return array(
			'customize' => array(
				'id'       => 'customize',
				'heading'  => __( 'Customize', 'instagram-feed' ),
				'sections' => SBI_Customize_Tab::get_sections(),
			),
			'settings'  => array(
				'id'       => 'settings',
				'heading'  => __( 'Settings', 'instagram-feed' ),
				'sections' => SBI_Settings_Tab::get_sections(),
			),
		);
	}


	/**
	 * Text Size Options
	 *
	 *
	 * @since 6.0
	 * @access public
	 *
	 * @return array
	*/
	public static function get_text_size_options() {
		return array(
			'inherit' => __( 'Inherit', 'instagram-feed' ),
			'10'      => '10px',
			'11'      => '11px',
			'12'      => '12px',
			'13'      => '13px',
			'14'      => '14px',
			'15'      => '15px',
			'16'      => '16px',
			'18'      => '18px',
			'20'      => '20px',
			'24'      => '24px',
			'28'      => '28px',
			'32'      => '32px',
			'36'      => '36px',
			'42'      => '42px',
			'48'      => '48px',
			'54'      => '54px',
			'60'      => '60px',
		);
	}


	/**
	 * header Icons Options
	 *
	 *
	 * @since 6.0
	 * @access public
	 *
	 * @return array
	*/
	public static function get_header_icons_options() {
		return array(
			'facebook-square' => 'Facebook 1',
			'facebook'        => 'Facebook 2',
			'calendar'        => 'Events 1',
			'calendar-o'      => 'Events 2',
			'picture-o'       => 'Photos',
			'users'           => 'People',
			'thumbs-o-up'     => 'Thumbs Up 1',
			'thumbs-up'       => 'Thumbs Up 2',
			'comment-o'       => 'Speech Bubble 1',
			'comment'         => 'Speech Bubble 2',
			'ticket'          => 'Ticket',
			'list-alt'        => 'News List',
			'file'            => 'File 1',
			'file-o'          => 'File 2',
			'file-text'       => 'File 3',
			'file-text-o'     => 'File 4',
			'youtube-play '   => 'Video',
			'youtube-play'    => 'YouTube',
			'vimeo-square'    => 'Vimeo',
		);
	}

	/**
	 * Date Format Options
	 *
	 *
	 * @since 6.0
	 * @access public
	 *
	 * @return array
	*/
	public static function get_date_format_options() {
		$original = strtotime( '2016-07-25T17:30:00+0000' );
		return array(
			'1'      => __( '2 days ago', 'instagram-feed' ),
			'2'      => gmdate( 'F jS, g:i a', $original ),
			'3'      => gmdate( 'F jS', $original ),
			'4'      => gmdate( 'D F jS', $original ),
			'5'      => gmdate( 'l F jS', $original ),
			'6'      => gmdate( 'D M jS, Y', $original ),
			'7'      => gmdate( 'l F jS, Y', $original ),
			'8'      => gmdate( 'l F jS, Y - g:i a', $original ),
			'9'      => gmdate( "l M jS, 'y", $original ),
			'10'     => gmdate( 'm.d.y', $original ),
			'18'     => gmdate( 'm.d.y - G:i', $original ),
			'11'     => gmdate( 'm/d/y', $original ),
			'12'     => gmdate( 'd.m.y', $original ),
			'19'     => gmdate( 'd.m.y - G:i', $original ),
			'13'     => gmdate( 'd/m/y', $original ),
			'14'     => gmdate( 'd-m-Y, G:i', $original ),
			'15'     => gmdate( 'jS F Y, G:i', $original ),
			'16'     => gmdate( 'd M Y, G:i', $original ),
			'17'     => gmdate( 'l jS F Y, G:i', $original ),
			'18'     => gmdate( 'Y-m-d', $original ),
			'custom' => __( 'Custom', 'instagram-feed' ),
		);
	}
}
