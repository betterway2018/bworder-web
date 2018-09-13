<?php 
/*
Input Paramter   : 	$email_from 
							$email_to
							$subject
							$message
							
Output Parameter : $mail_sent

*/


	//$smtp_server="smtpweb.netdesignhost.com";
	$smtp_server="smtp.kirz.com";
	$default_from = "callcenter@bworder.com";
	$default_to ="sutasinee_w@mistine.co.th";
	//$default_to ="bw.mistine@gmail.com";
	$default_cc ="";
	$default_bcc ="bw.mistine@gmail.com";
		
	$email_footer ='<font style="font-family:Tahoma, Geneva, sans-serif;font-size:12 ;color:#252525">';
	$email_footer .= '<br><br><b>หมายเหตุ : </b> อีเมลล์ฉบับนี้เป็นการแจ้งข้อมูลอัตโนมัติ กรุณาอย่าตอบกลับ<br />';
	$email_footer .='หากต้องการสอบถามรายละเอียดเพิ่มเติมกรุณาส่งคำถามผ่านทางเมนู ';
	$email_footer .='<a href="http://www.bworder.com/contact_us.php';
	$email_footer .='?id='.$_SESSION['dist'].$_SESSION['mslno'].$_SESSION['chkdgt'];
	$email_footer .='" target=""_blank""> ติดต่อสอบถาม </a> หรือติดต่อผ่านทาง Call Center  <br />' ;
	$email_footer .='โทรฟรี !  ทั่วประเทศ สำหรับผู้ใช้บริการ เอไอเอสและวันทูคอล<br />';
	$email_footer .='กดรหัสพิเศษ *7479000   หรือโทร.0-2548-1555 (เสียค่าโทร) <br />' ;
	$email_footer .='วันจันทร์-ศุกร์ เวลา 8.00-24.00 น.    วันเสาร์-อาทิตย์ เวลา 8.00-17.30 น. <br /></font>' ;
						

		
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
		$MailSubject = "ทดสอบ ".date('Y-m-d H:i:s');
		$MailMessage = "ทดสอบ" . date('Y-m-d H:i:s');
	
		$Headers = "MIME-Version: 1.0\r\n" ;
		$Headers .= "Content-type: text/html; charset=windows-874\r\n" ;
								  // ส่งข้อความเป็นภาษาไทย ใช้ "windows-874"
		$Headers .= "From: ".$MailFrom." <".$MailFrom.">\r\n" ;
		$Headers .= "Reply-to: ".$MailFrom." <".$MailFrom.">\r\n" ;
		$Headers .= "Bcc: bw.mistine@gmail.com" . "\r\n";
		$Headers .= "X-Priority: 3\r\n" ;
		$Headers .= "X-Mailer: PHP mailer\r\n" ;
		
		if(mail($MailTo, $MailSubject , $MailMessage, $Headers, $MailFrom))
		{
		echo "Send Mail True" ;  //ส่งเรียบร้อย
		}else{
		echo "Send Mail False" ; //ไม่สามารถส่งเมล์ได้
		}

//$mail_sent = mail( $email_to, $subject, $message, $Headers ); // @ = No Show Error //


	

?> 


