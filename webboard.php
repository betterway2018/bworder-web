
<?php  session_start(); ?>
<?php require("i_config.php"); ?>
<?php require("check_login.php"); ?>
<?php require("Connections/bwc_webboard.php"); ?>


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

$currentPage = $_SERVER["PHP_SELF"];
$maxRows_webboard = 25;
$page = 1;

if (isset($_GET['page'])) {
  $page = $_GET['page'];
}
$startRow_webboard = ($page-1) * $maxRows_webboard;

mysql_select_db($database_bwc_webboard, $bwc_webboard);
$query_webboard = "SELECT ROW_INDEX, NAME, SUBJECT,ANSWER FROM webboard ORDER BY ROW_INDEX";
$query_limit_webboard = sprintf("%s LIMIT %d, %d", $query_webboard, $startRow_webboard, $maxRows_webboard);
$webboard = mysql_query($query_limit_webboard, $bwc_webboard) or die(mysql_error());
$row_webboard = mysql_fetch_assoc($webboard);

if (isset($_GET['totalRows'])) {
  $totalRows = $_GET['totalRows'];
} else {
  $all_webboard = mysql_query($query_webboard);
  $totalRows = mysql_num_rows($all_webboard);
}

$totalPages_webboard = ceil($totalRows/$maxRows_webboard);

$queryString_webboard = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "page") == false && 
        stristr($param, "totalRows") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_webboard = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_webboard = sprintf("&totalRows=%d%s", $totalRows, $queryString_webboard);
 ?>

<?php
	$dist = $_SESSION['dist'];
	$mslno=$_SESSION['mslno'];
	$chkdgt = $_SESSION['chkdgt'];
	$rep_name =$_SESSION['name'];

	if ($dist=="" || $mslno=="" || $chkdgt=="") {
		echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
	}
	
	mysql_select_db($database_bwc_webboard, $bwc_webboard);
	$query = "SELECT * FROM WEBBOARD_GROUP ORDER BY ID";
	$group = mysql_query($query, $bwc_webboard) or die(mysql_error());
	$row_group = mysql_fetch_assoc($group);
	$totalRows_group = mysql_num_rows($group);

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
    <td height="480" align="left" valign="top" class="Sheet_Boder" style="padding:2px"><table width="710" border="0" align="center" cellpadding="4" cellspacing="1" class="FormBorder_3">
      <tr class="content_header">
        <td width="39" align="right" bgcolor="#003300" style="padding-right:10px"><strong>ลำดับ</strong></td>
        <td width="608" bgcolor="#003300"><strong>รายละเอียด</strong></td>
        <td width="34" align="center" bgcolor="#003300">&nbsp;</td>
        </tr>
      <?php 
	  	  $i=1;
	  do { 
			if (fmod($i, 2)==0){
				$bg="#B8E5C9";
			}
			else {
				$bg="#E7F5EC";
			}
	  ?>
        <tr >
          <td align="right"  style="padding-right:10px" bgcolor="<? echo $bg; ?>"><?php echo $i."."; ?></td>
          <td  bgcolor="<? echo $bg; ?>"><a href="webboard_detail.php?id=<? echo $row_webboard['ROW_INDEX'] ?>" target="_parent"><?php echo $row_webboard['SUBJECT']; ?><?php echo "(".$row_webboard['ANSWER'].")"; ?></a></td>
          <td align="center" bgcolor="<? echo $bg; ?>">&nbsp;</td>
          </tr>

        <?php 
			$i++;
		} while ($row_webboard = mysql_fetch_assoc($webboard)); ?>
        </table>
      <table width="710" border="0" align="center" cellpadding="1" cellspacing="1">
        <tr>
          <td width="100" valign="top" nowrap="nowrap">&nbsp;
            <?php if ($page > 1) { // Show if not first page ?>
            <a href="<?php printf("%s?page=%d%s", $currentPage, 1, $queryString_webboard); ?>">หน้าแรก</a>
            <?php } else { echo "หน้าแรก" ;} // Show if not first page ?>
            <?php if ($page > 1) { // Show if not first page ?>
            <a href="<?php printf("%s?page=%d%s", $currentPage, max(1, $page -1), $queryString_webboard); ?>">หน้าที่แล้ว</a>
            <?php }else { echo "หน้าที่แล้ว" ;}  // Show if not first page ?></td>
          <td width="463" align="center" valign="top"><?php

/* ตัวแบ่งหน้า */
for($i=1;$i<=$totalPages_webboard;$i++){
	if($_GET['page']==$i){ //ถ้าตัวแปล page ตรง กับ เลขที่วนได้  ?>
            <font size="+1"><a href="<?php printf("%s?page=%d%s", $currentPage, max(1, $i), $queryString_webboard); ?>"><? echo $i ?></a></font>&nbsp;
            <?	}else{ ?>
            <a href="<?php printf("%s?page=%d%s", $currentPage, max(1, $i ), $queryString_webboard); ?>"><? echo $i?></a>&nbsp;
            <?            
	}
		if ($i >25 ){ 
			echo "...";
			break ;
		}
}	
?></td>
          <td width="50" align="right" valign="top" nowrap="nowrap"><?php if ($page < $totalPages_webboard) { // Show if not last page ?>
            <a href="<?php printf("%s?page=%d%s", $currentPage, min($totalPages_webboard, $page + 1), $queryString_webboard); ?>">หน้าถัดไป</a>
            <?php } else { echo "หน้าถัดไป" ;}  // Show if not last page ?>
            <?php if ($page < $totalPages_webboard) { // Show if not last page ?>
            <a href="<?php printf("%s?page=%d%s", $currentPage, $totalPages_webboard, $queryString_webboard); ?>">หน้าสุดท้าย</a>
            <?php } else { echo "หน้าสุดท้าย" ;}  // Show if not last page ?></td>
        </tr>
      </table>
      <!-- Start  Content  -->    
    
    
    
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
?>
