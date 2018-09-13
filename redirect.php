<?php  session_start(); ?>
<?php
	$website_name = $_GET['website'];
	switch ($website_name){
		case "mistine" :
						$website="1";
						break;
		case "friday":
						$website="2";
						break;
		case "faris":
						$website="3";
						break;
		default:
						$website="0";
	}
	session_register("website");
	$_SESSION['website']=$website;
	//echo $_SESSION['website'];
	echo"<meta http-equiv='refresh' content='0;URL=login.php'>";		
?>
