<?php 
ob_start();
session_start();
?>
<?php  require("check_login.php"); ?>

<?php 
header('Content-type: text/html; charset=windows-874');
include("../i_function_msg.php");
require("../Connections/bwc_orders.php");
include("i_convert.php"); 
?>

<?php
$y=$_POST['year'];
$div= $_SESSION['div_code'];

mysql_select_db($database_bwc_orders, $bwc_orders);
mysql_query("SET NAMES 'tis620'");
//mysql_query("SET NAMES 'utf8'");

$query = "SELECT * FROM tbl008 Where STATUS ='Current'  ";
$tbl008 = mysql_query($query, $bwc_orders) or die(mysql_error());
$row_tbl008 = mysql_fetch_assoc($tbl008);
$rows_tbl008 =mysql_num_rows($tbl008);
if ($rows_tbl008==0) {
	$camp ="";
}
else {
	//$camp = substr($row_tbl008['CAMP'],4,2)."/".substr($row_tbl008['CAMP'],0,4);
	$camp = substr($row_tbl008['CAMP'],0,4);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>BWC ORDERS :Administrator (สำหรับผู้ดูแลระบบเท่านั้น)  : <?php  echo $_SESSION['user'];?></title>
<link rel="stylesheet" href="css/calendar.css">
</head>

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
	
		
			var stryear=document.getElementById('txtyear').value;
			
			if (stryear==""){
				var curdate = new Date()
				var year = curdate.getYear()
				document.getElementById('txtyear').value=year;
				stryear=year;
			}
			
			var url = 'data_campaign_ajax.php';
			// เดิม var url = 'data_campaign_ajax.php';
			var pmeters =  'year='+stryear;
			
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
     
<body onload="doAjax();">
<br />
<form id="form1" name="form1" method="post" action="">
  <table width="900" border="0" align="center" cellpadding="3" cellspacing="0" class="FormBorderGray">
    <tr>
      <td width="49" align="right">ระบุปี:</td>
      <td width="635"><input name="txtyear" type="text" id="txtyear" size="10" maxlength="10" onkeydown="autoTabCampaign(this);" value="<?php echo $camp; ?>"  />
        <input type="button" name="button" id="button" value="Query"  onclick="doAjax()"/>
        <input type="reset" name="button2" id="button2" value="Reset"  onclick="doAjax()"/></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><hr />
        <span id="mySpan"> </span></td>
    </tr>
  </table>
</form>
</body>
</html>