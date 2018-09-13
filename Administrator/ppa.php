<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>

<?
$t = "25/12/99, 14/5/00";
$t = preg_replace( "|\b(\d+)/(\d+)/(\d+)\b|", "\\2/\\1/\\3", $t );

print "$t<br>";

?>

</body>
</html>