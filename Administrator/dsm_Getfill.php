<?php session_start();?>
<?php 
header('Content-type: text/html; charset=windows-874');
include("../i_function_msg.php");
require("../Connections/bwc_orders.php");
include("i_convert.php"); 
?>

<?php
$div= $_SESSION['div_code'];
$dist = $_POST['dist'];

mysql_select_db($database_bwc_orders, $bwc_orders);
mysql_query("SET NAMES 'tis620'");
//mysql_query("SET NAMES 'utf8'");

$query = "SELECT * FROM users Where DISTRICT = '".$_POST['txtdist']."'";
 $query.=" ORDER BY DISTRICT";

$users = mysql_query($query, $bwc_orders) or die(mysql_error());
$row_users = mysql_fetch_assoc($users);
$total_row_users = mysql_num_rows($users);
if ($total_row_users==0){
	echo "";
}
else {
	echo $row_users['NAME'];
}
	
?>
