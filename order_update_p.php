<?php require_once('Connections/bwc_orders.php'); ?>
<?php 
echo "กำลังบันทึกข้อมูลการสั่งซื้อสินค้า กรุณารอสักครู่ ...";
echo "<br>";

require("check_login.php");
require_once('Connections/bwc_log.php');

$mode=false;
$dist=$_POST['dist'];
$mslno=$_POST['mslno'];
$chkdgt=$_POST['chkdgt'];
$rep_name=$_POST['rep_name'];
$rep_email = $_POST['email'];
$campaign=$_POST['campaign'];	
$totalItems = $_POST['TotalItems'];
$curcamp=$_POST['curcamp'];

$txtNormal_disc_1 = $_POST['txtNormal_disc_1'];
$txtNormal_disc_2 = $_POST['txtNormal_disc_2'];
$txtNormal_disc_3 = $_POST['txtNormal_disc_3'];


if ($txtNormal_disc_1=="") { $txtNormal_disc_1 ="0";}
if ($txtNormal_disc_2=="") { $txtNormal_disc_2 ="0";}
if ($txtNormal_disc_3=="") { $txtNormal_disc_3 ="0";}

//echo "nornal Dist =$txtNormal_disc_1 , $txtNormal_disc_2, $txtNormal_disc_3";



$website_id=$_SESSION['website'];
if($website_id=="") {
	$website_id ="0";
}



//Binding Data 
$totalAmount=0;
$items=0;



if ($dist=="" || $mslno=="" || $chkdgt=="") {
	echo "<meta http-equiv='refresh' content='0;URL=order_summary.php'>";
	exit;
}

if ($campaign=="") {
	echo "<meta http-equiv='refresh' content='0;URL=order_summary.php'>";
	exit;
}

mysql_select_db($database_bwc_orders, $bwc_orders);
//mysql_query("SET NAMES 'utf8'");
mysql_query("SET NAMES 'tis620'");
$sql ="Select  CAMP,DIST,BILLDATE,SHIPDATE,DLVDATE  From  TBL015 Where CAMP =$campaign  AND DIST='$dist'";
$tbl015 = mysql_query($sql, $bwc_orders) or die(mysql_error());
$row_tbl015 = mysql_fetch_assoc($tbl015);
$totalRows_tbl015 = mysql_num_rows($tbl015);			
if ($totalRows_tbl015 == 0) {
	$BillDate = "0";
	$ShipDate ="0";
	$DlvDate ="0";
	$DwnDate ="0";
}
else {
	$BillDate =$row_tbl015["BILLDATE"];
	$ShipDate = $row_tbl015["SHIPDATE"];
	$DlvDate = $row_tbl015["DLVDATE"];		
	$DwnDate = $row_tbl015["BILLDATE"];

	if (intval($DwnDate) <= intval(date('Ymd'))) {
	
		if (date("l",strtotime("+1 day"))=="Saturday") {
			$date = date("Ymd", strtotime("+3 day"));
		}
		else if (date("l",strtotime("+1 day"))=="Sunday") {
		 	$date = date("Ymd", strtotime("+2 day"));
		}
		else {
				$date = date("Ymd", strtotime("+1 day"));
		}
		
		$DwnDate=$date;		
	}
			
}

//Check Browser
$browser="";
$useragent = $_SERVER['HTTP_USER_AGENT'];
if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'IE';
} elseif (preg_match( '|Opera ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
    $browser_version=$matched[1];
    $browser = 'Opera';
} elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
        $browser_version=$matched[1];
        $browser = 'Firefox';
} elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
        $browser_version=$matched[1];
        $browser = 'Safari';
} else {
        // browser not recognized!
    $browser_version = 0;
    $browser= 'other';
}
$browser  = $browser . " ".$browser_version;

//Get Current DateTime
mysql_select_db($database_bwc_orders, $bwc_orders);
$queryTime = "select curdate() as curdate,curtime() as curtime";
$get_date = mysql_query($queryTime,$bwc_orders) or die(mysql_error());
$row_get_date =mysql_fetch_assoc ($get_date);
$current_date = str_replace("-","",$row_get_date['curdate']);
$current_time =str_replace(":","",$row_get_date['curtime']);

//header

$str_rep_code =$dist."-".substr("00000".$mslno,-5)."-".$chkdgt;
$str_camp =substr($campaign,4,2)."/".substr($campaign,0,4) ;
$str_current_date = substr($current_date,6,2)."/".substr($current_date,4,2)."/".substr($current_date,0,4);
$str_current_time = substr($current_time,0,2).":".substr($current_time,2,2).":".substr($current_time,4,2);
$str_dwn_date = substr($DwnDate,6,2)."/".substr($DwnDate,4,2)."/".substr($DwnDate,0,4);

$msg_h = "";
$msg_h .="<font style='font-family:Tahoma, Geneva, sans-serif;font-size:12 ;color:#252525'>";
$msg_h .= "เรียน คุณ$rep_name   ";
$msg_h .="รหัสสมาชิก  $str_rep_code<br />";
$msg_h .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ทางบริษัทฯ ขอขอบคุณที่ท่านได้สั่งซื้อสินค้าผ่านทางเว็บไซต์ http://www.bworder.com ";
$msg_h .="ในรอบจำหน่ายที่  $str_camp<br />";
$msg_h .= "วันที่สั่งซื้อผลิตภัณฑ์  $str_current_date  เวลา  $str_current_time <br />";
$msg_h .= "วันที่ดาวน์โหลดข้อมูล  $str_dwn_date ";
$msg_h .="</font>";

//Check Order History 
$order_no ="";
mysql_select_db($database_bwc_orders, $bwc_orders);
$query_order = "SELECT ORDER_NO, ORDCAMP, ORDDATE, ORDTIME, ITEMS, TOTAL_AMOUNT, ";
$query_order .="BILLDATE, SHIPDATE, DLVDATE, DWNDATE, DWNFLAG, DP_DOWNLOAD ";
$query_order .= "FROM order_header WHERE DWNFLAG='N' AND DELFLAG='N' ";
$query_order .=" AND  DIST='$dist' and MSLNO=$mslno AND CHKDGT=$chkdgt AND ORDCAMP=$campaign";
$order = mysql_query($query_order, $bwc_orders) or die(mysql_error());
$row_order = mysql_fetch_assoc($order);
$totalRows_order = mysql_num_rows($order);


if ($totalRows_order==0) {
			// GENERATE ORDER_NO
			$sql ="SELECT MAX(ORDER_NO) as MAXNO FROM ORDER_HEADER WHERE ORDCAMP = '$campaign' and dist = '$dist'
and mslno = '7614'
and chkdgt = '1'";
			$order_no = mysql_query($sql, $bwc_orders) or die(mysql_error());
			$row_order_no = mysql_fetch_assoc($order_no);
			$totalRows_order_no = mysql_num_rows($order_no);		
			
			if ($totalRows_order_no ==0) {
				$no =0;
			}
			else {
				if (!isset($row_order_no['MAXNO']) || $row_order_no['MAXNO']=="") {
					$no=0;
				}
				else {
					$no =$row_order_no['MAXNO'];
				}
			}
			$no=$no+1;
			
			$order_no = $no;
			$mode = "insert";
}
else 
{
		$order_no = $row_order['ORDER_NO'];
		$mode = "update";
}


//######################################################################################
// INSERT  ORDER_DETAIL
//######################################################################################
$amount =0;
$i_item=0;
$msg ="";
if ($mode=="insert") {
	$order_new = $order_no;
} else if ($mode=="update") {
	$order_new = $order_no * (-1);
}

mysql_query("SET AUTOCOMMIT=0"); 
mysql_query("START TRANSACTION");
/*
$sql_del="UPDATE ORDER_DETAIL SET DELFLAG = 'Y' , listno=listno*(-1) WHERE ORDER_NO = $order_no AND ORDCAMP=$campaign ";
$sql_del .=" AND DIST='$dist' AND MSLNO=$mslno AND CHKDGT =$chkdgt ";
$result_del=mysql_query($sql_del,$bwc_orders);
if (!result_del) {
	mysql_query("ROLLBACK");
	die('Error 0 :' . mysql_error());
	exit;
} else {
*/
	try {
		for ($i=1;$i<=$totalItems;$i++){
			if ($_POST['txtcode_'.$i]!="" && $_POST['txtqty_'.$i] !="") {
					$bill_code=$_POST['txtcode_'.$i];
					$bill_qty=intval($_POST['txtqty_'.$i]);
					$bill_brand =$_POST['txtbrand_'.$i];
					$item_discount=0;
					$bill_price=0;
					$bill_amt=0;
					
					mysql_select_db($database_bwc_orders, $bwc_orders);
					$sql="SELECT * FROM BILLCODE  WHERE CAMP=$campaign AND BILLCODE='$bill_code'";
					$rsBillcode=mysql_query($sql,$bwc_orders) or die(mysql_error());
					$row_billcode = mysql_fetch_assoc($rsBillcode);
					$total_rows_billcode =mysql_num_rows($rsBillcode);
					if ($total_rows_billcode!=0){
							$bill_desc=  str_replace("'","",$row_billcode['BILLDESC']);
							$bill_desc = str_replace(chr(34),"",$bill_desc);
							$bill_price = intval($row_billcode['PRICE']);
							$bill_amt =  $bill_qty * $bill_price;
							$bill_spcflg=$row_billcode['SPCFLG'];
							$bill_discflg=$row_billcode['DISCFLG'];													
							$bill_inctflg=$row_billcode['INCTFLG'];
							$bill_freeflg= $row_billcode['FREEFLG'];
							if ($row_billcode['SPCFLG']=="Y") {
								$item_discount = $row_billcode['SPCDSCBASE'];
							}
							else if($row_billcode['DISCFLG']=="Y" && $row_billcode['SPCFLG']=="N" ) {
								if ($bill_brand=="1") {
									$item_discount=$txtNormal_disc_1;
								}
								else if($bill_brand=="2") {
									$item_discount=$txtNormal_disc_2;
								}
								else if($bill_brand=="3") {
									$item_discount=$txtNormal_disc_3;
								}
							}
							else {
								$item_discount = 0;
							}
					}
					else 
					{
						$bill_desc="";
						$bill_price=0;
						$bill_amt=0;
						$bill_spcflg="";
						$bill_discflg="";
						$bill_inctflg="";
						$bill_freeflg= "";
					}
					
					$query ="INSERT INTO ORDER_DETAIL (";
					$query .="ORDER_NO,ORDCAMP,ORDDATE,ORDTIME,CURCAMP,DIST,MSLNO,CHKDGT,";
					$query .="LISTNO,BILLCODE,BILLDESC,QTY,PRICE,AMOUNT,";
					$query .="BRAND,DISCOUNT,SPCFLG,DISCFLG,INCTFLG,FREEFLG,";
					$query .="BILLFLAG,DWNFLAG,EXPFLAG,FLAG1 ) VALUES ( ";
					$query .="$order_new,$campaign,$current_date,'$current_time',$curcamp,'$dist',$mslno,$chkdgt";
					$query .=",$i,'$bill_code','$bill_desc',$bill_qty,$bill_price,$bill_amt";
					$query .=",'$bill_brand',$item_discount,'$bill_spcflg','$bill_discflg','$bill_inctflg','$bill_freeflg'";
					$query .=",'0','N','N','')";
					
					mysql_select_db($database_bwc_orders, $bwc_orders);
					$result_line= mysql_query($query,$bwc_orders);
					if (!$result_line) {
						mysql_query("ROLLBACK");
//						echo "Error insert: ".$query.mysql_error()."<br>";
						
						insert_log($dist,$mslno,$chkdgt,"error insert ","ไม่สามารถสร้างรายการใน_orderdetail ".$query."..."); ////insert log  ." error_detail ".mysql_error())
						
						chkdetail();
						
						
						exit;
					}
					$i_item  =$i_item+1;
					$amount = $amount + $bill_amt;
					
					
		////  Write message  for send mail
				
				$msg .= '<tr>';
				$msg .= '<td align="center">'.$i.'</td>';
				$msg .= '<td align="center">'.$bill_code.'</td>';
				$msg .= '<td>'.$bill_desc.'</td>';
				$msg .= '<td align="right">'.$bill_qty.'</td>';
				$msg .= '<td align="right">'.$bill_price.'</td>';
				$msg .= '<td align="right">'.$bill_amt.'</td>';
				$msg .= '</tr>';
					
			}
		}//for loop
	} catch (Exception $e) { insert_log($dist,$mslno,$chkdgt,"error insert_","_orderdetail_".$e."_from Exception"); } 
//	echo $sql_del;
//}

	chkdetail();
			
			
			
//######################################################################################
// INSERT  ORDER_HEADER
//######################################################################################
//if ($totalRows_order==0) {
if ($mode=="insert") {
	//INSERT HEADER
			$sql = "INSERT INTO ORDER_HEADER (ORDER_NO,ORDCAMP,ORDDATE,ORDTIME,CURCAMP,DIST,MSLNO,CHKDGT,NAME,
						ITEMS,TOTAL_AMOUNT,BILLDATE,SHIPDATE,DLVDATE,DWNDATE,DWNFLAG,
						MAIL_CONFIRM,UPDDATE,UPDTIME,DP_DOWNLOAD,WEBSITE_ID,BROWSER) VALUES (
						$order_no,$campaign,$current_date,'$current_time',$curcamp,'$dist',$mslno,$chkdgt,'$rep_name',
						$i_item,$amount,$BillDate,$ShipDate,$DlvDate,$DwnDate,'N',
						'N',$current_date,'$current_time','',$website_id,'$browser')";
			mysql_select_db($database_bwc_orders, $bwc_orders);
			$result_header = mysql_query($sql,$bwc_orders);
			if (!$result_header) {
					mysql_query("ROLLBACK");
					die(mysql_error());
					exit;
			}
			else 
			{
					mysql_query("COMMIT");
					echo "<br>สร้างรายการสั่งซื้อสินค้า เรียบร้อยแล้วค่ะ ...  (Order No  : $campaign - $order_no)<br>";
					 insert_log($dist,$mslno,$chkdgt,"Orders Update","ยืนยันรายการสั่งซื้อ Create new Order $campaign - $order_no"); ////insert log
					 send_mail($rep_email,$msg_h,$msg,$amount);
			}
		echo "<meta http-equiv='refresh' content='2;URL=order_summary.php'>";
			 //exit;
}
else if ($mode=="update") {
		// UPDATE DATA
			$sql ="UPDATE ORDER_HEADER SET  
					ORDDATE=$current_date,
					ORDTIME='$current_time',
					CURCAMP=$curcamp,
					ITEMS=$i_item,
					TOTAL_AMOUNT=$amount,
					NAME='$rep_name',
					UPDDATE=$current_date,
					UPDTIME='$current_time',
					WEBSITE_ID =$website_id, 
					BROWSER='$browser' 
					WHERE ORDER_NO = $order_no AND DIST='$dist' AND MSLNO=$mslno AND CHKDGT =$chkdgt AND ORDCAMP=$campaign";
			$result_header = mysql_query($sql,$bwc_orders);
			if (!$result_header) {
			    mysql_query("ROLLBACK");
		 		die('Error2: ' . mysql_error());
				exit;
			}
			else 
			{
				mysql_query("COMMIT");
				echo "<br>บันทึกรายการสั่งซื้อสินค้า เรียบร้อยแล้วค่ะ ... ( Order No :  $campaign - $order_no )<br>";
				insert_log($dist,$mslno,$chkdgt,"Orders Update"," ยืนยันรายการสั่งซื้อ  Update current Order $campaign - $order_no"); ////insert log
				send_mail($rep_email,$msg_h,$msg,$amount);
			}
  		    echo "<meta http-equiv='refresh' content='0;URL=order_summary.php'>";
			//exit;			
} else if ($mode=="rollback") {
	
}
 
 
 //#################################################################
 // Function Send E-mail
 //#################################################################
 
function send_mail($to,$msg_header,$msg,$tot_amt) {
	
	    include("i_email_config.php");  // refer $smtp_server,$default_from ,$default_to
		
		if ($email_from=="") {
				$email_from=$default_from;
		}
		
		if ($to=="") {
				$to=$default_to;
		}
		
		ini_set("SMTP", "$smtp_server");
		ini_set("sendmail_from", "$default_from");

		$MailTo = $to;
		$MailFrom = $email_from;
		$MailSubject = "แจ้งผลการสั่งซื้อสินค้าทางอินเตอร์เน็ต http://www.bworder.com ";
	
		$MailMessage = "";
		$MailMessage .=$msg_header;
		$MailMessage .= '<table width=560 border=0 cellspacing=0 cellpadding=0 ';
		$MailMessage .= 'style="font-family:Tahoma, Geneva, sans-serif;font-size:12 ;color:#252525">';
		$MailMessage .= '<tr>';
		$MailMessage .= '<td height=23 width="44" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">ลำดับ</td>';
		$MailMessage .= '<td  height=23 width="71" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">รหัสสินค้า</td>';
		$MailMessage .= '<td height=23  width="362" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">ชื่อสินค้า/รายละเอียด</td>';
		$MailMessage .= ' <td  height=23 width="83"  align="right" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">จำนวนสั่งซื้อ</td>';
		$MailMessage .= ' <td  height=23 width="85"  align="right" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">ราคา/หน่วย</td>';
		$MailMessage .= '<td  height=23 width="85"  align="right" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">ราคารวม</td>';
		$MailMessage .= '</tr>';
			  
		$MailMessage .=$msg ;
		$MailMessage .= "<tr>";
		$MailMessage .= '<td height=23 width="44" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">&nbsp;</td>';
		$MailMessage .= '<td  height=23 width="71" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">&nbsp;มูลค่ารวม</td>';
		$MailMessage .= '<td height=23  width="362" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">&nbsp;</td>';
		$MailMessage .= '<td  height=23 width="83" align="right" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">&nbsp;</td>';
		$MailMessage .= '<td  height=23 width="85"  align="right" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">&nbsp;</td>';
		$MailMessage .= '<td  height=23 width="85"  align="right" style="border-bottom:dotted #5F5F5F 1px;border-top:dotted #5F5F5F 1px">&nbsp;';
		$MailMessage .= $tot_amt.'</td>';

		$MailMessage .="</tr>";		
		$MailMessage .="</table>";
		$MailMessage .=$email_footer;
		
		$Headers = "MIME-Version: 1.0\r\n" ;
		$Headers .= "Content-type: text/html; charset=windows-874\r\n" ;		  // ส่งข้อความเป็นภาษาไทย ใช้ "windows-874"
		//$Headers .= "From: ".$MailFrom." < ".$MailFrom." >\r\n" ;
		//$Headers .= "Reply-to: ".$MailFrom." < ".$MailFrom." >\r\n" ;
		$Headers .= "From: ".$MailFrom."\r\n" ;
		$Headers .= "Reply-to: ".$MailFrom."\r\n" ;
		if ($default_cc!=="") {
			$Headers .= "Cc: ".$default_cc . "\r\n";
		}
		if ($default_bcc!=="") {
			$Headers .= "Bcc: ". $default_bcc . "\r\n";
		}
		
		$Headers .= "X-Priority: 3\r\n" ;
		$Headers .= "X-Mailer: PHP mailer\r\n" ;
		
		require_once('Connections/bwc_log.php');
		if(mail($MailTo, $MailSubject , $MailMessage, $Headers, $MailFrom))
		{
			echo "<BR>ส่ง E-mail ยืนยันการสั่งซื้อ เรียบร้อยแล้วค่ะ" ;  //ส่งเรียบร้อย
			insert_log($_SESSION["dist"],$_SESSION["mslno"],$_SESSION["chkdgt"],"Send E-mail","Send E-mail  successfuly ."); ////insert log

		}else{
			echo "<br>ไม่สามารถส่ง E-mail ยืนยันการสั่งซื้อได้ค่ะ" ; //ไม่สามารถส่งเมล์ได้
			insert_log($_SESSION["dist"],$_SESSION["mslno"],$_SESSION["chkdgt"],"Send E-mail","Send E-mail fail ."); ////insert log
		}
}


function chkdetail(){
	global $order_no;
	global $order_new;
	global $campaign;
	global $dist;
	global $mslno;
	global $chkdgt;
	global $query_campaign;
	global $database_bwc_orders;
	global $bwc_orders;
	global $i_item;
	
	insert_log($dist,$mslno,$chkdgt,"check detail ","check detail..."); 
	
	$query_campaign = "SELECT count(*) totaldetail from order_detail where ORDER_NO = '$order_new' and ORDCAMP = '$campaign' ";
	$query_campaign .=" AND DELFLAG = 'N' AND listno > 0 AND DIST='$dist' AND MSLNO='$mslno' AND CHKDGT ='$chkdgt' ";
	
	mysql_select_db($database_bwc_orders, $bwc_orders);
	
	$tblcampaign = mysql_query($query_campaign, $bwc_orders) or die(mysql_error());
	$row_tblcampaign = mysql_fetch_assoc($tblcampaign);
	$totaldetail=$row_tblcampaign['totaldetail'];
	
	//echo $totaldetail.'!='.$i_item;
	if($totaldetail!=$i_item || ($totaldetail==0 && $i_item==0)){
			$sql_del="DELETE FROM ORDER_DETAIL  WHERE ORDER_NO = $order_no AND ORDCAMP=$campaign ";
			$sql_del .=" AND DIST='$dist' AND MSLNO='$mslno' AND CHKDGT ='$chkdgt' ";
			echo $sql_del."<br>";
			$result_del=mysql_query($sql_del,$bwc_orders);
			if (!result_del) {
				mysql_query("ROLLBACK");
				die('Error 0 :' . mysql_error());
				exit;
			}
			$sql_del="UPDATE ORDER_DETAIL SET ORDER_NO = $order_no WHERE ORDER_NO = $order_new AND ORDCAMP=$campaign ";
			$sql_del .=" AND DIST='$dist' AND MSLNO='$mslno' AND CHKDGT ='$chkdgt' AND DELFLAG='Y' AND listno < 0 ";
			echo $sql_del."<br>";
			$result_del=mysql_query($sql_del,$bwc_orders);
			if (!result_del) {
				mysql_query("ROLLBACK");
				die('Error 0 :' . mysql_error());
				exit;
			}
			echo "เกิดข้อผิดพลาดไม่สามารถบันทึกได้ กดปุ่ม OK";
//			AlertMessage("เกิดข้อผิดพลาดไม่สามารถบันทึกได้ กดปุ่ม OK และกรุณา กดปุ่มยืนยันรายการสั่งซื้อ อีกครั้ง","javascript:history.back();");
	}
	else {
		$sql_del="DELETE FROM ORDER_DETAIL WHERE ORDER_NO = $order_new AND ORDCAMP=$campaign ";
		$sql_del .=" AND DIST='$dist' AND MSLNO=$mslno AND CHKDGT =$chkdgt ";
		$result_del=mysql_query($sql_del,$bwc_orders);
		if (!result_del) {
			mysql_query("ROLLBACK");
			die('Error 0 :' . mysql_error());
			exit;
		}
		$UpdHead = true;
	}
}
?>

