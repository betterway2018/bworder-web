<?php  session_start(); ?>
<?php require("../../i_config.php"); ?>
<?php //require("check_login.php"); ?>
<?php require_once("i_function_msg.php");  ?>
<?php require_once('../../Connections/config.inc.php'); ?>

<?php 

		$sql = "select * from billcode_mispro where camp = concat('$txtyear','$txtcamp')";
		$total = mysql_db_query($DBName,$sql);
		$row_total = mysql_num_rows($total);
		
		echo "TOTAL OF ROW" . $row_total;
		
		if ($row_total != 0 ){
			mysql_close();
			AlertMessage("�բ��������������ͺ���  " . $txtcamp ."/". $txtyear . "  ��������к����Ǥ� �������ö������" ,  "javascript:history.back(1);");
		}
//echo "<br>������������к�������º�������ǹФ�";
//***Start Attachment ***//
/*if (($_FILES["JPGFILE"]["type"] == "image/gif") 
						|| ($_FILES["JPGFILE"]["type"] == "image/pjpeg") 
						|| ($_FILES["JPGFILE"]["type"] == "image/jpg") )*/

if (($_FILES["JPGFILE"]["type"] == "image/gif") 
							|| ($_FILES["JPGFILE"]["type"] == "image/jpg") 
							|| ($_FILES["JPGFILE"]["type"] == "image/jpeg") 
							|| ($_FILES["JPGFILE"]["type"] == "image/pjpeg") 
							|| ($_FILES["JPGFILE"]["type"] == "image/png" ))

  {
	  if ($_FILES["JPGFILE"]["size"] < 3000000) {
			  if ($_FILES["JPGFILE"]["error"] > 0)
				{
				echo "Return Code: " . $_FILES["JPGFILE"]["error"] . "<br>";
				$canupload = false;
				}
			  else
				{
				echo "Upload: " . $_FILES["JPGFILE"]["name"] . "<br>";
				echo "Type: " . $_FILES["JPGFILE"]["type"] . "<br>";
				echo "Size: " . ($_FILES["JPGFILE"]["size"] / 1024) . " Kb<br>";
				echo "Temp file: " . $_FILES["JPGFILE"]["tmp_name"] . "<br>";   
				$filename = "upload/". $_FILES["JPGFILE"]["name"];
				echo $filename."<br>";
				if (file_exists($filename))  {
				  echo $_FILES["JPGFILE"]["name"] . " already exists. ";
				  $canupload = true;
				  
				  //$filename = "upload/". $_FILES["JPGFILE"]["name"];				  
				
					echo "<script type='text/javascript'>if (!confirm('��������������� ��ͧ����Ѿ��Ŵ���')){history.back()}</script>";

				}
				$canupload = true;
				}
	  }
	  else
	  {
		  AlertMessage("���ɤ� ����Թ 300 kb. ���͡�������硡��ҹ��� : file size more than 300 kb. ");
	  }
  }
else
  {
  AlertMessage("��س����͡�����ʡ�� .jpeg ��� .gif ","");
  }
		
		/**/
		echo "". $_POST["txtyear"];
		echo "". $txtcamp = $_POST["txtcamp"];
		echo "". $jpgfile = $_POST["JPGFILE"]["name"];
		echo "". $txtstatus = $_POST["txtStatus"];
		
  //INSERT DATA *********************************HEADER
		$txtcamp = $_POST["txtcamp"];
		$txtyear = $_POST["txtyear"];
		//$jpgfile = $_POST["JPGFILE"]["name"];
		$txtstatus = $_POST["txtStatus"];
		$jpgfile = $_FILES["JPGFILE"]["name"];
		
		$sql = "INSERT INTO promotionheader(CAMP,JPGFILE,Ext_file,STATUS) 
					VALUES (concat('$txtyear','$txtcamp'),'$jpgfile','ext_file','$txtstatus')";
		mysql_db_query($DBName,"SET NAMES 'TIS620'");
		$sqlquery = mysql_db_query($DBName,$sql) or die("�������ö������������ ��سҵ�Ǩ�ͺ�ա����˹�觤�");
		
		if ($canupload ==true){
					  echo "start upload";
					  move_uploaded_file($_FILES["JPGFILE"]["tmp_name"],$filename);
//				  move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" , $_FILES["file"]["name"]);
				  echo "Stored--- in: " . "upload/" . $_FILES["JPGFILE"]["name"];
				 
		}
		echo "�ͺ��˹���: ". $_POST["txtyear"]. "/" . $_POST["txtcamp"];
		echo "</br>";
		echo "�����Թ��� billcode : ". $_POST["txtid"];
		echo "</br>";
		echo "��������´�Թ��� : ". $_POST["txtname"];
		echo "</br>";
		echo "�Ҥ��Թ���  : ". $_POST["txtprice"] . "  �ҷ �ط��";
		
		//$txtcamp = $_POST["txtcamp"];
		//$txtyear = $_POST["txtyear"];
		/*$txtspcflg
		$txtfreeflg
		$txtsubflg*/
		
		For ($i = 1; $i<= 35; $i++) {
			if ($_POST["txtid" . $i] <> "" && $_POST["txtname"  . $i] <>"" ) { 
				
				$txtid = $_POST["txtid" . $i];
				$txtname = $_POST["txtname" . $i];
				$txtprice = $_POST["txtprice" . $i];
				
					$sql = "INSERT INTO billcode_mispro(camp,billcode,billtype,gconly,EFFDTE,EXPDTE,billdesc,price,spcflg,freeflg,subflg) 
					VALUES (concat('$txtyear','$txtcamp'),'$txtid','F','N','0','0','$txtname','$txtprice','$txtspcflg','$txtfreeflg','$txtsubflg')";
					echo $sql."<br />";
				mysql_db_query($DBName,"SET NAMES 'TIS620'");
				$sqlquery = mysql_db_query($DBName,$sql) or die("�������ö������������ ��سҵ�Ǩ�ͺ�ա����˹�觤�".mysql_error());
				
			}
		}
		
		mysql_close();

//echo "<br>������������к�������º�������ǹФ�";
AlertMessage("��������������������к� " . $txtcamp ."/". $txtyear."������º�������Ǥ� �ͺ���$txtcamp"  ,  "promotion.php");
		
		
?>