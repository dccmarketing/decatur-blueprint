<?php
/**
 * Decatur Blueprint Theme Customizer
 *
 * @package Decatur Blueprint
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @uses 	get_setting()
 */
function decaturblueprint_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

} // decaturblueprint_customize_register()
add_action( 'customize_register', 'decaturblueprint_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @uses 	wp_enqueue_script()
 * @uses 	get_template_directory_uri()
 */
function decaturblueprint_customize_preview_js() {

	wp_enqueue_script( 'decaturblueprint_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );

} // decaturblueprint_customize_preview_js()
add_action( 'customize_preview_init', 'decaturblueprint_customize_preview_js' );
