<?php 
/**
 * Template Name: Front Page Template
 *
 * Displays the Front Page Layout of the theme.
 * @package anews
 */
get_header();
?>
    <?php 
    if(get_theme_mod( 'anews_home_braking_news_enalbe' ) == true ){
        /**
        * Hook - anews_braking_news.
        *
        * @hooked anews_braking_news_items - 10
        */
        do_action( 'anews_braking_news' );
    } ?>
    <div class="front-page-wrapper">
    <!--  TRANDING SECTION --->
    <?php if ( true == get_theme_mod( 'anews_home_tranding_post_enalbe', true ) ){
        get_template_part( 'inc/section/home-tranding','section' );
    } ?>
    <!--  END TRANDING SECTION --->
    <!-- TOP HEADLINE --->
    <?php 
    if ( true == get_theme_mod( 'anews_home_top_headline_post_enalbe', true ) ){
        get_template_part( 'inc/section/top-headline','section' );
    }?>
    <!-- END TOP HEADLINE --->
    <!-- SLIDE WITH FEATURE --->
    <?php 
    if ( true == get_theme_mod( 'anews_home_slider_post_enalbe', true ) ){
        get_template_part( 'inc/section/home-post','slider' );
    } ?>
    <!-- END SLIDE WITH FEATURE --->
    <?php 
    if ( true == get_theme_mod( 'anews_home_ads1_enable', true ) ){
        get_template_part( 'inc/section/home-ads1','section' );
    } ?>
    <!-- MOST VIEW AND RECENT POST -->
    <?php 
    if ( true == get_theme_mod( 'anews_home_most_view_enalbe', true ) ){
        get_template_part( 'inc/section/home-most-view','section' );
    } ?>
    <!-- END MOST VIEW AND RECENT POST -->
    <!-- CATEGORY SECTION POST -->
    <?php
    if ( true == get_theme_mod( 'anews_home_categroy_enalbe', true ) ){
        get_template_part( 'inc/section/home-category','section' ); 
    }?>
    <!-- END CATEGORY SECTION POST -->
    <!-- FEATURED POST -->
    <?php if ( true == get_theme_mod( 'anews_home_post_list_enable', true ) ){
        get_template_part( 'inc/section/home-post-list','section' ); 
    } ?>
    <!-- END FEATURED POST -->
    <!--  SUBSCRIBE SECTION -->
    <?php if ( true == get_theme_mod( 'anews_home_subscribe_enable', true ) ){
        get_template_part( 'inc/section/home-subscribe','section' ); 
    } ?>
    <!-- END SUBSCRIBE SECTION -->
    <!-- RECENT POST WITH BANNER POST -->
    <?php if ( true == get_theme_mod( 'anews_home_recent_post_enable', true ) ){
        get_template_part( 'inc/section/home-resent-post','section' ); 
    } ?>
    <!-- END RECENT POST WITH BANNER POST -->
</div>
<?php
get_footer();