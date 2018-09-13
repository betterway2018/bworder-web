<?php 


session_start(); 
//require_once('check_login.php');
require_once('../include/i_config.php'); 
require_once('../Connections/bwc_content.php');


?>
<!DOCTYPE html>
<html>
<head>


  <meta charset="UTF-8">


<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #FF66CC;
    color: white;
}
</style>
</head>
<body>
<script language="JavaScript">
function chkdel(){if(confirm('  กรุณายืนยันการลบอีกครั้ง !!!  ')){
	return true;
}else{
	return false;
}
}
</script >

<center> <h2>รวบรวมคำถามที่สมาชิกสอบถามเข้ามาบ่อย</h2></center> 

<a href="add_new.php">เพิ่มหัวข้อใหม่</a>

<table>
  <tr>
    <th>NO</th>
	<th>ลำดับการแสดงผล</th>
	 <th>รหัสจากระบบ</th>
    <th>หัวข้อ</th>
    <th>เพิ่ม/แก้ไข</th>
  </tr>
  <?php
  mysql_select_db($database_bwc_content,$bwc_content);
mysql_query("SET NAMES 'utf8'");

$query="Select * From content_data  Where group_id=1  and status = 0 Order by  SEQ_NO asc";
$content_data = mysql_query($query, $bwc_content) or die(mysql_error());
$i=1;
while($objResult = mysql_fetch_array($content_data))

{

?>
  <tr>
    <td><?php  echo $i; ?></td>
	 <td><?php echo $objResult["SEQ_NO"]; ?></td>
	  <td><?php echo $objResult[0]; ?></td>
    <td><?php echo $objResult["SUBJECT"]; ?></td>
    <td>
		<a href="delete.php?id=<?php echo $objResult[0]; ?>" OnClick="return chkdel();" > <img src="delete.png"  height="25" width="25"></a>
	<a href="add_new.php?id=<?php echo $objResult[0]; ?>">
	<img src="update.png"  height="25" width="25"></a>
	
	</td>
  </tr>
<?php 
$i++;
 } ?>
</table>

</body>
</html>
