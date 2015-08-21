<?php
/*
    Plugin Name: QH Demo
    Plugin URI:  http://wordpress.org/extend/plugins/xinchao/
    Description: Day la plugin co ban
    Version:     1.0
    Author:      Jackie Wu
    Author URI:  http://wordpress.org/extend/plugins/xinchao/
    Text Domain: qhdemo
    Domain path: /languages
 */

/*define('QH_DEMO_VERSION', '1.0');
define('QH_WP_MINIUM_VERSION', '4.0');

// cac action hook va filter se khong the chay trong trong activation hook va deactivation hook
function plugin_activation()
{
    //die('Activation');
    // $arr = array(
    //     'mot' => 1,
    //     'hai' => 2,
    //     'ba' => 3
    // );
    // update_option('ten_bien_cua_ban', $arr);
    if (version_compare($GLOBALS['wp_version'], QH_WP_MINIUM_VERSION, '<')) {
        die('Phien ban cua ban da qua cu');
    }

    $version = get_option('qh_demo_version');
    if (!$version) {
        //do something
        add_option('qh_demo_version', QH_DEMO_VERSION);
    } else {
        //do something
        update_option('qh_demo_version', QH_DEMO_VERSION);
    }

}

register_activation_hook(__FILE__, 'plugin_activation');

function plugin_deactivation()
{
    // die('Deactivation');
    delete_option('qh_demo_version');
}

register_deactivation_hook(__FILE__, 'plugin_deactivation');

// $var = get_option('ten_bien_cua_ban');
// echo '<pre>';
// print_r($var);
// echo '</pre>';

function demo()
{
    global $wpdb;
    // $wpdb->query(
    //     'create table qhdemo(
    //         id int(11) not null primary key auto_increment,
    //         user varchar(255) not null,
    //         info text not null
    //     );'
    // );
    // $wpdb->insert('qhdemo', array(
    //     'user' => 'jackie wu',
    //     'info' => 'Web Developer',
    // ));
    // $id = $wpdb->insert_id;
    // $wpdb->update('qhdemo', array(
    //     'user' => 'Long Vo'
    // ), array(
    //     'id' => $id
    // ));

    // $result = $wpdb->get_results($wpdb->prepare('select * from qhdemo where id = %d', 3));
    // echo $result[0]->user;
    // $wpdb->delete('qhdemo', array(
    //     'id' => 1,
    // ));
}
demo();*/

class QHWidget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'qhwidget',
            'Widget Demo',
            array(
                'description' => 'Day la widget demo'
            )
        );

        add_action('wp_ajax_getMessage', array($this, 'getMessage'));
        add_action('wp_ajax_nopriv_getMessage', array($this, 'getMessage'));
    }
    //giao dien ben ngoai
    public function widget($args, $instance)
    {
        $data = array(
            'a' => 1,
            'b' => 2,
        );
        wp_register_script('qhdemo_js', plugin_dir_url(__FILE__) . '/scripts/function.js');
        wp_enqueue_script('qhdemo_js');

        wp_localize_script('qhdemo_js', 'qhdemo', array(
            'url' => admin_url('admin-ajax.php'),
            'list' => $data
        ));

        $title = !empty($instance['title']) ? $instance['title'] : '';
        echo '<aside id="'.$args['widget_id'].'" class="widget widget_meta"><h2 class="widget-title">'.$title.'</h2>
        <a href="javascript:void(0)" id="clickme">Load Data</a>
        <p id="message"></p>
        </aside>';
    }
    //giao dien form
    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        echo '<p><label for="'.$this->get_field_id('title').'">Title:</label> <input class="widefat" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'"></p>';
    }
    //luu lai thong tin widget
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ? $new_instance['title'] : '');
        return $instance;
    }

    public function getMessage()
    {
        //$id = $_POST['id'];
        $id = rand(1,3);
        $message = '';
        switch ($id) {
            case 1:
                $message = 'First';
                break;

            case 2:
                 $message = 'Second';
                break;

            case 3:
                 $message = 'Third';
                break;

            default:
                $message = 'Zero';
                break;
        }

        wp_send_json_success(array(
            'message' => $message,
        ));
    }
}

add_action('widgets_init', function(){
    register_widget('QHWidget');
});

//add_shortcode('qhshortcode', function($atts){
//    if (isset($_GET['content'])) {
//        $atts['content'] = (string)$_GET['content'];
//    }
//    $atts = shortcode_atts(array(
//        'content' => 'hello world',
//        'color' => 'red'
//    ), $atts);
//    echo '<div style="color:'.$atts['color'].'">'.$atts['content'].'</div>';
//});

//add_action('admin_menu', function(){
//    add_menu_page('Setting Demo', 'QH Demo', 'manage_options', 'qhsetting', 'createSettingPage');
//});
//
//function createSettingPage()
//{
//    require(plugin_dir_path(__FILE__) . '/views/qhsetting.php');
//}
//
//$option = get_option('qhSetting');
//$option2 = get_option('qhSetting2');
//function setupSetting()
//{
//    global $option;
//    global $option2;
//    register_setting('qhSettingGroup', 'qhSetting', 'saveData');
//
//    register_setting('qhSettingGroup', 'qhSetting2', 'saveData');
//
//    add_settings_section('qhSettingGeneral', 'General', function(){
//        echo 'Vui long dien day du thong tin';
//    }, 'qhsetting');
//
//    add_settings_field('qhSettingTitle', 'Title', function() use ($option){
//        echo '<input name="qhSetting[qhSettingTitle]" type="text" class="regular-text" value="'.(!empty($option['qhSettingTitle']) ? $option['qhSettingTitle'] : '').'">';
//    }, 'qhsetting', 'qhSettingGeneral');
//
//    add_settings_section('qhSettingGeneral2', 'General2', function(){
//        echo 'Vui long dien day du thong tin';
//    }, 'qhsetting');
//
//    add_settings_field('qhSettingTitle2', 'Title2', function() use ($option2){
//        echo '<input name="qhSetting2[qhSettingTitle2]" type="text" class="regular-text" value="'.(!empty($option2['qhSettingTitle2']) ? $option2['qhSettingTitle2'] : '').'">';
//    }, 'qhsetting', 'qhSettingGeneral2');
//
//}
//
//add_action('admin_init', function() {
//    setupSetting();
//});
//
//function saveData($input)
//{
//    return $input;
//}
//
//function setButton() {
//    echo '<script type="text/javascript">'
//    . 'QTags.addButton("qhbutton", "QH Button", "<open></open>", "", "Day la button demo", 1)'
//    . '</script>';
//
//    echo '<script type="text/javascript">'
//    . 'QTags.addButton("qhbuttonshortcode", "QH Button Shortcode", "[qhshortcode]", "", "Day la button shortcode demo", 1)'
//    . '</script>';
//
//    echo '<script type="text/javascript">'
//    . 'QTags.addButton("qhbutton2", "QH Button2",test ,"", "", "Day la button demo", 2);'
//            . 'function test() {'
//            . 'alert("hello")'
//            . '}'
//    . '</script>';
//}
//
//add_action('admin_print_footer_scripts', 'setButton');
