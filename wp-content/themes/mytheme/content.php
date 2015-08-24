<article id="post-<?php echo get_the_ID(); ?>" class="panel panel-default qh-content post-<?php echo implode(' ', get_post_class()) ?>">
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-3">
                <?php
                if (has_post_thumbnail() && is_home()) {
                    the_post_thumbnail('qh_thumbnail', array(
                        'class' => 'img-responsive'
                    ));
                } elseif (is_home()) {
                    echo '<img src="'.QH_THEME_URL.'/images/no_image.png" class="img-responsive" />';
                }
                ?>
            </div>
            <div class="col-xs-<?php echo is_home() ? '9' : '12'; ?>">
                <div class="qh-content-right">
                    <div class="qh-content-category">
                        <ol class="breadcrumb">
                            <?php
                            foreach (get_the_category() as $category) {
                                echo '<li>';
                                echo '<a href="'.get_category_link($category->term_id).'"">'.$category->cat_name.'</a>';
                                echo '</li>';
                            }
                            ?>
                        </ol>
                    </div>
                    <div class="clearfix">
                        <p class="pull-left"><span class="glyphicon glyphicon-time"></span> <?php echo get_the_time('F j, Y') . ' ' . get_the_time('g:i a') ?></p>
                        <p class="pull-right"><span class="glyphicon glyphicon-user"></span> <?php echo get_the_author(); ?>
                            <?php if(is_user_logged_in() && current_user_can('edit_post')) { ?>
                                <span class="glyphicon glyphicon-pencil"></span> <span><a class="post-edit-link" href="<?php echo get_edit_post_link(get_the_ID()); ?>">Edit</a> </span>
                            <?php } ?>
                            <span class="glyphicon glyphicon-comment"></span> <a href="<?php echo get_comments_link(); ?>">Comment</a>
                        </p>
                    </div>
                    <h3 class="page-header">
                        <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo apply_filters('the_title', get_the_title()); ?></a>	    			</h3>
                    <div class="post-content">
                        <?php
                        if (is_search()) {
                            the_excerpt();
                        } else {
                            echo apply_filters('the_content', get_the_content('Read More...'));
                            if (!is_home()) {
                                echo '<p>';
                                the_tags('<span class="glyphicon glyphicon-tags"> Tags</span>: ');
                                echo '</p>';
                            }
                        }
                        ?>
                    </div>

                </div>

                <!-- COMMENTS HERE -->
                <?php comments_template(); ?>

                <!-- END COMMENTS -->
            </div>
        </div>
    </div>
</article>