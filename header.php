<!DOCTYPE html>
<html <?php language_attributes(); ?> />
<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmgp.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
	<?php global $tp_options; ?>
</head>
<body <?php body_class(); ?> >
	<div id="container">
		<div id="header_search" class="row col-sm-8">
			<?php trungkien_social_menu(); ?>
			<?php trungkien_menu('top-menu');?>
		</div>
		<div id="header_main" class="col-sm-12">
			<div id="wrapper" class="row col-sm-10">
				<?php trungkien_logo(); ?>
				<div class="col-sm-8">
					<?php trungkien_main_menu('primary-menu');?>
				</div>
			</div>
		</div>
	</div>