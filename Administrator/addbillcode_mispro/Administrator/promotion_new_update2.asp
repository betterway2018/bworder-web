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

Response.Write "��س����ѡ����Ф� ..."
response.write "<BR>"

''Request.ServerVariables("APPL_PHYSICAL_PATH") &"counters\counters.txt"
'on error resume next
DBPath = Server.MapPath("../Orders/promotion.mdb") 
'Response.Write DBPath
Set Conn = Server.CreateObject("ADODB.Connection") 
Conn.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & DBPath & ";Jet OLEDB:Database Password="

curDate = year(date) & mid("00",1,2-len(month(date))) & month(date) & mid("00",1,2-len(day(date))) & day(date) 
curTime = mid("00",1,2-len(hour(time))) & hour(time) & mid("00",1,2-len(minute(time))) & minute(time) & mid("00",1,2-len(second(time))) & second(time)

dim file1
Dim uploadsDirVar
Dim Upload, fileName, fileSize, ks, i, fileKey
uploadsDirVar=Server.MapPath("../Orders/Promotion")
if right(uploadsDirVar,1) <> "\" Then uploadsDirVar  = uploadsDirVar & "\"
Set Upload = New FreeASPUpload
Set strObjFile = CreateObject("Scripting.FileSystemObject")
Upload.Save(uploadsDirVar)
ks = Upload.UploadedFiles.keys

If (UBound(ks) <> -1) then
	 '  Response.write "<B>Files uploaded:</B><BR> "
		for each fileKey in Upload.UploadedFiles.keys
			if filekey = "file1" Then 
					file1 = Upload.UploadedFiles(fileKey).FileName 
					
					if   strObjFile.fileExists( uploadsDirVar & file1) then 
							strExt = strObjFile.GetExtensionName( uploadsDirVar & file1) 
					End if		 
			End IF
		Next
Else
	file1=""
	strExt=""
End If


'Conn.Begintrans
'INSERT DATA
Sql ="UPDATE   PromotionHeader SET "
If file1  <> "" Then 
	sql =sql &  "jpgfile =" & "'" &  file1 & "'" & ","
	sql =sql & "ext_file =" &  "'" & strExt & "'" & ","
End If
sql =sql & "Status =" &  "'" & Upload.form("txtStatus") & "'" 
sql =sql &" Where Camp =" &  Upload.form("txtcamp") 
response.write "sql =" & sql 
response.write "<br>"
'response.End()
Conn.execute sql

sql ="Delete From PromotionData Where   Camp =" &  Upload.form("txtcamp") 
Conn.Execute sql

For i = 1 to 20
	if Upload.form("txtid" & cstr(i))<> "" And Upload.form("txtname" & cstr(i)) <>"" Then 
		Sql ="INSERT INTO PromotionData(CAMP,BillCode,Billdesc,Price)VALUES("
		sql =sql &  Upload.form("txtcamp")  & ","
		sql =sql &  "'" & Upload.form("txtid" & cstr(i)) & "'" & ","
		sql =sql & "'" & Upload.form("txtname" & cstr(i))& "'" & ","
		if Isnumeric(Upload.form("txtprice" & cstr(i) )) Then 
			sql =sql & Upload.form("txtprice" & cstr(i)) & ")"
		else
			sql =sql & "0" & ")"
		end IF
		Conn.execute sql
		response.write "sql =" & sql 
		response.write "<br>"		
	End If
Next



'Conn.Commit
Response.Redirect("promotion.asp")

    
    %>
