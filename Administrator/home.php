<?php session_start();

    $div_code=$_SESSION['div_code'];
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>BWC ORDERS :Administrator (����Ѻ�������к���ҹ��) <?php  echo $_SESSION['login_name'];?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="693" border="0" align="center" cellpadding="12" cellspacing="4">
  <tr>
    <td height="76" align="center"><a href="data_mailplan.php" target="mainFrame"><img src="images/11.gif" width="227" height="151" border="0" /><br />
���ҧ Mail Plan</a></td>
    <td align="center"><a href="data_campaign.php" target="mainFrame"><img src="images/22.gif" width="227" height="151" border="0" /><br />
�������ͺ��˹���</a></td>
    <td align="center"><a href="data_order.php" target="mainFrame"><img src="images/33.gif" width="227" height="151" border="0" /><br />
    �����š����觫��ͧ͢��Ҫԡ</a></td>
  </tr>
  <tr>
    <td height="76" align="center"><a href="data_mslmst.php" target="mainFrame"><img src="images/44.gif" width="227" height="151" border="0" /><br />
��������Ҫԡ mslmst </a></td>
    <td align="center"><a href="data_contactus2.php" target="mainFrame"><img src="images/55.gif" width="227" height="151" border="0" /><br />
�ͺ�Ӷ����лѭ�Ҽ�ҹ����� (Contact us) </a></td>
    <td align="center"><a href="data_order_cc.php" target="mainFrame"><img src="images/333.gif" width="227" height="151" border="0" /><br />
    �����š����觫��ͧ͢��Ҫԡ ���ͺ</a></td>
  </tr>
  <tr>
    <td height="76" align="center"><a href="demo.php" target="mainFrame"><img src="images/55.png" width="264" height="151" border="0" /></a><a href="demo.php" target="mainFrame"><br />
Update Banner ��˹�� DEMO+PLUSPLAN</a></td>
    <td align="center"><a href="http://bworder.com/plesk-stat/webstat/" target="mainFrame"><img src="images/66.png" width="264" height="151" border="0" /><br />
      <span id="spanid-web-stats">Web Statistics</span></a>&nbsp;</td>
<?
  if($div_code=="1")
  {
?>
    <td align="center"><a href="delete_webbord.php" target="mainFrame"><img src="images/delete_webbord.jpg" width="176" height="120" border="0" /><br />
ź�Ӷ����лѭ�Ҽ�ҹ����� (Contact us) </a></td>
<?
}
?>
  </tr>
  <!--<tr>
    <td width="208" height="76" align="center"><a href="dsm.php" target="mainFrame"><img src="images/kuser.png" width="48" height="48" border="0" /><br />
��������Ҫԡ mslmst (�ѧ�����)</a></td>
     <td width="214" align="center"><a href="division_profile.php" target="mainFrame"><img src="images/kgpg_identity.png" width="48" height="48" border="0" /><br />
Division Profile</a></td>
   <td width="211" align="center"><a href="news.php" target="mainFrame"><img src="images/folder_window.png" width="48" height="48" border="0" /><br />
���ǻ�Ъ�����ѹ��</a></td>
  </tr>-->
  
   <tr>
    <td height="76" align="center"><a href="Summary_webbord.php" target="mainFrame"><img src="images/sum.png" width="103" height="103" border="0" /><br />
      ��ػ�ӹǹ��¡�����Ǵ����ҡ��з��
    </a></td>
</tr>
</table>
<br />
<p>
  <?php include("i_footer.php"); ?>
</p>
</body>
</html>