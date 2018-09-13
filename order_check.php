<?php  session_start(); ?>
<?php require("i_config.php"); ?>
<?php require("check_login.php"); ?>
<?php require_once('Connections/bwc_orders.php'); ?>


<?php
$dist=$_SESSION['dist'];
$mslno=$_SESSION['mslno'];
$chkdgt=$_SESSION['chkdgt'];
$name=$_SESSION['name'];
$website_id =$_SESSION["website"];

//$currentCamp
//$orderCamp
//$doMode

$orddate=date('Ymd');
$ordtime=date('Hi00');



if ($dist=="" || $mslno=="" || $chkdgt=="") {
	echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
}


$orderCamp=$_GET["campaign"];


if ($orderCamp==""){
		// Query Current by Dist
		mysql_select_db($database_bwc_orders, $bwc_orders);
		$query="SELECT * FROM TBL015 WHERE DIST = '$dist' AND SHIPDATE > $orddate  ORDER BY camp asc limit 1";
		$tbl015=mysql_query($query,$bwc_orders) or die(mysql_error());
		$row_tbl015=mysql_fetch_assoc($tbl015);
		$total_row_tbl015 = mysql_num_rows($tbl015);
		
		if ($total_row_tbl015==0) {
			$query_campaign = "SELECT CAMP FROM TBL008 WHERE STATUS IN ('Current') ORDER BY CAMP";
			$tblcampaign = mysql_query($query_campaign, $bwc_orders) or die(mysql_error());
			$row_tblcampaign = mysql_fetch_assoc($tblcampaign);
			$totalRows_tblcampaign = mysql_num_rows($tblcampaign);
			$currentCamp=$row_tblcampaign['CAMP'];
			$orderCamp=$row_tblcampaign['CAMP'];
		}
		else {
			$currentCamp=$row_tbl015['CAMP'];
			$orderCamp=$row_tbl015['CAMP'];
		}

}


//Check Order History 
mysql_select_db($database_bwc_orders, $bwc_orders);


// เขตในการทดสอบการทำงาน 
if ($dist == "0999")
{    
    $query_order = "SELECT ORDER_NO, ORDCAMP, ORDDATE, ORDTIME, ITEMS, TOTAL_AMOUNT, BILLDATE, SHIPDATE, DLVDATE, DWNDATE, DWNFLAG, DP_DOWNLOAD FROM order_header  WHERE DWNFLAG='N' AND DELFLAG='N' AND  DIST='$dist' and MSLNO=$mslno AND CHKDGT=$chkdgt AND ORDCAMP=$orderCamp";
}
else
{
     $query_order = "SELECT ORDER_NO, ORDCAMP, ORDDATE, ORDTIME, ITEMS, TOTAL_AMOUNT, BILLDATE, SHIPDATE, DLVDATE, DWNDATE, DWNFLAG, DP_DOWNLOAD FROM order_header WHERE DWNFLAG='N' AND DELFLAG='N' AND  DIST='$dist' and MSLNO=$mslno AND CHKDGT=$chkdgt AND ORDCAMP=$orderCamp";
}





//echo $query_order 
//secho "<br>";
$order = mysql_query($query_order, $bwc_orders) or die(mysql_error());
$row_order = mysql_fetch_assoc($order);
$totalRows_order = mysql_num_rows($order);
if ($totalRows_order==0) {
	$doMode="New";
}
else {
	$doMode="Edit";
	$Order_No =$row_order['ORDER_NO'];
}


// Display resultr

//echo "Member Code		=$dist-$mslno-$chkdgt <br>
//		 Redirect from 		= $website_id <br>
//		 Order Date 			= $orddate 		<br>
//		 Current Campaign 	= $currentCamp <br>
//		 Order Campaign 		= $orderCamp 	<br>
//		 Mode 					= $doMode 		<br>
//		 Order No 				=$Order_No";

 $SQLPOINT= " select * from point_50 where DIST=$dist and MSLNO=$mslno and CHKDGT = $chkdgt and ORDCAMP= $orderCamp and ORDER_NO='$Order_No' and ORDER_FLAG = '50' ";
 $orderpoint = mysql_query($SQLPOINT, $bwc_orders) or die(mysql_error());
$row_order = mysql_fetch_assoc($orderpoint);
$totalRows_order = mysql_num_rows($orderpoint);
//echo  $SQLPOINT."DDDD"; exit;
if ($row_order['ORDER_FLAG'] == "50")
{

$_SESSION["ORDER_FLAG"] = "50" ;
}
else
{
$_SESSION["ORDER_FLAG"] = "0" ;

}


 

												

if ($doMode=="New") {
	
	//header('Location: order_form.php?doMode='.$doMode.'&camp='.$orderCamp.'&id='.$dist.$mslno.$chkdgt);
                if($dist == "0999")
                {              
                   $rep_code = $dist.$mslno.$chkdgt;                  
                    $rep_name=$_SESSION['name'];
                    $scriptLink = "Internetorder/?doMode=".$doMode."&camp=".$orderCamp."&id=".$rep_code."&rep_name=".$rep_name."&dist=".$dist."&mslno=".$mslno."&chkdgt=".$chkdgt;
                    echo "<meta http-equiv='refresh' content='0;URL=$scriptLink'>";               
                }
                else
                {
	   // $scriptLink = "order_form.php?doMode=".$doMode."&camp=".$orderCamp."&id=".$dist.$mslno.$chkdgt;
	   // echo "<meta http-equiv='refresh' content='0;URL=$scriptLink'>";

                    $rep_code = $dist.$mslno.$chkdgt;                  
                    $rep_name=$_SESSION['name'];
                    $scriptLink = "Internetorder/?doMode=".$doMode."&camp=".$orderCamp."&id=".$rep_code."&rep_name=".$rep_name."&dist=".$dist."&mslno=".$mslno."&chkdgt=".$chkdgt;
                    echo "<meta http-equiv='refresh' content='0;URL=$scriptLink'>";   
                

                }
	//echo $scriptLink;
}
else {
	
//	header('Location: order_form.php?doMode='.$doMode.'&camp='.$orderCamp.'&id='.$dist.$mslno.$chkdgt."&po=".$Order_No);
              if($dist == "0999")
                {            
                        $rep_code = $dist.$mslno.$chkdgt;                  
                        $rep_name=$_SESSION['name'];
                        $scriptLink = "Internetorder/?doMode=".$doMode."&camp=".$orderCamp."&id=".$rep_code."&rep_name=".$rep_name."&po=".$Order_No."&dist=".$dist."&mslno=".$mslno."&chkdgt=".$chkdgt;
                        echo "<meta http-equiv='refresh' content='0;URL=$scriptLink'>";
                     
                }
                else
                {
	    // $scriptLink = "order_form.php?doMode=".$doMode."&camp=".$orderCamp."&id=".$dist.$mslno.$chkdgt."&po=".$Order_No;
	    // echo "<meta http-equiv='refresh' content='0;URL=$scriptLink'>";

                        $rep_code = $dist.$mslno.$chkdgt;                  
                        $rep_name=$_SESSION['name'];
                        $scriptLink = "Internetorder/?doMode=".$doMode."&camp=".$orderCamp."&id=".$rep_code."&rep_name=".$rep_name."&po=".$Order_No."&dist=".$dist."&mslno=".$mslno."&chkdgt=".$chkdgt;
                        echo "<meta http-equiv='refresh' content='0;URL=$scriptLink'>";

                }
	//echo $scriptLink;
	// ข้อมูลที่รับค่าจาก  Order_Form.php
/* 	$no=$_GET['po'];
	$rep_code=$_GET['id'];
	$dist=substr($rep_code,0,3);
	$mslno=substr($rep_code,3,5);
	$chkdgt=substr($rep_code,8,1);
	$campaign=$_GET['camp'];
	$rep_name=$_SESSION['name'];
 */}



?>