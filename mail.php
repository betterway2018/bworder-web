<?PHP
require_once('phpmail/class.phpmailer.php');
		$mail = new PHPMailer(true);
		$mail->IsSMTP();
		$mail->Host = "mailcorp.truemail.co.th";
		$mail->Port = 25;
		$mail->CharSet="windows-874";
		$mail->SMTPSecure = 'tls';
		$mail->SMTPAuth = true;
		$mail->Username = "bworder-05@mistine.co.th";
		$mail->Password = "sd1234";
		$mail->From = 'bworder-05@mistine.co.th';
		$mail->FromName = 'ข้อความเเจ้งเตือนเอกสารใบขออัตรากำลังคน';
		$mail->Priority = 1; 
		//$mail->AddAddress('jiraporn_t@mistine.co.th');
		$mail->AddAddress('sssai7611@gmail.com');
		//$mail->AddBCC('jiraporn_t@mistine.co.th');
		$mail->IsHTML(true);
		
		$mail->Subject = "แจ้งเอกสารใบขออัตรากำลังคน";
		$mail->Body    = "เอกสารได้รับการอนุมัติจากคุณ......" ;		

		$result = $mail->Send();

		if(!$result) {
			echo "Mailer Error: " . $mail->ErrorInfo;
			return "1" ;
		} else {
			echo "Message sent!";header("Location:http://smartdevice.mistine.co.th:93/HR_R&SS/index2.php");
    
			return "1" ;
		}
		
    

?>
