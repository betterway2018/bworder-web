<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>
<!--#include file="../Include/i_config.asp"-->
<!--#include file="admin_config.asp"-->
<!-- Star Asp Code -->
<%
If Session("Admin_login") = "" then 
	response.Redirect("admin_login.asp")
	response.End()
End IF	


dim strConn
dim Conn
dim rs 
dim  seq
strConn = "Provider=Microsoft.Jet.OLEDB.4.0;Data Source=" & server.MapPath("../counters.mdb") &";Persist Security Info=False;" 
Set Conn = Server.CreateObject("ADODB.Connection") 
With Conn
		.ConnectionString =  strConn
		.CursorLocation =2
		.Open
End With


set rs = Server.CreateObject("ADODB.Recordset")
sql = "Select distinct CAMP From daily_counter  Order by Camp Desc"
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

<script language="JavaScript" src="css/calendar_eu2.js"></script>
	<link rel="stylesheet" href="css/calendar.css">

</head>
<script language="JavaScript">
	   var HttPRequest = false;

	   function doCallAjax(Sort) {
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
		  
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
	
		
			//var camp=document.getElementById('select_camp').value;
			var datefrom=document.getElementById('datefrom').value;
			var dateto=document.getElementById('dateto').value;
			var campaign=document.getElementById('campaign').value;

			
			var url = 'stat_daily_ajax.asp';
			var pmeters =  'Sort='+Sort+'&datefrom='+datefrom+'&dateto='+dateto+'&campaign='+campaign;
			
			//alert (pmeters);
			
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.send(pmeters);
			
			HttPRequest.onreadystatechange = function()
			{

				 if(HttPRequest.readyState == 3)  // Loading Request
				  {
				   document.getElementById("mySpan").innerHTML = "Now is Loading...";
				  }

				 if(HttPRequest.readyState == 4) // Return Request
				  {
				   document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
				  }
				
			}

	   }
	   

   function dailytoday() {
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
		  
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
	
		
			//var camp=document.getElementById('select_camp').value;
			var url = 'daily_counter.asp';
			//var pmeters =  'Sort='+Sort+'&datefrom='+datefrom+'&dateto='+dateto+'&campaign='+campaign;
			
			//alert (pmeters);
			
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		//	HttPRequest.setRequestHeader("Content-length", pmeters.length);
			//HttPRequest.send(pmeters);
			
			HttPRequest.onreadystatechange = function()
			{

				 if(HttPRequest.readyState == 3)  // Loading Request
				  {
				   document.getElementById("dplay").innerHTML = "Now is Loading...";
				  }

				 if(HttPRequest.readyState == 4) // Return Request
				  {
				   document.getElementById("dplay").innerHTML = HttPRequest.responseText;
				  }
				
			}

	   }
	   
	</script>    
    
<script language="javascript">
var limit="0:30";
if (document.images){
var parselimit=limit.split(":");
parselimit=parselimit[0]*60+parselimit[1]*1;
}

function begintimer(){
if (!document.images)
return

//---------Time=0----event------
if (parselimit==0){
parselimit = 300;
begintimer();
}else{
parselimit-=1;
curmin=Math.floor(parselimit/60);
cursec=parselimit%60;
if (curmin!=0){
curtime="your time <font color=red> "+curmin+" </font> minutes and <font color=red>"+cursec+" </font> second";
}else
//--------check second = 0---------------
if(cursec==0){

	//var camp=document.getElementById('select_camp').value;
			var url = 'daily_counter.asp';
			//var pmeters =  'Sort='+Sort+'&datefrom='+datefrom+'&dateto='+dateto+'&campaign='+campaign;
			
			//alert (pmeters);
			
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		//	HttPRequest.setRequestHeader("Content-length", pmeters.length);
			//HttPRequest.send(pmeters);
			
			HttPRequest.onreadystatechange = function()
			{

				 if(HttPRequest.readyState == 3)  // Loading Request
				  {
				   document.getElementById("dplay").innerHTML = "Now is Loading...";
				  }

				 if(HttPRequest.readyState == 4) // Return Request
				  {
				   document.getElementById("dplay").innerHTML = HttPRequest.responseText;
				  }
				
			}
			
}else{
curtime="your time <font color=red>"+cursec+" </font> second";
}
document.getElementById('dplay').innerHTML = curtime;
setTimeout("begintimer()",1000);
}
}
</script>
            

<body  bgcolor="#F0F8FF"  >
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left" valign="top" bgcolor="#F0F8FF"><!--#include file="header.asp" --></td>
  </tr>
  <tr>
    <td width="2%" align="left" valign="top" bgcolor="#F0F8FF"><!--#include file="menu.asp" --></td>
    <td width="100%" align="left" valign="top" bgcolor="#F0F8FF">
      


      <strong class="text_heading"><br />
      ::  Daily Report ::</strong>
      <hr />
      
	<!-- calendar attaches to existing form element -->
    <table width="100%" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <td height="104"  align="left">
        <form name="form1">
        
        <table width="100%" border="0" cellspacing="1" cellpadding="3">
          <tr>
            <td align="right">From Date </td>
            <td ><table width="77%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="27%" nowrap="nowrap"><input name="datefrom" type="text" id="datefrom" /></td>
                <td width="4%" nowrap="nowrap"><script language="JavaScript" type="text/javascript">
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'datefrom'
	});

	          </script></td>
                <td width="8%" align="center" nowrap="nowrap">&nbsp;&nbsp;To&nbsp;&nbsp;</td>
                <td width="27%" nowrap="nowrap"><input name="dateto" type="text" id="dateto" /></td>
                <td width="34%" nowrap="nowrap"><script language="JavaScript" type="text/javascript">
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'dateto'
	});

	          </script></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="right">Campaign</td>
            <td>
            <select name="campaign" id="campaign">
              <option value=""  >   </option>	
              <%	  	do While not rs.Eof  %>
				<option value="<%=rs("CAMP")%>"  ><%=MID(rs("CAMP"),5,2) & "/" & MID(rs("CAMP"),1,4)%></option>	
              <% rs.MoveNext :Loop
			  %>
            </select></td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td><input type="reset" name="button2" id="button2" value="Reset"  />             
             <input type="button" name="button" id="button" value="View" onclick="JavaScript:doCallAjax('counter_date');" /></td>
          </tr>
        </table>
        </form>
        </td>
        <td width="45%" align="center"><iframe width="100%" height="120"  frameborder="0"  style="background-color:#F0F8FF" src="daily_counter.asp"> </iframe>
            </td>
      </tr>
    </table>

 
<span id="mySpan"></span>
  
  </td>
  </tr>
</table>

</body>
</html>
