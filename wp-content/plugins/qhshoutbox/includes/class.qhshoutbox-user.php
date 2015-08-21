<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

class QHShoutboxUser
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
            self::$instance = new QHShoutboxUser();
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
        self::$table = self::$wpdb->prefix . 'qhshoutbox_user';

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
            banned tinyint(1) default '0' not null,
            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL
        ) $charset_collate;";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);
    }

    public static function updateTable()
    {
//        $table = self::$table;
//        $row = self::$wpdb->get_row('SELECT * FROM ' . $table);
//        if (empty($row->message2)) {
//            $sql = "ALTER TABLE $table ADD message2 text not null";
//            self::$wpdb->query($sql);
//        }
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

    public static function getUserObject($user_login)
    {
        return self::$wpdb->get_row(self::$wpdb->prepare(
            'select * from ' . self::$table . ' WHERE user_login=%s OR id=%d',$user_login, $user_login
        ));
    }

    public static function getUser($user_login)
    {
        $user = self::getUserObject($user_login);
        if (!$user) {
            self::$wpdb->insert(self::$table, array(
                'user_login' => $user_login,
                'banned' => 0,
                'time' => current_time('mysql'),
            ));

            return self::getUserObject(self::$wpdb->insert_id);
        }

        return $user;
    }

    public static function banUser($id)
    {
        self::$wpdb->update(self::$table, array(
            'banned' => 1,
            'time' => current_time('mysql'),
        ), array(
            'id' => $id
        ));

        return self::$instance;
    }

    public static function unBanUser($id)
    {
        self::$wpdb->update(self::$table, array(
            'banned' => 0,
            'time' => current_time('mysql'),
        ), array(
            'id' => $id
        ));

        return self::$instance;
    }

    public static function checkUser($user_login)
    {
        $user = self::getUser($user_login);

        if ($user && $user->banned == 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkCommand(&$message, $user_login)
    {
        $command = array(
            '/ban',
            '/unban'
        );

        $message = trim($message);
        if ($user_login != 'Guest' && preg_match('/([^ ]*) ([^ ]*)/u', $message, $matches) && in_array($matches[1], $command)) {
            $user = self::getUser($matches[2]);
            switch ($matches[1]) {
                case '/ban':
                    self::banUser($user->id);
                    $message = 'Ban da khoa tai khoan ' . $user->user_login;
                    break;
                case '/unban':
                    self::unBanUser($user->id);
                    $message = 'Ban da mo khoa tai khoan ' . $user->user_login;
                    break;
            }
        }
    }
}