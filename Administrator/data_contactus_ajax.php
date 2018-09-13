<?php session_start();

header('Content-type: text/html; charset=windows-874');
include("../i_function_msg.php");
require_once("../Connections/bwc_webboard.php");
include("i_convert.php"); 

				//$row_index = $_POST['row_index'];
				$dist = $_POST['dist'];
				$mslno	=$_POST['mslno'];
				$chkdgt	=$_POST['chkdgt'];
				$datefrom = $_POST['datefrom'];
				$dateto = $_POST['dateto'];
				$email = $_POST['email'];
				$fselect = $_POST['fselect'];
		//echo('aaaaa'.$fselect);		
				$strMode = $_REQUEST['tMode'];
				$row_index = $_REQUEST['row_index'];
				$curPage=$_POST['page'];
				
				echo  " <fieldset>";
				echo  " <font color=#ff8899> รหัสสมาชิก  </font> " .  $dist . "  -  " . $mslno . "  -  ".  $chkdgt . "<br>";
				/*echo " <font color=#ff8899> ชื่อสมาชิก  </font> " . $mslname ."</font>". "<br>";*/
				echo " <font color=#ff8899> วันที่ลงทะเบียน  </font> " . $datefrom . " to " . $dateto . "<br>";
				echo " <font color=#ff8899> อีเมลล์สมาชิก  </font> " . $email . "<br>"; 
				echo " <font color=#ff8899> ดึง ROW_INDEX : </font> " . $row_index . "<br>"; 
				echo "</fieldset>";
				echo "<br>";
				
				/*	$mslname = $_POST['mslname'];*/
				
				if ($strMode == 'DELETE' ) {
					$delete =  mysql_query("Delete from webboard where row_index =" . $row_index, $bwc_webboard) or die("<br><br>Error : ". mysql_error());
					//echo '<script language="JavaScript"> alert("ข้อมูลถูกลบเรียบร้อยแล้ว");</ script>';
					echo"<meta http-equiv='refresh' content='0'>";
				}
		
					
				if ($curPage == "") $curPage =1;
				if ($MySort == "") $MySort = "A.DIST"; 
	$MySort = "A.row_index desc";//ลบ
				$y = " WHERE A.NAME <> '' ";
				if ($dist<>"")  $y = $y." and A.dist = '". $dist ."' "; 
				if ($mslno<>"") $y = $y." and A.mslno = '". $mslno."' ";
				if ($chkdgt	 <>"") $y = $y." and A.chkdgt = '" . $chkdgt . "' "; 
				if ($mslname	 <>"") $y = $y." and A.mslname = '" . $mslname . "' "; 
				//if ($datefrom	 <>"") $y = $y." and reg_date = '" . $datefrom . "' "; 
				
	//			if ($row_index <>"") $y = $y." and row_index = '" . $row_index . "' "; 
				
				if ($datefrom	 <>"" and $dateto <>"") 
					$y = $y." and A.create_date between REPLACE('" . $datefrom . "','-','') and REPLACE('" . $dateto . "','-','') " ; 
				else if ($datefrom	 <>"") 
				   $y = $y." and A.create_date >= REPLACE('" . $datefrom . "','-','') "; 
				else if ($dateto	 <>"")
					$y = $y." and A.create_date <= REPLACE('" . $dateto . "','-','') "; 
				
				if ($email	 <>"") $y = $y." and A.email like '" . $email . "%' "; 
				
				if	($fselect==0)
					$y = $y . " and A.answer = 0 ";
				else if  ($fselect==1)
					$y = $y . " and A.answer >0 ";

					if	($sel_group <> "")
					{
					$y =  $y . " and C.Order_seq =".$sel_group;
					}
					
				if	($datefrom==0)
					$y = $y . " and A.CREATE_DATE >= 20110803 ";
					
				//echo "query condition = ". $y .  $fselect;
					
				
				/*If faqstatus <> ""  and faqstatus ="Active" then
					sql =sql & " AND faqStatus = 'Active'"
				elseIf faqstatus <> ""  and faqstatus ="Answer" then
					sql =sql & " AND faqStatus = 'Answer'"
				ElseIf faqstatus <> ""  and faqstatus ="All" then
					sql =sql & " AND faqStatus  IN ( 'Active','Answer')"
				End If */
				
				//echo $y . "<br>";
				$limit = 10;
				$start=$limit * ($curPage-1);
				if(!isset($start)){
				$start = 0;
				}

				
				$z = " ORDER BY ". $MySort ;
$query2 = "SELECT A.ROW_INDEX FROM WEBBOARD A LEFT JOIN WEBBOARD_DETAIL B ON A.ROW_INDEX = B.LIST_NO 
LEFT JOIN WEBBOARD_GROUP C ON C.ID = A.GROUP_ID ".$y;
//$total = mysql_query($query2, $bwc_webboard) or die("ERROR QUERY"."<font style='color:#ffffff'>".$query2."</font>");

$total = mysql_query($query2, $bwc_webboard) or die("<meta http-equiv='refresh' content='0'>");
$row_total = mysql_num_rows($total);

$query = "SELECT A.ROW_INDEX, concat(lpad(dist,4,'0'),'-',lpad(mslno,5,'0'),'-',lpad(chkdgt,1,'0')) msl_code, A.NAME, GROUP_ID, SUBJECT, DETAIL, A.IP, CREATE_DATE, CREATE_TIME,CHK_MAIL, EMAIL, PHONE, ANSWER ANSWER_COUNT
, B.ROW_INDEX ANSWER_INDEX, B.ANSWER_DETAIL, B.ANSWER_DATE, B.ANSWER_TIME, B.ANSWER_NAME, C.GROUPNAME
FROM WEBBOARD A LEFT JOIN WEBBOARD_DETAIL B ON A.ROW_INDEX = B.LIST_NO 
LEFT JOIN WEBBOARD_GROUP C ON C.ID = A.GROUP_ID ".$y.$z." LIMIT ".$start." , ".$limit;
$webboard = mysql_query($query, $bwc_webboard) or die($query);
//echo "  cfd ". $query;
/*$query2 = "SELECT * FROM webboard_detail WHERE answer_detail";
$webboard = mysql_query($query, $bwc_webboard) or die($query);*/

$totalRows_webboard = mysql_num_rows($webboard);
//echo $Query;

if ($totalRows_webboard==0) {
 AlertMessage("ไม่พบรหัสสมาชิกหรือ ระบุรหัสสมาชิกไม่ถูกต้อง","javascript:history.back();");
 exit;
}

?>

<table cellpadding="2" cellspacing="0">
  <tr  style="background-color:#CC0066;" >
    <td align="left" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    
    <td  align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td  align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
 
  </tr>
<?php 
$i =1;
$oldindex = "0";
while ($row_webboard=mysql_fetch_assoc($webboard))
{
	
	if  (($i%2)==0) {
		$bg="#FFFEFB";
	}
	else {
		$bg ="#FFF9FC";
		$f_color ="#000000";
		$f_w ="normal";
	}
	
 $newindex = $row_webboard['ROW_INDEX'];
 
 if ($oldindex != $newindex) { 
    $oldindex = $newindex;
 	?>
   <tr  bgcolor="<?php  echo $bg;?>" nowrap  style="color:<? echo $f_color;?>;font-weight:<? echo $f_w;?>" valign="top">
    <td align="center" valign="top"> <?php echo $i; ?></td>
    <td align="center"  valign="top" nowrap="nowrap"><font color="#CC0066" size="-1">รหัสสมาชิก</font><br />
     <?php  echo  $row_webboard['msl_code']; ?></td>
    <td align="left" valign="top">
    <table  border="0" cellpadding="0" cellspacing="0">
    <tr valign="top">
      <td><font color="#CC0066" size="-1">ชื่อ-สกุล </font></td>
      <td>&nbsp;</td>
      <td><?php  echo  $row_webboard['NAME']; ?></td>
    </tr>
    <tr>
      <td><font color="#CC0066" size="-1">IP  </font></td>
      <td>&nbsp;</td>
      <td><?php  echo  $row_webboard['IP']; ?></td>
    </tr>
    <tr>
      <td><font color="#CC0066" size="-1">อีเมลล์ </font></td>
      <td>&nbsp;</td>
      <td><?php  echo $row_webboard['EMAIL']; ?></td>
    </tr>
    <tr>
      <td><font color="#CC0066" size="-1">โทรศัพท์ </font></td>
      <td>&nbsp;</td>
      <td><?php  echo $row_webboard['PHONE']; ?></td>
    </tr>
    <tr>
      <td><font color="#CC0066" size="-1">วัน/เวลา</font></td>
      <td>&nbsp;</td>
      <td><?php  echo func_ConvertDateToString($row_webboard['CREATE_DATE'],$row_webboard['CREATE_TIME']); ?></td>
    </tr>
    <tr>
      <td><font color="#CC0066" size="-1">กลุ่มคำถาม</font></td>
      <td>&nbsp;</td>
      <td><?php echo  $row_webboard['GROUP_ID'];?></td>
    </tr>
    <tr>
      <td><font color="#CC0066" size="-1">ถามเรื่อง</font></td>
      <td>&nbsp;</td>
      <td><?php echo  $row_webboard['GROUPNAME'];?></td>
    </tr>
    </table>
    </td>
    <td align="left" valign="top"><p><font color="#CC0066" size="-1">หัวข้อ</font><br />
      <?php  echo  $row_webboard['SUBJECT']; ?>
      <br />
      <font color="#CC0066" size="-1"><br />
        </font><?php echo $row_webboard['DETAIL']; ?></p>
      <p><font color="#7D053F" size="-1">ตอบ
          <?php  echo "^^".$row_webboard['ANSWER_TIME'].$row_webboard['ANSWER_DETAIL']; ?>
      </font><br />
     </p></td>
    <td  align="center" valign="top" nowrap="nowrap">
      <font color="#CC0066" size="-1">เช็คเมลล์</font><br />
      <?php  echo  $row_webboard['CHK_MAIL']; ?>
      <br />
    </td>
    <td align="center" valign="top" nowrap="nowrap"><font color="#CC0066" size="-1">ตอบ</font><br />
     <?php  echo $row_webboard['ANSWER_COUNT'] ?></td>
    <td align="center" valign="top" >&nbsp;</td>
    <td align="center" valign="top" ><input type="button"  name="Button22" style="width:150px" value="ตอบด้วยอีเมลล์" onclick="window.location='contact_email.php?row_index=<?php  echo  $row_webboard['ROW_INDEX']; ?>'" />
	
	<!--<input type="button"  name="Button22" style="width:150px" value="DEMO" onclick="window.location='https://bworder.com/update_question/contact_email.php?row_index=<?php  echo  $row_webboard['ROW_INDEX']; ?>'" /> --> 
	
     <br /><hr/>
     <input style="width:150px" type="button" name="Button" value="**ลบข้อมูลนี้**"  onclick="JavaScript:DeleteFAQ('','DELETE',<?php  echo  $row_webboard['ROW_INDEX']; ?>);" /></td>
    <td align="center" valign="top" ><font color="#CC0066" size="-1">row_index</font><br />
     <?php  echo $row_webboard['ROW_INDEX']; ?></td></td>
    
    
    <!-- <td align="center" nowrap><?php  //echo func_ConvertDateToString($row_mslmst['REG_DATE'],''); ?></td>
    <td align="center" nowrap><?php // echo $row_mslmst['REG_DATE']; ?></td>-->
  </tr>
 <?php } ?>
   <tr>
     <td valign="top" nowrap="nowrap" colspan="10">&nbsp;</td>
    
   </tr>
   <tr>
    
   </tr>
 <?php 
    if ($oldindex != $newindex) {  ?>
   <tr  bgcolor="<?php  echo $bg;?>" nowrap  style="color:<? echo $f_color;?>;font-weight:<? echo $f_w;?>" valign="top" height="1">
     <td height="1" colspan="11" align="center" valign="top" bgcolor="#FFBBDD"></td>
   </tr>
 <?php } 
  $i=$i+1;
}
  ?>
</table>
<?php $Page = ceil($row_total/$limit); 
for($i=1;$i<=$Page;$i++){
	if($_GET['page']==$i){
		echo "[<a href='?start=".$limit*($i-1)."&page=$i'><B>$i</B></a>]";
		
//data_contactus_ajax.php		''++'&page='+page+'&dist='+dist+'&mslno='+mslno+'&chkdgt='+chkdgt+'&datefrom='+datefrom+'&dateto='+dateto+'&email='+email+"&fselect="+fselect
	}else{
		//echo "[<a href='data_contactus_ajax.php?start=".$limit*($i-1)."&page=$i'>$i</a>]";
		echo "[<a href=JavaScript:doCallAjax('DIST',$i)>$i</a>]";
		//JavaScript:doCallAjax('DIST',1);
		
		}
	
	}
//	echo "page =$curPage";
?>
<hr />
<?php 
mysql_free_result($webboard); 
//@mysql_close(); 
?>
