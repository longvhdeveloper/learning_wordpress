<div class="wrap">
    <h2>My Setting Page</h2>
    <form method="post" action="options.php">
        <?php 
        settings_fields('mySettingGroup');
        do_settings_sections('my_menu');
        submit_button();
        ?>
    </form>
</div>

