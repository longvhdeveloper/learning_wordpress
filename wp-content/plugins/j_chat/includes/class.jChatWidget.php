<?php
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}
/*
 * Class manage widget for plugin
 */
class jChatWidget extends WP_Widget
{
    protected static $instance;
    protected static $options;

    public function __construct()
    {
        parent::__construct(
            'j_chat_widget', //base id
            __('JChat Widget', 'j_chat'), //name
            array(
                'description' => __('This plugin jchat same as shoutbox', 'j_chat'),
            )
        );
    }

    public static function make()
    {
        $instance = self::getInstance();

        //init widget
        add_action('widgets_init', function(){
            register_widget('jChatWidget');
        });

//        add_action('plugins_loaded', function(){
//            self::saveMessage();
//        });

        //register ajax
        add_action('wp_ajax_jchat', array($instance, 'saveMessage'));
        add_action('wp_ajax_nopriv_jchat', array($instance, 'saveNoPrivMessage'));

        return $instance;
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new jChatWidget();
        }

        return self::$instance;
    }

    /**
     * @param $args
     * @param $instance
     * This is display widget in site
     */
    public function widget($args, $instance)
    {
        $title = !empty($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';

        //register css file
        wp_register_style('jchat_style', J_CHAT_URL . 'scripts/jchat.css');
        wp_enqueue_style('jchat_style');

        //register js file
        wp_register_script('jchat_script', J_CHAT_URL . 'scripts/jchat.js');
        wp_enqueue_script('jchat_script');

        //get messages
        $messages = jChatMessage::getMessages();

        //using ajax
        wp_localize_script('jchat_script', 'jchat' ,array(
            'url' => admin_url('admin-ajax.php'),
        ));

        require(J_CHAT_DIR . 'views/widget_show.php');
    }

    /**
     * @param $instance
     * This is display form in admin
     */
    public function form($instance)
    {
        $title = !empty($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
        //not use require_once in here
        require(J_CHAT_DIR . 'views/widget_form.php');
    }

    /**
     * @param $new_instance
     * @param $old_instance
     * This is process form
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = !empty($new_instance['title']) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

    public static function saveMessage()
    {
        //get user login
//        if (is_user_logged_in()) {
//            global $current_user;
//            $user_login = $current_user->user_login;
//        } else {
//            $user_login = 'guest';
//        }

        global $current_user;
        $user_login = $current_user->user_login;

        $message = isset($_POST['jchatMessage']) ? (string)$_POST['jchatMessage'] : '';
        $message = strip_tags($message);
//        if (!empty($message) && wp_verify_nonce($_POST['j_chat_token'], 'j_chat_plugin')) {
//            jChatMessage::add($message, $user_login);
//        }

        //using ajax
        $data = array(
            'messages' => null,
            'status' => 0
        );

        if (!empty($message) && check_ajax_referer('j_chat_plugin', 'j_chat_token',false)) {
            $data['status'] = jChatMessage::add($message, $user_login) ? 1 : 0;
            $data['messages'] = jChatMessage::getMessages('ARRAY_A');
        } else {
            $data['messages'] = 'Something was wrong !';
        }

        wp_send_json_success($data);
    }

    public static function saveNoPrivMessage()
    {
        //get user login
        $user_login = 'guest';

        $message = isset($_POST['jchatMessage']) ? (string)$_POST['jchatMessage'] : '';
        $message = strip_tags($message);
//        if (!empty($message) && wp_verify_nonce($_POST['j_chat_token'], 'j_chat_plugin')) {
//            jChatMessage::add($message, $user_login);
//        }

        //using ajax
        $data = array(
            'messages' => null,
            'status' => 0
        );

        if (!empty($message) && check_ajax_referer('j_chat_plugin', 'j_chat_token',false)) {
            $data['status'] = jChatMessage::add($message, $user_login) ? 1 : 0;
            $data['messages'] = jChatMessage::getMessages('ARRAY_A');
        } else {
            $data['messages'] = 'Something was wrong !';
        }

        wp_send_json_success($data);
    }

}