<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

class QHShoutbox
{
    protected static $instance;
    protected function __construct()
    {

    }

    protected function __clone() {

    }


    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new QHShoutbox();
        }

        return self::$instance;
    }

    public static function run()
    {
        $instance = self::getInstance();
        //khoi tao api
        QHShoutboxMessage::run();
        QHShoutboxUser::run();
        self::checkUpdate();
        QHShoutboxWidget::run();
        QHShoutboxShortCode::run();
        QHShoutboxSetting::run();
        return $instance;
    }

    public static function plugin_activation()
    {
        if (version_compare($GLOBALS['wp_version'], QH_MINIMUM_VERSION, '<')) {
            die('Phien ban toi can phai co la ' . QH_MINIMUM_VERSION);
        }
        //kiem tra version
        $version = get_option('qhshoutbox_version');

        if ( !$version ) {
            QHShoutboxMessage::createTable();
            QHShoutboxUser::createTable();
            add_option('qhshoutbox_version', QH_SHOUTBOX_VERSION);
        } else {
            //QHShoutboxMessage::updateTable();
            //QHShoutboxUser::updateTable();
            update_option('qhshoutbox_version', QH_SHOUTBOX_VERSION);
        }

        //kiem tra option
        $defaultOptions = get_option('qhSetting');
        if (!$defaultOptions) {
            add_option('qhSetting', array(
                'qhMaxMessage' => 10,
                'qhMaxLength' => 50,
                'qhRefreshRate' => 50000,
            ));
        }
    }

    public static function plugin_deactivation()
    {
        delete_option('qhshoutbox_version');
        QHShoutboxMessage::dropTable();
        QHShoutboxUser::dropTable();
        delete_option('qhSetting');
    }

    public static function checkUpdate()
    {
        $version = get_option('qhshoutbox_version');

        if ( $version && $version != QH_SHOUTBOX_VERSION) {
            QHShoutboxMessage::updateTable();
            QHShoutboxUser::checkUpdate();
            add_option('qhshoutbox_version', QH_SHOUTBOX_VERSION);
        }
    }
}

