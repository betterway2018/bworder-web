 <?php 
 //session_start();
 //ob_start();
 ?>
 <?php require("../i_config.php"); ?>
<?php 
//header('Content-type: text/html; charset=windows-874');
include("../i_function_msg.php");
require("../Connections/dsm_orders.php");
include("i_convert.php"); 
?>

<?php
$div= $_SESSION['div_code'];
$dist = $_GET['id'];

mysql_select_db($database_dsm_orders, $dsm_orders);
mysql_query("SET NAMES 'tis620'");
//mysql_query("SET NAMES 'utf8'");

$mode ="";
if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['doMode'])){
	$mode= "POST";
	$dist=$_POST['dist'];
	
	if ($_POST['txtpwd1']=="") {
		AlertMessage("กรุณาระบุรหัสผ่านด้วยค่ะ","dsm_resetPWD.php?id=$dist");
		exit;
	}
	
	if ($_POST['txtpwd1']!=$_POST['txtpwd2']) {
		AlertMessage("ยืนยันรหัสผ่านไม่ถูกต้อง","dsm_resetPWD.php?id=$dist");
		exit;
	}

	$query ="UPDATE users SET PASSWORD ='".$_POST['txtpwd1'] ."'";
	$query.=" WHERE DISTRICT='$dist'";
	$update = mysql_query($query,$dsm_orders);
	if ($update) {

		echo "<script type='text/javascript'> ";
		echo "if (parent.window.hs) {";
		echo "var exp = parent.window.hs.getExpander('changePWD".$dist."');";
		echo "if (exp) {";
				echo "setTimeout(function() {";
				echo "exp.close();";
				echo "}, 1000);";
				echo "}";
				echo "}";
		echo "</script>";
		echo "<font color='#000000'><center><br /><br />เปลี่ยนรหัสผ่านเรียบร้อยแล้วค่ะ ... </center><br /><br /></font>";
		echo "<br>";
		exit;
	}
	else {
		AlertMessage("ไม่สามารถเปลี่ยนรหัสผ่านได้ กรุณาลองใหม่อีกครั้ง","dsm_resetPWD.php?id=$dist");
		exit;		
	}
	
}
else {
	$mode ="GET";
	
}

$query = "SELECT * FROM users Where District = '$dist'";
$users = mysql_query($query, $dsm_orders) or die(mysql_error());
$row_users = mysql_fetch_assoc($users);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ข้อมูลของผู้จัดการประจำเขต</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript"> 
function doSubmit() {
	var frm = document.getElementById("frm");
	var area = document.getElementById("area");
	frm.submit();
/*	
	if (parent.window.hs) {
		var exp = parent.window.hs.getExpander("formexample");
		if (exp) {
				setTimeout(function() {
				exp.close();
			}, 3000);
		}
	}
 */
	return true;
}

function doClose(dist) {

		if (parent.window.hs) {
		var exp = parent.window.hs.getExpander("changePWD"+dist);
		if (exp) {
				setTimeout(function() {
				exp.close();
			},100);
		}
	}
 	return true;
}

function reset_pwd() {
	var pwd1 =document.getElementById('txtpwd1');
	var pwd2 =document.getElementById('txtpwd2');

	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	var string_length = 4;
	var randomstring = '';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	//document.randform.randomfield.value = randomstring;
	pwd1.value=randomstring;
	pwd2.value =randomstring;



}

</script>

</head>

<body>
<table width="500" border="0" align="center" cellpadding="0" cellspacing="0" style="border:solid #6497D6 1px;margin-top:0px;height:auto">
  <tr>
    <td width="543" align="left" style="background-image:url(images/bar_email1_06.png);background-position:top;background-repeat:repeat-x"><table width="199" border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <th width="14" align="left" valign="top" style="background-image:url(images/bar_email1_02.png); background-position:top left;background-repeat:repeat-x; width:9px"><img src="images/bar_email1_02.png" width="9" height="25" /></th>
        <td width="186" align="left" nowrap="nowrap" class="content_header" style="background-image:url(images/bar_email1_02.png); background-position:top left;background-repeat:repeat-x;">เปลี่ยนรหัสผ่าน</td>
        <td width="28" align="right" valign="top" style="background-image:url(images/bar_email1_02.png); background-position:top left;background-repeat:repeat-x; width:28px"><img src="images/bar_email1_04.png" width="28" height="25" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#F1F3F5"><div id="area">
 <form action="?id=<?php echo $row_users['DISTRICT']?>" method="POST" id="frm" style="margin: 0" onsubmit="return false">

 <table width="500" border="0" cellpadding="3" cellspacing="1">
  <tr>
    <td width="144" align="right" bgcolor="#E0E4E9"><strong>รหัสเขต</strong></td>
    <td width="349" align="left"><?php echo $row_users['DISTRICT'];?>
      <input name="doMode" type="hidden" id="doMode" value="ResetPassword" />
      <input name="dist" type="hidden" id="dist" value="<?php echo $row_users['DISTRICT'];?>" /></td>
    </tr>
  <tr>
    <td align="right" bgcolor="#E0E4E9"><strong>ชื่อ - นามสกุล</strong></td>
    <td align="left"><?php echo $row_users['NAME'];?></td>
    </tr>
  <tr>
    <td align="right" bgcolor="#E0E4E9"><strong>E-mail</strong></td>
    <td align="left"><?php echo $row_users['EMAIL'];?></td>
    </tr>
  <tr>
    <td align="right" bgcolor="#E0E4E9">&nbsp;</td>
    <td align="left">&nbsp;</td>
    </tr>
  <tr>
    <td align="right" bgcolor="#E0E4E9"><strong>รหัสผ่านเดิม</strong></td>
    <td align="left"><?php echo $row_users['PASSWORD'];?></td>
    </tr>
  <tr>
    <td align="right" bgcolor="#E0E4E9"><strong>รหัสผ่านใหม่</strong></td>
    <td align="left"><input type="text" name="txtpwd1" id="txtpwd1" />
      <a href="#" onclick="reset_pwd()">สร้างรหัสผ่านอัตโนมัติ</a></td>
    </tr>
  <tr>
    <td align="right" bgcolor="#E0E4E9"><strong>ยืนยันรหัสผ่านใหม่</strong></td>
    <td align="left"><input type="text" name="txtpwd2" id="txtpwd2" /></td>
    </tr>
  <tr>
    <td align="right" bgcolor="#E0E4E9">&nbsp;</td>
    <td align="right"><input type="button" name="button2" id="button2" value="เปลี่ยนรหัสผ่าน" onclick="doSubmit()"/>
      <input type="button" name="button" id="button" value="ปิดหน้าต่าง"  onclick="doClose('<?php  echo $dist;?>')"  />
 
    </td>
    </tr>
  </table>
 
  </form>
</div>
    
    </td>
  </tr>
</table>
</body>
</html>
<?php 
//ob_end_flush();   // ตำแหน่งสิ้นสุด  
?>