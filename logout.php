<?php //logout.php
session_start();
require_once('Connections/bwc_log.php');
insert_log($_SESSION["dist"],$_SESSION["mslno"],$_SESSION["chkdgt"],"Logout","Logout  to system"); ////insert log

//session_destroy(); //ล้าง session ทุกตัว
$_SESSION["login"]="";
$_SESSION["name"]="";
$_SESSION["dist"]="";
$_SESSION["mslno"]="";
$_SESSION["chkdgt"]="";
$_SESSION["email"]="";
$_SESSION["phone"]="";
$_SESSION["CurCamp"]="";
session_unset(); 
session_destroy();



header( 'Location: login.php') ;
//echo "<meta http-equiv='refresh' content='0;URL=login.php'>";

exit;
?>