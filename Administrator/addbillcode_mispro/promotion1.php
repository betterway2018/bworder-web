<?php  session_start(); ?>
<?php require("../../i_config.php"); ?>
<?php //require("check_login.php"); ?>
<?php require_once("i_function_msg.php");  ?>
<?php require_once('../../Connections/config.inc.php'); ?>
<?php 

		$txtyear = $_POST["txtyear"];
		$txtcamp = $_POST["txtcamp"];
		$jpgfile = $_POST["JPGFILE"];
		$txtstatus = $_POST["txtStatus"];
		$jpgfile = $_FILES["JPGFILE"]["name"];
		
	
	$sql = "Select * From billcode_mispro";
	//mysql_db_query($Name,"SET NAMES 'TIS620'");
	$sqlquery = mysql_db_query($DBName,$sql) or die("ไม่สามารถติดต่อฐานข้อมูลได้ กรุณาตรวจสอบอีกครั้งหนึ่งคะ");
	$row_content_data = mysql_fetch_assoc($sqlquery);
	
	
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>



</body>
</html>