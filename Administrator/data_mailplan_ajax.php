<?php session_start();?>
<?php 
header('Content-type: text/html; charset=windows-874');
include("../i_function_msg.php");
require("../Connections/bwc_orders.php");
include("i_convert.php"); 
?>

<?php
$strcamp=$_POST['camp'];
$camp= substr($strcamp,3,4).substr($strcamp,0,2);
$dist=$_POST['dist'];
$txtdiv= $_POST['txtdiv'];

mysql_select_db($database_bwc_orders, $bwc_orders);
mysql_query("SET NAMES 'tis620'");
//mysql_query("SET NAMES 'utf8'");

$query="SELECT DISTINCT MAILGROUP,MAILGROUP,BILLDATE,SHIPDATE,DLVDATE  
			 FROM TBL015 WHERE CAMP=$camp   AND  DIST <> '999'  ORDER BY MAILGROUP";
			
$mailgroup =mysql_query($query,$bwc_orders) or die(mysql_error());

/*
$query = "SELECT * FROM tbl015 Where dist <>'' ";


if ($strcamp !="") {
	$query .="  AND CAMP = $camp";
}

if ($dist!=""){
	$query.=" AND DIST='$dist'";
}


$tbl015 = mysql_query($query, $dsm_orders) or die(mysql_error());

*/
//$row_order = mysql_fetch_assoc($order);
?>
<table width="100%" border="0" cellpadding="3" cellspacing="1">
  <tr  style="color:#FFF;background-color:#B27F86" nowrap>
    <td width="28" align="center">NO.</td>
    <td width="84" align="center">CAMPAIGN</td>
    <td width="86" align="center">BILL DATE</td>
    <td width="88" align="center">SHIPDATE</td>
    <td width="88" align="center">DLV. DATE</td>
    <td width="43" align="center">GROUP</td>
    <td width="501" align="left">&nbsp;</td>
  </tr>
<?php 
$i =1;
while ($row_mailgroup=mysql_fetch_assoc($mailgroup))
{

	if  (($i%2)==0) {
		$bg="#FEEDEF";
	}
	else {
		$bg="#FEDAE0";
	}

	$mail_group=$row_mailgroup['MAILGROUP'];
	
	$query = "SELECT * FROM tbl015 Where  DIST <> '999' AND MAILGROUP ='$mail_group' And  CAMP=$camp ";
	
	if ($txtdiv !="") {
		$query.=" AND DIST  IN ( Select DISTRICT FROM users WHERE  DIVCODE ='$txtdiv')";
	}
	
	if ($dist!=""){
		$query.=" AND DIST='$dist'";
	}
		
	$query.=" ORDER BY DIST";
	
	$list_dist ="";
	
	//echo $query;
		
	$tbl015 = mysql_query($query, $bwc_orders) or die(mysql_error());
	while ($row_tbl015=mysql_fetch_assoc($tbl015))
	{
		$list_dist.=$row_tbl015['DIST']. "  ";
		$campaign =substr($row_tbl015['CAMP'],4,2) ."/".substr($row_tbl015['CAMP'],0,4);
	}
	$billdate=func_ConvertDateToString( $row_mailgroup['BILLDATE'],"");
	$shipdate=func_ConvertDateToString($row_mailgroup['SHIPDATE'],"");
	$dlvdate=func_ConvertDateToString($row_mailgroup['DLVDATE'],"");
	
	//$effdte =  func_ConvertDateToString($row_tbl015['EFFDTE'],"");
	//$expdte =  func_ConvertDateToString($row_tbl015['EXPDTE'],"");
	mysql_free_result($tbl015);
			
?>  
  <tr  bgcolor="<?php  echo $bg?>" >
    <td align="center" valign="top" nowrap><?php echo $i; ?></td>
    <td align="center" valign="top" nowrap><?php   if ($i==1){echo  $campaign;} ?></td>
    <td align="center" valign="top"><?php echo  $billdate; ?></td>
    <td align="center" valign="top"><?php echo  $shipdate; ?></td>
    <td align="center" valign="top"> <?php echo  $dlvdate; ?></td>
    <td align="center" valign="top"><?php echo "  ".$row_mailgroup['MAILGROUP']; ?></td>
    <td align="left" valign="top"><?php  echo  $list_dist;?></td>
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
  </tr>
</table>

<hr />
<?php
mysql_free_result($mailgroup);
?>
