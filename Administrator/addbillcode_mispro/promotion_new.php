<?php  session_start(); ?>
<?php require("../../i_config.php"); ?>
<?php //require("check_login.php"); ?>
<?php require_once("i_function_msg.php");  ?>
<?php require_once('../../Connections/config.inc.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>มิสทิน Setup Promotion : ถูกจริงคลิกเลย...</title>
</head>
<body>
<form action="promotion_new_update.php" method="post" enctype="multipart/form-data" name="form1" id="form1" >
  <table width="643" height="140" border="1" align="center" bgcolor="#FFEAEA">
    <tr >
      <td colspan="4" align="center" style="border-bottom:dotted #C8C8C8 1px;border-top:dotted #C8C8C8 1px">เพิ่ม Promotion mistine</td>
    </tr>
    <tr >
    <td colspan="4" style="border-bottom:dotted #C8C8C8 1px;border-top:dotted #C8C8C8 1px">&nbsp;&nbsp;รอบจำหน่าย
    
      
      <select name="txtyear"  id="txtyear"><option value="2012">2012</option><option value="2013">2013</option><option value="2014">2014</option><option value="2015">2015</option><option value="2016">2016</option><option value="2017">2017</option><option value="2018">2018</option></select>
      /<select name="txtcamp"  id="txtcamp">
      <option value="26">26</option>
      <option value="25">25</option>
      <option value="24">24</option>
      <option value="23">23</option>
      <option value="22">22</option>
      <option value="21">21</option>
      <option value="20">20</option>
      <option value="19">19</option>
      <option value="18">18</option>
      <option value="17">17</option>
      <option value="16">16</option>
      <option value="15">15</option>
      <option value="14">14</option>
      <option value="13">13</option>
      <option value="12">12</option>
      <option value="11">11</option>
      <option value="10">10</option>
      <option value="09">9</option>
      <option value="08">8</option>
      <option value="07">7</option>
      <option value="06">6</option>
      <option value="05">5</option>
      <option value="04">4</option>
      <option value="03">3</option>
      <option value="02">2</option>
      <option value="01">1</option>
      
      </select></td>
    </tr>
  <tr >
    <td colspan="4" style="border-bottom:dotted #C8C8C8 1px;border-top:dotted #C8C8C8 1px">&nbsp;&nbsp;สถานะ :
      <select name="txtStatus" id="txtStatus">
        <option value="Active">Active</option>
        <option value="Closed">Closed</option>
      </select>
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
				?>
				                  <tr>
                    <td align="center"><?php echo $i; ?></td>
                    <td align="left"><input type="text" name="txtid<?php echo $i; ?>" id ="txtid<?php echo $i; ?>" size="10" maxlength="5" /></td>
                    <td align="left"><input type="text" name="txtname<?php echo $i; ?>" id="txtname<?php echo $i; ?>" size="150" maxlength="250" /></td>
                    <td align="left"><input type="text" name="txtprice<?php echo $i; ?>"  id="txtprice<?php echo $i; ?>" size="10" maxlength="10" /></td>
                  </tr>
				                  

			<?php }
			?>
            <tr>
				                    <td colspan="4" align="center">&nbsp;</td>
    </tr>
				                 
             <tr>
				                    <td colspan="4" align="center">แสดงรูปภาพ :
				                      <input type="hidden" name="txtfreeflg" id="txtfreeflg" value="A" />
                                      <input type="hidden" name="txtsubflg" id="txtsubflg" value="A" />
                                      <input type="hidden" name="txtspcflg" id="txtspcflg" value="N" />
                                    <input type="file" name="JPGFILE"  id="JPGFILE" size="70" /></td>
    </tr>
				                  <tr>
				                    <td colspan="4" align="center"><input type="submit" name="button" id="button" value="ส่งข้อมูล" />
                                    <input type="reset" name="button2" id="button2" value="ล้างข้อมูล" />
                                    <input INPUT TYPE="BUTTON" VALUE="Go Back" ONCLICK="history.go(-1)" /></td>
    </tr>    
  </table>
</form>
</body>
</html>