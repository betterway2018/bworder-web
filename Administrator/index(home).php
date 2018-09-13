<?php session_start();?>
<?php  require("check_login.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>DSM INTERORDER SYSTEM : <?php  echo $_SESSION['login_name'];?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0" class="FormBorder" >
  <tr>
    <td height="33" colspan="2"><?php include("i_header.php"); ?></td>
  </tr>
  <tr>
    <td width="133"  rowspan="2" align="left" valign="top" class="left_menu" ><?php include("i_left_menu.php"); ?></td>
    <td width="848" height="558" align="left" valign="top" bgcolor="#FFFFFF" style="padding:5px"><br />
    
<br />
    <table width="732" border="0" align="center" cellpadding="6" cellspacing="6">
      <tr>
        <td width="214" height="102" align="center"><a href="data_order.php" target="_parent"><img src="images/document_text.png" width="48" height="48" border="0" /><br />
          รายการสั่งซื้อของผู้จัดการเขต</a></td>
        <td width="138" align="center"><a href="data_campaign.php" target="_parent"><img src="images/address_book2.png" width="48" height="48" border="0" /><br />
          ข้อมูลรอบจำหน่าย</a></td>
        <td width="132" align="center"><a href="data_mailplan.php" target="_parent"><img src="images/file_temporary.png" width="48" height="48" border="0" /><br />
          ตาราง Mail Plan</a></td>
        <td width="170" align="center">&nbsp;</td>
      </tr>
      <tr>
        <td height="124" align="center"><a href="dsm.php" target="_parent"><img src="images/kuser.png" width="48" height="48" border="0" /><br />
          ข้อมูลผู้จัดการเขต</a></td>
        <td align="center"><a href="division_profile.php" target="_parent"><img src="images/kgpg_identity.png" width="48" height="48" border="0" /><br />
          Division Profile</a></td>
        <td align="center"><a href="news.php" target="_parent"><img src="images/folder_window.png" width="48" height="48" border="0" /><br />
          ข่าวประชาสัมพันธ์</a></td>
        <td align="center"><a href="msm_msg.php" target="_parent"><img src="images/inbox_2.png" width="48" height="48" border="0" /><br />
          ข้อความถึงผู้จัดการเขต</a></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="32" bgcolor="#FFFFFF"><?php include("i_footer.php"); ?></td>
  </tr>
</table>
</body>
</html>