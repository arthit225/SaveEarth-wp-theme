<?php

namespace RebelCode\Spotlight\Instagram\Essentials\Elementor;

use Elementor\Base_Data_Control;

/**
 * The widget control for selecting a Spotlight Instagram feed.
 *
 * This widget is used as the main control for the {@link ElementorWidget}.
 *
 * @since 0.4.1
 */
class ElementorSelectFeedControl extends Base_Data_Control
{
    const TYPE = 'sli-select-feed';

    /**
     * @inheritDoc
     *
     * @since 0.4.1
     */
    public function get_type()
    {
        return static::TYPE;
    }

    /**
     * @inheritDoc
     *
     * @since 0.4.1
     */
    public function enqueue()
    {
        wp_enqueue_script('sli-elementor-editor');
        wp_enqueue_style('sli-elementor-editor');

        do_action('spotlight/instagram/localize_config');
    }

    /**
     * @inheritDoc
     *
     * @since 0.4.1
     */
    public function get_default_value()
    {
        return 0;
    }

    /**
     * @inheritDoc
     *
     * @since 0.4.1
     */
    public function content_template()
    {
        $uuid = $this->get_control_uid();
        $slAdminUrl = admin_url('admin.php?page=spotlight-instagram&screen=feeds');
        ?>
        <div class="sli-select-field-row elementor-control-field elementor-control elementor-control-type-select">
            <label for="<?= $uuid; ?>" class="elementor-control-title">
                {{{ data.label }}}
            </label>
            <div class="sli-select-control-row">
                <div class="sli-select-control-wrapper elementor-control-input-wrapper elementor-control-unit-5">
                    <select id="<?= $uuid; ?>"
                            class="sli-select-element sli-elementor-feed-select"
                            data-setting="{{ data.name }}">
                    </select>
                </div>

                <button class="sli-select-edit-btn elementor-button elementor-button-default">
                    Edit
                </button>
            </div>
        </div>

        <div class="sli-select-field-row">
            <button class="sli-select-new-btn elementor-button elementor-button-default">
            </button>
        </div>

        <div class="sli-select-field-row sli-select-field-help">
            <p>
                New Instagram feeds created in Elementor are automatically saved in
                <a href="<?= esc_attr($slAdminUrl) ?>" target="_blank">Spotlight</a>.
                <a href="https://docs.spotlightwp.com/article/720-elementor-widget" target="_blank">
                    Learn more.
                </a>
            </p>
        </div>

        <div class="sli-select-loading">
            <p>Loading ...</p>
        </div>

        <style>
          .sli-select-field-row {
            display: none;
          }

          .sli-select-field-row.elementor-control-field {
            display: none;
            position: unset !important;
            padding: 0 !important;
            background: unset !important;
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 15px;
          }

          .sli-select-control-row {
            flex: 1;
            display: flex;
            flex-direction: row;
            align-items: center;
            width: 100%;
            margin-top: 10px;
          }

          .sli-select-control-wrapper {
            flex: 1;
            margin-left: 0 !important;
            margin-right: 5px !important;
          }

          .sli-select-edit-btn {
            flex: 0;
          }

          .sli-select-field-help {
            margin-top: 10px;
            font-style: italic;
            line-height: 1.5em;
          }
        </style>
        <?php
    }
}
