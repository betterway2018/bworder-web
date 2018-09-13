<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file="../Include/i_config.asp"-->
<!--#INCLUDE FILE="../Include/freeASPUPload1.asp" -->

<meta http-equiv='Content-Type' content='text/html; charset=windows-874'>

<%
Dim Connext
dim maxid 
dim curDate
dim curTime
'
Response.Write "กรุณารอสักครู่นะคะ ..."
response.write "<BR>"

'Request.ServerVariables("APPL_PHYSICAL_PATH") &"counters\counters.txt"
'on error resume next
DBPath = Server.MapPath("../Orders/promotion.mdb") 
Set Conn = Server.CreateObject("ADODB.Connection") 
Conn.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & DBPath & ";Jet OLEDB:Database Password="

curDate = year(date) & mid("00",1,2-len(month(date))) & month(date) & mid("00",1,2-len(day(date))) & day(date) 
curTime = mid("00",1,2-len(hour(time))) & hour(time) & mid("00",1,2-len(minute(time))) & minute(time) & mid("00",1,2-len(second(time))) & second(time)


curCamp = Request.form("txtCamp")
toCamp = request.form("txtyear2") & Request.form("txtcamp2")
rStatus = Request.form("txtStatus")

response.write "cur =" & curCamp & "   to Camp =" & toCamp

'Delete Older


sql ="Delete From PromotionHeader Where Camp =" & toCamp
Conn.execute sql
sql ="Delete From PromotionData Where   Camp =" &  toCamp
Conn.Execute sql

set rsH = Server.CreateObject("ADODB.Recordset") 
set rsD = Server.CreateObject("ADODB.Recordset") 

sql ="Select * From PromotionHeader Where Camp =" & curCamp

rsH.Open Sql ,Conn,1,3

sql ="Select * From PromotionData Where Camp  =" & curCamp
rsD.Open sql,Conn,1,3


'INSERT DATA
Do While Not rsH.Eof 
	Sql ="INSERT INTO PromotionHeader(CAMP,JPGFile,JPG_None_Login,Ext_file,Status) Values("
	sql =sql &  toCamp & ","
	sql =sql &  "'" &  rsH("JPGFile") & "'" & ","
	sql =sql &  "'" &  rsH("JPG_None_Login") & "'" & ","
	sql =sql & "'" & rsH("Ext_File") & "'" & ","
	sql =sql & "'" &  rStatus & "'" & ")"
	Conn.execute sql
	rsH.MoveNext
Loop

Do While Not rsD.Eof
	
		Sql ="INSERT INTO PromotionData(CAMP,BillCode,Billdesc,Price)VALUES("
		sql =sql &  toCamp & ","
		sql =sql &  "'" & rsD("BillCode") & "'" & ","
		sql =sql & "'" &  rsD("BillDesc") & "'" & ","
		sql =sql &  rsD("Price") & ")"
		
		Conn.execute sql
	
	
	rsD.MoveNExt
Loop
Response.Redirect("promotion.asp")
 %>
