<?php session_start();?>

<?php 
header('Content-type: text/html; charset=windows-874');
require("check_login.php"); 
include("../i_function_msg.php");
require("../Connections/dsm_orders.php");
include("i_convert.php"); 
?>

<?php
$div= $_SESSION['div_code'];

mysql_select_db($database_dsm_orders, $dsm_orders);
mysql_query("SET NAMES 'tis620'");
//mysql_query("SET NAMES 'utf8'");

$query = "Select ID,GROUP_NAME From  content_group  Where GROUP_TYPE= '1' Order by ID";
$group = mysql_query($query, $dsm_orders) or die(mysql_error());
//$row_group = mysql_fetch_assoc($group);

?>

<?php
if ($_SERVER['REQUEST_METHOD']=="POST" && isset("Save")) {
	$txtarea = $_POST['elm1'];
	$txtgroup=$_POST['sel_group'];
	$txtsubj = $_POST['txtsubject'];
	
	
}
elseif ($_SERVER['REQUEST_METHOD']=="GET" && isset("id")) {
	
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>DSM INTERORDER SYSTEM : <?php  echo $_SESSION['login_name'];?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />


<!-- TinyMCE -->
<script type="text/javascript" src="../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "../tinymce/css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "../tinymce/lists/template_list.js",
		external_link_list_url : "../tinymce/lists/link_list.js",
		external_image_list_url : "../tinymce/lists/image_list.js",
		media_external_list_url : "../tinymce/lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->

</head>

<body>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0" class="FormBorder" >
  <tr>
    <td height="33" colspan="2"><?php include("i_header.php"); ?></td>
  </tr>
  <tr>
    <td width="133"  rowspan="2" align="left" valign="top" class="left_menu" ><?php include("i_left_menu.php"); ?></td>
    <td width="848" height="558" align="left" valign="top" bgcolor="#FFFFFF" style="padding:5px"><?php include("i_top_menu.php"); ?>
<!--    ------------ -->


<form action="" method="post" target="_parent" id="form1" onsubmit="return check()">
	<div>
	  <table width="100%" border="0" cellspacing="1" cellpadding="3">
	    <tr>
	      <td align="right">&nbsp;</td>
	      <td>&nbsp;</td>
	      </tr>
	    <tr>
		        <td width="7%" align="right"> Group : </td>
		        <td width="93%"><select name="sel_group" id="sel_group">
		          <option value="" selected="selected">== Select Group ==</option>
		          <?php 
		  while ($row_group=mysql_fetch_assoc($group)) {
			   echo "<option value='". $row_group['ID']."'>".$row_group['GROUP_NAME']."</option>";
		  }
		  ?>
	            </select></td>
	          </tr>
		      <tr>
		        <td align="right">Subect : </td>
		        <td style="margin-right:5px"><input type="text" name="txtsubject" id="txtsubject"  style="width:100%"/></td>
	          </tr>
	      </table>
	  <textarea id="elm1" name="elm1" rows="20" cols="80" style="width: 100%"><?php echo $txtarea;?></textarea>
<br />
		<!-- Some integration calls -->
        <!--
        <a href="javascript:;" onmousedown="tinyMCE.get('elm1').show();">[Show]</a>
		<a href="javascript:;" onmousedown="tinyMCE.get('elm1').hide();">[Hide]</a>
		<a href="javascript:;" onmousedown="tinyMCE.get('elm1').execCommand('Bold');">[Bold]</a>
		<a href="javascript:;" onmousedown="alert(tinyMCE.get('elm1').getContent());">[Get contents]</a>
		<a href="javascript:;" onmousedown="alert(tinyMCE.get('elm1').selection.getContent());">[Get selected HTML]</a>
		<a href="javascript:;" onmousedown="alert(tinyMCE.get('elm1').selection.getContent({format : 'text'}));">[Get selected text]</a>
		<a href="javascript:;" onmousedown="alert(tinyMCE.get('elm1').selection.getNode().nodeName);">[Get selected element]</a>
		<a href="javascript:;" onmousedown="tinyMCE.execCommand('mceInsertContent',false,'<b>Hello world!!</b>');">[Insert HTML]</a>
		<a href="javascript:;" onmousedown="tinyMCE.execCommand('mceReplaceContent',false,'<b>{$selection}</b>');">[Replace selection]</a>
		-->
        <center><!--<input name="Save" type="button" id="Save"  onclick="alert(tinyMCE.get('elm1').getContent());" value="Save"/>-->
		<input type="button" name="button" id="button" value="Cancel"  onclick="window.location='news.php'"/>
		<input type="reset" name="reset" value="Reset" />
        <input type="submit" name="Save" id="Save" value="Save" />
        </center>
	</div>
<script type="text/javascript">
	function check() {
		var frm = document.getElementById('form1');
		//alert (document.getElementById("elm1").text);
	   if (frm.sel_group.value=="") {
			alert ("Please select content group");
			frm.sel_group.focus();
			return false;
		}
		else if (frm.txtsubject.value=="") {
			alert("Please enter subject");
			frm.txtsubject.focus();
			return false;
		}
		//else if (frm.elm1.value==""){
			//alert ("Please enter  content tag ");
			//frm.elm1.focus();
			//return false;
		//}
		else {
			return true;
		}
			
			
	}
</script>
<?php 
if ($_SERVER['REQUEST_METHOD']=="POST"  ) {
		
	mysql_select_db($database_dsm_orders, $dsm_orders);
	mysql_query("SET NAMES 'tis620'");
	//mysql_query("SET NAMES 'utf8'");
	
	$txtdetail = $_POST['elm1'];
	$txtdetail = string
	$query = "INSERT INTO content_data(SUBJECT,DETAIL,GROUP_ID,STATUS,IS_DEFAULT,POST_DATE,POST_TIME,ALL_DISTRICT,EXP_DATE) ";
	$query.="VALUES (".$_POST['txtsubject']."','".$txtdetail	."'".",".$_POST['sel_group']. ","	."0,'N'".",". date('Ymd').","."'".date('Hi00')."',"."'Y'".",". date('Ymd').")";
	
	// echo $query;
	// exit;
	
	$insert = mysql_query($query, $dsm_orders) or die(mysql_error());
	if ($insert) {
		AlertMessage("บันทึกข้อมูลเรียบร้อยแล้วค่ะ ...","news.php");
		exit;
	} 
	else {
		echo mysql_error();
		exit;
	}
	//$row_users = mysql_fetch_assoc($users);
}
else {
	echo "POST =".$_POST['Save'];
}
?>
?>
</form>

<script type="text/javascript">
if (document.location.protocol == 'file:') {
	alert("The examples might not work properly on the local file system due to security settings in your browser. Please use a real webserver.");
}
</script>




<!--    =-------------- -->


</td>
  </tr>
  <tr>
    <td height="32" bgcolor="#FFFFFF"><?php include("i_footer.php"); ?></td>
  </tr>
</table>
</body>
</html>