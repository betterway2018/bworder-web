﻿<?php  
//header('Location: closewebsite.php');
clearstatcache();
session_start(); 
require_once('include/i_config.php'); 
date_default_timezone_set('Asia/Bangkok');   
	$current_day = date ('D');
	$current_year = date ('Y');
	$current_year = $current_year + 543;
	$current_date = date ('d/m/').$current_year;
	$current_time = date ('H:i:s');
	$current = date ('Ymd H:i:s');

	$close_start = '20161209 11:00:00';
	$close_stop  = '20161209 13:00:00';
	
	if ($current >= $close_start and $current <= $close_stop) 
	{
			header('Location: closewebsite.php?close_start='.$close_start.'&close_stop='.$close_stop);
			exit;
	} 
	
	
if(!isset($_POST)) 
{ 
//do the form 
} 
else 
{ 
//read the submitted form 
//echo "Thank you<br><a href='#'>To send another form go here.</a>"; 
}

$chk_login=$_SESSION['login'];
if($chk_login==1) {
	header("Location: logout.php");
}
?>
<?php  
   // header("Location: closewebsite.php");
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="-1" />
<title><?php echo $title; ?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" charset="utf-8" src="js/jscFunction.js"></script>
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
<!--
function setNextFocus(tar_obj) { //v3.0
	    if (event.keyCode == 13){
            var obj=document.getElementById(tar_obj);
			
            if (obj){
                obj.focus();
            }
        }
}
function  login_form_keydown() {
		    if (event.keyCode == 13){
            	var obj=document.getElementById('login_form');
				obj.submit()
        }
}
//-->
</script>


<style type="text/css">
<!--
.style2 {font-size: 12px}
#apDiv1 {
	position:absolute;
	width:250px;
	height:350px;
	z-index:1;
	left: 50px;
	top: 450px;
}
#hotprice {
	height: 247px;
	width: 269px;
	padding-top: 50px;
	padding-right: 50px;
	padding-bottom: 50px;
	padding-left: 100px;
}
#mishotprice {
	position:absolute;
	display:block;
	margin-left:10px;
}

a.mishotprice {
	text-decoration:none;	
}
-->
</style>
<script type="text/javascript" language="javascript">
function ClearForm(){
    document.login_form.reset();
}
</script>
</head>
<?PHP include ("analyticstracking.php")?>
<body onload="ClearForm()">
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" >
  <?php require_once('include/i_header_border.php'); ?>
  <?php require_once('include/i_header.php'); ?>
  <tr>
    <td height="480" align="left" valign="top" class="Sheet_Boder" style="padding:2px">
	<form action="login_check.php" method="post" name="login_form" target="_parent" id="login_form" >
    
	<div id="mishotprice" style="display:none;"><a class="mishotprice" href="https://www.mistine.co.th/save/saving.php?choice=1"><img style="border:none;" src="jquery.ikikok-slide/images/bwfamily_bworder.jpg" width="269" height="247" /></a></div>
    
        <table width="344" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="344" height="187"><fieldset >
              <legend ><img src="image_icon/banner_login.gif" width="325" height="36" /></legend>
              <br />
              <table width="320" border="0" align="center" cellpadding="3" cellspacing="3">
                <tr>
                  <td width="101" align="right">รหัสสมาชิก</td>
                  <td width="198" align="left"><input name="txtdist" type="text" id="txtdist" size="4" maxlength="4"  onkeydown="setNextFocus('txtmslno');"  onblur="setdistcode('txtdist');"/>
                    -
                    <input name="txtmslno" type="text" id="txtmslno" size="7" maxlength="5" onkeydown="setNextFocus('txtchkdgt');" />
                    -
                    <input name="txtchkdgt" type="text" id="txtchkdgt" size="2" maxlength="1"  onkeydown="setNextFocus('txtpwd');"  /></td>
                </tr>
                <tr>
                  <td align="right">รหัสผ่าน</td>
                  <td align="left"><input name="txtpwd" type="password" id="txtpwd" size="28" maxlength="15" onkeydown="login_form_keydown()" /></td>
                </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td align="left"><a href="javascript:document.login_form.submit();" target="_parent"> <img src="image_icon/login_btn.gif" width="59" height="23" border="0" /></a> <a href="javascript:document.login_form.reset();" target="_parent"><img src="image_icon/reset_btn.gif" width="59" height="23" border="0" /></a></td>
                </tr>
                </table>
              <br />

            </fieldset></td>
          </tr>
        </table>
        <br />

        

        <table width="326" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="32" valign="top"><img src="image_icon/log_in_icon1.gif" width="32" height="36" /></td>
            <td width="7" valign="top">&nbsp;</td>
            <td width="287" valign="middle"><font color="#EC008C" size="3">หากท่านมีรหัสสมาชิกแล้วและไม่เคยสั่งซื้อ<br />
            สินค้าทางอินเตอร์เน็ตและต้องการสั่งซื้อ<br />
            ผลิตภัณฑ์ <span style="color:blue; font-size:1.2em; font-weight: bold;"> (ลงทะเบียนใหม่) </span><br />กรุณา </font><a href="member_signup.php" target="_parent">คลิกที่นี่</a></td>
          </tr>
          <tr>
            <td colspan="3">&nbsp;</td>
          </tr>
          <tr>
            <td valign="top"><img src="image_icon/log_in_icon2.gif" width="32" height="36" /></td>
            <td valign="top">&nbsp;</td>
            <td valign="middle"><font color="#EC008C" size="3">ลืมรหัสผ่านกรุณา </font><a href="member_pwd1.php" target="_parent">คลิกที่นี่</a></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td valign="top"><img src="image_icon/log_in_icon4.gif" width="32" height="36" /></td>
            <td>&nbsp;</td>
            <td><font color="#EC008C" size="3">คู่มือการใช้งาน( .pdf) </font><a href="bw_Order_Manual.pdf">คลิกที่นี่</a><a href="BWOrder_manual/Default.html" title="คู่มือการใช้งาน" target="_blank"></a></td>
          </tr>
        </table>
        <script type="text/javascript">
function submit_form(){
		var thisform=document.getElementById("login_form");
		//alert (thisform.id);
		
		if (thisform.txtdist.value=="") {
			alert("กรุณาระบุรหัสสมาชิก !!");
			thisform.txtdist.focus();
			return false;
		}
		else if(thisform.txtmslno.value=="") {
			alert("กรุณาระบุรหัสสมาชิก !!");
			thisform.txtmslno.focus();
			return false;
		}
		else if(thisform.txtchkdgt.value=="") {
			alert("กรุณาระบุรหัสสมาชิก !!");
			thisform.txtchkdgt.focus();
			return false;
		}

		else {

			thisform.submit();
			return true;
		}
	
}
        </script>
<br />
      </form>
      <p><?php //include("i_banner_2.php"); ?></p></td>
  </tr>
  <?php require_once('include/i_footer_border.php'); ?>
</table>
<?php require_once('include/i_footer.php'); ?>
</body>
</html>