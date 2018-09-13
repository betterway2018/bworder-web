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

Set rs =Server.CreateObject("ADODB.Recordset")
sql ="Select * From tips Order By id"
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
<table width="800" border="0" align="center" cellpadding="1" cellspacing="0">
  <tr>
    <td width="675" height="36" align="center"><strong>.:: Tips ::.</strong></td>
  </tr>
  <tr>
    <td><input type="submit" name="button" id="button" value="Create new" /></td>
  </tr>
  <tr>
    <td align="center"><fieldset> 
    <table width="842" border="0" cellspacing="1" cellpadding="1">
      <tr class="table_head2">
        <td width="46" height="25" align="center">Seq.</td>
        <td width="54" align="center">ID</td>
        <td width="471" align="center">Subject</td>
        <td width="75" align="center">Default</td>
        <td width="99" align="center">Image</td>
        <td width="78" align="center">&nbsp;</td>
      </tr>
<% Do While Not rs.Eof 

%>      
      <tr>
        <td align="center" bgcolor="#FFDDEE"><%=rs("LineSeq")%></td>
        <td align="center" bgcolor="#FFDDEE"><%=rs("ID")%></td>
        <td align="left" bgcolor="#FFDDEE"><%=rs("Subject")%></td>
        <td align="center" bgcolor="#FFDDEE"><%=rs("IsDefault")%></td>
        <td align="center" nowrap="nowrap" bgcolor="#FFDDEE"><a href="../tips/tips_images/<%=rs("ImageFile")%>" target="_blank"><%=rs("ImageFile")%></a></td>
        <td align="center" bgcolor="#FFDDEE"><img src="images/edit2.gif" width="17" height="17" />&nbsp;<img src="images/delete2.gif" width="17" height="17" />&nbsp;&nbsp;<img src="images/view3.gif" width="17" height="17" /></td>
      </tr>
<% rs.MoveNext:Loop%>      
      <tr>
        <td bgcolor="#FFDDEE">&nbsp;</td>
        <td align="center" bgcolor="#FFDDEE">&nbsp;</td>
        <td align="center" bgcolor="#FFDDEE">&nbsp;</td>
        <td align="center" bgcolor="#FFDDEE">&nbsp;</td>
        <td align="center" bgcolor="#FFDDEE">&nbsp;</td>
        <td align="center" bgcolor="#FFDDEE">&nbsp;</td>
      </tr>
    </table>
    </fieldset>
</td>
  </tr>
</table>
<br />
<br />
<form action="tips_AddNew.asp" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return check();">
  <table width="611" border="0" align="center" cellpadding="2" cellspacing="0" class="Table_FormBorder_Blue">
    <tr>
      <td height="23" colspan="2" bgcolor="#B62A79"><strong class="text_normal2">Create New ...</strong></td>
    </tr>
    <tr>
      <td width="105" align="right">Line Sequence.</td>
      <td width="496"><input name="txtseq" type="text" id="txtseq" size="4" maxlength="4" /></td>
    </tr>
    <tr>
      <td align="right">ID</td>
      <td><input type="text" name="txtid" id="txtid" /></td>
    </tr>
    <tr>
      <td align="right">Subject</td>
      <td><textarea name="txtsubject" id="txtsubject" cols="60" rows="3"></textarea></td>
    </tr>
    <tr>
      <td align="right">Detail</td>
      <td><textarea name="txtdetail" id="txtdetail" cols="60" rows="3"></textarea></td>
    </tr>
    <tr>
      <td align="right">Post Date</td>
      <td><input type="text" name="txtPostdate" id="txtPostdate" />
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
      <td>&nbsp;</td>
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
