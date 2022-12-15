<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package anews
 */

get_header();
if( 'center' != get_theme_mod( 'anews_single_layout', 'right' ) &&  is_active_sidebar( 'sidebar-1' )){
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
					<?php if( 'left' == get_theme_mod( 'anews_single_layout') && is_active_sidebar( 'sidebar-1' )){
						get_sidebar();
					} ?>
					<div class="<?php echo esc_attr($anews_page_class); ?>">
						<?php
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content', get_post_type() );
							if( function_exists( 'anews_next_prev_post_link' )){
								anews_next_prev_post_link();
							}

							/**
							* Hooked - anews_single_ads3_banner -10
							*/
							do_action( 'anews_single_ads3' );
							if( true == get_theme_mod( 'anews_single_related_post', false )){
								/**
								 * Hooked - anews_reslted_post_start -10
								 */
								do_action( 'anews_action_before_realted_post' );
		
								/**
								 * Hooked - anews_action_realted_post_item -10
								 */
								do_action( 'anews_action_realted_post' );
		
								/**
								 * Hooked - anews_reslted_post_end -10
								 */
								do_action( 'anews_action_after_realted_post' );
							}
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
						endwhile; // End of the loop.
						?>
					</div>
					<?php if( 'right' == get_theme_mod( 'anews_single_layout', 'right' ) && is_active_sidebar( 'sidebar-1' )){
						get_sidebar();
					} ?>
				</div>
			</div>
		</div>
	</main>
</div>
<?php get_footer();