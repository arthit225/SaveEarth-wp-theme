<?php
$heading = get_sub_field('heading');
$background_image = esc_url(get_sub_field('background_image'));
$cta_button = get_sub_field_object('cta_button');
$cta_button_text = $cta_button['value']['text'];
$cta_button_link = $cta_button['value']['link'];
$cta_button_icon = $cta_button['value']['icon'];
$videos = get_sub_field('videos');
?>
<section class="video-gallery pt-32 bg-no-repeat bg-cover"
  style="background-image: url('<?php echo $background_image ?>');"
>
  <div class="h3 text-center text-midnight-blue">
    <?php echo $heading; ?>
  </div>
  <div class="mt-2 text-center">
    <a class="btn btn--link text-midnight-blue"
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
  </div>
  <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-8 pb-4 gap-4 mt-9">
  <?php
    foreach ($videos as $video) {?>
      <div class="video-wrapper aspect-video-portrait">
        <?php
          $video_url = $video['video_url'];
          $image = $video['thumbnail'];
          if($video_url === "") {
            // Code to execute for each value
            if ($image) {
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
            }
        ?>
          <picture>
            <source srcset="<?php echo $image_url ?>">
            <img class="lazyload" alt="<?php echo esc_attr($alt); ?>" loading="lazy"/>
          </picture>
        <?php
          } else {
        ?>
          <video autoplay loop muted>
            <source src="<?php echo $video_url;?>" type="video/mp4" />
            Your browser does not support the video tag.
          </video>
        <?php
          }
        ?>
          <div class="play-count">225</div>
      </div>
    <?php
    }
    ?>
  </div>
</section>
