<?php  session_start(); ?>
<?php require("i_config.php"); ?>
<?php require("i_function_msg.php"); ?>
<?php require_once('Connections/bwc_orders.php'); ?>

<?php 
	$id = $_GET['id'];
	
	if ($id=="") {
		echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
		exit;
	}
	
	/*$dist= substr($id,0,3);
	$mslno=substr($id,3,5);
	$chkdgt=substr($id,8,1);*/
	
	if(strlen($id)==10){
			$dist=substr($id,0,4);
			$mslno=substr($id,4,5);
			$chkdgt=substr($id,9,1);
			echo "สมาชิกเขต 4 หลัก".$id;
			}
			elseif(strlen($id)==9){
			$dist=substr($id,0,3);
			$mslno=substr($id,3,5);
			$chkdgt=substr($id,8,1);
			//echo "ผู้จัดการเขต 3 หลัก".$id;
				}
		
	if ($dist=="" || $mslno=="" || $chkdgt=="") {
		echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
		exit;
	}


	mysql_select_db($database_bwc_orders, $bwc_orders);
	mysql_query("SET NAMES 'tis620'");
	
	$query ="Select * From  mslmst Where DIST='$dist' and mslno=$mslno and chkdgt=$chkdgt ";
	$mslmst = mysql_query($query, $bwc_orders) or die(mysql_error());
	$row_mslmst = mysql_fetch_assoc($mslmst);
	$totalRows_mslmst= mysql_num_rows($mslmst);			
	if ($totalRows_mslmst==0) {
 		 	 echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
			 exit;
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
    <td height="480" align="left" valign="top" class="Sheet_Boder" style="padding:2px"><form id="form1" name="form1" method="post" action="member_signup_update.php" onsubmit="return check();">
      <table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><fieldset style="margin-top:12px;height:400px">
            <br />
            <table width="613"  border="0" align="center" cellpadding="2" cellspacing="1">
              <tr>
                <td colspan="3"  align="left"> &nbsp;&nbsp;&nbsp;ทางบริษัทขอขอบคุณ  คุณ
                 <font color="#EC008C"><b> 
                 <?php  echo $row_mslmst['NAME']; ?></b> </font>
                  สำหรับการลงทะเบียนการสั่งซื้อผลิตภัณฑ์ทางอินเตอร์เน็ต<br />
                  กรุณาเก็บรหัสผ่านไว้ เพื่อสำหรับล็อกอินเข้าสู่ระบบในการสั่งซื้อสินค้า มิสทิน ฟรายเดย์ ฟาริส ทางอินเตอร์เน็ต <br />
                  จากเวบไซต์ http://www.bworder.com รายละเอียดการลงทะเบียนและรหัสผ่าน <!--จะถูกจัดส่งไปทางอีเมลล์ <font color="#990000"><b>  <?php // echo $row_mslmst['EMAIL']; ?> 
                  </b></font>ตามที่คุณได้ระบุไว้ตอนลงทะเบียน เพื่อเป็นการยืนยันการลงทะเบียนของคุณค่ะ<br />-->
                 <br /> 
                 รายละเอียดการลงทะเบียนของคุณมีดังนี้ค่ะ <br/></td>
              </tr>
              <tr>
                <td width="72">&nbsp;</td>
                <td width="147">รหัสสมาชิก :</td>
                <td width="378" ><? echo  "$dist-$mslno-$chkdgt"; ?> &nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>ชื่อ - นามสกุล :</td>
                <td><?php  echo $row_mslmst['NAME']; ?>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>วัน/เดือน/ปี พ.ศ ที่เกิด :</td>
                <td><?php echo  substr($row_mslmst['BIRTHDATE'],6,2)."/".substr($row_mslmst['BIRTHDATE'],4,2)."/".substr($row_mslmst['BIRTHDATE'],0,4) ?>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>อีเมลล์ :</td>
                <td><? echo $row_mslmst['EMAIL']; ?> &nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td>เบอร์โทรศัพท์ :</td>
                <td><? echo $row_mslmst['PHONE']; ?> &nbsp;</td>
              </tr>
             <!-- <tr>
                <td align="right">คำถามกันลืมรหัสผ่าน : </td>
                <td><? //echo $row_mslmst['QUESTION']; ?> &nbsp;</td>
              </tr> -->
            <!--  <tr>
                <td align="right">คำตอบ : </td>
                <td><? //echo $row_mslmst['ANSWER']; ?> &nbsp;</td>
              </tr>-->
              <tr>
                <td>&nbsp;</td>
                <td>รหัสผ่าน  :</td>
                <td><? echo $row_mslmst['PWD']; ?> &nbsp;</td>
              </tr>
              <tr>
                <td colspan="2" align="right">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" align="center"><font color="#EC008C"><b>"ขอขอบคุณที่ท่านลงทะเบียนเพื่อสั่งซื้อสินค้าผ่านเวบ BWORDER : สั่งซื้อสินค้าง่าย ตลอด 24 ชม."</b></font></td>
              </tr>
              <tr>
                <td colspan="3" align="center"><p><a href="login.php" target="_parent"><img src="images/btn_back_login.gif" alt="กลับไปหน้าล็อกอิน"  border="0" title="คลิกเพื่อล็อคอินและเริ่มการสั่งซื้อสินค้าของคุณ"/></a></p>
                  <p>&nbsp;</p></td>
                </tr>
              </table>
            <br />
          </fieldset></td>
        </tr>
      </table>
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
					else if (document.form1.txtpwd1.value =="") {
							 	alert ("กรุณาระบุรหัสผ่านด้วยค่ะ !!!");
								document.form1.txtpwd1.focus();
								return false;					
					}
					else if  (document.form1.txtpwd1.value!=document.form1.txtpwd2.value) {
							 	alert ("ยืนยันรหัสผ่านใหม่ ไม่ถูกต้องค่ะ !!!");
								document.form1.txtpwd2.focus();
								return false;
					}
					else {
						return true;
					}
					
				}
		  </script>
      </span>
    </form> 
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