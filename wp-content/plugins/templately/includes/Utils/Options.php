<?php

namespace Templately\Utils;

use function get_option;
use function update_option;
use function get_user_meta;
use function update_user_meta;
use function get_current_user_id;

class Options extends Base {
	/**
	 * Current User Id
	 * @var integer
	 */
	private $current_user;

	/**
	 * User has any api?
	 * @var boolean
	 */
	private $has_api;

	/**
	 * Automatically invoked and set up the properties.
	 */
	public function __construct(){
		$this->current_user = get_current_user_id();
		$this->has_api      = ! empty( $this->get( 'api_key', '', $this->current_user ) );
	}

	/**
	 * Get the current user ID.
	 * @return int
	 */
	public function current_user_id(): int {
		return $this->current_user;
	}

	/**
	 * Can a user link another templately account in a setup?.
	 * @return boolean
	 */
	public function link_account(): bool {
		return $this->who_am_i() === 'link' && ! $this->has_api;
	}

	public function unlink_account(): bool {
		return ( $this->who_am_i() === 'link' || $this->who_am_i() === 'local' ) && $this->has_api;
	}

	/**
	 * Get determined who am I.
	 * @return string
	 */
	public function who_am_i(): string {
		$_who_am_i = 'local';

		if( $this->is_global() > 0 && $this->is_global() === $this->current_user ) {
			$_who_am_i = 'global';
		}

		if( $this->is_global() > 0 && $this->is_global() !== $this->current_user ) {
			$_who_am_i = 'link';
		}

		if( $this->is_global() == 0 ) {
			$_who_am_i = 'local';
		}

		return $_who_am_i;
	}

	/**
	 * Get user id determine dynamically
	 * @return integer
	 */
	private function user_id(): int {
		$_who_am_i = $this->who_am_i();

		if( ! empty( $_SERVER['REQUEST_URI'] ) ) {
			$parse_uri = explode( '/', substr( $_SERVER['REQUEST_URI'], 0, strpos( $_SERVER['REQUEST_URI'], '?' ) ) );
			if( $_who_am_i === 'link' && array_pop( $parse_uri ) === 'login' ) {
				return $this->current_user;
			}
		}

		if( $_who_am_i === 'link' && $this->has_api ) {
			return $this->current_user;
		}

		return $_who_am_i === 'local' ? $this->current_user : $this->is_global();
	}

	/**
	 * Globally logged in and the User ID of globally logged-in user.
	 * @return integer
	 */
	public function is_global(): int {
		return intval( get_option('_templately_global_login', 0) );
	}

	/**
	 * Set global login flag
	 * @return boolean
	 */
	public static function set_global_login(): bool {
		return update_option('_templately_global_login', get_current_user_id(), 'no');
	}

	/**
	 * Remove global login flag
	 * @return boolean
	 */
	public function remove_global_login(): bool {
		return delete_option( '_templately_global_login' );
	}

	public function is_globally_signed(): bool {
		return $this->who_am_i() !== 'local';
	}

	public function signed_as_global(): bool {
		return $this->current_user === $this->is_global();
	}

	/**
	 * Set optional user meta or option data
	 *
	 * @param string $key
	 * @param mixed $value
	 * @param null $user_id
	 * @return boolean
	 */
	public function set( $key, $value, $user_id = null ): bool {
		$key = '_templately_' . $key;

		$updated = $this->update_user_meta( $user_id, $key, $value );

		if( $key === '_templately_api_key' && $updated ) {
			$this->has_api = true;
		}

		return $updated;
	}

	/**
	 * Get optional user meta or option data
	 *
	 * @param string $key
	 * @param mixed $default
	 * @return mixed
	 */
	public function get( $key, $default = false, $user_id = null ){
		$key = '_templately_' . $key;
		$_user_meta = $this->get_user_meta( $user_id, $key, true );
		return ! empty( $_user_meta ) ? $_user_meta : $default;
	}

	/**
	 * Remove options data or user meta
	 *
	 * @param string $key
	 * @return Options
	 */
	public function remove( string $key ): Options {
		$key = '_templately_' . $key;
		$updated = $this->delete_user_meta( $key );

		if( $key === '_templately_api_key' && $updated ) {
			$this->has_api = false;
		}

		return $this;
	}

	public function get_user_meta( $user_id, $key = '', $single = false ) {
		$user_id = is_null( $user_id ) ? $this->user_id() : $user_id;

		if( ! is_multisite() ) {
			return get_user_meta( $user_id, $key, $single);
		}

		return get_user_option( $key, $user_id );
	}

	public function update_user_meta($user_id, $meta_key, $meta_value) {
		$user_id = is_null( $user_id ) ? $this->user_id() : $user_id;

		if( ! is_multisite() ) {
			return update_user_meta( $user_id, $meta_key, $meta_value );
		}

		return update_user_option( $user_id, $meta_key, $meta_value, $this->_is_global() );
	}

	public function delete_user_meta( $meta_key ): bool {
		if( ! is_multisite() ) {
			return delete_user_meta( $this->user_id(), $meta_key );
		}

		return delete_user_option( $this->user_id(), $meta_key, $this->_is_global() );
	}

	private function _is_global() {
		return apply_filters( 'templately_multisite_is_global', false );
	}

	/**
	 * Get option data
	 *
	 * @since 2.0.1
	 *
	 * @param string $key
	 * @param mixed  $default
	 *
	 * @return mixed
	 */
	public function get_option( $key, $default = false ){
		return get_option( $key, $default );
	}

	/**
	 * Update option data
	 *
	 * @since 2.0.1
	 *
	 * @param string $key
	 * @param mixed  $value
	 * @param string $autoload
	 *
	 * @return bool
	 */
	public function update_option( $key, $value, $autoload = 'no' ): bool {
		return update_option( $key, $value, $autoload );
	}
}