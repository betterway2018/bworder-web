<?php  
session_start();
require_once('check_login.php');
require_once('include/i_config.php'); 
require_once('connections/bwc_orders.php'); 

require_once('include/functionphp.inc');
require_once('nusoap.php'); 
//$ws_client = new soapclient('http://webservice.mistine.co.th/webservice/dsm_order_service_dsm_newuser.php?wsdl',true); 
//$ws_client = new soapclient('http://10.0.0.119/bworder/history_order.php?wsdl',true); 
$ws_client = new soapclient($url_webservice.'bws_order_history.php?wsdl',true); 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;" />
<meta http-equiv="Content-Type" content="text/html;" charset="SET NAMES 'UTF-8';" />
<title><?php  echo $title ?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="Styles/main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript"> 
	function autoTabRepCode(obj){ 
	/* กำหนดรูปแบบข้อความโดยให้ _ แทนค่าอะไรก็ได้ แล้วตามด้วยเครื่องหมาย 
	หรือสัญลักษณ์ที่ใช้แบ่ง เช่นกำหนดเป็น รูปแบบเลขที่บัตรประชาชน 
	4-2215-54125-6-12 ก็สามารถกำหนดเป็น _-____-_____-_-__ 
	รูปแบบเบอร์โทรศัพท์ 08-4521-6521 กำหนดเป็น __-____-____ 
	หรือกำหนดเวลาเช่น 12:45:30 กำหนดเป็น __:__:__ 
	ตัวอย่างข้างล่างเป็นการกำหนดรูปแบบเลขบัตรประชาชน 
	*/ 
	var pattern=new String("___-_____-_"); // กำหนดรูปแบบในนี้ 
	var pattern_ex=new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้ 
	var returnText=new String(""); 
	var obj_l=obj.value.length; 
	var obj_l2=obj_l-1; 
	for(i=0;i<pattern.length;i++){ 
	if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){ 
	returnText+=obj.value+pattern_ex; 
	obj.value=returnText; 
	} 
	} 
	if(obj_l>=pattern.length){ 
	obj.value=obj.value.substr(0,pattern.length); 
	} 
	} 
</script> 

<script type="text/javascript">
	function clear_vlaue() {
		var frm  = document.getElementById('form1');
		// 	frm.setAttribute('action','?doMode=Insert');		
		document.getElementById("doMode").value="Reset";		
		frm.submit();
			
	}
	
	function form_submit() {
		var frm  = document.getElementById('form1');
		if (document.getElementById('sel_camp').value=="") {
			alert("กรุณาเลือกรอบจำหน่าย");
			document.getElementById('sel_camp').focus();
			return false;
		}
		// 	frm.setAttribute('action','?doMode=Insert');	
		document.getElementById("doMode").value="Query";		
		frm.submit();
	}	

	function gotopage(pageno) {
		document.getElementById('curpage').value=pageno;
		document.getElementById("doMode").value="View";
		form_submit();
	}
	
	HttPRequest.onreadystatechange = function()
			{

				 if(HttPRequest.readyState == 3)  // Loading Request
				  {
				   document.getElementById("mySpan").innerHTML = "กรุณารอสักครู่ ...";
				  }

				 if(HttPRequest.readyState == 4) // Return Request
				  {
				   document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
				  }
				
			}
	
	
	
</script>

</head>


<?php

// Query   Campaign   for Order by Dist
$orddate=date('Ymd');
$dist=$_SESSION['dist'];
require("i_MailPlan.php"); 

	if ($campaign_limit=="") {
		$campaign_limit=4;
	}

	mysql_select_db($database_bwc_orders, $bwc_orders);
    $query_campaign = "select * from tbl008 where  camp <= (select camp from tbl008 where status='Current')  order by camp desc limit  $campaign_limit";
    $campaign = mysql_query($query_campaign, $bwc_orders) or die(mysql_error());
	mysql_close($bwc_orders);
    $row_campaign = mysql_fetch_assoc($campaign);
    $totalRows_campaign = mysql_num_rows($campaign);
  
    ?>

<body>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FDB5CF"></td>
  </tr>
</table>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td>
    <table width="860" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" align="left" valign="top"><img src="images/Box_Set3/frame_01.gif" width="5" height="5" /></td>
        <td width="845" align="left" valign="top"><img src="images/Box_Set3/frame_02.gif" width="900" height="5" /></td>
        <td width="10" align="right" valign="top"><img src="images/Box_Set3/frame_03.gif" width="5" height="5" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="Sheet_Boder"  ><?php include("include/i_header.php"); ?>
</td>
  </tr>
  <tr>
  <td height="200" align="center" valign="top" class="Sheet_Boder" style="padding:2px"><!-- Start  Content  -->    
    
     <?php
	//  Use for maintenance Only
	
	//echo "ขออภัยค่ะ .... ปิดปรับปรุงชั่วคราวค่ะ";
	//	exit;
	
	?>
    
    
     
    <!--- Start Content hear -->
      <?php 
		if ($_SERVER['REQUEST_METHOD']="POST" && isset($_POST['doMode']) && $_POST['doMode']=="Query") {
			//$dist= $_POST['dist'];
			//$mslno=$_POST['mslno'];
			//$chkdgt=$_POST['chkdgt'];
			$sel_camp=$_POST['sel_camp'];
			$sel_order_by = $_POST['sel_order_by'];
			$sel_asc = $_POST['sel_asc'];
			$totalrow = $_POST['totalrow'];
			
			$dist=$_SESSION['dist'];
			$mslno=$_SESSION['mslno'];
			$chkdgt=$_SESSION['chkdgt'];
			
			if ($dist=="" || $mslno=="" || $chkdgt=="") {
				echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
			}
			//include("i_WebService_config.php");
			//$DataToSend="dist=$dist&mslno=$mslno&chkdgt=$chkdgt&camp=$sel_camp&orderby=$sel_order_by&asc=$sel_asc";
		}
		elseif ($_SERVER['REQUEST_METHOD']="POST" && isset($_POST['doMode']) && $_POST['doMode']=="Reset") {
			$mslno="";
			$chkdgt="";
			$sel_camp="";
		}
?>

		<form id="form1" name="form1" method="post" action="">
        <table width="871" border="0" cellspacing="0" cellpadding="0" >
          <tr>
              <td width="871" align="right"><fieldset><table width="870" border="0" cellspacing="0" cellpadding="0" align="left">
              <tr>
                <td align="right">&nbsp;</td>
                <td colspan="2" align="left">&nbsp;</td>
              </tr>
              <tr>
                <td width="151" align="right" valign="top">รหัสสมาชิก : </td>
                <td colspan="2" align="left">&nbsp;&nbsp;<?php echo $_SESSION['dist'];?>-<?php echo $_SESSION['mslno'];?>-<?php echo $_SESSION['chkdgt'];?></td>
              </tr>
              <tr>
                <td width="151" align="right" valign="top">ชื่อสมาชิก : </td>
                <td colspan="2" align="left">&nbsp;&nbsp;<?php echo tis620_to_utf8($_SESSION['name']);?></td>
              </tr>
              <tr>
                <td height="23" align="right">รอบจำหน่าย : </td>
                <td width="432" align="left">&nbsp;
                <select name="sel_camp" id="sel_camp">
                  <option value="" >== เลือกรอบจำหน่าย ==</option>
                                    <?php
do {  
?>
                  <option value="<?php echo $row_campaign['CAMP']?>"  
				  <?php  if  ($row_campaign['CAMP']==$sel_camp ) { echo " selected " ;} ?>> 
				  <?php echo  substr($row_campaign['CAMP'],4,2) ."/". substr($row_campaign['CAMP'],0,4); ?></option>
				  
                  <?php
						} while ($row_campaign = mysql_fetch_assoc($campaign));
						  $rows = mysql_num_rows($campaign);
						  if($rows > 0) {
							  mysql_data_seek($campaign, 0);
							  $row_campaign = mysql_fetch_assoc($campaign);
						  }
?>
                  
                  </select>
                  &nbsp;*</td>
              </tr>
              <tr>
                <td align="right"></td>
                <td align="left"><input name="txtdist2" type="text" disabled="disabled" id="txtdist2" value="<?php echo $_SESSION['dist']; ?>" size="4" maxlength="4" style="display:none" />
                  <input name="mslno" type="text" id="mslno" 
                      onkeyup="javascript:if(this.value.length==5){chkdgt.focus()}" 
                      onkeydown="javascript: if (event.keyCode == 13){chkdgt.focus();}"
                      value="<?php echo $mslno ?>"   size="8" maxlength="5" style="display:none"/>
                  <input name="chkdgt" type="text" id="chkdgt" value="<?php echo $chkdgt?>" size="2" maxlength="1" 
                      onkeydown="javascript:if(event.keyCode==13){document.form1.submit();}"
                    style="display:none"  />
                  <input name="dist" type="hidden" id="dist" value="<?php echo $_SESSION['dist']; ?>" />
                  <input name="mslno1" type="hidden" id="mslno1" value="<?php echo $_SESSION['mslno']; ?>" /></td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td align="right">จัดเรียงข้อมูลจาก : </td>
                <td align="left"><select name="sel_order_by" id="sel_order_by">
                  <option value="ORDCAMP"  <?php   if ($sel_order_by=="ORDCAMP") { echo "selected='selected'";}?> >รอบจำหน่าย</option>
                  <option value="REPCODE" <?php   if ($sel_order_by=="REPCODE") { echo "selected='selected'";}?>>รหัสสมาชิก</option>
                  <option value="INVDATE" <?php   if ($sel_order_by=="INVDATE") { echo "selected='selected'";}?>>วันที่พิมพ์ใบกำกับภาษี</option>
                   <option value="ORDSTS" <?php   if ($sel_order_by=="ORDSTS") { echo "selected='selected'";}?>>สถานะใบสั่งซื้อ</option>
                  <option value="INVNO" <?php   if ($sel_order_by=="INVNO") { echo "selected='selected'";}?>>เลขที่ใบกำกับภาษี</option>
                  <option value="ORDSRC" <?php   if ($sel_order_by=="ORDSRC") { echo "selected='selected'";}?>>Order Source</option>
                  <option value="AMOUNT" <?php   if ($sel_order_by=="AMOUNT") { echo "selected='selected'";}?>>มูลค่าผลิตภัณฑ์</option>
                  
                </select>
                  <select name="sel_asc" id="sel_asc">
                    <option value="ASC" <?php   if ($sel_asc=="ASC") { echo "selected='selected'";}?> >เรียงจากน้อยไปมาก</option>
                    <option value="DESC" <?php   if ($sel_asc=="DESC") { echo "selected='selected'";}?> >เรียงจากมากไปน้อย</option>
                  </select></td>
                <td align="left"><input type="button" name="button2" id="button2" value="Reset"  onclick="clear_vlaue();"  class="formbutton"/>
                  <input type="button" name="Button" id="button" value="View" onclick="javascript:document.getElementById('curpage').value=''; form_submit();" <? if ($maintenance=="yes"){ echo " disabled='disabled'"; } ?>  class="formbutton" />
                  <input type="hidden" name="doMode" id="doMode" value="View" />
                  <input type="hidden" name="curpage" id="curpage" value="<?php echo $_POST['curpage']; ?>" />
                  <input type="hidden" name="totalrow" id="totalrow" /></td>
              </tr>
            </table></fieldset></td>
          </tr>
        </table>
      </form>
      
      <table width="870" border="1" cellpadding="0" cellspacing="0" height="407">
        
        <tr>
          
          <td align="center" valign="top">
          
             <?php    if ($maintenance=="yes") {  // กำหนดค่าจากไฟล์ i_config.php 
			  		echo "<br><br><br><center>$maintenance_msg </center>";
			  }
			  else {
			   ?> 
          <table width="868" border="0" align="center" cellpadding="0" cellspacing="0" >
            <tr style="font-family:Verdana, Geneva, sans-serif; color:#F09;font-weight:bold;font-size:9px">
              <td width="39" height="25" align="center"  style="border-top:#666 solid 1px;border-bottom:#666 solid 1px;border-left:#666 solid 1px;">ลำดับ</td>
              <td width="75" align="center" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">รอบจำหน่าย</td>

              <td width="200" align="left" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">รหัส-ชื่อ สมาชิก</td>
              <td width="134" align="left" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">วันที่พิมพ์ใบกำกับภาษี</td>
              <td width="102" align="left" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">สถานะใบสั่งซื้อ</td>
              <td width="108" align="left" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">เลขที่ใบกำกับภาษี</td>
              <td width="96" align="left" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">Order Source</td>
              <td width="84" align="right" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">มูลค่าสุทธิ</td>
              <td width="21" align="center" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">&nbsp;</td>
              <td width="19" align="center" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px;border-right:#666 solid 1px;">&nbsp;</td>
            </tr>
            <tr style="font-family:Verdana, Geneva, sans-serif;color:#226543;font-weight:bold;font-size:10px">
              <td colspan="10" align="left" valign="top"  style="border-top:#666 solid 1px;border-bottom:#666 solid 1px;border-right:#666 solid 1px;border-left:#666 solid 1px">
<?php
			if ($_POST['doMode']=="Query") {
				//echo $sel_camp.'__'.$dist.'__'.$mslno.'__'.$chkdgt.'__'.$sel_order_by.'__'.$sel_asc.'__'.$postUrl;
				bworderdata ($sel_camp,$dist,$mslno,$chkdgt,$sel_order_by,$sel_asc,$postUrl,$ws_client);
			}				
?>
              </td>
            </tr>
          </table>
          
          <p>
            <?php	} ?>       
          </p>
          </td>
          
        </tr>
        
      </table>
      <!-- End of  Content -->
    <br /><center>
      <strong><font color="#CC0000">** หมายเหตุ หากสถานะใบสั่งซื้อ ขึ้นว่า &quot;รอการอนุมัติ&quot; , &quot;ใบสั่งซื้อถูกยกเลิก&quot; **</font></strong><br />
      ให้ท่านโทรสอบถามเพิ่มเติมได้ที่ Call center 02-1185111 <br />
      วันจันทร์-ศุกร์ เวลา 8.00-24.00 น. วันเสาร์-อาทิตย์ เวลา 8.00-17.30 น. <br />
      <a href="index.php" target="_parent"><img src="images/BWorder_web_35.gif" alt="หน้าหลัก" width="72" height="19" border="0" /></a>
</td>
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
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php require "i_footer.php";?></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php 


function bworderdata($camp,$dist,$mslno,$chkdgt,$orderby,$ordersort,$postUrl,$ws_client) {
	$pageno = $_POST['curpage'];
	$totalrow = '';
	$param = array('dist' => $dist, 'mslno' => $mslno, 'chkdgt' => $chkdgt, 'camp' => $camp, 'orderby' => $orderby, 'ascend' => $ordersort, 'pageno' => $pageno, 'totalrow' => $totalrow);
	$result = $ws_client->call('bworder', $param); 
	//echo tis620_to_utf8($result);
	echo $result;
}
?>
