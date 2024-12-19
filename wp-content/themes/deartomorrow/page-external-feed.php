<?php
/**
Template Name: External Source Feed
 */
?>
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

				get_template_part( 'template-parts/content', 'external-feed' );

			endwhile; // End of the loop.
			?>

<?php wp_footer(); ?>
</body>
</html>
