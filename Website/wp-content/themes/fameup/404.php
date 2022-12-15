<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Fameup
 */
get_header(); ?>

  <!--==================== main content section ====================-->
  <div id="content" class="container">
  <!--container--> 
    <!--row-->
    <div class="row"> 
      <?php get_template_part('index','banner'); ?>
      <!--container-->
      <div class="col-md-12 text-center bs-section"> 
        <!--mg-error-404-->
        <div class="bs-error-404">
          <h1><?php esc_html_e('4','fameup'); ?><i class="fa fa-ban"></i>4</h1>
          <h4><?php esc_html_e('Oops! Page not found','fameup'); ?></h4>
          <p><?php esc_html_e("We are sorry, but the page you are looking for does not exist.","fameup"); ?></p>
          <a href="<?php echo esc_url(home_url());?>" onClick="history.back();" class="btn btn-theme"><?php esc_html_e('Go Back','fameup'); ?></a> </div>
        <!--/mg-error-404--> 
      </div>
      <!--/col-md-12--> 
    </div>
    <!--/row--> 
  <!--/container-->
</div>
<?php
get_footer();