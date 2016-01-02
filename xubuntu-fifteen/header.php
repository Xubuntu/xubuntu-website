<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes( 'xhtml' ); ?>>
<head>
	<title><?php wp_title( '&laquo;', true, 'right' ); ?><?php bloginfo( 'name' ); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />

	<meta name="description" content="<?php bloginfo( 'name' ); ?> – <?php bloginfo( 'description' ); ?>" />
	<meta name="author" content="The Xubuntu community" />
	<meta name="viewport" content="width=device-width, maximum-scale=1.0, minimum-scale=1.0, initial-scale=1" />

	<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.png">

	<?php wp_head( ); ?>
</head>

<body id="xubuntu" <?php echo body_class( ); ?>>

<div id="header_outer">
	<div id="header">
		<div id="logo">
			<a href="<?php home_url( '/' ); ?>"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/images/xubuntu-logo-45.png" alt="Xubuntu" /></a>
		</div>
	</div>
	<div id="navi_outer">
		<div id="navi">
			<a id="opennavi" class="navi_open_button" href="#footer_navi" title="<?php _e( 'Click to see more', 'xubuntu' ); ?>"></a>
			<?php
				wp_nav_menu( array(
					'theme_location' => 'quick_navigation',
					'container_id' => 'navi_quick',
					'container_class' => 'group navigation nq',
					'fallback_cb' => 'xubuntu_quick_menu_fallback'
				) );
			?>
			<?php
				wp_nav_menu( array(
					'theme_location' => 'main_navigation',
					'container_id' => 'navi_main',
					'container_class' => 'group navigation nd',
					'fallback_cb' => false
				) );
			?>
		</div>
	</div>
</div>
