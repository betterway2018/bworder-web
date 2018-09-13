<?php  session_start(); ?>
<?php
require("i_config.php"); 
include("check_login.php");
?>
<?php require_once('Connections/bwc_content.php'); ?>


<?php
mysql_select_db($database_bwc_content,$bwc_content);
$query="Select * From content_data  Where group_id=4  and status = 0 Order by  id desc";
$content_data = mysql_query($query, $bwc_content) or die(mysql_error());
$row_content_data = mysql_fetch_assoc($content_data);
$totalRows_content_data = mysql_num_rows($content_data);


if (isset($_GET['id']) && $_GET['id'] !="") {
		mysql_select_db($database_bwc_content, $bwc_content);
		$query_content_data = "SELECT * FROM content_data WHERE group_id=4 and  id=".$_GET['id'];
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
		$query_content_data = "SELECT * FROM content_data WHERE  group_id =4  and is_default ='Y'";
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
<title><?php  echo $title?></title>
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
    
      <br />
      <br />
      <!-- Start  Content  -->    
    <table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td></td>
  </tr>
  <tr>
    <td bgcolor="#FDB5CF"></td>
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
            <td width="17%"><img src="table_smooth/demo_friday.png" width="300" height="78" /></td>
            <td width="83%" align="center"><font size="3"><?php  echo $subject?></font></td>
            </tr>
          </table>
          <p><?php echo $detail;?>
            </p></td>
        <td align="right" valign="top" style="background-image:url( table_smooth/a2-2.gif); background-repeat:repeat-y"><img src="table_smooth/a2-2.gif" width="11" height="11"  /></td>
        </tr>
      <tr>
        <td align="left" valign="top" style="background-image:url( table_smooth/a3-2.gif); background-repeat:repeat-y"><img src="table_smooth/a3-2.gif" width="11" height="60" /></td>
        <td align="left" valign="top"  >โดย :
          <?php   echo $post_by;?>
          <br />
          <!--substr() ใช้ดึงบางส่วนของสตริงมาจากสตริง-->
          เมื่อวันที่  :
  <?php  echo substr($post_date,6,2)."/".substr($post_date,4,2)."/".substr($post_date,0,4)."  ". $post_time;?>
  <br />
          </td>
        <td align="right" valign="top" style="background-image:url( table_smooth/a2-2.gif); background-repeat:repeat-y"><img src="table_smooth/a2-2.gif" width="11" height="60"  /></td>
        </tr>
      <tr>
        <td><img src="table_smooth/a4.gif" width="11" height="11" /></td>
        <td  style="background-image:url(table_smooth/a2-1.gif); background-repeat:repeat-x"><img src="table_smooth/a2-1.gif" width="850" height="11"  /></td>
        <td><img src="table_smooth/a2.gif" width="11" height="11" /></td>
        </tr>
    </table>
    <table width="872" border="0" cellspacing="0" cellpadding="4">
      <tr>
        <td colspan="2" align="left">&nbsp;ใบปลิวหน้าอื่น จาก ฟรายเดย์</td>
        </tr>
      <tr>
        <td width="12" align="left">&nbsp;&nbsp;</td>
        <td width="844" align="left">
<?php 
	$i=1;
	do {
?>        
         <li><a href="news_vfrdemo.php?id=<?php echo $row_content_data['ID'];?>" target="_parent"><?php echo $row_content_data['SUBJECT'];?></a></li> 
<?php 
	$i++;
	}while ($row_content_data = mysql_fetch_assoc($content_data));
?>          
        </td>
      </tr>
    </table></td>
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
<br /><?php require "i_footer.php";?></td>
  </tr>
</table>
</body>
</html>
<?php
mysql_free_result($content_data);
?>
