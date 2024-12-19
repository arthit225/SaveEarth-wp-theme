<?php
/*
Template Name: Go to first child
*/
$pagekids = get_pages("child_of=".$post->ID."&sort_column=menu_order");
if ($pagekids) {
    $firstchild = $pagekids[0];
    wp_redirect(get_permalink($firstchild->ID));
} else {
    // Do whatever templating you want as a fall-back.
}
?>