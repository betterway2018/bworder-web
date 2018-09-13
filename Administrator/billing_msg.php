<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />
</head>


<script type="text/javascript">
<!--
function setNextFocus(tar_obj) { //v3.0
	    if (event.keyCode == 13){
            var obj=document.getElementById(tar_obj);
            if (obj){
                obj.focus();
            }
        }
}

//ให้รับเฉพาะตัวเลข
function checknumber() {
	  key=event.keyCode
	 if (key<48  ||  key>57 )  {
				event.returnValue = false;
	 }
}



//-->
</script>

<script language="JavaScript">
	   var HttPRequest = false;
	   function doAjax(order_by) {
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
	
		
			
			
			//if (stryear==""){
			//	var curdate = new Date()
			//	var year = curdate.getYear()
			//	document.getElementById('txtyear').value=year;
			//	stryear=year;
		//	}
			
			var url = 'billing_msg_ajax.php';

			// เดิม var url = 'data_campaign_ajax.php';
			//var order_by="";
			var pmeters = "orderby="+order_by;
			
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
				   document.getElementById("data").innerHTML = "Now is Loading...";
				  }

				 if(HttPRequest.readyState == 4) // Return Request
				  {
				   document.getElementById("data").innerHTML = HttPRequest.responseText;
				  }
				
			}
	   }
	</script>  

<script language="JavaScript">
	   var HttPRequestGetFill = false;
	   function get_BillCode(billcode) {
		  HttPRequestGetFill = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequestGetFill = new XMLHttpRequest();
			 if (HttPRequestGetFill.overrideMimeType) {
				HttPRequestGetFill.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequestGetFill = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequestGetFill = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
		  
		  if (!HttPRequestGetFill) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
	
		
			
			
			//if (stryear==""){
			//	var curdate = new Date()
			//	var year = curdate.getYear()
			//	document.getElementById('txtyear').value=year;
			//	stryear=year;
		//	}
			
			var url = 'billing_msg_get.php';
			var txt_camp1= document.getElementById('txt_camp1').value;
			var txt_camp2= document.getElementById('txt_camp2').value;
			// เดิม var url = 'data_campaign_ajax.php';
			//var order_by="";
			var pmeters = "txt_camp1="+txt_camp1+"&txt_camp2="+txt_camp2 +"&txt_billcode="+billcode;
			
			//alert (pmeters);
			
			
			HttPRequestGetFill.open('POST',url,true);

			HttPRequestGetFill.setRequestHeader("Content-type", "application/x-www-form-urlencoded;");
			HttPRequestGetFill.setRequestHeader("charset", "windows-874")

			//HttPRequest.setRequestHeader("Content-Type", "text/plain;charset=windows-874");
			HttPRequestGetFill.setRequestHeader("Content-length", pmeters.length);
			

			HttPRequestGetFill.send(pmeters);
			
			//<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
			
			HttPRequestGetFill.onreadystatechange = function()
			{

				 if(HttPRequestGetFill.readyState == 3)  // Loading Request
				  {
				   //document.getElementById("data").innerHTML = "Now is Loading...";
				  }

				 if(HttPRequestGetFill.readyState == 4) // Return Request
				  {
				   //document.getElementById("data").innerHTML = HttPRequestGetFill.responseText;
				   document.getElementById("txt_billdesc").value  = HttPRequestGetFill.responseText;
				    if ( document.getElementById("txt_billdesc").value=="") {
						document.getElementById("txt_billdesc").focus();
					}else
					{
						document.getElementById("sel_type").value
					}
				  }
				
			}
	   }
	</script>  
    
<body onload="javascript:doAjax('CAMP')">
<table width="800" border="0" align="center" cellpadding="0" cellspacing="0" class="FormBorderGray">
  <tr>
    <td>Billing code Message  on   <font color="#FF0000"> <b><?php  echo  $_SERVER['HTTP_HOST'] ;?></b></font></td>
  </tr>
  <tr>
    <td><hr /><span id="data"> </span></td>
  </tr>
</table>
<br />
<br />
<form id="form1" name="form1" method="post" action="billing_msg_insert.php">
  <table width="663" border="0" align="center" cellpadding="3" cellspacing="1" class="FormBorderRed">
    <tr >
      <td colspan="2" align="left" nowrap="nowrap" bgcolor="#F0EEEF">:: เพิ่มข้อมูล<a name="Insert" id="Insert"></a></td>
    </tr>
    <tr>
      <td width="102" align="right" nowrap="nowrap" bgcolor="#F0EEEF"><strong>Campaign</strong></td>
      <td width="546" nowrap="nowrap" bgcolor="#F9F9F9"><input name="txt_camp1" type="text" id="txt_camp1" size="2" maxlength="2"  onkeydown="setNextFocus('txt_camp2');"/>
        /
        <input name="txt_camp2" type="text" id="txt_camp2" size="5" maxlength="5" onkeydown="setNextFocus('txt_billcode');" /></td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap" bgcolor="#F0EEEF"><strong>Bill Code</strong></td>
      <td nowrap="nowrap" bgcolor="#F9F9F9"><input name="txt_billcode" type="text" id="txt_billcode" size="10" maxlength="5"
        onkeydown=" if (event.keyCode == 13){get_BillCode(document.getElementById('txt_billcode').value);}"/></td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap" bgcolor="#F0EEEF"><strong>Bill Description</strong></td>
      <td nowrap="nowrap" bgcolor="#F9F9F9"><input name="txt_billdesc" type="text" id="txt_billdesc" size="80" onkeydown="setNextFocus('sel_type');" /></td>
    </tr>
    <tr>
      <td align="right" nowrap="nowrap" bgcolor="#F0EEEF"><strong> Type</strong></td>
      <td nowrap="nowrap" bgcolor="#F9F9F9"><select name="sel_type" id="sel_type" >
        <option value="LOCK">LOCK ENTRY BILLCODE</option>
        <option value="VIP">VIP EXCEPT BILLCODE</option>
        <option value="DUP">DUPLICATE BILLCODE</option>
      </select></td>
    </tr>
    <tr>
      <td align="right" valign="top" nowrap="nowrap" bgcolor="#F0EEEF"><strong>Message</strong></td>
      <td nowrap="nowrap" bgcolor="#F9F9F9"><textarea name="txt_msgdesc" id="txt_msgdesc" cols="45" rows="5" style="width:100%"></textarea></td>
    </tr>
    <tr class="content_header">
      <td align="right" nowrap="nowrap" bgcolor="#F0EEEF">&nbsp;</td>
      <td nowrap="nowrap" bgcolor="#F9F9F9"><span class="content_header3">
        <input type="button" name="cmdSearch2" id="cmdSearch2" value="บันทึก" onclick="document.getElementById('form1').submit();" />
        <input type="reset" name="cmdReset2" id="cmdReset2" value="ยกเลิก" />
      </span></td>
    </tr>
    <tr class="content_header">
      <td colspan="2" align="center" valign="top" nowrap="nowrap"><hr /></td>
    </tr>
  </table>
</form>
<p><br />
</p>
</body>
</html>