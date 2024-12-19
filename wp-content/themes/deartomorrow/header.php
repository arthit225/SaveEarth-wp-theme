<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package deartomorrow
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'deartomorrow' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
        <div class="masthead_inner">
                <div class="header-links">
                    <div class="header-links-inner">
                        <?php wp_nav_menu( array( 'theme_location' => 'menu-social', 'menu_id' => 'social-menu' ) ); ?>
                    </div>
                    <div class="clear" style="height: 1px; clear: both;">&nbsp;</div>
                </div>
            <div class="site-branding">
                    <?php
                    $custom_logo_id = get_theme_mod( 'custom_logo' );
                    $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                    if ( has_custom_logo() ) { ?>
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo '<img src="'. esc_url( $logo[0] ) .'" alt="' . get_bloginfo('name') . '">'; ?></a></h1>
                    <?php } else { ?>
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php
                    }

                    ?>
            </div><!-- .site-branding -->
            <h2 class="site-tagline"><?php bloginfo('description'); ?></h2>
            <nav id="site-navigation" class="main-navigation" role="navigation">
                    <?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
                    <div class="clear" style="width: 100%; clear: both; height: 1px; font-size: 1px; line-height: 1px;">&nbsp;</div>

                <div class="clear" style="width: 100%; clear: both; height: 1px; font-size: 1px; line-height: 1px;">&nbsp;</div>
            </nav><!-- #site-navigation -->
        </div>
	</header><!-- #masthead -->
    <div id="searchbox" class="lightbox-deartomorrow"><?php get_search_form(); ?></div>
    <div id="content" class="site-content">
