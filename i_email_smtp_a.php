<?php
	 include('i_email_config.php'); 
	require("PHPMailer_v5.0.2/class.phpmailer.php");
$mail = new PHPMailer();

$body = "���¹ �س�� ���� 0999-549-9 �駼š����觫����Թ��ҷҧ�Թ������ http://www.bworder.com ���� PHPMailer.";

$mail->CharSet = "tis-620";
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = false;
$mail->Host = $smtp_server; // SMTP server
//$mail->Host = "smtpweb.netdesignhost.com"; // SMTP server
$mail->Port = 25; // ����
$mail->Username = $username; // account SMTP
$mail->Password = $password; // ���ʼ�ҹ SMTP

$mail->SetFrom($default_from);
//$mail->AddReplyTo("callcenterinfo@bworder.com", "callcenterinfo@bworder.com");
$mail->Subject = "test ���ͺ PHPMailer.1640";

$mail->MsgHTML($body.$email_footer );

$mail->AddAddress("paolopaolo886@hotmail.com", "recipient1"); // ����Ѻ�����˹��
$mail->AddAddress("paolopaolo137@gmail.com", "recipient2"); // ����Ѻ������ͧ

if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!!!!!!!";
}
						
?>
