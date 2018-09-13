<table width="100%"  border="0" cellspacing="0" cellpadding="0" 
style="background-image:url(images/bar1_54.gif);background-repeat:repeat-x;background-position:top; height:54px">
  <tr>
    <td width="172" height="32" align="center" valign="middle"><img src="images/logo_360.png" width="172" height="83" /></td>
    <td width="558" valign="middle" style=" color:#d34cb1"><strong>BWORDER : INTERNET ORDER SYSTEM</strong><br />
    <?php echo  $_SERVER['HTTP_HOST']?></td>
    <td width="577" align="right" valign="bottom"><table width="446" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td width="266">&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="middle"  style="color:#FFF">
        <?php  if($_SESSION['admin_login']=="1") { ?> 
        ยินดีต้อนรับ, <?php echo $_SESSION['login_name'];?> &nbsp;&nbsp;&nbsp; <a href="logout.php" target="_parent" style="color:#FFFFFF">Log out</a> |
        <?php } ?> <a href="index.php" target="_parent" style="color:#FFF">หน้าหลัก</a></td>
      </tr>
    </table></td>
  </tr>
  </table>
