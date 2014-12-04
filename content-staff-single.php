<?php
/**
 * @package Decatur Blueprint
 */

?><article id="post-<?php the_ID(); ?>" <?php post_class( 'slidein-content singlestaff' ); ?>>
	<div class="entry-content"><?php

		$picurl = get_thumbnail_url( get_the_ID() );
		$custom = get_post_meta( get_the_ID() );

		?><div class="staffpic" style="background-image:url(<?php echo $picurl; ?>)"></div>
		<h2 class="staffname"><?php echo the_title(); ?></h2>
		<div class="stafftitle"><?php echo $custom['position'][0]; ?></div>
		<div class="staffbio"><?php echo the_content(); ?></div>
		<div class="staffphone"><a href="tel:<?php echo $custom['phone_number'][0]; ?>"><?php echo $custom['phone_number'][0]; ?></a></div>
		<div class="staffemail"><a href="mailto:<?php echo $custom['email_address'][0]; ?>"><?php echo $custom['email_address'][0]; ?></a></div>

	</div><!-- .entry-content -->
</article><!-- #post-## -->