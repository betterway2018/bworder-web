<?php
  function func_ConvertDateToString($iDate,$iTime) {
			$yy=substr($iDate,0,4);
			$mm=substr($iDate,4,2);
			$dd=substr($iDate,6,2);
			if ($iTime!=""){
				$iTime=substr($iTime,0,2).":".substr($iTime,2,2).":".substr($iTime,4,2);	
			} 
			return $dd."/".$mm."/".$yy." ".$iTime;
  }
  
  function func_convertdatetime($idate) {
		  $datetime = date_create($idate);
		  return  date_format($datetime, 'd/m/Y H:i:s') . "\n";
	  }
  
  
  
    function func_ConvertDateLongToString2($iDate,$iTime) {
			if ($iDate!=""){
				$yy=substr($iDate,0,4);
				$mm=substr($iDate,4,2);
				$dd=substr($iDate,6,2);
			}
			else {
				$yy="";
				$mm="";
				$dd="";
			}
			
			if ($iTime!=""){
				$iTime=substr($iTime,0,2).":".substr($iTime,2,2).":".substr($iTime,4,2);	
			}
			
			if ($yy=="") {
				 $formats = $iTime;
			}
			elseif ($iTime=="") {
				$formats =$yy."-".$mm."-".$dd;
			}
			else {
				$formats= $yy."/".$mm."/".$dd." ".$iTime;
			}
			
			return $formats;
  }
  
     
  
  
?>