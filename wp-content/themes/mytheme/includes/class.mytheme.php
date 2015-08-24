<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}
class MyTheme
{
    public static function run()
    {
        add_action('init', function(){
            register_nav_menu('primary', 'Primary Menu');
            register_sidebar(array(
                'name' => 'Right Side Bar',
                'id' => 'right_side_bar',
                'description' => 'The right side bar',
                'before_widget' => '<aside id="%1$s" class="%2s">',
                'after_widget' => '</aside>',
            ));

            register_sidebars(3, array(
                'name' => 'Footer %d',
                'id' => 'footer',
                'before_widget' => '<aside id="%1$s" class="%2s">',
                'after_widget' => '</aside>',
            ));
        });

        add_action('wp_enqueue_scripts', function(){
            //register style
            wp_register_style('bootstrap_css', QH_THEME_URL . '/style.css');
            wp_enqueue_style('bootstrap_css');

            //register script
            wp_register_script('jquery', QH_THEME_URL . '/scripts/js/jquery.min.js');
            wp_register_script('bootstrap_js', QH_THEME_URL . '/scripts/js/bootstrap.min.js', array('jquery'));
            wp_enqueue_script('bootstrap_js');
        });

        add_action('after_setup_theme', function(){
            add_theme_support('post-thumbnails');
            add_theme_support('post-formats', array(
                'image', 'aside'
            ));

            add_theme_support('custom-background');
            //set_post_thumbnail_size(213, 213, true);
            add_image_size('qh_thumbnail', 213, 213, array('center', 'center'));

            add_image_size('qhlarge', 390, 300, array('center', 'center'));
            add_image_size('qhsmall', 195, 150, array('center', 'center'));

        });

        //run widget
        QHThemeWidgetFooter::run();

        //theme customization api
        add_action('customize_register', function($customize){
            //dang ky setting
            $customize->add_setting('qhtheme_special_post', array(
                'default' => 1,
                'transport' => 'postMessage',
            ));

            $customize->add_setting('qhtheme_nav_color', array(
                'default' => '#2E8DEF',
                'transport' => 'postMessage',
            ));

            $customize->add_setting('qhtheme_footer_color', array(
                'default' => '#333',
                'transport' => 'postMessage',
            ));

            //dang ky session
            $customize->add_section('qhtheme_setting_section', array(
                'title' => 'Theme setting',
                'priority' => 1
            ));
            //dang ky control
            $customize->add_control(new WP_Customize_Control($customize, 'qhtheme_special_post_control', array(
                'label' => 'Special Post',
                'section' => 'qhtheme_setting_section',
                'settings' => 'qhtheme_special_post',
                'type' => 'select',
                'choices' => array(
                    1 => 'On',
                    2 => 'Off'
                ),
            )));
            $customize->add_control(new WP_Customize_Color_Control($customize, 'qhtheme_nav_color_control', array(
                'label' => 'Navigation Bar Color',
                'section' => 'qhtheme_setting_section',
                'settings' => 'qhtheme_nav_color',
            )));

            $customize->add_control(new WP_Customize_Color_Control($customize, 'qhtheme_footer_color_control', array(
                'label' => 'Footer Color',
                'section' => 'qhtheme_setting_section',
                'settings' => 'qhtheme_footer_color',
            )));


            //get setting
            $customize->get_setting( 'qhtheme_special_post' )->transport = 'postMessage';
            $customize->get_setting( 'qhtheme_nav_color' )->transport = 'postMessage';
            $customize->get_setting( 'qhtheme_footer_color' )->transport = 'postMessage';
        });

        add_action('customize_preview_init', function(){
            wp_enqueue_script('theme-preview', QH_THEME_URL . '/scripts/js/theme-preview.js', array(
                'jquery', 'customize-preview'
            ));
        });
    }

    public static function primaryMenu()
    {
        return wp_nav_menu( array(
                'menu'              => 'Primary Menu',
                'theme_location'    => 'primary',
                'depth'             => 2,
                'container'         => false,
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker(),
                'echo'              => false,
            )
        );
    }

    public static function getAavatar($id_or_email, $size = 64)
    {
        $avatar = get_avatar($id_or_email, $size, '', esc_attr($id_or_email));
        preg_match('/^<img.*alt=\'(.*)\'.*src=\'(.*)\'.*\/>$/msU', $avatar, $matches);
        return '<img src="'.$matches[2].'" alt="'.$matches[1].'" class="avatar" />';
    }

    public static function getComments($comments = null)
    {
        $new_comments = array();
        foreach ($comments as $comment) {
            $new_comments[$comment->comment_parent][] = $comment;
        }

        self::makeComment($new_comments);
    }

    public static function makeComment($comments, $parentId = 0) {
        if (isset($comments[$parentId])) {
            foreach ($comments[$parentId] as $comment) {
                echo '
                <div class="media" id="comment-'.$comment->comment_ID.'">
            <a href="#" class="pull-left">
            '.self::getAavatar($comment->comment_author_email).'</a>
            <div class="media-body">
                <h4 class="media-heading">'.$comment->comment_author.'</h4>
                <p>'.$comment->comment_content.'</p>
                <p>
                    <a href="' . esc_attr(add_query_arg('replytocom', $comment->comment_ID.'#response',  get_permalink($comment->comment_post_ID))).'" class="btn btn-primary">Reply</a>
                    <a href="'.(is_user_logged_in() ? esc_attr(admin_url('comment.php?action=editcomment&c=' . $comment->comment_ID)) : 'javascript:void(0)').'" class="btn btn-warning">Edit</a>
                </p>
                ';
                self::makeComment($comments, $comment->comment_ID);
                echo '</div></div>';
            }
        }
    }

    public static function paginate()
    {
        global $wp_query, $numpages;
        $big = 999999999; // need an unlikely integer
        $arr =  paginate_links( array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'type' => 'array',
        ) );

        if ($arr) {
            foreach($arr as $key => $value) {
                if (preg_match('/span/u', $value)) {
                    preg_match('/^<span(.*)>(.*)<\/span>$/msU', $value, $matches);
                    $matches[1] = str_replace('current', 'active', $matches[1]);
                    $arr[$key] = "<li $matches[1]><span>$matches[2]</span></li>";
                } else {
                    $arr[$key] = "<li>$value</li>";
                }
            }
            return '<ul class="pagination">'.implode('', $arr).'</ul>';
        } else {
            return false;
        }
    }
}