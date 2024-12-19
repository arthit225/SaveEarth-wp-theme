<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( 'metro' === $layout ) {
	$ij = L_theplus_load_metro_style_layout( $ji, $metro_column, $metro_style );
	if ( ! empty( $responsive_tablet_metro ) && 'yes' === $responsive_tablet_metro ) {
		$tablet_ij = L_theplus_load_metro_style_layout( $ji, $tablet_metro_column, $tablet_metro_style );

		$tablet_metro_class = 'tb-metro-item' . esc_attr( $tablet_ij );
	}
}

// category filter.
$category_filter = '';
if ( 'yes' === $filter_category ) {
	$terms = get_the_terms( $loop->ID, 'category' );
	if ( $terms != null ) {
		foreach ( $terms as $term ) {
			$category_filter .= ' ' . esc_attr( $term->slug ) . ' ';
			unset( $term );
		}
	}
}

// grid item loop.
echo '<div class="grid-item metro-item' . esc_attr( $ij ) . ' ' . esc_attr( $tablet_metro_class ) . ' ' . esc_attr( $desktop_class ) . ' ' . esc_attr( $tablet_class ) . ' ' . esc_attr( $mobile_class ) . ' ' . esc_attr( $category_filter ) . ' ' . esc_attr( $animated_columns ) . '">';

if ( ! empty( $style ) ) {
	include L_THEPLUS_WSTYLES . 'blog/blog-' . sanitize_file_name( $style ) . '.php';
}

echo '</div>';
