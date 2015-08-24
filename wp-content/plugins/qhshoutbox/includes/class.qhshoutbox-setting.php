<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

class QHShoutboxSetting
{
    protected static $instance;
    protected static $option;
    protected function __construct()
    {

    }

    protected function __clone() {}


    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new QHShoutboxSetting();
        }

        return self::$instance;
    }

    public static function run()
    {
        $instance = self::getInstance();
        //add menu
        self::$option = get_option('qhSetting');

        add_action('admin_menu', function() use ($instance){
            add_menu_page('QH Setting', 'QH Demo', 'manage_options', 'qhsetting', array($instance, 'createSettingPage'));
        });

        add_action('admin_init', array($instance, 'setupSetting'));
        return $instance;
    }

    public static function createSettingPage()
    {
        require(QH_PLUGIN_DIR . '/views/setting.php');
    }

    public static function setupSetting()
    {
        register_setting('qhSettingGroup', 'qhSetting', array(self::$instance, 'saveData'));


        add_settings_section('qhSettingGeneral', 'General', function(){
            echo 'Vui long dien day du thong tin';
        }, 'qhsetting');

        add_settings_field('qhMaxMessage', 'Max Message', function() {
            echo '<input class="small-text" step="1" min="1" name="qhSetting[qhMaxMessage]" type="number" class="regular-text" value="'.(!empty(self::$option['qhMaxMessage']) ? esc_attr(self::$option['qhMaxMessage']) : '1').'">';
        }, 'qhsetting', 'qhSettingGeneral');

        add_settings_field('qhMaxLength', 'Max Length', function() {
            echo '<input class="small-text" step="1" min="1" name="qhSetting[qhMaxLength]" type="number" class="regular-text" value="'.(!empty(self::$option['qhMaxLength']) ? esc_attr(self::$option['qhMaxLength']) : '50').'">';
        }, 'qhsetting', 'qhSettingGeneral');

        add_settings_section('qhSettingAjax', 'Create Ajax', function(){
            echo 'Nhung thiet lap lien quan den ajax';
        }, 'qhsetting');

        add_settings_field('qhRefreshRate', 'Refresh rate', function() {
            echo '<input class="small-text" step="100" min="1000" name="qhSetting[qhRefreshRate]" type="number" class="regular-text" value="'.(!empty(self::$option['qhRefreshRate']) ? esc_attr(self::$option['qhRefreshRate']) : '5000').'">';
        }, 'qhsetting', 'qhSettingAjax');

    }

    public static function saveData($input)
    {
       $newInput = array();
        if (isset($input['qhMaxMessage'])) {
            $newInput['qhMaxMessage'] = absint($input['qhMaxMessage']);
        }

        if (isset($input['qhMaxLength'])) {
            $newInput['qhMaxLength'] = absint($input['qhMaxLength']);
        }

        if (isset($input['qhRefreshRate'])) {
            $newInput['qhRefreshRate'] = absint($input['qhRefreshRate']);
        }

        return $newInput;
    }

}

