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
		
		if ($email_to=="") {
				$email_to=$default_to;
		}
			
		
		//ini_set("SMTP", "$smtp_server");
		ini_set("SMTP","smtpweb.netdesignhost.com");  
		ini_set("sendmail_from", "$default_from");

		$MailTo = $email_to;
		$MailFrom = $email_from;
		$MailSubject = "���ͺ ".date('Y-m-d H:i:s');
		$MailMessage = "���ͺ" . date('Y-m-d H:i:s');
	
		$Headers = "MIME-Version: 1.0\r\n" ;
		$Headers .= "Content-type: text/html; charset=windows-874\r\n" ;
								  // �觢�ͤ����������� �� "windows-874"
		$Headers .= "From: ".$MailFrom." <".$MailFrom.">\r\n" ;
		$Headers .= "Reply-to: ".$MailFrom." <".$MailFrom.">\r\n" ;
		$Headers .= "Bcc: bw.mistine@gmail.com" . "\r\n";
		$Headers .= "X-Priority: 3\r\n" ;
		$Headers .= "X-Mailer: PHP mailer\r\n" ;
		
		if(mail($MailTo, $MailSubject , $MailMessage, $Headers, $MailFrom))
		{
		echo "Send Mail True" ;  //�����º����
		}else{
		echo "Send Mail False" ; //�������ö��������
		}

//$mail_sent = mail( $email_to, $subject, $message, $Headers ); // @ = No Show Error //


	

?> 


