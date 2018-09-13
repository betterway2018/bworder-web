<?php 
/*
Input Paramter   : 	$email_from 
							$email_to
							$subject
							$message
							
Output Parameter : $mail_sent

*/
	    include("i_email_config.php");  // refer $smtp_server,$default_from ,$default_to
		
		if ($email_from=="") {
				$email_from=$default_from;
		}
/*

$mail->SMTPSecure = 'ssl';
$mail->Host = '10.0.0.6:465';
//$mail->Host = 'mailsrv-01.mistine.co.th';
//$mail->Port = '443';
$mail->Username = 'contact@mistine.co.th';  
$mail->Password = 'sd1213';
$mail->SMTPAuth = true;

*/		
		if ($email_to=="") {
				$email_to=$default_to;
		}
		//$email_to = "perapong.sitti@gmail.com";
		
		ini_set("SMTP", "$smtp_server");
		ini_set("sendmail_from", "$default_from");

		$MailTo = $email_to;
		$MailFrom = $email_from;
		//$MailSubject = "ทดสอบ ".date('Y-m-d H:i:s');
		//$MailMessage = "ทดสอบ" . date('Y-m-d H:i:s');
		$MailSubject = $subject;
		$MailMessage = $message;
	
		$Headers = "MIME-Version: 1.0\r\n" ;
		$Headers .= "Content-type: text/html; charset=windows-874\r\n" ;  // ส่งข้อความเป็นภาษาไทย ใช้ "windows-874"
		$Headers .= "From: ".$MailFrom." <".$MailFrom.">\r\n" ;
		$Headers .= "Reply-to: ".$MailFrom." <".$MailFrom.">\r\n" ;
		$Headers .= "Bcc:callcenter@bworder.com,webmaster@bworder.com" . "\r\n";

		$Headers .= "X-Priority: 3\r\n" ;
		$Headers .= "X-Mailer: PHP mailer\r\n" ;
		
		if(mail($MailTo, $MailSubject , $MailMessage, $Headers, $MailFrom))
		{
		//echo "Send Mail True" ;  //ส่งเรียบร้อย
		}else{
		echo "Send Mail False" ; //ไม่สามารถส่งเมล์ได้
		}

//$mail_sent = mail( $email_to, $subject, $message, $Headers ); // @ = No Show Error //


	

?> 


