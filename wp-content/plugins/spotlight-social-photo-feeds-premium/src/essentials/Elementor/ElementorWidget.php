<?php

namespace RebelCode\Spotlight\Instagram\Essentials\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

/**
 * The Spotlight Elementor widget.
 *
 * @since 0.4
 */
class ElementorWidget extends Widget_Base
{
    /**
     * @since 0.4
     *
     * @var callable
     */
    protected static $renderAction;

    /** @var string[] */
    protected static $frontStyles;

    /**
     * Sets the static props for the widget.
     *
     * This is needed because Elementor widget class constructors cannot be overridden.
     *
     * @param callable $renderAction The render callback.
     * @param string[] $frontStyles  The front-end style handles.
     */
    public static function setStaticProps(callable $renderAction, array $frontStyles)
    {
        static::$renderAction = $renderAction;
        static::$frontStyles = $frontStyles;
    }

    /**
     * @inheritDoc
     *
     * @since 0.4
     */
    public function get_name()
    {
        return 'sl-insta-feed';
    }

    /**
     * @inheritDoc
     *
     * @since 0.4
     */
    public function get_title()
    {
        return __('Spotlight Instagram Feed', 'sl-insta');
    }

    /**
     * @inheritDoc
     *
     * @since 0.4
     */
    public function get_icon()
    {
        return 'eicon-instagram-post';
    }

    /**
     * @inheritDoc
     *
     * @since 0.4
     */
    public function get_categories()
    {
        return ['general'];
    }

    /** @inheritdoc */
    protected function register_controls()
    {
        $this->start_controls_section('sl-insta', [
            'label' => 'Instagram Feed',
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('feed', [
            'type' => ElementorSelectFeedControl::TYPE,
            'label' => __('Select the feed to display or create a new one', 'sl-insta'),
        ]);

        $this->end_controls_section();
    }

    /**
     * @inheritDoc
     *
     * @since 0.4
     */
    public function get_script_depends()
    {
        do_action('spotlight/instagram/localize_config');

        return ['sli-elementor-widget'];
    }

    /**
     * @inheritDoc
     *
     * @since 0.4
     */
    public function get_style_depends()
    {
        return array_merge(['sli-elementor-widget'], static::$frontStyles);
    }

    /**
     * @inheritDoc
     *
     * @since 0.4
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $feedId = $settings['feed'] ?? [];

        echo (static::$renderAction)([
            'feed' => $feedId,
        ]);
    }
}
