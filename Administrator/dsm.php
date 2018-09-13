<?php session_start();?>
<?php  require("check_login.php"); ?>
<?php require("../i_config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>BW INTERNET ORDER SYSTEM : Adminitrator<?php  echo $_SESSION['login_name'];?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="Scripts/highslide/highslide.css" />
<script type="text/javascript" src="Scripts/highslide/highslide-with-html.js"></script>


<script type="text/javascript">
	function openLightbox() {
		fireEvent(document.getElementById("idOfYourLink"),'click');
	}
	
	function fireEvent(obj,evt){
		var fireOnThis = obj;
		if( document.createEvent ) 	{
			var evObj = document.createEvent('MouseEvents');
			evObj.initEvent( evt, true, false );
			fireOnThis.dispatchEvent(evObj);
		} else if( document.createEventObject ) {
			fireOnThis.fireEvent('on'+evt);
		}
	}
</script>

<script type="text/javascript">
	hs.graphicsDir = 'Scripts/highslide/graphics/';
	hs.outlineType = 'rounded-white';
	hs.showCredits = false;
	hs.wrapperClassName = 'draggable-header';
</script>


<style type="text/css">
<!--
.validateTips {border: 1px solid transparent; padding: 0.3em; }
input.text {margin-bottom:12px; width:95%; padding: .4em; }
div#users-contain {width: 350px; margin: 20px 0; }
-->
</style>
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
	
		
			var txtdist=document.getElementById('txtdist').value;
			var txtdiv =document.getElementById('txtdiv').value;
			
			var url = 'dsm_ajax.php';
			var pmeters =  'txtdist='+txtdist+'&div='+txtdiv;
			
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
				   return true;
				  }

				 if(HttPRequest.readyState == 4) // Return Request
				  {
				   document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
				   return true;
				  }
				
			}

	   }
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------
	 function GetFill() {
	   
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
	
			document.getElementById('txtdist_name').value="";
			var txtdist=document.getElementById('txtdist').value;
			var txtdiv =document.getElementById('txtdiv').value;
			var url = 'dsm_GetFill.php';
			var pmeters =  'txtdist='+txtdist+'&div='+txtdiv;
			
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
				   
				   document.getElementById('txtdist_name').value="Loading ...";
				    return true;
				  }

				 if(HttPRequest.readyState == 4) // Return Request
				  {
				   document.getElementById('txtdist_name').value=HttPRequest.responseText;
				    return true;
				  }
				
			}

	   }
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------
//-----------------------------------------------------------------------------------------------------------------------------------------------------------------
function doReset() {
	 document.getElementById('txtdist_name').value="";
	 document.getElementById('txtdist').value="";
	 doAjax();
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
</script>


<body onload="doAjax();"  >
<table width="900" border="0" align="center" cellpadding="3" cellspacing="0" class="FormBorderGray">
  <tr>
    <td align="right" bgcolor="#F5F5F5"><?  echo $_SESSION['login_type']; ?></td>
    <td bgcolor="#F5F5F5"><input name="disp_div" type="text" disabled="disabled" id="disp_div" value="<?php  echo $_SESSION['login_id']?>" size="10" maxlength="10"  />
      <input name="textfield" type="text" disabled="disabled" id="textfield" value="<?php echo $_SESSION['login_name']?>" size="36" />
      <input name="txtdiv" type="hidden" id="txtdiv" value="<?php  echo $_SESSION['div_code']?>" /></td>
  </tr>
  <tr>
    <td align="right" bgcolor="#F5F5F5">เขต:</td>
    <td bgcolor="#F5F5F5"><input name="txtdist" type="text" id="txtdist" size="10" maxlength="10"  onchange="return GetFill();"  />
      <input name="txtdist_name" type="text" disabled="disabled" id="txtdist_name" size="36" /></td>
  </tr>
  <tr class="Sheet_Footer">
    <td width="54" align="right" bgcolor="#F5F5F5">&nbsp;</td>
    <td width="637" bgcolor="#F5F5F5"><input type="button" name="button" id="button" value="Query"  onclick="doAjax()"/>
      <input type="button" name="button2" id="button2" value="Reset"  onclick="doReset();"/></td>
  </tr>
  <tr>
    <td height="39" colspan="2" align="left"><hr />
      <span id="mySpan"> </span></td>
  </tr>
</table>
</body>
</html>