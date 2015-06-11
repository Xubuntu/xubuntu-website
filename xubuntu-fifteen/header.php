<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>>
<head>
	<title><?php wp_title( '&laquo;', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<meta name="description" content="<?php bloginfo( 'name' ); ?> – <?php bloginfo( 'description' ); ?>" />
	<meta name="author" content="The Xubuntu community" />

	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.png">

	<!-- Eric Meyer: CSS reset | http://meyerweb.com/eric/thoughts/2007/05/01/reset-reloaded/ -->
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/reset.css" media="all" />
	<!-- Steve Matteson: Open Sans | http://www.google.com/fonts/specimen/Open+Sans -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,600' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/style.css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/style-common.css" media="all" />

	<!-- Responsive stylesheets -->
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/style-resp-1200.css" media="only screen and (max-width:1200px)" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/style-resp-1000.css" media="only screen and (max-width:1000px)" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/style-resp-800.css" media="only screen and (max-width:800px)" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/style-resp-600.css" media="only screen and (max-width:600px)" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/style-resp-450.css" media="only screen and (max-width:450px)" />

	<!-- Extra stylesheets -->
	<link rel="stylesheet" href="http://static.xubuntu.org/www/extras.css" media="all" />

	<?php wp_head( ); ?>
</head>

<body id="xubuntu" <?php echo body_class( ); ?>>

<div id="header_outer">
	<div id="header">
		<div id="logo">
			<a href="<?php bloginfo( 'home' ); ?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/xubuntu-logo-45.png" alt="Xubuntu" /></a>
		</div>
	</div>
	<div id="navi_outer">
		<div id="navi">
			<a id="opennavi" href="#fbnavi" title="<?php _e( 'Click to open Menu', 'xubuntu' ); ?>"></a>
			<?php
				wp_nav_menu( array(
					'theme_location' => 'main_navigation',
					'container_class' => 'group navigation nd',
					'fallback_cb' => false
				) );
			?>
		</div>
	</div>
</div>
