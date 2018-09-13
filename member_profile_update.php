<?php 
session_start(); 
require_once('check_login.php');
require_once('include/i_config.php'); 
require_once('include/functionphp.inc');
require_once('Connections/bwc_orders.php'); 
require_once('i_function_msg.php');

//####################################################################################
if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['Submit']) && $_POST['Submit']=="บันทึก" ) {
//####################################################################################	
	$dist=$_POST['dist'];
	$mslno=$_POST['mslno'];
	$chkdgt=$_POST['chkdgt'];
	$rep_name=utf8_to_tis620($_POST['txtname']);
	$email = $_POST['txtemail'];
	$phone = $_POST['txtphone'];
	$birthdate=$_POST['b_year'].$_POST['b_month'].$_POST['b_date'];
	$question=$_POST['txtquest'];
	$answer = $_POST['txtans'];
	$pwd1 = $_POST['txtpwd1'];
	$pwd2 =$_POST['txtpwd2'];
	//echo $_POST['txtname'];//exit;
	
	if ($dist=="" || $mslno=="" || $chkdgt=="") {
		echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
	}

	mysql_select_db($database_bwc_orders, $bwc_orders);
	//mysql_query("SET NAMES 'utf8'");
	mysql_query("SET NAMES 'tis620'");


	include("i_current_date.php");
	 //return $current_date;
	 //return $current_time;
	 
	 if ($current_date=="") {
		 $current_date = date('Ymd');
	 }
	 
	$query ="Select * From  mslmst Where DIST='$dist' and mslno='$mslno' and chkdgt='$chkdgt'";
	$mslmst = mysql_query($query, $bwc_orders) or die(mysql_error());
	$row_mslmst = mysql_fetch_assoc($mslmst);
	$totalRows_mslmst= mysql_num_rows($mslmst);			
	if ($totalRows_mslmst==0) {
		 	 AlertMessage("ข้อมูลของคุณไม่ถูกต้อง กรุณากลับไปหน้าล็อกอิน เพื่อล็อกอินเข้าสู่ระบบและจัดการข้อมูลส่วนตัวของคุณอีกครั้ง" ,"logout.php");
			 exit;
	}
	
	if ($pwd1!="" && $pwd1==$pwd2) {
			$query ="UPDATE MSLMST SET  NAME ='$rep_name' ,EMAIL='$email', 	QUESTION='$question',";
			$query .="ANSWER='$answer',PWD='$pwd1',LAST_UPDATE =   '$current_date' ";
			$query .="	WHERE DIST='$dist' and mslno='$mslno' and chkdgt='$chkdgt' ";
			
			
	
	} 
    else {
	$query ="UPDATE MSLMST SET  NAME ='$rep_name' ,EMAIL='$email',
					QUESTION='$question',ANSWER='$answer',LAST_UPDATE=$current_date 
					WHERE DIST='$dist' and mslno=$mslno and chkdgt=$chkdgt ";
					
	}

	$update = mysql_query($query, $bwc_orders) or die(mysql_error());
	if (!$update) {
		die('Error: ' . mysql_error());
		exit;		
	}
	else {
		AlertMessage("แก้ไขข้อมูลส่วนตัวของคุณเรียบร้อยแล้วค่ะ" ,"index.php");
		exit;
	}
}
else {
		AlertMessage("ปรับปรุงข้อมูลไม่สำเร็จ","javascript:history.back();");
		exit;

}
?>