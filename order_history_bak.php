<?php  session_start(); ?>
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
    <td class="Sheet_Boder"  ><?php include("i_header_no.php"); ?>
</td>
  </tr>
  <tr>
    <td height="480" align="center" valign="top" class="Sheet_Boder" style="padding:2px"><br />
<!-- Start  Content  -->    
    
    <?php
	
	$dist=$_SESSION['dist'];
	$mslno=$_SESSION['mslno'];
	$chkdgt=$_SESSION['chkdgt'];
	$rep_name=$_SESSION['name'];
	
	
	if ($dist=="" || $mslno=="" || $chkdgt=="") {
		echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
	}


	$DataToSend="dist=$dist&mslno=$mslno&chkdgt=$chkdgt";
	$postUrl="http://mailsrv-01.mistine.co.th/webservice/order_header.asp"  . "?".$DataToSend;

?>
    <table 
                  width="709" height="73" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
      <tbody>
        <tr>
          <td height="5"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_01.gif" 
                        width="5" /></td>
          <td width="700"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_02.gif" 
                        width="700" /></td>
          <td width="10"><img height="5" alt="" 
                        src="Images/Box_Set3/frame_03.gif" 
                        width="5" /></td>
        </tr>
        <tr>
          <td valign="top" width="5" 
                      background="Images/Box_Set3/frame_04.gif" 
                      height="62"><img height="2" alt="" 
                        src="Images/Box_Set3/frame_04.gif" 
                        width="5" /></td>
          <td valign="top" bgcolor="#ffffff"><table width="100%" border="0" cellspacing="1" cellpadding="1">
            <tr>
              <td width="14%" align="right">รหัสสมาชิก : </td>
              <td width="86%" align="left"><? printf("%s-%s-%s ",$_SESSION['dist'],$_SESSION['mslno'],$_SESSION['chkdgt']); ?></td>
              </tr>
            <tr>
              <td align="right">ชื่อสมาชิก : </td>
              <td align="left"><?php echo $_SESSION['name'];?>&nbsp;</td>
              </tr>
            <tr>
              <td height="20" align="right">อีเมลล์ : </td>
              <td align="left"><? echo $_SESSION['email']; ?>&nbsp;</td>
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
                        width="700" /></td>
          <td><img height="5" alt="" 
                        src="Images/Box_Set3/frame_09.gif" 
                        width="5" /></td>
        </tr>
      </tbody>
    </table>
    <br />
<table width="714" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr style="font-family:Verdana, Geneva, sans-serif;color:#226543;font-weight:bold;font-size:11px">
    <td width="43" height="25" align="center"  style="border-top:#666 solid 1px;border-bottom:#666 solid 1px;border-left:#666 solid 1px;">ลำดับ</td>
    <td width="91" align="center" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">รอบจำหน่าย</td>
    <td width="124" align="center" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">วันที่พิมพ์ใบกำกับภาษี</td>
    <td width="150" align="center" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">เลขที่ใบกำกับภาษี</td>
    <td width="111" align="left" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">Order Source</td>
    <td width="119" align="right" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">มูลค่าผลิตภัณฑ์สุทธิ</td>
    <td width="64" align="center" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">&nbsp;</td>
    <td width="12" align="center" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px;border-right:#666 solid 1px;">&nbsp;</td>
  </tr>
  <tr style="font-family:Verdana, Geneva, sans-serif;color:#226543;font-weight:bold;font-size:11px">
    <td colspan="8" align="left" valign="top"  style="border-top:#666 solid 1px;border-bottom:#666 solid 1px;border-right:#666 solid 1px;border-left:#666 solid 1px"><iframe  src="<?php echo $postUrl; ?>" width="709" height="380" frameborder="0" scrolling="YES"> </iframe></td>
    </tr>

</table>
<br /><center>
      <a href="index.php" target="_parent"><br />
      <img src="images/BWorder_web_35.gif" alt="หน้าหลัก" width="72" height="19" border="0" /></a></center><br />
    
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