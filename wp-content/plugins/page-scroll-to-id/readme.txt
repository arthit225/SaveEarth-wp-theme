=== Page scroll to id ===
Contributors: malihu
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=UYJ5G65M6ZA28
Tags: page scrolling, page animation, smooth scroll, navigation, single-page navigation
Requires at least: 3.3
Tested up to: 6.4
Stable tag: 1.7.9
License: The MIT License (MIT)
License URI: http://opensource.org/licenses/MIT

Create links that scroll the page smoothly to any id within the document.

== Description ==

**Page scroll to id** is a fully featured plugin which replaces browser's "jumping" behavior with a [smooth scrolling animation](http://manos.malihu.gr/repository/page-scroll-to-id/demo/demo.html), when links with href value containing # are clicked. It provides all the basic tools and advanced functionality for single-page websites, in-page navigation, back-to-top links etc. with features like: 

* Adjustable scrolling animation [duration and easing (over 30 easing types)](http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-scroll-type-easing)
* Link and target highlighting via ready-to-use CSS classes
* [Vertical](http://manos.malihu.gr/repository/page-scroll-to-id/demo/demo.html) and/or [horizontal](http://manos.malihu.gr/repository/page-scroll-to-id/demo/demo-horizontal-layout.html) scrolling
* Scrolling from/to different pages (scrolling to target id on page load)
* Offset scrolling by pixels or element selector with custom expressions
* Insert link and target id buttons in post visual editor 
* Link-specific offset, scrolling duration, highlight target etc.

[Demo (default animation duration/easing, link highlighting etc.)](http://manos.malihu.gr/repository/page-scroll-to-id/demo/demo.html) 

= Plugin resources, links and tutorials =

* [Plugin homepage](http://manos.malihu.gr/page-scroll-to-id-for-wordpress/)
* [Knowledge Base - FAQ](http://manos.malihu.gr/page-scroll-to-id-for-wordpress/2/)
* [Basic tutorial](http://manos.malihu.gr/page-scroll-to-id-for-wordpress-tutorial/) - [Video tutorial](http://manos.malihu.gr/page-scroll-to-id-for-wordpress-tutorial/#video-tutorial)
   * [Using Page scroll to id with the Divi Builder plugin](http://manos.malihu.gr/using-page-scroll-to-id-with-the-divi-builder-plugin/)
   * [Using Page scroll to id with SiteOrigin Page Builder](http://manos.malihu.gr/using-page-scroll-to-id-with-siteorigin-page-builder/)
   * [Using Page scroll to id with WPBakery Page Builder](http://manos.malihu.gr/using-page-scroll-to-id-with-wpbakery-page-builder/)
   * [Using Page scroll to id with Elementor Page Builder](http://manos.malihu.gr/page-scroll-to-id-elementor-guide/)
* [Support](http://wordpress.org/support/plugin/page-scroll-to-id)

= Requirements =

Page scroll to id requires WordPress version **3.3** or higher (jQuery version **1.7.0** or higher) and your theme **must** (and should) have `wp_head()` and `wp_footer()` functions. In some Microsoft Windows based web servers some plugins might produce an error 500 (depends on server/PHP configuration). To pinpoint the issue [enable debugging](https://codex.wordpress.org/Debugging_in_WordPress) in `wp-config.php` and check `wp-content/debug.log` file for relevant errors.

= GDPR (General Data Protection Regulation) =

The plugin is GDPR compliant. It does not use or store any kind of user information/data. In fact, it's functionality has nothing to do with user data (personal or otherwise). So there's that.

= Quick usage and tips =

1. [Install the plugin](http://wordpress.org/plugins/page-scroll-to-id/installation/). 
2. The plugin is enabled by default on your WordPress Menu links, so you can start adding custom links and set their URL to the id/target you want to scroll to. 
3. Create id targets within your content using plugin's "Insert Page scroll to id target" button and/or shortcode (see contextual "Help" menu in plugin settings page) in post visual/text editor. Create targets in widgets areas using "Page scroll to id target" widget. 
5. Create links within your content using plugin's "Insert/edit Page scroll to id link" button and/or shortcode in post visual/text editor. You can also add the class `ps2id` on any existing link you want to be handled by the plugin. 

For more info [see plugin's basic tutorial](http://manos.malihu.gr/page-scroll-to-id-for-wordpress-tutorial/)

== Installation ==

= Automatic =

1. Click 'Add New' under 'Plugins' menu in WordPress. 
2. Perform a search for the term 'Page scroll to id' and in search results, click 'Install/Install Now' under plugin name. 
3. When installation is finished, click 'Activate Plugin'. 

= Manual =

1. Download and extract the plugin. 
2. Upload the entire `page-scroll-to-id` folder to `/wp-content/plugins/` directory. 
3. Activate the plugin through the 'Plugins' menu in WordPress. 

= Configuration =

Configure plugin options by clicking 'Settings' under plugin name or through the 'Settings' menu in WordPress administration. 

== Frequently Asked Questions ==

Please visit plugin's [Knowledge Base - FAQ](http://manos.malihu.gr/page-scroll-to-id-for-wordpress/2/) for up-to-date info and guides. 

= Is it GDPR compliant? =

Yes.

= Why it hasn't been updated for x weeks/months? =

Because it works and it already has a ton of features. The plugin has little dependency on WordPress functions so it doesn't need to be updated every time WordPress updates (that's why it works on ancient WordPress versions like 3.3). 

== Screenshots ==

1. "Page scoll to id" settings 

2. "Page scoll to id" settings help 

3. Multiple selectors in plugin settings

4. "Page scoll to id" target widget and widget id values 

5. Visual editor "Insert/edit Page scoll to id link" modal

6. Visual editor "Insert Page scoll to id target" modal

7. Gutenberg block editor "Page scoll to id target" custom block

== Changelog ==

= 1.7.9 =

* Fixed various PHP 8 warnings. 
* Changed plugin shortcodes files to adhere to wp coding standards. 

= 1.7.8 =

* Added aria-label attribute in plugin shortcodes (requires PHP v5.3 or greater). 
* Changed plugin shortcodes markup to remove empty attributes. 
* Fixed PHP warning (Array to string conversion) in PHP 8 installations - [related issue](https://wordpress.org/support/topic/errors-after-php-upgrade/). 
* Fixed issue with text formatting in plugin admin page - [related issue](https://wordpress.org/support/topic/text-formatting-plugin-admin-page/). 
* Modified various plugin files to comply with the WordPress Coding Standards. 
* Fixed an issue with shortcodes not working in WordPress 2022 theme editor. 
* Created the special class "ps2id-auto-scroll" to easily auto-scroll to a target id with this specific class on page load.

= 1.7.7 =

* Changed a couple of plugin functions in order to comply with the WordPress Coding Standards.

= 1.7.6 =

* Fixed various PHP notices and warnings.
* Extended unbind unrelated click events extra/deferred script. 
* Patched vulnerability in plugin's shortcode. 

= 1.7.5 =

* Fixed various PHP 7.4 and PHP 8 notices and warnings appearing on plugin installation.
* Fixed a minor javascript expression issue. 
* Fixed PHP warning with old PHP versions (5.2 and 5.3). 

= 1.7.4 =

* Added link-specific offset special class (ps2id-offset-NUMBER) for WordPress Menu items. For example adding the class ps2id-offset-150 to a menu item, will give the link an offset of 150.
* Extended plugin's offset selector expressions with the :sticky selector. 

= 1.7.3 =

* Fixed issue with target id attribute having special characters (like %, &, # etc.).
* Extended "Prevent other scripts from handling plugin’s links" option with special selector option field. 
* Removed jQuery 1.x deprecated functions from plugin script (.bind, .delegate, .unbind etc. are replaced with .on, .off etc.).
* Updated plugin's contextual help and notices. 

= 1.7.2 =

* Added an extended "Verify target position and readjust scrolling" option for lazy-load images, iframes, changes in document's length etc.
* Added "Force scroll type/easing" option for dealing with conflicts with outdated easing libraries added by themes or other plugins. 
* Updated plugin's settings page, contextual help and notices. 

= 1.7.1 =

* Update plugin's settings page and notices.

= 1.7.0 =

* Removed recommended plugins. 
* Updated plugin screenshots. 
* Updated readme.txt

= 1.6.9 =

* Added warning message in plugin settings when the selector option value lacks quotes (invalid without jquery migrate or with jquery 3.x).
* Fixed Uncaught TypeError of undefined data when actual page is inside an iframe - [related issue](http://manos.malihu.gr/page-scroll-to-id-for-wordpress/comment-page-7/#comment-23715).
* Added 'Encode unicode characters on links URL' option in plugin settings help panel.
* Extended "Prevent other scripts from handling plugin’s links" option function handler. 
* Replaced jQuery deprecated ready event in plugin script. 

= 1.6.8 =

* Fixed PHP notice/warning regarding contextual_help being deprecated (https://wordpress.org/support/topic/deprecated-contextual_help-is-obsolete-since-version-3-3-0/). 
* Added new option 'Encode unicode characters on links URL'. This option can be used when having links with encoded unicode characters (e.g. on internationalized domain names) in their href/URL.
* Added support for dynamic/live selectors for newer jQuery versions (3.x) and the upcoming WordPress 5.6.

= 1.6.7 =

* Fixed issue with links having meta characters (e.g. %) in URL. 
* Extended the default excluded selectors. 
* Fixed issue with TwentyTwenty theme smooth scrolling feature (https://wordpress.org/support/topic/scrolling-not-working-5/) 
* New feature for developers: add plugin options manually (via js) to overwrite the ones in plugin settings. 

= 1.6.6 =

* Fixed dynamic elements would not work automatically (issue in 1.6.5).
* Fixed some links would not get highlighted when using full URLs (issue in 1.6.5).

= 1.6.5 =

* Added new option to exclude specific selectors from being handled by the plugin.
* Added new option 'Auto-generate #ps2id-dummy-offset element'.
* Added 'Page scroll to id target' block for Gutenberg block editor.
* Added new feature for Gutenberg block editor: 
* Fixed highlight not working in URLs with an apostrophe.
* Fixed [this issue](https://wordpress.org/support/topic/only-works-on-initial-page-load/#post-11168522) regarding plugin's default selector when using non-WordPress jQuery library.
* Fixed [this minor issue](https://wordpress.org/support/topic/no-more-smooth-scrolling/). 
* Fixed multisite issue where few plugin options would not save/update properly.
* Fixed [issue #10](https://github.com/malihu/page-scroll-to-id/issues/17)
* Updated plugin's contextual help and documentation. 

= 1.6.4 =

* Fixed a minor bug affecting the "Prevent other scripts from handling plugin's links" option. 

= 1.6.3 =

* Fixed a bug which was breaking page scrolling in some WordPress themes/installations in version 1.6.2. 
* Fixed a bug regarding links with URL in non-latin characters (e.g. Greek, Cyrillic etc.). 
* Better plugin version control for multisite installations. 
* Fixed PHP 7 notices and warnings. 
* Plugin is now enabled by default on all links with a non-empty hash value (e.g. #some-id) in their URL.
* Changed default scroll duration from 1000 to 800 milliseconds.
* Added support for anchors inside SVG elements. 
* Added new option 'Verify target position and readjust scrolling if necessary'.
* Added new option 'Use element custom offset when scrolling from/to different pages'.
* Added new option 'Remove URL hash when scrolling from/to different pages'.

= 1.6.2 =
* Changed default options for scroll duration and easing type. Plugin is now enabled by default on WordPress menu items/links. These changes affect only first-time installations (upgrading won't change these options).
* Extended plugin's settings page and renamed few options to less technical terms.
* Added special class/option for creating links with alternative scroll duration/speed.
* Extended plugin buttons on WordPress visual editor (non-shortcode links, custom classes etc.).
* Added new option 'Append the clicked link’s hash value to browser’s URL/address bar'.
* Added new option 'Stop page scrolling on mouse-wheel or touch-swipe'.
* Added new option 'Prevent other scripts from handling plugin’s links'.
* Added new option 'Normalize anchor-point targets'.
* Relative-root links are now properly highlighted.
* Added `wp-config.php` option for selecting which script files the plugin loads (minified or uncompressed).
* Only necessary CDATA values are passed on the front-end script.
* Added compatibility for latest non-WordPress jQuery versions (2.x and 3.x).
* Fixed a bug regarding shortcode's offset attribute when used with "auto" layout.
* Fixed a php notice when updating plugin from version 1.6.0.
* Added workaround for IE/Edge not starting from the top when scrolling to hash on page load.
* Updated readme.txt, contextual help and documentation.

= 1.6.1 =
* Added additional default selectors: `.ps2id > a[href*='#'],a.ps2id[href*='#']`. 
* Added "Page scroll to id target" widget. 
* Added custom buttons in WordPress visual editor for plugin's shortcodes insertion. 
* Added new option 'Enable on WordPress Menu links' in plugin settings. 
* Fixed browser's history back button when 'Scroll to location hash' option is enabled. 
* Updated readme.txt.
* Extended help and documentation.

= 1.6.0 =
* Fixed contextual help shortcut links in plugin settings page. 
* Added new option 'Enable for all targets' for 'Scroll to location hash'. 
* Added new option 'Delay' for 'Scroll to location hash'. 
* Fixed an issue regarding invalid selectors with location hash. 
* Updated readme.txt.
* Updated help.

= 1.5.9 =
* Extended `ps2id` shortcode for creating `div` elements (in addition to anchors). 
* Added `ps2id_wrap` shortcode for creating target wrappers in content editor. 
* Extended offset selector expressions with `:position`, `:height()` and `:width()`.
* Updated readme.txt.
* Updated help.

= 1.5.8 =
* Fixed various PHP notices in debug mode. 
* Minor script optimizations. 

= 1.5.7 =
* Added 'Highlight by next target' option. When enabled, highlight elements according to their target and next target position (useful when targets have zero dimensions).
* Extended `ps2id` shortcode for creating targets in content editor. 

= 1.5.6 =
* Changed the way 'Force single highlight' option works. When enabled, it now highlights the first highlighted element instead of last.
* Extended highlight and target classes with additional ones in order to differentiate the first and last elements. You can now use `.mPS2id-highlight-first`, `.mPS2id-highlight-last`, `.mPS2id-target-first` and `.mPS2id-target-last` in order to target the first and last highlighted links and targets in your CSS.
* Added 'Keep highlight until next' option. When enabled, the plugin will keep the current link/target highlighted until the next one comes into view (one element always stays highlighted).
* Added 'Disable plugin below screen-size' option. Set the screen-size (in pixels), below which the plugin will be disabled. 

= 1.5.5 =
* Fixed contextual help links in plugin settings page.
* Updated Offset field to accept comma separated values for defining different offsets for vertical and horizontal layout (e.g. `100,50`).
* Added 'Scroll to location hash' option. When enabled, the plugin will scroll to target id (e.g. `<div id="id" />`) based on location hash (e.g. `mysite.com/mypage#id`) on page load.
* Updated readme.txt.
* Updated help.

= 1.5.4 =
* Fixed a minor bug in jquery.malihu.PageScroll2id-init.js.
* Updated screenshots.
* Updated readme.txt.

= 1.5.3 =
* Extended Offset option to accept element selectors in addition to fixed pixels values. 
* Added `ps2id` shortcode for creating links in content editor. 
* Added the ability to define link specific offsets via the html data attribute: `data-ps2id-offset`. 
* Fixed some minor issues for WordPress versions lower than 3.5. 
* Updated help and external links. 
* Changed plugin license from LGPL to MIT. 

= 1.5.2 =
* Minor code tweaks. 

= 1.5.1 =
* Minor code tweaks. 
* Minified scripts. 

= 1.5.0 =
* Dropped jQuery UI dependency (jQuery UI is no longer required for the plugin to work). 
* Fixed the bug of non-working links to other pages. The script now checks if href values refer to the parent document, before preventing the default behavior. 
* Fixed the bug regarding selectors referencing body class not working. 
* Any link handled by the plugin with href value `#top` will now scroll the page to top, if no element with id `top` exists.  
* Added links highlighting feature. The script adds a class (default: `mPS2id-highlight`) automatically on links  whose target elements are considered to be within the viewport. 
* Plugin adds a class (default: `mPS2id-target`) automatically on targets that are considered to be within the viewport. 
* Plugin adds a class (default: `mPS2id-clicked`) automatically on the link that has been clicked. 
* Added `offset` option: Offsets scroll-to position by x amount of pixels (positive or negative). 
* The plugin script now fully validates href values and ids before scrolling the page. 
* Fixed varius minor bugs. 
* Code rewritten and optimized for better performance and maintenance. 
* For more see [Plugin changelog](http://manos.malihu.gr/page-scroll-to-id/4/). 

= 1.2.0 =
* Added support for jQuery version 1.9.

= 1.1.0 =
* Removed the hard-coded plugin directory URL in order to fix errors of pointing .js files to a wrong location.

= 1.0.0 =
* Launch!

== Upgrade Notice ==

= 1.7.9 =

Fixed various PHP 8 warnings, changed plugin shortcodes files to adhere to wp coding standards. 

= 1.7.8 =

Added aria-label attribute and removed empty attributes in plugin shortcodes, fixed PHP (v8) warning (Array to string conversion), fixed issue with text formatting in plugin admin page, fixed an issue with shortcodes not working in WordPress 2022 theme, created the special class "ps2id-auto-scroll" to easily auto-scroll to a target id with this specific class on page load. 

= 1.7.7 =

Changed a couple of plugin functions in order to comply with the WordPress Coding Standards. 

= 1.7.6 =

Fixed various PHP notices and warnings, extended unbind unrelated click events extra/deferred script, patched vulnerability. 

= 1.7.5 =

Fixed various PHP 7.4 and PHP 8 notices and warnings appearing on plugin installation, fixed minor javascript issue, Fixed PHP 5.2 and 5.3 warnings. 

= 1.7.4 =

Added link-specific offset special class (ps2id-offset-NUMBER) for WordPress Menu items, extended plugin's offset selector expressions with the :sticky selector. 

= 1.7.3 =

Fixed issue with target id attribute having special characters, extended "Prevent other scripts from handling plugin’s links" option with special selector option field, removed jQuery 1.x deprecated functions from plugin script, updated plugin's contextual help and notices. 

= 1.7.2 =

Added an extended 'Verify target position and readjust scrolling' option (for lazy-load images, iframes etc.), added 'Force scroll type/easing' option, updated plugin's settings page, contextual help and notices.

= 1.7.1 =

Update plugin's settings page and notices.

= 1.7.0 =

Removed recommended plugins, updated plugin screenshots and readme.txt.

= 1.6.9 =

Added warning message in plugin settings when the selector option value lacks quotes, fixed Uncaught TypeError of undefined data when actual page is inside an iframe, Extended "Prevent other scripts from handling plugin’s links" option, updated help.

= 1.6.8 =

Fixed PHP notice/warning regarding contextual_help, added new option 'Encode unicode characters on links URL', added support for newer jQuery versions (3.x) and the upcoming WordPress 5.6.

= 1.6.7 =

Fixed issue with links having meta characters in URL, extended the default excluded selectors, fixed issue with TwentyTwenty theme smooth scrolling.

= 1.6.6 =

Fixed dynamic elements would not work automatically, fixed some links would not get highlighted when using full URLs.

= 1.6.5 =

Added "Page scroll to id target" block and new features for Gutenberg block editor, added exclude selectors option, added new offset options, fixed various issues and bugs. 

= 1.6.4 =

Fixed a minor bug affecting the "Prevent other scripts from handling plugin's links" option. 

= 1.6.3 =

Fixed a bug which was breaking page scrolling in some WordPress themes/installations in version 1.6.2, fixed a bug regarding links with URL in non-latin characters (e.g. Greek, Cyrillic etc.), better plugin version control for multisite installations, fixed PHP 7 notices/warnings. 

= 1.6.2 =

Extended plugin's settings and visual editor buttons, added various new features and options, fixed some minor bugs, added support for latest jQuery. Please see changelog for a complete list of changes and new features. 

= 1.6.1 =

Fixed browser's history back button for 'Scroll to location hash' option, added new options ('Enable on WordPress Menu links'), added plugin's target widget, added plugin's buttons in visual editor, extended default selectors, updated help and readme.txt.

= 1.6.0 =

Fixed some (minor) issues in admin and front-end, added new options ('Enable for all targets' and 'Delay') for 'Scroll to location hash', updated help and readme.txt.

= 1.5.9 =

Extended `ps2id` shortcode, added `ps2id_wrap` shortcode, extended offset selector expressions, updated help and readme.txt.

= 1.5.8 =

Fixed various PHP notices in debug mode, minor script optimizations.  

= 1.5.7 =

Added 'Highlight by next target' option and extended `ps2id` shortcode for creating targets in content editor. 

= 1.5.6 =

'Force single highlight' option will now highlight the first element instead of last, Extended highlight and target classes with additional ones, Added 'Keep highlight until next' and 'Disable plugin below screen-size' options, extended help, updated readme.txt.

= 1.5.5 =

Fixed contextual help links in plugin settings, define different offsets for vertical and horizontal layout, Added 'Scroll to location hash' option, updated readme.txt.

= 1.5.4 =

Fixed a minor bug in jquery.malihu.PageScroll2id-init.js, updated screenshots and readme.txt.

= 1.5.3 =

Extended Offset option, added shortcodes for link creation, updated documentation and added more external resources. 

= 1.5.0 =

Dropped jQuery UI dependency, fixed bugs, added links highlighting, optimized scripts and extended documentation. 

== License ==

MIT

You should have received a copy of the MIT License along with this program. 
If not, see <http://opensource.org/licenses/MIT>.

== Donate ==

If you like this plugin and find it useful, consider making a [donation](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=UYJ5G65M6ZA28) :). 

== Plugin previous/other versions ==

[All plugin versions](http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-versions)

== Other/external resources ==

* [How to create anchor links on WordPress Gutenberg editor](https://www.virfice.com/how-to-create-anchor-links-on-wordpress-gutenberg-editor/)
* [Using Page scroll to id with the Divi Builder plugin](http://manos.malihu.gr/using-page-scroll-to-id-with-the-divi-builder-plugin/)
* [One Page WordPress Smooth Scrolling Menu - How to Use Page Scroll to ID Plugin 2017](https://www.youtube.com/watch?v=ZJt7-0W-DeE)
* [Smooth scrolling between page sections using Page scroll to id](http://sridharkatakam.com/smooth-scrolling-page-sections-using-page-scroll-id/)
* [Video tutorial: How to create a single page WordPress website](http://www.pootlepress.com/2013/02/video-tutorial-a-beginners-guide-on-how-to-create-a-single-page-wordpress-website/)
* [GeneratePress - Elementor - Page Scroll to ID - One Page Website](http://snifflevalve.com/tutorials/generatepress-elementor-page-scroll-id-one-page-website/)
* [Onepage Wordpress - Page scroll to iD plugin](https://www.youtube.com/watch?v=XZ4SbV3aZb8)