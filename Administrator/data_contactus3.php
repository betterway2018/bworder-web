<?php session_start();?>
<?php  require("check_login.php"); ?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=TIS-620" />
<title>doCallAjax_Administrator BWORDER</title>
<link rel="stylesheet" href="css/calendar.css">
<link rel="stylesheet" href="processing.css">
<script language="JavaScript" src="css/calendar_db.js"></script>
<script language="JavaScript" src="processing.js"></script>


</head>

<script language="JavaScript">
	   var HttPRequest = false;

	   function doCallAjax(Sort,page,dist,row_index) {
		   showProcessing();
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
	
			//var row_index =document.getElementById('row_index').value;
			var dist=document.getElementById('dist').value;
			var mslno=document.getElementById('mslno').value;
			var chkdgt=document.getElementById('chkdgt').value;
			var datefrom=document.getElementById('datefrom').value;
			var dateto=document.getElementById('dateto').value;
			var email=document.getElementById('email').value;
			var fselect=document.getElementById('fselect').value;
			
			
			var url = 'data_contactus_Ajax3.php';
			//dist = '999';
			var pmeters =  'Sort='+Sort+'&page='+page+'&dist='+dist+'&mslno='+mslno+'&chkdgt='+chkdgt+'&datefrom='+datefrom+'&dateto='+dateto+'&email='+email+"&fselect="+fselect;
//			var pmeters =  'Sort='+Sort+'&page='+page+'&dist='+dist+'&mslno='+mslno+'&chkdgt='+chkdgt+'&datefrom='+datefrom+'&dateto='+dateto+'&email='+email+'&row_index='+row_index;
//			var pmeters =  'Sort='+Sort+'&page='+page+'&dist='+dist+'&mslno='+mslno+'&chkdgt='+chkdgt+'&mslname='+mslname +'&datefrom='+datefrom+'&dateto='+dateto+'&email='+email;
			//alert ('etuyy'+fselect);
			
			//alert (pmeters);
			
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded;");
			HttPRequest.setRequestHeader("charset", "TIS-620")
			//HttPRequest.setRequestHeader("charset", "windows-874")

			//HttPRequest.setRequestHeader("Content-Type", "text/plain;charset=windows-874");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			

			HttPRequest.send(pmeters);
			
			//<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
			
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
			closeProcessing();

	   }
	   
	   
	   	   function DeleteFAQ(page,Mode,row_index) {
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
	

			if (window.confirm("�׹�ѹ���ź������")!=true)
			{
				//window.open(varUrl,"_self")
				return false;
			}
			//var dist=document.getElementById('dist').value;
			//var mslno=document.getElementById('mslno').value;
			
			var dist=document.getElementById('dist').value;
			var mslno=document.getElementById('mslno').value;
			var chkdgt=document.getElementById('chkdgt').value;
			var datefrom=document.getElementById('datefrom').value;
			var dateto=document.getElementById('dateto').value;
			var email=document.getElementById('email').value;
			var fselect=document.getElementById('fselect').value;
			
			var url = 'data_contactus_Ajax3.php';
			var pmeters =  'Sort=&page=&dist='+dist+'&mslno='+mslno+'&chkdgt='+chkdgt+'&datefrom='+datefrom+'&dateto='+dateto+'&email='+email+"&row_index=" + row_index + "&tMode=" + Mode+"&fselect="+fselect;
			//var pmeters =  'page='+page+'&mslflag='+mslflag+'&datefrom='+datefrom+'&dateto='+dateto+'&email='+email+'&status='+status+ "&tMode=" + Mode +"&tID=" + ID;

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
			//AlertMessage('�����Ŷ١ź���º��������','');
			//doCallAjax('DIST',1);
	   }
		function change_select(){
			//alert(document.getElementById('datefrom').value);
			if (document.getElementById('fselect').value==1)
			{
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1;//January is 0!
var yyyy = today.getFullYear();

var fromday = new Date();
fromday.setDate(fromday.getDate()-3);
var fdd = fromday.getDate();
var fmm = fromday.getMonth()+1;//January is 0!
var fyyyy = fromday.getFullYear();
			//document.getElementById('datefrom').value=yyyy+"-"+(Right("0"+mm,2))+"-"+(Right("0"+(dd-3),2));
			document.getElementById('datefrom').value=fyyyy+"-"+(Right("0"+fmm,2))+"-"+(Right("0"+fdd,2));
			document.getElementById('dateto').value=yyyy+"-"+(Right("0"+mm,2))+"-"+(Right("0"+dd,2));
			}
			else
			{
			document.getElementById('datefrom').value="";
			document.getElementById('dateto').value="";
			}
			}
	   
function Right(str, n){
    if (n <= 0)
       return "";
    else if (n > String(str).length)
       return str;
    else {
       var iLen = String(str).length;
       return String(str).substring(iLen, iLen - n);
    }
}	   
	</script> 
    
       
    
    
<body onload="JavaScript:doCallAjax('DIST',1);">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" valign="top" bgcolor="#FFFFFF"></td>
  </tr>
  <tr>
    
    <td align="left" valign="top">
<br />
<strong class="text_heading">::   �Դ����ͺ��� ���-�ͺ :�¤�������� ::</strong>
    <hr />
    <form id="form1" name="form1" method="post" action="">
      <table width="622" border="0" cellspacing="0" cellpadding="5">
        <tr>
           <td colspan="3"><input name="row_index" type="hidden" id="row_index" size="48" /></td>
        </tr>

        <tr>
          <td width="155" align="right" valign="middle" nowrap="nowrap">�֧�����������ѹ��� :</td>
          <td width="447"><table width="77%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="27%" nowrap="nowrap"><input name="datefrom" type="text" id="datefrom" /></td>
              <td width="4%" nowrap="nowrap"><script language="JavaScript" type="text/javascript">
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'datefrom'
	});

	          </script></td>
              <td width="8%" align="center" nowrap="nowrap">&nbsp;&nbsp;�֧&nbsp;&nbsp;</td>
              <td width="27%" nowrap="nowrap"><input name="dateto" type="text" id="dateto" /></td>
              <td width="34%" nowrap="nowrap"><script language="JavaScript" type="text/javascript">
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'dateto'
	});

	          </script></td>
              </tr>
            </table></td>
          <td nowrap="nowrap"><font color="red" size="-1" >�к��ѹ���</font></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td colspan="2"><font color="red" >��س��к����͡�ѹ����ҹ��ͧ��÷�ҹ����</font></td>
        </tr>
        <tr>
          <td align="right">�к�������Ҫԡ :</td>
          <td colspan="2"><input name="dist" type="text" id="dist" size="4" maxlength="4" value="" />
-
  <input name="mslno" type="text" id="mslno" size="5" maxlength="5" />
-
<input name="chkdgt" type="text" id="chkdgt" size="3" maxlength="1" /><font color="red" size="-1" >
���Ҵ���������Ҫԡ</font></td>
        </tr>
        <tr>
          <td align="right">e-mail :</td>
          <td colspan="2"><input name="email" type="text" id="email" size="48" /> 
           <font color="red" size="-1" > ���Ҵ����������</font></td>
        </tr>
        <tr>
          <td align="right">���Ҵ��� :</td>
          <td colspan="2">
          	<select name="fselect" id="fselect" onchange="change_select();">
            <option value="0">��¡�÷���ѧ���ͺ�Ӷ��</option>
            <option value="1">��¡�÷��ͺ�Ӷ������</option>
            <option value="2">��¡�÷�����</option>
          </select></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td colspan="2"><input type="reset" name="button2" id="button2" value="Reset" />
            <input type="button" name="button" id="button" value="View" onclick="JavaScript:doCallAjax('DIST',1);" /></td>
        </tr>
      </table>
    </form>
    <span id="mySpan"></span>
</td>
  </tr>
</table>

<div id="divProcess" class="loading-invisible">
  <img id="imgProcess" style="position:absolute;" src="Processing.gif" border=0>
 </div>

</body>
</html>