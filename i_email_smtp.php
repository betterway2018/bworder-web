<?php

	require("PHPMailer_v5.0.2/class.phpmailer.php");
$mail = new PHPMailer();

$body = "เรียน คุณเปา รหัส 0999-549-9 แจ้งผลการสั่งซื้อสินค้าทางอินเตอร์เน็ต http://www.bworder.com ด้วย PHPMailer.";

$mail->CharSet = "tis-620";
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = false;
$mail->Host = "localhost"; // SMTP server
$mail->Port = 25; // พอร์ท
$mail->Username = "callcenterinfo@bworder.com"; // account SMTP
$mail->Password = "123456"; // รหัสผ่าน SMTP

$mail->SetFrom("callcenterinfo@bworder.com", "callcenterinfo@bworder.com");
$mail->AddReplyTo("callcenterinfo@bworder.com", "callcenterinfo@bworder.com");
$mail->Subject = "test ทดสอบ PHPMailer.";

$mail->MsgHTML($body);

$mail->AddAddress("wi1926chian@gmail.com", "recipient1"); // ผู้รับคนที่หนึ่ง
 

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
	$email_footer .= '<br><br><b>หมายเหตุ : </b> อีเมลล์ฉบับนี้เป็นการแจ้งข้อมูลอัตโนมัติ กรุณาอย่าตอบกลับ<br />';
	$email_footer .='หากต้องการสอบถามรายละเอียดเพิ่มเติมกรุณาส่งคำถามผ่านทางเมนู ';
	$email_footer .='<a href="http://www.bworder.com/contact_us.php';
	$email_footer .='?id='.$_SESSION['dist'].$_SESSION['mslno'].$_SESSION['chkdgt'];
	$email_footer .='" target=""_blank""> ติดต่อสอบถาม </a> หรือติดต่อผ่านทาง Call Center  <br />' ;
	$email_footer .='โทรฟรี !  ทั่วประเทศ สำหรับผู้ใช้บริการ เอไอเอสและวันทูคอล<br />';
	$email_footer .='กดรหัสพิเศษ *7479000   หรือโทร.0-2548-1555 (เสียค่าโทร) <br />' ;
	$email_footer .='วันจันทร์-ศุกร์ เวลา 8.00-24.00 น.    วันเสาร์-อาทิตย์ เวลา 8.00-17.30 น. <br /></font>' ;
						
?>

