<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>

<%
Dim Conn
DBPath = Server.MapPath("../webboard/data/faq.mdb") 
Set Conn = Server.CreateObject("ADODB.Connection") 
Conn.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & DBPath & ";Jet OLEDB:Database Password="
%>

      <%

dim titlePage
dim  rs


titlePage = Request.QueryString("title")
FaqIndex   = Request.QueryString("id")
action = Request.QueryString("Action")



if Request.form("Submit")  ="Update Sequence"  and Request.ServerVariables("REQUEST_METHOD")="POST" Then 
	FaqIndex = Request.Form("txtIndex")
	Question = Request.Form("txtQuestion")
	Answer = Request.Form("txtAnswer")
	strActive = Request.Form("selStatus")
	LineSeq = Request.form("txtseq")
	
	
	
	set rs = Server.CreateObject("ADODB.Recordset") 
	Sql  = "Select * From Data  Order by LineSeq"
	rs.Open Sql,Conn,1,3
	Do While Not rs.Eof
		seq_id =""
		seq_id = request.form("Line_" & rs("seq"))
		if seq_id <> "" Then 
			sql ="Update data SET LineSeq =" & seq_id
			sql =sql & " Where Seq =" & rs("seq")
			Conn.Execute sql
		End If	

'response.write "sql =" & sql 
'response.write "<BR>"		

		
		rs.MoveNext
	Loop
		
'response.End()
	Response.Redirect("faq.asp")
	

End If




%>
