<?php session_start();
ob_start();
?>

<?php 
header('Content-type: text/html; charset=windows-874');
include("../i_function_msg.php");
require("../Connections/dsm_orders.php");
include("i_convert.php"); 
?>
<?php  require("check_login.php"); ?>
<?php
$div= $_SESSION['div_code'];

mysql_select_db($database_dsm_orders, $dsm_orders);
mysql_query("SET NAMES 'tis620'");
//mysql_query("SET NAMES 'utf8'");

if ($_SERVER['REQUEST_METHOD']=="POST" &&  isset($_POST["Submit"]) && $_POST['Submit']=="Update") {
	
	$txtdiv = $_POST['txtdiv'];
	$email = $_POST['txtemail'];
	$div_login = $_POST['txtlogin'];
	$txtpwd1 =$_POST['txtpwd1'];
	$txtpwd2 =$_POST['txtpwd2'];
	
	$query="UPDATE  tbdiv SET DIV_EMAIL = '$email' WHERE DIV_CODE ='$txtdiv'";
	$update1=mysql_query($query,$dsm_orders) or die(mysql_error());
	//if ($update1) {
	//	AlertMessage("บันทึกข้อมูลเรียบร้อยแล้วค่ะ","division_profile.php");
	//	exit;
	//}
	
	if ($txtpwd1!="") {
		$query2="UPDATE users_admin SET LOGIN_PWD ='$txtpwd1' WHERE LOGIN_ID ='$div_login'";
		$update2=mysql_query($query2,$dsm_orders) or die(mysql_error());
		if($update2) {
			//echo "<meta http-equiv='refresh' content='0;URL=division_profile.php'>";
			AlertMessage("บันทึกข้อมูลเรียบร้อยแล้วค่ะ","division_profile.php");
		 	exit;
		}
		else { 
			AlertMessage("ไม่สามารถเปลี่ยนรหัสผ่านได้","javascript.history.back();");
			exit;
		}
	}
	else {
		 AlertMessage("บันทึกข้อมูลเรียบร้อยแล้วค่ะ","division_profile.php");
		 exit;
		//echo "<meta http-equiv='refresh' content='0;URL=division_profile.php'>";
	}
}

//#######################################################################################
//#######################################################################################


$query="Select a.DIV_CODE,a.DIV_NAME,a.DIV_MGR_NAME,a.DIV_EMAIL ,
			 b.LOGIN_ID,b.LOGIN_NAME,b.LOGIN_PWD,b.LOGIN_TYPE,b.LOGIN_STATUS,b.LAST_LOGIN
			 From tbdiv a
			 LEFT OUTER JOIN users_admin b 
			 ON a.DIV_CODE = b.DIV_CODE  
			 WHERE a.DIV_CODE ='$div'";
			 

$users = mysql_query($query, $dsm_orders) or die(mysql_error());
$row_users = mysql_fetch_assoc($users);
$total_row_users = mysql_num_rows($users);
if ($total_row_users==0) {
	AlertMessage ("ไม่พบข้อมูล  Division Profile","home.php");
	exit;
}


?>

    
    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>DSM INTERORDER SYSTEM : <?php  echo $_SESSION['login_name'];?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<br />
<form id="form1" name="form1" method="post" action="" onsubmit="return check();">
  <table width="512"  border="0" align="center" cellpadding="0" cellspacing="0" style="border:solid #6497D6 1px">
    <tr>
      <td width="510" align="left" style="background-image:url(images/bar_email1_06.png);background-position:top;background-repeat:repeat-x"><table width="165" border="0" cellpadding="0" cellspacing="0" >
        <tr>
          <th width="9" align="left" valign="top" style="background-image:url(images/bar_email1_02.png); background-position:top left;background-repeat:repeat-x; width:9px"><img src="images/bar_email1_02.png" width="9" height="25" /></th>
          <td width="187" align="left" nowrap="nowrap" class="content_header" style="background-image:url(images/bar_email1_02.png); background-position:top left;background-repeat:repeat-x;"><strong>Division Profile </strong></td>
          <td width="27" align="right" valign="top" style="background-image:url(images/bar_email1_02.png); background-position:top left;background-repeat:repeat-x; width:28px"><img src="images/bar_email1_04.png" width="28" height="25" /></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td height="231" align="left" bgcolor="#F1F3F5"><table width="503" border="0" cellspacing="1" cellpadding="3" >
        <tr>
          <td width="159">&nbsp;</td>
          <td width="329">&nbsp;</td>
        </tr>
        <tr>
          <td align="right">DIV CODE :</td>
          <td><input name="textfield4" type="text" disabled="disabled" id="textfield4" value="<?php echo $row_users['DIV_CODE'] ?>" size="5" maxlength="5" />
            <input name="txtdiv" type="hidden" id="txtdiv" value="<?php echo $row_users['DIV_CODE']; ?>" /></td>
        </tr>
        <tr>
          <td align="right">DESCRIPION :</td>
          <td><input name="textfield5" type="text" disabled="disabled" id="textfield5" value="<?php echo $row_users['DIV_NAME']; ?>" size="60" /></td>
        </tr>
        <tr>
          <td align="right">DIV NAME :</td>
          <td><input name="textfield6" type="text" disabled="disabled" id="textfield6" value="<?php echo $row_users['DIV_MGR_NAME']; ?>" size="60" /></td>
        </tr>
        <tr>
          <td align="right">E-MAIL :</td>
          <td><input name="txtemail" type="text" id="txtemail" value="<?php echo $row_users['DIV_EMAIL']; ?>" size="50" /></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">Login ID : </td>
          <td><input name="textfield7" type="text" disabled="disabled" id="textfield7" value="<?php echo $row_users['LOGIN_ID'] ?>" size="20" maxlength="20" />
            <input name="txtlogin" type="hidden" id="txtlogin" value="<?php echo $row_users['LOGIN_ID']; ?>" /></td>
        </tr>
        <tr>
          <td align="right">Old Password :</td>
          <td>******** </td>
        </tr>
        <tr>
          <td align="right">Change New Password :</td>
          <td><input name="txtpwd1" type="password" id="txtpwd1" size="20" maxlength="10" /></td>
        </tr>
        <tr>
          <td align="right">Confirm New Password :</td>
          <td><input name="txtpwd2" type="password" id="txtpwd2" size="20" maxlength="10" /></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td><input type="submit" name="Submit" id="Submit" value="Update" />
            <input type="button" name="button2" id="button2" value="Cancel"  onclick="window.location='home.php'"/></td>
        </tr>
      </table></td>
    </tr>
  </table>
  <script type="text/javascript">
		function check() {
			var frm = document.getElementById('form1');
			if (frm.txtemail.value=="") {
				alert("กรุณาระบุ E-mail  address ");
				frm.txtemail.focus();
				return false;
			}
			else if (frm.txtpwd1.value!="") {
				if (frm.txtpwd1.value !=frm.txtpwd2.value) {
					alert("ยืนยันรหัสผ่านใหม่ ไม่ถูกต้องค่ะ");
					frm.txtpwd2.focus();
					return false;
				}
				else {
					return true;
				}
			}
			else {
				return true;
			}
				
		}
  </script>
</form>
<br />
<br />
<br />
      <br />
</body>
</html>
<?php 
ob_end_flush();
?>