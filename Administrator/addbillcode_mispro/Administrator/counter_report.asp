
<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file="../Include/i_config.asp"-->
<!--#include file="../Connections/MySql_Connection.asp"-->
<%

daily_counter =0 
ordersHeader =0 
ordersItem =0 
mslReg =0 
faq =0
webboard =0
lastdate =0
Set connCounters= Server.CreateObject("ADODB.Connection") 
connCounters.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & Server.MapPath("../counters.mdb") & ";Jet OLEDB:Database Password="



strCurDate = year(date) & mid("00",1,2-len(month(date))) & month(date) & mid("00",1,2-len(day(date))) & day(date) 

if  Request.ServerVariables("REQUEST_METHOD") ="POST" Then 
	sql = "SELECT  max (counter_date) as last_date  From daily_counter"
	set rs = Server.CreateObject("ADODB.Recordset") 
	rs.Open sql,connCounters,1,3
	if Isnull(rs("last_date")) Then 
		lastdate =0
	else
		lastdate = rs("last_date")
	End IF

Else
	lastdate = strCurDate
End IF


dim l_date 
dim str_l_date
%>
<table width="510" border="0" cellspacing="1" cellpadding="2">
  <tr>
    <td colspan="6"><form id="form1" name="form1" method="post" action="">
      <label>
        Daily  report  as of date : 
          <% date%>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="button" id="button" value="Preview report" />
      </label>
    </form></td>
  </tr>
  <tr>
    <td width="107" bgcolor="#F0F0F0">Date</td>
    <td width="84" bgcolor="#F0F0F0">Visitor</td>
    <td width="66" bgcolor="#F0F0F0">Order</td>
    <td width="63" bgcolor="#F0F0F0"> Item</td>
    <td width="75" bgcolor="#F0F0F0">Register</td>
    <td width="80" bgcolor="#F0F0F0">Webboard</td>
  </tr>
<%  
l_date = dateserial(mid(lastdate,1,4),mid(lastdate,5,2) ,mid(lastdate,7,2))
l_date = dateadd("d",1,l_date)
do while l_date<date
	str_l_date = year(l_date)  &  right("00" & month(l_date),2) & right("00" & day(l_date),2)
	
	'############################################################
	'Visitor
	'############################################################
	'Counter PerDate
	Set strObjFile = CreateObject("Scripting.FileSystemObject") 'สร้าง Object ที่ใช้กับ Text Fil
	strFileDate = Request.ServerVariables("APPL_PHYSICAL_PATH") &"counters/" & "counter_"  & str_l_date & ".txt"
	
	if  Not strObjFile.fileExists(strFileDate) then 
		Set ObjText =  strObjFile.CreateTextFile(strFileDate,True)
		ObjText.WriteLine("1")
		daily_counter=1
		objText.Close
	Else
		Set ObjText = strObjFile.OpenTextfile(strFileDate,1)
		daily_counter = CLng(ObjText.ReadLine)
		ObjText.Close
	End if				 
	
	
	
	'############################################################
	'Oders
	'############################################################
	Response.Charset="windows-874"
	Set Conn = Server.CreateObject("ADODB.Connection") 
	Conn.open MySqlConnStr			
	set rs =Server.CreateObject("ADODB.Recordset")
	sql ="Select * From  ordhdr Where ORDDATE = " & str_l_date
	rs.CursorLocation = 3
	rs.Open sql,Conn,1,3
	ordersHeader = rs.Recordcount
	
	set rsD =Server.CreateObject("ADODB.Recordset")
	sql ="Select * From  ordLin Where ORDDATE = " & str_l_date
	rsD.CursorLocation = 3
	rsD.Open sql,Conn,1,3
	ordersItem =rsD.Recordcount


	

	'############################################################
	'Register
	'############################################################
	
	set rsReg = Server.CreateObject("ADODB.Recordset")
	sql ="select Name    from msl_register "
	sql =sql & " WHERE  TRANDATE = " & str_l_date
	rsReg.CursorLocation = 3
	rsReg.Open Sql,Conn,1,3
	MslReg= rsReg.Recordcount

		
	'get Current Camp
	strSql = "Select  * FROM  TBL008 Where " & str_l_date & "  BETWEEN  EFFDTE AND EXPDTE"
	set rsCamp =Server.CreateObject("ADODB.Recordset")
	rsCamp.CursorLocation = 3
	rsCamp.Open strSql,Conn,1,3
	if rsCamp.Recordcount =0  Then 
		Camp =0 
	else
		if Isnull(rsCamp("CAMP")) then 
			Camp =0 
		else
			camp = rsCamp("CAMP")
		end if
	end if
		
	
	'############################################################
	'Webboard
	'############################################################
	Set ConnWebboard = Server.CreateObject("ADODB.Connection") 
	ConnWebboard.Open "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & Server.MapPath("../Webboard/data/DataBoard.mdb") & ";Jet OLEDB:Database Password="
	'sql ="Select  faqName From contact_data Where faqDate = '" & str_l_date& "'"
	sql = "select * from mboard where datein = '" &  str_l_date & "'"
	set rsFaq = Server.CreateObject("ADODB.Recordset")
	rsFaq.CursorLocation =3
	rsFaq.Open sql,ConnWebboard,1,3
	faq = rsFaq.Recordcount 
		
	
%>

  <tr>
    <td bgcolor="#D2FFD2"><%=l_date%></td>
    <td bgcolor="#D2FFD2"><%=formatNumber(daily_counter,0)%></td>
    <td bgcolor="#D2FFD2"><%=formatNumber(ordersHeader,0)%></td>
    <td bgcolor="#D2FFD2"><%=formatNumber(ordersItem,0)%></td>
    <td bgcolor="#D2FFD2"><%=formatNumber(MslReg,0)%></td>
    <td bgcolor="#D2FFD2"><%=formatNumber(faq,0)%></td>
  </tr>
<%



	'INSERT Data
	
	sql ="Select  camp,counter_date  From daily_counter Where counter_date = " & str_l_date
	set rsChk = Server.CreateObject("ADODB.Recordset")
	rsChk.CursorLocation =3
	rsChk.Open sql,connCounters,1,3
	if rsChk.Recordcount =0 Then 
				On error Resume Next
                Sql = "INSERT INTO daily_counter(CAMP,counter_date,Visitor,CountOfOrders,CountOfOrdersItems,"
                Sql = Sql & "SumOfOrdersAmount,CountOfMslRegister,CountOfFAQ,CountOfWebboard)"
                Sql = Sql & " VALUES ("
                Sql = Sql & camp & ","
                Sql = Sql & str_l_date & ","
                Sql = Sql & daily_counter & ","
                Sql = Sql & ordersHeader & ","
                Sql = Sql & ordersItem & ","

                Sql = Sql & "0" & ","
                Sql = Sql & MslReg & ","
                Sql = Sql & "0" & ","
                Sql = Sql & faq & ")"
				
				connCounters.Execute Sql
				if Err.Number <> 0 Then 
					response.write  "Error !! : " & err.Description
					response.write "<br>" 
					response.write  " sql = " & SQL
					response.write "<BR>"
					Response.End()
				End If
	End If
	


	l_date = dateadd("d",1,l_date)
loop

%>  
</table>
<br>
<%
if  Request.ServerVariables("REQUEST_METHOD") ="POST" Then 
	Response.write "Create daily report successfull !!"
End IF
'%>
