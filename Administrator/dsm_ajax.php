<?php session_start();?>
<?php 
header('Content-type: text/html; charset=windows-874');
include("../i_function_msg.php");
require("../Connections/bwc_orders.php");
include("i_convert.php"); 
?>

<?php
$div= $_SESSION['div_code'];
$nsm_code=$_SESSION['nsm_code'];
$login_type = $_SESSION['login_type'];

mysql_select_db($database_bwc_orders, $bwc_orders);
mysql_query("SET NAMES 'tis620'");
//mysql_query("SET NAMES 'utf8'");

$query = "SELECT * FROM users Where  Status <> '' ";
  
if ($login_type=="DIV") {
	$filter= " and  DIVCODE='$div'  ";
}
else if ($login_type=="NSM") {
	$filter=" and   DIVCODE IN (select DIV_CODE from tbdiv where nsm =$nsm_code)";
}
else if ($login_type="Admin") {
	//$filter=" where div_code <> '' ";
}

$query.= $filter;

if ($_POST['txtdist']!="") {
	$query.=" AND District ='". $_POST['txtdist'] ."'";
}

$query.=" ORDER BY DISTRICT ASC";





$users = mysql_query($query, $bwc_orders) or die(mysql_error());
//$row_order = mysql_fetch_assoc($order);
?>

    
    
    
        
<table width="900" border="0" cellpadding="3" cellspacing="1">
  <tr  style="color:#FFF;background-color:#36F" nowrap>
    <td width="41" align="center" nowrap="nowrap">No.</td>
    <td width="64" align="center" nowrap="nowrap">District</td>
    <td width="237" align="left" nowrap="nowrap">NAME</td>
    <td width="159" align="left" nowrap="nowrap">E-mail</td>
    <td width="101" align="left" nowrap="nowrap">Last Login</td>
    <td width="63" align="left" nowrap="nowrap">Status</td>
    <td align="left">&nbsp;</td>
    <td width="90" align="left" nowrap="nowrap">&nbsp;</td>
  </tr>
<?php 
$i =1;
while ($row_users=mysql_fetch_assoc($users))
{
	
	if  (($i%2)==0) {
		$bg="#6699FF";
	}
	else {
		$bg="#E8EFFF";
	}

			$campaign =substr($row_users['CAMP'],4,2) ."/".substr($row_users['CAMP'],0,4);
			$effdte =  func_ConvertDateToString($row_users['EFFDTE'],"");
			$expdte =  func_ConvertDateToString($row_users['EXPDTE'],"");

		if ($row_users['LAST_LOGIN']=="") {
			$last_login = "";
		}
		else {
			$last_login=func_ConvertDateToString(substr($row_users['LAST_LOGIN'],0,8),substr($row_users['LAST_LOGIN'],8,6));
		}
		
			
?>  
  <tr  bgcolor="<?php  echo $bg?>" nowrap>
    <td align="center" nowrap><?php echo $i; ?></td>
    <td align="center" nowrap><?php  echo  "".$row_users['DISTRICT'] ?></td>
    <td align="left" nowrap="nowrap"><?php echo $row_users['NAME']  ?></td>
    <td align="left" nowrap="nowrap"><?php echo $row_users['EMAIL'] ;?></td>
    <td align="left" nowrap><?php  echo $last_login;?></td>
    <td align="center" nowrap><?php  echo "".$row_users['STATUS'];?></td>
    <td align="center">
    <?php 	if ($row_users['STATUS']!="Active") { ?>
  <a href="dsm_unlock_user.php?id=<?php echo $row_users['DISTRICT']; ?>">
    <img src="images/lock_open.png" alt="เปิดการใช้งาน" title="เปิดการใช้งาน" width="16" height="16" border="0" /></a>

		<?php } else { ?>
    <a href="dsm_lock_user.php?id=<?php echo $row_users['DISTRICT']; ?>">
    <img src="images/lock_2.png" alt="ปิดการใช้งานชั่วคราว"  title="ปิดการใช้งานชั่วคราว"width="16" height="16" border="0" /></a>			
        
    			
		<?php }?>
    
    </td>

    <td align="left" nowrap>
    <a href="dsm_profile.php?id=<? echo  $row_users['DISTRICT']; ?>" onclick="return hs.htmlExpand(this, { objectType: 'iframe', width: 600,height:350})">   
    <?php 	if ($row_users['STATUS']=="Active") { ?>
    <img src="images/User.gif" alt="ดูข้อมูลผู้จัดการประจำเขต"  title="ข้อมูลผู้จัดการประจำเขต" width="16" height="16" border="0" /></a>
    &nbsp;<a href="dsm_resetPWD.php?id=<?php  echo $row_users['DISTRICT'];?>" id="changePWD<?php echo $row_users['DISTRICT'];?>"  onclick="return hs.htmlExpand(this, {
    	objectType: 'iframe', outlineType: 'rounded-white',   outlineWhileAnimating: true, preserveContent: false, width: 503 ,height: 340} )"> <img src="images/password.png" width="16" height="16" border="0"  title="เปลี่ยนรหัสผ่าน"/></a>
     <!--  wrapperClassName: 'highslide-wrapper drag-header',-->
&nbsp; <a href="dsm_sendmail.php?id=<?php  echo $row_users['DISTRICT'];?>" id="SendMail<?php echo $row_users['DISTRICT'];?>"  onclick="return hs.htmlExpand(this, {objectType: 'iframe', outlineType: 'rounded-white',   outlineWhileAnimating: true, preserveContent: false, width: 450 } )"> <img src="images/Send Mail.png" width="16" height="16" border="0" title="ส่งอีเมลล์แจ้งรหัสผ่านไปยังผู้จัดการประจำเขต" /></a>
<?php }?></td>
  </tr>
  <?php 
  $i=$i+1;
}
  ?>
</table>
<?php
mysql_free_result($users);
?>
