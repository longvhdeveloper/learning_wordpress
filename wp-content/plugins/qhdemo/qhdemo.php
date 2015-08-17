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
    }
    //giao dien ben ngoai
    public function widget($args, $instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        echo '<aside id="'.$args['widget_id'].'" class="widget widget_meta"><h2 class="widget-title">'.$title.'</h2></aside>';
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
}

add_action('widgets_init', function(){
    register_widget('QHWidget');
});
