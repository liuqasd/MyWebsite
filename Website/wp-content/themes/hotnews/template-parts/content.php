<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package anews
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-item'); ?>>
	<?php if(has_post_thumbnail()) : ?>
	<figure class="post-imge entry-figure">
	<?php the_post_thumbnail('anews_blog_dec'); ?>
	</figure>
	<?php endif; ?>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title single">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				anews_posted_on();
				anews_posted_by();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
		 if(is_singular()){
			/**
			* Hooked - anews_single_ads1_banner -10
			*/
			do_action( 'anews_single_ads1' );
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'anews' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			/**
			* Hooked - anews_single_ads2_banner -10
			*/
			do_action( 'anews_single_ads2' );
		 }else{
			echo wp_kses_post( wp_trim_words( get_the_content(), 50 ) );
			?>
			<div class="blog-readmore">
				<a href="<?php echo esc_url( get_permalink() ); ?>" class="button"><?php esc_html_e('Read More','anews'); ?> <i class="fas fa-arrow-right"></i></a>
			</div>
			<?php
		 }
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'anews' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
	<?php if(is_singular()){
		if( has_tag() || true == get_theme_mod( 'anews_single_post_share' )) : ?>
		<div class="post-tag-social align-items-center">
			<?php if(has_tag()) : ?>
			<div class="post-tag flex-grow-1">
			<?php if(has_tag()) : ?>
				<?php anews_post_tag(); ?>
				<?php endif; ?>
			</div>
			<?php endif; 
			if(function_exists('anews_post_share') && true == get_theme_mod( 'anews_single_post_share' )) :
			?>
			<div class="post-share">
				<label><?php esc_html_e('Share','anews'); ?></label>
				<?php if(function_exists('anews_post_share')){
					anews_post_share();
				} ?>
			</div>
			<?php endif; ?>
		</div>
		<?php endif;
	 }
	?>
</article><!-- #post-<?php the_ID(); ?> -->
