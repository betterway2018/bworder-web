<?php  
session_start(); 

require_once('check_login.php');
require_once('include/i_config.php'); 

require_once('include/functionphp.inc');
require_once('include/nusoap.php'); 
$ws_client = new soapclient($url_webservice.'get_repinfo.php?wsdl',true); 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title ?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table border="0" align="center" cellpadding="0" cellspacing="0" width="900">
  <?php require_once('include/i_header_border.php'); ?>
  <?php require_once('include/i_header.php'); ?>
  <tr>
	<td class="Sheet_Boder">
<!--- Start Content hear -->    
<?php 
			$dist=$_SESSION['dist'];
            $mslno=$_SESSION['mslno']; 
			$chkdgt=$_SESSION['chkdgt'];
			$rep_code=$dist. substr("00000".$mslno,-5).$chkdgt;
			if ($dist=="") {
				echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
			}
			$rep_name = $_POST['txtrep_name'];
			
			$sel_camp=$_POST['sel_camp'];
			$sel_order_by = $_POST['sel_order_by'];
			$sel_asc = $_POST['sel_asc'];

			$data = repinfo($rep_code,$ws_client);
			//echo $url_webservice.'__'.$rep_code.'__'.$data;
			if ($aInfo = explode('|', $data)) { 
			//2 - 8	
				$rep_seq = $aInfo[2];
				//$REPREP_CODE = $aInfo[3];
				$rep_name = $aInfo[4];
				$point = number_format($aInfo[5],0,".",",");
				$award = number_format($aInfo[6],0,".",",");
				$ar_bal = number_format($aInfo[7],2,".",",");
				$paydate = $aInfo[8];
			//9 - 23
				$BPRBalfwd = number_format($aInfo[9],0,".",",");
				$BPRBal = number_format($aInfo[10],0,".",",");
				$BPRAdj = number_format($aInfo[11],0,".",",");
				$BPRUse = number_format($aInfo[12],0,".",",");
				//$BPRBalfwd-$BPRUse = number_format($aInfo[13],2,".",",");
				$BPRExpire = number_format($aInfo[14],0,".",",");
				$rep_member = $aInfo[15];
				$add_line1 = $aInfo[16];
				$add_line2 = $aInfo[17];
				$add_line3 = $aInfo[18];
				$add_provi = $aInfo[19];
				$add_zcode = $aInfo[20];
				$add_telno = $aInfo[21];
				$add_faxno = $aInfo[22];
				$add_mobile = $aInfo[23];
			}				
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
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td height="450" colspan="2" align="center">
						<hr />
						<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" style="font-family:Tahoma, Geneva, sans-serif; font-size:13px;">
						  <tr>
							<td width="700" colspan="2" align="center">
							  <tr class="FormBorderGray">
								<td width="479" height="26" align="left"><strong>รหัส/ชื่อ สมาชิก :</strong><strong>&nbsp;<?php  echo substr($rep_code,0,4)."-".substr($rep_code,4,5) ."-".substr($rep_code,9,1) . " ". $rep_name; ?></strong></font></td>
							  </tr>
							  <tr>
							 
								<td width="479" colspan="2" align="left">
								<strong>คะแนนสะสม พอยท์ รีวอร์ด ของสมาชิกที่มีอยู่ตอนนี้ คือ :</strong>
								<font color="#FF0000"><?php echo $point; ?></font> คะแนน</td>
							  </tr>
							  <?
							  if ($award<>0)
							  {
							  
							  ?>
							  <tr bgcolor=#FFCCFF align=center>
								<td width="479" colspan="2" align="left">
								<p><strong>เงินออมทรัพย์จากมิสทีนปีที่ 1 เริ่มรอบที่ 13/2016 - 12/2017 </strong> </p>
								<strong>เงินออมรัพย์สะสมรวม  :  </strong>
								<strong><font color="#FF0000"><? echo $award; ?> </font> บาท </strong>
								</td>
							  </tr>
							  <?
							  }
							  ?>
							  <tr>
								<td height="41" colspan="2" align="left">
									<strong>ยอดเงินที่สมาชิกต้องชำระก่อนการสั่งซื้อสินค้าครั้งต่อไปคือ  :</strong>
									<font color="#FF0000"><?php echo $ar_bal; ?></font> บาท 
									<font color="#FF0000"><?php
										//if ($ar_bal != 0){ echo "<br>..กรุณาชำระเงินภายในวันที่  ".substr($paydate,6,2)."/".substr($paydate,4,2) ."/".substr($paydate,0,4); } 
										if ($ar_bal != 0){ echo "<br>..กรุณาชำระเงินภายในวันที่  ".$paydate; } 
										?>
									</font>
								</td>
							  </tr>
							  <tr>
								<td height="2" colspan="2"></td>
							  </tr>
							</td>
						  </tr>
						</table>
						<table border="1" cellpadding="0" cellspacing="0"width="650"> 
						  <tr align=center>
							<td colspan="5">รายการคะแนนรางวัล</td>
							<td rowspan="3">คะเเนนสะสม <div>ไม่มีวันหมดอายุ</div></td>
						  </tr>
						  <tr bgcolor=#FBEFF8 align=center>
							<th>คะแนนสะสมยกมา</th>
							<th>คะแนนสะสมรอบนี้</th>
							<th>คะแนนปรับปรุงรอบนี้</th>
							<th>คะแนนสะสมที่ใช้ไปรอบนี้</th>
							<th>คะแนนสะสมคงเหลือ</th>
							<!--<th rowspan="2" align="center">คะเเนนสะสม ไม่มีวันหมดอายุ</th> -->
						
						  </tr>
						  <tr align=center>
							<td><?php echo $BPRBalfwd ?></td>
							<td><?php echo $BPRBal?></td>
							<td><?php echo $BPRAdj?></td>
							<td><?php echo $BPRUse?></td>
							<!-- <td><?php echo $BPRBalfwd-$BPRUse?></td> -->
							 <td><?php echo $point?></td>
							
							
						  </tr>
						</table>
						<table width="600" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td height="31" align="left"><span style="border-bottom:solid #333 1px">ที่อยู่ในการจัดส่งสินค้า</span></td>
						  </tr>
						  <tr>
							<td height="30" align="left">
							  <font style="font-family:Tahoma, Geneva, sans-serif;font-size:14px;" >
								<?php
								echo $add_line1."</br>";
								if ( $add_line2!="") {
									echo $add_line2."</br>";
								}
								echo $add_line3 ."</br>";
								echo $add_provi ."</br>";
								echo $add_zcode ."</br>";
								?>
							  </font>
							</td>
						  </tr>
						  <tr>
							<td height="34" align="left"><hr />
							  <font style="font-family:Tahoma, Geneva, sans-serif;font-size:14px" >
								โทรศัพท์ : <?php echo $add_telno; ?>  </br>  
								แฟกซ์  :  <?php echo $add_faxno; ?> </br>
								โทรศัทพ์มือถือ :<?php  echo $add_mobile;?>
							  </font>
							</td>
						  </tr>
						</table>
						<span id="mySpan"> </span> <br />
						</td>
					</tr>
				</table>
<?php		} ?>            
		  </td>
		</tr>
	  </table>
	</form>
    <!-- End of  Content -->    
	</td>
  </tr>
  <?php require_once('include/i_footer_border.php'); ?>
</table>
<?php require_once('include/i_footer.php'); ?>
</body>
</html>

<?php 
function repinfo($rep_code,$ws_client) {
	$param = array('rep_code' => $rep_code);
	$result = $ws_client->call('repinfo', $param); 
	return $result;
}

