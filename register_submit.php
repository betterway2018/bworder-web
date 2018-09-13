<?php  session_start(); 
ob_start();
?>
<?php require("i_config.php"); ?>
<?php require("i_function_msg.php"); ?>
<?php require_once('Connections/bwc_orders.php'); ?>

<?php 
header('Content-type: text/html; charset=windows-874');
 //####################################################################################
if ($_SERVER['REQUEST_METHOD']=="POST"   ) {
//####################################################################################	
	$name=$_POST['txtname'];
	$address=$_POST['txtaddress'];
	$tumbol=$_POST['txttumbol'];
	$amphur=$_POST['txtamphur'];
	$province=$_POST['txtprovince'];
	$postcode=$_POST['txtpostcode'];
	$phone=$_POST['txtphone'];
	$mobile=$_POST['txtmobile'];
	$fax=$_POST['txtfax'];
	$email=$_POST['txtemail'];
	$address2=$_POST['txtaddress2'];
	$address3=$_POST['txtaddress3'];
	$website_name =$_POST['Website'];
	$txturl =$_POST['txturl'];
	//echo 'phone'.$phone.'mobile'.$mobile;
	//exit;
	
	if ($website_name =="mistine") {
		$website_id =1;
	}
	elseif($website_name=="friday") {
		$website_id =2;
	}
	elseif($website_name=="faris") {
		$website_id=3;
	}
	elseif($website_name=="catalogfridayonline") {
		$website_id=4;
	}
	elseif($website_name=="line-001"){
		$website_id=201;
	}
	else {
		$website_id=0;
	}
	
	echo "กำลังบันทึกข้อมูล กรุณารอสักครู่ ....";
	echo "<br>";
	
	mysql_select_db($database_bwc_orders, $bwc_orders);
	mysql_query("SET NAMES 'tis620'");
	
	$queryTime = "select curdate() as curdate,curtime() as curtime";
	$get_date = mysql_query($queryTime,$bwc_orders) or die(mysql_error());
	$row_get_date =mysql_fetch_assoc ($get_date);
	$current_date = str_replace("-","",$row_get_date['curdate']);
	$current_time =str_replace(":","",$row_get_date['curtime']);

	$query ="select * From msl_register Where TRANDATE=$current_date  AND NAME='$name' AND EMAIL='$email'  AND ADDRESS='$address' AND PROVINCE='$province' AND POSTCODE='$postcode' AND PHONE='$phone'";
		
	$mslmst = mysql_query($query, $bwc_orders) or die(mysql_error());
	$row_mslmst = mysql_fetch_assoc($mslmst);
	$totalRows_mslmst= mysql_num_rows($mslmst);			
	//echo "recordcount=$totalRows_mslmst";
	
	if ($phone!=""&&$mobile!=""){
		$telnum = $phone.",".$mobile;
		} else if ($phone!=""){
		$telnum = $phone;
		} else{
		$telnum = $mobile;
		}
	
	if ($totalRows_mslmst==0) {
			$qry_insert=	"INSERT INTO msl_register(TRANDATE,TRANTIME,NAME,ADDRESS,TUMBOL,AMPHUR,";
			$qry_insert .="PROVINCE,POSTCODE,EMAIL,PHONE,FAX,";
			$qry_insert .="CONTACT_PLACE,CONTACT_TIME,DWNFLAG,DWN_DATE,FLAG1,FLAG2,WEBSITE_ID)";
			$qry_insert .="VALUES ($current_date,'$current_time','$name','$address','$tumbol','$amphur',";
			$qry_insert .="'$province','$postcode','$email','$telnum','$fax',";
			$qry_insert .="'$address2','$address3','N','','','',$website_id)";
	
			$update = mysql_query($qry_insert, $bwc_orders) or die(mysql_error());
			
	}
	//echo $txturl;
	if ($txturl==""){
		echo "<meta http-equiv='refresh' content='1;URL=register_result.php?id=$id'>";
	}else{
		echo "<meta http-equiv='refresh' content='1;URL=".$txturl."'>";
	}
	ob_end_flush();
	exit;	

//	
	
//	if (!$update) {
//		die('Error: ' . mysql_error());
//		exit;		
//	}
//	else {
//		echo "<meta http-equiv='refresh' content='0;URL=member_signup_result.php?id=$id'>";
//		exit;
//	}
}

?>