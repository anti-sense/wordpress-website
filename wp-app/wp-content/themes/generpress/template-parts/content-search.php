<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package GenerPress
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('post-list posts-entry fbox'); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		
		<div class="featured-thumbnail">
			<a href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail('generpress-large'); ?></a>
		</div>

	<?php else : ?>

		<div class="featured-thumbnail">
			<a href="<?php the_permalink() ?>" rel="bookmark"><img class="wp-post-image" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/default-large.jpg" alt="<?php echo the_title_attribute(); ?>" /></a>
		</div>

	<?php endif; ?>

	<div class="entry-content">
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php generpress_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

		<p class="more-link-wrap">
			<a href="<?php the_permalink() ?>"><?php echo esc_html__( 'Continue Reading &rarr;', 'generpress' ); ?></a>
		</p>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
