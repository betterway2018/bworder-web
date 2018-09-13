<?php require_once('Connections/bwc_webboard.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}


  function func_CertDateToString($iDate,$iTime) {
			$yy=substr($iDate,0,4);
			$mm=substr($iDate,4,2);
			$dd=substr($iDate,6,2);
			$time=substr($iTime,0,2).":".substr($iTime,2,2).":".substr($iTime,4,2);
			return $dd."/".$mm."/".$yy."  ".$time;
  }




$colname_webboard = "-1";
if (isset($_GET['id'])) {
  $colname_webboard = $_GET['id'];
}
mysql_select_db($database_bwc_webboard, $bwc_webboard);
$query_webboard = sprintf("SELECT * FROM webboard WHERE ROW_INDEX = %s", GetSQLValueString($colname_webboard, "int"));
$webboard = mysql_query($query_webboard, $bwc_webboard) or die(mysql_error());
$row_webboard = mysql_fetch_assoc($webboard);
$totalRows_webboard = mysql_num_rows($webboard);

$colname_detail = "-1";
if (isset($_GET['id'])) {
  $colname_detail = $_GET['id'];
}
mysql_select_db($database_bwc_webboard, $bwc_webboard);
$query_detail = sprintf("SELECT * FROM webboard_detail WHERE ROW_INDEX = %s ORDER BY LIST_NO ASC", GetSQLValueString($colname_detail, "int"));
$detail = mysql_query($query_detail, $bwc_webboard) or die(mysql_error());
$row_detail = mysql_fetch_assoc($detail);
$totalRows_detail = mysql_num_rows($detail);
  session_start(); ?>
<?php require("i_config.php"); ?>
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
<style type="text/css">
<!--
.style6 {color: #0000FF}
.style8 {color: #0000FF; font-weight: bold; }
-->
</style>
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
    <td height="480" align="left" valign="top" class="Sheet_Boder" style="padding:2px"><table width="710" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="9" align="right" valign="top"><img src="images/Box_Set4/bd3_01.gif" width="9" height="9" /></td>
        <td width="700" align="left" valign="top"><img src="images/Box_Set4/bd3_02.gif" width="700" height="9" /></td>
        <td width="10" align="left" valign="top"><img src="images/Box_Set4/bd3_03.gif" width="9" height="9" /></td>
      </tr>
      <tr>
        <td align="right" valign="top" ><img src="images/Box_Set4/bd3_04.gif" width="9" height="160" /></td>
        <td align="left" valign="top" bgcolor="#EEF5FD" style="FILTER: progid:DXImageTransform.Microsoft.Gradient(startColorStr=#F9FBFD, endColorStr=#EEF5FD, gradientType=0)" ><table width="100%" border="0" cellspacing="2" cellpadding="0">
          <tr>
            <td align="right" ><strong>ชื่อ</strong></td>
            <td class="content_header2"><?php echo $row_webboard['NAME']; ?></td>
          </tr>
          <tr>
            <td height="16" align="right" ><strong>รหัสสมาชิก</strong></td>
            <td class="content_header2" ><?php echo $row_webboard['DIST']."-". substr("00000".$row_webboard['MSLNO'],-5)."-".$row_webboard['CHKDGT']; ?></td>
          </tr>
          <tr>
            <td align="right" valign="middle" ><strong>รายละเอียด</strong></td>
            <td valign="top" class="content_header2" ><?php echo $row_webboard['SUBJECT']; ?></td>
          </tr>
          <tr>
            <td align="right" >&nbsp;</td>
            <td valign="top" class="content_header2"><textarea name="textarea" cols="118" rows="5" readonly="readonly" id="textarea"  class="content_header2"  style="border:none;background-color:#EEF5FD"><?php echo $row_webboard['DETAIL']; ?></textarea></td>
          </tr>
          <tr>
            <td width="11%" align="right" ><strong>วันที่ / เวลา </strong></td>
            <td width="89%" class="content_header2" ><?php echo  func_CertDateToString($row_webboard['CREATE_DATE'],$row_webboard['CREATE_TIME']) ?></td>
          </tr>
        </table></td>
        <td align="left" valign="top" ><img src="images/Box_Set4/bd3_06.gif" width="9" height="160" /></td>
      </tr>
      <tr>
        <td align="right" valign="top"><img src="images/Box_Set4/bd3_07.gif" width="9" height="9" /></td>
        <td align="left" valign="top"><img src="images/Box_Set4/bd3_08.gif" width="700" height="9" /></td>
        <td align="left" valign="top"><img src="images/Box_Set4/bd3_09.gif" width="9" height="9" /></td>
      </tr>
    </table>
      <table width="715" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="219">&nbsp;</td>
          <td width="461" align="right"><input type="button" name="button" id="button" value="&lt;&lt; กลับไปยังหน้าหลัก"  onclick="javascript:window.location='webboard.php'" />
            <input type="button" name="button2" id="button2" value="ตอบกระทู้ &gt;&gt;" onclick="javascript:window.location='#ans'" /></td>
        </tr>
      </table>
<br />
	  <?php
		if  ($totalRows_detail  !=0) {
			
			$i=1;
		
		do { ?>
        <table width="710" border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
              <td><fieldset  style="padding:8px">
              
              	ความคิดเห็นที่ <?php echo $i ?><br />

                <?php echo $row_detail['ANSWER_DETAIL']; ?>
                
                <br />
                <br />
              ผู้ตอบคำถาม 
              <?php echo $row_detail['ANSWER_NAME']; ?>
              <br />
              วันที่ /เวลา  
              <?php echo  func_CertDateToString( $row_detail['ANSWER_DATE'],$row_detail['ANSWER_TIME']) ?>
           
            </fieldset></td>
          </tr>
        </table>
   <?php 
   		$i++;
   } while ($row_detail = mysql_fetch_assoc($detail)); ?>   

<?php }  // if  ($totalRows_detail  !=0) { ?>
<br />
<br />
<br />
    
    <form action="" method="get">
      <table width="715" border="0" align="center" cellpadding="2" cellspacing="1">
        <tr>
          <td width="138" align="right"><a name="ans" id="ans"></a>ชื่อผู้แสดงความคิดเห็น</td>
          <td width="566"><input name="textfield" type="text" id="textfield" size="80" maxlength="150" /></td>
        </tr>
        <tr>
          <td align="right">รหัสสมาชิก </td>
          <td><input name="textfield2" type="text" id="textfield2" size="5" maxlength="5" />
            -
              <input name="textfield3" type="text" id="textfield3" size="7" maxlength="7" />
              -
              <input name="textfield4" type="text" id="textfield4" size="2" maxlength="1" /></td>
        </tr>
        <tr>
          <td align="right" valign="top">ความคิดเห็น</td>
          <td><textarea name="textarea2" id="textarea2" cols="100" rows="5"></textarea></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td><input type="submit" name="button3" id="button3" value="Submit" />
            <input type="submit" name="button4" id="button4" value="Submit" /></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
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
<?php
mysql_free_result($webboard);

mysql_free_result($detail);
?>
