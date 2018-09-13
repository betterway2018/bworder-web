<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>

<!--#include file="../Include/i_config.asp"-->
<!--#include file="../Connections/MySql_Connection.asp"-->
<!-- Star Asp Code -->
<%
Response.Charset="windows-874"

'If Session("Admin_login") = "" then 
'	response.Redirect("admin_login.asp")
'	response.End()
'End IF	
%>

<%
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
<title>Friday Web Administrator</title>
<link href="../Styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/calendar.css">
<script language="JavaScript" src="css/calendar_db.js"></script>


</head>
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
		
			//var camp=document.getElementById('select_camp').value;
			var dist=document.getElementById('dist').value;
			var mslno=document.getElementById('mslno').value;
			var chkdgt=document.getElementById('chkdgt').value;
			var mslname=document.getElementById('mslname').value;
			var orddate=document.getElementById('orddate').value;
			var dwndate=document.getElementById('dwndate').value;
			var dwnstatus=document.getElementById('dwnstatus').value;			
			var url = 'data_orders_ajax.asp';
			var pmeters =  'Sort='+Sort+'&page='+page+'&dist='+dist+'&mslno='+mslno+'&chkdgt='+chkdgt+'&mslname='+mslname+'&orddate='+orddate+'&dwndate='+dwndate+'&dwnstatus='+dwnstatus;
			
			//alert (pmeters);
			
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
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

	   }
	</script>    
<body  >
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top" bgcolor="#F0F8FF"><!--#include file="header.asp" --></td>
  </tr>
  <tr>
    <td width="2%" align="left" valign="top" nowrap="nowrap" bgcolor="#F0F8FF"><!--#include file="menu.asp" --></td>
    <td width="79%" align="left" valign="top" bgcolor="#F0F8FF">
  <br />
      
      <strong class="text_heading">::  ข้อมูลการสั่งซื้อสินค้า ::</strong>
      <hr />
    
      <form id="form1" name="form1" method="post" action="">
        <table width="447" border="0" cellspacing="0" cellpadding="3">
          <tr>
            <td width="94" align="right">รหัสสาวจำหน่าย</td>
            <td width="341"><input name="dist" type="text" id="dist" size="3" maxlength="3" />
              -
              <input name="mslno" type="text" id="mslno" size="5" maxlength="5" />
              -
              <input name="chkdgt" type="text" id="chkdgt" size="3" maxlength="1" /></td>
          </tr>
          <tr>
            <td align="right">ชื่อ - นามสกุล</td>
            <td><input name="mslname" type="text" id="mslname" size="30" /></td>
          </tr>
          <tr>
            <td align="right">วันที่สั่งซื้อ</td>
            <td><input name="orddate" type="text" id="orddate" size="20" />
              <script language="JavaScript" type="text/javascript">
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'orddate'
	});

	          </script>
              (ระบุเป็น yyyy-mm-dd )</td>
          </tr>
          <tr>
            <td align="right">วันที่ดาวน์โหลด </td>
            <td><input name="dwndate" type="text" id="dwndate" size="20" />
              <script language="JavaScript" type="text/javascript">
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'dwndate'
	});

	          </script>
              (ระบุเป็น yyyy-mm-dd )</td>
          </tr>
          <tr>
            <td align="right">สถานะดาวน์โหลด</td>
            <td><select name="dwnstatus" id="dwnstatus">
              <option value="">All</option>
              <option value="Y">Yes</option>
              <option value="N">No</option>
            </select></td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td><input type="reset" name="button2" id="button2" value="Reset" />              <input type="button" name="button" id="button" value="View" onclick="JavaScript:doCallAjax('ORDNO',1);" /></td>
          </tr>
        </table>
    </form><br />

        <span id="mySpan"></span>
    </td>
  </tr>
</table>

</body>
</html>
