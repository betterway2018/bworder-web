<?php 

//�ѹ���ͧ��
function dayofyear($date){
$yy=substr($date,0,4);$mm=substr($date,5,2);$dd=substr($date,8,2);
$m=array();
$m['01']=0;$m['02']=31;$m['03']=59;$m['04']=90;$m['05']=120;$m['06']=151;
$m['07']=181;$m['08']=212;$m['09']=243;$m['10']=273;$m['11']=304;$m['12']=334;
$day=$m[$mm];
if(($yy%4==0)&&($mm>"02"))
$dayofyear=$day+$dd+1;
else
$dayofyear=$day+$dd;
return $dayofyear;
}

//�Ҩӹǹ�ѹ������ҡ�ѹ��������鹶֧�ѹ�������ش
function numDay($st_date,$ed_date){
$st_y=substr($st_date,0,4);
$ed_y=substr($ed_date,0,4);
$st_dofy=dayofyear($st_date);
$ed_dofy=dayofyear($ed_date);
if($st_y<>$ed_y){
for($i=$st_y;$i<=$ed_y;$i++){		
		if($i%4==0)
		$day=366;
		else 
		$day=365;
		if($i==$st_y)
		$day=$day-$st_dofy;
		if($i==$ed_y)
		$day=$ed_dofy;
		$num=$num+$day;
}
}else{
$num=$ed_dofy-$st_dofy;
}return $num;
}

//�ѧ���� �ѹ���
function dateThai($date){
	$_month_name = array("01"=>"���Ҥ�","02"=>"����Ҿѹ��","03"=>"�չҤ�","04"=>"����¹","05"=>"����Ҥ�","06"=>"�Զع�¹","07"=>"�á�Ҥ�","08"=>"�ԧ�Ҥ�","09"=>"�ѹ��¹","10"=>"���Ҥ�","11"=>"��Ȩԡ�¹","12"=>"�ѹ�Ҥ�");
	
	$yy=substr($date,0,4);$mm=substr($date,5,2);$dd=substr($date,8,2);$time=substr($date,11,8);
	$yy+=543;
	$dateT=intval($dd)." ".$_month_name[$mm]." ".$yy." ".$time;
	return $dateT;
}
	
function MonthName($monthNo) {
	$_month_name = array("1"=>"���Ҥ�","2"=>"����Ҿѹ��","3"=>"�չҤ�","4"=>"����¹","5"=>"����Ҥ�","6"=>"�Զع�¹","7"=>"�á�Ҥ�","8"=>"�ԧ�Ҥ�","9"=>"�ѹ��¹","10"=>"���Ҥ�","11"=>"��Ȩԡ�¹","12"=>"�ѹ�Ҥ�");
       return $_month_name[$monthNo];
	 
}
?>