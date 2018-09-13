<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file="../Include/i_config.asp"-->
<!--#include file="../Connections/MySql_Connection.asp"-->
<!-- Star Asp Code -->

<%
Response.Charset = "TIS-620"
mySort = request.form("Sort")
Page = Request.Form("page")
strMode = request("mode")
datasource = request("datasource")
campaign = request("campaign")
query =request("query")
q=request.QueryString("q")
q=  replace(q,"%20" , " ")


'Conn.open MySqlConnStr
'response.write "<br>"
'response.write "mode =" & strMode
'response.write "<br>"
'response.write "datasource =" & datasource
'response.write "<br>"
'response.write "campaign =" &campaign
'response.write "<br>"
'response.write "query =" & q

if q ="" then 
	Response.write "No Query "
	response.End()
End If	

Select case   datasource
case "Orders"
		Set Conn = Server.CreateObject("ADODB.Connection") 
		Conn.open MySqlConnStr
case "Catalogue"
		strfile  = "../Catalogue/mistine/mistine_" & campaign & "/Data/" & "Catalogue_" & campaign & ".mdb"
		Set Conn = Server.CreateObject("ADODB.Connection") 
		Conn.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & Server.MapPath(strfile) & ";Jet OLEDB:Database Password="
			
	
case "Webboard"
		Set Conn = Server.CreateObject("ADODB.Connection") 
		Conn.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & Server.MapPath("../Webboard/data/DataBoard.mdb") & ";Jet OLEDB:Database Password="
case "Promotion"
		Set Conn = Server.CreateObject("ADODB.Connection") 
		strConn = "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & server.MapPath("../Orders/Promotion.mdb") &";Persist Security Info=False;" 
		With Conn
				.ConnectionString =  strConn
				.CursorLocation =2
				.Open
		End With		
case "News"
		Set Conn = Server.CreateObject("ADODB.Connection") 
		strConn = "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & server.MapPath("../News/news_data.mdb") &";Persist Security Info=False;" 
		With Conn
				.ConnectionString =  strConn
				.CursorLocation =2
				.Open
		End With
		
case "Tips"
		Set Conn = Server.CreateObject("ADODB.Connection") 
		strConn = "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & server.MapPath("../tips/tips_data.mdb") &";Persist Security Info=False;" 
		With Conn
				.ConnectionString =  strConn
				.CursorLocation =2
				.Open
		End With		
case else
		response.write "no data source "
		response.end
end select


on error resume next


sql = q

if strMode ="Query" Then
	set rs =Server.CreateObject("ADODB.Recordset")
	rs.CursorLocation =3
	rs.Open sql,Conn,1,3  
	
	if err.number <> 0 Then
		response.Write err.Number & ":" & Err.Description
		response.end 
	end if 

Elseif 	strMode = "Execute" Then 
	
	Conn.execute sql
	if err.number <> 0 Then
		response.Write err.Number & ":" & Err.Description
		response.end 
	else
		Response.write "Execute command successfuly ..."
		response.end
	end if 
End If

%>

<table width="21%" border="0" cellpadding="0" cellspacing="1" class="FormBorder_1967DB">
  <tr style="background-image:url(Images/bar_email1_06.png);background-position:left;background-repeat:repeat-x;height:25px;font-weight:bold;color:#FFF">
    <td width="80" height="26" align="center">SEQ.</td>
<% for each s_col  in rs.fields %>    
    <td width="100" align="center" nowrap><%=s_col.name%></td>
<% Next%>   
    
    
  </tr>
<%

  
i = 1
rec =0
Do While Not rs.Eof 
	If i Mod 2 =0 Then 
		bg_color = "#E6EFF9"
	Else
		bg_color ="#A9CAE2"
	End If

%>
  <tr   bgcolor="<%=bg_color%>">
    <td height="21" align="center" nowrap="nowrap" ><%=i%></td>
<% for each s_col  in rs.fields %>    
    <td  align="left" nowrap="nowrap"><%=s_col.value%></td>
<% Next%>   
  </tr>
  <%
	i =i+1
	rec=rec+1
	rs.MoveNext
Loop	
%>
</table>

