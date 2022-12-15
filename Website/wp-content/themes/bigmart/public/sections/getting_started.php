<?php require_once get_template_directory() . '/welcome/inc/promos.php'; ?>
<div class="lets-start">
    <h2><?php esc_html_e("Let's Get Started", "bigmart"); ?></h2>
    <p><?php esc_html_e("Getting use to site building using the theme can be pretty daunting task especially if you are new to the WordPress. Here we have provide you a couple of ways to may familiarize you with the theme.", "bigmart") ?></p>
</div>

<div class="welcome-getting-started">
    <div class="welcome-manual-setup">
        <div class="welcome-manual-setupin">
            <h3><?php echo esc_html__('Manual Setup from Customizer Panel', 'bigmart'); ?></h3>
            <div class="welcome-theme-thumb">
                <img src="https://resources.wpcirqle.com/webp/customizer-settings.webp" alt="<?php echo esc_attr__('Resoto Demo', 'bigmart'); ?>">
            </div>

            <ol>
                <li><?php echo esc_html__('Go to Appearance > Customize', 'bigmart'); ?></li>
                <li><?php echo esc_html__('Click on any of the setting panels & sections.', 'bigmart'); ?> </li>
                <li><?php echo esc_html__('Change the settings and options with the guidance of the documentation.', 'bigmart'); ?> </li>
            </ol>
            <a class="button button-primary" href="<?php echo esc_url(admin_url('customize.php')); ?>"><?php echo esc_html__('Go to Customizer Panels', 'bigmart'); ?></a>
        </div>
    </div>

    <div class="welcome-demo-import">
        <div class="welcome-demo-importin">
            <h3><?php echo esc_html__('Import Pre-Made Demos', 'bigmart'); ?></h3>
            <div class="welcome-theme-thumb">
                <img src="https://resources.wpcirqle.com/webp/demo-import.webp" alt="<?php printf(esc_html__('%s Demo', 'bigmart'), $this->theme_name); ?>">
            </div>

            <div class="welcome-demo-import-text">
                <ol>
                    <li><?php echo esc_html__('Install & Activate \'Swift Demo Import\' plugin.', 'bigmart'); ?></li>
                    <li><?php echo esc_html__('Go to Dashboard > Appearanse > Swift Demo Import.', 'bigmart'); ?> </li>
                    <li><?php echo esc_html__('You will find the list of the demos available for you to install. Now Install the demo of your choice.', 'bigmart'); ?></li>
                </ol>
                <?php
                if (class_exists('SDI_Importer')) {
                    ?>
                    <p><?php esc_html_e('Click the link below and view all the available demos for installation.', 'bigmart'); ?></p>

                    <div class="btn-wrapper">
                        <a class="button success" href="<?php echo esc_url(admin_url('/themes.php?page=sdi-demo-import')); ?>"><?php esc_html_e('View All Demos', 'bigmart'); ?></a>
                    </div>
                    <?php
                } else {
                    $plugin = array(
                        'slug' => 'swift-demo-import',
                        'class' => 'SWFT_Demo_Import',
                        'filename' => 'swift-demo-import.php',
                    );
                    $info = $this->call_plugin_api('swift-demo-import');
                    $icon_url = $this->check_for_icon($info->icons);
                    $plugin_status = $this->get_plugin_status($plugin);
                    $btn_url = $this->generate_plugin_install_btn($plugin_status, $plugin);
                    ?>
                    <p><?php esc_html_e('The plugin allows you to install the demo in one click.', 'bigmart'); ?></p>

                    <div class="btn-wrapper">
                        <?php echo $btn_url; ?>
                    </div>
                    <?php
                }
                ?>

            </div>
        </div>
    </div>
</div>

<div class="welcome-upgrade-wrap">
    <div class="welcome-upgrade-header">
        <h3><?php printf(esc_html__('Bigmart Pro - Premium Version of %s', 'bigmart'), $this->theme_name); ?></h3>
        <p><?php echo sprintf(esc_html__('Check out the websites that you can create with the premium version of the %s Theme. These demos can be imported with just one click in the premium version.', 'bigmart'), $this->theme_name); ?></p>
    </div>

    <div class="upgrade-demo-wrap">
        <?php $promos = bigmart_promos(); ?>

        <?php
            if( !empty( $promos ) ) {
                foreach( $promos as $promo ) {
                    ?>
                    <div class="recommend-plugins">
                        <div class="plug-image">
                            <img src="<?php echo esc_url( $promo['image'] ); ?>" alt="<?php echo esc_attr__('Bigmart Demos', 'bigmart'); ?>">
                        </div>

                        <div class="plug-title-wrap">
                            <div class="plug-title"><?php echo esc_html( $promo['name'] ); ?></div>
                            <div class="plug-btn-wrapper">
                                <a target="_blank" href="<?php echo esc_url( $promo['buy_url'] ); ?>" class="button button-primary"><?php echo esc_html__('Buy Now', 'bigmart'); ?></a>
                                <a target="_blank" href="<?php echo esc_url( $promo['preview_url'] ); ?>" class="button button-primary"><?php echo esc_html__('Preview', 'bigmart'); ?></a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
        ?>
    </div>
</div>

<div class="welcome-upgrade-box">
    <div class="upgrade-box-text">
        <h3><?php echo esc_html__('Upgrade To Bigmart Pro', 'bigmart'); ?></h3>
        <p><?php echo sprintf(esc_html__('%1$s by itself is a powerful tool to Create an engaging Ecommerce website. However, upgrading to pro version will unlock even more possiblities to create more dynamic ecommerce websites.', 'bigmart'), $this->theme_name); ?>
    </div>
    <a class="upgrade-button why-button" href="<?php echo esc_url(admin_url('themes.php?page=bigmart-welcome&section=free_vs_pro')); ?>"><?php esc_html_e('Why Upgrade ?', 'bigmart'); ?></a>
    <a class="upgrade-button" href="https://wpcirqle.com/products/bigmart" target="_blank"><?php esc_html_e('Upgrade Now', 'bigmart'); ?></a>
</div>