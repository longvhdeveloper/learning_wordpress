<?php

/**
 * Class jChat
 * This is class main to control plugin jChat
 */
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}
class jChat
{
    protected static $instance;

    //prevent using constructor for singleton
    protected function __construct(){}
    protected function __clone(){}

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new jChat();
        }

        return self::$instance;
    }

    public static function make()
    {
        self::$instance = self::getInstance();

        //run jChat Message
        jChatMessage::make();
        jChatWidget::make();

        return self::$instance;
    }

    public static function plugin_activation()
    {
        //check version of WP current
        if (version_compare($GLOBALS['wp_version'], J_CHAT_MINIMUM_VERSION, '<')) {
            die('Please upgrade your wordpress minium is ' . J_CHAT_MINIMUM_VERSION);
        }

        //check version of plugin
        $plugin_version = get_option('j_chat_version');
        if (!$plugin_version) {
            add_option('j_chat_version', J_CHAT_VERSION);
            //create table
            jChatMessage::createTable();
        } else {
            update_option('j_chat_version', J_CHAT_VERSION);
        }
    }

    public static function plugin_deactivation()
    {
        //remove version
        delete_option('j_chat_version');
    }
}