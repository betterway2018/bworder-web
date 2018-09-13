<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>

<!--#include file="../Include/i_config.asp"-->
<!--#include file="../Connections/MySql_Connection.asp"-->
<!--#include file="admin_config.asp"-->


<%
If Session("Admin_login") = "" then 
	response.Redirect("admin_login.asp")
	response.End()
End IF	



		Set Conn = Server.CreateObject("ADODB.Connection") 
		Conn.open MySqlConnStr



%>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><%=title%></title>
<link href="../Styles.css" rel="stylesheet" type="text/css" />
</head>

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
	
		
			var mode=document.getElementById('mode').value;
			var datasource=document.getElementById('datasource').value;
			var campaign = document.getElementById('campaign').value;
			var query=document.getElementById('query').value;
			
			
			var url = 'query.asp?q='+query;
			var pmeters =  'Sort='+Sort+'&mode='+mode+'&datasource='+datasource+'&campaign='+campaign+'&query='+query;
			
			//alert (pmeters);
			
			
			HttPRequest.open('POST',url,true);
			//HttPRequest.open('GET',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded;");
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

	   }
	</script>    
<body>
<!--#include file="header.asp" -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="2%" align="left" valign="top"><!--#include file="menu.asp" -->&nbsp;</td>
    <td width="98%" align="left" valign="top"><br />
      <strong class="text_heading">::  Command ::</strong>
      <hr />

        <table width="777" border="0" cellspacing="0" cellpadding="3">
          <tr>
            <td width="81" align="right">Type  :</td>
            <td width="684"><select name="mode" id="mode">
              <option value="Query">Query</option>
              <option value="Execute">INSERT/UPDATE/DELETE</option>
            </select></td>
          </tr>
          <tr>
            <td align="right">Data source :</td>
            <td><select name="datasource" id="datasource">
              <option value="Orders">Orders (MySQL)</option>
              <option value="Catalogue">Catalogue</option>
              <option value="Webboard">Webboard</option>
              <option value="Promotion">Promotion</option>
              <option value="News">News</option>
              <option value="Tips">Tips</option>
            </select>
            
<%
set rs  =Server.CreateObject("ADODB.Recordset")
sql ="Select Camp From  TBL008 Where Status IN ('Late','Current','Advance')"
rs.Open sql,Conn,1,3

%>            
              <select name="campaign" id="campaign">
               <% Do while not rs.eof %>
                <option value="<%=rs("Camp")%>"><%=MID(rs("Camp"),5,2) & "/" & MID(rs("Camp"),1,4)%></option>
                <%rs.MoveNext:Loop%>
            </select></td>
          </tr>
          <tr>
            <td align="right" valign="top">Sql :</td>
            <td><textarea name="query" id="query" cols="120" rows="5"></textarea></td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td><input type="reset" name="button2" id="button2" value="Reset" />
              <input type="button" name="button" id="button" value="Execute" onclick="JavaScript:doCallAjax('DIST');" /></td>
          </tr>
        </table>

    <span id="mySpan"></span></td>
  </tr>
</table>

</body>
</html>
