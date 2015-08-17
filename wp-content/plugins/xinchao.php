<?php
/*
    Plugin Name: Xin Chao
    Plugin URI:  http://wordpress.org/extend/plugins/xinchao/
    Description: Day la plugin co ban
    Version:     1.0
    Author:      Jackie Wu
    Author URI:  http://wordpress.org/extend/plugins/xinchao/
 */
function hello_dolly_get_lyric() {
    /** These are the lyrics to Hello Dolly */
    $lyrics = "Hello, Dolly
Well, hello, Dolly
It's so nice to have you back where you belong
You're lookin' swell, Dolly
I can tell, Dolly
You're still glowin', you're still crowin'
You're still goin' strong
We feel the room swayin'
While the band's playin'
One of your old favourite songs from way back when
So, take her wrap, fellas
Find her an empty lap, fellas
Dolly'll never go away again
Hello, Dolly
Well, hello, Dolly
It's so nice to have you back where you belong
You're lookin' swell, Dolly
I can tell, Dolly
You're still glowin', you're still crowin'
You're still goin' strong
We feel the room swayin'
While the band's playin'
One of your old favourite songs from way back when
Golly, gee, fellas
Find her a vacant knee, fellas
Dolly'll never go away
Dolly'll never go away
Dolly'll never go away again";

    // Here we split it into lines
    $lyrics = explode( "\n", $lyrics );

    // And then randomly choose a line
    return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function hello_dolly() {
    $chosen = hello_dolly_get_lyric();
    echo "<p id='dolly'>$chosen</p>";
}

add_action('admin_notices', 'hello_dolly');

// We need some CSS to position the paragraph
function dolly_css() {
    // This makes sure that the positioning is also good for right-to-left languages
    $x = is_rtl() ? 'left' : 'right';

    echo "
    <style type='text/css'>
    #dolly {
        float: $x;
        padding-$x: 15px;
        padding-top: 5px;
        margin: 0;
        font-size: 11px;
        color:red;
    }
    </style>
    ";
}

add_action('admin_head', 'dolly_css');

function linhtinh() {
    echo wptexturize('<p style="margin-left:200px;color:red;font-size:20px;">--"Day la cau thanh ngu" (tm)</p>');
}

add_action('admin_init', 'linhtinh');