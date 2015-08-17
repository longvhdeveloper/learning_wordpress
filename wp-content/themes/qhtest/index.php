<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Testing Page | <?php do_action('qh_title_page'); ?></title>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
	<?php wp_head(); ?>
</head>
<body class="<?php body_class(); ?>">
	<div class="container">
		<div class="col-sm-12">
			<div class="jumbotron">
				<h1><?php echo apply_filters('qh_title', 'Hello, world!', 'Hello ban trai'); ?></h1>
				<p><?php do_action('qh_header'); ?></p>
				<p>
					<a class="btn btn-primary btn-lg" href="#" role="button">
						Xem thêm
					</a>
				</p>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="panel panel-default">
				<div class="panel-body">
					<?php do_action('qh_left'); ?>
				</div>
			</div>
		</div>
		<div class="col-sm-8">
			<div class="panel panel-default">
				<div class="panel-body">
					<?php do_action('qh_right', 'Khong lien quan', 'Co Lien Quan'); ?>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<?php do_action('qh_footer'); ?>
				</div>
			</div>
		</div>
	</div>

	<?php wp_footer();?>
</body>
</html>