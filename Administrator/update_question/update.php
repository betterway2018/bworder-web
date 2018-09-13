<?php 


session_start(); 
//require_once('check_login.php');
require_once('../include/i_config.php'); 
require_once('../Connections/bwc_content.php');
mysql_select_db($database_bwc_content,$bwc_content);
mysql_query("SET NAMES 'utf8'");

 $id = $_POST["id"]; 
$SUBJECT = $_POST["SUBJECT"];
$editor1 = $_POST["editor1"];
$SEQ_NO = $_POST["SEQ_NO"];

if($id!=""){
$query=" UPDATE content_data SET SEQ_NO = '". $SEQ_NO."', SUBJECT = '". $SUBJECT."', DETAIL = '". $editor1."' WHERE id =".$id;
$content_data = mysql_query($query, $bwc_content) or die(mysql_error());
}else{
	$datep=date("Ymd");
	$datet=date("His");
	$query="
INSERT INTO content_data (SUBJECT, DETAIL, GROUP_ID, STATUS , POST_DATE , POST_TIME , POST_BY , EXP_DATE , SEQ_NO )
VALUES ('".$SUBJECT."', '".$editor1."', 1 , 0 ,'".$datep."' ,'".$datet."' , 'Administrator' , 0 , '".$SEQ_NO."');";

	$content_data = mysql_query($query, $bwc_content) or die(mysql_error());	
}
echo '<script> alert("บันทึกข้อมูลสำเร็จ"); window.location.replace("index.php");</script>';

?>