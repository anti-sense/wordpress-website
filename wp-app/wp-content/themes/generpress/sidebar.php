<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GenerPress
 */

if ( ! is_active_sidebar( 'sidebar-1' ) || get_theme_mod('generpress_general_layout') == 'none_sidebar' ) {
	return;
}
?>

<aside id="secondary" class="featured-sidebar widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside><!-- #secondary -->
