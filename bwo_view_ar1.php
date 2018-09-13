<?php  
session_start(); 
require("i_config.php"); 
include("check_login.php");
require_once('Connections/bwc_orders.php'); 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><?php  echo $title?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />


<script type="text/javascript"> 
	function autoTabRepCode(obj){ 
	/* กำหนดรูปแบบข้อความโดยให้ _ แทนค่าอะไรก็ได้ แล้วตามด้วยเครื่องหมาย 
	หรือสัญลักษณ์ที่ใช้แบ่ง เช่นกำหนดเป็น รูปแบบเลขที่บัตรประชาชน 
	4-2215-54125-6-12 ก็สามารถกำหนดเป็น _-____-_____-_-__ 
	รูปแบบเบอร์โทรศัพท์ 08-4521-6521 กำหนดเป็น __-____-____ 
	หรือกำหนดเวลาเช่น 12:45:30 กำหนดเป็น __:__:__ 
	ตัวอย่างข้างล่างเป็นการกำหนดรูปแบบเลขบัตรประชาชน 
	*/ 
	var pattern=new String("___-_____-_"); // กำหนดรูปแบบในนี้ 
	var pattern_ex=new String("-"); // กำหนดสัญลักษณ์หรือเครื่องหมายที่ใช้แบ่งในนี้ 
	var returnText=new String(""); 
	var obj_l=obj.value.length; 
	var obj_l2=obj_l-1; 
	for(i=0;i<pattern.length;i++){ 
	if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){ 
	returnText+=obj.value+pattern_ex; 
	obj.value=returnText; 
	} 
	} 
	if(obj_l>=pattern.length){ 
	obj.value=obj.value.substr(0,pattern.length); 
	} 
	} 

</script> 
<script type="text/javascript">
	function clear_vlaue() {
    var mslno=	document.getElementById('mslno');
	var chkdgt=document.getElementById('chkdgt');
	var repname = document.getElementById('txtrep_name');
	//alert ('hhh'+mslno.value);
	//	  document.getElementById("mySpan").value = ""
	//  document.getElementById("mslno").value = ""
	//  document.getElementById("chkdgt").value = ""
	mslno.value="";
	chkdgt.value="";
	repname.value="";
	
	mslno.focus();
	}
	
	function form_submit(){
		//document.getElementById("progress").innerHTML = "Now is Loading...";
		//document.form1.submit()
		
		//var fra =  document.getElementById('fra_data');
		// 	frm.setAttribute('action','?doMode=Insert');		
			
		
		var frm  = document.getElementById('form1');
		var txtname  = document.getElementById('txtrep_name');
	
   		//if (txtname.value ==" " ) {
//			alert("กรุณาระบุชื่อสมาชิกใหม่อีกครั้งค่ะ ...");
//			frm.txtrep_name.value="";
//			frm.txtrep_name.focus();
//			return false;
//		}

//		if ( txtname.value=="" && frm.mslno.value=="") {
//			alert("กรุณากรอกรหัส หรือ ชื่อของสมาชิก !!")
//			frm.txtrep_name.focus();
//			return false;
//		}
				
		if (frm.mslno.value=="") {
			alert("กรุณากรอกรหัส แล้วกดปุ่มสอบถามข้อมูลคะ!!")
			frm.txtrep_name.focus();
			return false;
		}
		
		
		document.getElementById("doMode").value="Query";		
		frm.submit();
		
	}
</script>

</head>






<?php 
mysql_select_db($database_bwc_orders, $bwc_orders);
mysql_query("SET NAMES 'tis620'");
//mysql_query("SET NAMES 'utf8'");


$dist=$_SESSION['dist'];
$date = date("Ymd");
$query = "SELECT  MAILDATE,BILLDATE   from tbl015 WHERE DIST='$dist' AND BILLDATE >$date ORDER BY CAMP ASC  Limit 1";
$mailplan = mysql_query($query,$bwc_orders) or die(mysql_error());
$row_mailplan =mysql_fetch_assoc ($mailplan);
$total_row_mailplan = mysql_num_rows($mailplan);		
if ($total_row_mailplan >0 ) {
	$paydate=$row_mailplan['MAILDATE'];
}
else {
	$paydate="";
}
//echo "paydate = $paydate";

?>
<body>
<table border="0" align="center" cellpadding="0" cellspacing="0" width="900">
  <tr>
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
  </tr>
  <tr>
    <td class="Sheet_Boder">
<!--- Start Content hear -->    
     <?php 
		//if ($_SERVER['REQUEST_METHOD']="POST" && isset($_POST['doMode']) && $_POST['doMode']=="Query") {
		
			//$dist= $_POST['dist'];
			//$mslno=$_POST['mslno'];
			//$chkdgt=$_POST['chkdgt'];
			$rep_name = $_POST['txtrep_name'];
			
			$sel_camp=$_POST['sel_camp'];
			$sel_order_by = $_POST['sel_order_by'];
			$sel_asc = $_POST['sel_asc'];
			
			$dist=$_SESSION['dist'];
            $mslno=$_SESSION['mslno']; 
			$chkdgt=$_SESSION['chkdgt'];
			if ($dist=="") {
				echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
			}
			include("i_WebService_config.php");
			$DataToSend="dist=$dist&mslno=$mslno&chkdgt=$chkdgt&rep_name=$rep_name";
		 
			
			//$postUrl=$url_webservice."/asp_Get_RepInfo.asp"  . "?".$DataToSend;
			
			$rep_code=$dist. substr("00000".$mslno,-5).$chkdgt;

			
			if (strlen($dist)==4) {
			
				$postUrl=$url_webservice."/bsmart_dsm_order_view_ar_newuser.php" . "?rep_code=".$rep_code;
			//}
			//else{
			//$postUrl=$url_webservice."/asp_Get_RepInfo.asp"  . "?".$DataToSend;
			}
	//echo $postUrl;
		//}
		/*elseif ($_SERVER['REQUEST_METHOD']="POST" && isset($_POST['doMode']) && $_POST['doMode']=="Reset") {
			
			$mslno="";
			$chkdgt="";
			$rep_name ="";
			$sel_camp="";
			$postUrl="";
		}*/
			
		mysql_close($bwc_orders);

  ?>
    <form id="form1" name="form1" method="post" action="">
      <table width="800" border="0" cellpadding="0" cellspacing="0" align="center">
        <tr>
          <td>
            <?php 
			                
            if ($maintenance=="yes") {   // กำหนดค่าจากไฟล์ i_config.php
			  		echo "<br><br><br><center>$maintenance_msg</center>";
			  }
			  else { 
  ?>
            
            
            <!--<table width="100%" border="0" cellspacing="0" cellpadding="0" >
              <tr align="center">
                <td width="493">
                  <br/>
                  <table width="600" border="0" cellspacing="0" >
                    <tr>
                      <td width="159" align="right">รหัสสมาชิก</td>
                      <td width="197" align="left"><input name="txtdist2" type="text" disabled="disabled" id="txtdist2" value="<?php echo $_SESSION['dist']; ?>" size="4" maxlength="4" />
                        -                    
                        <input name="mslno" type="text" id="mslno" 
                      onkeyup="javascript:if(this.value.length==5){chkdgt.focus()}" 
                      onkeydown="javascript: if (event.keyCode == 13){chkdgt.focus();}"
                      value="<?php echo $mslno ?>"   size="8" maxlength="5" readonly="readonly" />
                        -
                        <input name="chkdgt" type="text" id="chkdgt" value="<?php echo $chkdgt ?>" size="2" maxlength="1" readonly="readonly"
                      onkeydown="javascript:if(event.keyCode==13){javascript:Get_RepInfo();}"
                      />
                        <input name="dist" type="hidden" id="dist" value="<?php echo $_SESSION['dist']; ?>" /></td>
                      <td width="238" align="left"> <!--<input type="button" name="button2" id="button2" value="Reset"  onclick="clear_vlaue();" class="formbutton"/>
                        <input type="button" name="Button" id="button" value="กดเพื่อแสดงข้อมูล" onclick="javascript:form_submit();" class="formbutton"/>
                        <input name="doMode" type="hidden" id="doMode" value="View A/R" />
                        <input name="paydate" type="hidden" id="paydate" value="<?php  echo $paydate;?>" /></td>
                      </tr>
                    <tr>
                      <td align="right"></td>
                      <td colspan="2" align="left"><input name="txtrep_name" type="text" id="txtrep_name" value="<?php echo $_SESSION['rep_name']; ?> " 
                    size="48" maxlength="100" style="display:none"/>
                      ..</td>
                      </tr>
                  
                  </table></td>
                </tr>
              <tr>
                <td height="2" colspan="2" align="center">
                  
                  
                  </td>
                </tr>
              </table>   -->       
  <?php  }?>            
</td>
          
        </tr>
        <tr>
          <td height="400" valign="top">
          <iframe id="id2" fra_data="fra_data"  frameborder="0" width="100%" height="100%" src="<?php  echo $postUrl; ?>"> </iframe>
          </td>
          
        </tr>
      </table>
    </form>
    <!-- End of  Content -->    
    </td>
  </tr>
  </table>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0" >
  
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

</table>
<blockquote><?php require "i_footer.php";?>&nbsp;</blockquote>

</body>
</html>


