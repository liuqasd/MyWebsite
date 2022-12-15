heyoyaLoggedIn = function(){
	var $, heyoyaReportService, logoutUrl;
	function init(jqueryObj, heyoyaReportObj){
		$ = jqueryObj;		
		heyoyaReportService = heyoyaReportObj;
		logoutUrl = "https://admin.heyoya.com/client-admin/login/logout.heyoya?";
		
		initMessaging();
		loadIframe();
	}
	
	function initMessaging(){
		if (!window.heyoyaMessaging)
			return;
		
		window.heyoyaMessaging.init(messagingCallback);
	}
	
	function messagingCallback(eventData){
		if (!eventData || !eventData.action || !eventData.value)
			return;

		var requestData = {};		
		switch (eventData.action){
			case "hey_logout":
				requestData.action = "logout";
				
				var oImg = document.createElement("img");
		        oImg.setAttribute('src', logoutUrl + "&r1=" + Math.random() + "&r2=" + Math.random() );
		        oImg.setAttribute('width', '1px');
		        oImg.setAttribute('height', '1px');
		        document.body.appendChild(oImg);

				heyoyaReportService.report("wp-admin-logout", true);		        		        
		        
				break;
				
			case "hey_published":
				requestData.action = "published";
				heyoyaReportService.report("wp-admin-published", true);		        		        
				
				break;

			case "hey_iw":
				requestData = null;
		        if (!isNaN(eventData.value) && eventData.value > 500){
					$("#heyoyaContainer iframe").css("height", eventData.value + "px");
					sendPosition();					
				}
				break;
		        
			case "hey_np":
		        sendPosition();
				requestData = null;
				break;
				
			default:
				requestData = null;	
		}		
		
		if (requestData != null){
			$.post(ajaxurl, requestData, function(response) {
				if ($.trim(response) == "1")
					heyoyaReportService.report("wp-admin-" + requestData.action + "-success", requestData.action == "logout");
				else 
					heyoyaReportService.report("wp-admin-" + requestData.action + "-error");
				
				if (requestData.action == "logout" && $.trim(response) == "1")
					window.location.href = window.location.href;
			});
		}		
	}
	
	function loadIframe(){
		var returnUrl = "installation.heyoya";
		if (window.location.href.indexOf("&s=c") != -1)
			returnUrl = "comments.heyoya";
		
		var url = "https://admin.heyoya.com/client-admin/installation.heyoya?ak=" + $("#heyoyaContainer").attr("aa") + "&at=wp&v=1&returnUrl=" + returnUrl + "%3Ftp%3D" + encodeURIComponent(window.location.href); 
		
		var heyoyaContainer = $("#heyoyaContainer");
		heyoyaContainer.append("<iframe style=\"width:" + (heyoyaContainer.width()-17) + "px;height:1400px;\" src=\"" + url + "\" allow=\"microphone;\"></iframe>");
				
		
		heyoyaReportService.report("wp-loggedin-impression");
		
		$(window).on("scroll", sendPosition);
	}
	
	function sendPosition(){
			var heyoyaContainer = $("#heyoyaContainer");

			try{
				var messageValue = {
					"scrollTop": $(window).scrollTop(),
					"heyoyaTop": heyoyaContainer.offset().top,
					"heyoyaHeight": heyoyaContainer.height(),
					"windowHeight": window.innerHeight
				};
				
				var message = "1hey1234heyhey_dimhey1234hey" + JSON.stringify(messageValue);

				window.heyoyaMessaging.postMessage(heyoyaContainer.find("iframe")[0].contentWindow, message);
			} catch(e){
				
			}		
	}
	
	
	
	return{
		init:init
	}

}();

jQuery(function(){
	heyoyaReport.init(jQuery);
	heyoyaLoggedIn.init(jQuery, heyoyaReport);
});