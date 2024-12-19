<?php
$text = esc_html(get_sub_field('text'));
$final_text = "";
for ($i=0; $i < 10; $i++) { 
  $final_text .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" . $text ;
}
$bg_color = esc_html(get_sub_field('background_color'));
$bg_color = preg_replace('/\s+/', '-', strtolower($bg_color));
$bg_style = "background-color: var(--$bg_color);";
if($bg_color == "transparent")
  $bg_style = "background-color: transparent";

$text_color = esc_html(get_sub_field('text_color'));
$text_color = preg_replace('/\s+/', '-', strtolower($text_color));
$text_style = "color: var(--$text_color);";
$direction = get_sub_field('reverse_direction') === true ? "right" : "left";
$blend_mode = get_sub_field('blend_mode');
$additional_class = "";
if($blend_mode === "none") {
  $additional_class = "border-t border-b border-paper-white";
} else if($blend_mode === "top") {
  $additional_class = "-mt-16";
  $bg_style = "background-color: transparent";
} else if($blend_mode === "bottom") {
  $additional_class = "-mb-16";
  $bg_style = "background-color: transparent";
}
?>
<section class="marquee relative z-50 py-4 <?php echo $additional_class?>" style="<?php echo $bg_style?>">
  <div 
    class="marquee-container overflow-hidden" 
    data-direction="<?php echo $direction?>" 
    style="<?php echo $text_style?>"
  >
    <p class="h5"><?php echo $final_text;?></p>
  </div>
</section>