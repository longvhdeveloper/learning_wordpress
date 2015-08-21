<?php
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

/**
 * Class jChatMessage
 * This class model to working database
 */
class jChatMessage
{
    public static $instance;
    public static $options;
    public static $table;
    public static $wpdb;

    //prevent create object for singleton
    protected function __construct(){}
    protected function __clone(){}

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new jChatMessage();
        }
        return self::$instance;
    }

    public static function make()
    {
        self::$instance = self::getInstance();
        //setup db
        global $wpdb;
        self::$wpdb = $wpdb;

        //config table
        self::$table = $wpdb->prefix . 'j_chat_message';

        return self::$instance;
    }

    public static function createTable()
    {
        $table = self::$table;
        $charset_collate = self::$wpdb->get_charset_collate();
        $sql = "CREATE TABLE IF NOT EXISTS $table(
            id int(11) not null PRIMARY KEY auto_increment,
            user_name_from varchar(255) not null,
            message text not null,
            created int(10) not null
        )$charset_collate;";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);
    }

    public static function updateTable()
    {

    }

    /**
     * Check update version of plugin in runtime
     */
    public static function checkUpdate()
    {
        $version = get_option('j_chat_version');

        if ($version && $version != J_CHAT_VERSION) {
            update_option('j_chat_version', J_CHAT_VERSION);
            self::updateTable();
        }
    }

    public static function add($message, $user_login = '')
    {
        if ($message != '') {
            self::$wpdb->insert(self::$table, array(
                'user_name_from' => (string)$user_login,
                'message' => (string)$message,
                'created' => time(),
            ));
            return true;
        } else {
            return false;
        }
    }

    public static function getMessages($outputType = 'OBJECT')
    {
        $table = self::$table;
        $sql = "SELECT * FROM $table";

        $results = self::$wpdb->get_results($sql, $outputType);
        return $results;
    }
}