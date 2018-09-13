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
    <td width="848" height="558" align="left" valign="top" bgcolor="#FFFFFF" style="padding:5px"><?php include("i_top_menu.php"); ?>
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