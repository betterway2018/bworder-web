<?php
session_start(); 
require_once('check_login.php');
require_once('include/i_config.php'); 
require_once('Connections/bwc_orders.php');
require_once('include/functionphp.inc');
require_once('include/nusoap.php'); 

	

//$CurCamp =$_GET['CurCamp'];
$CurCamp=$_SESSION["CurCamp"];
$rep_seq=$_SESSION["rep_seq"];
$point=$_SESSION["point"];
$name=$_SESSION["name"];
$PHONE=$_SESSION["PHONE"];
$dist=$_SESSION['dist'];
$mslno=$_SESSION['mslno'];
$chkdgt=$_SESSION['chkdgt'];
$flagalert=$_SESSION['flagalert'];
$YUPIN_STATUS=$_SESSION["YUPIN_STATUS"];
$YUPIN_REGISTER=$_SESSION["YUPIN_REGISTER"];
//$rep_code=$dist.$mslno=str_pad($mslno,5, "0", STR_PAD_LEFT).$chkdgt;
//echo  $rep_code."FFFF";
if($YUPIN_STATUS == 'AC')
{
	$popup = "dialog_alert_point()";
	
}
else
{	$popup = "dialog_alert_point()";
	//$popup = "dialog_alert_YUPIN()";
}
 //echo $popup."AC".$YUPIN_STATUS; 
/*
$ws_client = new soapclient($url_webservice.'get_repinfo.php?wsdl',true); 
 $rep_code_callservice=$dist. substr("00000".$mslno,-5).$chkdgt;					
////////////////////////////////////////////////////////////Dialog box/////////////////////////////////////////////////////////////////////
			$data = repinfo($rep_code_callservice,$ws_client);
						//echo $url_webservice.'__'.$rep_code.'__'.$data;
						if ($aInfo = explode('|', $data)) { 
						//2 - 8	
							$rep_seq = $aInfo[2];
							//$REPREP_CODE = $aInfo[3];
							$rep_name = $aInfo[4];
							$point = number_format($aInfo[5],0,".",",");
							$_SESSION['point']=$point;
							}
function repinfo($rep_code,$ws_client) {
	$param = array('rep_code' => $rep_code);
	$result = $ws_client->call('repinfo', $param); 
	return $result;
}
///////////////////////////////////////////////////////////Dialog box/////////////////////////////////////////////////////////////////////		
*/
$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");


$iphone = strtolower($iPhone);
$ipad = strtolower($iPad);
$android = strtolower($Android);
if( $iPod || $iPhone || $iPad)
	{
		$newURL = 'http://push.webservice-yupin.com/Mistine/download.php?usertype=2&refid='.$rep_seq.'&refcode='.$rep_code.'&mobileno=';
	}
	else if($Android)
	{
		$newURL = 'market://details?id=th.co.mistine.mistinecatalog';
		//$newURL = 'market://details?id=th.co.mistine.mistinecatalog&ah=N3wPTVWHjqvVd4t_9sccSVA399A&referrer=sms%3E%26'.$rep_code.'%26'.$mobile;
		//echo $newURL;
	}
	else
	{
		//$newURL = 'https://play.google.com/store/apps/details?id=th.co.mistine.mistinecatalog;
		$newURL = 'https://play.google.com/store/apps/details?id=th.co.mistine.mistinecatalog&ah=N3wPTVWHjqvVd4t_9sccSVA399A&referrer=sms%3E%26'.$rep_code.'%26';			
	}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php  echo $title?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="Scripts/ajaxsbmt.js"></script>    
        <script type="text/javascript" src="Scripts/jQuery/jquery-1.8.2.js"></script>
        <link href="Scripts/jquery/css/ui-lightness/jquery-ui-1.8.13.custom.css" rel="stylesheet" type="text/css" />
        <style type="text/css">
            /*demo page css*/
            body{ font: 62.5% "Trebuchet MS", sans-serif; margin: 50px;}
            .demoHeaders { margin-top: 2em; }
            #dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
            #dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
            ul#icons {margin: 0; padding: 0;}
            ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
            ul#icons span.ui-icon {float: left; margin: 0 4px;}
			
						
			
.ui-dialog .ui-dialog-buttonpane .ui-dialog-buttonset {
   float: none;
}

.ui-dialog .ui-dialog-buttonpane {
     text-align: center; // left/center/right
}


.ui-dialog-title{
    font-size: 210% !important;
   
}

        </style>	
         <script type="text/javascript" src="Scripts/ajaxsbmt.js"></script>
         <script type="text/javascript" src="Scripts/NumberFormat154.js"></script>
         <script type="text/javascript" src="Scripts/jQuery/js/jquery-1.5.1.min.js"></script>
         <script type="text/javascript" src="Scripts/jquery/js/jquery-ui-1.8.13.custom.min.js"></script>
		 
<script type="text/javascript">

//เก็บสถิติกูเกิ้ล
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34860989-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

function show_alert() {
	<?php
		//if ($_SESSION['flagalert']==1) {
		
			$popup = "dialog_alert_YUPIN()";
			$message ="message_box_YUPIN";
			/*if($_SESSION['YUPIN_STATUS'] == 'AC') {
				$popup = "dialog_alert_point()";
				$message ="message_box_point";
			} else {
				$popup = "dialog_alert_YUPIN()";
				$message ="message_box_YUPIN";
			}*/
			echo $popup."; document.getElementById('".$message."').style.display = 'inline';";
			$_SESSION['flagalert'] = 0;
		//} 
	?>
}

function dialog_alert_YUPIN() {
						$("#dialogpointYUPIN").dialog({
						modal: true,
						draggable: false,
						resizable: false,
						position: ['center', 'center'],
						show: 'blind',
						hide: 'blind',
						width: 750,
						higth: 500,
						dialogClass: 'ui-dialog-osx',
					 
						 buttons: {
                          'ดาวน์โหลด': function() {

	                      window.open('http://push.webservice-yupin.com/yupin.php?id=509','_blank');
						  $(this).dialog('close');
						   
						},
						
						'เริ่มสั่งซื้อสินค้า': function() {
		
						//order_check.php?rep_seq=<?=$rep_seq?>
						//window.location.href   = "order_check.php";
						document.location.href='order_check.php';
						  // $(this).dialog('close');
						},
						
						'กลับสู่หน้าหลัก': function() {
							document.getElementById('message_box_YUPIN').style.display = 'inline'
						    $(this).dialog('close');
						}
					  }
	
					});
}
/*
function dialog_alert_point() {
						$("#dialogpoint").dialog({
						modal: true,
						draggable: false,
						resizable: false,
						position: ['center', 'center'],
						show: 'blind',
						hide: 'blind',
						width: 700,
						higth: 500,
						dialogClass: 'ui-dialog-osx',
					   
						 buttons: {

						'ตรวจสอบรางวัล': function() {

	                      window.open('http://www.mistine.co.th/pointrewards/index.php','_blank');
						  $(this).dialog('close');
						   
						},
						'เริ่มสั่งซื้อสินค้า': function() {
		
						//order_check.php?rep_seq=<?=$rep_seq?>
						//window.location.href   = "order_check.php";
						document.location.href='order_check.php';
						  // $(this).dialog('close');
						},
						
						'กลับสู่หน้าหลัก':ๆ function() {
							document.getElementById('message_box_point').style.display = 'inline'
						    $(this).dialog('close');
						}
					  }
	
					});
}
*/
</script>



</head>

<body onload="show_alert();">

<!--<body>-->

<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" >
  <?php require_once('include/i_header_border.php'); ?>
  <?php require_once('include/i_header.php'); ?>
  <?php  require_once('PHPQR_CODE/phpqrcode/GenQR.php');  ?>
 
  <tr>
    <td height="480" align="left" valign="top" class="Sheet_Boder" style="padding:2px"><br />
	
	  <br />
      <br />
      <br />
      
      <table width="0" border="0"   cellspacing="5">
        <tr>
          <td align="center"><a href="order_check.php?rep_seq=<?=$rep_seq?>" target="_parent" onmouseover="MM_swapImage('Image1','','images/New_Button/A02.gif',1)" onmouseout="MM_swapImgRestore()"><img src="images/New_Button/A01.gif" alt="สั่งซื้อสินค้าด่วน" name="Image1" width="144" height="119" border="0" id="Image1" /></a>
		  <input name="CurCamp " type="hidden" value="<?=$CurCamp ?>" />		  </td>
          <td align="center"><a href="order_summary.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image_Query','','images/New_Button/D02.gif',1)" title="รายการสั่งซื้อที่ยังไม่ถูกดาวน์โหลด&#013;ท่านสมาชิกสามารถเช็ครายละเอียดเปลี่ยนแปลงแก้ไขเพิ่มเติม คลิกที่นี่ "><img src="images/New_Button/D01.gif" alt="รายการสั่งซื้อที่ยังไม่ถูกดาวน์โหลด&#013;ท่านสมาชิกสามารถเช็ครายละเอียดเปลี่ยนแปลงแก้ไขเพิ่มเติม คลิกที่นี่ " name="Image_Query" width="144" height="119" border="0" id="Image_Query" /></a></td>
          <td align="center"><a href="bwo_view_ar.php" target="_parent" onmouseover="MM_swapImage('Image81','','images/New_Button/C02.gif',1)" onmouseout="MM_swapImgRestore()" title="&#8226;  ยอดค้างชำระ&#013;&#8226;  วันที่จัดส่งสินค้า&#013;&#8226;  วันที่สั่งสินค้า&#013;&#8226;  คะแนนสะสมเบทเตอร์เวย์พอยท์ รีวอร์ด&#013;&#8226;  ยอดเงินปันผลปัจจุบัน"><img src="images/New_Button/C01.gif" alt="&#8226;  ยอดค้างชำระ&#013;&#8226;  วันที่จัดส่งสินค้า&#013;&#8226;  วันที่สั่งสินค้า&#013;&#8226;  คะแนนสะสมเบทเตอร์เวย์พอยท์ รีวอร์ด&#013;&#8226;  ยอดเงินปันผลปัจจุบัน" name="Image81" width="144" height="119" border="0" id="Image81" /></a></td>
          <td align="center"><a href="catalogue.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image22','','images/New_Button/B02.gif',1)"><img src="images/New_Button/B01.gif" alt="แคตตาล็อค มิสทิน ฟาริส ฟรายเดย์" name="Image22" width="144" height="119" border="0" id="Image22" /></a></td>
          <td align="center"><a href="plusplan.php" target="_parent" onmouseover="MM_swapImage('Image24','','images/New_Button/J02.gif',1)" onmouseout="MM_swapImgRestore()"><img src="images/New_Button/J01.gif" alt="ใบปลิวพิเศษ" name="Image24" width="144" height="119" border="0" id="Image24" /></a></td>
        </tr>
        <tr>
        <td align="center"><a href="member_profile.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image21','','images/New_Button/E02.gif',1)"><img src="images/New_Button/E01.gif" alt="แก้ไขข้อมูลส่วนตัว" name="Image21" width="144" height="119" border="0" id="Image21" /></a></td>
          <td align="center"><input name="rep_seq " type="hidden" value="<?=$rep_seq?>" />
          <a href="bwo_profile.php?rep_seq=<?=$rep_seq?>" target="_parent" onmouseover="MM_swapImage('Image31','','images/New_Button/F02.gif',1)" onmouseout="MM_swapImgRestore()" title="รายการสั่งซื้อที่ดาวน์โหลดแล้ว &#013;ท่านสมาชิกสามารถดูรายละเอียดต่างๆ ได้จากประวัติการสั่งซื้อ&#013;รอบจำหน่าย, วันที่พิมพ์ใบกำกับภาษี, เลขที่ใบกำกับภาษี, มูลค่าผลิตภัณฑ์สุทธิ คลิกที่นี่"><img src="images/New_Button/F01.gif" alt="รายการสั่งซื้อที่ดาวน์โหลดแล้ว &#013;ท่านสมาชิกสามารถดูรายละเอียดต่างๆ ได้จากประวัติการสั่งซื้อ&#013;รอบจำหน่าย, วันที่พิมพ์ใบกำกับภาษี, เลขที่ใบกำกับภาษี, มูลค่าผลิตภัณฑ์สุทธิ คลิกที่นี่" name="Image31" width="144" height="119" border="0" id="Image31" /></a>		  </td>
          <td align="center"><a href="bw_Order_Manual.pdf" target="_blank" onmouseover="MM_swapImage('Image71','','images/New_Button/G02.gif',1)" onmouseout="MM_swapImgRestore()"><img src="images/New_Button/G01.gif" alt="ขั้นตอนการสั่งซื้อสินค้า" name="Image71" width="144" height="119" border="0" id="Image71" /></a></td>
          <td align="center">
		  <a href="contact_us.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image_contact','','images/New_Button/H02-new.png',1)"><img src="images/New_Button/H01-new.png" alt="ติดต่อสอบถาม E-mail Call Center" name="Image_contact" width="144" height="119" border="0" id="Image_contact" /></a>
		  </td>
          <td align="center">
		  <a href="http://www.mistine.co.th/pointrewards/index.php" target="_blank" onmouseover="MM_swapImage('Image23','','images/New_Button/bg2.png',1)" onmouseout="MM_swapImgRestore()"><img src="images/New_Button/bg2.png" alt="เบทเตอร์เวย์พอยท์ รีวอร์ด" name="Image23" width="144" height="119" border="0" id="Image23" /></a>
		  </td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center"></td>
          <td align="center"></td>
        </tr>
        <!--<tr>
          <td align="center"><a href="promote_all.php" target="_parent" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>&nbsp;</td>
          <td align="center"><a href="news_vip.php" target="_parent" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>&nbsp;</td>
          <td align="center"></td>
          <td align="center">&nbsp;</td>
          <td align="center"></td>
        </tr>-->
      </table>
      <br />
    </td>
  </tr>
  <?php require_once('include/i_footer_border.php'); ?>
</table>
<div id="dialogpoint" title="คะเเนนรางวัลสะสม">
    <div id="message_box_point" style="margin-left: 23px; display:none;">
    <span class="ui-state-default">
	<span class="ui-icon ui-icon-info" style="float:left; margin:0 7px 0 0;"></span></span>

<p style="text-align: center;"><span style="font-size:18px;">ปัจจุบันคุณมีคะแนนรางวัลสะสม  <?=$point ?>  คะเเเนน</span></p>

<p style="text-align: center;"><span style="font-size:18px;">สามารถสะสมคะเเนนไว้เพื่อเเลกของรางวัลได้โดยไม่มีวันหมดอายุ</span></p>
<p style="text-align: center;"><span style="font-size:18px;">คะแนนจะถูกยกเลิก เมื่อคุณไม่ได้สั่งซื้อติดต่อกัน 3 รอบจำหน่าย</span></p>
<p style="text-align: center;"><span style="font-size:18px;">คุณสามารถตรวจสอบรายการของรางวัลได้ที่ เมนูรายการคะแนนรางวัล</span></p>
<p style="text-align: center;"><span style="font-size:18px;"><img src="images/New_Button/logo_Mistinebw.gif" width="150" height="100" alt=""></span></p>		
		</div>
</div>

<div id="dialogpointYUPIN" title="ข่าวดีสำหรับ คุณ <?php echo $name?>">

    <div id="message_box_YUPIN" style="margin-center:50px; display:none;">
    <span class="ui-state-default">
   </span>
 <table id="Table_01" width="687" height="150" border="0" cellpadding="0" cellspacing="0" align="center">
	<!--<tr>
		<td rowspan="3">
			<img src="images/banner_popup/BW-Order-Key-order C.6-2018.jpg" width="290" height="150" alt=""></td>
		<td>
			<img src="images/banner_popup/02-crop.jpg" width="98" height="41" alt=""></td>
		<td rowspan="3">
			<img src="images/banner_popup/banner_yupin_03_3.jpg" width="299" height="150" alt=""></td>
	</tr>
	<tr>
		<td>
		
            <img src="../PHPQR_CODE/phpqrcode/<?php echo $PNG_WEB_DIR.basename($filename)?>"  width="98" height="97" alt="" />		
		</td> 
		
	<tr>
		<td>
			<img src="images/banner_popup/BW-Order-Key-order C.6-2018.jpg" width="98" height="12" alt=""></td>
	</tr>-->
	<tr>
		<td>
			<img src="images/banner_popup/BW-Order-Key-order C.6-2018.jpg" width="680" height="300" ></td>
	</tr>
</table>
  <p style="text-align:left"> 
   <FONT   SIZE="3" color="FF3333">หมายเหตุ   :  </Font>    
  </p> 
  <p style="text-align:left"> 
   <FONT   SIZE="3"> 1. สแกน QR Code โดยใช้ แอปพลิเคชัน  </Font>  &nbsp <img style="border:none;" align="ยุพิน" src="images/Line.png" width="40px" height = "40px"  />  
  </p> 
    <p style="text-align:left"> 
      <FONT SIZE="3">2. ค้นหาแอปพลิเคชันบน &nbsp&nbsp</Font>
		   <img style="border:none;" align="ยุพิน" src="images/20160803_1.png" width="90px" height = "30px"  /> &nbsp &nbsp  <FONT SIZE="3">หรือ</FONT>&nbsp &nbsp
		   <img style="border:none;" align="ยุพิน" src="images/20160803_2.png" width="90px" height = "30px"  />    &nbsp &nbsp 
	  <FONT  SIZE="3">ด้วยคำว่า </Font> &nbsp <FONT  SIZE="5">  "ยุพิน" </Font>
  </p>

   </div>
</div>
<?php require_once('include/i_footer.php'); ?>
</body>
</html>
<?php
	$dist=$_SESSION['dist'];
	$mslno=$_SESSION['mslno'];         
	include("i_msg_box.php"); 
	
?>
