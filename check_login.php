<?php
$chk_login=$_SESSION['login'];
if($chk_login!=1) {
	//	header("Location: login.php");
	echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
	exit;
}

	$dist=$_SESSION['dist'];
	$mslno=$_SESSION['mslno'];
	$chkdgt=$_SESSION['chkdgt'];

	if ($dist=="" || $mslno=="" || $chkdgt=="") {
		echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
		exit;
	}
	
?>