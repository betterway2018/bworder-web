<?php session_start();
 ob_start();
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
	$camp = substr($row_tbl008['CAMP'],4,2)."/".substr($row_tbl008['CAMP'],0,4);
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>DSM INTERORDER SYSTEM : <?php  echo $_SESSION['user'];?></title>
<link rel="stylesheet" href="css/calendar.css">
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
	
		
			var txtcamp=document.getElementById('txtcamp').value;
			var txtdist=document.getElementById('txtdist').value;
			var txtdiv =document.getElementById('txtdiv').value;
			
			if (txtcamp=="") {
				alert("กรุณาระบุรอบจำหน่าย");
				document.getElementById('txtcamp').focus();
				return false;
			}
			
			var url = 'data_mailplan_ajax.php';
			var pmeters =  'camp='+txtcamp+'&dist='+txtdist+'&txtdiv='+txtdiv;
			
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
	   
	   function get_default(camp) {
			document.getElementById('txtcamp').value=camp;
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
     
<body  onload="get_default('<?php  echo $camp;?>')">
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0" >
    <tr>
      <td align="right">รอบจำหน่าย :</td>
      <td><input name="txtcamp" type="text" id="txtcamp"   onkeydown="autoTabCampaign(this);" value="<?php echo $camp; ?>" size="10" maxlength="10"/></td>
    </tr>
    <tr>
      <td align="right">Division :</td>
      <td><input name="txtdiv" type="text" id="txtdiv" size="10" maxlength="10"  /></td>
    </tr>
    <tr>
      <td align="right">เขต:</td>
      <td><input name="txtdist" type="text" id="txtdist" size="10" maxlength="10"  /></td>
    </tr>
    <tr>
      <td width="91" align="right">&nbsp;</td>
      <td width="885"><input type="button" name="button" id="button" value="Query"  onclick="doAjax()"/>
        <input type="reset" name="button2" id="button2" value="Reset"  onclick="doAjax()"/></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><hr />
        <span id="mySpan"> </span>&nbsp;</td>
    </tr>
  </table>
</form>
<?php ob_end_flush(); ?>
</body>
</html>