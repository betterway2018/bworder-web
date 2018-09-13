<?php  session_start(); 
		require("../../i_config.php"); 
		//require("check_login.php"); 
		require_once("i_function_msg.php");  
		require_once('../../Connections/config.inc.php'); 
		
		$camp = $_GET['CAMP'];
		
	$sqlH ="Select  * From promotionheader Where Camp = '$camp'";
	$rsH = mysql_db_query($DBName,$sqlH) or die("ไม่สามารถติดต่อฐานข้อมูลได้ Promotionheader กรุณาตรวจสอบอีกครั้งหนึ่งคะ");
	$row_dataH = mysql_fetch_assoc($rsH);

	$sqlD = "Select * From billcode_mispro where CAMP = '$camp' ";
	$rsD = mysql_db_query($DBName,$sqlD) or die("ไม่สามารถติดต่อฐานข้อมูลได้ billcode_mispro กรุณาตรวจสอบอีกครั้งหนึ่งคะ");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<body>
<form action="promotion_new_update2.php" method="post" enctype="multipart/form-data" name="form1" id="form1" >
  <table width="643" height="140" border="1" align="center" bgcolor="#FFE6FB">
    <tr >
      <td colspan="4" align="center" style="border-bottom:dotted #C8C8C8 1px;border-top:dotted #C8C8C8 1px">แก้ไข เพิ่มเติม ข้อมูล Promotion</td>
    </tr>
    <tr >
    <td colspan="4" style="border-bottom:dotted #C8C8C8 1px;border-top:dotted #C8C8C8 1px">รอบจำหน่าย
      <input name="txtyear1" type="text" id="txtyear1" size="4" maxlength="4"  readonly="readonly" value = <?php echo substr($row_dataH["CAMP"],0,4);  ?> />
      /
      <input name="txtcamp1" type="text" id="txtcamp1" size="2" maxlength="2"  readonly="readonly" value = <?php echo substr($row_dataH["CAMP"],4,2);  ?> />
       <input name="txtyear" type="hidden" id="txtyear" size="4" maxlength="4" value = <?php echo substr($row_dataH["CAMP"],0,4);  ?> />
          <input name="txtcamp" type="hidden" id="txtcamp" size="2" maxlength="2" value = <?php echo substr($row_dataH["CAMP"],4,2);  ?> />
      </td>
    </tr>
  <tr >
    <td colspan="4" style="border-bottom:dotted #C8C8C8 1px;border-top:dotted #C8C8C8 1px">สถานะ :
      <select name="txtStatus" id="txtStatus">
        <option value="Active">Active</option>
        <option value="Closed">Closed</option>
      </select>
      <input type="hidden" name="txtidH"  id="txtidH" size="10" maxlength="10" value="<?php echo $row_dataH["ROW_ID"]; ?>" />
      <br /></td>
    </tr>
  <tr >
                    <td width="13%" align="center" style="border-bottom:dotted #C8C8C8 1px;border-top:dotted #C8C8C8 1px">ลำดับที่</td>
                    <td width="9%" align="left"  style="border-bottom:dotted #C8C8C8 1px;border-top:dotted #C8C8C8 1px">รหัสสินค้า</td>
                    <td width="50%" align="left"  style="border-bottom:dotted #C8C8C8 1px;border-top:dotted #C8C8C8 1px">ชื่อสินค้า / รายละเอียด</td>
                    <td width="9%" align="left"  style="border-bottom:dotted #C8C8C8 1px;border-top:dotted #C8C8C8 1px"> ราคา</td>
    </tr>
                  <?php
			
				For ($i = 1; $i<= 35; $i++) {
					$row_dataD = mysql_fetch_assoc($rsD);
				?>
				                  <tr>
                    <td align="center"><?php echo $i; ?></td>
                    <td align="left"><input type="text" name="txtid<?php echo $i; ?>" id ="txtid<?php echo $i; ?>" size="10" maxlength="5"  value="<?php echo $row_dataD["BILLCODE"]; ?>" /></td>
                    <td align="left"><input type="text" name="txtname<?php echo $i; ?>" id="txtname<?php echo $i; ?>" size="150" maxlength="200" value="<?php echo $row_dataD["BILLDESC"]; ?>"/></td>
                    <td align="left"><input type="text" name="txtprice<?php echo $i; ?>"  id="txtprice<?php echo $i; ?>" size="10" maxlength="10" value="<?php echo $row_dataD["PRICE"]; ?>" /><input type="hidden" name="rowid<?php echo $i; ?>"  id="rowid<?php echo $i; ?>" size="10" maxlength="10" value="<?php echo $row_dataD["ROW_ID"]; ?>" /></td>
                    </tr>
				                  

			<?php }
			?>
            <tr>
				                    <td colspan="4" align="center">&nbsp;</td>
    </tr>
				                 
             <tr>
				                    <td colspan="4">Current file : <?php echo $row_dataH['JPGFILE'] ;?>
                                    <?php echo "<img src='"."upload/". $row_dataH ['JPGFILE'] ."' style = \"width:70%; height:100%\" />"; ?>
                                    <br />
				                      แสดงรูปภาพ :
				                      <input type="hidden" name="txtfreeflg" id="txtfreeflg" value="A" />
                                      <input type="hidden" name="txtsubflg" id="txtsubflg" value="A" />
                                      <input type="hidden" name="txtspcflg" id="txtspcflg" value="N" />
                                    <input type="file" name="JPGFILE"  id="JPGFILE" size="70" /></td>
    </tr>
				                  <tr>
				                    <td colspan="4" align="center"><p>
				                      <input type="submit" name="button" id="button" value="ส่งข้อมูล" />
				                      <input type="reset" name="button2" id="button2" value="ล้างข้อมูล" />
                                      <INPUT TYPE="BUTTON" VALUE="Go Back" ONCLICK="history.go(-1)" />
				                    </td>
    </tr>    
  </table>
</form>
</body>
</html>