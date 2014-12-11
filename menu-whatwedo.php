<div class="menu_page_content"><?php

	$page 		= get_page_by_title( 'Galleries of Our Work' );
	$post 		= get_post( $page->ID );
	$content 	= apply_filters( 'the_content', $post->post_content );

	if ( ! empty( $post->post_content ) ) {

		echo $content; 

	} 

?></div><?php 

if ( has_nav_menu( 'galleriesofourwork' ) ) {
						
	$menu['theme_location']		= 'galleriesofourwork';
	$menu['container'] 			= 'div';
	$menu['container_id']    	= 'menu-galleriesofourwork';
	$menu['container_class'] 	= 'menu nav-galleriesofourwork';
	$menu['menu_id']         	= 'menu-galleriesofourwork-items';
	$menu['menu_class']      	= 'menu-items';
	$menu['depth']           	= 2;
	$menu['fallback_cb']     	= '';

	wp_nav_menu( $menu );

} ?>
<div class="menu_page_content"><?php

	$page 		= get_page_by_title( 'What We Do at Blue' );
	$post 		= get_post( $page->ID );
	$content 	= apply_filters( 'the_content', $post->post_content );

	if ( ! empty( $post->post_content ) ) {

		echo $content; 

	}

?></div><?php 

if ( has_nav_menu( 'whatwedoatblue' ) ) {
						
	$menu['theme_location']		= 'whatwedoatblue';
	$menu['container'] 			= 'div';
	$menu['container_id']    	= 'menu-whatwedoatblue';
	$menu['container_class'] 	= 'menu nav-whatwedoatblue';
	$menu['menu_id']         	= 'menu-whatwedoatblue-items';
	$menu['menu_class']      	= 'menu-items';
	$menu['depth']           	= 2;
	$menu['fallback_cb']     	= '';

	wp_nav_menu( $menu );

} ?>
