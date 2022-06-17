<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GenerPress
 */

?>
		</div>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer clearfix">
		
		<div class="content-wrap">
			
			<div class="site-info">

				<?php $blog_info = get_bloginfo( 'name' ); ?>
				<?php if ( ! empty( $blog_info ) ) : ?>
					<a class="site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				<?php endif; ?>

				<?php
					echo 'Copyright &copy; ' . date( 'Y' ) . ' &bull; <span class="copyright-block"></span>'. esc_html(__('Theme by', 'generpress' ) ).' <a href="' . esc_url( __( 'http://opensumo.com/generpress/', 'generpress' ) ) . '">OpenSumo</a>'; 
				
				?>
			</div><!-- .site-info -->

			<?php if ( has_nav_menu( 'menu-4' ) ) : ?>
				<nav id="footer-site-navigation" class="fmenu">

					<?php
						wp_nav_menu( array(
							'theme_location'	=> 'menu-4',
							'menu_id'			=> 'footer-menu',
							'menu_class'		=> 'footer-menu'
						) );
					?>

				</nav><!-- #footer-site-navigation -->
			<?php endif; ?>

		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<div id="smobile-menu" class="mobile-only"></div>
<div id="mobile-menu-overlay"></div>

<?php wp_footer(); ?>
</body>
</html>
