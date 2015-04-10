<?php 


$xmlData = file_get_contents('http://mafreebox.freebox.fr/pub/fbx_info.txt');
$str = mb_convert_encoding($xmlData,"UTF-8","ISO-8859-1");


function str_chop_lines($str, $lines) {
    return implode("\n", array_slice(explode("\n", $str), $lines));
}

$str = str_chop_lines($str, 6);

$array = explode("\n\n\n", $str);