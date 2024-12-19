<?php

namespace Templately\Builder\Types;


class Header extends HeaderFooterBase {
	public static function get_type(): string {
		return 'header';
	}

	public static function get_title(): string {
		return __( 'Header', 'templately' );
	}

	public static function get_plural_title(): string {
		return __( 'Headers', 'templately' );
	}

	public static function get_properties(): array {
		$properties = parent::get_properties();

		$properties['location'] = 'header';

		return $properties;
	}
}