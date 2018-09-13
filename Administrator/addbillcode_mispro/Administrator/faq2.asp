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
<%
Dim Conn
DBPath = Server.MapPath("../webboard/data/faq.mdb") 
Set Conn = Server.CreateObject("ADODB.Connection") 
Conn.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & DBPath & ";Jet OLEDB:Database Password="
%>


 <%


dim titlePage
dim  rs
' Connect Databas


titlePage = Request.QueryString("title")
	

if Request.QueryString("Submit") = "del" Then 
		Sql ="Delete From  Data  Where  Seq = " & Request.QueryString("id")
		Conn.Execute Sql
		
End If

%>
<html>
<head>
<meta http-equiv="Content-Language" content="th">
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<title><%=title%></title>
<link href="../styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-size: 18px}
.style3 {font-size: 18px; font-weight: bold; }
.style5 {color: #FF00FF}
-->
</style>

<script language=javascript>
//แสดง dialog เตือนการลบข้อมูล
	function del(varUrl)
	{
		if (window.confirm("ยืนยันการลบข้อมูล")==true)
		{
			window.open(varUrl,"_self")
		}
	}

function popNewWindow (strDest,strWidth,strHeight,scoll,rez) {
newWin = window.open(strDest,"popup","toolbar=no,scrollbars="+scoll+",resizable="+rez+",width=" + strWidth + ",height=" + strHeight);
}

//-->	
</script>

</head>
<body >


<center>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="left"><!--#include file="header.asp" --></td>
  </tr>
  <tr>
    <td width="1%" align="left" valign="top"><!--#include file="menu.asp" --></td>
    <td width="99%" align="left" valign="top" bgcolor="#F3D8E6"><center>
      <span class="style1"><span class="style3">-- FAQ -- </span><br>
        </span>
      <table width="100%" border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td height="21" align="center"><a href="faq_new.asp?action=Insert">Add New </a></td>
          <td colspan="3">&nbsp;</td>
        </tr>
        <tr>
          <td height="21" colspan="4" align="center"><hr></td>
        </tr>
        <tr>
          <td width="13%" height="21" align="center">&nbsp;</td>
          <td colspan="3">&nbsp;</td>
        </tr>
        <%
Dim i
dim rsFaq 




Set rsFaq = Server.CreateObject("ADODB.Recordset") 
Sql ="Select * From [Data] Order by seq"
rsFaq.Open sql,Conn,1,3
 

i =1
Do While Not rsFaq.EOF 

%>
        <tr>
          <td align="center"><a href="faq_new.asp?action=Update&id=<%=rsFaq("Seq")%>">Edit</a> | <a href= # onClick= "del('faq.asp?Submit=del&id=<%=rsFaq("Seq")%>')">Del</a></td>
          <td width="7%"><span style="color: #FF0000"><%="Q. " & i%></span></td>
          <td colspan="2"><span style="color: #0000FF"><%=rsFaq("Quest")%></span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td width="5%" valign="top"><span style="color: #FF00FF">Ans.</span></td>
          <td width="75%"><%=rsFaq("Answer")%></td>
        </tr>
        <tr>
          <td class="Table_border_bottom_gray2">&nbsp;</td>
          <td class="Table_border_bottom_gray2">&nbsp;</td>
          <td class="Table_border_bottom_gray2">&nbsp;</td>
          <td class="Table_border_bottom_gray2">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <%
		i =i+1
		rsFaq.MoveNext
Loop
%>
        </table>
    </center>
      <br></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><!--#include file="../Include/i_footer.asp" --></td>
  </tr>
</table>
<br>
<br>
</center>
</body>
</html>