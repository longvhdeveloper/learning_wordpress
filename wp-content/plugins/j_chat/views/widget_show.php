<aside class="widget widget_jchat" id="<?php echo $args['widget_id'] ?>">
    <h2 class="widget-title"><?php echo $title; ?></h2>
    <div class="jchat-messages">
        <?php
        if (!empty($messages)) {
            foreach ($messages as $message) {
            ?>
            <p style="margin-left: 5px;"><b><?php echo $message->user_name_from ?></b>: <?php echo $message->message; ?></p>
            <?php
            }
        }
        ?>
    </div>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" accept-charset="utf-8" id="jchat-form">
        <?php echo wp_nonce_field('j_chat_plugin', 'j_chat_token') ?>
        <input type="text" class="jchat-message" name="jchatMessage" id="jchatMessage" placeholder="Typing your text..." maxlength="<?php echo $maxLength; ?>" />
        <input type="submit" name="fsubmit" value="Send" class="jchat-send" id="jchat-send" />
    </form>
    <div class="jchat-status"></div>
</aside>
