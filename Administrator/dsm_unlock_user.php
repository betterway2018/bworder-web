<?php 
session_start();
include("../i_function_msg.php");

if (isset($_GET['id']) && $_GET['id']!="") {
	
	require("../Connections/dsm_orders.php");
	
	$dist = $_GET['id'];
	

	mysql_select_db($database_dsm_orders,$dsm_orders);
	$query ="UPDATE users SET  STATUS = 'Active'";
	$query.=" WHERE  DISTRICT ='$dist'";
	$update= mysql_query($query, $dsm_orders) or die(mysql_error());
	
	if ($update) {
		AlertMessage("เปิดการใช้งานของรหัสผู้จัดการประจำเขต ".$dist . "  เรียบร้อยแล้วค่ะ","dsm.php");
		exit;
	}
	else
	{
		AlertMessage("ไม่สามารถบันทึกข้อมูลได้ ".mysql_error(),"javascript:history.back(1);");
		exit;
	}
		
	
	
	
}
else {
	echo"<meta http-equiv='refresh' content='0;URL=dsm.php'>";		
}
?>

