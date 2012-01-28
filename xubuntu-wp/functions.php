<?php

/* enable shortcodes for widgets */
add_filter( 'widget_text', 'do_shortcode' );

/* enable widget areas */
if( function_exists( 'register_sidebar' ) ) {
	register_sidebar( array(
		"name" => "Frontpage",
		"id" => "xubuntu_front",
		"before_widget" => "<div class='column'>",
		"after_widget" => "</div>",
		"before_title" => "<h2>",
		"after_title" => "</h2>"
	) );
	register_sidebar( array(
		"name" => "Frontpage columns",
		"id" => "xubuntu_front_columns",
		"before_widget" => "<div class='column'>",
		"after_widget" => "</div>",
		"before_title" => "<h2>",
		"after_title" => "</h2>"
	) );
	register_sidebar( array(
		"name" => "Sidebar",
		"id" => "xubuntu_sidebar",
		"before_widget" => "",
		"after_widget" => "",
		"before_title" => "<h4>",
		"after_title" => "</h4>"
	) );
	register_sidebar( array(
		"name" => "Footer",
		"id" => "xubuntu_footer",
		"before_widget" => "<div class='footer-widget'>",
		"after_widget" => "</div>",
		"before_title" => "<h4>",
		"after_title" => "</h4>"
	) );
}

?>
