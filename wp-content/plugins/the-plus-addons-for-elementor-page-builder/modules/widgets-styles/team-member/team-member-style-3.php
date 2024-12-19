<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$postid = get_the_ID();

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="team-list-content">
		<div class="post-content-image">
		<?php 
			require L_THEPLUS_WSTYLES . 'team-member/format-image.php';
		?>	

		</div>		
		<div class="post-content-bottom">
			<div class="content-table">
				<div class="table-cell">
					<?php require L_THEPLUS_WSTYLES . 'team-member/post-meta-title.php'; ?>
				</div>
				<div class="table-cell">
					<?php
					if ( ! empty( $team_social_contnet ) && ! empty( $display_social_icon ) && $display_social_icon == 'yes' ) {
						echo wp_kses_post( $team_social_contnet );
					}
					?>
				</div>
			</div>
			<?php
			if ( ! empty( $designation ) && ! empty( $display_designation ) && $display_designation == 'yes' ) {
				echo wp_kses_post( $designation );
			}
			?>
		</div>
	</div>
</article>