<?php session_start();?>
<?php 
header('Content-type: text/html; charset=windows-874');
include("../i_function_msg.php");
require("../Connections/bwc_orders.php");
include("i_convert.php"); 
require_once("../Connections/bwc_orders.php"); 

mysql_select_db($database_bwc_orders, $bwc_orders);
mysql_query("SET NAMES 'tis620'");
//mysql_query("SET NAMES 'utf8'");

//$query = "Select * From billcode_msg";
//$billmsg = mysql_query($query, $bwc_orders) or die(mysql_error());
//$row_order = mysql_fetch_assoc($order);


$camp = $_GET['camp'];
$billcode = $_GET['billcode'];

$del_str ="DELETE FROM billcode_msg WHERE CAMP=$camp AND BILLCODE ='$billcode'";
$del = mysql_query($del_str,$bwc_orders);
if (!$del)  {
	echo "Error:". mysql_error();
	die;
}
else 
{
echo "<meta http-equiv='refresh' content='0;URL=billing_msg.php' />";
exit;
	
}

?>