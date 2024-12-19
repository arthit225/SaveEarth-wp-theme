<?php
/**
 * Blog meta date
 *
 * @package ThePlus
 * @since 1.0.0
 * @version 5.6.7
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<span class="meta-date"><a href="<?php echo esc_url( get_the_permalink() ); ?>"><span class="entry-date"><?php echo get_the_date(); ?></span></a></span>
</a></span>
