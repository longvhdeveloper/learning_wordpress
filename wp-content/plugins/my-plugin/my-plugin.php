<?php
/*
    Plugin Name: My Plugin
    Plugin URI:  http://wordpress.org/extend/plugins/xinchao/
    Description: Day la plugin co ban cua toi 
    Version:     1.0
    Author:      Jackie Wu
    Author URI:  http://wordpress.org/extend/plugins/xinchao/
    Text Domain: my-plugin
    Domain path: /languages
*/

add_action('admin_menu', function(){
    add_menu_page('My Setting Page', 'My Setting', 'manage_options', 'my_menu', 'createMySettingPage');
});

function createMySettingPage()
{
    require_once(plugin_dir_path(__FILE__) . '/views/my_setting.php');
}

function setupMySetting()
{
    $option = get_option('mySetting');
    $optionName = array('name' => '', 'display_banner' => '', 'country' => 'VietNam', 'protocol' => 'http');
    foreach ($optionName as $name => $value) {
        if (empty($option[$name])) {
            $option[$name] = $value;
        }
    }
    //register setting
    register_setting('mySettingGroup', 'mySetting', 'saveMySetting');
    
    //add setting section
    add_settings_section('infoSection', 'Information', function(){
        echo 'Vui long nhap day du thong tin';
    }, 'my_menu');
    
    add_settings_field('name', 'Name', function() use($option){
        echo '<input type="text" name="mySetting[name]" class="regular-text" value="'.$option['name'].'" />';
    }, 'my_menu', 'infoSection');
    
    add_settings_field('display_banner', 'Banner', function() use ($option){
        echo '<label for"display_banner"><input type="checkbox" name="mySetting[display_banner]" id="display_banner" '.(!empty($option['display_banner']) ? 'checked' : '').' /> Display banner</label>';
    }, 'my_menu', 'infoSection');
    
    
    //add section 2
    add_settings_section('otherSection', 'Other', function(){
        echo '';
    }, 'my_menu');
    
    add_settings_field('country', 'Country', function() use ($option){
        $countries = array(
            'VietNam',
            'USA',
            'Japan',
            'Singapore',
            'Other'
        );
        echo '<select name="mySetting[country]">';
        foreach ($countries as $country) {
            if ($country == $option['country']) {
                echo '<option value="'.$country.'" selected>'.$country.'</option>';
            } else {
                echo '<option value="'.$country.'">'.$country.'</option>';
            }
        }
        echo '</select>';
    }, 'my_menu', 'otherSection');
    
    add_settings_field('protocol', 'Protocol', function() use ($option){
        echo '<label for="http"><input '.($option['protocol'] == 'http' ? 'checked' : '').' type="radio" name="mySetting[protocol]" value="http" /> HTTP</label><br/>';
        echo '<label for="https"><input '.($option['protocol'] == 'https' ? 'checked' : '').' type="radio" name="mySetting[protocol]" value="https" /> HTTPs</label><br/>';
        echo '<label for="udp"><input '.($option['protocol'] == 'udp' ? 'checked' : '').' type="radio" name="mySetting[protocol]" value="udp" /> UDP</label><br/>';
    }, 'my_menu', 'otherSection');
}

add_action('admin_init', function(){
    setupMySetting();
});

function saveMySetting($input)
{
    return $input;
}

