<?php
if (!defined('BASEPATH')) die('Access Denied!');
ini_set('session.save_path', BASEPATH . 'cache/session');
ini_set('session.use_trans_sid', 0);
ini_set('session.use_strict_mode', 1);
ini_set('session.use_cookies', 1);
ini_set('session.use_only_cookies', 1);
		
if(is_dir(BASEPATH . "cache/session/") === false)
{
	mkdir(BASEPATH . "cache/session/", 0775, true);
}

// session
session_start();

// fitur check online
if(isset($_SESSION['last_login'])) {
	$_SESSION['last_login'] = time() + (2*60); // last login tambah 2 menit
}

