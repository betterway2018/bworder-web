<?php session_start();
ob_start();
header('Content-type: text/html; charset=windows-874');
include("../i_function_msg.php");
require_once("../Connections/bwc_webboard.php");
include("i_convert.php"); 
$query = "SELECT * FROM WEBBOARD_GROUP ORDER BY ID";
//echo $query;
$group = mysql_query($query, $bwc_webboard) or die(mysql_error());
$row_group = mysql_fetch_assoc($group);
$totalRows_group = mysql_num_rows($group);
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=TIS-620" />
<title>doCallAjax_Administrator BWORDER</title>
<link rel="stylesheet" href="css/calendar.css">
<link rel="stylesheet" href="processing.css">
<script language="JavaScript" src="css/calendar_db.js"></script>
<script language="JavaScript" src="processing.js"></script>

<script type="text/javascript">
 function Inint_AJAX() {
           try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
           try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
           try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
           alert("XMLHttpRequest not supported");
           return null;
        };
  function dochange(datefrom,dateto) {  
             var req = Inint_AJAX();
             req.onreadystatechange = function () { 
                  if (req.readyState==4) {
                       if (req.status==200) {
				
                            document.getElementById("ShowReport").innerHTML=req.responseText; //รับค่ากลับมา
							//document.getElementById("ShowReport").innerHTML="SAIIIIIIIIII"; //รับค่ากลับมา
                       } 
                  }
             };
             req.open("GET", "delete_webbord_ajax.php?datefrom="); //สร้าง connection
             req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
             req.send(null); //ส่งค่า

        }
		
		
function  view()
{  
     var req = Inint_AJAX();
             req.onreadystatechange = function () { 
                  if (req.readyState==4) {
                       if (req.status==200) {
					       
                            document.getElementById("ShowReport").innerHTML=req.responseText; //รับค่ากลับมา
							//document.getElementById("ShowReport").innerHTML="SAIIIIIIIIII"; //รับค่ากลับมา
                       } 
                  }
             };
			  var sel_group = document.getElementById('sel_group').value
             req.open("GET", "Summary_webbord_ajax.php?searchdateto="+document.form1.searchdateto.value+"&searchdatefrom="+document.form1.Searchdatefrom.value+"&sel_group="+sel_group); //สร้าง connection
             req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
             req.send(null); //ส่งค่า

		
}
	   function doCallAjax(Sort,page,datefrom,dateto) {
     var req = Inint_AJAX();
             req.onreadystatechange = function () { 
                  if (req.readyState==4) {
                       if (req.status==200) {
					       
                            document.getElementById("ShowReport").innerHTML=req.responseText; //รับค่ากลับมา
							//document.getElementById("ShowReport").innerHTML="SAIIIIIIIIII"; //รับค่ากลับมา
                       } 
                  }
             };
			 
             req.open("GET", "delete_webbord_ajax.php?Sort="+Sort+"&page="+page+"&searchdatefrom="+document.form1.Searchdatefrom.value+"&searchdateto="+document.form1.searchdateto.value); //สร้าง connection
             req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
             req.send(null); //ส่งค่า
	   }
	   
	 function DeleteFAQ(page,Mode,row_index) {
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
		  
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }
	

			if (window.confirm("ยืนยันการลบข้อมูล")!=true)
			{
				//window.open(varUrl,"_self")
				return false;
			}
			//var dist=document.getElementById('dist').value;
			//var mslno=document.getElementById('mslno').value;
			
			var dist=document.getElementById('dist').value;
			var mslno=document.getElementById('mslno').value;
			var chkdgt=document.getElementById('chkdgt').value;
			var datefrom=document.getElementById('datefrom').value;
			var dateto=document.getElementById('dateto').value;
			var email=document.getElementById('email').value;
			var fselect=document.getElementById('fselect').value;
			
			var url = 'data_contactus_Ajax.php';
			var pmeters =  'Sort=&page=&dist='+dist+'&mslno='+mslno+'&chkdgt='+chkdgt+'&datefrom='+datefrom+'&dateto='+dateto+'&email='+email+"&row_index=" + row_index + "&tMode=" + Mode+"&fselect="+fselect;
			//var pmeters =  'page='+page+'&mslflag='+mslflag+'&datefrom='+datefrom+'&dateto='+dateto+'&email='+email+'&status='+status+ "&tMode=" + Mode +"&tID=" + ID;

			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
			
			HttPRequest.onreadystatechange = function()
			{

				 if(HttPRequest.readyState == 3)  // Loading Request
				  {
				   document.getElementById("mySpan").innerHTML = "Now is Loading...";
				  }

				 if(HttPRequest.readyState == 4) // Return Request
				  {
				   document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
				  }
				
			}
			//AlertMessage('ข้อมูลถูกลบเรียบร้อยแล้ว','');
			//doCallAjax('DIST',1);
	   } 
	   

</script>

</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" valign="top" bgcolor="#FFFFFF"></td>
  </tr>
  <tr>
    
    <td align="left" valign="top">
<br />
<strong class="text_heading">::   ติดต่อสอบถาม ถาม-ตอบ :โดยคอลเซ็นเตอร์ ::</strong>
    <hr />
    <form id="form1" name="form1" method="POST" action="">
      <table width="777" border="0" cellspacing="0" cellpadding="5">
        <tr>
           <td colspan="3"><input name="row_index" type="hidden" id="row_index" size="48" /></td>
        </tr>

        <tr>
          <td width="242" align="right" valign="middle" nowrap="nowrap">ดึงข้อมูลโดยใช้วันที่ :</td>
          <td width="381"><table width="77%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="27%" nowrap="nowrap"><input name="Searchdatefrom" type="text" id="Searchdatefrom"  value="<?php echo $Searchdatefrom; ?>" /></td>
              <td width="4%" nowrap="nowrap"><script language="JavaScript" type="text/javascript">
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'Searchdatefrom'
	});

	          </script></td>
              <td width="8%" align="center" nowrap="nowrap">&nbsp;&nbsp;ถึง&nbsp;&nbsp;</td>
              <td width="27%" nowrap="nowrap"><input name="searchdateto" type="text" id="searchdateto"  value="<?php echo $searchdateto; ?>"/></td>
              <td width="34%" nowrap="nowrap"><script language="JavaScript" type="text/javascript">
	new tcal ({
		// form name
		'formname': 'form1',
		// input name
		'controlname': 'searchdateto'
	});

	          </script></td>
              </tr>
            </table></td>
          <td width="124" nowrap="nowrap"><font color="red" size="-1" >ระบุวันที่</font></td>
        </tr>
		  <tr>
                  <td align="right">เลือกกลุ่มในการติดต่อสอบถาม</td>
                  <td align="left"><select name="sel_group" id="sel_group">
                    <option value="">==เลือกกลุ่มในการติดต่อสอบถาม  ==</option>
                    <?php do {  ?>
                      <option value="<?php  echo $row_group['ID'];?>"><?php  echo $row_group['GroupName'];?></option>
                      <?php } while ($row_group = mysql_fetch_assoc($group)); ?>
                  </select></td>
          </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td colspan="2"><input type="reset" name="button2" id="button2" value="Reset" />
            <input type="button" name="button" id="button" value="Preview" onclick="view();" /></td>
        </tr>
		
      </table>
    </form>
	<br />
	<br />
	<br />
	
    <span id="ShowReport"> </span>
</td>
  </tr>
</table>

<div id="divProcess" class="loading-invisible">
  <img id="imgProcess" style="position:absolute;" src="Processing.gif" border=0>
 </div>

</body>
</html>