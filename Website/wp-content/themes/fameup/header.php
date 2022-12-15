<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package Fameup
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<?php wp_body_open(); ?>
<div id="page" class="site">
<a class="skip-link screen-reader-text" href="#content">
<?php esc_html_e( 'Skip to content', 'fameup' ); ?></a>
<!--wrapper-->
<div class="wrapper">
  
    <!--==================== TOP BAR ====================-->
    <?php do_action('fameup_action_fameup_header_type_section'); ?>
   
 <main id="content">
    <div class="container">
      	<div class="row">
            <div class="col-md-12 trending-cls">        
<?php
    do_action('fameup_action_header_brk_section');
    do_action('fameup_action_front_page_main_section_1');
    do_action('fameup_action_featured_ads_section');
?>