<?php
/*  Template Name: Bottom navigation
 *
 */

	get_header( );
?>

<div id="mainwrap" class="group tpl_bottomnavi">
	<div id="main">
		<?php get_template_part( 'content', get_post_format( ) ); ?>
	</div>
</div>

<?php
	#get_sidebar( );

	/* Shows menu set to 'front-page' */
	wp_nav_menu( array(
		'theme_location' => 'front-page',
		'container_class' => 'group tpl_bottomnavi',
		'container_id' => 'horizontal_navi',
		'fallback_cb' => false
	) );
?>

<?php get_footer( ); ?>
