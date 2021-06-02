<?php

// source code https://stackoverflow.com/questions/14420176/automatically-create-cache-file-with-php/14420265
function getUrl() {
    if(!empty($_SERVER['REQUEST_URI'])) {
    	$url = str_replace('/', '#', str_replace('?', '~', $_SERVER['REQUEST_URI']));
    } else {
    	$url = str_replace('/', '#', str_replace('?', '~', $_SERVER['REQUEST_URI']));
    }
    return $url;
}

//getUrl gets the queried page with query string
function cache($buffer) { //page's content is $buffer
    // mkdir
    if (is_dir(BASEPATH . "/cache/pages/") === false) {
        mkdir(BASEPATH . "/cache/pages/", 0775, true);
    }

    if(config('cache.enable') == 'true') {
    	$url = getUrl();
        $filename = $url . '.cache';
        $watermark = "\n<!-- Cached page generated on ".date('Y-m-d H:i:s')." -->";
        $data = stripslashes($buffer . $watermark);
        $filew = fopen(BASEPATH . "/cache/pages/" . $filename, 'w');
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
    $filename = $url . '.cache';
    if (!file_exists(BASEPATH . "/cache/pages/" . $filename)) {
        return false;
    }
    $filer = fopen(BASEPATH . "/cache/pages/" . $filename, 'r');
    $data = fread($filer, filesize(BASEPATH . "/cache/pages/" . $filename));
    fclose($filer);
    if (time()-(100) > filemtime(BASEPATH . "/cache/pages/" . $filename)) { // 100 is the cache time here!!!
        return false;
    }
        echo $data;
        die();
}


?>