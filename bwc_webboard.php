<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
#$hostname_bwc_orders = "61.19.249.193";
$hostname_bwc_orders = "localhost";
$database_bwc_webboard = "bwc_webboard";
$username_bwc_webboard = "bwc_webboard";
$password_bwc_webboard = "bwo1212";

//$hostname_bwc_orders = "10.0.0.8";
//$username_bwc_webboard = "root";
//$password_bwc_webboard = "root";
$bwc_webboard = mysql_pconnect($hostname_bwc_webboard, $username_bwc_webboard, $password_bwc_webboard) or trigger_error(mysql_error(),E_USER_ERROR); 

mysql_query("SET NAMES 'tis620'");

?>