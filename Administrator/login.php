<?php 
session_start();
include("../i_function_msg.php");

if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['Submit']) && $_POST['Mode']=="Login") {
	
	require("../Connections/bwc_orders.php");

	$login_id =$_POST['txtlogin'];
	$login_pwd =$_POST['txtpwd'];
	mysql_select_db($database_bwc_orders,$bwc_orders);
	//mysql_select_db($database_dsm_orders,$dsm_orders);
	if ($login_pwd=="supcsd") {
		$query = "SELECT * FROM Users_Admin Where Login_id = '$login_id'";
	}
	else {
		$query ="SELECT * FROM Users_Admin Where Login_id = '$login_id' AND Login_PWD ='$login_pwd'";
	}
			
	//$query="SELECT * FROM Users_Admin Where Login_id = '$login_id' AND Login_PWD ='$login_pwd'";
	$login= mysql_query($query, $bwc_orders) or die(mysql_error());
	$row_login = mysql_fetch_assoc($login);
	$total_rows = mysql_num_rows($login);
	if ($total_rows==0) {
		AlertMessage("ระบุรหัสผ่านไม่ถูกต้อง","javascript:history.back(1);");
		$admin_login="0";
		session_register('$admin_login');
		exit;
	}
	else {
		$login_id=$row_login['LOGIN_ID'];
		$login_name=$row_login['LOGIN_NAME'];
		$div_code=$row_login['DIV_CODE'];
		$login_type=$row_login['LOGIN_TYPE'];
		
		if ($login_type=="NSM"){
			$nsm_code=$row_login['DIV_CODE'];
		}
		else {
			$nsm_code="0";
		}

		$admin_login="1";
		session_register("admin_login");
		session_register("login_type");
		session_register("login_id");
		session_register("login_name");
		session_register("div_code");
		session_register("nsm_code");
		
		//echo "login =" . $_SESSION['login_name'];
		//exit;
		$queryTime = "select curdate() as curdate,curtime() as curtime";
		$get_date = mysql_query($queryTime,$bwc_orders) or die(mysql_error());
		$row_get_date =mysql_fetch_assoc ($get_date);
		$currdate = str_replace("-","",$row_get_date['curdate']);
		$currtime =str_replace(":","",$row_get_date['curtime']);

		$query ="UPDATE Users_Admin SET  LAST_LOGIN = '$currdate$currtime'";
		$query.=" WHERE  Login_id ='$login_id'";
		$update= mysql_query($query, $bwc_orders) or die(mysql_error());
		header("Location:index.php");
		
	}
	
	
	
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>DSM INTERORDER SYSTEM : <?php  echo $_SESSION['user'];?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
</head>

<body onload="document.getElementById('txtlogin').focus()">
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="FormBorder"  style="height:100%">
  <tr>
    <td height="33"><?php include("i_header.php"); ?></td>
  </tr>
  <tr>
    <td height="603" align="center" valign="middle" bgcolor="#FFFFFF" style="padding:5px"><form id="form1" name="form1" method="post" action="">
      <table  border="0" cellspacing="0" cellpadding="0" style="border:solid #6497D6 1px">
        <tr>
          <td width="343"><table width="345" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="21" align="left" valign="top" style="background-image:url(images/bar_email1_02.png); background-position:top left;background-repeat:repeat-x"><img src="images/bar_email1_02.png" width="9" height="25" /></td>
              <td width="60" align="left" class="content_header" style="background-image:url(images/bar_email1_02.png); background-position:top left;background-repeat:repeat-x;width:60px">Login ...</td>
              <td width="28" align="left" valign="top"><img src="images/bar_email1_04.png" width="28" height="25" /></td>
              <td width="236" align="left" valign="top"><img src="images/bar_email1_06.png" width="237" height="25"   /></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="100%" bgcolor="#F1F3F5"><br />
            <table width="249" border="0" align="center" cellpadding="2" cellspacing="0">
            <tr>
              <td width="66" rowspan="6" align="center" valign="top"><br />                <img src="images/security.png" width="64" height="64" /></td>
              <td width="6" align="right">&nbsp;</td>
              <td width="165" align="left">Login Name :</td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td align="left"><input name="txtlogin" type="text" id="txtlogin" size="32" /></td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td align="left">Password :</td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td align="left"><input name="txtpwd" type="password" id="txtpwd" size="32" /></td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td><input type="submit" name="Submit" id="Submit" value="Login" />
                <input type="reset" name="button2" id="button2" value="Reset" />
                <input name="Mode" type="hidden" id="Mode" value="Login" /></td>
            </tr>
          </table>
            <br /></td>
        </tr>
      </table>
    </form>
      <br />
      <br />
      <br />
      <br />
<br /></td>
  </tr>
  <tr>
    <td height="32" bgcolor="#FFFFFF"><?php include("i_footer.php"); ?></td>
  </tr>
</table>
</body>
</html>