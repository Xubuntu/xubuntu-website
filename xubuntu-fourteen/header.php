<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>>
<head>
	<title><?php wp_title( '&laquo;', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<meta name="language" content="<?php bloginfo( 'language' ); ?>">
	<meta name="Author" lang="<?php bloginfo( 'language' ); ?>" content="Pasi Lallinaho" />
	<meta name="copyright" content="&copy; <?php echo date( 'Y' ); ?> Canonical Ltd." />
	<meta name="description" content="<?php bloginfo( 'name' ); ?> – <?php bloginfo( 'description' ); ?>" />

	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.png">

	<!-- Eric Meyer: CSS reset | http://meyerweb.com/eric/thoughts/2007/05/01/reset-reloaded/ -->
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/reset.css" media="all" />
	<!-- Steve Matteson: Open Sans | http://www.google.com/fonts/specimen/Open+Sans -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,600' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/style.css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/templates.css" media="all" />

	<!-- Responsive stylesheets -->
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/style-sub1200.css" media="only screen and (max-width:1200px)" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/style-sub1000.css" media="only screen and (max-width:1000px)" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/style-sub600.css" media="only screen and (max-width:600px)" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/style-sub450.css" media="only screen and (max-width:450px)" />

	<!-- Extra stylesheets -->
	<link rel="stylesheet" href="http://static.xubuntu.org/www/extras.css" media="all" />

	<!-- Stylesheets for Internet Explorer compatibility -->
	<!--[if IE]><link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/iefix.css" media="all" /><![endif]-->
	<!--[if IE 7]><link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/ie7fix.css" media="all" /><![endif]-->

	<?php wp_head( ); ?>
</head>

<body id="xubuntu" <?php echo body_class( ); ?>>

<div id="header">
	<div id="logo">
		<a href="<?php bloginfo( 'home' ); ?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/xubuntu-logo.png" alt="Xubuntu" /></a>
	</div>
</div>
<div id="wpcontent" class="group">

