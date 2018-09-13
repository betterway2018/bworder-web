<?php
	date_default_timezone_set('Asia/Bangkok');   
	$current_day = date ('D');
	$current_year = date ('Y');   
	$current_year = $current_year + 543;
	$current_date = date ('d/m/').$current_year;
	$current_time = date ('H:i:s');
	$current = date ('Ymd H:i:s');
	
	//$close_start = '20170826 18:00';
	//$close_stop  = '20170827 06:00';

		
	//echo $current_day.' '.$current_date." ".$current_time." ".$current;
	//$current_time > '21:30:00' and $current_time < '22:00:00'

	
	if ($current >= $close_start and $current <= $close_stop) {
		$close_start_str = substr($close_start,6,2)."/".substr($close_start,4,2)."/".(substr($close_start,0,4)+ 543)." เวลา ".substr($close_start,9,8);
		$close_stop_str = substr($close_stop,6,2)."/".substr($close_stop,4,2)."/".(substr($close_stop,0,4)+ 543)." เวลา ".substr($close_stop,9,8);
	} else if ($current_day == 'Sun') {
		if ($current_time > '21:30:00' and $current_time < '22:00:00') {
			$close_start_str = $current_date.' 21:30';
			$close_stop_str  = $current_date.' 22:00';
//			echo 'close time';
		} else {
			header('Location: login.php');
			exit;
		}
	} else {
		header('Location: login.php');
		exit;
	}
	
	
	
	
	/* **************************************
	
	if ($current >= $close_start and $current <= $close_stop) {
		$close_start_str = substr($close_start,6,2)."/".substr($close_start,4,2)."/".(substr($close_start,0,4)+ 543)." เวลา ".substr($close_start,9,8);
		$close_stop_str = substr($close_stop,6,2)."/".substr($close_stop,4,2)."/".(substr($close_stop,0,4)+ 543)." เวลา ".substr($close_stop,9,8);
	} else if ($current_day == 'Sun') {
		if ($current_time > '21:30:00' and $current_time < '22:00:00') {
			$close_start_str = $current_date.' 21:30';
			$close_stop_str  = $current_date.' 22:00';
//			echo 'close time';
		} else {
			header('Location:login.php');
			exit;
		}
	} else {
		header('Location:login.php');
		exit;
	}
	*/
	
/*	if ($current_day == 'Sat') {
		if ($current_time > '18:00:00') {
//			echo 'close time';
		} else {
			header('Location: login.php');
			exit;
		}
	} else {
		header('Location: login.php');
		exit;
	}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title><?php  echo $title?></title>
<link href="menucss3/dropdown/table.css" rel="stylesheet"  type="text/css">
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
      
    </table></td>
  </tr>
  <tr>
    <td height="58" class="Sheet_Boder"  >&nbsp;</td>
  </tr>
  <tr>
    <td height="297" align="left" valign="top" class="Sheet_Boder" style="padding:2px">
    <form id="form1" name="form1" method="post" action="" onsubmit="return check();">
      <table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top"><fieldset>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr align="center">
                <td height="246" colspan="2" bgcolor="#FEDFEF"><p>ขออภัยค่ะ ระบบปิดปรับปรุงชั่วคราว <br />
                  <a href="javascript:window.close()">Close this window!</a></p>
				  <!--  เวลา 21:30 น  ถึงวันที่   <?php echo $current_date; ?>   เวลา 22:00 -->
                  <p >แจ้งสมาชิก </p> 
                  <p > <h5><FONT COLOR=red> ขออภัยค่ะ ระบบ Bworder ปิดปรับปรุงชั่วคราว 
				  <br> ในวันที่  <?php echo $close_start_str; ?> น  ถึงวันที่  <?php echo $close_stop_str; ?> น  </FONT></h5>  </p>           
       
                  <p>จึงเรียนมาเพื่อทราบ และขออภัยในความไม่สะดวก</p>
                  </p>
                  <p><br />
                    <br />
                  </p></td>
              </tr>
              </table>
         
          </fieldset>
            
          </td>
        </tr>
      
      </table>

    </form>
      <!-- Start  Content  -->    
    
    
    
    </td>
  </tr>
</table>
</body>
</html>