<?php session_start();?>
<?php 
header('Content-type: text/html; charset=windows-874');
include("../i_function_msg.php");
require("../Connections/dsm_orders.php");
include("i_convert.php"); 
?>

<?php
$div= $_SESSION['div_code'];

if ($_SERVER['REQUEST_METHOD']=="POST"  ) {
		
	mysql_select_db($database_dsm_orders, $dsm_orders);
	mysql_query("SET NAMES 'tis620'");
	//mysql_query("SET NAMES 'utf8'");
	
	$query = "INSERT INTO content_data(SUBJECT,DETAIL,GROUP_ID,STATUS,IS_DEFAULT,POST_DATE,POST_TIME,ALL_DISTRICT,EXP_DATE) ";
	$query.="VALUES (".$_POST['txtsubject']."','".$_POST['elm1']."'".",".$_POST['sel_group']. ","	."0,'N'".",". date('Ymd').","."'".date('Hi00')."',"."'Y'".",". date('Ymd').")";
	
	// echo $query;
	// exit;
	
	$insert = mysql_query($query, $dsm_orders) or die(mysql_error());
	if ($insert) {
		AlertMessage("บันทึกข้อมูลเรียบร้อยแล้วค่ะ ...","news.php");
		exit;
	} 
	else {
		echo mysql_error();
		exit;
	}
	//$row_users = mysql_fetch_assoc($users);
}
else {
	echo "POST =".$_POST['Save'];
}
?>