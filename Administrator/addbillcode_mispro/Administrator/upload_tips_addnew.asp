<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<!--#include file="../Include/i_config.asp"-->
<!--#INCLUDE FILE="../Include/freeASPUPload1.asp" -->

<%
Dim Connext
dim maxid 
dim curDate
dim curTime
'
Response.Charset="windows-874"
Response.Write "กรุณารอสักครู่นะคะ ... "
response.write "<BR>"

curDate = year(date) & mid("00",1,2-len(month(date))) & month(date) & mid("00",1,2-len(day(date))) & day(date) 
curTime = mid("00",1,2-len(hour(time))) & hour(time) & mid("00",1,2-len(minute(time))) & minute(time) & mid("00",1,2-len(second(time))) & second(time)


''Request.ServerVariables("APPL_PHYSICAL_PATH") &"counters\counters.txt"
'on error resume next
DBPath = Server.MapPath("../tips/tips_data.mdb") 
Set Conn = Server.CreateObject("ADODB.Connection") 
Conn.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & DBPath & ";Jet OLEDB:Database Password="

On error Resume Next
	dim file1,strExt
  	Dim uploadsDirVar
	Dim Upload, fileName, fileSize, ks, i, fileKey
	uploadsDirVar=Server.MapPath("../tips/tips_images")
	if right(uploadsDirVar,1) <> "\" Then uploadsDirVar  = uploadsDirVar & "\"
 
 	Set strObjFile = CreateObject("Scripting.FileSystemObject")
    Set Upload = New FreeASPUpload

   
   Upload.Save(uploadsDirVar)
	
	ks = Upload.UploadedFiles.keys
	
	If (UBound(ks) <> -1) then
		 '  Response.write "<B>Files uploaded:</B><BR> "
			for each fileKey in Upload.UploadedFiles.keys
				if filekey = "file1" Then 
						file1 = Upload.UploadedFiles(fileKey).FileName 
						if   strObjFile.fileExists(uploadsDirVar & file1) then 
								strExt = strObjFile.GetExtensionName( uploadsDirVar & file1) 
						else 
							file1 =""
							strExt=""
						End if		
												
				End IF
			Next
	Else
		file1=""
		strExt=""
	End If
	
if Err.Number  <> 0 Then 
	Response.write   Err.Number & " : " & Err.Description
	response.write "<br><br>" & sql & "<br><br>"
	response.write "<center><a href=""javascript:history.back();"">back</a> <center>"
	Response.End()
End If

'"INSERT DATA TO TABLE
'response.write "id =" & Upload.form("txtid") & "<br />"
'response.write "seq = " & Upload.form("txtseq") & "<br />"
'response.End()

On error Resume Next

if not Isnumeric( Upload.form("txtseq")) Then 
 	seq = 9
else
	seq = Upload.form("txtseq")
end if



sql ="INSERT INTO tips(id,LineSeq,Subject,Detail,Post_date,IsDefault,ImageFile,Ext_File)  VALUES("
sql =sql & "'" & Upload.form("txtid") & "'" & ","
sql =sql &   seq & ","
sql =sql & "'" & Upload.Form("txtSubject") & "'" & ","
sql =sql & "'" & Upload.Form("txtDetail") & "'" & ","
sql =sql & "'" & Upload.Form("txtPostdate") & "'" & ","
sql =sql & "'" & Upload.form("txtDefault" ) & "'" & ","
sql =sql & "'" & file1 & "'" & ","
sql =sql & "'" & strExt & "'" & ")"
Conn.Execute sql

if Err.Number  <> 0 Then 
	Response.write   Err.Number & " : " & Err.Description
	response.write "<br><br>" & sql & "<br><br>"
	response.write "<center><a href=""javascript:history.back();"">back</a> <center>"
	Response.End()
End If
response.Redirect("upload_tips.asp")
response.End()
%>


