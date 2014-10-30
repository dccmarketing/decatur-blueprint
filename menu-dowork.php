<?php if ( has_nav_menu( 'dowork' ) ) {
					
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