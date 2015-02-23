<?php
	/* Template name: Blank  */
	/* A blank page template with no content area background  */
?>

<?php get_header( ); ?>
<?php the_post( ); ?>

<div id="content_outer">
	<div id="content" class="air">
		<h1 class="boxed"><?php the_title( ); ?></h1>
		<?php the_content( ); ?>
	</div>
</div>

<?php get_footer( ); ?>