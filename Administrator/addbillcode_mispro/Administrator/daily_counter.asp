<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file="../Include/i_config.asp"-->
<!--#include file="../Connections/MySql_Connection.asp"-->
<!--#include file="admin_config.asp"-->
<%


daily_counter =0 
ordersHeader =0 
ordersItem =0 
mslReg =0 
faq =0
webboard =0

strCurDate = year(date) & mid("00",1,2-len(month(date))) & month(date) & mid("00",1,2-len(day(date))) & day(date) 

'############################################################
'Visitor
'############################################################
'Counter PerDate
Set strObjFile = CreateObject("Scripting.FileSystemObject") 'สร้าง Object ที่ใช้กับ Text Fil
strFileDate = Request.ServerVariables("APPL_PHYSICAL_PATH") &"counters/" & "counter_"  & strCurDate & ".txt"

if  Not strObjFile.fileExists(strFileDate) then 
	Set ObjText =  strObjFile.CreateTextFile(strFileDate,True)
	ObjText.WriteLine("1")
	daily_counter=1
	objText.Close
Else
	Set ObjText = strObjFile.OpenTextfile(strFileDate,1)
	daily_counter = CLng(ObjText.ReadLine)
	ObjText.Close
End if				 

	
'############################################################
'Oders
'############################################################
Response.Charset="windows-874"
Set Conn = Server.CreateObject("ADODB.Connection") 
Conn.open MySqlConnStr			
set rs =Server.CreateObject("ADODB.Recordset")
sql ="Select * From  ordhdr Where ORDDATE = " & strCurDate
rs.CursorLocation = 3
rs.Open sql,Conn,1,3
ordersHeader = rs.Recordcount

set rsD =Server.CreateObject("ADODB.Recordset")
sql ="Select * From  ordLin Where ORDDATE = " & strCurDate
rsD.CursorLocation = 3
rsD.Open sql,Conn,1,3
ordersItem =rsD.Recordcount

'############################################################
'Register
'############################################################

set rsReg = Server.CreateObject("ADODB.Recordset")
sql ="select Name    from msl_register "
sql =sql & " WHERE  TRANDATE = " & strCurDate
rsReg.CursorLocation = 3
rsReg.Open Sql,Conn,1,3
MslReg= rsReg.Recordcount



'############################################################
'FAQ
'############################################################

Set connFAQ = Server.CreateObject("ADODB.Connection") 
connFAQ.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & Server.MapPath("../Webboard/data/DataBoard.mdb") & ";Jet OLEDB:Database Password="
sql ="Select  * From  mboard  Where Datein = '" & strCurDate& "'"
set rsFaq = Server.CreateObject("ADODB.Recordset")
rsFaq.CursorLocation =3
rsFaq.Open sql,ConnFAQ,1,3
faq = rsFaq.Recordcount 
%>         
         
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><%=title%></title>
<link href="../Styles.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Refresh" content="30" />
</head>

<body bgcolor="#F0F8FF">
<fieldset>
  <legend>TO DAY</legend>
  <table width="428" border="0" cellspacing="0" cellpadding="1" bgcolor="#F0F8FF" style="margin-top:-1px">
    <tr>
      <td width="151" align="right">Date Time :</td>
      <td width="376"><%=now()%></td>
    </tr>
    <tr>
      <td align="right">Daily  visitors :</td>
      <td><%=formatNumber(daily_counter,0)    & "  :    " &  "Online visitor : " & Application("visitors")%> </td>
    </tr>
    <tr>
      <td align="right">Orders : </td>
      <td><% = ordersHeader & "  /  " &    ordersItem %></td>
    </tr>
    <tr>
      <td align="right">Msl. Register :</td>
      <td><%=MslReg%></td>
    </tr>
    <tr>
      <td align="right">Contact faq. :</td>
      <td><%=faq%></td>
    </tr>
  </table>
</fieldset>
</body>
</html>
