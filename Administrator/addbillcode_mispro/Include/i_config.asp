  <%
	' Since our software must run on IIS 4.0 and IIS 5.0 we need to make sure the
	' settings are the same.
	Response.Buffer = True
	'Response.ExpiresAbsolute
	session.Timeout=240

	Server.ScriptTimeout=3600



	%>