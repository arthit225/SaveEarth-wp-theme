<?php

namespace Templately\Builder\Types;

class PageSingle extends Single {
	public static function get_type(): string {
		return 'page_single';
	}

	public static function get_title(): string {
		return __( 'Page Single', 'templately' );
	}

	public static function get_plural_title(): string {
		return __( 'Page Single', 'templately' );
	}

	public static function get_properties(): array {
		$properties = parent::get_properties();

		$properties['condition'] = 'include/singular/page';
		$properties['builder']   = true;

		return $properties;
	}
}