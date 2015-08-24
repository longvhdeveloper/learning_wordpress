<?php
define('QH_THEME_VERSION', '1.0');
define('QH_THEME_MINIMUM_VERSION', '3.9.2');
define('QH_THEME_URL', get_template_directory_uri());
define('QH_THEME_DIR', plugin_dir_path(__FILE__));
define('QH_THEME_LANGUAGES', dirname(plugin_basename(__FILE__ ). '/languages/'));

require_once(QH_THEME_DIR . 'wp_bootstrap_navwalker.php');
require_once(QH_THEME_DIR . 'includes/class.qhtheme-widget-footer.php');
require_once(QH_THEME_DIR . 'includes/class.mytheme.php');

MyTheme::run();