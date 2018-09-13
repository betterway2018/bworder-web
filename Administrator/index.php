<?php session_start();?>
<?php  require("check_login.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BWC ORDER SYSTEM : ADMINISTRATOR <?php  echo $_SESSION['login_name'];?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />

</head>
<frameset rows="130,*" cols="*" framespacing="0" frameborder="no" border="0">
  <frame src="frame_header.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
  <frame src="home.php" name="mainFrame" id="mainFrame" title="mainFrame" />
</frameset>
<noframes><body>
</body></noframes>
</html>
