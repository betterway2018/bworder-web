<table width="100%"  border="0" cellspacing="0" bgcolor="#CCCCCC" valign="middle">
  <tr>
    <td width="172" height="32" align="center" valign="middle"><img src="picpromotion/logoMistine.png" width="306" height="126" /></td>
    <td width="558" valign="middle" style=" color:#d34cb1"><strong>MISTINE BWORDER : Administrator</strong><br />
    <?php echo  $_SERVER['HTTP_HOST']?></td>
    <td width="577" align="right" valign="middle"><table width="446" border="0" cellspacing="0" cellpadding="3" align="center">
      <tr>
        <td width="266" valign="top" >&nbsp;</td>
      </tr>
      <tr>
        <td align="right" valign="top"  style="color:#FFF">
        <?php  if($_SESSION['admin_login']=="1") { ?> 
        ยินดีต้อนรับ, <?php echo $_SESSION['login_name'];?> &nbsp;&nbsp;&nbsp; <a href="logout.php" target="_parent" style="color:#FFFFFF">Log out</a> |
        <?php } ?> <a href="login.php" target="_parent" style="color:#FFF">หน้าหลัก</a></td>
      </tr>
    </table></td>
  </tr>
  </table>
