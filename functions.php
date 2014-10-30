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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'decatur-blueprint' ),
		'social' => __( 'Social Links', 'decatur-blueprint' ),
		'studioblue' => __( 'Studio Blue Menu', 'decatur-blueprint' ),
		'plansandportals' => __( 'Plans and Portals Menu', 'decatur-blueprint' ),
		'dowork' => __( 'Do Work Menu', 'decatur-blueprint' )
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

	wp_enqueue_script( 'decatur-blueprint-smooth-state', get_template_directory_uri() . '/js/smoothState.min.js', array( 'jquery' ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_home() || is_front_page() ) {

		wp_enqueue_script( 'decatur-blueprint-bg-video', get_template_directory_uri() . '/js/html5ext.min.js' );

	}
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
 * Add Extra Code to Primary Menu
 *
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
function decaturblue_menu_icons( $item_output, $item, $depth, $args ) {

	if ( 'primary' !== $args->theme_location ) { return $item_output; }

	//echo '<pre>'; print_r( $item ); echo '</pre>';

	$output = '<a href="' . $item->url . '"><span class="menu-label">' . $item->title . '</span>';
	$output .= get_page_icon( $item->object_id );
	$output .= '</a>';

	return $output;

} // decaturblue_menu_icons()

add_filter( 'walker_nav_menu_start_el', 'decaturblue_menu_icons', 10, 4 );


function get_page_icon( $ID ) {

	$output = '';
	$page 	= get_post( $ID );

	switch( $page->post_title ) {

		case 'The Diggs'		: $output .= '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 144 144" enable-background="new 0 0 144 144" xml:space="preserve"><path fill="#ffffff" d="M45.034,81h-0.02v0.005C45.021,81.005,45.03,81,45.034,81 M102.516,72H94.5v31.5H78.64V86.91H65.36v16.59H49.5V72h-8.015 L72,41.414L102.516,72z M108.035,72c0-2.193-1.596-3.933-3.674-4.333L73.05,36.419c-0.722-0.72-1.446-0.72-2.168,0l-31.35,31.283 c-1.772,0.419-3.091,1.827-3.365,3.651c-0.081,0.215-0.208,0.42-0.217,0.646h0.086c0,2.483,2.016,4.5,4.5,4.5h4.5V81v22.5 c0,2.483,2.016,4.5,4.5,4.5h9h0.002h35.997c2.484,0,4.5-2.017,4.5-4.5v-27h4.5C106.02,76.5,108.035,74.483,108.035,72 M139.5,72.002 c0,37.277-30.221,67.498-67.5,67.498c-37.278,0-67.5-30.221-67.5-67.498C4.5,34.723,34.722,4.5,72,4.5 C109.279,4.5,139.5,34.723,139.5,72.002 M144,72c0-39.764-32.236-72-72-72S0,32.236,0,72s32.236,72,72,72S144,111.764,144,72"/></svg>'; break;
		case 'Studio Blue' 		: $output .= '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 144 144" enable-background="new 0 0 144 144" xml:space="preserve"><path fill="#ffffff" d="M46.793,45.596c0-2.597,0.689-4.599,2.068-6.006c1.196-1.224,2.721-1.837,4.57-1.837c2.479,0,4.288,0.822,5.434,2.464 c0.63,0.92,0.97,1.846,1.017,2.774h-3.108c-0.198-0.713-0.451-1.252-0.763-1.615c-0.552-0.646-1.373-0.968-2.46-0.968 c-1.107,0-1.982,0.455-2.62,1.367c-0.64,0.912-0.96,2.201-0.96,3.869c0,1.67,0.338,2.92,1.014,3.75s1.53,1.246,2.57,1.246 c1.066,0,1.88-0.356,2.438-1.069c0.31-0.384,0.566-0.959,0.77-1.726h3.089c-0.266,1.621-0.947,2.939-2.043,3.955 c-1.095,1.017-2.497,1.525-4.209,1.525c-2.116,0-3.779-0.686-4.991-2.059C47.397,49.889,46.793,47.997,46.793,45.596 M41.577,56.11 h23.521v-21.14H41.577V56.11z M40.1,33.48h26.475v32.474H40.1V33.48z M37.468,68.587h31.738V30.85H37.468V68.587z M46.722,82.665 h3.664l3.089,6.479l2.957-6.479h3.521l-4.976,9.297v5.578h-3.108v-5.578L46.722,82.665z M41.577,100.676h23.521V79.534H41.577 V100.676z M40.1,78.044h26.475v32.476H40.1V78.044z M37.468,113.152h31.738v-37.74H37.468V113.152z M85.135,37.967h4.524 l2.708,11.696l2.687-11.696h4.474v14.875H96.63V42.78c0-0.289,0.004-0.694,0.01-1.216c0.008-0.521,0.011-0.924,0.011-1.205 l-2.819,12.482h-3.021l-2.799-12.483c0,0.282,0.004,0.684,0.01,1.204c0.006,0.521,0.011,0.928,0.011,1.217v10.062h-2.897V37.967z M80.57,56.11h23.521v-21.14H80.57V56.11z M79.094,33.48h26.475v32.474H79.094V33.48z M76.462,68.587H108.2V30.85H76.462V68.587z M85.763,82.665h3.058v6.129l5.748-6.129h4.018l-6.105,6.12l6.418,8.757h-3.996l-4.584-6.493l-1.498,1.518v4.976h-3.058V82.665z M80.57,100.676h23.521V79.534H80.57V100.676z M79.094,78.044h26.475v32.476H79.094V78.044z M76.462,113.152H108.2v-37.74H76.462 V113.152z M139.5,72c0,37.279-30.221,67.5-67.5,67.5c-37.278,0-67.5-30.221-67.5-67.5C4.5,34.723,34.722,4.5,72,4.5 C109.279,4.5,139.5,34.723,139.5,72 M144,72c0-39.764-32.236-72-72-72S0,32.236,0,72s32.236,72,72,72S144,111.764,144,72"/></svg>'; break;
		case 'Plans & Portals' 	: $output .= '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 144 144" enable-background="new 0 0 144 144" xml:space="preserve"><path fill="#ffffff" d="M77.903,59.5l4.378-3.545h-39.09l-12.147,50.1h79.608L99.331,59.361l-3.033,2.547l9.842,40.601H35.556L45.98,59.5H77.903z M71.687,67.25l-4.304,10.26L78.15,74.9L71.687,67.25z M49.922,66.261l-2.333,11.083h13.629l1.028-6.097l-2.995,1.757l-0.284,1.684 h-8.099l1.213-5.769h6.772l4.193-2.431l0.038-0.228H49.922z M57.109,85.594l-1.028,6.111h-8.589l1.287-6.111H57.109z M58.463,94.525 l1.983-11.754H46.49l-2.477,11.754H58.463z M63.719,66.945l-7.167,4.16l-1.87-1.797l-1.86,1.131l3.27,3.459l9.373-5.506 L63.719,66.945z M107.667,50.379l-6.869-8.131l-27.737,23.43l6.869,8.131l15.574-13.156l0.013-0.01l3.423-2.891L107.667,50.379z M112.035,46.689c1.096-0.924,1.232-2.562,0.308-3.656l-3.52-4.17c-0.925-1.092-2.562-1.229-3.657-0.308l-3.033,2.564l6.87,8.132 L112.035,46.689z M139.5,72.002c0,37.277-30.222,67.498-67.5,67.498c-37.279,0-67.5-30.221-67.5-67.498 C4.5,34.722,34.721,4.5,72,4.5C109.278,4.5,139.5,34.722,139.5,72.002 M144,72c0-39.764-32.236-72-72-72S0,32.236,0,72 s32.236,72,72,72S144,111.764,144,72"/></svg>'; break;
		case 'Our Story' 		: $output .= '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 144 144" enable-background="new 0 0 144 144" xml:space="preserve"><path fill="#ffffff" d="M72,54c0,8.699-7.051,15.75-15.75,15.75S40.5,62.699,40.5,54s7.051-15.75,15.75-15.75S72,45.301,72,54 M76.5,54 c0-11.186-9.065-20.25-20.25-20.25C45.064,33.75,36,42.814,36,54s9.064,20.25,20.25,20.25C67.435,74.25,76.5,65.186,76.5,54 M105.75,60.75c0,4.971-4.03,9-9,9c-4.971,0-9-4.029-9-9c0-4.97,4.029-9,9-9C101.72,51.75,105.75,55.78,105.75,60.75 M110.25,60.75 c0-7.454-6.047-13.5-13.5-13.5s-13.5,6.046-13.5,13.5s6.047,13.5,13.5,13.5S110.25,68.204,110.25,60.75 M110.677,99 c-6.465,9.257-16.137,16.098-27.427,18.868V92.25h0.826c1.858-5.232,6.803-9,12.674-9c6.688,0,12.197,4.871,13.271,11.25h0.229V99 H110.677z M78.75,118.764c-2.202,0.317-4.456,0.486-6.75,0.486c-15.363,0-28.988-7.352-37.615-18.708 C36.738,90.628,45.621,83.25,56.25,83.25c11.669,0,21.256,8.881,22.386,20.25h0.114V118.764z M114.328,101.15l0.422-8.9 c-2.008-7.738-9.628-13.5-18-13.5c-8.279,0-15.214,5.607-17.311,13.219C74.729,84.062,66.121,78.75,56.25,78.75 c-11.374,0-21.078,7.044-25.051,17.002c-1.24,4.577,0.052,8.047,0.958,8.68C41.747,116.068,54.72,123.759,72,123.75 C89.767,123.741,105.01,114.79,114.328,101.15 M139.5,72.002c0,37.277-30.221,67.498-67.5,67.498c-37.278,0-67.5-30.221-67.5-67.498 C4.5,34.723,34.722,4.5,72,4.5C109.279,4.5,139.5,34.723,139.5,72.002 M144,72c0-39.764-32.236-72-72-72S0,32.236,0,72 s32.236,72,72,72S144,111.764,144,72"/></svg>'; break;
		case 'Message Us' 		: $output .= '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 144 144" enable-background="new 0 0 144 144" xml:space="preserve"><path fill="#ffffff" d="M72,60.75c0,1.245-1.005,2.25-2.25,2.25c-1.241,0-2.25-1.005-2.25-2.25c0-1.242,1.009-2.25,2.25-2.25 C70.995,58.5,72,59.508,72,60.75 M76.5,60.75c0-3.729-3.021-6.75-6.75-6.75C66.024,54,63,57.021,63,60.75s3.024,6.75,6.75,6.75 C73.479,67.5,76.5,64.479,76.5,60.75 M87.75,63c-1.241,0-2.25-1.005-2.25-2.25c0-1.242,1.009-2.25,2.25-2.25 c1.244,0,2.25,1.008,2.25,2.25C90,61.995,88.994,63,87.75,63 M87.75,67.5c3.729,0,6.75-3.021,6.75-6.75S91.479,54,87.75,54 C84.023,54,81,57.021,81,60.75S84.023,67.5,87.75,67.5 M103.5,88.743l-11.512-8.945c-0.562-0.981-1.738-1.338-2.76-0.948 c0.004-0.033,0.006-0.068,0.012-0.102H63c-4.971,0-9-4.03-9-9v-18c0-4.971,4.029-9,9-9h31.5c4.97,0,9,4.029,9,9V88.743z M63,83.25 h13.482c-0.091,4.869-4.07,8.793-8.982,8.793H54.763c0.004,0.034,0.004,0.066,0.008,0.1c-1.02-0.39-2.194-0.033-2.759,0.946 L40.5,101.99V74.189c0-4.948,4.029-8.957,9-8.957v4.518C49.5,77.203,55.546,83.25,63,83.25 M107.974,92.311 c0-0.043,0.026-21.789,0.026-22.561v-18c0-7.454-6.047-13.5-13.5-13.5H63c-7.454,0-13.5,6.046-13.5,13.5v9 c-7.454,0-13.5,6.016-13.5,13.439v8.896c0,0.767,0.024,22.415,0.027,22.458c-0.121,0.875,0.211,1.564,1.028,2.035 c1.078,0.617,2.068,0.462,3.144-0.607l13.958-10.449H67.5c7.4,0,13.4-5.929,13.491-13.271h8.851l13.959,10.496 c1.079,1.079,2.068,1.232,3.145,0.613C107.763,93.885,108.094,93.189,107.974,92.311 M139.5,72c0,37.279-30.221,67.5-67.5,67.5 c-37.278,0-67.5-30.221-67.5-67.5C4.5,34.723,34.722,4.5,72,4.5C109.279,4.5,139.5,34.723,139.5,72 M144,72 c0-39.764-32.236-72-72-72S0,32.236,0,72s32.236,72,72,72S144,111.764,144,72"/></svg>'; break;
		case 'Do Work' 			: $output .= '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0" y="0" viewBox="0 0 144 144" enable-background="new 0 0 144 144" xml:space="preserve"><path fill="#ffffff" d="M37.797,92.961c-3.584,3.576-3.584,9.381,0,12.967c3.584,3.582,9.398,3.582,12.975,0l17.854-17.852l2.355-2.352 c0.041-0.049,0.078-0.109,0.125-0.16l-2.965-2.971l-21.205,21.201c-0.504,0.514-1.33,0.514-1.842,0c-0.52-0.516-0.52-1.346,0-1.857 L66.281,80.75l-3.309-3.311l-21.18,21.191c-0.52,0.516-1.35,0.516-1.859,0c-0.51-0.504-0.51-1.34,0-1.852l21.188-21.188 l-2.963-2.977c-0.049,0.055-0.1,0.086-0.15,0.139L37.797,92.961z M106.688,41.807c1.461-2.209,2.258-4.387,1.789-4.859l-0.852-0.85 c0,0-0.375-0.385-0.844-0.85c-0.467-0.471-2.648,0.326-4.859,1.785l-5.689,3.744c-2.209,1.461-4.24,3.764-4.537,5.156l-0.531,2.508 L76.176,63.34l4.102,4.104l15.004-14.895c0,0,1.125-0.232,2.508-0.521c1.391-0.297,3.695-2.33,5.156-4.539L106.688,41.807z M103.359,99.67c0,2.035-1.654,3.688-3.689,3.688c-2.039,0-3.689-1.652-3.689-3.688c0-2.041,1.65-3.695,3.689-3.695 C101.705,95.975,103.359,97.629,103.359,99.67 M106.518,106.514c3.254-3.252,3.146-8.631-0.238-12.01 c-0.41-0.41-24.547-22.039-35.562-33.051c-2.045-2.049-1.236-3.549-0.816-4.295c2.953-5.213,3.148-10.562-1.842-15.555 c-5.271-5.271-13.887-7.701-21.029-5.908l12.676,12.672c0,0,0,3.779-3.777,7.561c-3.779,3.779-7.559,3.779-7.559,3.779 L35.695,47.029c-1.793,7.143,0.637,15.754,5.908,21.031c4.873,4.871,10.092,4.801,15.191,2.041c0.863-0.465,2.76-1.221,4.918,0.939 c11.211,11.209,32.383,34.832,32.791,35.238C97.887,109.664,103.266,109.77,106.518,106.514 M139.5,72 c0,37.277-30.223,67.5-67.5,67.5S4.5,109.277,4.5,72C4.5,34.721,34.723,4.5,72,4.5S139.5,34.721,139.5,72 M144,72 c0-39.766-32.236-72-72-72S0,32.234,0,72c0,39.764,32.236,72,72,72S144,111.764,144,72"/></svg>'; break;

	} // switch
	
	return $output;

} // get_page_icon()

function pretty( $input ) {

	echo '<pre>'; print_r( $input ); echo '</pre>';

} // pretty()



