<?php
/*
 Plugin Name: QH Shoutbox
 Plugin URI: http://come-stay.vn
 Description: Day la plugin chat
 Version: 1.0.0
 Author: Jackie
 Author URI: http://come-stay.vn
 License: GPL2
 Text Domain: qhshoutbox
 Domain Path: /languages
 */
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define('QH_SHOUTBOX_VERSION', '1.0.1');
define('QH_MINIMUM_VERSION', '3.9.2');
define('QH_PLUGIN_URL', plugin_dir_url(__FILE__));
define('QH_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('QH_PLUGIN_LANGUAGES', dirname(plugin_basename(__FILE__ ). '/languages/'));

require_once(QH_PLUGIN_DIR . 'includes/class.qhshoutbox-message.php');
require_once(QH_PLUGIN_DIR . 'includes/class.qhshoutbox-setting.php');
require_once(QH_PLUGIN_DIR . 'includes/class.qhshoutbox-widget.php');
require_once(QH_PLUGIN_DIR . 'includes/class.qhshoutbox-shortcode.php');
require_once(QH_PLUGIN_DIR . 'includes/class.qhshoutbox-user.php');
require_once(QH_PLUGIN_DIR . 'includes/class.qhshoutbox.php');

register_activation_hook(__FILE__, array('QHShoutbox', 'plugin_activation'));

register_deactivation_hook(__FILE__, array('QHShoutbox', 'plugin_deactivation'));

QHShoutbox::run();
