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
      <table width="800"  border="0" align="center" cellpadding="0" cellspacing="0" style="border:solid #6497D6 1px">
        <tr>
          <td width="806" align="left" style="background-image:url(images/bar_email1_06.png);background-position:top;background-repeat:repeat-x">
          <table width="228" border="0" cellpadding="0" cellspacing="0" >
            <tr>
              <th width="14" align="left" valign="top" style="background-image:url(images/bar_email1_02.png); background-position:top left;background-repeat:repeat-x; width:9px"><img src="images/bar_email1_02.png" width="9" height="25" /></th>
              <td width="186" align="left" nowrap="nowrap" class="content_header" style="background-image:url(images/bar_email1_02.png); background-position:top left;background-repeat:repeat-x;">News &amp; Events  ...</td>
              <td width="28" align="right" valign="top" style="background-image:url(images/bar_email1_02.png); background-position:top left;background-repeat:repeat-x; width:28px"><img src="images/bar_email1_04.png" width="28" height="25" /></td>
              </tr>
          </table></td>
        </tr>
        <tr>
          <td height="100%" bgcolor="#F1F3F5"><br />
            <br /></td>
        </tr>
      </table>
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