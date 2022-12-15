<?php
/**
 * anews functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package anews
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function anews_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on anews, use a find and replace
		* to change 'anews' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'anews', get_template_directory() . '/languages' );

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
	add_image_size( 'anews_blog_dec', 850, 450, true);
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'primary_menu' => esc_html__( 'Primary Menu', 'anews' ),
			'header_top_menu' => esc_html__( 'Header Top Menu', 'anews' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support( "html5" );
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'anews_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);
	add_theme_support( "custom-header" );
	add_theme_support( 'custom-background' );
	add_theme_support( 'register_block_pattern' ); 
	add_theme_support( 'register_block_style' ); 
	add_theme_support( 'responsive-embeds' );
	add_editor_style( trailingslashit( get_template_directory_uri() ) . 'assets/css/editor-style.css' );
	// Gutenberg support
	add_theme_support( 'editor-color-palette', array(
		array(
		 'name' => esc_html__( 'Blue', 'anews' ),
		 'slug' => 'blue',
		 'color' => '#2c7dfa',
		),
		array(
			'name' => esc_html__( 'Green', 'anews' ),
			'slug' => 'green',
			'color' => '#07d79c',
		),
		array(
			'name' => esc_html__( 'Orange', 'anews' ),
			'slug' => 'orange',
			'color' => '#ff8737',
		),
		array(
			'name' => esc_html__( 'Black', 'anews' ),
			'slug' => 'black',
			'color' => '#2f3633',
		),
		array(
			'name' => esc_html__( 'Grey', 'anews' ),
			'slug' => 'grey',
			'color' => '#82868b',
		),
	));

 add_theme_support( 'align-wide' );
 add_theme_support( 'editor-font-sizes', array(
		array(
			'name' => esc_html__( 'small', 'anews' ),
			'shortName' => esc_html__( 'S', 'anews' ),
			'size' => 12,
			'slug' => 'small'
		),
		array(
			'name' => esc_html__( 'regular', 'anews' ),
			'shortName' => esc_html__( 'M', 'anews' ),
			'size' => 16,
			'slug' => 'regular'
		),
		array(
			'name' => esc_html__( 'larger', 'anews' ),
			'shortName' => esc_html__( 'L', 'anews' ),
			'size' => 36,
			'slug' => 'larger'
		),
		array(
			'name' => esc_html__( 'huge', 'anews' ),
			'shortName' => esc_html__( 'XL', 'anews' ),
			'size' => 48,
			'slug' => 'huge'
		)
 ));
 add_theme_support('editor-styles');
 add_theme_support( 'wp-block-styles' );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( "custom-logo" );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'anews_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function anews_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'anews_content_width', 640 );
}
add_action( 'after_setup_theme', 'anews_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function anews_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'anews' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'anews' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Page Sidebar', 'anews' ),
			'id'            => 'page-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'anews' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer One', 'anews' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'anews' ),
			'before_widget' => '<section id="%1$s" class="widget footer-widtet %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Two', 'anews' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'anews' ),
			'before_widget' => '<section id="%1$s" class="widget footer-widtet %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Three', 'anews' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'anews' ),
			'before_widget' => '<section id="%1$s" class="widget footer-widtet %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Four', 'anews' ),
			'id'            => 'footer-4',
			'description'   => esc_html__( 'Add widgets here.', 'anews' ),
			'before_widget' => '<section id="%1$s" class="widget footer-widtet %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		)
	);
}
add_action( 'widgets_init', 'anews_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function anews_scripts() {
	//Enqueue Style.
	wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/assets/bootstrap/bootstrap-min.css', array(), _S_VERSION, 'all' );
	if(is_rtl()){
		wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri().'/assets/bootstrap/bootstrap-rtl-min.css', array(), _S_VERSION, 'all' );
	}
	wp_enqueue_style( 'fontawesomeall-min', get_template_directory_uri().'/assets/css/fontawesomeall-min.css', array(), _S_VERSION, 'all' );
	wp_enqueue_style( 'owl-carousel', get_template_directory_uri().'/assets/css/owl-carousel-min.css', array(), _S_VERSION, 'all' );
	wp_enqueue_style( 'slicknav-min', get_template_directory_uri().'/assets/css/slicknav-min.css', array(), _S_VERSION, 'all' );
	wp_enqueue_style( 'superfish', get_template_directory_uri().'/assets/css/superfish.css', array(), _S_VERSION, 'all' );
	wp_enqueue_style( 'anews-unitest', get_template_directory_uri().'/assets/css/unitest.css', array(), _S_VERSION, 'all' );
	wp_enqueue_style( 'anews-theme', get_template_directory_uri().'/assets/css/theme.css', array(), _S_VERSION, 'all' );
	wp_enqueue_style( 'anews-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'anews-style', 'rtl', 'replace' );

	//Enqueue scripts.
	wp_enqueue_script( 'popper-js', get_template_directory_uri() . '/assets/bootstrap/popper-min.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/bootstrap/bootstrap-min.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/assets/js/owl-carousel-min.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'isotop-js', get_template_directory_uri() . '/assets/js/isotop-min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'slicknav-min-js', get_template_directory_uri() . '/assets/js/jquery-slicknav-min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'superfish.min', get_template_directory_uri() . '/assets/js/superfish.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'anews-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'anews-skip-link-focus', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'anews-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_style( 'anews-fonts', anews_fonts_url(), array(), null );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'anews_scripts' );

if ( ! function_exists( 'anews_fonts_url' ) ) :

	function anews_fonts_url() {
		
		$fonts_url = '';
		$fonts     = array();
		$subsets   = 'latin,latin-ext';
		if ( 'off' !== _x( 'on', 'Work Sans: on or off', 'anews' ) ) {
			$fonts[] = 'WorkSans:100,200,300,400,500,600,700,800,900';
		}
		if ( 'off' !== _x( 'on', 'Epilogue font: on or off', 'anews' ) ) {
			$fonts[] = 'Epilogue:100,200,300,400,500,600,800,900';
		}
		$query_args = array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		);

		if ( $fonts ) {
			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}
endif;

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Kirki framework additions.
 */
require get_template_directory() . '/inc/kirki/kirki.php';
require get_template_directory() . '/inc/kirki-customizer.php';
require get_template_directory() . '/inc/style.php';

/**
* Custom template tags for this theme.
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';
require get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom Widgets.
 */
require get_template_directory() . '/inc/widgets/recent-posts.php';
require get_template_directory() . '/inc/widgets/anews-about-widget.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/post-share.php';
require get_template_directory() . '/inc/comments-template.php';

/**
 * Load hooks.
 */
require get_template_directory() . '/inc/hook/custom.php';
require get_template_directory() . '/inc/hook/structure.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}


// Add Span In category number
add_filter('wp_list_categories', 'anews_cat_count_span');
function anews_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span class="number">(', $links);
  $links = str_replace(')', ')</span>', $links);
  return $links;
}
// Add Span In archive number
function anews_the_archive_count($links) {
    $links = str_replace('</a>'.esc_attr__('&nbsp;','anews').'(', '</a> <span class="number">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}
add_filter('get_archives_link', 'anews_the_archive_count');

