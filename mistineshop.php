<?php
header('Content-Type: text/html; charset=UTF-8');

$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");


$iphone = strtolower($iPhone);
$ipad = strtolower($iPad);
$android = strtolower($Android);


$rep_seq = $_GET['referrerid'];

if ($rep_seq != "") 
{
	require_once('Connections/db_etl61.php'); 
	mysql_select_db("bsmartshop", $db_connect);
	$query= "SELECT  REP_CODE,REP_SEQ FROM mslmst  WHERE REP_SEQ=$rep_seq";
	echo $query;
	$mslmst = mysql_query($query) or die(mysql_error());
	$row_mslmst = mysql_fetch_assoc($mslmst);
	$rep_code = $row_mslmst['REP_CODE'];
	if($ipad == "ipad" || $iphone == "iphone")
		{

			$newURL = 'https://appsto.re/th/LS6rbb.i?refid='.$rep_seq.'&refcode='.$rep_code;

		}
			
			if($android == "android")
			{
				//header('Location: ' . GOOGLE_DOWNLOAD_URL);
				$newURL = 'market://details?id=th.co.mistine.mistinecatalog&ah=N3wPTVWHjqvVd4t_9sccSVA399A&referrer=msl%3Emarket://details?id=th.co.mistine.mistinecatalog&ah=N3wPTVWHjqvVd4t_9sccSVA399A&referrer=msl%3E'.$rep_code;
			}
			else
			{
				$newURL = 'https://play.google.com/store/apps/details?id=th.co.mistine.mistinecatalog&ah=N3wPTVWHjqvVd4t_9sccSVA399A&referrer=msl%3E'.$rep_code;
				
			}
} 














else 
{
	require_once('Connections/db_etl61.php'); 
	mysql_select_db("bw_etl", $db_connect);
	$query= "SELECT  REP_CODE,REP_SEQ FROM MSLMST  WHERE REP_SEQ=$rep_seq";
	//echo $query;
	$mslmst = mysql_query($query, $db_connect) or die(mysql_error());
	$row_mslmst = mysql_fetch_assoc($mslmst);
	//$rep_code = $row_mslmst['DIST'].str_pad($row_mslmst['MSLNO'],5, "0", STR_PAD_LEFT).$row_mslmst['CHKDGT'];
	$rep_code = $row_mslmst['REP_CODE'];
	
}
if ($rep_code=='' || $rep_code=='00000')
{
	//echo $query.'<br>';
	echo "ข้อมูลสมาชิก ไม่ถูกต้อง";
} 
else 
{
	
		if( $iPod || $iPhone || $iPad)
		{

			$newURL = 'https://appsto.re/th/LS6rbb.i?refid='.$rep_seq.'&refcode='.$rep_code;
		
		

		}
      else 
		{
				
			if($Android)
			{
				//header('Location: ' . GOOGLE_DOWNLOAD_URL);
				$newURL = 'market://details?id=th.co.mistine.mistinecatalog&ah=N3wPTVWHjqvVd4t_9sccSVA399A&referrer=msl%3Emarket://details?id=th.co.mistine.mistinecatalog&ah=N3wPTVWHjqvVd4t_9sccSVA399A&referrer=msl%3E'.$rep_code;
			}
			else 
			{
				
				$newURL = 'https://play.google.com/store/apps/details?id=th.co.mistine.mistinecatalog&ah=N3wPTVWHjqvVd4t_9sccSVA399A&referrer=msl%3E'.$rep_code;
				//$newURL = 'https://appsto.re/th/LS6rbb.i?refid='.$rep_seq.'&refcode='.$rep_code;

			}
		}
//	echo $newURL;
   header('Location: '.$newURL);
}
?>