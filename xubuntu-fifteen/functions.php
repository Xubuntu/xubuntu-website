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

/*
 *  Configuration options
 *
 */
include 'functions-config.php';


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