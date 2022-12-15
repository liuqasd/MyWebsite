(function( $ ) {
    'use strict';    
	$(function(){
		$('.heyoya-notice').on( 'click', ".notice-dismiss", function() {
			var $noticeElement = $(this).parent('.heyoya-notice.is-dismissible');
			if ($noticeElement.length === 0)
				return;

			var dismiss_url = $noticeElement.attr('data-dismiss-url');
			if ( dismiss_url )
				$.get( dismiss_url );
		});    
	});
})( jQuery );