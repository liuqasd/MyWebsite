<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Fameup
 */
?>
</div>
</main>
<?php 
do_action('fameup_action_footer_missed_section');
?><!--==================== FOOTER AREA ====================-->
    <?php $fameup_footer_widget_background = get_theme_mod('fameup_footer_widget_background');
    $fameup_footer_overlay_color = get_theme_mod('fameup_footer_overlay_color'); 
   if($fameup_footer_widget_background != '') { ?>
    <footer style="background-image:url('<?php echo esc_url($fameup_footer_widget_background);?>');">
     <?php } else { ?>
    <footer> 
    <?php } ?>
        <div class="overlay" style="background-color: <?php echo esc_html($fameup_footer_overlay_color);?>;">
                <!--Start bs-footer-widget-area-->
                <?php if ( is_active_sidebar( 'footer_widget_area' ) ) { ?>
                <div class="bs-footer-widget-area">
                    <div class="container">
                        <div class="row">
                          <?php  dynamic_sidebar( 'footer_widget_area' ); ?>
                        </div>
                        <!--/row-->
                    </div>
                    <!--/container-->
                </div>
                 <?php } $fameup_footer_layout = get_theme_mod('fameup_footer_layout','footer-default');
                  if($fameup_footer_layout == 'footer-default'){
                  ?>
                <div class="bs-footer-widget-area">
                    <div class="container">
                        <div class="row">
                          <!--col-md-3-->
				              <?php do_action('fameup_action_footer_social_section'); ?>
              				<!--/col-md-3-->
                        </div>
                        <!--/row-->
                    </div>
                    <!--/container-->
                </div>
                <!--End bs-footer-widget-area-->

                <div class="bs-footer-copyright">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <p>
                                <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'fameup' ) ); ?>">
                                <?php
                                /* translators: placeholder replaced with string */
                                printf( esc_html__( 'Proudly powered by %s', 'fameup' ), 'WordPress' );
                                ?>
                                </a>
                                <span class="sep"> | </span>
                                <?php
                                /* translators: placeholder replaced with string */
                                printf( esc_html__( 'Theme: %1$s by %2$s.', 'fameup' ), 'Fameup', '<a href="' . esc_url( __( 'https://themeansar.com/', 'fameup' ) ) . '" rel="designer">Themeansar</a>' );
                                ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div> 
              <?php } elseif($fameup_footer_layout == 'footer-insta') { ?>
              <div class="bs-footer-copyright">
                 <div class="container">
                    <div class="row d-flex-space">
                       <div class="col-md-4 footer-inner"> 
                          <div class="copyright ">
                             <p>
                                <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'fameup' ) ); ?>">
                                <?php
                                /* translators: placeholder replaced with string */
                                printf( esc_html__( 'Proudly powered by %s', 'fameup' ), 'WordPress' );
                                ?>
                                </a>
                                <span class="sep"> | </span>
                                <?php
                                /* translators: placeholder replaced with string */
                                printf( esc_html__( 'Theme: %1$s by %2$s.', 'fameup' ), 'Fameup', '<a href="' . esc_url( __( 'https://themeansar.com/', 'fameup' ) ) . '" rel="designer">Themeansar</a>' );
                                ?>
                                </p>
                          </div>  
                       </div>
                       <div class="col-md-4">
                        <div class="footer-logo">
                               <?php the_custom_logo(); ?>
                              <div class="site-branding-text">
                              <h1 class="site-title"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                              <p class="site-description"><?php bloginfo('description'); ?></p>
                              </div>
                        </div>
                      </div>

                      <div class="col-md-4">
                         <?php do_action('fameup_action_footer_social_section'); ?>   
                      </div>
                    </div>
                 </div>
              </div>
            <?php } ?>

            </div>
            <!--/overlay-->
        </footer>
        <!--/footer-->
    <!--/wrapper-->
    <!--Scroll To Top-->
    <?php fameup_scrolltoup(); ?>
    <!--/Scroll To Top-->
<!-- /Scroll To Top -->
<?php wp_footer(); ?>
</body>
</html>