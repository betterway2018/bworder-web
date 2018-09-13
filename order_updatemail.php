<?php 
               header('Content-type: text/html; charset=windows-874');

                 $to     = $_GET['to'];
                 $msg_header     = $_GET['msg_header'];
                 $msg  = $_GET['msg']; 
                 
                 
                echo "111" . "\r\n";
                echo $to. "\r\n";
                echo "222" . "\r\n";
                echo $msg_header. "\r\n";
                echo "333" . "\r\n";
                echo $msg. "\r\n";  
                echo "444" . "\r\n";
                 
//	              include("i_email_config.php");  		
//		if ($email_from=="") {
//	                         $email_from=$default_from;
//		}		
//		if ($to=="") {
//	                         $to=$default_to;
//		}
//		
//		ini_set("SMTP", "$smtp_server");
//		ini_set("sendmail_from", "$default_from");
//
//		$MailTo = $to;
//		$MailFrom = $email_from;
//		$MailSubject = "แจ้งผลการสั่งซื้อสินค้าทางอินเตอร์เน็ต http://www.bworder.com ";
//		
//		$Headers = "MIME-Version: 1.0\r\n" ;
//		$Headers .= "Content-type: text/html; charset=windows-874\r\n" ;	 
//		$Headers .= "From: ".$MailFrom."\r\n" ;
//		$Headers .= "Reply-to: ".$MailFrom."\r\n" ;
//		if ($default_cc!=="") {
//			$Headers .= "Cc: ".$default_cc . "\r\n";
//		}
//		if ($default_bcc!=="") {
//			$Headers .= "Bcc: ". $default_bcc . "\r\n";
//		}
//		
//		$Headers .= "X-Priority: 3\r\n" ;
//		$Headers .= "X-Mailer: PHP mailer\r\n" ;		
//		$MailMessage = $msg;
//                             echo $MailTo . "\r\n";
//                             echo $MailSubject  . "\r\n";
//                             echo $MailMessage  . "\r\n";
//                             echo $Header . "\r\n";
//                             echo $MailFrom . "\r\n";                                  
                       
                             
		// if(mail($MailTo, $MailSubject , $MailMessage, $Headers, $MailFrom))
		 

?>

