<?php session_start();?>
<?php  require("check_login.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>DSM INTERORDER SYSTEM : <?php  echo $_SESSION['user'];?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
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
			var strcamp=document.getElementById('txtcamp').value;
			var sel_status =document.getElementById('sel_status').value;
			//var intcamp=substr(strcamp,4,4);
			//alert(intCamp);
			var url = 'data_order_ajax.php';
			var pmeters =  'dist='+dist+'&camp='+strcamp+'&dwnflag='+sel_status;
			
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
</script>
     
<body onload="doAjax()">
<br />
<br />
<hr />
    <span id="mySpan"> </span>

</body>
</html>