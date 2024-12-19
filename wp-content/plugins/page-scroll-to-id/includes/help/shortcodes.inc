<?php
$help_shortcodes_text=<<<EOD

<p>Plugin's <code>[ps2id]</code> shortcode can be inserted directly in WordPress post editor (as with any WordPress shortcode) in order to create links and id targets in your content.</p>

<p>
	<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-shortcodes-link" target="_blank"><strong>Link shortcode</strong></a> - <code>[ps2id url='#some-id']link text[/ps2id]</code>
</p>

<p>
	<strong>Attributes</strong> 
</p>

<ul>
	<li>
		<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-shortcodes-link-url" target="_blank">url</a> (required) - Link URL
	</li>
	<li>
		<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-shortcodes-link-offset" target="_blank">offset</a> (optional) - Link-specific offset (bypasses the general offset value in plugin settings)  <br /> 
		Examples: <code>[ps2id url='#some-id' offset='100']link text[/ps2id]</code> (offset scrolling by 100 pixels), <code>[ps2id url='#some-id' offset='#navigation-menu']link text[/ps2id]</code> (Offset scrolling by the height/width of the element with id <code>navigation-menu</code>)
	</li>
	<li>
		<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-shortcodes-link-class" target="_blank">class</a> (optional) - Link custom class(es) <br />
		You can give the link one or more custom classes, e.g. <code>[ps2id url='#some-id' class='class-a class-b']link text[/ps2id]</code> <br />
		Adding a special class in the form of <code>ps2id-speed-VALUE</code>, will change the scroll duration/speed of that link. For example, <code>[ps2id url='#some-id' class='ps2id-speed-400']link text[/ps2id]</code> will set link's scroll duration to 400 milliseconds.</code>
	</li>
</ul>

<p>
	<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-shortcodes-target" target="_blank"><strong>Target id shortcode</strong></a> - <code>[ps2id id='some-id'/]</code> (anchor-point target) or <code>[ps2id_wrap id='some-id'] your content... [/ps2id_wrap]</code> (wrapper target)
</p>

<p>
	<strong>Attributes</strong> 
</p>

<ul>
	<li>
		<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-shortcodes-target-id" target="_blank">id</a> (required) - Target id 
	</li>
	<li>
		<a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#plugin-shortcodes-target-target" target="_blank">target</a> (optional) - The element that’ll be considered as the actual target for highlighting <br /> 
		Examples: <code>[ps2id id='some-id' target='#some-id + div'/]</code> (the associated link will scroll to <code>#some-id</code> element but will be highlighted as if its target is the next adjacent div, i.e. the div immediately following <code>#some-id</code> element) 
	</li>
</ul>

EOD;
?>

<?php _e($help_shortcodes_text, $this->plugin_slug); ?>