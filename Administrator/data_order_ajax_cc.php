<?php session_start();?>
<?php 
header('Content-type: text/html; charset=windows-874');
include("../i_function_msg.php");
require("../Connections/bwc_callcenter.php");
include("i_convert.php"); 
?>

<?php
$dist=$_POST['dist'];
$mslno=$_POST['mslno'];
$div= $_SESSION['div_code'];
$login_type =$_SESSION['login_type'];
$strcamp=$_POST['camp'];
$campaign=substr($strcamp,3,4).substr($strcamp,0,2);
$dwnflag=$_POST['dwnflag'];

mysql_select_db($database_bwc_orders, $bwc_orders);
mysql_query("SET NAMES 'tis620'");
//mysql_query("SET NAMES 'utf8'");



$filter="";


$query="SELECT
	order_header.ORDER_NO, order_header.ORDCAMP, order_header.ORDDATE,
	order_header.ORDTIME, order_header.DIST, order_header.MSLNO,
	order_header.CHKDGT, order_header.NAME, order_header.ITEMS,
	order_header.TOTAL_AMOUNT, order_header.BILLDATE,
	order_header.SHIPDATE, order_header.DLVDATE, order_header.DWNDATE,
	order_header.DWNFLAG
FROM
	order_header WHERE order_header.DELFLAG='N' ";



if ($dist !="") {
	$query.=" AND order_header.DIST='$dist'";
}

if ($mslno !="") {
	$query.=" AND order_header.MSLNO='$mslno'";
}

if ($campaign!="") {
	$query.=" AND order_header.ORDCAMP='$campaign'";
}
	
if ($dwnflag!="") {
	$query.=" AND order_header.DWNFLAG ='$dwnflag'";
	$query.= "order by  dwndate,orddate,ordtime  asc";
}
  
//echo $query;


$order = mysql_query($query, $bwc_orders) or die(mysql_error());
mysql_close($bwc_orders);
//$row_order = mysql_fetch_assoc($order);
?>
<table border="0" cellpadding="3" cellspacing="1" align="center">
  <tr  style="color:#ffedf8;background-color: #000000" nowrap>
    <td>&nbsp;</td>
    <td>ลำดับ</td>
    <td>รอบจำหน่าย</td>
    <td>ใบสั่งซื้อ</td>
    <td>รหัสสมาชิก</td>
    <td>วันที่ / เวลา</td>
    <td align="right">จำนวนรายการ</td>
    <td align="right">จำนวนเงิน</td>
    <td>สถานะ</td>
    <td>วันที่ดาวน์โหลด</td>
  </tr>
<?php 
$i =1;
while ($row_order=mysql_fetch_assoc($order))
{
	
	if  (($i%2)==0) {
		$bg="#FFB6C1";
	}
	else {
		$bg="#FEDAE0";
	}

		
			$campaign =substr($row_order['ORDCAMP'],4,2) ."/".substr($row_order['ORDCAMP'],0,4);
			$rep_code =$row_order['DIST']."-".substr("00000".$row_order['MSLNO'],-5)."-".$row_order['CHKDGT'];
			$rep_name = $row_order['NAME'];
								   
			$mslno=$row_order['MSLNO'];
			$chkdgt=$row_order['CHKDGT'];
			$p_no=$campaign."-".substr("000000".$row_order['ORDER_NO'],-6);
			$script_link ="po=".$row_order['ORDER_NO']."&id=". $row_order['DIST'].substr("00000".$row_order['MSLNO'],-5).$row_order['CHKDGT']."&camp=".$row_order['ORDCAMP'];
			$date=$row_order['ORDDATE'];
			$time=$row_order['ORDTIME'];
			$yy=substr($date,0,4);$mm=substr($date,4,2);$dd=substr($date,6,2);
			$time=substr($time,0,2).":".substr($time,2,2).":".substr($time,4,2);
			$dateT=$dd."/".$mm."/".$yy." ".$time;
			
			$total_amt = number_format($row_order['TOTAL_AMOUNT'],0,".",",");
?>  
  <tr  bgcolor="<?php  echo $bg?>" nowrap>
    <td><a href="javascript: MM_openBrWindow('../order_view.php?<? echo $script_link;?>','', 760, 550);"><img src="images/xmag.png" width="16" height="16" border="0"></a></td>
    <td nowrap><?php echo $i; ?></td>
    <td nowrap><?php  echo  " ".substr($row_order['ORDCAMP'],4,2)."/".substr($row_order['ORDCAMP'],0,4);?></td>
    <td><?php echo  " ". $row_order['ORDER_NO'];?></td>
    <td><?php echo  $row_order['DIST']."-".substr("00000".$row_order['MSLNO'],-5)."-".$row_order['CHKDGT']."  ".$row_order['NAME'];?></td>
    <td nowrap><?php echo  func_ConvertDateToString($row_order['ORDDATE'],$row_order['ORDTIME']);?></td>
    <td align="right"><?php echo  $row_order['ITEMS'];?></td>
    <td align="right"><?php  echo  $total_amt;?></td>
    <td align="center"><?php echo  $row_order['DWNFLAG'];?></td>
    <td align="center"><?php echo  func_ConvertDateToString($row_order['DWNDATE'],"");?></td>
  </tr>
  <?php 
  $i=$i+1;
}
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

<hr style=" border:dotted 1px #999" />
<table width="274" border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
    <td width="137" align="right"><? echo $_SESSION['login_type'];?> :</td>
    <td width="129" align="left"><?php  echo $div?></td>
  </tr>
  <tr>
    <td align="right">District :</td>
    <td align="left"><?php  echo $dist ?></td>
  </tr>
  <tr>
    <td align="right">Campaign : </td>
    <td align="left"><?php  echo $strcamp ?></td>
  </tr>
  <tr>
    <td align="right">Download Status : </td>
    <td align="left"><?php  echo $dwnflag?></td>
  </tr>
</table>
<hr style=" border:dotted 1px #999" />
<?php
mysql_free_result($order);
?>
