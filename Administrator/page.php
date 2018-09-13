<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="722"><table width="39%" border="0" cellspacing="0" cellpadding="0">
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
    </table>

</body>
</html>