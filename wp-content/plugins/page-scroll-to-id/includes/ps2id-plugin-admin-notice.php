<?php
if (!class_exists('ps2id_Plugin_Admin_Notice')) {

    class ps2id_Plugin_Admin_Notice{
        public function __construct(){
            add_action('admin_notices', array($this, 'admin_notice'));
            add_action('network_admin_notices', array($this, 'admin_notice'));
            add_action('admin_init', array($this, 'dismiss_admin_notice'));
        }

        public function dismiss_admin_notice(){
            if (!isset($_GET['ps2id-plugin-admin-notice-action']) || $_GET['ps2id-plugin-admin-notice-action'] != 'ps2id_plugin_admin_notice_dismiss_notice') {
                return;
            }

            $url = admin_url();
            update_option('ps2id_plugin_admin_notice_dismiss_notice', 'true');

            wp_safe_redirect($url);
            exit;
        }

        public function admin_notice(){
            if (get_option('ps2id_plugin_admin_notice_dismiss_notice', 'false') == 'true') {
                return;
            }

            $dismiss_url = esc_url_raw(
                add_query_arg(
                    array(
                        'ps2id-plugin-admin-notice-action' => 'ps2id_plugin_admin_notice_dismiss_notice'
                    ),
                    admin_url()
                )
            );
            $this->notice_css();
            ?>
            <div id="ps2id-plugin-admin-notice" class="notice notice-info">
                <p><span class="ps2id-admin-notice-title">Thank you for using <strong>Page scroll to id</strong>!</span>
                    <span class="br"></span> 
                    For more information about using the plugin and its settings, visit <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/" target="_blank">plugin's homepage</a>, <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress-tutorial/" target="_blank">tutorial</a> and <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/2/" target="_blank">FAQ</a>. 
                    <br />
                    If you need help, please use the <a href="https://wordpress.org/support/plugin/page-scroll-to-id/" target="_blank">support forum</a> or the <a href="http://manos.malihu.gr/page-scroll-to-id-for-wordpress/#comments" target="_blank">comments system in plugin's homepage</a>. I'll be more than happy to assist you! 
                    <span class="br"></span>
                    If you like the plugin and want to support my effort to provide it for free, please consider <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=UYJ5G65M6ZA28" target="_blank">making a donation</a> <span class="smile">:-)</span>
                    <span class="br"></span>
                    <a href="<?php echo esc_attr($dismiss_url); ?>"><?php esc_html_e('Dismiss this notice'); ?></a>
                </p>
                <a href="<?php echo esc_attr($dismiss_url); ?>" class="notice-dismiss ps2id-plugin-admin-notice-dismiss" title="<?php esc_attr_e('Dismiss this notice'); ?>">
                   <span class="screen-reader-text"><?php esc_html_e('Dismiss this notice'); ?>.</span>
                </a>
            </div>
            <?php
        }

        public function notice_css(){
            ?>
            <style type="text/css">
            #ps2id-plugin-admin-notice{
                position: relative;
                padding-right: 48px;
            }
            .ps2id-admin-notice-title{
                font-size: 14px;
                margin-bottom: .2em;
            }
            .notice-dismiss.ps2id-plugin-admin-notice-dismiss{
                text-decoration: none;
            }
            #ps2id-plugin-admin-notice .br{
                display: block;
                margin-bottom: .5em;
            }
            #ps2id-plugin-admin-notice .smile{
                display: inline-block;
                font-size: 125%;
                margin-left: .25em;
                transform: translateY(.05em);
            }
            </style>
            <?php
        }

        public static function instance(){
            static $instance = null;

            if (is_null($instance)) {
                $instance = new self();
            }

            return $instance;
        }
    }
}

ps2id_Plugin_Admin_Notice::instance();
?>