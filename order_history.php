<?php  session_start(); ?>
<?php require("i_config.php"); ?>
<?php require("check_login.php"); ?>
<?php require_once('Connections/bwc_orders.php'); ?>
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

<script type="text/javascript">
	function clear_vlaue() {
		var frm  = document.getElementById('form1');
		// 	frm.setAttribute('action','?doMode=Insert');		
		document.getElementById("doMode").value="Reset";		
		frm.submit();
			
	}
	
	function form_submit() {
		var frm  = document.getElementById('form1');
		
		if (document.getElementById('sel_camp').value==""){
			alert("กรุณาเลือกรอบจำหน่าย !!");
			document.getElementById('sel_camp').focus();
			return false;
			
		}
		
		// 	frm.setAttribute('action','?doMode=Insert');		
		document.getElementById("doMode").value="Query";		
		frm.submit();
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
    <td class="Sheet_Boder"  ><?php include("i_header_no.php"); ?>
</td>
  </tr>
  <tr>
    <td height="480" align="center" valign="top" class="Sheet_Boder" style="padding:2px">
    
    <!-- Start  Content  -->    
        
    
    <?php  include("i_WebService_config.php");  ?>

    <?php 
		if($maintenance=="yes") {
			//header("Location: under_con.php");
			//include("under_con.php");
			echo  $maintenance_msg;
			exit;
		}
	?>
    
	<?php
	
	if ($campaign_limit=="") {
		$campaign_limit=3;
	}

	mysql_select_db($database_bwc_orders, $bwc_orders);
    $query_campaign = "select * from tbl008 where  camp <= (select camp from tbl008 where status='Current')  order by camp desc limit  $campaign_limit";
    $campaign = mysql_query($query_campaign, $bwc_orders) or die(mysql_error());
    $row_campaign = mysql_fetch_assoc($campaign);
    $totalRows_campaign = mysql_num_rows($campaign);
  
    ?>
    
<?php 
	
		if ($_SERVER['REQUEST_METHOD']="POST" && isset($_POST['doMode']) && $_POST['doMode']=="Query") {
		
			
			$dist=$_SESSION['dist'];
			$mslno=$_SESSION['mslno'];
			$chkdgt=$_SESSION['chkdgt'];
			$rep_name=$_SESSION['name'];
			$sel_camp=$_POST['sel_camp'];
			$sel_order_by = $_POST['sel_order_by'];
			$sel_asc = $_POST['sel_asc'];
			
		
			if ($dist=="") {
				echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
			}
		
			$DataToSend="dist=$dist&mslno=$mslno&chkdgt=$chkdgt&camp=$sel_camp&orderby=$sel_order_by&asc=$sel_asc";
			$postUrl=$url_webservice."/bwc_order_header.asp"  . "?".$DataToSend;

		}
		elseif ($_SERVER['REQUEST_METHOD']="POST" && isset($_POST['doMode']) && $_POST['doMode']=="Reset") {
			
				$sel_camp="";
		}
			
		
//echo "post_url=".$post_URL;

  ?> 
  
  
    <form id="form1" name="form1" method="post" action="">
      <table 
                  width="800" height="73" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
        <tbody>
          <tr>
            <td height="5"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_01.gif" 
                        width="5" /></td>
            <td width="700"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_02.gif" 
                        width="850" /></td>
            <td width="10"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_03.gif" 
                        width="5" /></td>
          </tr>
          <tr>
            <td valign="top" width="5" 
                      background="Images/Box_Set3/frame_04.gif" 
                      height="62"><img height="2" alt="" 
                        src="Images/Box_Set3/frame_04.gif" 
                        width="5" /></td>
            <td valign="top" bgcolor="#ffffff"><table width="100%" border="0" cellspacing="3" cellpadding="3">
              <tr>
                <td width="101" align="right">รหัสสมาชิก :</td>
                <td colspan="2" align="left">&nbsp;<? printf("%s-%s-%s ",$_SESSION['dist'],$_SESSION['mslno'],$_SESSION['chkdgt']); ?>&nbsp;&nbsp;<?php echo $_SESSION['name'];?></td>
              </tr>
              <tr>
                <td height="23" align="right">รอบจำหน่าย :</td>
                <td width="339" align="left"><select name="sel_camp" id="sel_camp">
                  <option value=""> ==ไม่ระบุ==</option>
                  <?php
do {  
?>
                  <option value="<?php echo $row_campaign['CAMP']?>"  <?  if  ($row_campaign['CAMP']==$sel_camp ) { echo " selected " ;} ?>> <?php echo  substr($row_campaign['CAMP'],4,2) ."/". substr($row_campaign['CAMP'],0,4); ?></option>
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
                <td width="239" align="left">&nbsp;</td>
              </tr>
              <tr>
                <td align="right">จัดเรียงข้อมูลจาก :</td>
                <td align="left"><select name="sel_order_by" id="sel_order_by">
                  <option value="ORDCAMP"  <?php   if ($sel_order_by=="ORDCAMP") { echo "selected='selected'";}?> >รอบจำหน่าย</option>
                  <!--<option value="REPCODE" <?php   //if ($sel_order_by=="REPCODE") { echo "selected='selected'";}?>>รหัสสมาชิก</option>-->
                  <option value="INVDATE" <?php   if ($sel_order_by=="INVDATE") { echo "selected='selected'";}?>>วันที่พิมพ์ใบกำกับภาษี</option>
                  <option value="INVNO" <?php   if ($sel_order_by=="INVNO") { echo "selected='selected'";}?>>เลขที่ใบกำกับภาษี</option>
                  <option value="AMOUNT" <?php   if ($sel_order_by=="AMOUNT") { echo "selected='selected'";}?>>มูลค่าผลิตภัณฑ์</option>
                  </select>
                  <select name="sel_asc" id="sel_asc">
                    <option value="ASC" <?php   if ($sel_asc=="ASC") { echo "selected='selected'";}?> >เรียงจากน้อยไปมาก</option>
                    <option value="DESC" <?php   if ($sel_asc=="DESC") { echo "selected='selected'";}?> >เรียงจากมากไปน้อย</option>
                    </select></td>
                <td align="left"><input type="button" name="button2" id="button2" value="Reset"  onclick="clear_vlaue();"  class="formbutton"/>
                  <input type="button" name="Button" id="button" value="View" onclick="form_submit()" class="formbutton" />
                  <input name="doMode" type="hidden" id="doMode" value="View" /></td>
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
                        width="850" /></td>
            <td><img height="5" alt="" 
                        src="Images/Box_Set3/frame_09.gif" 
                        width="5" /></td>
          </tr>
        </tbody>
      </table>
      <br />
    </form>
    <table width="868" border="0" align="center" cellpadding="0" cellspacing="0" >
      <tr style="font-family:Verdana, Geneva, sans-serif;color:#8C1764;font-weight:bold;font-size:9px">
        <td width="39" height="25" align="center" bgcolor="#F3DFEC"  style="border-top:#666 solid 1px;border-bottom:#666 solid 1px;border-left:#666 solid 1px;">ลำดับ</td>
        <td width="75" align="center" bgcolor="#F3DFEC" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px"><font color="#8C1764">รอบจำหน่าย</font></td>
        <td width="190" align="left" bgcolor="#F3DFEC" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px"><font color="#8C1764">รหัส-ชื่อ สมาชิก</font></td>
        <td width="134" align="left" bgcolor="#F3DFEC" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px"><font color="#8C1764">วันที่พิมพ์ใบกำกับภาษี</font></td>
        <td width="102" align="left" bgcolor="#F3DFEC" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px"><font color="#8C1764">สถานะใบสั่งซื้อ</font></td>
        <td width="108" align="left" bgcolor="#F3DFEC" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px"><font color="#8C1764">เลขที่ใบกำกับภาษี</font></td>
        <td width="96" align="left" bgcolor="#F3DFEC" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">Order Source</td>
        <td width="84" align="right" bgcolor="#F3DFEC" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px"><font color="#8C1764">มูลค่าสุทธิ</font></td>
        <td width="21" align="center" bgcolor="#F3DFEC" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">&nbsp;</td>
        <td width="19" align="center" bgcolor="#F3DFEC" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px;border-right:#666 solid 1px;">&nbsp;</td>
      </tr>
      <tr style="font-family:Verdana, Geneva, sans-serif;color:#226543;font-weight:bold;font-size:10px">
        <td colspan="10" align="left" valign="top"  style="border-top:#666 solid 1px;border-bottom:#666 solid 1px;border-right:#666 solid 1px;border-left:#666 solid 1px">
        
        <iframe  src="<?php echo $postUrl; ?>" width="100%" height="300" frameborder="0" scrolling="Yes"> </iframe>
        
        </td>
      </tr>
    </table>
    <br /><center>
      <strong><font color="#CC0000">หมายเหตุ หากสถานะใบสั่งซื้อ ขึ้นว่า &quot;ออร์เดอร์ติด Hold เพื่อรอการอนุมัติ&quot;</font></strong><br />
      ให้ท่านโทรสอบถามเพิ่มเติมที่ Call center โทรฟรี ! ทั่วประเทศ สำหรับผู้ใช้บริการ เอไอเอสและวันทูคอล กดรหัสพิเศษ *7479000 หรือโทร.0-2548-1555 (เสียค่าโทร) <br />
      วันจันทร์-ศุกร์ เวลา 8.00-24.00 น. วันเสาร์-อาทิตย์ เวลา 8.00-17.30 น. <br />
      <a href="index.php" target="_parent"><img src="images/BWorder_web_35.gif" alt="หน้าหลัก" width="72" height="19" border="0" /></a><br />
    
<!-- Start  Content  -->    
    
    
    
    </center></td>
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
<br /><?php include("i_footer.php"); ?>
</body>
</html>