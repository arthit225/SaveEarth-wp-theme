<?php
$heading = get_sub_field('heading');
$description = get_sub_field('description');
$cta_button = get_sub_field_object('cta_button');
$cta_button_text = $cta_button['value']['text'];
$cta_button_link = $cta_button['value']['link'];
$cta_button_link_type = $cta_button['value']['link_type'];
$cta_button_embed_code = $cta_button['value']['embed_code_of_modal'];
$background_image = esc_url(get_sub_field('background_image'));
$background_video = esc_url(get_sub_field('background_video'));
?>
<div class="home-hero text-paper-white js-video-hero relative">
  <picture class="absolute left-0 top-0 w-full h-full">
    <source srcset="<?php echo $background_image ?>" width="100%" height="100%">
    <img class="lazyload" alt="" loading="lazy">
  </picture>
  <?php if($background_video) : ?>
    <video class="absolute w-full h-full object-cover" autoplay muted loop>
      <source src="<?php echo $background_video ?>" type="video/mp4">
      Your browser does not support HTML5 video.
    </video>
  <?php endif; ?>
  <div
    class="
      home-hero__inner
      mx-4 lg:mx-10
      absolute top-34 left-0 right-0 bottom-14
    ">
    <?php if ($heading): ?>
      <div
        class="
          absolute top-0 left-0 right-0 bottom-0
          h1 flex flex-col justify-between h-full home-hero__text js-video-hero-text
        ">
        <?php echo $heading; ?>
      </div>
    <?php endif; ?>

    <div class="absolute left-0 bottom-0">      
      <?php if ($description): ?>
        <div class="w-80 mb-5 desc-sm">
          <?php echo $description; ?>
        </div>
      <?php endif; ?>
      <?php if ($cta_button): ?>
      <?php if($cta_button_link_type === "modal") { ?>
        <button 
          class="btn btn--cta-btn lvideo" 
          data-embedcode="<?php echo esc_html($cta_button_embed_code);?>"
        >
          <?php echo esc_html($cta_button_text); ?>
        </button>
      <?php } else { ?>
        <a class="btn btn--cta-btn"
          <?php
          if ($cta_button_link) {
              $url = $cta_button_link['url'];         // The URL
              $title = $cta_button_link['title'];     // The link text
              $target = $cta_button_link['target'];   // The target (e.g., _blank)
              // Output the link
              echo 'href="' . esc_url($url) . '" target="' . esc_attr($target) . '" title="'.  esc_html($title). '"';
          } else {
            echo 'href="#"';
          }
          ?>
        >
          <?php echo esc_html($cta_button_text); ?>
        </a>
      <?php } ?>
      <?php endif; ?>
    </div>
  </div>
</div>