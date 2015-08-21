<aside class="widget qh-shoutbox" id="<?php echo $args['widget_id'];?>">
    <h1 class="widget-title"><?php echo $title; ?></h1>
    <div class="qh-messages">
        <?php
        if (!empty($data)) {
            foreach ($data as $item) {
            ?>
            <p><?php echo $item->user_login . ' : ' . $item->message; ?></p>
            <?php
            }

            for ($i = count($data) - 1; $i >=0 ; $i--) {
                echo '<p>' . $data[$i]->user_login . ': ' . esc_attr($data[$i]->message) . '</p>';
            }
        }
        ?>
    </div>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" accept-charset="utf-8" id="qh-form">
        <?php wp_nonce_field('qhshoutbox', 'qhsecurity'); ?>
        <input type="text" name="qhMessage" id="qh-input" value="" placeholder="Type anything..." maxlength="<?php echo $qhMaxLength; ?>" />
        <input type="submit" name="qhshoutbox" id="submitMessage" value="Send!" />
    </form>
    <div class="qh-status"></div>
</aside>