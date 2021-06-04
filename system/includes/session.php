<?php
if (!defined('BASEPATH')) die('Access Denied!');

$secure = true; // if you only want to receive the cookie over HTTPS
$httponly = true; // prevent JavaScript access to session cookie
$samesite = 'strict';

if(PHP_VERSION_ID < 70300) {
	session_set_cookie_params('samesite='.$samesite, $_SERVER['HTTP_HOST'], $secure, $httponly);
} else {
	session_set_cookie_params([
            'domain' => $_SERVER['HTTP_HOST'],
            'secure' => $secure,
            'httponly' => $httponly,
            'samesite' => $samesite
        ]);
}
    
if (isset($_COOKIE['PHPSESSID']))
    session_start();
