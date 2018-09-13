<?php 
require_once('include/i_config.php'); 
require_once('Connections/bwc_orders.php'); 
//session_start();   //  ทำการ  START 
//clearstatcache();
//header('Content-type: text/html; charset=utf-8');
$chkDate = date('Ymd');
$chkTime = date('H:i:s');
$chkHour = substr($chkTime,0,2);
if ($chkHour=='00') {
	$chkDate = date('Ymd');
	$chkDate = date('Ymd', strtotime('-1 day', strtotime($chkDate)));
	$chkHour = '23';
} else {
	$chkDate = date('Ymd');
	$chkHour = $chkHour - 1;
}

$strDate = substr($chkDate,6,2)."/".substr($chkDate,4,2)."/".substr($chkDate,0,4)."  ".$chkTime;
echo "เวลาตรวจสอบระบบ ".$strDate."<br />";

//chkProcess ($chkDate, $chkTime, '201511', '0999', 466, 2, 'ทดสอบ ขั้นเทพ', 'perapong.sitti@gmail.com', 0, '20150531', '11:22:33');

//function chkProcess ($chkDate, $chkTime, $campaign, $dist, $mslno, $chkdgt, $rep_name, $email, $amount, $strcurrentdate, $strcurrenttime) {
		$msg_header = "";
		$msg_header.= "<font style='font-family:Tahoma, Geneva, sans-serif;font-size:14 ;color:#252525'>";
		$msg_header.= "เรียนทุกท่านเพื่อทราบ <br />";
		$msg_header.= "ขอรายงานผลการตรวจสอบการทำงานของระบบ ณ วันที่ ".$strDate."<br /><br />";
		$msg_header.= "</font>";
		$MailMessage = "";
		$MailMessage.= $msg_header;
		$MailMessage.= '<font style="font-family:Tahoma, Geneva, sans-serif;font-size:16 ;color:#252525">';
		$MailMessage.= '<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;การสั่งซื้อผ่านทางเว็บไซต์ http://www.BWorder.com<br /><br />';
			mysql_select_db($database_bwc_orders, $bwc_orders);
			mysql_query("SET NAMES 'UTF8'");
			$sqlstr = "select 'All' CNT_TYPE, count(*) CNT_TOTAL from mail_log
						where mail_date = $chkDate
						union
					   select 'Cur' CNT_TYPE, count(*) CNT_TOTAL from mail_log
						where mail_date = $chkDate
						  and substr(MAIL_TIME,1,2) = '$chkHour'";
			//echo $sqlstr;
			$rstData = mysql_query($sqlstr, $bwc_orders) or die(mysql_error());
			//$rowData = mysql_fetch_assoc($rstData);
			$resData = "";
			while ($rowData = mysql_fetch_assoc($rstData)) { 
				if ($rowData['CNT_TYPE']=='All') {
					$resData.= '<tr style="heigth:500px;">
								<td style="text-align:left;   width:300px;">&nbsp;จำนวนรายการยืนยันการสั่งซื้อ ทั้งหมด </td>
								<td style="text-align:center; width:200px;">&nbsp;วันที่ '.substr($chkDate,6,2)."/".substr($chkDate,4,2)."/".substr($chkDate,0,4).'</td>
								<td style="text-align:right;  width:10px; ">=</td>
								<td style="text-align:right;  width:100px;">'.$rowData['CNT_TOTAL'].'</td>
							</tr>';
				} else if ($rowData['CNT_TYPE']=='Cur') {
					$resData.= '<tr>
								<td style="text-align:left;">&nbsp;จำนวนรายการยืนยันการสั่งซื้อ เวลา </td>
								<td style="text-align:center;">&nbsp;'.$chkHour.' นาฬิกา</td>
								<td style="text-align:right;">=</td>
								<td style="text-align:right;">'.$rowData['CNT_TOTAL'].'</td>
							</tr>';
				}
			}
		$MailMessage.= '<table id="rounded-corner" border="1"><tbody>'.$resData.'</tbody></table><br />';

		$MailMessage.= '<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;การสั่งซื้อผ่านทางเว็บไซต์ http://www.DSMorder.com<br /><br />';
			$dsm_orders = mysql_connect("dsmorder.com", "dsmorder", "dsm1214") or trigger_error(mysql_error(),E_USER_ERROR); 
			mysql_query("SET NAMES 'tis620'");
			mysql_select_db("dsm_orders", $dsm_orders);
			mysql_query("SET NAMES 'UTF8'");
			$sqlstr = "select 'All' CNT_TYPE, count(*) CNT_TOTAL from mail_log
						where mail_date = $chkDate
						union
					   select 'Cur' CNT_TYPE, count(*) CNT_TOTAL from mail_log
						where mail_date = $chkDate
						  and substr(MAIL_TIME,1,2) = '$chkHour'";
			//echo $sqlstr;
			$rstData = mysql_query($sqlstr, $dsm_orders) or die(mysql_error());
			//$rowData = mysql_fetch_assoc($rstData);
			$resData = "";
			while ($rowData = mysql_fetch_assoc($rstData)) { 
				if ($rowData['CNT_TYPE']=='All') {
					$resData.= '<tr style="heigth:500px;">
								<td style="text-align:left;   width:300px;">&nbsp;จำนวนรายการยืนยันการสั่งซื้อ ทั้งหมด </td>
								<td style="text-align:center; width:200px;">&nbsp;วันที่ '.substr($chkDate,6,2)."/".substr($chkDate,4,2)."/".substr($chkDate,0,4).'</td>
								<td style="text-align:right;  width:10px; ">=</td>
								<td style="text-align:right;  width:100px;">'.$rowData['CNT_TOTAL'].'</td>
							</tr>';
				} else if ($rowData['CNT_TYPE']=='Cur') {
					$resData.= '<tr>
								<td style="text-align:left;">&nbsp;จำนวนรายการยืนยันการสั่งซื้อ เวลา </td>
								<td style="text-align:center;">&nbsp;'.$chkHour.' นาฬิกา</td>
								<td style="text-align:right;">=</td>
								<td style="text-align:right;">'.$rowData['CNT_TOTAL'].'</td>
							</tr>';
				}
			}
		$MailMessage.= '<table id="rounded-corner" border="1"><tbody>'.$resData.'</tbody></table><br />';

		$MailMessage.= "<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ระบบ แต่งตั้งสมาชิกอัจฉริยะ IA<br /><br />";

		$MailSubject = "รายงานผลการตรวจสอบระบบ";

		echo $MailMessage;
		
exit;
		require_once('Internetorder\application\controllers\class.phpmailer.php');
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->CharSet="UTF-8";
		$mail->SMTPSecure = 'tls';
		$mail->Host = 'mailcorp.truemail.co.th';
		$mail->Port = 25;
		//$mail->Username = 'mistineinfo@mistine.co.th';
		//$mail->Password = '1234';
		$mail->SMTPAuth = true;

		//$to = 'bwdsmorder@gmail.com';
		$to = 'perapong.sitti@gmail.com';
		$mail_date = $strcurrentdate;
		$mail_time = $strcurrenttime;
		$mail_type = 'test';
		$currentCamp = $campaign;
		
		$mail_user = 'bworder-01@mistine.co.th';
		//$mail_user = $this->mail_log($mail_date, $mail_time, $mail_type, $dist, $mslno, $chkdgt, $campaign, $currentCamp, 0, 0, 0);
		$mail->Username = $mail_user;
		$mail->Password = 'sd1234';
		$mail->From = $mail_user;
		$mail->FromName = 'BWORDER.COM';
		$mail->AddAddress($to);         
		/*
		$mail->AddBCC('bwdsmmistine@gmail.com');
		$mail->AddBCC('wichian_w@mistine.co.th');
		$mail->AddBCC('perapong.sitti@gmail.com');
		$mail->AddBCC('pitsanu.n@gmail.com');
		$mail->AddBCC('sssai7611@gmail.com');
		$mail->AddBCC('Pleteera@gmail.com');
		*/
		$mail->IsHTML(true);
		$mail->Subject = $MailSubject;
		$mail->Body    = $MailMessage ;

		if(!$mail->Send())
		{				 
				echo "can't send e-mail";
		}
		else
		{				 
				echo "send mail complete";
		}

exit;

/*

*/
?>
