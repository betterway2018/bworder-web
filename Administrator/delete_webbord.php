<?php session_start();?>
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
				
                            document.getElementById("ShowReport").innerHTML=req.responseText; //�Ѻ��ҡ�Ѻ��
							//document.getElementById("ShowReport").innerHTML="SAIIIIIIIIII"; //�Ѻ��ҡ�Ѻ��
                       } 
                  }
             };
             req.open("GET", "delete_webbord_ajax.php?datefrom="); //���ҧ connection
             req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
             req.send(null); //�觤��

        }
		
		
function  view()
{  
     var req = Inint_AJAX();
             req.onreadystatechange = function () { 
                  if (req.readyState==4) {
                       if (req.status==200) {
					       
                            document.getElementById("ShowReport").innerHTML=req.responseText; //�Ѻ��ҡ�Ѻ��
							//document.getElementById("ShowReport").innerHTML="SAIIIIIIIIII"; //�Ѻ��ҡ�Ѻ��
                       } 
                  }
             };
			 
             req.open("GET", "delete_webbord_ajax.php?searchdateto="+document.form1.searchdateto.value+"&searchdatefrom="+document.form1.Searchdatefrom.value); //���ҧ connection
             req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
             req.send(null); //�觤��

		
}
	   function doCallAjax(Sort,page,datefrom,dateto) {
     var req = Inint_AJAX();
             req.onreadystatechange = function () { 
                  if (req.readyState==4) {
                       if (req.status==200) {
					       
                            document.getElementById("ShowReport").innerHTML=req.responseText; //�Ѻ��ҡ�Ѻ��
							//document.getElementById("ShowReport").innerHTML="SAIIIIIIIIII"; //�Ѻ��ҡ�Ѻ��
                       } 
                  }
             };
			 
             req.open("GET", "delete_webbord_ajax.php?Sort="+Sort+"&page="+page+"&searchdatefrom="+document.form1.Searchdatefrom.value+"&searchdateto="+document.form1.searchdateto.value); //���ҧ connection
             req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
             req.send(null); //�觤��
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
	

			if (window.confirm("�׹�ѹ���ź������")!=true)
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
			//AlertMessage('�����Ŷ١ź���º��������','');
			//doCallAjax('DIST',1);
	   } 
	   
 function Delete()
{

		 if(confirm("��س��׹�ѹ���ź") == true)
{
     var req = Inint_AJAX();
             req.onreadystatechange = function () { 
                  if (req.readyState==4) {
                       if (req.status==200) {
					       
                            document.getElementById("ShowReport").innerHTML=req.responseText; //�Ѻ��ҡ�Ѻ��
							//document.getElementById("ShowReport").innerHTML="SAIIIIIIIIII"; //�Ѻ��ҡ�Ѻ��
                       } 
                  }
             };
			var inputs = document.getElementsByTagName( 'input' );
			var qs = Array();
             var j=0;
			for ( i = 0 ; i < inputs.length ; i++ )
			{    
			    if( inputs[i].checked == true)
				{ j++;
					if ( inputs[i].type == 'checkbox')
						{  
							 qs[i] = inputs[i].name + '=' + inputs[i].value;
						};
				}
			};
			var query = qs.join( '&' ); // ��ͤ��� query �����
			if(j>0)
			{
			 req.open("GET", "delete_webbord_ajax.php?strMode=DELETE" + query+"&searchdateto="+document.form1.searchdateto.value+"&searchdatefrom="+document.form1.Searchdatefrom.value); //���ҧ connection
             req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
             req.send(null); //�觤��
			}
			else
			{
			  alert("��س����͡�����ŷ���ͧ���ź");
			}
            
 
     }
}   
	     
	 function checkAll(id)
{
	elm=document.getElementsByTagName('input');
	for(i=0; i<elm.length ;i++){
		 if(elm[i].id==id){
				elm[i].checked = true ;
		  }
	   }
	 
}

function uncheckAll(id)
{
	elm=document.getElementsByTagName('input');
	for(i=0; i<elm.length ;i++){
		 if(elm[i].id==id){
				elm[i].checked = false ;
		  }
	   }
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
   <br/>
<strong class="text_heading">::   �Դ����ͺ��� ���-�ͺ :�¤�������� ::</strong>
    <hr />
    <form id="form1" name="form1" method="POST" action="">
      <table width="622" border="0" cellspacing="0" cellpadding="5">
        <tr>
           <td colspan="3"><input name="row_index" type="hidden" id="row_index" size="48" /></td>
        </tr>
        <tr>
          <td width="155" align="right" valign="middle" nowrap="nowrap">�֧�����������ѹ��� :</td>
          <td width="447"><table width="77%" border="0" cellspacing="0" cellpadding="0">
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
              <td width="8%" align="center" nowrap="nowrap">&nbsp;&nbsp;�֧&nbsp;&nbsp;</td>
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
          <td nowrap="nowrap"><font color="red" size="-1" >�к��ѹ���</font></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td colspan="2"><input type="reset" name="button2" id="button2" value="Reset" />
            <input type="button" name="button" id="button" value="View" onclick="view();" /></td>
        </tr>
      </table>
    </form>
	<br />
<div style=" background-color:#FFFFCC">
     <a href="#" class="button green" onClick="checkAll('chkbox');"><img src="images/checked_checkbox.png" width="32" height="32" border="0" /></a>
	 <a href="#" class="button green" onClick="uncheckAll('chkbox');"><img src="images/unchecked_checkbox.png" border="0"  width="32" height="32" /></a>
	<a href="#" class="button green" onClick="Delete();"><img src="images/trash yellow.png" border="0"  width="32" height="32" /></a>
	<!--  <input type="button" name="checkAll" id="checkAll" value="���͡������" onclick="checkAll('chkbox');" />
	  <input type="button" name="uncheckAll" id="uncheckAll" value="¡��ԡ������" onclick="uncheckAll('chkbox');" />
	   <input type="button" name="Delete" id="Delete" value="ź������" onclick="Delete();" /> -->
</div>
	<br/>
	<br/>	
    <span id="ShowReport"> </span>
</td>
  </tr>
</table>

<div id="divProcess" class="loading-invisible">
  <img id="imgProcess" style="position:absolute;" src="Processing.gif" border=0>
 </div>
</body>
</html>