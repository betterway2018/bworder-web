<?php  session_start(); ?>
<?php require("i_config.php"); ?>
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
    <td height="480" align="left" valign="top" class="Sheet_Boder" style="padding:2px"><center><br />
      <strong><span class="Table_border_bottom_gray">.:: ลืมรหัสผ่าน ::.</span></strong><br />
      <br /></center>
      <form id="form_login" name="form_login" method="post" action="" onsubmit="return check();">
        <center>
          <br />
          <table width="444" border="0" cellspacing="1" cellpadding="3">
            <tr>
              <td width="74" align="right">รหัสสมาชิก :</td>
              <td width="355" align="left"><input name="txtdist" type="text" id="txtdist" size="3" maxlength="3" />
                -
                <input name="txtmslno" type="text" id="txtmslno" size="5" maxlength="5" />
                -
                <input name="txtchkdgt" type="text" id="txtchkdgt" size="1" maxlength="1" /></td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td align="left"><table width="326" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td width="19" align="left"><input name="rd1" type="radio" id="radio2" value="1" checked="checked" /></td>
                  <td width="307" align="left">ยืนยันข้อมูลเพื่อขอรหัสผ่านจากข้อมูลส่วนตัว</td>
                </tr>
                <tr>
                  <td align="left"><input type="radio" name="rd1" id="radio" value="2" /></td>
                  <td align="left">ยืนยันข้อมูลเพื่อขอรหัสผ่านจากคำถามกันลืมรหัสผ่าน</td>
                </tr>
              </table></td>
            </tr>
          </table>
          <table width="600" border="0" cellspacing="0" cellpadding="3">
            <tr> </tr>
          </table>
          <br />
          <input type="button" name="Button" id="button" value="&lt;&lt; ย้อนกลับ"  onclick="javascript:history.back();"/>
          <input type="submit" name="Submit" id="Submit" value="ต่อไป &gt;&gt;" />
          <input name="doMode" type="hidden" id="doMode" value="Reset_PWD" />
          <br />
          <script type="text/javascript">
				function IsNumeric(strString)
					   //  check for valid numeric strings	
					   {
					   var strValidChars = "0123456789.-";
					   var strChar;
					   var blnResult = true;
					
					   if (strString.length == 0) return false;
					
					   //  test strString consists of valid characters listed above
					   for (i = 0; i < strString.length && blnResult == true; i++)
						  {
						  strChar = strString.charAt(i);
						  if (strValidChars.indexOf(strChar) == -1)
							 {
							 blnResult = false;
							 }
						  }
					   return blnResult;
				}
				// Email Validation. Written by PerlScriptsJavaScripts.com
				
				function check_email(e) {
					ok = "1234567890qwertyuiop[]asdfghjklzxcvbnm.@-_QWERTYUIOPASDFGHJKLZXCVBNM";
				
					for(i=0; i < e.length ;i++){
						if(ok.indexOf(e.charAt(i))<0){ 
						return (false);
						}	
					} 
				
					if (document.images) {
						re = /(@.*@)|(\.\.)|(^\.)|(^@)|(@$)|(\.$)|(@\.)/;
						re_two = /^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
						if (!e.match(re) && e.match(re_two)) {
							return (-1);		
						} 
				
					}
				
				}
				
//=========================================
				function check() {
					var frm  = document.getElementById('form_login');
				    if(!IsNumeric(document.form_login.txtdist.value)) {
						alert("คุณกรอกรหัสสมาชิก ไม่ถูกต้องค่ะ !!");
						document.form_login.txtdist.focus();
						return false;		
				    }
					else if(!IsNumeric(document.form_login.txtmslno.value)) {
						alert("คุณกรอกรหัสสมาชิก ไม่ถูกต้องค่ะ !!");
						document.form_login.txtmslno.focus();
						return false;
					} else if(!IsNumeric(document.form_login.txtchkdgt.value)) {
						alert("คุณกรอกรหัสสมาชิกไม่ถูกต้องค่ะ !!");
						document.form_login.txtchkdgt.focus();
						return false;
					}
					else {
						if (document.form_login.rd1[0].checked){
							frm.setAttribute('action','member_pwd1.php');
							frm.submit()							 
						}
						else  if (document.form_login.rd1[1].checked){
							frm.setAttribute('action','member_pwd2.php');
							frm.submit()	
						}
						return true;
					}
					
				}
		</script>
        </center>
      </form>
      <br />
      <br />
      <br />
<!-- Start  Content  -->    
    
    
    
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
<br /><?php include("i_footer.php"); ?>
</body>
</html>