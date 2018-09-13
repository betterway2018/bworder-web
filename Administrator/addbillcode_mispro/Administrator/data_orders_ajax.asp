<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file="../Include/i_config.asp"-->
<!--#include file="../Connections/MySql_Connection.asp"-->
<!-- Star Asp Code -->

<%
Response.Charset="windows-874"

Set Conn = Server.CreateObject("ADODB.Connection") 
Conn.open MySqlConnStr
	 

mySort = request.form("Sort")
Page = Request.Form("page")
dist = Request.form("dist")
mslno = Request.form("mslno")
chkdgt = Request.form("chkdgt")
mslname = Request.form("mslname")
orddate =Request.form("orddate")
dwndate = Request.form("dwndate")
dwnstatus = Request.form("dwnstatus")

			
			
if Page ="" then Page =1
if MySort = "" Then MySort = "ORDNO"


set rs =Server.CreateObject("ADODB.Recordset")

sql ="Select * From  ordhdr"

if dwnstatus ="" then 
	 sql=sql & " WHERE DWNFLAG IN ('Y','N') "
elseif dwnstatus = "N" Then 
	sql =sql & " WHERE  DWNFLAG ='N'"
elseif dwnstatus = "Y" Then 
	sql =sql & " WHERE DWNFLAG ='Y'"
end if

if dist <> "" Then 
	sql =sql & " AND dist = '" &  dist & "'"
End If

If Isnumeric(mslno) Then 
	sql =sql &  " AND mslno = " & mslno 
End If

if Isnumeric(chkdgt) Then
	sql =sql & " And chkdgt = " & chkdgt
End If
	
if  mslname <> "" Then 
	sql =sql & " AND name like '%" & mslname & "%'"
End If

if  orddate  <> "" Then 
	sql =sql & " AND  ORDDATE  = " & replace(orddate,"-","")
End IF

if dwndate <> "" then 
	sql =sql & " AND DWNDATE = " & replace(dwndate,"-","")
End If	
	
if mySort  <> "" Then 
	sql =sql & " Order by " & mySort
End If

rs.CursorLocation =3
rs.Open sql,Conn ,1,3

if rs.REcordcount >0 Then 

	PageLen = 100
	rs.PageSize=PageLen
	rs.Absolutepage =Page
end if




%>	

<%
Function AlertMessage(msg,url)
 		response.write "<script type='text/JavaScript'>"
		response.write "javascript:alert(' " & msg &"');"
		response.write "document.location = '" & url &"';"
		response.write"</script>"
End Function
%>
<link href="../Styles.css" rel="stylesheet" type="text/css" />

<table width="685" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="40" align="left" nowrap="nowrap"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('<%=mySort%>',1);"><img src="Images/Move_first_b16.png" width="16" height="16" border="0" /></a> <a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('<%=mySort%>',<%If Page=1 Then  Response.write "1" Else Response.write (Page -1) End IF %>);"> <img src="Images/move_prev_b16.png" width="16" height="16" border="0" /></a></td>
    <td width="20" align="left" nowrap="nowrap"><%
For i = 1  to rs.Pagecount
	if cstr(i) = cstr(page)  Then 
		Response.write   "<font size=""+1"">" &  i &"</font>" & "&nbsp;&nbsp;"
		'Response.write   "<b>" &  i &"</b>" & "&nbsp;&nbsp;"
	Else

		Response.write  "<a href=""#"" style=""color:#000000"" onclick=""JavaScript:doCallAjax('" & mySort &"'," & cstr(i) &");"">"  & cstr(i)  & "</a>" & "&nbsp;&nbsp;"

		
	End If

Next 
%></td>
    <td width="40" align="right" nowrap="nowrap"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('<%=mySort%>',<%If Page>=rs.Pagecount Then  Response.write (rs.Pagecount ) Else Response.write (Page +1) End IF %>);"> <img src="Images/Move_next_b16.png" width="16" height="16" border="0" /></a> <a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('<%=mySort%>',<%=rs.Pagecount%>);"> <img src="Images/Move_last_b16.png" width="16" height="16" border="0" /></a></td>
    <td width="585" align="left" nowrap="nowrap"><%
	If   ( PageLen * page) > rs.RecordCount Then 
		 toPage=rs.Recordcount
	Else
		toPage =  ( PageLen * page) 
	End IF
	
	%>
      Records :<%=cstr(PageLen * (page-1) +1)&  "-" &   toPage & " / " & rs.Recordcount%></td>
  </tr>
</table>

<table width="1458" border="0" cellpadding="0" cellspacing="1" class="FormBorder_1967DB">
  <tr style="background-image:url(images/bg_menu.gif);background-position:left;background-repeat:repeat-x;height:25px;font-weight:bold;color:#FFF">
    <td width="89" align="center" > <a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('ORDCAMP',<%=page%>);">CAMPAIGN</a></td>
    <td width="116" align="center"> <a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('ORDNO',<%=page%>);">ORD. NO.</a></td>
    <td width="137" height="26" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('ORDDATE',<%=page%>);">DATE /TIME</a></td>
    <td width="130" align="center"> <a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('DIST',<%=page%>);">MSL. CODE</a></td>
    <td width="291" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('NAME',<%=page%>);">NAME</a></td>
    <td width="87" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('CURCAMP',<%=page%>);">CUR. CAMP</a></td>
    <td width="94" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('BILLDATE',<%=page%>);"> BILL</a></td>
    <td width="122" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('SHIPDATE',<%=page%>);">SHIP </a></td>
    <td width="132" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('DWNFLAG',<%=page%>);">DOWNLOAD</a></td>
    <td width="147" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('DWNDATE',<%=page%>);">DOWNLOAD DATE</a></td>
    <td width="101" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('STATUS',<%=page%>);">STATUS</a></td>
  </tr>
  <%
i = 0
rec =0
Do While Not rs.Eof and  rec <=PageLen
	If i Mod 2 =0 Then 
		bg_color = "#E6EFF9"
	Else
		bg_color ="#A9CAE2"
	End If

%>
  <tr   bgcolor="<%=bg_color%>">
    <td width="89" align="center" nowrap="nowrap" ><%=MID(rs("ORDCAMP"),5,2) &"/" & MID(rs("ORDCAMP"),1,4)%></td>
    <td width="116" align="center" nowrap="nowrap" ><a href="../Orders/order_preview.asp?id=<%=rs("ORDNO")&"&dist="&rs("DIST")&"&mslno=" & rs("MSLNO") & "&chkdgt=" & rs("CHKDGT") & "&camp=" & rs("ORDCAMP")%>" target="_blank"><%=rs("ORDNO")%></a></td>
    <td width="137" height="21" align="center" nowrap="nowrap" ><%=MID(rs("ORDDATE"),7,2) & "/" & MID(rs("ORDDATE"),5,2) & "/" & MID(rs("ORDDATE"),1,4) & "  " & MID(rs("ORDTIME"),1,2) & ":" & MID(rs("ORDTIME"),3,2)  &":" & MID(rs("ORDTIME"),5,2) %></td>
    <td width="130"  align="left" nowrap="nowrap"><%=rs("DIST") & "-" & Right("00000"& rs("MSLNO"),5) & "-" & rs("CHKDGT")%></td>
    <td width="291"  align="left" nowrap="nowrap"><%=rs("NAME")%></td>
    <td height="21"  align="left" nowrap="nowrap"><%=MID(rs("CURCAMP"),5,2) & "/" & MID(rs("CURCAMP"),1,4)%></td>
    <td height="21" align="left" nowrap="nowrap">
	<%
		if rs("BILLDATE")  <> 0 Then 
			 response.write MID(rs("BILLDATE"),7,2) & "/" & MID(rs("BILLDATE"),5,2) & "/" & MID(rs("BILLDATE"),1,4)
		End If
			 %></td>
    <td height="21" align="center" nowrap="nowrap">
	<%
		If rs("SHIPDATE")  <> 0 Then 	
			 response.write MID(rs("SHIPDATE"),7,2) & "/" & MID(rs("SHIPDATE"),5,2) & "/" & MID(rs("SHIPDATE"),1,4)
		End If
	%></td>
    <td align="center"><%=rs("DWNFLAG")%></td>
    <td align="center">
	<%
		If rs("DWNDATE") <> 0 Then 
		  Response.write 	MID(rs("DWNDATE"),7,2) & "/" & MID(rs("DWNDATE"),5,2) & "/" & MID(rs("DWNDATE"),1,4) 
		 End If
	%>
    
    </td>
    <td align="center"><%=rs("STATUS") %></td>
  </tr>
  <%
	i =i+1
	rec=rec+1
	rs.MoveNext
Loop	
%>
</table>
<%response.write sql
'response.write "<br>"%>

