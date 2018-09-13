<?php
 $repcode=$dist. substr("00000".$mslno,-5).$chkdgt;
//Detect special conditions devices
$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");


//do something with this information
if($iPhone ){ $Device="iPhone";
    //browser reported as an iPhone/iPod touch -- do something here
}else if($iPad){ $Device="iPad";
    //browser reported as an iPad -- do something here
}else if($Android){ $Device="Android";
    //browser reported as an Android device -- do something here
}else  $Device="Website";



    $namelog=date("Y-m-d").".txt";
	$log = $rep_seq."|".$repcode."|".$_SERVER['REMOTE_ADDR']."|".$Device."|".date("Y-m-d H:i:s");

	file_put_contents('Log/'.$namelog,"\r\n $log ",FILE_APPEND);	
	
?>