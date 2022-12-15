<?php
class HeyoyaLoginController{	
	private $outputResponse = "{\"il\": #IL-VALUE#, \"c\": \"#C-VALUE#\"}";			
	public function __construct(){
		
	}
	
	private function loginWindow($template){					
		$loginResponse = "-5000";
		try{
			$redirect = "/heyoya/login/";		
			if (!is_user_logged_in()){
				wp_redirect( wp_login_url($redirect) );
				die();
			}
				
			$current_user = wp_get_current_user();
			if ( 0 == $current_user->ID ) {
				wp_redirect( wp_login_url($redirect) );					
				die();
			}
			
			$loginResponse =  $this -> createAuthRequest($current_user->user_email, $current_user->user_firstname, $current_user->user_lastname, $current_user->display_name);
		} catch(exception $e){
			$loginResponse = "-5001";
		} 
		include_once(plugin_dir_path( __FILE__ )."views/login_output.php");
	}
	
	private function loginRequest($template){		
		try{			
			if (!is_user_logged_in()){
				echo $this -> getLoggedOutString();
				die();
			}
				
			$current_user = wp_get_current_user();
			if ( 0 == $current_user->ID ) {
				echo $this -> getLoggedOutString();
				die();
			}			
			
			$loginResponse =  $this -> createAuthRequest($current_user->user_email, $current_user->user_firstname, $current_user->user_lastname, $current_user->display_name);
		} catch(exception $e){
			$loginResponse = "-5000";
		} 
		
		if (is_numeric($loginResponse))
			echo $this -> getLoggedOutString();
		else
			echo $this -> generateLoggedInString($loginResponse);

		die();		
	}
	
	private function createAuthRequest($email, $firstName, $lastName, $displayName){
		if ( $email == null || trim($email) == "" || !is_email($email) || 
			( 
				($firstName == null || trim($firstName) == "") &&
				($lastName == null || trim($lastName) == "") &&
				($displayName == null || trim($displayName) == "")
			) 
		   )
			return "-1000";							

		$loginUrl = 'https://commerce.heyoya.com/receiver/swld.action';
		
		$time = time(); 		
		
		$args = array('body' => array('email' => $email,'firstName' => $firstName,'lastName' => $lastName, 'fullName' => $displayName, 't' => $time), "sslverify" => false, "timeout" => 60);
		
		$response = wp_remote_post( $loginUrl, $args );
		
		if ($response === null)
			return "-2000";
		
		$response_code = wp_remote_retrieve_response_code($response);
		if ($response_code === "" || $response_code != 200)
			return "-3000";
		
		$body = wp_remote_retrieve_body( $response );
		if ($body == null || trim($body) == "" )
			return "-4000";
				
		return trim($body);
	} 
	
	private function getLoggedOutString(){
		return str_replace('#IL-VALUE#', '0', str_replace('#C-VALUE#', '', $this -> outputResponse));
	}

	private function generateLoggedInString($loginResponse){
		if ($loginResponse == null || trim($loginResponse) == ""){
			   $this->getLoggedOutString();
			   return;
		   }		
		
		return str_replace('#IL-VALUE#', '1', str_replace('#C-VALUE#', $loginResponse, $this -> outputResponse));
	}
		
	public function login($template){
		if (
				$template == null || 
				!isset($template->request) ||
				(
					$template->request !== "heyoya/login" &&
					$template->request !== "heyoya/logind"
				)
			){	
				return;
}

		header("HTTP/1.0 200 OK");		
		if ($template->request == "heyoya/login")
			$this -> loginWindow($template);
		else 
			$this -> loginRequest($template);
	}
}
?>