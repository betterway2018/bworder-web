<?php 
session_start();
ob_start();

require("../Connections/bwc_orders.php");
include("../i_function_msg.php");
include("i_convert.php"); 

?>

<?php
header('Content-type: text/html; charset=windows-874');
$y=$_POST['YEAR'];
$div= $_SESSION['div_code'];

mysql_select_db($database_bwc_orders, $bwc_orders);
mysql_query("SET NAMES 'tis620'");
//mysql_query("SET NAMES 'utf8'");

$query = "SELECT * FROM tbl008 ";


if ($y !="") {
	$query .=" WHERE YEAR = $year order by camp desc";
}

  

$tbl008 = mysql_query($query, $bwc_orders) or die(mysql_error());
mysql_close($bwc_orders);
//$row_order = mysql_fetch_assoc($order);
?>
<table width="900" border="0" cellpadding="3" cellspacing="1">
  <tr  style="color:#FFF;background-color:#cd067c" nowrap>
    <td width="61" align="center">ลำดับ</td>
    <td width="136" align="center">รอบจำหน่าย</td>
    <td width="172" align="center">วันที่เริ่มต้น</td>
    <td width="95" align="center">วันที่สิ้นสุด</td>
    <td width="160" align="center">สถานะ</td>
  </tr>
<?php 
$i =1;
while ($row_tbl008=mysql_fetch_assoc($tbl008))
{
	
	if  (($i%2)==0) {
		$bg="#febae2";
	}
	else {
		$bg="#ffddf1";
	}

			$campaign =substr($row_tbl008['CAMP'],4,2) ."/".substr($row_tbl008['CAMP'],0,4);
			$effdte =  func_ConvertDateToString($row_tbl008['EFFDTE'],"");
			$expdte =  func_ConvertDateToString($row_tbl008['EXPDTE'],"");

	if ($row_tbl008['STATUS'] !="Closed") {
		$f_color = "#FF0000";
		$f_w="bold";
	}
	else {
		$f_color ="#000000";
		$f_w="normal";
	}
?>  
  <tr  bgcolor="<?php  echo $bg?>" nowrap  style="color:<? echo $f_color;?>;font-weight:<? echo $f_w;?>">
    <td align="center" nowrap><?php echo $i; ?></td>
    <td align="center" nowrap><?php  echo  $campaign ?></td>
    <td align="center"><?php echo  $effdte; ?></td>
    <td align="center"><?php echo $expdte;?></td>
    <td align="center" nowrap><?php  echo $row_tbl008['STATUS'];?></td>
  </tr>
  <?php 
  $i=$i+1;
}
  ?>
</table>

<hr />
<?php
mysql_free_result($tbl008);
?>
