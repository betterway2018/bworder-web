<?php 

mysql_select_db($database_bwc_orders, $bwc_orders);
mysql_query("SET NAMES 'tis620'");

$queryTime = "select curdate() as curdate,curtime() as curtime";
$get_date = mysql_query($queryTime,$bwc_orders) or die(mysql_error());
$row_get_date =mysql_fetch_assoc ($get_date);
$current_date = str_replace("-","",$row_get_date['curdate']);
$current_time =str_replace(":","",$row_get_date['curtime']);
$current_format_date=$row_get_date['curdate'];
$current_format_time=$row_get_date['curtime'];

//	include("i_current_date.php"); // return  $current_date  ,$current_time ,$current_format_date,$current_format_time
?>
