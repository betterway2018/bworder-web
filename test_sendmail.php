<?php 
header('Content-type: text/html; charset=utf-8');

test_sendmail ('201511', '0999', 466, 2, 'ทดสอบ ขั้นเทพ', 'perapong.sitti@gmail.com', 0, '20150531', '11:22:33');

function test_sendmail ($campaign, $dist, $mslno, $chkdgt, $rep_name, $email, $amount, $strcurrentdate, $strcurrenttime) {
		$mslno = substr('0000'.$mslno,-5);
		$str_rep_code = $dist . '-' . $mslno . '-' . $chkdgt;
		$msg_header = "";
		$msg_header.= "<font style='font-family:Tahoma, Geneva, sans-serif;font-size:14 ;color:#252525'>";
		$msg_header.= "เรียนทุกท่านเพื่อทราบ <br />";
		$msg_header.= "ขอรายงานผลการตรวจสอบการทำงานของระบบ ณ วันที่ ".date('d-m-Y H:i:s')."<br /><br />";
		$msg_header.= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ทางบริษัทฯ ขอขอบคุณที่ท่านได้ ให้ความสนใจทำรายการผ่านทางเว็บไซต์ http://www.bworder.com ";
		$msg_header.= "9999ในรอบจำหน่ายที่  ".substr($campaign,4,2)."/".substr($campaign,0,4)."<br />";
		$msg_header.= "</font>";
		$MailMessage = "";
		$MailMessage.= $msg_header;
		$MailMessage.= '<font style="font-family:Tahoma, Geneva, sans-serif;font-size:12 ;color:#252525">';
		$MailSubject = "รายงานผลการตรวจสอบระบบ";
		
		
		//$mail_host = 'mailcorp.truemail.co.th';
		//$mail_user = 'bworder-01@mistine.co.th';
		$mail_host = 'mailsrv.mistine.co.th';
		$mail_user = 'dsmorder-01@mistine.co.th';
		$mail_pass = 'sd1234';
		$mail_to   = 'perapong.sitti@gmail.com'; // notify=success,failure';     //$_GET['mailto'];
		
		require_once('Internetorder\application\controllers\class.phpmailer.php');
		$mail = new PHPMailer(true);
		$mail->IsSMTP();
		$mail->Host = $mail_host;
		$mail->Port = 25;
		$mail->CharSet="UTF-8";
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->Username = $mail_user;
		$mail->Password = $mail_pass;
		
		$mail->From = $mail_user;
		$mail->FromName = 'BWORDER.COM';
		$mail->AddAddress($mail_to);        
		//$mail->AddAddress($mail_to);   
		$mail->IsHTML(true);
		//$mail->SMTPDebug = 1;
		
		$mail->Subject = $MailSubject;
		$mail->Body    = $MailMessage ;		

		$result = $mail->Send();
		if(!$result)
		{				 
			echo "can't send e-mail";
		}
		else
		{				 
			echo "send mail complete";
		}
}
?>
