<?php 
session_start(); 
ob_start();
require_once('check_login.php');
require_once('include/i_config.php'); 
require_once('Connections/bwc_orders.php'); 
require_once('include/functionphp.inc');

	$id =$_GET['id'];
	$dist=$_SESSION['dist'];
	$mslno=$_SESSION['mslno'];
	$chkdgt=$_SESSION['chkdgt'];
	$rep_name=$_SESSION['name'];


if ($dist=="" || $mslno=="" || $chkdgt=="") {
	echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
}

mysql_select_db($database_bwc_orders, $bwc_orders);
mysql_query("SET NAMES 'utf8'");

$query = "SELECT * FROM MSLMST  WHERE  DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt";
$mslmst = mysql_query($query, $bwc_orders) or die(mysql_error());
$row_mslmst = mysql_fetch_assoc($mslmst);
$totalRows_mslmst = mysql_num_rows($mslmst);
if ($totalRows_mslmst==0) {
 AlertMessage("ไม่พบรหัสสมาชิกหรือ ระบุรหัสสมาชิกไม่ถูกต้อง","javascript:history.back();");
 exit;
}
else { 
	$bDate =substr($row_mslmst['BIRTHDATE'],6,2);
	$bMonth =substr($row_mslmst['BIRTHDATE'],4,2);
	$bYear =substr($row_mslmst['BIRTHDATE'],0,4);
	$email = $row_mslmst['EMAIL'];
	
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title; ?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->


function check_character(ch){ alert("FFF");
var len, digit;
if(ch == " "){
len=0;
}else{
len = ch.length;
}
for(var i=0 ; i<len ; i++)
{
digit = ch.charAt(i)
if( (digit >= "a" && digit <= "z") || (digit >="0" && digit <="9") || (digit >="A" && digit <="Z") || (digit =="_")){
return true;
}else{
//  return false;  
alert("กรุณากรอกตัวเลขและภาษาอังกฤษ");
  return false;  
}
}

}
</script>
</head>

<body>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0" >
  <?php require_once('include/i_header_border.php'); ?>
  <?php require_once('include/i_header.php'); ?>
  <tr>
    <td height="480" align="left" valign="top" class="Sheet_Boder" style="padding:2px">
    <form id="form1" name="form1" method="post" action="member_profile_update.php" onsubmit="return check();">
      <table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><fieldset style="margin-top:12px;height:400px">
            <legend ><img src="image_icon/edit_banner.gif" width="200" height="31" /></legend>
            <br />
            <table width="586"  border="0" align="center" cellpadding="3" cellspacing="1">
              <tr>
                <td width="206"  align="right">รหัสสมาชิก :</td>
                <td colspan="2" ><?php echo "$dist-$mslno-$chkdgt"; ?>
                  <input name="dist" type="hidden" id="dist" value="<?php echo $dist; ?>" />
                  <input name="mslno" type="hidden" id="mslno" value="<?php echo $mslno; ?>" />
                  <input name="chkdgt" type="hidden" id="chkdgt" value="<?php echo $chkdgt; ?>" /></td>
              </tr>
              <tr>
                <td align="right">ชื่อ - นามสกุล :</td>
                <td width="300"><input name="txtname" type="text"  id="txtname" value="<?php echo $row_mslmst['NAME']; ?>" size="32"  /></td>
                <td width="58">&nbsp;</td>
              </tr>
              <tr>
                <td align="right">วัน/เดือน/ปี พ.ศ ที่เกิด :</td>
                <td colspan="2"><select name="b_date" id="b_date"  disabled="disabled" >
                  <option value="" <?php If ($bDate==""){ echo "selected"; }?>>วันที่ </option>
                  <option value="01" <?php  If ($bDate=="01" ){  echo "selected"; } ?> >1</option>
                  <option value="02" <?php  If ($bDate=="02" ){  echo "selected"; } ?>>2</option>
                  <option value="03" <?php  If ($bDate=="03" ){  echo "selected"; } ?>>3</option>
                  <option value="04" <?php  If ($bDate=="04" ){  echo "selected"; } ?>>4</option>
                  <option value="05" <?php  If ($bDate=="05" ){  echo "selected"; } ?>>5</option>
                  <option value="06" <?php  If ($bDate=="06" ){  echo "selected"; } ?>>6</option>
                  <option value="07" <?php  If ($bDate=="07" ){  echo "selected"; } ?>>7</option>
                  <option value="08" <?php  If ($bDate=="08" ){  echo "selected"; } ?>>8</option>
                  <option value="09" <?php  If ($bDate=="09" ){  echo "selected"; } ?>>9</option>
                  <option value="10" <?php  If ($bDate=="10" ){  echo "selected"; } ?>>10</option>
                  <option value="11" <?php  If ($bDate=="11" ){  echo "selected"; } ?>>11</option>
                  <option value="12" <?php  If ($bDate=="12" ){  echo "selected"; } ?>>12</option>
                  <option value="13" <?php  If ($bDate=="13" ){  echo "selected"; } ?>>13</option>
                  <option value="14" <?php  If ($bDate=="14" ){  echo "selected"; } ?>>14</option>
                  <option value="15" <?php  If ($bDate=="15" ){  echo "selected"; } ?>>15</option>
                  <option value="16" <?php  If ($bDate=="16" ){  echo "selected"; } ?>>16</option>
                  <option value="17" <?php  If ($bDate=="17" ){  echo "selected"; } ?>>17</option>
                  <option value="18" <?php  If ($bDate=="18" ){  echo "selected"; } ?>>18</option>
                  <option value="19" <?php  If ($bDate=="19" ){  echo "selected"; } ?>>19</option>
                  <option value="20" <?php  If ($bDate=="20" ){  echo "selected"; } ?>>20</option>
                  <option value="21" <?php  If ($bDate=="21" ){  echo "selected"; } ?>>21</option>
                  <option value="22" <?php  If ($bDate=="22" ){  echo "selected"; } ?>>22</option>
                  <option value="23" <?php  If ($bDate=="23" ){  echo "selected"; } ?>>23</option>
                  <option value="24" <?php  If ($bDate=="24" ){  echo "selected"; } ?>>24</option>
                  <option value="25" <?php  If ($bDate=="25" ){  echo "selected"; } ?>>25</option>
                  <option value="26" <?php  If ($bDate=="26" ){  echo "selected"; } ?>>26</option>
                  <option value="27" <?php  If ($bDate=="27" ){  echo "selected"; } ?>>27</option>
                  <option value="28" <?php  If ($bDate=="28" ){  echo "selected"; } ?>>28</option>
                  <option value="29" <?php  If ($bDate=="29" ){  echo "selected"; } ?>>29</option>
                  <option value="30" <?php  If ($bDate=="30" ){  echo "selected"; } ?>>30</option>
                  <option value="31" <?php  If ($bDate=="31" ){  echo "selected"; } ?>>31</option>
                </select>
                  /
                  <select name="b_month" id="b_month" disabled="disabled">
                    <option value="" <?php  if ($bMonth=="" ) {  echo "selected"; } ?>>เดือน</option>
                    <option value="01" <?php  if ($bMonth=="01" ) {  echo "selected"; } ?>>มกราคม</option>
                    <option value="02" <?php  if ($bMonth=="02" ) {  echo "selected"; } ?>>กุมภาพันธ์</option>
                    <option value="03" <?php  if ($bMonth=="03" ) {  echo "selected"; } ?>>มีนาคม</option>
                    <option value="04" <?php  if ($bMonth=="04" ) {  echo "selected"; } ?>>เมษายน</option>
                    <option value="05" <?php  if ($bMonth=="05" ) {  echo "selected"; } ?>>พฤษภาคม</option>
                    <option value="06" <?php  if ($bMonth=="06" ) {  echo "selected"; } ?>>มิถุนายน</option>
                    <option value="07" <?php  if ($bMonth=="07" ) {  echo "selected"; } ?>>กรกฏาคม</option>
                    <option value="08" <?php  if ($bMonth=="08" ) {  echo "selected"; } ?>>สิงหาคม</option>
                    <option value="09" <?php  if ($bMonth=="09" ) {  echo "selected"; } ?>>กันยายน</option>
                    <option value="10" <?php  if ($bMonth=="10" ) {  echo "selected"; } ?>>ตุลาคม</option>
                    <option value="11" <?php  if ($bMonth=="11" ) {  echo "selected"; } ?>>พฤศจิกายน</option>
                    <option value="12" <?php  if ($bMonth=="12" ) {  echo "selected"; } ?>>ธันวาคม</option>
                  </select>
                  /
                  <select name="b_year" id="b_year" disabled="disabled">
                    <option value="" selected="selected">ปี พ.ศ. </option>
                    <?php
						for ($j==1; $j<=80;$j++) {
					?>
                    <option value="<?php echo date('Y') -$j+543; ?>" <?php  If ($bYear== date('Y') -$j+543) {  echo "selected"; } ?> ><?php echo date('Y') -$j+543; ?></option>
                    <?php } ?>
                  </select></td>
              </tr>
              <tr>
              <td align="right">เบอร์โทรศัพท์ :</td>
                <td colspan="2"><input name="txtphone" type="text" id="txtphone" value="<?php echo $row_mslmst['PHONE']; ?>" size="32" maxlength="32" disabled="disabled" /></td>
             
              </tr>
              <tr>
               <td align="right">อีเมลล์ :</td>
                <td colspan="2"><input name="txtemail" type="text" id="txtemail" value="<?php echo $row_mslmst['EMAIL']; ?>" size="32" />
                  *สามารถแก้ไขอีเมล์ได้</td>
              </tr>
             <!-- <tr>
                <td align="right">&nbsp;</td>
                <td colspan="2">&nbsp;</td>
              </tr>-->
            <!--  <tr>
                <td align="right">คำถามกันลืมรหัสผ่าน : </td>
                <td><input name="txtquest" type="text" id="txtquest" value="<?php //echo $row_mslmst['QUESTION']; ?>" size="60" /></td>
                <td>*</td>
              </tr>-->
             <!-- <tr>
                <td align="right">คำตอบ : </td>
                <td colspan="2"><input name="txtans" type="text" id="txtans" value="<?php //echo $row_mslmst['ANSWER']; ?>" size="36" />
                  *</td>
              </tr>-->
              <tr>
                <td align="right">&nbsp;</td>
                <td colspan="2"><font style="color:#F00; font-weight:bold;"> **หากท่านไม่มี e-mail หรือต้องการแก้ไข e-Mail <br />
                  กรุณาใส่ e-mail แล้วกดปุ่มบันทึก</font></td>
              </tr>
              <tr>
                <td align="right">เปลี่ยนรหัสผ่านใหม่ :</td>
                <td colspan="2"><input name="txtpwd1" type="password" id="txtpwd1" size="36" maxlength="15" onkeyup="checkText('txtpwd1')"  /></td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td colspan="2"><font color="#444444">* ระบุตัวเลข รวมกันอย่างน้อย 4 แต่ไม่เกิน 6 ตัว</font></td>
              </tr>
              <tr>
                <td align="right">ยืนยันรหัสผ่านใหม่ :</td>
                <td colspan="2"><input name="txtpwd2" type="password" id="txtpwd2" size="36" maxlength="15"  onkeyup="checkText('txtpwd2')"   /></td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td colspan="2"><font color="#444444">* ยืนยันรหัสผ่านที่คุณได้กำหนดแล้ว<br />
                </font></td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td colspan="2">&nbsp;
                  <input name="button" type="button" class="button_cancel" id="button" value="ยกเลิก"  onclick="window.location='index.php'" />
                  <input name="Submit" type="submit" class="button_save" id="Submit" value="บันทึก" /></td>
              </tr>
            </table>
            <br />
          </fieldset></td>
        </tr>
      </table>

      <script type="text/javascript">
	  
	  
	  
	  function checkText(str)
	{
		var elem = document.getElementById(str).value;
		if(!elem.match(/^([a-z0-9\_])+$/i))
		{
			alert("กรอกได้เฉพาะ a-Z, A-Z, 0-9");
			document.getElementById(str).value = "";
		}
	}
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

<!--

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
				
				// -->

//=========================================
				function check() {
					
				    if(!IsNumeric(document.form1.dist.value)) {
						alert("คุณกรอกรหัสสมาชิก ไม่ถูกต้องค่ะ !!");
						document.form1.dist.focus();
						return false;		
				    }
					else if(!IsNumeric(document.form1.mslno.value)) {
						alert("คุณกรอกรหัสสมาชิก ไม่ถูกต้องค่ะ !!");
						document.form1.mslno.focus();
						return false;
					} else if(!IsNumeric(document.form1.chkdgt.value)) {
						alert("คุณกรอกรหัสสมาชิกไม่ถูกต้องค่ะ !!");
						document.form1.chkdgt.focus();
						return false;
					}
					else if (document.form1.txtname.value==""){
						alert("กรุณากรอกชื่อ-นามสกุลของคุณด้วยค่ะ !!");
						document.form1.txtname.focus();
						return false;
					}
					else if ( document.form1.txtemail.value !="" && !check_email(document.form1.txtemail.value)){
						alert("กรุณากรอกอีเมลล์ไม่ถูกต้องค่ะ !!");
						document.form1.txtemail.focus();
						return false;
					}			
					else if (document.form1.b_date.value=="" || document.form1.b_month.value=="" || document.form1.b_year.value==""){
						alert("กรุณาระบุวันเกิดของคุณด้วยค่ะ");
						document.form1.b_date.focus();
						return false;
					}
					
					else if (document.form1.txtquest.value=="") {
						alert("กรุณาตั้งคำถามกันลืมรหัสผ่านของคุณด้วยค่ะ");
						document.form1.txtquest.focus();
						return false;
					}
					else if(document.form1.txtans.value=="") {
						alert("กรุณาระบุคำตอบด้วยค่ะ");
						document.form1.txtans.focus();
						return false;
					}
					else if (document.form1.txtpwd1.value !="") {
						 if  (document.form1.txtpwd1.value!=document.form1.txtpwd2.value) {
							 	alert ("ยืนยันรหัสผ่านใหม่ ไม่ถูกต้องค่ะ !!!");
								document.form1.txtpwd2.focus();
								return false;
						 }
						
					}
					else {
						return true;
					}
					
				}
		  </script>
      </span>
    </form>
      <br />
      <br />
      <!-- Start  Content  -->    
    
    
    
    </td>
  </tr>
  <?php require_once('include/i_footer_border.php'); ?>
</table>
<?php require_once('include/i_footer.php'); ?>
</body>
</html>
<?php
require_once('i_function_msg.php');
?>