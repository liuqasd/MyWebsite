<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package anews
 */

/**
* Hook - anews_action_doctype.
*
* @hooked anews_doctype -  10
*/
do_action( 'anews_action_doctype' ); 
?>
<head>
<?php
/**
* Hook - anews_action_head.
*
* @hooked anews_head -  10
*/
do_action( 'anews_action_head' );
wp_head();
?>
<!-- Add Custom code here -->

</head>
<body <?php body_class(); ?>>
<?php wp_body_open();?>
<?php 
/**
* Hook - anews_action_before.
*
* @hooked anews_page_start - 10
*/
do_action( 'anews_action_before' );

/**
*
* @hooked anews_header_start - 10
*/
do_action( 'anews_action_before_header' );
/**
*
*@hooked anews_site_branding - 10
*@hooked anews_header_end - 15 
*/
do_action('anews_action_header');
?>