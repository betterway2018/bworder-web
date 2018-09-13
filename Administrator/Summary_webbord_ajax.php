<?php session_start();

header('Content-type: text/html; charset=windows-874');
include("../i_function_msg.php");
require_once("../Connections/bwc_webboard.php");
include("i_convert.php"); 
                $dateto     = $_GET['searchdateto'];
				$datefrom	=$_GET['searchdatefrom'];
				$sel_group=$_GET['sel_group'];
				
				
		
		
			
/*=================== Condition======================*/
			if ($curPage == "") $curPage =1;
				if ($MySort == "") $MySort = "A.DIST"; 
	$MySort = "A.row_index desc";//ลบ
			
			
/*=================== Date ======================*/				
if ($datefrom <>"" and $dateto <>"") 
       $y = $y." and webboard.create_date 
	                  between REPLACE('" . $datefrom . "','-','') 
	                   and REPLACE('" . $dateto . "','-','') " ; 
else if ($datefrom	 <>"") 
	   $y = $y." and .create_date >= REPLACE('" . $datefrom . "','-','') "; 
	 else if ($dateto	 <>"")
		$y = $y." and   webboard.create_date <= REPLACE('" . $dateto . "','-','') "; 
		
		if($sel_group <> "")
		{
		  $sel_group =" and   webboard.GROUP_ID = ".$sel_group;
		
		}
/*=================== Query ======================*/

                $limit = 15;
				$start=$limit * ($curPage-1);
				if(!isset($start)){
				$start = 0;
				}
				
	
$query ="SELECT  webboard_group.GroupName,count(CASE WHEN answer = 0  THEN 1 end ) as notanswer,count(CASE WHEN answer > 0  THEN 1 end ) as answer,count(*) as total
 FROM webboard
 left Join webboard_group ON webboard.GROUP_ID = webboard_group.ID 
WHERE  1=1 ".$y." ".$sel_group."  group by webboard.GROUP_ID ";
//echo $query."ddddd";
$webboard = mysql_query($query,$bwc_webboard) or die("ERROR");
//echo $webboard."-------webboard-------"."   ";
$totalRows_webboard = mysql_num_rows($webboard);
//echo "totalRows_webboard        ".$totalRows_webboard;
/* ----------------------------------------------------*/
	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>doCallAjax_Administrator BWORDER</title>
</head>
<body>
 <form name="FrmUser"  action="delete_webbord - Copy.php" method="GET" >

<table width="996" cellpadding="2" cellspacing="0">
  <tr  style="background-color:#FFCCCC;" >
    <td width="37" align="left" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td width="35" align="left" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="580" align="center" valign="top">กลุ่มคำถาม</td>
	  <td width="103" align="left" valign="top">จำนวนรายการที่ยังไม่ตอบคำถาม</td>
	  <td width="103" align="left" valign="top">จำนวนรายการที่ตอบคำถามเเล้ว</td>
    <td width="103" align="left" valign="top">จำนวนรายการทั้งหมด</td>
  </tr>
<?php 
if ($totalRows_webboard==0) {
?>
<tr  bgcolor="<?php  echo $bg;?>" nowrap  style="color:<? echo $f_color;?>;font-weight:<? echo $f_w;?>" valign="top">
 
    <td align="center" valign="top" colspan="6">ไม่พบข้อมูลที่ค้นหา</td>
   

  </tr>

<? 
}


$i=0;
$oldindex = "0";
while ($row_webboard=mysql_fetch_assoc($webboard))
{
	$i++;
	if  (($i%2)==0) {
		$bg="#FFFEFB";
	}
	else {
		$bg ="#FFF9FC";
		$f_color ="#000000";
		$f_w ="normal";
	}

   
 	?>
	
   <tr  bgcolor="<?php  echo $bg;?>" nowrap  style="color:<? echo $f_color;?>;font-weight:<? echo $f_w;?>" valign="top">
   <td align="center" valign="top"><?php echo $i; ?></td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="left" valign="top" >
     <?php  echo  $row_webboard['GroupName']; ?></td>
	  <td align="left" valign="top"> <?php  echo  $row_webboard['notanswer']; ?>	</td>
	 <td align="left" valign="top"> <?php  echo  $row_webboard['answer']; ?>	</td>
    <td align="left" valign="top"> <?php  echo  $row_webboard['total']; ?>	</td>
  </tr>

   <tr>
     <td valign="top" nowrap="nowrap" colspan="10">&nbsp;</td>
   </tr>
   <tr>   </tr>
    <?php } ?>
</table>
  

</p>
<hr />

</form>
</body>
</html>
