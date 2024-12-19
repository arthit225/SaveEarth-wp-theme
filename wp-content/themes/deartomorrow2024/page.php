<?php get_header() ?>
<?php
$post_type = get_post_type( get_the_ID() );
if ( have_rows( 'section_blocks' ) ):
  while ( have_rows( 'section_blocks' ) ): the_row();
    switch ( get_row_layout() ):

      case 'home_hero':
        get_template_part ('inc/sectionblocks/home-hero');
        break;

      case 'letters_swiper':
        get_template_part ('inc/sectionblocks/letters-swiper');
        //get_template_part('inc/flexiblocks/project-description');
        break;

      case 'marquee':
        get_template_part ('inc/sectionblocks/marquee');
        break;

      case 'floating_images':
        get_template_part ('inc/sectionblocks/floating-images');
        break;

      case 'video_gallery':
        get_template_part ('inc/sectionblocks/video-gallery');
        break;

      case 'watch_video':
        get_template_part ('inc/sectionblocks/watch-video');
        break;
      case 'our_team':
        get_template_part('inc/sectionblocks/team');
        break;
      default:
        break;
    endswitch;
  endwhile;
endif;
?>


<!-- <article>
    <header>
        <h1 class="h1 text-center"><?php the_title() ?></h1>
    </header>
    <section class="max-w-screen-lg mx-auto">
        <div class="mt-4">
            <?php the_content() ?>
        </div>
    </section>
</article> -->

<?php get_footer() ?>
