<?php
session_start();
require_once('include/i_config.php'); 

require_once('nusoap.php'); 
$ws_client = new soapclient($url_webservice.'bwc_order_detail_history.php?wsdl',true); 

$rep_seq = $_GET['rep_seq'];
$sale_campaign = $_GET['sale_campaign'];
$bill_seq = $_GET['bill_seq'];
$trans_no = $_GET['trans_no'];

order_detail($rep_seq,$sale_campaign,$bill_seq,$trans_no,$ws_client);

function order_detail($rep_seq,$sale_campaign,$bill_seq,$trans_no,$ws_client) {
	$param = array('rep_seq' => $rep_seq,'sale_campaign' => $sale_campaign,'bill_seq' => $bill_seq,'trans_no' => $trans_no);
	$result = $ws_client->call('order_detail', $param); 
	echo $result;
}
?>