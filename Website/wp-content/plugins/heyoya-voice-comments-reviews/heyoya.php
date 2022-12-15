<?php
/*
Plugin Name: Voice Comments - Heyoya
Plugin URI: https://www.heyoya.com/
Description: Heyoya is a revolutionary voice comments platform that is transforming the way people interact with content online! To get started: 1) Click the "Activate" link to the left of this description, and 2) Go to your Heyoya configuration page, and log in / sign up

Version: 2.2.6
Author: Heyoya <support@heyoya.com>
Author URI: https://www.heyoya.com/
Text Domain: heyoya-voice-comments-reviews
Domain Path: /languages/

*/

require_once(dirname(__FILE__) . '/admin/admin.php');
require_once(dirname(__FILE__) . '/plugin/plugin.php');

function heyoya_login_init( $template )
{
	try{
		if (
				$template !== null && 
				isset($template->request) && 
				(
					$template->request === "heyoya/login" ||
					$template->request === "heyoya/logind"
				)
			){	
			$dir = plugin_dir_path( __FILE__ );
			include_once($dir."plugin/login.php");
			$heyoyaLoginController = new HeyoyaLoginController();
			$heyoyaLoginController -> login($template);

			header("HTTP/1.0 200 OK");
			die();
		}
	} catch(exception $e){
		
	}
}


function add_login_handlers() {
  add_rewrite_rule('^heyoya/login(.*)/?', 'index.php', 'top');  

  global $wp_rewrite;
  $wp_rewrite->flush_rules( false );
}
	
	
try{
	add_filter( 'wp', 'heyoya_login_init', 99 );
	add_action('init', 'add_login_handlers');	
	add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'add_plugin_page_settings_link');
} catch(exception $e){
		
}

function add_plugin_page_settings_link( $links ) {
	$settings_link = sprintf('<a href="' .
		admin_url( 'edit-comments.php?page=heyoya-options' ) .
		'">' . __('Settings') . '</a>');
	
	array_unshift( $links, $settings_link );	
	
	return $links;
}


/*
 * Creating one of 2 classes:
 * 	if we're in the admin panel - creating an instance of the AdminOptionsPage class
 * 	if we're in the frontend - creating an instance of the PluginContainer class 
 */
if( is_admin() ){
	$admin_options_page = new AdminOptionsPage();
	require_once(dirname(__FILE__) . '/admin/notices.php');
	$heyoya_notices = new HeyoyaNotices();	
	require_once(dirname(__FILE__) . '/admin/feedback.php');	
	$heyoya_feedback = new HeyoyaFeedback();	
} else {	
	if( ! function_exists('get_plugin_data') )
		require_once( ABSPATH . '/wp-admin/includes/plugin.php' );    			

	$version = null;
	$pluginData = get_plugin_data( __FILE__);
	if ($pluginData != null && isset($pluginData["Version"]))
		$version = $pluginData["Version"];

	$plugin_container = new PluginContainer($version);	
}


/*
 * This function will check if the user is logged in to the Heyoya admin panel
 */
function is_heyoya_installed() {	
	$options = get_option('heyoya_options', null);	
	
	return  $options != null && isset($options["affiliate_id"]) && strlen($options["affiliate_id"]) > 0 && isset($options["tosa"]) && $options["tosa"] > 0;	
}


?>