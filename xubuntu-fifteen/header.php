<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>>
<head>
	<title><?php wp_title( '&laquo;', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<meta name="description" content="<?php bloginfo( 'name' ); ?> – <?php bloginfo( 'description' ); ?>" />
	<meta name="author" content="The Xubuntu community" />
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1" />

	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri( ); ?>/images/xubuntu-icon-16.png">

	<?php wp_head( ); ?>
</head>

<body id="xubuntu" <?php echo body_class( 'no-js' ); ?>>

<header>
	<div id="logo">
		<a href="<?php echo home_url( '/' ); ?>"><img src="<?php echo get_stylesheet_directory_uri( ); ?>/images/xubuntu-logo-45.png" alt="Xubuntu" /></a>
	</div>

	<div id="navi">
		<a id="opennavi" class="navi_open_button" href="#footer_navi" title="<?php _e( 'Click to see more', 'xubuntu' ); ?>"></a>
		<?php
			wp_nav_menu( array(
				'theme_location' => 'quick_navigation',
				'container' => 'nav',
				'container_id' => 'navi_quick',
				'container_class' => 'group navigation nq',
				'fallback_cb' => 'xubuntu_quick_menu_fallback'
			) );
		?>
		<?php
			wp_nav_menu( array(
				'theme_location' => 'main_navigation',
				'container' => 'nav',
				'container_id' => 'navi_main',
				'container_class' => 'group navigation nd',
				'fallback_cb' => false
			) );
		?>
	</div>
</header>
