<ul class="list-group">
    <?php
    $postList = new WP_Query(array(
        'posts_per_page' => 10
    ));
    if ($postList->have_posts()) {
        while($postList->have_posts()) {
            $postList->the_post();
            ?>
            <li class="list-group-item"><a href="<?php echo get_permalink(get_the_ID()) ?>" title="<?php echo get_the_title(); ?>"><span class="glyphicon glyphicon-list-alt"></span><?php echo get_the_title(); ?></a></li>
            <?php
        }
    }
    ?>
</ul>