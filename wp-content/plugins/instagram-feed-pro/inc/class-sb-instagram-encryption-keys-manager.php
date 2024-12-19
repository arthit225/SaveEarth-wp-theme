<?php

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class SBI_Ecnryption_Keys_Manager {

	private $encryption_key_constant;
	private $encryption_salt_constant;

	public function __construct($encryption_key_constant, $encryption_salt_constant) {
		$this->encryption_key_constant = $encryption_key_constant;
		$this->encryption_salt_constant = $encryption_salt_constant;
	}

	private function should_set_keys_constants() {
		return current_user_can( 'manage_instagram_feed_options' );
	}

	private function find_wpconfig_path() {
		$config_file_name = 'wp-config';
		$abspath          = ABSPATH;
		$config_file      = "{$abspath}{$config_file_name}.php";

		if ( is_writable( $config_file ) ) {
			return $config_file;
		}

		$abspath_parent  = dirname( $abspath ) . DIRECTORY_SEPARATOR;
		$config_file_alt = "{$abspath_parent}{$config_file_name}.php";

		if (
			is_file( $config_file_alt )
			&&
			is_writable( $config_file_alt )
			&&
			! is_file( "{$abspath_parent}wp-settings.php" )
		) {
			return $config_file_alt;
		}

		// No writable file found.
		return false;
	}


	private function get_constant_content( $constant, $value = 'true' ) {
		return "define( '{$constant}', '{$value}' );";
	}

	public function set_constants($remove = false) {
		if ( ! $this->should_set_keys_constants() ) {
			return false;
		}

		$config_file_path = $this->find_wpconfig_path();

		if ( ! $config_file_path ) {
			return false;
		}

		$config_file_contents = file_get_contents( $config_file_path );

		$salt_value = wp_generate_password( 64 );
		$key_value  = wp_generate_password( 64 );

		$salt_constant_value = $this->get_constant_content($this->encryption_salt_constant, $salt_value);
		$encryption_constant_value = $this->get_constant_content($this->encryption_key_constant, $key_value);

		$updated_with_salt = $this->add_or_update_constant($this->encryption_salt_constant, true === $remove ? '' : $salt_constant_value, true === $remove ? '' : $salt_value, $config_file_contents);

		if ( false !== $updated_with_salt ) {
			$config_file_contents = $updated_with_salt;
		}

		$updated_with_encryption = $this->add_or_update_constant( $this->encryption_key_constant,
			true === $remove ? '' : $encryption_constant_value, true === $remove ? '' : $key_value, $config_file_contents );

		if ( false !== $updated_with_encryption ) {
			$config_file_contents = $updated_with_encryption;
		}

		if(empty($config_file_contents)) {
			return false;
		}

		return file_put_contents( $config_file_path, $config_file_contents );
	}

	private function add_or_update_constant($constant_name, $constant, $value, $config_file_contents) {
		$constant_found = preg_match( "/^\s*define\(\s*'{$constant_name}'\s*,.*?(?<value>[^\s\)]*)\s*\)/m",
			$config_file_contents, $matches );

		if (
			! empty( $matches['value'] )
			&&
			$matches['value'] === $value
		) {
			return false;
		}

		if ( ! $constant_found ) {
			$config_file_contents = preg_replace( '/(<\?php)/i', "<?php\r\n{$constant}\r\n", $config_file_contents, 1 );
		}

		return $config_file_contents;
	}

	public function remove_keys() {
		$this->set_constants(true);
	}
}
