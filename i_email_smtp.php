<?php

	require("PHPMailer_v5.0.2/class.phpmailer.php");
$mail = new PHPMailer();

$body = "���¹ �س�� ���� 0999-549-9 �駼š����觫����Թ��ҷҧ�Թ������ http://www.bworder.com ���� PHPMailer.";

$mail->CharSet = "tis-620";
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = false;
$mail->Host = "localhost"; // SMTP server
$mail->Port = 25; // ����
$mail->Username = "callcenterinfo@bworder.com"; // account SMTP
$mail->Password = "123456"; // ���ʼ�ҹ SMTP

$mail->SetFrom("callcenterinfo@bworder.com", "callcenterinfo@bworder.com");
$mail->AddReplyTo("callcenterinfo@bworder.com", "callcenterinfo@bworder.com");
$mail->Subject = "test ���ͺ PHPMailer.";

$mail->MsgHTML($body);

$mail->AddAddress("wi1926chian@gmail.com", "recipient1"); // ����Ѻ�����˹��
 

if(!$mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
						
?>
<?php
	$smtp_server="localhost";	 
	$default_from = "callcenterinfo@bworder.com";
	$default_to ="bw.mistine@gmail.com";
	$default_cc ="";
	$default_bcc ="bw.mistine@gmail.com";
	$email_footer ='<font style="font-family:Tahoma, Geneva, sans-serif;font-size:12 ;color:#252525">';
	$email_footer .= '<br><br><b>�����˵� : </b> ������쩺Ѻ����繡���駢������ѵ��ѵ� ��س����ҵͺ��Ѻ<br />';
	$email_footer .='�ҡ��ͧ����ͺ�����������´���������س��觤Ӷ����ҹ�ҧ���� ';
	$email_footer .='<a href="http://www.bworder.com/contact_us.php';
	$email_footer .='?id='.$_SESSION['dist'].$_SESSION['mslno'].$_SESSION['chkdgt'];
	$email_footer .='" target=""_blank""> �Դ����ͺ��� </a> ���͵Դ��ͼ�ҹ�ҧ Call Center  <br />' ;
	$email_footer .='�ÿ�� !  ���ǻ���� ����Ѻ������ԡ�� �����������ѹ�٤��<br />';
	$email_footer .='�����ʾ���� *7479000   ������.0-2548-1555 (���¤����) <br />' ;
	$email_footer .='�ѹ�ѹ���-�ء�� ���� 8.00-24.00 �.    �ѹ�����-�ҷԵ�� ���� 8.00-17.30 �. <br /></font>' ;
						
?>

