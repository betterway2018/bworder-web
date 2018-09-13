<?php
	 include('i_email_config.php'); 
	require("PHPMailer_v5.0.2/class.phpmailer.php");
$mail = new PHPMailer();

$body = "เรียน คุณเปา รหัส 0999-549-9 แจ้งผลการสั่งซื้อสินค้าทางอินเตอร์เน็ต http://www.bworder.com ด้วย PHPMailer.";

$mail->CharSet = "tis-620";
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = false;
$mail->Host = $smtp_server; // SMTP server
//$mail->Host = "smtpweb.netdesignhost.com"; // SMTP server
$mail->Port = 25; // พอร์ท
$mail->Username = $username; // account SMTP
$mail->Password = $password; // รหัสผ่าน SMTP

$mail->SetFrom($default_from);
//$mail->AddReplyTo("callcenterinfo@bworder.com", "callcenterinfo@bworder.com");
$mail->Subject = "test ทดสอบ PHPMailer.1640";

$mail->MsgHTML($body.$email_footer );

$mail->AddAddress("paolopaolo886@hotmail.com", "recipient1"); // ผู้รับคนที่หนึ่ง
$mail->AddAddress("paolopaolo137@gmail.com", "recipient2"); // ผู้รับคนที่สอง

if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!!!!!!!";
}
						
?>
