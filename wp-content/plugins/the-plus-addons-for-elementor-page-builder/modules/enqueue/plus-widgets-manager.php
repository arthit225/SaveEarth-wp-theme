<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;// Exit if accessed directly.
}

/**
 * Class Plus_Widgets_Manager
 */
class Plus_Widgets_Manager {
	/**
	 * A reference to an instance of this class.
	 *
	 * @since 1.0.0
	 * @var   object
	 */
	private static $instance = null;

	public $transient_widgets = array();

	public $preload_name = '';
	public $post_type    = '';
	public $post_id      = '';

	public $post_assets_objects = array();

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 */
	public static function get_instance( $shortcodes = array() ) {

		if ( null == self::$instance ) {
			self::$instance = new self( $shortcodes );
		}
		return self::$instance;
	}

	/**
	 * Constructor
	 */
	public function __construct( $post_id = '', $post_type = '' ) {
		if ( ! empty( $post_id ) ) {
			$this->post_type = $post_type;
			$this->post_id   = intval( $post_id );
			$this->get_widgets_list( $this->post_id, $this->post_type );
		}
	}

	/**
	 * Carousel dots style
	 * 
	 * @since 5.5.4
	 * @version 5.5.4
	 * @param string $options The option of the widgets.
	 * 
	 */
	public function tp_carousel_dots( $options ) {
		$sliderDots = isset( $options['slider_dots'] ) ? $options['slider_dots'] : 'yes';
		$tablet_slider_dots = isset( $options['tablet_slider_dots'] ) ? $options['tablet_slider_dots'] : 'yes';
		$mobile_slider_dots = isset( $options['mobile_slider_dots'] ) ? $options['mobile_slider_dots'] : 'yes';
		
		if ( 'yes' === $sliderDots ) {
			
			$slider_dots_style = ! empty( $options['slider_dots_style'] ) ? $options['slider_dots_style'] : 'style-1';
			
			$this->transient_widgets[] = 'tp-carousel-' . $slider_dots_style;
			$this->transient_widgets[] = 'tp-carousel-style';
		}
		if ( 'yes' === $tablet_slider_dots ) {

			$tablet_slider_dots_style = ! empty( $options['tablet_slider_dots_style'] ) ? $options['tablet_slider_dots_style'] : 'style-1';

			$this->transient_widgets[] = 'tp-carousel-' . $tablet_slider_dots_style;
			$this->transient_widgets[] = 'tp-carousel-style';
		}
		if ( 'yes' === $mobile_slider_dots ) {

			$mobile_slider_dots_style = ! empty( $options['mobile_slider_dots_style'] ) ? $options['mobile_slider_dots_style'] : 'style-1';

			$this->transient_widgets[] = 'tp-carousel-' . $mobile_slider_dots_style;
			$this->transient_widgets[] = 'tp-carousel-style';
		}
	}

	/**
	 * Carousel arrows style
	 * 
	 * @since 5.5.4
	 * @version 5.5.4
	 * @param string $options The option of the widgets.
	 * 
	 */
	public function tp_carousel_arrow( $options ){

		$show_arrows = isset( $options['slider_arrows'] ) ? $options['slider_arrows'] : 'no';

		$tablet_show_arrows  = isset( $options['tablet_slider_arrows'] ) ? $options['tablet_slider_arrows'] : 'no';
		$mobile_show_arrows  = isset( $options['mobile_slider_arrows'] ) ? $options['mobile_slider_arrows'] : 'no';

		
		if ( 'yes' === $show_arrows ) {

			$slider_arrows_style = ! empty( $options['slider_arrows_style'] ) ? $options['slider_arrows_style'] : 'style-1';

			$this->transient_widgets[] = 'tp-arrows-' . $slider_arrows_style;
			$this->transient_widgets[] = 'tp-arrows-style';
		}
		if ( 'yes' === $tablet_show_arrows ) {

			$tablet_slider_arrows_style = ! empty( $options['tablet_slider_arrows_style'] ) ? $options['tablet_slider_arrows_style'] : 'style-1';

			$this->transient_widgets[] = 'tp-arrows-' . $tablet_slider_arrows_style;
			$this->transient_widgets[] = 'tp-arrows-style';
		}
		if ( 'yes' === $mobile_show_arrows ) {

			$mobile_slider_arrows_style = ! empty( $options['mobile_slider_arrows_style'] ) ? $options['mobile_slider_arrows_style'] : 'style-1';

			$this->transient_widgets[] = 'tp-arrows-' . $mobile_slider_arrows_style;
			$this->transient_widgets[] = 'tp-arrows-style';
		}
	}

	/**
	 * get_element_list
	 * get cached widget list
	 *
	 * @param $post_id
	 *
	 * @return bool
	 * @version 5.4.2
	 */
	public function get_widgets_list( $post_id = '', $post_type = '' ) {

		if ( is_object( Elementor\Plugin::instance()->editor ) && Elementor\Plugin::instance()->editor->is_edit_mode() ) {
			return false;
		}

		$document = is_object( Elementor\Plugin::$instance->documents ) ? Elementor\Plugin::$instance->documents->get( $post_id ) : array();
		$data     = is_object( $document ) ? $document->get_elements_data() : array();

		$data = $this->get_widget_list( $data );

		$this->preload_name = $post_id;
		// current page/post load all templates one time load elements
		if ( isset( $this->transient_widgets ) && ! empty( $this->transient_widgets ) ) {
			if ( isset( l_theplus_generator()->post_assets_objects['elements'] ) ) {
				$elements = l_theplus_generator()->post_assets_objects['elements'];
			} else {
				$elements = array();
			}
			$different_elements = array_diff( $this->transient_widgets, $elements );
			if ( $this->transient_widgets != $different_elements ) {
				$this->preload_name = get_queried_object_id() . '-' . $post_id;
			}
			l_theplus_generator()->post_assets_objects['elements'] = array_unique( array_merge( $elements, $this->transient_widgets ) );

			$this->transient_widgets = $different_elements;
		}

		if ( ! empty( $this->transient_widgets ) ) {
			l_theplus_library()->remove_files_unlink( $post_type, $this->preload_name, array( 'css' ), true );

			// regenerate files page/post
			if ( ! l_theplus_generator()->check_css_js_cache_files( $post_type, $this->preload_name, 'css', true ) && l_theplus_generator()->get_caching_option() == false ) {
				sort( $this->transient_widgets );
				l_theplus_generator()->plus_generate_scripts( $this->transient_widgets, 'theplus-preload-' . $post_type . '-' . $this->preload_name, array( 'css' ), false );
			}
		}

		return true;
	}

	/**
	 * A reference to an instance of this class.
	 *
	 * @since 5.3.1
	 * @version 5.4.2
	 */
	public function tpebl_layout_listing( $options ) {

		$layout = ! empty( $options['layout'] ) ? $options['layout'] : 'grid';

		if ( 'grid' === $layout || 'masonry' === $layout ) {
			return 'plus-listing-masonry';
		} elseif ( 'metro' === $layout) {
			return 'plus-listing-metro';
		}
	}

	/**
	 * get_widget_list
	 * get widget names
	 *
	 * @param array $data
	 *
	 * @return array
	 */
	public function get_widget_list( $data ) {
		$widget_list = array();
		$replace     = array(
			'tp_smooth_scroll' => 'tp-smooth-scroll',
		);

		if ( is_object( Elementor\Plugin::$instance->db ) ) {
			Elementor\Plugin::$instance->db->iterate_data(
				$data,
				function ( $element ) use ( &$widget_list, $replace ) {

					if ( empty( $element['widgetType'] ) ) {
						$type = $element['elType'];
					} else {
						$type = $element['widgetType'];
					}

					if ( ! empty( $element['widgetType'] ) && $element['widgetType'] === 'global' ) {
						$document = Elementor\Plugin::$instance->documents->get( $element['templateID'] );
						$type     = is_object( $document ) ? current( $this->get_widget_list( $document->get_elements_data() ) ) : $type;

						if ( ! empty( $type ) ) {
							$type = 'tp-' . $type;
						}
					}

					if ( ! empty( $type ) && ! is_array( $type ) ) {

						if ( isset( $replace[ $type ] ) ) {
							$type = $replace[ $type ];
						}

						if ( ! in_array( $type, $this->transient_widgets ) ) {
							$this->transient_widgets[] = $type;
						}

						if ( isset( $element['widgetType'] ) ) {
							$this->plus_widgets_options( $element['settings'], $element['widgetType'] );
						} elseif ( isset( $element['elType'] ) ) {
							$this->plus_widgets_options( $element['settings'], $element['elType'] );
						}
					}
				}
			);
		}
		return $this->transient_widgets;
	}

	/**
	 * Button Style
	 *
	 * @since 5.4.2
	 * 
	 * @param array $button_style Array of btn style.
	 */
	public function tp_button_style( $button_style ) {
		$this->transient_widgets[] = 'tp-button-' . $button_style;
		$this->transient_widgets[] = 'tp-button';
	}

	 /**
	 * Check Widgets Options
	 *
	 * @since 2.0.2
	 * @version 5.5.0
	 *
	 * @param array  $options Array of options for the widget.
	 * @param string $widget_name Name of the widget being checked.
	 */
	 
	 public function plus_widgets_options( $options = '', $widget_name = '' ) {
		
		if ( ! empty( $options['seh_switch'] ) && 'yes' === $options['seh_switch'] ) {
			$this->transient_widgets[] = 'plus-equal-height';
		}
		
		if ( tp_has_lazyload() && ! in_array( 'plus-lazyLoad', $this->transient_widgets ) ) {
			$this->transient_widgets[] = 'plus-lazyLoad';
		}

		if ( ! empty( $options['animation_effects'] ) && 'no-animation' !== $options['animation_effects'] ) {
			$this->transient_widgets[] = 'plus-velocity';
		}

		if ( ! empty( $widget_name ) ) {

			if( 'tp-heading-title' === $widget_name || 'tp-button' === $widget_name || 'tp-contact-form-7' === $widget_name || 'tp-post-search' === $widget_name || 'tp-flip-box' === $widget_name || 'tp-info-box' === $widget_name || 'tp-navigation-menu-lite' === $widget_name || 'tp-tabs-tours' === $widget_name || 'tp-social-icon' === $widget_name ){
				$this->transient_widgets[] = "plus-alignmnet-effect";
			}

			if ( 'tp-button' === $widget_name ) {

				$hover_effect = ! empty( $options['btn_hover_effects'] ) ? $options['btn_hover_effects'] : '';
				$button_style = ! empty( $options['button_style'] ) ? $options['button_style'] : 'style-1';

				$this->tp_button_style( $button_style );

				if ( ! empty( $hover_effect ) ) {
					$this->transient_widgets[] = 'plus-content-hover-effect';
				}
			}

			if ( 'tp-blog-listout' === $widget_name ) {

				$blog_style                = ! empty( $options['style'] ) ? $options['style'] : 'style-1';
				$this->transient_widgets[] = 'tp-bloglistout-' . $blog_style;
				$this->transient_widgets[] = 'tp-blog-listout';

				$this->transient_widgets[] = $this->tpebl_layout_listing( $options );
			}

			if ( 'tp-clients-listout' === $widget_name ) {
				$this->transient_widgets[] = $this->tpebl_layout_listing( $options );
			}

			if ( 'tp-gallery-listout' === $widget_name ) {

				$gallery_style = ! empty( $options['style'] ) ? $options['style'] : 'style-1';

				$this->transient_widgets[] = 'tp-gallery-listout';

				if ( 'style-1' === $gallery_style || 'style-2' === $gallery_style) {
					$this->transient_widgets[] = 'tp-gallery-listout-' . $gallery_style;
				}

				$this->transient_widgets[] = $this->tpebl_layout_listing( $options );
			}

			if ( 'tp-team-member-listout' === $widget_name ) {

				$tm_style = ! empty( $options['style'] ) ? $options['style'] : 'style-1';

				if ( 'style-1' === $tm_style || 'style-3' === $tm_style ) {
					
					$this->transient_widgets[] = 'tp-team-member-listout-' . $tm_style;
				}
				$this->transient_widgets[] = 'tp-team-member-listout';
				$this->transient_widgets[] = $this->tpebl_layout_listing( $options );
			}

			if ( 'tp-testimonial-listout' === $widget_name ) {

				$this->transient_widgets[] = $this->tpebl_layout_listing( $options );

				$tl_style = ! empty( $options['style'] ) ? $options['style'] : 'style-1';

				if ( ! empty( $tl_style ) ) {
					$this->transient_widgets[] = 'tp-testimonial-listout-' . $tl_style;
				}
				$this->transient_widgets[] = 'tp-testimonial-listout';

				$layout = ! empty( $options['layout'] ) ? $options['layout'] : 'carousel';

				if ( 'carousel' === $layout ) {

					$slider_dots       = isset( $options['slider_dots'] ) ? $options['slider_dots'] : 'yes';
					$slider_dots_style = ! empty( $options['slider_dots_style'] ) ? $options['slider_dots_style'] : 'style-1';

					$show_arrows         = isset( $options['slider_arrows'] ) ? $options['slider_arrows'] : '';
					$slider_arrows_style = ! empty( $options['slider_arrows_style'] ) ? $options['slider_arrows_style'] : 'style-2';

					if ( ! empty( $show_arrows ) && 'style-1' === $slider_arrows_style ) {
						$this->transient_widgets[] = 'tp-arrows-style-1';
						$this->transient_widgets[] = 'tp-arrows-style';
					}

					if ( ! empty( $show_arrows ) && 'style-2' === $slider_arrows_style ) {
						$this->transient_widgets[] = 'tp-arrows-style-2';
						$this->transient_widgets[] = 'tp-arrows-style';
					}

					if ( ! empty( $slider_dots ) && 'style-1' === $slider_dots_style ) {
						$this->transient_widgets[] = 'tp-carousel-style-1';
						$this->transient_widgets[] = 'tp-carousel-style';
					}

					$this->transient_widgets[] = 'tp-carosual-extra';
			    }

				if ('masonry' === $layout || 'grid' === $layout){
					$this->transient_widgets[] = 'tp-bootstrap-grid';
				}
			}

			if ( 'tp-flip-box' === $widget_name || 'tp-info-box' === $widget_name ) {

				if ( 'tp-info-box' === $widget_name ) {

					$main_style = ! empty( $options['main_style'] ) ? $options['main_style'] : 'style_1';

					$this->transient_widgets[] = 'tp-info-box-' . $main_style;
					$this->transient_widgets[] = 'tp-info-box';
				}

				if ( ! empty( $options['display_button'] ) && 'yes' === $options['display_button'] ) {

					$button_style = ! empty( $options['button_style'] ) ? $options['button_style'] : 'style-8';

					$this->tp_button_style( $button_style );

				}

				if ( ! empty( $options['box_hover_effects'] ) ) {
					$this->transient_widgets[] = 'plus-content-hover-effect';
				}
				if ( ( ! empty( $options['image_icon'] ) && 'svg' === $options['image_icon'] ) || ( ! empty( $options['loop_select_icon'] ) && 'svg' === $options['loop_select_icon'] ) ) {
					$this->transient_widgets[] = 'tp-draw-svg';
				}
				
				$respo_visible = ! empty( $options['responsive_visible_opt'] ) ? $options['responsive_visible_opt'] : '';

				if ( 'yes' === $respo_visible ) {
					$this->transient_widgets[] = 'plus-responsive-visibility';
				}

			}

			if ( 'tp-number-counter' === $widget_name ) {

				$nc_style = ! empty( $options['style'] ) ? $options['style'] : 'style-1';
				$box_effects   = ! empty( $options['box_hover_effects'] ) ? $options['box_hover_effects'] : '';

				$this->transient_widgets[] = 'tp-number-counter-' . $nc_style;
				$this->transient_widgets[] = 'tp-number-counter';

				if ( ! empty( $box_effects ) ) {
					$this->transient_widgets[] = 'plus-content-hover-effect';
				}
			}

			if ( 'tp-page-scroll' === $widget_name ) {

				$ps_opt = ! empty( $options['page_scroll_opt'] ) ? $options['page_scroll_opt'] : 'tp_full_page';

				if ( ! isset( $options['page_scroll_opt'] ) || ( ! empty( $options['page_scroll_opt'] ) && 'tp_full_page' === $options['page_scroll_opt'] ) ) {
					$this->transient_widgets[] = 'tp-fullpage';
				}
				$this->transient_widgets[] = 'plus-widget-error';
			}

			if ( 'tp-process-steps' === $widget_name ) {

				$display_counter = ! empty( $options['pro_ste_display_counter'] ) ? $options['pro_ste_display_counter'] : 'no';
				$special_bg      = ! empty( $options['pro_ste_display_special_bg'] ) ? $options['pro_ste_display_special_bg'] : 'no';

				if ( 'yes' == $display_counter ) {
					$this->transient_widgets[] = 'tp-process-counter';
				}

				if ( 'yes' == $special_bg ) {
					$this->transient_widgets[] = 'tp-process-bg';
				}

				$this->transient_widgets[] = 'tp-process-steps';

				if ( ( ! empty( $options['ps_style'] ) && 'style_2' === $options['ps_style'] ) || ( ! empty( $options['connection_switch'] ) && 'yes' === $options['connection_switch'] && ! empty( $options['connection_unique_id'] ) ) ) {
					$this->transient_widgets[] = 'tp-process-steps-js';
				}

				if ( ( ! empty( $options['loop_content'][0]['loop_image_icon'] ) && 'lottie' === $options['loop_content'][0]['loop_image_icon'] ) ) {
					$this->transient_widgets[] = 'plus-lottie-player';
				}
			}

			if ( has_filter( 'tp_has_widgets_condition' ) ) {
				$this->transient_widgets = apply_filters( 'tp_has_widgets_condition', $this->transient_widgets, $options, $widget_name );
			}

			if ( 'tp-age-gate' === $widget_name ) {
				$av_method = ! empty( $options['age_verify_method'] ) ? $options['age_verify_method'] : 'method-1';

				$this->transient_widgets[] = 'tp-ag-' . $av_method;
				$this->transient_widgets[] = 'tp-age-gate';
			}

			if ( 'tp-blockquote' === $widget_name ) {
				$border_layout             = ! empty( $options['border_layout'] ) ? $options['border_layout'] : 'none';
				$this->transient_widgets[] = 'tp-bq-' . $border_layout;
				$this->transient_widgets[] = 'tp-blockquote';
			}

			if ( 'tp-countdown' === $widget_name ) {
				$cd_style                  = ! empty( $options['CDstyle'] ) ? $options['CDstyle'] : 'style-1';
				$this->transient_widgets[] = 'tp-countdown-' . $cd_style;
				$this->transient_widgets[] = 'tp-countdown';
			}

			if ( 'tp-heading-title' === $widget_name ) {
				$ht_style = ! empty( $options['heading_style'] ) ? $options['heading_style'] : 'style_1';

				$this->transient_widgets[] = 'tp-heading-title-' . $ht_style;
				$this->transient_widgets[] = 'tp-heading-title';
			}

			if ( 'tp-heading-animation' === $widget_name ) {

				$ha_style = ! empty( $options['anim_styles'] ) ? $options['anim_styles'] : 'style-1';
				$this->transient_widgets[] = 'tp-heading-animation-' . $ha_style;
				$this->transient_widgets[] = 'tp-heading-animation';
			}

			if ( 'tp-progress-bar' === $widget_name ) {
				$pb_style = ! empty( $options['main_style'] ) ? $options['main_style'] : 'progressbar';

				if ( 'progressbar' === $pb_style ) {
					$this->transient_widgets[] = 'tp-progress-bar';
				}
				if ( 'pie_chart' === $pb_style ) {
					$this->transient_widgets[] = 'tp-piechart';
				}
			}

			if ( 'tp-scroll-navigation' === $widget_name ) {

				$scroll_nav = ! empty( $options['scroll_navigation_style'] ) ? $options['scroll_navigation_style'] : 'style-1';

				if ( 'style-1' === $scroll_nav ) {
					$this->transient_widgets[] = 'tp-scroll-navigation-' . $scroll_nav;
				}
				$this->transient_widgets[] = 'tp-scroll-navigation';
			}

			if ( 'tp-syntax-highlighter' === $widget_name ) {

				$themeType     = ! empty( $options['themeType'] ) ? $options['themeType'] : 'prism-default';
				$cpybtnicon    = ! empty( $options['cpybtnicon']['value'] ) ? $options['cpybtnicon']['value'] : 'fas fa-copy';
				$copiedbtnicon = ! empty( $options['copiedbtnicon']['value'] ) ? $options['copiedbtnicon']['value'] : 'fas fa-arrow-alt-circle-down';
				$dwnldBtnIcon  = ! empty( $options['dwnldBtnIcon']['value'] ) ? $options['dwnldBtnIcon']['value'] : 'fas fa-arrow-alt-circle-down';
				
				if ( ! empty( $themeType ) ) {
					$this->transient_widgets[] = 'tp-syntax-highlighter';
					if ( $themeType == 'prism-default' ) {
						$this->transient_widgets[] = 'prism_default';
					} elseif ( $themeType == 'prism-coy' ) {
						$this->transient_widgets[] = 'prism_coy';
					} elseif ( $themeType == 'prism-dark' ) {
						$this->transient_widgets[] = 'prism_dark';
					} elseif ( $themeType == 'prism-funky' ) {
						$this->transient_widgets[] = 'prism_funky';
					} elseif ( $themeType == 'prism-okaidia' ) {
						$this->transient_widgets[] = 'prism_okaidia';
					} elseif ( $themeType == 'prism-solarizedlight' ) {
						$this->transient_widgets[] = 'prism_solarizedlight';
					} elseif ( $themeType == 'prism-tomorrownight' ) {
						$this->transient_widgets[] = 'prism_tomorrownight';
					} elseif ( $themeType == 'prism-twilight' ) {
						$this->transient_widgets[] = 'prism_twilight';
					}
					if ( $cpybtnicon || $copiedbtnicon || $dwnldBtnIcon ) {
						$this->transient_widgets[] = 'tp-syntax-highlighter-icons';
					}
				}
			}

			if ( 'tp-social-icon' === $widget_name ) {

				$social_icon = ! empty( $options['styles'] ) ? $options['styles'] : 'style-1';

				$this->transient_widgets[] = 'tp-social-icon-' . $social_icon;
				$this->transient_widgets[] = 'tp-social-icon';
			}

			if ( 'tp-pricing-table' === $widget_name ) {
				$p_style = ! empty( $options['pricing_table_style'] ) ? $options['pricing_table_style'] : 'style-1';
				$this->transient_widgets[] = 'tp-pricing-table-' . $p_style;
				$this->transient_widgets[] = 'tp-pricing-table';

				$button_style = ! empty( $options['button_style'] ) ? $options['button_style'] : 'style-8';
				$this->tp_button_style( $button_style );

				$table_ribbon  = ! empty( $options['display_ribbon_pin'] ) ? $options['display_ribbon_pin'] : 'no';
                $ribbon_style = ! empty( $options['ribbon_pin_style'] ) ? $options['ribbon_pin_style'] : 'style-1';

                if( 'yes' === $table_ribbon && 'style-1' === $ribbon_style ){
                    $this->transient_widgets[] = 'tp-pricing-ribbon';
                }
			}

			if ('tp-video-player' === $widget_name){

				$popup = !empty($options['popup_video']) ?$options['popup_video'] : '';

				if('yes' === $popup){
					$this->transient_widgets[] = 'tp-lity-extra';
				}
			}

			if ( 'tp-dynamic-categories' === $widget_name ) {

				$this->transient_widgets[] = $this->tpebl_layout_listing( $options );

				$head_style = ! empty( $options['style'] ) ? $options['style'] : 'style_1';

				if ( !empty ( $head_style ) ) {
					$this->transient_widgets[] = 'tp-dynamic-categories-' . $head_style;
					$this->transient_widgets[] = 'tp-dynamic-categories';
				}

			}
			
			if ( 'tp-carousel-anything' == $widget_name ) {

				$this->tp_carousel_dots( $options );
				$this->tp_carousel_arrow( $options );
			}

		}
	}
}

/**
 * Returns instance of Plus_Widgets_Manager
 */
Plus_Widgets_Manager::get_instance();

/**
 * Get post assets object.
 *
 * @since new_version
 */
function tpae_get_post_assets( $post_id = '', $post_type = '' ) {
	if ( ! isset( l_theplus_generator()->post_assets_objects[ $post_id ] ) ) {
		$post_obj = new Plus_Widgets_Manager( $post_id, $post_type );
		l_theplus_generator()->post_assets_objects[ $post_id ] = $post_obj;
	}
	return l_theplus_generator()->post_assets_objects[ $post_id ];
}
