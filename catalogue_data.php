<?php  session_start(); 
ob_start();
?>
<?php require("i_config.php"); ?>
<?php require("check_login.php"); ?>
<?php require_once('Connections/bwc_orders.php'); ?>

<?php
header('Content-type: text/html; charset=windows-874');
//  var pmeters = "Brand=" + encodeURI(fBrand) +"&Camp="+encodeURI(fCamp)+"&Type="+encodeURI(fType)+"&pageNo="+encodeURI(pageno.value);

$id= $_POST['id'];
$PageNo=$_POST['pageNo'];
$page1= substr($PageNo,0,3);
$page2= substr($PageNo,3,3);

mysql_select_db($database_bwc_orders, $bwc_orders);
mysql_query("SET NAMES 'tis620'");

$query0 ="Select * from Catalogue Where id=$id";
$cat= mysql_query($query0, $bwc_orders) or die(mysql_error());
$row_cat = mysql_fetch_assoc($cat) ;
$camp=$row_cat['CAMP'];
$title = $row_cat['TITLE'];

 $query= "Select * from Catalogue_data where id =$id And CPAGE_FROM='$page1' AND CPAGE_TO='$page2'  and Price >0 Order by BILLCODE";						
//echo $query;
//echo "<BR>";
$billcode= mysql_query($query, $bwc_orders) or die(mysql_error());
//$row_billcode = mysql_fetch_assoc($billcode);
$num_row_billcode=mysql_num_rows($billcode);

?>

 <?php echo $title ?>  หน้า <?php  echo $page1 . ' - '. $page2 ?>  จำนวน :  <?  echo $num_row_billcode ?>  รายการ

<table width="900" border="0" cellspacing="1" cellpadding="3" style="border:#6CC solid 1px">
  <tr style="background:url(images/h_bg2.gif);background-position:bottom;background-repeat:repeat-x;height:25px">
    <td width="83" height="28" align="center" valign="bottom"><strong>รหัสสินค้า</strong></td>
    <td width="444" valign="bottom"><strong>ชื่อสินค้า - รายละเอียด</strong></td>
    <td width="73" align="center" valign="bottom"><strong>หน้า</strong></td>
    <td width="104" align="center" valign="bottom"><strong>ราคา/หน่วย</strong></td>
    <td width="158" align="right" valign="bottom">&nbsp;</td>
  </tr>
  <?php
  $i=0;
  while ($row_billcode = mysql_fetch_assoc($billcode)) {
	   if ($i % 2) {
	  	 $bg="#f3c7e2";
	   }else {
	  	$bg="#fce3f2";
	   }
	
	   
  ?>
  
  <tr  bgcolor="<?php  echo $bg?>" >
    <td align="center" width="83"><?php  echo  " ".$row_billcode['BILLCODE'] ?></td>
    <td><?php echo $row_billcode['BILL_DESC'] ?></td>
    <td align="center"><?php echo  $page1." - " . $page2 ?></td>
    <td align="center"><?php  echo  (int) $row_billcode['PRICE'] ?></td>
    <td align="center"><table width="158" border="0" cellspacing="0" cellpadding="1">
      <tr>
        <td width="36" rowspan="2"><input name="<? echo"Qty_".$row_billcode['BILLCODE'] ?>" type="text" id="<? echo "Qty_".$row_billcode['BILLCODE']; ?>" value="1" size="4" maxlength="4" /></td>
        <td width="9" height="10" align="center" valign="middle"><a href="#" onclick=" return Qty_Added(<? echo "Qty_".$row_billcode['BILLCODE']?>);">
        <img src="Images/arrow-up-sharp.gif" width="9" height="5" border="0" /></a></td>
        <td width="107" rowspan="2" align="center" valign="middle">
	  <input type="button" name="button" id="button" value="สั่งซื้อสินค้า"  class="ui-state-default ui-corner-all"  
        onclick="javascript:AddToCart(<? echo $camp ?>,'<? echo $row_billcode['BILLCODE']?>','<? echo $row_billcode['BILL_DESC'] ?>',
        document.getElementById('<? echo "Qty_".$row_billcode['BILLCODE'] ?>').value,<? echo $row_billcode['PRICE'] ?>);"/>
 </td>
      </tr>
      <tr>
        <td height="5" align="center" valign="middle"><a href="#" onclick=" return Qty_Minus(<? echo "Qty_".$row_billcode['BILLCODE']?>);"><img src="Images/arrow-dn-sharp.gif" width="9" height="5" border="0" /></a></td>
      </tr>
    </table></td>
  </tr>
  
<?php 
	$i=$i+1;
} ?>  
</table>
