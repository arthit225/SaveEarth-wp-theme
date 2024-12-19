<?php
/*
Template Name: Redirect Partner
*/
$redirect_parter = $_GET['source'];
if ($redirect_parter) {
    echo $redirect_partner;
    if ($redirect_parter == 'Elders Climate Action') {
        wp_redirect('https://www.deartomorrow.org/type/elders-climate-action/');
    }
    elseif ($redirect_parter == 'Climate Dads') {
        wp_redirect('https://www.deartomorrow.org/type/climate-dads/');
    }
} else {
    // Do whatever templating you want as a fall-back.
}
?>