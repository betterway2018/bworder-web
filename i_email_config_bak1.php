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
	$email_footer .= '<br><br><b>�����˵� : </b> ������쩺Ѻ����繡���駢������ѵ��ѵ� ��س����ҵͺ��Ѻ<br />';
	$email_footer .='�ҡ��ͧ����ͺ�����������´���������س��觤Ӷ����ҹ�ҧ���� ';
	$email_footer .='<a href="http://www.bworder.com/contact_us.php';
	$email_footer .='?id='.$_SESSION['dist'].$_SESSION['mslno'].$_SESSION['chkdgt'];
	$email_footer .='" target=""_blank""> �Դ����ͺ��� </a> ���͵Դ��ͼ�ҹ�ҧ Call Center  <br />' ;
	$email_footer .='�ÿ�� !  ���ǻ���� ����Ѻ������ԡ�� �����������ѹ�٤��<br />';
	$email_footer .='�����ʾ���� *7479000   ������.0-2548-1555 (���¤����) <br />' ;
	$email_footer .='�ѹ�ѹ���-�ء�� ���� 8.00-24.00 �.    �ѹ�����-�ҷԵ�� ���� 8.00-17.30 �. <br /></font>' ;
						
?>
