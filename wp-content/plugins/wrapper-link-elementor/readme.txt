=== Wrapper Link Elementor ===
Contributors: pedrogusmao02
Donate link: https://www.paypal.com/donate/?hosted_button_id=BDA26H487WE2Q
Tags: elementor, link
Requires at least: 5.0
Tested up to: 6.2
Stable tag: 1.0.5
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Elementor Link Wrapper allow you to place custom links into sections and columns on Elementor.

== Description ==

Elementor Link Wrapper allow you to place custom links into sections and columns on Elementor. You can choose the link implementation method and you can also use dynamic links for internal links.

For backwards compatibility, if this section is missing, the full length of the short description will be used, and Markdown parsed.

== Frequently Asked Questions ==

= What is the difference between HTML and JS implementation methods? =

On the HTML implementation method, after setting the link a <a> tag will be created as the wrapper parent. On JS, the link redirect will be set through jQuery (onclick() method). On the JS method, you may have to insert the "cursor: pointer" manually on the wrapper to display it's clickable. On the HTML <a> tag injection, you may experience some trouble because of the CSS styling of this tag, so you may customize it also.

= Which link settings are being transported to the frontend? =

On link settings, you can set multiple features: Link in new tab or not (target), nofollow, custom values and others.
At this time, the plugin will only read the target setting, not the others.

= Which plugins are compatible with Wrapper Link Elementor? =

At this time you may experience some difficulties using the dynamic link with other plugins that extend Elementor, such as Elementor Custom Skin and others. I'm working on improvements for the next releases.


== Screenshots ==

1. Elementor advanced tab, where the Wrapper Link can be set through implementation method and custom link.

== Changelog ==

= 1.0.1 =

* Tested with WordPress 6.2

= 1.0 =
* Official release