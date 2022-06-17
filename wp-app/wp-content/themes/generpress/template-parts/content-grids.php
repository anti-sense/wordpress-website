<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package GenerPress
 */

if( 'none_sidebar' != get_theme_mod('generpress_general_layout', 'right_sidebar') && is_active_sidebar( 'sidebar-1' ) ) :
	$grids = 'xg-grid-two ';
else :
	$grids = 'xg-grid-three ';
endif;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $grids . 'posts-entry'); ?>>
	<div class="post-container">
		<?php if ( has_post_thumbnail() ) : ?>
			
			<div class="post-content-thumbnail">
				<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('generpress-large'); ?></a>
				<a href="<?php the_permalink() ?>" rel="bookmark" class="fancy-overlay-bg"><i class="fas fa-compress-arrows-alt"></i></a>
			</div>

		<?php else : ?>

			<div class="post-content-thumbnail">
				<a href="<?php the_permalink() ?>" rel="bookmark"><img class="wp-post-image" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/default-large.jpg" alt="<?php echo the_title_attribute(); ?>" /></a>
			</div>

		<?php endif; ?>

		<div class="post-content-container">

			<div class="entry-content">

				<header class="entry-header">
					<?php
					if ( is_single() ) :
						the_title( '<h1 class="entry-title">', '</h1>' );

						generpress_posted_on();
						
					else :
						
						generpress_posted_on();

						the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					endif;
					?>
				</header><!-- .entry-header -->

				<p class="more-link-wrap">
					<a href="<?php the_permalink() ?>"><?php echo esc_html__( 'Continue Reading &rarr;', 'generpress' ); ?></a>
				</p>
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php generpress_entry_footer(); ?>
			</footer><!-- .entry-footer -->

		</div><!-- .post-content-container -->

	</div><!-- .post-container -->
</article><!-- #post-<?php the_ID(); ?> -->
