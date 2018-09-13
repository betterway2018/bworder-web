<?php
session_start(); 
ob_start();
?>
<?php require_once('Connections/bwc_orders.php'); ?>
<?php require("i_config.php"); ?>
<?php include("i_function_msg.php"); ?>
<?php include("i_function_format.php"); ?>
<?php



mysql_query("SET NAMES 'tis620'");
/*header('Content-type: text/html; charset=windows-874');*/
$po=$_GET['po'];
$id=$_GET['id'];
$camp=$_GET['camp'];
$rep_email = $_POST['email'];
$pono=$camp.'/'.$po;

/*$dist=substr($id,0,3);
$mslno=substr($id,3,5);
$chkdgt=substr($id,8,1);*/

if(strlen($id)==10){
			$dist=substr($id,0,4);
			$mslno=substr($id,4,5);
			$chkdgt=substr($id,9,1);
			//echo "ผู้จัดการเขต 4 หลัก".$id;
			}
			elseif(strlen($id)==9){
			$dist=substr($id,0,3);
			$mslno=substr($id,3,5);
			$chkdgt=substr($id,8,1);
			//echo "ผู้จัดการเขต 3 หลัก".$id;
				}

echo "กำลังลบข้อมูลทั้งหมดรอบ...".$camp."  กรุณารอสักครู่ ....";

mysql_query("SET AUTOCOMMIT=0"); 
mysql_query("START TRANSACTION");
mysql_query("BEGIN");

mysql_select_db($database_bwc_orders, $bwc_orders);
//$query_order = "DELETE FROM order_headertemp  WHERE dist='$dist' and mslno=$mslno and chkdgt=$chkdgt and order_no=$po";

$query_order = "UPDATE   order_headertemp  set DELFLAG='Y'  WHERE dist='$dist' and mslno='$mslno' and chkdgt='$chkdgt' and order_no='$po' and ordcamp='$camp' and DELFLAG='N'";



$del_hdr = mysql_query($query_order, $bwc_orders) or die(mysql_error());
if (!$del_hdr ) {
	mysql_query("ROLLBACK");
	AlertMessage ("เกิดข้อผิดพลาด !!!  ไม่สามารถลบข้อมูลได้  ","javascript:history.back();");
               exit;	 
} 
 

//  $query_order_line = "UPDATE order_detailtemp   SET DELFLAG='Y'  WHERE dist='$dist' and mslno='$mslno' and chkdgt='$chkdgt' and order_no='$po' and ordcamp='$camp'";
//  $order_line = mysql_query($query_order_line, $bwc_orders) or die(mysql_error());
//  if (!$order_line) {
//	mysql_query("ROLLBACK");
//	AlertMessage ("เกิดข้อผิดพลาด !!!  ไม่สามารถลบข้อมูลได้  ","javascript:history.back();");
//               exit;	 
//  } 

require_once('Connections/bwc_log.php');
insert_log($dist,$mslno,$chkdgt,"Orders Form","Delete Order  $camp-$po " ); ////insert log


// mysql_free_result($bwc_orders);
 mysql_close($bwc_orders); 


/*$msg = "ท่านได้ทำการยกเลิกการสั่งซื้อสินค้าตามรายการหมายเลข ".$pono;
send_mail($rep_email,$msg_h,$msg);*/
//mysql_close($bwc_orders); 
echo"<meta http-equiv='refresh' content='1;URL=order_summary.php'>";		

?>