<div id="comments" class="comments-area">
    <?php
    if ( have_comments() ) {
        MyTheme::getComments(get_comments(array(
            'status' => 'approve',
            'post_id' => get_the_ID()
        )));
    }
    if (!comments_open(get_the_ID())) {
        echo '<p class="no-comments">'.__('Comment are closed.').'</p>';
    } else {
        comment_form();
    }
    ?>

</div>