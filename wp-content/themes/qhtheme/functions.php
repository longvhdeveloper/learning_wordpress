<?php
/**
 * Created by PhpStorm.
 * User: longvo
 * Date: 8/21/15
 * Time: 9:48 AM
 */
//add_action('content', function(){
////    if (have_posts()) {
////        while(have_posts()) {
////            the_post();
////            echo 'Ten bai viet: ' . get_the_title() . '<br/>';
////            echo 'Chuyen muc: ';the_category() . '<br/>';
////            echo 'Noi dung: ' . get_the_content();
////            echo '<hr/>';
////        }
////        //tra het ve gia tri ben trong vong lap ve mac dinh
////        rewind_posts();
////        while(have_posts()) {
////            the_post();
////            echo 'Ten bai viet: ' . get_the_title() . '<br/>';
////            echo 'Chuyen muc: ';the_category() . '<br/>';
////            echo 'Noi dung: ' . get_the_content();
////            echo '<hr/>';
////        }
////    } else {
////
////    }
//
////    $args = array(
//////        'category__and' => array('2', '4'),
////        'author' => 1,
////        'post_per_page' => 2
////    );
////    $posts = new WP_Query($args);
////    if ($posts->have_posts()) {
////        while ($posts->have_posts()) {
////            $posts->the_post();
////            echo 'Ten bai viet: ' . get_the_title() . '<br/>';
////            echo 'Chuyen muc: ';the_category() . '<br/>';
////            echo 'Noi dung: ' . get_the_content();
////            echo '<hr/>';
////        }
////        //dung de chay nhieu the loop
////        wp_reset_postdata();
////    }
////
////    $args = array(
//////        'category__and' => array('2', '4'),
////        'author' => 2,
////        'post_per_page' => 2
////    );
////    $posts2 = new WP_Query($args);
////    if ($posts2->have_posts()) {
////        while ($posts2->have_posts()) {
////            $posts2->the_post();
////            echo 'Ten bai viet: ' . get_the_title() . '<br/>';
////            echo 'Chuyen muc: ';the_category() . '<br/>';
////            echo 'Noi dung: ' . get_the_content();
////            echo '<hr/>';
////        }
////        wp_reset_postdata();
////    }
////    echo '<hr/>';
////    echo $posts2->posts[0]->ID;
////    global $post;
////    $post3 = get_posts();
////    echo '<pre>';
////    print_r($post3);
////    echo '</pre>';
////
////    foreach ($post3 as $post) {
//////        echo $post->post_title . '<br/>';
////        setup_postdata($post);
////        the_title();
////        //the_content();
////        echo '<br/>';
////    }
//});
//
//add_action('after_setup_theme', function(){
////    register_nav_menu('primary_menu', 'Primary Menu');
////    register_nav_menus(array(
////        'secondary_menu' => 'Secondary Menu',
////        'third_menu' => 'Third Menu',
////        'lef_menu' => 'Left Menu',
////    ));
//    register_sidebar(array(
//        'name' => 'Right Sidebar',
//        'id' => 'right_sidebar',
//        'description' => 'The right sidebar'
//    ));
//
//    register_sidebars(3, array(
//        'name' => 'Sidebar slot %d',
//        'id' => 'sidebar'
//    ));
//
//    add_theme_support('post-formats', array(
//        'image', 'audio', 'aside'
//    ));
//
//    add_theme_support('custom-background');
//});
//
//add_action('header', function(){
////    wp_nav_menu(array(
////        'theme_location' => 'lef_menu',
//////            'depth'=> 2
////        'fallback_cb' => false,
////    ));
//
//    dynamic_sidebar('right_sidebar');
//    dynamic_sidebar('sidebar');
//});
//
//add_action('footer', function(){
////    wp_nav_menu(array(
////        'theme_location' => 'secondary_menu',
////        'fallback_cb' => false,
////    ));
//
//});

add_action('header', function(){
    echo __('I am handsome', 'qhtest');
});

add_action('content', function(){
    _e('You are beautiful', 'qhtest');
});

add_action('footer', function(){
    echo _n('You have 1 book', 'You have 4 books', 2, 'qhtest'); //
    echo _x('So mot', 'This is number one', 'qhtest');
});