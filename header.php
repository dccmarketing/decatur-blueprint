<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Decatur Blueprint
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"><?php

wp_head();

?></head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'decatur-blueprint' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="header-wrap">
			<div class="site-branding">
				<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 144 144" enable-background="new 0 0 144 144" xml:space="preserve"><path fill="#047abb" d="M60.082 36.65c0.76-0.833 1.14-1.647 1.136-2.438 -0.003-0.797-0.196-1.63-0.583-2.505 -0.297-0.676-0.763-1.276-1.396-1.803 -0.632-0.527-1.447-0.766-2.444-0.721 -0.892 0.046-1.908 0.303-3.054 0.776 -1.146 0.471-2.745 1.16-4.797 2.061l-0.98 0.431 3.796 8.616 1.633-0.718c1.651-0.727 3.044-1.374 4.183-1.94C58.713 37.844 59.548 37.257 60.082 36.65M69.459 52.958c0.867-0.93 1.337-1.865 1.402-2.807 0.068-0.938-0.117-1.904-0.555-2.897 -0.574-1.305-1.264-2.203-2.065-2.693 -0.804-0.489-1.873-0.651-3.208-0.48 -0.91 0.116-2.076 0.475-3.496 1.081 -1.421 0.604-2.901 1.244-4.438 1.921l-2.255 0.991 4.503 10.225 0.75-0.331c2.898-1.274 4.968-2.197 6.214-2.766C67.555 54.632 68.604 53.882 69.459 52.958M123.885 38.696L94.627 51.58 76.744 10.965 87.25 6.336l14.425 32.76 18.747-8.257L123.885 38.696zM76.057 37.051c2.27 0.98 4.001 2.827 5.197 5.54 0.867 1.969 1.245 3.9 1.141 5.797 -0.109 1.896-0.626 3.658-1.555 5.283 -1.066 1.904-2.443 3.536-4.135 4.887 -1.686 1.353-3.998 2.674-6.936 3.971l-17.68 7.782L34.203 29.693l15.742-6.93c3.268-1.439 5.707-2.382 7.32-2.832 1.612-0.449 3.326-0.631 5.144-0.542 1.887 0.1 3.495 0.642 4.828 1.626 1.333 0.982 2.372 2.319 3.113 4.006 0.864 1.959 1.11 3.915 0.739 5.864 -0.371 1.953-1.312 3.757-2.824 5.42l0.096 0.217C71.223 35.896 73.788 36.071 76.057 37.051M56.317 81.449l10.507-4.627 11.188 25.404c1.244 2.826 2.761 4.674 4.551 5.538 1.787 0.865 4.009 0.716 6.658-0.452 2.614-1.15 4.23-2.656 4.85-4.518 0.623-1.861 0.287-4.263-1.005-7.197L81.878 70.193l10.51-4.629 11.413 25.92c2.211 5.02 2.379 9.541 0.506 13.553 -1.871 4.021-5.772 7.333-11.708 9.946 -5.936 2.612-11.013 3.255-15.228 1.919 -4.219-1.335-7.428-4.506-9.631-9.508L56.317 81.449zM143.258 82.275C143.737 78.918 144 75.49 144 71.999c0-39.764-32.236-72-71.998-72C32.235-0.001 0 32.235 0 71.999c0 39.768 32.235 72.002 72.002 72.002 32.579 0 60.092-21.646 68.975-51.34l-20.86 9.186 -17.887-40.615 29.353-12.925 3.459 7.859 -18.844 8.297 3.086 7.006 17.518-7.712 3.458 7.855 -17.514 7.714 4.417 10.038L143.258 82.275z"/></svg></a></div>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div><!-- .site-branding -->
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle"><?php _e( 'Menu', 'decatur-blueprint' ); ?><span class="hamburger">&#xf0c9;</span></button><?php

				wp_nav_menu( array( 'theme_location' => 'primary' ) );
			
			?></nav><!-- #site-navigation --><?php

			get_template_part( 'menu', 'social' );

		?></div><!-- .header_wrap -->
	</header><!-- #masthead --><?php

	get_template_part( 'menu', 'studioblue' );
	get_template_part( 'menu', 'plansandportals' );

	?><div id="content" class="site-content">