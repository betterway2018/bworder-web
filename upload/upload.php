<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
		
		<table>
          <form method="post" action="<?php echo $PHP_SELF; ?> " enctype="multipart/form-data">
                    ������ͧ��� upload <input type="file" name="ufile" size="25"  /><br />
                    <input type="submit" name="send" value="Upload"  />
                    </form>
      
					<?php
					//echo "����� Upload File";
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
					if (!send)  { ?> <! ����� �����ҡѺ true �� false ���� false �� true -->
                    <tr>
                    <td>
                    <form method="post" action="<?php echo $PHP_SELF; ?> " enctype="multipart/form-data">
                    ������ͧ��� upload <input type="file" name="ufile" size="25"  /><br />
                    <input type="submit" name="send" value="Upload"  />
                    </form>
                    </td>
                    </tr>
                    <?php }
					//��Ǩ�ͺ����ա�����͡�������Ѿ��Ŵŧ㹪�ͧ�Ѻ����������
					elseif (empty($HTTP_POST_FILES['ufile']['tmp_name']))
					{
						echo "��س����͡���";
					}
					elseif (copy($HTTP_POST_FILES['ufile']['tmp_name'],$HTTP_POST_FILES['ufile']['name'])) {
						echo  "��������´������Ѻ<br>\n";
						echo  "������� " .$HTTP_POST_FILES['ufile']['name']."<br>\n";
						echo  "���;Ҹ".$HTTP_POST_FILES['ufile']['tmp_name']."<br>\n";
						echo  "��Ҵ���".$HTTP_POST_FILES['ufile']['name']."<br>\n";
						echo  "���������".$HTTP_POST_FILES['ufile']['type']."<br>\n";
						echo  "<font color = red ><h2>Upload Complete �Ѿ��Ŵ��������<h2></font>";
						}
					?>
				<tr><td>
                <a href="http://10.0.0.8/dsmorder/upload" />��ҹ��ͧ��ô���� Upload ��ԧ�������</a>
                </td></td>
</table>
</body>
</html>