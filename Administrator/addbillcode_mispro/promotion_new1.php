<?php  session_start(); ?>
<?php require("../../i_config.php"); ?>
<?php //require("check_login.php"); ?>
<?php require_once('../../Connections/bwc_orders.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<?php echo "Connect database";?>

<body>
<form action="promotion_new_update.php" method="post" enctype="multipart/form-data" name="form1" id="form1" >
  <p>
    รอบจำหน่าย
    <input name="txtcamp" type="text" id="txtcamp" size="2" maxlength="2" />
                      /
 <input name="txtyear" type="text" id="txtyear" size="4" maxlength="4" />
 </p>
  <p>สถานะ :
  <select name="txtStatus" id="txtStatus">
    <option value="Active">Active</option>
    <option value="Closed">Closed</option>
  </select>
  </p>
  <p> รหัสสินค้า
  <input name="txtid" type="text" size="10" maxlength="5" />
    รายละเอียดสินค้า
    <input name="txtname" type="text" id="txtname" size="70" maxlength="90" />
    ราคา
    <input name="txtprice" type="text" id="txtprice" size="10" maxlength="10" />
  </p>
  <p>
    <input type="submit" name="button" id="button" value="Submit" />
    <input type="reset" name="button2" id="button2" value="Reset" />
  </p>
                  <?php echo "$txtname";?>
</form>
</body>
</html>