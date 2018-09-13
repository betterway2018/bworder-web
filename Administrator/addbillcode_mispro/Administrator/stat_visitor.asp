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
<title><%=title%></title>
<link href="../Styles.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#F0F8FF">
<!--#include file="header.asp" -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="4%" valign="top"><!--#include file="menu.asp" --></td>
    <td width="96%" align="center"><table width="532" border="0" cellpadding="3" cellspacing="1" class="FormBorder_d1daed">
      <tr>
        <td width="82" align="right" bgcolor="#F0F0F0">Domain :</td>
        <td width="438" align="left" bgcolor="#FBFBFB">mistine.co.th</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#F0F0F0">Url</td>
        <td align="left" bgcolor="#FBFBFB"><a href="http://stat4.netdesignhost.com:9999" target="_blank">http://stat6.netdesignhost.com:9999</a></td>
      </tr>
      <tr>
        <td align="right" bgcolor="#F0F0F0">Site ID :</td>
        <td align="left" bgcolor="#FBFBFB">82</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#F0F0F0">Username :</td>
        <td align="left" bgcolor="#FBFBFB">mistine</td>
      </tr>
      <tr>
        <td align="right" bgcolor="#F0F0F0">Password :</td>
        <td align="left" bgcolor="#FBFBFB">mis1213</td>
      </tr>
    </table></td>
  </tr>
</table>

</body>
</html>
