<?php
///   นำวันที่ปัจจุบัน และเขต เพื่อหา รอบจำหน่ายปัจจุบัน , วันที่  Bill Date,Ship,Date และข้อมูล
// Input data    	$wrkDate
//						$dist		               

// Output Data	$currentCamp
//						$nextCamp
//						$lastCamp


//						$bill_date
//						$ship_date
//						$dlv_date
//						$dwn_date

if ($wrkDate==""){
	$wrkDate=date('Ymd');
}

mysql_select_db($database_bwc_orders, $bwc_orders);
$query="SELECT * FROM TBL015 WHERE DIST = '$dist' AND SHIPDATE >=$wrkDate Order by CAMP  ASC  LIMIT 1";
$mailplan=mysql_query($query,$bwc_orders) or die(mysql_error());
$row_mailplan=mysql_fetch_assoc($mailplan);
$total_row_mailplan = mysql_num_rows($mailplan);

if ($total_row_mailplan==0) {
	$query_campaign = "SELECT CAMP FROM TBL008 WHERE STATUS IN ('Current') ORDER BY CAMP ASC  LIMIT 1";
	$tblcampaign = mysql_query($query_campaign, $bwc_orders) or die(mysql_error());
	$row_tblcampaign = mysql_fetch_assoc($tblcampaign);
	$totalRows_tblcampaign = mysql_num_rows($tblcampaign);
	$currentCamp=$row_tblcampaign['CAMP'];
	$bill_date="";
	$ship_date="";
	$dlv_date ="";	
	$dwn_date="";
	mysql_free_result($tblcampaign);
}

else {
		$currentCamp=$row_mailplan['CAMP'];
		$bill_date=$row_mailplan['BILLDATE'];
		$ship_date=$row_mailplan['SHIPDATE'];
		$dlv_date =$row_mailplan['DLVDATE'];
		
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
		
			$dwn_date=$date;		
		}


}


$c_camp =26;
$cur_camp_year= substr($currentCamp,0,4);
$cur_camp_no = substr($currentCamp,-2);

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

?>

<?php
//Test Data
/*
echo " 	WrkDate : $wrkDate <br>
			District :	$dist <br>
			current : $currentCamp <br>
			next :$nextCamp <br>
			last :$lastCamp <br>
			Bill Date : $bill_date  <br>
			Ship Date :$ship_date  <br>
			Dlv Date :$dlv_date  <br>
			Dwn date : $dwn_date <br>";

*/
?>