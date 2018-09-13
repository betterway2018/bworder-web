<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file="../Include/i_config.asp"-->
<!--#include file="../Connections/MySql_Connection.asp"-->
<!-- Star Asp Code -->

<%
'Response.ContentType = "text/html"

'Response.Charset="windows-874"
'Response.charset="utf-8"
Response.Charset = "TIS-620"
Set Conn = Server.CreateObject("ADODB.Connection") 
Conn.open MySqlConnStr


mySort = request.form("Sort")
Page = Request.Form("page")
dist = Request.form("dist")
mslno = Request.form("mslno")
chkdgt = Request.form("chkdgt")
mslname = Request.form("mslname")
datefrom =Request.form("datefrom")
dateto = Request.form("dateto")
email = Request.form("email")


if Page ="" then Page =1
if MySort = "" Then MySort = "DIST"


set rs =Server.CreateObject("ADODB.Recordset")
sql ="Select * From  mslmst"

sql =sql & " Where Status  <> '' "

if dist <> "" then 
	sql =sql & " And dist = '" & dist & "'"
end if

if Isnumeric(mslno) Then 
	sql=sql &  " AND mslno =" & mslno 
end if

if  Isnumeric(chkdgt)  Then 
	sql =sql & " AND chkdgt = " & chkdgt
end if

if mslname  <> "" then 
	sql =sql & " AND  Name LIKE '%" & mslname & "%'"
end if

if  datefrom  <> ""   and dateto ="" then 
	sql =sql & " AND REG_DATE = " & replace(datefrom,"-" ,"")
elseif datefrom ="" and dateto<>"" then 
	sql =sql  & " and REG_DATE = " & replace(dateto,"-","")	
elseif datefrom <> "" and dateto <> "" then 
	sql =sql  & " AND REG_DATE BETWEEN  " & replace(datefrom,"-","") & " AND " &  replace(dateto,"-","")
end if

if email <> "" then 
	sql =sql & " AND Email  LIKE '%" & email & "%'"
End if



if mySort  <> "" Then 
	sql =sql & " Order by " & mySort
End If


rs.CursorLocation =3
rs.Open sql,Conn ,1,3

if rs.Recordcount >0 Then 

	PageLen = 100
	rs.PageSize=PageLen
	rs.Absolutepage =Page
end if

response.write "sql =" & sql


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

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="786"><table width="39%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="15%" height="19" align="left" nowrap="nowrap">
      <a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('<%=mySort%>',1);"><img src="Images/Move_first_b16.png" width="16" height="16" border="0" />
        </a>
        <a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('<%=mySort%>',<%If Page=1 Then  Response.write "1" Else Response.write (Page -1) End IF %>);">
              <img src="Images/move_prev_b16.png" width="16" height="16" border="0" />
        </a>
        </td>
        <td width="34%" align="center" nowrap="nowrap">
<%
For i = 1  to rs.Pagecount
	if cstr(i) = cstr(page)  Then 
		Response.write   "<font size=""+1"">" &  i &"</font>" & "&nbsp;&nbsp;"
		'Response.write   "<b>" &  i &"</b>" & "&nbsp;&nbsp;"
	Else

		Response.write  "<a href=""#"" style=""color:#000000"" onclick=""JavaScript:doCallAjax('" & mySort &"'," & cstr(i) &");"">"  & cstr(i)  & "</a>" & "&nbsp;&nbsp;"

		
	End If

Next 
%>        

</td>


        <td width="14%" align="right" nowrap="nowrap">
        <a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('<%=mySort%>',<%If Page>=rs.Pagecount Then  Response.write (rs.Pagecount ) Else Response.write (Page +1) End IF %>);">
        <img src="Images/Move_next_b16.png" width="16" height="16" border="0" />
        </a>
        <a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('<%=mySort%>',<%=rs.Pagecount%>);">
        <img src="Images/Move_last_b16.png" width="16" height="16" border="0" />
        </a>
        </td>
        <td width="37%" align="right" nowrap="nowrap"><%
	If   ( PageLen * page) > rs.RecordCount Then 
		 toPage=rs.Recordcount
	Else
		toPage =  ( PageLen * page) 
	End IF
	
	%>
Records :<%=cstr(PageLen * (page-1) +1)&  "-" &   toPage & " / " & rs.Recordcount%></td>
      </tr>
    </table></td>
    <td width="247" align="right">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="FormBorder_1967DB">
  <tr style="background-image:url(Images/bar_email1_06.png);background-position:left;background-repeat:repeat-x;height:25px;font-weight:bold;color:#FFF">
    <td width="78" height="26" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('DIST',<%=page%>);">MSL. CODE</a></td>
    <td width="174" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('NAME',<%=page%>);">NAME</a></td>
    
    <td width="113" align="center">PASSWORD</td>
    
    <td width="189" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('EMAIL',<%=page%>);">E-MAIL</a></td>
    <td width="69" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('PHONE',<%=page%>);"> PHONE</a></td>
    <td width="75" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('BIRTHDATE',<%=page%>);">BIRTH DATE</a></td>
    <td width="119" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('REG_DATE',<%=page%>);">REGISTER DATE</a></td>
    <td width="36" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('STATUS',<%=page%>);">STATUS</a></td>
    <td width="37" align="center">&nbsp;</td>
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
    <td height="21" align="center" nowrap="nowrap" ><%=rs("DIST") & "-" & Right("00000"&rs("MSLNO"),5) & "-" & rs("CHKDGT")%></td>
    <td  align="left" nowrap="nowrap"><%=rs("NAME")%></td>
    <td  align="left"><% 
			if Session("Admin_Login") ="callcenter"  Then 
				response.write rs("PWD")
			Else
				response.write "********"
			End If
			
	
	%></td>
    <td height="21"  align="left"><%=rs("EMAIL")%></td>
    <td height="21" align="left" nowrap="nowrap"><%=rs("PHONE")%></td>
    <td height="21" align="center" nowrap="nowrap"><%=MID(rs("BIRTHDATE"),7,2) & "/" & MID(rs("BIRTHDATE"),5,2) & "/" & MID(rs("BIRTHDATE"),1,4) %></td>
    <td align="center"><%=MID(rs("REG_DATE"),7,2) & "/" & MID(rs("REG_DATE"),5,2) & "/" & MID(rs("REG_DATE"),1,4) & "  " & MID(rs("REG_TIME"),1,2) & ":" & MID(rs("REG_TIME"),3,2)  &":" & MID(rs("REG_TIME"),5,2)  %></td>
    <td align="center"><%=rs("STATUS")%></td>
    <td align="center">&nbsp;</td>
  </tr>
  <%
	i =i+1
	rec=rec+1
	rs.MoveNext
Loop	
%>
</table>

