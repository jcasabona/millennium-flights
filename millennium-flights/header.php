<!DOCTYPE html>
<html lang="en-us">
<head>
	<title><?php bloginfo('name'); ?> | <?php wp_title(); ?> </title>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<?php wp_head(); ?>
</head>
<body>
		<div id="wrapper">
			<header class="group">
				<h1 class="group"><img src="<?php print IMAGES;?>/logo.png" alt="<?php bloginfo('name'); ?>" /> <?php bloginfo('name'); ?></h1>
				<nav id="main">
					<div class="select-menu">
		<?php
			wp_nav_menu(array(
				'menu' => 'Main'
				)
			);
		?>
	</div>

				</nav>
			</header>
			
			<div id="content" class="group">
