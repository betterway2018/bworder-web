<?php
session_start(); 
ob_start();
require_once('check_login.php');
require_once('include/i_config.php'); 
require_once('Connections/bwc_orders.php'); 
require_once('Connections/bwc_webboard.php'); 
require("i_function_msg.php"); 
require_once('include/functionphp.inc');

//if ( isset($_POST['Submit']) ) { 
//	AlertMessage($_POST['Submit'],"javascript:history.back();");
//	exit;}
if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['Submit']) && $_POST['Submit']=="บันทึก" ) {

	$dist= $_POST['txtdist'];
	$mslno=$_POST['txtmslno'];
	$chkdgt=$_POST['txtchkdgt'];
	$rep_name=utf8_to_tis620($_POST['txtname']);
	$email= $_POST['txtemail'];
	$phone = $_POST['txtphone'];
	$group = $_POST['sel_group'];
	$subject = utf8_to_tis620($_POST['txtsubject']);
	$detail = utf8_to_tis620($_POST['editor1']);
	
	$cre_date=date('Ymd');
	$cre_time=date('Hi00');
	$ip=$_SERVER['REMOTE_ADDR'];

	 if ($dist=="" || $mslno=="" || $chkdgt=="" ) {
		 	AlertMessage("กรุณาระบุรหัสสมาชิก ให้ถูกต้อง","javascript:history.back();");
			exit;
	 }
	 else{
			$no =0 ;

			//Generate  No	
			$sql ="SELECT MAX(ROW_INDEX) as MAXNO FROM webboard";
			mysql_select_db($database_bwc_webboard, $bwc_webboard);
			$max_no = mysql_query($sql, $bwc_webboard) or die(mysql_error());
			$row_max_no = mysql_fetch_assoc($max_no);
			$totalRows_max_no = mysql_num_rows($max_no);		
			
			if ($totalRows_max_no ==0) {
				$no =0;
			}
			else {
				if (!isset($row_max_no['MAXNO']) || $row_max_no['MAXNO']=="") {
					$no=0;
				}
				else {
					$no =$row_max_no['MAXNO'];
				}
			}
			$no=$no+1;
		
		//mysql_query("SET NAMES 'tis620'");

		
		$queryTime = "select curdate() as curdate,curtime() as curtime";
		$get_date = mysql_query($queryTime,$bwc_webboard) or die(mysql_error());
		$row_get_date =mysql_fetch_assoc ($get_date);
		$current_date = str_replace("-","",$row_get_date['curdate']);
		$current_time =str_replace(":","",$row_get_date['curtime']);

			//Update Header
			$query=	"INSERT INTO webboard(ROW_INDEX,DIST,MSLNO,CHKDGT,NAME,GROUP_ID,
						 SUBJECT,DETAIL,IP,CREATE_DATE,CREATE_TIME,CHK_MAIL,EMAIL,PHONE,ANSWER)VALUES(
						 $no,'$dist',$mslno,$chkdgt,'$rep_name',$group,'$subject','$detail','$ip',$current_date,'$current_time','Y','$email','$phone',0)";
			mysql_select_db($database_bwc_webboard, $bwc_webboard);
			$header = mysql_query($query, $bwc_webboard) or die(mysql_error());
			if (!$header) {
			  //   mysql_query("ROLLBACK");
		 			die('Error: ' . die(mysql_error()));
					exit;
			}
			
			// Send  E-mail
			
			//$email_from ="smiletech@mistine.co.th";
			//$email_to="nawin_m@mistine.co.th";
			
			
			$message = $detail;
			$message="เรียน Webmaster <br> ";
			$message .="      คุณ".$rep_name ." รหัสสมาชิก $dist-$mslno-$chkdgt  ";
			$message .="email : $email  หมายเลขโทรศัพท์ : $phone ";
			$message .="<br>";
			$message .="ได้แสดงความคิดเห็นหรือติดต่อ/สอบถามข้อมูลผ่านทางเว็บไซต์ ";
			$message .="http://".$_SERVER['HTTP_HOST'];
			$message .="<br>เมื่อวันที่  ". date('d/m/Y') ." ".date('H:i:00');
			$message .="  มีรายละเอียดดังนี้ค่ะ ...<br>";
			$message .="Subject : ". $subject ;
			$message .="<br>";
			$message .="Detail    : ". $detail ;
			
			$email_to = "callcenter@bworder.com";
			$email_from=$email;
			include("send_mail.php");
			AlertMessage("บันทึกข้อมูลติดต่อสอบถามของคุณเรียบร้อยแล้วค่ะ" ,"index.php");
			exit;
			
	}
} 

else {
		AlertMessage("กรุณาระบุรหัสสมาชิก ให้ถูกต้อง","javascript:history.back();");
		exit;

}


ob_end_flush();   // ตำแหน่งสิ้นสุด  

?>