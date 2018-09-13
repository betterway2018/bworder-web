<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file="../Include/i_config.asp"-->
<!--#include file="../Connections/MySql_Connection.asp"-->
<!-- Star Asp Code -->
<%
If Session("Admin_login") = "" then 
	response.Redirect("admin_login.asp")
	response.End()
End IF	


dim dbfile
dbfile = Server.MapPath("../tips/tips_data.mdb") 
Set Conn = Server.CreateObject("ADODB.Connection") 
Conn.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & dbfile & ";Jet OLEDB:Database Password="

id = request.QueryString("id")

Set rs =Server.CreateObject("ADODB.Recordset")
sql ="Select * From tips where id = '" & id & "'" 
rs.Open sql,Conn,1,3


%>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>รอบจำหน่าย</title>
<link href="../styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<br />
<br />
<form action="tips_AddNew.asp" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check();">
  <table width="611" border="0" align="center" cellpadding="2" cellspacing="0" class="Table_FormBorder_Blue">
    <tr>
      <td height="23" colspan="2" bgcolor="#B62A79"><strong class="text_normal2"> Tips </strong></td>
    </tr>
    <tr>
      <td width="105" align="right">Line Sequence.</td>
      <td width="496"><input name="txtseq" type="text" id="txtseq" value="<%=rs("LineSeq")%>" size="4" maxlength="4" /></td>
    </tr>
    <tr>
      <td align="right">ID</td>
      <td><input name="txtid2" type="text" disabled="disabled" id="txtid2" value="<%=rs("ID")%>" />
      <input name="txtid" type="hidden" id="txtid" value="<%=rs("ID")%>" /></td>
    </tr>
    <tr>
      <td align="right">Subject</td>
      <td><textarea name="txtsubject" id="txtsubject" cols="60" rows="3"><%=rs("Subject")%></textarea></td>
    </tr>
    <tr>
      <td align="right">Detail</td>
      <td><textarea name="txtdetail" id="txtdetail" cols="60" rows="3"><%=rs("Detail")%></textarea></td>
    </tr>
    <tr>
      <td align="right">Post Date</td>
      <td><input name="txtPostdate" type="text" id="txtPostdate" value="<%=rs("Post_Date")%>" />
        (ระบุเป็น dd/mm/yyyy ตัวอย่าง 01/04/2010)</td>
    </tr>
    <tr>
      <td align="right">Default</td>
      <td><select name="txtDefault" id="txtDefault">
        <option value="N">No</option>
        <option value="Y">Yes</option>
      </select></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td><a href="../tips/tips_images/<%=rs("imagefile")%>"><%=rs("Imagefile")%></a></td>
    </tr>
    <tr>
      <td align="right">Image file :</td>
      <td><input name="file1" type="file" id="file1" size="60" /></td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">&nbsp;</td>
      <td><input type="reset" name="Reset" id="button2" value="Reset" />
        <input type="submit" name="button2" id="button2" value="Create" /></td>
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
</form>
</body>
</html>
