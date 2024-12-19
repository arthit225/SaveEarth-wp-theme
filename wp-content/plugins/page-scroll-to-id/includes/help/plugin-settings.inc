<?php 
$help_plugin_settings_text=<<<EOD

<p><em>Click an option to visit plugin's documentation for additional info and guides</em>.</p>

<p>
	<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-selectors" target="_blank"><strong>Selector(s)</strong></a> - 
	Use this field when you need to instruct the plugin to handle specific links. The value(s) should be anchor tags (<code>a</code>, i.e. links) in the form of <a href="http://www.w3.org/TR/css3-selectors/" target="_blank">strings that represent ways of choosing elements in the DOM</a> (i.e. CSS selectors). Each selector is separated by comma, so multiple selectors can be defined as: <code>selector1, selector2, selector3</code> etc. <br />
	<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-enable-on-wp-menu-links" target="_blank">Enable on WordPress Menu links</a> enables the plugin automatically on custom links created in WordPress Menus (Appearance &rarr; Menus). <br />
	To exclude specific links from being handled by the plugin (e.g. special tabs, accordions, toggles etc.), use the <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-excluded-selectors" target="_blank">selectors are excluded</a> field by adding the element selector(s) you want (separated by comma).
</p>

<p>
	<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-scroll-duration" target="_blank"><strong>Scroll duration</strong></a> - 
	Scroll animation duration (i.e. scrolling speed) in milliseconds (1000 milliseconds equal 1 second). Lower values equal faster scrolling. <br />
	<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-auto-adjust-scrolling-duration" target="_blank">Auto-adjust scrolling duration</a> instructs the plugin to fine-tune scrolling duration/speed according to target and page scroll position.
</p>

<p>
	<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-scroll-type-easing" target="_blank"><strong>Scroll type/easing</strong></a> - 
	Scroll animation easing type (i.e. the way the animation progresses at different points within its duration). <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#ps2id-duration-easings-demo" target="_blank">Click here to see a visual representation &amp; demo of all easing types</a>. <br />
	Enable <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-force-scroll-easing" target="_blank">Force scroll type/easing</a> if the selected animation easing does not seem to take effect (this can happen when there's conflict with outdated easing libraries added by themes or other plugins. 
</p>

<p>
	<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-scroll-behavior" target="_blank"><strong>Scroll behavior</strong></a> - 
	<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-always-scroll-smoothly" target="_blank">Always scroll smoothly when reaching the end of the page/document</a> option adjusts scroll-to position so it does not exceed document length. <br />
	Enable <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-stop-scroll-on-event" target="_blank">Stop page scrolling on mouse-wheel or touch-swipe</a> if you want to stop page scrolling when the user tries to scroll the page manually (e.g. via mouse-wheel or touch-swipe). <br />
	Enabling <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-autocorrect-scroll" target="_blank">Verify target position and readjust scrolling (if necessary), after scrolling animation is complete</a> option, will auto-correct scrolling if the target’s position was changed while the page was scrolling. <br />
	If you need to extend the above option for issues with lazy-load images, iframes, changes in document's length etc., enable <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-autocorrect-scroll-extend" target="_blank">Extend target position verification and scrolling adjustment for lazy-load scripts (images, iframes etc.) and changes in document's length</a>. 
</p>

<p>
	<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-page-layout" target="_blank"><strong>Page layout</strong></a> - 
	Set page scrolling direction (i.e. restrict scrolling) to top-bottom (vertical) or left-right (horizontal) accordingly.
</p>

<p>
	<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-offset" target="_blank"><strong>Offset</strong></a> - 
	Offset scroll-to position by x amount of pixels or by selector. The offset value can a be a positive or negative number (indicating pixels), or a matching set of elements in your html (selector). <br />
	Enable the <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-offset-dummy" target="_blank">Auto-generate <code>#ps2id-dummy-offset</code> element</a> option if you want the plugin to create a hidden element with id <code>ps2id-dummy-offset</code> and use it as the <strong>Offset</strong> option value and in your CSS by giving it a height equal to the amount of offset you want.
</p>

<p>
	<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-highlight-selectors" target="_blank"><strong>Highlight selector(s)</strong></a> - 
	The matching set of elements (i.e. selectors) handled by the plugin, that will be eligible for highlighting. The value(s) should be anchor tags (<code>a</code>, i.e. links).
</p>

<p>
	<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-classes-highlight" target="_blank"><strong>Classes &amp; highlight options</strong></a> - 
	The plugin adds special classes to the links and the target elements it handles according to user action and page scrolling position. You can change the clicked link class, as well as the highlight classes for links and targets. <br />
	Enable <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-force-single-highlight" target="_blank">Allow only one highlighted element at a time</a> to prevent multiple elements from being highlighted at the same time. <br />
	Enable <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-keep-highlight-until-next" target="_blank">Keep the current element highlighted until the next one comes into view</a> when you need to keep at least one element (e.g. a menu link) always highlighted. <br />
	Enable <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-highlight-by-next-target" target="_blank">Highlight by next target</a> to highlight elements according to the next adjucent element from the actual target (useful when target elements have zero dimensions).
</p>

<p>
	<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-links-behavior" target="_blank"><strong>Links behavior</strong></a> - 
	If you want the link’s URL hash value (e.g. <code>#some-id</code>) to appear in browser's address bar when it's clicked, enable <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-append-hash" target="_blank">Append the clicked link's hash value to browser's URL/address bar</a> option. <br />
	<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-scroll-to-different-pages" target="_blank">Scroll from/to different pages</a> option enables the plugin to smoothly scroll a newly loaded page to a target (i.e. the hash value in browser's address bar). <br />
	To use link-specific offsets (instead of the general offset) when scrolling from/to different pages, enable <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-scroll-to-hash-use-element-data" target="_blank">Use element’s custom offset (if it exists) when scrolling from/to different pages</a> option. <br />
	If you want to remove the hash value from browser's address bar when scrolling from/to different pages, enable <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-scrolltohash-remove-url-hash" target="_blank">Remove URL hash when scrolling from/to different pages</a>.
</p>

<p>
	<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-disable-plugin-below" target="_blank"><strong>Disable plugin below</strong></a> - 
	Set the viewport/screen-size in pixels, below which the plugin will be disabled. The value can be <code>width</code> (e.g. <code>1024</code>) or <code>width,height</code> (e.g. <code>1024,600</code>).
</p>

<p>
	<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-administration" target="_blank"><strong>Administration</strong></a> - 
	Check <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-display-widgets-id" target="_blank">Display widgets id attribute</a> to have the id attribute value of each widget (in Appearance &rarr; Widgets) displayed within its panel. <br />
	<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-post-editor-buttons" target="_blank">Enable insert link/target buttons in post visual editor</a> activates plugin’s buttons in WordPress visual editor toolbar.
</p>

<p>
	<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-advanced" target="_blank"><strong>Advanced options</strong></a> - 
	If another plugin or a theme script handles page scrolling and conflicts with "Page scroll to id", try enabling <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-remove-other-click-events" target="_blank">Prevent other scripts from handling plugin’s links</a> option. <br />
	You may add a specific selector for the option above using the <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-remove-other-click-events-selector" target="_blank">Prevent other scripts from handling plugin’s links selector(s)</a> field below. <br />
	Enable <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-advanced-normalize-targets" target="_blank">Normalize anchor-point targets</a> to normalize/reset the CSS properties (height, line-height, border etc.) of anchor-point targets. <br />
	Enable <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-settings-advanced-encode-links" target="_blank">Encode unicode characters on links URL</a> when having links with encoded unicode characters (e.g. on internationalized domain names) in their href/URL.
</p>

EOD;
?>

<?php _e($help_plugin_settings_text, $this->plugin_slug); ?>