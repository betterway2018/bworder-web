<?php  session_start(); 
ob_start();
?>

<?php require("i_config.php"); ?>
<?php require("check_login.php"); ?>
<?php require_once('Connections/bwc_orders.php'); ?>
<?php header('Content-type: text/html; charset=windows-874'); ?>


<?php
$dist=$_SESSION['dist'];
$mslno=$_SESSION['mslno'];
$chkdgt=$_SESSION['chkdgt'];
$name=$_SESSION['name'];
$website_id =$_SESSION["website"];

$campaign=$_POST['camp'];

$billcode = $_POST['billcode'];
$qty=$_POST['qty'];
$price=$_POST['price'];
$brand=$_POST['brand'];

if($website_id=="") {
	$website_id ="0";
}

if ($dist=="" || $mslno=="" || $chkdgt=="") {
	echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
}



include("i_current_date.php"); // Output  $current_date;  , $current_time;
$orddate=$current_date;
$ordtime=$current_time;
$wrkDate=$orddate;

include("i_MailPlan_by_camp.php");


/*
echo "total_row =".$total_row_mailplan. "<BR>";
echo "Order Type : $order_type <br>";
echo "Current Campaign : $currentCamp <BR>";
echo "Order Campaign : $campaign <BR>";
echo "Next Campaign : $nextCamp";
echo "<br>";
echo "BILLDATE : $bill_date";
echo "<br>";
echo "SHIPDATE : $ship_date";
echo "<br>";
echo "DLVDATE : $dlv_date";
echo "<br>";
echo "DWNDATE : $dwn_date";
echo "<br><br>";
echo "BILLDATE2 : $bill_date2";
echo "<br>";
echo "SHIPDATE2 : $ship_date2";
echo "<br>";
echo "DLVDATE2 : $dlv_date2";
*/



mysql_select_db($database_bwc_orders, $bwc_orders);
$query_campaign = "SELECT CAMP FROM TBL008 WHERE STATUS IN ('Current') ORDER BY CAMP";
$tblcampaign = mysql_query($query_campaign, $bwc_orders) or die(mysql_error());
$row_tblcampaign = mysql_fetch_assoc($tblcampaign);
$totalRows_tblcampaign = mysql_num_rows($tblcampaign);
$currentCamp_tbl008=$row_tblcampaign['CAMP'];

mysql_free_result($tblcampaign);



if ($order_type=="Late") {
	$camp_by_type = $campaign;
}
else {
	$camp_by_type = $currentCamp;
}

//echo "Order Type : $order_type.'|'.$camp_by_type";
//exit;



// Get Bill Code Information
$query_bill_code="select * from billcode where CAMP=$campaign AND BILLCODE='$billcode'";
//echo $query_bill_code;
//echo "<br>";
$Bcode = mysql_query($query_bill_code,$bwc_orders);
$row_billcode = mysql_fetch_assoc($Bcode);
$row_num_billcode = mysql_num_rows($Bcode);

//echo "    rownUm="+$row_num_billcode;
//echo "<br>";
if ($row_num_billcode==1) {
	$bill_code = $row_billcode['BILLCODE'];
	$bill_desc = $row_billcode['BILLDESC'];
	$bill_price = $row_billcode['PRICE'];
	$brand = $row_billcode['BRAND'];
}
else {
	$bill_code = $billcode;
	$bill_desc ="";
	$bill_price =0;
	$brand = "";
}



//echo "bill_code=". $bill_code." desc ".$bill_desc." price ".$bill_price." brand ".$brand."___";
//exit;
$amount= (int)$qty * (int)$bill_price;
//echo "camp=$campaign  ,  billcode=$billcode , billdesc = $bill_desc , qty=$qty , price=$bill_price , amount = $amount";
//exit;					  

//Check Order History 
mysql_select_db($database_bwc_orders, $bwc_orders);
$query_order = "SELECT ORDER_NO, ORDCAMP, ORDDATE, ORDTIME, ITEMS, TOTAL_AMOUNT, BILLDATE, SHIPDATE, DLVDATE, DWNDATE, DWNFLAG, DP_DOWNLOAD FROM order_header WHERE DWNFLAG='N' AND DELFLAG='N' AND  DIST='$dist' and MSLNO=$mslno AND CHKDGT=$chkdgt AND ORDCAMP=$camp_by_type";


	

$Order_Noedit = 0;
$order = mysql_query($query_order, $bwc_orders) or die(mysql_error());
$row_order = mysql_fetch_assoc($order);
$totalRows_order = mysql_num_rows($order);
if ($totalRows_order==0) {
	$doMode="New";
	$Order_No = "";
	$items =0;
}
else {
	$doMode="Edit";
	$Order_No =$row_order['ORDER_NO'];
	$items=$row_order['ITEMS'];
	$Order_Noedit  =  $Order_No;
}




	


if ($doMode =="New") {
//############################################################
	//Generate  ORDER NO	
	$sql ="SELECT MAX(ORDER_NO) as MAXNO FROM ORDER_HEADER WHERE ORDCAMP =$camp_by_type";




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




	
	//INSERT HEADER

	$sql = "INSERT INTO ORDER_HEADER (ORDER_NO,ORDCAMP,ORDDATE,ORDTIME,CURCAMP,DIST,MSLNO,CHKDGT,NAME,
				ITEMS,TOTAL_AMOUNT,BILLDATE,SHIPDATE,DLVDATE,DWNDATE,DWNFLAG,
				MAIL_CONFIRM,UPDDATE,UPDTIME,DP_DOWNLOAD,WEBSITE_ID) VALUES (
				$no,$camp_by_type,$orddate,'$ordtime',$currentCamp,'$dist',$mslno,$chkdgt,'$rep_name',
				1,$amount,$bill_date,$ship_date,$dlv_date,$dwn_date,'N',
				'N',$orddate,'$ordtime','',$website_id)";
	//	echo "$sql<br>";
 	 //	exit;
		//echo "insert header=$sql";
		$result = mysql_query($sql,$bwc_orders);
		if ($result) {

				$query ="INSERT INTO ORDER_DETAIL (
							  ORDER_NO,ORDCAMP,ORDDATE,ORDTIME,CURCAMP,DIST,MSLNO,CHKDGT,
							  LISTNO,BILLCODE,BILLDESC,QTY,PRICE,AMOUNT,BRAND,
							  BILLFLAG,DWNFLAG,EXPFLAG,FLAG1 ) VALUES ( 
							  $no,$camp_by_type,$orddate,'$ordtime',$currentCamp,'$dist',$mslno,$chkdgt,
							  1,'$bill_code','$bill_desc',$qty,$bill_price,$amount,'$brand',
							  '0','N','N','')";
				//echo "insert detail=$query";
		
				 $result_line=mysql_query($query,$bwc_orders);
				 if (!$result_line) {
   				//echo "<br><br>false<br><br>";
		 			die('Error: 2' . mysql_error());
					exit;
				 }

   		   echo "เพิ่มรายการสั่งซื้อผลิตภัณฑ์ของคุณเรียบร้อยแล้วค่ะ ...";
			exit;
		}
		else {
		
			echo 'Error: 3' . mysql_error();
			exit;
		}
//############################################################
}
elseif ($doMode=="Edit") {
//############################################################
		mysql_query("BEGIN");
		
		$hdr_items = 0;
		$hdr_amount=0;
	
		$sql2="SELECT  * FROM ORDER_DETAIL WHERE ORDER_NO = $Order_No  AND DIST='$dist' ";
		$sql2.=" AND MSLNO=$mslno AND CHKDGT =$chkdgt ";
		$sql2.=" AND ORDCAMP=$camp_by_type";
		$sql2.=" AND BILLCODE ='$bill_code'";
		$sql2.=" AND DWNFLAG='N' AND DELFLAG='N'";
		

		


		$rs = mysql_query($sql2,$bwc_orders) or die(mysql_error());
		$row_rs = mysql_fetch_assoc($rs);
		$total_rows_rs = mysql_num_rows($rs);
		if ($total_rows_rs==0) {

		   
    
				$hdr_items=1;
				$hdr_amount=$amount;
				$list_no=$items+1;
				$query ="INSERT INTO ORDER_DETAIL ( ";
				$query.="ORDER_NO,ORDCAMP,ORDDATE,ORDTIME,CURCAMP,DIST,MSLNO,CHKDGT,";
				$query.="LISTNO,BILLCODE,BILLDESC,QTY,PRICE,AMOUNT,BRAND,";
				$query.="BILLFLAG,DWNFLAG,EXPFLAG,FLAG1 ) VALUES ( ";
				$query.="$Order_No,$camp_by_type,$orddate,'$ordtime',$currentCamp,'$dist',$mslno,$chkdgt,";
				$query.="$list_no,'$bill_code','$bill_desc',$qty,$bill_price,$amount,'$brand',";
				$query.="'0','N','N','')";
				
					//echo  $query ;
                   //  exit;	

				 $result_line=mysql_query($query,$bwc_orders);
				 if (!$result_line) {
					 mysql_query("ROLLBACK");
					 die('Error: 20' . mysql_error());
					 exit;
				 }
			 
		}
		else { // Update

				$qty1=$row_rs['QTY'];
				$amt1=$row_rs['AMOUNT'];
				
				$hdr_items=0;
				$hdr_amount=($qty* $bill_price)-$amt1;
								
				$qty_new = $qty1+$qty;
				$amt_new= $qty_new * $bill_price;
				$query ="UPDATE ORDER_DETAIL  SET  QTY=$qty_new,AMOUNT=$amt_new ";
				$query.=" WHERE ORDER_NO = $Order_No  AND DIST='$dist' ";
				$query.=" AND MSLNO=". intval($mslno) . " AND CHKDGT =$chkdgt";
				$query.=" AND ORDCAMP=$camp_by_type";
				$query.=" AND BILLCODE ='$bill_code'";
				$query.=" AND DWNFLAG='N' AND DELFLAG='N' ";

				$result_line2=mysql_query($query,$bwc_orders);
				 if (!$result_line2) {
					 mysql_query("ROLLBACK");
					die('Error: 21' . mysql_error());
					exit;
				 }
		}
		
		$sql ="UPDATE ORDER_HEADER SET  ITEMS=ITEMS+$hdr_items,
			  TOTAL_AMOUNT=TOTAL_AMOUNT+$hdr_amount,
			  UPDDATE=$orddate, UPDTIME='$ordtime'
			  WHERE ORDER_NO = $Order_No  AND DIST='$dist' AND MSLNO=$mslno AND CHKDGT =$chkdgt   AND	ORDCAMP=$camp_by_type";

		$result = mysql_query($sql,$bwc_orders);
		if (!$result) {
			mysql_query("ROLLBACK");
			die('Error: 1' . mysql_error());
			exit;			
		}
		
		
   		mysql_query("COMMIT");
		echo "บันทึกรายการสั่งซื้อผลิตภัณฑ์ของคุณเรียบร้อยแล้วค่ะ ...";
		exit;
//############################################################
}


//echo "Mode =$doMode";




?>
<? ob_end_flush(); ?>