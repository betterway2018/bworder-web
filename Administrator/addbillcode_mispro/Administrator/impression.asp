<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#INCLUDE FILE="../Include/freeASPUPload1.asp" -->

<%
	curDate = year(date) & mid("00",1,2-len(month(date))) & month(date) & mid("00",1,2-len(day(date))) & day(date) 
	curTime = mid("00",1,2-len(hour(time))) & hour(time) & mid("00",1,2-len(minute(time))) & minute(time) & mid("00",1,2-len(second(time))) & second(time)

	
	If Request.ServerVariables("REQUEST_METHOD") = "POST" Then 

		dim file1
		Dim uploadsDirVar
		Dim Upload, fileName, fileSize, ks, i, fileKey
		'uploadsDirVar=Server.MapPath("../Job/rec_images")
		uploadsDirVar=Request.ServerVariables("APPL_PHYSICAL_PATH") &"Home\my_impression\"
		if right(uploadsDirVar,1) <> "\" Then uploadsDirVar  = uploadsDirVar & "\"
	 
		Set Upload = New FreeASPUpload
			
		Upload.Save(uploadsDirVar)
		ks = Upload.UploadedFiles.keys
		
		If (UBound(ks) <> -1) then
			 '  Response.write "<B>Files uploaded:</B><BR> "
				for each fileKey in Upload.UploadedFiles.keys
					if filekey = "file1" Then 
							file1 = Upload.UploadedFiles(fileKey).FileName 
							Set strObjFile = CreateObject("Scripting.FileSystemObject")
							if   strObjFile.fileExists( uploadsDirVar & file1) then 
									strExt = strObjFile.GetExtensionName( uploadsDirVar & file1) 
									strObjFile.CopyFile uploadsDirVar & file1 ,uploadsDirVar &  "my_impression.jpg",true
									file1 =uploadsDirVar &  "my_impression.jpg"
								'response.Write "new File =" & uploadsDirVar &  "my_impression.jpg"
							'	response.write "<BR>"
							End if		 
					End IF
				Next
				response.write"<meta http-equiv=""refresh"" content=""1"" />"
		Else
			file1=""
		End If	
	End If
	
%>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ความประทับใจผู้ใช้</title>
<link href="../styles.css" rel="stylesheet" type="text/css" />

</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="left"><!--#include file="header.asp" --></td>
  </tr>
  <tr>
    <td width="1%" align="left" valign="top"><!--#include file="menu.asp" --></td>
    <td width="99%" align="left" valign="top" bgcolor="#F3D8E6"><form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
      <br />
      <center>
        <%=file1%>
      </center>
      <table width="674" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><img src="../Home/my_impression/my_impression.jpg" width="850" height="612" class="Table_FormBorder_gray" /></td>
        </tr>
        <tr>
          <td height="45">Upload  file :
            <input name="file1" type="file" id="file1" size="60" />
            (ขนาดไฟล์ 850 x 600)</td>
        </tr>
      </table>
      <br />
      <center>
        <input type="reset" name="button2" id="button2" value="Reset" />
        <input type="submit" name="Submit" id="Submit" value="Submit" />
      </center>
      <br />
    </form></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><!--#include file="../Include/i_footer.asp" --></td>
  </tr>
</table>
</body>
</html>
