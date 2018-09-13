<?php 
session_start(); 
require_once('check_login.php');
require_once('include/i_config.php'); 
require_once('Connections/bwc_orders.php'); 

$url_page="plusplan_page.php";
$coverpage ="coverpage.jpg";
$html_default ="default.html";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title ?></title>
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
		  <td colspan="3"><img src="image_icon/2h_catalogue_mistine.gif" width="864" height="40" /></td>
		</tr>
		<tr bgcolor="#FFDFF4">
		  <!--<td height="18" colspan="3" align="center"><iframe height="130px" width="850px" src="vmtdemo_preview.php" scrolling="No" frameborder="0"></iframe></td>-->
		</tr>
		<tr bgcolor="#FFDFF3">
		  <td height="18" colspan="3" align="center">&nbsp;</td>
		</tr>
		<tr bgcolor="#FFDFF3">
		  <td height="18" colspan="3" align="center" bgcolor="#FFDFF3">
<?php 
			mysql_select_db($database_bwc_orders, $bwc_orders);
			mysql_query("SET NAMES 'utf8'");

			// View Catalogue by  District Login

			$wrkDate="";
			$dist= $_SESSION['dist'];

			include("i_MailPlan_by_date.php");

			///###############################################3
			// Show Mistine Catalogue
			///###############################################3

			$query_mistine ="select * from catalogue where  Status ='Publish'  and brand ='1' and media in ('12','21') and camp in ($lastCamp,$currentCamp,$nextCamp) order by camp";
			$website_mistine = mysql_query($query_mistine, $bwc_orders) or die(mysql_error());
			//echo $query_mistine;
			$script_link_lastCamp="cate=1&type=12&camp=".$lastCamp."&id=000";
			$script_link_currentCamp="cate=1&type=12&camp=".$currentCamp."&id=000";
			$script_link_nextCamp="cate=1&type=12&camp=".$nextCamp."&id=000";
?>
			<div id="Catalogue_Mistine" class="imageflow">
				<img src="Cat_Plusplan_page/images/1/media12_<?php echo $lastCamp?>/media12Mistine<?php echo $lastCamp?>_001.jpg" 
              	longdesc="<?php echo $url_page."?$script_link_lastCamp"  ?>" 
                width="175" height="219" 
                alt="<?php  echo "<font color = #055f9f>" . $row_friday['TITLE']; ?>" />
					 <img src="Cat_Plusplan_page/images/1/media12_<?php echo $currentCamp?>/media12Mistine<?php echo $currentCamp?>_001.jpg" 
              	longdesc="<?php echo $url_page."?$script_link_currentCamp"  ?>" 
                width="175" height="219" 
                alt="<?php  echo "<font color = #055f9f>" . $row_friday['TITLE']; ?>" />
					 <img src="Cat_Plusplan_page/images/1/media12_<?php echo $nextCamp?>/media12Mistine<?php echo $nextCamp?>_001.jpg" 
              	longdesc="<?php echo $url_page."?$script_link_nextCamp"  ?>" 
                width="175" height="219" 
                alt="<?php  echo "<font color = #055f9f>" . $row_friday['TITLE']; ?>" />
			</div>    
		  </td>
		</tr>
		<tr>
          <td colspan="3"><img src="image_icon/uu_catalogue.gif" width="864" height="10" /></td>
		</tr>
	  </table>
	  <br />
	  <table width="0" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
		  <td colspan="3"><img src="image_icon/2h_catalogue_faris.gif" width="864" height="40" /></td>
		</tr>
		<tr bgcolor="#FFDFF3">
		  <td colspan="3" align="center"><!--<iframe height="130px" width="850px" src="vfarisdemo_preview.php" scrolling="no" frameborder="0"></iframe>--></td>
		</tr>
		<tr>
		  <td colspan="3" align="center" bgcolor="#FFDFF3">&nbsp;</td>
		</tr>
		<tr>
		  <td colspan="3" align="center" bgcolor="#FFDFF3">
<?php 
			///###############################################3
			// Show Faris Catalogue
			///###############################################3
			/*mysql_select_db($database_bwc_orders, $bwc_orders);
			$query_faris ="select * from catalogue where  Status ='Publish'  and brand ='3' and media in ('12','21') and camp in ($lastCamp,$currentCamp,$nextCamp)  order by camp";
			$website_faris = mysql_query($query_faris, $bwc_orders) or die(mysql_error());
			//$row_mistine = mysql_fetch_assoc($website_mistine);
			*/
			
$script_link_lastCamp="cate=3&type=12&camp=".$lastCamp."&id=000";
$script_link_currentCamp="cate=3&type=12&camp=".$currentCamp."&id=000";
$script_link_nextCamp="cate=3&type=12&camp=".$nextCamp."&id=000";
?>
			 <div id="Catalogue_Faris" class="imageflow" >
			 <img src="Cat_Plusplan_page/images/3/media12_<?php echo $lastCamp?>/media12faris<?php echo $lastCamp?>_001.jpg" 
              	longdesc="<?php echo $url_page."?$script_link_lastCamp"  ?>" 
                width="175" height="219" 
                alt="<?php  echo "<font color = #055f9f>" . $row_friday['TITLE']; ?>" />
					 <img src="Cat_Plusplan_page/images/3/media12_<?php echo $currentCamp?>/media12faris<?php echo $currentCamp?>_001.jpg" 
              	longdesc="<?php echo $url_page."?$script_link_currentCamp"  ?>" 
                width="175" height="219" 
                alt="<?php  echo "<font color = #055f9f>" . $row_friday['TITLE']; ?>" />
					 <img src="Cat_Plusplan_page/images/3/media12_<?php echo $nextCamp?>/media12faris<?php echo $nextCamp?>_001.jpg" 
              	longdesc="<?php echo $url_page."?$script_link_nextCamp"  ?>" 
                width="175" height="219" 
                alt="<?php  echo "<font color = #055f9f>" . $row_friday['TITLE']; ?>" />
				</div>    
		  </td>
		</tr>
		<tr>
		  <td colspan="3"><img src="image_icon/uu_catalogue.gif" width="864" height="10" /></td>
		</tr>
	  </table>
	  <br />
	  <table width="864" border="0" align="center" cellpadding="0" cellspacing="0">
		<tr>
		  <td colspan="5"><img src="image_icon/2h_catalogue_friday.gif" width="864" height="40" /></td>
		</tr>
		<tr>
		  <td colspan="5" align="left" bgcolor="#FFF2FA"></td>
		</tr>
		<tr bgcolor="#FFDFF3">
		  <td colspan="5" align="center">
			<!--<iframe height="130px" width="850px" src="vfrdemo_preview.php" scrolling="no" frameborder="0"></iframe>-->
		  </td>
		</tr>
		<tr>
		  <td colspan="5" align="center" bgcolor="#FFDFF3">&nbsp;</td>
		</tr>
		<tr>
          <td colspan="5" align="center" bgcolor="#FFDFF4">
<?php 
			///###############################################3
			// Show Friday Catalogue
			///###############################################3
			/*mysql_select_db($database_bwc_orders, $bwc_orders);
			$query_friday ="select * from catalogue where  Status ='Publish'  and brand ='2' and media in ('06','11','21','27','28') and camp in ($currentCamp,$nextCamp)  order by  camp ASC,TYPE DESC";
			$website_friday = mysql_query($query_friday, $bwc_orders) or die(mysql_error());
			//echo $query_friday;
			//$row_mistine = mysql_fetch_assoc($website_mistine);
			<div id="Catalogue_Friday" class="imageflow" >
  				<?php while ($row_friday=mysql_fetch_assoc($website_friday)) { 	
					//echo $row_mistine['URL']."/". $coverpage ;
					$script_link="cate=".$row_friday['BRAND']."&type=".$row_friday['TYPE']."&camp=".$row_friday['CAMP']. "&id=".$row_friday['ID'];
				?>
              
			  <img src="<?php echo $row_friday['URL']."/". $coverpage ?>" 
              	longdesc="<?php echo $url_page."?$script_link"  ?>" 
                width="175" height="219" 
                alt="<?php  echo "<font color = #055f9f>" . $row_friday['TITLE']; ?>" />
	            <?php } ?>
			</div>     
*/
$script_link_lastCamp="cate=2&type=26&camp=".$lastCamp."&id=000";
$script_link_currentCamp="cate=2&type=26&camp=".$currentCamp."&id=000";
$script_link_nextCamp="cate=2&type=26&camp=".$nextCamp."&id=000";
?>
            <div id="Catalogue_Friday" class="imageflow" >
			 <img src="Cat_Plusplan_page/images/2/media26_<?php echo $lastCamp?>/Media26friday<?php echo $lastCamp?>_001.jpg" 
              	longdesc="<?php echo $url_page."?$script_link_lastCamp"  ?>" 
                width="175" height="219" 
                alt="<?php  echo "<font color = #055f9f>" . $row_friday['TITLE']; ?>" />
					 <img src="Cat_Plusplan_page/images/2/media26_<?php echo $currentCamp?>/Media26friday<?php echo $currentCamp?>_001.jpg" 
              	longdesc="<?php echo $url_page."?$script_link_currentCamp"  ?>" 
                width="175" height="219" 
                alt="<?php  echo "<font color = #055f9f>" . $row_friday['TITLE']; ?>" />
					 <img src="Cat_Plusplan_page/images/2/media26_<?php echo $nextCamp?>/Media26friday<?php echo $nextCamp?>_001.jpg" 
              	longdesc="<?php echo $url_page."?$script_link_nextCamp"  ?>" 
                width="175" height="219" 
                alt="<?php  echo "<font color = #055f9f>" . $row_friday['TITLE']; ?>" />
				</div>    
		  </td>
		  
		</tr>
		<tr>
		  <td colspan="5"><img src="image_icon/uu_catalogue.gif" width="864" height="10" /></td>
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