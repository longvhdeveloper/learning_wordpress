<p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Ten widget :') ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id('title') ?>" name="<?php echo $this->get_field_name('title') ?>" type="text" value="<?php echo esc_attr($title) ?>" />
</p>

<p>
    <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Noi dung :') ?></label>
    <textarea rows="5" class="widefat" id="<?php echo $this->get_field_id('content') ?>" name="<?php echo $this->get_field_name('content') ?>"><?php echo esc_attr($content) ?></textarea>
</p>