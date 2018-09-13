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
$txt_billdesc= $_POST['txt_billdesc'];
$sel_type=$_POST['sel_type'];
$txt_msgdesc=$_POST['txt_msgdesc'];


$insert_str ="INSERT INTO billcode_msg (CAMP,BILLCODE,BILLDESC,MSGTYP,MSG_DESC)VALUES(";
$insert_str .="$camp,'$txt_billcode','$txt_billdesc','$sel_type','$txt_msgdesc')";
$insert = mysql_query($insert_str,$bwc_orders);
if (!$insert)  {
	echo "Error:". mysql_error();
	die;
}
else 
{
echo "<meta http-equiv='refresh' content='0;URL=billing_msg.php' />";
exit;
	
}



?>
