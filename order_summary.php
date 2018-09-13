<?php
session_start(); 
ob_start();
require_once('check_login.php');


require_once('include/i_config.php'); 
require_once('Connections/bwc_orders.php'); 
require_once('Connections/bwc_webboard.php'); 
require_once('include/functionphp.inc');
$GOLDCLUB=$_SESSION["GOLDCLUB"];

	//require_once('Connections/bwc_log.php');
	//require("order_update.php"); 
?>
<?php require("i_function_msg.php"); ?>
<?php
  function func_ConvertDateToString($iDate) {
			$yy=substr($iDate,0,4);
			$mm=substr($iDate,4,2);
			$dd=substr($iDate,6,2);
		//	$time=substr($time,0,2).":".substr($time,2,2).":".substr($time,4,2);
			return $dd."/".$mm."/".$yy;
  }
?>

<?php
 date_default_timezone_set('Asia/Bangkok');  
$dist=$_SESSION['dist'];
$mslno=$_SESSION['mslno'];
$chkdgt=$_SESSION['chkdgt'];
$name=$_SESSION['name'];
$rep_seq=$_SESSION['rep_seq'];
$GOLDCLUB=$_SESSION["GOLDCLUB"];
$orddate=date('Ymd');

if ($dist=="" || $mslno=="" || $chkdgt=="") {
	echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
}

mysql_select_db($database_bwc_orders, $bwc_orders);

if($dist == "0999")
{
   $query_order = "SELECT ORDER_NO, ORDCAMP, ORDDATE, ORDTIME, ITEMS, NAME, TOTAL_AMOUNT, BILLDATE, SHIPDATE, DLVDATE, DWNDATE, DWNFLAG, DP_DOWNLOAD FROM order_header   WHERE DWNFLAG='N' AND DELFLAG='N' AND  DIST='$dist' and MSLNO='$mslno' AND CHKDGT='$chkdgt' ORDER BY ORDCAMP,ORDER_NO";   

}
else
{
  $query_order = "SELECT  DIST,MSLNO,CHKDGT,ORDER_NO,rep_seq, ORDCAMP, ORDDATE, ORDTIME, ITEMS, NAME, TOTAL_AMOUNT, BILLDATE, SHIPDATE, DLVDATE, DWNDATE, DWNFLAG, DP_DOWNLOAD FROM order_header WHERE DWNFLAG='N' AND DELFLAG='N' AND  DIST='$dist' and MSLNO='$mslno' AND CHKDGT='$chkdgt' and rep_seq is not null   ORDER BY ORDCAMP,ORDER_NO";
  //rep_seq='$rep_seq'  
}

$order = mysql_query($query_order, $bwc_orders) or die(mysql_error());
$row_order = mysql_fetch_assoc($order);
$totalRows_order = mysql_num_rows($order);
 //echo $query_order;
//echo "aaarow  ".$row_order;
//echo "bbbtotalrow  ".$totalRows_order;
//exit;

//echo $query_order;
// Query Current by Dist
mysql_select_db($database_bwc_orders, $bwc_orders);
$query="SELECT * FROM TBL015 WHERE DIST = '$dist' AND SHIPDATE >=$orddate  LIMIT 1";
//echo $query;

$tbl015=mysql_query($query,$bwc_orders) or die(mysql_error());
$row_tbl015=mysql_fetch_assoc($tbl015);
$total_row_tbl015 = mysql_num_rows($tbl015);

if ($total_row_tbl015==0) {
	$query_campaign = "SELECT CAMP FROM TBL008 WHERE STATUS IN ('Current') ORDER BY CAMP";
	$tblcampaign = mysql_query($query_campaign, $bwc_orders) or die(mysql_error());
	$row_tblcampaign = mysql_fetch_assoc($tblcampaign);
	$totalRows_tblcampaign = mysql_num_rows($tblcampaign);
	$currentCamp=$row_tblcampaign['CAMP'];
	$orderCamp=$row_tblcampaign['CAMP'];
}
else {
	$currentCamp=$row_tbl015['CAMP'];
	$orderCamp=$row_tbl015['CAMP'];
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><?php  echo $title?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>

<script language="JavaScript" type="text/JavaScript"> 
 
	function MM_openBrWindow(theURL,winName,w,h,scrollbars) 
	{ 
	  LeftPosition=(screen.width)?(screen.width-w)/2:100;
	  TopPosition=(screen.height)?(screen.height-h)/2:100;
	  
	  settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scrollbars+',location=no,directories=no,status=0,menubar=no,toolbar=no,resizable=yes';
	  URL = theURL;
	  window.open(URL,winName,settings);
	}

	function confirmDelete(url,pno) {
		if (confirm("คุณต้องการยกเลิกรายการสั่งซื้อสินค้า " + pno +" ใช่หรือไม่ ?")) {
			document.location = url;
			//return true ;
		}
	}
	function confirmEdit(url,pno) {
		if (confirm("คุณต้องเพิ่มเติม / การแก้ไขรายการสั่งซื้อสินค้า " + pno +" ใช่หรือไม่ ?")) {
			document.location = url;
			//return true ;
		}
	}	
		
</script>

</head>

<body>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0" >
  <?php require_once('include/i_header_border.php'); ?>
  <?php require_once('include/i_header.php'); ?>
  <tr>
    <td height="364" align="left" valign="top" class="Sheet_Boder" style="padding:2px"><table 
                  width="709" height="58" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
      <tbody>
        <tr>
          <td height="5"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_01.gif" 
                        width="5" /></td>
          <td width="700"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_02.gif" 
                        width="780" /></td>
          <td width="10"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_03.gif" 
                        width="5" /></td>
        </tr>
        <tr>
          <td valign="top" width="5" 
                      background="Images/Box_Set3/frame_04.gif" 
                      height="45"><img height="2" alt="" 
                        src="Images/Box_Set3/frame_04.gif" 
                        width="5" /></td>
          <td valign="top" bgcolor="#ffffff"><table width="100%" border="0" cellspacing="1" cellpadding="2">
            <tr>
              <td width="13%" align="right">รหัสสมาชิก : </td>
              <td width="43%"><?php  printf("%s-%s-%s ",$_SESSION['dist'],$_SESSION['mslno'],$_SESSION['chkdgt']); ?>
           </td>
              <td width="19%" align="right">วันที่/เวลา :</td>
              <td width="25%"><?php  echo  date('d/m/Y G:i:00'); ?>&nbsp;&nbsp;</td>
            </tr>
            <tr>
              <td align="right">ชื่อสมาชิก : </td>
              <td><?php echo $_SESSION['name'];?>&nbsp;</td>
              <td align="right">อีเมลล์ : </td>
              <td><?php  echo $_SESSION['email']; ?></td>
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
                        width="780" /></td>
          <td><img height="5" alt="" 
                        src="Images/Box_Set3/frame_09.gif" 
                        width="5" /></td>
        </tr>
      </tbody>
    </table>
      <?php
	
if ($totalRows_order>0) {
	

?>

    <table width="800" border="0" align="center" cellpadding="3" cellspacing="0">

       <tr>
        <td width="787" height="50" style="text-align: center;"><strong style="color:#F00">
		<input name="ORDER_FLAG" type="hidden"  value="<?=$ORDER_FLAG?>"/>
		รายการสั่งซื้อสินค้าที่ยังไม่ถูกดาวน์โหลด ท่านสมาชิกสามารถเช็ครายละเอียด เปลี่ยนแปลงแก้ไขเพิ่มเติม ได้ที่นี่</strong></td>
      </tr>
      <tr>
        <td>
        

        
        <table width="794" border="0" cellpadding="3" cellspacing="1" class="FormBorder_3">
          <tr bgcolor="#EC008C">
            <td width="32" height="47" align="center" style="border-bottom: solid #006633 1px; border-top: solid #006633 1px"><strong class="content_header">ลำดับ</strong></td>
            <td width="73" align="center" style="border-bottom: solid #006633 1px; border-top: solid #006633 1px"><strong class="content_header">รอบจำหน่าย</strong></td>
            <td width="160" align="center" style="border-bottom: solid #006633 1px; border-top: solid #006633 1px"><strong class="content_header">วันที่สั่งซื้อ</strong></td>
            <td width="103" align="center" style="border-bottom: solid #006633 1px; border-top: solid #006633 1px"><strong class="content_header">เลขที่ใบสั่งซื้อ</strong></td>
            <td width="88" align="center" style="border-bottom: solid #006633 1px; border-top: solid #006633 1px"><strong class="content_header">จำนวนรายการ</strong></td>
            <td width="122" align="center" style="border-bottom: solid #006633 1px; border-top: solid #006633 1px">
			<span class="content_header"><strong>สามารถแก้ไข<br />จนถึงวันที่</strong></span></td>
            <td width="172" style="border-bottom: solid #006633 1px; border-top: solid #006633 1px">&nbsp;</td>
          </tr>
<?php  
	  $i=1;
	  
  do { 
	  		
//			echo $row_order['ORDER_NO'];

			$statusStr = "";
			//AlertMessage("คุณยังไม่ได้สร้างการสั่งซื้อคะ","javascript:window.close();");
			//echo "คุณยังไม่ได้สร้างการสั่งซื้อคะ";
			
			if ( $row_order['DWNFLAG']=="N" ) {
				$statusStr="สามารถสั่งซื้อเพิ่มเติมได้";
			}
			elseif($row_order['DWNFLAG']=="Y") {
				$statusStr ="ไม่สามารถสั่งซื้อเพิ่มเติมได้";
			}
			else {
				$statusStr="";
			}
			
			$campaign =substr($row_order['ORDCAMP'],4,2) ."/".substr($row_order['ORDCAMP'],0,4);
           // $rep_seq=$row_order['rep_seq'];
			$DIST=$row_order['DIST'];
			$MSLNO=$row_order['MSLNO'];
			//$MSLNO = str_pad($MSLNO,5, "0", STR_PAD_LEFT); 
			$CHKDGT=$row_order['CHKDGT'];
           // echo $MSLNO."dist";     
			$p_no=$campaign."-".substr("000000".$row_order['ORDER_NO'],-6);
			$script_link ="po=".$row_order['ORDER_NO']."&id=$dist$mslno$chkdgt&rep_seq=$rep_seq" ."&camp=".$row_order['ORDCAMP'];
                        
                                             
                                           $script_link = "id=$dist$mslno$chkdgt&rep_seq=$rep_seq&camp=" . $row_order['ORDCAMP'] . "&po=" . $row_order['ORDER_NO'] . "&rep_name=" . $row_order['NAME'] . "&dist=" . $dist . "&mslno=" . $mslno . "&chkdgt=" . $chkdgt;
                        
                                  
											  
											                                        
                                                   $rep_code = $dist.$mslno.$chkdgt;
                                                   $rep_name=$row_order['name'];
                                                   $script_link = "Internetorder?doMode=Edit"."&rep_seq=$rep_seq&camp=".$row_order['ORDCAMP'] ."&id=".$rep_code."&rep_name=".$rep_name."&po=".$row_order['ORDER_NO'] ."&dist=".$dist."&mslno=".$mslno."&chkdgt=".$chkdgt;
                                              //  }
                        
                        
			$date=$row_order['ORDDATE'];
			$time=$row_order['ORDTIME'];
			$yy=substr($date,0,4);$mm=substr($date,4,2);$dd=substr($date,6,2);
			$time=substr($time,0,2).":".substr($time,2,2).":".substr($time,4,2);
			$dateT=$dd."/".$mm."/".$yy." ".$time;
			$dwn_date = $row_order['DWNDATE'];
			
			/*if ($dwn_date==0){
				$dwn_date = date('Ymd');
				}*/

			
			$fmt_date = substr($dwn_date,0,4).'-'.substr($dwn_date,4,2).'-'.substr($dwn_date,6,2);
				//echo "xxx".$fmt_date;
			$adate = date($fmt_date); 
			$end_of_order=date("Ymd",strtotime("-1 days",strtotime($adate)));
	
			if (fmod($i, 2)==0){
				$bg="#ffc5db";
			}
			else {
				$bg="#FFF4FA";
			}
		
?>     
          <tr  bgcolor="<?php  echo $bg; ?>">
            <td align="center" valign="top"><?php  echo $i; ?></td>
            <td align="center" valign="top"><?php echo $campaign; ?></td>
            <td align="center" valign="top"><?php echo $dateT; ?></td>
            <td align="center" valign="top"><?php echo $p_no ?></td>
            <td align="center" valign="top"><?php echo $row_order['ITEMS']; ?></td>
            <td align="center" valign="top">
			
			
			

			<?php if ($end_of_order!="19691231") 
			{
			     if ($GOLDCLUB == 'GC1')
				 {
				    $GOLDCLUB_ = "Gold Club";
					//echo "<strike>";
					echo func_ConvertDateToString($end_of_order);
					//echo "</strike>";
				?>
				 <br>
				 <span style="color: rgb(255, 0, 0);"><?=$GOLDCLUB_?></span>
				<?php
				  }
				  else
				  {
				  
				   echo func_ConvertDateToString($end_of_order);
				  }
				?>
			<?php	 
			
			}    ?>
	
            </td>
            <td valign="top"><li><a href="javascript: MM_openBrWindow('order_view.php?<?php  echo $script_link;?>','', 790, 550,'yes');">ดูรายการสั่งซื้อสินค้า</a></li>
            <?php if ($row_order['DWNFLAG']=="N") { ?>
                       <?php if ($dist=="0999") { ?>                
                               <li><a href="#" onclick="javascript:confirmEdit('<?php  echo $script_link ; ?>','<?php   echo $p_no; ?>');" >เพิ่มเติม/แก้ไขรายการสั่งซื้อ </a></li>                                           
                      <?php }  ?> 
                             
                     <?php if ($dist  <> "0999") { ?>
                              <li><a href="#" onclick="javascript:confirmEdit('<?php  echo $script_link ; ?>','<?php   echo $p_no; ?>');" >เพิ่มเติม/แก้ไขรายการสั่งซื้อ </a></li>    
                              <!--  <li><a href="#" onclick="javascript:confirmEdit('order_form.php?doMode=Edit&amp;<?php  echo $script_link ; ?>','<?php   echo $p_no; ?>');" >เพิ่มเติม/แก้ไขรายการสั่งซื้อ </a></li> -->           
                       <?php }  ?> 
                             
              <?php }  ?> </br>
             <!-- <font color="#0000FF"><b>วันที่จัดส่งสินค้าของคุณคือ  <?php  //echo  func_ConvertDateToString($dlv_date);	?></b></font> -->
              </td>
          </tr>
  <?php 
  	$i=$i+1;
		 
  } while ($row_order = mysql_fetch_assoc($order)); ?>               
          </table> 
        </td>
      </tr>
    </table>


      <?php
	  
	  

}//if ($totalRows_order>0) 

elseif ($totalRows_order==0){
	echo "<br>";
	echo "<table width=700 border=0 align=center bgcolor= #DF3A01><tr><td align=center><strong class=content_header>รายการสั่งซื้อของท่านได้ถูกดาวน์โหลดเรียบร้อยแล้ว </br>โดยท่านสามารถตรวจสอบสถานะการสั่งซื้อได้ที่ประวัติการสั่งซื้อ</strong></td></tr></table>";
	}
?>
      
      <br />

    <form id="form1" name="form1" method="post" action="order_form.php">
    <table width="700" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="713" align="center"><br />
        <!--   <img src="images/add_order.png" width="225" height="28"  onclick="document.form1.submit();" style="cursor:hand"/><br /> -->

        <a href="index.php" target="_parent"><img src="images/BWorder_web_35.gif" alt="หน้าหลัก" width="72" height="19" border="0" /></a><img src="images/btn_exit.gif" border ="0"   style="visibility:hidden"/><!--<a href="order_check.php"><img src="images/add_order.png" alt="เพิ่มรายการสั่งซื้อทางอินเตอร์เน็ต" width="225" height="28" border="0"  />-->

<input name="doMode" type="hidden" id="doMode" value="New" />
<input name="dist" type="hidden" id="dist" value="<?php echo $_SESSION['dist']; ?>" />
<input name="mslno" type="hidden" id="mslno" value="<?php echo $_SESSION['mslno']; ?>" />
<input name="chkdgt" type="hidden" id="chkdgt" value="<?php echo $_SESSION['chkdgt']; ?>" />
<input name="rep_name" type="hidden" id="rep_name" value="<?php echo $_SESSION['name']; ?>" />
<input name="email" type="hidden" id="email" value="<?php echo $_SESSION['email']; ?>" />
<input name="curcamp" type="hidden" id="curcamp" value="<?php echo $_SESSION['CurCamp']; ?>" />
<input name="ordcamp" type="hidden" id="ordcamp" value="<?php echo $_SESSION['CurCamp']; ?>" />
</td>
        </tr>
      </table><br />
    
    </form></td>
  </tr>
  <?php // require_once('include/i_footer_border.php'); ?>
</table>
<?php // require_once('include/i_footer.php'); ?>
<?php
            // POPUP มอบของขวัญ
            $dist=$_SESSION['dist'];
            $mslno=$_SESSION['mslno'];
            include("i_msg_box2.php");
           
                       
?>


</body>
</html>
<?php

mysql_free_result($order);

?>
