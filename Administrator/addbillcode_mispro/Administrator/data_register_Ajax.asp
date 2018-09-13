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
datefrom =Request.form("datefrom")
dateto = Request.form("dateto")


if Page ="" then Page =1
if MySort = "" Then MySort = "TRANDATE"


set rs =Server.CreateObject("ADODB.Recordset")
sql ="Select * From  msl_register"

if  datefrom  <> ""   and dateto ="" then 
	sql =sql & " WHERE TRANDATE = " & replace(datefrom,"-" ,"")
elseif datefrom ="" and dateto<>"" then 
	sql =sql  & " WHERE  TRANDATE = " & replace(dateto,"-","")	
elseif datefrom <> "" and dateto <> "" then 
	sql =sql  & " WHERE TRANDATE BETWEEN  " & replace(datefrom,"-","") & " AND " &  replace(dateto,"-","")
end if

if mySort  <> "" Then 
	sql =sql & " Order by " & mySort
End If

'response.write "sql =" & sql

rs.CursorLocation =3
rs.Open sql,Conn ,1,3

if rs.RecordCount > 0 Then 
	PageLen = 100
	rs.PageSize=PageLen
	rs.Absolutepage =Page
end If



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

<table width="239" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="39" align="left" nowrap="nowrap"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('<%=mySort%>',1);"><img src="Images/Move_first_b16.png" width="16" height="16" border="0" /></a> <a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('<%=mySort%>',<%If Page=1 Then  Response.write "1" Else Response.write (Page -1) End IF %>);"> <img src="Images/move_prev_b16.png" width="16" height="16" border="0" /></a></td>
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
    <td width="39" align="right" nowrap="nowrap"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('<%=mySort%>',<%If Page>=rs.Pagecount Then  Response.write (rs.Pagecount ) Else Response.write (Page +1) End IF %>);"> <img src="Images/Move_next_b16.png" width="16" height="16" border="0" /></a> <a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('<%=mySort%>',<%=rs.Pagecount%>);"> <img src="Images/Move_last_b16.png" width="16" height="16" border="0" /></a></td>
    <td width="131" align="center" nowrap="nowrap"><%
	If   ( PageLen * page) > rs.RecordCount Then 
		 toPage=rs.Recordcount
	Else
		toPage =  ( PageLen * page) 
	End IF
	
	%>
      Records :<%=cstr(PageLen * (page-1) +1)&  "-" &   toPage & " / " & rs.Recordcount%></td>
  </tr>
</table>

<table width="950" border="0" cellpadding="0" cellspacing="1" class="FormBorder_1967DB">
  <tr style="background-image:url(Images/bar_email1_06.png);background-position:left;background-repeat:repeat-x;height:25px;font-weight:bold;color:#FFF">
    <td width="156" height="26" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('TRANDATE',<%=page%>);">DATE /TIME</a></td>
    <td width="200" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('NAME',<%=page%>);">NAME</a></td>
    <td width="186" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('ADDRESS',<%=page%>);">ADDRESS</a></td>
    <td width="77" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('PHONE',<%=page%>);"> PHONE</a></td>
    <td width="133" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('EMAIL',<%=page%>);">E-MAIL</a></td>
    <td width="73" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('DWNFLAG',<%=page%>);">DOWNLOAD</a></td>
    <td width="64" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('FLAG1',<%=page%>);">FLAG1/2</a></td>
    <td width="65" align="center">ss</td>
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
    <td width="156" height="21" align="center" nowrap="nowrap" ><%=MID(rs("TRANDATE"),7,2) & "/" & MID(rs("TRANDATE"),5,2) & "/" & MID(rs("TRANDATE"),1,4) & "  " & MID(rs("TRANTIME"),1,2) & ":" & MID(rs("TRANTIME"),3,2)  &":" & MID(rs("TRANTIME"),5,2) %></td>
    <td width="200"  align="left" nowrap="nowrap"><%=rs("NAME")%></td>
    <td height="21"  align="left" nowrap="nowrap"><%=rs("ADDRESS") &  " µÓºÅ/á¢Ç§" & rs("TUMBOL" ) & " à¢µ/ÍÓàÀÍ" & rs("AMPHUR") & " ¨Ñ§ËÇÑ´" & rs("PROVINCE")%></td>
    <td height="21" align="left" nowrap="nowrap"><%=rs("PHONE")%></td>
    <td height="21" align="center" nowrap="nowrap"><%=rs("EMAIL")%></td>
    <td align="center"><%=rs("DWNFLAG")%></td>
    <td align="center"><%=rs("FLAG1") & "  /  " & rs("FLAG2")%></td>
    <td align="center"><%=rs("WEBSITE_ID")%></td>
  </tr>
  <%
	i =i+1
	rec=rec+1
	rs.MoveNext
Loop	
%>
</table>

