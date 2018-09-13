<?php
///   นำรอบจำหน่าย และเขต เพื่อหา  วันที่  Bill Date,ShipDate,วันที่จัดส่งสินค้า,และวันที่ download
// Input data    	$campaign
//						$dist		               
/*
// Output Data	$order_type   ( Late, Current,Advance)
						
//						$bill_date
//						$ship_date
//						$dlv_date
//						$dwn_date
					 	$end_of_order			
						
						$lastCamp
						$orderCamp
						$nextCamp
						$currentCamp

// Option Outpub $
//						$bill_date2
//						$ship_date2
//						$dlv_date2
*/


$bill_date="";
$ship_date="";
$dlv_date ="";
$dwn_date="";

$bill_date1=0;
$ship_date1=0;
$dlv_date1 =0;	


$bill_date2=0;
$ship_date2=0;
$dlv_date2 =0;	


mysql_select_db($database_dsm_orders, $bwc_orders);
$query_campaign = "SELECT CAMP FROM TBL008 WHERE STATUS IN ('Current') ORDER BY CAMP ASC  LIMIT 1";
$tblcampaign = mysql_query($query_campaign, $bwc_orders) or die(mysql_error());
$row_tblcampaign = mysql_fetch_assoc($tblcampaign);
$totalRows_tblcampaign = mysql_num_rows($tblcampaign);
$currentCamp=$row_tblcampaign['CAMP'];
mysql_free_result($tblcampaign);


// Get Current Campaign by Ship Date
mysql_select_db($database_bwc_orders, $bwc_orders);
$query="SELECT * FROM TBL015 WHERE DIST = '$dist' AND SHIPDATE > $wrkDate Order by CAMP  ASC  LIMIT 1";
$mailplan1=mysql_query($query,$bwc_orders) or die(mysql_error());
$row_mailplan1=mysql_fetch_assoc($mailplan1);
$total_row_mailplan1 = mysql_num_rows($mailplan1);

if ($total_row_mailplan1==0) {
	$query_campaign = "SELECT CAMP FROM TBL008 WHERE STATUS IN ('Current') ORDER BY CAMP ASC  LIMIT 1";
	$tblcampaign = mysql_query($query_campaign, $bwc_orders) or die(mysql_error());
	$row_tblcampaign = mysql_fetch_assoc($tblcampaign);
	$totalRows_tblcampaign = mysql_num_rows($tblcampaign);
	$currentCamp_by_ship=$row_tblcampaign['CAMP'];
	mysql_free_result($tblcampaign);
}

else {
		$currentCamp_by_ship=$row_mailplan1['CAMP'];
}
mysql_free_result($mailplan1);

//echo "currentCamp by Ship =  $currentCamp_by_ship"."<br>";
//echo "camppaign =$campaign"."<br>";
if (intval($campaign)==intval($currentCamp_by_ship)) {
	$order_type="Current";
	//echo "xxx current xxxx";
}
elseif(intval($campaign)< intval($currentCamp_by_ship)) {
	$order_type="Late";
	//echo "xxxxxlatexxxxxx" ;
}
elseif(intval($campaign )>intval($currentCamp_by_ship)) {
	$order_type = "Advance";
	//echo "xxx Advance xxx";
}



$query="SELECT * FROM TBL015 WHERE DIST = '$dist' AND CAMP =$campaign   ORDER BY  CAMP  ASC ,BILLDATE ASC LIMIT 2";
$mailplan=mysql_query($query,$bwc_orders) or die(mysql_error());
$row_mailplan=mysql_fetch_assoc($mailplan);
$total_row_mailplan = mysql_num_rows($mailplan);

if ($total_row_mailplan==0) {
	$ordercamp=$currentCamp;
	echo "row =0";
}
else {

		$bill_date1=$row_mailplan['BILLDATE'];
		$ship_date1=$row_mailplan['SHIPDATE'];
		$dlv_date1 =$row_mailplan['DLVDATE'];
		$dwn_date =$row_mailplan['BILLDATE'];
		
		if ($total_row_mailplan==1) {
				$bill_date=$row_mailplan['BILLDATE'];
				$ship_date=$row_mailplan['SHIPDATE'];
				$dlv_date =$row_mailplan['DLVDATE'];
				$dwn_date =$row_mailplan['BILLDATE'];
		
		}
		elseif ($total_row_mailplan >1) {
			/// Support  1 Campaign 2 Ship
				$row_mailplan=mysql_fetch_assoc($mailplan);
				$bill_date2=$row_mailplan['BILLDATE'];
				$ship_date2=$row_mailplan['SHIPDATE'];
				$dlv_date2 =$row_mailplan['DLVDATE'];
				
		
				// ดู Mail plan ตามวันที่   (Support  2Ship)
				
				if ( (int)$mail_plan_date < (int)$bill_date1 && (int)$mail_plan_date < (int)$bill_date2) {
					$bill_date=$bill_date1;
					$ship_date=$ship_date1;
					$dlv_date = $dlv_date1;
				}
				elseif ((int)$mail_plan_date > (int)$bill_date1 && (int)$mail_plan_date <(int)$bill_date2) {
					$bill_date=$bill_date2;
					$ship_date=$ship_date2;
					$dlv_date = $dlv_date2;
				}
				elseif ((int)$mail_plan_date > (int)$bill_date1 && (int)$mail_plan_date >(int)$bill_date2) {
					$bill_date=$bill_date2;
					$ship_date=$ship_date2;
					$dlv_date = $dlv_date2;	
				}
		}
		else {
				$bill_date2=0;
				$ship_date2=0;
				$dlv_date2=0;
		}
}


$c_camp =26;
$cur_camp_year= substr($campaign,0,4);
$cur_camp_no = substr($campaign,-2);

$next_y =0;
$next_no=0;

$last_no=0;
$last_year=0;

//Calulate Next Campaign
if (intval($cur_camp_no)==intval($c_camp) ) {
	$next_no =1;
	$next_y = intval($cur_camp_year)+1;
}
else {
	$next_no = intval($cur_camp_no) +1;
	$next_y=$cur_camp_year;
}

$nextCamp= (string)$next_y."".substr("00".(string)$next_no,-2);



//Calculate Last Campaign 
if (intval($cur_camp_no)==1) {
	$last_no =$c_camp;
	$last_year = intval($cur_camp_year)-1;
}
else {
	$last_no = intval($cur_camp_no) -1;
	$last_year=$cur_camp_year;
}
$lastCamp=$last_year.substr("00".$last_no,-2);


//Next Delivery
//if (intval($dlv_date) <=intval(date('Ymd'))) {
	
if($order_type=="Late") {
	//$wrkDate =date('Ymd');

	
	mysql_select_db($database_bwc_orders, $bwc_orders);
	$query="SELECT * FROM TBL015 WHERE DIST = '$dist' AND SHIPDATE >$dlv_date Order by CAMP  ASC  LIMIT 1";
	$mailplan2=mysql_query($query,$bwc_orders) or die(mysql_error());
	$row_mailplan2=mysql_fetch_assoc($mailplan2);
	$total_row_mailplan2 = mysql_num_rows($mailplan2);
	if ($total_row_mailplan2!=0) {
		$dlv_date =$row_mailplan2['DLVDATE'];
	}
	mysql_free_result($mailplan2);
}

mysql_free_result($mailplan);



// วันที่ Download
if (intval($bill_date) <= intval(date('Ymd'))) {
	if (date("l",strtotime("+1 day"))=="Saturday") {
		$date = date("Ymd", strtotime("+3 day"));
	}
	else if (date("l",strtotime("+1 day"))=="Sunday") {
		$date = date("Ymd", strtotime("+2 day"));
	}
	else {
			$date = date("Ymd", strtotime("+1 day"));
	}
	//$order_type="Late";	
	$dwn_date=$date;		
}
else {
	$dwn_date=$bill_date;
}


// End Of Order
$fmt_date = substr($dwn_date,0,4).'-'.substr($dwn_date,4,2).'-'.substr($dwn_date,6,2);
$adate = date($fmt_date); 
$end_of_order=date("Ymd",strtotime("-1 days",strtotime($adate)));


/*
echo "total_row =".$total_row_mailplan. "<BR>";
echo "Order Type : $order_type <br>";
echo "Current Campaign : $currentCamp <BR>";
echo "Current Campaign by ship  : $currentCamp_by_ship <BR>";
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
echo "<br>";
echo "End Of Order : $end_of_order";
echo "<br><br>";
echo "BILLDATE2 : $bill_date2";
echo "<br>";
echo "SHIPDATE2 : $ship_date2";
echo "<br>";
echo "DLVDATE2 : $dlv_date2";
echo "<br>";


*/



?>