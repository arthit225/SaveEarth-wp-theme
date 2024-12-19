<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Public Sans"
    />
    <?php wp_head() ?>
  </head>
  <body <?php body_class('flex flex-col min-h-screen') ?>>

  <?php wp_body_open(); ?>

  <header class="header flex-0 fixed w-full top-0 md:top-10 px-4 lg:px-10">

   <button
    class="header__nav-blocker w-screen h-screen fixed"
    onclick="window.toggleBodyClass('close', 'nav-open', null)">
  <span class="sr-only">Click to close the menu</span>
  </button>

    <div class="header__inner flex justify-between mx-auto">
      <figure class="header__logo">
        <a
          href="<?php echo home_url() ?>"
          rel="home"
          class="flex items-center h-full"
          title="Link to home"
        >
         <span class="header__logo-icon">
          <?php get_template_part ('inc/icons/logo_icon'); ?>
        </span>
         <span class="header__logo-word ml-1.5 hidden sm:block">
          <?php get_template_part('inc/icons/logo_word'); ?>
        </span>
        </a>
      </figure>
      <nav class="main-navigation">
        
        <button class="main-navigation__hamburger flex md:hidden" onclick="window.toggleBodyClass(null, 'nav-open', null)">
          <div class="main-navigation__hamburger-bun">
            <span class="main-navigation__hamburger-pattie"></span>
            <span class="main-navigation__hamburger-pattie"></span>
            <span class="main-navigation__hamburger-pattie"></span>
          </div>
          <span class="sr-only">Click to open and close the menu</span>
        </button>

        <?php echo wp_nav_menu() ?>
      </nav>
    </div>    
  </header>

  <main class="main">