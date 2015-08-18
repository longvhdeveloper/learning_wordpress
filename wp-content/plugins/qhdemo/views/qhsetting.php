<div class="wrap">
    <h2>QH Setting Demo</h2>
    <form method="post" action="options.php">
        <?php 
        settings_fields('qhSettingGroup');
        do_settings_sections('qhsetting');
        submit_button();
        ?>
    </form>
</div>

