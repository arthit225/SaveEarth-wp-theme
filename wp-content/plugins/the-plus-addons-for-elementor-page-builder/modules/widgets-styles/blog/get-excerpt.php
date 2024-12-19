<?php
/**
 * Get Excerpt data
 *
 * @package ThePlus
 * @since 1.0.0
 * @version 5.6.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<div class="entry-content">
	<p><?php echo esc_attr( l_theplus_excerpt( $post_excerpt_count ) ); ?></p>
</div>
