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
		$name =$_POST['txtname'];
		$email =$_POST['txtemail'];
		$pwd = $_POST['txtpwd'];
		
		
		$msg="เรียนคุณ".$name. "  รหัสผู้จัดการประจำเขต ".$dist."\n";
		$msg.= "ขอแจ้งรหัสผ่านใหม่สำหรับเข้าระบบ DSM Internet Order ผ่านทางเว็บไซต์ http://www.dsmorder.com ของคุณดังนี้ค่ะ \n";
		$msg.= "รหัสผู้จัดการประจำเขต  " .$dist."\n";
		$msg.= "รหัสผ่านคือ  " .$pwd."\n";
		$msg.= "คุณสามารถสั่งซื้อสินค้าทางอินเตอร์ได้ผ่าน URL  http://www.dsmorder.com  ค่ะ\n";
		$msg.= "ขอบคุณคะ " ;
		
		$email_from = "info@mistine.co.th";
		$to = $email;
		$subject ="แจ้งรหัสผ่านใหม่สำหรับเข้าระบบ DSM Internet Order ผ่านทางเว็บไซต์ http://www.dsmorder.com";
		$random_hash = md5(date('r', time())); 
		$headers = "From: $email_from"."\r\nReply-To: $to"; 
		$headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\""; 
		$message =$msg  ;
		//send the email 
		$mail_sent = @mail( $to, $subject, $message, $headers ); 
		if  ($mail_sent) {
			//echo"<meta http-equiv='refresh' content='0;URL=index.php'>";		
			echo "<script type='text/javascript'> ";
			echo "if (parent.window.hs) {";
			echo "var exp = parent.window.hs.getExpander('SendMail".$dist."');";
			echo "if (exp) {";
			echo "setTimeout(function() {";
			echo "exp.close();";
			echo "}, 3000);";
			echo "}";
			echo "}";
			echo "</script>";
			echo " <font style='font-family:Tahoma, Geneva, sans-serif; size:9px'> <center><br /><br />แจ้งรหัสผ่านใหม่สำหรับเข้าระบบ DSM Internet Order ผ่านทางเว็บไซต์ http://www.dsmorder.com <br>ไปยังคุณ $name  รหัสผู้จัดการประจำเขต  $dist  เรียบร้อยแล้วค่ะ ... </center><br /><br /></font>";
			echo "<br>";
			exit;
		
		}
		else {
			//die("Sorry but the email could not be sent. Please go back and try again!"); 
			AlertMessage("ขออภัยค่ะ ...ไม่สามารถส่งอีเมลล์ได้ กรุณาลองใหม่อีกครั้งค่ะ","javascript:history.back();");
			exit;
		}
}
else {
	$mode ="GET";
	
}

$query = "SELECT * FROM users Where   District = '$dist'";
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
		var exp = parent.window.hs.getExpander("SendMail"+dist);
		if (exp) {
				setTimeout(function() {
				exp.close();
			},100);
		}
	}
 	return true;
}

</script>

</head>

<body>
<table width="100%"   height="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:solid #6497D6 1px;margin-top:0px;height:auto">
  <tr>
    <td width="550" height="25" align="left" style="background-image:url(images/bar_email1_06.png);background-position:top;background-repeat:repeat-x"><table width="199" border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <th width="14" align="left" valign="top" style="background-image:url(images/bar_email1_02.png); background-position:top left;background-repeat:repeat-x; width:9px"><img src="images/bar_email1_02.png" width="9" height="25" /></th>
        <td width="186" align="left" nowrap="nowrap" class="content_header" style="background-image:url(images/bar_email1_02.png); background-position:top left;background-repeat:repeat-x;">ส่ง E-mail แจ้งรหัสผ่านไปยังผู้จัดการประจำเขต </td>
        <td width="28" align="right" valign="top" style="background-image:url(images/bar_email1_02.png); background-position:top left;background-repeat:repeat-x; width:28px"><img src="images/bar_email1_04.png" width="28" height="25" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="100%" align="left" valign="top" bgcolor="#F1F3F5"><div id="area">
 <form action="?id=<?php echo $row_users['DISTRICT']?>" method="POST" id="frm" style="margin: 0" onsubmit="return false">

 <table width="100%" border="0" cellpadding="3" cellspacing="1">
  <tr>
    <td width="23%" align="right" bgcolor="#E0E4E9"><strong>รหัสเขต</strong></td>
    <td width="77%" align="left"><?php echo $row_users['DISTRICT'];?>
      <input name="doMode" type="hidden" id="doMode" value="ResetPassword" />
      <input name="dist" type="hidden" id="dist" value="<?php echo $row_users['DISTRICT'];?>" /></td>
    </tr>
  <tr>
    <td align="right" bgcolor="#E0E4E9"><strong>ชื่อ - นามสกุล</strong></td>
    <td align="left"><?php echo $row_users['NAME'];?>
      <input name="txtname" type="hidden" id="txtname" value="<?php echo $row_users['NAME'];?>" /></td>
    </tr>
  <tr>
    <td align="right" bgcolor="#E0E4E9"><strong>E-mail</strong></td>
    <td align="left"><?php echo $row_users['EMAIL'];?>
      <input name="txtemail" type="hidden" id="txtemail" value="<?php echo $row_users['EMAIL'];?>" /></td>
    </tr>
  <tr>
    <td align="right" bgcolor="#E0E4E9">&nbsp;</td>
    <td align="left">&nbsp;</td>
    </tr>
  <tr>
    <td align="right" bgcolor="#E0E4E9"><strong>รหัสผ่าน</strong></td>
    <td align="left"><?php echo $row_users['PASSWORD'];?>
      <input name="txtpwd" type="hidden" id="txtpwd" value="<?php echo $row_users['PASSWORD'];?>" /></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#E0E4E9">&nbsp;</td>
    <td align="right"><input type="button" name="button2" id="button2" value="ส่งอีเมลล์" onclick="doSubmit()"/>
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