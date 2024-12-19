<?php

namespace Templately\Core\Importer\Utils;

use Templately\Core\Importer\WPImport;
use Templately\Utils\Helper;

class GutenbergHelper extends ImportHelper {
	const IMAGE_URL_PATTERN = '/(http(s?):)([\/|.|\w|\s|-])*\.(?:jpg|gif|png)/';

	private $template_settings = [];
	private $forms             = [];
	/**
	 * @var WPImport
	 */
	private $wp_importer;

	public $shouldLog = true; // This is the class property to check

	protected $content;

	protected $post_id;

	protected static $attachment_ids = [];


	/**
	 * @param $template_json
	 * @param $template_settings
	 * @param $extra_content
	 *
	 * @return GutenbergHelper
	 */
	public function prepare( $template_json, $template_settings, $extra_content = [], $request_params = [] ) {
		$this->template_settings = $template_settings;
		$this->post_id           = $this->map_post_ids[ $template_settings['post_id'] ];
		$this->wp_importer       = new WPImport( null, ['fetch_attachments' => true] );

		$parsed_blocks = parse_blocks( $template_json['content'] );
		if ( ! empty( $extra_content ) ) {
			$this->prepare_form_data( $extra_content, $template_settings );
		}
		if ( isset($this->template_settings['__attachments']) ) {
			$this->process_images();
			// Make sure we do the longest urls first, in case one is a substring of another.
			uksort( $this->wp_importer->url_remap, function ( $a, $b ) {
				// Return the difference in length between two strings.
				return strlen( $b ) - strlen( $a );
			} );
		}
		$this->replace( $parsed_blocks, $request_params );
		$this->content = wp_slash( serialize_blocks( $parsed_blocks ) );

		return $this;
	}

	public function update() {
		$this->sse_log('update', 'Updating prepared data, just a moment...', 1, 'eventLog');
		wp_update_post( [
			'ID'           => $this->post_id,
			'post_content' => $this->content
		] );
	}

	private function prepare_form_data( $extra_content, $template_settings ) {
		foreach ( $extra_content as $type => $content ) {
			foreach ( $content as $block_id => $value ) {
				foreach ( $template_settings['data']['form'][ $type ] as $setting ) {
					if ( isset( $setting['id'] ) && $setting['id'] === $block_id ) {
						$this->forms[ $block_id ] = [
							'value' => $value,
							'attr'  => $setting['identifier']
						];
					}
				}

			}
		}
	}

	private function replace( &$blocks, $request_params = [] ) {
		foreach ( $blocks as &$block ) {
			$this->sse_log('prepare', 'Preparing output for finalize, just a moment...', 1, 'eventLog');
			if ( $block['blockName'] === 'core/navigation' ) {
				if ( ! empty( $block['attrs']['ref'] ) && array_key_exists( $block['attrs']['ref'], $this->map_post_ids ) ) {
					$block['attrs']['ref'] = $this->map_post_ids[ $block['attrs']['ref'] ];
					$this->replace_archive_id( $block['attrs']['ref'] );
				}
			}
			if ( isset( $block['attrs']['blockId'] ) && array_key_exists( $block['attrs']['blockId'], $this->forms ) ) {
				$blockId = $block['attrs']['blockId'];
				$form    = $this->forms[$blockId];
				$attr    = $form['attr'];
				$value   = (string) $form['value'];

				$block['attrs'][$attr] = $value;
			}

			if ( ! empty( $block['attrs']['queryData'] ) ) {
				$this->replace_query_data( $block );
			}

			if ( isset($this->template_settings['__attachments']) ) {
				$block = $this->replace_attachment_url( $block );
			}

			if ( ! empty( $block['innerBlocks'] ) ) {
				$this->replace( $block['innerBlocks'], $request_params );
			}
			else if(!empty($request_params['logo']['id']) && isset($request_params['logo_size']) && $request_params['logo_size'] && $block['blockName'] === "essential-blocks/advanced-image" && $block["attrs"]["imgSource"] === "site-logo"){
				$block["attrs"]["widthRange"]    = $request_params['logo_size'];
				unset($block["attrs"]["widthUnit"]);
				if (isset($block['attrs']['blockMeta']['desktop']) && is_string($block['attrs']['blockMeta']['desktop'])) {
					$meta = $block['attrs']['blockMeta']['desktop'];
					$regex = '/\.image-wrapper\s*{\s*width:\s*(\d+)px;/';

					if (preg_match($regex, $meta, $matches)) {
						$replaced = preg_replace($regex, '.image-wrapper { width:' . $request_params['logo_size'] . 'px;', $meta);

						if ($replaced) {
							$block['attrs']['blockMeta']['desktop'] = $replaced;
						}
					}
				}

				$this->sse_log('prepare', 'Updated Site Logo', 1, 'eventLog');
			}
		}
	}

	private function replace_archive_id( $menu_id ) {
		if ( ! empty( $this->imported_data['archive_settings'] ) ) {
			$post    = get_post( $menu_id );
			$blocks  = parse_blocks( $post->post_content );
			$changed = false;
			foreach ( $blocks as &$block ) {
				$this->sse_log('query', 'Finalizing archive settings, just a moment...', 1, 'eventLog');

				if ( isset( $block['attrs']['id'] ) && $block['attrs']['id'] === $this->imported_data['archive_settings']['archive_id'] ) {
					$changed               = true;
					$block['attrs']['id']  = $this->imported_data['archive_settings']['page_id'];
					$block['attrs']['url'] = get_the_permalink( $this->imported_data['archive_settings']['page_id'] );
				}
			}
			if ( $changed ) {
				wp_update_post( [
					'ID'           => $menu_id,
					'post_content' => wp_slash( serialize_blocks( $blocks ) )
				] );
			}
		}
	}

	/**
	 * @param $block
	 *
	 * @return void
	 */
	private function replace_query_data( &$block ) {
		if ( ! empty( $block['attrs']['queryData']['taxonomies'] ) ) {
			foreach ( $block['attrs']['queryData']['taxonomies'] as &$tax ) {
				$this->sse_log('query', 'Finalizing query data, just a moment...', 1, 'eventLog');
				$tax['value'] = json_decode( $tax['value'], true );
				if ( ! empty( $tax['value'] ) ) {
					foreach ( $tax['value'] as &$val ) {
						if ( array_key_exists( $val['value'], $this->map_term_ids ) ) {
							$val['value'] = $this->map_term_ids[ $val['value'] ];
						}
					}
				}
				$tax['value'] = json_encode( $tax['value'] );
			}
		}
		$this->replace_raw_taxonomies($block);
		if(!empty( $block['attrs']['queryData']['author'])){
			$user = wp_get_current_user();
			$block['attrs']['queryData']['author'] = json_encode([['label' => $user->display_name, 'value' => $user->ID]]);
		}
	}

	/**
	 * @param $block
	 *
	 * @return void
	 */
	private function replace_raw_taxonomies( &$block ) {
		$types = ['category', 'tag'];
		foreach ( $types as $type){
			if(!empty($block['attrs']['queryData'][$type])){
				$block['attrs']['queryData'][$type] = json_decode($block['attrs']['queryData'][$type], true);
				foreach ($block['attrs']['queryData'][$type] as &$term){
					$this->sse_log('prepare', 'Finalizing taxonomies, just a moment...', 1, 'eventLog');
					if ( isset($term['value']) && array_key_exists( $term['value'], $this->map_term_ids ) ) {
						$term['value'] = $this->map_term_ids[ $term['value'] ];
					}
				}
				$block['attrs']['queryData'][$type] = json_encode($block['attrs']['queryData'][$type]);
			}
		}
	}

	public function replace_attachment_url($attrs) {
		if ( !empty($attrs['blockName'] ) ) {
			$attrs = $this->replace_attachment_ids($attrs);
		}

		if (is_string($attrs)) {
			foreach ($this->wp_importer->url_remap as $old_url => $new_url) {
				if (strpos($attrs, $old_url) !== false) {
					$attrs = str_replace($old_url, $new_url, $attrs);
				}
			}
		}
		else if (is_array($attrs)) {
			foreach ($attrs as $key => $attr) {
				$attrs[$key] = $this->replace_attachment_url($attr);
			}
		}

		return $attrs;
	}

	protected function replace_attachment_ids($attrs){
		switch ($attrs['blockName']) {
			case 'essential-blocks/slider':
				$attrs = $this->processImages($attrs, 'images', 'imageId', 'url');
				break;
			case 'essential-blocks/advanced-image':
				$attrs = $this->processSingleImage($attrs, 'image');
				break;
			case 'essential-blocks/parallax-slider':
				$attrs = $this->processImages($attrs, 'sliderData', 'id', 'src');
				break;
			case 'essential-blocks/image-gallery':
				$attrs = $this->processImages($attrs, 'images', 'id', 'url');
				$attrs = $this->processImages($attrs, 'sources', 'id', 'url');
				break;
			case 'core/image':
				$attrs = $this->processCoreImage($attrs, 'id');
				break;
			case 'core/media-text':
				$attrs = $this->processCoreImage($attrs, 'mediaId');
				break;
			case 'core/cover':
				$attrs = $this->processSingleImage($attrs, 'url');
				break;
		}
		return $attrs;
	}

	private function processImages($attrs, $imageKey, $idKey, $urlKey) {
		if (!empty($attrs['attrs'][$imageKey])) {
			foreach ($attrs['attrs'][$imageKey] as $key => &$image) {
				$imageUrl = $image[$urlKey];
				if (!empty(self::$attachment_ids[$imageUrl])) {
					$oldId = $image[$idKey];
					$newId = (int) self::$attachment_ids[$imageUrl];
					$image[$idKey] = $newId;

					// Update innerHTML and innerContent for 'essential-blocks/slider'
					if ($attrs['blockName'] === 'essential-blocks/slider') {
						$attrs = $this->updateInnerHTMLAndContent($attrs, "imageId&quot;:$oldId,&quot;", "imageId&quot;:$newId,&quot;");
					}
				}
			}
		}
		return $attrs;
	}

	private function processSingleImage($attrs, $imageKey) {
		if (!empty(self::$attachment_ids[$attrs['attrs'][$imageKey]['url']])) {
			$attrs['attrs'][$imageKey]['id'] = (int) self::$attachment_ids[$attrs['attrs'][$imageKey]['url']];
		}
		return $attrs;
	}

	private function processCoreImage($attrs, $idKey) {
		preg_match(self::IMAGE_URL_PATTERN, $attrs['innerHTML'], $matches);
		if (!empty($matches[0])) {
			$url = $matches[0];
			if (!empty(self::$attachment_ids[$url])) {
				$oldId = $attrs['attrs'][$idKey];
				$newId = (int) self::$attachment_ids[$url];
				$attrs['attrs'][$idKey] = $newId;

				// Replace old ID with new ID in innerHTML and innerContent
				$attrs = $this->updateInnerHTMLAndContent($attrs, "wp-image-$oldId", "wp-image-$newId");
			}
		}
		return $attrs;
	}

	private function updateInnerHTMLAndContent($attrs, $oldValue, $newValue) {
		$attrs['innerHTML'] = str_replace($oldValue, $newValue, $attrs['innerHTML']);
		if (is_array($attrs['innerContent'])) {
			foreach ($attrs['innerContent'] as $i => $content) {
				$attrs['innerContent'][$i] = str_replace($oldValue, $newValue, $content);
			}
		} else {
			$attrs['innerContent'] = str_replace($oldValue, $newValue, $attrs['innerContent']);
		}
		return $attrs;
	}

	/**
	 * Parses the images from the post content, processes them as attachments, and updates the post with the new attachment URL.
	 * @todo: Parse using parse_blocks instead of regex
	 *
	 * @param int    $post_id      The ID of the post.
	 * @param string $post_content The content of the post.
	 */
	public function parse_images($post_content) {
		// Find all image URLs in the post content
		preg_match_all(self::IMAGE_URL_PATTERN, $post_content, $matches);

		$urls           = $matches[0];
		$organizedUrls  = [];

		foreach ($urls as $url) {
			// Remove the size suffix from the URL
			$base_url = preg_replace('/-\d+x\d+(?=\.[a-zA-Z]+$)/', '', $url);

			// Check if the URL already exists in the array
			if (!isset($organizedUrls[$base_url]) || !in_array($url, $organizedUrls[$base_url])) {
				// Add the URL to the array under the base URL key
				$organizedUrls[$base_url][] = $url;
			}
		}

		return $organizedUrls;
	}

	public function process_images(){
		// Time to run the import!
		set_time_limit( 0 );

		$organizedUrls = $this->template_settings['__attachments'];
		// For each base image URL...
		foreach ($organizedUrls as $base_url => $sizes) {
			// Prepare the post data for the attachment
			$post_data = $this->prepare_post_data($this->post_id, $base_url);

			// If prepare_post_data returned null, skip this iteration
			if ($post_data === null) {
				continue;
			}

			// Check if the attachment already exists
			$attachment_id = $this->wp_importer->process_attachment($post_data, $base_url, $sizes);
			// If there was an error, handle it here
			if (is_wp_error($attachment_id)) {
				$this->sse_log('error', $attachment_id->get_error_message(), -1, 'eventLog');
			} else {
				$this->sse_log('success', "Imported attachment: $attachment_id", -1, 'eventLog');
				self::$attachment_ids[$base_url] = $attachment_id;
			}
		}
	}

	private function prepare_post_data($post_id, $image_url) {
		$filetype = wp_check_filetype(basename($image_url));
		if (!$filetype['type']) {
			$this->sse_log('prepare', 'Error: Unable to determine the file type.', -1, 'eventLog');
			return null;
		}

		$post_data = array(
			'post_title'     => basename($image_url),
			'post_content'   => '',
			'post_status'    => 'inherit',
			'post_mime_type' => $filetype['type'],
			'guid'           => $image_url,
			'post_parent'    => $post_id, // Set the parent post
		);

		if (preg_match('%wp-content/uploads/([0-9]{4}/[0-9]{2})%', $image_url, $matches)) {
			$post_data['upload_date'] = $matches[1];
		}
		else{
			$post_data['upload_date'] = date('Y/m');
		}

		return $post_data;
	}

	public function sse_log( $type, $message, $progress = 1, $action = 'updateLog', $status = null ) {
		if ($this->shouldLog) {
			parent::sse_log($type, $message, $progress, $action, $status);
		}
		else{
			Helper::log(func_get_args());
		}
	}

	public function get_content(){
		return $this->content;
	}

}