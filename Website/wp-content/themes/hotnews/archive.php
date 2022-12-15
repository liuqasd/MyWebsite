<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package anews
 */

get_header();
if( 'center' != get_theme_mod( 'anews_archiv_layout', 'right' ) &&  is_active_sidebar( 'sidebar-1' )){
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
						<li><?php the_archive_title(); ?></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-wrapper">
			<div class="container">
				<div class="row">
					<?php if( 'left' == get_theme_mod( 'anews_archiv_layout') && is_active_sidebar( 'sidebar-1' )){
						get_sidebar();
					} ?>
					<div class="<?php echo esc_attr($anews_page_class); ?>">
						<?php if ( have_posts() ) : ?>
							<?php
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
					<?php if( 'right' == get_theme_mod( 'anews_archiv_layout', 'right') && is_active_sidebar( 'sidebar-1' )){
						get_sidebar();
					} ?>
				</div>
			</div>
		</div>
	</main>
</div>
<?php get_footer();
