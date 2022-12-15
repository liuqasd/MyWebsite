<?php
/*
 * This class is responsible for creating the Heyoya Admin Feedback Form
 */
class HeyoyaFeedback{	
	private $currentHook = null;
	private $matchedName = "plugins.php";

	/*
	 * Class constructor. in it we're attaching the hooks that will render the feedback if required.
	 */
	public function __construct(){		
		add_action('admin_init', array($this, 'heyoya_feedback_init') );
		add_action('admin_enqueue_scripts', array($this, 'load_feedback_scripts') );
		add_action('wp_ajax_heyoya_deactivate_feedback', array($this, 'heyoya_send_feedback') );
	}

	/*
	 * Loading client scripts for feedback.
	 */
	function load_feedback_scripts($hook){
		$this -> addFeedbackScripts();
	}
	
	function addFeedbackScripts(){
		if (!isset($this->currentHook) || $this->currentHook != $this->matchedName)
			return;
		
		wp_register_script( 'heyoya_feedback_script', plugins_url( '/js/feedback.js', __FILE__ ) );
		wp_enqueue_script( 'heyoya_feedback_script', plugins_url( '/js/feedback.js', __FILE__ ), array( 'jQuery') );
		
		wp_enqueue_style( 'heyoya_feedback_style', plugins_url( '/css/feedback.css', __FILE__ ) );

	}
	
	/*
	 * Checking if we need to display one of feedback boxes
	 */
	function heyoya_feedback_init(){
		global $pagenow;
		$this->currentHook = $pagenow;
		
		$this->addFeedbackBox();
	}		
	
	function is_heyoya_activated(){
		$options = get_option('heyoya_options', null);
		return ($options != null && isset($options["affiliate_id"]));
	}
	
	
	function addFeedbackBox(){
		if (!isset($this->currentHook) || $this->currentHook != $this->matchedName)
			return;
		
		add_action( 'admin_footer', [ $this, 'addFeedbackBoxHTML' ] );
	}
	
	function addFeedbackBoxHTML(){
		$reasons = [
			'no_longer_needed' => [
				'title' => 'I no longer need the plugin',
				'input_placeholder' => '',
			],
			'found_a_better_plugin' => [
				'title' => 'I found a better plugin',
				'input_placeholder' => 'Please share which plugin',
			],
			'couldnt_get_the_plugin_to_work' => [
				'title' => 'I couldn\'t get the plugin to work',
				'input_placeholder' => '',
			],
			'temporary_deactivation' => [
				'title' => 'It\'s a temporary deactivation',
				'input_placeholder' => '',
			],
			'other' => [
				'title' => 'Other',
				'input_placeholder' => 'Please share the reason',
			],
		];

		$this->addWrapperOpening('Quick Feedback', '_heyoya_deactivate_feedback_nonce');
		
		?>
		<input type="hidden" name="action" value="heyoya_deactivate_feedback" />

		<div class="hey-feedback-dialog-form-headline">If you have a moment, please share why you are deactivating Heyoya:</div>
		<div class="hey-feedback-dialog-form-body">
			<?php foreach ( $reasons as $reason_key => $reason ) : ?>
				<div class="hey-feedback-dialog-input-wrapper">
					<input id="hey-feedback-<?php echo esc_attr( $reason_key ); ?>" class="hey-feedback-dialog-input" type="radio" name="reason_key" value="<?php echo esc_attr( $reason_key ); ?>" />
					<label for="hey-feedback-<?php echo esc_attr( $reason_key ); ?>" class="hey-feedback-dialog-label"><?php echo esc_html( $reason['title'] ); ?></label>
					<?php if ( ! empty( $reason['input_placeholder'] ) ) : ?>
						<input class="hey-feedback-text" type="text" name="reason_<?php echo esc_attr( $reason_key ); ?>" placeholder="<?php echo esc_attr( $reason['input_placeholder'] ); ?>" />
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="hey-feedback-dialog-buttons-wrapper">
			<button class="hey-feedback-dialog-submit-btn">Submit &amp; Deactivate</button>
			<button class="hey-feedback-dialog-skip-btn">Skip &amp; Deactivate</button>
		</div>
		<?php
		
		$this->addWrapperClosing();
	}
	
	function addWrapperOpening($headlineText, $nonceFieldName){
		?>
		<div class="hey-feedback-background" style="display:none;">
			<div class="hey-feedback-dialog-wrapper">
				<div class="hey-feedback-dialog-header">
					<span class="hey-logo"></span>
					<span class="hey-feedback-dialog-header-title"><?php echo $headlineText ?></span>
				</div>
				<form class="hey-feedback-dialog-form" method="post">
					<input type="hidden" name="_rnd" value="<?php echo (time()) ?>"
					<?php
					wp_nonce_field( $nonceFieldName );
					?>
		<?php		
	}
	
	function addWrapperClosing(){
		?>
				</form>
			</div>	
		</div>
		<?php		
	}

	function heyoya_send_feedback(){
		echo "1";

		$options = get_option('heyoya_options');
		if ($options == null || !isset($options["apikey"]) || trim($options["apikey"]) == ""){
			wp_die();
			return;
		}
		
		$reasonKey = $_POST["reason_key"];
		$reasonText = '';
		$reasonKeyId = 5;
		if (isset($reasonKey)){				
			if ($reasonKey == "no_longer_needed")
				$reasonKeyId = 0;
			
			if ($reasonKey == "found_a_better_plugin"){
				$reasonKeyId = 1;
				if (isset($_POST["reason_found_a_better_plugin"]))
					$reasonText = $_POST["reason_found_a_better_plugin"];				
			}

			if ($reasonKey == "couldnt_get_the_plugin_to_work")
				$reasonKeyId = 2;

			if ($reasonKey == "temporary_deactivation")
				$reasonKeyId = 3;

			if ($reasonKey == "other"){
				$reasonKeyId = 4;
				if (isset($_POST["reason_other"]))
					$reasonText = $_POST["reason_other"];				
			}			
		}
		

		$time = time();		
		$apikey = trim($options["apikey"]);
		$url = 'https://admin.heyoya.com/client-admin/af/dar.heyoya';
		
		$args = array('body' => array(
										'ak' => $apikey, 
										'ri' => $reasonKeyId,
										'rt' => $reasonText,
										't' =>  $time)
					  , "sslverify" => false, "timeout" => 60);		
		
		$response = wp_remote_post( $url, $args );	
		$response_code = wp_remote_retrieve_response_code($response);

		wp_die();
	}

}
?>