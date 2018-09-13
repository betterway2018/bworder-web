<?php 
ob_start();


?>
<?php 
//header('Content-type: text/html; charset=windows-874');
include("../i_function_msg.php");
require("../Connections/bwc_orders.php");
ini_set('mysql.connect_timeout','0');   
ini_set('max_execution_time', '0')
?>


<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Summay Order by Order Date</title>

<link href="../Styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/calendar.css">
<script language="JavaScript" src="css/calendar_db.js"></script>

<script language="JavaScript">
	   var HttPRequest = false;

	   function doCallAjax(Sort,page,dist) {
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
	
		
			var dist=document.getElementById('dist').value;
			var mslno=document.getElementById('mslno').value;
			var chkdgt=document.getElementById('chkdgt').value;
			//var mslname = document.getElementById('mslname').value;
			var datefrom=document.getElementById('datefrom').value;
			var dateto=document.getElementById('dateto').value;
			var email=document.getElementById('email').value;
			alert ('dddddddddddddd');
			
			var url = 'data_mslmst_Ajax.php';
			//dist = '999';
			var pmeters =  'Sort='+Sort+'&page='+page+'&dist='+dist+'&mslno='+mslno+'&chkdgt='+chkdgt+'&datefrom='+datefrom+'&dateto='+dateto+'&email='+email;
//			var pmeters =  'Sort='+Sort+'&page='+page+'&dist='+dist+'&mslno='+mslno+'&chkdgt='+chkdgt+'&mslname='+mslname +'&datefrom='+datefrom+'&dateto='+dateto+'&email='+email;
			
			//alert (pmeters);
			
			
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded;");
			HttPRequest.setRequestHeader("charset", "TIS-620")
			//HttPRequest.setRequestHeader("charset", "windows-874")

			//HttPRequest.setRequestHeader("Content-Type", "text/plain;charset=windows-874");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			

			HttPRequest.send(pmeters);
			
			//<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
			
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
<link href="../css/main.css" rel="stylesheet" type="text/css">
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" valign="top" bgcolor="#FFFFFF"><!--#include file="header.asp" --></td>
  </tr>
  <tr>
    <td width="5%" valign="top" nowrap="nowrap" bgcolor="#FFFFFF" style="border-bottom:solid #D4D4D4 0px;border-left:solid #D4D4D4  0px;border-top:solid #D4D4D4  0px;border-right:solid #D4D4D4  0px"><!--#include file="menu.asp" -->
      &nbsp;</td>
    <td align="left" valign="top"><br />
      <strong class="text_heading">:: SUMMARY ORDER BY ORDER DATE</strong>
      <hr />
      <form id="form1" name="form1" method="post" action="">
        <table width="622" border="0" cellspacing="0" cellpadding="5">
          <!--        <tr>
          <td align="right">ชื่อ - นามสกุล: </td>
          <td><input name="mslname" type="text" id="mslname" size="48" /></td>
        </tr>  -->
          <tr>
            <td width="155" align="right" valign="middle">ORDER  DATE:</td>
            <td width="447"><table width="77%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="27%" nowrap="nowrap"><input name="datefrom" type="text" id="datefrom" value="<?php echo $_REQUEST['datefrom']; ?>" /></td>
                <td width="4%" nowrap="nowrap"><script language="JavaScript" type="text/javascript">
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'datefrom'
	});

	          </script></td>
                <td width="8%" align="center" nowrap="nowrap">&nbsp;&nbsp;ถึง&nbsp;&nbsp;</td>
                <td width="27%" nowrap="nowrap"><input name="dateto" type="text" id="dateto" value="<?php echo $_REQUEST['dateto']; ?>" /></td>
                <td width="34%" nowrap="nowrap"><script language="JavaScript" type="text/javascript">
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'dateto'
	});

	          </script></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td><input type="reset" name="button2" id="button2" value="Reset" />
              <input type="submit" name="Submit" id="button" value="View" /></td>
          </tr>
        </table>
      </form>
      
      
<?php
if ($_SERVER['REQUEST_METHOD']=="POST") 
{
	$date1 = $_REQUEST['datefrom'];
	$date2=$_REQUEST['dateto'];
	
	if($date1=="") {
		$date1= date('Y-m-d');
	}
	
	if($date2=="") {
		$date2=date('Y-m-d');
	}
	$sql1 = "SELECT order_header.ORDDATE,Count(order_header.ORDER_NO)  CountOfOrderNo";
	$sql1 =$sql1 . " FROM order_header WHERE   order_header.DELFLAG = 'N' AND order_header.ORDDATE BETWEEN '".  str_replace("-","",$date1) ."' AND '".   str_replace("-","",$date2)."'  ";
	$sql1 = $sql1 . " GROUP BY    order_header.ORDDATE ";

	
	mysql_select_db($database_bwc_orders, $bwc_orders);
	mysql_query("SET NAMES 'tis620'");
	$data1 = mysql_query($sql1, $bwc_orders) or die(mysql_error());
	$total_data1 = mysql_num_rows($data1);
	$values1 = array();
	$i =1;
	while ($row_data1=mysql_fetch_assoc($data1))
	{
		$intDate=$row_data1['ORDDATE'];
		$values1[$intDate] = $row_data1['CountOfOrderNo'];
	  	$i=$i+1;
	}
	
    

	$sql2 = "SELECT order_detail.ORDDATE, Count(order_detail.BILLCODE) CountOfItems,";
	$sql2 = $sql2 . " Sum(order_detail.QTY) SumOfQty, Sum(order_detail.AMOUNT) SumOfAmount ";
	$sql2 = $sql2 . " FROM Order_Detail ";
	$sql2=  $sql2 . " Where Order_Detail.DELFLAG='N' AND Order_Detail.ORDDATE BETWEEN  '".  str_replace("-","",$date1) ."' AND '".   str_replace("-","",$date2)."'  ";
	$sql2 = $sql2 . " Group BY  Order_Detail.ORDDATE ";
	
	$data2 = mysql_query($sql2, $bwc_orders) or die(mysql_error());
	$total_data2 = mysql_num_rows($data2);	
	$values2 = array();
	$ii =1;
	while ($row_data2=mysql_fetch_assoc($data2))
	{

		$intDate=$row_data2['ORDDATE'];
		$values2[$intDate]['Items'] = $row_data2['CountOfItems'];
		$values2[$intDate]['Qty'] = $row_data2['SumOfQty'];
		$values2[$intDate]['Amount'] = $row_data2['SumOfAmount'];




	  	$ii=$ii+1;
	}	
	
	
	$sql3 = $sql3 . " SELECT TRANDATE,COUNT(ref_seq) CountOfRegister from msl_register ";
	$sql3 = $sql3 . " GROUP BY TRANDATE ";
	$sql3 = $sql3 . " HAVING TRANDATE BETWEEN '".  str_replace("-","",$date1) ."' AND '".   str_replace("-","",$date2)."'  ";
	
	$data3 = mysql_query($sql3, $bwc_orders) or die(mysql_error());
	$total_data3 = mysql_num_rows($data3);
	$values3= array();
	$i=1;
	while ($row_data3=mysql_fetch_assoc($data3))
	{
		$intDate=$row_data3['TRANDATE'];
		//echo "<br> $intDate=".$row_data3['CountOfRegister'];
		$values3[$intDate] = $row_data3['CountOfRegister'];
	  	$i=$i+1;
	}	
	
	//echo "<br>$sql3<br>";
	//print_r($values3);
	
	$start_date = strtotime($date1);
	$end_date = strtotime($date2);
	$currentdate = $start_date;

/*
    while ($currentdate <= $end_date) {
        //if you encounter a Saturday or Sunday, remove from the total days count
        //if (!((date('D', $currentdate) == 'Sat') || (date('D', $currentdate) == 'Sun') || in_array(date('d', $currentdate), $extras))) {
          //  $return = $return + 1;
       // }
	   echo  date('d/m/Y', $currentdate);
	   echo "<br>";
	   
        $currentdate = strtotime('+1 day', $currentdate);
    } //end date walk loop
*/	
}
?>

<?php 
	//นับคนที่มาสมัครทางเวบเพื่อสั่งซื้อสินค้า
	
	$sql4 = $sql4 . " SELECT REG_DATE,COUNT(*) CountOfRegister from mslmst ";
	$sql4 = $sql4 . " WHERE REG_DATE BETWEEN '".  str_replace("-","",$date1) ."' AND '".   str_replace("-","",$date2)."'  ";
	$sql4 = $sql4 . " GROUP BY REG_DATE ";
	
	
	$data4 = mysql_query($sql4, $bwc_orders) or die(mysql_error());
	$total_data4 = mysql_num_rows($data4);
	$values4= array();
	$i=1;
	while ($row_data4=mysql_fetch_assoc($data4))
	{
		$intDate=$row_data4['REG_DATE'];
		//echo "<br> $intDate=".$row_data3['CountOfRegister'];
		$values4[$intDate] = $row_data4['CountOfRegister'];
	  	$i=$i+1;
	}	
	
	//echo "<br>$sql3<br>";
	//print_r($values3);
	
	$start_date = strtotime($date1);
	$end_date = strtotime($date2);
	$currentdate = $start_date;

//}

?>
<?php 
	//นับคนที่มาสมัครทางเวบเพื่อสั่งซื้อสินค้า
	
	$sql5 = $sql5 . " SELECT REG_DATE, sum(if(website_id=0,1,0)) as CountOfWebsite0, sum(if(website_id=1,1,0)) as CountOfWebsite1, SUM(if(website_id=2,1,0)) as CountOfWebsite2, sum(if(website_id=3,1,0)) as CountOfWebsite3 from mslmst ";
	$sql5 = $sql5 . " WHERE REG_DATE BETWEEN '".  str_replace("-","",$date1) ."' AND '".   str_replace("-","",$date2)."'  ";
	$sql5 = $sql5 . " GROUP BY REG_DATE ";
	
	$data5 = mysql_query($sql5, $bwc_orders) or die(mysql_error());
	$total_data5 = mysql_num_rows($data5);
	$values5= array();
	$i=1;
	while ($row_data5=mysql_fetch_assoc($data5))
	{
		$intDate=$row_data5['REG_DATE'];
		//echo "<br> $intDate=".$row_data3['CountOfRegister'];
		$values50[$intDate] = $row_data5['CountOfWebsite0'];
		$values51[$intDate] = $row_data5['CountOfWebsite1'];
		$values52[$intDate] = $row_data5['CountOfWebsite2'];
		$values53[$intDate] = $row_data5['CountOfWebsite3'];
		$i=$i+1;
	}	
	
	//echo "<br>$sql5<br>";
	//print_r($values5);
	
	$start_date = strtotime($date1);
	$end_date = strtotime($date2);
	$currentdate = $start_date;

?>

<?php 
	//นับคนที่มาสมัครทางเวบเพื่อสั่งซื้อสินค้า
	
	$sql6 = $sql6 . " SELECT TRANDATE, sum(if(website_id=1,1,0)) as CountOfWebsite1, SUM(if(website_id=2,1,0)) as CountOfWebsite2, sum(if(website_id=3,1,0)) as CountOfWebsite3, sum(if(website_id=4,1,0)) as CountOfWebsite4, sum(if(website_id=201,1,0)) as CountOfWebsite5 from msl_register ";
	$sql6 = $sql6 . " WHERE TRANDATE BETWEEN '".  str_replace("-","",$date1) ."' AND '".   str_replace("-","",$date2)."'  ";
	$sql6 = $sql6 . " GROUP BY TRANDATE ";
	
	$data6 = mysql_query($sql6, $bwc_orders) or die(mysql_error());
	$total_data6 = mysql_num_rows($data6);
	$values6= array();
	$i=1;
	while ($row_data6=mysql_fetch_assoc($data6))
	{
		$intDate=$row_data6['TRANDATE'];
		//echo "<br> $intDate=".$row_data3['CountOfRegister'];
		$values61[$intDate] = $row_data6['CountOfWebsite1'];
		$values62[$intDate] = $row_data6['CountOfWebsite2'];
		$values63[$intDate] = $row_data6['CountOfWebsite3'];
		$values64[$intDate] = $row_data6['CountOfWebsite4'];
		$values65[$intDate] = $row_data6['CountOfWebsite5'];
		$i=$i+1;
	}	
	
	//echo "<br>$sql5<br>";
	//print_r($values5);
	
	$start_date = strtotime($date1);
	$end_date = strtotime($date2);
	$currentdate = $start_date;

?>

   <table width="965" border="0" cellpadding="3" cellspacing="1" class="FormBorderGray">
  <tr class="content_header">
    <td width="178" height="29" align="center" bgcolor="#003300"><strong>DATE</strong></td>
    <td width="60" align="right" bgcolor="#003300"><strong>REGISTER<br>
      from web BW
    </strong></td>
    <td width="30" align="right" bgcolor="#CC6699">register from MISTINE</td>
    <td width="14" align="right" bgcolor="#3A4F6C">register from FRIDAY</td>
    <td width="3" align="right" bgcolor="#669999">register from FARIS</td>
    <td width="3" align="right" bgcolor="#3399CC">register from CATALOGFRIDAYONLINE</td>
	<td width="3" align="right" bgcolor="#FF99FF">register from HOTPOT</td>
    <td align="right" bgcolor="#003300"><strong>ORDERS</strong></td>
    <td width="101" align="right" bgcolor="#003300"><strong>ITEM</strong></td>
    <td width="121" align="right" bgcolor="#003300"><strong>UNITS</strong></td>
    <td width="121" align="right" bgcolor="#003300"><strong>AMOUNT</strong></td>
    <td width="60" align="right" bgcolor="#003300"><strong> Register for order on website BWORDER</strong></td>
    </tr>
<?php
$i=1;
 while ($currentdate <= $end_date) {
        //if you encounter a Saturday or Sunday, remove from the total days count
		//|| in_array(date('d', $currentdate), $extras))
        if (!((date('D', $currentdate) == 'Sat') || (date('D', $currentdate) == 'Sun'))) {
            $return = $return + 1;
			$bg="#F0EEEF";
        }
		else 
		{
			$bg="#DFDFDF";
		}
		
		//$countOforder= $values[$currentdate];
		$intDate = date('Ymd',$currentdate);
		
		$english_format_number = number_format($number);


?>
  <tr>
    <td align="center" bgcolor="<?php echo $bg ;?>"><?php   echo  date('d M Y', $currentdate);?></td>
    <td align="right" bgcolor="<?php echo $bg ;?>"><?php   echo number_format( $values3["$intDate"]);?></td>
    
    <td align="right"bgcolor="<?php echo $bg ;?>"><?php   echo number_format( $values61["$intDate"]);?></td>
    <td align="right"bgcolor="<?php echo $bg ;?>"><?php   echo number_format( $values62["$intDate"]);?></td>
    <td align="right"bgcolor="<?php echo $bg ;?>"><?php   echo number_format( $values63["$intDate"]);?></td>
    <td align="right"bgcolor="<?php echo $bg ;?>"><?php   echo number_format( $values64["$intDate"]);?></td>
	<td align="right"bgcolor="<?php echo $bg ;?>"><?php   echo number_format( $values65["$intDate"]);?></td>
    <td align="right" bgcolor="<?php echo $bg ;?>"><?php   echo number_format($values1["$intDate"]);?></td>
    <td align="right" bgcolor="<?php echo $bg ;?>"><?php   echo number_format($values2["$intDate"]['Items']);?></td>
    <td align="right" bgcolor="<?php echo $bg ;?>"><?php   echo number_format($values2["$intDate"]['Qty']);?></td>
    <td align="right" bgcolor="<?php echo $bg ;?>"><?php   echo number_format($values2["$intDate"]['Amount']);?></td>
    <td align="right"bgcolor="<?php echo $bg ;?>"><?php   echo number_format( $values4["$intDate"]);?></td>
    </tr>

<?php
		$website_id0 = $website_id0+$values50["$intDate"];
		$website_id1 = $website_id1+$values51["$intDate"];
		$website_id2 = $website_id2+$values52["$intDate"];
		$website_id3 = $website_id3+$values53["$intDate"];
		
		
		$website_id61 = $website_id61+$values61["$intDate"];
		$website_id62 = $website_id62+$values62["$intDate"];
		$website_id63 = $website_id63+$values63["$intDate"];
		$website_id64 = $website_id64+$values64["$intDate"];
		$website_id65 = $website_id65+$values65["$intDate"];
		
		$total_registerweb = $total_registerweb+$values4["$intDate"];
		$total_register = $total_register+$values3["$intDate"];
	  $total_orders = $total_orders+$values1["$intDate"];
	  $total_items = $total_items+$values2["$intDate"]['Items'];
	  $total_qty = $total_qty+$values2["$intDate"]['Qty'];
	  $total_amount = $total_amount +$values2["$intDate"]['Amount'];
      $currentdate = strtotime('+1 day', $currentdate);
	  $i=$i+1;
    } //end date walk loop
?> 
	 <tr>
    <td align="center" bgcolor="#F0EEEF" style="border-bottom: double #F00 2px; border-top:double #F00 2px"><strong>Total</strong></td>
    <td align="right" bgcolor="#F0EEEF" style="border-bottom: double #F00 2px; border-top:double #F00 2px"><strong><?php echo number_format($total_register); ?></strong></td>
    <td align="right" bgcolor="#F0EEEF" style="border-bottom: double #F00 2px; border-top:double #F00 2px"><strong><?php echo number_format($website_id61);?></strong></td>
    <td align="right" bgcolor="#F0EEEF" style="border-bottom: double #F00 2px; border-top:double #F00 2px"><strong><?php echo number_format($website_id62);?></strong></td>
    <td align="right" bgcolor="#F0EEEF" style="border-bottom: double #F00 2px; border-top:double #F00 2px"><strong><?php echo number_format($website_id63);?></strong></td>
    <td align="right" bgcolor="#F0EEEF" style="border-bottom: double #F00 2px; border-top:double #F00 2px"><strong><?php echo number_format($website_id64);?></strong></td>
	<td align="right" bgcolor="#F0EEEF" style="border-bottom: double #F00 2px; border-top:double #F00 2px"><strong><?php echo number_format($website_id65);?></strong></td>
    <td align="right" bgcolor="#F0EEEF" style="border-bottom: double #F00 2px; border-top:double #F00 2px"><strong><?php echo number_format($total_orders);?></strong></td>
    <td align="right" bgcolor="#F0EEEF" style="border-bottom: double #F00 2px; border-top:double #F00 2px"><strong><?php echo number_format( $total_items);?></strong></td>
    <td align="right" bgcolor="#F0EEEF" style="border-bottom: double #F00 2px; border-top:double #F00 2px"><strong><?php echo number_format( $total_qty );?></strong></td>
    <td align="right" bgcolor="#F0EEEF" style="border-bottom: double #F00 2px; border-top:double #F00 2px"><strong><?php echo number_format($total_amount);?></strong></td>
    <td align="right" bgcolor="#F0EEEF" style="border-bottom: double #F00 2px; border-top:double #F00 2px"><strong><?php echo number_format($total_registerweb);?></strong></td>
    </tr>
  </table>

<?php
ob_end_flush();
?>
   </td>
  </tr>
</table>
</body>
</html>
