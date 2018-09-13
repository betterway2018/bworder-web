<?php session_start();?>
<?php  require("check_login.php"); ?>
<?php 
header('Content-type: text/html; charset=windows-874');
include("../i_function_msg.php");
require("../Connections/bwc_content.php");
include("i_convert.php"); 
?>

<?php
$dist=$_POST['dist'];
$div= $_SESSION['div_code'];
$strcamp=$_POST['camp'];
$campaign=substr($strcamp,3,4).substr($strcamp,0,2);
$dwnflag=$_POST['dwnflag'];

mysql_select_db($database_bwc_content, $bwc_content);
mysql_query("SET NAMES 'tis620'");
//mysql_query("SET NAMES 'utf8'");

//$query = "SELECT * FROM  content_data  Where Group_id =1 Order by ID";
$query="select a.*,b.GROUP_NAME,b.GROUP_TYPE from content_data a,content_group b
			where a.group_id = b.id 
			 AND a.group_id = 5 
			 ORDER BY a.ID";
			 
$data = mysql_query($query, $bwc_content) or die(mysql_error());

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>BW INTERNET ORDER SYSTEM : <?php  echo $_SESSION['login_name'];?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
	function MM_openBrWindow(theURL,winName,w,h,scrollbars) 
	{ 
	  LeftPosition=(screen.width)?(screen.width-w)/2:100;
	  TopPosition=(screen.height)?(screen.height-h)/2:100;
	  
	  settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars=yes,location=no,directories=no,status=0,menubar=no,toolbar=no,resizable=yes';
	  URL = theURL;
	  window.open(URL,winName,settings);
	}
	
	function confirmDelete(url ){
		if (confirm("Confirm to delete item ?")) {
			document.location = url;
			//return true ;
		}
	}	
	
</script>

<link rel="stylesheet" type="text/css" href="Scripts/highslide/highslide.css" />
<script type="text/javascript" src="Scripts/highslide/highslide-with-html.js"></script>


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
	hs.graphicsDir = 'Scripts/highslide/graphics/';
	hs.outlineType = 'rounded-white';
	hs.showCredits = false;
	hs.wrapperClassName = 'draggable-header';
</script>

<style type="text/css">
<!--
.validateTips {border: 1px solid transparent; padding: 0.3em; }
input.text {margin-bottom:12px; width:95%; padding: .4em; }
div#users-contain {width: 350px; margin: 20px 0; }
-->
</style>


</head>

<body>
<br />
<font color="#FF00CC">
<h2>Update Demo : MISTINE ON WWW.BWORDER.COM</h2></font>
<table width="98%"  border="0" align="center" cellpadding="0" cellspacing="1" style="border:solid #6497D6 1px">
  <tr style="background-image:url(images/bar_email1_06.png);background-position:top;background-repeat:repeat-x;color:#FFF;height:25px">
    <td width="25" height="25" align="center" ><strong>No.</strong></td>
    <td width="122" align="left" ><strong>Group</strong></td>
    <td width="270" align="left" ><strong>Subject</strong></td>
    <td width="114" align="left" ><strong>Post Date</strong></td>
    <td width="97" align="left" ><strong>Post by</strong></td>
    <td width="89" align="left" ><strong>Expire Date</strong></td>
    <td width="62" align="left" ><strong>Status</strong></td>
    <td width="45" align="left" ><strong>Default</strong></td>
    <td width="176" align="left" >&nbsp;</td>
  </tr>
  <?php
$i=0;
while ($row_data = mysql_fetch_assoc($data)){
	$i=$i+1;
	if ($row_data['POST_DATE']==0) {
		$strpost_date ="";
	}
	else {
		$strpost_date= func_ConvertDateToString($row_data['POST_DATE'],$row_data['POST_TIME']);
	}

	if ($row_data['EXP_DATE']==0) {
		$strexp_date ="";
	}
	else {
		$strexp_date= func_ConvertDateToString($row_data['EXP_DATE'],"");
	}


?>
  <tr style="height:25px">
    <td valign="top" bgcolor="#F1F3F5">&nbsp;<?php echo $i;?></td>
    <td height="16" valign="top" bgcolor="#F1F3F5">&nbsp;<?php echo $row_data['GROUP_NAME'];?></td>
    <td height="16" valign="top" bgcolor="#F1F3F5">&nbsp;<?php echo $row_data['SUBJECT'];?></td>
    <td height="16" valign="top" bgcolor="#F1F3F5">&nbsp;<?php echo $strpost_date  ?></td>
    <td height="16" valign="top" bgcolor="#F1F3F5">&nbsp;<?php echo $row_data['POST_BY'];?></td>
    <td valign="top" bgcolor="#F1F3F5"><?php echo $strexp_date;?></td>
    <td height="16" valign="top" bgcolor="#F1F3F5">&nbsp;
      <?php  if($row_data['STATUS']==0){echo "Publish";} else { echo "Un Publish";}?></td>
    <td height="16" valign="top" bgcolor="#F1F3F5">&nbsp;<?php echo " ". $row_data['IS_DEFAULT'];?></td>
    <td height="16" align="center" valign="top" bgcolor="#F1F3F5">
      <a href="#" onclick="MM_openBrWindow('../vmtdemo_preview.php?id=<? echo $row_data['ID']?>','preview_news',800,600,'no')"> View </a> | <a href="../vmtdemo_form_FCKeditor.php?Mode=Update&id=<?php echo $row_data['ID'];?>">Edit</a>  | <a href="#" 
      onclick="confirmDelete('vmtdemo_delete.php?message_id=<? echo $row_data['ID'];?>');">*Delete DEMO MISTINE*</a></td>
  </tr>
  <?php
}
  ?>
</table>
<br /><center>
<input type="button" name="button" id="button" value="Create DEMO MISTINE"  onclick="window.location='../vmtdemo_form_FCKeditor.php?Mode=Insert'"/>
</center>
<br />
</body>
</html>