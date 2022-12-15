<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package anews
 */

get_header();
if( 'center' != get_theme_mod( 'anews_blog_layout', 'right' ) &&  is_active_sidebar( 'sidebar-1' )){
	$anews_page_class = 'col-12 col-sm-12 col-md-12 col-lg-8';
}else{
	$anews_page_class = 'col-12 col-sm-12 col-md-12 col-lg-12';
}
/**
* Hook - anews_braking_news.
*
* @hooked anews_braking_news_items - 10
*/
do_action( 'anews_braking_news' );
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="page-title-wrapper">
			<div class="container">
				<div class="page-title-inner">
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Home','anews'); ?></a></li>
						<li><?php esc_html_e('Blog','anews'); ?></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-wrapper">
			<div class="container">
				<div class="row">
					<?php if( 'left' == get_theme_mod( 'anews_blog_layout') && is_active_sidebar( 'sidebar-1' )){
						get_sidebar();
					} ?>
					<div class="<?php echo esc_attr($anews_page_class); ?>">
						<?php
						if ( have_posts() ) :
							if ( is_home() && ! is_front_page() ) :
								?>
								<header>
									<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
								</header>
								<?php
							endif;
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();
								/*
								* Include the Post-Type-specific template for the content.
								* If you want to override this in a child theme, then include a file
								* called content-___.php (where ___ is the Post Type name) and that will be used instead.
								*/
								get_template_part( 'template-parts/content', get_post_type() );
							endwhile;
							anews_pagination();
						else :
							get_template_part( 'template-parts/content', 'none' );
						endif;
						?>
					</div>
					<?php if( 'right' == get_theme_mod( 'anews_blog_layout', 'right' ) && is_active_sidebar( 'sidebar-1' )){
						get_sidebar();
					} ?>
				</div>
			</div>
		</div>
	</main>
</div>
<?php
get_footer();
