<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package Decatur Blueprint
 */

$parents = get_post_ancestors( get_the_ID() );

if ( empty( $parents ) ) {

	$id = get_the_ID();

} else {

	$count 	= count( $parents );
	$id 	= $parents[$count - 1];

}

$class = '';

if ( is_page_template( 'page_left-sidebar-menu.php' ) ) {

	$class = 'slidein';

}

?>
<div class="menu-sidebar <?php echo $class; ?>">
	<header class="menu-header">
		<div class="header-wrap">
			<div class="sidemenu-logo"><?php

				echo get_page_icon( $id );

			?></div>
			<h1><?php

				echo get_the_title( $id );

			?></h1>
		</div><!-- .header-wrap -->
	</header><!-- .menu-header -->
	<div class="sidebar-menu-content"><?php

		$title 	= strtolower( str_replace( ' ', '', get_the_title( $id ) ) );

		//pretty( $title );

		$menu 	= str_replace( '&#038;', 'and', $title );

		//pretty( $menu );

		get_template_part( 'menu', $menu );
		
	?></div><!-- .sidebar-menu-content -->
</div><!-- .menu-sidebar -->