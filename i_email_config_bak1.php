<?php
	$smtp_server="smtpweb.netdesignhost.com";
	//$smtp_server="smtp.kirz.com";
	$default_from = "callcenter@bworder.com";
	//$default_to ="sutasinee_w@mistine.co.th";
	$default_to ="bw.mistine@gmail.com";
	$default_cc ="";
	$default_bcc ="bw.mistine@gmail.com";
	//$default_bcc ="nawin.minth@gmail.com";
		
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
