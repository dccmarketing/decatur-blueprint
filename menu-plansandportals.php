<div class="menu_page_content"><?php

	$page 		= get_page_by_title( 'Links & Lists' );
	$post 		= get_post( $page->ID );
	$content 	= apply_filters( 'the_content', $post->post_content );

	if ( ! empty( $post->post_content ) ) {

		echo $content; 

	}

?></div><?php if ( has_nav_menu( 'linksandlists' ) ) {
					
	$menu['theme_location']		= 'linksandlists';
	$menu['container'] 			= 'div';
	$menu['container_id']    	= 'menu-linksandlists';
	$menu['container_class'] 	= 'menu nav-linksandlists';
	$menu['menu_id']         	= 'menu-linksandlists-items';
	$menu['menu_class']      	= 'menu-items';
	$menu['depth']           	= 2;
	$menu['fallback_cb']     	= '';

	wp_nav_menu( $menu );

} ?><div class="menu_page_content"><?php

	$page 		= get_page_by_title( 'AEC Digital Services' );
	$post 		= get_post( $page->ID );
	$content 	= apply_filters( 'the_content', $post->post_content );

	if ( ! empty( $post->post_content ) ) {

		echo $content; 

	}

?></div><?php if ( has_nav_menu( 'aecdigitalservices' ) ) {
					
	$menu['theme_location']		= 'aecdigitalservices';
	$menu['container'] 			= 'div';
	$menu['container_id']    	= 'menu-aecdigitalservices';
	$menu['container_class'] 	= 'menu nav-aecdigitalservices';
	$menu['menu_id']         	= 'menu-aecdigitalservices-items';
	$menu['menu_class']      	= 'menu-items';
	$menu['depth']           	= 2;
	$menu['fallback_cb']     	= '';

	wp_nav_menu( $menu );

} ?>