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
		 	AlertMessage("��س��к�������Ҫԡ ���١��ͧ","javascript:history.back();");
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
				 AlertMessage("��辺������Ҫԡ ".$dist."-".$mslno."-".$chkdgt." ���� �к�������Ҫԡ���١��ͧ","javascript:history.back();");
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
                                                                                   AlertMessage("����ͼԴ��Ҵ㹡�� ��䢢����� ú�ǹ��觫����Թ�������ҷҧ���Ѿ���� ������ԡ���к���ᷤ����觫����������� �ÿ�� ! �� *22999 ���� ���к�������� 1-2Call ���ÿ�� ! *7479999 ��� ����02-548-1999(���¤�Һ�ԡ��) ��������Ѻ�Թ����ͺ�����觫���㹻Ѩ�غѹ���º�������� �ͺ�Ѵ���Ҫԡ����ö���� ��ͤ�Թ��觫��ͷҧ�Թ����������͹������ \\n�ͺ�س��� ","javascript:history.back();");  
	                                                                     exit;
                                                                                 }
                                                                            }
                                                                           else
                                                                            {                                                                                                                                                       
                                                                               AlertMessage($valuetemp."|"."��Ҫԡ ".$dist."-".$msl."-".$chkdgt." �١�͹��Ҿ �������ö��觫��ͷҧ�Թ�������� �Դ��ͤ�������� \\n\\n���ʢͧ��Ҫԡ�ѧ��觫����Թ��Ҽ�ҹ�ҧ�к��Թ�������ѧ������� ���ͧ�ҡ��Ҫԡ��Ҵ�����觫����Թ��� 4 �ͺ��˹��� ������Ҫԡ�֧�١�͹��Ҿ ú�ǹ��觫����Թ�������ҷҧ���Ѿ���� ������ԡ���к���ᷤ����觫����������� �ÿ�� ! �� *22999 ���� ���к�������� 1-2Call ���ÿ�� ! *7479999 ��� ����02-548-1999(���¤�Һ�ԡ��) ��������Ѻ�Թ����ͺ�����觫���㹻Ѩ�غѹ���º�������� �ͺ�Ѵ���Ҫԡ����ö���� ��ͤ�Թ��觫��ͷҧ�Թ����������͹������ \\n�ͺ�س��� ","javascript:history.back();");
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
				//echo "ʶҹ�". $status;
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
		AlertMessage("��س��к�������Ҫԡ ���١��ͧ","javascript:history.back();");
		exit;
}
?>

