<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Decatur Blueprint
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'slidein-content' ); ?>>
	<header class="entry-header"><?php

		the_title( '<h1 class="entry-title">', '</h1>' );

	?></header><!-- .entry-header -->
	<div class="entry-content"><?php

		the_content();

	?></div><!-- .entry-content -->
</article><!-- #post-## -->