<?php 
/**
 * Fameup functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Fameup
 */

/**
 * Define Theme Constants.
 */

$fameup_theme_path = get_template_directory() . '/inc/ansar/';

	require( $fameup_theme_path . '/fameup-custom-navwalker.php' );
	require( $fameup_theme_path . '/default_menu_walker.php' );
	require( $fameup_theme_path . '/font/font.php');
	require( $fameup_theme_path . '/template-tags.php');
	require( $fameup_theme_path . '/template-functions.php');
	require( $fameup_theme_path. '/widgets/widgets-common-functions.php');
	require( $fameup_theme_path . '/custom-control/custom-control.php');
	require( $fameup_theme_path . '/fameup-pagination.php');
	require( $fameup_theme_path . '/custom-control/font/font-control.php');


	$fameup_theme_start = wp_get_theme();
	if (( 'Fameup' == $fameup_theme_start->name) )  {
	if ( is_admin() ) {
		require ($fameup_theme_path . '/admin/getting-started.php');
	}
	}

	// Theme version.
	$fameup_theme = wp_get_theme();
	define( 'FAMEUP_THEME_VERSION', $fameup_theme->get( 'Version' ) );
	define ( 'FAMEUP_THEME_NAME', $fameup_theme->get( 'Name' ) );

	/*-----------------------------------------------------------------------------------*/
	/*	Enqueue scripts and styles.
	/*-----------------------------------------------------------------------------------*/
	require( $fameup_theme_path .'/enqueue.php');
	/* ----------------------------------------------------------------------------------- */
	/* Customizer */
	/* ----------------------------------------------------------------------------------- */
	require( $fameup_theme_path . '/customize/customizer.php');

	/* ----------------------------------------------------------------------------------- */
	/* Customizer */
	/* ----------------------------------------------------------------------------------- */

	require( $fameup_theme_path  . '/widgets/widgets-init.php');

	/* ----------------------------------------------------------------------------------- */
	/* Widget */
	/* ----------------------------------------------------------------------------------- */

	require( $fameup_theme_path  . '/hooks/hooks-init.php');

	/* custom-color file. */
	require( get_template_directory() . '/css/colors/theme-options-color.php');

	/* color css file. */
	require( get_template_directory() . '/css/colors/color-css.php');

	require get_template_directory().'/css/custom-style.php';

	require get_template_directory().'/inc/ansar/hooks/blocks/slider/slider-init.php';

	require_once( trailingslashit( get_template_directory() ) . 'inc/ansar/customize-pro/class-customize.php' );


if ( ! function_exists( 'fameup_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function fameup_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on fameup, use a find and replace
	 * to change 'fameup' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'fameup', get_template_directory() . '/languages' );

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

	// Add featured image sizes
        add_image_size('fameup-slider-full', 1280, 720, true); // width, height, crop
        add_image_size('fameup-featured', 1024, 0, false ); // width, height, crop
        add_image_size('fameup-medium', 720, 380, true); // width, height, crop

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary menu', 'fameup' ),
		'sidebar_menu' => __( 'Sidebar Menu', 'fameup' ),
        'footer' => __( 'Footer menu', 'fameup' ),
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

	$args = array(
    'default-color' => '#eee',
    'default-image' => '',
	);
	add_theme_support( 'custom-background', $args );

    // Set up the woocommerce feature.
    add_theme_support( 'woocommerce');

     // Woocommerce Gallery Support
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

    // Added theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	/* Add theme support for gutenberg block */
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );

	//Custom logo
	add_theme_support( 'custom-logo');
	
	// custom header Support
			$args = array(
			'default-image'		=>  get_template_directory_uri() .'/images/head-back.jpg',
			'width'			=> '1600',
			'height'		=> '600',
			'flex-height'		=> false,
			'flex-width'		=> false,
			'header-text'		=> true,
			'default-text-color'	=> '000',
			'wp-head-callback'       => 'fameup_header_color',
		);
		add_theme_support( 'custom-header', $args );


	/*
     * Enable support for Post Formats on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/post-formats/
     */
    add_theme_support( 'post-formats', array( 'image', 'video', 'gallery' ) );

    //Editor Styling 
	add_editor_style( array( 'css/editor-style.css') );
}
endif;
add_action( 'after_setup_theme', 'fameup_setup' );


	function fameup_the_custom_logo() {
	
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}

	}

	add_filter('get_custom_logo','fameup_logo_class');


	function fameup_logo_class($html)
	{
	$html = str_replace('custom-logo-link', 'navbar-brand', $html);
	return $html;
	}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function fameup_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'fameup_content_width', 640 );
}
add_action( 'after_setup_theme', 'fameup_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function fameup_widgets_init() {
	
	$fameup_footer_column_layout = esc_attr(get_theme_mod('fameup_footer_column_layout',3));
	
	$fameup_footer_column_layout = 12 / $fameup_footer_column_layout;
	
	
	register_sidebar( array(
		'name'          => esc_html__( 'Menu Sidebar Widget Area', 'fameup' ),
		'id'            => 'menu-sidebar-content',
		'description'   => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Widget Area', 'fameup' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="bs-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="bs-widget-title"><h6 class="title"><span class="bg">',
		'after_title'   => '</span></h6></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front-page Content Section', 'fameup'),
		'id'            => 'front-page-content',
		'description'   => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '',
		'after_title'   => '',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front-Page Sidebar Section', 'fameup'),
		'id'            => 'front-page-sidebar',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="bs-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="bs-widget-title"><h6 class="title"><span class="bg">',
		'after_title'   => '</span></h6></div>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget Area', 'fameup' ),
		'id'            => 'footer_widget_area',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="col-md-'.$fameup_footer_column_layout.' col-sm-6 rotateInDownLeft animated bs-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6>',
		'after_title'   => '</h6>',
	) );

}
add_action( 'widgets_init', 'fameup_widgets_init' );