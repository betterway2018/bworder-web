<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file="../Include/i_config.asp"-->
<!--#include file="../Connections/MySql_Connection.asp"-->
<!-- Star Asp Code -->

<%


Set Conn = Server.CreateObject("ADODB.Connection") 
Conn.open MySqlConnStr
	 
select_campaign= Request.Form("camp")
mySort = request.form("mySort")

if select_campaign = "" then 
	select_campaign = "0"
End If



set rs =Server.CreateObject("ADODB.Recordset")
sql ="Select * From TBL015 Where  CAMP  = " & select_campaign
if mySort  <> "" Then 
	sql =sql & " Order by " & mySort
End If

'response.write "sql =" & sql

rs.CursorLocation =3
rs.Open sql,Conn ,1,3

set rs2 = Server.CreateObject("ADODB.Recordset")
sql ="Select Distinct  CAMP  From TBL015 Order by CAMP"
rs2.Open Sql,Conn,1,3
	
%>	

<%
Function AlertMessage(msg,url)
 		response.write "<script type='text/JavaScript'>"
		response.write "javascript:alert(' " & msg &"');"
		response.write "document.location = '" & url &"';"
		response.write"</script>"
End Function
%>


<table width="760" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="525">&nbsp;</td>
    <td width="235" align="right">Total Records :<%=rs.Recordcount%></td>
  </tr>
</table>
<table width="760" border="0" align="center" cellpadding="0" cellspacing="1" class="FormBorder_1967DB">
  <tr style="background-image:url(Images/bar_email1_06.png);background-position:left;background-repeat:repeat-x;height:25px;font-weight:bold;color:#FFF">
    <td width="91" height="26" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('CAMP');">CAMPAIGN</a></td>
    <td width="81" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('DIST');">DISTRICT</a></td>
    <td width="110" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('EFFDTE');">START DATE</a></td>
    <td width="83" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('EXPDTE');"> ENDDATE</a></td>
    <td width="73" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('MAILGROUP');">GROUP</a></td>
    <td width="87" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('BILLDATE');">BILL DATE</a></td>
    <td width="102" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('SHIPDATE');">SHIP DATE</a></td>
    <td width="104" align="center"><a href="#" style="color:#FFF" onclick="JavaScript:doCallAjax('DLVDATE');">DALIVERY</a></td>
  </tr>
  <%
i = 0

Do While Not rs.Eof
	If i Mod 2 =0 Then 
		bg_color = "#E6EFF9"
	Else
		bg_color ="#A9CAE2"
	End If

%>
  <tr   bgcolor="<%=bg_color%>">
    <td align="center" height="21" ><%=MID(rs("CAMP"),5,2) & "/" & MID(rs("CAMP"),1,4)%></td>
    <td  align="center"><%=rs("DIST")%></td>
    <td  align="center" height="21"><%=MID(rs("EFFDTE"),7,2) & "/" & MID(rs("EFFDTE"),5,2) & "/" & MID(rs("EFFDTE"),1,4)%></td>
    <td align="center" height="21"><%=MID(rs("EXPDTE"),7,2) & "/" & MID(rs("EXPDTE"),5,2) & "/" & MID(rs("EXPDTE"),1,4)%></td>
    <td align="center" height="21"><%=rs("MAILGROUP")%></td>
    <td align="center"><%=MID(rs("BILLDATE"),7,2) & "/" & MID(rs("BILLDATE"),5,2) & "/" & MID(rs("BILLDATE"),1,4)%></td>
    <td align="center"><%=MID(rs("SHIPDATE"),7,2) & "/" & MID(rs("SHIPDATE"),5,2) & "/" & MID(rs("SHIPDATE"),1,4)%></td>
    <td align="center"><%=MID(rs("DLVDATE"),7,2) & "/" & MID(rs("DLVDATE"),5,2) & "/" & MID(rs("DLVDATE"),1,4)%></td>
  </tr>
  <%
	i =i+1
	rs.MoveNext
Loop	
%>
</table>

