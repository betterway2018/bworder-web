<?php session_start();?>
<?php  require("check_login.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>BWC INTERNET ORDER SYSTEM : ADMINISTRATOR <?php  echo $_SESSION['user'];?></title>
<link rel="stylesheet" href="css/calendar.css">
</head>

<script type="text/javascript"> 
	function autoTabCampaign(obj){ 
	/* ��˹��ٻẺ��ͤ�������� _ ᷹������á��� ���ǵ����������ͧ���� 
	�����ѭ�ѡɳ������� �蹡�˹��� �ٻẺ�Ţ���ѵû�ЪҪ� 
	4-2215-54125-6-12 ������ö��˹��� _-____-_____-_-__ 
	�ٻẺ�������Ѿ�� 08-4521-6521 ��˹��� __-____-____ 
	���͡�˹������� 12:45:30 ��˹��� __:__:__ 
	������ҧ��ҧ��ҧ�繡�á�˹��ٻẺ�Ţ�ѵû�ЪҪ� 
	*/ 
	var pattern=new String("__/____"); // ��˹��ٻẺ㹹�� 
	var pattern_ex=new String("/"); // ��˹��ѭ�ѡɳ���������ͧ���·������㹹�� 
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
	
	
			var dist=document.getElementById('txtdist').value;
			var mslno=document.getElementById('txtmslno').value;
			var strcamp1=document.getElementById('txtcamp1').value;
			var strcamp2=document.getElementById('txtcamp2').value;
			var sel_status =document.getElementById('sel_status').value;
			//var intcamp=substr(strcamp,4,4);
			//alert(intCamp);
			var strcamp="";
			if (strcamp1!="" && strcamp2!="") {
				strcamp = strcamp1+'/'+strcamp2;
			}
			else {
				strcamp="";
			}
			var url = 'data_order_ajax_cc.php';
			var pmeters =  'dist='+dist+'&mslno='+mslno+'&camp='+strcamp+'&dwnflag='+sel_status;
			
		//	alert (pmeters);
			
			
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
</script>
     
<body>
<br />
<br />

  <table width="800" border="0" cellpadding="3" cellspacing="0" align="center">
    <tr>
      <td align="right">�������ŷ���ҹ��ͧ��ä���</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td align="right">��س��к��ͺ��˹���:</td>
      <td><input name="txtcamp1" type="text" id="txtcamp1" size="2" maxlength="2"  onkeyup="if(document.getElementById('txtcamp1').value.length==2){txtcamp2.focus();} "/>
      /
      <input name="txtcamp2" type="text" id="txtcamp2" size="4" maxlength="4"  /></td>
    </tr>
    <tr>
      <td align="right">����ࢵ:</td>
      <td><input name="txtdist" type="text" id="txtdist" size="5" maxlength="4" value="0999"/>-<input name="txtmslno" type="text" id="txtmslno" size="5" maxlength="5" /></td>
    </tr>
    <tr>
      <td align="right">���͡ʶҹ� :</td>
      <td><select name="sel_status" id="sel_status">
        <option value="N">�ѧ���١��ǹ���Ŵ</option>
        <option value="Y">��ǹ���Ŵ����</option>
        <option value="">������</option>
      </select></td>
    </tr>
    <tr>
      <td width="208" align="right">&nbsp;</td>
      <td width="580"><input type="button" name="button" id="button" value="�ʴ�������"  onclick="doAjax()"/>
      <input type="reset" name="button2" id="button2" value="��ҧ������"  onclick="doAjax()"/></td>
    </tr>
  </table>
<hr />
    <span id="mySpan"> </span>

</body>
</html>