<?php
/*
 Plugin Name: J_Chat
 Plugin URI: http://come-stay.vn
 Description: This plugin J_Chat to display in front-end
 Version: 1.0.0
 Author: Jackie
 License: GPL
 Text Domain: j_chat
 Domain Path: /languages
 */
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

//defined constant for plugin
define('J_CHAT_MINIMUM_VERSION', '3.9.2');
define('J_CHAT_VERSION', '1.0.0');
define('J_CHAT_URL', plugin_dir_url(__FILE__));
define('J_CHAT_DIR', plugin_dir_path(__FILE__));
define('J_CHAT_LANGUAGES', J_CHAT_DIR . 'languages/');

require_once(J_CHAT_DIR . 'includes/class.jChat.php');
require_once(J_CHAT_DIR . 'includes/class.jChatMessage.php');
require_once(J_CHAT_DIR . 'includes/class.jChatWidget.php');

register_activation_hook(__FILE__, array('jChat', 'plugin_activation'));
register_deactivation_hook(__FILE__, array('jChat', 'plugin_deactivation'));

jChat::make();
