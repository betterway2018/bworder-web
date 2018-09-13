<?php  session_start(); ?>
<?php
require("i_config.php"); 

?>
<?php require_once('Connections/bwc_content.php'); ?>

<?php
$query="Select * From content_data  Where group_id=5 Order by  id desc";
$content_data = mysql_query($query, $bwc_content) or die(mysql_error());
$row_content_data = mysql_fetch_assoc($content_data);
$totalRows_content_data = mysql_num_rows($content_data);

//echo "opopo".$totalRows_content_data ."popop" . $query;
//exit;

if (isset($_GET['id']) && $_GET['id'] !="") {
		mysql_select_db($database_bwc_content, $bwc_content);
		$query_content_data = "SELECT * FROM content_data WHERE group_id=5 and  id=".$_GET['id'];
		$content_default = mysql_query($query_content_data, $bwc_content) or die(mysql_error());
		$row_content_default = mysql_fetch_assoc($content_default);
		$totalRows_content_default = mysql_num_rows($content_default);
		
		//echo ('1...');
		if ($totalRows_content_default==0) {
			
		//echo ('1'.$row_content_data['SUBJECT'].'1...');
			$subject = $row_content_data['SUBJECT'];
			$detail = $row_content_data['DETAIL'];
			$post_date = $row_content_data['POST_DATE'];
			$post_time=$row_content_data['POST_TIME'];
			$post_by=$row_content_data['POST_BY'];
		}
		else {
		//echo ('12...');
		
			$subject = $row_content_default['SUBJECT'];
			$detail = $row_content_default['DETAIL'];
			$post_date = $row_content_default['POST_DATE'];
			$post_time=$row_content_default['POST_TIME'];
			$post_by=$row_content_data['POST_BY'];
			
		}		
}
else {
		mysql_select_db($database_bwc_content, $bwc_content);
		$query_content_data = "SELECT * FROM content_data WHERE  group_id =5 and is_default ='Y'";
		$content_default = mysql_query($query_content_data, $bwc_content) or die(mysql_error());
		$row_content_default = mysql_fetch_assoc($content_default);
		$totalRows_content_default = mysql_num_rows($content_default);
		//echo ('2...');
		if ($totalRows_content_default==0) {
		//echo ('21...');
			$subject = $row_content_data['SUBJECT'];
			$detail = $row_content_data['DETAIL'];
			$post_date = $row_content_data['POST_DATE'];
			$post_time=$row_content_data['POST_TIME'];
			$post_by=$row_content_data['POST_BY'];
		}
		else {
		//echo ('22...');
			$subject = $row_content_default['SUBJECT'];
			$detail = $row_content_default['DETAIL'];
			$post_date = $row_content_default['POST_DATE'];
			$post_time=$row_content_default['POST_TIME'];
			$post_by=$row_content_data['POST_BY'];
			
		}

}

//echo "opopopopop" . $query_content_data;
//exit;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Preview News</title>
<link href="Styles/main.css" rel="stylesheet" type="text/css" /></head>

<body>
<table width="783" border="0" cellpadding="0" cellspacing="0">

  <tr>
    <td height="200" align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="100%"><?php echo $detail;?></td>
        </tr>
      <tr>
        <td><?php  echo $subject?></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="left" valign="top"  ><hr />
      <span class="text">โดย :
        <?php   echo $post_by?>
        เมื่อวันที่  :
        <?php  echo substr($post_date,6,2)."/".substr($post_date,4,2)."/".substr($post_date,0,4)."  ". $post_time?>
<br />
        <br />
      </span></td>
  </tr>
</table>
</body>
</html>