<?php  session_start(); ?>
<?php require("i_config.php"); ?>
<?php require("check_login.php"); ?>
<?php require_once('Connections/bwc_orders.php'); ?>

<?php
$url_page="catalogue_page.php";
$coverpage ="coverpage.jpg";
$html_default ="default.html";
$img_path="ImageFlow_130/img/";

//?cate=1&type=01&camp=201110

$brand=$_GET['cate'];
$type=$_GET['type'];
$camp=$_GET['camp'];

mysql_select_db($database_bwc_orders, $bwc_orders);
$query ="select * from catalogue where  Status ='Publish'  and brand ='$brand' and TYPE='$type' And CAMP=$camp  order by camp";
$website= mysql_query($query, $bwc_orders) or die(mysql_error());
$row_website = mysql_fetch_assoc($website);
$num_rows_website=mysql_num_rows($website);

if ($num_rows_website !=0) {
	
	$page_url= $row_website['URL']."/".$html_default;
	
	 switch ($row_website['BRAND'].$row_website['TYPE']) {
    				case "101":
								$str_brand="Mistine";
								$GCONLY="N";
						        break;
					case "201":
								$str_brand="Friday";
								$GCONLY="N";
								break;
					case "202":
								$str_brand="Friday Grand";
								$GCONLY="G";
								break;
								
					case "301":
								$str_brand="Faris";
								$GCONLY="N";
								break;
		}
}
else {
	$page_url="";
	
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><?php  echo $title ?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	/*demo page css*/
	  body{ font: "Trebuchet MS", sans-serif; margin: 50px;} 
	.demoHeaders { margin-top: 2em; }
	#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
	#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
	ul#icons {margin: 0; padding: 0;}
	ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
	ul#icons span.ui-icon {float: left; margin: 0 4px;}
</style>
<link href="Scripts/jquery/css/ui-lightness/jquery-ui-1.8.13.custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="Scripts/jquery/js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="Scripts/jquery/js/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript">
			$(function(){
				// Dialog			
				$('#dialog').dialog({
					autoOpen: false,
					modal: true,
					width: 600,
					buttons: {
						"Ok": function() { 
							$(this).dialog("close"); 
						}, 
						"Cancel": function() { 
							$(this).dialog("close"); 
						} 
					}
				});
				
				
				
				// Dialog Link
				$('#dialog_link').click(function(){
					$('#dialog').dialog('open');
					return false;
				});
			});
</script>

</head>


<script language="JavaScript" >
	   var HttPRequest = false;
		
	   function preview_data(fBrand,fType,fCamp) {

		//alert(seqno);
		//alert(txtcode);
		//alert(txtqty);
		//alert(fCampCode);
		
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
		  
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
		
			var i;
		    var url = 'catalogue_data2.php';
			var pageno= document.getElementById('sel_page');
		    var pmeters = "Brand=" + encodeURI(fBrand) +"&Camp="+encodeURI(fCamp)+"&Type="+encodeURI(fType)+"&pageNo="+encodeURI(pageno.value);
			
		
			HttPRequest.open('POST',url,true);
			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
			
			
			HttPRequest.onreadystatechange = function()
			{

				 if(HttPRequest.readyState == 3)  // Loading Request
				  {
				   document.getElementById("mySpan").innerHTML = "Now is Loading...";
				  }

				 if(HttPRequest.readyState == 4) // Return Request
				  {
				   document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
				  }
				
			}

		
	   }
	   
</script>	   

<script type="text/javascript">

	   function AddToCart(camp,billcode,billdesc,qty,price) {
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
		  
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
	
			var url = 'catalogue_order_update.php';
			var pmeters = 'camp='+ camp +'&billcode='+ billcode +'&qty='+qty+'&price='+price;

			//Confirm\
			var str_camp =String(camp);
			
			
			 var str_confirm  ='คุณต้องการเพิ่มรายการสั่งซื้อผลิตภัณฑ์ ใช่หรือไม่ ? \n'  +
			 				'รอบจำหน่าย   : '+ str_camp.substr(4,2)+'/'+str_camp.substr(0,4) +'\n'+
					       'รหัส - ชื่อสินค้า : '+billcode + '  '+billdesc+'\n' +
						   'จำนวนที่สั่งซื้อ  : '+qty  +'  ชิ้น ';
				
				var answer = confirm(str_confirm)
				if (answer) {
					//alert ('ok');
					//return true;
				}
				else {
					return false ;
				}
										
			
			//alert (pmeters);
			
			HttPRequest.open('POST',url,true);
			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.send(pmeters);
			HttPRequest.onreadystatechange = function()
			{

				 if(HttPRequest.readyState == 3)  // Loading Request
				  {
				   //document.getElementById("mySpan").innerHTML = "Now is Loading...";
				  }

				 if(HttPRequest.readyState == 4) // Return Request
				  {
				   //document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
				   //doCallAjax('BILLCODE');
				   alert(HttPRequest.responseText);
				   return false;
				  }
				
			}

	   }

function Qty_Added(obj) {
	var qty_el =  obj; //document.getElementById('<%="qty"&rsItem("BILLCODE")%>'); 
	var qty = qty_el.value; 
	if( !isNaN( qty )) {
		qty_el.value++;
	} 
	else {
		qty_el.value=1;
	}
	qty_el.focus();	
	return false;
}

function Qty_Minus(obj) {
	var qty_el =  obj; //document.getElementById('<%="qty" & rsItem("BILLCODE")%>'); 
	var qty = qty_el.value; 
	if( !isNaN( qty )) {
		qty_el.value--;
		if (qty_el.value <1 ){
			qty_el.value=1;
		}
	}
	else {
		qty_el = 1;
	}
	qty_el.focus();
	return false;
}

</script>


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
    <td height="53" align="center" valign="top" class="Sheet_Boder" style="padding:2px"><!-- Start  Content  -->    
        
    <table width="900" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td align="left"><iframe src="<?  echo $page_url ?>" width="99%" height="500" frameborder="0" class="FormBorderGray"  > </iframe></td>
      </tr>
      <tr>
        <td width="904" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
              <td width="39%"><a name="data" id="data"></a>รายการผลิตภัณ์ <? echo $str_brand?> หน้าที่
<?PHP 

	mysql_select_db($database_bwc_orders, $bwc_orders);
	$query="Select DISTINCT PAGENO  from catalogue_data where camp=$camp and brand='$brand'  AND GCONLY='$GCONLY' AND SUBSTR(PAGENO,1,3)  <> SUBSTRING(PAGENO,4,3) ORDER BY PAGENO";
$page_no= mysql_query($query, $bwc_orders) or die(mysql_error());
//$row_pageno = mysql_fetch_assoc($page_no);
//$num_rows_pageno=mysql_num_rows($page_no);

?>
                <select name="sel_page" id="sel_page" onchange="preview_data('<? echo $brand ?>','<? echo $type ?>', <? echo $camp ?>);">
                  <option>เลือกหน้าแคตตาล็อค</option>
                  <?php while ( $row_pageno=mysql_fetch_assoc($page_no)) {
					
						
					echo "<option value='".$row_pageno['PAGENO'] ."'>".
								"หน้า  : " .  (int) substr($row_pageno['PAGENO'],0,3)." - ". (int) substr($row_pageno['PAGENO'],3,3) ."</option>";
				
				?>
                  <?php } ?>
                </select></td>
              <td width="20%">&nbsp;</td>
              <td width="41%" align="right"><a href="catalogue.php" target="_parent">ดูแคตตาล็อคอื่น ๆ </a></td>
            </tr>
          </table></td>
      </tr>
      <tr>
        <td align="left" valign="top">
          
          <span id="mySpan">        </span>        </td>
      </tr>
    </table></td>
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