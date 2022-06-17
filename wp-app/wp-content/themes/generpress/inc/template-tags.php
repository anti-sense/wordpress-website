<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package GenerPress
 */


if ( ! function_exists( 'generpress_the_posts_navigation' ) ) :
/**
 |------------------------------------------------------------------------------
 | Display navigation to next/previous set of posts when applicable.
 |------------------------------------------------------------------------------
 |
 */
function generpress_the_posts_navigation() {
	
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	$nav_style = get_theme_mod ('generpress_general_pagination_mode', 'default');

	if ( $nav_style == 'numberal' ) :
		
		// Previous/next page navigation.
		the_posts_pagination( array(
			'prev_text'				=> esc_html__( 'Previous page', 'generpress' ),
			'next_text'				=> esc_html__( 'Next page', 'generpress' ),
			'before_page_number'	=> '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'generpress' ) . ' </span>',
		) );
		
	else :
	?>

	<nav class="navigation paging-navigation clearfix" role="navigation">
		<span class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'generpress' ); ?></span>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><span class="meta-nav">&larr;</span> <?php next_posts_link( esc_html__( 'Older posts', 'generpress' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next"><?php previous_posts_link( esc_html__( 'Newer posts', 'generpress' ) ); ?> <span class="meta-nav">&rarr;</span></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->

	<?php
	endif;
}
endif;


/**
|------------------------------------------------------------------------------
| Related Posts
|------------------------------------------------------------------------------
|
| You can show related posts by Categories or Tags. 
| It has two options to show related posts
|
| 1. Thumbnail related posts (default)
| 2. List of related posts
| 
| @return void
|
*/

if ( ! function_exists('generpress_related_posts') ) :

	function generpress_related_posts() {
		
		global $post;

		$taxonomy = get_theme_mod('generpress_related_post_taxonomy', 'category');
		$numberRelated = get_theme_mod('generpress_number_related_posts', '6');

		$args =  array();

		if ( $taxonomy == 'tag' ) {

			$tags = wp_get_post_tags( $post->ID );
			$arr_tags = array();

			foreach( $tags as $tag ) {

				array_push($arr_tags, $tag->term_id);

			}
			
			if (!empty($arr_tags)) { 
				$args = array(
					'tag__in'			=> $arr_tags,  
					'post__not_in'		=> array($post->ID),  
					'posts_per_page'	=> $numberRelated,
				); 
			}

		} else {

			$args = array( 
				'category__in'		=> wp_get_post_categories($post->ID), 
				'posts_per_page'	=> $numberRelated, 
				'post__not_in'		=> array($post->ID) 
			);

		}

		if ( ! empty( $args ) ) {
			
			$posts = get_posts( $args );

			if ( $posts ) {
			?>

			<div class="fbox posts-related clearfix">
				
				<div class="swidget">
					<h3 class="related-title"><?php esc_html_e('Related Post', 'generpress') ?></h3>
				</div>
				
				<?php
					$related_style = 'grid';
					if ( $related_style == 'grid' ) :
				?>
					
					<ul class="related-grid">
						
						<?php
						foreach ( $posts as $p ) {
						?>
							
							<li>
										
								<?php if ( has_post_thumbnail( $p->ID ) ) : ?>

									<a href="<?php echo esc_url( get_the_permalink( $p->ID ) ) ?>">
										<?php echo get_the_post_thumbnail( $p->ID, 'generpress-small' ) ?>
									</a>

								<?php else : ?>

									<a href="<?php echo esc_url( get_the_permalink( $p->ID ) ) ?>">
										<img class="wp-post-image" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/default-small.jpg" alt="<?php the_title_attribute() ?>" />
									</a>

								<?php endif; ?>
								
								<a class="related-ptitle" href="<?php echo esc_url( get_the_permalink( $p->ID ) ) ?>"><?php echo esc_html( get_the_title( $p->ID ) ); ?></a>

							</li>

						<?php
							}
						?>

					</ul>

					<?php
						else :
					?>

					<ul class="related-list">
						
						<?php
						foreach ( $posts as $p ) {
							?>
							
							<li>												
								
								<a href="<?php echo esc_url( get_the_permalink($p->ID) ) ?>"><?php echo esc_html( get_the_title( $p->ID ) ); ?></a>								
								
							</li>

						<?php
							}
						?>
					</ul>

					<?php endif; ?>

				</div>
			
				<?php
			}
		}
	}
endif;


if ( ! function_exists( 'generpress_excerpt_length' ) ) {

	/**
	|------------------------------------------------------------------------------
	| Excerpt length | @return integer
	|------------------------------------------------------------------------------
	*/

	function generpress_excerpt_length($length) {

		if ( is_admin() ) {
			return $length;
		}

		$number = intval ( get_theme_mod('generpress_general_excerpt_lengh', 8) ) > 0 ? intval ( get_theme_mod('generpress_general_excerpt_lengh', 8) ) : $length;
		return $number;
	}
	
}

add_filter( 'excerpt_length', 'generpress_excerpt_length', 999 );


if ( ! function_exists( 'generpress_excerpt_more' ) ) {
	/**
	|------------------------------------------------------------------------------
	| Excerpt ending | @return string
	|------------------------------------------------------------------------------
	*/
	function generpress_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}
		return get_theme_mod( 'generpress_general_excerpt_end_text', ' ...' );
	}
	
}

add_filter( 'excerpt_more', 'generpress_excerpt_more' );


if ( ! function_exists( 'generpress_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function generpress_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'generpress' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'generpress' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span><span class="posted-on">' . $posted_on . '</span><!-- .entry-meta -->'; // WPCS: XSS OK.

	}
endif;


if ( ! function_exists( 'generpress_avatar_thumb' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function generpress_avatar_thumb() {

		$user = wp_get_current_user();
		 
		if ( $user ) :
			?>
			<div class="avatar-thumb">
				<img src="<?php echo esc_url( get_avatar_url( $user->ID ) ); ?>" />
			</div>
			<?php
		endif;

	}
endif;


if ( ! function_exists( 'generpress_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function generpress_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'generpress' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'generpress' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'generpress' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'generpress' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'generpress' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'generpress' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;