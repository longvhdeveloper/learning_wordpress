<?php
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}
class QHThemeWidgetFooter extends WP_Widget
{
    protected static $instance;
    protected static $option;
    public function __construct()
    {
        //khoi tai thong so cho widget
        parent::__construct(
            'qhtheme_widget_footer', // base ID
            __('QH Theme Widget Footer', 'qhtheme'), //name
            array(
                'description' => 'footer widget'
            )
        );
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new QHThemeWidgetFooter();
        }
        return self::$instance;
    }

    public static function run()
    {
        $instance = self::getInstance();

        add_action('widgets_init', function(){
            register_widget('QHThemeWidgetFooter');
        });

        return $instance;
    }

    public function widget($args, $instance)
    {

        $title = (isset($instance['title'])) ? apply_filters('widget_title', $instance['title']) : '';
        $content = (isset($instance['content'])) ? apply_filters('widget_content', $instance['content']) : '';



        require(QH_THEME_DIR . 'views/show.php');
    }

    public function form($instance)
    {
        $title = (isset($instance['title'])) ? apply_filters('widget_title', $instance['title']) : '';
        $content = (isset($instance['content'])) ? apply_filters('widget_content', $instance['content']) : '';
        require(QH_THEME_DIR . 'views/form.php');
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = !empty($new_instance['title']) ? strip_tags($new_instance['title']) : '';
        $instance['content'] = (isset($new_instance['content'])) ? $new_instance['content'] : '';
        return $instance;
    }
}