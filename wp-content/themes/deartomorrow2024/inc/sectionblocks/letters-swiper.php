<?php
$heading = esc_html(get_sub_field('heading'));
$description = esc_html(get_sub_field('description'));
$cta_button = get_sub_field_object('cta_button');
$cta_button_text = $cta_button['value']['text'];
$cta_button_link = $cta_button['value']['link'];
$cta_button_icon = $cta_button['value']['icon'];
$background_image = esc_url(get_sub_field('background_image'));
$swiper_row = get_sub_field_object('swiper_row');
$swiper_row_heading = esc_html($swiper_row['value']['heading']);
$ticker_direction = $swiper_row['value']['heading_ticker_direction'] === true ? "right" : "left";
$swiper_row_description = $swiper_row['value']['description'];
$swiper_row_cta_button = $swiper_row['value']['cta_button'];
$swiper_row_cta_button_text = $swiper_row_cta_button['text'];
$swiper_row_cta_button_link = $swiper_row_cta_button['link'];
$swiper_row_images = $swiper_row['value']['images'];
$marquee_text = "";
for ($i=0; $i < 10; $i++) { 
  $marquee_text .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $swiper_row_heading ;
}
?>
<section class="letters-swiper pt-48 pb-48" style="background-image: url('<?php echo $background_image ?>')">
  <div class="max-w-7xl mx-auto">
    <div class="h4 text-center">
      <?php echo $heading; ?>
    </div>
    <div class="w-full flex flex-col items-center">
      <p class="text-center mt-10 w-96 font-sans text-base">
        <?php echo $description; ?>
      </p>
      <a class="btn mt-10"
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
  </div>
  <div class="heading-marquee overflow-hidden mt-16" data-direction="<?php echo $ticker_direction?>">
    <div class="h3 text-center"> <?php echo $marquee_text; ?></div>
  </div>
  <div class="swiper-container overflow-x-hidden mt-20">
    <div class="swiper-wrapper">
      <?php
      foreach ($swiper_row_images as $image) {
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
        <a href="#" class="swiper-slide">
          <picture>
            <source srcset="<?php echo $image_url ?>">
            <img 
              class="object-cover aspect-[4/5] lazyload"
              alt="<?php echo esc_attr($alt); ?>"
              loading="lazy"
            />
          </picture>
          </a>
      <?php
      }
      ?>
    </div>
    <div class="flex max-w-7xl mx-auto mt-8 sm:mt-12 px-10 justify-between relative flex-col sm:flex-row">
      <div class="flex items-center">
        <div class="swiper-prev-button btn btn--circle-btn mr-11 sm:flex hidden">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
          </svg>
        </div>
        <div class="w-full sm:w-96 desc text-center sm:text-left ">
          <?php echo $swiper_row_description; ?>
        </div>
      </div>
      <div class="flex items-center flex-col sm:flex-row">
        <a href="#" class="btn sm:mr-11 mt-4 sm:mt-0"> <?php echo esc_html($swiper_row_cta_button_text); ?></a>
        <div class="swiper-next-button btn btn--circle-btn sm:flex hidden">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
          </svg>
        </div>
      </div>
    </div>
  </div>
</section>