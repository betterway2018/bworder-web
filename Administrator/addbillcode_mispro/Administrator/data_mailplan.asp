<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>

<!--#include file="../Include/i_config.asp"-->
<!--#include file="../Connections/MySql_Connection.asp"-->
<!--'#include file="admin_config.asp"-->


<%
'If Session("Admin_login") = "" then 
'	response.Redirect("admin_login.asp")
'	response.End()
'End IF	

Set Conn = Server.CreateObject("ADODB.Connection") 
Conn.open MySqlConnStr

select_campaign= Request.Form("select_camp")
if select_campaign = "" then 
	select_campaign = "0"
End If

set rs =Server.CreateObject("ADODB.Recordset")
sql ="Select * From TBL015 Where  CAMP  = " & select_campaign
rs.CursorLocation =3
rs.Open sql,Conn ,1,3

set rs2 = Server.CreateObject("ADODB.Recordset")
sql ="Select Distinct  CAMP  From TBL015 Order by CAMP"
rs2.Open Sql,Conn,1,3
	

%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><%=title%></title>
<link href="../Styles.css" rel="stylesheet" type="text/css" />



<style type="text/css">
<!--
body {
	background-color: #F3D8E6;
}
-->
</style></head>
<script language="JavaScript">
	   var HttPRequest = false;

	   function doCallAjax(Sort) {
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
	
		
			var camp=document.getElementById('select_camp').value;
			
			var url = 'data_mailplan_Ajax.asp';
			var pmeters = 'camp='+camp+ '&mySort='+Sort;
			
			
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
<body  onload="JavaScript:doCallAjax('DIST');">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" bgcolor="#F3D8E6"><table width="697" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="697" height="58" align="center"><strong class="text_heading">::  ข้อมูล Mail plan::</strong>
          <hr /></td>
        </tr>
      <tr>
        <td>Campaign :
          <select name="select_camp" id="select_camp"  onchange="JavaScript:doCallAjax('CAMP');">
            <option value="0" <% If cstr(rs2("CAMP")) = cstr(select_campaign) Then  response.write("selected")  End If%> >== Campaign == </option>
            <%Do While not rs2.Eof %>
            <option value="<%=rs2("CAMP")%>" <% If cstr(rs2("CAMP")) = cstr(select_campaign) Then  response.write("selected")  End If%>><%=MID(rs2("CAMP"),5,2) &"/" & MID(rs2("CAMP"),1,4)%></option>
            <%rs2.MoveNext :Loop%>
          </select></td>
        </tr>
      </table>
      <span id="mySpan"></span>
      
    </td>
  </tr>
</table>

</body>
</html>
