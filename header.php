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
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-MFGHVR"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MFGHVR');</script>
<!-- End Google Tag Manager -->
<div id="page" class="hfeed site<?php echo ' bgimage';

/*	if ( is_front_page() || is_home() ) {

		echo ' easyhtml5video';

	} else {

		echo ' bgimage';

	}*/

?>">
	<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'decatur-blueprint' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="header-wrap">
			<div class="site-branding">
				<div class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo decaturblue_get_svg( 'logo' ); ?></a></div>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div><!-- .site-branding -->
			<nav id="site-navigation" class="main-navigation<?php if ( is_home() || is_front_page() ) { echo ' toggled'; } ?>" role="navigation">
				<button class="menu-toggle"><span><?php _e( 'Menu', 'decatur-blueprint' ); ?></span><span><?php echo decaturblue_get_svg( 'hamburger' ); ?></span></button><?php

				wp_nav_menu( array( 'theme_location' => 'primary' ) );

			?></nav><!-- #site-navigation --><?php

			get_template_part( 'menu', 'social' );

		?></div><!-- .header_wrap -->
	</header><!-- #masthead --><?php

/*if ( is_front_page() || is_home() ) {

	?><video id="bgvideo" class="bgvideo" autoplay="autoplay" loop="loop" muted="muted" poster="<?php echo get_template_directory_uri(); ?>/images/decblue.jpg" title="Decatur Blue" onended="var v=this;setTimeout(function(){v.play()},300)">
		<source src="<?php echo get_template_directory_uri(); ?>/videos/decblue.webm" type="video/webm" />
		<source src="<?php echo get_template_directory_uri(); ?>/videos/decblue.m4v" type="video/mp4" />
		<source src="<?php echo get_template_directory_uri(); ?>/videos/decblue.ogv" type="video/ogg" />
		<object type="application/x-shockwave-flash" data="<?php echo get_template_directory_uri(); ?>/videos/flashfox.swf" width="1920" height="1080" style="position:relative;">
			<param name="movie" value="<?php echo get_template_directory_uri(); ?>/videos/flashfox.swf" />
			<param name="allowFullScreen" value="true" />
			<param name="flashVars" value="autoplay=true&amp;controls=true&amp;fullScreenEnabled=true&amp;posterOnEnd=true&amp;loop=true&amp;poster=<?php echo get_template_directory_uri(); ?>/images/decblue.jpg&amp;src=/videos/decblue.m4v" />
		 	<embed src="<?php echo get_template_directory_uri(); ?>/videos/flashfox.swf" width="1920" height="1080" style="position:relative;"  flashVars="autoplay=true&amp;controls=true&amp;fullScreenEnabled=true&amp;posterOnEnd=true&amp;loop=true&amp;poster=<?php echo get_template_directory_uri(); ?>/images/decblue.jpg&amp;src=decblue.m4v"	allowFullScreen="true" wmode="transparent" type="application/x-shockwave-flash" pluginspage="http://www.adobe.com/go/getflashplayer_en" />
		</object>
	</video>
	<button id="playpause">&#10073; &#10073;</button><?php

}*/

	?><div id="content" class="site-content">


