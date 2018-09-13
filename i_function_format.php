<?php

//แปลงจากตัวเลขเป็นจำนวนเงิน
function intToMoney($num){
$num=intval($num);
$ed=strlen($num)%3;
$str=substr($num,0,$ed); 
for($i=$ed;$i<strlen($num);$i+=3)
$str=$str.",".substr($num,$i,3);
if($ed==0)
$str=substr($str,1,strlen($str));
return $str;
}

?>