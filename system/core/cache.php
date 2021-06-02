<?php

// source code https://stackoverflow.com/questions/14420176/automatically-create-cache-file-with-php/14420265
function getUrl() {
    if(!empty($_SERVER['REQUEST_URI'])) {
    	$url = $_SERVER['REQUEST_URI'];
    } else {
    	$url = $_SERVER['SCRIPT_NAME'];
    }
    return $url;
}

//getUrl gets the queried page with query string
function cache($buffer) { //page's content is $buffer
    if(config('cache.enable') == true) {
    $url = getUrl();
    $filename = md5($url) . '.cache';
    $watermark = "\n<!-- dynamic generated cache -->";
    $data = stripslashes($buffer . $watermark);
    $filew = fopen(BASEPATH . "/cache/" . $filename, 'w');
    fwrite($filew, $data);
    fclose($filew);
        return $buffer;
    } else {
    	return $buffer;
    }
}

// display cache
function display() {
    $url = getUrl();
    $filename = md5($url) . '.cache';
    if (!file_exists(BASEPATH . "/cache/" . $filename)) {
    return false;
    }
    $filer = fopen(BASEPATH . "/cache/" . $filename, 'r');
    $data = fread($filer, filesize(BASEPATH . "/cache/" . $filename));
    fclose($filer);
    if (time()-(100) > filemtime(BASEPATH . "/cache/" . $filename)) { // 100 is the cache time here!!!
        return false;
    }
        echo $data;
        die();
}


?>