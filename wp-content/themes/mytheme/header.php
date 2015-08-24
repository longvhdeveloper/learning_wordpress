<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" lang="vi-VN">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" lang="vi-VN">
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php echo language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>QH Online Solutions | Just another WordPress site</title>
    <!--[if lt IE 9]>
    <script src="<?php echo QH_THEME_URL . 'scripts/js/' ?>html5shiv.min.js"></script>
    <![endif]-->
    <?php wp_head() ?>
</head>
<body <?php echo body_class(); ?>>




<!-- NAVBAR -->
<?php
$nav_color = get_theme_mod('qhtheme_nav_color') ? get_theme_mod('qhtheme_nav_color') : '#2E8DEF';
?>
<nav class="navbar navbar-default" role="navigation" style="background-color: <?php echo $nav_color; ?>;border-color: <?php echo $nav_color ?>;">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo get_home_url('/'); ?>">QHOnline</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <?php
            echo MyTheme::primaryMenu();
            ?>
            <form class="navbar-form navbar-left" role="search" action="<?php echo home_url('/'); ?>">
                <div class="form-group">
                    <input type="text" name="s" id="search" class="form-control" value="<?php echo get_search_query(); ?>" />
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<!-- END NAVBAR -->







<!-- CONTENT -->
<div class="container">
    <?php if(!is_single() && is_home()) { ?>
    <!-- ROW -->
        <?php
        if (get_theme_mod('qhtheme_special_post')) {
            $special_post_display = 'block';
        } else {
            $special_post_display = 'none';
        }
        ?>
    <div class="row" id="qhtheme-special-post" style="display: <?php echo $special_post_display; ?> ;">
        <div class="col-md-12 visible-md visible-lg">
            <div class="row">
                <!-- BOX -->
                <?php get_template_part('newest-posts'); ?>
            </div>
        </div>
        <div class="col-xs-12 visible-xs visible-sm">
            <div class="row">
                <div class="qh-top-news">
                    <!-- TOP NEWS -->
                    <?php get_template_part('top-news'); ?>
                    <!-- END TOP NEWS -->
                </div>
            </div>
        </div>
    </div>
        <!-- END ROW -->
    <?php } ?>
    <div class="row">
        <div class="col-md-10">
            <div class="row">