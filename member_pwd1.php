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
			mysql_query("SET NAMES 'UTF8'");
			$query = "SELECT * FROM MSLMST  WHERE  DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt";
			$mslmst = mysql_query($query, $bwc_orders) or die(mysql_error());
			$row_mslmst = mysql_fetch_assoc($mslmst);
			$totalRows_mslmst = mysql_num_rows($mslmst);
			 if ($totalRows_mslmst==0) {
				 AlertMessage("��辺������Ҫԡ���� �к�������Ҫԡ���١��ͧ","member_pwd.php");
				 exit;
			 }
			 else { 
		
				$name = $row_mslmst['NAME'];
			 }

} 
 //####################################################################################
else if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['Submit']) && $_POST['chk']=="1" ) {
//####################################################################################	
			$dist=$_POST['txtdist'];
			$mslno=$_POST['txtmslno'];
			$chkdgt=$_POST['txtchkdgt'];
			$rep_name=$_POST['txtname'];
			$email = $_POST['txtemail'];
			$phone = $_POST['txtphone'];
			$birthdate=$_POST['b_year'].$_POST['b_month'].$_POST['b_date'];
			
			mysql_select_db($database_bwc_orders, $bwc_orders);
			mysql_query("SET NAMES 'tis620'");
			$query = "SELECT * FROM MSLMST  WHERE  DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt  AND BIRTHDATE=$birthdate";
			//$query = "SELECT * FROM MSLMST  WHERE  DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt AND EMAIL ='$email'  AND PHONE='$phone' AND BIRTHDATE=$birthdate";
			$mslmst = mysql_query($query, $bwc_orders) or die(mysql_error());
			$row_mslmst = mysql_fetch_assoc($mslmst);
			$totalRows_mslmst = mysql_num_rows($mslmst);
			 if ($totalRows_mslmst==0) {
				 AlertMessage("�س��͡��������ǹ��Ǣͧ�س���١��ͧ","member_pwd1.php");
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
    <td height="480" align="left" valign="top" class="Sheet_Boder" style="padding:2px">
    
<?php 
if ($result=="1") {
?>


<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="307"  align="left" valign="top"><br />  <fieldset style="padding:6px;">
 <dl>
   <h3> ���¹ <b>��Ҫԡ :<?php echo $name; ?></b></h3></dl><dt>��������´������ʼ�ҹ����Ѻ��͡�Թ������觫��ͼ�Ե�ѳ��ҧ�Թ�����絢ͧ�س�մѧ�����<br /></dt>

 <ul>
   <li>������Ҫԡ  <b><?php echo $id;  ?></b> </li>
 <li> ���� - ���ʡ��  <b><?php echo $name ;?></b></li>
 <li> �ѹ ��͹ �� �Դ <b><?php  echo $birthdate;?></b></li>
 <li> �������    <b><?php  echo $email; ?></b></li>
 <li> ���Ѿ�� <b><?php echo $phone ; ?></b></li>
<li> �ѹ���ŧ����¹  <b><?php  echo $reg_date; ?></b></li>
<li> ���ʼ�ҹ <b><?php echo $pwd;?></b></li>
  <br />
</ul>
<center><font color="#990000">
  ��س�����������´������ʼ�ҹ�ͧ�س�����������Ѻ��͡�Թ������觫��ͼ�Ե�ѳ��ҧ�Թ������</font><br />
  *** �ͺ�س��� ***<br />
  <br />
  <input type="button" name="Button" id="Submit2" value="�˹����͡�Թ" onclick="window.location='login.php'" />

</center>
    </fieldset>      
      <br /></td>
  </tr>
</table>
<br />
<br />
<br />
<?php } else {  ?>


    <form action="" method="post" name="form_login" target="_parent" id="form_login" onsubmit="return check();">
      <br />
      <br />
      <table width="450" height="201" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="450" height="156" align="center" valign="top" ><fieldset  style="padding:0px;border-spacing:0px">
            <table width="100%" border="0" cellpadding="0" cellspacing="0" class="Table_border_bottom_gray">
              <tr>
                <td height="25" bgcolor="#F0F0F0">&nbsp;&nbsp;������ʼ�ҹ</td>
              </tr>
            </table>
            <br />
            <table width="96%" border="0" cellspacing="1" cellpadding="3">
              <tr>
                <td width="139" align="right">������Ҫԡ :</td>
                <td width="280" align="left"><input name="txtdist" type="text"  id="txtdist" value="<?php //echo $dist; ?>" size="4" maxlength="4" onblur="setdistcode('txtdist');"/>
                  -
                  <input name="txtmslno" type="text"  id="txtmslno" value="<?php //echo $mslno; ?>" size="5" maxlength="5" />
                  -
                  <input name="txtchkdgt" type="text"  id="txtchkdgt" value="<?php //echo $chkdgt; ?>" size="3" maxlength="1" />
               </td>
              </tr>
              <tr>
                <td align="right">���� - ���ʡ�� :</td>
                <td align="left"><input name="txtname" type="text"  id="txtname" value="<?php //echo $name ?>" size="32" />
                  </td>
              </tr>
              <tr>
                <td align="right">�ѹ/��͹/�� �.� ����Դ :</td>
                <td align="left"><select name="b_date" id="b_date">
                  <option value="" selected="selected">�ѹ��� </option>
                  <option value="01">1</option>
                  <option value="02">2</option>
                  <option value="03">3</option>
                  <option value="04">4</option>
                  <option value="05">5</option>
                  <option value="06">6</option>
                  <option value="07">7</option>
                  <option value="08">8</option>
                  <option value="09">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15</option>
                  <option value="16">16</option>
                  <option value="17">17</option>
                  <option value="18">18</option>
                  <option value="19">19</option>
                  <option value="20">20</option>
                  <option value="21">21</option>
                  <option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                </select>
                  /
                  <select name="b_month" id="b_month">
                    <option value="" selected="selected">��͹</option>
                    <option value="01">���Ҥ�</option>
                    <option value="02">����Ҿѹ��</option>
                    <option value="03">�չҤ�</option>
                    <option value="04">����¹</option>
                    <option value="05">����Ҥ�</option>
                    <option value="06">�Զع�¹</option>
                    <option value="07">�á�Ҥ�</option>
                    <option value="08">�ԧ�Ҥ�</option>
                    <option value="09">�ѹ��¹</option>
                    <option value="10">���Ҥ�</option>
                    <option value="11">��Ȩԡ�¹</option>
                    <option value="12">�ѹ�Ҥ�</option>
                  </select>
                  /                  
                  <select name="b_year" id="b_year">
                    <option value="" selected="selected">�� �.�. </option>
                    <?php
						for ($j==1; $j<=80;$j++) {
					?>
                    <option value="<?php echo date('Y') -$j+543; ?>" <?php  If ($bYear== date('Y') -$j+543) {  echo "selected"; } ?> ><?php echo date('Y') -$j+543; ?></option>
                    <?php } ?>
                  </select></td>
              </tr>
              <!--<tr>
                <td align="right">�����Ţ���Ѿ�� :</td>
                <td align="left"><input name="txtphone" type="text" id="txtphone" size="32" /></td>
              </tr>-->
             <!-- <tr>
                <td align="right">������� :</td>
                <td align="left"><input name="txtemail" type="text" id="txtemail" size="32" /></td>
              </tr>-->
            </table>
            <br />
            <input name="chk" type="hidden" id="chk" value="1" />
            <br />
            <!--<input type="button" name="button" id="button" value="��͹��Ѻ"   onclick="window.location='member_pwd.php'"/>-->
                       <input type="submit" name="Submit" id="Submit" value="�׹�ѹ�ʹ����ʼ�ҹ" />
                        <input type="reset" name="button2" id="button2" value="¡��ԡ"  onclick="window.location='login.php'"/>
            <br />
            <br />
          </fieldset></td>
        </tr>
      </table>
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
						alert("�س��͡������Ҫԡ ���١��ͧ��� !!");
						document.form_login.txtdist.focus();
						return false;		
				    }
					else if(!IsNumeric(document.form_login.txtmslno.value)) {
						alert("�س��͡������Ҫԡ ���١��ͧ��� !!");
						document.form_login.txtmslno.focus();
						return false;
					} else if(!IsNumeric(document.form_login.txtchkdgt.value)) {
						alert("�س��͡������Ҫԡ���١��ͧ��� !!");
						document.form_login.txtchkdgt.focus();
						return false;
					}
					else if (document.form_login.txtname.value==""){
						alert("��سҡ�͡����-���ʡ�Ţͧ�س���¤�� !!");
						document.form_login.txtname.focus();
						return false;
					}
	//				else if (!check_email(document.form_login.txtemail.value)){
	//					alert("��سҡ�͡����������١��ͧ��� !!");
	//					document.form_login.txtemail.focus();
	//					return false;
	//				}			
					else if (document.form_login.b_date.value=="" || document.form_login.b_month.value=="" || document.form_login.b_year.value==""){
						alert("��س��к��ѹ�Դ�ͧ�س���¤��");
						document.form_login.b_date.focus();
						return false;
					}

					else {
						return true;
					}
					
				}
		</script>
    </form>
    
<?php } ?>
    
    
    
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