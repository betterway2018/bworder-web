<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file="../Include/i_config.asp"-->

<!-- Star Asp Code -->

<%
Response.Charset="windows-874"


dim strConn
dim Conn
dim rs 
dim  seq
strConn = "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & server.MapPath("../counters.mdb") &";Persist Security Info=False;" 
Set Conn = Server.CreateObject("ADODB.Connection") 
With Conn
		.ConnectionString =  strConn
		.CursorLocation =2
		.Open
End With


mySort = request.form("Sort")
strdatefrom = Request.Form("datefrom")
strdateto = Request.form("dateto")
campaign = Request.form("campaign")


if strdatefrom <>"" then 
	intdatefrom = MID(strdatefrom,7,4) & MID(strdatefrom,4,2) & MID(strdatefrom,1,2)
else
	intdatefrom =""	
end if

if strdateto <> "" then 
	intdateto = MID(strdateto,7,4) & MID(strdateto,4,2) & MID(strdateto,1,2)
else
	intdateto =""
end if		

if Page ="" then Page =1
if MySort = "" Then MySort = "counter_date"


set rs =Server.CreateObject("ADODB.Recordset")
sql ="Select * From  daily_counter "


if intdatefrom  <>"" and intdateto ="" then 
	sql =sql & " Where   counter_date = " & intdatefrom 
elseif  intdatefrom  ="" and intdateto <>"" then 
	sql =sql & " Where   counter_date = " & intdateto
elseif  intdatefrom  <>"" and intdateto <>"" then 
	sql =sql & " Where   counter_date between " & intdatefrom & " and " & intdateto
else
	sql =sql & " Where   counter_date  is not null"
end if

if isnumeric(campaign)  then 
	sql =sql  & " and camp =" & campaign
end if

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



'response.write sql
'response.write "<br>"

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

<table width="743" border="0" cellpadding="3" cellspacing="1" class="FormBorder_1967DB">
  <tr style="background-image:url(images/bg_menu.gif);background-position:left;background-repeat:repeat-x;height:25px;font-weight:bold;color:#FFF">
    <td width="110" align="center" > <a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('counter_date',<%=page%>);">DATE</a></td>
    <td width="82" align="center"> <a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('CAMP',<%=page%>);">CAMPAIGN</a></td>
    <td width="89" height="26" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('visitor',<%=page%>);">VISITORS</a></td>
    <td width="85" align="center"> <a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('CountOfOrders',<%=page%>);">ORDERS</a></td>
    <td width="93" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('CountOfOrdersItems',<%=page%>);">ORDER ITEM</a></td>
    <td width="115" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('CountOfMslRegister',<%=page%>);">MSL REGISTER</a></td>
    <td width="90" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('CountOfWebboard',<%=page%>);"> WEBBOARD</a></td>
    <td width="68" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('CountOfFAQ',<%=page%>);">FAQ </a></td>
  </tr>
  <%
i = 0
rec =0

visitor  =0 
order =0 
items =0
register =0 
webboard =0
faq =0

Do While Not rs.Eof 
	If i Mod 2 =0 Then 
		bg_color = "#E6EFF9"
	Else
		bg_color ="#A9CAE2"
	End If

%>
  <tr   bgcolor="<%=bg_color%>">
    <td width="110" align="center" nowrap="nowrap" >
	<%=MID(rs("counter_date"),7,2) &"/" & MID(rs("counter_date"),5,2) & "/" & MID(rs("counter_date"),1,4)%></td>
    <td width="82" align="center" nowrap="nowrap" ><%=MID(rs("CAMP"),5,2) &"/" & MID(rs("CAMP"),1,4)%></td>
    <td width="89" height="21" align="right" nowrap="nowrap" ><%= FormatNumber(rs("Visitor"),0) %></td>
    <td width="85"  align="right" nowrap="nowrap"><%= FormatNumber(rs("CountOfOrders"),0)%></td>
    <td width="93"  align="right" nowrap="nowrap"><%=FormatNumber(rs("CountOfOrdersItems"),0)%></td>
    <td height="21"  align="right" nowrap="nowrap"><%= FormatNumber(rs("CountOfMslRegister"),0)%></td>
    <td height="21" align="right" nowrap="nowrap">
	<%= FormatNumber(rs("CountOfWebboard")	,0)	 %></td>
    <td height="21" align="right" nowrap="nowrap">
    <% = FormatNumber(rs("CountOfFAQ"),0)	%></td>
  </tr>

  <%
	visitor  =visitor + rs("visitor")
	order =order + rs("CountOfOrders")
	items =items + rs("CountOfOrdersItems")
	register =register + rs("CountOfMslRegister")
	webboard =webboard + rs("CountOfWebboard")
	faq =faq + rs("CountOfFAQ")

	i =i+1
	rec=rec+1
	rs.MoveNext
Loop	
%>
  <tr   class="Item_white">
    <td align="center" nowrap="nowrap" bgcolor="#999999" >Totals</td>
    <td align="center" nowrap="nowrap" bgcolor="#999999" >&nbsp;</td>
    <td height="21" align="right" nowrap="nowrap" bgcolor="#999999" ><%=FormatNumber(visitor,0)%></td>
    <td  align="right" nowrap="nowrap" bgcolor="#999999"><%=FormatNumber(order,0)%></td>
    <td  align="right" nowrap="nowrap" bgcolor="#999999"><%=FormatNumber(items,0)%></td>
    <td height="21"  align="right" nowrap="nowrap" bgcolor="#999999"><%=FormatNumber(register,0)%></td>
    <td height="21" align="right" nowrap="nowrap" bgcolor="#999999"><%=FormatNumber(webboard,0)%></td>
    <td height="21" align="right" nowrap="nowrap" bgcolor="#999999"><%=FormatNumber(faq,0)%></td>
  </tr>
</table>

