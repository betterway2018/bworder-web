<?php  
session_start();
require("i_config.php"); 
include("check_login.php");
require_once('Connections/bwc_orders.php'); 

require_once('nusoap.php'); 
$ws_client = new soapclient('http://webservice.mistine.co.th/webservice/dsm_order_service_dsm_newuser.php?wsdl',true); 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><?php  echo $title?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="Styles/main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript"> 
	function autoTabRepCode(obj){ 
	/* ��˹��ٻẺ��ͤ�������� _ ᷹������á��� ���ǵ����������ͧ���� 
	�����ѭ�ѡɳ������� �蹡�˹��� �ٻẺ�Ţ���ѵû�ЪҪ� 
	4-2215-54125-6-12 ������ö��˹��� _-____-_____-_-__ 
	�ٻẺ�������Ѿ�� 08-4521-6521 ��˹��� __-____-____ 
	���͡�˹������� 12:45:30 ��˹��� __:__:__ 
	������ҧ��ҧ��ҧ�繡�á�˹��ٻẺ�Ţ�ѵû�ЪҪ� 
	*/ 
	var pattern=new String("___-_____-_"); // ��˹��ٻẺ㹹�� 
	var pattern_ex=new String("-"); // ��˹��ѭ�ѡɳ���������ͧ���·������㹹�� 
	var returnText=new String(""); 
	var obj_l=obj.value.length; 
	var obj_l2=obj_l-1; 
	for(i=0;i<pattern.length;i++){ 
	if(obj_l2==i && pattern.charAt(i+1)==pattern_ex){ 
	returnText+=obj.value+pattern_ex; 
	obj.value=returnText; 
	} 
	} 
	if(obj_l>=pattern.length){ 
	obj.value=obj.value.substr(0,pattern.length); 
	} 
	} 
</script> 

<script type="text/javascript">
	function clear_vlaue() {
		var frm  = document.getElementById('form1');
		// 	frm.setAttribute('action','?doMode=Insert');		
		document.getElementById("doMode").value="Reset";		
		frm.submit();
			
	}
	
	function form_submit() {
		var frm  = document.getElementById('form1');
		if (document.getElementById('sel_camp').value=="") {
			alert("��س����͡�ͺ��˹���");
			document.getElementById('sel_camp').focus();
			return false;
		}
		// 	frm.setAttribute('action','?doMode=Insert');	
		document.getElementById("doMode").value="Query";		
		frm.submit();
	}	

	function gotopage(pageno) {
		document.getElementById('curpage').value=pageno;
		document.getElementById("doMode").value="View";
		form_submit();
	}
	
	HttPRequest.onreadystatechange = function()
			{

				 if(HttPRequest.readyState == 3)  // Loading Request
				  {
				   document.getElementById("mySpan").innerHTML = "��س����ѡ���� ...";
				  }

				 if(HttPRequest.readyState == 4) // Return Request
				  {
				   document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
				  }
				
			}
	
	
	
</script>

</head>


<?php

// Query   Campaign   for Order by Dist
$orddate=date('Ymd');
$dist=$_SESSION['dist'];
require("i_MailPlan.php"); 

	if ($campaign_limit=="") {
		$campaign_limit=4;
	}

	mysql_select_db($database_bwc_orders, $bwc_orders);
    $query_campaign = "select * from tbl008 where  camp <= (select camp from tbl008 where status='Current')  order by camp desc limit  $campaign_limit";
    $campaign = mysql_query($query_campaign, $bwc_orders) or die(mysql_error());
	mysql_close($bwc_orders);
    $row_campaign = mysql_fetch_assoc($campaign);
    $totalRows_campaign = mysql_num_rows($campaign);
  
    ?>

<body>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FDB5CF"></td>
  </tr>
</table>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td>
    <table width="860" border="0" cellspacing="0" cellpadding="0">
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
  <td height="200" align="center" valign="top" class="Sheet_Boder" style="padding:2px"><!-- Start  Content  -->    
    
     <?php
	//  Use for maintenance Only
	
	//echo "�����¤�� .... �Դ��Ѻ��ا���Ǥ��Ǥ��";
	//	exit;
	
	?>
    
    
     
    <!--- Start Content hear -->
      <?php 
      if ($_SERVER['REQUEST_METHOD']="POST" && isset($_POST['doMode']) && $_POST['doMode']=="Query") {
			//$dist= $_POST['dist'];
			//$mslno=$_POST['mslno'];
			//$chkdgt=$_POST['chkdgt'];
			$sel_camp=$_POST['sel_camp'];
			$sel_order_by = $_POST['sel_order_by'];
			$sel_asc = $_POST['sel_asc'];
			$totalrow = $_POST['totalrow'];
			
			$dist=$_SESSION['dist'];
			$mslno=$_SESSION['mslno'];
			$chkdgt=$_SESSION['chkdgt'];
			
			/*echo "eee".$dist.$mslno.$chkdgt;
			exit;*/
			
			if ($dist=="" || $mslno=="" || $chkdgt=="") {
				echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
			}
			include("i_WebService_config.php");
			$DataToSend="dist=$dist&mslno=$mslno&chkdgt=$chkdgt&camp=$sel_camp&orderby=$sel_order_by&asc=$sel_asc";
		}
		elseif ($_SERVER['REQUEST_METHOD']="POST" && isset($_POST['doMode']) && $_POST['doMode']=="Reset") {
			$mslno="";
			$chkdgt="";
			$sel_camp="";
		}
?>

      <form id="form1" name="form1" method="post" action="">
        <table width="871" border="0" cellspacing="0" cellpadding="0" >
          <tr>
              <td width="871" align="right"><fieldset><table width="870" border="0" cellspacing="0" cellpadding="0" align="left">
              <tr>
                <td align="right">&nbsp;</td>
                <td colspan="2" align="left">&nbsp;</td>
              </tr>
              <tr>
                <td width="151" align="right" valign="top">������Ҫԡ :<br />
                  ������Ҫԡ : </td>
                <td colspan="2" align="left">&nbsp;<?php echo $_SESSION['dist'];?>-<?php echo $_SESSION['mslno'];?>-<?php echo $_SESSION['chkdgt'];?>&nbsp;<br />                  &nbsp;<?php echo $_SESSION['name'];?></td>
              </tr>
              <tr>
                <td height="23" align="right">�ͺ��˹��� : </td>
                <td width="432" align="left">
                <select name="sel_camp" id="sel_camp">
                  <option value="" >== ���͡�ͺ��˹��� ==</option>
                                    <?php
do {  
?>
                  <option value="<?php echo $row_campaign['CAMP']?>"  
				  <?  if  ($row_campaign['CAMP']==$sel_camp ) { echo " selected " ;} ?>> 
				  <?php echo  substr($row_campaign['CAMP'],4,2) ."/". substr($row_campaign['CAMP'],0,4); ?></option>
				  
                  <?php
						} while ($row_campaign = mysql_fetch_assoc($campaign));
						  $rows = mysql_num_rows($campaign);
						  if($rows > 0) {
							  mysql_data_seek($campaign, 0);
							  $row_campaign = mysql_fetch_assoc($campaign);
						  }
?>
                  
                  </select>
                  &nbsp;*</td>
                <td width="287" align="left">..</td>
              </tr>
              <tr>
                <td align="right"></td>
                <td align="left"><input name="txtdist2" type="text" disabled="disabled" id="txtdist2" value="<?php echo $_SESSION['dist']; ?>" size="4" maxlength="4" style="display:none" />
                  <input name="mslno" type="text" id="mslno" 
                      onkeyup="javascript:if(this.value.length==5){chkdgt.focus()}" 
                      onkeydown="javascript: if (event.keyCode == 13){chkdgt.focus();}"
                      value="<?php echo $mslno ?>"   size="8" maxlength="5" style="display:none"/>
                  <input name="chkdgt" type="text" id="chkdgt" value="<?php echo $chkdgt?>" size="2" maxlength="1" 
                      onkeydown="javascript:if(event.keyCode==13){document.form1.submit();}"
                    style="display:none"  />
                  <input name="dist" type="hidden" id="dist" value="<?php echo $_SESSION['dist']; ?>" />
                  <input name="mslno1" type="hidden" id="mslno1" value="<?php echo $_SESSION['mslno']; ?>" /></td>
                <td align="left">&nbsp;</td>
              </tr>
              <tr>
                <td align="right">�Ѵ���§�����Ũҡ : </td>
                <td align="left"><select name="sel_order_by" id="sel_order_by">
                  <option value="ORDCAMP"  <?php   if ($sel_order_by=="ORDCAMP") { echo "selected='selected'";}?> >�ͺ��˹���</option>
                  <option value="REPCODE" <?php   if ($sel_order_by=="REPCODE") { echo "selected='selected'";}?>>������Ҫԡ</option>
                  <option value="INVDATE" <?php   if ($sel_order_by=="INVDATE") { echo "selected='selected'";}?>>�ѹ�������㺡ӡѺ����</option>
                   <option value="ORDSTS" <?php   if ($sel_order_by=="ORDSTS") { echo "selected='selected'";}?>>ʶҹ����觫���</option>
                  <option value="INVNO" <?php   if ($sel_order_by=="INVNO") { echo "selected='selected'";}?>>�Ţ���㺡ӡѺ����</option>
                  <option value="ORDSRC" <?php   if ($sel_order_by=="ORDSRC") { echo "selected='selected'";}?>>Order Source</option>
                  <option value="AMOUNT" <?php   if ($sel_order_by=="AMOUNT") { echo "selected='selected'";}?>>��Ť�Ҽ�Ե�ѳ��</option>
                  
                </select>
                  <select name="sel_asc" id="sel_asc">
                    <option value="ASC" <?php   if ($sel_asc=="ASC") { echo "selected='selected'";}?> >���§�ҡ������ҡ</option>
                    <option value="DESC" <?php   if ($sel_asc=="DESC") { echo "selected='selected'";}?> >���§�ҡ�ҡ仹���</option>
                  </select></td>
                <td align="left"><input type="button" name="button2" id="button2" value="Reset"  onclick="clear_vlaue();"  class="formbutton"/>
                  <input type="button" name="Button" id="button" value="View" onclick="javascript:document.getElementById('curpage').value=''; form_submit();" <? if ($maintenance=="yes"){ echo " disabled='disabled'"; } ?>  class="formbutton" />
                  <input type="hidden" name="doMode" id="doMode" value="View" />
                  <input type="hidden" name="curpage" id="curpage" value="<?php echo $_POST['curpage']; ?>" />
                  <input type="hidden" name="totalrow" id="totalrow" /></td>
              </tr>
            </table></fieldset></td>
          </tr>
        </table>
      </form>
      
      <table width="870" border="1" cellpadding="0" cellspacing="0" height="407">
        
        <tr>
          
          <td align="center" valign="top">
          
             <?php    if ($maintenance=="yes") {  // ��˹���Ҩҡ��� i_config.php 
			  		echo "<br><br><br><center>$maintenance_msg </center>";
			  }
			  else {
			   ?> 
          <table width="868" border="0" align="center" cellpadding="0" cellspacing="0" >
            <tr style="font-family:Verdana, Geneva, sans-serif; color:#F09;font-weight:bold;font-size:9px">
              <td width="39" height="25" align="center"  style="border-top:#666 solid 1px;border-bottom:#666 solid 1px;border-left:#666 solid 1px;">�ӴѺ</td>
              <td width="75" align="center" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">�ͺ��˹���</td>

              <td width="200" align="left" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">����-���� ��Ҫԡ</td>
              <td width="134" align="left" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">�ѹ�������㺡ӡѺ����</td>
              <td width="102" align="left" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">ʶҹ����觫���</td>
              <td width="108" align="left" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">�Ţ���㺡ӡѺ����</td>
              <td width="96" align="left" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">Order Source</td>
              <td width="84" align="right" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">��Ť���ط��</td>
              <td width="21" align="center" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px">&nbsp;</td>
              <td width="19" align="center" style="border-top:#666 solid 1px;border-bottom:#666 solid 1px;border-right:#666 solid 1px;">&nbsp;</td>
            </tr>
            <tr style="font-family:Verdana, Geneva, sans-serif;color:#226543;font-weight:bold;font-size:10px">
              <td colspan="10" align="left" valign="top"  style="border-top:#666 solid 1px;border-bottom:#666 solid 1px;border-right:#666 solid 1px;border-left:#666 solid 1px">
<?php
			if ($_POST['doMode']=="Query") {
				if (strlen($dist)==4) {
					//echo $url_webservice."/bsmart_dsm_order_header.php"  . "?".$DataToSend;
					fourdigidata ($sel_camp,$dist,$mslno,$chkdgt,$sel_order_by,$sel_asc,$postUrl,$ws_client);
				} else if (strlen($dist)==3) {
					threedigidata($sel_camp,$dist,$mslno,$chkdgt,$sel_order_by,$sel_asc,$postUrl,$ws_client);
				} //end check digit
			}				
?>
              </td>
            </tr>
          </table>
          
          <p>
            <?php	} ?>       
          </p>
          </td>
          
        </tr>
        
      </table>
      <!-- End of  Content -->
    <br /><center>
      <strong><font color="#CC0000">�����˵� �ҡʶҹ����觫��� ������ &quot;��������Դ Hold �����͡��͹��ѵ�&quot;</font></strong><br />
      ����ҹ���ͺ������������� Call center �ÿ�� ! ���ǻ���� ����Ѻ������ԡ�� �����������ѹ�٤�� �����ʾ���� *7479000 ������.0-2548-1555 (���¤����) <br />
      �ѹ�ѹ���-�ء�� ���� 8.00-24.00 �. �ѹ�����-�ҷԵ�� ���� 8.00-17.30 �. <br />
      <a href="index.php" target="_parent"><img src="images/BWorder_web_35.gif" alt="˹����ѡ" width="72" height="19" border="0" /></a>
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
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><?php require "i_footer.php";?></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>
<?php 


function threedigidata($camp,$dist,$mslno,$chkdgt,$orderby,$ordersort,$postUrl,$ws_client) {
	$pageno = $_POST['curpage'];
	$totalrow = '';
	$param = array('dist' => $dist, 'mslno' => $mslno, 'chkdgt' => $chkdgt, 'camp' => $camp, 'orderby' => $orderby, 'ascend' => $ordersort, 'pageno' => $pageno, 'totalrow' => $totalrow);
	$result = $ws_client->call('search_db', $param); 
	echo $result;
}
function fourdigidata($camp,$dist,$mslno,$chkdgt,$orderby,$ordersort,$postUrl,$ws_client) {
	$pageno = $_POST['curpage'];
	$totalrow = '';
	$param = array('dist' => $dist, 'mslno' => $mslno, 'chkdgt' => $chkdgt, 'camp' => $camp, 'orderby' => $orderby, 'ascend' => $ordersort, 'pageno' => $pageno, 'totalrow' => $totalrow);
	$result = $ws_client->call('fourdigi', $param); 
	echo $result;
}
?>
