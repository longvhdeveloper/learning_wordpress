<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

class QHShoutboxWidget extends WP_Widget
{
    protected static $instance;
    protected static $option;
    public function __construct()
    {
        //khoi tai thong so cho widget
        parent::__construct(
            'qhshoutbox', // base ID
            'QHShoutbox Wiget', //name
            array(
                'description' => 'Every can chat'
            )
        );
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new QHShoutboxWidget();
        }
        return self::$instance;
    }

    public static function run()
    {
        $instance = self::getInstance();

        add_action('widgets_init', function(){
            register_widget('QHShoutboxWidget');
        });
        // add_action('plugins_loaded', function(){
        //     self::saveData();
        // });
        add_action('wp_ajax_qhshoutbox', array($instance, 'saveData'));
        add_action('wp_ajax_nopriv_qhshoutbox', array($instance, 'saveDataNoPriv'));
        self::$option = get_option('qhSetting');
        return $instance;
    }

    public function widget($args, $instance)
    {
        $data = QHShoutboxMessage::get();
        $title = (isset($instance['title'])) ? apply_filters('widget_title', $instance['title']) : '';

        wp_register_style('qhshoutbox_css', QH_PLUGIN_URL . 'scripts/style.css');

        wp_enqueue_style('qhshoutbox_css');

        wp_register_script('qhshoutbox_js', QH_PLUGIN_URL . 'scripts/function.js');
        wp_enqueue_script('qhshoutbox_js');

        wp_localize_script('qhshoutbox_js', 'qhshoutbox', array(
            'url' => admin_url('admin-ajax.php'),
            'refreshRate' => self::$option['qhRefreshRate'],
        ));

        extract(self::$option);

        require_once(QH_PLUGIN_DIR . 'views/show.php');
    }

    public function form($instance)
    {
        $title = (isset($instance['title'])) ? apply_filters('widget_title', $instance['title']) : '';
        require_once(QH_PLUGIN_DIR . 'views/form.php');
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = !empty($new_instance['title']) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

    public static function saveData()
    {
        // if (is_user_logged_in()) {
        //     global $current_user;
        //     $user_login = $current_user->user_login;
        // } else {
        //     $user_login = '';
        // }

        global $current_user;
        $user_login = $current_user->user_login;

        $data = array(
            'status' => 0,
            'message' => ''
        );
        // if (isset($_POST['qhMessage']) && $_POST['qhMessage'] != '' && wp_verify_nonce($_POST['qhsecurity'], 'submit_message')) {
        //     $message = esc_attr($_POST['qhMessage']);
        //     if ($user_login != '') {
        //         QHShoutboxMessage::save($message, $user_login);
        //     } else {
        //         QHShoutboxMessage::save($message);
        //     }
        // }
        //print_r($data);die;
        if ( isset($_POST['qhMessage']) && $_POST['qhMessage'] != '' && check_ajax_referer('qhshoutbox', 'qhsecurity', false)) {

            $message = esc_attr($_POST['qhMessage']);
            $validate = QHShoutboxMessage::save($message, $user_login);

            if ($validate) {
                $data['status'] = 1;
                $data['message'] = QHShoutboxMessage::get('ARRAY_A');
            } else {
                $data['message'] = 'Something went wrong !';
            }


        } else {
            $data['status'] = 1;
            $data['message'] = QHShoutboxMessage::get('ARRAY_A');
        }
         wp_send_json_success($data);
    }

    public static function saveDataNoPriv()
    {
        // if (is_user_logged_in()) {
        //     global $current_user;
        //     $user_login = $current_user->user_login;
        // } else {
        //     $user_login = '';
        // }

        $data = array(
            'status' => 0,
            'message' => ''
        );
        // if (isset($_POST['qhMessage']) && $_POST['qhMessage'] != '' && wp_verify_nonce($_POST['qhsecurity'], 'submit_message')) {
        //     $message = esc_attr($_POST['qhMessage']);
        //     if ($user_login != '') {
        //         QHShoutboxMessage::save($message, $user_login);
        //     } else {
        //         QHShoutboxMessage::save($message);
        //     }
        // }
        //print_r($data);die;
        if ( isset($_POST['qhMessage']) && $_POST['qhMessage'] != '' && check_ajax_referer('qhshoutbox', 'qhsecurity', false)) {

            $message = esc_attr($_POST['qhMessage']);
            $validate = QHShoutboxMessage::save($message);

            if ($validate) {
                $data['status'] = 1;
                $data['message'] = QHShoutboxMessage::get('ARRAY_A');
            } else {
                $data['message'] = 'Something went wrong !';
            }


        } else {
            $data['status'] = 1;
            $data['message'] = QHShoutboxMessage::get('ARRAY_A');
        }
         wp_send_json_success($data);
    }
}