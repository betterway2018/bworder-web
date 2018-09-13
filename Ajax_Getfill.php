<?php  session_start(); ?>
<?php require("i_config.php"); ?>
<?php require_once('Connections/bwc_orders.php'); ?>
<?php
$campaign =$_POST['tCampCode'];
$billcode=$_POST['tProductID'];
$_unit=$_POST['tUnit'];


mysql_select_db($database_bwc_orders, $bwc_orders);
//mysql_query("SET NAMES 'tis620'");
mysql_query("SET NAMES 'utf8'");
$query_billcode = "SELECT * FROM billcode where camp=$campaign and billcode='$billcode'";
$billcode = mysql_query($query_billcode, $bwc_orders) or die(mysql_error());
$row_billcode = mysql_fetch_assoc($billcode);
$totalRows_billcode = mysql_num_rows($billcode);
 
if ($totalRows_billcode>0) {
	echo $row_billcode['BILLDESC']."|".$row_billcode['PRICE'];
}
else {
	echo "|0";
}
?>

<?php
mysql_free_result($billcode);
?>
