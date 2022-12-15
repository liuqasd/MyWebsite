<?php
/*
 * This class is responsible for creating the Heyoya Admin panel
 * Login, signup and admin will be preformed in this class.
 */
class AdminOptionsPage{
	private $loginMethodSiteKeyValue = 'lmsk';
	private $loginMethodUPValue = 'lmup';
	private $adminURL = 'https://admin.heyoya.com/client-admin/rwau.heyoya';

	/*
	 * Class constructor. in it we're attaching the hooks that will render the application 
	 */
	public function __construct(){		
		add_action('admin_menu', array($this, 'heyoya_menu') );		
		add_action('admin_enqueue_scripts', array($this, 'load_admin_scripts') );
		add_action('admin_init', array($this, 'heyoya_admin_init') );
		add_action('admin_head', array($this, 'heyoya_admin_head') );
		add_action( 'wp_ajax_logout', array($this, 'heyoya_logout') );
		add_action( 'wp_ajax_cancel_manual_login', array($this, 'heyoya_cancel_manual_login') );
		add_action( 'wp_ajax_published', array($this, 'heyoya_published') );
		add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ), 1 );
	}
	
	/*
	 * Adding heyoya to the comments menu
	 */
	function heyoya_menu() {
		add_comments_page( 'Heyoya Options', 'Heyoya', 'manage_options', 'heyoya-options', array($this, 'set_heyoya_options') );
	}
	
	public function admin_footer_text( $footer_text ) {
		if (!isset($_GET['page']) || $_GET['page'] !== 'heyoya-options')
			return $footer_text;
		
		return "If you like <strong>\"Voice Comments - Heyoya\"</strong> please leave us a <a target=\"_blank\" href=\"https://wordpress.org/support/plugin/heyoya-voice-comments-reviews/reviews/?rate=5#new-post\">★★★★★</a> rating. A huge thanks in advance!";
	}
	
	/*
	 * Loading client scripts for login and logged in modes.
	 * - report script will report usage statistics to Heyoya servers for bug tracking.
	 * - loggedout script will handle the login and signup modes + validations.
	 * - loggedin script will load the Heyoya admin (in an iframe)
	 * - messaging script will provide the communication layer between the heyoya admin and wordpress.     
	 */
	function load_admin_scripts($hook){
		if ( 'comments_page_heyoya-options' != $hook )
			return;			

		wp_register_script( 'report_script', plugins_url( '/js/report.js', __FILE__ ) );
		wp_enqueue_script( 'report_script', plugins_url( '/js/report.js', __FILE__ ), array( 'jQuery') );
		
		wp_register_script( 'messaging_script', plugins_url( '/js/messaging.js', __FILE__ ) );
		wp_enqueue_script( 'messaging_script', plugins_url( '/js/messaging.js', __FILE__ ) );	
		
		$options = get_option('heyoya_options', null);					
		$initial_login_method = $options != null && isset($options["initial_login_method"])?$options["initial_login_method"]: $this->loginMethodUPValue;
		$login_method = $options != null && isset($options["login_method"])?$options["login_method"]: $this->loginMethodUPValue;

		if (				
				($options != null && isset($options["initial_login_method"]) && $initial_login_method == $this->loginMethodUPValue && !$this->is_heyoya_user_logged_in()) ||
				($options != null && isset($options["initial_login_method"]) && $initial_login_method == $this->loginMethodSiteKeyValue && $options["login_method"] == $this->loginMethodUPValue && !$this->is_heyoya_user_logged_in())
			){		
			wp_register_script( 'loggedout_script', plugins_url( '/js/loggedout.js', __FILE__ ) );
			wp_enqueue_script( 'loggedout_script', plugins_url( '/js/loggedout.js', __FILE__ ), array( 'jQuery') );			
		} else {
			wp_register_script( 'loggedin_script', plugins_url( '/js/loggedin.js', __FILE__ ) );
			wp_enqueue_script( 'loggedin_script', plugins_url( '/js/loggedin.js', __FILE__ ), array( 'jQuery') );
		}
	}		
	
	/*
	 * Logically registering the forms and inputs
	 */
	function heyoya_admin_init(){
		$options = get_option('heyoya_options', null);
		if ($options == null){
			$options = array();
			add_option("heyoya_options", $options);
		}
		
		register_setting( 'heyoya-options', 'heyoya-options', array($this, 'heyoya_options_validate' ));
		add_settings_section('heyoya_login', '', array($this, 'heyoya_section_text'), 'admin-login');
		add_settings_section('heyoya_signup', '', array($this, 'heyoya_section_text'), 'admin-signup');
		
		add_settings_field('login_email', 'Email', array($this, 'admin_email_string'), 'admin-login', 'heyoya_login');
		add_settings_field('login_password', 'Password', array($this, 'admin_password_string'), 'admin-login', 'heyoya_login');

		add_settings_field('signup_fullname', 'Full Name', array($this, 'admin_fullname_string'), 'admin-signup', 'heyoya_signup');
		add_settings_field('signup_email', 'Email', array($this, 'admin_email_string'), 'admin-signup', 'heyoya_signup');
		add_settings_field('signup_password', 'Password', array($this, 'admin_password_string'), 'admin-signup', 'heyoya_signup');		
	}	
	
		
	
	function heyoya_section_text() {
		echo '';
	} 

	/*
	 * Rendering the inputs
	 */
	function admin_email_string() {
		$options = get_option('heyoya_options');
		echo "<input class='login_email' name='heyoya_options[login_email]' size='30' type='text' value='" . (isset($options["login_email"])?$options["login_email"]:"") . "' />";
	}

	/*
	 * Rendering the inputs
	 */	
	function admin_fullname_string() {
		$options = get_option('heyoya_options');
		echo "<input class='signup_fullname' name='heyoya_options[signup_fullname]' size='30' type='text' value='" . (isset($options["signup_fullname"])?$options["signup_fullname"]:"") . "' />";
	}
	
	/*
	 * Rendering the inputs
	 */	
	function admin_password_string() {
		$options = get_option('heyoya_options');
		echo "<input class='login_password' name='heyoya_options[login_password]' size='30' type='password' value='" . (isset($options["login_password"])?$options["login_password"]:"") . "' />";
	}

	/*
	 * Rendering the inputs
	 */	
	function admin_hsi_string() {
		$options = get_option('heyoya_options');		
		echo "<input name='heyoya_options[signup_hsi]' id='heyoya_options[signup_hsi]' type='hidden' value=''/>";
	}

	/*
	 * Rendering the inputs
	 */	
	function admin_hssi_string() {
		$options = get_option('heyoya_options');		
		echo "<input name='heyoya_options[signup_hssi]' id='heyoya_options[signup_hssi]' type='hidden' value=''/>";
	}

	
	/*
	 * Rendering the inputs
	 */	
	function admin_hci_string() {
		$options = get_option('heyoya_options');		
		echo "<input name='heyoya_options[signup_hci]' id='heyoya_options[signup_hci]' type='hidden' value=''/>";
	}

	/*
	 * Rendering the inputs
	 */	
	function admin_hcsi_string() {
		$options = get_option('heyoya_options');		
		echo "<input name='heyoya_options[signup_hcsi]' id='heyoya_options[signup_hcsi]' type='hidden' value=''/>";
	}

	/*
	 * Rendering the inputs
	 */	
	function admin_hclki_string() {
		$options = get_option('heyoya_options');		
		echo "<input name='heyoya_options[signup_hclki]' id='heyoya_options[signup_hclki]' type='hidden' value=''/>";
	}

	/*
	 * Rendering the inputs
	 */	
	function admin_hcpmi_string() {
		$options = get_option('heyoya_options');		
		echo "<input name='heyoya_options[signup_hcpmi]' id='heyoya_options[signup_hcpmi]' type='hidden' value=''/>";
	}

	/*
	 * Rendering the inputs
	 */	
	function admin_hrt_string() {
		$options = get_option('heyoya_options');		
		echo "<input name='heyoya_options[signup_hrt]' id='heyoya_options[signup_hrt]' type='hidden' value=''/>";
	}
	
	
	/*
	 * Main login function, will send a POST login request to the server and pass the response to the login_signup_handle_response method. 
	 */
	function login_user($options, $email, $password){
		if ( $email == null || trim($email) == "" || !is_email($email) || ( ( $password == null || trim($password) == "" ) && ( $options == null || $options["apikey"] == null ) ) )
			return;

		$time = time();		
		$email = trim($email);
		$url = 'https://admin.heyoya.com/client-admin/lwak.heyoya';
		
		$showLoginUsingEmailMessage = isset($options["initial_login_method"]) && $options["initial_login_method"] == $this->loginMethodSiteKeyValue;
		
		if ($password != null){
			$password = trim($password);			
			
			$args = array ("body" => array ("e" => $email,"p" => $password, "sluem" =>$showLoginUsingEmailMessage?1:0, "iwp" => 1,"t" => $time), "sslverify" => false, "timeout" => 60);
			
		} else			
			$args = array('body' => array('e' =>  $email,'ak' => $options["apikey"], "sluem" =>$showLoginUsingEmailMessage?1:0, "iwp" => 1,'t' =>  $time), "sslverify" => false, "timeout" => 60);		
		
		$response = wp_remote_post( $url, $args );	
		
		$options["last_method"] = "login";
		update_option("heyoya_options", $options);
		
		$this->login_signup_handle_response($options, $response, $email, $time);
	}

	/*
	 * site key login function, will send a POST login request to the server and pass the response to the login_signup_handle_response method. 
	 */
	function login_user_site_key($options){
		if ( $options == null || !isset($options["site_key"]) || !isset($options["affiliate_id"]) || trim($options["site_key"]) == "" || trim($options["affiliate_id"]) == "")
			return $this->login_user_site_id($options);

		$time = time();		
		$site_key = trim($options["site_key"]);
		$affiliate_id = trim($options["affiliate_id"]);		
		$url = 'https://admin.heyoya.com/client-admin/lwskafid.heyoya';		
		$args = array('body' => array('sk' =>  $site_key,'af' => $affiliate_id,'t' =>  $time), "sslverify" => false, "timeout" => 60);		
		
		$response = wp_remote_post( $url, $args );	
				
		$this->login_signup_handle_response($options, $response, isset($options["login_email"])?$options["login_email"]:get_option("admin_email", wp_get_current_user()->user_email), $time);
	}

	/*
	 * site id login function, will send a POST login request to the server and pass the response to the login_signup_handle_response method. 
	 */
	function login_user_site_id($options){
		if ($options == null){
			$options = array();			
			add_option("heyoya_options", $options);
		}
		
		if (!isset($options["site_id"]) || trim($options["site_id"]) == ""){
			$options["site_id"] = $this->get_site_id();
			update_option("heyoya_options", $options);
		}						

		$time = time();		
		$site_id = trim($options["site_id"]);
		$email = null;
		$name = null;
		try{
			$email = get_option("admin_email", null);			
			$current_user = wp_get_current_user();
			if (isset($current_user) && 0 != $current_user->ID){
				if (!isset($email))
					$email = $current_user->user_email;
				$name = $current_user->display_name;					
				if ( (isset($current_user->user_firstname) && trim($current_user->user_firstname) != "") || 
						(isset($current_user->user_lastname) && trim($current_user->user_lastname) != "")){
					$firstNameAdded = false;
					if (isset($current_user->user_firstname) && trim($current_user->user_firstname) != ""){
						$firstNameAdded = true;
						$name = $current_user->user_firstname;
					}
					
					if (isset($current_user->user_lastname) && trim($current_user->user_lastname) != ""){
						if ($firstNameAdded)
							$name .= " " . $current_user->user_lastname;
						else
							$name = $current_user->user_lastname;							
					}
				}					
			}
 		} catch (Exception $e) {
			$email = null;
			$name = null;
		}
		
		if (isset($email) && !isset($name)){
			$name = get_option("blogname", null);
		}
		
		if (!isset($email) || !isset($name)){
			$options["error_raised"] = true;
			$options["error_code"] = -10;
			update_option("heyoya_options", $options);
			return;					
		}
		
		$url = 'https://admin.heyoya.com/client-admin/lwpsidafid.heyoya';		

		$args = array('body' => array('si' =>  $site_id, 'e' => $email, 'fn' => $name,'t' =>  $time), "sslverify" => false, "timeout" => 60);		
		
		$response = wp_remote_post( $url, $args );	
				
		$this->login_signup_handle_response($options, $response, $email, $time);
	}

	
	
	/*
	 * Main signup function, will send a POST signup request to the server and pass the response to the login_signup_handle_response method. 
	 */
	function signup_user($options, $fullname, $email, $password, $_hsi, $_hssi, $_hclki, $_hcpmi, $_hrt, $_hci, $_hcsi){
		if ( $email == null || trim($email) == "" || !is_email($email) || $fullname == null || trim($fullname) == "" || $password == null || trim($password) == "" )
			return;							

		$email = trim($email);
		$password = trim($password);			
		$fullname = trim($fullname);
		$time = time(); 		
		$_hsi = trim($_hsi);
		$_hssi = trim($_hssi);
		$_hclki = trim($_hclki);
		$_hcpmi = trim($_hcpmi);
		$_hrt = trim($_hrt);
		$_hci = trim($_hci);
		$_hcsi = trim($_hcsi);
		if (trim($_hci) == "")
			$_hci = "wordpress";
		else  if (trim($_hcsi) == "")
			$_hcsi = "wordpress";

		$url = 'https://admin.heyoya.com/client-admin/rwak.heyoya';
		$args = array('body' => array('e' => $email,'p' => $password,'n' => $fullname, 'hsi' => $_hsi, 'hssi' => $_hssi, 'hclki' => $_hclki, 'hcpmi' => $_hcpmi, 'hrt' => $_hrt, 'hci' => $_hci, 'hcsi' => $_hcsi, "iwp" => 1, 't' => $time), "sslverify" => false, "timeout" => 60);
		
		$response = wp_remote_post( $url, $args );

		$options["last_method"] = "signup";
		
		$this->login_signup_handle_response($options, $response, $email, $time);
	}



	/*
	 * Login/signup response method.
	 * Check the response code and body for errors and associate the user if the resposne is valid.
	 */	
	function login_signup_handle_response($options, $response, $email, $last_login_time){
		if ($response == null || $email == null || !is_email($email) || $last_login_time == null){
			$options["error_raised"] = true;
			$options["error_code"] = -1;
			update_option("heyoya_options", $options);				
			return;
		}	
		
		$response_code = wp_remote_retrieve_response_code($response);
		if ($response_code == "" || $response_code != 200){
			$options["error_raised"] = true;
			$options["error_code"] = -1;
			update_option("heyoya_options", $options);
			return;
		}
		
		$body = wp_remote_retrieve_body( $response );
		if ($body == null || trim($body) == "" || preg_match('/^-[0-9]{1}$/i', trim($body))){			
			$options["error_raised"] = true;			
			
			if ($body == null || trim($body) == "")
				$options["error_code"] = -1;
			else  	
				$options["error_code"] = intval(trim($body));
						
			update_option("heyoya_options", $options);
			return;
		}		

		$body_response = json_decode($body, true);
		
		if (isset($body_response["ai"])){
			if (isset($options["last_method"]) &&  $options["last_method"] == "login"){
				$options = get_option('heyoya_options', array());
			}
				
			$options["affiliate_id"] = $body_response["ai"];
			if ($options["affiliate_id"] == "null")
				$options["affiliate_id"] = null;
		}
		
		if (isset($body_response["ak"]))
			$options["apikey"] = $body_response["ak"];
		
		if (isset($body_response["sk"]))
			$options["site_key"] = $body_response["sk"];
		
		if (isset($body_response["tosa"]))
			$options["tosa"] = $body_response["tosa"];
		
		$options["login_email"] = $email;
		$options["last_login_time"] = $last_login_time;				
		
		update_option("heyoya_options", $options);
	}	
	
	/*
	 * Main validation function.
	 * Server validation for the login and signup forms 
	 */
	function heyoya_options_validate() {
		$input = $_POST["heyoya_options"];
		$options = get_option('heyoya_options');			
		
		if ($input == null || !isset($input["login_email"]) || !is_email(trim($input["login_email"])) || ( ( !isset($input["signup_fullname"]) || trim($input["signup_fullname"]) == "" ) && ( !isset($input["login_password"]) || trim($input["login_password"]) == "" ) ) ){
			update_option("heyoya_options", $options);
			return;				
		}
		
		if ( !isset($input["signup_fullname"]) || trim($input["signup_fullname"]) == "" ){
			$this->login_user( $options, trim($input["login_email"]), trim($input["login_password"]) );			
			return;
		} 			
		
		$this->signup_user($options, trim($input["signup_fullname"]), trim($input["login_email"]), trim($input["login_password"]), trim($input["_hsi"]), trim($input["_hssi"]), trim($input["_hclki"]), trim($input["_hcpmi"]), trim($input["_hrt"]), trim($input["_hci"]), trim($input["_hcsi"]));		
		return;		
	}
	
	/*
	 * Heyoya logout callback listener
	 * Once executed, will empty the Heyoya options object. 
	 */
	function heyoya_logout(){
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}		
		
		echo "1";
		
		$options = get_option('heyoya_options', null);
		if ($options == null){
			exit();
			return;		
		}
		
		
		if (isset($options["apikey"]))
			$options["apikey"] = null;
		
		if (isset($options["site_key"]))
			$options["site_key"] = null;
		
		if (isset($options["login_email"]))
			$options["login_email"] = null;
		
		if (isset($options["last_login_time"]))
			$options["last_login_time"] = null;
		
		if (isset($options["last_method"]))
			$options["last_method"] = null;
		
		if (isset($options["initial_login_method"]) &&  $options["initial_login_method"] == $this->loginMethodSiteKeyValue){			
			if (isset($options["login_method"]) &&  $options["login_method"] != $this->loginMethodSiteKeyValue)
				$options["login_method"] = $this->loginMethodSiteKeyValue;
			else 
				$options["login_method"] = $this->loginMethodUPValue;						
		}
	
		update_option("heyoya_options", $options);

		exit();
	}
	
	function heyoya_cancel_manual_login(){
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}		
		
		echo "1";

		$options = get_option('heyoya_options', null);
		if ($options == null){
			exit();
			return;		
		}
		
		if (isset($options["initial_login_method"]) &&  $options["initial_login_method"] != $this->loginMethodSiteKeyValue){
			exit();
			return;		
		}
		
		$options["login_method"] = $this->loginMethodSiteKeyValue;	
		update_option("heyoya_options", $options);

		exit();
	}
	
	/*
	 * Heyoya published callback listener	 
	 */
	function heyoya_published(){
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}		
		
		echo "1";
		
		$options = get_option('heyoya_options', null);
		if ($options == null){
			$options = array();
			add_option("heyoya_options", $options);
		}

		$options["tosa"] = time();
		update_option("heyoya_options", $options);

		exit();
	}


	/*
	 * Main UI rendering method.
	 * Will check if the user is logged in.
	 * If so, will load the Heyoya admin panel
	 * Otherwise will render login and signup dialogs. 
	 */	
	function set_heyoya_options() {
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}		
		
		$login_method = $this->setDefaultLoginMethod();

		if ( isset($login_method) && $login_method == $this->loginMethodSiteKeyValue )
			$this->load_sitekey_login_flow();
		else 
			$this->load_up_login_flow();			
	}
	
	
	function load_up_login_flow(){
		$session_valid = false;
		$error_raised = false;
		$error_code = 0;
		$last_method = "login";
		$options = get_option('heyoya_options', null);
		
		if ($options != null && isset($options["error_raised"]) && $options["error_raised"] == true && isset($options["error_code"]) && trim($options["error_code"]) != "" && isset($options["last_method"])){
			
				
			$error_raised = true;
			$last_method = $options["last_method"];
			$error_code = $options["error_code"];

			$options["error_raised"] = false;
			$options["last_method"] = null;
			$options["error_code"] = null;
			
			update_option("heyoya_options", $options);			
		}
		
		if (!$error_raised && ($options != null && isset($options["last_login_time"]) && is_numeric($options["last_login_time"]))){
			$last_login_time = intval($options["last_login_time"], 10);
			if ( (time() - $last_login_time) < 10800 )
				$session_valid = true;
		}	
		
		$is_heyoya_installed = $this->is_heyoya_user_logged_in();
		
		if (!$error_raised && $is_heyoya_installed && !$session_valid){						
			$session_valid = true;
			$this->login_user($options, $options["login_email"], null);			
			$options = get_option('heyoya_options', null);					
			
			if ($options != null && isset($options["error_raised"]) && $options["error_raised"] == true){
				if (isset($options["apikey"]))
					$options["apikey"] = null; 
				
				
				$session_valid = false;
 				$error_raised = true;
				$last_method = "login";
 				
				$error_code = -1000 + intval(trim($options["error_code"]));
					
				$options["error_raised"] = false;
				$options["last_method"] = null;
				$options["error_code"] = null;
				
				update_option("heyoya_options", $options);
			}

			$is_heyoya_installed = $this->is_heyoya_user_logged_in();
		} 

		$siteKeyClassAddition = "";
		if (isset($options["initial_login_method"]) &&  $options["initial_login_method"] == $this->loginMethodSiteKeyValue)
			$siteKeyClassAddition = "site-key";
		
		if (!$is_heyoya_installed || $error_raised || !$session_valid){
			//echo '<pre>'; print_r($options); echo '</pre>';
		?>
		<div id="heyoyaAdmin" class="<?php echo $siteKeyClassAddition ?>">
			<div id="heyoyaSignUpDiv" class="<?php echo $last_method != "login"?"":"invisible" ?>">
				<h2>Create Heyoya Account</h2>				
				<div class="updated <?php echo $error_raised && $error_code != 0?"":"invisible" ?>">
					<p>
						<span class="invisible email_invalid">Email address is <strong>invalid</strong></span>
						<span class="invisible email_missing">Email address is <strong>required</strong></span>
						<span class="invisible name_missing">Name is <strong>required</strong></span>
						<span class="invisible password_missing">Password is <strong>required</strong></span>
						<span class="<?php echo ($error_raised && ($error_code == -1 || $error_code == -4))?"":"invisible" ?> general_error">An error has occurred, please try again in a few seconds</span>
						<span class="<?php echo ($error_raised && $error_code == -2)?"":"invisible" ?> general_error">Please make sure to fill the fields below</span>
						<span class="<?php echo ($error_raised && $error_code == -3)?"":"invisible" ?> general_error">Email already exists</span>						
					</p>																
				</div>
				<form action="options.php" method="post">
				<?php settings_fields('heyoya-options'); ?>
				<?php do_settings_sections('admin-signup'); ?>
		 
				<input class="button-primary button" name="Submit" type="submit" value="<?php esc_attr_e('Create account'); ?>"  original_value="<?php esc_attr_e('Create account'); ?>" /><span class="alternate">Already registered?&nbsp;&nbsp;<a id="login">Log in!</a></span>
				<br /><br />
				By creating an account I accept the <a target="_blank" href="https://www.heyoya.com/termsOfUse.html">Terms of Use</a> and recognize that a 'Powered by Heyoya' link will appear on the bottom of my Heyoya widget.				
				</form>
			</div> 
			<div id="heyoyaLoginDiv" class="<?php echo $last_method == "login"?"":"invisible" ?>">
				<h2>Login with your Heyoya account</h2>			
				<div class="updated <?php echo $error_raised && $error_code != 0?"":"invisible" ?>">
					<p>
						<span class="invisible email_invalid">Email address is <strong>invalid</strong></span>
						<span class="invisible email_missing">Email address is <strong>required</strong></span>
						<span class="invisible password_missing">password is <strong>required</strong></span>
						<span class="<?php echo ($error_raised && ($error_code == -1 || $error_code == -4))?"":"invisible" ?> general_error">Email or password are incorrect</span>
						<span class="<?php echo ($error_raised && $error_code == -2)?"":"invisible" ?> general_error">Please make sure to fill the fields below</span>
						<span class="<?php echo ($error_raised && $error_code == -5)?"":"invisible" ?> general_error">An error has occurred, please try again in a few seconds</span>
					</p>
				</div>
				<form action="options.php" method="post">
				<?php settings_fields('heyoya-options'); ?>
				<?php do_settings_sections('admin-login'); ?>
				<input class="button-primary button" name="Submit" type="submit" value="<?php esc_attr_e('Log in'); ?>" original_value="<?php esc_attr_e('Log in'); ?>" />
				<span class="alternate">No account?&nbsp;&nbsp;<a id="createAccount">Sign up!</a></span>											
				</form>
			</div> 
			<div id="cancelManualLoginContainer">I'm not interested in manual login, <a href="javascript:void(0)" id="cancelManualLoginButton">cancel manual login mode</a></div>
		</div>
		
		<script type="text/javascript">
			var heyoyaErrorCode = <?php echo $error_code ?>; 
		</script>
		
		<?php } else { 
			$this->report_admin_url();
		//	echo '<pre>'; print_r($options); echo '</pre>';
			?>
			<div id="heyoyaContainer" aa="<?php echo $options["apikey"] ?>"></div>
		<?php }

	}
	
	function load_sitekey_login_flow(){
		$error_raised = false;
		$error_code = 0;	

		$this->generate_site_key_and_login();
		$options = get_option('heyoya_options', null);					
		if ($options != null && isset($options["error_raised"]) && $options["error_raised"] == true && isset($options["error_code"]) && trim($options["error_code"]) != ""){
	
			$error_raised = true;
			$error_code = $options["error_code"];

			$options["error_raised"] = false;
			$options["error_code"] = null;			
			update_option("heyoya_options", $options);			
		}
		
		$is_heyoya_installed = $this->is_heyoya_user_logged_in();		
		if (!$is_heyoya_installed || $error_raised){
			//echo '<pre>'; print_r($options); echo '</pre>';
		?>
		<div id="heyoyaAdmin">
			<div id="heyoyaKeyLoginError">
				<h2>Something went wrong</h2>				
				<div>Oops.. We couldn't load the settings panel.</div>
				<div>We'll be right back, so please try again in a few minutes</div>
			</div> 
		</div>				
		<?php } else { 
			$this->report_admin_url();
		
		//	echo '<pre>'; print_r($options); echo '</pre>';
			?>
			<div id="heyoyaContainer" aa="<?php echo $options["apikey"] ?>"></div>
		<?php }
		
	}
	
	
	/*
	 * Adding the Heyoya css file to the page head node.  
	 */	
	function heyoya_admin_head(){
		if (isset($_GET['page']) && $_GET['page'] == 'heyoya-options') {?>
		<link rel='stylesheet' href='<?php echo esc_url( plugins_url( 'css/admin.css', __FILE__ ) ); ?>' type='text/css' />
	<?php }
	}
	
	function setDefaultLoginMethod(){			
		$login_method = $this->loginMethodUPValue;

		try{

			$options = get_option('heyoya_options', null);
			if ($options == null){
				$options = [];
				add_option("heyoya_options", $options);
			}
			
			if (isset($options["login_method"])){
				$login_method = $options["login_method"];
			} else {				
				$login_method = $this->loginMethodSiteKeyValue;
				$initial_login_method = $this->loginMethodSiteKeyValue;
				if ( array_key_exists("apikey", $options) || array_key_exists("affiliate_id", $options) || array_key_exists("last_method", $options)){	
					$login_method = $this->loginMethodUPValue;
					$initial_login_method = $this->loginMethodUPValue;
				}
				
				$options["login_method"] = $login_method;
				$options["initial_login_method"] = $initial_login_method;
				
				update_option("heyoya_options", $options);
			}
			
 		} catch (Exception $e) {
			$login_method = loginMethodUPValue;
		}
						
		return $login_method;
	}
		
	function generate_site_key_and_login(){
		$options = get_option('heyoya_options', null);
		if ($options == null){
			$options = array();			
			add_option("heyoya_options", $options);
		}		
				
		if (isset($options["site_key"]) && trim($options["site_key"]) != "" && isset($options["affiliate_id"]) && trim($options["affiliate_id"]) != ""){
			return $this->login_user_site_key($options);
		}
		
		if (!isset($options["site_id"]) || trim($options["site_id"]) == ""){
			$site_id = $this->get_site_id();
			$options["site_id"] = $site_id;
			update_option("heyoya_options", $options);
		}
				
		return $this->login_user_site_id($options);						
	}

	function is_heyoya_user_logged_in() {					
		$options = get_option('heyoya_options', null);	
		if ($options == null)
			return false;
		
		if(isset($options["login_method"]))
			$login_method = $options["login_method"];
		else 
			$login_method = $this->loginMethodUPValue;
	
		return  ($login_method == $this->loginMethodUPValue && isset($options["apikey"]) && trim($options["apikey"]) != "") || 
				($login_method == $this->loginMethodSiteKeyValue && isset($options["site_key"]) && trim($options["site_key"]) != "") ;	
	}
	
	function get_site_id(){
		$options = get_option('heyoya_options', null);	
		if ($options != null && isset($options["site_id"]) && trim($options["site_id"]) != "")
			return $options["site_id"];
			
		return current_time("timestamp", true) . str_replace('.','',uniqid('', true)) . str_replace('.','',uniqid('', true));		
	}

	function report_admin_url(){		
		$options = get_option('heyoya_options', null);	
		if ($options == null ||	!isset($options["apikey"]) || trim($options["apikey"]) == "")				
			return;			
		
		$time = time();				
		
		try {						
			$args = array ("body" => array ("ak" => $options["apikey"], "wau" => admin_url(),"t" => $time), "sslverify" => false, "timeout" => 60);
			
			$response = wp_remote_post( $this->adminURL, $args );	
			
			if ($response == null)
				return;
			
			$response_code = wp_remote_retrieve_response_code($response);		
			if ($response_code == "" || $response_code != 200)
				return;						
			
			$options["last_au"] = $time;	
			update_option("heyoya_options", $options);			
			
		} catch (Exception $e) {

		}								
	}

}
?>