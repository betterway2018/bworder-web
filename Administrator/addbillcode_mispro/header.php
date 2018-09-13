<?php session_start();?>
<?php  require("check_login.php"); ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-top:auto">
  <tr style="background-image:url(bar4.gif);background-position:left;background-repeat:repeat-x;height:96">
    <td width="1%" height="92">&nbsp;</td>
    <td width="42%">สำหรับผู้ดูแลมิสทิน v.1</td>
    <td width="50%" align="right" valign="middle"  style="color:#2E2E2E">
        <?php  if($_SESSION['admin_login']=="1") { ?> 
        ยินดีต้อนรับ, <?php echo $_SESSION['login_name'];?> &nbsp;&nbsp;&nbsp; <a href="logout.php" target="_parent" style="color:#ec008c">Log out</a> 
        <?php } ?> <!--<a href="login.php" target="mainFrame" style="color:#ec008c">หน้าหลัก</a>--></td>
    <td><img src="Mistine_Logo.gif" width="142" height="91" /></td>
  </tr>
</table>
