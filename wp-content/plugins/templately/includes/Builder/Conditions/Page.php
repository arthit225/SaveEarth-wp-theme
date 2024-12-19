<?php

namespace Templately\Builder\Conditions;

class Page extends Condition {
	private $_post_type = 'page';
	private $post_type;

	public function __construct( $args = [] ) {
		$this->post_type = get_post_type_object( $this->_post_type );

		parent::__construct( $args );
	}

	public function get_priority(): int {
		return 35;
	}

	public function get_label(): string {
		return $this->post_type->labels->singular_name;
	}

	public function get_all_label(): string {
		return $this->post_type->label;
	}

	public function get_type(): string {
		return 'singular';
	}

	public function get_name(): string {
		return $this->post_type->name;
	}

	public function check( $args = [] ): bool {
		if ( isset( $args['id'] ) ) {
			$id = (int) $args['id'];
			if ( $id ) {
				return is_page() && get_queried_object_id() === $id;
			}
		}

		return is_page();
	}

	public function register_sub_conditions() {
		$by_author = new PostByAuthor( $this->post_type );
		$this->register_sub_condition( $by_author );
	}

	protected function register_controls() {
		$this->add_control( "posts_query_" . $this->get_name(), [
			'field'      => 'ID',
			'query_type' => 'posts',
			'options'    => [ '' => 'All' ],
			'query'      => [ 'post_type' => $this->get_name() ]
		] );
	}
}