<div class="menu_page_content"><?php

	$page 		= get_page_by_title( 'Studio Blue' );
	$post 		= get_post( $page->ID );
	$content 	= apply_filters( 'the_content', $post->post_content );

	echo $content; 

?></div><?php 

if ( has_nav_menu( 'studioblue' ) ) {
						
	$menu['theme_location']		= 'studioblue';
	$menu['container'] 			= 'div';
	$menu['container_id']    	= 'menu-studioblue';
	$menu['container_class'] 	= 'menu nav-studioblue';
	$menu['menu_id']         	= 'menu-studioblue-items';
	$menu['menu_class']      	= 'menu-items';
	$menu['depth']           	= 2;
	$menu['fallback_cb']     	= '';

	wp_nav_menu( $menu );

} ?>
