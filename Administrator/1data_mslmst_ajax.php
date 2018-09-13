<?php session_start();?>
<?php 
header('Content-type: text/html; charset=windows-874');
include("../i_function_msg.php");
require("../Connections/bwc_orders.php");
include("i_convert.php"); 
?>

<?php
/*$dist=$_SESSION['dist'];
$mslno=$_SESSION['mslno'];
$chkdgt=$_SESSION['chkdgt'];
$rep_name=$_SESSION['name'];


if ($dist=="" || $mslno=="" || $chkdgt=="") {
	echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
}
*/
mysql_select_db($database_bwc_orders, $bwc_orders);
mysql_query("");

$query = "SELECT * FROM MSLMST  WHERE  DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt";
$mslmst = mysql_query($query, $bwc_orders) or die(mysql_error());
$row_mslmst = mysql_fetch_assoc($mslmst);
$totalRows_mslmst = mysql_num_rows($mslmst);
if ($totalRows_mslmst==0) {
 AlertMessage("ไม่พบรหัสสมาชิกหรือ ระบุรหัสสมาชิกไม่ถูกต้อง","javascript:history.back();");
 exit;
}
else { 
	$bDate =substr($row_mslmst['BIRTHDATE'],6,2);
	$bMonth =substr($row_mslmst['BIRTHDATE'],4,2);
	$bYear =substr($row_mslmst['BIRTHDATE'],0,4);
	$email = $row_mslmst['EMAIL'];
	
}
?>
<table width="900" border="0" cellpadding="3" cellspacing="1">
  <tr  style="color:#FFF;background-color:#cd067c" nowrap>
    <td width="61" align="center">ลำดับ</td>
    <td width="136" align="center">รอบจำหน่าย</td>
    <td width="172" align="center">วันที่เริ่มต้น</td>
    <td width="95" align="center">วันที่สิ้นสุด</td>
    <td width="160" align="center">สถานะ</td>
    <td width="160" align="center">jksdfghsjkdfgsdfg</td>
  </tr>
<?php 
$i =1;
while ($row_mslmst=mysql_fetch_assoc($mslmst))
{
	
	if  (($i%2)==0) {
		$bg="#febae2";
	}
	else {
		$bg ="#ffddf1";
		$f_color ="#000000";
		$f_w ="normal";
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
