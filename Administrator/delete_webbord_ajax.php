<?php session_start();

header('Content-type: text/html; charset=windows-874');
include("../i_function_msg.php");
require_once("../Connections/bwc_webboard.php");
include("i_convert.php"); 
                $dateto     = $_GET['searchdateto'];
				$datefrom	=$_GET['searchdatefrom'];
				$curPage=$_GET['page'];
				$strMode=$_GET['strMode'];
				$chkbox=$_GET['chkbox'];
			
	if ($strMode == 'DELETE' )
	 {     
	    if(!empty($_GET['chkbox'])) 
		  {  
					foreach($_GET['chkbox'] as $row_index) 
					 {  
					  
						 $delete =  mysql_query("Delete from webboard where row_index =" . $row_index, $bwc_webboard) 
								or die("<br><br>Error : ". mysql_error());
							
						
					 } 	
					 
					
			 }
			 else
			 {
                echo "<script>alert('กรุณาเลือกข้อมูลต้องการลบ');</script>";
			 
			 }

    
		/// echo"<meta http-equiv='refresh' content='0'>";
		
	}

		
			
/*=================== Condition======================*/
			if ($curPage == "") $curPage =1;
				if ($MySort == "") $MySort = "A.DIST"; 
	$MySort = "A.row_index desc";//ลบ
			
			
/*=================== Date ======================*/				
if ($datefrom <>"" and $dateto <>"") 
       $y = $y." and A.create_date 
	                  between REPLACE('" . $datefrom . "','-','') 
	                   and REPLACE('" . $dateto . "','-','') " ; 
else if ($datefrom	 <>"") 
	   $y = $y." and A.create_date >= REPLACE('" . $datefrom . "','-','') "; 
	 else if ($dateto	 <>"")
		$y = $y." and A.create_date <= REPLACE('" . $dateto . "','-','') "; 
/*=================== Query ======================*/

                $limit = 15;
				$start=$limit * ($curPage-1);
				if(!isset($start)){
				$start = 0;
				}
		$query2 = "SELECT  A.ROW_INDEX
		                   FROM WEBBOARD A 
		                  LEFT JOIN WEBBOARD_DETAIL B ON A.ROW_INDEX = B.LIST_NO 
                          LEFT JOIN WEBBOARD_GROUP C ON C.ID = A.GROUP_ID  where  A.answer > 0  ".$y;
//$total = mysql_query($query2, $bwc_webboard) or die("ERROR QUERY"."<font style='color:#ffffff'>".$query2."</font>");
//echo $query2;
$total = mysql_query($query2, $bwc_webboard) or die("<meta http-equiv='refresh' content='0'>");
$row_total = mysql_num_rows($total);
//echo $row_total;
/*
if ($row2 = mysql_fetch_array($total))
{
    $row_total= $row2['row_total'];
}
*/
$query = "SELECT A.ROW_INDEX, concat(lpad(dist,4,'0'),'-',lpad(mslno,5,'0'),'-',lpad(chkdgt,1,'0')) msl_code, A.NAME, GROUP_ID, SUBJECT, DETAIL, A.IP, CREATE_DATE, CREATE_TIME,CHK_MAIL, EMAIL, PHONE, ANSWER ANSWER_COUNT
, B.ROW_INDEX ANSWER_INDEX, B.ANSWER_DETAIL, B.ANSWER_DATE, B.ANSWER_TIME, B.ANSWER_NAME, C.GROUPNAME
FROM WEBBOARD A LEFT JOIN WEBBOARD_DETAIL B ON A.ROW_INDEX = B.LIST_NO 
LEFT JOIN WEBBOARD_GROUP C ON C.ID = A.GROUP_ID WHERE  A.answer > 0  ".$y." LIMIT ".$start." , ".$limit;
$webboard = mysql_query($query,$bwc_webboard) or die($query);

$totalRows_webboard = mysql_num_rows($webboard);
//echo $Query;

if ($totalRows_webboard==0) {
 AlertMessage("ไม่พบรหัสสมาชิกหรือ ระบุรหัสสมาชิกไม่ถูกต้อง","javascript:history.back();");
 exit;
}
			
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>doCallAjax_Administrator BWORDER</title>
</head>
<body>
 <form name="FrmUser"  action="delete_webbord - Copy.php" method="GET" >

<table cellpadding="2" cellspacing="0">
  <tr  style="background-color:#CC0066;" >
    <td align="left" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td align="left" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    
    <td  align="left" valign="top">&nbsp;</td>
    <td align="left" valign="top">&nbsp;</td>
    <td  align="left" valign="top">&nbsp;</td>
  
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
   <td align="center" valign="top"> 	
   <input type='checkbox' name='chkbox[]' id='chkbox' value="<?=$row_webboard['ROW_INDEX'];?>"  <?=$checked?> /></td>
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

		echo "[<a href=JavaScript:doCallAjax('DIST',$i,$datefrom,$dateto)>$i</a>]";
		//JavaScript:doCallAjax('DIST',1);
		
		}
	
	}
//	echo "page =$curPage";
?>
</p>
<hr />
<?
mysql_free_result($webboard); 
//@mysql_close(); 
?>
</form>
</body>
</html>
