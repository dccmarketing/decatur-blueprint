<div class="menu_page_content"><?php

	$page 		= get_page_by_title( 'Plans & Portals' );
	$post 		= get_post( $page->ID );
	$content 	= apply_filters( 'the_content', $post->post_content );

	echo $content; 

?></div><?php if ( has_nav_menu( 'plansandportals' ) ) {
					
	$menu['theme_location']		= 'plansandportals';
	$menu['container'] 			= 'div';
	$menu['container_id']    	= 'menu-plansandportals';
	$menu['container_class'] 	= 'menu nav-plansandportals';
	$menu['menu_id']         	= 'menu-plansandportals-items';
	$menu['menu_class']      	= 'menu-items';
	$menu['depth']           	= 2;
	$menu['fallback_cb']     	= '';

	wp_nav_menu( $menu );

} ?>