<div class="menu_page_content"><?php

	$page 		= get_page_by_title( 'Do Work' );
	$post 		= get_post( $page->ID );
	$content 	= apply_filters( 'the_content', $post->post_content );

	echo $content; 

?></div><?php if ( has_nav_menu( 'dowork' ) ) {
					
	$menu['theme_location']		= 'dowork';
	$menu['container'] 			= 'div';
	$menu['container_id']    	= 'menu-dowork';
	$menu['container_class'] 	= 'menu nav-dowork';
	$menu['menu_id']         	= 'menu-dowork-items';
	$menu['menu_class']      	= 'menu-items';
	$menu['depth']           	= 2;
	$menu['fallback_cb']     	= '';

	wp_nav_menu( $menu );

} ?>