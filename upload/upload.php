<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
		
		<table>
          <form method="post" action="<?php echo $PHP_SELF; ?> " enctype="multipart/form-data">
                    ไฟล์ที่ต้องการ upload <input type="file" name="ufile" size="25"  /><br />
                    <input type="submit" name="send" value="Upload"  />
                    </form>
      
					<?php
					//echo "โปรแกรม Upload File";
                    ?>
                    <?php
					if (empty($send))
					{
					$send = false;
					}
					else
					{
					$send = true;
						}
					if (!send)  { ?> <! แปลว่า ไม่เท่ากับ true เป็น false หรือ false เป็น true -->
                    <tr>
                    <td>
                    <form method="post" action="<?php echo $PHP_SELF; ?> " enctype="multipart/form-data">
                    ไฟล์ที่ต้องการ upload <input type="file" name="ufile" size="25"  /><br />
                    <input type="submit" name="send" value="Upload"  />
                    </form>
                    </td>
                    </tr>
                    <?php }
					//ตรวจสอบว่ามีการเลือกไฟล์ที่จะอัพโหลดลงในช่องรับไฟล์หรือไม่
					elseif (empty($HTTP_POST_FILES['ufile']['tmp_name']))
					{
						echo "กรุณาเลือกไฟล์";
					}
					elseif (copy($HTTP_POST_FILES['ufile']['tmp_name'],$HTTP_POST_FILES['ufile']['name'])) {
						echo  "รายละเอียดที่ได้รับ<br>\n";
						echo  "ชื่อไฟล์ " .$HTTP_POST_FILES['ufile']['name']."<br>\n";
						echo  "ชื่อพาธ".$HTTP_POST_FILES['ufile']['tmp_name']."<br>\n";
						echo  "ขนาดไฟล์".$HTTP_POST_FILES['ufile']['name']."<br>\n";
						echo  "ประเภทไฟล์".$HTTP_POST_FILES['ufile']['type']."<br>\n";
						echo  "<font color = red ><h2>Upload Complete อัพโหลดไฟล์สำเร็จ<h2></font>";
						}
					?>
				<tr><td>
                <a href="http://10.0.0.8/dsmorder/upload" />ท่านต้องการดูไฟล์ Upload จริงหรือไม่</a>
                </td></td>
</table>
</body>
</html>