<?php
/*session_start(); 
ob_start();
*/
require_once('include/i_config.php'); 
require_once('Connections/bwc_orders.php'); 

mysql_select_db($database_bwc_orders, $bwc_orders);
mysql_query("SET NAMES 'utf8'");
/*mysql_query("SET character_set_results=tis620");
mysql_query("SET character_set_client=tis620");
mysql_query("SET character_set_connection=tis620");
*/

$CurCamp=$_SESSION["CurCamp"];
$sql =" SELECT order_header.NAME, point_50.ORDER_FLAG, 
point_50.DEL, point_50.ORDCAMP, 
point_50.DIST, point_50.MSLNO, point_50.CHKDGT
FROM
point_50
Inner Join order_header ON order_header.DIST = point_50.DIST AND order_header.MSLNO = point_50.MSLNO AND order_header.CHKDGT = point_50.CHKDGT AND order_header.ORDER_NO = point_50.ORDER_NO AND point_50.DEL = 'N'
 AND order_header.DELFLAG = 'N'
 AND point_50.ORDER_FLAG = 50
 AND point_50.ORDCAMP = order_header.ORDCAMP order by 1 asc ";
$result = mysql_db_query($database_bwc_orders,$sql);
$show = mysql_db_query($database_bwc_orders,$sql);
$rs_01=mysql_fetch_array($show);
//echo $sql;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
   <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7; IE=EDGE" />
<title><?php  echo $title?></title>

<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css">
<link href="css/main.css" rel="stylesheet" type="text/css" />
	<script src="js_bootstrap/bootstrap.min.js"></script>

</head>
<body  bgcolor="#CCFFFF">
<!--<script src="js_bootstrap/bootstrap.min.js"></script>
	<script type="text/javascript" language="javascript" src="js_bootstrap/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="js_bootstrap/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="js_bootstrap/dataTables.bootstrap.js"></script> -->
	
	
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css">
    <script src="js_bootstrap/jquery-2.1.1.min.js"></script>
	<script src="js_bootstrap/bootstrap.min.js"></script>
	<script type="text/javascript" language="javascript" src="js_bootstrap/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="js_bootstrap/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="js_bootstrap/dataTables.bootstrap.js"></script>
	
<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
    $('#example').dataTable();
} );

	</script>


<table width="900"  height="500"  border="0"   align="center"   cellpadding="0"  cellspacing="0" >
  <tr>
    <td height="500px" align="left"  style="padding:2px"><table width="800"   border="0" align="center" cellpadding="3" cellspacing="0" >
      <tr   valign="top">
        <td width="787" style="text-align: center;">
		<br>
		<div style="font-size:25px" > ประกาศรายชื่อสมาชิก</div>
         <br>
          <div  style="font-size:15px"> รายชื่อสมาชิก ที่ได้รับคะเเนนสะสม เบทเตอร์เวย์ พอยท์ รีวอร์ด ฟรี 50 คะแนน </div>
		  <br>
          <div style="font-size:15px"> จากการสั่งซื้อสินค้าผ่านทาง อินเตอร์เน็ต ประจำรอบจำหน่ายที่ <span style="font-weight: bold;">
              <?php   echo substr($rs_01['ORDCAMP'],4,6) ."/".substr($rs_01['ORDCAMP'],0,4); ?> ดังนี้
          </span> </div>
		  <br>
		  <div style="font-size:15px">(ตรวจสอบคะแนนสะสม เบทเตอร์เวย์ พอยท์ รีวอร์ด ได้ในใบกำกับภาษีรอบจำหน่ายที่  <span>
              <?php   echo substr($rs_01['ORDCAMP'],4,6)+1 ."/".substr($rs_01['ORDCAMP'],0,4); ?>
          )</span> </div>
		  <br>
		  </td>
      </tr>
      <tr>
        <td><table class="table table-bordered table-striped list3title3"  id="example">
            <!--   <tr bgcolor="#EC008C">
            <td width="32" height="47" align="center" style="border-bottom: solid #006633 1px; border-top: solid #006633 1px"><strong class="content_header">เน€เธเธ…เน€เธเธ“เน€เธโ€เน€เธเธ‘เน€เธย</strong></td>
            <td width="73" align="center" style="border-bottom: solid #006633 1px; border-top: solid #006633 1px"><strong class="content_header">เน€เธเธเน€เธเธเน€เธยเน€เธยเน€เธเธ“เน€เธเธเน€เธยเน€เธยเน€เธเธ’เน€เธเธ</strong></td>
            <td width="160" align="center" style="border-bottom: solid #006633 1px; border-top: solid #006633 1px"><strong class="content_header">เน€เธเธเน€เธเธ’เน€เธเธเน€เธยเน€เธเธ—เน€เธยเน€เธเธเน€เธยเน€เธเธเน€เธยเน€เธยเน€เธยเน€เธยเน€เธโ€เน€เธเธ•</strong></td>
          </tr> -->
            <thead>
              <tr>
                <th style="width:20%">ลำดับ</th>
                <th style="width:50%">ชื่อ - นามสกุล</th>
              </tr>
            </thead>
            <tbody>
              <?

   while($rs=mysql_fetch_array($result))
	{  $i++;
	?>
              <tr >
                <td align="center" valign="top"><? echo $i; ?></td>
                <td align="left" valign="top"><?php echo  $rs['NAME']?></td>
              </tr>
              <?	  
    }
?>
            </tbody>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <?php require_once('include/i_footer_border.php'); ?>
</table>

<?php require_once('include/i_footer.php'); ?>
<?php
            // POPUP เน€เธเธเน€เธเธเน€เธยเน€เธยเน€เธเธเน€เธยเน€เธยเน€เธเธเน€เธเธ‘เน€เธย
            $dist=$_SESSION['dist'];
            $mslno=$_SESSION['mslno'];
            // $ordtype = $_SESSION['ORDER']  ;
            //  if($ordtype == 1)
            //  {
            //    if( $dist !='0999' )
            //     { 
            include("i_msg_box2.php");
            //     }
            //  }      
           // if( $dist =='0999' )
          //  { 
          //       include("i_msg_box3.php");
          //  }
                       
?>


</body>
</html>

