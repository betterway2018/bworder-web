<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file="../Include/i_config.asp"-->
<!--#include file="../Connections/MySql_Connection.asp"-->
<!-- Star Asp Code -->


<%
Response.Charset="windows-874"


dim strConn
dim Conn
dim rs 
dim  seq
strConn = "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & server.MapPath("../News/news_data.mdb") &";Persist Security Info=False;" 
Set Conn = Server.CreateObject("ADODB.Connection") 
With Conn
		.ConnectionString =  strConn
		.CursorLocation =2
		.Open
End With


set rs = Server.CreateObject("ADODB.Recordset")
sql ="Select *  from News Order by  LineSeq"
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
<title>Friday Web Administrator</title>
<link href="../Styles.css" rel="stylesheet" type="text/css" />



</head>

<body  >
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="left"><!--#include file="header.asp" --></td>
  </tr>
  <tr>
    <td width="1%" align="left" valign="top"><!--#include file="menu.asp" --></td>
    <td width="99%" align="left" valign="top" bgcolor="#F3D8E6"><form action="upload_news_create.asp" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check();">
      <br />
      <strong class="text_heading">::  ข่าวและกิจกรรม ::</strong>
      <hr />
      <table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" class="Table_FormBorder_violet">
        <tr style="height:25px;font-weight:bold;color:#FFF">
          <td width="38" height="26" align="center" bgcolor="#CC0066">Seq.</td>
          <td width="34" align="center" bgcolor="#CC0066">ID</td>
          <td width="214" align="center" bgcolor="#CC0066">Subject</td>
          <td width="190" align="center" bgcolor="#CC0066">Detail</td>
          <td width="75" align="center" bgcolor="#CC0066">Post Date</td>
          <td width="65" align="center" bgcolor="#CC0066">Defalut</td>
          <td width="119" align="center" bgcolor="#CC0066">Image</td>
          <td width="66" align="center" bgcolor="#CC0066">&nbsp;</td>
        </tr>
        <%
i = 0
rec =0
Do While Not rs.Eof 
	If i Mod 2 =0 Then 
		bg_color = "#E6EFF9"
	Else
		bg_color ="#A9CAE2"
	End If

%>
        <tr   bgcolor="<%=bg_color%>">
          <td height="21" align="center" nowrap="nowrap" ><%=rs("LineSeq")%></td>
          <td  align="center" nowrap="nowrap"><%=rs("ID")%></td>
          <td height="21"  align="left"><%=rs("Subject")%></td>
          <td height="21" align="left" nowrap="nowrap"><%=rs("Detail")%></td>
          <td height="21" align="center" nowrap="nowrap"><%=rs("POST_DATE") %></td>
          <td align="center"><%=rs("IsDefault") %></td>
          <td align="center"><a href="../News/news_images/<%=rs("ImageFile")%>" target="_blank"><%=rs("ImageFile")%></a></td>
          <td align="center">&nbsp;<a href="upload_news_edit.asp?id=<%=rs("id")%>"><img src="images/edit2.gif" width="17" height="17" border="0" /></a>&nbsp;&nbsp;<a href="upload_news_delete.asp?id=<%=rs("ID")%>"><img src="Images/delete2.gif" width="17" height="17" border="0" /></a></td>
        </tr>
        <%
	i =i+1
	rec=rec+1
	rs.MoveNext
Loop	
%>
      </table>
      <center>
        <br />
        <br />
        <table width="611" border="0" align="center" cellpadding="2" cellspacing="0" class="Table_FormBorder_Blue">
          <tr>
            <td height="23" colspan="2" bgcolor="#5991BB"><strong class="Item_white">Create New ...</strong></td>
          </tr>
          <tr>
            <td width="105" align="right">Line Sequence.</td>
            <td width="496" align="left"><input name="txtseq" type="text" id="txtseq" size="4" maxlength="4" /></td>
          </tr>
          <tr>
            <td align="right">ID</td>
            <td align="left"><input type="text" name="txtid" id="txtid" /></td>
          </tr>
          <tr>
            <td align="right">Subject</td>
            <td align="left"><textarea name="txtsubject" id="txtsubject" cols="60" rows="3"></textarea></td>
          </tr>
          <tr>
            <td align="right">Detail</td>
            <td align="left"><textarea name="txtdetail" id="txtdetail" cols="60" rows="3"></textarea></td>
          </tr>
          <tr>
            <td align="right">Post Date</td>
            <td align="left"><input type="text" name="txtPostdate" id="txtPostdate" />
              (ระบุเป็น dd/mm/yyyy ตัวอย่าง 01/04/2010)</td>
          </tr>
          <tr>
            <td align="right">Default</td>
            <td align="left"><select name="txtDefault" id="txtDefault">
              <option value="N">No</option>
              <option value="Y">Yes</option>
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
            <td align="left"><input type="reset" name="Reset" id="button" value="Reset" />
              <input type="submit" name="button" id="button" value="Create" /></td>
          </tr>
        </table>
        <br />
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
      </center>
    </form></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><!--#include file="../Include/i_footer.asp" --></td>
  </tr>
</table>
</body>
</html>
