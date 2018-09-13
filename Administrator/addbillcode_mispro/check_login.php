<?php 
if($_SESSION['admin_login']!="1") {
	//header("Location:login.php");
	echo "<meta http-equiv='refresh' content='0;URL=login.php' />";

}

?>