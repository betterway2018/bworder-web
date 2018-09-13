<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>

<!--#include file="../Include/i_config.asp"-->
<!--#include file="../Connections/MySql_Connection.asp"-->
<!--'#include file="admin_config.asp"-->


<%
'If Session("Admin_login") = "" then 
'	response.Redirect("admin_login.asp")
'	response.End()
'End IF	

'Dim MySqlConnStr = "DRIVER={MySQL ODBC 3.51 Driver}; SERVER=27.254.38.144;UID=bwc_orders; pwd=bwo1212; database=bwc_orders; option=3306;"
Set Conn = Server.CreateObject("ADODB.Connection") 
Conn.open MySqlConnStr

Set rs =Server.CreateObject("ADODB.Recordset")
sql ="Select * From TBL008 Order By Camp"
rs.Open sql,Conn,1,3


%>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><%=title%></title>
<link href="../styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
body {
	background-color: #F3D8E6;
}
-->
</style></head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td width="1%" align="left" valign="top">&nbsp;</td>
    <td width="99%" align="left" valign="top" bgcolor="#F3D8E6"><table width="675" border="0" align="center" cellpadding="1" cellspacing="0">
      <tr>
        <td width="675" height="36" align="center"><strong>.:: ข้อมูลรอบจำหน่าย ::.</strong></td>
      </tr>
      <tr>
        <td align="center"><fieldset>
          <table width="674" border="0" cellspacing="1" cellpadding="1">
            <tr class="table_head2">
              <td width="41" height="25">&nbsp;</td>
              <td width="92" align="center">รอบจำหน่าย</td>
              <td width="163" align="center">วันที่</td>
              <td width="142" align="center">ถึงวันที่ </td>
              <td width="146" align="center">สถานะ</td>
              </tr>
            <% Do While Not rs.Eof 
		if rs("Status") ="Closed" Then 
			foreColor = "#000000"
		Else
			foreColor = "#FF0000"
		End If

%>
            <tr>
              <td bgcolor="#FFDDEE">&nbsp;</td>
              <td align="center" bgcolor="#FFDDEE"><font color="<%=foreColor%>"><%=MID(rs("Camp"),5,2)&"/" & MID(rs("Camp"),1,4)%></font></td>
              <td align="center" bgcolor="#FFDDEE"><font color="<%=foreColor%>"><%=MID(rs("EFFDTE"),7,2) & "/" & MID(rs("EFFDTE"),5,2) & "/" & MID(rs("EFFDTE"),1,4)%></font></td>
              <td align="center" bgcolor="#FFDDEE"><font color="<%=foreColor%>"><%=MID(rs("EXPDTE"),7,2) &"/" & MID(rs("EXPDTE"),5,2)&"/" & MID(rs("EXPDTE"),1,4)%></font></td>
              <td align="center" bgcolor="#FFDDEE"><font color="<%=foreColor%>"><%=rs("Status")%></font></td>
              </tr>
            <% rs.MoveNext:Loop%>
            <tr>
              <td bgcolor="#FFDDEE">&nbsp;</td>
              <td align="center" bgcolor="#FFDDEE">&nbsp;</td>
              <td align="center" bgcolor="#FFDDEE">&nbsp;</td>
              <td align="center" bgcolor="#FFDDEE">&nbsp;</td>
              <td align="center" bgcolor="#FFDDEE">&nbsp;</td>
              </tr>
            </table>
          </fieldset></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
