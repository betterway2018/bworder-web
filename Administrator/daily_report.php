<?php session_start();?>
<?php  require("check_login.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>DSM INTERORDER SYSTEM : <?php  echo $_SESSION['user'];?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" href="css/calendar.css">
<script language="JavaScript" src="css/calendar_db.js"></script>
</head>

<script type="text/javascript"> 
	function autoTabCampaign(obj){ 
	/* กำหนดรูปแบบข้อความโดยให้ _ แทนค่าอะไรก็ได้ แล้วตามด้วยเครื่องหมาย 
	หรือสัญลักษณ์ที่ใช้แบ่ง เช่นกำหนดเป็น รูปแบบเลขที่บัตรประชาชน 
	4-2215-54125-6-12 ก็สามารถกำหนดเป็น _-____-_____-_-__ 
	รูปแบบเบอร์โทรศัพท์ 08-4521-6521 กำหนดเป็น __-____-____ 
	หรือกำหนดเวลาเช่น 12:45:30 กำหนดเป็น __:__:__ 
	ตัวอย่างข้างล่างเป็นการกำหนดรูปแบบเลขบัตรประชาชน 
	*/ 
	var pattern=new String("__/____"); // กำหนดรูปแบบในนี้ 
	var pattern_ex=new String("/"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้ 
	var returnText=new String(""); 
	var obj_l=obj.value.length; 
	var obj_l2=obj_l-1; 
	for(i=0;i<pattern.length;i++){ 
	if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){ 
	returnText+=obj.value+pattern_ex; 
	obj.value=returnText; 
	} 
	} 
	if(obj_l>=pattern.length){ 
	obj.value=obj.value.substr(0,pattern.length); 
	} 
	} 

</script> 

<script language="JavaScript">
	   var HttPRequest = false;
	   function doAjax() {
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
	
	
			//var dist=document.getElementById('txtdist').value;
			//var strcamp=document.getElementById('txtcamp').value;
			//var sel_status =document.getElementById('sel_status').value;
			//var intcamp=substr(strcamp,4,4);
			//alert(intCamp);
			var url = 'daily_report_ajax.php';
			var pmeters="";
			//var pmeters =  'dist='+dist+'&camp='+strcamp+'&dwnflag='+sel_status;
			
			//alert (pmeters);
			
			
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded;");
			HttPRequest.setRequestHeader("charset", "windows-874")

			//HttPRequest.setRequestHeader("Content-Type", "text/plain;charset=windows-874");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			

			HttPRequest.send(pmeters);
			
			//<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
			
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
<script type="text/javascript">
	function MM_openBrWindow(theURL,winName,w,h,scrollbars) 
	{ 
	  LeftPosition=(screen.width)?(screen.width-w)/2:100;
	  TopPosition=(screen.height)?(screen.height-h)/2:100;
	  
	  settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars=yes,location=no,directories=no,status=0,menubar=no,toolbar=no,resizable=yes';
	  URL = theURL;
	  window.open(URL,winName,settings);
	}
	
	//ให้รับเฉพาะตัวเลข
function checknumber() {
	  key=event.keyCode
	 if (key<48  ||  key>57 )  {
			 if (key==45) {
				event.returnValue = true;
			 } else {
				event.returnValue = false;
			 }
	 }
}
</script>
     
<body onload="doAjax()">
<table width="825" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="466" align="center" valign="bottom"><form id="form1" name="form1" method="post" action="">
      <table width="466" border="0" cellspacing="1" cellpadding="3">
        <tr>
          <td width="85" align="right">Order Date </td>
          <td width="366" ><table width="77%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="27%" align="left" nowrap="nowrap"><input name="datefrom" type="text" id="datefrom"  onkeypress="checknumber()" size="16" /></td>
              <td width="4%" align="left" nowrap="nowrap"><script language="JavaScript" type="text/javascript">
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'datefrom'
	});

	          </script></td>
              <td width="8%" align="center" nowrap="nowrap">&nbsp;&nbsp;To&nbsp;&nbsp;</td>
              <td width="27%" align="left" nowrap="nowrap"><input name="dateto" type="text" id="dateto" onkeypress="checknumber()" size="16" /></td>
              <td width="34%" align="left" nowrap="nowrap"><script language="JavaScript" type="text/javascript">
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
          <td align="left"><input type="reset" name="button2" id="button2" value="Reset"  />
            <input type="button" name="button" id="button" value="View" onclick="JavaScript:doAjax();" /></td>
        </tr>
      </table>
    </form></td>
    <td width="359"><iframe width="360" height="60" frameborder="0" scrolling="no"> </iframe></td>
  </tr>
</table>
<br />
<hr />
    <span id="mySpan"> </span>

</body>
</html>