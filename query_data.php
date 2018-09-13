<?php  session_start(); ?>
<?php require("i_config.php"); ?>
<?php require("check_login.php"); ?>
<?php require_once('Connections/bwc_orders.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><?php  echo $title?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>

<script language="JavaScript">
	   var HttPRequest = false;
	   function Get_RepInfo(dist,mslno,chkdgt,paydate,under_con) {
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

	
		   //var dist=document.getElementById('dist').value;
		   //var mslno=document.getElementById('mslno').value;
		  // var chkdgt =document.getElementById('chkdgt').value;
		  // var paydate =document.getElementById('paydate').value;
		   
		   if (dist==""){
			   alert("กรุณาระบุรหัสเขต");
			   return false;
		   }
		   else if(mslno=="") { 
		   		alert("กรุณาระบุรหัสสมาชิก");
				document.getElementById('mslno').focus();
				return false;
		   }
		   else if(chkdgt=="") {
		   		alert("กรุณาระบุรหัสสมาชิก");
				document.getElementById('chkdgt').focus();
				return false;
		   }
		   		   

		   var url='';
		   if (under_con=="yes") {
			  // url='under_con.php';
			     document.getElementById("mySpan").innerHTML ="<?php  echo $maintenance_msg; ?>";
				 //HttPRequest.responseText;
				 return false;
		   }
		   else {
			   url= 'asp_Get_RepInfo.asp';
		   }
	      
		   
		   var pmeters = 'dist='+dist+'&mslno='+mslno+'&chkdgt='+chkdgt+'&paydate='+paydate+'&maintenance='+under_con+'&msg=';
	
			//alert (pmeters);
			document.getElementById("mySpan").innerHTML = "กรุณารอสักครู่ ...";
			
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
				   document.getElementById("mySpan").innerHTML = "กรุณารอสักครู่ ...";
				  }

				 if(HttPRequest.readyState == 4) // Return Request
				  {
				   document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
				  }
				
			}
	   }

	   
</script>    
</head>
<?php

mysql_select_db($database_bwc_orders, $bwc_orders);
mysql_query("SET NAMES 'tis620'");
//mysql_query("SET NAMES 'utf8'");


$dist=$_SESSION['dist'];
$date = date("Ymd");
$query = "SELECT  MAILDATE,BILLDATE   from tbl015 WHERE DIST='$dist' AND BILLDATE >$date ORDER BY CAMP ASC  Limit 1";
$mailplan = mysql_query($query,$bwc_orders) or die(mysql_error());
$row_mailplan =mysql_fetch_assoc ($mailplan);
$total_row_mailplan = mysql_num_rows($mailplan);		
if ($total_row_mailplan >0 ) {
	$paydate=$row_mailplan['MAILDATE'];
}
else {
	$paydate="";
}
//echo "paydate = $paydate"
mysql_free_result($mailplan);
?>
    
<body onload="Get_RepInfo('<? echo $_SESSION['dist'] ?>','<? echo $_SESSION['mslno']  ?>','<?  echo $_SESSION['chkdgt'] ?>','<?  echo $paydate ?>','<? echo $maintenance ;?>');" >

<table width="900" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td><table width="860" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" align="left" valign="top"><img src="images/Box_Set3/frame_01.gif" width="5" height="5" /></td>
        <td width="845" align="left" valign="top"><img src="images/Box_Set3/frame_02.gif" width="900" height="5" /></td>
        <td width="10" align="right" valign="top"><img src="images/Box_Set3/frame_03.gif" width="5" height="5" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="Sheet_Boder"  ><?php include("i_header_no.php"); ?>
</td>
  </tr>
  <tr>
  <td height="200" align="center" valign="top" class="Sheet_Boder" style="padding:2px">

<br />
<br /><span id="mySpan"> </span>
<br />


<!-- Start  Content  -->    
    
    
    
    <br />
    <br /></td>
  </tr>
  <tr>
    <td valign="top" ><table width="790" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="1%" align="left" valign="top"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_07.gif" 
                        width="5" /></td>
        <td width="100%" ><img height="5" alt="" 
                        src="Images/Box_Set3/frame_08.gif" 
                        width="900" /></td>
        <td width="1%" align="right" valign="top"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_09.gif" 
                        width="5" /></td>
      </tr>
    </table></td>
  </tr>
</table>
<br /><?php include("i_footer.php"); ?>
</body>
</html>