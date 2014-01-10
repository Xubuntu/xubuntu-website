<!DOCTYPE html><!-- this is HTML5 -->

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>>
<head>
	<title><?php wp_title( '&laquo;', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<meta name="language" content="<?php bloginfo( 'language' ); ?>">
	<meta name="Author" lang="<?php bloginfo( 'language' ); ?>" content="Pasi Lallinaho" />
	<meta name="copyright" content="&copy; <?php echo date( 'Y' ); ?> Canonical Ltd." />
	<meta name="description" content="<?php bloginfo( 'name' ); ?> – <?php bloginfo( 'description' ); ?>" />

	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.png">

	<!-- CSS reset: http://meyerweb.com/eric/thoughts/2007/05/01/reset-reloaded/ -->
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/reset.css" media="all" />
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_directory' ); ?>/style.css" media="all" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,600' rel='stylesheet' type='text/css'>

	<?php wp_head( ); ?>
</head>

<?php if( is_single( ) ) { $singular = "item-single"; } elseif( is_archive( ) || is_home( ) ) { $singular = "item-archive"; } ?>
<?php if( is_front_page( ) ) { $front = "is-front"; } ?>

<body id="xubuntu" class="item-<?php print $post->post_name . ' ' . $singular . ' ' . $front; ?>">

<div id="header">
	<div id="logo">
		<a href="<?php bloginfo( 'home' ); ?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/xubuntu-logo.png" /></a>
	</div>
</div>
<div id="wpcontent" class="group">

