<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file ="asp_WebService_config.asp"-->
<%
	response.Charset="Windows-874"

	dist= request("dist")
	mslno=request("mslno")
	chkdgt=request("chkdgt")
	fname=request("fname")
	lname=request("lname")
	
'	response.write    "|0" 
'	response.End()

	'file BWORDER 
	
'	response.write   dist &"-" & right("00000" & mslno,5) & "-" & chkdgt
'	response.End()
	
    Dim xmlhttp
    Dim DataToSend
    Dim postUrl
	
	if len(dist)=3 then
		DataToSend="UID=caw&PWD=caw320&dist=" & dist & "&mslno=" & mslno & "&chkdgt=" & chkdgt
		postUrl = "http://10.0.0.57/VSWebservice" & "/Rep_info.asmx/get_MSLMST" & "?" & DataToSend
		'postUrl="http://webservice.mistine.co.th/webservice/Rep_info.asmx/get_MSLMST" & "?" & DataToSend
		'postUrl="http://webservice.mistine.co.th/webservice/Rep_info.asmx/get_MSLMST" & "?" & DataToSend
		'postUrl="http://mailsrv-01.mistine.co.th/webservice/Rep_info.asmx/get_MSLMST" & "?" & DataToSend
		'postUrl= "http://mailsrv-01.mistine.co.th/webservice/Rep_info.asmx?op=get_MSLMST"
	elseif len(dist)=4 then
		DataToSend="REPCODE=" & dist & right("00000" & mslno,5) & chkdgt
		postUrl ="http://10.0.0.57/VSWebservice" & "/Get_Repname4digit.asmx/GET_RepresentativeName" & "?" & DataToSend
	end if
    
	Set xmlhttp = server.Createobject("MSXML2.XMLHTTP")
'	xmlhttp.Open "POST",postUrl,false
'	xhr.ontimeout = timeoutFired;
    xmlhttp.Open "GET",postUrl,false
    xmlhttp.setRequestHeader "Content-Type","application/x-www-form-urlencoded"
    xmlhttp.send  'DataToSend
'	Response.Write DataToSend  & "<br>"
'	Response.Write(xmlhttp.responseText)
'	Response.write xmlhttp.responsexml.xml
	
	dim result
	dim result2
	dim rep_name
	dim rep_ar
	on error resume next

	result=xmlhttp.responseText
	
	'response.write  result
	'response.End()
	
	arr = split(result,"|")
	if len(dist)=3 then
		rep_name = trim(arr(3))
		rep_ar = trim(arr(5))
		rep_birthdate = ""
	elseif len(dist)=4 then
		rep_name = trim(arr(1))
		rep_ar = trim(arr(2))
		rep_birthdate = trim(arr(3))
	end if
	if Err.Number<>0 Then 
		Response.write "|0"
		
	else
		'response.write   result2
		response.write   rep_name & "|" &  rep_ar & "|" &  rep_birthdate
		
	end If
	
       
%>
