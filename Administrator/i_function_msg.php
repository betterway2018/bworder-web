<?php 
// �ѧ���� Alert  Message Dialog box
function AlertMessage($msg,$url) {
	echo  "<script type='text/JavaScript'>";
	echo  "javascript:alert('$msg');";
	echo "document.location = '$url';";
	echo "</script>";
	exit();
}

// 
function msg($st){
	print "	
	<form  name='form1' method='post' action='javascript:history.back(1)'>
	<table width='50%'  border='1' align='center' cellpadding='0' cellspacing='0' bordercolor='#0000FF'>
  <tr><td bgcolor='#0000FF'><font color='#FFFFFF' ><b>�Դ��ͼԴ��Ҵ</b></font></td>
  </tr><tr>
    <td><br><font color='red'><center>".$st."</center></font><br>
	        <div align='center'>
          <input type='submit' name='Submit' value='��ŧ'>
        </div>
          </td>
  </tr></table> </form> 
";
exit();
}

// ��Ǩ�ͺ form ������
function check_form($formdata){
foreach ($formdata as $key => $value){ 
if (!isset($key) || $value == "" )
return false;
}
return true;
}

?>