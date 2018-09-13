<?php session_start();?>
<?php 
header('Content-type: text/html; charset=windows-874');
require("../Connections/bwc_orders.php");



mysql_select_db($database_bwc_orders, $bwc_orders);
mysql_query("SET NAMES 'tis620'");
//mysql_query("SET NAMES 'utf8'");

$query = "Select * From billcode_msg ";

if ($_POST['orderby']!=""){
	$query .=" Order by  camp desc";
}
	
  

$billmsg = mysql_query($query, $bwc_orders) or die(mysql_error());
//$row_order = mysql_fetch_assoc($order);



?>

<table width="975" border="0" align="center" cellpadding="3" cellspacing="1" class="FormBorder_3">
  <tr   style="color:#FFF">
    <td width="89" bgcolor="#339900"  style=" font color:#FFF" >&nbsp;</td>
    <td width="82" bgcolor="#339900" style=" font color:#FFF" ><strong><a href="javascript:doAjax('CAMP')" style="color:#FFF">Campaign</a></strong></td>
    <td width="82" bgcolor="#339900" style="color:#FFF"><strong><a href="javascript:doAjax('BILLCODE')" style="color:#FFF">Bill Code</a></strong></td>
    <td width="285" bgcolor="#339900" style="color:#FFF"><strong><a href="javascript:doAjax('BILLDESC')" style="color:#FFF">Bill Description</a></strong></td>
    <td width="138" bgcolor="#339900" style="color:#FFF"><strong><a href="javascript:doAjax('MSGTYP')" style="color:#FFF">Message Type</a></strong></td>
    <td width="256" bgcolor="#339900" style="color:#FFF"><strong>Message Description</strong></td>
  </tr>
<?php
$i =1;
while ($row_billmsg=mysql_fetch_assoc($billmsg))
{
	
	if  (($i%2)==0) {
		$bg="#febae2";
	}
	else {
		$bg="#ffddf1";
	}

	$campaign =substr($row_billmsg['CAMP'],4,2) ."/".substr($row_billmsg['CAMP'],0,4);
	$camp=$row_billmsg['CAMP'];
	$billcode=$row_billmsg['BILLCODE'];
	
?>  

  <tr style=" color:#000">
    <td align="center" valign="top" nowrap="nowrap" bgcolor="#C6FFC6">[ <a href="billing_msg_delete.php?camp=<?php echo $camp ?>&amp;billcode=<?php echo $billcode ?>">ลบ</a> ]</td>
    <td align="center" valign="top" bgcolor="#C6FFC6">&nbsp;<?php  echo $campaign;?></td>
    <td align="center" valign="top" bgcolor="#C6FFC6">&nbsp;<?php echo "". $row_billmsg['BILLCODE'];?></td>
    <td align="left" valign="top" bgcolor="#C6FFC6">&nbsp;<?php echo $row_billmsg['BILLDESC'];?></td>
    <td align="center" valign="top" bgcolor="#C6FFC6">&nbsp;<?php echo $row_billmsg['MSGTYP'];?></td>
    <td align="left" valign="top" bgcolor="#C6FFC6">&nbsp;<?php echo $row_billmsg['MSG_DESC'];?></td>
  </tr>
  <?php 
  $i=$i+1;
}
  ?>  
  <tr>
    <td bgcolor="#C6FFC6"><input type="button" name="cmdAdd" id="cmdAdd" value="เพิ่มข้อมูล"  onclick="window.location='#Insert'"/></td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
    <td bgcolor="#C6FFC6">&nbsp;</td>
  </tr>
</table>
