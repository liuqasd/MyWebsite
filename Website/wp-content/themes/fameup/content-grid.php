<?php
/**
 * The template for displaying the content.
 * @package Fameup
 */
?>
<div id="grid" class="row" >
     <?php while(have_posts()){ the_post();  
     $fameup_content_layout = esc_attr(get_theme_mod('fameup_content_layout','align-content-right')); ?>
    <div id="post-<?php the_ID(); ?>" <?php if($fameup_content_layout == "grid-fullwidth") { echo post_class('col-md-4'); } else { echo post_class('col-md-6'); } ?>>
       <!-- bs-posts-sec bs-posts-modul-6 -->
            <div class="bs-blog-post"> 
                 <?php $url = fameup_get_freatured_image_url($post->ID, 'fameup-medium'); ?>
                <article class="small">
                    <div class="bs-blog-category">
                            <?php fameup_post_categories(); ?> 
                    </div>
                    <h4 class="entry-title title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                    <?php fameup_post_meta(); ?>
                            <?php $fameup_blog_content = get_theme_mod('fameup_blog_content', 'excerpt'); 
                            if($fameup_blog_content == 'excerpt')
                            {
                            ?>
                            <p><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                            <?php } else { the_content(); } ?>
                </article>
            </div>
        </div>
        <?php } ?>
        <div class="col-md-12 text-center d-md-flex justify-content-center">
            <?php //Previous / next page navigation
                    the_posts_pagination( array(
                    'prev_text'          => '<i class="fa fa-angle-left"></i>',
                    'next_text'          => '<i class="fa fa-angle-right"></i>',
                    ) ); 
            ?>
        </div>
</div>