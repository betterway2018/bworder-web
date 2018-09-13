
<?php  session_start(); ?>
<?php require("i_config.php"); ?>
<?php require("i_function_msg.php"); ?>
<?php require_once('Connections/bwc_orders.php'); ?>

<?php 
$result = "0";
 //####################################################################################
if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['Submit']) && $_POST['doMode']=="Reset_PWD" ) {
//####################################################################################	
			$dist=$_POST['txtdist'];
			$mslno=$_POST['txtmslno'];
			$chkdgt=$_POST['txtchkdgt'];
			
			$result="0";
			
			mysql_select_db($database_bwc_orders, $bwc_orders);
			$query = "SELECT * FROM MSLMST  WHERE  DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt";
			$mslmst = mysql_query($query, $bwc_orders) or die(mysql_error());
			$row_mslmst = mysql_fetch_assoc($mslmst);
			$totalRows_mslmst = mysql_num_rows($mslmst);
			 if ($totalRows_mslmst==0) {
				 AlertMessage("ไม่พบรหัสสมาชิกหรือ ระบุรหัสสมาชิกไม่ถูกต้อง","javascript:history.back();");
				 exit;
			 }
			 else { 
		
				$name = $row_mslmst['NAME'];
				$question=$row_mslmst['QUESTION'];
			 }

} 
 //####################################################################################
else if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['Submit']) && $_POST['chk']=="2" ) {
//####################################################################################	
			$dist=$_POST['txtdist'];
			$mslno=$_POST['txtmslno'];
			$chkdgt=$_POST['txtchkdgt'];
			$question=$_POST['question'];
			$answer =$_POST['txtanswer'];
			
	
			mysql_select_db($database_bwc_orders, $bwc_orders);
			$query = "SELECT * FROM MSLMST  WHERE  DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt AND QUESTION ='$question'  AND ANSWER='$answer'";
			$mslmst = mysql_query($query, $bwc_orders) or die(mysql_error());
			$row_mslmst = mysql_fetch_assoc($mslmst);
			$totalRows_mslmst = mysql_num_rows($mslmst);
			 if ($totalRows_mslmst==0) {
				 AlertMessage("คุณตอบคำถามเพื่อขอรหัสผ่านจากคำถามกันลืมรหัสผ่านของคุณ ไม่ถูกต้อง","member_pwd.php");
				 exit;
			 }
			 else { 
				$result="1";
				$name = $row_mslmst['NAME'];
				$email = $row_mslmst['EMAIL'];
				$phone=$row_mslmst['PHONE'];
				$birthdate =substr($row_mslmst['BIRTHDATE'],6,2)."/".substr($row_mslmst['BIRTHDATE'],4,2)."/".substr($row_mslmst['BIRTHDATE'],0,4);
				$pwd=$row_mslmst['PWD'];
				$id =$dist."-".substr("00000".$mslno,-5)."-".$chkdgt;
				$reg_date =substr($row_mslmst['REG_DATE'],6,2)."/".substr($row_mslmst['REG_DATE'],4,2)."/".substr($row_mslmst['REG_DATE'],0,4);
				$question=$row_mslmst['QUESTION'];
				$answer=$row_mslmst['ANSWER'];
				
				
			 }

} 
else {
	$result="0";
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
    <td height="480" align="left" valign="top" class="Sheet_Boder" style="padding:2px"><?php 
if ($result=="1") {
?>
      <table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td height="307"  align="left" valign="top"><br />
            <fieldset style="padding:6px;">
              <br />
              เรียน คุณ<? echo $name; ?><br />
              รายละเอียดและรหัสผ่านสำหรับล็อกอินเพื่อสั่งซื้อผลิตภัณฑ์ทางอินเตอร์เน็ตของคุณมีดังนี้ค่ะ <br />
              .:  รหัสสมาชิก <?php echo $id;  ?> <br />
              .: ชื่อ - นามสกุล <?php echo $name ;?><br />
              .: วัน เดือน ปี เกิด
              <?php  echo $birthdate;?>
              <br />
              .: อีเมลล์
              <?php  echo $email; ?>
              <br />
              .: โทรศัพท์ <?php echo $phone ; ?><br />
              .: วันที่ลงทะเบียน
              <?php  echo $reg_date; ?>
              <br />
              .: คำถามกันลืมรหัสผ่าน 
              <?php  echo $question; ?>
              <br />
              .: คำตอบกันลืมรหัสผ่าน
              <?php  echo $answer; ?>
<br />
              .: รหัสผ่าน <b><?php echo $pwd;?></b> <br />
              <br />
              <center>
                กรุณาเก็บรายละเอียดและรหัสผ่านของคุณไว้เพื่อสำหรับล็อกอินเพื่อสั่งซื้อผลิตภัณฑ์ทางอินเตอร์เน็ต<br />
                *** ขอบคุณค่ะ ***<br />
                <br />
                <input type="button" name="Button" id="Submit2" value="ไปหน้าล็อกอิน" onclick="window.location='login.php'" />
              </center>
            </fieldset>
            <br /></td>
        </tr>
      </table>
      <br />
      <br />
      <br />
      <? } else {  ?>
      <form action="" method="post" name="form_login" target="_parent" id="form_login" onsubmit="return check();">
        <br />
        <table width="646" height="201" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="646" height="156" align="center" valign="top" style="background-image:url(Images/h_bg2.gif);background-position:top;background-repeat:repeat"><fieldset  style="padding:0px;border-spacing:0px">
              <table width="100%" border="0" cellpadding="0" cellspacing="0" class="Table_border_bottom_gray">
                <tr>
                  <td height="25" bgcolor="#F0F0F0">&nbsp;&nbsp;ลืมรหัสผ่าน</td>
                </tr>
              </table>
              <br />
              <table width="96%" border="0" cellspacing="1" cellpadding="3">
                <tr>
                  <td width="172" align="right">รหัสสมาชิก :</td>
                  <td width="431" align="left"><input name="txtdist2" type="text" disabled="disabled" id="txtdist2" value="<? echo $dist; ?>" size="3" maxlength="3" />
                    -
                    <input name="txtmslno2" type="text" disabled="disabled" id="txtmslno2" value="<? echo $mslno ?>" size="5" maxlength="5" />
                    -
                    <input name="txtchkdgt2" type="text" disabled="disabled" id="txtchkdgt2" value="<? echo $chkdgt ?>" size="3" maxlength="1" />
                    <input name="txtdist" type="hidden" id="txtdist" value="<? echo $dist ?>" />
                    <input name="txtmslno" type="hidden" id="txtmslno" value="<? echo $mslno ?>" />
                    <input name="txtchkdgt" type="hidden" id="txtchkdgt" value="<?php echo $chkdgt; ?>" /></td>
                </tr>
                <tr>
                  <td align="right">คำถามกันลืมรหัสผ่าน :</td>
                  <td align="left"><strong > <font color="#FF0000"><? echo $question; ?>
                    <input name="question" type="hidden" id="question" value="<?php echo $question ?>" />
                  </font></strong></td>
                </tr>
                <tr>
                  <td align="right">คำตอบ :</td>
                  <td align="left"><input name="txtanswer" type="text" id="txtanswer" size="48" maxlength="125" /></td>
                </tr>
              </table>
              <br />
              <input name="chk" type="hidden" id="chk" value="2" />
              <br />
              <input type="button" name="button" id="button" value="ย้อนกลับ"   onclick="window.location='member_pwd.php'"/>
              <input type="reset" name="button2" id="button2" value="ยกเลิก" />
              <input type="submit" name="Submit" id="Submit" value="ยืนยันขอรหัสผ่าน" />
              <br />
              <br />
            </fieldset></td>
          </tr>
        </table>
        <br />
        <br />
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
					else if (document.form_login.txtanswer.value==""){
						alert("กรุณากรอกคำตอบของคุณด้วยค่ะ !!");
						document.form_login.txtanswer.focus();
						return false;
					}
					else {
						return true;
					}
					
				}
		</script>
      </form>
      <? } ?>
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