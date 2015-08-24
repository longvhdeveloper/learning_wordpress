<div class="wrap">
    <h2>QH Shoutbox Setting</h2>
    <form method="post" action="options.php">
        <input type="hidden" name="action" value="update">
        <?php
        settings_fields('qhSettingGroup');
        do_settings_sections('qhsetting');
        submit_button();
        ?>
    </form>
</div>
