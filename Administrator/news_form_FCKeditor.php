<?php 
ob_start();
session_start();
?>
<?php 
//header('Content-type: text/html; charset=windows-874');
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
if (strtoupper($_SERVER['REQUEST_METHOD'])=="POST"  && isset($_POST)) {
	//$txtarea = $_POST['elm1'];

	//	if ( get_magic_quotes_gpc() )
	//		$txtarea = htmlspecialchars(stripslashes( $_POST['editor1'] ) ) ;
			
	//	else
	//		$txtarea = htmlspecialchars( $_POST['editor1'] ) ;
		
		$txtarea = $_POST['editor1'];
		$txtgroup=$_POST['sel_group'];
		$txtsubject= $_POST['txtsubject'];
		$post_date = date("Ymd");
		$post_time= date("Hi00");
		$exp_date = date("Ymd");
		
		mysql_select_db($database_dsm_orders, $dsm_orders);
		mysql_query("SET NAMES 'tis620'");
		//mysql_query("SET NAMES 'utf8'");
		
		//$strreplace = htmlentities($txtarea,ENT_QUOTES);
		//$str_replace = str_replace("&quot;","",$txtarea);
		$str_replace=$txtarea;
		$query = "INSERT INTO content_data(
								SUBJECT,
								DETAIL,
								GROUP_ID,
								STATUS,
								IS_DEFAULT,
								POST_DATE,
								POST_TIME,
								ALL_DISTRICT,
								EXP_DATE) 
						VALUES(
								'$txtsubject',
								'$str_replace',
								$txtgroup,
								0,
								'Y',
								$post_date,
								'$post_time',
								'Y',
								$exp_date)";
	
		 echo $query;
		// exit;
		
		$insert = mysql_query($query, $dsm_orders) or die("<br><br>Error : ". mysql_error());
		if ($insert) {
			AlertMessage("บันทึกข้อมูลเรียบร้อยแล้วค่ะ ...","news.php");
			exit;
		} 
		else {
			echo "<br>\nError : ไม่สามารถบันทึกข้อมูลได้  \n".mysql_error();
			exit;
		}
	
	
		
/*		
		if ( isset( $_POST ) )
				$postArray = &$_POST ;			// 4.1.0 or later, use $_POST
		else
				$postArray = &$HTTP_POST_VARS ;	// prior to 4.1.0, use HTTP_POST_VARS
		
		foreach ( $postArray as $sForm => $value )
		{
		if ( get_magic_quotes_gpc() )
			$postedValue = htmlspecialchars(stripslashes( $value ) ) ;
		else
			$postedValue = htmlspecialchars( $value ) ;
*/
		
	
}
else if (strtoupper($_SERVER['REQUEST_METHOD'])=="GET"  && isset($_POST['id'])) {

		
		mysql_select_db($database_dsm_orders, $dsm_orders);
		mysql_query("SET NAMES 'tis620'");	
		$query ="Select *  From content_data Where ID =".$_GET['id'];
		$content = mysql_query($query, $dsm_orders) or die("<br><br>Error : ". mysql_error());
		$row_content = mysql_fetch_assoc($content);
		$rows_content = mysql_num_rows($content);
		if ($rows_content >0) {
			$txtarea = $row_content['DETAIL'];
			$txtgroup=$row_content['GROUP_ID'];
			$txtsubject =$row_content['SUBJECT'];
			$post_date = date("Ymd");
			$post_time= date("Hi00");
			$exp_date = date("Ymd");
		
		}
		else {
			AlertMessage("ไม่พบข้อมูล กรุณาลองใหม่อีกครั้ง !!","news.php");
			exit;
		}
		$Mode="Update";

}
else {
	$Mode="Insert";
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>DSM INTERORDER SYSTEM : <?php  echo $_SESSION['login_name'];?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../wysiwyg/ckeditor/ckeditor.js"></script>
<script src="../wysiwyg/ckeditor/_samples/sample.js" type="text/javascript"></script>
<link href="../wysiwyg/ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />

</head>

<body>
<table width="950" border="0" align="center" cellpadding="0" cellspacing="0" class="FormBorder" >
  <tr>
    <td height="33" colspan="2"><?php include("i_header.php"); ?></td>
  </tr>
  <tr>
    <td width="133"  rowspan="2" align="left" valign="top" class="left_menu" ><?php include("i_left_menu.php"); ?></td>
    <td width="848" height="558" align="left" valign="top" bgcolor="#FFFFFF" style="padding:5px"><?php include("i_top_menu.php"); ?>
<!-- Check $_POST    
    
    
    <table border="1" cellspacing="0" id="outputSample">
      <colgroup>
        <col width="100" />
        </colgroup>
      <thead>
        <tr>
          <th>Field&nbsp;Name</th>
          <th>Value</th>
        </tr>
      </thead>
      <?php
/*
if ( isset( $_POST ) )
	$postArray = &$_POST ;			// 4.1.0 or later, use $_POST
else
	$postArray = &$HTTP_POST_VARS ;	// prior to 4.1.0, use HTTP_POST_VARS

foreach ( $postArray as $sForm => $value )
{
	if ( get_magic_quotes_gpc() )
		$postedValue = htmlspecialchars(stripslashes( $value ) ) ;
	else
		$postedValue = htmlspecialchars( $value ) ;
*/
?>
      <tr>
        <th style="vertical-align: top"><?php // echo $sForm?></th>
        <td><pre class="samples"><?php //echo $postedValue?></pre></td>
      </tr>
      <?php
//}
?>
    </table>
-->
<form id="form1" name="form1" method="post" action="" onsubmit="return check();">
  <table width="100%" border="0" cellspacing="1" cellpadding="3">
    <tr>
      <td align="right">&nbsp;</td>
      <td>&nbsp;<?php echo $Mode;?></td>
      </tr>
    <tr>
      <td width="11%" align="right"> Group : </td>
      <td width="89%"><select name="sel_group" id="sel_group">
        <option value="">      </option>
  <?php 
		  while ($row_group=mysql_fetch_assoc($group)) {
			   echo "<option value='". $row_group['ID']."'>".$row_group['GROUP_NAME']."</option>";
		  }
		  ?>
        </select></td>
      </tr>
    <tr>
      <td align="right">Subject : </td>
      <td style="margin-right:5px"><input name="txtsubject" type="text" id="txtsubject"  style="width:100%" value="<?php echo $subject; ?>"/></td>
      </tr>
    <tr>
      <td align="right">Default :</td>
      <td style="margin-right:5px"><input type="checkbox" name="checkbox" id="checkbox" /></td>
    </tr>
    <tr>
      <td align="right">Status : </td>
      <td style="margin-right:5px"><select name="select" id="select">
      </select></td>
    </tr>
    <tr>
      <td align="right">Expire Date :</td>
      <td style="margin-right:5px"><input type="text" name="textfield" id="textfield" />
        (รูปแบบ YYYY-MM-DD   ตัวอย่าง 2011-03-30)</td>
    </tr>
    <tr>
      <td align="right">Post Date : </td>
      <td style="margin-right:5px"><input type="text" name="textfield2" id="textfield2" />
        (รูปแบบ YYYY-MM-DD   ตัวอย่าง 2011-03-30)</td>
    </tr>
    <tr>
      <td align="right">Post Time :</td>
      <td style="margin-right:5px"><input type="text" name="textfield3" id="textfield3" />        
         (รูปแบบ HH:mm:ss   ตัวอย่าง 12:00:00)</td>
    </tr>
    </table>
  <textarea cols="80" id="editor1" name="editor1" rows="15">
</textarea>
  <script type="text/javascript">
			//<![CDATA[

				CKEDITOR.replace( 'editor1',
					{
						/*
						 * Style sheet for the contents
						 */
						contentsCss : 'body {color:#000; background-color#:FFF;}',

						/*
						 * Simple HTML5 doctype
						 */
						docType : '<!DOCTYPE HTML>',

						/*
						 * Core styles.
						 */
						coreStyles_bold	: { element : 'b' },
						coreStyles_italic	: { element : 'i' },
						coreStyles_underline	: { element : 'u'},
						coreStyles_strike	: { element : 'strike' },

						/*
						 * Font face
						 */
						// Define the way font elements will be applied to the document. The "font"
						// element will be used.
						font_style :
						{
								element		: 'font',
								attributes		: { 'face' : '#(family)' }
						},

						/*
						 * Font sizes.
						 */
						fontSize_sizes : 'xx-small/1;x-small/2;small/3;medium/4;large/5;x-large/6;xx-large/7',
						fontSize_style :
							{
								element		: 'font',
								attributes	: { 'size' : '#(size)' }
							} ,

						/*
						 * Font colors.
						 */
						colorButton_enableMore : true,

						colorButton_foreStyle :
							{
								element : 'font',
								attributes : { 'color' : '#(color)' },
								overrides	: [ { element : 'span', attributes : { 'class' : /^FontColor(?:1|2|3)$/ } } ]
							},

						colorButton_backStyle :
							{
								element : 'font',
								styles	: { 'background-color' : '#(color)' }
							},

						/*
						 * Styles combo.
						 */
						stylesSet :
								[
									{ name : 'Computer Code', element : 'code' },
									{ name : 'Keyboard Phrase', element : 'kbd' },
									{ name : 'Sample Text', element : 'samp' },
									{ name : 'Variable', element : 'var' },

									{ name : 'Deleted Text', element : 'del' },
									{ name : 'Inserted Text', element : 'ins' },

									{ name : 'Cited Work', element : 'cite' },
									{ name : 'Inline Quotation', element : 'q' }
								],

						on : { 'instanceReady' : configureHtmlOutput }
					});

/*
 * Adjust the behavior of the dataProcessor to avoid styles
 * and make it look like FCKeditor HTML output.
 */
function configureHtmlOutput( ev )
{
	var editor = ev.editor,
		dataProcessor = editor.dataProcessor,
		htmlFilter = dataProcessor && dataProcessor.htmlFilter;

	// Out self closing tags the HTML4 way, like <br>.
	dataProcessor.writer.selfClosingEnd = '>';

	// Make output formatting behave similar to FCKeditor
	var dtd = CKEDITOR.dtd;
	for ( var e in CKEDITOR.tools.extend( {}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent ) )
	{
		dataProcessor.writer.setRules( e,
			{
				indent : true,
				breakBeforeOpen : true,
				breakAfterOpen : false,
				breakBeforeClose : !dtd[ e ][ '#' ],
				breakAfterClose : true
			});
	}

	// Output properties as attributes, not styles.
	htmlFilter.addRules(
		{
			elements :
			{
				$ : function( element )
				{
					// Output dimensions of images as width and height
					if ( element.name == 'img' )
					{
						var style = element.attributes.style;

						if ( style )
						{
							// Get the width from the style.
							var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec( style ),
								width = match && match[1];

							// Get the height from the style.
							match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec( style );
							var height = match && match[1];

							if ( width )
							{
								element.attributes.style = element.attributes.style.replace( /(?:^|\s)width\s*:\s*(\d+)px;?/i , '' );
								element.attributes.width = width;
							}

							if ( height )
							{
								element.attributes.style = element.attributes.style.replace( /(?:^|\s)height\s*:\s*(\d+)px;?/i , '' );
								element.attributes.height = height;
							}
						}
					}

					// Output alignment of paragraphs using align
					if ( element.name == 'p' )
					{
						style = element.attributes.style;

						if ( style )
						{
							// Get the align from the style.
							match = /(?:^|\s)text-align\s*:\s*(\w*);/i.exec( style );
							var align = match && match[1];

							if ( align )
							{
								element.attributes.style = element.attributes.style.replace( /(?:^|\s)text-align\s*:\s*(\w*);?/i , '' );
								element.attributes.align = align;
							}
						}
					}

					if ( !element.attributes.style )
						delete element.attributes.style;

					return element;
				}
			},

			attributes :
				{
					style : function( value, element )
					{
						// Return #RGB for background and border colors
						return convertRGBToHex( value );
					}
				}
		} );
}


/**
* Convert a CSS rgb(R, G, B) color back to #RRGGBB format.
* @param Css style string (can include more than one color
* @return Converted css style.
*/
function convertRGBToHex( cssStyle )
{
	return cssStyle.replace( /(?:rgb\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*\))/gi, function( match, red, green, blue )
		{
			red = parseInt( red, 10 ).toString( 16 );
			green = parseInt( green, 10 ).toString( 16 );
			blue = parseInt( blue, 10 ).toString( 16 );
			var color = [red, green, blue] ;

			// Add padding zeros if the hex value is less than 0x10.
			for ( var i = 0 ; i < color.length ; i++ )
				color[i] = String( '0' + color[i] ).slice( -2 ) ;

			return '#' + color.join( '' ) ;
		 });
}
			//]]>
			</script>
  <br />
  
  <center>
    <input type="submit" name="Save" id="Save" value="Save" />
    <input type="reset" name="button2" id="button2" value="Reset" />
    </center>
</form>
<!--    ------------ -->
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
		//else if (frm.editor1.value==""){
		//	alert ("Please enter  content editor ");
		//	return false;
		//}
		else {
			return true;
		}
	}
</script>


</td>
  </tr>
  <tr>
    <td height="32" bgcolor="#FFFFFF"><?php include("i_footer.php"); ?></td>
  </tr>
</table>
</body>
</html>
<?php 
ob_end_flush();   // ตำแหน่งสิ้นสุด  
?>