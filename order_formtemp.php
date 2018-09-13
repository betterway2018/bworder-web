<?php  session_start(); ?>
<?php require("i_config.php"); ?>
<?php require("i_function_msg.php"); ?>
<?php require("check_login.php"); ?>
<?php
ini_set('max_execution_time',60); // 60 seconds for max execution time..
require_once('Connections/bwc_orders.php');
require_once('Connections/bwc_log.php');
?>

<?php
  function func_ConvertDateToString($iDate) {
			$yy=substr($iDate,0,4);
			$mm=substr($iDate,4,2);
			$dd=substr($iDate,6,2);
		//	$time=substr($time,0,2).":".substr($time,2,2).":".substr($time,4,2);
			return $dd."/".$mm."/".$yy;
  }
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><?php  echo $title?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="Scripts/jquery/css/ui-lightness/jquery-ui-1.8.13.custom.css" rel="stylesheet" type="text/css" />
<style type="text/css">
	/*demo page css*/
	body{ font: 62.5% "Trebuchet MS", sans-serif; margin: 50px;}
	.demoHeaders { margin-top: 2em; }
	#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
	#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
	ul#icons {margin: 0; padding: 0;}
	ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
	ul#icons span.ui-icon {float: left; margin: 0 4px;}
</style>	
<script type="text/javascript" src="Scripts/ajaxsbmt.js"></script>
<script type="text/javascript" src="Scripts/NumberFormat154.js"></script>
<script type="text/javascript" src="Scripts/jQuery/js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="Scripts/jquery/js/jquery-ui-1.8.13.custom.min.js"></script>
<style>
        .overlay{
          position:absolute;
          top:0;
          left:0;
          width:100%;
          height:100%;
          z-index:5000;
          background-color:#000;
          -moz-opacity: 0.7;
          opacity:.70;
          filter: alpha(opacity=65);
          text-align: center;
        }
 	
</style>

<script type="text/javascript">
	var flagclose = 0;
		$(function(){
			// Dialog			
			$('#dialog_discount').dialog({
				autoOpen: false,
				modal: true,
				width: 640,
				height: 550,
				flagclose: 0,
				open : function () {
					$(":button:contains('<< กลับไปหน้ารายการสั่งซื้อ')").blur();
					$(":button:contains('ยืนยันรายการสั่งซื้อ >>')").focus();
				} ,
				beforeClose: function(event, ui) { 
					//alert(flagclose);
					if (flagclose==0) {
						if (confirm("ท่านยังไม่ได้ยืนยันรายการ \n กด OK เพื่อยืนยันรายการสั่งซื้อ \n กด cancel เพื่อกลับหน้ารายการสั่งซื้อ")){
							$(this).dialog(do_submit()  ); 
							 return true; 
						} else { return true; }
					} else { flagclose=0; }
				} ,
				buttons: {
					"<< กลับไปหน้ารายการสั่งซื้อ": function() { 
							//if (confirm("กลับหน้าสรุปรายการใช่หรือไม่  ?")){
							//confirm('กลับหน้าสรุปรายการใช่หรือไม่')==true
							flagclose = 1;
							$(this).dialog("close"); //}
					}, 
					
					"ยืนยันรายการสั่งซื้อ >>": function() { 
						//document.getElementById('div_wait').innerHTML = "<img src='images/indicator.white_1.gif' />";
						//confirm('รายการสั่งซื้อของท่านได้ถูกยืนยันเรียบร้อยแล้ว ท่านจะได้รับ E-Mail เพื่อยันยันรายการสั่งซื้อของท่าน')==true
						alert('รายการสั่งซื้อของท่านได้ถูกยืนยันเรียบร้อยแล้ว ท่านจะได้รับ E-Mail เพื่อยันยันรายการสั่งซื้อของท่าน');
						$(this).dialog(do_submit()  ); 
						//msgbox "แก้ไขล่าสุด26/10/2012";
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

<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>


	
    

<script type="text/javascript">
<!--
function setNextFocus(tar_obj) { //v3.0
	    if (event.keyCode == 13){
            var obj=document.getElementById(tar_obj);
            if (obj){
                obj.focus();
            }
        }
}

//ให้รับเฉพาะตัวเลข
function checknumber() {
	  key=event.keyCode
	 if (key<48  ||  key>57 )  {
				event.returnValue = false;
	 }
}

//#####################################################################
function BackPage()
{
	if (document.getElementById('hidva').value=='true')
	{		
		if (window.confirm("ท่านมีการแก้ไขรายการสั่งซื้อ และยังไม่ได้ยืนยันรายการสั่งซื้อสินค้า \nกดปุ่ม Ok เพื่อกลับไปที่หน้าจอสรุปรายการสั่งซื้อ\nหรือกดปุ่ม Cancel เพื่อกลับไปหน้าสั่งซื้อสินค้าเพื่อยันยันรายการสั่งซื้อสินค้า")==true)
		{
			//return false;
			window.location='order_summary.php';
		}else{
			//form_submit();
			//window.location='order_summary.php';
			return false;
		}
	}else{
		window.location='order_summary.php';
		}
}


function Editing()
{
	var nflag = checknumber();
	if(nflag!=false)
	{
		document.getElementById('hidva').value='true';
		}
	}


//-->
</script>


<script language="JavaScript" >
	   var HttPRequest = false;
		
	   function doCallAjax(seqno,fCampCode) {

		//alert('seqno='+seqno);
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
		    var url = 'order_getfill.php';
			var txtcode= document.getElementById('txtcode_'+seqno);
			var txtdesc =document.getElementById('txtdesc_'+seqno);
			var txtqty=document.getElementById("txtqty_"+seqno);
			var txtprice=document.getElementById('txtprice_'+seqno);
			var txtamount=document.getElementById('txtamount_'+seqno);
			var totseq=document.getElementById('TotalItems');

			// *** Check Duuplicate *** //
			
			 for ( i=1 ;i<=totseq.value;i++) {	
//			 alert(document.getElementById('txtcode_'+i).value+ '  ' + document.getElementById('txtcode_'+seqno).value);
				 if(document.getElementById('txtcode_'+i).value == document.getElementById("txtcode_"+seqno).value &&  seqno !=  i 		) {
						 alert("คุณได้กรอกรหัสสินค้าซ้ำ กับรายการที่  " + i);
						 document.getElementById('txtcode_'+seqno).value="";
						 document.getElementById('txtcode_'+i).focus();
						 return false;
					}
			 }
			 
		    var pmeters = "tProductID=" + encodeURI(txtcode.value) +"&"+"tCampCode="+encodeURI(fCampCode);

			//alert (pmeters);
		
			HttPRequest.open('POST',url,true);
			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
			
			
			HttPRequest.onreadystatechange = function()
			{

				//if(HttPRequest.readyState == 3)  // Loading Request
				//{
					//document.getElementById(fProductName).innerHTML = "..";
				//}
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
					var price=myArr[2];
					var format_price= new NumberFormat(parseFloat(myArr[2]));
					var brand= myArr[3];
					var msgtyp = myArr[4];
					var strMsg=  myArr[5].replace(/^\s+|\s+$/g, '');		
				
					format_price.setPlaces(0);  //จำนวน ทศนิยม
					format_price.setSeparators(true); // ใส่ คอมม่า คั่น หลัก พัน

					//START !!!!! 
					//@@@@@@@@@@@@@@@@@@@@@@@@@@@@
					if (ErrResult=="0" || ErrResult==0) 
					{ //  return typ   no error ;
						 if (billdesc=="") {
								if (!confirm("คุณระบุรหัสสินค้าไม่ถูกต้อง หรือระบุรหัสสินค้าไม่ตรงกับรอบจำหน่ายที่คุณเลือก \nคุณต้องการเพิ่มในรายการสั่งซื้อของคุณใช่หรือไม่ \n\n"+str_confirm )) 
								{
										//ถ้าไม่พบรหัสสินค้าและไม่เพิ่มรายการ
										document.getElementById('txtcode_'+seqno).value="";
										document.getElementById('txtdesc_'+seqno).value ="";
										document.getElementById('disp_desc_'+seqno).value="";
										document.getElementById('disp_price_'+seqno).value="";
										document.getElementById('disp_amount_'+seqno).value=""; // amount			
										document.getElementById('txtdesc_'+seqno).value="";  // description
										document.getElementById('txtbrand_'+seqno).value=""; //brand
										document.getElementById('txtprice_'+seqno).value=""; // price
										document.getElementById('txtamount_'+seqno).value=""; // amount						
										document.getElementById('txtcode_'+seqno).focus();											
										return false;
								}
						}
						//ถ้าไม่พบรหัสสินค้าแต่ต้องการเพิ่มรายการ
						document.getElementById('disp_desc_'+seqno).value=billdesc;  // description
						document.getElementById('disp_price_'+seqno).value=format_price.toFormatted(); // price
						document.getElementById('disp_amount_'+seqno).value="0"; // amount
						document.getElementById('txtdesc_'+seqno).value=billdesc;  // description
						document.getElementById('txtprice_'+seqno).value=price; // price
						document.getElementById('txtbrand_'+seqno).value=brand;//brand 
						document.getElementById('txtamount_'+seqno).value="0"; // amount
						return true;				
						
						
						 
			}////////@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@WWWW
					//ERROR
					else if (ErrResult=="1" || ErrResult==1) 
					{ // return type error
					//alert(strMsg);

						if (msgtyp =="OKOnly") 
						{
							alert(strMsg);
							document.getElementById('disp_desc_'+seqno).value=billdesc;  // description
							document.getElementById('disp_price_'+seqno).value=format_price.toFormatted(); // price
							document.getElementById('disp_amount_'+seqno).value="0"; // amount
							document.getElementById('txtdesc_'+seqno).value=billdesc;  // description
							document.getElementById('txtprice_'+seqno).value=price; // price
							document.getElementById('txtbrand_'+seqno).value=brand;//brand 
							document.getElementById('txtamount_'+seqno).value="0"; // amount
							
							return true;									
						}
						else if(msgtyp=="OKAlert") 
						{
							alert(strMsg);
							document.getElementById('txtcode_'+seqno).value="";
							document.getElementById('txtqty_'+seqno).value="";
							document.getElementById('txtdesc_'+seqno).value ="";
							document.getElementById('disp_desc_'+seqno).value="";
							document.getElementById('disp_price_'+seqno).value="";
							document.getElementById('disp_amount_'+seqno).value=""; // amount			
							document.getElementById('txtdesc_'+seqno).value="";  // description
							document.getElementById('txtprice_'+seqno).value=""; // price
							document.getElementById('txtbrand_'+seqno).value="";//brand 
							document.getElementById('txtamount_'+seqno).value=""; // amount						
							document.getElementById('txtcode_'+seqno).focus();											
							return false;
						}
						else if(msgtyp=="OKCancel") 
						{
							if (!confirm(strMsg +"\n\n"+str_confirm )) 
							{
								// Click Cancel
								document.getElementById('txtcode_'+seqno).value="";
								document.getElementById('txtqty_'+seqno).value="";
								document.getElementById('txtdesc_'+seqno).value ="";
								document.getElementById('disp_desc_'+seqno).value="";
								document.getElementById('disp_price_'+seqno).value="";
								document.getElementById('disp_amount_'+seqno).value=""; // amount			
								document.getElementById('txtdesc_'+seqno).value="";  // description
								document.getElementById('txtprice_'+seqno).value=""; // price
								document.getElementById('txtbrand_'+seqno).value="";//brand 
								document.getElementById('txtamount_'+seqno).value=""; // amount						
								document.getElementById('txtcode_'+seqno).focus();											
								return false;
							} else {
						
								//Click OK
								document.getElementById('disp_desc_'+seqno).value=billdesc;  // description
								document.getElementById('disp_price_'+seqno).value=format_price.toFormatted(); // price
								document.getElementById('disp_amount_'+seqno).value="0"; // amount
								document.getElementById('txtdesc_'+seqno).value=billdesc;  // description
								document.getElementById('txtprice_'+seqno).value=price; // price
								document.getElementById('txtbrand_'+seqno).value=brand;//brand 
								document.getElementById('txtamount_'+seqno).value="0"; // amount
								
								return true;									
							}
						}
					} // enof  // return type error
				
			}//if(HttPRequest.readyState == 4) 
		
	   }//HttPRequest.onreadystatechange = function()/
	}
//#################################################################################	    

		function cal_amount (seqno,totseq) 
		{
						 
					var txtqty=document.getElementById("txtqty_"+seqno);
					var txtprice=document.getElementById("txtprice_"+seqno);
					var tot_amount=0;
					var i;
					var strnum;
					var numqty=0;
					var numprice=0;
																	
					var num = parseFloat(txtqty.value )*parseFloat(txtprice.value );
					var objnum = new NumberFormat(parseFloat(num));
					
					if (isNaN(num)){
						num=0;
					}
					else {
						//num=parseFloat(txtqty.value )*parseFloat(txtprice.value );
					}
					
					//alert (parseFloat(txtqty.value ) +  "*" + parseFloat(txtprice.value ) + "=" + num);
				
					objnum.setPlaces(0);  //จำนวน ทศนิยม
					objnum.setSeparators(true); // ใส่ คอมม่า คั่น หลัก พัน
					strnum = objnum.toFormatted();
					document.getElementById("disp_amount_"+seqno).value =  num;
					document.getElementById("txtamount_"+seqno).value =  num;
					var amt_1 =0;
					var amt_2=0;
					var amt_3=0;
					var dsc_1=0;
					var dsc_2=0;
					var dsc_3=0;
					
					 for ( i=1 ;i<=totseq;i++) {	
							var billcode =document.getElementById('txtcode_'+i);
							var txt_qty = document.getElementById('txtqty_'+i);
							var txt_price = document.getElementById('txtprice_'+i);
							var dispamount=document.getElementById('disp_amount_'+i);
							var txtamount = document.getElementById('txtamount_'+i);
							 if( billcode.value != "" ) {
								var num2 = parseFloat(txt_qty.value )*parseFloat(txt_price.value );
								if (isNaN(num2)){
									num2=0;
								}
								else {
									//num=parseFloat(txtqty.value )*parseFloat(txtprice.value );
								}
				
								txtamount.value=num2;
								dispamount.value=num2;
								
								 if ( IsNumeric(txtamount.value)) {
									 tot_amount= parseFloat(tot_amount)  +parseFloat(txtamount.value);
									 if(document.getElementById('txtbrand_'+i).value=="1") { amt_1=parseFloat(amt_1)  +parseFloat(txtamount.value);}
									 else if(document.getElementById('txtbrand_'+i).value=="2") { amt_2=parseFloat(amt_2)  +parseFloat(txtamount.value);}
									 else if(document.getElementById('txtbrand_'+i).value=="3") { amt_3=parseFloat(amt_3)  +parseFloat(txtamount.value);}
								}
							}
						}
						

						//brand1 แก้ไข
						if(amt_1>0 && amt_1<=199.99) {dsc_1=0;}
                        else if(amt_1>=200 && amt_1<=999.99) {dsc_1=10;}                                                 
                        else if(amt_1>=1000 && amt_1<=1999.99) {dsc_1=15;}                                                
                        else if(amt_1>=2000 && amt_1<=2999.99) {dsc_1=20;}
                        else if(amt_1>=3000 && amt_1<=999999.99) {dsc_1=30;}
						
						//brand1 เดิม
						/*if(amt_1>0 && amt_1<=299.99) {$dsc_1=0;}
						else if(amt_1>=300 && amt_1<=499.99) {dsc_1=15;}
						else if(amt_1>=500 && amt_1<=2999.99) {dsc_1=25;}
						else if(amt_1>=3000 && amt_1<=999999.99) {dsc_1=30;}*/
						
						//brand2 แก้ไข
						if(amt_2>0 && amt_2<=199.99) {dsc_2=0;}
                        else if(amt_2>=200 && amt_2<=999.99) {dsc_2=10;}
                        else if(amt_2>=1000 && amt_2<=1999.99) {dsc_2=15;}
                        else if(amt_2>=2000 && amt_2<=999999.99) {dsc_2=20;}

						//brand2 เดิม
						/*if(amt_2>0 && amt_2<=299.99) {$dsc_2=0;}
						else if(amt_2>=300 && amt_2<=499.99) {dsc_2=10;}
						else if(amt_2>=500 && amt_2<=999999.99) {dsc_2=20;}*/
						
						//brand3
						if(amt_3>0 && amt_3<=999.99) {dsc_3=10;}
						else if(amt_3>=1000 && amt_3<=1999.99) {dsc_3=15;}
						else if(amt_3>=2000 && amt_3<=2999.99) {dsc_3=20;}
						else if(amt_3>=3000 && amt_3<=999999.99) {dsc_3=30;}			

						var totnum = new NumberFormat(parseFloat(tot_amount));
						totnum.setPlaces(0);  //จำนวน ทศนิยม
						totnum.setSeparators(true); // ใส่ คอมม่า คั่น หลัก พัน
						document.getElementById("disp_total_amount").value = totnum.toFormatted();				
						document.getElementById("txtTotalAmount").value =tot_amount;
						document.getElementById('txtG_1').value = amt_1;
						document.getElementById('txtG_2').value = amt_2;
						document.getElementById('txtG_3').value = amt_3;
						document.getElementById('txtNormal_disc_1').value = dsc_1;
						document.getElementById('txtNormal_disc_2').value = dsc_2;
						document.getElementById('txtNormal_disc_3').value = dsc_3;
						
						
		}

//###############################################################################
//###############################################################################
	  
	
  function  do_submit()
	   {
		   var frm  = document.getElementById('form_order');
			var i=1;
			var j=0;
			
			if (document.getElementById('flag').value=="UPDATE" ) {
				frm.setAttribute('action','?doMode=Update');
				}
			else
			{
				frm.setAttribute('action','?doMode=Insert');				
			}
			document.getElementById("doMode").value="Save Order";		
			frm.submit();
			return true;
	   }
	   

////คำนวนส่วนลด#######################################################################		

	   function  check_discount()
	   {
  
		   var frm  = document.getElementById('form_order');
			var i=1;
			var j=0;
			var totalitems = document.getElementById('TotalItems').value;
			//alert(totalitems);
			
			 for ( i=1 ;i<=totalitems;i++) {	
			 	 var billcode  = document.getElementById('txtcode_'+i);
				 var billdesc = document.getElementById('txtdesc_'+i);
				 var billunit=document.getElementById('txtqty_'+i);
				 
				 //alert ("-"+billcode.value+"-");
				 if( billcode.value != "" ) {
					 if (! IsNumeric(billunit.value)) {
						alert ("กรุณากรอกจำนวนสั่งซื้อ ในรายการที่ "+ i  +" ด้วยค่ะ ");
						billunit.focus();
						return false;
					 }
					 if (billunit.value==0) {
						 alert("จำนวนที่สั่งซื้อสินค้า ในรายการที่ " +i  + "  ต้องมากกว่า 0 นะคะ  ");
						 billunit.focus();
						 return false;
					 }
						 					
					 if (billunit.value >=9999) {
						 alert("กรุณาตรวจสอบจำนวนที่สั่งซื้อสินค้า ในรายการที่ " +i  + "  ด้วยค่ะ  ");
						 billunit.focus();
						 return false;
					 }
				 }
				 if (billcode.value!="" && billunit!="") {
					 j=j+1;
				 }
			 }
			
			if (j==0) {
				alert("กรุณากรอกรหัสสินค้า ที่คุณต้องการสั่งซื้อด้วยค่ะ");
				return false;
			}
			cal_amount(1,totalitems);
		
			xmlhttpPost('order_calculate_discount.php', 'form_order', 'dialog_discount', '<img src=\'images/indicator.white_1.gif\'>'); 
			$('#dialog_discount').dialog('open');
			return false;

	  }

//##############################################################################
	    function form_AddRows(){
			  var frm  = document.getElementById('form_order');
			  document.getElementById("doMode").value="Add Rows";
			  //alert (document.getElementById("doMode").value);
			  frm.submit();
		}
		
	    function form_RemoveRows(){
			  var frm  = document.getElementById('form_order');
			  document.getElementById("doMode").value="Remove Rows";
			  //alert (document.getElementById("doMode").value);
			  frm.submit();
		}
				
		
		function IsNumeric(strString)
					   //  check for valid numeric strings	
					   {
					   var strValidChars = "0123456789.-";
					   var strChar;
					   var blnResult = true;
					
					   if (strString.length == 0) return false;
					
					   //  test strString consists of valid characters listed above
					   for (i = 0; i < strString.length && blnResult == true; i++)
						  {
						  strChar = strString.charAt(i);
						  if (strValidChars.indexOf(strChar) == -1)
							 {
							 blnResult = false;
							 }
						  }
					   return blnResult;
		}		
		
		function confirmSubmit(url) {
			if (confirm("คุณต้องการย้อนกลับไปหน้าสรุปรายการสั่งซื้อสินค้า ใช่หรือไม่ ?")) {
				document.location = url;
				//return true ;
			}
		}
		

	function confirmDelete(url,pno) {
		if (confirm("คุณต้องการลบรายการสั่งซื้อสินค้าทั้งหมดของ " + pno +"  ใช่หรือไม่ ?")) {
			//alert(url);
			document.location = url;
			//return true ;
		}
	}		
	</script>
    
<!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$-->
<!-- Test form post-->
<!--$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$-->

<script type="text/javascript">
 

</script>

    
</head>


<?php 
//echo $_SERVER['REQUEST_METHOD'] ;
//-echo "<br>";
//echo $_GET['doMode'];
//exit;
				
$campaign=$_GET['camp'];		
				
 //####################################################################################
if ($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['doMode']) && ($_GET['doMode']=="New" || $_GET['doMode']=="Edit") ) {
//####################################################################################	
			
			$dist=$_SESSION['dist'];
			$mslno=$_SESSION['mslno'];
			$chkdgt=$_SESSION['chkdgt'];
			$rep_name=$_SESSION['rep_name'];
			$email=$_SESSION['email'];
			$campaign=$_GET['camp'];	
			
			if ($_GET['doMode']=="Edit")
			{
					$flag="UPDATE";
			}
			else
			{
					$flag="INSERT";
			}
				
			$totalItems=15;
			
			if ($dist=="" || $mslno=="" || $chkdgt=="") {echo "<meta http-equiv='refresh' content='0;URL=login.php'>";	}
			if ($campaign=="") { echo "<meta http-equiv='refresh' content='0;URL=order_summary.php'>";	}
			
			mysql_select_db($database_bwc_orders, $bwc_orders);
			mysql_query("SET NAMES 'tis620'");
			
			$query ="Select * From  order_headertemp Where DIST='$dist' and mslno=$mslno and chkdgt=$chkdgt 
							and ordcamp=$campaign and dwnflag='N' and delflag='N'";
			$order = mysql_query($query, $bwc_orders) or die(mysql_error());
			$row_order = mysql_fetch_assoc($order);
			$totalRows_order = mysql_num_rows($order);		
			if ($totalRows_order >0 ) {
					$strcamp = substr($campaign,4,2)."/".substr($campaign,0,4);
					$strpo  =  substr("000000".$row_order['ORDER_NO'],-6);
					$order_no = $row_order['ORDER_NO'];
					$flag="UPDATE";
					
					$query="SELECT * FROM order_detailtemp WHERE  DWNFLAG='N' AND DELFLAG='N' ";
					$query = $query ." AND DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt AND ORDER_NO = $order_no AND ORDCAMP=$campaign";
					$order_detailtemp =mysql_query($query,$bwc_orders) ;
					if (!$order_detailtemp) {
						die(mysql_error());
						exit;
					}
					$row_order_detailtemp  = mysql_fetch_assoc($order_detailtemp);
					$totalItems = mysql_num_rows($order_detailtemp);
					
					//Binding Data 
					$arr_billcode = array("");
					$arr_qty = array("");	
					$arr_billdesc=array("");
					$arr_price =array("");
					$arr_brand=array("");
					$arr_amount=array("");
					$totalAmount=0;
					do {
							array_push($arr_billcode ,$row_order_detailtemp['BILLCODE'] );
							array_push($arr_qty ,$row_order_detailtemp['QTY'] );
							array_push($arr_billdesc ,$row_order_detailtemp['BILLDESC'] );
							array_push($arr_price ,$row_order_detailtemp['PRICE'] );		
							array_push($arr_brand,$row_order_detailtemp['BRAND']);
							array_push($arr_amount ,$row_order_detailtemp['AMOUNT'] );				
							$totalAmount= $totalAmount +$row_order_detailtemp['AMOUNT'] ;		
					} while  ($row_order_detailtemp  = mysql_fetch_assoc($order_detailtemp)); 
				
					if ($totalItems<15) { 
						$totalItems=15;
					} 
					else {
						$totalItems=$totalItems+5;
					}
			}
			
			insert_log($_SESSION["dist"],$_SESSION["mslno"],$_SESSION["chkdgt"],"Order Form","$flag  Order $campaign - $strpo"); ////insert log
	
	
}

//####################################################################################
else if ($_SERVER['REQUEST_METHOD']=="POST" && $_POST['doMode']=="Save Order") {
//####################################################################################	
			mysql_select_db($database_bwc_orders, $bwc_orders);
			mysql_query("SET NAMES 'tis620'");
			require("order_updatetemp.php"); 			
			exit;
			
	//if  (isset($_POST['flag']) && $_POST['flag']=="" || $_POST['flag']=="INSERT") {
		//require("order_update.php"); 
	//} 
	//elseif (isset($_POST['flag']) && $_POST['flag']=="UPDATE") {
		//require("order_update.php"); 										   
	//}

	//exit;
	
}
//####################################################################################
else if ($_SERVER['REQUEST_METHOD']=="POST" && $_POST['doMode']=="Remove Rows"){
//####################################################################################	

	$dist=$_POST['dist'];
	$mslno=$_POST['mslno'];
	$chkdgt=$_POST['chkdgt'];
	$rep_name=$_POST['rep_name'];
	$campaign=$_POST['campaign'];	
    $totalItems = $_POST['TotalItems'];
	$flag=$_POST['flag'];
	
	$arr_billcode = array("");
	$arr_qty = array("");	
	$arr_billdesc=array("");
	$arr_price =array("");
	$arr_brand=array("");
	$arr_amount=array("");
	
	$totalAmount=0;
	for ($i=1;$i<=$totalItems;$i++){
		if ($_POST['chk_'.$i]!=$i  ) {
			if ($_POST['txtcode_'.$i]!="") {
				array_push($arr_billcode ,$_POST['txtcode_'.$i] );
				array_push($arr_qty ,$_POST['txtqty_'.$i] );
				array_push($arr_billdesc ,$_POST['txtdesc_'.$i] );
				array_push($arr_price ,$_POST['txtprice_'.$i] );	
				array_push($arr_brand,$_POST['txtbrand_'.$i]);
				array_push($arr_amount ,$_POST['txtamount_'.$i] );		
				$totalAmount= $totalAmount + $_POST['txtamount_'.$i];
			}
		}
	}
	
	$totalItems = count($arr_billcode);
	if ($totalItems<15) { 
		$totalItems=15;
	} 
	else {
		$totalItems=$totalItems+5;
	}

	
}
//####################################################################################
else if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['doMode'])=="Add Rows" ) {
//####################################################################################	
	
	$dist=$_POST['dist'];
	$mslno=$_POST['mslno'];
	$chkdgt=$_POST['chkdgt'];
	$rep_name=$_POST['rep_name'];
	$campaign=$_POST['campaign'];	
    $totalItems = $_POST['TotalItems'];
	$totalItems = $totalItems + $_POST['txtrows'];
	$flag=$_POST['flag'];
	//Binding Data 
	
	$arr_billcode = array("");
	$arr_qty = array("");	
	$arr_billdesc=array("");
	$arr_price =array("");
	$arr_brand=array("");
	$arr_amount=array("");
	$totalAmount=0;
	for ($i=1;$i<=$totalItems;$i++){
		if ($_POST['txtcode_'.$i]!="") {
			array_push($arr_billcode ,$_POST['txtcode_'.$i] );
			array_push($arr_qty ,$_POST['txtqty_'.$i] );
			array_push($arr_billdesc ,$_POST['txtdesc_'.$i] );
			array_push($arr_price ,$_POST['txtprice_'.$i]);		
			array_push($arr_brand,$_POST['txtbrand_'.$i]);
			array_push($arr_amount ,$_POST['txtamount_'.$i] );				
			$totalAmount= $totalAmount + $_POST['txtamount_'.$i];
		}
	}

	if ($totalItems<15) { 
		$totalItems=15;
	} 
	

}

/// Check rep code 
if ($dist=="" || $mslno=="" || $chkdgt=="") {
	echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
}

if ($campaign=="") {
	echo "<meta http-equiv='refresh' content='0;URL=order_summary.php'>";
}
mysql_select_db($database_bwc_orders, $bwc_orders);
//mysql_query("SET NAMES 'tis620'");
$wrkDate=date('Ymd');
include("i_MailPlan_by_camp.php");

?>

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
    <td height="388" align="left" valign="top" class="Sheet_Boder" style="padding:2px"><form id="form_order" name="form_order" method="post" action="">
      <table 
                  width="709" height="79" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
        <tbody>
          <tr>
            <td height="5"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_01.gif" 
                        width="5" /></td>
            <td width="700"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_02.gif" 
                        width="700" /></td>
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
            <td valign="top" bgcolor="#ffffff"><table width="100%" border="0" cellspacing="1" cellpadding="2">
              <tr>
                <td width="15%" align="right">รหัสสมาชิก : </td>
                <td width="41%"><? printf("%s-%s-%s ",$_SESSION['dist'],$_SESSION['mslno'],$_SESSION['chkdgt']); ?></td>
                <td width="23%" align="right">เลขที่รายการสั่งซื้อ :</td>
                <td width="21%"><?php   if ($flag=="UPDATE") {echo $strcamp ."-".$strpo;  }else { echo "[ AUTO ]"; }?> <input name="flag" type="hidden" id="flag" value="<? echo $flag ?>" />
                  <input name="order_no" type="hidden" id="order_no" value="<? echo $po; ?>" /></td>
              </tr>
              <tr>
                <td align="right">ชื่อสมาชิก : </td>
                <td><?php echo $_SESSION['name'];?></td>
                <td align="right">รอบจำหน่ายที่สั่งซื้อ : </td>
                <td><?php   echo  substr($campaign,4,2)."/".substr($campaign,0,4); ?>&nbsp;
				<?php   if($order_type =="Late") { echo  "( $order_type )" ;  }  ?>
                  <input name="campaign" type="hidden" id="campaign" value="<? echo $campaign; ?>" />
                  </td>
              </tr>
              <tr>
                <td height="20" align="right">อีเมลล์ : </td>
                <td><? echo $_SESSION['email']; ?>&nbsp;</td>
                <td align="right">วันที่สั่งซื้อ : </td>
                <td><?php  echo  date('d/m/Y G:i:00'); ?>&nbsp;</td>
              </tr>
                
<?php 
 if ($order_type!="Late") {
?>              
              <tr>
                <td height="22" align="right">&nbsp;</td>
                <td colspan="3" align="right"><font color="#FF0000">

<strong>หากท่านต้องการสั่งซื้อรายการมิสทินและฟาริสรอบที่ 
                <font color="#024E28"><?php echo  substr($lastCamp,4,2)."/".substr($lastCamp,0,4)  ?></font></strong> <a href="order_check.php?campaign=<? echo $lastCamp; ?>">กรุณาคลิกที่นี่</a></font>
             
                
                </td>
                </tr>
<?php  } ?>                   
                
            </table></td>
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
                        width="700" /></td>
            <td><img height="5" alt="" 
                        src="Images/Box_Set3/frame_09.gif" 
                        width="5" /></td>
          </tr>
        </tbody>
      </table>
      <table width="710" border="0" align="center" cellpadding="1" cellspacing="0" class="FormBorder_3">
        <tr class="content_header2"  style="background-image:url(image_icon/bg_cell.gif);background-position:top;background-repeat:repeat-x;font-weight:bold">
          <td width="23" align="center" nowrap="nowrap" >&nbsp;</td>
          <td width="34" height="23" align="center" nowrap="nowrap"><strong class="content_header3">ลำดับ</strong></td>
          <td width="70" align="left" ><strong class="content_header3">รหัสสินค้า</strong></td>
          <td width="40" align="left" nowrap="nowrap"><strong class="content_header3">จำนวน</strong></td>
          <td width="374" align="left" ><strong class="content_header3">ชื่อสินค้า</strong></td>
          <td width="83" align="center" nowrap="nowrap"><strong class="content_header3">ราคา/หน่วย</strong></td>
          <td width="70" align="center" ><strong class="content_header3">ราคารวม</strong></td>
        </tr>
        <?php 
		

FOR ($i = 1; $i <= $totalItems; $i++) 
{ 

	if ($i<$totalItems) {
		$var = $i+1;
	}
	else {
		$var=$i;
	}
	
	$next_obj = "txtcode_$var";

?>

        <tr bgcolor="#ffe8f1" class="line_bottom">
          <td align="center"><input name="<? echo "chk_$i"; ?>" type="checkbox" id="<? echo "chk_$i"; ?>" value="<? echo $i ?>" /></td>
          <td align="center"><? echo "$i." ?></td>
          <td align="left"><input name="<? echo "txtcode_$i";?>" type="text" id="<? echo "txtcode_$i";?>" onchange="return doCallAjax(<? echo $i;?>,'<? echo $campaign;?>' )"  onkeydown="setNextFocus('<?php  echo "txtqty_$i"; ?>');" 
          onkeypress="Editing()"
          value="<? echo  $arr_billcode[$i];?>" size="10" maxlength="5" /></td>
          <td align="left">
          <input name="<? echo "txtqty_$i";?>" 
          type="text" id="<? echo "txtqty_$i";?>" 
          onblur="cal_amount(<? echo $i ; ?>,<?php echo $totalItems; ?>)"   
           onkeydown="setNextFocus('<?php  echo $next_obj; ?>')"
          onkeypress="checknumber()"
          value="<? echo  $arr_qty[$i];?>" size="5" maxlength="4"/></td>
          <td align="left"><input name="<? echo "disp_desc_$i"; ?>" type="text"  readonly="readonly" id="<? echo "disp_desc_$i";?>" value="<? echo  $arr_billdesc[$i];?>" size="50" maxlength="100"   style="width:98%"/>
            <input name="<? echo "txtdesc_$i"; ?>" type="hidden" id="<? echo "txtdesc_$i"; ?>" value="<? echo   $arr_billdesc[$i];?>" />
            <input name="<? echo "txtbrand_$i"; ?>" type="hidden" id="<? echo "txtbrand_$i"; ?>" value="<? echo   $arr_brand[$i];?>" size="1" /></td>
          <td align="center"><input name="<? echo "disp_price_$i"; ?>" type="text" disabled="disabled" id="<? echo "disp_price_$i"; ?>" style=" text-align:right" value="<? echo  $arr_price[$i];?>" size="8" />
            <input name="<?echo "txtprice_$i" ?>" type="hidden" id="<?echo "txtprice_$i" ?>" value="<? echo  $arr_price[$i];?>" /></td>
          <td align="center"><input name="<? echo "disp_amount_$i";?>" type="text" disabled="disabled"  id="<? echo "disp_amount_$i";?>" style="text-align:right" value="<? echo  $arr_amount[$i];?>" size="8" />
            <input name="<? echo "txtamount_$i"; ?>" type="hidden" id="<? echo "txtamount_$i"; ?>" value="<? echo  $arr_amount[$i];?>" /></td>
        </tr>
        <?php
}  // end of for loop

?>
        </table>
      <table width="710" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td><table width="710" border="0" cellspacing="1" cellpadding="0">
            <tr>
              <td width="544" align="left" valign="top"><input type="button" name="but_Del" id="but_Del" value="ลบรายการที่เลือก"  onclick="javascript:form_RemoveRows();" class="formbutton"/>
              
              
                    <?php $script_link ="po=".$strpo."&id=". $dist.substr("00000".$mslno,-5).$chkdgt."&camp=".$campaign;   ?>
                    
                    
<?php if ($flag=="UPDATE") {?>                    
                      <input type="button" name="but_Del2" id="but_Del2" value="ลบรายการสั่งซื้อทั้งหมด"  onclick="javascript:confirmDelete('order_deletetemp.php?<? echo $script_link; ?>','<? echo $strcamp ."-".$strpo?>');" class="formbutton"/>
<?php } ?>                         
                <input type="button" name="Submit2" id="Submit2" value="เพิ่มช่องรายการสั่งซื้อสินค้า" onclick="javascript:form_AddRows();"  class="formbutton"/>
                <input type="hidden" name="doMode" id="doMode" />
                <input name="TotalItems" type="hidden" id="TotalItems" value="<? echo $totalItems;?>" />
                <input name="txtrows" type="text" id="txtrows" value="5" size="5" maxlength="4" style="visibility:hidden" /></td>
              <td width="94" align="right" valign="top"><strong>มูลค่ารวม</strong></td>
              <td width="68" align="center" valign="top"><input name="disp_total_amount" type="text" disabled="disabled" id="disp_total_amount"  style="text-align:right" value="<? echo  $totalAmount;?>" size="8"/>
                <input name="txtTotalAmount" type="hidden" id="txtTotalAmount" value="<? echo  $totalAmount;?>" />
                <br /></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td align="left" valign="top">
             <!--   Happy hour Promotion-->
          <?php
		  	  		
			mysql_select_db($database_bwc_orders, $bwc_orders);
			//mysql_query("SET NAMES 'tis620'");
			
			$query ="Select * From  Order_happy_hour Where DIST='$dist' and mslno=$mslno and chkdgt=$chkdgt and camp=$campaign";
			$happy_hour = mysql_query($query, $bwc_orders) or die(mysql_error());
			$row_happy_hour = mysql_fetch_assoc($happy_hour);
			$totalRows_happy_hour = mysql_num_rows($happy_hour);	
		if($totalRows_happy_hour >0){	
		if (($row_happy_hour['STATUS'] == "Happy Hour" || $row_happy_hour['STATUS'] == "" || $row_happy_hour['STATUS'] == NULL) ) {
	 ?>
          <table width="692" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="206" height="111" align="center" valign="middle"><img src="images/yesbutton-addtocarthappy.jpg" width="150" height="111" /></td>
              <td width="486" align="left" valign="middle">
              <?
              	$strcamp = substr($campaign,4,2)."/".substr($campaign,0,4);
				$strdatetime=substr( $row_happy_hour['REG_DATE'],6,2)."/".substr( $row_happy_hour['REG_DATE'],4,2)."/".substr( $row_happy_hour['REG_DATE'],0,4);
				$strtime = substr($row_happy_hour['REG_TIME'],0,2).":".substr($row_happy_hour['REG_TIME'],2,2).":".substr($row_happy_hour['REG_TIME'],4,2);
				$billdesc=$row_happy_hour['BILLDESC'];
				$nor_price=$row_happy_hour['NOR_PRICE'];
				$spc_price=$row_happy_hour['SPC_PRICE'];
				
				$msg= " <h3  style='line-height: 20px'>ยินดีด้วยค่ะ คุณได้สั่งซื้อสินค้าในช่วง HAPPY HOUR  ";
			//	$msg .=" ในวันที่ ". $strdatetime.  " ".$strtime;
				$msg .= " คือ <b>". $billdesc ." จากราคาปกติ ". number_format($nor_price) . " บาท พิเศษเพียง ". number_format($spc_price) . ".- สุทธิ เท่านั้น </b> ";
				$msg .= "โดยสินค้าจะจัดส่งไปพร้อมกับออร์เดอร์ปกติของคุณ </h3>";
				$msg .="<center>** หากคุณต้องการยกเลิกสินค้าในช่วง HAPPY HOUR กรุณาโทรมาที่ 0-2917-0000  ต่อ 621 **</center>";
				echo $msg;		

			  ?>
              
              </td></tr></table>
	
<?php 	
}else{
		$k = 1;
			$str = "";
			$query ="Select * From  Order_happy_hour Where DIST='$dist' and mslno=$mslno and chkdgt=$chkdgt and camp=$campaign";
			$happy_hour2 = mysql_query($query, $bwc_orders) or die(mysql_error());
			while($row_happy_hour2 = mysql_fetch_array($happy_hour2)){
					$pro_id = $row_happy_hour2['BILLCODE'];
					$desc = $row_happy_hour2['BILLDESC'];
					$n_price = $row_happy_hour2['NOR_PRICE'];
				/*	$objConnect = odbc_connect("Promotiononweb2","","") or die("Error Connect to Database");
					$strSQL = "SELECT * FROM PromotionData WHERE BILLCODE ='".$pro_id."'";
					$objExec = odbc_exec($objConnect, $strSQL) or die ("Error Execute [".$strSQL."] : ".odbc_errormsg());
				//	print $strSQL."<br>";
			while($objResult = odbc_fetch_array($objExec)){
					$desc = $objResult['BILLDESC'];
					$n_price = $objResult['Normalprice'];
				}*/
					$str .=  "<tr bgcolor='#ffe8f1' class='line_bottom'><td>".$desc."</td><td>".$n_price."</td><td>".$row_happy_hour2['SPC_PRICE']."</td></tr>";

				$k++;
				}
	
	?>
	  <table width="692" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="206" height="111" align="center" valign="middle"><img src="images/yesbutton-addtocarthappy.jpg" width="150" height="111" /></td>
              <td width="486" align="left" valign="middle">
               <?
			print " <center><h3  style='line-height: 20px'>ยินดีด้วยค่ะ คุณได้สั่งซื้อสินค้าในกิจกรรมแซนดี้ท้าให้ทาย</h3></center> ";
			?>
			   <table width="500" border="1" align="center" cellpadding="1" cellspacing="0" class="FormBorder_3">
                  <tr class="content_header2"  style="background-image:url(image_icon/bg_cell.gif);background-position:top;background-repeat:repeat-x;font-weight:bold">
                  <th align="center">ชื่อสินค้า</th>
                  <th align="center">ราคาปกติ</th>
                  <th align="center">ราคาพิเศษ</th>
            </tr>
                  <?=$str;?>
                </table>
			<?
			print "<center><font size='-2'>** หากคุณต้องการยกเลิกสินค้าในกิจกรรมแซนดี้ท้าให้ทาย กรุณาโทรมาที่ 0-2917-0000  ต่อ 621 **</font></center>";
				//echo $msg;		
		  ?>
              </td></tr></table>
	<?
	}
	}
	?>          
          </td>
        </tr>
        <tr>
          <td>
            &nbsp;
            <input name="txtG_1" type="hidden" id="txtG_1" value="" size="10" />
            <input name="txtG_2" type="hidden" id="txtG_2" value="" size="10" />
            <input name="txtG_3" type="hidden" id="txtG_3" value="" size="10" />
            <input name="txtNormal_disc_1" type="hidden" id="txtNormal_disc_1" value="<?php echo $dsc_1 ?>" />
            <input name="txtNormal_disc_2" type="hidden" id="txtNormal_disc_2" value="<?php echo $dsc_2 ?>" />
            <input name="txtNormal_disc_3" type="hidden" id="txtNormal_disc_3" value="<?php echo $dsc_3 ?>" /></td>
        </tr>
        <tr>
          <td><font color="#FF0000"><strong>หมายเหตุ :</strong><br />
            </font>
            <li><font color="#FF0000">เมื่อมีการคีย์รหัสสินค้าท่านต้อง<strong>ยืนยันรายการสั่งซื้อทุกครั้ง</strong> ระบบจะทำการบันทึกรายการสินค้าและข้อมูลได้ที่เมนู <a href="order_summary.php" target="_self"><strong>สรุปรายการสั่งซื้อ</strong></a></font></li><font color="#FF0000">
            <li>รายการทั้งหมดยังไม่ได้เช็คเงื่อนไขการขาย/รายการสินค้าขาดสต็อค และยอดเงินยังไม่ได้หักส่วนลด</li>
			<li>คุณสามารถสั่งซื้อสินค้ามิสทิน,ฟรายเดย์,ฟาริสจากแคตตาล็อครอบจำหน่ายที่ <font color="#0000FF"><?php  echo  substr($campaign,4,2)."/".substr($campaign,0,4)  ?></font> และ <font color="#0000FF"><?php  echo  substr($nextCamp,4,2)."/".substr($nextCamp,0,4) ?></font> ในตารางแบบฟอร์มสั่งซื้อสินค้านี้ได้</li>
              <?php 
			  		if ($end_of_order!="") { echo "<li>สามารถแก้ไขและเพิ่มเติมรายการสั่งซื้อได้จนถึงวันที่  "; echo  "<font color= blue><b>". func_ConvertDateToString($end_of_order) ." เวลา  23.00 น. </b> </font>";"</li>";  }
				?>            
			<li>สินค้าจะจัดส่งถึงคุณประมาณวันที่ <font color="#0000FF"><b><?php  echo  func_ConvertDateToString($dlv_date);	?></b></font></li>

 </font></td>
        </tr>
      </table><center>
<input name="dist" type="hidden" id="dist" value="<?php echo $_SESSION['dist']; ?>" />
<input name="mslno" type="hidden" id="mslno" value="<?php echo $_SESSION['mslno']; ?>" />
<input name="chkdgt" type="hidden" id="chkdgt" value="<?php echo $_SESSION['chkdgt']; ?>" />
<input name="rep_name" type="hidden" id="rep_name" value="<?php echo $_SESSION['name']; ?>" />
<input name="email" type="hidden" id="email" value="<?php echo $_SESSION['email']; ?>" />
<input name="curcamp" type="hidden" id="curcamp" value="<?php echo $_SESSION['CurCamp']; ?>" />
<input name="hidva" type="hidden" id="hidva" value="false" />
<br />

<input type="button" name="button2" id="button2" value="กลับไปหน้าสรุปรายการสั่งซื้อ"  onclick="BackPage();" class="formbutton"/>
&nbsp;
<input type="button" name="button3" id="button3" value="คำนวนส่วนลด/มูลค่าผลิตภัณฑ์"  onclick="javascript: return check_discount();"  class="formbutton"/>
&nbsp;<br />
<br />
<input type="button" name="button" id="button" value="กดปุ่มนี้เพื่อยืนยันรายการสั่งซื้อสินค้า" onclick="javascript: return check_discount();"   class="formOrder"/>
&nbsp;<br /></center>

<div id="dialog_discount" title="Order Summary กรุณายืนยันรายการของท่านอีกครั้ง" >
<p>1.Order Summary  </p>
</div>
    </form>
 
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
<br />
<?php include("i_footer.php"); ?>
</body>
</html>
