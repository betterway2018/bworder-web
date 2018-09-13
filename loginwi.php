<?php  
clearstatcache();
session_start(); 

require("i_config.php"); 

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
<?php // header("Location: closewebsite.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Pragma" content="no-cache" />
 <meta http-equiv="Expires" content="-1" />
<title><?php  echo $title?></title>
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
-->
</style>
<script type="text/javascript" language="javascript">
function ClearForm(){
    document.login_form.reset();
}
</script>
</head>

<body onload="ClearForm()">
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" >
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
    <td class="Sheet_Boder"  ><?php //include("epop2.php"); ?>
</td>
  </tr>
  <tr>
    <td height="480" align="left" valign="top" class="Sheet_Boder" style="padding:2px"><form action="login_check.php" method="post" name="login_form" target="_parent" id="login_form" >
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
            ผลิตภัณฑ์กรุณา </font><a href="member_signup.php" target="_parent">คลิกที่นี่</a></td>
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