<?php session_start();  
?>
<?php require_once('Connections/bwc_orders.php'); ?>
<?php require("i_config.php"); ?>
<?php include("i_function_msg.php"); ?>
<?php include("i_function_format.php"); ?>
<?php

$po=$_GET['po'];
$id=$_GET['id'];
$camp=$_GET['camp'];
$rep_seq=$_GET["rep_seq"];

/*$dist=substr($id,0,3);
$mslno=substr($id,3,5);
$chkdgt=substr($id,8,1);*/

if(strlen($id)==10){
			$dist=substr($id,0,4);
			$mslno=substr($id,4,5);
			$chkdgt=substr($id,9,1);
			//echo "ผู้จัดการเขต 4 หลัก".$id;
			}
			elseif(strlen($id)==9){
			$dist=substr($id,0,3);
			$mslno=substr($id,3,5);
			$chkdgt=substr($id,8,1);
			//echo "ผู้จัดการเขต 3 หลัก".$id;
				}

if($rep_seq <>  "")
{
  $rep_seq="rep_seq = $rep_seq and ";

}

// ไว้ใช้กับรหัสที่ทำการทดสอบ 
if($dist == "0999")
{
        mysql_select_db($database_bwc_orders, $bwc_orders);
        $query_order = "SELECT * FROM order_header    WHERE ".$rep_seq." chkdgt='$chkdgt'  
		and  order_no='$po'  and ordcamp='$camp' AND DELFLAG='N'";
		// echo $query_order; exit;
        $order = mysql_query($query_order, $bwc_orders) or die(mysql_error());
       // echo $query_order;
        $row_order = mysql_fetch_assoc($order);
        $totalRows_order = mysql_num_rows($order);

        mysql_select_db($database_bwc_orders, $bwc_orders);
        $query_order_line = "SELECT * FROM order_detail   WHERE  ".$rep_seq." order_no='$po' 
		and  ordcamp='$camp' AND DELFLAG='N' order by  ListNO";
		// echo $query_order_line; exit;
        $order_line = mysql_query($query_order_line, $bwc_orders) or die(mysql_error());
        $row_order_line = mysql_fetch_assoc($order_line);
        $totalRows_order_line = mysql_num_rows($order_line);  
}
else
{ 
        mysql_select_db($database_bwc_orders, $bwc_orders);
        $query_order = " SELECT *  FROM order_header   WHERE ".$rep_seq."   order_no='$po'  
		and ordcamp='$camp' AND DELFLAG='N'";
        $order = mysql_query($query_order, $bwc_orders) or die(mysql_error());
         //echo $query_order; 
        $row_order = mysql_fetch_assoc($order);
        $totalRows_order = mysql_num_rows($order);

		

         mysql_select_db($database_bwc_orders, $bwc_orders);
        $query_order_line = "SELECT * FROM order_detail  WHERE dist='$dist' and mslno='$mslno' and chkdgt='$chkdgt'  and order_no='$po' and ordcamp='$camp' AND DELFLAG='N' order by  ListNO";
		//echo $query_order_line; exit;
        $order_line = mysql_query($query_order_line, $bwc_orders) or die(mysql_error());
        $row_order_line = mysql_fetch_assoc($order_line);
        $totalRows_order_line = mysql_num_rows($order_line);
}
//exit;

mysql_close($bwc_orders);
//echo  "totalrows=$totalRows_order_line";

if ($totalRows_order > 0){
		
			$campaign =substr($row_order['ORDCAMP'],4,2) ."/".substr($row_order['ORDCAMP'],0,4);
			$p_no=$campaign."-".substr("000000".$row_order['ORDER_NO'],-6);
			$script_link ="po=".$row_order['ORDER_NO']."&id=$dist$mslno$chkdgt" ."&camp=".$row_order['ORDCAMP'];
			$date=$row_order['ORDDATE'];
			$time=$row_order['ORDTIME'];
			$yy=substr($date,0,4);$mm=substr($date,4,2);$dd=substr($date,6,2);
			$time=substr($time,0,2).":".substr($time,2,2).":".substr($time,4,2);
			$dateT=$dd."/".$mm."/".$yy." ".$time;	
}
else {
	AlertMessage("ไม่พบเลขที่เอกสาร","javascript:window.close();");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><?php  echo $title?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function doSaveAs(){
if (document.execCommand){
document.execCommand("SaveAs")
}
else {
alert("Save-feature available only in Internet Exlorer 5.x.")
}
}
function ShowSaveComplete() {

if (document.all) {

var OLECMDID_SAVEAS = 4;

var OLECMDEXECOPT_DONTPROMPTUSER = 2;

var OLECMDEXECOPT_PROMPTUSER = 1;

var WebBrowser = "<OBJECT ID=\"WebBrowser1\" WIDTH=0 HEIGHT=0 CLASSID=\"CLSID:8856F961-340A-11D0-A96B-00C04FD705A2\"></OBJECT>";

document.body.insertAdjacentHTML("beforeEnd", WebBrowser);

WebBrowser1.ExecWB(OLECMDID_SAVEAS, OLECMDEXECOPT_PROMPTUSER);

WebBrowser1.outerHTML = "";

} else {

alert("This is only applicable to Internet Explorer");

}

}


//-->
</script>
</head>

<body  style="background-color:#FFF" >
<table width="750" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><table width="750" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="275" height="88" align="left"><img src="image_head/bwc_logo1.gif" width="252" height="88" /></td>
        <td width="150" align="center" valign="top"><img src="image_head/cutting_web_02.gif" width="148" height="79" /></td>
        <td width="163" align="center" valign="top"><img src="image_head/cutting_web_03.gif" width="149" height="79" /></td>
        <td width="162" align="center" valign="top"><img src="image_head/cutting_web_04.gif" width="147" height="79" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><br /><center>
      <img src="image_icon/product_list.gif" width="274" height="31" /></center>
    <hr />
    <table width="740" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="5"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_01.gif" 
                        width="5" /></td>
        <td width="740"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_02.gif" 
                        width="730" /></td>
        <td width="10"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_03.gif" 
                        width="5" /></td>
      </tr>
      <tr>
        <td valign="top" 
                      background="Images/Box_Set3/frame_04.gif"><img height="75" alt="" 
                        src="Images/Box_Set3/frame_04.gif" 
                        width="5" /></td>
        <td valign="top" bgcolor="#ffffff"><table width="100%" border="0" cellspacing="1" cellpadding="2">
          <tr>
            <td width="11%" align="right">รหัสสมาชิก : </td>
            <td width="33%"><?php  echo "$dist-$mslno-$chkdgt"; ?></td>
            <td width="33%" align="right">เลขที่สั่งซื้อ : </td>
            <td width="23%"><?php echo  $p_no ?></td>
          </tr>
          <tr>
            <td align="right">ชื่อสมาชิก : </td>
            <td><?php echo $row_order['NAME'];?>&nbsp;</td>
            <td align="right">วันที่สั่งซื้อ : </td>
            <td><?php echo $dateT; ?></td>
          </tr>
          <tr>
            <td align="right">อีเมลล์ : </td>
            <td><? echo $_SESSION['email']; ?>&nbsp;</td>
            <td align="right">รอบจำหน่ายที่สั่งซื้อ : </td>
            <td><? echo  $campaign; ?>&nbsp;</td>
          </tr>
        </table></td>
        <td valign="top" 
                      background="Images/Box_Set3/frame_06.gif"><img 
                        height="75" alt="" 
                        src="Images/Box_Set3/frame_06.gif" 
                        width="5" /></td>
      </tr>
      <tr>
        <td><img height="5" alt="" 
                        src="Images/Box_Set3/frame_07.gif" 
                        width="5" /></td>
        <td><img height="5" alt="" 
                        src="Images/Box_Set3/frame_08.gif" 
                        width="730" /></td>
        <td><img height="5" alt="" 
                        src="Images/Box_Set3/frame_09.gif" 
                        width="5" /></td>
      </tr>
    </table>
    <table width="740" border="0" align="center" cellpadding="0" cellspacing="1"  style="border:#ec008c solid 1px;margin-top:3px">
      <tr style="background-image:url(image_icon/bg_cell.gif);background-position:top;background-repeat:repeat-x;color:#226543;font-weight:bold">
        <td width="4" height="24">&nbsp;</td>
        <td width="47" align="center" nowrap="nowrap"><strong class="content_header3">ลำดับ</strong></td>
        <td width="74" align="center" nowrap="nowrap"><strong class="content_header3">รหัสสินค้า</strong></td>
        <td width="69" align="center" nowrap="nowrap"><strong class="content_header3">จำนวน</strong></td>
        <td width="357" nowrap="nowrap"><strong class="content_header3">&nbsp;ชื่อสินค้า/รายละเอียด</strong></td>
        <td width="93" align="right" nowrap="nowrap"><strong class="content_header3">ราคา/หน่วย</strong></td>
        <td width="86" align="right" nowrap="nowrap"><strong class="content_header3">ราคารวม</strong></td>
      </tr>

      <? 
$i=1;
$amt=0;
do { 
	$amt=$amt+$row_order_line['AMOUNT'];
?>
      <tr bgcolor="#FFF0FE" style=" height:26px;">
        <td align="center" class="line_bottom" >&nbsp;</td>
        <td align="right" class="line_bottom" style="padding-right:3px"><? echo  "$i." ?></td>
        <td align="center" class="line_bottom"><?php echo " ".$row_order_line['BILLCODE']; ?></td>
        <td align="center" class="line_bottom"><?php echo "".$row_order_line['QTY']; ?></td>
        <td class="line_bottom" style="padding-left:6px"><?php echo  "".$row_order_line['BILLDESC']; ?>&nbsp;</td>
        <td align="right" class="line_bottom"><?php echo " ". intToMoney($row_order_line['PRICE']); ?></td>
        <td align="right" class="line_bottom"><?php echo  " ". intToMoney($row_order_line['AMOUNT']); ?>&nbsp;</td>
      </tr>
      <?php 
  	$i=$i+1;
  } while ($row_order_line = mysql_fetch_assoc($order_line)); ?>
    </table>
    <table width="740"  border="0" align="center" cellpadding="2" cellspacing="1">
      <tr>
        <td width="644" align="right"><strong>จำนวนเงินก่อนหักส่วนลด</strong></td>
        <td width="85" align="right"  style="padding-right:6px"><strong><? echo intToMoney($amt); ?></strong></td>
      </tr>
    </table>
    <br />
    <br />
    <br />
    <center>
      <a href="javascript:print();"><img src="images/print_printer.png" width="16" height="16" border="0" />  พิมพ์เอกสาร</a> | <a href="javascript:window.close()">ปิดหน้าต่าง</a>
    </center>
    <br /></td>
  </tr>
</table>
<br /><?php include("i_footer.php"); ?>
</body>
</html>
<?php
mysql_free_result($order);

mysql_free_result($order_line);
?>
