<?php

function pridmag_enqueue_admin_scripts( $hook ) {
    if ( 'appearance_page_about-pridmag-theme' != $hook ) {
        return;
    }
    wp_register_style( 'pridmag-admin-css', get_template_directory_uri() . '/inc/dashboard/css/admin.css', false, '1.0.0' );
    wp_enqueue_style( 'pridmag-admin-css' );
}
add_action( 'admin_enqueue_scripts', 'pridmag_enqueue_admin_scripts' );

/**
 * Add admin notice when active theme
 */
function pridmag_admin_notice() {
    ?>
    <div class="updated notice notice-info is-dismissible">
        <p><?php esc_html_e( 'Welcome to PridMag! To get started with PridMag please visit the theme Welcome page.', 'pridmag' ); ?></p>
        <p><a class="button" href="<?php echo esc_url( admin_url( 'themes.php?page=about-pridmag-theme' ) ); ?>"><?php esc_html_e( 'Get Started with PridMag', 'pridmag' ) ?></a></p>
    </div>
    <?php
}


function pridmag_activation_admin_notice(){
    global $pagenow;
    if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
        add_action( 'admin_notices', 'pridmag_admin_notice' );
    }
}
add_action( 'load-themes.php',  'pridmag_activation_admin_notice'  );


function pridmag_add_themeinfo_page() {

    // Menu title can be displayed with recommended actions count.
    $menu_title = esc_html__( 'PridMag Theme', 'pridmag' );

    add_theme_page( esc_html__( 'PridMag Theme', 'pridmag' ), $menu_title , 'edit_theme_options', 'about-pridmag-theme', 'pridmag_themeinfo_page_render' );

}
add_action( 'admin_menu', 'pridmag_add_themeinfo_page' );

function pridmag_themeinfo_page_render() { ?>

    <div class="wrap about-wrap">

        <?php $theme_info = wp_get_theme(); ?>

        <h1><?php esc_html_e( 'Welcome to PridMag', 'pridmag' ); ?></h1>

        <p><?php echo esc_html( $theme_info->get( 'Description' ) ); ?></p>
    
        <h2 class="nav-tab-wrapper">
            <a class="nav-tab <?php if ( $_GET['page'] == 'about-pridmag-theme' && ! isset( $_GET['tab'] ) ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'about-pridmag-theme' ), 'themes.php' ) ) ); ?>">
                <?php esc_html_e( 'PridMag', 'pridmag' ); ?>
            </a>
            <a class="nav-tab <?php if ( isset( $_GET['tab'] ) && $_GET['tab'] == 'magazine_homepage' ) echo 'nav-tab-active'; ?>" href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'about-pridmag-theme', 'tab' => 'magazine_homepage' ), 'themes.php' ) ) ); ?>">
                <?php esc_html_e( 'Magazine Homepage', 'pridmag' ); ?>
            </a>
        </h2>

        <?php

        $current_tab = ! empty( $_GET['tab'] ) ? sanitize_title( $_GET['tab'] ) : '';

        if ( $current_tab == 'magazine_homepage' ) {
            pridmag_magazine_make_guide();
        } else {
            pridmag_admin_welcome_page();
        }

        ?>

    </div><!-- .wrap .about-wrap -->

    <?php

}

function pridmag_admin_welcome_page() { ?>
    <div class="th-dashboard-wrapper">
        <div class="th-dashboard-box">
            <div class="th-dashboard-box-inner">
                <h3><?php esc_html_e( 'Theme Documentation', 'pridmag' ); ?></h3>
                <p><?php esc_html_e( 'Need to learn all about PridMag? Or do you want to make your site look like the demo? If so please read the theme documentation carefully.', 'pridmag' ) ?></p>
                <a class="button" target="_blank" href="<?php echo esc_url( 'https://themezhut.com/pridmag-wordpress-theme-documentation/' ); ?>"><?php esc_html_e( 'Read the documentation.','pridmag' ); ?></a>
            </div>
        </div>
        <div class="th-dashboard-box">
            <div class="th-dashboard-box-inner">
                <h3><?php esc_html_e( 'Theme Customizer', 'pridmag' ); ?></h3>
                <p><?php esc_html_e( 'All the PridMag theme settings are located at the customizer. Start customizing your website with customizer.', 'pridmag' ) ?></p>
                <a class="button" target="_blank" href="<?php echo esc_url( admin_url( '/customize.php' ) ); ?>"><?php esc_html_e( 'Go to customizer','pridmag' ); ?></a>
            </div>
        </div>
        <div class="th-dashboard-box">
            <div class="th-dashboard-box-inner">
                <h3><?php esc_html_e( 'Theme Info', 'pridmag' ); ?></h3>
                <p><?php esc_html_e( 'Know all the details about PridMag theme.', 'pridmag' ) ?></p>
                <a class="button" target="_blank" href="<?php echo esc_url( 'https://themezhut.com/themes/pridmag/' ); ?>"><?php esc_html_e( 'Theme Details.','pridmag' ); ?></a>
            </div>
        </div>
        <div class="th-dashboard-box">
            <div class="th-dashboard-box-inner">
                <h3><?php esc_html_e( 'Theme Demo', 'pridmag' ); ?></h3>
                <p><?php esc_html_e( 'See the theme preview of free version.', 'pridmag' ) ?></p>
                <a class="button" target="_blank" href="<?php echo esc_url( 'https://themezhut.com/demo/pridmag/' ); ?>"><?php esc_html_e( 'Theme Preview','pridmag' ); ?></a>    
            </div>
        </div>   
    </div> 
    <?php
}

function pridmag_magazine_make_guide() {

    if ( 'posts' == get_option( 'show_on_front' ) ) {
        
        pridmag_template_box( 'posts' );

        pridmag_static_page_box();

    }

    if ( 'page' == get_option( 'show_on_front' ) ) {
        
        $frontpage_id = get_option( 'page_on_front' );

        $frontpage_slug = get_page_template_slug( $frontpage_id );

        if ( $frontpage_slug != 'template-magazine.php' ) {
            pridmag_template_box( 'page' );
        } else {
            ?>
            <p>
                <?php
                    esc_html_e( 'Congratulations...! You have activated a magazine front page successfully. Now start adding posts widgets to magazine widget areas. Magazine widget areas are Featured Content Area, Magazine Top Content, Magazine Mid Left Content, Magazine Mid Right Content and Magazine Bottom Content.', 'pridmag' );
                ?>
            </p>
            <a class="button" target="_blank" href="<?php echo esc_url( admin_url( '/widgets.php' ) ); ?>"><?php esc_html_e( 'Go to Widgets Area','pridmag' ); ?></a>
            <?php
        }

    }

}

function pridmag_static_page_box() { 
    ?>
    <div class="th-required-box">
        <h3 class="th-reqbox-heading"><?php esc_html_e( 'Select "A Static page" option for the setting "Front Page Displays"', 'pridmag' ) ?></h3>
        <p class="th-reqbox-desc">
            <?php
                esc_html_e( 'Select the page that has "Magazine Template" template as the front page .', 'pridmag' );
            ?>
        </p> 
        <a class="button" target="_blank" href="<?php echo esc_url( admin_url('options-reading.php') ); ?>"><?php esc_html_e( 'Select front page.','pridmag' ); ?></a>
    </div>
    <?php
}

function pridmag_template_box( $case ) {
    ?>
    <div class="th-required-box">
        
        <?php  
        if ( $case == 'page' ) : ?>
            <h3 class="th-reqbox-heading"><?php esc_html_e( 'Select the "Magazine Template" page template for the front page.', 'pridmag' ) ?></h3>
            <p>
                <?php esc_html_e( 'Go to the edit screen of the front page. Then select the Template - "Magazine Template" from "Page Attributes" dialog box.', 'pridmag' ); ?>
            </p>
            <?php
            $frontpage_id = get_option( 'page_on_front' ); ?>
            <a href="<?php echo get_edit_post_link( $frontpage_id ); ?>" class="button" target="_blank"><?php esc_html_e( 'Change front page template', 'pridmag' ); ?></a>
        <?php elseif ( $case == 'posts' ) : ?>
            <h3 class="th-reqbox-heading"><?php esc_html_e( 'Create a page that has "Magazine Template" page template.', 'pridmag' ) ?></h3>
            <p class="th-reqbox-desc">
                <ol>
                    <li><?php esc_html_e( 'First create a page to display on front page. Give any title for that page. ( eg: Home )', 'pridmag' ); ?></li>
                    <li><?php esc_html_e( 'Then from the "Page Attributes" dialog box select the Template-"Magazine Template"', 'pridmag' ); ?></li>
                </ol>
            </p> 
            <a class="button" target="_blank" href="<?php echo esc_url( admin_url('post-new.php?post_type=page') ); ?>"><?php esc_html_e( 'Create a page.','pridmag' ) ?></a>
        <?php endif; ?>
    
    </div>
    <?php
}