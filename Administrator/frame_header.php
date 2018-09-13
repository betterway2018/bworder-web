<?php session_start();?>
<?php  require("check_login.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>BWC ORDERS :Administrator (สำหรับผู้ดูแลระบบเท่านั้น)</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%"  border="0" cellspacing="0" cellpadding="0" 
style="background-image:url(images/bg_images.jpg);background-repeat:repeat-x;background-position:top; height:54px">
  <tr>
    <td width="186" height="100" align="center" ><img src="images/logo_360.png" width="172" height="83" /></td>
    <td width="570" valign="middle" style="color:#2E2E2E; font-size: 14px;"><strong>BWC INTERNET ORDER SYSTEM</strong><br />
    <?php echo  $_SERVER['HTTP_HOST']?></td>
    <td width="571" align="right" valign="bottom"><table width="446" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td width="266"></td>
      </tr>
      </table>
      <table>
      <tr>
        <td align="right" valign="middle"  style="color:#2E2E2E">
        <?php  if($_SESSION['admin_login']=="1") { ?> 
        ยินดีต้อนรับ, <?php echo $_SESSION['login_name'];?> &nbsp;&nbsp;&nbsp; <a href="logout.php" target="_parent" style="color:#ec008c">Log out</a> |
        <?php } ?> <a href="home.php" target="mainFrame" style="color:#ec008c">หน้าหลัก</a></td>
        <td>&nbsp;</td>
      </tr>
    </table></td></tr>
</table>
<?php include("i_top_menu.php"); ?>
<hr  style="margin-top:0px"/>

</body>
</html>
