<?php 


session_start(); 
//require_once('check_login.php');
require_once('../include/i_config.php'); 
require_once('../Connections/bwc_content.php');
mysql_select_db($database_bwc_content,$bwc_content);
mysql_query("SET NAMES 'utf8'");

$id = $_GET["id"]; 
$query=" DELETE FROM content_data WHERE id = ".$id;
$content_data = mysql_query($query, $bwc_content) or die(mysql_error());
echo '<script> window.location.replace("index.php");</script>';

?>