<?php  session_start(); ?>
<?php require("i_config.php"); ?>
<?php require("i_function_msg.php"); ?>
<?php require("check_login.php"); ?>
<?php require_once('Connections/bwc_orders.php'); ?>

<?php 
 //####################################################################################
if ($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['doMode']) && $_POST['doMode']=="New" ) {
//####################################################################################	
	$dist=$_POST['dist'];
	$mslno=$_POST['mslno'];
	$chkdgt=$_POST['chkdgt'];
	$rep_name=$_POST['rep_name'];
	$campaign=$_POST['sel_camp'];	
	$flag="INSERT";
	$totalItems=15;
	if ($dist=="" || $mslno=="" || $chkdgt=="") {
		echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
	}

	mysql_select_db($database_bwc_orders, $bwc_orders);
	//mysql_query("SET NAMES 'utf8'");
	mysql_query("SET NAMES 'tis620'");
	
	$query ="Select * From  Order_Header Where DIST='$dist' and mslno=$mslno and chkdgt=$chkdgt 
					and ordcamp=$campaign and dwnflag='N' and delflag='N'";
					
					
	$order = mysql_query($query, $bwc_orders) or die(mysql_error());
	$row_order = mysql_fetch_assoc($order);
	$totalRows_order = mysql_num_rows($order);		
	if ($totalRows_order >0 ) {
		$strcamp = substr($campaign,4,2)."/".substr($campaign,0,4);
		$strpo  =  substr("000000".$row_order['ORDER_NO'],-6);
		$strmsg="คุณมีรายการสั่งซื้อสินค้าในรอบจำหน่าย $strcamp  ในใบสั่งซื้อเลขที่  $strcamp-$strpo  กรุณาคลิกปุ่ม OK เพื่อย้อนกลับไปแก้ไข";
		AlertMessage("$strmsg","javascript:history.back();");
		exit;
	}
	
}
//####################################################################################
else if ($_SERVER['REQUEST_METHOD']=="GET" && $_GET['doMode']=="Edit") {
//####################################################################################

	$flag="UPDATE";
	$no=$_GET['po'];
	$rep_code=$_GET['id'];
	$dist=substr($rep_code,0,3);
	$mslno=substr($rep_code,3,5);
	$chkdgt=substr($rep_code,8,1);
	$campaign=$_GET['camp'];
	$rep_name=$_SESSION['name'];

	
	
	if ($dist=="" || $mslno=="" || $chkdgt=="") {
		echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
	}
	
	if ($campaign=="") {
		echo "<meta http-equiv='refresh' content='0;URL=order_summary.php'>";
	}

	mysql_select_db($database_bwc_orders, $bwc_orders);
	//mysql_query("SET NAMES 'utf8'");
	mysql_query("SET NAMES 'tis620'");
	$query="SELECT * FROM ORDER_HEADER WHERE  DELFLAG='N' AND  DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt AND ORDER_NO = $no AND ORDCAMP=$campaign ";
	$order_header = mysql_query($query, $bwc_orders) or die(mysql_error());
	$row_order_header = mysql_fetch_assoc($order_header);
	$totalRows_order_header = mysql_num_rows($order_header);		
	
	if ($totalRows_order_header ==0 ) {
		$strcamp = substr($campaign,4,2)."/".substr($campaign,0,4);
		$strpo  =  substr("000000".$no,-6);
		$strmsg="เกิดข้อผิดพลาด !!!  ไม่สามารถแสดงข้อมูลการสั่งซื้อ ใบสั่งซื้อเลขที่  $strcamp-$strpo  กรุณาคลิกปุ่ม OK เพื่อย้อนกลับไปแก้ไข";
		AlertMessage("$strmsg","javascript:history.back();");
		exit;
	}	
		
	$query="SELECT * FROM ORDER_DETAIL WHERE  DELFLAG='N' AND DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt AND ORDER_NO = $no AND ORDCAMP=$campaign";
	$order_detail =mysql_query($query,$bwc_orders) or die(mysql_error());
	$row_order_detail  = mysql_fetch_assoc($order_detail);
	$num_rows_order_detail = mysql_num_rows($order_detail);

	$strcamp = substr($campaign,4,2)."/".substr($campaign,0,4);
	$strpo  =  substr("000000".$row_order_header['ORDER_NO'],-6);
	$totalItems =$num_rows_order_detail;
	
	//Binding Data 
	
	$arr_billcode = array("");
	$arr_qty = array("");	
	$arr_billdesc=array("");
	$arr_price =array("");
	$arr_amount=array("");
	$totalAmount=0;
	do {
			array_push($arr_billcode ,$row_order_detail['BILLCODE'] );
			array_push($arr_qty ,$row_order_detail['QTY'] );
			array_push($arr_billdesc ,$row_order_detail['BILLDESC'] );
			array_push($arr_price ,$row_order_detail['PRICE'] );		
			array_push($arr_amount ,$row_order_detail['AMOUNT'] );				
			$totalAmount= $totalAmount +$row_order_detail['AMOUNT'] ;		
	} while  ($row_order_detail  = mysql_fetch_assoc($order_detail)); 
	


	if ($totalItems<15) { 
		$totalItems=15;
	} 
	else {
		$totalItems=$totalItems+5;
	}
	
	
	
}
//####################################################################################
else if  ($_SERVER['REQUEST_METHOD']=="POST" && $_POST['doMode']=="Order") {
//####################################################################################	
	echo "\tสั่งซื้อสินค้า";
	exit;
}
//####################################################################################
else if ($_SERVER['REQUEST_METHOD']=="POST" && $_POST['doMode']=="Save Order") {
//####################################################################################	

if  (isset($_POST['flag']) && $_POST['flag']=="" || $_POST['flag']=="INSERT") {
		require("order_insert.php"); 
	} 
	elseif (isset($_POST['flag']) && $_POST['flag']=="UPDATE") {
		require("order_update.php"); 										   
	}
	
	exit;
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
	$arr_amount=array("");
	
	$totalAmount=0;
	for ($i=1;$i<=$totalItems;$i++){
		if ($_POST['chk_'.$i]!=$i  ) {
			if ($_POST['txtcode_'.$i]!="") {
				array_push($arr_billcode ,$_POST['txtcode_'.$i] );
				array_push($arr_qty ,$_POST['txtqty_'.$i] );
				array_push($arr_billdesc ,$_POST['txtdesc_'.$i] );
				array_push($arr_price ,$_POST['txtprice_'.$i] );		
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
	$arr_amount=array("");
	$totalAmount=0;
	for ($i=1;$i<=$totalItems;$i++){
		if ($_POST['txtcode_'.$i]!="") {
			array_push($arr_billcode ,$_POST['txtcode_'.$i] );
			array_push($arr_qty ,$_POST['txtqty_'.$i] );
			array_push($arr_billdesc ,$_POST['txtdesc_'.$i] );
			array_push($arr_price ,$_POST['txtprice_'.$i] );		
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

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><?php  echo $title?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="Scripts/NumberFormat154.js"></script>
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
//-->
</script>

<script language="JavaScript" >
	   var HttPRequest = false;
		
	   function doCallAjax(seqno,fCampCode) {

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
		    var url = 'Ajax_GetFill.php';
			var txtcode= document.getElementById('txtcode_'+seqno);
			var txtdesc =document.getElementById('txtdesc_'+seqno);
			var txtqty=document.getElementById("txtqty_"+seqno);
			var txtprice=document.getElementById('txtprice_'+seqno);
			var txtamount=document.getElementById('txtamount_'+seqno);
			var totseq=document.getElementById('TotalItems');
			
			// *** Check Duuplicate *** //
			 for ( i=1 ;i<=totseq.value;i++) {	
			 //	alert( document.getElementById('txtcode'+i).value + '  ' + document.getElementById('txtcode'+seqno).value);
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
					var myProduct = HttPRequest.responseText;
					//document.getElementById('disp_desc_'+seqno).value= myProduct;
					
					var myArr = myProduct.split("|");
					//alert (myArr[0] +' : ' +myArr[1]);
					if(myArr[0] != "")
					{
						
						var  price= new NumberFormat(parseFloat(myArr[1]));
						price.setPlaces(0);  //จำนวน ทศนิยม
						price.setSeparators(true); // ใส่ คอมม่า คั่น หลัก พัน
							  
					    //txtdesc.value=myArr[0];
						//txtprice.value=myArr[1];
						document.getElementById('disp_desc_'+seqno).value=myArr[0];  // description
						document.getElementById('disp_price_'+seqno).value=price.toFormatted(); // price
						document.getElementById('disp_amount_'+seqno).value="0"; // amount

						document.getElementById('txtdesc_'+seqno).value=myArr[0];  // description
						//document.getElementById('txtprice_'+seqno).value=price.toFormatted(); // price
						document.getElementById('txtprice_'+seqno).value=myArr[1]; // price
						document.getElementById('txtamount_'+seqno).value="0"; // amount
					
						
						//alert (myArr[0] +' : ' +myArr[1]);
						return true;
					} 
					else{
						
						document.getElementById('disp_desc_'+seqno).value="";
						document.getElementById('disp_price_'+seqno).value="0";
						document.getElementById('disp_amount_'+seqno).value="0"; // amount						
						return true;
					}
				}
				
			}
		
	   }
	   
//#################################################################################	   

		function cal_amount (seqno,totseq,tar_obj) 
		{
			 if (event.keyCode == 13){
				 
					var txtqty=document.getElementById("txtqty_"+seqno);
					var txtprice=document.getElementById("txtprice_"+seqno);
					var tot_amount=0;
					var i;
					var strnum;
					
					var num = parseFloat(txtqty.value )* parseFloat(txtprice.value);
					var objnum = new NumberFormat(parseFloat(num));
				
					objnum.setPlaces(0);  //จำนวน ทศนิยม
					objnum.setSeparators(true); // ใส่ คอมม่า คั่น หลัก พัน
					strnum = objnum.toFormatted();
					document.getElementById("disp_amount_"+seqno).value =  num;
					document.getElementById("txtamount_"+seqno).value =  num;
				
					 for ( i=1 ;i<=totseq;i++) {	
							var billcode =document.getElementById('txtcode_'+i);
							var txtamount=document.getElementById('disp_amount_'+i);
							 if( billcode.value != "" ) {
								 if ( IsNumeric(txtamount.value)) {
									 tot_amount= parseFloat(tot_amount)  +parseFloat( txtamount.value);
									 //parseFloat( txtamount.value) 
								}
					  
							}
						}
						var totnum = new NumberFormat(parseFloat(tot_amount));
						totnum.setPlaces(0);  //จำนวน ทศนิยม
						totnum.setSeparators(true); // ใส่ คอมม่า คั่น หลัก พัน
						document.getElementById("disp_total_amount").value = totnum.toFormatted();				
						document.getElementById("txtTotalAmount").value =tot_amount;
						
						var obj=document.getElementById(tar_obj);
						if (obj){
							obj.focus();
						}
			}
		}
		

	   function  form_submit()
	   {
		   var frm  = document.getElementById('form_order');
			var i=1;
			var j=0;
			var totalitems =  frm.TotalItems.value;
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
					  
				 }
				 if (billcode.value!="" && billunit!="") {
					 j=j+1;
				 }
			 }
			
			if (j==0) {
				alert("กรุณากรอกรหัสสินค้า ที่คุณต้องการสั่งซื้อด้วยค่ะ");
				return false;
			}
			
			//alert ("OK");
			if (document.getElementById('flag').value=="UPDATE" ) {
			//	frm.setAttribute('action','order_update.asp');
				//alert("UPDATE")
				//return false;
				}
			else
			{
				//alert( document.getElementById('flag').value);
				//return false;
				//frm.setAttribute('action','order_insert.asp');				
			}
					 
			document.getElementById("doMode").value="Save Order";		
			frm.submit();
			return true;
	   }
	   
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
    <td class="Sheet_Boder"  ><?php include("i_header.php"); ?>
</td>
  </tr>
  <tr>
    <td height="480" align="left" valign="top" class="Sheet_Boder" style="padding:2px"><form id="form_order" name="form_order" method="post" action="">
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
                <td width="12%" align="right">รหัสสมาชิก : </td>
                <td width="44%"><? printf("%s-%s-%s ",$_SESSION['dist'],$_SESSION['mslno'],$_SESSION['chkdgt']); ?></td>
                <td width="19%" align="right">เลขที่รายการสั่งซื้อ :</td>
                <td width="25%"><?php   if ($flag=="UPDATE") {echo $strcamp ."-".$strpo;  }else { echo "[ AUTO ]"; }?> <input name="flag" type="hidden" id="flag" value="<? echo $flag ?>" />
                  <input name="order_no" type="hidden" id="order_no" value="<? echo $po; ?>" /></td>
              </tr>
              <tr>
                <td align="right">ชื่อสมาชิก : </td>
                <td><?php echo $_SESSION['name'];?>&nbsp;</td>
                <td align="right">รอบจำหน่ายที่สั่งซื้อ : </td>
                <td><?php   echo  substr($campaign,4,2)."/".substr($campaign,0,4); ?>&nbsp;
                  <input name="campaign" type="hidden" id="campaign" value="<? echo $campaign; ?>" /></td>
              </tr>
              <tr>
                <td height="20" align="right">อีเมลล์ : </td>
                <td><? echo $_SESSION['email']; ?>&nbsp;</td>
                <td align="right">วันที่สั่งซื้อ : </td>
                <td><?php  echo  date('d/m/Y G:i:00'); ?>&nbsp;</td>
              </tr>
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
          <td width="20" align="center" nowrap="nowrap" >&nbsp;</td>
          <td width="30" height="23" align="center" nowrap="nowrap"><strong>ลำดับ</strong></td>
          <td width="61" align="left" ><strong>รหัสสินค้า</strong></td>
          <td width="35" align="left" nowrap="nowrap"><strong>จำนวน</strong></td>
          <td width="330" align="left" ><strong>ชื่อสินค้า</strong></td>
          <td width="64" align="center"><strong>ราคา/หน่วย</strong></td>
          <td width="62" align="center" ><strong>ราคารวม</strong></td>
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
        <tr bgcolor="#F2FAF5" class="line_bottom">
          <td align="center"><input name="<? echo "chk_$i"; ?>" type="checkbox" id="<? echo "chk_$i"; ?>" value="<? echo $i ?>" /></td>
          <td align="center"><? echo "$i." ?></td>
          <td align="left"><input name="<? echo "txtcode_$i";?>" type="text" id="<? echo "txtcode_$i";?>" onchange="return doCallAjax(<? echo $i;?>,'<? echo $campaign;?>' )"  onkeydown="setNextFocus('<?php  echo "txtqty_$i"; ?>');" value="<? echo  $arr_billcode[$i];?>" size="10" maxlength="5" /></td>
          <td align="left">
          <input name="<? echo "txtqty_$i";?>" 
          type="text" id="<? echo "txtqty_$i";?>" 
          onkeydown="cal_amount(<? echo $i ; ?>,<?php echo $totalItems; ?>,'<?php  echo $next_obj; ?>') "   
          value="<? echo  $arr_qty[$i];?>" size="5" maxlength="4"/></td>
          <td align="left"><input name="<? echo "disp_desc_$i"; ?>" type="text" disabled="disabled" id="<? echo "disp_desc_$i";?>" value="<? echo  $arr_billdesc[$i];?>" size="73" maxlength="100"  />
            <input name="<? echo "txtdesc_$i"; ?>" type="hidden" id="<? echo "txtdesc_$i"; ?>" value="<? echo  $arr_billdesc[$i];?>" /></td>
          <td align="center"><input name="<? echo "disp_price_$i"; ?>" type="text" disabled="disabled" id="<? echo "disp_price_$i"; ?>" style=" text-align:right" value="<? echo  $arr_price[$i];?>" size="8" />
            <input name="<?echo "txtprice_$i" ?>" type="hidden" id="<?echo "txtprice_$i" ?>" value="<? echo  $arr_price[$i];?>" /></td>
          <td align="center"><input name="<? echo "disp_amount_$i";?>" type="text" disabled="disabled" id="<? echo "disp_amount_$i";?>" style="text-align:right" value="<? echo  $arr_amount[$i];?>" size="8" />
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
              <td width="544"><input type="button" name="but_Del" id="but_Del" value="ลบรายการที่เลือก"  onclick="javascript:form_RemoveRows();"/>
                <input type="hidden" name="doMode" id="doMode" /></td>
              <td width="94" align="right"><strong>มูลค่ารวม</strong></td>
              <td width="68" align="center"><input name="disp_total_amount" type="text" disabled="disabled" id="disp_total_amount"  style="text-align:right" value="<? echo  $totalAmount;?>" size="8"/>
                <input name="txtTotalAmount" type="hidden" id="txtTotalAmount" value="<? echo  $totalAmount;?>" /></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td>เพิ่มจำนวนรายการสั่งซื้อสินค้า
            <input name="txtrows" type="text" id="txtrows" value="1" size="5" maxlength="4" />
            <input type="button" name="Submit2" id="Submit2" value="เพิ่มช่องรายการสั่งซื้อสินค้า" onclick="javascript:form_AddRows();" />
            <input name="TotalItems" type="hidden" id="TotalItems" value="<? echo $totalItems;?>" /></td>
        </tr>
        <tr>
          <td><font color="#FF0000"><strong>หมายเหตุ :</strong><br />
              <li>รายการทั้งหมดยังไม่ได้เช็คเงื่อนไขการขาย/รายการสินค้าขาดสต็อค และยอดเงินยังไม่ได้หักส่วนลด</li>
          </font></td>
        </tr>
      </table>
      <br /><center>
<input name="dist" type="hidden" id="dist" value="<?php echo $_SESSION['dist']; ?>" />
<input name="mslno" type="hidden" id="mslno" value="<?php echo $_SESSION['mslno']; ?>" />
<input name="chkdgt" type="hidden" id="chkdgt" value="<?php echo $_SESSION['chkdgt']; ?>" />
<input name="rep_name" type="hidden" id="rep_name" value="<?php echo $_SESSION['name']; ?>" />
<input name="email" type="hidden" id="email" value="<?php echo $_SESSION['email']; ?>" />
<input name="curcamp" type="hidden" id="curcamp" value="<?php echo $_SESSION['CurCamp']; ?>" />
<br />
<br />
<!--<input type="button" name="button" id="button" value="&lt;&lt; ยกเลิกรายการสั่งซื้อ" onclick="javascript:window.location='order_summary.php';" />-->
<input type="button" name="button" id="button" value="ยืนยันการสั่งซื้อ &gt;&gt;"  onclick="javascript:form_submit();"/>
<br /></center>
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
<br /><?php include("i_footer.php"); ?>
</body>
</html>