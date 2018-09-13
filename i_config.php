<?php
$title="Betterway Internet Order ";
$maintenance="no";
$maintenance_msg="";
ob_start();
//header('Content-Type: text/html; charset=UTF-8');
$url_webservice="http://10.0.0.119/bworder/";
$campaign_limit = 4;

// Script เอาไว้ปิดเว็บไซต์เพื่อปรับปรุง


		/*open
		$date_now  = new  DateTime("now"); 
		$st_dt = new DateTime('2012-02-28 11:30:00'); 
		$end_dt = new DateTime('2012-02-28 14:30:00');  
		
		
		if ($date_now>$st_dt && $date_now <=$end_dt)  {
			 
		 /*open
		 $maintenance ="yes";
		 $maintenance_msg="ขออภัยในความไม่สะดวกค่ะ <br> เนื่องจากขณะนี้มีการปิดปรับปรุงระบบชั่วคราว  ท่านสามารถสั่งซื้อสินค้าได้ตามปกติ<br>";
		 $maintenance_msg= $maintenance_msg . "แต่ท่านจะไม่สามารถใช้งานได้  2 เมนูดังนี้  ";
		 $maintenance_msg=$maintenance_msg."<strong><ol><li>ประวัติการสั่งซื้อ</li><li>สอบถามยอดค้างชำระและคะแนน </li></ol></strong>";
		
		 $maintenance_msg=$maintenance_msg."ระบบจะกลับมาใช้งานได้ตามปกติ   <strong>ในวันที่  " .  $end_dt->format('d/m/Y H:i:s')  ." เป็นต้นไปค่ะ</strong>";	 
		 }
		else {
		 $maintenance="no";
		 }
		
		 close*/

?>