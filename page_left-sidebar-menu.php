<?php
/**
 * Template Name: Left Sidebar Menu
 *  
 * Description: Page template with a sidebar menu on the left side
 *
 * @package Decatur Blueprint
 */

get_header(); ?>

	<div id="primary" class="content-area left-sidebar">
		<main id="main" class="site-main" role="main"><?php

			get_template_part( 'content', 'sidebarmenu' );

		?></main><!-- #main -->
	</div><!-- #primary --><?php

get_footer(); ?>