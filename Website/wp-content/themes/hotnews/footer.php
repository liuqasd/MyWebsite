<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package anews
 */
/**
 *
 * @hooked anews_footer_start
 */
do_action( 'anews_action_before_footer' );

/**
 * Hooked - anews_footer_top_section -10
 * Hooked - anews_footer_widgets -10
 * Hooked - anews_footer_site_info -10
 */
do_action( 'anews_action_footer' );

/**
 * Hooked - anews_footer_end. 
 */
do_action( 'anews_action_after_footer' );

wp_footer(); ?>
</body>
</html>
