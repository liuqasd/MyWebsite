<?php 
?>
<html>
	<head>
		<title>Heyoya Login</title>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<script type="text/javascript">
			try{window.opener.postMessage( "11212hey1234heyhey_lshey1234hey7hey1234hey<?php echo($loginResponse)?>", "*" );}catch(e){
				try{
					window.parent.postMessage( "11212hey1234heyhey_lshey1234hey7hey1234hey<?php echo($loginResponse)?>", "*" );
				} catch(e2){
						
			}
			}
				
			window.location.href = "https://commerce-static.heyoya.com/b2b/swh.html?t=<?php echo($loginResponse)?>";						
		</script>
	</body>
</html>