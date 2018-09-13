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
	

	dim rsH,rsD	

	set rsH = Server.CreateObject("ADODB.Recordset")
	set rsD= Server.CreateObject("ADODB.Recordset")

	sql ="Select  * From  PromotionHeader  Order by Camp DESC"
	rsH.Open sql,AccessConn,1,3 

	
%>    


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>โปรโมชั่น</title>
<link href="../styles.css" rel="stylesheet" type="text/css" />
</head>

<body>
<%=dbfile %>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="left"><!--#include file="header.asp" --></td>
  </tr>
  <tr>
    <td width="1%" align="left" valign="top"><!--#include file="menu.asp" --></td>
    <td width="99%" align="left" valign="top" bgcolor="#F3D8E6"><table width="800" border="0" align="center" cellpadding="1" cellspacing="0">
      <tr>
        <td width="675" height="36" align="center"><strong>.:: ข้อมูลโปรโมชั่น ::.</strong></td>
      </tr>
      <tr>
        <td><input type="button" name="button" id="button" value="เพิ่มโปรโมชั่น"   onclick="window.location ='promotion_new.asp'"/></td>
      </tr>
      <tr>
        <td align="center"><fieldset>
          <table width="100%" border="0" cellspacing="1" cellpadding="1">
            <tr class="table_head2">
              <td width="213" height="25">รูปภาพ</td>
              <td width="576" align="center">รายละเอียด</td>
            </tr>
            <% Do While Not rsH.Eof 
				pg = rsH("JPGFILE")
%>
            <tr>
              <td height="186" align="center" valign="middle" bgcolor="#FFDDEE"><img src="<%="../Orders/Promotion/" & pg%>" width="189" height="184" /></td>
              <td align="left" valign="top" bgcolor="#FFDDEE"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                <tr class="FormBorder_CFCFCF">
                  <td height="44" colspan="2" align="left" >รอบจำหน่าย : <%=MID(rsH("Camp"),5,2)&"/" & MID(rsH("Camp"),1,4)%><br />
                    สถานะ : <%=rsH("Status")%></td>
                  <td align="right" valign="bottom"  ><a href="promotion_edit.asp?id=<%=rsH("Camp")%>"><img src="images/edit2.gif" width="17" height="17" border="0" /></a>&nbsp;<a href="promotion_delete.asp?id=<%=rsH("Camp")%>"><img src="images/delete2.gif" width="17" height="17" border="0" /></a>
                    <a href="promotion_copy.asp?id=<%=rsH("Camp")%>">Copy to Campaign </a></td>
                </tr>
                <tr class="FormBorder_CFCFCF">
                  <td width="18%" height="28" align="center" class="text_normal_Bule" style="border-bottom:dotted #C8C8C8 1px;border-top:dotted #C8C8C8 1px">รหัสสินค้า</td>
                  <td width="56%" class="text_normal_Bule" style="border-bottom:dotted #C8C8C8 1px;border-top:dotted #C8C8C8 1px">ชื่อสินค้า / รายละเอียด</td>
                  <td width="26%" class="text_normal_Bule" style="border-bottom:dotted #C8C8C8 1px;border-top:dotted #C8C8C8 1px"> ราคา</td>
                </tr>
                <%
			sql ="Select * From PromotionData Where Camp =" & rsH("Camp") 
			if rsD.State = 1 Then rsD.Close
			rsD.Open sql,AccessConn,1,3 
			Do While not rsD.Eof
			%>
                <tr>
                  <td align="center"><%= rsD("BillCode")%></td>
                  <td><%=  rsD("BILLDESC")%></td>
                  <td><%= rsD("Price")%></td>
                </tr>
                <%
			  		rsD.MoveNext 
			Loop
			
			  %>
              </table>
                <br /></td>
            </tr>
            <% rsH.MoveNext:Loop%>
          </table>
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
