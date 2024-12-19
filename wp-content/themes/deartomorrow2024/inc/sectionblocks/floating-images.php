<?php
$heading = get_sub_field('heading');
$floating_images = get_sub_field('Images');
$background_image = esc_url(get_sub_field('background_image'));
$column_count = 5;
$images_count = count($floating_images);
if ($images_count < $column_count)
  $column_count = $images_count;
$columns = array();
for ($i = 0; $i < $column_count; $i++) {
  $columns[] = array();
}
$images_per_column = 0;
if ($column_count > 0) {
  $images_per_column = ceil((float) $images_count / $column_count);
}

// Randomly distribute images to columns
$image_idx = 0;
while ($image_idx < $images_count) {
  $col_index = rand(0, $column_count - 1);
  if (count($columns[$col_index]) < $images_per_column) {
    $columns[$col_index][] = $floating_images[$image_idx];
  } else {
    $col_index = 0;
    while (count($columns[$col_index]) >= $images_per_column && $col_index < $column_count) {
      $col_index++;
    }
    $columns[$col_index][] = $floating_images[$image_idx];
  }
  $image_idx++;
}

if ($column_count > 0)
  $column_width_rate = 100 / (float) $column_count;

?>
<section 
  class="floating-images text-midnight-blue bg-paper-white py-36 relative bg-no-repeat bg-cover"
  style="background-image: url('<?php echo $background_image ?>');"
>
  <div class="images-container w-full h-full absolute top-0 overflow-hidden">
    <div class="images-wrapper flex flex-wrap w-full h-full py-12">
      <?php
      foreach ($columns as $column) { ?>
        <div
          class="floating-images__column column flex flex-col justify-around h-full"
          style="flex: <?php echo $column_width_rate; ?>%"
        >
          <?php
          foreach ($column as $image) {
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
            <div class="img-wrapper w-full relative h-auto">
              <picture class="relative">
                <source srcset="<?php echo $image_url ?>" width="<?php echo $image['width']; ?>" height="<?php echo $image['height']; ?>">
                <img
                  class="relative lazyload"
                  alt="<?php echo esc_attr($alt); ?>"
                  loading="lazy"
                />
              </picture>
            </div>
            <?php
          }
          ?>
        </div>
        <?php
      }
      ?>
    </div>
  </div>
  <div class="mx-4 lg:mx-10 relative">
    <div class="h1 flex flex-col justify-between h-full text-paper-white mix-blend-difference">
      <?php echo $heading; ?>
    </div>
  </div>
</section>