<?php session_start();?>
<?php 
header('Content-type: text/html; charset=windows-874');
include("../i_function_msg.php");
require("../Connections/bwc_orders.php");
include("i_convert.php"); 
?>

<?php
				$dist = $_POST['dist'];
				$mslno	=$_POST['mslno'];
				$chkdgt	=$_POST['chkdgt'];
				$mslname = $_POST['mslname'];
				$datefrom = $_POST['datefrom'];
				$dateto = $_POST['dateto'];
				$email = $_POST['email'];
				
				echo  " <fieldset>";
				echo  " <font color=#ff8899> รหัสสมาชิก  </font> " .  $dist . "  -  " . $mslno . "  -  ".  $chkdgt . "<br>";
				/*echo " <font color=#ff8899> ชื่อสมาชิก  </font> " . $mslname ."</font>". "<br>";
				echo " <font color=#ff8899> วันที่ลงทะเบียน  </font> " . $datefrom . " to " . $dateto . "<br>";
				echo " <font color=#ff8899> อีเมลล์สมาชิก  </font> " . $email . "<br>"; */
				echo "<br>";
				echo "</fieldset>";
	
	if ($Page == "") $Page =1;
	if ($MySort == "") $MySort = "DIST";

mysql_select_db($database_bwc_orders, $bwc_orders);
mysql_query("SET NAMES 'tis620'");
//mysql_query("");

//$query = "SELECT * FROM MSLMST  WHERE  DIST='$dist' AND MSLNO=$mslno AND CHKDGT=$chkdgt";
//$query = "SELECT  COUNT (*) FROM MSLMST  WHERE  STATUS <> '' ORDER BY DIST";
//$query = "SELECT * FROM MSLMST  WHERE  STATUS <> '' ORDER BY DIST";

$y = " WHERE  STATUS <> '' ";
if ($dist<>"")  $y = $y." and dist = '". $dist ."' "; 
if ($mslno<>"") $y = $y." and mslno = '". $mslno."' ";
if ($chkdgt	 <>"") $y = $y." and chkdgt = '" . $chkdgt . "' "; 
if ($mslname	 <>"") $y = $y." and mslname = '" . $mslname . "' "; 
//if ($datefrom	 <>"") $y = $y." and reg_date = '" . $datefrom . "' "; 

if ($datefrom	 <>"" and $dateto <>"") 
    $y = $y." and reg_date between REPLACE('" . $datefrom . "','-','') and REPLACE('" . $dateto . "','-','') " ; 
else if ($datefrom	 <>"") 
   $y = $y." and reg_date >= REPLACE('" . $datefrom . "','-','') "; 
else if ($dateto	 <>"")
    $y = $y." and reg_date <= REPLACE('" . $dateto . "','-','') "; 




if ($email	 <>"") $y = $y." and email like '" . $email . "%' "; 

echo $y . "<br>";


$z = " ORDER BY ".$MySort ;


$query = "SELECT  concat(lpad(dist,4,'0'),'-',lpad(mslno,5,'0'),'-',lpad(chkdgt,1,'0')) msl_code, NAME, PWD,EMAIL, PHONE, BIRTHDATE, STATUS, REG_DATE, REG_TIME, QUESTION,ANSWER,WEBSITE_ID,LAST_LOGIN FROM MSLMST".$y.$z;

$mslmst = mysql_query($query, $bwc_orders) or die(mysql_error());
mysql_close($bwc_orders);
//KK $row_mslmst = mysql_fetch_assoc($mslmst);
$totalRows_mslmst = mysql_num_rows($mslmst);

if ($totalRows_mslmst==0) {
 AlertMessage("ไม่พบรหัสสมาชิกหรือ ระบุรหัสสมาชิกไม่ถูกต้อง","javascript:history.back();");
 exit;
}

?>

<table width="900" border="0" cellpadding="3" cellspacing="1">
  <tr  style="color:#FFF;background-color:#B27F86" nowrap>
    <td width="61" align="center">ลำดับ</td>
    <td width="136" align="center">MSL.CODE รหัสสมาชิก</td>
    <td width="172" align="center">Name : ชื่อ-นามสกุล</td>
        <td width="172" align="center">PWD : พาสเวิร์ด</td>
        <td width="172" align="center">EMAIL : อีเมล์</td>
    <td width="95" align="center">PHONE : เบอร์ติดต่อ</td>
       <td width="160" align="center">BIRHTDATE : วันเกิด</td>
    <td width="160" align="center">สถานะ</td>
       <td width="160" align="center">Register_DATE&amp;TIME</td>
           <td width="160" align="center">LAST_LOGIN</td>
              <td width="160" align="center">WEBSITE _ID : 3=faris,<br />2=friday,<br /> 1=mistine,<br />
              0=bw</td>
 
  </tr>
<?php 
$i =1;
while ($row_mslmst=mysql_fetch_assoc($mslmst))
{
	
	if  (($i%2)==0) {
		$bg="#FEEDEF";
	}
	else {
		$bg ="#FEDAE0";
		$f_color ="#000000";
		$f_w ="normal";
	}
?>  
  <tr  bgcolor="<?php  echo $bg?>" nowrap  style="color:<? echo $f_color;?>;font-weight:<? echo $f_w;?>">
    <td align="center" nowrap><?php echo $i; ?></td>
    <td align="center" nowrap><?php  echo  $row_mslmst['msl_code']; ?></td>
    <td align="left" nowrap><?php  echo  $row_mslmst['NAME']; ?></td>
    <td align="center" nowrap><?php echo  $row_mslmst['PWD']; ?></td>
    <td align="left" nowrap><?php  echo  $row_mslmst['EMAIL']; ?></td>
    <td align="center" nowrap><?php echo $row_mslmst['PHONE']; ?></td>
    <td align="center" nowrap><?php  echo  $row_mslmst['BIRTHDATE']; ?></td>
    <td align="center" nowrap><?php  echo $row_mslmst['STATUS']; ?></td>
    
     <!-- <td align="center" nowrap><?php  //echo func_ConvertDateToString($row_mslmst['REG_DATE'],''); ?></td>
     
          <!--<td align="center" nowrap><?php // echo $row_mslmst['REG_DATE']; ?></td>-->
          
      <td align="center" nowrap><?php  echo func_ConvertDateToString($row_mslmst['REG_DATE'],$row_mslmst['REG_TIME']); ?></td>
      <td align="center" nowrap>
	  <?php if ($row_mslmst['LAST_LOGIN']=="") {echo "-"; }else { echo	  
	  func_convertdatetime($row_mslmst['LAST_LOGIN']);} ?>
</td>
    <td align="center" nowrap><?php  echo  $row_mslmst['WEBSITE_ID']; ?></td>
    
  </tr>
  <?php 
  $i=$i+1;
}
  ?>
</table>

<hr />
<?php
mysql_free_result($mslmst);
?>
