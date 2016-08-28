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

	// Font: Open Sans
	wp_enqueue_style( 'font-open-sans', get_stylesheet_directory_uri( ) . '/font-open-sans.css' );

	// Main style sheets
	wp_enqueue_style( 'xubuntu-style', get_stylesheet_directory_uri( ) . '/style.css' );
	wp_enqueue_style( 'xubuntu-style-common', get_stylesheet_directory_uri( ) . '/style-common.css' );

	// Responsive design
	wp_enqueue_style( 'xubuntu-style-resp-1200', get_stylesheet_directory_uri( ) . '/style-resp-1200.css', array( 'xubuntu-style', 'xubuntu-style-common' ), false, 'only screen and (max-width:1200px)' );
	wp_enqueue_style( 'xubuntu-style-resp-1000', get_stylesheet_directory_uri( ) . '/style-resp-1000.css', array( 'xubuntu-style', 'xubuntu-style-common', 'xubuntu-style-resp-1200' ), false, 'only screen and (max-width:1000px)' );
	wp_enqueue_style( 'xubuntu-style-resp-800', get_stylesheet_directory_uri( ) . '/style-resp-800.css', array( 'xubuntu-style', 'xubuntu-style-common', 'xubuntu-style-resp-1000' ), false, 'only screen and (max-width:800px)' );
	wp_enqueue_style( 'xubuntu-style-resp-600', get_stylesheet_directory_uri( ) . '/style-resp-600.css', array( 'xubuntu-style', 'xubuntu-style-common', 'xubuntu-style-resp-800' ), false, 'only screen and (max-width:600px)' );
	wp_enqueue_style( 'xubuntu-style-resp-450', get_stylesheet_directory_uri( ) . '/style-resp-450.css', array( 'xubuntu-style', 'xubuntu-style-common', 'xubuntu-style-resp-600' ), false, 'only screen and (max-width:450px)' );
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