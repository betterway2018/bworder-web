<?php require_once('Connections/bwc_orders.php'); ?>
<?php 
echo "กำลังบันทึกข้อมูลการสั่งซื้อสินค้า กรุณารอสักครู่ ...";
echo "<br>";



$dist=$_POST['dist'];
$mslno=$_POST['mslno'];
$chkdgt=$_POST['chkdgt'];
$rep_name=$_POST['rep_name'];
$rep_email = $_POST['email'];
$campaign=$_POST['campaign'];	
$totalItems = $_POST['TotalItems'];
$curcamp=$_POST['curcamp'];


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


//Get Current DateTime
mysql_select_db($database_bwc_orders, $bwc_orders);
$queryTime = "select curdate() as curdate,curtime() as curtime";
$get_date = mysql_query($queryTime,$bwc_orders) or die(mysql_error());
$row_get_date =mysql_fetch_assoc ($get_date);
$current_date = str_replace("-","",$row_get_date['curdate']);
$current_time =str_replace(":","",$row_get_date['curtime']);


$str_rep_code =$dist."-".$mslno."-".$chkdgt;
$str_camp =substr($campaign,4,2)."/".substr($campaign,0,4) ;
$str_current_date = substr($current_date,6,2)."/".substr($current_date,4,2)."/".substr($current_date,0,4);
$str_current_time = substr($current_time,0,2).":".substr($current_time,2,2).":".substr($current_time,4,2);
$str_dwn_date = substr($DwnDate,6,2)."/".substr($DwnDate,4,2)."/".substr($DwnDate,0,4);

$toal_amount =0;
$i_item=0;


$amt_1=0;
$amt_2=0;
$amt_3=0;

$spc_1=0;
$spc_2=0;
$spc_3=0;

$net_1=0;
$net_2=0;
$net_3=0;

for ($i=1;$i<=$totalItems;$i++){
			if ($_POST['txtcode_'.$i]!="" && $_POST['txtqty_'.$i] !="") {
					$bill_code=$_POST['txtcode_'.$i];
					$bill_qty=intval($_POST['txtqty_'.$i]);
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
							$bill_gconly = $row_billcode['GCONLY'];
							$bill_spcflg=$row_billcode['SPCFLG'];
							$bill_freeflg= $row_billcode['FREEFLG'];
							$bill_discflg=$row_billcode['DISCFLG'];
					 }
					 else 
					 {
							$bill_desc="";
							$bill_price=0;
							$bill_amt ="0";
							$bill_gconly = "0";
							$bill_spcflg="0";
							$bill_freeflg= "0";
							$bill_discflg="0";
					 }
			
					
					$product_id; // ไอดีสินค้าที่คำนวณส่วนลด
					$StrSql=mysql_query("select count(id) as Count, sum(product_price) as SumPrice from order where product_id='$product_id'");
					$Fetch_obj=mysql_fetch_array($StrSql);
					$Rate = $Fetch_obj['Count'];
					$Sum= $Fetch_obj['SumPrice'];
					
					// ตัวอย่างการนับจำนวนสินค้า และรวมราคา จากตาราง order น่ะครับ ของคุณอาจแตกต่างไปจากนี้ ค่อยประยุกต์เอา
					
					if($Rate >10 && $Rate < 20)
					{
					$Sum = $sum - (($Sum*10)/100);
					}
					elseif($Rate >20 && $Rate < 30)
					{
					$Sum = $sum - (($Sum*15)/100);
					}
					elseif($Rate >30 && $Rate < 50)
					{
					$Sum = $sum - (($Sum*20)/100);
					}
					else
					{
					$Sum = $sum - (($Sum*25)/100);
					}
								
					echo "$bill_code  $bill_desc   $bill_price  $bill_qty  $bill_gconly  $bill_spcflg $bill_freeflg $bill_discflg";
					echo "<br>";
			
			
					$i_item  =$i_item+1;
					$amount = $amount + $bill_amt;
					
					
			}
 }//for loop

?>

<?
/*
friday  1-299.99 = 0
        300-499.99 =10
        500-999999.99 =20


select * from dscpcy  where  camp=201119
Mistine
        1 - 299.99 = 0
        300 - 499.99 = 15
        500 - 2999.99 = 25
        3000-999999.99 = 30
        
faris         
	1-999.99 = 10%
	1000-1999.99 = 15%
	2000-2999.99	 = 20%
	3000-999999.99 =30%

*/
?>