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
 <font    style="font-family:Tahoma, Geneva, sans-serif;size:13px;color:#000000"><u><strong>�Դ��Ѻ��ا�к�</strong></u><strong><u> </u></strong></font></td>
  </tr>
  <tr>
    <td height="54" align="center"> ������㹤�������дǡ��� <br />
      ���ͧ�ҡ��й���ա�ûԴ��Ѻ��ا�к����Ǥ��� <br />
      ��ҹ����ö��觫����Թ�����������<br />
   ���ҹ���������ö��ҹ��  2 ���ٴѧ���</td>
  </tr>
  <tr>
    <td align="center"><table width="200" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><img width="152" height="136" src="under_con_image/1.png" /></td>
          <td><img width="152" height="128" src="under_con_image/2.png" /></td>
        </tr>
        <tr>
          <td colspan="2" align="left"><ol>
            <li><strong>����ʹ��ҧ������Ф�ṹ</strong><strong> </strong></li>
            <li><strong>����ѵԡ����觫���</strong><strong> </strong></li>
          </ol></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="85" align="center"><strong><br>
      <br>
      ���к��С�Ѻ����ҹ��������</strong><strong> </strong><br />
    <strong>��ѹ���  4 �.�. ��������� 6.00 �. �繵�令��</strong><strong> </strong><br>
    <br>
    <a href="index.php">��Ѻ�˹����ѡ</a><br>
    <br></td>
  </tr>
</table>
