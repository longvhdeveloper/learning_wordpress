<?php
//cho nay ko dung bien co ten la posts vi se conflict voi core cua wp
$post_list = new WP_Query(array(
    'posts_per_page' => 5
));
if ($post_list->have_posts()) {
    $i = 0;
    while ($post_list->have_posts()) {
        $post_list->the_post();
        if ($i == 0) {
            ?>
            <div class="col-md-6">
                <div class="row">
                    <a class="qh-box-large" href="<?php echo get_permalink(get_the_ID()); ?>" title="<?php echo get_the_title() ?>">
                        <h3><?php echo get_the_title(); ?></h3>
                        <?php if(has_post_thumbnail()) {
                            the_post_thumbnail('qhlarge');
                        } else {
                            echo '<img src="'.QH_THEME_URL.'/images/no_image.png" alt="No image" />';
                        }?>
                        <div class="qh-box-overlay main"></div>
                    </a>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="col-md-3">
                <div class="row">
                    <a class="qh-box-small" href="<?php echo get_permalink(get_the_ID()) ?>" title="<?php echo get_the_title(); ?>">
                        <h3><?php echo get_the_title(); ?></h3>
                        <?php if(has_post_thumbnail()) {
                            the_post_thumbnail('qhsmall');
                        } else {
                            echo '<img src="'.QH_THEME_URL.'/images/no_image.png" alt="No image" />';
                        }?>
                        <div class="qh-box-overlay bg-<?php echo $i; ?>"></div>
                    </a>
                </div>
            </div>
            <?php
        }

        $i++;
    }
    wp_reset_postdata();
}
?>