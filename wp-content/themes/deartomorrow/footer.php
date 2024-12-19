<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package deartomorrow
 */

?>

</div><!-- #content -->


    <div style="clear: both; width: 100%; height: 1px; font-size: 1px; line-height: 1px;">&nbsp;</div>

	<footer id="colophon" class="site-footer" role="contentinfo">
        <div class="footer-inner">
            <?php dynamic_sidebar( 'footer-1' ); ?>	
            <div class="clear" style="width: 100%; clear: both; height: 1px; font-size: 1px; line-height: 1px;">&nbsp;</div>
        </div>
        <div class="clear" style="width: 100%; clear: both; height: 1px; font-size: 1px; line-height: 1px;">&nbsp;</div>
    </footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
