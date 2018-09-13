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
$dist=$_SESSION['dist'];
$mslno=$_SESSION['mslno'];
$chkdgt=$_SESSION['chkdgt'];
$flagalert=$_SESSION['flagalert'];
$YUPIN_STATUS=$_SESSION['YUPIN_STATUS'];
$YUPIN_REGISTER=$_SESSION['YUPIN_REGISTER'];

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
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
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
	<?php if ($_SESSION['flagalert']==1) {
		echo "dialog_alert(); document.getElementById('message_box').style.display = 'inline';";
		$_SESSION['flagalert'] = 0;
	} ?>
}  
  	   
function dialog_alert() {
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
						
						'กลับสู่หน้าหลัก': function() {
							document.getElementById('message_box').style.display = 'inline'
						    $(this).dialog('close');
						}
					  }
	
					});
}
		
 

</script>



</head>
<body onload="show_alert();">

<!-- <body>-->

<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" >
  <?php require_once('include/i_header_border.php'); ?>
  <?php require_once('include/i_header.php'); ?>
  <tr>
    <td height="480" align="left" valign="top" class="Sheet_Boder" style="padding:2px"><br />
	
	  <br />
      <br />
      <br />
      
      <table width="0" border="0" align="center" cellpadding="5" cellspacing="5">
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
          <td align="center"><a href="contact_us.php" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image_contact','','images/New_Button/H02-new.png',1)"><img src="images/New_Button/H01-new.png" alt="ติดต่อสอบถาม E-mail Call Center" name="Image_contact" width="144" height="119" border="0" id="Image_contact" /></a></td>
          <td align="center"><a href="http://www.mistine.co.th/pointrewards/index.php" target="_blank" onmouseover="MM_swapImage('Image23','','images/New_Button/I02.gif',1)" onmouseout="MM_swapImgRestore()"><img src="images/New_Button/I01.gif" alt="เบทเตอร์เวย์พอยท์ รีวอร์ด" name="Image23" width="144" height="119" border="0" id="Image23" /></a></td>
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
<div id="dialogpoint" title="คะเเนนสะสมเบทเตอร์เวย์พอยท์รีวอร์ด">
    <div id="message_box" style="margin-left: 23px; display:none;">
    <span class="ui-state-default">
	<span class="ui-icon ui-icon-info" style="float:left; margin:0 7px 0 0;"></span></span>

<p style="text-align: center;"><span style="font-size:18px;">ปัจจุบันคุณมีคะแนนสะสมเบทเตอร์เวย์พอยท์รีวอร์ด  <?=$point ?>  คะเเเนน</span></p>

<p style="text-align: center;"><span style="font-size:18px;">สามารถสะสมคะเเนนไว้เพื่อเเลกของรางวัลได้โดยไม่มีวันหมดอายุ</span></p>

<p style="text-align: center;"><span style="font-size:18px;">คุณสามารถตรวจสอบรายการของรางวัลได้ที่ เมนูเบทเตอร์เวย์พอยท์รีวอร์ดค่ะ</span></p>
		
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
