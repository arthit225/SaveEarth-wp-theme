<?php

namespace WPFancyBox3;

/**
 * Class WPfancyBox3
 * @package WPFancyBox3
 */
class Core
{

    /**
     * @var string
     */
    protected static $key = 'wpfancybox3';

    /**
     * @var string
     */
    protected static $pluginURL;

    /**
     * @var string
     */
    protected static $pluginBasename;

    /**
     * @var string
     */
    protected static $pluginSettingsURL;

    /**
     * @var
     */
    protected static $pluginDir;

    /**
     * @var string
     */
    protected static $version = '1.0.13';

    /**
     * @var string
     */
    protected static $selector = 'a[href*=".jpg"]:not(.nolightbox,li.nolightbox>a), area[href*=".jpg"]:not(.nolightbox), a[href*=".jpeg"]:not(.nolightbox,li.nolightbox>a), area[href*=".jpeg"]:not(.nolightbox), a[href*=".png"]:not(.nolightbox,li.nolightbox>a), area[href*=".png"]:not(.nolightbox)';

    /**
     * WPfancyBox3 constructor.
     *
     * @param $pluginFile
     */
    public function __construct($pluginFile)
    {
        static::$pluginURL         = plugins_url('/', $pluginFile);
        static::$pluginBasename    = plugin_basename($pluginFile);
        static::$pluginDir         = plugin_dir_path($pluginFile);
        static::$pluginSettingsURL = admin_url('options-general.php?page='.static::$key);

        add_action('plugins_loaded', array($this, 'loadTranslations'));
        add_action('wp_enqueue_scripts', array($this, 'registerAssets'));
        add_action('admin_enqueue_scripts', array($this, 'registerAssetsAdmin'));
        add_action('wp_footer', array($this, 'renderFront'), 999);
        add_action('admin_menu', array($this, 'addOptionsPage'));
        add_action('admin_init', array($this, 'registerOptions'));
        add_filter('plugin_action_links_'.static::$pluginBasename, array($this, 'filterPluginLinks'));
        add_filter('img_caption_shortcode', array($this, 'filterImgCaptionShortcode'), 10, 3);
        add_filter('wp_get_attachment_link', array($this, 'filterGetAttachmentLink'), 10, 2);
    }

    /**
     * Load translations for the plugin.
     *
     * @return void
     */
    public function loadTranslations()
    {
        load_plugin_textdomain(static::$key, false, 'wp-fancybox-3/languages');
    }

    /**
     * Register assets in WordPress for the front area.
     *
     * @return void
     */
    public function registerAssets()
    {
        wp_enqueue_script('jquery-fancybox', static::$pluginURL.'assets/js/jquery.fancybox.min.js',
            array('jquery'),
            static::$version, true);

        wp_enqueue_style('jquery-fancybox', static::$pluginURL.'assets/css/jquery.fancybox.min.css', null,
            static::$version, 'screen');
    }

    /**
     * Register assets for admin area
     */
    public function registerAssetsAdmin()
    {
        wp_register_style(static::$key, static::$pluginURL.'assets/css/admin.css', null, static::$version,
            'screen');
    }

    /**
     *  Method adds a link to admin menu
     */
    public function addOptionsPage()
    {
        add_options_page(
            __('WP fancyBox3 Settings', static::$key),
            __('WP fancyBox3', static::$key),
            'manage_options',
            static::$key,
            array($this, 'renderAdmin')
        );
    }

    /**
     * Method adds a new one link to array
     *
     * @param array $links
     *
     * @return array
     */
    public function filterPluginLinks($links)
    {
        $links[] = '<a href="'.static::$pluginSettingsURL.'">'.__('Settings', static::$key).'</a>';

        return $links;
    }

    /**
     * Register plugin's options in WP
     *
     * @return void
     */
    public function registerOptions()
    {
        register_setting(static::$key, static::$key);
    }

    /**
     * Output options page Page.
     *
     * @return void
     * @throws \Exception
     */
    public function renderAdmin()
    {
        wp_enqueue_style(static::$key);

        $options  = get_option(static::$key, array());
        $selector = static::$selector;
        $template = static::$pluginDir.'/templates/admin.php';
        $template = apply_filters('wpfancybox3_admin_template', $template);

        if ( ! file_exists($template)) {
            throw new \RuntimeException('No template file found');
        }

        $render = function () use ($template, $options, $selector) {
            include $template;
        };

        $render();
    }

    /**
     * Render script on site area
     * @throws \RuntimeException
     */
    public function renderFront()
    {
        wp_enqueue_style('jquery-fancybox');
        wp_enqueue_script('jquery-fancybox');

        $options  = get_option(static::$key, array());
        $selector = ! empty($options['selector']) ? $options['selector'] : static::$selector;

        if (is_admin_bar_showing()) {
            $options['baseClass'] = ! empty($options['baseClass']) ? $options['baseClass'].' admin-bar' : 'admin-bar';
        }

        $template = static::$pluginDir.'/templates/front.php';
        $template = apply_filters('wpfancybox3_front_template', $template);

        if ( ! file_exists($template)) {
            throw new \RuntimeException('No template file found');
        }

        $render = function () use ($template, $options, $selector) {
            include $template;
        };

        $render();
    }

    /**
     * Modify media tag and pass caption into a link
     *
     * @param $a
     * @param $attr
     * @param $content
     *
     * @return mixed|string
     */
    public function filterImgCaptionShortcode($a, $content, array $attr = array())
    {
        $content = preg_replace('/href=/', ' data-caption="'.esc_html($attr['caption']).'" href=$1',
            $content);

        // code below is copied from \wp-includes\media.php
        $atts = shortcode_atts(array(
            'id'      => '',
            'align'   => 'alignnone',
            'width'   => '',
            'caption' => '',
            'class'   => '',
        ), $attr, 'caption');

        $atts['width'] = (int)$atts['width'];

        if ($atts['width'] < 1 || empty($atts['caption'])) {
            return $content;
        }

        if ( ! empty($atts['id'])) {
            $atts['id'] = 'id="'.esc_attr(sanitize_html_class($atts['id'])).'" ';
        }

        $class = trim('wp-caption '.$atts['align'].' '.$atts['class']);

        $html5         = current_theme_supports('html5', 'caption');
        $width         = $html5 ? $atts['width'] : (10 + $atts['width']);
        $caption_width = apply_filters('img_caption_shortcode_width', $width, $atts, $content);
        $style         = '';

        if ($caption_width) {
            $style = 'style="max-width: '.(int)$caption_width.'px" ';
        }

        if ($html5) {
            $html = '<figure '.$atts['id'].$style.'class="'.esc_attr($class).'">'
                    .do_shortcode($content).'<figcaption class="wp-caption-text">'.$atts['caption'].'</figcaption></figure>';
        } else {
            $html = '<div '.$atts['id'].$style.'class="'.esc_attr($class).'">'
                    .do_shortcode($content).'<p class="wp-caption-text">'.$atts['caption'].'</p></div>';
        }

        return $html;
    }

    /**
     *
     * @param $html
     * @param $id
     *
     * @return mixed
     */
    public function filterGetAttachmentLink($html, $id)
    {
        $attachment = get_post($id);

        if (trim($attachment->post_excerpt)) {
            $html = preg_replace('/href=/', ' data-caption="'.esc_attr($attachment->post_excerpt).'" href=$1',
                $html);
        }

        return $html;
    }
}