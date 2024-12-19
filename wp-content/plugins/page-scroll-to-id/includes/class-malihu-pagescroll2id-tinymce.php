<?php
/*
Page scroll to id tinyMCE buttons 
*/

class malihuPageScroll2idtinymce {
	
	public function add_custom_button(){
		global $typenow; 
		// check user permissions 
		if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) { return; } 
		// verify the post type 
		//if( ! in_array( $typenow, array( 'post', 'page' ) ) ) return; 
		// check if WYSIWYG is enabled 
		if ( get_user_option('rich_editing') == 'true') { 
			add_filter('mce_external_plugins', array($this, 'add_tinymce_plugin')); 
			add_filter('mce_buttons', array($this, 'register_custom_button')); 
		}
	}

	public function add_tinymce_plugin($plugin_array){ 
		$plugin_array['ps2id_tinymce_custom_button'] = plugins_url( '/malihu-pagescroll2id-tinymce.js', __FILE__ ); 
		return $plugin_array; 
	}
	
	public function register_custom_button($buttons){
		array_push($buttons, 'ps2id_tinymce_custom_button_link', 'ps2id_tinymce_custom_button_target'); 
		return $buttons; 
	}

}
?>