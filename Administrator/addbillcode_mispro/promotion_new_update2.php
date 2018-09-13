<?php  session_start(); 
		require("../../i_config.php"); 
		//require("check_login.php"); 
		require_once("i_function_msg.php");  
		require_once('../../Connections/config.inc.php'); 
			
		$row_id = $_POST['txtidH'];
		
		$txtcamp = $_POST["txtcamp"];
		$txtyear = $_POST["txtyear"];
		$txtstatus = $_POST["txtStatus"];
		$jpgfile = $_FILES["JPGFILE"]["name"];

				echo "year = ". $txtyear."<br>";
				echo "camp = ". $txtcamp."<br>";
				echo "filename = ". $jpgfile."<br>";
				echo "status = ". $txtstatus."<br>";
				echo "Head row_id = ". $row_id."<br>";

		$sqlH ="Select  * From  Promotionheader  Order by Camp DESC";
		$rsH = mysql_db_query($DBName,$sqlH) or die("ไม่สามารถติดต่อฐานข้อมูลได้ Promotionheader กรุณาตรวจสอบอีกครั้งหนึ่งคะ");

	
		//$sqlA = "Select * From Promotionheader H inner join billcode_mispro D on H.camp = D.camp ORDER BY H.camp";
		//$rsA = mysql_db_query($DBName,$sqlA) or die("ไม่สามารถติดต่อฐานข้อมูลได้ billcode_mispro กรุณาตรวจสอบอีกครั้งหนึ่งคะ");
		
		
		//$row_dataD = mysql_fetch_assoc($rsD);
		
		//***Start Attachment ***//
  if ( $jpgfile <> '') {
	//if (($_FILES["JPGFILE"]["type"] == "image/gif") || ($_FILES["JPGFILE"]["type"] == "image/pjpeg") || ($_FILES["JPGFILE"]["type"] == "image/jpg"))
	if (($_FILES["JPGFILE"]["type"] == "image/gif") 
							|| ($_FILES["JPGFILE"]["type"] == "image/jpg") 
							|| ($_FILES["JPGFILE"]["type"] == "image/jpeg") 
							|| ($_FILES["JPGFILE"]["type"] == "image/pjpeg") 
							|| ($_FILES["JPGFILE"]["type"] == "image/png" ))
  {
	  if ($_FILES["JPGFILE"]["size"] < 3000000) {
			  if ($_FILES["file"]["error"] > 0)
				{
				echo "Return Code: " . $_FILES["JPGFILE"]["error"] . "<br>";
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
				}
				else
				  {
					  echo "start upload";
					  move_uploaded_file($_FILES["JPGFILE"]["tmp_name"],$filename);
//				  move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" , $_FILES["file"]["name"]);
				  echo "Stored--- in: " . "upload/" . $_FILES["JPGFILE"]["name"];
				  }
				}
	  }
	  else
	  {
		  AlertMessage("ขอโทษคะ ไฟล์เกิน 300 kb. เลือกไฟล์ที่เล็กกว่านี้คะ : file size more than 300 kb. ","");
	  }
  }
else
  {
  AlertMessage("กรุณาเลือกไฟล์นามสกุล .jpeg และ .gif ","");
  }
}
  
/*----------------------------------------------------------------		
		$havefile  = '';
		if ( $jpgfile <> '') {
		$havefile = " , JPGFILE = '$jpgfile'"; }
		
		$sql = "UPDATE promotionheader SET STATUS = '$txtstatus' $havefile  WHERE ROW_ID  = ".$row_id;
		$sqlquery = mysql_db_query($DBName,$sql) or die("ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบอีกครั้งหนึ่งคะ  " . $sql);
------------------------------------------------------------------*/
		if ( $jpgfile <> '') {
			$sql = "UPDATE promotionheader SET STATUS = '$txtstatus' , JPGFILE = '$jpgfile'  WHERE ROW_ID  = ".$row_id;
		}
		else {
			$sql = "UPDATE promotionheader SET STATUS = '$txtstatus'  WHERE ROW_ID  = ".$row_id;
		}
		echo "<br>------------------------------------------------------------------<br>query update head = <br>".$sql."<br>------------------------------------------------------------------<br><br>";
		$sqlquery = mysql_db_query($DBName,$sql) or die("ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบอีกครั้งหนึ่งคะ  " . $sql);

				For ($i = 1; $i<= 35; $i++) {
				
				                  
				$rowid = $_POST["rowid".$i];
				$txtid = $_POST["txtid".$i];
				$txtname = $_POST["txtname".$i];
				$txtprice = $_POST["txtprice".$i];
				
				if ($rowid <> '') {
					//echo '<br>'.$rowid.$txtid.'...'.$txtname.'^^'.$txtprice.'___';
					if ($txtid <> '' && $txtname <>'' && $txtprice<> '') {
						$sql = "UPDATE billcode_mispro SET BILLCODE = '$txtid' , BILLDESC = '$txtname' , PRICE = '$txtprice'  WHERE ROW_ID  = " . $rowid;
						$sqlquery = mysql_db_query($DBName,$sql) or die("ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบอีกครั้งหนึ่งคะ  " . $sql.mysql_error());
					}
					else if ($txtid == '' && $txtname =='' && $txtprice== '') {
						$sql = "Delete From billcode_mispro Where ROW_ID  = " . $rowid;
						$rsD = mysql_db_query($DBName,$sql) or die("ไม่สามารถติดต่อฐานข้อมูลได้ billcode_mispro กรุณาตรวจสอบอีกครั้งหนึ่งคะ");
						
					}
				//เช็คเงื่อนไขในการ delete
				
				
				echo "<br>". $sql;
				}
				else if ($txtid <> '' && $txtname <>'' && $txtprice<> '') {
					$txtcamp = $_POST["txtcamp"];
					$txtyear = $_POST["txtyear"];
					$txtfreeflg = "A";
                    $txtsubflg = "A";
                    $txtspcflg ="N";
					$sql = "INSERT INTO billcode_mispro(camp,billcode,billtype,gconly,billdesc,price,spcflg,freeflg,subflg) 
					VALUES (concat('$txtyear','$txtcamp'),'$txtid','F','N','$txtname','$txtprice','$txtspcflg','$txtfreeflg','$txtsubflg')";
					$sqlquery = mysql_db_query($DBName,$sql) or die("ไม่สามารถเพิ่มข้อมูลได้ กรุณาตรวจสอบอีกครั้งหนึ่งคะ".mysql_error());

					//echo "<br>COMMAND --". $sql;;
				}
			}
			
		
		mysql_close();
		AlertMessage("บันทึกข้อมูลในระบบให้เรียบร้อยแล้วนะคะ" . $camp , "promotion.php");

	?>










