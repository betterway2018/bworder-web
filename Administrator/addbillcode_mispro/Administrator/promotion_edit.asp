<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>

<!--#include file="../Include/i_config.asp"-->
<!--#include file="../Connections/MySql_Connection.asp"-->
<!-- Star Asp Code -->
<%
If Session("Admin_login") = "" then 
	response.Redirect("admin_login.asp")
	response.End()
End IF	
%>

<%

	dim dbfile
	dbfile = Server.MapPath("../Orders/Promotion.mdb") 
	Set AccessConn = Server.CreateObject("ADODB.Connection") 
	AccessConn.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & dbfile & ";Jet OLEDB:Database Password="
	
	
	dim id
	
	id = Request.QueryString("id")
	
	set rsH = Server.CreateObject("ADODB.Recordset")
	set rsD= Server.CreateObject("ADODB.Recordset")

	sql ="Select  * From  PromotionHeader  Where Camp =" & id
	rsH.Open sql,AccessConn,1,3 
	
	sql ="Select * From PromotionData Where Camp = " &Id
	rsD.Open sql,AccessConn,1,3
	
%>    


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>โปรโมชั่น</title>
<link href="../styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="left"><!--#include file="header.asp" --></td>
  </tr>
  <tr>
    <td width="1%" align="left" valign="top"><!--#include file="menu.asp" --></td>
    <td width="99%" align="left" valign="top" bgcolor="#F3D8E6"><table border="0" align="center" cellpadding="1" cellspacing="0">
      <tr>
        <td height="36" align="center"><strong>.:: ข้อมูลโปรโมชั่น ::.</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="left"><fieldset>
          <form action="promotion_new_update2.asp" method="post" enctype="multipart/form-data" name="form1" id="form1" >
            <table width="100%" border="0" cellpadding="1" cellspacing="1">
              <tr class="table_head2">
                <td align="center">รายละเอียด</td>
              </tr>
              <tr>
                <td align="left" valign="top" bgcolor="#FFDDEE"><table width="100%" border="0" cellpadding="1" cellspacing="1">
                  <tr class="FormBorder_CFCFCF">
                    <td colspan="3" align="left" >รอบจำหน่าย :
                      <input name="txtcamp1" type="text" disabled="disabled" id="txtcamp1" value="<%=MID(rsH("Camp"),5,2)%>" size="2" maxlength="2" />
                      /
                      <input name="txtyear1" type="text" disabled="disabled" id="txtyear1" value="<%=MID(rsH("Camp"),1,4)%>" size="4" maxlength="4" />
                      <input name="txtCamp" type="hidden" id="txtCamp" value="<%=rsH("Camp") %>" />
                      <br />
                      <br />
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สถานะ :
                      <select name="txtStatus" id="txtStatus">
                        <option value="Active" <% IF rsH("Status") = "Active" Then  response.write("selected") End IF%>>Active</option>
                        <option value="Closed" <% IF rsH("Status") = "Closed" Then  response.write("selected") End IF%>>Closed</option>
                      </select></td>
                    <td width="20%" align="right" valign="bottom"  >&nbsp;</td>
                  </tr>
                  <tr class="FormBorder_CFCFCF">
                    <td width="13%" align="center" class="text_normal_Bule" style="border-bottom:dotted #C8C8C8 1px;border-top:dotted #C8C8C8 1px">ลำดับที่</td>
                    <td width="9%" align="left" class="text_normal_Bule" style="border-bottom:dotted #C8C8C8 1px;border-top:dotted #C8C8C8 1px">รหัสสินค้า</td>
                    <td width="58%" align="left" class="text_normal_Bule" style="border-bottom:dotted #C8C8C8 1px;border-top:dotted #C8C8C8 1px">ชื่อสินค้า / รายละเอียด</td>
                    <td class="text_normal_Bule" style="border-bottom:dotted #C8C8C8 1px;border-top:dotted #C8C8C8 1px"> ราคา</td>
                  </tr>
                  <%
			
			i = 1
			For i = 1 to 20
				If Not rsD.Eof Then 
					billCode = rsD("BillCode")
					billDesc = rsD("BillDesc")
					billPrice = rsD("Price")
				Else
					billCode =""
					billDesc =""
					billPrice =""
				End iF
			%>
                  <tr>
                    <td align="center"><%=i & "."%></td>
                    <td align="left"><input name="<%="txtid" &cstr(i)%>" type="text" id="<%="txtid" &cstr(i)%>" value="<%=billCode%>" size="10" maxlength="5" /></td>
                    <td align="left"><input name="<%="txtname" &cstr(i)%>" type="text" id="<%="txtname" &cstr(i)%>" value="<%=billDesc%>" size="70" maxlength="90" /></td>
                    <td><input name="<%="txtprice"&cstr(i)%>" type="text" id="<%="txtprice"&cstr(i)%>" value="<%=billPrice%>" size="10" maxlength="10" /></td>
                  </tr>
                  <%
				  		if Not rsD.Eof Then rsD.MoveNext
			  		Next 
	
			  %>
                </table></td>
              </tr>
            </table>
            <br />
            Current file  :<a href="../Orders/Promotion/<%=rsH("jpgFile")%>" target="_blank"> <%=rsH("jpgFile")%> </a><br />
            File :
            <input name="file1" type="file" id="file1" size="70" />
            <br />
            <br />
            <center>
              <input name="Button2" type="button" id="Button2" value="Cancel"  onclick="window.location='promotion.asp'"/>
              <input name="Button" type="reset" id="Button" value="Reset" />
              <input type="submit" name="Submit" id="Submit" value="Save" />
            </center>
            <script type="text/javascript">
 
function check(){
	var i=1;
	var j=0;
	var totalitems = 10;
	 for ( i=1 ;i<=totalitems;i++) {	
		 var billcode  = document.getElementById('txtid'+i);
		 var billdesc = document.getElementById('txtname'+i);
		 var billprice=document.getElementById('txtprice'+i);
		 
		 //alert ("-"+billcode.value+"-");
		 if(billcode.value != "" ) {
			 if (billdesc=="")  {
				 alert("กรุณากรอกชื่อสินค้า ในรายการที่ " + i + " ด้วยค่ะ");
				 billdesc.focus();
				 return false;
			 }
			 else if (! IsNumeric(billunit.value)) {
				alert ("กรุณากรอกจำนวนสั่งซื้อ ในรายการที่ "+ i  +" ด้วยค่ะ ");
				billunit.focus();
				return false;
			 }
		 }

	}	
	return true;
	
	
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
        </fieldset></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" valign="top"><!--#include file="../Include/i_footer.asp" --></td>
  </tr>
</table>
</body>
</html>
