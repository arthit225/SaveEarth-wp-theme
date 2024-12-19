<?php
/*
Page scroll to id widgets 
*/

/*
Simple widget which creates an (invinsible) target element with an id attribute
*/

class malihuPageScroll2idWidget extends WP_Widget {

	// Register widget with WordPress
	function __construct(){
		parent::__construct(
			'malihuPageScroll2idWidget', // Base ID
			__( 'Page scroll to id target', 'page-scroll-to-id' ), // Name
			array( 'description' => __( 'Single target element (anchor point)', 'page-scroll-to-id' ), ) // Args
		);
	}
	
	// Front-end display of widget 
	public function widget($args, $instance){
		if(!empty($instance['id_value'])){
			$target_value=!empty($instance['target_value']) ? $instance['target_value'] : '';
			echo '<a id="'.esc_attr($instance['id_value']).'" data-ps2id-target="'.esc_attr($target_value).'"></a>';
		}
	}
	
	// Back-end widget form 
	public function form($instance){
		$id_value=!empty($instance['id_value']) ? $instance['id_value'] : '';
		$target_value=!empty($instance['target_value']) ? $instance['target_value'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('id_value')); ?>"><?php esc_html_e( 'id:' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('id_value')); ?>" name="<?php echo esc_attr($this->get_field_name('id_value')); ?>" type="text" value="<?php echo esc_attr($id_value); ?>">
			<small class="description ps2id-admin-widgets-row-field-desc"><em><?php esc_html_e( 'Unique identifier without spaces (e.g. my-id)' ); ?></em></small>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('target_value')); ?>"><?php esc_html_e( 'Highlight target selector:' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('target_value')); ?>" name="<?php echo esc_attr($this->get_field_name('target_value')); ?>" type="text" value="<?php echo esc_attr($target_value); ?>">
			<small class="description ps2id-admin-widgets-row-field-desc"><em><?php esc_html_e( 'Optional element selector to use for highlighting (e.g. #another-id)' ); ?></em></small>
		</p>
		<?php 
	}

	// Sanitize widget form values as they are saved 
	public function update($new_instance, $old_instance){
		$instance = array();
		$instance['id_value']=(!empty($new_instance['id_value'])) ? sanitize_text_field($new_instance['id_value']) : '';
		$instance['target_value']=(!empty($new_instance['target_value'])) ? sanitize_text_field($new_instance['target_value']) : '';
		return $instance;
	}

}

include_once(
	plugin_dir_path( __FILE__ ).(version_compare(PHP_VERSION, '5.3', '<') ? 'class-malihu-pagescroll2id-widget-init-php52.php' : 'class-malihu-pagescroll2id-widget-init.php')
);
?>