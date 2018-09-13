<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file="../Include/i_config.asp"-->
<!--#INCLUDE FILE="../Include/freeASPUPload1.asp" -->

<%
Dim Connext
dim maxid 
dim curDate
dim curTime
'

Response.Write "กรุณารอสักครู่นะคะ ... "
response.write "<BR>"



curDate = year(date) & mid("00",1,2-len(month(date))) & month(date) & mid("00",1,2-len(day(date))) & day(date) 
curTime = mid("00",1,2-len(hour(time))) & hour(time) & mid("00",1,2-len(minute(time))) & minute(time) & mid("00",1,2-len(second(time))) & second(time)

dim file1,strExt
Dim uploadsDirVar
Dim Upload, fileName, fileSize, ks, i, fileKey
uploadsDirVar=Server.MapPath("../News/news_images")
if right(uploadsDirVar,1) <> "\" Then uploadsDirVar  = uploadsDirVar & "\"
 
Set strObjFile = CreateObject("Scripting.FileSystemObject")

''Request.ServerVariables("APPL_PHYSICAL_PATH") &"counters\counters.txt"
on error resume next
DBPath = Server.MapPath("../news/news_data.mdb") 
Set Conn = Server.CreateObject("ADODB.Connection") 
Conn.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & DBPath & ";Jet OLEDB:Database Password="



sql ="Select * From News Where  id = '" & request.QueryString("id") & "'" 
set rs = Server.CreateObject("ADODB.Recordset") 
rs.Open sql,Conn,1,3
if not rs.Eof  Then 
	if   strObjFile.fileExists(uploadsDirVar &  rs("imageFile")) then 
			strExt = strObjFile.GetExtensionName( uploadsDirVar &  rs("imageFile"))
	End If
End IF


sql ="Delete From News Where id = '" &  request.QueryString("id") & "'" 
Conn.Execute sql


 
if Err.Number  <> 0 Then 
	Response.write   Err.Number & " : " & Err.Description
	response.write "<br><br>" & sql & "<br><br>"
	response.write "<center><a href=""javascript:history.back();"">back</a> <center>"
	Response.End()
End If
response.Redirect("upload_news.asp")
response.End()
%>


