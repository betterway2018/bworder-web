<body onLoad="MM_preloadImages('images/images/a02.gif','images/images/b02.gif','images/images/c02.gif','images/images/g02.gif','images/images/e02.gif','images/images/h02.gif','images/images/d01.gif','images/images/i02.gif')"><table width="100%" border="0" cellspacing="0" cellpadding="0" style="background-image:url(images/h_bg.gif);background-position:top;background-repeat:repeat-x;height:150px">
  <tr>
    <td width="348" align="left" valign="top"><img src="image_head/BWorder_web_02.gif" width="340" height="117" longdesc="http://www.bworder.com" /></td>
    <td width="290" height="127" align="center" valign="middle"><a href="http://www.mistine.co.th" target="_blank"><img src="image_head/cutting_web_02.gif" width="169" height="91" border="0"></a></td>
    <td width="186" align="center" valign="middle"><a href="http://www.friday.co.th" target="_blank"><img src="image_head/cutting_web_03.gif" width="169" height="91" border="0"></a></td>
    <td width="189" align="center" valign="middle"><a href="http://www.faris.co.th" target="_blank"><img src="image_head/cutting_web_04.gif" width="169" height="91" border="0"></a></td>
  </tr>
  <tr>
    <td height="23" colspan="4" align="left" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="317" height="23" valign="middle">&nbsp;</td>
        <td width="262" valign="middle"><span style=" padding-right:3px"><a href="index.php" target="_parent"></a></span></td>
        <td width="361" align="right" valign="middle"><span style=" padding-right:3px">&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php" target="_parent">หน้าหลัก</a>&nbsp;|&nbsp;
            <?php   if ($_SESSION["login"]==1 ) { 
		        			echo "<a href='logout.php' target='_parent'>ออกจากระบบ</a>";
		?>
            <!--           <a href="logout.php" target="_parent"><img src="images/mnu_logout.gif" width="110" height="20" border="0" /></a>-->
            <?php } else { ?>
            <a href="login.php" target="_parent">ล็อกอิน ...</a>
            <?php } ?>
        </span></td>
      </tr>
      <tr valign="top" bgcolor="#FFDFEF">
        <td height="23" colspan="3" align="center" valign="middle"><?php require("i_title.php"); ?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="4" align="center" valign="top" style="padding:2px"><a href="index.php" target="_parent"><font size="3" color="#990000"><b><br>
<?php
 if ($_SESSION['login']==1) {
	echo "";
	//printf("ยินดีต้อนรับคุณ %s   รหัสสมาชิก %s-%s-%s ",$_SESSION['name'],$_SESSION['dist'],$_SESSION['mslno'],$_SESSION['chkdgt'] ); 
	//printf("<br>เข้าสู่ระบบสั่งซื้อสินค้าที่สะดวกสบาย ของเบทเตอร์เวย์ ตลอด 24 ชม.") ;
  } 
  ?></b></font>
</a></td>
  </tr>
<?php 
//$pos = strpos($_SERVER['REQUEST_URI'],"login.php");

				if ( strpos($_SERVER['REQUEST_URI'],"login.php")==false &&  strpos($_SERVER['REQUEST_URI'],"index.php")==false && $_SESSION['login']==1)  {
							?>
  <tr>
    <td colspan="4" align="left" valign="top" style="padding:2px"><?php require("i_menu.php"); ?></td>
  </tr>
				<?php } ?>  
  
</table>








