<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file="../Include/i_config.asp"-->
<!--#include file="../Connections/MySql_Connection.asp"-->
<!--'#include file="admin_config.asp"-->
<!-- Star Asp Code -->



<%
'If Session("Admin_login") = "" then 
'	response.Redirect("admin_login.asp")
'	response.End()
'End IF	
Response.Charset="windows-874"

Function AlertMessage(msg,url)
 		response.write "<script type='text/JavaScript'>"
		response.write "javascript:alert(' " & msg &"');"
		response.write "document.location = '" & url &"';"
		response.write"</script>"
End Function
%>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><%=title%></title>
<link href="../Styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/calendar.css">
<script language="JavaScript" src="css/calendar_db.js"></script>
	


<style type="text/css">
<!--
body {
	background-color: #F3D8E6;
}
-->
</style></head>
<script language="JavaScript">
	   var HttPRequest = false;

	   function doCallAjax(Sort,page) {
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
	
		
			var dist=document.getElementById('dist').value;
			var mslno=document.getElementById('mslno').value;
			var mslname = document.getElementById('mslname').value;
			var chkdgt=document.getElementById('chkdgt').value;
			var datefrom=document.getElementById('datefrom').value;
			var dateto=document.getElementById('dateto').value;
			var email=document.getElementById('email').value;
			
			
			var url = 'data_mslmst_Ajax.asp';
			var pmeters =  'Sort='+Sort+'&page='+page+'&dist='+dist+'&mslno='+mslno+'&chkdgt='+chkdgt+'&mslname='+mslname +'&datefrom='+datefrom+'&dateto='+dateto+'&email='+email;
			
			//alert (pmeters);
			
			
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded;");
			HttPRequest.setRequestHeader("charset", "windows-874")

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

	   }
	</script>    
<body  onload="JavaScript:doCallAjax('DIST',1);">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" bgcolor="#F3D8E6">
  <br />
  <strong class="text_heading">::  ข้อมูล สมาชิก ::</strong>
      <hr />
      <form id="form1" name="form1" method="post" action="">
        <table width="503" border="0" cellspacing="0" cellpadding="3">
          <tr>
            <td width="114" align="right">รหัสสาวจำหน่าย :</td>
            <td width="377"><input name="dist" type="text" id="dist" size="3" maxlength="3" />
              -
              <input name="mslno" type="text" id="mslno" size="5" maxlength="5" />
              -
            <input name="chkdgt" type="text" id="chkdgt" size="3" maxlength="1" /></td>
          </tr>
          <tr>
            <td align="right">ชื่อ - นามสกุล: </td>
            <td><input name="mslname" type="text" id="mslname" size="48" /></td>
          </tr>
          <tr>
            <td align="right" valign="middle">วันที่ลงทะเบียน :</td>
            <td><table width="320" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="144" nowrap="nowrap"><input name="datefrom" type="text" id="datefrom" /></td>
                <td width="1" nowrap="nowrap"><script language="JavaScript" type="text/javascript">
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'datefrom'
	});

	          </script></td>
                <td width="30" align="center" nowrap="nowrap">&nbsp;&nbsp;ถึง&nbsp;&nbsp;</td>
                <td width="144" nowrap="nowrap"><input name="dateto" type="text" id="dateto" /></td>
                <td width="1" nowrap="nowrap"><script language="JavaScript" type="text/javascript">
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'dateto'
	});

	          </script></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td align="right">Email :</td>
            <td><input name="email" type="text" id="email" size="48" /></td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td><input type="reset" name="button2" id="button2" value="Reset" />
            <input type="button" name="button" id="button" value="View" onclick="JavaScript:doCallAjax('DIST',1);" /></td>
          </tr>
        </table>
      </form>
      <span id="mySpan"></span>
</td>
  </tr>
</table>

</body>
</html>
