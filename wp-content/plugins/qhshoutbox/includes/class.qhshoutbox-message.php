<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

class QHShoutboxMessage
{
    protected static $instance;
    protected static $wpdb;
    protected static $option;
    protected static $table;

    protected function __construct()
    {

    }

    protected function __clone()
    {

    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new QHShoutboxMessage();
        }

        return self::$instance;
    }

    public static function run()
    {
        $instance = self::getInstance();
        //setup
        global $wpdb;
        self::$wpdb = $wpdb;
        //table name
        self::$table = self::$wpdb->prefix . 'qhshoutbox';

        self::$option = get_option('qhSetting');

        return $instance;
    }

    public static function createTable()
    {
        $table = self::$table;
        //set charset
        $charset_collate = self::$wpdb->get_charset_collate();;
        //sql
        $sql = "CREATE TABLE IF NOT EXISTS $table(
            id int(11) not null primary key auto_increment,
            user_login varchar(255) not null,
            message text not null,
            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL
        ) $charset_collate;";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);
    }

    public static function updateTable()
    {
        $table = self::$table;
        $row = self::$wpdb->get_row('SELECT * FROM ' . $table);
        if (empty($row->message2)) {
            $sql = "ALTER TABLE $table ADD message2 text not null";
            self::$wpdb->query($sql);
        }
    }

    public static function checkUpdate()
    {
    }

    public static function dropTable()
    {
        $table = self::$table;
        $sql = "DROP TABLE IF EXISTS $table";
        self::$wpdb->query($sql);
    }

    public static function save($message, $user_login = 'Guest')
    {
        if (current_user_can('moderate_comments')) {
            QHShoutboxUser::checkCommand($message, $user_login);
        } elseif (!current_user_can('moderate_comments') && !QHShoutboxUser::checkUser($user_login)) {
            return false;
        }

        self::$wpdb->insert(self::$table, array(
            'user_login' => $user_login,
            'message' => htmlspecialchars($message),
            'time' => current_time('mysql'),
        ));
        return true;
    }

    public static function get($dataType = 'OBJECT')
    {
        $table = self::$table;
        $maxMess = self::$option['qhMaxMessage'];
        $messages = self::$wpdb->get_results("
            select * from $table order by id DESC LIMIT 0, $maxMess
        ", $dataType);

        return $messages;
    }
}
