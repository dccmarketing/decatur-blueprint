<?php
/**
 * The template for displaying all single posts.
 *
 * @package Decatur Blueprint
 */

get_header();

	?><div id="primary" class="content-area content-on-left">
		<main id="main" class="site-main" role="main"><?php

		$query = new WP_Query( array( 'pagename' => 'our-story' ) );

		if ( $query->have_posts() ) {

			while ( $query->have_posts() ) : $query->the_post();

				?><article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<div class="header-wrap">
							<div class="sidemenu-logo"><?php

								echo decaturblue_get_svg_by_pageID( get_the_ID() );

							?></div><?php

							the_title( '<h1 class="entry-title">', '</h1>' );
						?></div><!-- .header-wrap -->
					</header><!-- .entry-header -->

					<div class="entry-content"><?php
						
						the_content();

						echo decaturblue_staff_list();
						
					?></div><!-- .entry-content -->

				</article><!-- #post-## --><?php

			endwhile; // loop

			wp_reset_postdata();

		} // have_posts()

		?></main><!-- #main -->
	</div><!-- #primary --><?php

	?><div id="staffsingle" class="staffsingle slidein-content">
		<main id="main" class="site-main" role="main"><?php

		while ( have_posts() ) : the_post();

			?><article id="post-<?php the_ID(); ?>" <?php post_class( 'singlestaff' ); ?>>
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
			</article><!-- #post-## --><?php

		endwhile; // end of the loop.

		?></main><!-- #main -->
	</div><!-- #staffsingle --><?php

get_footer();
?>