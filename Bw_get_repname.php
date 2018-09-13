<?php
session_start();
require_once('include/i_config.php'); 

require_once('nusoap.php'); 
$ws_client = new soapclient($url_webservice.'get_repinfo.php?wsdl',true);
$mslno=$_GET['mslno'];
$mslno_01=str_pad($mslno,5, "0", STR_PAD_LEFT);
//echo $mslno_01; exit;
$rep_code = $_GET['dist'].$mslno_01.$_GET['chkdgt'];
repinfo($rep_code,$ws_client);

function repinfo($rep_code,$ws_client) {
	$pageno = $_POST['curpage'];
	$totalrow = '';
	$param = array('rep_code' => $rep_code);
	$result = $ws_client->call('repinfo', $param); 
	echo $result;
}
?>