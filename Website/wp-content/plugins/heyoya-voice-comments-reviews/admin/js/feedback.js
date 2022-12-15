(function( $ ) {
    'use strict';    
	$(function(){
		var daLink = null;
		function init(){
			daLink = $("#the-list").find('[data-slug="heyoya-voice-comments-reviews"] span.deactivate a');
			bindEvents();
		}
		
		function bindEvents(){
			if (daLink == null || daLink.length === 0)
				return;
			
			daLink.on("click", function(e) {
				e.preventDefault(); 
				showFeedbackModal();				
			});			
		}
		
		function showFeedbackModal(){
			try{
				$(".hey-feedback-dialog-submit-btn, .hey-feedback-dialog-skip-btn").on("click", function(e) {
					e.preventDefault(); 									
					$.post(ajaxurl, $(".hey-feedback-dialog-form").serialize()).always(deactivate());
				});


				$(document).keyup(function(e) {
					if (e.key === "Escape") { 
						$(".hey-feedback-background").fadeOut();
					}
				});
				
				$(".hey-feedback-background").fadeIn();
			} catch (err){
				deactivate();
			}
		}
		
		function deactivate(){
			setTimeout(function(){window.location.href = daLink.attr("href");},1000);
		}
		
		init();		
	});
})( jQuery );