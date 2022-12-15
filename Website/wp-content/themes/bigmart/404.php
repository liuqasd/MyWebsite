<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Bigmart
 */
get_header();
?>

<div id="ms-primary" class="ms-content-area">

    <div class="error-404 not-found">

        <div class="page-content">
            <h2 class="page-title"><?php echo esc_html__('404', 'bigmart'); ?><span><?php echo esc_html__('Page Not Found', 'bigmart'); ?></span></h2>
            <p><?php esc_html_e('The page you are looking for might have been removed, had it\'s name changed or is temporarily unavailable.', 'bigmart'); ?><br/><?php esc_html_e('Try going to homepage and look for something else ?', 'bigmart'); ?></p>
            <a href="<?php echo esc_url(get_home_url()); ?>" class="home-pg-btn"><?php esc_html_e('Homepage', 'bigmart'); ?></a>					
        </div>
    </div>

</div>
<?php
get_footer();
