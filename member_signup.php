<?php  session_start(); ?>
<?php require("i_config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><?php  echo $title?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" charset="utf-8" src="js/jscFunction.js"></script>
<script type="text/javascript" src="Scripts/ajaxsbmt.js"></script>
<script type="text/javascript" src="Scripts/jQuery/js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="Scripts/jquery/js/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}
//-->
</script>

<script type="text/javascript">

	function setNextFocus(tar_obj) { //v3.0
			if (event.keyCode == 13){
				var obj=document.getElementById(tar_obj);
				if (obj){
					obj.focus();
				}
			}
	}

</script>    
</head>

<body >
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
    <td height="480" align="left" valign="top" class="Sheet_Boder" style="padding:2px">
    <form id="form1" name="form1" method="post" action="member_signup_update.php" >
  
      <table width="719" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td width="719" valign="top"><fieldset style="margin-top:12px;height:400px">
            <table width="666"  border="0" align="center" cellpadding="3" cellspacing="1">
              <tr>
                <td colspan="2" ><strong class="content_header3">ŧ����¹������觫����Թ��Ҽ�ҹ�Թ������</strong>
                </td>
                </tr>
              <tr>
                <td  align="right">&nbsp;</td>
                <td >&nbsp;</td>
              </tr>
              <tr>
                <td width="158"  align="right">������Ҫԡ :</td>
                <td width="493" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25%" nowrap="nowrap"><input name="dist" type="text" id="dist" size="4" maxlength="4" value="" onblur="setdistcode('dist');"/>
-
  <input name="mslno" type="text" id="mslno" size="7" maxlength="5" value="" />
-
<input name="chkdgt" type="text" id="chkdgt" size="1" maxlength="1"    />
<input name="rep_seq" type="hidden" id="rep_seq"  value="<?=$rep_seq?>"  />
<input name="GOLDCLUB" type="hidden" id="GOLDCLUB"  value="<?=$GOLDCLUB?>"  />

</td>
    <td width="3%">*</td>
    <td width="72%"><span id="div_wait"> </span></td>
  </tr>
</table></td>
              </tr>
              <tr>
                <td align="right">����  :</td>
                <td><input name="txtname" type="text" id="txtname" size="38"  value="" />
                  *</td>
              </tr>
              <tr>
                <td align="right">���ʡ�� : </td>
                <td><input name="txtname2" type="text" id="txtname2" size="38" value="" /></td>
              </tr>
              <tr>
                <td align="right">�ѹ/��͹/�� �.� ����Դ :</td>
                <td><select name="b_date" id="b_date">
                  <option value="" selected="selected">�ѹ��� </option>
                  <option value="01">1</option>
                  <option value="02">2</option>
                  <option value="03">3</option>
                  <option value="04">4</option>
                  <option value="05">5</option>
                  <option value="06">6</option>
                  <option value="07">7</option>
                  <option value="08">8</option>
                  <option value="09">9</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                  <option value="13">13</option>
                  <option value="14">14</option>
                  <option value="15">15</option>
                  <option value="16">16</option>
                  <option value="17">17</option>
                  <option value="18">18</option>
                  <option value="19">19</option>
                  <option value="20">20</option>
                  <option value="21">21</option>
                  <option value="22">22</option>
                  <option value="23">23</option>
                  <option value="24">24</option>
                  <option value="25">25</option>
                  <option value="26">26</option>
                  <option value="27">27</option>
                  <option value="28">28</option>
                  <option value="29">29</option>
                  <option value="30">30</option>
                  <option value="31">31</option>
                </select>
/
<select name="b_month" id="b_month">
  <option value="" selected="selected">��͹</option>
  <option value="01">���Ҥ�</option>
  <option value="02">����Ҿѹ��</option>
  <option value="03">�չҤ�</option>
  <option value="04">����¹</option>
  <option value="05">����Ҥ�</option>
  <option value="06">�Զع�¹</option>
  <option value="07">�á�Ҥ�</option>
  <option value="08">�ԧ�Ҥ�</option>
  <option value="09">�ѹ��¹</option>
  <option value="10">���Ҥ�</option>
  <option value="11">��Ȩԡ�¹</option>
  <option value="12">�ѹ�Ҥ�</option>
</select>
/
<select name="b_year" id="b_year">
<option value="" selected="selected">�� �.�. </option>
  <?php
		for ($j==1; $j<=80;$j++) {
		?>
  		<option value="<?php echo  date('Y') -$j+543 ; ?>" ><?php echo date('Y')-$j+543; ?></option>
  <?php } ?>
</select>
*
</td>
              </tr>
              <tr>
                <td align="right">������� :</td>
                <td><input name="txtemail" type="text" id="txtemail" size="32" />
                  * ��س��к� e-mail �ͧ�س</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td><strong><font color="#FF0033">��ҹ��������Ѻ e-mail �׹�ѹ�����觫����Թ�����ФӶ���ͧ��ҹ������� <br />
                  �Ѻ��õͺ��Ѻ ��ҷ�ҹ�������������   e-mail ���</font></strong></td>
              </tr>
              <tr>
                <td align="right">�������Ѿ�� :</td>
                <td><input name="txtphone" type="text" id="txtphone" size="32" maxlength="32" /></td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>

              <tr>
                <td align="right">��������ʼ�ҹ  :</td>
                <td><input name="txtpwd1" type="password" id="txtpwd1" size="36" maxlength="12" />
                  <font color="#444444">* </font></td>
              </tr>
              <tr>
                <td align="right">�׹�ѹ���ʼ�ҹ :</td>
                <td><input name="txtpwd2" type="password" id="txtpwd2" size="36" maxlength="12" />
                  <font color="#444444">* �׹�ѹ���ʼ�ҹ���س���˹�����</font></td>
              </tr>
              <tr>
                <td align="right"></td>
                <td>
<input name="Button" type="button"  id="Submit" value="�ѹ�֡������" class="formbutton"   onclick="return form_submit();"/>&nbsp;<input name="Reset" type="reset"  id="button" value="��ҧ������" class="formbutton"/></td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="right">&nbsp;</td>
                <td>
</td>
              </tr>
            </table>
          </fieldset></td>
        </tr>
      </table>
      <script type="text/javascript">
				function IsNumeric(strString)
					   //  check for valid numeric strings	
					   {
					   var strValidChars = "0123456789.-";
					   var strChar;
					   var blnResult = true;
					
					   if (strString.length == 0) return false;
					
					   //  test strString consists of valid characters listed above
					   for (i = 0; i < strString.length && blnResult == true; i++)
						  {
						  strChar = strString.charAt(i);
						  if (strValidChars.indexOf(strChar) == -1)
							 {
							 blnResult = false;
							 }
						  }
					   return blnResult;
				}

<!--

				// Email Validation. Written by PerlScriptsJavaScripts.com
				
				function check_email(e) {
					ok = "1234567890qwertyuiop[]asdfghjklzxcvbnm.@-_QWERTYUIOPASDFGHJKLZXCVBNM";
				
					for(i=0; i < e.length ;i++){
						if(ok.indexOf(e.charAt(i))<0){ 
						return (false);
						}	
					} 
				
					if (document.images) {
						re = /(@.*@)|(\.\.)|(^\.)|(^@)|(@$)|(\.$)|(@\.)/;
						re_two = /^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
						if (!e.match(re) && e.match(re_two)) {
							return (-1);		
						} 
				
					}
				
				}
				
				// -->

//=========================================
				function form_submit() {
				    if(!IsNumeric(document.form1.dist.value)) {
						alert("��سҡ�͡������Ҫԡ�ͧ�س���");
						document.form1.dist.focus();
						return false;		
				    }
				//    else if(parseInt(document.form1.dist.value)>=8000 && parseInt(document.form1.dist.value) < 9000) {
				//		alert("��Ҫԡ����� �������ö��觫��ͺ��Ǻ䫵����� ��سҵԴ��� Callcenter !!");
				//		document.form1.dist.focus();
				//		return false;		
				//    }
					else if(!IsNumeric(document.form1.mslno.value)) {
						alert("��سҡ�͡������Ҫԡ�ͧ�س���");
						document.form1.mslno.focus();
						return false;
					} else if(!IsNumeric(document.form1.chkdgt.value)) {
						alert("��سҡ�͡������Ҫԡ�ͧ�س���");
						document.form1.chkdgt.focus();
						return false;
					}

					else if (document.form1.txtname.value==""){
						alert("��سҡ�͡���ͧ͢�س��� !!");
						document.form1.txtname.focus();
						return false;
					}

		
					else if ( document.form1.txtemail.value !="" && !check_email(document.form1.txtemail.value)){
						alert("��سҡ�͡��������� !!");
						document.form1.txtemail.focus();
						return false;
					}			
					else if (document.form1.b_date.value=="" || document.form1.b_month.value=="" || document.form1.b_year.value==""){
						alert("��س��к��ѹ�Դ�ͧ�س���");
						document.form1.b_date.focus();
						return false;
					}
					else if (document.form1.txtpwd1.value =="") {
							 	alert ("��س��к����ʼ�ҹ��� !!!");
								document.form1.txtpwd1.focus();
								return false;					
					}
					else if  (document.form1.txtpwd1.value!=document.form1.txtpwd2.value) {
							 	alert ("��س��׹�ѹ���ʼ�ҹ���");
								document.form1.txtpwd2.focus();
								return false;
					}
					else {
							/*document.getElementById('div_wait').innerHTML = "";
							document.getElementById('form1').submit();
							return true;  */

							//open - close script //
							var  ret ="";
							var dist=document.getElementById('dist').value;
							var mslno=document.getElementById('mslno').value;

							//alert(mslno);
							var chkdgt =document.getElementById('chkdgt').value;
							var fname =document.getElementById('txtname').value;
							var lname = document.getElementById('txtname2').value;
							//var urls = 'asp_Get_RepName.asp';
							var urls = 'Bw_get_repname.php?dist='+dist+'&mslno='+mslno+'&chkdgt='+chkdgt;
							var pmeters = 'dist='+dist+'&mslno='+mslno+'&chkdgt='+chkdgt;
						///var pmeters = 'dist='+dist+'&mslno='+mslno+'&chkdgt='+chkdgt+'&fname='+ fname+'&lname='+lname;

							//alert(pmeters);	  
							$.ajax( 
									{ 
										type: "POST", 
										data: pmeters,
										url: urls, 
										success: function(data) 
										{ 
										 	document.getElementById('div_wait').innerHTML = "<img src='images/indicator.white_1.gif' />";
										   // alert('ERROR1___'+data);
										    var  rep_name="";
											var arrMsg = data.split("|");
											if(arrMsg[24]== 'G')
											{
											   GOLDCLUB = 'GC1';
											}
											else
											{
											
											    GOLDCLUB = 'D';
											}
											if ((document.getElementById('dist').value.length)==3)
											 {
												var rep_name = arrMsg[0];
											
											} else  {
												var rep_name = arrMsg[4];
									
											}
												var rep_seq = arrMsg[2];
									       //   alert('ERROR2___'+rep_name);
											    if( rep_name!="") {  
												/// alert('ERROR3rep_name!=""___'+rep_name);
														document.getElementById('txtname').value=rep_name;
														document.getElementById('rep_seq').value=rep_seq;
														document.getElementById('GOLDCLUB').value = GOLDCLUB;
														document.getElementById('div_wait').innerHTML = "";
														document.getElementById('form1').submit();
														return true;
						
											}
											else if (rep_name=="" )
											{  // �������
                                                     //      alert('ERROR3rep_name==""___'+rep_name);
														//alert(err_desc);
														//document.getElementById('div_wait').innerHTML = "";
													      alert("�Դ��ͼԴ��Ҵ:  ��辺��������Ҫԡ��� ...");
														  	document.getElementById('div_wait').innerHTML=  ' '; 
														return false;
											}
										
										},
										error: function(data) { 
										   // alert('ERROR___3'+data);
											document.getElementById('div_wait').innerHTML =" ";
											alert("�Դ��ͼԴ��Ҵ:  ��辺��������Ҫԡ��� ...")
											return false;
										}
									}); 
					}
			}
		  </script>
      </span>
    </form>
    
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

<?php include("i_footer.php"); ?>
</body>
</html>
