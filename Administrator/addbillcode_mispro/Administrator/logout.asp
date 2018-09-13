<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<%

		Session("Login") = "fase"
		Session("Admin_Login") = ""
		Session("User_name") = ""
		Response.Redirect("admin_login.asp")
		response.end

%>	
