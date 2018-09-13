<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file="../Include/i_config.asp"-->
<!--#include file="../Connections/MySql_Connection.asp"-->
<!-- Star Asp Code -->

<%

dim user_id
dim user_name
dim password


If Request.ServerVariables("REQUEST_METHOD") ="POST" And  Request.form("Submit") = "Login" Then 

	Set Conn = Server.CreateObject("ADODB.Connection") 
	Conn.open MySqlConnStr
	 
	 set rs =Server.CreateObject("ADODB.Recordset")
	 sql ="Select * From Users Where User_id = '" & request.form("txtuser") & "'"
	 sql =sql & " AND Password = '" & request.form("txtpwd") & "'" 
	 rs.Open sql,Conn ,1,3
	 if rs.Eof Then 
	 	Call AlertMessage("รหัสผู้ใช้งานหรือรหัสผ่านไม่ถูกต้องค่ะ !!!","javascript:history.back();")
		response.End 
	Else
		Session("Admin_Login") =  rs("User_id")
		Session("User_name") = rs("User_name")
		Response.Redirect("index.asp")
		response.end
	End If

Else
	Response.Redirect("Admin_login.asp")
	response.End()
End If



Function AlertMessage(msg,url)
 		response.write "<script type='text/JavaScript'>"
		response.write "javascript:alert(' " & msg &"');"
		response.write "document.location = '" & url &"';"
		response.write"</script>"
End Function


%>


