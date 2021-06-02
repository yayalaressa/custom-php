<?php
if (!defined('BASEPATH')) die('Access Denied!');

// Source from HTMLy
$samesite = 'strict';
if(PHP_VERSION_ID < 70300) {
    session_set_cookie_params('samesite='.$samesite);	
} else {
    session_set_cookie_params(['samesite' => $samesite]);
}

if (isset($_COOKIE['PHPSESSID']))
    session_start();
	
?>