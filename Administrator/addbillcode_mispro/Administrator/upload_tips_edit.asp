<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file="../Include/i_config.asp"-->
<!--#include file="../Connections/MySql_Connection.asp"-->
<!--#include file="admin_config.asp"-->

<%If Session("Admin_login") = "" then 
	response.Redirect("admin_login.asp")
	response.End()
End IF	%>

<%
Response.Charset="windows-874"


dim strConn
dim Conn
dim rs 
dim  seq
strConn = "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & server.MapPath("../tips/tips_data.mdb") &";Persist Security Info=False;" 
Set Conn = Server.CreateObject("ADODB.Connection") 
With Conn
		.ConnectionString =  strConn
		.CursorLocation =2
		.Open
End With

id = request.QueryString("id")

set rs = Server.CreateObject("ADODB.Recordset")
sql ="Select *  from tips  where id = '" &  request.QueryString("id") & "'" 
rs.Open sql,Conn,1,3


%>

<%
Function AlertMessage(msg,url)
 		response.write "<script type='text/JavaScript'>"
		response.write "javascript:alert(' " & msg &"');"
		response.write "document.location = '" & url &"';"
		response.write"</script>"
End Function
%>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><%=title%></title>
<link href="../Styles.css" rel="stylesheet" type="text/css" />



</head>

<body  >
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" valign="top" bgcolor="#FFFFFF"><!--#include file="header.asp" --></td>
  </tr>
  <tr>
    <td width="5%" valign="top" nowrap="nowrap" bgcolor="#FFFFFF" style="border-bottom:solid #D4D4D4 1px;border-left:solid #D4D4D4  1px;border-top:solid #D4D4D4  1px;border-right:solid #D4D4D4  1px"><!--#include file="menu.asp" -->&nbsp;</td>
    <td align="left" valign="top" bgcolor="#F0F8FF">
<br />
 
  <strong class="text_heading">::  Tips &amp; Trick ::</strong>
    <hr />
    <center>
      <br />
      <form action="upload_tips_update.asp" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check();">
        <br />
        <table width="611" border="0" align="center" cellpadding="2" cellspacing="0" class="FormBorder_d1daed">
          <tr>
            <td height="23" colspan="2" bgcolor="#5991BB"><strong class="Item_white">Create New ...</strong></td>
            </tr>
          <tr>
            <td width="105" align="right">Line Sequence.</td>
            <td width="496" align="left"><input name="txtseq" type="text" id="txtseq" value="<%=rs("LineSeq")%>" size="4" maxlength="4" /></td>
            </tr>
          <tr>
            <td align="right">ID</td>
            <td align="left"><input name="txtid2" type="text" disabled="disabled" id="txtid2" value="<%=rs("ID")%>" />
              <input name="txtid" type="hidden" id="txtid" value="<%=rs("id")%>" /></td>
            </tr>
          <tr>
            <td align="right">Subject</td>
            <td align="left"><textarea name="txtsubject" id="txtsubject" cols="60" rows="3"><%=rs("Subject")%></textarea></td>
            </tr>
          <tr>
            <td align="right">Detail</td>
            <td align="left"><textarea name="txtdetail" id="txtdetail" cols="60" rows="5"><%=rs("Detail")%></textarea></td>
            </tr>
          <tr>
            <td align="right">Post Date</td>
            <td align="left"><input name="txtPostdate" type="text" id="txtPostdate" value="<%=rs("Post_Date")%>" />
              (ระบุเป็น dd/mm/yyyy ตัวอย่าง 01/04/2010)</td>
            </tr>
          <tr>
            <td align="right">Default</td>
            <td align="left"><select name="txtDefault" id="txtDefault">
          <option value="N" <%If  rs("IsDefault") = "N" Then response.write("selected=""selected""")  End If%>>No</option>
          <option value="Y"  <%If  rs("IsDefault") = "Y" Then response.write("selected=""selected""") End If %>>Yes</option>
              </select></td>
            </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td align="left">&nbsp;</td>
            </tr>
          <tr>
            <td align="right">Image file :</td>
            <td align="left"><input name="file1" type="file" id="file1" size="60" /></td>
            </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td align="left">&nbsp;</td>
            </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td align="left"><input type="submit" name="button" id="button" value="Cancel" />
              <input type="submit" name="button" id="button" value="Update" /></td>
            </tr>
          </table>
        <script type="text/javascript">
	function check() {
		if (!IsNumeric(document.form1.txtseq.value)) {
			alert("กรอก sequence no. ไม่ถูกต้อง");
			document.form1.txtseq.focus();
			return false;
		}
		else if (document.form1.txtid.value=="") {
			alert("กรุณากรอก รหัส");
			document.form1.txtid.focus();
			return false;
		}
		else if (document.form1.txtsubject.value==""){
			alert ("กรุณาระบุ  Subject ");
			document.form1.txtsubject.focus();
			return false;
		}
		else { 
			return true;
		}
	}
	function IsNumeric(strString)
					   //  check for valid numeric strings	
					   {
					   var strValidChars = "0123456789.-";
					   var strChar;
					   var blnResult = true;
					
					   if (strString.length == 0) return false;
					
					   //  test strString consists of valid characters listed above
					   for (i = 0; i < strString.length && blnResult == true; i++)
						  {
						  strChar = strString.charAt(i);
						  if (strValidChars.indexOf(strChar) == -1)
							 {
							 blnResult = false;
							 }
						  }
					   return blnResult;
		}		
		
        </script>
        <br />
      </form>
    </center>
    </td>
  </tr>
</table>

</body>
</html>
