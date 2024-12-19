<div class="templately-builder-nav">
	<ul class="nav-tab-wrapper">
		<?php
			/**
			 * @var array $template_types
			 */
			$__type = isset($_GET['type']) ? $_GET['type'] : 'all';
			foreach ( $template_types as $typename => $type ) {
				$classes = esc_attr( $typename );
				$classes .= $__type === $typename ? ' active' : '';
				echo wp_kses( sprintf( '<li class="nav-tab %1$s"><a href="%2$s">%3$s</a></li>', $classes, esc_url( $type['url'] ), $type['label'] ), 'post' );
			}
		?>
	</ul>

	<?php if(isset($_GET['type']) && 'settings' === $_GET['type']):?>
		<div id="templately-fsi-revert-wrapper" style="clear: both; background: #fff; padding: 20px;" class="rendered">
			<div class="templately-fsi-revert-notice__content">
				<h3><?php _e("Revert to previous website", "templately");?></h3>

				<p><?php _e("Here you can revert back to your old website. We will restore previous settings, posts, pages, menus, etc.", "templately");?></p>

				<div class="templately-fsi-revert-notice__actions">
					<button
						class="button"
						<?php echo $has_revert ? '' : 'disabled';?>
						title="<?php echo $has_revert ? '' : __('Nothing to revert', 'templately');?>"
					>
						<span><?php _e("Revert Now", 'templately');?></span>
					</button>
				</div>
			</div>
		</div>
		<style>
			#posts-filter, .templately-builder-nav .subsubsub{
				display: none;
			}
		</style>
	<?php endif;?>
	<ul class="subsubsub">
		<?php
			/**
			 * @var array $tabs
			 */
			if(!empty($tabs)){
				foreach ( $tabs as $class => $tab ) {
					echo sprintf( '<li class="%1$s">%2$s</li>', esc_attr( $class ), wp_kses( $tab, 'post' ) );
				}
			}
		?>
	</ul>
</div>
