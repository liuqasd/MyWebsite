<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package anews
 */
get_header();
?>
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="page-title-wrapper">
			<div class="container">
				<div class="page-title-inner">
					<ul>
						<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e('Home','anews'); ?></a></li>
						<li><?php echo esc_html_e('Oops! That page can&rsquo;t be found','anews'); ?></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="page-wrapper">
			<div class="container">
				<section class="error-404 not-found">
					<div class="page-content">
						<div class="error-dec">
							<?php echo wp_kses_post(get_theme_mod( 'anews_error_content',wp_kses(
							__( '<h2> Oops! page not found.</h2><p>The page you are looking for is not available or does not belong to this website!</p>', 'anews' ),
							array(
								'a'      => array(
									'href' => array(),
								),
								'strong' => array(),
								'small'  => array(),
								'span'   => array(),
								'p'      => array(),
								'h1'     => array(),
								'h2'     => array(),
								'h3'     => array(),
								'h4'     => array(),
								'h5'     => array(),
								'h6'     => array(),
							)) 
						)); ?>
						</div>
						<div class="error-button">
							<a class="theme-btn" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Go Home','anews'); ?></a>
						</div>
					</div><!-- .page-content -->
				</section><!-- .error-404 -->
			</div>
		</div>
	</main>
</div>
<?php
get_footer();