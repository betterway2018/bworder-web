<?php  

		session_start(); 
		require("../../i_config.php"); 
		//require("check_login.php"); 
		require_once("i_function_msg.php");  
		require_once('../../Connections/config.inc.php'); 
			
		$row_id = $_POST['txtidH'];
		$txtcamp = $_POST["txtcamp"];
		$txtyear = $_POST["txtyear"];
		$jpgfile = $_POST["JPGFILE"];
		$txtstatus = $_POST["txtStatus"];
		$jpgfile = $_FILES["JPGFILE"]["name"];
		
		$camp = $_GET['CAMP'];
		
		 
		
	$sqlH ="Delete From promotionheader Where Camp = '$camp'";
	$rsH = mysql_db_query($DBName,$sqlH) or die("�������ö�Դ��Ͱҹ�������� Promotionheader ��سҵ�Ǩ�ͺ�ա����˹�觤�");
	//$row_dataH = mysql_fetch_assoc($rsH);

	$sqlD = "Delete From billcode_mispro Where Camp = '$camp' ";
	$rsD = mysql_db_query($DBName,$sqlD) or die("�������ö�Դ��Ͱҹ�������� billcode_mispro ��سҵ�Ǩ�ͺ�ա����˹�觤�");

		AlertMessage("�س��ӡ��ź�������ͺ��˹��·��  " . $camp , "promotion.php");
		
		//echo "header". $sqlH;
		//echo "detail". $sqlD;
					
		//header("Location: promotion.php"); /* Redirect browser */

		
		?>
