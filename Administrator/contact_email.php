<?php session_start();
header('Content-type: text/html; charset=windows-874');
ini_set('max_execution_time',60); // 60 seconds for max execution time
require_once("../Connections/bwc_webboard.php");
include("i_convert.php"); 


				$dist = $_REQUEST['dist'];
				$mslno	=$_REQUEST['mslno'];
				$chkdgt	=$_REQUEST['chkdgt'];
				$datefrom = $_REQUEST['datefrom'];
				$dateto = $_REQUEST['dateto'];
				$email = $_REQUEST['email'];
				$txtAnswer = $_POST['txtAnswer'];
				
				$row_index = $_REQUEST['row_index'];

$condition = " WHERE A.ROW_INDEX = " . $row_index;
//concat(lpad(dist,4,'0')
$query = "SELECT A.ROW_INDEX, concat(dist,'-',lpad(mslno,5,'0'),'-',lpad(chkdgt,1,'0')) msl_code, NAME, GROUP_ID, SUBJECT, DETAIL, A.IP, CREATE_DATE, CREATE_TIME,CHK_MAIL, EMAIL, PHONE, ANSWER ANSWER_COUNT, B.ROW_INDEX ANSWER_INDEX, B.ANSWER_DETAIL
FROM WEBBOARD A LEFT JOIN WEBBOARD_DETAIL B ON A.ROW_INDEX = B.LIST_NO ".$condition; 

//$webboard = mysql_query($query, $bwc_webboard) or die($query);
//$totalRows_webboard = mysql_num_rows($webboard);


		//$content_default = mysql_query($query_content_data, $dsm_content) or die(mysql_error());
		$webboard = mysql_query($query, $bwc_webboard) or die('error on command =' + $query);
		
		//$row_content_default = mysql_fetch_assoc($content_default);
		$row_content_data = mysql_fetch_assoc($webboard);
		
		//$totalRows_content_default = mysql_num_rows($content_default);
		//--$totalRows_webboard = mysql_num_rows($webboard);
			
				echo  " <fieldset>";
				echo  " <font color=#ff8899> รหัสสมาชิก  </font> " .  $row_content_data['msl_code']."<br>";
				//echo " <font color=#ff8899> วันที่ลงทะเบียน  </font> " . $datefrom . " to " . $dateto . "<br>";
				echo " <font color=#ff8899> อีเมลล์สมาชิก  </font> " . $row_content_data['EMAIL'] . "<br>"; 
				echo " <font color=#ff8899> ดึง ROW_INDEX : </font> " . $row_index . "<br>"; 
				echo "</fieldset>";
				echo "<br>";
				
				
				
?>


<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<?php   
	if ($strMode == 'INSERT' ) {	 echo "<meta http-equiv='refresh' content='0;URL=contact_email.php?row_index='".$row_index."'>";}
?>
<title>Answer by e-mail</title>
<link href="" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>

<script language="JavaScript">
  function ANSWER(page,Mode,row_index) {
/*	  
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
		  
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
	
*/
			if (window.confirm("ยืนยันการส่งข้อมูล")!=true)
			{
				//window.open(varUrl,"_self")
				return false;
			}
			//var dist=document.getElementById('dist').value;
			//var mslno=document.getElementById('mslno').value;
			/*
			var dist=document.getElementById('dist').value;
			var mslno=document.getElementById('mslno').value;
			var chkdgt=document.getElementById('chkdgt').value;
			var datefrom=document.getElementById('datefrom').value;
			var dateto=document.getElementById('dateto').value;
			var email=document.getElementById('email').value;*/
			var answer = document.getElementById('txtAnswer').value;
			
			
			var url2 = 'contact_email_update.php?tMode=' + Mode + '&row_index=' + row_index;
			alert(url2);
			//window.location = url2;
			window.open(url2,'_self');
			//<meta http-equiv='refresh' content='0;URL=member_signup_result.php?id=$id'>
/*			
			var url = 'contact_email.php';
			var pmeters =  'tMode=' + Mode;
			
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
			HttPRequest.onreadystatechange = function()
			{

				 if(HttPRequest.readyState == 3)  // Loading Request
				  {
				   document.getElementById("mySpan").innerHTML = "Now is Loading...";
				  }

				 if(HttPRequest.readyState == 4) // Return Request
				  {
				   document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
				  }
				
			}
			AlertMessage('ข้อมูลถูกลบเรียบร้อยแล้ว','');
			//doCallAjax('DIST',1);*/
	   }
	   	</script>    

</head>

<body>
<div align="center"><strong>ส่งเมล์ตอบคำถาม (Answer by Email</strong>)


</div>
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<br>

<center>
<a href="https://cookies.ningnongmistine.com/bworder_img/index.php"
 target="_blank"> <font color ="#FFA500"> <?php echo  "เพิ่มลิ้งรูปภาพ" ; ?> </font> </a> &nbsp;&nbsp;&nbsp;
<a href="https://cookies.ningnongmistine.com/bworder_img/upfile.pdf" target="_blank"> 
 <font color ="#FFA500"> <?php echo "วิธีเพิ่มภาพในการตอบคำถาม"; ?> </font> </a>   </center>
 
<form  id="form1" name="form1" method="post" action="contact_email_update.php">
<input name="hidROW_INDEX" type="hidden" id="hidROW_INDEX" value="<?php echo  $row_content_data['ROW_INDEX']; ?>" size="5">
  <table width="700" border="0" align="center" cellpadding="0" cellspacing="2">
       <tr>
      <td align="right" bgcolor="#FFF9FC"><strong>From :</strong></td>
      <td bgcolor="#FFF9FC"><input name="txtFrom" type="text" id="txtFrom" value="webmaster@bworder.com" size="48"></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFF9FC"><strong>To : </strong></td>
      <td bgcolor="#FFF9FC"><input name="txtTo" type="text" id="txtTo" value="<?php echo  $row_content_data['EMAIL']; ?>" size="48"></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFF9FC"><strong>Subject : </strong></td>
      <td bgcolor="#FFF9FC">
        <input name="txtSubject" type="text" id="txtSubject" value="<?php echo "ตอบ : " . $row_content_data['SUBJECT']; ?>" size="48"></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFF9FC"><strong>ชื่อ</strong></td><td bgcolor="#FFF9FC"><input name="txtTo2" type="text" id="txtTo2" value="<?php  echo  $row_content_data['NAME']; ?>" size="48" readonly="readonly"></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFF9FC"><p><strong>รหัส :</strong></p></td>
      <td bgcolor="#FFF9FC"><input name="txtCode" type="text" id="txtCode" value="<?php  echo  $row_content_data['msl_code']; ?>" size="25" readonly="readonly"></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFF9FC"><strong>Tel :</strong></td>
      <td bgcolor="#FFF9FC"><span class="ProductBottomLine">
        <input name="txtTo4" type="text" id="txtTo4" value="<?php  echo $row_content_data['PHONE']; ?>" size="25" readonly="readonly">
      </span></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFF9FC"><strong>กลุ่มคำถาม</strong></td>
      <td bgcolor="#FFF9FC"><span class="ProductBottomLine">
        <input name="txtGROUP_ID" type="text" id="txtGROUP_ID" value="<?php  echo $row_content_data['GROUP_ID']; ?>" size="25" readonly="readonly">
        <textarea name="txtDetail" cols="88" rows="1" id="txtDetail" style="visibility:hidden"><?php  echo  "รายละเอียด : " . $row_content_data['DETAIL']; ?>
        </textarea>
      </span></td>
    </tr>
    <tr>
      <td align="right" valign="top" bgcolor="#FFF9FC"><strong>ถาม :</strong></td>
      <td bgcolor="#FFF9FC"><div spry:content="2"><?php  echo "<font size=2>" . $row_content_data['SUBJECT'] . "<p>". $row_content_data['DETAIL'] ."</p>"."</font>" ; ?></div></td>
    </tr>
   
    <tr>
      <td align="right" valign="top" bgcolor="#FFF9FC"><strong>ตอบ :</strong></td>
      <td bgcolor="#FFF9FC">
	  
	  
	  <textarea name="txtAnswer" cols="88" rows="10" id="txtAnswer" class="ckeditor"></textarea>
	  
	  
	  
	  
	  </td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFF9FC">Answer by :      </td>
      <td bgcolor="#FFF9FC"><input name="txtAnswerBy" type="text" id="txtAnswerBy" value="Webmaster BWOrder" cols="88"></td>
    </tr>
    <tr>
      <td align="right" bgcolor="#FFF9FC">&nbsp;</td>
      <td bgcolor="#FFF9FC"><input name="FaqIndex" type="hidden" id="FaqIndex" value="">
      <input name="faqName" type="hidden" id="faqName" value=""></td>
    </tr>
     <tr>
      <td align="right" valign="top" bgcolor="#FFF9FC" colspan="2" >&nbsp;</td>
      
    </tr>
    <tr>
      <td colspan="2" align="center" bgcolor="#FFF9FC"><input type="submit" name="submit" value="Send E-mail">
   </td>
    </tr>
  </table>
</form>

	  
	  


   </td>
  </tr>
</table>


</body>

</html>
<?php mysql_free_result($webboard); ?>