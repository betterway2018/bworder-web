<?php session_start();

header('Content-type: text/html; charset=windows-874');
require_once("../Connections/bwc_webboard.php");
require_once("i_email_config.php");  // refer $smtp_server,$default_from ,$default_to
include("i_function_msg.php"); 

$tMode = $_POST['submit'];	

if ($tMode == "Send E-mail") {
	
	//if ($tMode == "Answer") {
 				$dist = $_REQUEST['dist'];
				$mslno	=$_REQUEST['mslno'];
				$chkdgt	=$_REQUEST['chkdgt'];
				$datefrom = $_REQUEST['datefrom'];
				$dateto = $_REQUEST['dateto'];
				$email = $_REQUEST['email'];
				$txtCode = $_POST['txtCode'];
				$txtAnswerBy = $_POST['txtAnswerBy'];
				$txtAnswer = $_POST['txtAnswer'];
				$txtDetail = $_POST['txtDetail'];
							
				$IP_ADDRESS = $_SERVER['REMOTE_ADDR'];
				
				//echo "Update Answer" . $txtAnswer."=>".$txtCode;
				$cre_date=date('Ymd');
				$cre_time=date('Hi00');
				$strMode = $_REQUEST['tMode'];
				$row_index = $_POST['hidROW_INDEX']; 	
				
/*	$query = "SELECT ROW_INDEX, concat(lpad(dist,3,'0'),'-',lpad(mslno,5,'0'),'-',lpad(chkdgt,1,'0')) msl_code, NAME, GROUP_ID, SUBJECT, DETAIL, IP, CREATE_DATE, CREATE_TIME,CHK_MAIL, EMAIL, PHONE, ANSWER FROM WEBBOARD"; 

		$queryTime = "select curdate() as curdate,curtime() as curtime";
		$get_date = mysql_query($queryTime,$bwc_webboard) or die("error command ".mysql_error());
		$row_get_date =mysql_fetch_assoc ($get_date);
		$current_date = str_replace("-","",$row_get_date['curdate']);
		$current_time =str_replace(":","",$row_get_date['curtime']);*/


$insert = "INSERT INTO webboard_detail (answer_name, answer_code, ip, answer_date, answer_time, list_no, answer_detail)
				VALUES  ('".$txtAnswerBy."','".$txtCode."','$IP_ADDRESS',replace(curdate(),'-',''),replace(curtime(),':',''),".$row_index.",'".$txtAnswer."')";
$webboard = mysql_query($insert, $bwc_webboard) or die("error command ". $insert);
$update = "UPDATE webboard SET answer = answer + 1 WHERE row_index = ".$row_index;
$webboard = mysql_query($update, $bwc_webboard) or die("error command ". $update);

//echo "email";	
	
	$strFrom=$_POST['txtFrom'];
	$strFromName = $_POST['txtName'];
	$strTo = $_POST['txtTo'];
	$strSubject = $_POST['txtSubject'];
	$strMessage = "รหัสสมาชิก ". $_POST['txtCode'] . "<br>".  $_POST['txtDetail'] . "<br>" . "คำตอบ : " . nl2br($_POST['txtAnswer']) . "<br>" ."ตอบโดย: ". $_POST['txtAnswerBy'] ."  ".$row_index ."  <br>อีเมล์ฉบับนี้ตอบกับเพียงครั้งเดียวเท่านั้น หากท่านต้องการสอบถามข้อมูลเพิ่มเติม กรุณาติดต่อ Call center โทร  02-118-5111<br> 
     วันจันทร์-ศุกร์ เวลา 8.00-24.00 น. วันเสาร์-อาทิตย์ เวลา 8.00-17.30 น. " ;

		
		include("i_email_config.php");  // refer $smtp_server,$default_from ,$default_to
		
		if ($email_from=="") {
				$email_from=$default_from;
		}
		
		if ($email_to=="") {
				$email_to=$default_to;
		}
			
		
		ini_set("SMTP", "$smtp_server");
		ini_set("sendmail_from", "$default_from");

		$MailTo = $email_to;
		$MailFrom = $email_from;
//		$MailSubject = "ทดสอบ ".date('Y-m-d H:i:s');
//		$MailMessage = "ทดสอบ" . date('Y-m-d H:i:s');
	
		$Headers = "MIME-Version: 1.0\r\n" ;
		$Headers .= "Content-type: text/html; charset=windows-874\r\n" ;  // ส่งข้อความเป็นภาษาไทย ใช้ "windows-874" $strHeader .= "From: ".$strFromName."<". $strFrom.">\nReply-To: ".$strFrom.";";
		$Headers .= "From: ".$strFromName." <".$strFrom.">\r\n" ;
		$Headers .= "Reply-to: ".$MailFrom." <".$MailFrom.">\r\n" ;
		//$Headers .= "Bcc:grandtechshop@gmail.com,grandtechshop@gmail.com" . "\r\n";

		$Headers .= "X-Priority: 3\r\n" ;
		$Headers .= "X-Mailer: PHP mailer\r\n" ;

	
	   $flgSend = mail($strTo,$strSubject,$strMessage,$Headers,$strAnswerBy);  // @ = No Show Error //
	


/*=================================================================================*/

/*perapong edit 04/09/2018
	$smtp_server_test="mailsrv.mistine.co.th";
	$default_from_test = "callcenter@mistine.co.th";


	    ini_set("SMTP", "$smtp_server_test");
		ini_set("sendmail_from", "$default_from_test");

		$MailTo = $email_to;
		$MailFrom = $email_from;
	
		$Headers = "MIME-Version: 1.0\r\n" ;
		$Headers .= "Content-type: text/html; charset=windows-874\r\n" ;  // ส่งข้อความเป็นภาษาไทย ใช้ "windows-874" $strHeader .= "From: ".$strFromName."<". $strFrom.">\nReply-To: ".$strFrom.";";
		$Headers .= "From: ".$strFromName." <".$strFrom.">\r\n" ;
		$Headers .= "X-Priority: 3\r\n" ;
		$Headers .= "X-Mailer: PHP mailer\r\n" ;

	
	$flgSend = mail("dsm2.mistine@gmail.com",$strSubject,$strMessage,$Headers,$strAnswerBy);  // @ = No Show Error //
*/
/*=================================================================================*/



mysql_close($bwc_webboard);
echo '<META HTTP-EQUIV="refresh" content="0;URL=data_contactus2.php">';
	}


?>

<!--<script language="javascript">window.location='data_contactus2.php';</script>-->