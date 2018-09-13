<?php  session_start(); ?>
<?php require("i_config.php"); ?>
<?php require("check_login.php"); ?>
<?php require_once('Connections/bwc_orders.php'); ?>

<?php
$url_page="catalogue_page.php";
$coverpage ="coverpage.jpg";
$html_default ="default.html";
$img_path="ImageFlow_130/img/";


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><?php  echo $title?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="ImageFlow_130/imageflow.css" type="text/css" />
<script type="text/javascript" src="ImageFlow_130/imageflow.js"></script>
      
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
    <td height="339" align="left" valign="top" class="Sheet_Boder" style="padding:2px">
      <!-- This is all the XHTML ImageFlow needs -->
      
     
      <table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="3"><img src="image_icon/1h_catalogue_mistine.gif" width="864" height="40" /></td>
        </tr>
        <tr>
          <td height="18" colspan="3" align="center" bgcolor="#daf2e3">
<?php 
mysql_select_db($database_bwc_orders, $bwc_orders);
$query_mistine ="select * from catalogue where  Status ='Publish'  and brand ='1' order by camp";
$website_mistine = mysql_query($query_mistine, $bwc_orders) or die(mysql_error());
//$row_mistine = mysql_fetch_assoc($website_mistine);

?>
		<div id="Catalogue_Mistine" class="imageflow">
  				<?php 	 while ($row_mistine=mysql_fetch_assoc($website_mistine)) { 	
				//echo $row_mistine['URL']."/". $coverpage ;
				   $script_link="cate=".$row_mistine['BRAND']."&type=".$row_mistine['TYPE']."&camp=".$row_mistine['CAMP'];
				?>
                
			  <img src="<?php echo $row_mistine['URL']."/". $coverpage ?>" 
              	longdesc="<?  echo $url_page."?$script_link" ?>" 
                width="175" height="219" 
                alt="<?  echo $row_mistine['TITLE'];?>" />
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
          <td colspan="3"><img src="image_icon/1h_catalogue_faris.gif" width="864" height="40" /></td>
        </tr>
        <tr>
          <td colspan="3" align="center" bgcolor="#daf2e3">
<?php 
mysql_select_db($database_bwc_orders, $bwc_orders);
$query_faris ="select * from catalogue where  Status ='Publish'  and brand ='3' order by camp";
$website_faris = mysql_query($query_faris, $bwc_orders) or die(mysql_error());
//$row_mistine = mysql_fetch_assoc($website_mistine);

?>
		<div id="Catalogue_Faris" class="imageflow">
  				<?php 	 while ($row_faris=mysql_fetch_assoc($website_faris)) { 	
				//echo $row_mistine['URL']."/". $coverpage ;
				  $script_link="cate=".$row_faris['BRAND']."&type=".$row_faris['TYPE']."&camp=".$row_faris['CAMP'];
				?>
                
			  <img src="<?php echo $row_faris['URL']."/". $coverpage ?>" 
              	longdesc="<?  echo $url_page."?$script_link" ?>" 
                width="175" height="219" 
                alt="<?  echo $row_faris['TITLE'];?>" />
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
          <td colspan="5"><img src="image_icon/1h_catalogue_friday.gif" width="864" height="40" /></td>
        </tr>
        <tr>
          <td colspan="5" align="center" bgcolor="#daf2e3">
            
<?php 
mysql_select_db($database_bwc_orders, $bwc_orders);
$query_friday ="select * from catalogue where  Status ='Publish'  and brand ='2' order by TYPE,camp";
$website_friday = mysql_query($query_friday, $bwc_orders) or die(mysql_error());
//$row_mistine = mysql_fetch_assoc($website_mistine);

?>
		<div id="Catalogue_Friday" class="imageflow">
  				<?php 	 while ($row_friday=mysql_fetch_assoc($website_friday)) { 	
				//echo $row_mistine['URL']."/". $coverpage ;
				  $script_link="cate=".$row_friday['BRAND']."&type=".$row_friday['TYPE']."&camp=".$row_friday['CAMP'];
				?>
                
			  <img src="<?php echo $row_friday['URL']."/". $coverpage ?>" 
              	longdesc="<? echo $url_page."?$script_link"  ?>" 
                width="175" height="219" 
                alt="<?  echo $row_friday['TITLE'];?>" 
             
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