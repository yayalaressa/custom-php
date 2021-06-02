<?php
if (!defined('BASEPATH')) die('Access Denied!');

// Source code https://harviacode.com/2015/01/16/membuat-fungsi-untuk-enkripsi-dan-dekripsi-php/
function encrypt($str) {
    $kunci = '7a12df986a0bc5671abc890';
    for ($i = 0; $i < strlen($str); $i++) {
        $karakter = substr($str, $i, 1);
        $kuncikarakter = substr($kunci, ($i % strlen($kunci))-1, 1);
        $karakter = chr(ord($karakter)+ord($kuncikarakter));
        $hasil .= $karakter;
    }
    return urlencode(base64_encode($hasil));
}

// Source code https://harviacode.com/2015/01/16/membuat-fungsi-untuk-enkripsi-dan-dekripsi-php/
function decrypt($str) {
    $str = base64_decode(urldecode($str));
    $hasil = '';
    $kunci = '7a12df986a0bc5671abc890';
    for ($i = 0; $i < strlen($str); $i++) {
        $karakter = substr($str, $i, 1);
        $kuncikarakter = substr($kunci, ($i % strlen($kunci))-1, 1);
        $karakter = chr(ord($karakter)-ord($kuncikarakter));
        $hasil .= $karakter;
    }
    return $hasil;
}