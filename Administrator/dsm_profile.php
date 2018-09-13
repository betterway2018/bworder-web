<?php session_start();?>
<?php 
header('Content-type: text/html; charset=windows-874');
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

$query = "SELECT * FROM users Where  District = '$dist'";
 

$users = mysql_query($query, $dsm_orders) or die(mysql_error());
$row_users = mysql_fetch_assoc($users);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ข้อมูลของผู้จัดการประจำเขต</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%"   height="100%" border="0" align="center" cellpadding="0" cellspacing="0" style="border:solid #6497D6 1px;margin-top:0px;height:auto">
  <tr>
    <td width="550" height="25" align="left" style="background-image:url(images/bar_email1_06.png);background-position:top;background-repeat:repeat-x"><table width="199" border="0" cellpadding="0" cellspacing="0" >
      <tr>
        <th width="14" align="left" valign="top" style="background-image:url(images/bar_email1_02.png); background-position:top left;background-repeat:repeat-x; width:9px"><img src="images/bar_email1_02.png" width="9" height="25" /></th>
        <td width="186" align="left" nowrap="nowrap" class="content_header" style="background-image:url(images/bar_email1_02.png); background-position:top left;background-repeat:repeat-x;">ข้อมูลของผู้จัดการประจำเขต</td>
        <td width="28" align="right" valign="top" style="background-image:url(images/bar_email1_02.png); background-position:top left;background-repeat:repeat-x; width:28px"><img src="images/bar_email1_04.png" width="28" height="25" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="100%" align="left" valign="top" bgcolor="#F1F3F5"><table width="531" border="0" cellpadding="3" cellspacing="1">
      <tr>
        <td align="right" bgcolor="#E0E4E9"><strong>รหัสเขต</strong></td>
        <td align="left"><?php echo $row_users['DISTRICT'];?></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#E0E4E9"><strong>ชื่อ - นามสกุล</strong></td>
        <td align="left"><?php echo $row_users['NAME'];?></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#E0E4E9"><strong>รหัสผ่าน</strong></td>
        <td align="left"><?php echo $row_users['PASSWORD'];?></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#E0E4E9"><strong>สถานะ</strong></td>
        <td align="left"><?php echo $row_users['STATUS'];?></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#E0E4E9"><strong>E-mail</strong></td>
        <td align="left"><?php echo $row_users['EMAIL'];?></td>
      </tr>
      <tr>
        <td width="124" align="right" bgcolor="#E0E4E9"><strong>วัน/เดือน/ปี เกิด</strong></td>
        <td width="410" align="left"><?php echo $row_users['BIRTHDATE'];?></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#E0E4E9"><strong>ที่อยู่</strong></td>
        <td align="left"><?php echo $row_users['MGRADR1'];?></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#E0E4E9">&nbsp;</td>
        <td align="left"><?php echo $row_users['MGRADR2'];?></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#E0E4E9">&nbsp;</td>
        <td align="left"><?php echo $row_users['MGRADR3'];?></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#E0E4E9">&nbsp;</td>
        <td align="left"><?php echo $row_users['MGRADR4'];?></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#E0E4E9"><strong>โทรศัพท์ </strong></td>
        <td align="left"><?php echo $row_users['PHONE'];?></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#E0E4E9">&nbsp;</td>
        <td align="left"><?php echo $row_users['MOBILE'];?></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#E0E4E9">&nbsp;</td>
        <td align="left"><input type="button" name="button" id="button" value="Close" onclick="javascript:window.close();"  style="visibility:hidden"/></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>