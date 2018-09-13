<?php  session_start(); ?>
<?php require("i_config.php"); ?>
<?php require("check_login.php"); ?>
<?php require_once('Connections/bwc_orders.php'); ?>

<?php
  function func_ConvertDateToString($iDate) {
			$yy=substr($iDate,0,4);
			$mm=substr($iDate,4,2);
			$dd=substr($iDate,6,2);
		//	$time=substr($time,0,2).":".substr($time,2,2).":".substr($time,4,2);
			return $dd."/".$mm."/".$yy;
  }
?>

<?php
$dist=$_SESSION['dist'];
$mslno=$_SESSION['mslno'];
$chkdgt=$_SESSION['chkdgt'];
$name=$_SESSION['name'];




if ($dist=="" || $mslno=="" || $chkdgt=="") {
	echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
}

mysql_select_db($database_bwc_orders, $bwc_orders);
$query_order = "SELECT ORDER_NO, ORDCAMP, ORDDATE, ORDTIME, ITEMS, TOTAL_AMOUNT, BILLDATE, SHIPDATE, DLVDATE, DWNDATE, DWNFLAG, DP_DOWNLOAD FROM order_header WHERE DELFLAG='N' AND  DIST='$dist' and MSLNO=$mslno AND CHKDGT=$chkdgt;";
$order = mysql_query($query_order, $bwc_orders) or die(mysql_error());
$row_order = mysql_fetch_assoc($order);
$totalRows_order = mysql_num_rows($order);

mysql_select_db($database_bwc_orders, $bwc_orders);
$query_campaign = "SELECT * FROM TBL015 WHERE DIST = '999' AND CAMP IN (SELECT CAMP FROM TBL008 WHERE STATUS IN ('Late','Current','Advance')) ORDER BY CAMP";
$tblcampaign = mysql_query($query_campaign, $bwc_orders) or die(mysql_error());
$row_tblcampaign = mysql_fetch_assoc($tblcampaign);
$totalRows_tblcampaign = mysql_num_rows($tblcampaign);




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
//-->
</script>

<script language="JavaScript" type="text/JavaScript"> 
 
	function MM_openBrWindow(theURL,winName,w,h,scrollbars) 
	{ 
	  LeftPosition=(screen.width)?(screen.width-w)/2:100;
	  TopPosition=(screen.height)?(screen.height-h)/2:100;
	  
	  settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scrollbars+',location=no,directories=no,status=0,menubar=no,toolbar=no,resizable=no';
	  URL = theURL;
	  window.open(URL,winName,settings);
	}

	function confirmDelete(url,pno) {
		if (confirm("คุณต้องการยกเลิกรายการสั่งซื้อสินค้า " + pno +" ใช่หรือไม่ ?")) {
			document.location = url;
			//return true ;
		}
	}
	function confirmEdit(url,pno) {
		if (confirm("คุณต้องการแก้ไขรายการสั่งซื้อสินค้า " + pno +" ใช่หรือไม่ ?")) {
			document.location = url;
			//return true ;
		}
	}	
		
</script>

</head>

<body>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td><table width="860" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" align="left" valign="top"><img src="images/Box_Set3/frame_01.gif" width="5" height="5" /></td>
        <td width="845" align="left" valign="top"><img src="images/Box_Set3/frame_02.gif" width="900" height="5" /></td>
        <td width="10" align="right" valign="top"><img src="images/Box_Set3/frame_03.gif" width="5" height="5" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="Sheet_Boder"  ><?php include("i_header.php"); ?>
</td>
  </tr>
  <tr>
    <td height="480" align="left" valign="top" class="Sheet_Boder" style="padding:2px"><table 
                  width="709" height="79" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
      <tbody>
        <tr>
          <td height="5"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_01.gif" 
                        width="5" /></td>
          <td width="700"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_02.gif" 
                        width="700" /></td>
          <td width="10"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_03.gif" 
                        width="5" /></td>
        </tr>
        <tr>
          <td valign="top" width="5" 
                      background="Images/Box_Set3/frame_04.gif" 
                      height="55"><img height="2" alt="" 
                        src="Images/Box_Set3/frame_04.gif" 
                        width="5" /></td>
          <td valign="top" bgcolor="#ffffff"><table width="100%" border="0" cellspacing="1" cellpadding="2">
            <tr>
              <td width="10%" align="right">รหัสสมาชิก : </td>
              <td width="46%"><? printf("%s-%s-%s ",$_SESSION['dist'],$_SESSION['mslno'],$_SESSION['chkdgt']); ?>
           </td>
              <td width="19%" align="right">&nbsp;</td>
              <td width="25%">&nbsp;</td>
            </tr>
            <tr>
              <td align="right">ชื่อสมาชิก : </td>
              <td><?php echo $_SESSION['name'];?>&nbsp;</td>
              <td align="right">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td height="20" align="right">อีเมลล์ : </td>
              <td><? echo $_SESSION['email']; ?>&nbsp;</td>
              <td align="right">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          <td valign="top" 
                      background="Images/Box_Set3/frame_06.gif"><img 
                        height="1" alt="" 
                        src="Images/Box_Set3/frame_06.gif" 
                        width="5" /></td>
        </tr>
        <tr>
          <td height="5"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_07.gif" 
                        width="5" /></td>
          <td><img height="5" alt="" 
                        src="Images/Box_Set3/frame_08.gif" 
                        width="700" /></td>
          <td><img height="5" alt="" 
                        src="Images/Box_Set3/frame_09.gif" 
                        width="5" /></td>
        </tr>
      </tbody>
    </table>
<br />
<?php
if ($totalRows_order>0) {
?>
    <table width="793" border="0" align="center" cellpadding="3" cellspacing="0">
      <tr>
        <td width="787"><strong>ประวัติการสั่งซื้อสินค้าทางอินเตอร์เน็ตของคุณ :</strong></td>
      </tr>
      <tr>
        <td><table width="750" border="0" cellpadding="2" cellspacing="1" class="FormBorder">
          <tr class="content_header">
            <td width="37" height="23" align="center" bgcolor="#348F56"><strong>ลำดับที่</strong></td>
            <td width="63" align="center" bgcolor="#348F56"><strong>รอบจำหน่าย</strong></td>
            <td width="127" align="center" bgcolor="#348F56"><strong>วันที่สั่งซื้อ</strong></td>
            <td width="100" align="center" bgcolor="#348F56"><strong>เลขที่ใบสั่งซื้อ</strong></td>
            <td width="70" align="center" bgcolor="#348F56"><strong>จำนวน<br />
              รายการสั่งซื้อ</strong></td>
            <td width="86" align="center" bgcolor="#348F56"><strong>เพิ่มรายการ<br />
              สั่งซื้อได้ภายใน </strong></td>
            <td width="113" align="center" bgcolor="#348F56"><strong>สถานะ</strong></td>
            <td width="61" align="center" bgcolor="#348F56">&nbsp;</td>
          </tr>
    
<?php 
	  $i=1;
	  
	  do { 
	  		
//			echo $row_order['ORDER_NO'];

			$statusStr = "";
			if ( $row_order['DWNFLAG']=="N" ) {
				$statusStr="สามารถสั่งซื้อเพิ่มเติมได้";
			}
			elseif($row_order['DWNFLAG']=="Y") {
				$statusStr ="ไม่สามารถสั่งซื้อเพิ่มเติมได้";
			}
			else {
				$statusStr="";
			}
			
			$campaign =substr($row_order['ORDCAMP'],4,2) ."/".substr($row_order['ORDCAMP'],0,4);
			$p_no=$campaign."-".substr("000000".$row_order['ORDER_NO'],-6);
			$script_link ="po=".$row_order['ORDER_NO']."&id=$dist$mslno$chkdgt" ."&camp=".$row_order['ORDCAMP'];
			$date=$row_order['ORDDATE'];
			$time=$row_order['ORDTIME'];
			$yy=substr($date,0,4);$mm=substr($date,4,2);$dd=substr($date,6,2);
			$time=substr($time,0,2).":".substr($time,2,2).":".substr($time,4,2);
			$dateT=$dd."/".$mm."/".$yy." ".$time;
	
?>
          <tr >
            <td height="26" align="right" nowrap="nowrap" bgcolor="#F8F8F8" class="line_bottom"><? echo $i; ?>&nbsp;&nbsp;</td>
            <td align="center" bgcolor="#F8F8F8" class="line_bottom"><?php echo $campaign; ?></td>
            <td align="center" bgcolor="#F8F8F8" class="line_bottom"><?php echo $dateT; ?></td>
            <td align="center" bgcolor="#F8F8F8" class="line_bottom"><?php echo $p_no ?></td>
            <td align="center" bgcolor="#F8F8F8" class="line_bottom"><?php echo $row_order['ITEMS']; ?></td>
            <td align="center" bgcolor="#F8F8F8" class="line_bottom"><?php echo func_ConvertDateToString($row_order['DWNDATE']); ?></td>
            <td nowrap="nowrap" bgcolor="#F8F8F8" class="line_bottom" ><?php echo $statusStr; ?></td>
            <td align="center" bgcolor="#F8F8F8" class="line_bottom"><a  href="javascript: MM_openBrWindow('order_view.php?<? echo $script_link;?>','', 760, 550);"> <img src="Images/document_view.png" title="ดูรายการสั่งซื้อสินค้า" alt="ดูรายการสั่งซื้อสินค้า" width="16" height="16" border="0"  /></a>&nbsp;<a href="#" onclick="javascript:confirmEdit('order_form.php?doMode=Edit&amp;<? echo $script_link ; ?>','<?  echo $p_no; ?>');" ><img src="Images/Edit-(Alt-2).gif" title="แก้ไขรายการสั่งซื้อสินค้า" alt="แก้ไขรายการสั่งซื้อสินค้า" width="16" height="16" border="0" /></a>&nbsp; <a href="#" onclick="javascript:confirmDelete('order_delete.php?<? echo $script_link; ?>','<? echo $p_no?>');" > <img src="Images/document_delete.png" title="ยกเลิกรายการสั่งซื้อ" alt="ยกเลิกรายการสั่งซื้อ" width="16" height="16" border="0" /></a></td>
          </tr>

  <?php 
  	$i=$i+1;
  } while ($row_order = mysql_fetch_assoc($order)); ?> 
        </table></td>
      </tr>
    </table>

<?php
}//if ($totalRows_order>0) {
?>
    
    <br />
    <br />
    <form id="form1" name="form1" method="post" action="order_form.php">
      <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="713" align="center"><fieldset>
            <legend><img src="image_icon/add_product.gif" width="288" height="31" /></legend>
            <br />
            <table width="541" border="0" cellpadding="1" cellspacing="1" class="FormBorderGray">
              <tr class="content_header">
                <td width="28" height="23" align="center" bgcolor="#003300"> เลือก </td>
                <td width="87" align="left" bgcolor="#003300">รอบจำหน่าย</td>
                <td width="202" bgcolor="#003300">วันที่รอบจำหน่าย</td>
                <td width="105" bgcolor="#003300">วันที่สั่งซื้อวันสุดท้าย</td>
                <td width="101" bgcolor="#003300">วันที่จัดส่งผลิตภัณฑ์</td>
              </tr>
              <?php 
			  	$i=1;
				do { 
			  		
					if (fmod($i, 2)==0){
						$bg="#B8E5C9";
					}
					else {
						$bg="#E7F5EC";
					}
					
					

			  
			  ?>
              <tr  bgcolor="<? echo $bg; ?>">
                <td height="22" align="center" ><input name="sel_camp"  type="radio" id="radio" value="<? echo $row_tblcampaign['CAMP'];?>"  <? if ($_SESSION['CurCamp']== $row_tblcampaign['CAMP']) { echo "checked='checked'"; }else { echo ""; }?> /></td>
                <td align="left"><?php echo substr($row_tblcampaign['CAMP'],4,2)."/".substr($row_tblcampaign['CAMP'],0,4); ?></td>
                <td><?php echo func_ConvertDateToString($row_tblcampaign['EFFDTE']); ?>&nbsp; - &nbsp;<?php echo  func_ConvertDateToString($row_tblcampaign['EXPDTE']); ?></td>
                <td><?php echo  func_ConvertDateToString($row_tblcampaign['BILLDATE']);?></td>
                <td><?php echo  func_ConvertDateToString($row_tblcampaign['DLVDATE']); ?></td>
              </tr>
              <?php
			  
			  	$i=$i+1;
			  } while ($row_tblcampaign = mysql_fetch_assoc($tblcampaign)); ?>
            </table>
            <br />
            <br />

<center>
  <p><img src="image_icon/cancel_btn_product.gif"  onclick="window.location='index.php'" style="cursor:hand" /> <img src="image_icon/order_btn.gif"  onclick="document.form1.submit();" style="cursor:hand"  />
    <input name="doMode" type="hidden" id="doMode" value="New" />
  </p>
       
	<!--<input name="button" type="button" class="button_order_cancel" id="button" onclick="window.location='index.php'" value="ยกเลิก" /> -->
	<!-- <input name="Submit" type="submit" class="button_order_new" id="Submit" value="สั่งซื้อสินค้า" />-->
</center> 
<input name="dist" type="hidden" id="dist" value="<?php echo $_SESSION['dist']; ?>" />
<input name="mslno" type="hidden" id="mslno" value="<?php echo $_SESSION['mslno']; ?>" />
<input name="chkdgt" type="hidden" id="chkdgt" value="<?php echo $_SESSION['chkdgt']; ?>" />
<input name="rep_name" type="hidden" id="rep_name" value="<?php echo $_SESSION['name']; ?>" />
<input name="email" type="hidden" id="email" value="<?php echo $_SESSION['email']; ?>" />
<input name="curcamp" type="hidden" id="curcamp" value="<?php echo $_SESSION['CurCamp']; ?>" />
<br />
          </fieldset></td>
        </tr>
      </table><br />
    
    </form></td>
  </tr>
  <tr>
    <td valign="top" ><table width="790" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="1%" align="left" valign="top"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_07.gif" 
                        width="5" /></td>
        <td width="100%" ><img height="5" alt="" 
                        src="Images/Box_Set3/frame_08.gif" 
                        width="900" /></td>
        <td width="1%" align="right" valign="top"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_09.gif" 
                        width="5" /></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php include("i_footer.php"); ?>
</body>
</html>
<?php
mysql_free_result($order);
mysql_free_result($tblcampaign);
?>
