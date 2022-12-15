<?php
/*
 * This class is responsible for creating the Heyoya Admin Notices
 */
class HeyoyaNotices{	
	private $noticeReviewKey = 'review_notice_dismissed';
	private $noticeGetStartedKey = 'get_started_notice_dismissed';
	private $currentHook = null;

	/*
	 * Class constructor. in it we're attaching the hooks that will render the notices if required.
	 */
	public function __construct(){		
		add_action('admin_enqueue_scripts', array($this, 'load_notice_scripts') );
		add_action('admin_init', array($this, 'heyoya_notices_init') );
		add_action( 'admin_notices', array($this, 'heyoya_admin_notices') );		
	}

	/*
	 * Loading client scripts for notices.
	 */
	function load_notice_scripts($hook){
		$this->currentHook = $hook;

		wp_register_script( 'dismiss_script', plugins_url( '/js/dismiss.js', __FILE__ ) );
		wp_enqueue_script( 'dismiss_script', plugins_url( '/js/dismiss.js', __FILE__ ), array( 'jQuery') );
	}
	
	/*
	 * Checking if we need to mark one of notices as marked
	 */
	function heyoya_notices_init(){
		$this->checkForNoticeCallback();
	}		
	
	/*
	 * Adding admin notices  
	 */
	function heyoya_admin_notices(){		
		$this->add_get_started_notice();
		$this->add_review_notice();			
	}
	
	function add_get_started_notice(){		
		if ($this->is_heyoya_activated() || (isset($_GET['page']) && $_GET['page'] === 'heyoya-options')){
			$options = get_option('heyoya_options', null);
			if ($options !== null){
				$options[$this->noticeGetStartedKey] = "1";
				update_option("heyoya_options", $options);
			}

			return;
		}

		
		$options = get_option('heyoya_options', null);
		if (
 			 $options !== null && 			
			 isset($options[$this->noticeGetStartedKey]) && 
			 $options[$this->noticeGetStartedKey] == "1" 			 
		   )
			return;		
		
		$dismiss_url = add_query_arg( array(
                'heyoya_'.$this->noticeGetStartedKey => true
            ), admin_url() );
		
		
		echo "<div class=\"notice heyoya-notice notice-info is-dismissible\" data-dismiss-url=\"" . esc_url( $dismiss_url ) . "\"><p>Thanks for installing <strong>\"Voice Comments - Heyoya\"</strong>! <a href=\"" . admin_url() . "edit-comments.php?page=heyoya-options\">Click here</a> and get started!</p></div>";
		
	}
	
	function add_review_notice(){
		if ( 
			!$this->is_heyoya_activated() || 
			(
				($this->currentHook == null || ($this->currentHook !== null && $this->currentHook !== 'plugins.php')) &&
				(!isset($_GET['page']) || (isset($_GET['page']) && $_GET['page'] !== 'heyoya-options'))
			) 			
		   )
			return;
		
		
		
		$options = get_option('heyoya_options', null);
		if ($options == null || (isset($options[$this->noticeReviewKey]) && $options[$this->noticeReviewKey] == "1"))
			return;		
		
		$dismiss_url = add_query_arg( array(
                'heyoya_'.$this->noticeReviewKey => true
            ), admin_url() );

		echo "<div class=\"notice heyoya-notice notice-info is-dismissible\" data-dismiss-url=\"" . esc_url( $dismiss_url ) . "\"><p>If you like <strong>\"Voice Comments - Heyoya\"</strong> please leave us a <a target=\"_blank\" href=\"https://wordpress.org/support/plugin/heyoya-voice-comments-reviews/reviews/?rate=5#new-post\">★★★★★</a> rating. A huge thanks in advance!</p></div>";								

	}
	
	function is_heyoya_activated(){
		$options = get_option('heyoya_options', null);
		return ($options != null && isset($options["affiliate_id"]));
	}
	
	
	function checkForNoticeCallback(){
	    $dismiss_review_parameter = filter_input( INPUT_GET, 'heyoya_'.$this->noticeReviewKey, FILTER_SANITIZE_STRING );
		$dismiss_get_started_parameter = filter_input( INPUT_GET, 'heyoya_'.$this->noticeGetStartedKey, FILTER_SANITIZE_STRING );
		
		
		if ( 
				(
					$dismiss_review_parameter != null && 
					$dismiss_review_parameter
				) || 
				(
					$dismiss_get_started_parameter != null && 
					$dismiss_get_started_parameter
				)

		   ) {
			$options = get_option('heyoya_options', null);
			if ($options == null)
				return;
			
			if ($dismiss_review_parameter)
				$options[$this->noticeReviewKey] = "1";
			else 
				$options[$this->noticeGetStartedKey] = "1";
			
			update_option("heyoya_options", $options);
			exit();
			return;		
		}

	}


}
?>