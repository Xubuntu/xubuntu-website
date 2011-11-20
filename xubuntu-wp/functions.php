<?php

/* enable menu */
add_action( 'init', 'xubuntu_navi_menu' );
function xubuntu_navi_menu( ) {
	register_nav_menus(
		array( 'xubuntu-header-nav' => 'Header Navigation links' )
	);
}

/* enable widgets */
if( function_exists( 'register_sidebar' ) ) {
	register_sidebar( array(
		"name" => "Homepage sidebar",
		"id" => "xubuntu_home_sidebar",
		"before_widget" => "",
		"after_widget" => "",
		"before_title" => "<h2>",
		"after_title" => "</h2>"
	) );
	register_sidebar( array(
		"name" => "Archive sidebar",
		"id" => "xubuntu_archive_sidebar",
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

/* shortcode for latest news */
function LatestNews( $atts, $content, $code ) {
	extract( shortcode_atts( array(
		'title' => 'Latest news',
		'cat' => ''
	), $atts ) );

	setlocale( LC_TIME, get_locale( ) );

	global $post;
	$myposts = get_posts( array( 'category' => $cat, 'numberposts' => 4 ) );
	foreach( $myposts as $post ) {
		$out .= "<li class=\"news\"><a href=\"" . get_permalink( ) . "\">" . get_the_title( ) . "&nbsp;&raquo;";
		$cat_res = get_the_category( ); unset( $cats );
		foreach( $cat_res as $num => $cat ) {
			$cats .= $cat->name;
			if( $num < count( $cat_res ) - 1 ) { $cats .= ", "; }
		}
		$out .= "<span class=\"news-meta\">" . strftime( __( '%B %e, %Y', 'xubuntu-wp' ), get_the_time( 'U' ) ) . " in " . $cats . "</span>";
		$out .= "</a></li>";
	}

	if( $out ) {
		$ret = "<div id=\"latest-news\">";
		$ret .= "<h2>{$title}</h2>\n<ul>{$out}</ul>";
		$ret .= "</div>";
	}

	return $ret;
}
add_shortcode( 'latest-news', 'LatestNews' );

/* custom comments */
function xubuntu_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	if( $comment->comment_type == "pingback" ) { ?>
		<li <?php comment_class( "group type-pingback" ); ?> id="li-comment-<?php comment_ID( ); ?>">
			<div class="comment-from">Pingback from <?php echo get_comment_author_link( ); ?></div>
			<div class="comment-comment"><?php comment_text( ); ?></div>
		<?php
	} else { ?>
		<li <?php comment_class( "group type-comment" ); ?> id="li-comment-<?php comment_ID(); ?>">
			<span class="comment-meta">
				<?php echo get_avatar( $comment, $size='18' ); ?>
				<strong><?php echo get_comment_author_link( ); ?></strong>, <?php setlocale( LC_TIME, get_locale( ) ); print strftime( __( '%B %e, %Y', 'xubuntu-wp' ), strtotime( $comment->comment_date ) ); ?>
			</span>

			<div class="comment-comment">
				<?php comment_text( ); ?>
				<div class="comment-reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></div>
			</div>

		<?php /* do not add trailing </li> !! */
	}
}

?>
