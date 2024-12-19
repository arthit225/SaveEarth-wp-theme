<?php
/**
 * Plugin settings template
 *
 * @package   page_scroll_to_id
 */

$repeatables=false; // --edit--
$shortcodes=false; // --edit--
$btn_add=__('Add instance', $this->plugin_slug);
$btn_more_actions=__('More actions', $this->plugin_slug);
$btn_reset=($repeatables) ? __('Delete all and reset to default', $this->plugin_slug) : __('Reset to default', $this->plugin_slug);
$toggle_instance_title=__('Click to toggle', $this->plugin_slug);
?>

<div class="wrap">

	<?php if( version_compare(get_bloginfo('version'), '3.8', '<') && function_exists('screen_icon') ) screen_icon(); ?>
	<?php
	$plugin_admin_page_title=esc_html(get_admin_page_title());
	if( version_compare(get_bloginfo('version'), '4.3', '<') ) : ?>
		<h2><?php echo esc_html($plugin_admin_page_title); ?></h2>
	<?php else : ?>
		<h1><?php echo esc_html($plugin_admin_page_title); ?></h1>
	<?php endif; ?>

	<div class="plugin-header">
		<p class="plugin-info">
			<span><span class="dashicons dashicons-editor-help"></span> Plugin help &amp; resources:</span> <a href="#" class="mPS2id-open-help mPS2id-open-help-overview">Overview</a> <a href="#" class="mPS2id-open-help mPS2id-open-help-get-started">Get started</a> <a href="#" class="mPS2id-open-help mPS2id-open-help-plugin-settings">Plugin settings</a> <a href="#" class="mPS2id-open-help mPS2id-open-help-shortcodes">Shortcodes</a> <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/" class="mPS2id-external-link" target="_blank">Plugin homepage &amp; documentation</a> <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/2/" class="mPS2id-external-link" target="_blank">Knowledge Base – FAQ</a> <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress-tutorial/" class="mPS2id-external-link" target="_blank">Basic tutorial</a>
		</p>
		<p class="plugin-version">Version <?php echo esc_html($this->version); ?></p>

		<?php if(version_compare(get_bloginfo('version'), '3.6', '<')) : ?>
			<div class="oldwp-plugin-help">
				<!-- --edit-- -->
				<div class="oldwp-plugin-help-section oldwp-plugin-help-section-overview">
					<?php include_once(plugin_dir_path( __FILE__ ).'help/overview.inc'); ?>
				</div>
				<div class="oldwp-plugin-help-section oldwp-plugin-help-section-get-started">
					<?php include_once(plugin_dir_path( __FILE__ ).'help/get-started.inc'); ?>
				</div>
				<div class="oldwp-plugin-help-section oldwp-plugin-help-section-plugin-settings">
					<?php include_once(plugin_dir_path( __FILE__ ).'help/plugin-settings.inc'); ?>
				</div>
				<div class="oldwp-plugin-help-section oldwp-plugin-help-section-shortcodes">
					<?php include_once(plugin_dir_path( __FILE__ ).'help/shortcodes.inc'); ?>
				</div>
			</div>
		<?php endif; ?>

	</div>

	<?php if($repeatables) : ?>
		<div class="metabox-holder">
	<?php endif; ?>

		<div class="plugin-body clearfix">

			<div class="plugin-body-section-1">

				<form id="<?php echo esc_attr($this->pl_pfx); ?>form" method="post" action="options.php">

					<?php settings_fields($this->plugin_slug); ?>

					<?php echo '<input type="hidden" id="'.esc_attr($this->db_prefix).'total_instances'.'" name="'.esc_attr($this->db_prefix).'total_instances'.'" value="'.esc_attr($this->index).'" /> '; ?>
					<?php echo '<input type="hidden" id="'.esc_attr($this->db_prefix).'instances'.'" name="'.esc_attr($this->db_prefix).'instances'.'" value="" /> '; ?>
					<?php echo '<input type="hidden" id="'.esc_attr($this->db_prefix).'reset'.'" name="'.esc_attr($this->db_prefix).'reset'.'" value="false" /> '; ?>

					<?php do_settings_sections($this->plugin_slug); ?>

					<div class="other-buttons">
						<?php if($repeatables) : ?>
							<a class="button button-small repeatable-add" href="#"><?php echo esc_html($btn_add); ?></a> 
						<?php endif; ?>
						<a class="button button-small reset-to-default" href="#"><?php echo esc_html($btn_reset); ?></a>
					</div>

					<?php submit_button(); ?> 

				</form>

			</div>

			<div class="plugin-body-section-2">
				<span>Help me support the plugin <b>:-)</b></span>
				<?php // Elegant themes banner --edit-- ?>
				<a href="https://www.elegantthemes.com/affiliates/idevaffiliate.php?id=36986_1_1_14" target="_blank" rel="nofollow"><img src="<?php echo esc_url(plugins_url('elegant-themes-160x600.gif', __FILE__)); ?>" style="border:0px" /></a>
				<?php // Elementor page builder banner --edit-- ?>
				<a href="https://be.elementor.com/visit/?bta=208242&nci=5383" target="_blank" rel="nofollow"><img src="<?php echo esc_url(plugins_url('elementor-pro-b-160600.png', __FILE__)); ?>" style="border:0px" /></a>
			</div>

		</div>

	<?php if($repeatables) : ?>
		</div>
	<?php endif; ?>

	<div class="plugin-footer">
		<div class="donate">
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="UYJ5G65M6ZA28">
				<span>If you like this plugin and find it useful, consider making a donation <b>:-)</b></span> <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
		</div>
	</div>

</div>

<script>
	var wpVersion="<?php echo esc_attr(get_bloginfo('version')); ?>",
		repeatables="<?php echo esc_attr($repeatables); ?>",
		shortcodes="<?php echo esc_attr($shortcodes); ?>",
		toggle_instance_title="<?php echo esc_attr($toggle_instance_title); ?>";
</script>
