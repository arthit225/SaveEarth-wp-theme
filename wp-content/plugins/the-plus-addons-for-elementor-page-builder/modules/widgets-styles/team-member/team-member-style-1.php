<?php
/**
 * Get Style 1 Here
 *
 * @package ThePlus
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$postid = get_the_ID();

if ( 'repeater' !== $selct_source ) {
	$member_url = get_the_permalink();
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="team-list-content">
		<div class="post-content-image">
				<a rel="<?php echo esc_attr( $member_urlnofollow ); ?>" href="<?php echo esc_url( $member_url ); ?>" target="<?php echo esc_attr( $member_urlblank ); ?>" >
					<?php require L_THEPLUS_WSTYLES . 'team-member/format-image.php'; ?>			
				</a>
			<?php
			if ( ! empty( $team_social_contnet ) && 'yes' === $display_social_icon ) {
				echo wp_kses_post( $team_social_contnet );
			}
			?>
		</div>		
		
		<div class="post-content-bottom">			
			<?php
				require L_THEPLUS_WSTYLES . 'team-member/post-meta-title.php';

			if ( ! empty( $designation ) && 'yes' === $display_designation ) {
				echo wp_kses_post( $designation );
			}
			?>
		</div>
		
	</div>
</article>