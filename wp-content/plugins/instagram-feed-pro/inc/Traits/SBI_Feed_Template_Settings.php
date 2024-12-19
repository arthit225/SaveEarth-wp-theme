<?php

namespace InstagramFeed\Traits;

/**
 * Trait SBI_Feed_Template_Settings
 *
 * Holds the settings for the feed templates.
 *
 * @since INSTA_FEED_PRO_SINCE
 */
trait SBI_Feed_Template_Settings {

	/**
	 * Get feed settings depending on feed templates.
	 *
	 * @since INSTA_FEED_PRO_SINCE
	 */
	public static function get_feed_settings_by_feed_templates( $settings ) {
		if ( empty( $settings['feedtemplate'] ) ) {
			return self::get_ft_default_template_settings( $settings );
		}

		switch ( $settings['feedtemplate'] ) {
			case 'ft_simple_grid':
				return self::get_ft_simple_grid_template_settings( $settings );
			case 'ft_simple_grid_xl':
				return self::get_ft_simple_grid_xl_template_settings( $settings );
			case 'ft_simple_row':
				return self::get_ft_simple_row_template_settings( $settings );
			case 'ft_simple_carousel':
				return self::get_ft_simple_carousel_template_settings( $settings );
			case 'ft_masonry_cards':
				return self::get_ft_masonry_cards_template_settings( $settings );
			case 'ft_card_grid':
				return self::get_ft_card_grid_template_settings( $settings );
			case 'ft_highlight':
				return self::get_ft_highlight_template_settings( $settings );
			case 'ft_single_post':
				return self::get_ft_single_post_template_settings( $settings );
			case 'ft_single_post_carousel':
				return self::get_ft_single_post_carousel_template_settings( $settings );

			default:
				return self::get_ft_default_template_settings( $settings );
		}
	}

	/**
	 * Get `default` feed templates settings.
	 *
	 * @since INSTA_FEED_PRO_SINCE
	 */
	public static function get_ft_default_template_settings( $settings ) {
		// Feed Layout
		$settings['layout']     		= 'grid';
		$settings['num']        		= '8';
		$settings['nummobile']  		= '4';
		$settings['cols']       		= '4';
		$settings['colstablet'] 		= '3';
		$settings['colsmobile'] 		= '1';
		$settings['imagepadding'] 		= '6';

		// Load More Button
		$settings['showbutton'] 			= true;
		$settings['buttoncolor'] 			= '#F3F4F5';
		$settings['buttonhovercolor']		= '#E8E8EB';
		$settings['buttontextcolor'] 		= '#2C324C';

		//Follow Button
		$settings['showfollow']				= true;
		$settings['followcolor']			= '#0068A0';
		$settings['followhovercolor']		= '#005B8C';
		$settings['followtextcolor']		= '#ffffff';

		// Like Box
		$settings['showlikebox'] 			= false;

		// Header
		$settings['showheader']  			= true;
		$settings['headerstyle'] 			= 'standard';

		//Color Scheme
		$settings['colorpalette'] 			= 'inherit';

		//Like and Comment Summary
		$settings['showlikes']  			= true;
		$settings['likescolor']  			= '#8C8F9A';

		//Caption
		$settings['showcaption']  			= true;
		$settings['captionlength']  		= '50';
		$settings['captionsize']  			= '12';
		$settings['captioncolor']  			= '#434960';

		//Post/Hover State
		$settings['hoverdisplay']			= 'caption,likes';
		$settings['hovercaptionlength']		= '50';

		//Post Style
		$settings['poststyle']			= 'regular';


		return $settings;
	}

	/**
	 * Get `ft_simple_grid` feed templates settings.
	 *
	 * @since INSTA_FEED_PRO_SINCE
	 */
	public static function get_ft_simple_grid_template_settings( $settings ) {
		// Feed Layout
		$settings['layout']     	= 'grid';
		$settings['num']        	= '8';
		$settings['nummobile']  	= '8';
		$settings['cols']       	= '4';
		$settings['colstablet'] 	= '3';
		$settings['colsmobile'] 	= '2';
		$settings['imagepadding'] 	= '6';

		// Load More Button
		$settings['showbutton'] 			= true;
		$settings['buttoncolor'] 			= '#F3F4F5';
		$settings['buttonhovercolor']		= '#E8E8EB';
		$settings['buttontextcolor'] 		= '#2C324C';

		// Follow Button
		$settings['showfollow']				= true;
		$settings['followcolor']			= '#0068A0';
		$settings['followhovercolor']		= '#005B8C';
		$settings['followtextcolor']		= '#ffffff';


		//Color Scheme
		$settings['colorpalette'] 			= 'inherit';

		//Like and Comment Summary
		$settings['showlikes']  			= false;

		//Caption
		$settings['showcaption']  			= false;


		// Header
		$settings['showheader']  			= true;
		$settings['headerstyle'] 			= 'text';
		$settings['headertext'] 			= __('We are on Instagram' , 'instagram-feed');
		$settings['headertextsize'] 		= 'medium';

		//Post/Hover State
		$settings['hoverdisplay']			= 'caption,likes';


		return $settings;
	}

	/**
	 * Get `ft_simple_grid_xl` feed templates settings.
	 *
	 * @since INSTA_FEED_PRO_SINCE
	 */
	public static function get_ft_simple_grid_xl_template_settings( $settings ) {
		// Feed Layout
		$settings['layout']     	= 'grid';
		$settings['num']        	= '32';
		$settings['nummobile']  	= '8';
		$settings['cols']       	= '8';
		$settings['colstablet'] 	= '4';
		$settings['colsmobile'] 	= '2';
		$settings['imagepadding'] 	= '6';

		// Load More Button
		$settings['showbutton'] 			= true;
		$settings['buttoncolor'] 			= '#F3F4F5';
		$settings['buttonhovercolor']		= '#E8E8EB';
		$settings['buttontextcolor'] 		= '#2C324C';

		// Follow Button
		$settings['showfollow']				= true;
		$settings['followcolor']			= '#0068A0';
		$settings['followhovercolor']		= '#005B8C';
		$settings['followtextcolor']		= '#ffffff';

		//Color Scheme
		$settings['colorpalette'] 			= 'inherit';

		// Like Box
		$settings['showlikes'] = false;

		// Caption
		$settings['showcaption'] = false;

		// Header
		$settings['showheader']  = true;
		$settings['headerstyle']  = 'centered';

		//Post/Hover State
		$settings['hoverdisplay']			= 'caption,likes';

		return $settings;
	}

	/**
	 * Get `ft_simple_row` feed templates settings.
	 *
	 * @since INSTA_FEED_PRO_SINCE
	 */
	public static function get_ft_simple_row_template_settings( $settings ) {
		// Feed Layout
		$settings['layout']     			= 'grid';
		$settings['num']        			= '5';
		$settings['nummobile']  			= '4';
		$settings['cols']       			= '5';
		$settings['colstablet'] 			= '4';
		$settings['colsmobile'] 			= '2';
		$settings['imagepadding'] 			= '0';

		// Load More Button
		$settings['showbutton'] 			= false;

		// Follow Button
		$settings['showfollow']				= true;
		$settings['followcolor']			= '#0068A0';
		$settings['followhovercolor']		= '#005B8C';
		$settings['followtextcolor']		= '#ffffff';

		// Like Box
		$settings['showlikes'] 				= false;

		//Color Scheme
		$settings['colorpalette'] 			= 'inherit';


		// Caption
		$settings['showcaption'] 			= false;

		// Header
		$settings['showheader']  			= true;
		$settings['headerstyle'] 			= 'text';
		$settings['headertext'] 			= __('We are on Instagram' , 'instagram-feed');
		$settings['headertextsize'] 		= 'medium';

		//Post/Hover State
		$settings['hoverdisplay']			= 'caption,likes';

		return $settings;
	}

	/**
	 * Get `ft_simple_carousel` feed templates settings.
	 *
	 * @since INSTA_FEED_PRO_SINCE
	 */
	public static function get_ft_simple_carousel_template_settings( $settings ) {
		// Feed Layout
		$settings['layout']     			= 'carousel';
		$settings['num']        			= '12';
		$settings['nummobile']  			= '8';
		$settings['cols']       			= '4';
		$settings['colstablet'] 			= '3';
		$settings['colsmobile'] 			= '2';
		$settings['imagepadding'] 			= '6';

		//Carousel Settings
		$settings['carouselrows']     = 1;
		$settings['carouselloop']     = 'rewind';
		$settings['carouseltime']     = 500;
		$settings['carouselarrows']   = true;
		$settings['carouselpag']     = true;


		// Load More Button
		$settings['showbutton'] 			= true;
		$settings['buttoncolor'] 			= '#F3F4F5';
		$settings['buttonhovercolor']		= '#E8E8EB';
		$settings['buttontextcolor'] 		= '#2C324C';

		// Follow Button
		$settings['showfollow']				= true;
		$settings['followcolor']			= '#0068A0';
		$settings['followhovercolor']		= '#005B8C';
		$settings['followtextcolor']		= '#ffffff';

		//Color Scheme
		$settings['colorpalette'] 			= 'inherit';

		// Like Box
		$settings['showlikes'] 				= true;
		$settings['likescolor']				= '#8C8F9A';

		//Caption
		$settings['showcaption']  			= true;
		$settings['captionlength']  		= '50';
		$settings['captionsize']  			= '12';
		$settings['captioncolor']  			= '#434960';

		// Header
		$settings['showheader']  			= true;
		$settings['headerstyle'] 			= 'text';
		$settings['headertext'] 			= __('We are on Instagram' , 'instagram-feed');
		$settings['headertextsize'] 		= 'medium';

		//Post/Hover State
		$settings['hoverdisplay']			= 'caption,likes';
		$settings['hovercaptionlength']		= '50';

		return $settings;
	}

	/**
	 * Get `ft_masonry_cards` feed templates settings.
	 *
	 * @since INSTA_FEED_PRO_SINCE
	 */
	public static function get_ft_masonry_cards_template_settings( $settings ) {
		// Feed Layout
		$settings['layout']     			= 'masonry';
		$settings['num']        			= '12';
		$settings['nummobile']  			= '4';
		$settings['cols']       			= '4';
		$settings['colstablet'] 			= '3';
		$settings['colsmobile'] 			= '1';
		$settings['imagepadding'] 			= '6';

		// Load More Button
		$settings['showbutton'] 			= true;
		$settings['buttoncolor'] 			= '#F3F4F5';
		$settings['buttonhovercolor']		= '#E8E8EB';
		$settings['buttontextcolor'] 		= '#2C324C';

		// Follow Button
		$settings['showfollow']				= true;
		$settings['followcolor']			= '#0068A0';
		$settings['followhovercolor']		= '#005B8C';
		$settings['followtextcolor']		= '#ffffff';

		//Color Scheme
		$settings['colorpalette'] 			= 'inherit';

		// Like Box
		$settings['showlikes'] 				= true;
		$settings['likescolor']				= '#8C8F9A';

		//Caption
		$settings['showcaption']  			= true;
		$settings['captionlength']  		= '50';
		$settings['captionsize']  			= '12';
		$settings['captioncolor']  			= '#434960';

		// Header
		$settings['showheader']  			= true;
		$settings['headerstyle']  			= 'standard';

		//Post/Hover State
		$settings['hoverdisplay']			= 'caption,likes';
		$settings['hovercaptionlength']		= '50';


		//Post Style
		$settings['postbgcolor']		= '#fff';
		$settings['poststyle']			= 'boxed';
		$settings['boxshadow']			= 'on';


		return $settings;
	}

	/**
	 * Get `ft_card_grid` feed templates settings.
	 *
	 * @since INSTA_FEED_PRO_SINCE
	 */
	public static function get_ft_card_grid_template_settings( $settings ) {
		// Feed Layout
		$settings['layout']     			= 'grid';
		$settings['num']        			= '8';
		$settings['nummobile']  			= '4';
		$settings['cols']       			= '4';
		$settings['colstablet'] 			= '3';
		$settings['colsmobile'] 			= '1';
		$settings['imagepadding'] 			= '6';

		// Load More Button
		$settings['showbutton'] 			= true;
		$settings['buttoncolor'] 			= '#F3F4F5';
		$settings['buttonhovercolor']		= '#E8E8EB';
		$settings['buttontextcolor'] 		= '#2C324C';

		// Follow Button
		$settings['showfollow']				= true;
		$settings['followcolor']			= '#0068A0';
		$settings['followhovercolor']		= '#005B8C';
		$settings['followtextcolor']		= '#ffffff';

		//Color Scheme
		$settings['colorpalette'] 			= 'inherit';

		// Like Box
		$settings['showlikes'] 				= true;
		$settings['likescolor']				= '#8C8F9A';

		//Caption
		$settings['showcaption']  			= true;
		$settings['captionlength']  		= '50';
		$settings['captionsize']  			= '12';
		$settings['captioncolor']  			= '#434960';

		// Header
		$settings['showheader']  = true;
		$settings['headerstyle']  			= 'standard';

		//Post/Hover State
		$settings['hoverdisplay']			= 'caption,likes';
		$settings['hovercaptionlength']		= '50';

		//Post Styles
		$settings['postbgcolor']		= '#fff';
		$settings['poststyle']			= 'boxed';
		$settings['boxshadow']			= 'on';

		return $settings;
	}

	/**
	 * Get `ft_highlight` feed templates settings.
	 *
	 * @since INSTA_FEED_PRO_SINCE
	 */
	public static function get_ft_highlight_template_settings( $settings ) {
		// Feed Layout
		$settings['layout']     			= 'highlight';
		$settings['num']        			= '8';
		$settings['nummobile']  			= '4';
		$settings['cols']       			= '4';
		$settings['colstablet'] 			= '3';
		$settings['colsmobile'] 			= '1';
		$settings['imagepadding'] 			= '6';

		// Load More Button
		$settings['showbutton'] 			= true;
		$settings['buttoncolor'] 			= '#F3F4F5';
		$settings['buttonhovercolor']		= '#E8E8EB';
		$settings['buttontextcolor'] 		= '#2C324C';

		// Follow Button
		$settings['showfollow']				= true;
		$settings['followcolor']			= '#0068A0';
		$settings['followhovercolor']		= '#005B8C';
		$settings['followtextcolor']		= '#ffffff';

		//Color Scheme
		$settings['colorpalette'] 			= 'inherit';

		// Like Box
		$settings['showlikes'] = false;

		// Caption
		$settings['showcaption'] = false;

		// Header
		$settings['showheader']  = true;
		$settings['headerstyle']  			= 'standard';

		//Post/Hover State
		$settings['hoverdisplay']			= 'caption,likes';

		return $settings;
	}

	/**
	 * Get `ft_single_post` feed templates settings.
	 *
	 * @since INSTA_FEED_PRO_SINCE
	 */
	public static function get_ft_single_post_template_settings( $settings ) {
		// Feed Layout
		$settings['layout']     = 'grid';
		$settings['num']        = '1';
		$settings['nummobile']  = '1';
		$settings['cols']       = '1';
		$settings['colstablet'] = '1';
		$settings['colsmobile'] = '1';

		// Load More Button
		$settings['showbutton'] = false;

		// Follow Button
		$settings['showfollow']				= true;
		$settings['followcolor']			= '#0068A0';
		$settings['followhovercolor']		= '#005B8C';
		$settings['followtextcolor']		= '#ffffff';

		// Like Box
		$settings['showlikes'] = false;

		// Caption
		$settings['showcaption'] = false;

		//Color Scheme
		$settings['colorpalette'] 			= 'inherit';

		// Header
		$settings['showheader']  = true;
		$settings['headerstyle']  			= 'standard';

		//Post/Hover State
		$settings['hoverdisplay']			= 'caption,likes';

		return $settings;
	}

	/**
	 * Get `ft_single_post_carousel` feed templates settings.
	 *
	 * @since INSTA_FEED_PRO_SINCE
	 */
	public static function get_ft_single_post_carousel_template_settings( $settings ) {
		// Feed Layout
		$settings['layout']     = 'carousel';
		$settings['num']        = '4';
		$settings['nummobile']  = '4';
		$settings['cols']       = '1';
		$settings['colstablet'] = '1';
		$settings['colsmobile'] = '1';

		//Carousel Settings
		$settings['carouselrows']     = 1;
		$settings['carouselloop']     = 'infinity';
		$settings['carouseltime']     = 500;
		$settings['carouselarrows']   = true;
		$settings['carouselpag']     = false;

		// Load More Button
		$settings['showbutton'] = false;

		// Follow Button
		$settings['showfollow']				= true;
		$settings['followcolor']			= '#0068A0';
		$settings['followhovercolor']		= '#005B8C';
		$settings['followtextcolor']		= '#ffffff';

		// Like Box
		$settings['showlikes'] = false;

		// Caption
		$settings['showcaption'] = false;

		//Color Scheme
		$settings['colorpalette'] 			= 'inherit';

		// Header
		$settings['showheader']  = true;
		$settings['headerstyle']  			= 'standard';

		//Post/Hover State
		$settings['hoverdisplay']			= 'caption,likes';

		return $settings;
	}
}
