<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package GenerPress
 */
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'generpress' ); ?></a>

	<header id="masthead" class="banner-shadow sheader site-header clearfix">
		
		<?php if ( get_theme_mod('generpress_general_notify_smg') != '' ) : ?>
			<div class="xgnotification-top" style="background-color:<?php echo esc_attr( get_theme_mod('generpress_general_notify_bg', '#ffffff') ) ?>; color: <?php echo esc_attr( get_theme_mod('generpress_general_notify_text', '#11171a') ) ?>;">
				<?php echo wp_kses_post(get_theme_mod('generpress_general_notify_smg')); ?>
			</div>
		<?php endif; ?>

		<?php if ( get_header_image() ) : ?>
			<div id="site-header" class="clearfix" >
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src="<?php esc_url( header_image() ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
				</a>
			</div>
		<?php endif; ?>

		<?php if ( get_theme_mod('generpress_general_header_banner') != '' ) : ?>
			<?php if ( ! ( is_single() && get_theme_mod('generpress_general_header_banner_options_single', 'single_banner_enable') == 'single_banner_disable' ) ) : ?>
				<div class="campaign-banner" style="background-image: url(<?php echo esc_attr( get_theme_mod( 'generpress_general_header_banner', '' ) ) ?>);" ?>
					<?php if ( get_theme_mod('generpress_general_notify_smg') != '' ) : ?>
						<div class="xgbanner-container">
							<header class="banner-title" style="color:<?php echo esc_attr( get_theme_mod('generpress_general_header_banner_text_color', '#ffffff') ) ?>;" >
								<?php echo wp_kses_post( get_theme_mod('generpress_general_header_banner_text') ); ?>
							</header>
						</div>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		
		<div id="header-top-nav">
			<div class="content-wrap clearfix">

				<?php if ( has_nav_menu( 'menu-3' ) ) : ?>
					<nav id="social-site-navigation" class="social-menu main-navigation">
						
						<?php
							wp_nav_menu( array(
								'theme_location'	=> 'menu-3',
								'menu_id'			=> 'social-menu',
								'menu_class'		=> 'scmenu'
							) );
						?>

					</nav><!-- #primary-site-navigation -->
				<?php endif; ?>

				<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
					<nav id="primary-site-navigation" class="primary-menu main-navigation">
						
						<?php
							wp_nav_menu( array(
								'theme_location'	=> 'menu-1',
								'menu_id'			=> 'primary-menu',
								'menu_class'		=> 'pmenu'
							) );
						?>

					</nav><!-- #primary-site-navigation -->
				<?php endif; ?>

			</div>
		</div>

		<div id="header-bottom-nav" class="main-header">
			<div class="content-wrap clearfix">
				<?php if ( has_custom_logo() ) : ?>

					<div class="site-branding branding-logo">
						<?php the_custom_logo(); ?>
					</div><!-- .site-branding -->

				<?php else : ?>

					<div class="site-branding">

						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<h2 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
						<?php
						endif;

						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
						<?php
						endif;
						?>

					</div><!-- .site-branding -->

				<?php
				endif;
				?>

				<nav id="secondary-site-navigation" class="secondary-menu main-navigation">
					
					<?php
						wp_nav_menu( array(
							'theme_location'	=> 'menu-2',
							'menu_id'			=> 'secondary-menu',
							'menu_class'		=> 'smenu'
						) );
					?>

				</nav><!-- #secondary-site-navigation -->
			</div>
		</div>

		<div class="super-menu clearfix">
			<div class="super-menu-nav">

				<button class="icon-toggle">
					<span class="inner-line"><?php esc_html_e( 'Toggle Main Menu', 'generpress' ); ?></span>
				</button>

				<span class="inner-label"><?php esc_html_e( 'Menu', 'generpress' ); ?></span>

			</div>
		</div>
	</header><!-- #masthead -->

	<?php
	if ( have_posts() && is_archive() ) :
	?>

		<div class="section-page-header">
			<div class="content-wrap">
				<header class="archive-page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</header>
			</div>
		</div><!-- .section-page-header -->

	<?php
	endif;
	?>

	<div id="content" class="site-content clearfix">
		<div class="content-wrap">