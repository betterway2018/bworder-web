<?php
session_start(); 
require_once('check_login.php');
require_once('include/i_config.php'); 
require_once('Connections/bwc_orders.php'); 
require_once("i_MailPlan_by_date.php");
$url_page="catalogue_page.php";
$coverpage ="coverpage.jpg";
$html_default ="default.html";
//$lastCamp,$currentCamp,$nextCamp

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title; ?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="ImageFlow_130/imageflow.css" type="text/css" />
<script type="text/javascript" src="ImageFlow_130/imageflow.js"></script>
</head>

<body>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0" >
  <?php require_once('include/i_header_border.php'); ?>
  <?php require_once('include/i_header.php'); ?>
  <tr>
    <td height="339" align="left" valign="top" class="Sheet_Boder" style="padding:2px">
      <!-- This is all the XHTML ImageFlow needs -->
      
     
      <table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="3"><img src="image_icon/11h_catalogue_mistine.gif" width="864" height="40" /></td>
        </tr>
        <tr>
		    <td height="18" align="center" bgcolor="#FFDFEF">
  			<a href="https://www.mistine.co.th/th/catalogue/catalogueview.php?camp=<?php echo $lastCamp?>" target="_blank">
            		  <IMG src="http://www.mistine.co.th/Catalogue/Mistine/Mistine_<?php echo $lastCamp?>/coverpage.jpg" 
                width="175" height="219" 
                />  </a>    
          </td>
          <td height="18" align="center" bgcolor="#FFDFEF">
  			<a href="https://www.mistine.co.th/th/catalogue/catalogueview.php?camp=<?php echo $currentCamp?>" target="_blank">
            		  <IMG src="http://www.mistine.co.th/Catalogue/Mistine/Mistine_<?php echo $currentCamp?>/coverpage.jpg" 
              	" 
                width="175" height="219" 
                />  </a>    
          </td>
		        <td height="18" align="center" bgcolor="#FFDFEF">
  			<a href="https://www.mistine.co.th/th/catalogue/catalogueview.php?camp=<?php echo $nextCamp?>" target="_blank">
            		  <IMG src="http://www.mistine.co.th/Catalogue/Mistine/Mistine_<?php echo $nextCamp?>/coverpage.jpg" 
              	" 
                width="175" height="219" 
                />  </a>    
          </td>
        </tr>
        <tr>
          <td colspan="3"><img src="image_icon/u_catalogue.gif" width="864" height="10" /></td>
        </tr>
      </table>
      <br />
      <table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="3"><img src="image_icon/11h_catalogue_faris.gif" width="864" height="40" /></td>
        </tr>
              <tr>
		    <td height="18" align="center" bgcolor="#FFDFEF">
  			<a href="http://www.faris.co.th/catalogue.php?c=<?php echo $lastCamp?>" target="_blank">
            		  <IMG src="http://www.faris.co.th/Catalogue/Faris/Faris_<?php echo $lastCamp?>/coverpage.jpg" 
                width="175" height="219" 
                />  </a>    
          </td>
          <td height="18" align="center" bgcolor="#FFDFEF">
  			<a href="http://www.faris.co.th/catalogue.php?c=<?php echo $currentCamp?>" target="_blank">
            		  <IMG src="http://www.faris.co.th/Catalogue/Faris/Faris_<?php echo $currentCamp?>/coverpage.jpg" 
              	" 
                width="175" height="219" 
                />  </a>    
          </td>
		        <td height="18" align="center" bgcolor="#FFDFEF">
  			<a href="http://www.faris.co.th/catalogue.php?c=<?php echo $nextCamp?>" target="_blank">
            		  <IMG src="http://www.faris.co.th/Catalogue/Faris/Faris_<?php echo $nextCamp?>/coverpage.jpg" 
              	" 
                width="175" height="219" 
                />  </a>    
          </td>
        </tr>
        <tr>
          <td colspan="3"><img src="image_icon/u_catalogue.gif" width="864" height="10" /></td>
        </tr>
      </table>
      <br />
      <table width="864" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="5"><img src="image_icon/11h_catalogue_friday.gif" width="864" height="40" /></td>
        </tr>
              <tr>
		    <td height="18" align="center" bgcolor="#FFDFEF">
  			<a href="http://www.friday.co.th/catalogueview.php?s=front&camp=<?php echo $lastCamp?>" target="_blank">
            		  <IMG src="http://www.friday.co.th/catalogue/Fridayfront/Fridaya_<?php echo $lastCamp?>/coverpage.jpg" 
                width="175" height="219" 
                />  </a>    
          </td>
          <td height="18" align="center" bgcolor="#FFDFEF">
  			<a href="http://www.friday.co.th/catalogueview.php?s=front&camp=<?php echo $lastCamp?>" target="_blank">
            		  <IMG src="http://www.friday.co.th/catalogue/Fridayfront/Fridaya_<?php echo $currentCamp?>/coverpage.jpg" 
              	" 
                width="175" height="219" 
                />  </a>    
          </td>
		    <td height="18" align="center" bgcolor="#FFDFEF">
  			<a href="http://www.friday.co.th/catalogueview.php?s=front&camp=<?php echo $nextCamp?>" target="_blank">
            		  <IMG src="http://www.friday.co.th/catalogue/Fridayfront/Fridaya_<?php echo $nextCamp?>/coverpage.jpg" 
              	" 
                width="175" height="219" 
                />  </a>    
          </td>
        </tr>
          <td colspan="5"><img src="image_icon/u_catalogue.gif" width="864" height="10" /></td>
        </tr>
        <tr>
          <td colspan="5">&nbsp;</td>
        </tr>
      </table>
</td>
  </tr>
  <?php require_once('include/i_footer_border.php'); ?>
</table>
<?php require_once('include/i_footer.php'); ?>
</body>
</html>