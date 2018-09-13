<%@LANGUAGE="VBSCRIPT" %>

<%
	response.Charset="tis-620"
	
	SessionID = Request("SessionID")
	
	dist = request("dist")
	mslno=request("mslno")
	chkdgt=request("chkdgt")
	
	BillCamp = request("billcamp")
	
	BillCampSend = Right(BillCamp,2) + Left(BillCamp,4)
	
	BillCode = request("billcode")
	
	BillName = request("billname")
	
	OrdUnit = request("ordunit")
	
	OrdQty = request("ordqty")
	
	OrdType = "NET"
	
	ProgID = "BWORDER"
	
	
    Dim xmlhttp
    Dim DataToSend
    Dim postUrl
	
	
		DataToSend="p_OuCode=000&p_SessionID=" & SessionID & "&p_LocCode=" & dist & "&p_RepCode=" & dist & right("00000" & mslno,5) & chkdgt & "&p_BillCamp=" & BillCampSend & "&p_BillCode=" & BillCode & "&p_BillName= " & BillName & "&p_OrdUnit=" & OrdUnit & "&p_UserOrdUnit=" & OrdQty &  "&p_ProgID=" & ProgID & "&p_OrdType=" & OrdType & ""
		postUrl = "http://10.0.0.57/VSWebservice_Test/VRStock.asmx/genBillBooking" & "?" & DataToSend
	
	'response.write postUrl
	

	
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
	dim rep_gold
	dim rep_point
	dim rep_bd
	on error resume next

	result=xmlhttp.responseText
    
'response.write  result
'	response.End()
    
	Set xmlhttp = Nothing
	
	
	arr = split(result,"|")
	'if len(dist)=3 then
	'	rep_name = trim(arr(3))
	'	rep_ar = trim(arr(5))
	'elseif len(dist)=4 then
	'	rep_name = trim(arr(1))
	'	rep_ar = trim(arr(2))
	'	rep_gold = trim(arr(3))
	'	rep_point = trim(arr(4))
	'	rep_bd = trim(arr(5))
	'end if
	'if Err.Number<>0 Then 
	'	Response.write "|0|"
	'else
		'response.write   result
		response.write 	arr(1) & "|" & arr(2) & "|" & arr(3) & "|" & arr(4)
	'end If
       
%>
