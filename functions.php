<?php
/**
 * Decatur Blueprint functions and definitions
 *
 * @package Decatur Blueprint
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'decaturblueprint_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function decaturblueprint_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Decatur Blueprint, use a find and replace
	 * to change 'decatur-blueprint' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'decatur-blueprint', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'db-gallery', 600, 450 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'decatur-blueprint' ),
		'social' => __( 'Social Links', 'decatur-blueprint' ),
		'dowork' => __( 'Do Work Menu', 'decatur-blueprint' ),
		'linksandlists' => __( 'Links and Lists Menu', 'decatur-blueprint' ),
		'aecdigitalservices' => __( 'AEC Digital Services Menu', 'decatur-blueprint' ),
		'galleriesofourwork' => __( 'Galleries of Our Work Menu', 'decatur-blueprint' ),
		'whatwedoatblue' => __( 'What We Do at Blue Menu', 'decatur-blueprint' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'decaturblueprint_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // decaturblueprint_setup
add_action( 'after_setup_theme', 'decaturblueprint_setup' );



/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function decaturblueprint_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'decatur-blueprint' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'decaturblueprint_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function decaturblueprint_scripts() {
	wp_enqueue_style( 'decatur-blueprint-style', get_stylesheet_uri() );

	wp_enqueue_script( 'decatur-blueprint-navigation', get_template_directory_uri() . '/js/navigation.min.js', array(), '20120206', true );

	wp_enqueue_script( 'decatur-blueprint-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), '20130115', true );

	//wp_enqueue_script( 'smoothState', get_template_directory_uri() . '/js/smoothState.min.js', array( 'jquery' ), null, TRUE );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_home() || is_front_page() ) {

		wp_enqueue_script( 'decatur-blueprint-bg-video', get_template_directory_uri() . '/js/html5ext.min.js' );

	}

	wp_enqueue_script( 'decatur-blueprint-public', get_template_directory_uri() . '/js/public.min.js', array( 'jquery' ), null, TRUE );
}
add_action( 'wp_enqueue_scripts', 'decaturblueprint_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



/**
 * Customize footer
 */
function custom_site_info() {

	printf( __( '<div class="copyright">&copy %1$s <a href="%2$s" title="Login">%3$s</a></a></div>', 'decatur-blueprint' ), date( 'Y' ), get_admin_url(), get_bloginfo( 'name' ) );

	echo '<div class="address"><address>230 West Wood &middot; Decatur, IL 62523</address> &middot; <a href="tel:2174237589">217-423-7589</a></div>';
	echo '<div class="credits">' . __( 'Site designed and developed by', 'decatur-blueprint' ) . ' <a href="http://dccmarketing.com" title="DCC Marketing">DCC Marketing</a></div>';

} // custom_site_info()
add_action( 'site_info', 'custom_site_info' );



/**
 * Load Fonts
 */
function load_fonts() {

	wp_register_style( 'et-googleFonts', 'http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' );
	wp_enqueue_style( 'et-googleFonts' );	

} // load_fonts()
add_action( 'wp_print_styles', 'load_fonts' );

/**
 * Add Extra Code to a Menu
 *
 * @author Bill Erickson
 * @link http://www.billerickson.net/customizing-wordpress-menus/
 *
 * @param 	string 		$item_output		//
 * @param 	object 		$item				//
 * @param 	int 		$depth 				//
 * @param 	array 		$args 				//
 * 
 * @return 	string 							modified menu
 */
function decaturblue_menu_svgs( $item_output, $item, $depth, $args ) {

	if ( 'social' !== $args->theme_location && 'primary' !== $args->theme_location ) { return $item_output; }

	$host 	= parse_url( $item->url, PHP_URL_HOST );
	$output = '<a href="' . $item->url . '" class="icon-menu">';
	$class 	= decaturblue_get_svg_by_class( $item->classes );

	if ( ! empty( $class ) ) {

		$output .= $class;

	} else {

		if ( $host !== parse_url( get_site_url(), PHP_URL_HOST ) ) { 

			$output .= decaturblue_get_svg_by_url( $item->url );

		} else {

			$output .= decaturblue_get_svg_by_pageID( $item->object_id );

		}

	} // class check

	if ( 'social' !== $args->theme_location ) {

		$output .= '<div class="menu-icon-label">' . $item->title . '</div>';

	}

	$output .= '</a>';

	return $output;

} // decaturblue_menu_svgs()

add_filter( 'walker_nav_menu_start_el', 'decaturblue_menu_svgs', 10, 4 );

/**
 * Gets the appropriate SVG based on a menu item class
 * 
 * @param  [type] $url [description]
 * @return [type]      [description]
 */
function decaturblue_get_svg_by_class( $classes ) {

	$output = '';

	foreach ( $classes as $class ) {

		$check = decaturblue_get_svg( $class );

		if ( ! is_null( $check ) ) { $output .= $check; break; }

	} // foreach

	return $output;

} // decaturblue_get_svg_by_class()

/**
 * Gets the appropriate SVG based on a URL
 * 
 * @param  [type] $url [description]
 * @return [type]      [description]
 */
function decaturblue_get_svg_by_pageID( $ID ) {

	$output = '';
	$page 	= get_post( $ID );

	switch( $page->post_title ) {

		case 'The Diggs' 		: $output .= decaturblue_get_svg( 'diggs' ); break;
		case 'Studio Blue' 		: $output .= decaturblue_get_svg( 'studio' ); break;
		case 'Plans & Portals' 	: $output .= decaturblue_get_svg( 'plansandportals' ); break;
		case 'Our Story' 		: $output .= decaturblue_get_svg( 'story' ); break;
		case 'Message Us' 		: $output .= decaturblue_get_svg( 'message' ); break;
		case 'Do Work' 			: $output .= decaturblue_get_svg( 'dowork' ); break;

	} // switch

	return $output;

} // decaturblue_get_svg_by_pageID()

/**
 * Gets the appropriate SVG based on a URL
 * 
 * @param  [type] $url [description]
 * @return [type]      [description]
 */
function decaturblue_get_svg_by_url( $url ) {

	$output = '';
	$host 	= parse_url( $url, PHP_URL_HOST );

	switch( $host ) {

		case 'facebook.com' 	: $output .= decaturblue_get_svg( 'facebook' ); break;
		case 'flickr.com' 		: $output .= decaturblue_get_svg( 'flickr' ); break;
		case 'instagram.com' 	: $output .= decaturblue_get_svg( 'instagram' ); break;
		case 'linkedin.com' 	: $output .= decaturblue_get_svg( 'linkedin' ); break;
		case 'pinterest.com' 	: $output .= decaturblue_get_svg( 'pinterest' ); break;
		case 'twitter.com' 		: $output .= decaturblue_get_svg( 'twitter' ); break;
		case 'vimeo.com' 		: $output .= decaturblue_get_svg( 'vimeo' ); break;
		case 'youtube.com' 		: $output .= decaturblue_get_svg( 'youtube' ); break;

	} // switch

	return $output;

} // decaturblue_get_svg_by_url()

function decaturblue_get_svg( $svg ) {

	$output = '';

	switch( $svg ) {

		case 'diggs'			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 144 144" enable-background="new 0 0 144 144" xml:space="preserve" class="diggs"><path fill="#ffffff" d="M45.034,81h-0.02v0.005C45.021,81.005,45.03,81,45.034,81 M102.516,72H94.5v31.5H78.64V86.91H65.36v16.59H49.5V72h-8.015 L72,41.414L102.516,72z M108.035,72c0-2.193-1.596-3.933-3.674-4.333L73.05,36.419c-0.722-0.72-1.446-0.72-2.168,0l-31.35,31.283 c-1.772,0.419-3.091,1.827-3.365,3.651c-0.081,0.215-0.208,0.42-0.217,0.646h0.086c0,2.483,2.016,4.5,4.5,4.5h4.5V81v22.5 c0,2.483,2.016,4.5,4.5,4.5h9h0.002h35.997c2.484,0,4.5-2.017,4.5-4.5v-27h4.5C106.02,76.5,108.035,74.483,108.035,72 M139.5,72.002 c0,37.277-30.221,67.498-67.5,67.498c-37.278,0-67.5-30.221-67.5-67.498C4.5,34.723,34.722,4.5,72,4.5 C109.279,4.5,139.5,34.723,139.5,72.002 M144,72c0-39.764-32.236-72-72-72S0,32.236,0,72s32.236,72,72,72S144,111.764,144,72"/></svg>'; break;
		case 'dowork' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 144 144" enable-background="new 0 0 144 144" xml:space="preserve" class="dowork"><path fill="#ffffff" d="M37.797,92.961c-3.584,3.576-3.584,9.381,0,12.967c3.584,3.582,9.398,3.582,12.975,0l17.854-17.852l2.355-2.352 c0.041-0.049,0.078-0.109,0.125-0.16l-2.965-2.971l-21.205,21.201c-0.504,0.514-1.33,0.514-1.842,0c-0.52-0.516-0.52-1.346,0-1.857 L66.281,80.75l-3.309-3.311l-21.18,21.191c-0.52,0.516-1.35,0.516-1.859,0c-0.51-0.504-0.51-1.34,0-1.852l21.188-21.188 l-2.963-2.977c-0.049,0.055-0.1,0.086-0.15,0.139L37.797,92.961z M106.688,41.807c1.461-2.209,2.258-4.387,1.789-4.859l-0.852-0.85 c0,0-0.375-0.385-0.844-0.85c-0.467-0.471-2.648,0.326-4.859,1.785l-5.689,3.744c-2.209,1.461-4.24,3.764-4.537,5.156l-0.531,2.508 L76.176,63.34l4.102,4.104l15.004-14.895c0,0,1.125-0.232,2.508-0.521c1.391-0.297,3.695-2.33,5.156-4.539L106.688,41.807z M103.359,99.67c0,2.035-1.654,3.688-3.689,3.688c-2.039,0-3.689-1.652-3.689-3.688c0-2.041,1.65-3.695,3.689-3.695 C101.705,95.975,103.359,97.629,103.359,99.67 M106.518,106.514c3.254-3.252,3.146-8.631-0.238-12.01 c-0.41-0.41-24.547-22.039-35.562-33.051c-2.045-2.049-1.236-3.549-0.816-4.295c2.953-5.213,3.148-10.562-1.842-15.555 c-5.271-5.271-13.887-7.701-21.029-5.908l12.676,12.672c0,0,0,3.779-3.777,7.561c-3.779,3.779-7.559,3.779-7.559,3.779 L35.695,47.029c-1.793,7.143,0.637,15.754,5.908,21.031c4.873,4.871,10.092,4.801,15.191,2.041c0.863-0.465,2.76-1.221,4.918,0.939 c11.211,11.209,32.383,34.832,32.791,35.238C97.887,109.664,103.266,109.77,106.518,106.514 M139.5,72 c0,37.277-30.223,67.5-67.5,67.5S4.5,109.277,4.5,72C4.5,34.721,34.723,4.5,72,4.5S139.5,34.721,139.5,72 M144,72 c0-39.766-32.236-72-72-72S0,32.234,0,72c0,39.764,32.236,72,72,72S144,111.764,144,72"/></svg>'; break;
		case 'facebook' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 113 113" enable-background="new 0 0 113 113" xml:space="preserve" class="facebook"><path d="M82.2 21.1H72.1c-7.9 0-9.4 3.8-9.4 9.2v12.1h18.8l-2.5 19H62.8v48.7H43.1V61.5H26.8v-19h16.4v-14c0-16.2 9.9-25.1 24.5-25.1 6.9 0 12.9 0.5 14.6 0.8V21.1z"/></svg>'; break;
		case 'flickr' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" class="flickr"><path d="M97.6 20.2v59.5c0 9.8-8 17.8-17.8 17.8H20.3c-9.8 0-17.8-8-17.8-17.8V20.2c0-9.8 8-17.8 17.8-17.8h59.5C89.6 2.3 97.6 10.3 97.6 20.2zM32.5 36.8c-7.2 0-13.1 5.9-13.1 13.1S25.3 63 32.5 63s13.1-5.9 13.1-13.1S39.8 36.8 32.5 36.8zM67.5 36.8c-7.2 0-13.1 5.9-13.1 13.1S60.2 63 67.5 63s13.1-5.9 13.1-13.1S74.7 36.8 67.5 36.8z"/></svg>'; break;
		case 'hamburger' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" class="hamburger"><path d="M97.1 21.3c0 2.1-1.8 3.9-3.9 3.9H6.8c-2.1 0-3.9-1.8-3.9-3.9v-7.9c0-2.1 1.8-3.9 3.9-3.9h86.4c2.1 0 3.9 1.8 3.9 3.9V21.3zM97.1 52.8c0 2.1-1.8 3.9-3.9 3.9H6.8c-2.1 0-3.9-1.8-3.9-3.9v-7.9c0-2.1 1.8-3.9 3.9-3.9h86.4c2.1 0 3.9 1.8 3.9 3.9V52.8zM97.1 84.2c0 2.1-1.8 3.9-3.9 3.9H6.8c-2.1 0-3.9-1.8-3.9-3.9v-7.9c0-2.1 1.8-3.9 3.9-3.9h86.4c2.1 0 3.9 1.8 3.9 3.9V84.2z"/></svg>'; break;
		case 'instagram' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" class="instagram"><path d="M97.1 84.9c0 6.6-5.5 12.1-12.1 12.1H15C8.3 97 2.9 91.5 2.9 84.9V14.8C2.9 8.1 8.3 2.7 15 2.7h70.1c6.6 0 12.1 5.5 12.1 12.1V84.9zM86.5 42.6h-8.3c0.8 2.5 1.2 5.3 1.2 8C79.4 66.3 66.3 79 50.1 79c-16.1 0-29.3-12.7-29.3-28.4 0-2.8 0.4-5.5 1.2-8h-8.7v39.8c0 2.1 1.7 3.7 3.7 3.7h65.6c2.1 0 3.7-1.7 3.7-3.7V42.6zM50.1 31.3c-10.4 0-18.9 8.2-18.9 18.4S39.6 68 50.1 68c10.5 0 19-8.2 19-18.4S60.6 31.3 50.1 31.3zM86.5 17.4c0-2.3-1.9-4.2-4.2-4.2H71.5c-2.3 0-4.2 1.9-4.2 4.2v10.1c0 2.3 1.9 4.2 4.2 4.2h10.7c2.3 0 4.2-1.9 4.2-4.2V17.4z"/></svg>'; break;
		case 'linkedin' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" class="linkedin"><path d="M14.2 25.9H14c-6.8 0-11.2-4.7-11.2-10.5 0-6 4.5-10.5 11.4-10.5 6.9 0 11.2 4.5 11.3 10.5C25.6 21.2 21.2 25.9 14.2 25.9zM24.3 95H4V34.2h20.3V95zM97.1 95H77V62.5c0-8.2-2.9-13.8-10.3-13.8 -5.6 0-8.9 3.7-10.4 7.4 -0.5 1.4-0.7 3.1-0.7 5V95H35.5c0.2-55.1 0-60.8 0-60.8h20.2V43h-0.1c2.6-4.2 7.4-10.3 18.4-10.3 13.3 0 23.3 8.7 23.3 27.4V95z"/></svg>'; break;
		case 'message' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 144 144" enable-background="new 0 0 144 144" xml:space="preserve" class="message"><path fill="#ffffff" d="M72,60.75c0,1.245-1.005,2.25-2.25,2.25c-1.241,0-2.25-1.005-2.25-2.25c0-1.242,1.009-2.25,2.25-2.25 C70.995,58.5,72,59.508,72,60.75 M76.5,60.75c0-3.729-3.021-6.75-6.75-6.75C66.024,54,63,57.021,63,60.75s3.024,6.75,6.75,6.75 C73.479,67.5,76.5,64.479,76.5,60.75 M87.75,63c-1.241,0-2.25-1.005-2.25-2.25c0-1.242,1.009-2.25,2.25-2.25 c1.244,0,2.25,1.008,2.25,2.25C90,61.995,88.994,63,87.75,63 M87.75,67.5c3.729,0,6.75-3.021,6.75-6.75S91.479,54,87.75,54 C84.023,54,81,57.021,81,60.75S84.023,67.5,87.75,67.5 M103.5,88.743l-11.512-8.945c-0.562-0.981-1.738-1.338-2.76-0.948 c0.004-0.033,0.006-0.068,0.012-0.102H63c-4.971,0-9-4.03-9-9v-18c0-4.971,4.029-9,9-9h31.5c4.97,0,9,4.029,9,9V88.743z M63,83.25 h13.482c-0.091,4.869-4.07,8.793-8.982,8.793H54.763c0.004,0.034,0.004,0.066,0.008,0.1c-1.02-0.39-2.194-0.033-2.759,0.946 L40.5,101.99V74.189c0-4.948,4.029-8.957,9-8.957v4.518C49.5,77.203,55.546,83.25,63,83.25 M107.974,92.311 c0-0.043,0.026-21.789,0.026-22.561v-18c0-7.454-6.047-13.5-13.5-13.5H63c-7.454,0-13.5,6.046-13.5,13.5v9 c-7.454,0-13.5,6.016-13.5,13.439v8.896c0,0.767,0.024,22.415,0.027,22.458c-0.121,0.875,0.211,1.564,1.028,2.035 c1.078,0.617,2.068,0.462,3.144-0.607l13.958-10.449H67.5c7.4,0,13.4-5.929,13.491-13.271h8.851l13.959,10.496 c1.079,1.079,2.068,1.232,3.145,0.613C107.763,93.885,108.094,93.189,107.974,92.311 M139.5,72c0,37.279-30.221,67.5-67.5,67.5 c-37.278,0-67.5-30.221-67.5-67.5C4.5,34.723,34.722,4.5,72,4.5C109.279,4.5,139.5,34.723,139.5,72 M144,72 c0-39.764-32.236-72-72-72S0,32.236,0,72s32.236,72,72,72S144,111.764,144,72"/></svg>'; break;
		case 'pinterest' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" class="pinterest"><path d="M50 97c-4.7 0-9.1-0.7-13.4-2 1.8-2.8 3.8-6.4 4.8-10.1 0 0 0.6-2.1 3.3-13 1.6 3.1 6.4 5.9 11.5 5.9 15.2 0 25.5-13.8 25.5-32.4 0-13.9-11.8-27-29.9-27 -22.3 0-33.6 16.1-33.6 29.5 0 8.1 3.1 15.3 9.6 18 1 0.4 2 0 2.3-1.2 0.2-0.8 0.7-2.9 1-3.7 0.3-1.2 0.2-1.6-0.7-2.6 -1.9-2.3-3.1-5.2-3.1-9.3 0-11.9 8.9-22.6 23.2-22.6 12.6 0 19.6 7.7 19.6 18.1 0 13.6-6 25-15 25 -4.9 0-8.6-4.1-7.4-9.1 1.4-6 4.2-12.4 4.2-16.7 0-3.9-2.1-7.1-6.4-7.1 -5 0-9.1 5.2-9.1 12.2 0 0 0 4.5 1.5 7.5 -5.2 21.9-6.1 25.7-6.1 25.7C31 85.7 31 89.7 31.1 93 14.5 85.7 2.9 69.2 2.9 49.8 2.9 23.8 24 2.7 50 2.7c26 0 47.1 21.1 47.1 47.1S76 97 50 97z"/></svg>'; break;
		case 'plansandportals' 	: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 144 144" enable-background="new 0 0 144 144" xml:space="preserve" class="plansandportals"><path fill="#ffffff" d="M77.903,59.5l4.378-3.545h-39.09l-12.147,50.1h79.608L99.331,59.361l-3.033,2.547l9.842,40.601H35.556L45.98,59.5H77.903z M71.687,67.25l-4.304,10.26L78.15,74.9L71.687,67.25z M49.922,66.261l-2.333,11.083h13.629l1.028-6.097l-2.995,1.757l-0.284,1.684 h-8.099l1.213-5.769h6.772l4.193-2.431l0.038-0.228H49.922z M57.109,85.594l-1.028,6.111h-8.589l1.287-6.111H57.109z M58.463,94.525 l1.983-11.754H46.49l-2.477,11.754H58.463z M63.719,66.945l-7.167,4.16l-1.87-1.797l-1.86,1.131l3.27,3.459l9.373-5.506 L63.719,66.945z M107.667,50.379l-6.869-8.131l-27.737,23.43l6.869,8.131l15.574-13.156l0.013-0.01l3.423-2.891L107.667,50.379z M112.035,46.689c1.096-0.924,1.232-2.562,0.308-3.656l-3.52-4.17c-0.925-1.092-2.562-1.229-3.657-0.308l-3.033,2.564l6.87,8.132 L112.035,46.689z M139.5,72.002c0,37.277-30.222,67.498-67.5,67.498c-37.279,0-67.5-30.221-67.5-67.498 C4.5,34.722,34.721,4.5,72,4.5C109.278,4.5,139.5,34.722,139.5,72.002 M144,72c0-39.764-32.236-72-72-72S0,32.236,0,72 s32.236,72,72,72S144,111.764,144,72"/></svg>'; break;
		case 'story' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 144 144" enable-background="new 0 0 144 144" xml:space="preserve" class="story"><path fill="#ffffff" d="M72,54c0,8.699-7.051,15.75-15.75,15.75S40.5,62.699,40.5,54s7.051-15.75,15.75-15.75S72,45.301,72,54 M76.5,54 c0-11.186-9.065-20.25-20.25-20.25C45.064,33.75,36,42.814,36,54s9.064,20.25,20.25,20.25C67.435,74.25,76.5,65.186,76.5,54 M105.75,60.75c0,4.971-4.03,9-9,9c-4.971,0-9-4.029-9-9c0-4.97,4.029-9,9-9C101.72,51.75,105.75,55.78,105.75,60.75 M110.25,60.75 c0-7.454-6.047-13.5-13.5-13.5s-13.5,6.046-13.5,13.5s6.047,13.5,13.5,13.5S110.25,68.204,110.25,60.75 M110.677,99 c-6.465,9.257-16.137,16.098-27.427,18.868V92.25h0.826c1.858-5.232,6.803-9,12.674-9c6.688,0,12.197,4.871,13.271,11.25h0.229V99 H110.677z M78.75,118.764c-2.202,0.317-4.456,0.486-6.75,0.486c-15.363,0-28.988-7.352-37.615-18.708 C36.738,90.628,45.621,83.25,56.25,83.25c11.669,0,21.256,8.881,22.386,20.25h0.114V118.764z M114.328,101.15l0.422-8.9 c-2.008-7.738-9.628-13.5-18-13.5c-8.279,0-15.214,5.607-17.311,13.219C74.729,84.062,66.121,78.75,56.25,78.75 c-11.374,0-21.078,7.044-25.051,17.002c-1.24,4.577,0.052,8.047,0.958,8.68C41.747,116.068,54.72,123.759,72,123.75 C89.767,123.741,105.01,114.79,114.328,101.15 M139.5,72.002c0,37.277-30.221,67.498-67.5,67.498c-37.278,0-67.5-30.221-67.5-67.498 C4.5,34.723,34.722,4.5,72,4.5C109.279,4.5,139.5,34.723,139.5,72.002 M144,72c0-39.764-32.236-72-72-72S0,32.236,0,72 s32.236,72,72,72S144,111.764,144,72"/></svg>'; break;
		case 'studio' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 144 144" enable-background="new 0 0 144 144" xml:space="preserve" class="studio"><path fill="#ffffff" d="M46.793,45.596c0-2.597,0.689-4.599,2.068-6.006c1.196-1.224,2.721-1.837,4.57-1.837c2.479,0,4.288,0.822,5.434,2.464 c0.63,0.92,0.97,1.846,1.017,2.774h-3.108c-0.198-0.713-0.451-1.252-0.763-1.615c-0.552-0.646-1.373-0.968-2.46-0.968 c-1.107,0-1.982,0.455-2.62,1.367c-0.64,0.912-0.96,2.201-0.96,3.869c0,1.67,0.338,2.92,1.014,3.75s1.53,1.246,2.57,1.246 c1.066,0,1.88-0.356,2.438-1.069c0.31-0.384,0.566-0.959,0.77-1.726h3.089c-0.266,1.621-0.947,2.939-2.043,3.955 c-1.095,1.017-2.497,1.525-4.209,1.525c-2.116,0-3.779-0.686-4.991-2.059C47.397,49.889,46.793,47.997,46.793,45.596 M41.577,56.11 h23.521v-21.14H41.577V56.11z M40.1,33.48h26.475v32.474H40.1V33.48z M37.468,68.587h31.738V30.85H37.468V68.587z M46.722,82.665 h3.664l3.089,6.479l2.957-6.479h3.521l-4.976,9.297v5.578h-3.108v-5.578L46.722,82.665z M41.577,100.676h23.521V79.534H41.577 V100.676z M40.1,78.044h26.475v32.476H40.1V78.044z M37.468,113.152h31.738v-37.74H37.468V113.152z M85.135,37.967h4.524 l2.708,11.696l2.687-11.696h4.474v14.875H96.63V42.78c0-0.289,0.004-0.694,0.01-1.216c0.008-0.521,0.011-0.924,0.011-1.205 l-2.819,12.482h-3.021l-2.799-12.483c0,0.282,0.004,0.684,0.01,1.204c0.006,0.521,0.011,0.928,0.011,1.217v10.062h-2.897V37.967z M80.57,56.11h23.521v-21.14H80.57V56.11z M79.094,33.48h26.475v32.474H79.094V33.48z M76.462,68.587H108.2V30.85H76.462V68.587z M85.763,82.665h3.058v6.129l5.748-6.129h4.018l-6.105,6.12l6.418,8.757h-3.996l-4.584-6.493l-1.498,1.518v4.976h-3.058V82.665z M80.57,100.676h23.521V79.534H80.57V100.676z M79.094,78.044h26.475v32.476H79.094V78.044z M76.462,113.152H108.2v-37.74H76.462 V113.152z M139.5,72c0,37.279-30.221,67.5-67.5,67.5c-37.278,0-67.5-30.221-67.5-67.5C4.5,34.723,34.722,4.5,72,4.5 C109.279,4.5,139.5,34.723,139.5,72 M144,72c0-39.764-32.236-72-72-72S0,32.236,0,72s32.236,72,72,72S144,111.764,144,72"/></svg>'; break;
		case 'twitter' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 113 113" enable-background="new 0 0 113 113" xml:space="preserve" class="twitter"><g><path d="M101.2 33.6c0.1 1 0.1 2 0.1 3c0 30.5-23.2 65.6-65.6 65.6c-13.1 0-25.2-3.8-35.4-10.4 c1.9 0.2 3.6 0.3 5.6 0.3c10.8 0 20.7-3.6 28.6-9.9c-10.1-0.2-18.6-6.9-21.6-16c1.4 0.2 2.9 0.4 4.4 0.4c2.1 0 4.1-0.3 6.1-0.8 C12.7 63.7 4.8 54.4 4.8 43.2c0-0.1 0-0.2 0-0.3c3.1 1.7 6.6 2.8 10.4 2.9C9 41.7 4.9 34.6 4.9 26.6c0-4.3 1.1-8.2 3.1-11.6 c11.4 14 28.4 23.1 47.6 24.1c-0.4-1.7-0.6-3.5-0.6-5.3c0-12.7 10.3-23.1 23.1-23.1c6.6 0 12.6 2.8 16.9 7.3 c5.2-1 10.2-2.9 14.6-5.6c-1.7 5.4-5.4 9.9-10.1 12.7c4.6-0.5 9.1-1.8 13.3-3.6C109.6 26.2 105.7 30.3 101.2 33.6z"/></g></svg>'; break;
		case 'vimeo' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" class="vimeo"><path d="M97.1 79.3c0 9.8-7.9 17.7-17.7 17.7H20.5c-9.8 0-17.7-7.9-17.7-17.7V20.4c0-9.8 7.9-17.7 17.7-17.7h58.9c9.8 0 17.7 7.9 17.7 17.7V79.3zM78.5 25.8c-2.5-3.2-7.8-3.3-11.5-2.8 -2.9 0.5-13 4.9-16.4 15.5 6-0.5 9.2 0.4 8.6 7.1 -0.2 2.8-1.7 5.8-3.2 8.8 -1.8 3.4-5.2 10-9.7 5.2 -4-4.3-3.7-12.5-4.6-18 -0.6-3.1-1.1-6.9-2.1-10.1 -0.9-2.7-2.9-6-5.3-6.7 -2.6-0.7-5.9 0.4-7.8 1.5 -6 3.6-10 8.6-15.9 12.8v0.4c2 1 1.4 2.6 2.9 2.8 3.6 0.5 7.1-3.4 9.5 0.7 1.5 2.5 1.9 5.2 2.8 7.8 1.3 3.6 2.2 7.4 3.3 11.5 1.7 6.9 3.8 17.2 9.8 19.8 3 1.3 7.6-0.4 9.9-1.8 6.3-3.7 11.2-9 15.3-14.5C73.8 52.9 79 38.2 79.8 33.9 80.4 31 80.3 28.1 78.5 25.8z"/></svg>'; break;
		case 'youtube' 			: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" class="youtube"><path d="M89.5 90.4c-1 4.4-4.6 7.6-8.8 8 -10.2 1.2-20.4 1.2-30.7 1.2 -10.2 0-20.5 0-30.7-1.2 -4.3-0.4-7.8-3.6-8.8-8 -1.4-6.2-1.4-13-1.4-19.3 0-6.4 0.1-13.2 1.4-19.3 1-4.4 4.6-7.6 8.9-8.1 10.1-1.1 20.4-1.1 30.6-1.1 10.2 0 20.5 0 30.7 1.1 4.3 0.5 7.8 3.7 8.8 8.1 1.4 6.2 1.4 12.9 1.4 19.3C90.9 77.4 90.9 84.2 89.5 90.4zM32.4 57.3v-5.2H15.2v5.2H21v31.4h5.5V57.3H32.4zM41.4 0.5l-6.7 22v15h-5.5v-15c-0.5-2.7-1.6-6.6-3.4-11.7C24.6 7.4 23.4 4 22.3 0.5h5.9L32 15.1l3.8-14.5H41.4zM47.4 88.7V61.4h-4.9v20.9c-1.1 1.5-2.2 2.3-3.1 2.3 -0.7 0-1-0.4-1.2-1.2 -0.1-0.2-0.1-0.8-0.1-1.9V61.4h-4.9V83c0 1.9 0.2 3.2 0.4 4 0.4 1.4 1.6 2 3.2 2 1.8 0 3.6-1.1 5.6-3.4v3H47.4zM56.2 28.6c0 2.9-0.5 5.1-1.5 6.5 -1.4 1.9-3.3 2.8-5.9 2.8 -2.5 0-4.4-0.9-5.8-2.8 -1-1.4-1.5-3.6-1.5-6.5v-9.7c0-2.9 0.5-5.1 1.5-6.5 1.4-1.9 3.3-2.8 5.8-2.8 2.5 0 4.5 0.9 5.9 2.8 1 1.4 1.5 3.5 1.5 6.5V28.6zM51.2 17.9c0-2.5-0.7-3.8-2.4-3.8 -1.6 0-2.4 1.3-2.4 3.8v11.6c0 2.5 0.8 3.9 2.4 3.9 1.7 0 2.4-1.3 2.4-3.9V17.9zM66.1 69.7c0-2.5-0.1-4.4-0.5-5.5 -0.6-2-2-3.1-3.9-3.1 -1.8 0-3.5 1-5.1 3v-12h-4.9v36.6h4.9v-2.7c1.7 2 3.4 3 5.1 3 1.9 0 3.3-1 3.9-3 0.4-1.2 0.5-3 0.5-5.5V69.7zM61.2 80.9c0 2.5-0.7 3.7-2.2 3.7 -0.8 0-1.7-0.4-2.5-1.2V66.8c0.8-0.8 1.7-1.2 2.5-1.2 1.4 0 2.2 1.3 2.2 3.7V80.9zM74.8 37.6h-5v-3c-2 2.3-3.9 3.4-5.7 3.4 -1.6 0-2.8-0.7-3.3-2 -0.3-0.8-0.4-2.2-0.4-4.1V10h5v20.3c0 1.2 0 1.8 0.1 1.9 0.1 0.8 0.5 1.2 1.2 1.2 1 0 2-0.8 3.1-2.4V10h5V37.6zM84.8 79.3h-5c0 2-0.1 3.1-0.1 3.4 -0.3 1.3-1 2-2.2 2 -1.7 0-2.5-1.3-2.5-3.8V76h9.9v-5.7c0-2.9-0.5-5-1.5-6.4 -1.4-1.9-3.4-2.8-5.9-2.8 -2.5 0-4.5 0.9-5.9 2.8 -1 1.4-1.5 3.5-1.5 6.4v9.6c0 2.9 0.6 5.1 1.6 6.4 1.4 1.9 3.4 2.8 6 2.8 2.6 0 4.6-1 6-2.9 0.6-0.9 1-1.9 1.2-3 0.1-0.5 0.1-1.6 0.1-3.2V79.3zM79.9 71.9h-5v-2.5c0-2.5 0.8-3.8 2.5-3.8 1.7 0 2.5 1.3 2.5 3.8V71.9z"/></svg>'; break;

	} // switch
	
	return $output;

} // decaturblue_get_svg()

/**
 * Prints whatever in a nice, readable format
 * 
 * @param 	mixed 		$input 		Something to pretty print, usually an array or object
 * 
 * @return 	mixed 					The input between pre tags and in print_r()
 */
function pretty( $input ) {

	echo '<pre>'; print_r( $input ); echo '</pre>';

} // pretty()



function gallery_override( $output = '', $atts ) {

	$return = '<div class="gallery_list"><ul>';
	$ids 	= explode( ',', $atts['ids'] );

	foreach ( $ids as $id ) {

		$pic 	= wp_prepare_attachment_for_js( $id );
		$return .= '<li class="image_for_viewbox" data-image="' . $pic['url'] . '"';
		$items 	= array( 'caption', 'title' );

		foreach ( $items as $item ) {

			$return .= 'data-' . $item . '="' . $pic[$item] . '" ';

		} // foreach

		$return .= '>' . $pic['title'] . '</li>';

	} // foreach

	$first = wp_prepare_attachment_for_js( $ids[0] );

	$return .= '</ul></div>';
	$return .= '<div class="view_wrap"><img class="viewbox" src="' . $first['url'] . '" /><h3 class="view_title">' . $first['title'] . '</h3><div class="view_caption">' . $first['caption'] . '</div></div><!-- .view_wrap -->';

	return $return;

} // gallery_override()

add_filter( 'post_gallery', 'gallery_override', 10, 2 );



/**
 * Returns the URL of the featured image
 * 
 * @param 	int 		$postID 		The post ID
 * @param 	string 		$size 			The image size to return
 * 
 * @return 	string | bool 				The URL of the featured image, otherwise FALSE
 */
function get_thumbnail_url( $postID, $size = 'thumbnail' ) {

	if ( empty( $postID ) ) { return FALSE; }

	$thumb_id = get_post_thumbnail_id( $postID );

	if ( empty( $thumb_id ) ) { return FALSE; }

	$thumb_array = wp_get_attachment_image_src( $thumb_id, $size, true );

	if ( empty( $thumb_array ) ) { return FALSE; }
	
	return $thumb_array[0];

} // get_thumbnail_url()



require( 'toolkit/make_cpt.php' );

class DecaturBlue_Staff extends Slushman_Make_Custom_Post_Type {

	function __construct() {

		$reqs['i18n'] 		= 'slushman';
		$reqs['plural'] 	= 'Staff';
		$reqs['post_type'] 	= 'Staff';
		$reqs['single'] 	= 'Staff';

		$args['menu_icon'] 	= 'dashicons-groups';

		$this->setup( $reqs, $args );

	} // __construct()

}

$cpt = new DecaturBlue_Staff();



/**
 * Performs a WordPress Query for posts contained Simple Fields data
 *
 * @uses 	WP_Query()
 *
 * @return  object 				A query object containing the results of the query
 */
function decaturblue_get_staff() {

	$args['order']			= 'ASC';
	$args['orderby']		= 'meta_value';
	$args['posts_per_page'] = -1;
	$args['post_type'] 		= 'Staff';
	
	$query = new WP_Query( $args );

	return $query;

} // End of decaturblue_get_staff()

/**
 * [get_staff_list description]
 * @return [type] [description]
 */
function decaturblue_staff_list() {

	$stafflist 	= decaturblue_get_staff();
	$output 	= '';

	if ( 1 > $stafflist->found_posts ) { return; }

	//pretty( $stafflist );

	$output .= '<ul class="stafflist">';

	foreach ( $stafflist->posts as $employee ) {

		$picurl = get_thumbnail_url( $employee->ID );
		$custom = get_post_meta( $employee->ID );

		$output .= '<li class="staffmember">';
		$output .= '<a href="' . get_permalink( $employee->ID ) . '">';

		if ( ! empty( $picurl ) ) {

			$output .= '<div class="staffpic" style="background-image:url(' . $picurl . ');"></div>';

		} else {

			$output .= '<div class="emptypic"></div>';

		}

		$output .= '<div class="staffname">' . $employee->post_title . '</div>';
		$output .= '</a></li>';


/*		$output .= '<div class="stafftitle">' . $custom['position'][0] . '</div>';
		$output .= '<div class="staffbio">' . wpautop( $employee->post_content ) . '</div>';
		$output .= '<div class="staffphone"><a href="tel:' . $custom['phone_number'][0] . '">' . $custom['phone_number'][0] . '</a></div>';
		$output .= '<div class="staffemail"><a href="mailto:' . $custom['email_address'][0] . '">' . $custom['email_address'][0] . '</a></div>';*/

	} // foreach

	$output .= '</ul><!-- .stafflist -->';

	return $output;

} // get_staff_list()





