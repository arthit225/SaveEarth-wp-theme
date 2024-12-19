<?php
/**
 * Template Name: Embed Page
 *
 * @package deartomorrow
 */
?>
<?php acf_form_head(); ?>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
    <base target="_top">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site bare">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'bare' );
    
			endwhile; // End of the loop.
			?>

<script>
    jQuery(document).ready(function () {
        var targetvalue = 'dtembedframe';
        jQuery('.acf-form').prop("target", targetvalue);
    });
</script>
    
<?php 
    if (isset($_GET['zwJJARSSKuDuresponseid'])) { 
?>
<script>
    jQuery(document).ready(function(){
        jQuery(this).scrollTop(0);
    });
</script>
    
    
<?php    
    }
?>
    
<?php wp_footer(); ?>
</body>
</html>
