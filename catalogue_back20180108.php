<?php
session_start(); 
require_once('check_login.php');
require_once('include/i_config.php'); 
require_once('Connections/bwc_orders.php'); 

$url_page="catalogue_page.php";
$coverpage ="coverpage.jpg";
$html_default ="default.html";

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
          <td height="18" colspan="3" align="center" bgcolor="#FFDFEF">
<?php 
mysql_select_db($database_bwc_orders, $bwc_orders);
mysql_query("SET NAMES 'utf8'");

// View Catalogue by  District Login

$wrkDate="";
$dist= $_SESSION['dist'];

include("i_MailPlan_by_date.php");
/*
// ***this out from i_mailPlan.php ***

echo " 	WrkDate : $wrkDate <br>
			District :	$dist <br>
			current : $currentCamp <br>
			next :$nextCamp <br>
			last :$lastCamp <br>
			Bill Date : $bill_date  <br>
			Ship Date :$ship_date  <br>
			Dlv Date :$dlv_date  <br>
			Dwn date : $dwn_date <br>";

*/

///###############################################3
// Show Mistine Catalogue
///###############################################3

$query_mistine ="select * from catalogue where  Status ='Publish'  and brand ='1'  and media in ('01','02') and camp in ($lastCamp,$currentCamp,$nextCamp) order by camp ";
$website_mistine = mysql_query($query_mistine, $bwc_orders) or die(mysql_error());


?>
		<div id="Catalogue_Mistine" class="imageflow">
  				<?php 	 while ($row_mistine=mysql_fetch_assoc($website_mistine)) { 	
				//echo $row_mistine['URL']."/". $coverpage ;
				  // $script_link="cate=".$row_mistine['BRAND']."&type=".$row_mistine['TYPE']."&camp=".$row_mistine['CAMP'];
				   $script_link="id=".$row_mistine['ID'] ;
				?>
                
			  <IMG src="<?php echo $row_mistine['URL']."/". $coverpage ?>" 
              	longdesc="<?php  echo $url_page."?$script_link" ?>" 
                width="175" height="219" 
                alt="<? echo "<font color = #ec008c>" . $row_mistine['TITLE'];?>" />
	            <?php  }?>
		
		</div>     
                          
          
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
          <td colspan="3" align="center" bgcolor="#FFDFEF">
<?php 
///###############################################3
// Show Faris Catalogue
///###############################################3
mysql_select_db($database_bwc_orders, $bwc_orders);
//$query_faris ="select * from catalogue where  Status ='Publish'  and brand ='3'  and type <> 'plus plan'  and camp in ($lastCamp,$currentCamp,$nextCamp)  order by camp";
$query_faris="select * from catalogue where  Status ='Publish'  and brand ='3'  and media in ('01','02') and camp in ($lastCamp,$currentCamp,$nextCamp) order by camp ";
$website_faris = mysql_query($query_faris, $bwc_orders) or die(mysql_error());
//$row_mistine = mysql_fetch_assoc($website_mistine);

?>
		<div id="Catalogue_Faris" class="imageflow">
  				<?php 	 while ($row_faris=mysql_fetch_assoc($website_faris)) { 	
				//echo $row_mistine['URL']."/". $coverpage ;
				  //$script_link="cate=".$row_faris['BRAND']."&type=".$row_faris['TYPE']."&camp=".$row_faris['CAMP'];
				  $script_link="id=".$row_faris['ID'];
				?>
                
			  <img src="<?php echo $row_faris['URL']."/". $coverpage ?>" 
              	longdesc="<?php  echo $url_page."?$script_link" ?>" 
                width="175" height="219" 
                alt="<?php  echo "<font color = #007236>" . $row_faris['TITLE'];?>" />
	            <?php  }?>
		
		</div>     
                          
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
          <td colspan="5" align="center" bgcolor="#FFDFEF">
            
<?php 
///###############################################3
// Show Friday Catalogue
///###############################################3
mysql_select_db($database_bwc_orders, $bwc_orders);
//$query_friday ="select * from catalogue where  Status ='Publish'  and brand ='2' and type <> 'plus plan' and camp in ($currentCamp,$nextCamp)  order by  camp 
//ASC,TYPE DESC";
$query_friday="select * from catalogue where  Status ='Publish'  and brand ='2' and media in ('01','02','26','06')  and camp in ($currentCamp,$nextCamp) order by camp ";
$website_friday = mysql_query($query_friday, $bwc_orders) or die(mysql_error());
//echo $query_friday;
//$row_mistine = mysql_fetch_assoc($website_mistine);

?>
		<div id="Catalogue_Friday" class="imageflow">
  				<?php 	 while ($row_friday=mysql_fetch_assoc($website_friday)) { 	
				//echo $row_mistine['URL']."/". $coverpage ;
				  //$script_link="cate=".$row_friday['BRAND']."&type=".$row_friday['TYPE']."&camp=".$row_friday['CAMP'];
				  $script_link="id=".$row_friday['ID']; 
				?>
                
			  <img src="<?php echo $row_friday['URL']."/". $coverpage ?>" 
              	longdesc="<?php echo $url_page."?$script_link"  ?>" 
                width="175" height="219" 
                alt="<?php  echo "<font color = #055f9f>" .  $row_friday['TITLE'];?>" 
             
                />
	            <?php  }?>
		
		</div>     


          </td>
        </tr>
        <tr>
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