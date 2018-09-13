<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>

<%
Dim Conn
DBPath = Server.MapPath("../webboard/data/faq.mdb") 
Set Conn = Server.CreateObject("ADODB.Connection") 
Conn.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & DBPath & ";Jet OLEDB:Database Password="
%>

      <%

dim titlePage
dim  rs


titlePage = Request.QueryString("title")
	

FaqIndex   = Request.QueryString("id")
action = Request.QueryString("Action")


if Request.QueryString("action") = "del" Then 
		Sql ="Delete From  Data Where  Seq = " & Request.QueryString("id")
		Conn.Execute Sql

elseif  action = "Insert" Then 
	' get New ID
	sql  ="Select Max(Seq) as MaxId From Data"
	Set rsMax  = Server.CreateObject("ADODB.Recordset")
	rsMax.Open Sql,Conn,1,3
	if Isnull(rsMax("MaxId")) Then 
		FaqIndex = 1
	Else
		FaqIndex = rsMax("MaxId") + 1
	End If
	
	Answer =""
	Active =""
	
ElseIf Action = "Update" Then 
	set rs = Server.CreateObject("ADODB.Recordset") 
	Sql  = "Select * From Data  Where Seq = " &  Request.QueryString("id") 
	rs.Open Sql,Conn,1,3
	FaqIndex = rs("Seq")
	Question =rs("Quest")
	Answer = rs("Answer")
	LineSeq = rs("LineSeq")
	faqStatus = rs("IsPublish")
	
	'Active = rs("Status")
End If


if Request.form("Submit")  ="Insert" Then 
	FaqIndex = Request.Form("txtIndex")
	Question = Request.Form("txtQuestion")
	Answer = Request.Form("txtAnswer")
	strActive = Request.Form("selStatus")
	LineSeq = Request.form("txtseq")
	

	

	If LineSeq ="" Then LineSeq = "0"
	if Not Isnumeric(LineSeq)  Then LineSeq ="0"
	

	
	
	set rs = Server.CreateObject("ADODB.Recordset") 
	Sql  = "Select * From Data "
	rs.Open Sql,Conn,1,3
	rs.AddNew
	rs("Quest") = question 
	rs("Answer") = Answer
	rs("LineSeq") = LineSeq
	rs("IsPublish") = strActive
	rs.Update
	Response.Redirect("faq.asp")
	
ElseIf Request.Form("Submit") = "Update" then 
	FaqIndex = Request.Form("txtIndex")
	Question = Request.Form("txtQuestion")
	Answer = Request.Form("txtAnswer")
	strActive = Request.Form("selStatus")
	LineSeq = Request.form("txtseq")
	set rs = Server.CreateObject("ADODB.Recordset") 
	Sql  = "Select * From data  Where Seq = " & FaqIndex
	rs.Open Sql,Conn,1,3
	rs("Quest") = question 
	rs("Answer") = Answer
	rs("LineSeq") = LineSeq
	rs("IsPublish") = strActive
	rs.Update	

	Response.Redirect("faq.asp")
End If




%>
<html>
<head>
<meta http-equiv="Content-Language" content="th">
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">

<title>Friday Administration</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="Styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style1 {font-size: 18px}
.style3 {font-size: 18px; font-weight: bold; }
.style4 {
	color: #FFFFFF;
	font-weight: bold;
}
.style5 {color: #FFFFFF}
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

<link href="../styles.css" rel="stylesheet" type="text/css">
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
    </center>
      <br>
      <br>
      <br>
      <form name="form1" method="post" action="">
        <table width="602" border="0" align="center" cellpadding="0" cellspacing="2">
          <tr>
            <td width="119" align="right" class="white_border">&nbsp;</td>
            <td width="477"><input name="txtIndex" type="hidden" id="txtIndex" value="<%=FAQIndex%>">
              <%'=FAQIndex%></td>
          </tr>
          <tr>
            <td height="19" align="right" valign="top" bgcolor="#B1C3D9" class="white_border"><span class="style4">Sequence :</span></td>
            <td bgcolor="#F9F8F2"><input name="txtseq" type="text" id="txtseq" value="<%=LineSeq%>" size="8" maxlength="5"></td>
          </tr>
          <tr>
            <td height="19" align="right" valign="top" bgcolor="#B1C3D9" class="white_border"><span class="style4">Status :</span></td>
            <td bgcolor="#F9F8F2"><select name="selStatus" id="selStatus">
              <option value="Y" selected>ใช้งาน</option>
              <option value="N">ไม่ใช้งาน</option>
            </select></td>
          </tr>
          <tr>
            <td height="81" align="right" valign="top" bgcolor="#B1C3D9" class="white_border"><span class="style4">Question : </span></td>
            <td bgcolor="#F9F8F2"><textarea name="txtQuestion" cols="74" rows="5" id="txtQuestion"><%=Question%></textarea></td>
          </tr>
          <tr>
            <td align="right" valign="top" bgcolor="#B1C3D9" class="white_border"><span class="style4">Answer : </span></td>
            <td bgcolor="#F9F8F2"><textarea name="txtAnswer" cols="74" rows="10" id="txtAnswer"><%=Answer%></textarea></td>
          </tr>
          <tr>
            <td colspan="2" align="center" class="white_border"><input type="submit" name="Submit" value="<%=Action%>">
              <input type="button" name="Submit2" value="Cancel"  onClick="window.location='faq.asp'"></td>
          </tr>
        </table>
      </form></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><!--#include file="../Include/i_footer.asp" --></td>
  </tr>
</table>
</center>
</body>
</html>