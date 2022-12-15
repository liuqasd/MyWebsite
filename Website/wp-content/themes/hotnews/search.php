<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package anews
 */
get_header();
if( 'center' != get_theme_mod( 'anews_search_layout', 'right' ) &&  is_active_sidebar( 'sidebar-1' )){
	$anews_page_class = 'col-12 col-sm-12 col-md-12 col-lg-8';
}else{
	$anews_page_class = 'col-12 col-sm-12 col-md-12 col-lg-12';
}
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="page-title-wrapper">
				<div class="container">
					<div class="page-title-inner">
						<ul>
							<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Home','anews'); ?></a></li>
							<li><?php /* translators: %s: search term */
							printf( esc_html__( 'Search Results for: %s', 'anews' ), '<span>' . get_search_query() . '</span>' ); ?></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="page-wrapper">
				<div class="container">
					<div class="row">
						<?php if( 'left' == get_theme_mod( 'anews_search_layout') && is_active_sidebar( 'sidebar-1' )){
							get_sidebar();
						} ?>
						<div class="<?php echo esc_attr($anews_page_class); ?>">
						<?php if ( have_posts() ) : ?>
							<?php
							/* Start the Loop */
							while ( have_posts() ) :
								the_post();
								/**
								 * Run the loop for the search to output the results.
								 * If you want to overload this in a child theme then include a file
								 * called content-search.php and that will be used instead.
								 */
								get_template_part( 'template-parts/content', 'search' );
							endwhile;
							anews_pagination();
						else :
							get_template_part( 'template-parts/content', 'none' );
						endif;
						?>
						</div>
						<?php if( 'right' == get_theme_mod( 'anews_search_layout', 'right' ) && is_active_sidebar( 'sidebar-1' )){
							get_sidebar();
						} ?>
					</div>
				</div>
			</div>
		</div>
	</main>
</div>
<?php get_footer();
