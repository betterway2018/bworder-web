<?php require_once('Connections/bwc_orders.php'); ?>
<?php 
header('Content-type: text/html; charset=windows-874');
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



$toal_amount =$_POST['txtTotalAmount'];
$i_item=0;


$amt_1=$_POST['txtG_1'];
$amt_2=$_POST['txtG_2'];
$amt_3=$_POST['txtG_3'];

$dsc_1=0;
$dsc_2=0;
$dsc_3=0;
$nor_gross_1 =0;
$nor_gross_2=0;
$nor_gross_3=0;

$spc_gross_1=0;
$spc_gross_2=0;
$spc_gross_3=0;

$spc_disc_1=0;
$spc_discs_2=0;
$spc_disc_3=0;

$spc_net_1=0;
$spc_net_2=0;
$spc_net_3=0;

$normal_disc_1=0;
$normal_disc_2=0;
$normal_disc_3=0;

$net_1=0;
$net_2=0;
$net_3=0;

$qty_disc_1 =0;
$qty_disc_2=0;
$qty_disc_3=0;
$qty_net_1=0;
$qty_net_2=0;
$qty_net_3=0;
$qty_spc_1=0;
$qty_spc_2=0;
$qty_spc_3 =0;


//brand1 เดิม
/*if($amt_1>0 && $amt_1<=299.99) {$dsc_1=0;}
else if($amt_1>=300 && $amt_1<=499.99) {$dsc_1=15;}
else if($amt_1>=500 && $amt_1<=2999.99) {$dsc_1=25;}
else if($amt_1>=3000 && $amt_1<=999999.99) {$dsc_1=30;}*/

//brand1 ใหม่
	 if($amt_1>0 && $amt_1<=199.99) {$dsc_1=0;}
     	else if($amt_1>=200 && $amt_1<=999.99) {$dsc_1=10;}                                                 
       	else if($amt_1>=1000 && $amt_1<=1999.99) {$dsc_1=15;}                                                
        else if($amt_1>=2000 && $amt_1<=2999.99) {$dsc_1=20;}
        else if($amt_1>=3000 && $amt_1<=999999.99) {$dsc_1=30;}

//brand2 เดิม
/*if($amt_2>0 && $amt_2<=299.99) {$dsc_2=0;}
else if($amt_2>=300 && $amt_2<=499.99) {$dsc_2=10;}
else if($amt_2>=500 && $amt_2<=999999.99) {$dsc_2=20;}*/

//brand2 ใหม่
if($amt_2>0 && $amt_2<=199.99) {$dsc_2=0;}
	else if($amt_2>=200 && $amt_2<=999.99) {$dsc_2=10;}
	else if($amt_2>=1000 && $amt_2<=1999.99) {$dsc_2=15;}
	else if($amt_2>=2000 && $amt_2<=999999.99) {$dsc_2=20;}

//brand3
if($amt_3>0 && $amt_3<=999.99) {$dsc_3=10;}
else if($amt_3>=1000 && $amt_3<=1999.99) {$dsc_3=15;}
else if($amt_3>=2000 && $amt_3<=2999.99) {$dsc_3=20;}
else if($amt_3>=3000 && $amt_3<=999999.99) {$dsc_3=30;}			


for ($i=1;$i<=$totalItems;$i++){
			if ($_POST['txtcode_'.$i]!="" && $_POST['txtqty_'.$i] !="") {
					$bill_code=$_POST['txtcode_'.$i];
					$bill_qty=intval($_POST['txtqty_'.$i]);
					$bill_brand = $_POST['txtbrand_'.$i];
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
							
					 }
					 else 
					 {
							$bill_desc="";
							$bill_price=0;
							$bill_amt =0;
							$bill_spcflg="";
							$bill_discflg="";
							$bill_inctflg="";
							$bill_freeflg= "";
					 }
					
					//Normal Discount
				
					if($bill_brand=="1" && $bill_discflg=="Y" && $bill_spcflg=="N") {
							$normal_disc_1=$normal_disc_1 + ($bill_amt - ($bill_amt * $dsc_1/100));
							$qty_disc_1=$qty_disc_1 + $bill_qty;
							$nor_gross_1 =$nor_gross_1 + $bill_amt;
					}
					else  if($bill_brand=="2" && $bill_discflg=="Y" && $bill_spcflg=="N") {
							$normal_disc_2=$normal_disc_2 + ($bill_amt - ($bill_amt * $dsc_2/100));
							$qty_disc_2=$qty_disc_2 + $bill_qty;
							$nor_gross_2 =$nor_gross_2 + $bill_amt;
					}
					else  if($bill_brand=="3" && $bill_discflg=="Y" && $bill_spcflg=="N") {
							$normal_disc_3=$normal_disc_3 + ($bill_amt - ($bill_amt * $dsc_3/100));
							$qty_disc_3=$qty_disc_3 + $bill_qty;
							$nor_gross_3 =$nor_gross_3 + $bill_amt;
					}
					
			
					//special discount
					if ($bill_brand=="1" && $bill_spcflg=="Y")
					{
						$spc_gross_1 = $spc_gross_1 + $bill_amt;
						$spc_disc_1 = $spc_disc_1  + ($bill_amt * $row_billcode['SPCDSCBASE'] /100);
						$spc_net_1=$spc_net_1 +($bill_amt - ($bill_amt * $row_billcode['SPCDSCBASE'] /100));
						$qty_spc_1=$qty_spc_1 + $bill_qty;
						

					}
					else if ($bill_brand=="2" && $bill_spcflg=="Y") 
					{
						$spc_gross_2 = $spc_gross_2 + $bill_amt;
						$spc_disc_2 = $spc_disc_2  + ($bill_amt * $row_billcode['SPCDSCBASE'] /100);
						$spc_net_2=$spc_net_2 +($bill_amt - ($bill_amt * $row_billcode['SPCDSCBASE'] /100));
						$qty_spc_2=$qty_spc_2 + $bill_qty;
					}
					else if ($bill_brand=="3" && $bill_spcflg=="Y") 
					{
						$spc_gross_3 = $spc_gross_3 + $bill_amt;
						$spc_disc_3 = $spc_disc_3 + ($bill_amt * $row_billcode['SPCDSCBASE'] /100);
						$spc_net_3=$spc_net_3 +($bill_amt - ($bill_amt * $row_billcode['SPCDSCBASE'] /100));
						$qty_spc_3=$qty_spc_3 + $bill_qty;
					}
					
					// Net Amount
					
					if($bill_brand=="1" && $bill_discflg=="N" && $bill_spcflg=="N") {
							$net_1 = $net_1 + $bill_amt;
							$qty_net_1=$qty_net_1+$bill_qty;
					}
					else  if($bill_brand=="2" && $bill_discflg=="N" && $bill_spcflg=="N") {
							$net_2 =$net_2+$bill_amt;
							$qty_net_2=$qty_net_2+$bill_qty;
					}
					else  if($bill_brand=="3" && $bill_discflg=="N" && $bill_spcflg=="N") {
							$net_3 = $net_3+$bill_amt;
							$qty_net_3=$qty_net_3+$bill_qty;
					}
					
					
					
					
			//echo "billcode  $bill_code  $bill_amt   $spc_gross_1   $spc_disc_1 $spc_net_1 <br>";		
					
			/*		if ($bill_brand=="1") {
						$amt_1 = $amt_1 + $bill_amt;
					}elseif($bill_brand=="2") {
						$amt_2 =$amt_2 + $bill_amt;
					}elseif($bill_brand=="3") {
						$amt_3=$amt_3 + $bill_amt;
					}
			*/
			
					$i_item  =$i_item+1;
					$amount = $amount + $bill_amt;
					
					
			}
 }//for loop

$qty_total_1 = floatval($qty_disc_1) +floatval($qty_spc_1) + floatval($qty_net_1);
$qty_total_2 = floatval($qty_disc_2) +floatval($qty_spc_2) + floatval($qty_net_2);
$qty_total_3 = floatval($qty_disc_3) +floatval($qty_spc_3) + floatval($qty_net_3);

$gross_total_1=floatval($net_1) + floatval($spc_gross_1) + floatval($nor_gross_1);
$gross_total_2=floatval($net_2) + floatval($spc_gross_2) + floatval($nor_gross_2);
$gross_total_3=floatval($net_3) + floatval($spc_gross_3) + floatval($nor_gross_3);

 
$net_total_1=floatval($net_1) + floatval($spc_net_1) + floatval($normal_disc_1);
$net_total_2=floatval($net_2) + floatval($spc_net_2) + floatval($normal_disc_2) ;
$net_total_3=floatval($net_3) + floatval($spc_net_3) + floatval($normal_disc_3);
		
/*
echo "Normal Discount<br>";
echo "Mistine    : $amt_1  discount $dsc_1 %  =$normal_disc_1<br>";
echo "Friday     : $amt_2 discount $dsc_2 %  =$normal_disc_2<br>";
echo "Faris       : $amt_3 discount $dsc_3 %  =$normal_disc_3<br>";

echo "Special discount <br>";
echo  "Mistine : $spc_gross_1   disc amt  $spc_disc_1 =  $spc_net_1<br>";
echo  "Friday : $spc_gross_2   disc amt  $spc_disc_2 =  $spc_net_2<br>";
echo  "Faris : $spc_gross_3   disc amt  $spc_disc_3 =  $spc_net_3<br>";

echo "Net Amount <br>";
echo  "Mistine  = $net_1 <br>";
echo "Friday =  $net_2 <br>";
echo "Faris = $net_3 <br>";

*/

//echo "Friday : $spc_gross_2    -->$spc_2 =  $spc_gross_2-$spc_2 <br>";
//echo "Faris : $spc_gross_3    --> $spc_3 =  $spc_gross_3-$spc_3 <br>";

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
<table width="611" border="0" cellpadding="2" cellspacing="1">
  <tr>
    <td width="210" align="center" valign="top" nowrap="nowrap" bgcolor="#CCCCCC"><strong>รายการสั่งซื้อผลิตภัณฑ์</strong></td>
    <td width="63" align="right" valign="top" nowrap="nowrap" bgcolor="#CCCCCC"><strong>จำนวน </strong></td>
    <td width="104" align="right" valign="top" nowrap="nowrap" bgcolor="#CCCCCC"><strong>รวมเงิน
    (บาท)</strong></td>
    <td width="89" align="right" valign="top" nowrap="nowrap" bgcolor="#CCCCCC"><strong>ส่วนลด
    (%)</strong></td>
    <td width="119" align="right" valign="top" bgcolor="#CCCCCC"><strong>มูลค่าสูทธิ(บาท)</strong></td>
  </tr>
  <tr>
    <td colspan="5" align="left" style="border-bottom:#666 solid 1px; border-top:#666 solid 1px">ผลิตภัณฑ์ มิสทิน</td>
  </tr>
  <tr>
    <td align="right">มูลค่าผลิตภัณฑ์ที่ไม่มีส่วนลด</td>
    <td align="right"><?php echo $qty_net_1 ?></td>
    <td align="right"><?php echo $net_1?></td>
    <td align="right"><?php  "" ?></td>
    <td align="right"><?php echo $net_1?></td>
  </tr>
  <tr>
    <td align="right">ผลิตภัณฑ์ที่มีส่วนลดพิเศษ</td>
    <td align="right"><?php echo $qty_spc_1 ?></td>
    <td align="right"><?php echo $spc_gross_1?></td>
    <td align="right"><?php  " " //echo $spc_disc_1?></td>
    <td align="right"><?php echo $spc_net_1 ?></td>
  </tr>
  <tr>
    <td align="right">ผลิตภัณฑ์ที่มีส่วนลดปกติ</td>
    <td align="right"><?php echo $qty_disc_1 ?></td>
    <td align="right"><?php echo $nor_gross_1 ?></td>
    <td align="right"><?php  echo $dsc_1."%"?></td>
    <td align="right"><?php echo $normal_disc_1?></td>
  </tr>
  <tr>
    <td align="right"><strong>รวมมูลค่าผลิตภัณฑ์มิสทิน</strong></td>
    <td align="right"><strong><?php echo $qty_total_1?></strong></td>
    <td align="right"><strong><?php echo  $gross_total_1 ?></strong></td>
    <td align="right">&nbsp;</td>
    <td align="right"><strong> <?php echo $net_total_1 ?>   </strong></td>
  </tr>
  <tr style="border-bottom:#666 solid 1px">
    <td colspan="5" align="left" style="border-bottom:#666 solid 1px; border-top:#666 solid 1px">ผลิตภัณฑ์ฟรายเดย์</td>
  </tr>
  <tr>
    <td align="right">มูลค่าผลิตภัณฑ์ที่ไม่มีส่วนลด</td>
     <td align="right"><?php echo $qty_net_2 ?></td>
    <td align="right"><?php echo $net_2?></td>
    <td align="right"><?php  "" ?></td>
    <td align="right"><?php echo $net_2?></td>
  </tr>
  <tr>
    <td align="right">ผลิตภัณฑ์ที่มีส่วนลดพิเศษ</td>
  <td align="right"><?php echo $qty_spc_2 ?></td>
    <td align="right"><?php echo $spc_gross_2?></td>
    <td align="right"><?php  " " //echo $spc_disc_1?></td>
    <td align="right"><?php echo $spc_net_2 ?></td>
  </tr>
  <tr>
    <td align="right">ผลิตภัณฑ์ที่มีส่วนลดปกติ</td>
   <td align="right"><?php echo $qty_disc_2 ?></td>
    <td align="right"><?php echo $nor_gross_2 ?></td>
    <td align="right"><?php  echo $dsc_2."%"?></td>
    <td align="right"><?php echo $normal_disc_2?></td>
  </tr>
  <tr>
    <td align="right"><strong>รวมมูลค่าผลิตภัณฑ์ฟรายเดย์</strong></td>
   <td align="right"><strong><?php echo $qty_total_2?></strong></td>
    <td align="right"><strong><?php echo  $gross_total_2 ?></strong></td>
    <td align="right">&nbsp;</td>
    <td align="right"><strong> <?php echo $net_total_2 ?>   </strong></td>
  </tr>
  <tr>
    <td colspan="5" align="left" style="border-bottom:#666 solid 1px; border-top:#666 solid 1px">ผลิตภัณฑ์ฟาริส บาย นาริส</td>
  </tr>
  <tr>
    <td align="right">มูลค่าผลิตภัณฑ์ที่ไม่มีส่วนลด</td>
     <td align="right"><?php echo $qty_net_3 ?></td>
    <td align="right"><?php echo $net_3?></td>
    <td align="right"><?php  "" ?></td>
    <td align="right"><?php echo $net_3?></td>
  </tr>
  <tr>
    <td align="right">ผลิตภัณฑ์ที่มีส่วนลดพิเศษ</td>
    <td align="right"><?php echo $qty_spc_3 ?></td>
    <td align="right"><?php echo $spc_gross_3?></td>
    <td align="right"><?php  " " //echo $spc_disc_1?></td>
    <td align="right"><?php echo $spc_net_3 ?></td>
  </tr>
  <tr>
    <td align="right">ผลิตภัณฑ์ที่มีส่วนลดปกติ</td>
   <td align="right"><?php echo $qty_disc_3 ?></td>
    <td align="right"><?php echo $nor_gross_3 ?></td>
    <td align="right"><?php  echo $dsc_3."%"?></td>
    <td align="right"><?php echo $normal_disc_3?></td>
  </tr>
  <tr>
    <td align="right"><strong>รวมมูลค่าผลิตภัณฑ์ฟาริส บาย นาริส</strong></td>
   <td align="right"><strong><?php echo $qty_total_3?></strong></td>
    <td align="right"><strong><?php echo  $gross_total_3 ?></strong></td>
    <td align="right">&nbsp;</td>
    <td align="right"><strong> <?php  echo $net_total_3 ?>   </strong></td>
  </tr>
  <tr>
    <td colspan="4" align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="right"><font color="#FF0000"><strong>รวมมูลค่าผลิตภัณฑ์ที่สั่งซื้อในรอบ </strong></font></td>
    <td align="right"><font color="#FF0000"><strong>
      <?php 
		$net_total=  floatval($net_total_1)+floatval($net_total_2)+floatval($net_total_3);
		echo $net_total;
	?>
    </strong></font></td>
  </tr>
  <tr>
    <td colspan="5" align="left"><font color="#FF0000"><strong>หมายเหตุ :</strong><br />
        <li>โปรด "กดปุ่มยืนยันรายการสั่งซื้ออีกครั้ง" เพื่อให้รายการของท่านบันทึกเข้าระบบคะ</li>
        <li>รายการทั้งหมดยังไม่ได้เช็คเงื่อนไขการขาย/รายการสินค้าขาดสต็อค กรุณาตรวจสอบส่วนลดผลิตภัณฑ์อีกครั้งหลังจากที่ดาวน์โหลดข้อมูลเรียบร้อยแล้ว</li></font>
    </td>
  </tr>
</table>
<script type="text/javascript">
	document.getElementById('txtNormal_disc_1').value='123';
</script>
