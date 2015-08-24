<?php
get_header();
?>

<!-- CONTENT -->
<?php
if (have_posts()) {
    while (have_posts()) {
        the_post();
        get_template_part('content', get_post_format()); //content + format
    }
    wp_reset_postdata();
}
?>
<div class="text-center">
    <!-- pagination -->
    <?php
    echo MyTheme::paginate();
    ?>
</div>
<?php
get_footer();
?>
