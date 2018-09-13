<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>

<!--#include file="../Include/i_config.asp"-->
<!--#include file="../Connections/MySql_Connection.asp"-->
<!--#include file="admin_config.asp"-->


<%
If Session("Admin_login") = "" then 
	response.Redirect("admin_login.asp")
	response.End()
End IF	
%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Director Infomation</title>
<style type="text/css">
<!--
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>
<link href="../Styles.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#F0F8FF">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><!--#include file="header.asp" --></td>
  </tr>
  <tr>
    <td width="4%" align="left" valign="top"><!--#include file="menu.asp" --></td>
    <td width="96%" align="left" valign="top"><%

dim objFso
dim oblfol
dim SubFol



dir  = request("dir")
if dir = "" Then 
	dir = server.MapPath("../../"   )
End If

'Response.Write "root = " & root
'response.Write("<Br>")

'response.write "dir =" & dir
'response.Write("<Br>")

on error resume next

Set ObjFso = Server.CreateObject("Scripting.FileSystemObject")
Set objFol  = objFso.getfolder(dir)



	
'Get Of Site Path

 dim localP
 local =  replace( dir, Server.MapPath("../../"),"")
 local = replace(local,"\","/")
 
 response.write local
%>
      <table width="800" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="210" height="24" bgcolor="#ECE9D8"><span class="style1">Name</span></td>
          <td width="92" align="right" bgcolor="#ECE9D8"><span class="style1">Size (KB)</span></td>
          <td width="284" bgcolor="#ECE9D8"><span class="style1">Type</span></td>
          <td width="188" bgcolor="#ECE9D8"><span class="style1">Date Modified </span></td>
        </tr>
        <tr>
          <td><%
				if dir <> server.MapPath("../../" )  Then 
					Response.Write( "<A href = ""?dir=" &  request("parent")   & """>" & "..." & "</a>")
					response.Write("<Br>")
				End If
		%></td>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <%  
For  Each SubFol  In  ObjFol.SubFolders
%>
        <tr>
          <td><%
				Response.Write  "<A href = """
				response.write "?parent=" & dir 
				response.write "&dir=" &  dir  &"\" & SubFol.Name  & """>" 
				response.write  SubFol.Name 
				response.write  "</a>"
			%></td>
          <td align="right"><%=(SubFol.Size \ 1024)  %></td>
          <td><%=Subfol.Type%></td>
          <td><%=subFol.DateLastModified%></td>
        </tr>
        <%
 Next
 %>
        <%
For Each  objFile  in ObjFol.files
%>
        <tr>
          <td><%=objFile.Name%></td>
          <td align="right"><%=objFile.Size\1024%></td>
          <td><%=objFile.Type%></td>
          <td><%=objFile.DateLastModified%></td>
        </tr>
        <%
Next
%>
      </table>
      <form id="form1" name="form1" method="post" action="">
        <input name="hiddenField" type="hidden" value="<%=local%>" />
      </form>
      <br /></td>
  </tr>
</table>
<br />

</body>
</html>
