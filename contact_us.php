<?php
session_start(); 
ob_start();
require_once('check_login.php');
require_once('include/i_config.php'); 
require_once('Connections/bwc_orders.php'); 
require_once('Connections/bwc_webboard.php'); 

require_once('include/functionphp.inc');

	$id =$_GET['id'];
	$dist=$_SESSION['dist'];
	$mslno=$_SESSION['mslno'];
	$chkdgt=$_SESSION['chkdgt'];
	
if ($dist!="" && $mslno!="" && $chkdgt!="") {
	mysql_select_db($database_bwc_orders, $bwc_orders);
	mysql_query("SET NAMES 'utf8'");
	$query = "SELECT * FROM MSLMST  WHERE  DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt";
	$mslmst = mysql_query($query, $bwc_orders) or die(mysql_error());
	$row_mslmst = mysql_fetch_assoc($mslmst);
	$totalRows_mslmst = mysql_num_rows($mslmst);
	if ($totalRows_mslmst==0) {
		$rep_name = $_SESSION['name'];
		$email = $_SESSION['email'];
		$phone = $_SESSION['phone'];
	}
	else { 
		$rep_name =$row_mslmst['NAME'];
		$email = $row_mslmst['EMAIL'];
		$phone = $row_mslmst['PHONE'];
	}
}

mysql_select_db($database_bwc_webboard, $bwc_webboard);
mysql_query("SET NAMES 'utf8'");
$query = "SELECT * FROM WEBBOARD_GROUP ORDER BY ID";
$group = mysql_query($query, $bwc_webboard) or die(mysql_error());
$row_group = mysql_fetch_assoc($group);
$totalRows_group = mysql_num_rows($group);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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

<body>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0" >
  <?php require_once('include/i_header_border.php'); ?>
  <?php require_once('include/i_header.php'); ?>
  <tr>
    <td height="480" align="left" valign="top" class="Sheet_Boder" style="padding:2px">
    <form action="contact_us_update.php" method="post" name="form1" target="_parent" id="form1" onsubmit="return check();">
      <br />
      <br />
      <table 
                  width="600" height="79" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
        <tbody>
          <tr>
            <td height="5"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_01.gif" 
                        width="5" /></td>
            <td width="700"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_02.gif" 
                        width="800" /></td>
            <td width="10"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_03.gif" 
                        width="5" /></td>
          </tr>
          <tr>
            <td valign="top" width="5" 
                      background="Images/Box_Set3/frame_04.gif" 
                      height="55"><img height="2" alt="" 
                        src="Images/Box_Set3/frame_04.gif" 
                        width="5" /></td>
            <td valign="top" bgcolor="#ffffff"><br />
              <table width="799" border="0" align="center" cellpadding="3" cellspacing="0">
                <tr>
                  <td width="172" align="right">รหัสสมาชิก</td>
                  <td width="615" align="left"><?php echo $dist; ?>-<?php echo $mslno; ?>-<?php echo $chkdgt; ?>
                    <input name="txtdist" type="hidden" id="txtdist" value="<?php echo $dist; ?>" />
                    <input name="txtmslno" type="hidden" id="txtmslno" value="<?php echo $mslno;  ?>" />
                    <input name="txtchkdgt" type="hidden" id="txtchkdgt" value="<?php echo $chkdgt; ?>" /></td>
                </tr>
                <tr>
                  <td align="right">ชื่อสมาชิก</td>
                  <td align="left"><?php echo ($rep_name); ?>
                    <input name="txtname" type="hidden" id="txtname" value="<?php echo ($rep_name); ?>" /></td>
                </tr>
                <tr>
                  <td align="right">อีเมลล์</td>
                  <td align="left"><input name="txtemail" type="text" id="txtemail" value="<?php echo $email; ?>" size="50" /></td>
                </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td align="left"><font style="color:#F00; font-weight:bold;"> ** คำถามของท่านจะไม่ได้รับการตอบกลับ ถ้าท่านไม่ได้ให้ข้อมูล e-mail ไว้   <br />
                    หากท่านต้องการเพิ่มเติมหรือแก้ไข E-Mail </font><a href="member_profile.php" target="_parent">กรุณาคลิกที่นี่</a></td>
                </tr>
                <tr>
                  <td align="right">โทรศัพท์ </td>
                  <td align="left"><input name="txtphone" type="text" id="txtphone" value="<?php echo $phone; ?>" size="50" />
                    </td>
                </tr>
                <tr>
                  <td align="right">เลือกกลุ่มในการติดต่อสอบถาม</td>
                  <td align="left"><select name="sel_group" id="sel_group">
                    <option value="">== เลือกกลุ่มในการติดต่อสอบถาม ==</option>
                    <?php do {  ?>
                      <option value="<?php  echo $row_group['ID'];?>"><?php  echo $row_group['GroupName'];?></option>
                      <?php } while ($row_group = mysql_fetch_assoc($group)); ?>
                  </select></td>
                </tr>
                <tr>
                  <td align="right">หัวข้อในการสอบถาม</td>
                  <td align="left"><input name="txtsubject" type="text" id="txtsubject" size="65" style="width:98%" /></td>
                </tr>
                <tr>
                  <td colspan="2" align="center" valign="top"><textarea cols="120" id="editor1" name="editor1" rows="25"><?php echo $txtarea; ?>
                  </textarea>
                    <script type="text/javascript">
			//<![CDATA[
					
				CKEDITOR.editorConfig = function( config )
				{
					config.toolbar = 'MyToolbar';
				 
					config.toolbar_MyToolbar =
					[
						{ name: 'document', items : [ 'NewPage','Preview' ] },
						{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
						{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
						{ name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'
								 ,'Iframe' ] },
								'/',
						{ name: 'styles', items : [ 'Styles','Format' ] },
						{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
						{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
						{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
						{ name: 'tools', items : [ 'Maximize','-','About' ] }
					];
				};

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

						on : { 'instanceReady' : configureHtmlOutput },
				
						toolbar:[
							 	  /* [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] , */
								   [ 'Bold','Italic','Underline','Strike','-','RemoveFormat' ],
								  [ 'Styles','Format','Font','FontSize' ],
								  [ 'TextColor','BGColor' ],
   							   
								 [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] 
								
								]

					});

/*
	{ name: 'document', items : [ 'NewPage','Preview' ] },
									{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
									{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','Scayt' ] },
									{ name: 'styles', items : [ 'Styles','Format' ] },
									{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
									{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
									{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
									{ name: 'tools', items : [ 'Maximize','-','About' ] }
									
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
                    
                    </td>
                </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td align="left">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="center"><input name="Button" type="button" id="button" value="ยกเลิก"  onclick="window.location='index.php'" class="formbutton"/>
                    <input name="Submit" type="submit" id="Submit" value="บันทึก"  class="formbutton"/></td>
                  </tr>
              </table>
              <br /></td>
            <td valign="top" 
                      background="Images/Box_Set3/frame_06.gif"><img 
                        height="1" alt="" 
                        src="Images/Box_Set3/frame_06.gif" 
                        width="5" /></td>
          </tr>
          <tr>
            <td height="5"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_07.gif" 
                        width="5" /></td>
            <td><img height="5" alt="" 
                        src="Images/Box_Set3/frame_08.gif" 
                        width="800" /></td>
            <td><img height="5" alt="" 
                        src="Images/Box_Set3/frame_09.gif" 
                        width="5" /></td>
          </tr>
        </tbody>
      </table>
      <script type="text/javascript">
			var thisform = document.getElementById("form1");
			function check() {
				if (thisform.txtdist.value=="" || thisform.txtmslno.value=="" || thisform.txtchkdgt.value==""){
					alert ("เกิดข้อผิดพลาด ไม่พบรหัสสมาชิก กรุณาล็อกอินใหม่อีกครั้ง");
					window.location='logout.php';
					return false;
				}
				else if (thisform.sel_group.value=="") {
					alert("กรุณาเลือกกลุ่มในการติดต่อสอบถาม");
					thisform.sel_group.focus();
					return false;
				}
				else if (thisform.txtsubject.value=="") {
					alert("กรุณากรอกหัวข้อในการสอบถาม");
					thisform.txtsubject.focus();
					return false;
				}
				else if (thisform.txtdetail.value=="") {
					alert("กรุณากรอกรายละเอียดในการสอบถาม");
					thisform.txtdetail.focus();
					return false;
				}
				else {
					return true;
				}
			
			
			}
			
      </script>
    </form>
      <br />
      <br />
      <!-- Start  Content  -->    
    </td>
  </tr>
  <?php require_once('include/i_footer_border.php'); ?>
</table>
<?php require_once('include/i_footer.php'); ?>
</body>
</html>
<?php
mysql_free_result($group);

ob_end_flush();   // ตำแหน่งสิ้นสุด  

?>