<?php 
session_start();
include("../i_function_msg.php");

if (isset($_GET['id']) && $_GET['id']!="") {
	
	require("../Connections/dsm_orders.php");
	
	$dist = $_GET['id'];
	

	mysql_select_db($database_dsm_orders,$dsm_orders);
	$query ="UPDATE users SET  STATUS = 'Active'";
	$query.=" WHERE  DISTRICT ='$dist'";
	$update= mysql_query($query, $dsm_orders) or die(mysql_error());
	
	if ($update) {
		AlertMessage("�Դ�����ҹ�ͧ���ʼ��Ѵ��û�Ш�ࢵ ".$dist . "  ���º�������Ǥ��","dsm.php");
		exit;
	}
	else
	{
		AlertMessage("�������ö�ѹ�֡�������� ".mysql_error(),"javascript:history.back(1);");
		exit;
	}
		
	
	
	
}
else {
	echo"<meta http-equiv='refresh' content='0;URL=dsm.php'>";		
}
?>

