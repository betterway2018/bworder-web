<?php session_start();
ob_start();
?>
<?php 
header('Content-type: text/html; charset=windows-874');
include("i_function_msg.php");
require("Connections/bwc_content.php");
include("Administrator/i_convert.php"); 
?>

<?php
$div= $_SESSION['div_code'];

mysql_select_db($database_bwc_content, $bwc_content);
mysql_query("SET NAMES 'tis620'");
//mysql_query("SET NAMES 'utf8'");

$query = "Select ID,GROUP_NAME From  content_group  Where GROUP_TYPE= '4' Order by ID";
//$query = "Select ID,GROUP_NAME From  content_group  Where GROUP_TYPE= '1' Order by ID";
$group = mysql_query($query, $bwc_content) or die(mysql_error());
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
		$post_date = str_replace("-","",$_POST['txtpost_date']);
		$post_time=  str_replace(":","",$_POST['txtpost_time']);
		$is_default=$_POST['chkDefault'];
		$sel_status = $_POST['sel_status'];
		$post_by=$_SESSION['login_name'];
		
		if ($_POST['txtexp_date']==""){
			$exp_date ="0";
		}
		else {
			$exp_date = str_replace("-","",$_POST['txtexp_date']);
		}
		
		mysql_select_db($database_bwc_content, $bwc_content);
		mysql_query("SET NAMES 'tis620'");
		//mysql_query("SET NAMES 'utf8'");
		$str_replace=$txtarea;
	
		if (isset($_POST['Mode']) && $_POST['Mode']=="Update") {
			$id = $_POST['ID'];
			$query ="UPDATE content_data SET 
														  SUBJECT='$txtsubject',
														  DETAIL = '$str_replace',
														  GROUP_ID=$txtgroup,
														  STATUS = $sel_status,
														  IS_DEFAULT='$is_default',
														  POST_DATE =$post_date,
														  POST_TIME='$post_time',
														  EXP_DATE=$exp_date 
														   WHERE ID=$id";
		
		}
		else {
				$query = "INSERT INTO content_data(
								SUBJECT,
								DETAIL,
								GROUP_ID,
								STATUS,
								IS_DEFAULT,
								POST_DATE,
								POST_TIME,
								POST_BY,
								ALL_DISTRICT,
								EXP_DATE) 
						VALUES(
								'$txtsubject',
								'$str_replace',
								$txtgroup,
								$sel_status,
								'$is_default',
								$post_date,
								'$post_time',
								'$post_by',
								'Y',
								$exp_date);";
		}
		//echo $query;
		 //exit;
		
		$insert = mysql_query($query, $bwc_content) or die("<br><br>Error : ". mysql_error());
		if ($insert) {
			AlertMessage("บันทึกข้อมูลเรียบร้อย Demo Friday แล้วค่ะ ...","Administrator/vfrdemo.php");
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
else if (strtoupper($_SERVER['REQUEST_METHOD'])=="GET"  && isset($_GET['id'])) {
		
		mysql_select_db($database_bwc_content, $bwc_content);
		mysql_query("SET NAMES 'tis620'");	
		$query ="Select *  From content_data Where ID =".$_GET['id'];
		$content = mysql_query($query, $bwc_content) or die("<br><br>Error : ". mysql_error());
		$row_content = mysql_fetch_assoc($content);
		$rows_content = mysql_num_rows($content);
		if ($rows_content >0) {
			$id = $row_content['ID'];
			$txtarea = $row_content['DETAIL'];
			$txtgroup=$row_content['GROUP_ID'];
			$txtsubject =$row_content['SUBJECT'];
			$status = $row_content['STATUS'];
			$is_default=$row_content['IS_DEFAULT'];
			if ($row_content['EXP_DATE']=="0" ) {
				 $exp_date ="";
			}
			else {
						$exp_date = func_ConvertDateLongToString2($row_content['EXP_DATE'],"");
			}
			
			if ($row_content['POST_DATE']=="0") {
				$post_date ="";
			}
			else {
				$post_date = func_ConvertDateLongToString2($row_content['POST_DATE'],"");
			}
			
			if ($row_content['POST_TIME']=="0") {
				$post_time="";
			}
			else {
				$post_time= func_ConvertDateLongToString2("",$row_content['POST_TIME']);
			}
		}
		else {
			AlertMessage("ไม่พบข้อมูล กรุณาลองใหม่อีกครั้ง !!","vfrdemo.php");
			exit;
		}
		$Mode="Update";

}
else {
	
	$Mode="Insert";
	$id="";
	$txtarea = "";
	$txtgroup="";
	$txtsubject ="";
	$status = "0";
	$is_default ="N";
	$post_date = date("Y-m-d");
	$post_time= date("H:i:00");
	$exp_date = "";
	
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>DSM INTERORDER SYSTEM : <?php  echo $_SESSION['login_name'];?></title>
<link href="Administrator/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="wysiwyg/ckeditor/ckeditor.js"></script>
<script src="wysiwyg/ckeditor/_samples/sample.js" type="text/javascript"></script>
<link href="wysiwyg/ckeditor/_samples/sample.css" rel="stylesheet" type="text/css" />

</head>

<body>

</br>
<table width="900"  border="0" align="center" cellpadding="0" cellspacing="0" style="border:solid #6497D6 1px" bgcolor="#33CCFF">
  <tr>
    <td width="806" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="50%">
          
          
          <table width="228" border="0" cellpadding="0" cellspacing="0" >
            <tr>
              <th align="left" valign="top" >สร้าง/เพิ่ม File DEMO : FRIDAY</th>
              </tr>
          </table></td>
          <td width="50%" align="right"><?php echo $Mode;?>&nbsp;&nbsp;</td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#F1F3F5"><form id="form1" name="form1" method="post" action="" onsubmit="return check();">
        <br />
        <table width="100%" border="0" cellspacing="1" cellpadding="2">
          <tr>
            <td width="11%" align="right"> Group : </td>
            <td width="89%"><select name="sel_group" id="sel_group" >
              <option value="" > </option>
              <?php 
		  while ($row_group=mysql_fetch_assoc($group)) {
			  	if ($row_group['ID']==$txtgroup) {
					$selected ="selected";
				}
				else {
					$selected ="";
				}
					
			   echo "<option value='". $row_group['ID']."'".  $selected  ." >".$row_group['GROUP_NAME']."</option>";
		  }
		  ?>
            </select>              <input name="ID" type="hidden" id="ID" value="<?php echo $id; ?>" />*เลือก friday</td>
          </tr>
          <tr>
            <td align="right">Subject : </td>
            <td style="margin-right:10px"><input name="txtsubject" type="text" id="txtsubject"  style="width:98%" value="<?php echo $txtsubject; ?>"/></td>
          </tr>
          <tr>
            <td align="right">Default :</td>
            <td style="margin-right:5px"><input <?php if ($is_default=="Y") {echo "checked=\"checked\"";} ?> name="chkDefault" type="checkbox" id="chkDefault" value="Y" /></td>
          </tr>
          <tr>
            <td align="right">Status : </td>
            <td style="margin-right:5px">
            <select name="sel_status" id="sel_status">
              <option value="0" <?php  if ($status=="0") { echo "selected"; }?> >Publish</option>
              <option value="1" <?php  if ($status=="1") { echo "selected"; }?>>Un Publish</option>
            </select></td>
          </tr>
          <tr>
            <td align="right">Expire Date :</td>
            <td style="margin-right:5px"><input name="txtexp_date" type="text" id="txtexp_date" value="<?php echo $exp_date; ?>" />
              (รูปแบบ YYYY-MM-DD   ตัวอย่าง 2011-03-30)</td>
          </tr>
          <tr>
            <td align="right">Post Date : </td>
            <td style="margin-right:5px"><input name="txtpost_date" type="text" id="txtpost_date" value="<?php echo $post_date; ?>" />
              (รูปแบบ YYYY-MM-DD   ตัวอย่าง 2011-03-30)</td>
          </tr>
          <tr>
            <td align="right">Post Time :</td>
            <td style="margin-right:5px"><input name="txtpost_time" type="text" id="txtpost_time" value="<?php echo $post_time; ?>" />
              (รูปแบบ HH:mm:ss   ตัวอย่าง 12:00:00)</td>
          </tr>
        </table>
        <textarea cols="80" id="editor1" name="editor1" rows="25"><?php echo $txtarea; ?>
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

        <center>
          <input type="submit" name="Save" id="Save" value="Save" />
          <input type="reset" name="button2" id="button2" value="Reset" />
          <input type="button" name="button" id="button" value="Cancel"  onclick="window.location='administrator/vfrdemo.php'"/>
          <input name="Mode" type="hidden" id="Mode" value="<?php echo $Mode; ?>" />
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
</table>
</body>
</html>
<?php 
ob_end_flush();   // ตำแหน่งสิ้นสุด  
?>