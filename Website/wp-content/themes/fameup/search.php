<?php
/**
 * The template for displaying search results pages.
 *
 * @package Fameup
 */

get_header(); ?>
<!--==================== Fameup breadcrumb section ====================-->
<?php get_template_part('index','banner'); ?>
<!--==================== main content section ====================-->
<div id="content">
    <!--container-->
    <div class="container">
    <!--row-->
        <div class="row">
            <div class="col-md-<?php echo ( !is_active_sidebar( 'sidebar-1' ) ? '12' :'8' ); ?>">
                <h2><?php /* translators: %s: search term */ printf( esc_html__( 'Search Results for: %s','fameup'), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h2>
                <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <!-- bs-posts-sec bs-posts-modul-6 -->
                            <div class="bs-posts-sec bs-posts-modul-6">
                                <!-- bs-posts-sec-inner -->
                                <div class="bs-posts-sec-inner">
                                    <?php if ( have_posts() ) : /* Start the Loop */
                                    while ( have_posts() ) : the_post(); ?>
                                    <article class="d-md-flex bs-posts-sec-post">
                                    <?php fameup_post_image_display_type($post); ?>
                                            <div class="bs-sec-top-post py-3 col">
                                                    <div class="bs-blog-category"> 
                                                        <?php fameup_post_categories(); ?>
                                                    </div>

                                                    <h4 class="entry-title title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
                                                    <?php fameup_post_meta(); ?>

                                                
                                                    <div class="bs-content">
                                                        <p><?php echo wp_trim_words( get_the_excerpt(), 20 ); ?></p>
                                                </div>
                                            </div>
                                    </article>
                                    <?php endwhile; else :?>
                                    
        <h2><?php esc_html_e( "Nothing Found", 'fameup' ); ?></h2>
        <div class="">
        <p><?php esc_html_e( "Sorry, but nothing matched your search criteria. Please try again with some different keywords.", 'fameup' ); ?>
        </p>
        <?php get_search_form(); ?>
        </div><!-- .blog_con_mn -->
        <?php endif; ?>
                                </div>
                                <!-- // bs-posts-sec-inner -->
                            </div>
                            <!-- // bs-posts-sec block_6 -->

                            <!--col-md-12-->
</div>
            </div>
            <aside class="col-md-3 col-sm-4 sidebar-right">
                    <?php get_sidebar();?>
            </aside>
        </div><!--/row-->
    </div><!--/container-->
</div>
<?php
get_footer();
?>