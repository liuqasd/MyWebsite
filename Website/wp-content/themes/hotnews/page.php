<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package anews
 */

get_header();
if( 'center' != get_theme_mod( 'anews_page_layout', 'center' ) &&  is_active_sidebar( 'sidebar-1' )){
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
						<li><?php the_title(); ?></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-wrapper">
			<div class="container">
				<div class="row">
					<?php if( 'left' == get_theme_mod( 'anews_page_layout') && is_active_sidebar( 'page-sidebar' )) : ?>
					<div class="col-12 col-sm-12 col-md-12 col-lg-4">
						<aside id="secondary" class="sidebar-widget" role="complementary">
							<div class="sidebar-inner">
							<?php dynamic_sidebar( 'page-sidebar' ); ?>
							</div>
						</aside><!-- #secondary -->
					</div>
					<?php endif; ?>
					<div class="<?php echo esc_attr($anews_page_class); ?>">
						<div class="page-wrapper">
						<?php
							while ( have_posts() ) :
								the_post();
								get_template_part( 'template-parts/content', 'page' );
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;
							endwhile; // End of the loop.
							?>
						</div>
					</div>
					<?php if( 'right' == get_theme_mod( 'anews_page_layout') && is_active_sidebar( 'page-sidebar' )) : ?>
					<div class="col-12 col-sm-12 col-md-12 col-lg-4">
						<aside id="secondary" class="sidebar-widget" role="complementary">
							<div class="sidebar-inner">
							<?php dynamic_sidebar( 'page-sidebar' ); ?>
							</div>
						</aside><!-- #secondary -->
					</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</main>
</div>
<?php
get_footer();
