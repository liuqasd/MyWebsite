<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package anews
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-item'); ?>>
	<?php if(has_post_thumbnail()) : ?>
	<div class="post-imge">
		<?php anews_post_thumbnail(); ?>
	</div>
	<?php endif; ?>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
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
		 echo wp_kses_post( wp_trim_words( get_the_content(), 50 ) );
		?>
		<div class="blog-readmore">
			 <a href="<?php echo esc_url( get_permalink() ); ?>" class="button"><?php esc_html_e('Read More','anews'); ?> <i class="fas fa-arrow-right"></i></a>
		 </div>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
