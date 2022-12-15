<?php

/** Comparison Datas */
if (!function_exists('bigmart_comparison_datas')) {

    function bigmart_comparison_datas() {
        return $comparison_datas = array(
            'pre-built' => array(
                'title' => __('Pre-built Starter Sites', 'bigmart'),
                'details' => __('Install any pre-made starter site using a single-click demo
                    installation option', 'bigmart'),
                'free' => __('3', 'bigmart'),
                'pro' => __('6', 'bigmart'),
            ),
            'dynamic-color' => array(
                'title' => __('Dynamic Color Options', 'bigmart'),
                'details' => __('Unlimited color palette to choose from', 'bigmart'),
                'free' => __('Basic', 'bigmart'),
                'pro' => __('Advanced', 'bigmart'),
            ),
            'mega-menu' => array(
                'title' => __('Advanced Mega Menu', 'bigmart'),
                'details' => __('Display beautiful multi-columned drop-down menus', 'bigmart'),
                'free' => 'no',
                'pro' => 'yes',
            ), 
            'ajax-search' => array(
                'title' => __('Ajax/Live Search', 'bigmart'),
                'details' => __('Boost your user experience by providing a user
                    friendly ajax powered search form', 'bigmart'),
                'free' => 'no',
                'pro' => 'yes',
            ),
            'web-layout' => array(
                'title' => __('Website Layout', 'bigmart'),
                'details' => __('Choose between traditional boxed layout or modern
                    wide layout for your site.', 'bigmart'),
                'free' => __('Wide, Boxed', 'bigmart'),
                'pro' => __('Wide, Boxed with more advanced settings', 'bigmart'),
            ),
            'header-layouts' => array(
                'title' => __('Header Layouts', 'bigmart'),
                'details' => __('Three Different Header Layouts to choose from', 'bigmart'),
                'free' => __('Simple', 'bigmart'),
                'pro' => __('Advanced with more customization', 'bigmart'),
            ),
            'footer-layouts' => array(
                'title' => __('Footer Layout Customization', 'bigmart'),
                'details' => __('Easy way to customize width & layout for the website footer', 'bigmart'),
                'free' => 'no',
                'pro' => 'yes',
            ),
            'sticky-sidebar' => array(
                'title' => __('Sticky Sidebar', 'bigmart'),
                'details' => __('Fix the sidebar to its position', 'bigmart'),
                'free' => 'no',
                'pro' => 'yes',
            ),
            'maintainance' => array(
                'title' => __('Maintainance Mode', 'bigmart'),
                'details' => __('Switch to maintainance mode while maintaing the website', 'bigmart'),
                'free' => 'no',
                'pro' => 'yes',
            ),
            'admin-logo' => array(
                'title' => __('Admin Logo Option', 'bigmart'),
                'details' => __('Display custom logo in login page', 'bigmart'),
                'free' => 'no',
                'pro' => 'yes',
            ),
            'page-opt' => array(
                'title' => __('Powerful Page Options', 'bigmart'),
                'details' => __('Packed with advanced page meta options to easily customize inner pages', 'bigmart'),
                'free' => 'no',
                'pro' => 'yes',
            ),
            'preloaders' => array(
                'title' => __('Preloader Options', 'bigmart'),
                'details' => __('Display preloader while loading the website', 'bigmart'),
                'free' => __('1', 'bigmart'),
                'pro' => __('15', 'bigmart'),
            ),
            'typography' => array(
                'title' => __('Typography Options', 'bigmart'),
                'details' => __('Choose from 600+ Google fonts & variations', 'bigmart'),
                'free' => __('Basic', 'bigmart'),
                'pro' => __('Advanced', 'bigmart'),
            ),
            'to-top' => array(
                'title' => __('Custom Scroll to Top Button', 'bigmart'),
                'details' => __('Customize Scroll to top button for easy site navigation', 'bigmart'),
                'free' => 'no',
                'pro' => 'yes',
            ),
            'menu-hover' => array(
                'title' => __('Menu Hover Styles', 'bigmart'),
                'details' => __('Choose from nine available hover styles for the site', 'bigmart'),
                'free' => __('0', 'bigmart'),
                'pro' => __('9', 'bigmart'),
            ),
            'gdpr' => array(
                'title' => __('GDPR Compatible & Customization', 'bigmart'),
                'details' => __('Standardise your webiste to GDPR to make your site
                    trustworthy among your customer', 'bigmart'),
                'free' => 'no',
                'pro' => 'yes',
            ),
            'toggle-menu' => array(
                'title' => __('Advanced Toggle Menu', 'bigmart'),
                'details' => __('Customize Toggle Menu to display intuitive ', 'bigmart'),
                'free' => __('Basic', 'bigmart'),
                'pro' => __('Advanced', 'bigmart'),
            ),
            'menu-cta' => array(
                'title' => __('Menu Call to Action Button', 'bigmart'),
                'details' => __('Dedicated option to display customer engaging Call to
                    Action button in menu', 'bigmart'),
                'free' => 'no',
                'pro' => 'yes',
            ),
            'cus-based' => array(
                'title' => __('Customizer Based', 'bigmart'),
                'details' => __('Preview changes as per you make using live customizer', 'bigmart'),
                'free' => 'yes',
                'pro' => 'yes',
            ),
            'woo' => array(
                'title' => __('WooCommerce Compatible', 'bigmart'),
                'details' => __('Compatible with one of the most popular Ecommerce Plugin in WordPress', 'bigmart'),
                'free' => 'Simple',
                'pro' => 'Advanced',
            ),
            'ele' => array(
                'title' => __('Elementor Compatible', 'bigmart'),
                'details' => __('Customize your website with one of the most popular Sitebuilder plugin in WordPress', 'bigmart'),
                'free' => 'Simple Widgets',
                'pro' => 'Advanced Widgets',
            ),
            'res-des' => array(
                'title' => __('Responsive Design', 'bigmart'),
                'details' => __('Whether handheld devices or wide displays your site will
                    look great', 'bigmart'),
                'free' => 'yes',
                'pro' => 'yes',
            ),
            'rev-slider' => array(
                'title' => __('Revolution Slider', 'bigmart'),
                'details' => __('Integrate Revolution slider to your site', 'bigmart'),
                'free' => 'no',
                'pro' => 'yes',
            ),
            'seo' => array(
                'title' => __('SEO Friendly', 'bigmart'),
                'details' => __('Search Engine will love it', 'bigmart'),
                'free' => 'yes',
                'pro' => 'yes',
            ),
            'rtl' => array(
                'title' => __('RTL Ready', 'bigmart'),
                'details' => __('Supports the languages with RTL nature too', 'bigmart'),
                'free' => 'yes',
                'pro' => 'yes',
            ),
            'wpml' => array(
                'title' => __('WPML Compatible & Translation Ready', 'bigmart'),
                'details' => __('Supports multilingual site and translate into any language
                    of your choice', 'bigmart'),
                'free' => 'yes',
                'pro' => 'yes',
            ),
            'lifetime-update' => array(
                'title' => __('Lifetime Updates', 'bigmart'),
                'details' => __('Regular, lifetime updates', 'bigmart'),
                'free' => 'yes',
                'pro' => 'yes',
            ),
            'child-theme' => array(
                'title' => __('Child Theme Ready', 'bigmart'),
                'details' => __('Supportss Child theme if looking for theme customizations', 'bigmart'),
                'free' => 'yes',
                'pro' => 'yes',
            ),
            'cross-brow' => array(
                'title' => __('Cross-Browser Compatibility', 'bigmart'),
                'details' => __('(IE10+, Chrome, Firefox, Safari, Opera, Edge)', 'bigmart'),
                'free' => 'yes',
                'pro' => 'yes',
            ),
            'support' => array(
                'title' => __('Theme Help & Support', 'bigmart'),
                'details' => __('Fast & Reliable support via our customer friendly support
                    team', 'bigmart'),
                'free' => __('Basic', 'bigmart'),
                'pro' => __('Dedicated', 'bigmart'),
            ),
        );
    }

}