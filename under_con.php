<?php 

//echo $_SERVER['SCRIPT_FILENAME']. "<br>";
$pos = strrpos($_SERVER['HTTP_REFERER'], "order_history.php");
//echo "pos=".$pos;
if ($pos===false) {
 header ('Content-type: text/html; charset=tis-620');
}  

//header ('Content-type: text/html; charset=tis-620');
?>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0"  style="font-family:Tahoma, Geneva, sans-serif;size:13px;color:#000000">
  <tr>
    <td height="38" align="center" valign="top">
 <font    style="font-family:Tahoma, Geneva, sans-serif;size:13px;color:#000000"><u><strong>ปิดปรับปรุงระบบ</strong></u><strong><u> </u></strong></font></td>
  </tr>
  <tr>
    <td height="54" align="center"> ขออภัยในความไม่สะดวกค่ะ <br />
      เนื่องจากขณะนี้มีการปิดปรับปรุงระบบชั่วคราว <br />
      ท่านสามารถสั่งซื้อสินค้าได้ตามปกติ<br />
   แต่ท่านจะไม่สามารถใช้งานได้  2 เมนูดังนี้</td>
  </tr>
  <tr>
    <td align="center"><table width="200" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img width="152" height="136" src="under_con_image/1.png" /></td>
          <td><img width="152" height="128" src="under_con_image/2.png" /></td>
        </tr>
        <tr>
          <td colspan="2" align="left"><ol>
            <li><strong>ถามยอดค้างชำระและคะแนน</strong><strong> </strong></li>
            <li><strong>ประวัติการสั่งซื้อ</strong><strong> </strong></li>
          </ol></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="85" align="center"><strong><br>
      <br>
      โดยระบบจะกลับมาใช้งานได้ตามปกติ</strong><strong> </strong><br />
    <strong>ในวันที่  4 ก.พ. ตั้งแต่เวลา 6.00 น. เป็นต้นไปค่ะ</strong><strong> </strong><br>
    <br>
    <a href="index.php">กลับไปหน้าหลัก</a><br>
    <br></td>
  </tr>
</table>
