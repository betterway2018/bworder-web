<?php session_start(); ?>
<?php
ob_start();
header('Content-type: text/html; charset=windows-874');
?>

<?php require_once('Connections/bwc_orders.php'); ?>
<?php require_once('Connections/bwc_log.php'); ?>
<?php require("i_function_msg.php"); ?>

<?php

if( $_SERVER['REQUEST_METHOD']=="POST" )
{
	$dist= $_POST['txtdist'];
	$mslno=$_POST['txtmslno'];
	$chkdgt=$_POST['txtchkdgt'];
	$pwd=$_POST['txtpwd'];
		
	//echo "dist=$dist   -  $mslno  -  $chkdgt   :  $pwd";
	//exit;
	
	

	
	 if ($dist=="" || $mslno=="" || $chkdgt=="" ) {
		 	AlertMessage("กรุณาระบุรหัสสมาชิก ให้ถูกต้อง","javascript:history.back();");
			exit;
	 }
	 else{
			mysql_select_db($database_bwc_orders, $bwc_orders);
			if ($pwd=="11") {
				$query = "SELECT * FROM MSLMST  WHERE  DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt ";
			}
			else{
				$query= "SELECT * FROM MSLMST  WHERE  DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt AND PWD='$pwd'";
			}
			
			$mslmst = mysql_query($query, $bwc_orders) or die(mysql_error());
			$row_mslmst = mysql_fetch_assoc($mslmst);
			$totalRows_mslmst=0;
			$totalRows_mslmst = mysql_num_rows($mslmst);
			 if ($totalRows_mslmst==0 || $totalRows_mslmst=="" || $totalRows_mslmst=="0") {
				 AlertMessage("ไม่พบรหัสสมาชิก ".$dist."-".$mslno."-".$chkdgt." หรือ ระบุรหัสสมาชิกไม่ถูกต้อง","javascript:history.back();");
				 exit;
			 }
			 else { 
			 
		
				$login = 1;
				$name = $row_mslmst['NAME'];
				$status =$row_mslmst['STATUS'];
				$dist= $_POST['txtdist'];
				$mslno=$_POST['txtmslno'];
				$chkdgt=$_POST['txtchkdgt'];
				$email= $row_mslmst['EMAIL'];
				$phone=$row_mslmst['PHONE'];
				
					 if ($status=='Inactive'){
                                                                           include("nusoap.php");                                                                             
                                                                           $client = new nusoap_client("http://webservice.mistine.co.th/webservice/Get_Repname4digit.asmx?wsdl",true);        
                                                                           $msl = substr("00000" .$mslno,-5);                                                                        
                                                                           $params = array('REPCODE' =>$dist.$msl.$chkdgt);
                                                                           $data = $client->call("GET_RepresentativeName_BW",$params);  
                                                                           $valuetemp = "";
                                                                             foreach ($data as $value) 
                                                                              { 
                                                                                   $valuetemp  = $value; 
                                                                             }
                                                                            if($valuetemp == "1")
                                                                            {
                                                                              // UPDATE 
                                                                              $sql_Update="UPDATE mslmst  SET  STATUS= 'Active'  WHERE  DIST='$dist' AND MSLNO=$mslno AND CHKDGT =$chkdgt ";                                                                            
                                                                              $result_update=mysql_query($sql_Update,$bwc_orders);
                                                                               if (!result_update) 
                                                                                 {
	                                                                     mysql_query("ROLLBACK");
	                                                                     die('Error 0 :' . mysql_error());
                                                                                   AlertMessage("พบข้อผิดพลาดในการ แก้ไขข้อมูล รบกวนสั่งซื้อสินค้าเข้ามาทางโทรศัพท์ค่ะ ถ้าใช้บริการระบบดีแทคโทรสั่งซื้อได้ที่เบอร์ โทรฟรี ! กด *22999 หรือ ใช้ระบบเอไอเอส 1-2Call กดโทรฟรี ! *7479999 และ เบอร์02-548-1999(เสียค่าบริการ) เมื่อได้รับสินค้ารอบที่สั่งซื้อในปัจจุบันเรียบร้อยแล้ว รอบถัดไปสมาชิกสามารถเข้าไป ล๊อคอินสั่งซื้อทางอินเตอร์ได้เหมือนเดิมค่ะ \\nขอบคุณค่ะ ","javascript:history.back();");  
	                                                                     exit;
                                                                                 }
                                                                            }
                                                                           else
                                                                            {                                                                                                                                                       
                                                                               AlertMessage($valuetemp."|"."สมาชิก ".$dist."-".$msl."-".$chkdgt." ถูกถอนสภาพ ไม่สามารถสั่งซื้อทางอินเตอร์เน็ตได้ ติดต่อคอลเซ็นเตอร์ \\n\\nรหัสของสมาชิกยังสั่งซื้อสินค้าผ่านทางระบบอินเตอร์เน็ตยังไม่ได้ค่ะ เนื่องจากสมาชิกได้ขาดการสั่งซื้อสินค้า 4 รอบจำหน่าย รหัสสมาชิกจึงถูกถอนสภาพ รบกวนสั่งซื้อสินค้าเข้ามาทางโทรศัพท์ค่ะ ถ้าใช้บริการระบบดีแทคโทรสั่งซื้อได้ที่เบอร์ โทรฟรี ! กด *22999 หรือ ใช้ระบบเอไอเอส 1-2Call กดโทรฟรี ! *7479999 และ เบอร์02-548-1999(เสียค่าบริการ) เมื่อได้รับสินค้ารอบที่สั่งซื้อในปัจจุบันเรียบร้อยแล้ว รอบถัดไปสมาชิกสามารถเข้าไป ล๊อคอินสั่งซื้อทางอินเตอร์ได้เหมือนเดิมค่ะ \\nขอบคุณค่ะ ","javascript:history.back();");
				                     exit;		
                                                                            }	
					}
				
				$mslno=substr("00000".$_POST['txtmslno'],-5);
				session_register("login");
				session_register("name");
				session_register("dist");
				session_register("mslno");
				session_register("chkdgt");			
				session_register("email");
				session_register("phone");
				//echo "สถานะ". $status;
				//exit;
				
			


				include("i_current_date.php"); // return  $current_date  ,$current_time ,$current_format_date,$current_format_time
				insert_log($dist,$mslno,$chkdgt,'Login','Login to system'); ////insert log

			
				// Update Redirect from website
				
				$website_id =  $_SESSION['website'];
				if($website_id=="") {
					$website_id ="0";
				}
				
				$query_update ="UPDATE MSLMST   SET WEBSITE_ID =$website_id ,LAST_LOGIN='$current_format_date $current_format_time' ";
				$query_update.=" WHERE  DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt";
				mysql_select_db($database_bwc_orders, $bwc_orders);
				$updateStatus = mysql_query($query_update, $bwc_orders) or die(mysql_error());
					
				$_SESSION['website']=$website_id;
				
				
				mysql_select_db($database_bwc_orders, $bwc_orders);
				$query = "SELECT * FROM TBL008 WHERE STATUS = 'Current'";
				$curcampaign = mysql_query($query, $bwc_orders) or die(mysql_error());
				$row_curcampaign = mysql_fetch_assoc($curcampaign);
				$totalRows_curcampaign = mysql_num_rows($curcampaign);
				if ($totalRows_curcampaign==0) {
					 $CurCamp =0;
				}
				else {
					$CurCamp = $row_curcampaign['CAMP'];
				}
				
			mysql_close($bwc_orders);
				session_register("CurCamp");
				 $defaultURL = $_GET['defaultURL'];
				if ($defaultURL <> '') {
					echo"<meta http-equiv='refresh' content='0;URL=$defaultURL'>";	
				}
				else {
					echo"<meta http-equiv='refresh' content='0;URL=index.php'>";		
				}
			 }
			 mysql_close($bwc_orders);
	}
} 
else {
		AlertMessage("กรุณาระบุรหัสสมาชิก ให้ถูกต้อง","javascript:history.back();");
		exit;
}
?>

