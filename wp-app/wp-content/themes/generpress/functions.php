<?php
/**
 * GenerPress Functions and Definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package GenerPress
 */

if ( ! function_exists( 'generpress_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function generpress_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on generpress, use a find and replace
		 * to change 'generpress' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'generpress', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 300 );

		add_image_size( 'generpress-small', 350 , 260, true );
		add_image_size( 'generpress-large', 680 , 500, true );
		add_image_size( 'generpress-widget', 86 , 60, true );


		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1'	=> esc_html__( 'Primary Menu', 'generpress' ),
			'menu-2'	=> esc_html__( 'Secondary Menu', 'generpress' ),
			'menu-3'	=> esc_html__( 'Social Menu', 'generpress' ),
			'menu-4'	=> esc_html__( 'Footer Menu', 'generpress' )
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'generpress_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

	}
endif;
add_action( 'after_setup_theme', 'generpress_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function generpress_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'generpress_content_width', 640 );
}
add_action( 'after_setup_theme', 'generpress_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function generpress_widgets_init() {
	register_sidebar( array(
		'name'				=> esc_html__( 'Sidebar', 'generpress' ),
		'id'				=> 'sidebar-1',
		'description'		=> esc_html__( 'Add widgets here.', 'generpress' ),
		'before_widget'		=> '<section id="%1$s" class="fbox widget %2$s"><div class="swidget-inner">',
		'after_widget'		=> '</div></section>',
		'before_title'		=> '<div class="swidget"><h3 class="widget-title">',
		'after_title'		=> '</h3></div>',
	) );
}
add_action( 'widgets_init', 'generpress_widgets_init' );

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 *
	 * @since GenerPress 1.0.3
	 */
	function wp_body_open() {
		/**
		 * Triggered after the opening <body> tag.
		 *
		 * @since GenerPress 1.0.3
		 */
		do_action( 'wp_body_open' );
	}
endif;

/**
 * Enqueue scripts and styles.
 */
function generpress_scripts() {
	wp_enqueue_style( 'generpress-font-google', 'https://fonts.googleapis.com/css?family=Dancing+Script:400,700|Lora:400,700&display=swap' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/all.css' );
	wp_enqueue_style( 'generpress-style', get_stylesheet_uri() );

	wp_enqueue_script( 'generpress-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '1.1', true );
	wp_enqueue_script( 'generpress-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '1.1', true );
	wp_enqueue_script( 'generpress-script', get_template_directory_uri() . '/js/script.js', array(), '1.1', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'generpress_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require_once( trailingslashit( get_template_directory() ) . 'inc/customizer.php');

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Widgets
 */
require get_template_directory() . '/inc/widget.php';

/**
* Custom Style 
*/
load_template( get_template_directory() . '/inc/options-style.php' );

