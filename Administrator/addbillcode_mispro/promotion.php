<?php  session_start(); 
		require("../../i_config.php"); 
		//require("check_login.php"); 
		require_once("i_function_msg.php");  
		require_once('../../Connections/config.inc.php'); 
			
	
		
		$txtcamp = $_POST["txtcamp"];
		$txtyear = $_POST["txtyear"];
		$jpgfile = $_POST["JPGFILE"];
		$txtstatus = $_POST["txtStatus"];
		$jpgfile = $_FILES["JPGFILE"]["name"];
		
	$sqlH ="Select  * From  Promotionheader  Order by Camp DESC";
	$rsH = mysql_db_query($DBName,$sqlH) or die("ไม่สามารถติดต่อฐานข้อมูลได้ Promotionheader กรุณาตรวจสอบอีกครั้งหนึ่งคะ");

	
		//$sqlA = "Select * From Promotionheader H inner join billcode_mispro D on H.camp = D.camp ORDER BY H.camp";
		//$rsA = mysql_db_query($DBName,$sqlA) or die("ไม่สามารถติดต่อฐานข้อมูลได้ billcode_mispro กรุณาตรวจสอบอีกครั้งหนึ่งคะ");
		
		
		//$row_dataD = mysql_fetch_assoc($rsD);

	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>เพิ่มข้อมูล โปรโมทชั่น</title>
<style type="text/css">
<!--
.aa {
	color: #F90;
}
body {
	font-size:14px;
}
-->
</style>
</head>
<body>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FEEDFE"><p><strong><br />
      เพิ่มข้อมูลโปรโมชั่น <br />
      <br />
    </strong></p></td>
  </tr>
  <tr>
    <td><input type="button" name="button" id="button" value="เพิ่มโปรโมชั่น"   onclick="window.location ='promotion_new.php'"/></td>
  </tr>
  <tr>
    <td align="center"><fieldset>
      <table width="100%" border="0" cellspacing="1" cellpadding="1">
        <tr>
          <td >รูปภาพ</td>
          <td align="center">รายละเอียด</td>
        </tr>
        		<?php 
				
				$oldindex = "";
				
				while ($row_dataH = mysql_fetch_assoc($rsH))
				{
				?>
        <tr>
          
          <?php //if ($oldindex != $row_dataA["CAMP"]) { ?>
						<td  bgcolor="#FFDDEE" valign="top">
                        <?php echo "<img src='"."upload/". $row_dataH ['JPGFILE'] ."' style = \"width:250px; height:350px; border:10px;\" />"; ?>
						</td>
          <td align="left" valign="top" bgcolor="#FFDDEE"><table width="100%" border="0" cellspacing="1" cellpadding="1">
            <tr >
              <td colspan="2" rowspan="3" align="left"  bgcolor="#FEEDFE">รอบจำหน่าย : <?php echo substr($row_dataH["CAMP"],0,4) ."/".substr($row_dataH["CAMP"],4,2);  ?><br />
                สถานะ : <?php echo $row_dataH['STATUS'] ; ?></td>
              <td align="right" valign="bottom"  bgcolor="#FEEDFE">
              <a href="promotion_edit.php?CAMP=<?php echo $row_dataH['CAMP']; ?>"><img src="picpromotion/add_or_remove_programs.png" width="25" height="25" border="0"/>Edit to Campaing</a></td>
            </tr>
            <tr >
              <td align="right" bgcolor="#FEEDFE"><a href="promotion_delete.php?CAMP=<?php echo  $row_dataH['CAMP']; ?>"><img src="picpromotion/recycle_bin_full.png" width="25" height="25" border="0"/>Delete to Campaing</a></td>
            </tr>
            <tr >
              <td align="right" valign="middle" bgcolor="#FEEDFE"><!--<a href="promotion_copy.php?CAMP=<?php //echo  $row_dataH['CAMP']; ?>"><img src="picpromotion/regional_and_language_settings.png" width="30" height="30" border="0" /></a><a href="promotion_copy.php?CAMP=<?php //echo  $row_dataH['CAMP']; ?>"> Copy to Campaign</a>--></td>
            </tr>

            <tr >
              <td width="14%" bgcolor="#FF6699">รหัสสินค้า..</td>
              <td width="72%" bgcolor="#FF6699">ชื่อสินค้า / รายละเอียด</td>
              <td width="14%" bgcolor="#FF6699"> ราคา</td>
            </tr>
                        
                        
					<?php	
					$sqlD = "Select * From billcode_mispro where CAMP = '".$row_dataH["CAMP"]."' order by billcode asc";
					$rsD = mysql_db_query($DBName,$sqlD) or die("ไม่สามารถติดต่อฐานข้อมูลได้ billcode_mispro กรุณาตรวจสอบอีกครั้งหนึ่งคะ");
					
					
					while ($row_dataD = mysql_fetch_assoc($rsD)) 
					{?>
            
            <tr>
              <td nowrap="nowrap"><?php echo  $row_dataD["BILLCODE"];?></td>
              <td><?php echo $row_dataD["BILLDESC"];?></td>
              <td><?php echo $row_dataD["PRICE"];?></td>
            </tr>
            <?php } ?>

        
          </table>
            <br /></td> <?php	//}?>
        </tr>
        
      <?php } ?>
      </table>
    </fieldset></td>
  </tr>
</table>
</body>
</html>