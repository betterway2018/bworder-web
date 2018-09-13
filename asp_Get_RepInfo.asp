<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file ="asp_WebService_config.asp"-->
<%
	response.Charset="Windows-874"
	
	dist= request("dist")
	mslno=request("mslno")
	chkdgt=request("chkdgt")
	paydate =request("paydate")
	
	
	'response.write   dist &"-" & right("00000" & mslno,5) & "-" & chkdgt
	'response.End()
	
	'response.write  "paydate =" & paydate
	
    Dim xmlhttp
    Dim DataToSend
    Dim postUrl
	
	
	DataToSend="uid=caw&pwd=caw320&dist=" & dist & "&mslno=" & mslno & "&chkdgt=" & chkdgt
	postUrl="http://10.0.0.57/VSWebservice" & "/rep_info.asmx/get_MSLMST" & "?" & DataToSend
	postUrl2="http://10.0.0.57/VSWebservice" & "/rep_info.asmx/get_BPR" & "?" & DataToSend

	'postUrl="http://webservice.mistine.co.th/webservice/Rep_info.asmx/get_MSLMST" & "?" & DataToSend
	'postUrl="http://webservice.mistine.co.th/webservice/Rep_info.asmx/get_MSLMST" & "?" & DataToSend
	
	
	Set xmlhttp = server.Createobject("MSXML2.XMLHTTP")
'    xmlhttp.Open "POST",postUrl,false
    xmlhttp.Open "GET",postUrl,false
    xmlhttp.setRequestHeader "Content-Type","application/x-www-form-urlencoded"
    xmlhttp.send  'DataToSend
	'Response.Write DataToSend  & "<br>"
   'Response.Write(xmlhttp.responseText)
   'Response.write xmlhttp.responsexml.xml
   
   	
	dim result
	dim result2
	dim rep_name
	dim rep_ar
	
	'on error resume next
	result=xmlhttp.responseText
	arr = split(result,"|")
	result2 =  trim(arr(1))
	
	if  result2 = "1" then
		rep_code =trim(arr(2))
		rep_name = trim(arr(3))
		rep_status=trim(arr(4))
		rep_ar = trim(arr(5))	
		rep_adr1=trim(arr(6))
		rep_adr2=trim(arr(7))
		rep_adr3=trim(arr(8))
		'rep_adr4=trim(arr(9))
		rep_adr4= left(trim(arr(9)),30)
		rep_phone=trim(arr(10))
		rep_mobile = right(trim(arr(9)),10)
	'response.write "addr4 =" & arr(9)
	else
		response.write "ขออภัยค่ะ ... </br> ไม่สามารถแสดงข้อมูลได้ค่ะ" & "<br>" & arr(2)
		response.end
	end if
	
	
   	Set xmlhttp2 = server.Createobject("MSXML2.XMLHTTP")
'    xmlhttp.Open "POST",postUrl,false
    xmlhttp2.Open "GET",postUrl2,false
    xmlhttp2.setRequestHeader "Content-Type","application/x-www-form-urlencoded"
    xmlhttp2.send  'DataToSend
	

   result3 = xmlhttp2.responseText
   arr2= split(result3,"|")
   if trim(arr2(1)) = "1" then 
   	 	PNT = trim(arr2(2))
   else
   		PNT = "0"
   end if

   timeStamp=now    
	
	
	'Paydate
	
	PayDate ="กรุณาชำระเงินภายในวันที่  "  & Mid(PayDate,7,2)  & "/" &  Mid(PayDate,5,2) & "/" & MID(PayDate,1,4)
	
%>


<table width="657" border="0" align="center" cellpadding="3" cellspacing="0">
  <tr>
    <td width="651"><fieldset >
      <table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" style="font-family:Tahoma, Geneva, sans-serif;font-size:11px">
        <tr>
          <td width="95%" height="34" align="left"><font style="font-family:Tahoma, Geneva, sans-serif;font-size:13px" ><strong>รหัส/ชื่อ สมาชิก :</strong><%=rep_code & "   " & rep_name%></font></td>
          <td width="5%">&nbsp;</td>
        </tr>
        <tr>
          <td height="27" align="left"><font style="font-family:Tahoma, Geneva, sans-serif;font-size:14px" ><strong>คะแนนสะสมเบทเตอร์เวย์ พอยท์ รีวอร์ด
            ของคุณที่มีอยู่ตอนนี้ คือ :</strong><font color="#FF0000">
              <%
				If CDBL(PNT) =0 Then 
					Response.write "0"
				Else
					Response.write formatnumber(PNT,0)
				End If
			%>
            </font>คะแนน</font> </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td height="31" align="left"><font style="font-family:Tahoma, Geneva, sans-serif;font-size:14px" ><strong>ยอดเงินที่ท่านต้องชำระก่อนการสั่งซื้อ
            สินค้าครั้งต่อไปคือ  :</strong></font><font style="font-family:Tahoma, Geneva, sans-serif;font-size:14px;color:#FF0000" >
              <%
		  		IF cdbl(rep_ar)<=0 Then 
						response.write "0.00"
				else
						response.write   formatnumber(rep_ar,2)
				End If
			%> </font> บาท
            <font style="font-family:Tahoma, Geneva, sans-serif;font-size:14px;color:#FF0000" >
              <%  'Response.write  MID(BillDAte,7,2) &"/" & MID(BillDate,5,2) & "/" & MID(BillDate,1,4) 
		  		'Response.write befBillDate
				IF cdbl(rep_ar) > 0 Then  response.write  "<br><br><center>" & PayDate  & "</center>" End If
		  %>
          </font>
            </td>
          <td>&nbsp;</td>
        </tr>
        <% 
IF cdbl(rep_ar) > 0 Then 
%>
        <%End If%>
        <tr>
          <td align="left">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" align="right"><table width="641" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="575" align="right"><font color="#FF0000" size="-1" >
                <% Response.write "หมายเหตุ : ประมวลผล ณ  วันที่  " & timeStamp  %>
              </font></td>
              <td width="66">&nbsp;</td>
            </tr>
          </table></td>
        </tr>
      </table>
    </fieldset></td>
  </tr>
</table>
