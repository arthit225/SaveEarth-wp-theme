=== WP fancyBox3 ===
Contributors: ejimford
Donate link: https://web.ejimford.com
Tags: WP fancyBox3, fancybox3, fancybox 3, fancybox, lightbox, gallery, image, photo, video, flash, overlay, youtube, vimeo, dailymotion, pdf, svg, iframe, swf, jquery, webp
Requires at least: 4.8
Tested up to: 6
Stable tag: 1.0.13
License: GPLv2 or later

Plugin provides support for fancyBox3 (jQuery lightbox script for displaying images, videos and more.
Touch enabled, responsive and fully customizable) on whole your website pages. Configure in few clicks!

== Description ==

Plugin provides support for fancyBox3 (jQuery lightbox script for displaying images, videos and more.
Touch enabled, responsive and fully customizable) on whole your website pages. Configure in few clicks!

= Languages =
* English (default)
* Русский

== Installation ==
1. Upload the `wp-fancybox-3` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the Plugins menu in WordPress. After activation, go to menu "Settings" - "WP fancyBox3"
3. Configure the plugin
4. Enjoy!

== Screenshots ==
1. Images gallery
2. Image zoom
3. Sharing
4. Responsive on any device
5. Settings
6. Settings
7. Settings
8. Settings

== Changelog ==
= 1.0.13 =
* Added options for interaction with user

= 1.0.12 =
* Escaping fixes
* Fixed bug with caption in galleries

= 1.0.10 =
* Added support for image caption

= 1.0.9 =
* Bug fixes

= 1.0.7 =
* Added Russian translation
* Added Share feature
* Bug fixes

= 1.0.6 =
* Added hooks support

= 1.0.5 =
* Added translations support
* Bug fixes

= 1.0.2 =
* Bug fixes

= 1.0.0 =
* Release

== Frequently Asked Questions ==

= Plugin doesn't support some features that are in JavaScript version of fancyBox3 =
 Contact me using skype and I'll add this features to my plugin.

= How to override front-end template or change callable function? =
 Just use a hook add_filter('wpfancybox3_front_template', your_function_name) in your functions.php file.
 Function take as param a template filename that now placed by path /wp-fancybox-3/templates/front.php
 Just copy this file in your template and return a new path in your function, for example:

add_filter('wpfancybox3_front_template', 'replace_wpfancybox3');
function replace_wpfancybox3($template) {
    return get_template_directory().'/my_own_template.php';
}

= How to override admin template? =
 Just use a hook add_filter('wpfancybox3_admin_template', your_function_name)
 with the same schema as described above.

= How to override styles? =
 Firstly, disable default styles in your functions.php file:
wp_deregister_style('jquery-fancybox');
 and after that you can use your styles file. If it placed in separated file instead your theme style.css use following code:
wp_enqueue_style('jquery-fancybox', get_template_directory_uri() . '/css/my_own_styles.css');