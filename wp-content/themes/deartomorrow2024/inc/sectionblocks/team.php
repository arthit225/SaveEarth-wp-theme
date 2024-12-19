<?php

function get_custom_post_type_posts($post_type, $field_group_name = 'your_acf_field_group') {
    // Arguments for WP_Query
    $args = array(
        'post_type' => $post_type,
        'posts_per_page' => -1, // Retrieve all posts
        'post_status' => 'publish'
    );
    
    // Initialize the query
    $query = new WP_Query($args);
    
    // Array to store post data
    $posts_data = array();
    
    // Loop through posts
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            
            // Get post details
            $post_id = get_the_ID();
            
            // Prepare post data array
            $post_item = array(
                'id' => $post_id,
                'title' => get_the_title(),
                'content' => get_the_content(),
                'featured_image' => array(
                    'url' => get_the_post_thumbnail_url($post_id, 'full'),
                    'alt' => get_post_meta(get_post_thumbnail_id($post_id), '_wp_attachment_image_alt', true)
                )
            );
            
            // Get ACF field group values
            if (function_exists('get_field')) {
                $type = get_field('type', $post_id);
                $position = get_field('position', $post_id);
                $post_item['type'] = $type;
                $post_item['position'] = $position;
            }
            
            // Add to posts array
            $posts_data[] = $post_item;
        }
        
        // Reset post data
        wp_reset_postdata();
        
        return $posts_data;
    }
    
    return array(); // Return empty array if no posts found
}
/**
 * Filters an array of associative arrays by a specific field name and value.
 *
 * @param array $array The array to filter.
 * @param string $field The field name to filter by.
 * @param mixed $value The value to match.
 * @return array The filtered array.
 */
function filterArrayByField(array $array, string $field, $value): array {
    return array_filter($array, function ($item) use ($field, $value) {
        return isset($item[$field]) && $item[$field] === $value;
    });
}
$team_posts = get_custom_post_type_posts('team');
$team_types = [
    'team'=> 'Our Team',
    'council' => 'The Council',
];
$team_council  = filterArrayByField($team_posts, 'type', 'council');
$team_team = filterArrayByField($team_posts, 'type', 'team');
// Optional: Print or use the retrieved posts
// Uncomment for debugging
// print_r($custom_posts);
?>
<section class="our-team relative bg-midnight-blue text-paper-white pt-14.5 pb-29 overflow-hidden">
    <div class="team-tabs flex gap-13 justify-center">
        <?php
            foreach ($team_types as $type => $label) {
                echo '<h3 class="h3 team-tabs__tab '.(  $type === 'team' ? 'active' : '').'">' . $label . '</h3>'; // Loop through $team_types
            }
        ?>
    </div>
    <div class="team-tab-panels mt-5">
        <?php
        foreach ($team_types as $type => $label) {
            $members = filterArrayByField($team_posts, 'type', $type);
        ?>
        <div class="team-tab-panels__panel <?php echo $type === 'team' ? 'active' : ''; ?>">
            <div class="swiper-container relative">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($members as $member) {
                        // Code to execute for each value
                        if ($member) {
                            $image_url = $member['featured_image']['url'];
                            $alt = $member['featured_image']['alt']; // Optional
                        }
                    ?>
                        <div class="swiper-slide">
                            <div class="team-member-card">
                                <picture>
                                    <source srcset="<?php echo $image_url ?>">
                                    <img 
                                        class="object-cover aspect-square w-full grayscale lazyload" 
                                        alt="<?php echo esc_attr($alt); ?>" 
                                        loading="lazy"
                                    />
                                </picture>
                                <div class="team-member-card__content flex justify-between items-end">
                                    <div class="team-member-card__title">
                                        <h4 class="desc"><?php echo $member['title']; ?></h4>
                                        <p class="desc italic"><?php echo $member['position']; ?></p>  
                                    </div>
                                    <div 
                                        class="team-member-card__btn underline cursor-pointer desc-sm"
                                        data-title="<?php echo $member['title']; ?>"
                                        data-position="<?php echo $member['position']; ?>"
                                        data-photo="<?php echo $image_url; ?>"
                                        data-content="<?php echo $member['content']; ?>"
                                    >
                                        Read Bio
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    
                </div>
                <div class="swiper-navigation hidden sm:flex mx-auto px-8 justify-between relative">
                    <div class="flex items-center">
                        <div class="swiper-prev-button btn btn--circle-btn mr-11">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="swiper-next-button btn btn--circle-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        <?php }?>
    </div>

    <!-- The Modal -->
    <div class="modal-bio">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="absolute w-full h-full bg-cover" style="background-image: url('<?php echo home_url() ?>/wp-content/themes/deartomorrow2024/assets/img/team_modal_bg.png');">
            <span class="modal-close text-center">
                <svg width="15" height="14" viewBox="0 0 15 14" xmlns="http://www.w3.org/2000/svg">
                    <rect x="2" y="0.0209961" width="17" height="2.4" rx="1.2" transform="rotate(45 2 0.0209961)" />
                    <rect y="12.021" width="17" height="2.4" rx="1.2" transform="rotate(-45 0 12.021)" />
                </svg>
            </span>
            <div class="flex flex-col w-full h-full p-12 pt-20 overflow-y-auto items-center">
                <div class="modal-bio__title text-center h4">
                    Modal Bio Title
                </div>
                <div class="modal-bio__position text-center h4">
                    Modal Bio Position
                </div>
                <div class="modal-bio__photo mt-8 w-80 h-80">
                    <picture>
                        <source srcset="<?php echo home_url() ?>/wp-content/themes/deartomorrow2024/assets/img/swiper/1.jpg">
                        <img class="object-cover aspect-square w-full grayscale lazyload" loading="lazy"/>
                    </picture>
                </div>
                <div class="modal-bio__content mt-8 text-center">
                    <p class="desc-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed in ultricies neque. Nullam euismod, lectus a ornare finibus, justo velit facilisis nunc, id gravida arcu enim nec eros. Nullam auctor libero vel velit pellentesque, ut laoreet purus bibendum. Sed varius, velit ac consectetur mattis, velit velit accumsan nisi, vitae gravida sapien nisi eu justo. Quisque non ipsum vel odio elementum convallis.</p>
                </div>
            </div>
        </div>
    </div>
</section>
