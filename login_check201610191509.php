<?php session_start(); 
ob_start();
require_once('include/i_config.php'); 
require_once('Connections/bwc_orders.php'); 
require_once('Connections/bwc_log.php'); 
require_once('Connections/bw_etl.php'); 
require_once('include/functionphp.inc');
require("i_function_msg.php"); 
error_reporting(0);
$_SERVER['REQUEST_METHOD']="POST";

if($_SERVER['REQUEST_METHOD']== "POST" )
{
	$dist= $_POST['txtdist'];
	$mslno=$_POST['txtmslno'];
	$chkdgt=$_POST['txtchkdgt'];
	$pwd=$_POST['txtpwd'];
		
	//echo "dist=$dist   -  $mslno  -  $chkdgt   :  $pwd";
	//exit;
	if ($dist=="" || $mslno=="" || $chkdgt=="" ) {
			AlertMessage("กรุณาใส่รหัสสมาชิก และ รหัสผ่านค่ะ","javascript:history.back();");
			exit;
	} else if ($pwd == "") {
			AlertMessage("กรุณาใส่รหัสสมาชิก และ รหัสผ่านค่ะ ","javascript:history.back();");
			exit;
	}else{
			mysql_select_db($database_bwc_orders, $bwc_orders);
			mysql_query("SET NAMES 'UTF8'");
			if ($pwd=="QZasq27A") {
				$query = "SELECT * FROM MSLMST  WHERE  DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt ";
			}
			else{
				$query= "SELECT * FROM MSLMST  WHERE  DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt AND PWD='$pwd'";
			}
			//echo $query; exit;
			
			$mslmst = mysql_query($query, $bwc_orders) or die(mysql_error());
			$row_mslmst = mysql_fetch_assoc($mslmst);
			$rep_seq =$row_mslmst['rep_seq'];
			$PHONE =$row_mslmst['PHONE'];
			
			//echo "REP_SEQ".$rep_seq ;
			//exit;
			$totalRows_mslmst=0;
			$totalRows_mslmst = mysql_num_rows($mslmst);
			//echo $totalRows_mslmst."DDDDD"; exit;
			if ($totalRows_mslmst==0 || $totalRows_mslmst=="" || $totalRows_mslmst=="0")
			{
				 //AlertMessage("ไม่พบรหัสสมาชิก ".$dist."-".$mslno."-".$chkdgt." หรือ ระบุรหัสสมาชิกไม่ถูกต้อง","javascript:history.back();");
			$_dist=$row_mslmst['DIST'];
			$_mslno=$row_mslmst['MSLNO'];
			$_chkdgt=$row_mslmst['CHKDGT'];
            $mslno=str_pad($mslno,5, "0", STR_PAD_LEFT);
			$str=$dist.$mslno.$chkdgt;
			$query_01= "SELECT  mslmst.DIST,
						mslmst.MSLNO,
						mslmst.CHKDGT,
						count(*) as num 
						FROM MSLMST 
						WHERE rep_code_new ='".$str."'  group by mslmst.DIST ";
			$mslmst_01 = mysql_query($query_01, $bwc_orders) or die(mysql_error());
			$row_mslmst_01 = mysql_fetch_assoc($mslmst_01);       
			//echo    $query_01;	 exit;
            $num = $row_mslmst_01['num'];			
			$_dist = $row_mslmst_01['DIST'];
			$_mslno = $row_mslmst_01['MSLNO'];
			$_mslno=str_pad($_mslno,5, "0", STR_PAD_LEFT);
			$_chkdgt = $row_mslmst_01['CHKDGT'];

					if ($num > 0)
					{
					 AlertMessage("ขออภัยค่ะ รหัสสมาชิกของคุณมีการเปลี่ยนแปลงเนื่องจากมีการย้ายที่อยู่ กรุณาใช้รหัสสมาชิกใหม่ $_dist - $_mslno -$_chkdgt และรหัสผ่านเดิมในการสั่งซื้อสินค้าค่ะ ","javascript:history.back();");
					
					}		
					 else
					 {

					AlertMessage("ขออภัยค่ะ กรุณาตรวจสอบความถูกต้องของรหัสสมาชิกและรหัสผ่าน อีกครั้ง \\n หรือโทรสอบถามข้อมูลเพิ่มเติมที่ศูนย์บริการสมาชิก เบอร์  02-1185111 คะ","javascript:history.back();");
					 }
		
				 exit;
			 
	
		
			} else { 
				$login = 1;
				$name = $row_mslmst['NAME'];
				$status =$row_mslmst['STATUS'];
				$dist= $_POST['txtdist'];
				$mslno=$_POST['txtmslno'];
				$chkdgt=$_POST['txtchkdgt'];
				
				//$rep_seq =$row_mslmst['rep_seq'];
				//echo $rep_seq."ddd";
				$mslno=str_pad($mslno,5, "0", STR_PAD_LEFT);
				$mslno_01=str_pad($mslno,5, "0", STR_PAD_LEFT);
				$email= $row_mslmst['EMAIL'];
				$phone=$row_mslmst['PHONE'];
				$regdate=$row_mslmst['REG_DATE'];
				$repcode_flag=$row_mslmst['repcode_flag'];
				$rep_code_new=$row_mslmst['rep_code_new'];
				 $Strdist = substr($rep_code_new,0, 4);
				 $Strmslno = substr($rep_code_new,4, 5);
				 $Strmslno=str_pad($Strmslno,5, "0", STR_PAD_LEFT);
				 $Strchkdgt = substr($rep_code_new,9, 1);

	///////////////////  GET Paramete  MSLMST_ETL//////////////////////////////////////

		  $query_= " SELECT
							mslmst.REP_SEQ,
							mslmst.GOLDCLUB as GOLDCLUB_ETL 
							,mslmst.REP_STATUS as STATUS_ETL,
							mslmst.YUPIN_STATUS,
							mslmst.YUPIN_REGISTER,
							FORMAT(BPRBALANCE, 0) AS point 
							FROM
							mslmst where  REP_SEQ  = ".$rep_seq;
						 $mslmst_01 = mysql_query($query_, $bw_etl) or die(mysql_error());
						 $row_mslmst_01 = mysql_fetch_assoc($mslmst_01);     
						 $mslmst_bw_etl = mysql_num_rows($mslmst_01);			 
			//echo    $query_;	 exit;
                     //$rep_seq = $row_mslmst_01['REP_SEQ'];	
                     $GOLDCLUB_ETL = $row_mslmst_01['GOLDCLUB_ETL'];
					 $STATUS_ETL = $row_mslmst_01['STATUS_ETL'];
					 $point = $row_mslmst_01['point'];
					 $YUPIN_STATUS = $row_mslmst_01['YUPIN_STATUS'];
					// echo $YUPIN_STATUS; exit;
					 $YUPIN_REGISTER = $row_mslmst_01['YUPIN_REGISTER'];
					 
					  if($STATUS_ETL == 'NM' )
						{

						$status = 'Inactive';
						$sqlGOLDCLUB=" UPDATE MSLMST SET GOLDCLUB  = '$GOLDCLUB_ETL',STATUS  = '$status'  WHERE   rep_seq=".$rep_seq; 
						$result_update=mysql_query($sqlGOLDCLUB,$bwc_orders) or die(mysql_error());


						}
						else
						{
							 if ($mslmst_bw_etl==0)
							 {
								 $status = 'Inactive'; 
								 $sqlGOLDCLUB_Inactive=" UPDATE MSLMST SET STATUS  = 'Inactive'  WHERE   rep_seq=".$rep_seq; 
								//  $result_update_Inactive=mysql_query($sqlGOLDCLUB_Inactive,$bwc_orders) or die(mysql_error());								 
							 }
							 else
							 {  
								  $status = 'Active';
								 
							 }

						}
						
						/*
					  if(isset($GOLDCLUB_ETL) )
						{ // echo "FFF";
                        $sqlGOLDCLUB=" UPDATE MSLMST SET GOLDCLUB  = '$GOLDCLUB_ETL',STATUS  = '$status'  WHERE   rep_seq=$rep_seq ";  
						 
						 $result_update=mysql_query($sqlGOLDCLUB,$bwc_orders) or die(mysql_error());
						 $GOLDCLUB=$GOLDCLUB_ETL;
					    }
						else
						{
						   
						 $sqlGOLDCLUB=" UPDATE MSLMST SET GOLDCLUB  = '',STATUS  = '$status'  WHERE   rep_seq=$rep_seq ";  
						 
						 $result_update=mysql_query($sqlGOLDCLUB,$bwc_orders) or die(mysql_error());
						 $GOLDCLUB=" ";
						}
*/


		     //   echo $query_; exit;

/////////////////////////////  GET Paramete  MSLMST_ETL//////////////////////////////////////
	



				if ($repcode_flag == 'N')
				{
				  echo "<script type=\"text/javascript\">alert('ขออภัยค่ะ รหัสสมาชิก  $dist - $mslno_01 - $chkdgt มีการโอนย้ายเขต เนื่องจากมีการเปลี่ยนเเปลงที่อยู่ เพื่อเป็นการรักษาสิทธิประโยชน์ต่างๆของสมาชิกในการสั่งซื้อสินค้าในครั้งถัดไป กรุณาใช้รหัสสมาชิกใหม่  $Strdist -$Strmslno - $Strchkdgt และรหัสผ่านเดิม ในการสั่งซื้อสินค้าค่ะ ') </script>";
				  
				        
				 $Strdist = substr($rep_code_new,0, 4);
				 $Strmslno = substr($rep_code_new,4, 5);
				 $Strchkdgt = substr($rep_code_new,9, 1);
                 $dist_50=str_pad($dist,4, "0", STR_PAD_LEFT);

				    $str=$dist.$mslno.$chkdgt;
					$query_chk_regis= "SELECT count(*) as num FROM MSLMST 
					WHERE DIST='$Strdist' AND MSLNO=$Strmslno AND CHKDGT=$Strchkdgt";
					$mslmst_chk_regis = mysql_query($query_chk_regis, $bwc_orders) or die(mysql_error());
					$row_chk_regis = mysql_fetch_assoc($mslmst_chk_regis);
					//echo $query_chk_regis; exit;
					$num = $row_chk_regis['num'];
					if ($num >= 1)
					{ //กรณีนำรหัสใหม่  Register ก่อน  ระบบ Update  รหัสใหม่ให่้อัตโนมัคิ
					$sqlUpdateNew_rep=" UPDATE MSLMST SET repcode_flag ='O' ,rep_code_new='".$Strdist.$Strmslno.$Strchkdgt."',STATUS ='Inactive' WHERE DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt "; 
					//echo $sqlUpdateNew_rep; 
				      $result_update=mysql_query($sqlUpdateNew_rep,$bwc_orders) or die(mysql_error());

					}
					else
					{		

					 $sqlUpdateNew_rep=" UPDATE MSLMST SET DIST  ='$Strdist',MSLNO =  $Strmslno ,CHKDGT = $Strchkdgt,repcode_flag ='O' ,
					 rep_code_new='".$dist_50.$mslno.$chkdgt."' WHERE DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt ";  
					 $result_update=mysql_query($sqlUpdateNew_rep,$bwc_orders) or die(mysql_error());
					}


				 	$dist= $Strdist;
					$mslno= $Strmslno;
					$chkdgt=$Strchkdgt;
				 //echo "<script type='text/javascript'>window.location.href = \"login.php\";

				}
				//echo $status; exit;
					if ($status=='Inactive')
					  {
						$valuetemp = "";
						$msl = substr("00000" .$mslno,-5);                                                                        
						$rep_code = $dist.$msl.$chkdgt;

						require_once('nusoap.php'); 
						$ws_client = new soapclient($url_webservice.'get_repinfo.php?wsdl',true);
						$data = repinfo($rep_code,$ws_client);
						if ($aInfo = explode('|', $data)) { 
							$valuetemp = $aInfo[0];
						}

						
						if($valuetemp == "1")
						{
						  // UPDATE 
							$sql_Update="UPDATE MSLMST SET STATUS= 'Active' WHERE DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt ";                                                                            
							$result_update=mysql_query($sql_Update,$bwc_orders);
							if (!result_update) {
								mysql_query("ROLLBACK");
								die('Error 0 :' . mysql_error());
								AlertMessage("พบข้อผิดพลาดในการ แก้ไขข้อมูล รบกวนสั่งซื้อสินค้าเข้ามาทางโทรศัพท์ค่ะ ถ้าใช้บริการระบบดีแทคโทรสั่งซื้อได้ที่เบอร์ โทรฟรี ! กด *22999 หรือ ใช้ระบบเอไอเอส 1-2Call กดโทรฟรี ! *7479999 และ เบอร์02-548-1999(เสียค่าบริการ) เมื่อได้รับสินค้ารอบที่สั่งซื้อในปัจจุบันเรียบร้อยแล้ว รอบถัดไปสมาชิกสามารถเข้าไป ล๊อคอินสั่งซื้อทางอินเตอร์ได้เหมือนเดิมค่ะ \\nขอบคุณค่ะ ","javascript:history.back();");  
								exit;
							}
						}
						else
						{   
					        
						$v_Message="ขออภัยค่ะ กรุณาตรวจสอบความถูกต้องของสมาชิกและรหัสผ่าน อีกครั้ง \\n หรือโทรสอบถามข้อมูลเพิ่มเติมที่ศูนย์บริการสมาชิก เบอร์  02-1185111 คะ";

							//$v_Message="ขออภัยค่ะ รหัสสมาชิกของคุณมีการเปลี่ยนแปลงเนื่องจากมีการย้ายที่อยู่ กรุณาใช้รหัสสมาชิกใหม่ $Strdist -$Strmslno -$Strchkdgt  และ รหัสผ่านเดิมในการสั่งซื้อสินค้าค่ะ";
							AlertMessage($v_Message,"javascript:history.back();");
							exit;		
						}	
					}
				
				/*
					if ($status=='DEL')
					  {
						  $v_Message="รหัสของท่านไม่อยู่ในระบบ โทรสอบถามข้อมูลเพิ่มเติมที่ศูนย์บริการสมาชิก เบอร์  02-1185111 ";
						  AlertMessage($v_Message,"javascript:history.back();");
							exit;
					  }
					  
					  */
			    require_once('check_accessed_device.php');
				session_register("login");
				session_register("name");
				session_register("dist");
				session_register("mslno");
			    session_register("rep_seq");
				session_register("GOLDCLUB");
				session_register("chkdgt");
				session_register("email");
				session_register("phone");
				session_register("regdate");
				session_register("CurCamp");
				session_register("flagalert");
				session_register("point");
				$_SESSION['flagalert']=1;
				session_register("YUPIN_STATUS");
				session_register("YUPIN_REGISTER");
				session_register("PHONE");
				//echo "สถานะ". $status;
				
				include("i_current_date.php"); // return  $current_date  ,$current_time ,$current_format_date,$current_format_time
				insert_log($dist,$mslno,$chkdgt,'Login','Login to system'); ////insert log
				
				// Update Redirect from website
				if ($pwd<>"-1234567890-") {
					$website_id = $_SESSION['website'];
					if($website_id=="") {
						$website_id ="0";
					}
				
					$query_update ="UPDATE MSLMST SET WEBSITE_ID =$website_id ,LAST_LOGIN='$current_format_date $current_format_time' ";
					$query_update.=" WHERE DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt";

					$updateStatus = mysql_query($query_update,$bwc_orders ) or die(mysql_error()); 
				}
				
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

				//mysql_close($bwc_orders);
				$defaultURL = $_GET['defaultURL'];
				if ($defaultURL <> '') {
					echo"<meta http-equiv='refresh' content='0;URL=$defaultURL'>";	
				}
				else {  $_SESSION["CurCamp"] =$CurCamp;
					echo"<meta http-equiv='refresh' content='0;URL=index.php?CurCamp'>";		
				}
			}
			mysql_close($bwc_orders);
//echo "perapong</br>".$curcamp; exit; 
	}
} 
else {
		AlertMessage("ขออภัยค่ะ กรุณาตรวจสอบความถูกต้องของสมาชิกและรหัสผ่าน อีกครั้ง \\n หรือ
โทรสอบถามข้อมูลเพิ่มเติมที่ศูนย์บริการสมาชิก เบอร์  02-1185111 คะ","javascript:history.back();");
		exit;
}

function repinfo($rep_code,$ws_client) {
	$param = array('rep_code' => $rep_code);
	$result = $ws_client->call('repinfo', $param); 
	return $result;
}

?>

