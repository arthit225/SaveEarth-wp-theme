<?php
$heading = get_sub_field('heading');
$description = get_sub_field('description');
$cta_button = get_sub_field_object('cta_button');
$cta_button_text = $cta_button['value']['text'];
$cta_button_link = $cta_button['value']['link'];
$cta_button_link_type = $cta_button['value']['link_type'];
$cta_button_embed_code = $cta_button['value']['embed_code_of_modal'];
$bg_color = esc_html(get_sub_field('background_color'));
$bg_color = preg_replace('/\s+/', '-', strtolower($bg_color));
$bg_style = "background-color: var(--$bg_color);";
$video_clip = esc_url(get_sub_field('video_clip'));

switch($bg_color) {
  case "transparent":
    $bg_style = "background-color: transparent";
    $title_style = "color: var(--paper-white)";
    break;
  case "midnight-blue":
    $title_style = "color: var(--paper-white)";
    $desc_style = "color: var(--paper-white);";
    break;
  default:
    $title_style = "color: var(--$bg_color)";
    $button_style = "background-color: var(--midnight-blue);";    
    $desc_style = "color: var(--midnight-blue);";
}

$image = get_sub_field('thumbnail');
if (is_array($image)) {
  // Image Array
  $image_url = $image['url'];
  $alt = $image['alt']; // Optional
} elseif (is_numeric($image)) {
  // Image ID
  $image_url = wp_get_attachment_image_url($image, 'full');
  $alt = get_post_meta($image, '_wp_attachment_image_alt', true); // Optional
} else {
  // Image URL
  $image_url = $image;
  $alt = ''; // Default alt if not available
}
?>
<section class="watch-video pt-96 pb-40 overflow-hidden relative" style="<?php echo $bg_style;?>">
  <div class="absolute top-40 w-full flex justify-center ">
  <?php if(!empty($video_clip)) : ?>
    <video class="w-128 h-full aspect-video object-cover" autoplay muted loop>
      <source src="<?php echo $video_clip ?>" type="video/mp4">
      Your browser does not support HTML5 video.
    </video>
  <?php endif; ?>
  <?php if(empty($video_clip) && !empty($image_url)) : ?>
    <picture>
      <source srcset="<?php echo $image_url ?>" width="512px">
      <img class="object-cover lazyload aspect-video" alt="<?php echo esc_attr($alt); ?>" loading="lazy"/>
    </picture>
  <?php endif; ?>
  </div>
  <div class="flex flex-col items-center relative">
    <div class="h2 text-center  mix-blend-difference" style="<?php echo $title_style;?>">
      <?php echo $heading; ?>
    </div>
    <?php
      if($cta_button_link_type === "modal") {
      ?>
        <button 
          class="btn btn--cta-btn lvideo mt-6" 
          data-embedcode="<?php echo esc_html($cta_button_embed_code);?>"
          style="<?php echo $button_style?>"
        >
          <?php echo esc_html($cta_button_text); ?>
        </button>
      <?php } else { ?>
        <a class="btn btn--cta-btn mt-6" style="<?php echo $button_style?>"
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
    <?php
      }
    ?>
    <p class="w-80 mt-8 desc-sm text-center text-paper-white" style="<?php echo $desc_style?>">
      <?php echo $description; ?>
    </p>
  </div>
</section>
