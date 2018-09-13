<?php  session_start(); ?>
<?php require("i_config.php"); ?>

<?php
$dist=$_SESSION['dist'];
$mslno=$_SESSION['mslno'];
$chkdgt=$_SESSION['chkdgt'];
$rep_name=$_SESSION['name'];


if ($dist=="" || $mslno=="" || $chkdgt=="") {
	echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
}


?>
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

<script language="JavaScript" >
	   var HttPRequest = false;
//#################################################################################	   

function initial_google_map(dist,mslno,chkdgt,invno,radio,tr){
		var f_map  = document.getElementById('google_map');
		//f_map.setAttribute('src','googlemap2.asp?lat='+myArray[1]+'&lon='+myArray[2]);
		f_map.setAttribute('src','http://mailsrv-01.mistine.co.th/webservice/gpsreader.asp?dist='+dist+'&mslno='+mslno+'&chkdgt='+chkdgt+'&invoice='+invno+'&radio='+radio +'&tr='+tr );
		
		//document.getElementById("mySpan").innerHTML = "";
				
}
		
	</script>
    
</head>

<body>
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
    <td height="480" align="left" valign="top" class="Sheet_Boder" style="padding:2px">
    
    
<!-- Start  Content  -->    
    
    <?php
	
	
	$DataToSend="dist=$dist&mslno=$mslno&chkdgt=$chkdgt";
	$postUrl="http://mailsrv-01.mistine.co.th/webservice/list_invoice.asp"  . "?".$DataToSend;

?>
    <br />
<iframe id="google_map" src="<?php echo $postUrl; ?>" width="900" height="508" frameborder="0" scrolling="Auto"> </iframe>
    </td>
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