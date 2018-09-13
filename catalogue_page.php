<?php  session_start(); 
ob_start();
?>
<?php require("i_config.php"); ?>
<?php require("check_login.php"); ?>
<?php require_once('Connections/bwc_orders.php'); ?>

<?php
$url_page="catalogue_page.php";
$coverpage ="coverpage.jpg";
$html_default ="Default.html";
$img_path="ImageFlow_130/img/";

//?cate=1&type=01&camp=201110

$id=$_GET['id'];
$brand="";
$type="";
$camp="";

$query ="select * from catalogue where  Status ='Publish'  and id=$id";
mysql_select_db($database_bwc_orders, $bwc_orders);
$website= mysql_query($query, $bwc_orders) or die(mysql_error());
$row_website = mysql_fetch_assoc($website);
$num_rows_website=mysql_num_rows($website);

if ($num_rows_website !=0) {
	$page_url= $row_website['URL']."/".$html_default;
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
<script type="text/javascript" src="Scripts/ajaxsbmt.js"></script>
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
		
	   function preview_data(fID,fPage1,fPage2) {

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
		    var url = 'catalogue_data.php';
			var pageno= document.getElementById('sel_page');
		    var pmeters = "id=" + encodeURI(fID) +"&pageNo="+encodeURI(pageno.value);
			
		
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

	   function doAddToCart(camp,billcode,billdesc,qty,price) {
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

<script language="JavaScript" >
	   function AddToCart(camp,billcode,billdesc,qty,price) {

		//alert('camp='+camp);
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

		    var url = 'order_getfill.php';
		    var pmeters = "tProductID=" + billcode +"&"+"tCampCode="+camp;

			//alert (pmeters);
		
			HttPRequest.open('POST',url,true);
			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
			
			HttPRequest.onreadystatechange = function()
			{

				if(HttPRequest.readyState == 3)  // Loading Request
				{
					//document.getElementById(fProductName).innerHTML = "..";
				}
				if(HttPRequest.readyState == 4) // Return Request
				{
					var str_confirm ="คลิกปุ่ม 'OK'  ถ้าคุณต้องการเพิ่มในรายการสั่งซื้อของคุณ หรือ \n คลิกปุ่ม 'Cancel' เพื่อยกเลิกรหัสสินค้านี้";
					var myProduct = HttPRequest.responseText;
					//								0                      1           2        3          4               5
					// return value   =  0=normal,1=error| billdesc | price | brand| msgtype | message				
					//alert (myProduct);
					var myArr = myProduct.split("|");
					var ErrResult=myArr[0];
					var billdesc= myArr[1];
					var strMsg=  myArr[5].replace(/^\s+|\s+$/g, '');		
					
					//START !!!!! 
					//@@@@@@@@@@@@@@@@@@@@@@@@@@@@
					if (ErrResult=="0" || ErrResult==0) 
					{ //  return typ   no error ;
					//alert('rrr'+strMsg);
						 if (strMsg=="") {
								//if (!confirm("คุณระบุรหัสสินค้าไม่ถูกต้อง หรือระบุรหัสสินค้าไม่ตรงกับรอบจำหน่ายที่คุณเลือก \nคุณต้องการเพิ่มในรายการสั่งซื้อของคุณใช่หรือไม่ \n\n"+str_confirm )) 
								//{
									//alert('can shop');
									doAddToCart(camp,billcode,billdesc,qty,price)
										//ถ้าไม่พบรหัสสินค้าและไม่เพิ่มรายการ
										return false;
								//}
						}
						//ถ้าไม่พบรหัสสินค้าแต่ต้องการเพิ่มรายการ
						return true;				
						
						
						 
					}////////@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@WWWW
					//ERROR
					else if (ErrResult=="1" || ErrResult==1) 
					{ // return type error
				
					alert('*** '+strMsg);
						if (msgtyp =="OKOnly") 
						{
							alert(strMsg);
							return false;
						}
						else if(msgtyp=="OKCancel") 
						{
							
							if (!confirm(strMsg +"\n\n"+str_confirm )) 
							{
								// Click Cancel
								return false;
							}
								return true;									
						}
					} else { alert('ErrResult='+ErrResult); } // enof  // return type error
				
			}//if(HttPRequest.readyState == 4) 
	   }//HttPRequest.onreadystatechange = function()/
	}
//#################################################################################	   
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
              <td width="45%"><a name="data" id="data"></a>รายการผลิตภัณฑ์  <? echo $str_brand?> หน้าที่
<?PHP 

	mysql_select_db($database_bwc_orders, $bwc_orders);
//	$query="Select DISTINCT PAGENO  from catalogue_data where camp=$camp and brand='$brand'  AND GCONLY='$GCONLY' AND SUBSTR(PAGENO,1,3)  <> //SUBSTRING(PAGENO,4,3) AND SUBSTRING(PAGENO,1,1) NOT IN ('9','5')  ORDER BY PAGENO";

$query="select distinct CPAGE_FROM,CPAGE_TO FROM CATALOGUE_DATA WHERE  ID =$id ORDER BY CPAGE_FROM";
$page_no= mysql_query($query, $bwc_orders) or die(mysql_error());


//$row_pageno = mysql_fetch_assoc($page_no);
$num_rows_pageno=mysql_num_rows($page_no);
//echo $num_rows_pageno;
//exit;
?>
                <select name="sel_page" id="sel_page" onchange="preview_data('<? echo $id ?>');">
                  <option>เลือกหน้าแคตตาล็อค</option>

                  <?php 
				  
				  
				  while ( $row_pageno=mysql_fetch_assoc($page_no)) {
					$PageNo=		$row_pageno['CPAGE_FROM'].$row_pageno['CPAGE_TO'];
					$Page1=$row_pageno['CPAGE_FROM'];
					$Page2=$row_pageno['CPAGE_TO'];
					
					echo "<option value='". $PageNo ."'>".
								"หน้า  : " . $Page1." - ". $Page2 ."</option>";
				  }
				?>
              
                </select></td>
              <td width="44%">สนใจสั่งซื้อสินค้าในหน้า ที่ท่านกำลังเปิดอยู่ คลิกที่หน้า Catalouge</td>
              <td width="11%" align="right"><a href="catalogue.php" target="_parent">ดูแคตตาล็อคอื่น ๆ </a></td>
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

<?php ob_end_flush(); ?>