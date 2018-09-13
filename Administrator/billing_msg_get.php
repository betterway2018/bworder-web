<?php session_start();?>
<?php 
header('Content-type: text/html; charset=windows-874');
include("../i_function_msg.php");
require("../Connections/bwc_orders.php");
include("i_convert.php"); 


mysql_select_db($database_bwc_orders, $bwc_orders);
mysql_query("SET NAMES 'tis620'");
//mysql_query("SET NAMES 'utf8'");

//$query = "Select * From billcode_msg";
//$billmsg = mysql_query($query, $bwc_orders) or die(mysql_error());
//$row_order = mysql_fetch_assoc($order);


$camp = $_POST['txt_camp2'].$_POST['txt_camp1'];
$txt_billcode = $_POST['txt_billcode'];

$query ="Select BILLCODE,BILLDESC FROM BILLCODE WHERE  CAMP = $camp AND BILLCODE ='$txt_billcode'";
$billcode = mysql_query($query,$bwc_orders);
$bill_code = mysql_fetch_assoc($billcode);
if (!$billcode)  {
	echo "Not found ...";
}
else 
{
	echo $bill_code['BILLDESC'];
}



?>
