<?php
/**
 * The template for displaying the content.
 * @package Fameup
 */
?>
<div class="row">
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php while(have_posts()){ the_post(); ?>
    <!--col-md-12-->
    <div class="col-md-12 fadeInDown wow" data-wow-delay="0.1s">
        <!-- bs-posts-sec-inner -->
        <?php $blog_layout = get_theme_mod('blog_layout','default'); 
        if($blog_layout == 'default')
        {
        ?>
        <div class="bs-blog-post list-blog">
            <?php
                $url = fameup_get_freatured_image_url($post->ID, 'fameup-medium');
                fameup_post_image_display_type($post); 
              ?>
            <article class="small col">
              <?php 
                    $fameup_global_category_enable = get_theme_mod('fameup_global_category_enable','true');
                    if($fameup_global_category_enable == 'true') {
                    fameup_post_categories(); } ?>
              <h4 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
              <?php fameup_post_meta(); ?>
                        <?php fameup_posted_content(); wp_link_pages( ); 
                        $fameup_readmore_excerpt=get_theme_mod('fameup_blog_content','excerpt');
                            if($fameup_readmore_excerpt=="excerpt"){?>
                                <p><a href="<?php the_permalink();?>" class="more-link"><?php _e('Read More','fameup'); ?></a></p>
                            <?php 
                            } ?>
                <?php  fameup_post_social_share_post($post); ?>
            </article>
          </div>
       <?php }  elseif ($blog_layout == "three")  { ?>
        <?php $url = fameup_get_freatured_image_url($post->ID, 'fameup-medium'); ?> 
        <div class="bs-blog-post bshre">
                  <?php fameup_post_image_display_type($post); ?>
                  <article class="small">
                    <?php 
                    $fameup_global_category_enable = get_theme_mod('fameup_global_category_enable','true');
                    if($fameup_global_category_enable == 'true') {
                    fameup_post_categories(); } ?>
                    <h4 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                    <?php fameup_post_meta(); fameup_posted_content(); wp_link_pages( ); 
                    $fameup_readmore_excerpt=get_theme_mod('fameup_blog_content','excerpt');
                            if($fameup_readmore_excerpt=="excerpt"){?>
                                <p><a href="<?php the_permalink();?>" class="more-link"><?php _e('Read More','fameup'); ?></a></p>
                            <?php 
                            } ?>
            </article>
        </div>
    <?php }  ?>

    <!-- // bs-posts-sec block_6 -->
    </div>
    <?php } ?>
    <div class="col-md-12 text-center d-md-flex justify-content-between">
                <?php //Previous / next page navigation
                    the_posts_pagination( array(
                        'prev_text'          => '<i class="fa fa-angle-left"></i>',
                        'next_text'          => '<i class="fa fa-angle-right"></i>',
                    ) ); ?>


                    <?php $fameup_pagination_remove = get_theme_mod('fameup_pagination_remove','true');
                    if($fameup_pagination_remove == true)
                    {
                    ?>
                    <div class="navigation"><p><?php posts_nav_link(); ?></p></div>
                    <?php } ?>
        </div>
</div>
</div>