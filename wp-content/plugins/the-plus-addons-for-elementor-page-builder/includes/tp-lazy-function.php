<?php
/**
 * TP Pro LazyLoad Images
 *
 * @link       https://posimyth.com/
 * @since      5.6.7
 *
 * @package    the-plus-addons-for-elementor-page-builder
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Tp_LazyLoad_Images
 *
 * @since   5.6.7
 **/
class Tp_LazyLoad_Images {

	/**
	 * Updates the attributes of <img> tags in the provided content.
	 *
	 * @since 5.6.7
	 *
	 * @param string $img_content   The HTML content containing <img> tags.
	 * @param string $old_attr_name The name of the attribute to replace.
	 * @param string $new_attr_name The new attribute name to set.
	 */
	public function tp_change_attribute_form_images( $img_content, $old_attr_name, $new_attr_name ) {
		$tagname = 'img';

		if ( ! preg_match_all( '/<' . $tagname . ' [^>]+>/', $img_content, $matches ) ) {
			return $img_content;
		}

		$sel_images = array();
		foreach ( $matches[0] as $image ) {
			$sel_images[] = $image;
		}

		foreach ( $sel_images as $image ) {
			$img_content = str_replace( $image, $this->tp_rename_attribute_for_image( $image, $old_attr_name, $new_attr_name ), $img_content );
		}

		return $img_content;
	}

	/**
	 * Renames an attribute for a specific <img> tag.
	 *
	 * @param string $image          The <img> tag as a string from which the attribute needs to be renamed.
	 * @param string $old_attr_name  The name of the attribute to replace.
	 * @param string $new_attr_name  The new attribute name to set.
	 */
	public function tp_rename_attribute_for_image( $image, $old_attr_name, $new_attr_name ) {
		$tag = 'img';

		$old_attr_value = ltrim(
			rtrim(
				trim(
					preg_replace(
						'/(\\<' .
						$tag .
						'[^>]+)(\\s?' .
						$old_attr_name .
						'\\="[^"]+"\\s?)([^>]+)(>)/',
						'${2}',
						$image
					)
				),
				'"'
			),
			$old_attr_name . '="'
		);

		$removed = $this->tp_remove_attribute_from_images( $image, $old_attr_name );

		$image = $this->tp_add_attribute_to_image( $removed, $new_attr_name, $old_attr_value );

		return $image;
	}

	/**
	 * Removes a specific attribute from all <img> tags in the provided HTML content.
	 *
	 * @param string $img_content The HTML content containing <img> tags.
	 * @param string $attribute   The name of the attribute to remove from <img> tags.
	 */
	public function tp_remove_attribute_from_images( $img_content, $attribute ) {
		$tagname = 'img';

		if ( ! preg_match_all( '/<' . $tagname . ' [^>]+>/', $img_content, $matches ) ) {
			return $img_content;
		}

		$select_images = array();

		foreach ( $matches[0] as $image ) {
			$select_images[] = $image;
		}

		foreach ( $select_images as $image ) {
			$img_content = str_replace( $image, $this->tp_remove_attribute_from_single_image( $image, $attribute ), $img_content );
		}

		return $img_content;
	}

	/**
	 * Removes a specific attribute from a single <img> tag.
	 *
	 * @param string $image     The <img> tag as a string from which the attribute needs to be removed.
	 * @param string $attribute The name of the attribute to remove from the <img> tag.
	 */
	public function tp_remove_attribute_from_single_image( $image, $attribute ) {
		$tagname = 'img';

		return preg_replace( '/(\\<' . $tagname . '[^>]+)(\\s?' . $attribute . '\\="[^"]+"\\s?)([^>]+)(>)/', '${1}${3}${4}', $image );
	}

	/**
	 * Adds a new attribute with a specified value to an <img> tag, replacing any existing attribute with the same name.
	 *
	 * @param string $image      The <img> tag as a string to which the attribute needs to be added.
	 * @param string $attr_name  The name of the attribute to add or replace.
	 * @param string $attr_value The value of the attribute to set.
	 */
	public function tp_add_attribute_to_image( $image, $attr_name, $attr_value ) {
		$tagname     = 'img';
		$update_attr = sprintf( ' %s="%s"', esc_attr( $attr_name ), esc_attr( $attr_value ) );

		$val = preg_replace(
			'/<' . $tagname . ' ([^>]+?)[\\/ ]*>/',
			'<' . $tagname . ' $1' . $update_attr . ' />',
			$this->tp_remove_attribute_from_images( $image, $attr_name )
		);

		return $val;
	}
}

if ( ! function_exists( 'tp_getAspectRatio' ) ) {
	function tp_getAspectRatio( int $width, int $height ) {
		$aspact_ratio = $width / $height;   // tp_getAspectRatio($image_src[1], $image_src[2]);
		$target_width = $target_height = min( 10, max( $width, $height ) );

		if ( $aspact_ratio < 1 ) {
			$target_width = $target_height * $aspact_ratio;
		} else {
			$target_height = $target_width / $aspact_ratio;
		}

		return array( $target_width, $target_height );
	}
}

if ( ! function_exists( 'tp_has_lazyload' ) ) {
	function tp_has_lazyload() {
		$theplus_options = get_option( 'theplus_api_connection_data' );
		$lazyopt         = ! empty( $theplus_options['plus_lazyload_opt'] ) ? $theplus_options['plus_lazyload_opt'] : '';

		if ( 'enable' === $lazyopt ) {
			return true;
		} else {
			return false;
		}
	}
}

if ( ! function_exists( 'tp_lazyload_type' ) ) {
	function tp_lazyload_type() {
		$theplus_options = get_option( 'theplus_api_connection_data' );
		$lazyopt         = ( ! empty( $theplus_options['plus_lazyload_opt'] ) ) ? $theplus_options['plus_lazyload_opt'] : '';
		$lazyanimopt     = ( ! empty( $theplus_options['plus_lazyload_opt_anim'] ) ) ? $theplus_options['plus_lazyload_opt_anim'] : '';

		if ( 'enable' === $lazyopt && ! empty( $lazyanimopt ) ) {
			return $lazyanimopt;
			// return 'dbl-circle';  // fade | dbl-circle | circle | blur-img | skeleton
		}
	}
}

if ( ! function_exists( 'tp_get_image_rander' ) ) {
	function tp_get_image_rander( $id = '', $size = 'full', $attr = array(), $posttype = 'attachment' ) {
		if ( empty( $id ) ) {
			return '';
		}

		if ( ! empty( $posttype ) && 'post' === $posttype ) {
			$get_post = get_post( $id );

			if ( ! $get_post ) {
				return '';
			}

			$id = get_post_thumbnail_id( $get_post );
		}

		if ( ! wp_get_attachment_image_src( $id ) ) {
			return '';
		}

		$output = '';

		if ( tp_has_lazyload() ) {
			$lazy_type            = tp_lazyload_type();
			$attr['data-tp-lazy'] = $lazy_type;

			if ( 'dbl-circle' === $lazy_type || 'circle' === $lazy_type || 'skeleton' === $lazy_type ) {
				$output .= '<span class="tp-loader-' . esc_attr( $lazy_type ) . '"></span>';
			} elseif ( 'blur-img' === $lazy_type ) {
				$image_src = wp_get_attachment_image_src( $id, $size );

				if ( ! empty( $image_src[1] ) && ! empty( $image_src[2] ) ) {
					$aspact_ratio = tp_getAspectRatio( $image_src[1], $image_src[2] );

					$attr['src'] = wp_get_attachment_image_url( $id, $aspact_ratio );
				}

				$attr['data-src'] = wp_get_attachment_image_url( $id, $size );

			}

			$attr['class'] = ( isset( $attr['class'] ) ? $attr['class'] : '' ) . ' tp-lazyload';
		}

		$get_image = wp_get_attachment_image( $id, $size, false, $attr );

		$check_srcset = strpos( $get_image, 'srcset' ) !== false;

		if ( tp_has_lazyload() ) {
			$lazy_type = tp_lazyload_type();
			$output   .= '<noscript>' . $get_image . '</noscript>';

			$lazyloadImage = new Tp_LazyLoad_Images();
			if ( 'blur-img' != $lazy_type ) {
				$get_image = $lazyloadImage->tp_change_attribute_form_images( $get_image, 'src', 'data-src' );
			}

			if ( $check_srcset ) {
				$get_image = $lazyloadImage->tp_change_attribute_form_images( $get_image, 'srcset', 'data-srcset' );
			}
		}

		$output = $get_image . $output;

		return $output;
	}
}

function tp_bg_lazyLoad( $option = array(), $option2 = array() ) {

	if ( tp_has_lazyload() && isset( $option ) && ! empty( $option ) && isset( $option['url'] ) && ! empty( $option['url'] ) ) {
		return ' lazy-background';
	}

	if ( tp_has_lazyload() && isset( $option2 ) && ! empty( $option2 ) && isset( $option2['url'] ) && ! empty( $option2['url'] ) ) {
		return ' lazy-background';
	}

	return '';
}
