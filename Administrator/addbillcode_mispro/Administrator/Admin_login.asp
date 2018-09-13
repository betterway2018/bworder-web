<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Administrator</title>
<link href="../styles.css" rel="stylesheet" type="text/css" />
</head>

<body bgcolor="#E6E6FF">
<br />
<br />
<table width="480" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td class="Gradient_violet"><img src="../Images/logo.gif" width="162" height="63" /></td>
  </tr>
  <tr>
    <td><br />
<fieldset>
      <legend > Administrator Login ... </legend>
      <form action="login.asp" method="post" name="form1" target="_parent" id="form1">
        <br />
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="111" align="center" valign="top"><img src="images/security.gif" width="64" height="64" /></td>
            <td width="367"><table width="81%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td width="38%" align="right"><strong>รหัสผู้ใช้งาน :</strong></td>
                <td width="62%"><input type="text" name="txtuser" id="txtuser" /></td>
                </tr>
              <tr>
                <td align="right"><strong>รหัสผ่าน :</strong></td>
                <td><input type="password" name="txtpwd" id="txtpwd" /></td>
                </tr>
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td><input type="reset" name="Reset" id="button" value="Reset" />
                  <input type="submit" name="Submit" id="Submit" value="Login" /></td>
                </tr>
              </table></td>
          </tr>
          </table>
      </form>
    </fieldset></td>
  </tr>
</table>
</body>
</html>
