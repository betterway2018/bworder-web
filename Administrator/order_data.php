<?php session_start();?>
<?php  require("check_login.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>DSM INTERORDER SYSTEM : <?php  echo $_SESSION['user'];?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
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
	
		
			var dist=document.getElementById('txtdist').value;
			
			var url = 'data_order_ajax.php';
			var pmeters =  'dist='+dist;
			
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
     
<body>
<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="FormBorder" >
  <tr>
    <td height="33" colspan="2"><?php include("i_header.php"); ?></td>
  </tr>
  <tr>
    <td width="130"  rowspan="2" align="left" valign="top" class="left_menu" ><?php include("i_left_menu.php"); ?></td>
    <td width="813" height="558" align="left" valign="top" bgcolor="#FFFFFF" style="padding:5px"><table width="100%" height="28" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><fieldset><br />
<br />

        </fieldset></td>
      </tr>
    </table>
      <br />
      <form id="form1" name="form1" method="post" action="">
        <table width="800" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td>√À— ‡¢µ: 
            <input name="txtdist" type="text" id="txtdist" size="5" maxlength="5" />
            <input type="button" name="button" id="button" value="Button"  onclick="doAjax()"/></td>
          </tr>
        </table>
     <hr />
        <span id="mySpan"> </span>
      </form>

<br /></td>
  </tr>
  <tr>
    <td height="32" bgcolor="#FFFFFF"><?php include("i_footer.php"); ?></td>
  </tr>
</table>
</body>
</html>