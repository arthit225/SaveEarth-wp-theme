<?php
$help_get_started_text=<<<EOD

<p>
	The plugin works by "connecting" links with href/URL in the form of <code>#my-id</code> or <code>http://my-site.com/page/#my-id</code> to sections/elements within the document with an equivalent id attribute value (e.g. <code>&lt;div id="my-id"&gt;...&lt;/div&gt;</code>). Clicking such links will scroll the page smoothly to their target id position. 
</p>

<p>
	<strong>Get started</strong> by creating or setting-up your links. The plugin is enabled by default on WordPress Menu links (created in Appearance &rarr; Menus), so you can start adding custom links and set their URL to the id/target you want to scroll to (e.g. <code>#my-id</code>, <code>/page/#my-id</code>, <code>http://my-site.com/page/#my-id</code> etc.). <br />
	You can use id values that already exist in your theme or you can create your own id targets using plugin's "Insert Page scroll to id target" button in wp post visual editor or the <code>[ps2id]</code> shortcode (e.g. <code>[ps2id id='my-id'/]</code>). 
</p>

<p>
	To create links within your content, use plugin's "Insert/edit Page scroll to id link" button and/or shortcode (e.g. <code>[ps2id url='#my-id']link text[/ps2id]</code>) in wp post visual/text editor. <br />
	To enable the plugin on existing links, add the <code>ps2id</code> class or the <code>m_PageScroll2id</code> rel attribute to them, making sure the link's href/URL value contains a hash (<code>#</code>) with the id of the section you want to scroll-to. In addition, you can simply add your links CSS selector (e.g. <code>.menu-item a</code>, <code>a[href*=#]:not([href=#])</code> etc.) in "Selector(s)" field in plugin settings.
</p>

<p>
	To highlight your links (or targets), use the classes provided by the plugin in your theme's stylesheet or custom CSS. The default highlight class is <code>mPS2id-highlight</code> but you can set your own in the "Classes &amp; highlight options". For example, to style the highlighted link (the link whose target element is considered to be within the viewport), you could add in your CSS: <br />
	<code>a.mPS2id-highlight{ background: #ff0; }</code> or <code>.menu-item a.mPS2id-highlight{ background: #ff0; }</code> for highlighting custom menus links only.
</p>

<p>
	If you have a fixed-positioned/sticky menu which overlaps your target's content when page scrolling is completed, insert your menu CSS selector or a fixed pixel value in the "Offset" field. For example, inserting <code>#navigation-menu</code> will offset the scroll-to position according to the height/width/position of the element with id <code>navigation-menu</code>. In the same manner, setting the "Offset" value to <code>100</code> will offset page scrolling by 100 pixels. 
</p>

EOD;
?>

<?php _e($help_get_started_text, $this->plugin_slug); ?>