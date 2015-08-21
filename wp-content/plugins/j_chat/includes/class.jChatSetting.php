<?php
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

/**
 * Class jChatSetting
 * This is control setting for plugin jChat
 */
class jChatSetting
{
    protected static $instance;
    protected static $options;

    protected function __construct(){}
    protected function __clone(){}

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new jChatSetting();
        }

        return self::$instance;
    }

    public static function make()
    {
        $instance = self::getInstance();


        return $instance;
    }

    public static function setupSetting()
    {
        register_setting('jChatGroup', 'jChatSetting', 'save');

        require(J_CHAT_DIR . 'views/setting_form.php');
    }
}