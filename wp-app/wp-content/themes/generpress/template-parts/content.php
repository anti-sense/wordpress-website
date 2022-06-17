<?php
/**
 * Template part for displaying posts
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

			<?php
			if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php generpress_avatar_thumb(); ?>

				<div class="entry-meta-middle">
					<?php generpress_posted_on(); ?>
				</div>
			</div><!-- .entry-meta -->
			<?php
			endif; 

			if ( is_singular() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif;
			?>
		</header><!-- .entry-header -->

		<?php
			the_excerpt( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'generpress' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'generpress' ),
				'after'  => '</div>',
			) );
		?>

		<div class="more-link-wrap">
			<a href="<?php the_permalink() ?>"><?php echo esc_html__( 'Continue Reading &rarr;', 'generpress' ); ?></a>
		</div>
	</div><!-- .entry-content -->
	
</article><!-- #post-<?php the_ID(); ?> -->
