<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file="../Include/i_config.asp"-->

<!-- Star Asp Code -->
<%
If Session("Admin_login") = "" then 
	response.Redirect("admin_login.asp")
	response.End()
End IF	


dim dbfile
dbfile = Server.MapPath("../News/news_data.mdb") 
Set Conn = Server.CreateObject("ADODB.Connection") 
Conn.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & dbfile & ";Jet OLEDB:Database Password="

Set rs =Server.CreateObject("ADODB.Recordset")
sql ="Select * From news Order By  id"
rs.Open sql,Conn,1,3


%>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>รอบจำหน่าย</title>
<link href="../styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="800" border="0" align="center" cellpadding="1" cellspacing="0">
  <tr>
    <td width="675" height="36" align="center"><strong>.:: News ::.</strong></td>
  </tr>
  <tr>
    <td><input type="submit" name="button" id="button" value="Create new" /></td>
  </tr>
  <tr>
    <td align="center"><fieldset> 
    <table width="800" border="0" cellspacing="1" cellpadding="1">
      <tr class="table_head2">
        <td width="80" height="25">&nbsp;</td>
        <td width="44" align="center">Seq.</td>
        <td width="441" align="center">Subject</td>
        <td width="85" align="center">Post Date</td>
        <td width="58" align="center">Default</td>
        <td width="73" align="center">&nbsp;</td>
      </tr>
<% Do While Not rs.Eof 

%>      

      <tr>
        <td height="54" align="center" bgcolor="#FFDDEE"><img src="<%="../news/news_images/" & rs("imagefile")%>" width="65" height="52" /></td>
        <td align="center" bgcolor="#FFDDEE"><%=rs("ID")%></td>
        <td align="left" bgcolor="#FFDDEE"><%=rs("Subject")%></td>
        <td align="center" bgcolor="#FFDDEE"><%=MID(rs("Post_Date"),7,2) & "/" & MID(rs("Post_Date"),5,2) & "/" & MID(rs("Post_Date"),1,4)%></td>
        <td align="center" bgcolor="#FFDDEE"><%=rs("IsDefault")%></td>
        <td align="center" bgcolor="#FFDDEE"><img src="images/edit2.gif" width="17" height="17" />&nbsp;<img src="images/delete2.gif" width="17" height="17" />&nbsp;&nbsp;<img src="images/view3.gif" width="17" height="17" /></td>
      </tr>
<% rs.MoveNext:Loop%>      
      </table>
    </fieldset>
</td>
  </tr>
</table>
</body>
</html>
