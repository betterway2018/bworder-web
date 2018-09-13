<?php
function decodePOLNum($oldnum) {
/*	$result = ''.number_format($oldnum,0);
	$result = str_replace(0,'L',$result);
	$result = str_replace(1,'H',$result);
	$result = str_replace(2,'N',$result);
	$result = str_replace(3,'M',$result);
	$result = str_replace(4,'T',$result);
	$result = str_replace(5,'R',$result);
	$result = str_replace(6,'F',$result);
	$result = str_replace(7,'V',$result);
	$result = str_replace(8,'U',$result);
	$result = str_replace(9,'X',$result);
*/	$result = "KK";
	return $result;	
}

function PHPalert($text) {
	echo '<script language="JavaScript">';
	echo 'alert("'.$text.'");';
	echo '</script>';
}

function tis620_to_utf8($text) {
    $utf8 = "";
    for ($i = 0; $i < strlen($text); $i++) {
        $a = substr($text, $i, 1);
        $val = ord($a);

        if ($val < 0x80) {
            $utf8 .= $a;
        } elseif ((0xA1 <= $val && $val < 0xDA) || (0xDF <= $val && $val <= 0xFB)) {
            $unicode = 0x0E00+$val-0xA0; $utf8 .= chr(0xE0 | ($unicode >> 12));
            $utf8 .= chr(0x80 | (($unicode >> 6) & 0x3F));
            $utf8 .= chr(0x80 | ($unicode & 0x3F));
        }
    }
    return $utf8;
}

function utf8_to_tis620($string) {
    $str = $string;
    $res = "";
    for ($i = 0; $i < strlen($str); $i++) {
        if (ord($str[$i]) == 224) {
            $unicode = ord($str[$i+2]) & 0x3F;
            $unicode |= (ord($str[$i+1]) & 0x3F) << 6;
            $unicode |= (ord($str[$i]) & 0x0F) << 12;
            $res .= chr($unicode-0x0E00+0xA0);
            $i += 2;
        } else {
            $res .= $str[$i];
        }
    }
    return $res;
}
?>