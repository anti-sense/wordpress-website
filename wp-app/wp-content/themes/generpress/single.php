<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package GenerPress
 */

get_header(); ?>

	<div id="primary" class="full-featured-content-small content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single' );
		
			if ( get_theme_mod('generpress_post_navigation_options', 'navigation_enable') == 'navigation_enable' ) :
				the_post_navigation();
			endif;

			if ( get_theme_mod('generpress_related_post_options', 'related_post_enable') == 'related_post_enable' ) :
				generpress_related_posts();
			endif;

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
