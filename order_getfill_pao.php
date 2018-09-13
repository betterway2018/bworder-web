<?php  session_start(); ?>
<?php require("i_config.php"); ?>
<?php require_once('Connections/bwc_orders.php'); ?>
<?php header('Content-type: text/html; charset=windows-874'); ?>
<?php


$campaign =$_POST['tCampCode'];
$bill_code=$_POST['tProductID'];
$_unit=$_POST['tUnit'];
/*
$campaign ="201113";
$bill_code = "53761";
$bill_unit=1;
*/

$strcampaign = substr($campaign,4,2)."/".substr($campaign,0,4);
$bill_prefix = substr($bill_code,0,2);

// Return messagebox type =  OKOnly   หรือ OKCancel 
$okonly="OKOnly";
$okcancel="OKCancel";
$okalert="OKAlert";

mysql_select_db($database_bwc_orders, $bwc_orders);
//mysql_query("SET NAMES 'tis620'");
//mysql_query("SET NAMES 'utf8'");


//ตรวจสอบ Billing Code 
$query_billcode = "SELECT * FROM billcode where camp=$campaign and billcode='$bill_code'";
$billcode = mysql_query($query_billcode, $bwc_orders) or die(mysql_error());
$row_billcode = mysql_fetch_assoc($billcode);
$totalRows_billcode = mysql_num_rows($billcode);


if ($row_billcode['BRAND']==3) {
	$bill_brand="3";
} else if ($row_billcode['BRAND']==2) {
	$bill_brand="2";
} else if ($row_billcode['BRAND']==1) {
	$bill_brand="1";
} else {
	$bill_brand="";
}
 
$str_msg="";
//mysql_free_result($billcode);

//ตรวจสอบว่าเป็น VIP ,  Premium หรือไม่
switch ($bill_prefix) {
	case "00";
	case "01";
	case "02";
	case "04";
	case "05";
	case "06";
	case "07":
			$str_msg="ขออภัยค่ะ ...\nรหัสสินค้า $bill_code  ไม่สามารถสั่งซื้อทางอินเตอร์เน็ตได้ค่ะ";
			echo "1|$bill_desc|0|$bill_brand|$okalert|$str_msg";
			exit;	
			break;
	case "08";
	case "09":
			$sql = "Select  camp,billcode,billdesc,msgtyp,msg_desc  from billcode_msg where camp =$campaign and billcode ='$bill_code'";
			$chkvip = mysql_query($sql,$bwc_orders) ;
			$row_chkvip = mysql_fetch_assoc($chkvip);
			$totalrows_chk_vip  = mysql_num_rows($chkvip);
			if ($totalrows_chk_vip==0 ) {
				$str_msg="ขออภัยค่ะ ...\nรหัสสินค้า $bill_code  $bill_desc เป็นสินค้า VIP ไม่สามารถสั่งซื้อทางอินเตอร์เน็ตได้ค่ะ";
				echo "1|$bill_desc|0|$bill_brand|$okonly|$str_msg";
				mysql_free_result($chkvip);
				exit;
			}
			mysql_free_result($chkvip);
			break;
}

// ตรวจสอบ  Bill Code _Message Lock
$qry_bill = "Select  camp,billcode,billdesc,msgtyp,msg_desc  from billcode_msg where camp =$campaign and billcode ='$bill_code'";
$billcode_msg = mysql_query($qry_bill,$bwc_orders) or die(mysql_error());
$row_billcode_msg = mysql_fetch_assoc($billcode_msg);
$rows_billcode_msg = mysql_num_rows($billcode_msg);
 if ($rows_billcode_msg !=0) {
	//$bill_desc = $row_billcode_msg['billdesc'];
	switch ($row_billcode_msg['msgtyp']){
	case  "LOCK" : 
						$str_msg="ขออภัยค่ะ ...\nรหัสสินค้า $bill_code  $bill_desc  ไม่สามารถสั่งซื้อทางอินเตอร์เน็ตได้ค่ะ\nเนื่องจาก ". $row_billcode_msg['msg_desc'];
						echo "1|$bill_desc|0|$bill_brand|$okalert|$str_msg";
						mysql_free_result($billcode_msg);
						exit;								
						break;
	case "DUP" :	
						$str_msg="ขออภัยค่ะ ... \nรหัสสินค้า $bill_code  ไม่สามารถสั่งซื้อได้ \n" . $row_billcode_msg['msg_desc'];
						echo "1|$bill_desc|$bill_price|$bill_brand|$okalert|$str_msg";
						mysql_free_result($billcode_msg);
						exit;								
						break;
	default:
						$str_msg="otherother \n" . $row_billcode_msg['msg_desc'];
						echo "1|$bill_desc|$bill_price|$bill_brand|$okonly|$str_msg";
						mysql_free_result($billcode_msg);
						exit;								
						break;

	}
 }
 
$bill_code = $row_billcode['BILLCODE'];
$bill_desc = $row_billcode['BILLDESC'];
$bill_price=$row_billcode['PRICE'];

if ($totalRows_billcode==0) {
	if ($bill_prefix=="00" ||$bill_prefix=="01" ||$bill_prefix=="02" ||$bill_prefix=="03" ||$bill_prefix=="04" ||$bill_prefix=="05"||$bill_prefix=="06"||$bill_prefix=="07"||$bill_prefix=="08"||$bill_prefix=="09")  {
		$str_msg="ขออภัยค่ะ ... \nไม่พบรหัสสินค้า $bill_code  $bill_desc ในรอบจำหน่ายที่ $strcampaign  ค่ะ...";
		echo "1||0|$bill_brand|$okalert|$str_msg";	
	}
	else
	{
		$str_msg="ขออภัยค่ะ ... \nไม่พบรหัสสินค้า $bill_code  $bill_desc ในรอบจำหน่ายที่ $strcampaign  ค่ะ...";
		echo "1||0|$bill_brand|$okalert|$str_msg";		
	}
	exit;
}

/*
//ตรวจสอบ Billing Code 
$query_billcode = "SELECT * FROM billcode where camp=$campaign and billcode='$bill_code'";
$billcode = mysql_query($query_billcode, $bwc_orders) or die(mysql_error());
$row_billcode = mysql_fetch_assoc($billcode);
$totalRows_billcode = mysql_num_rows($billcode);
 
if ($totalRows_billcode==0) {
	$str_msg="ขออภัยค่ะ ... \nไม่พบรหัสสินค้า $bill_code  $bill_desc ในรอบจำหน่ายที่คุณเลือกค่ะ ...";
	echo "1||0|$okcancel|$str_msg";
	mysql_free_result($billcode);
	exit;
}

$bill_code = $row_billcode['BILLCODE'];
$bill_desc = $row_billcode['BILLDESC'];
$bill_price=$row_billcode['PRICE'];
$str_msg="";
mysql_free_result($billcode);
*/


// ตรวจสอบ Short
$new_campaign = substr($campaign,4,2).substr($campaign,0,4);
$sql ="SELECT  * FROM BILLCODE_SHORT  WHERE CAMP =$new_campaign AND BILLCODE ='$bill_code'";
$shtmsg = mysql_query($sql,$bwc_orders) or die(mysql_error());
$rs_shtmsg = mysql_fetch_assoc($shtmsg);
$rows_shtmsg = mysql_num_rows($shtmsg);
$xx = $rows_shtmsg;
if ($rows_shtmsg !=0) {
		$sht_code = $rs_shtmsg['BILLCODE'];
		$sht_desc = trim($rs_shtmsg['BILLDESC']);
		$result = $rs_shtmsg['SHTCODE'];
		$str_msg="";
		switch ($result) {
		 case "": 
		 	$str_msg="";
			break;
		 case "0";
			$str_msg="";
			break;
		 case "1":
			$str_msg="ขออภัยค่ะ ...\nสินค้า $sht_desc  รหัส $sht_code ขาดสต๊อก และเลิกจำหน่ายแล้วค่ะ !!!";
			echo "1|$bill_desc|$bill_price|$bill_brand|$okalert|$str_msg";
			exit;
			break;
		 case "2":
				$sub_code = $rs_shtmsg['SUBCODE'];
				 $sub_desc = trim($rs_shtmsg['BILLDESC']);
			if ($sub_code!="" && $sub_desc!="") {
				$str_msg="ขออภัยค่ะ ..\n$sht_desc  รหัส  $sht_code  ขาดสต๊อกค่ะ  \nถ้าท่านสั่งซื้อสินค้านี้ท่านจะได้สินค้า $sub_desc รหัส $sub_code ทดแทนค่ะ";
				echo "1|$bill_desc|$bill_price|$bill_brand|$okcancel|$str_msg";
				exit;
			 }
			 else {
				 $str_msg="ขออภัยค่ะ ..\n$sht_desc  รหัส  $sht_code  ขาดสต๊อกค่ะ  \nถ้าท่านสั่งซื้อสินค้านี้ท่านจะได้สินค้าอื่นทดแทนค่ะ";
				echo "1|$bill_desc|$bill_price|$bill_brand|$okcancel|$str_msg";
				exit;
				 
			 }
			
			break;
		 case "3":
			$str_msg="ขออภัยค่ะ ..\n$sht_desc  รหัส  $sht_code  ขาดสต๊อกค่ะ    \nท่านสามารถสั่งซื้อสินค้านี้ใหม่ในรอบจำหน่ายหน้าค่ะ";
			echo "1|$bill_desc|$bill_price|$bill_brand|$okalert|$str_msg";
			exit;
			break;
		 case "4":
			$str_msg="ขออภัยค่ะ ..\n$sht_desc  รหัส  $sht_code  ขาดสต๊อกค่ะ    \nทางบริษัทจะจัดส่งสินค้าให้ท่านในรอบจำหน่ายหน้าค่ะ";
			echo "1|$bill_desc|$bill_price|$bill_brand|$okonly|$str_msg";
			exit;
			break;
		 case "5":
					if ($rs_shtmsg['SHORTLMT']==0){
						$str_msg="ขออภัยค่ะ ..\n$sht_desc  รหัส  $sht_code  ขาดสต๊อกชั่วคราวค่ะ ";
						echo "1|$bill_desc|$bill_price|$bill_brand|$okcancel|$str_msg";
						exit;
						
					}
					else {
						$str_msg="";
						echo "0|$bill_desc|$bill_price|$bill_brand|$okcancel|$str_msg";
						exit;
						
					}
					break;			
		 default :
			$str_msg="";
			echo "0|$bill_desc|$bill_price|$bill_brand|$okcancel|$str_msg";
			exit;
			
		}
}else
{
	$str_msg="";
	echo "0|$bill_desc|$bill_price|$bill_brand|$okcancel|$str_msg";
	exit;
	

}

		
echo "0|$bill_desc|$bill_price|$bill_brand|$okcancel|$str_msg";

/*
else {
	echo "|0|$okonly|";
	mysql_free_result($billcode);
}
*/

?>

