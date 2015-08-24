<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

class QHShoutboxShortCode
{
    protected static $instance;
    protected static $option;
    protected function __construct()
    {

    }

    protected function __clone() {

    }


    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new QHShoutboxShortCode();
        }

        return self::$instance;
    }

    public static function run()
    {
        $instance = self::getInstance();
        self::$option = get_option('qhSetting');
        //khoi tao api
        add_shortcode('qhshoutbox', array($instance, 'create'));
        return $instance;
    }

    public static function create($atts)
    {
        $data = QHShoutboxMessage::get();

        extract(self::$option);

        $atts = shortcode_atts(array(
            'title' => 'QH Shoutbox',
            'color' => 'red'
        ), $atts);

        $title = apply_filters('widget_title', $atts['title']);

        wp_register_style('qhshoutbox_css', QH_PLUGIN_URL . 'scripts/style.css');

        wp_enqueue_style('qhshoutbox_css');

        wp_register_script('qhshoutbox_js', QH_PLUGIN_URL . 'scripts/function.js');
        wp_enqueue_script('qhshoutbox_js');
        echo '<style>.qh-shoutbox .widget-title{color: '.$atts['color'].'}</style>';
        wp_localize_script('qhshoutbox_js', 'qhshoutbox', array(
            'url' => admin_url('admin-ajax.php'),
            'refreshRate' => self::$option['qhRefreshRate'],
        ));

        require_once(QH_PLUGIN_DIR . 'views/show.php');
    }
}