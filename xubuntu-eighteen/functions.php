<?php

/*
 *  Admin
 *
 */
include 'functions-admin.php';

/*
 *  Register widget areas and menu locations
 *  ...and other features
 *
 */
include 'functions-features.php';
include 'functions-features-articles.php';
include 'functions-features-releases.php';
include 'functions-features-release-links.php';
include 'functions-features-release-mirrors.php';

/*
 *  Configuration options
 *
 */
include 'functions-config.php';


/*
 *  Include stylesheets
 *
 */
add_action( 'wp_enqueue_scripts', 'xubuntu_styles' );

function xubuntu_styles( ) {
	// Eric Meyer: CSS reset | http://meyerweb.com/eric/thoughts/2007/05/01/reset-reloaded/
	wp_enqueue_style( 'css-reset', get_stylesheet_directory_uri( ) . '/reset.css' );

	// Font: Noto Sans
	wp_enqueue_style( 'font-noto-sans', get_stylesheet_directory_uri( ) . '/font-noto-sans.css' );

	// Main style sheets
	wp_enqueue_style( 'xubuntu-style', get_stylesheet_directory_uri( ) . '/style.css' );
	wp_enqueue_style( 'xubuntu-style-common', get_stylesheet_directory_uri( ) . '/style-common.css' );

	// Responsive design
	wp_enqueue_style( 'xubuntu-style-480', get_stylesheet_directory_uri( ) . '/style-480.css', array( 'xubuntu-style', 'xubuntu-style-common' ), false, 'only screen and (min-width:480px)' );
	wp_enqueue_style( 'xubuntu-style-600', get_stylesheet_directory_uri( ) . '/style-600.css', array( 'xubuntu-style-480' ), false, 'only screen and (min-width:600px)' );
	wp_enqueue_style( 'xubuntu-style-800', get_stylesheet_directory_uri( ) . '/style-800.css', array( 'xubuntu-style-600' ), false, 'only screen and (min-width:800px)' );
	wp_enqueue_style( 'xubuntu-style-1000', get_stylesheet_directory_uri( ) . '/style-1000.css', array( 'xubuntu-style-800' ), false, 'only screen and (min-width:1000px)' );
}

/*  Check if the current page is a blog page
 *  (c) 2011 Wes Bos, https://gist.github.com/wesbos/1189639
 *
 */

function is_blog( ) {
	global $post;
	$posttype = get_post_type( $post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post' ) ) ? true : false ;
}

?>