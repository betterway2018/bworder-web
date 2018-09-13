<?php session_start();?>
<?php  require("check_login.php"); ?>
<?php 
header('Content-type: text/html; charset=windows-874');
include("../i_function_msg.php");
require("../Connections/bwc_content.php");
include("i_convert.php"); 
?>

<?php
$dist=$_POST['dist'];
$div= $_SESSION['div_code'];
$strcamp=$_POST['camp'];
$id=$_GET['message_id'];
$campaign=substr($strcamp,3,4).substr($strcamp,0,2);
$dwnflag=$_POST['dwnflag'];

mysql_select_db($database_bwc_content, $bwc_content);
mysql_query("SET NAMES 'tis620'");

$delete =  mysql_query("Delete from content_data where ID =$id", $bwc_content) or die("<br><br>Error : ". mysql_error());


echo"<meta http-equiv='refresh' content='0;URL=vip.php'>";

?>