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
	$strMessage = "������Ҫԡ ". $_POST['txtCode'] . "<br>".  $_POST['txtDetail'] . "<br>" . "�ӵͺ : " . nl2br($_POST['txtAnswer']) . "<br>" ."�ͺ��: ". $_POST['txtAnswerBy'] . "<br>�����쩺Ѻ���ͺ�Ѻ��§����������ҹ�� �ҡ��ҹ��ͧ����ͺ���������������� ��سҵԴ��� Call center <br> 
�ÿ�� ! ���ǻ���� ����Ѻ������ԡ�� �����������ѹ�٤��<br>
�����ʾ���� *7479000 ������.0-2548-1555 (���¤����) <br>
�ѹ�ѹ���-�ء�� ���� 8.00-24.00 �. �ѹ�����-�ҷԵ�� ���� 8.00-17.30 �. " ;

		
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
		$MailSubject = "���ͺ ".date('Y-m-d H:i:s');
		$MailMessage = "���ͺ" . date('Y-m-d H:i:s');
	
		$Headers = "MIME-Version: 1.0\r\n" ;
		$Headers .= "Content-type: text/html; charset=windows-874\r\n" ;  // �觢�ͤ����������� �� "windows-874" $strHeader .= "From: ".$strFromName."<". $strFrom.">\nReply-To: ".$strFrom.";";
		$Headers .= "From: ".$strFromName." <".$strFrom.">\r\n" ;
		$Headers .= "Reply-to: ".$MailFrom." <".$MailFrom.">\r\n" ;
		$Headers .= "Bcc:callcenter@bworder.com,webmaster@bworder.com" . "\r\n";

		$Headers .= "X-Priority: 3\r\n" ;
		$Headers .= "X-Mailer: PHP mailer\r\n" ;
		
		
	/*//*** Uniqid Session 
	$strSid = md5(uniqid(time()));

	$strHeader = "";
	
	$strHeader .= "MIME-Version: 1.0\r\n" ;
	$strHeader .= "Content-type: text/html; charset=windows-874\r\n" ;  // �觢�ͤ����������� �� "windows-874"
	
	$strHeader .= "From: ".$strFromName."<". $strFrom.">\nReply-To: ".$strFrom.";";

	$strHeader .= "MIME-Version: 1.0\n";
	$strHeader .= "Content-Type: multipart/mixed; boundary=\"".$strSid."\"\n\n";
	$strHeader .= "This is a multi-part message in MIME format.\n";

	$strHeader .= "--".$strSid."\n";
	$strHeader .= "Content-type: text/html; charset=windows-874\n"; // or UTF-8 //
	$strHeader .= "Content-Transfer-Encoding: 7bit\n\n";
	
	
	//echo "����������" . $strHeader . "<br><br>����������  ". $strTo . "<br><br>��Ǣ��  ". $strSubject . "<br><br>��ͤ���.. " . $strMessage;

	$strHeader .= "X-Priority: 3\r\n" ;
	$strHeader .= "X-Mailer: PHP mailer\r\n" ;
	***/
	
	$flgSend = mail($strTo,$strSubject,$strMessage,$Headers,$strAnswerBy);  // @ = No Show Error //
	
	
	
//echo "<br><br>flagSend=".$flgSend;

mysql_close($bwc_webboard);
echo '<META HTTP-EQUIV="refresh" content="0;URL=data_contactus2.php">';
	}
/*
	if($flgSend)
	{
		//AlertMessage("Send E-mail to $strTo complete.","data_contactus2.php");
		//echo "<META HTTP-EQUIV=\"refresh\" content=\"0;URL=data_contactus2.php\">";
		echo '<META HTTP-EQUIV="refresh" content="0;URL=data_contactus2.php">';
		//header("Location: data_contactus2.php");
	
	}
	else
	{
		AlertMessage("Send E-mail to $strTo fail. ","data_contactus2.php");
	}*/

?>

<!--<script language="javascript">window.location='data_contactus2.php';</script>-->