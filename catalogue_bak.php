<?php  session_start(); ?>
<?php require("i_config.php"); ?>
<?php require("check_login.php"); ?>
<?php require_once('Connections/bwc_orders.php'); ?>

<?php

$coverpage ="coverpage.jpg";
$html_default ="default.html";

mysql_select_db($database_bwc_orders, $bwc_orders);
$query ="Select * From website  order by  website_id asc ";
$website = mysql_query($query, $bwc_orders) or die(mysql_error());
$row_website = mysql_fetch_assoc($website);
$numRows_website = mysql_num_rows($website);

//echo "row= $numRows_website <br>";
//echo $row_website['WEBSITE_ID']." : " .$row_website['WEBSITE_NAME'] ."<br>";
 
if ($numRows_website !=0){
	 do {
		 //echo $row_website['WEBSITE_ID']." : " .$row_website['WEBSITE_NAME'] ."<br>";
		 switch ($row_website['WEBSITE_ID']) {
    				case "1":
								$mistine=array($row_website['Catalogue1'],$row_website['Catalogue2'],$row_website['Catalogue3']);
						        break;
					case "2":
								//$friday=('http://www.friday.co.th/Catalogue/catalogue_friday.asp?camp=201109');
								$friday=array($row_website['Catalogue1'],$row_website['Catalogue2'],$row_website['Catalogue3']);
								break;
					case "3":
								$faris= array($row_website['Catalogue1'],$row_website['Catalogue2'],$row_website['Catalogue3']);
								break;
					case "4":
								$fridayGrand=array($row_website['Catalogue1'],$row_website['Catalogue2'],$row_website['Catalogue3']);
								break;
								
		}
	 } while ($row_website = mysql_fetch_assoc($website));

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><?php  echo $title?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="catalogue/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="catalogue/highslide/highslide.css" />

<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>


        
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
	hs.graphicsDir = 'Catalogue/highslide/graphics/';
	hs.outlineType = 'rounded-white';
	hs.showCredits = false;
	hs.wrapperClassName = 'draggable-header';
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
    <td height="480" align="left" valign="top" class="Sheet_Boder" style="padding:2px"><h3>
      <!-- This is all the XHTML ImageFlow needs -->
      </h3>
      <table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="3"><img src="image_icon/1h_catalogue_mistine.gif" width="864" height="40" /></td>
        </tr>
        <tr>
          <td align="center" bgcolor="#daf2e3">&nbsp;</td>
          <td align="center"  bgcolor="#daf2e3">&nbsp;</td>
          <td align="center"  bgcolor="#daf2e3">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" bgcolor="#daf2e3"><a href="<? echo $mistine[0]."/".$html_default ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"><img src="<? echo $mistine[0] ."/". $coverpage ?>" alt="á¤µµÒÅçÍ¤ Mistine # 1"   width="175" height="203" border="0"  /></a></td>
          <td align="center"  bgcolor="#daf2e3"><a href="<? echo $mistine[1]."/".$html_default ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"><img src="<? echo $mistine[1]."/".$coverpage ?>"  alt="á¤µµÒÅçÍ¤ Mistine # 2" width="175" height="203" border="0"  /></a></td>
          <td align="center"  bgcolor="#daf2e3"><a href="<? echo $mistine[2]."/".$html_default ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"><img src="<? echo $mistine[2]."/".$coverpage ?>"  alt="á¤µµÒÅçÍ¤ Mistine # 3"  width="175" height="203" border="0"  /></a></td>
        </tr>
        <tr>
          <td colspan="3"><img src="image_icon/u_catalogue.gif" width="864" height="10" /></td>
        </tr>
      </table><br/>
      <table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="3"><img src="image_icon/1h_catalogue_faris.gif" width="864" height="40" /></td>
        </tr>
        <tr>
          <td align="center" bgcolor="#daf2e3">&nbsp;</td>
          <td align="center"  bgcolor="#daf2e3">&nbsp;</td>
          <td align="center"  bgcolor="#daf2e3">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" bgcolor="#daf2e3"><a href="<? echo $faris[0]."/".$html_default ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"><img src="<? echo $faris[0]."/".$coverpage ?>" alt="á¤µµÒÅçÍ¤ Faris # 1"  width="175" height="203" border="0"  /></a><a href="<? echo $mistine[0]."/".$html_default ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"></a></td>
          <td align="center"  bgcolor="#daf2e3"><a href="<? echo $faris[1]."/".$html_default ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"><img src="<? echo $faris[1]."/".$coverpage ?>"  alt="á¤µµÒÅçÍ¤ Faris # 2"  width="175" height="203" border="0"  /></a><a href="<? echo $mistine[1]."/".$html_default ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"></a></td>
          <td align="center"  bgcolor="#daf2e3"><a href="<? echo $faris[2]."/".$html_default  ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"><img src="<? echo $faris[2]."/".$coverpage ?>"  alt="á¤µµÒÅçÍ¤ Faris # 3"  width="175" height="203" border="0"  /></a><a href="<? echo $mistine[2]."/".$html_default ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"></a></td>
        </tr>
        <tr>
          <td colspan="3"><img src="image_icon/u_catalogue.gif" width="864" height="10" /></td>
        </tr>
      </table>
      <br />
      <table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="5"><img src="image_icon/1h_catalogue_friday.gif" width="864" height="40" /></td>
        </tr>
        <tr>
          <td align="center" bgcolor="#daf2e3">&nbsp;</td>
          <td colspan="2" align="center"  bgcolor="#daf2e3">&nbsp;</td>
          <td colspan="2" align="center"  bgcolor="#daf2e3">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" bgcolor="#daf2e3">&nbsp;</td>
          <td align="center"  bgcolor="#daf2e3"><a href="<? echo $friday[1]."/".$html_default ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"><img src="<? echo $friday[1]."/".$coverpage ?>"  alt="á¤µµÒÅçÍ¤ Friday # 2"  width="175" height="203" border="0"   /></a></td>
          <td align="center"  bgcolor="#daf2e3"><a href="<? echo $fridayGrand[1]."/".$html_default ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"><img src="<? echo $fridayGrand[1]."/".$coverpage ?>"  alt="á¤µµÒÅçÍ¤ FridayGrand # 2"  width="175" height="203" border="0"   /></a></td>
          <td align="center"  bgcolor="#daf2e3"><a href="<? echo $friday[2]."/".$html_default  ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"><img src="<? echo $friday[2]."/".$coverpage ?>"  alt="á¤µµÒÅçÍ¤ Friday # 3"  width="175" height="203" border="0"   /></a></td>
          <td align="center"  bgcolor="#daf2e3"><a href="<? echo $fridayGrand[2]."/".$html_default ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"><img src="<? echo $fridayGrand[2]."/".$coverpage ?>"  alt="á¤µµÒÅçÍ¤ FridayGrand # 2"  width="175" height="203" border="0"   /></a></td>
        </tr>
        <tr>
          <td align="center" bgcolor="#daf2e3">&nbsp;</td>
          <td colspan="2" align="center"  bgcolor="#daf2e3">&nbsp;</td>
          <td colspan="2" align="center"  bgcolor="#daf2e3">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" bgcolor="#daf2e3"><a href="<? echo $friday[0]."/".$html_default; ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"><!--//<img src="<? echo $friday[0]."/".$coverpage ?>"  alt="á¤µµÒÅçÍ¤ Friday # 1"  width="175" height="203" border="0"   /></a>//--><a href="<? echo $faris[0]."/".$html_default ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"></a><a href="<? echo $mistine[0]."/".$html_default ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"></a></td>
          <td colspan="2" align="center"  bgcolor="#daf2e3"><a href="<? echo $faris[1]."/".$html_default ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"></a><a href="<? echo $mistine[1]."/".$html_default ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"></a></td>
          <td colspan="2" align="center"  bgcolor="#daf2e3"><a href="<? echo $faris[2]."/".$html_default  ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"></a><a href="#">catalogue_link.php</a><a href="<? echo $mistine[2]."/".$html_default ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 1100,height:800})"></a></td>
        </tr>
        <tr>
          <td colspan="5"><img src="image_icon/u_catalogue.gif" width="864" height="10" /></td>
        </tr>
        <tr>
          <td colspan="5">&nbsp;</td>
        </tr>
      </table>
      <p><br />
    
    
<!-- Start  Content  -->    
    </p></td>
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