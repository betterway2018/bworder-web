<?php session_start();?>
<?php  require("check_login.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>สำหรับ admin : มิสทิน คะ</title>
</head>
<frameset rows="1,88,*,50" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="UntitledFrame-2">
  <frame src="header.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
  <frameset rows="*" cols="226,*" framespacing="0" frameborder="no" border="0">
    <frame src="menu.asp" name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" title="leftFrame" />
    <frame src="Administrator/data_register.asp" name="mainFrame" id="mainFrame" title="mainFrame" />
  </frameset>
  <frame src="footer.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame"  marginheight="0"/>
  
</frameset>
<noframes><body>
</body></noframes>
</html>
