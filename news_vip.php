<?php 
session_start(); 
//require_once('check_login.php');
require_once('include/i_config.php'); 
require_once('Connections/bwc_content.php');

mysql_select_db($database_bwc_content,$bwc_content);
mysql_query("SET NAMES 'utf8'");
$query="Select * From content_data  Where group_id=1  and status = 0 Order by  id asc";
$content_data = mysql_query($query, $bwc_content) or die(mysql_error());
$row_content_data = mysql_fetch_assoc($content_data);
$totalRows_content_data = mysql_num_rows($content_data);

if (isset($_GET['id']) && $_GET['id'] !="") {
		mysql_select_db($database_bwc_content, $bwc_content);
		$query_content_data = "SELECT * FROM content_data WHERE group_id=1 and  id=".$_GET['id'];
		$content_default = mysql_query($query_content_data, $bwc_content) or die(mysql_error());
		$row_content_default = mysql_fetch_assoc($content_default);
		$totalRows_content_default = mysql_num_rows($content_default);
		if ($totalRows_content_default==0) {
			$subject = $row_content_data['SUBJECT'];
			$detail = $row_content_data['DETAIL'];
			$post_date = $row_content_data['POST_DATE'];
			$post_time=$row_content_data['POST_TIME'];
			$post_by=$row_content_data['POST_BY'];
		}
		else {
			$subject = $row_content_default['SUBJECT'];
			$detail = $row_content_default['DETAIL'];
			$post_date = $row_content_default['POST_DATE'];
			$post_time=$row_content_default['POST_TIME'];
			$post_by=$row_content_data['POST_BY'];
			
		}		
}
else {
		mysql_select_db($database_bwc_content, $bwc_content);
		$query_content_data = "SELECT * FROM content_data WHERE  group_id =1  and is_default ='Y'";
		$content_default = mysql_query($query_content_data, $bwc_content) or die(mysql_error());
		$row_content_default = mysql_fetch_assoc($content_default);
		$totalRows_content_default = mysql_num_rows($content_default);
		if ($totalRows_content_default==0) {
			$subject = $row_content_data['SUBJECT'];
			$detail = $row_content_data['DETAIL'];
			$post_date = $row_content_data['POST_DATE'];
			$post_time=$row_content_data['POST_TIME'];
			$post_by=$row_content_data['POST_BY'];
		}
		else {
			$subject = $row_content_default['SUBJECT'];
			$detail = $row_content_default['DETAIL'];
			$post_date = $row_content_default['POST_DATE'];
			$post_time=$row_content_default['POST_TIME'];
			$post_by=$row_content_data['POST_BY'];
			
		}

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><?php echo $title; ?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="wysiwyg/ckeditor/ckeditor.js"></script>
<script src="wysiwyg/ckeditor/_samples/sample.js" type="text/javascript"></script>
<link href="wysiwyg/ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)	
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>
</head>



<?php 

//$detail = str_replace("คลิกรายละเอียด", '<img src="images/new.png"  height="25">', $detail);
//$detail = str_replace("คลิกที่นี้", '<img src="images/new.png"  height="25">', $detail);


if($_GET["id"] == ""){
	
	$query="Select * From content_data  Where group_id=1  and status = 0 Order by  SEQ_NO asc";
$content_data = mysql_query($query, $bwc_content) or die(mysql_error());
$i=1;
 $detail2 ="";
while($objResult = mysql_fetch_array($content_data))

{
 $detail2 =  $detail2.'<p> <span style="margin-left: 40px"><font size="4"><font color="#2f4f4f"><b>'.$i.'. '.$objResult["SUBJECT"].' </b></font></font><b><a  target="_blank" href="/news_vip.php?id='.$objResult[0].'"><font size="+0"><img src="images/new.png" height="25"></font></a></b> </span></p>
';
$i++;

}
  $detail = $detail2;	
}
?>
<body>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0" >
  <?php require_once('include/i_header_border.php'); ?>
  <?php require_once('include/i_header.php'); ?>
  <tr>
    <td height="480" align="left" valign="top" class="Sheet_Boder" style="padding:2px">
      <!-- Start  Content  -->    
    <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr valign="top">
    <td></td>
  </tr>
  <tr>
    <td ></td>
  </tr>
  <tr>
    <td align="center" valign="top" bgcolor="#FFFFFF" style="padding:3px;height:300px"><table width="783" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td><img src="table_smooth/a3.gif" alt="" width="11" height="11" /></td>
        <td style="background-image:url( table_smooth/a3-1.gif); background-repeat:repeat-x"><img src="table_smooth/a3-1.gif" width="850" height="11"   /></td>
        <td><img src="table_smooth/a1.gif" width="11" height="11" /></td>
        </tr>
      <tr>
        <td height="250" align="left" valign="top" style="background-image:url( table_smooth/a3-2.gif); background-repeat:repeat-y"><img src="table_smooth/a3-2.gif" width="11" height="250" /></td>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><!--<img src="table_smooth/demo_news.png" />--><font size="3" color="#6633CC"><?php  echo $subject?></font></td>
            </tr>
          </table>
          <?php echo $detail;?></td>
        <td align="right" valign="top" style="background-image:url( table_smooth/a2-2.gif); background-repeat:repeat-y"><img src="table_smooth/a2-2.gif" width="11" height="11"  /></td>
        </tr>
      <tr>
        <td align="left" valign="top" style="background-image:url( table_smooth/a3-2.gif); background-repeat:repeat-y"><img src="table_smooth/a3-2.gif" width="11" height="20" /></td>
        <td align="left" valign="top"  ><font size="2" color="#FF99CC">โดย :
          <?php  echo $post_by;?>
          เมื่อวันที่  :
  <?php  echo substr($post_date,6,2)."/".substr($post_date,4,2)."/".substr($post_date,0,4)."  ". $post_time;?></font>
  <br />
          </td>
        <td align="right" valign="top" style="background-image:url( table_smooth/a2-2.gif); background-repeat:repeat-y"><img src="table_smooth/a2-2.gif" width="11" height="20"  /></td>
        </tr>
      <tr>
        <td><img src="table_smooth/a4.gif" width="11" height="11" /></td>
        <td  style="background-image:url(table_smooth/a2-1.gif); background-repeat:repeat-x"><img src="table_smooth/a2-1.gif" width="850" height="11"  /></td>
        <td><img src="table_smooth/a2.gif" width="11" height="11" /></td>
        </tr>
    </table>
	
	<?php if($_GET["id"] == 130 ){ ?>
	<BR>
	<img src="images/re1.png" >
	<BR>
	<?php  } ?>
    <table width="872" border="0" cellspacing="0" cellpadding="4">
           <tr>
        <td width="12" align="left">&nbsp;&nbsp;</td>
        <td width="844" align="left" style="font-size:18px; font-family:Tahoma, Geneva, sans-serif;">
<?php 
	$i=1;
	do {
?>        
        <!-- <li><a href="news_vip.php?id=<?php echo $row_content_data['ID'];?>" target="_parent"><?php echo $row_content_data['SUBJECT'];?></a></li> -->
<?php 
	$i++;
	}while ($row_content_data = mysql_fetch_assoc($content_data));
?>          
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td></td>
  </tr>
</table>
    
    
    </td>
  </tr>
  <?php require_once('include/i_footer_border.php'); ?>
</table>
<?php require_once('include/i_footer.php'); ?>
</body>
</html>
<?php

//echo 'Current PHP version: ' . phpversion();


mysql_free_result($content_data);
?>
