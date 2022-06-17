<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package GenerPress
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function generpress_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( 'none_sidebar' == get_theme_mod('generpress_general_layout', 'right_sidebar') || ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'none-sidebar';
	} elseif ( 'left_sidebar' == get_theme_mod('generpress_general_layout') ) {
		$classes[] = 'left-sidebar';
	} else {
		$classes[] = 'right-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'generpress_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function generpress_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'generpress_pingback_header' );