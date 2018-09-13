<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file="../Include/i_config.asp"-->

<!-- Star Asp Code -->
<%
If Session("Admin_login") = "" then 
	response.Redirect("admin_login.asp")
	response.End()
End IF	


dim dbfile
dbfile = Server.MapPath("../Webboard/Data/FAQ.mdb") 
Set Conn = Server.CreateObject("ADODB.Connection") 
Conn.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & dbfile & ";Jet OLEDB:Database Password="




if Request.QueryString("Submit") = "del" Then 
		response.write "กรุณารอสักครู่ ... "
		Sql ="Delete From  Data  Where  Seq = " & Request.QueryString("id")
		Conn.Execute Sql
		response.write "<meta http-equiv=""refresh"" content=""1;URL=faq.asp"" />"
		response.end 

End If


Set rs =Server.CreateObject("ADODB.Recordset")
sql ="Select * From data Order By  LineSeq ASC"
rs.Open sql,Conn,1,3


%>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>รอบจำหน่าย</title>
<link href="../styles.css" rel="stylesheet" type="text/css" />

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

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="left"><!--#include file="header.asp" --></td>
  </tr>
  <tr>
    <td width="1%" align="left" valign="top"><!--#include file="menu.asp" --></td>
    <td width="99%" align="left" valign="top" bgcolor="#F3D8E6">
<form action="faq_Update_Sequence.asp" method="post" target="_parent">
    <table width="800" border="0" align="center" cellpadding="1" cellspacing="0">
      <tr>
        <td width="675" height="36" align="center"><strong>.:: ถาม - ตอบ ::.</strong></td>
      </tr>
      <tr>
        <td><input type="button" name="button" id="button" value="Create new" onclick="window.location='faq_new.asp?action=Insert'" />
          <input type="submit" name="Submit" id="Submit" value="Update Sequence" /></td>
      </tr>
      <tr>
        <td align="center"><fieldset>
          <table width="895" border="0" cellspacing="1" cellpadding="4">
            <tr class="table_head2">
              <td width="46" height="25" align="center">Seq.</td>
              <td width="640" align="center">Subject</td>
              <td width="86" align="center">Status</td>
              <td width="86" align="center">&nbsp;</td>
            </tr>
            <%
			i=1
			 Do While Not rs.Eof 

%>
            <tr>
              <td height="32" align="center" valign="top" bgcolor="#FFDDEE" class="Table_border_bottom_gray2"><input name="<%="Line_" &rs("Seq")%>" type="text" id="<%="Line_" &rs("Seq")%>" value="<%=rs("LineSeq")%>" size="10" maxlength="10"  align="middle" style="text-align:center"/></td>
              <td align="left" valign="top" bgcolor="#FFDDEE" class="Table_border_bottom_gray2"><%="<b>ถาม  :</b> " & rs("quest") &"<br>" & "<b>ตอบ  :</b>" &  rs("answer")%></td>
              <td align="center" valign="top" bgcolor="#FFDDEE" class="Table_border_bottom_gray2"><%If rs("IsPublish") = "Y" Then  response.write"ใช้งาน" Else response.write "ไม่ใช้งาน" End IF%>&nbsp;</td>
              <td align="center" valign="top" bgcolor="#FFDDEE" class="Table_border_bottom_gray2"><a href="faq_new.asp?action=Update&amp;id=<%=rs("Seq")%>"><img src="images/edit2.gif" width="17" height="17" border="0" /></a>&nbsp;<a href= # onClick= "del('faq.asp?Submit=del&id=<%=rs("Seq")%>')"><img src="images/delete2.gif" width="17" height="17" border="0" /></a></td>
            </tr>
            <%
			i=i+1
			 rs.MoveNext:Loop%>
          </table>

        </fieldset></td>
      </tr>
    </table>
</form>    
    </td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><!--#include file="../Include/i_footer.asp" --></td>
  </tr>
</table>
</body>
</html>
