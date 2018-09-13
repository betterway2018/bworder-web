<%@LANGUAGE="VBSCRIPT" CODEPAGE="874"%>

<!--#include file="../Include/i_config.asp"-->
<!--#include file="../Connections/MySql_Connection.asp"-->


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><%=title%></title>
<link href="../styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/calendar.css">
<script language="JavaScript" src="css/calendar_db.js"></script>
</head>
<script language="JavaScript">
	   var HttPRequest = false;

	   function doCallAjax(Sort,page) {
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
			
			var url = 'data_register_Ajax.asp';
			var pmeters =  'Sort='+Sort+'&page='+page+'&datefrom='+datefrom+'&dateto='+dateto;
			
			
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
	</script>    
<body  onload="JavaScript:doCallAjax('TRANDATE',1);">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td width="1%" align="left" valign="top">&nbsp;</td>
    <td width="99%" align="left" valign="top" bgcolor="#F3D8E6"><br />
  <strong class="text_heading">::  ข้อมูลการสมัครสมาชิก ::</strong>
    <hr />
    <form id="form1" name="form1" method="post" action="">
      <table width="503" border="0" cellspacing="0" cellpadding="3">
        <tr>
          <td width="114" align="right" valign="middle">วันที่ลงทะเบียน :</td>
          <td width="377"><table width="77%" border="0" cellspacing="0" cellpadding="0">
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
              <td width="8%" align="center" nowrap="nowrap">&nbsp;&nbsp;ถึง&nbsp;&nbsp;</td>
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
          <td align="right">&nbsp;</td>
          <td><input type="reset" name="button2" id="button2" value="Reset" />
            <input type="button" name="button" id="button" value="View" onclick="JavaScript:doCallAjax('TRANDATE',1);" /></td>
        </tr>
      </table>
    </form>
<span id="mySpan"></span></td>
  </tr>
  <tr>
    <td colspan="2" valign="top">&nbsp;</td>
  </tr>
</table>
</body>
</html>
