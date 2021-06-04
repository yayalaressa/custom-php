<?php

// Define Root
define('BASEPATH', str_replace("\\", "/", realpath(dirname(__FILE__))) . '/');
require_once BASEPATH . 'system/vendor/autoload.php';
// Load the configuration file
config('source', BASEPATH . '/config/config.ini');
// Set the timezone
if (config('timezone')) date_default_timezone_set(config('timezone'));
else date_default_timezone_set('Asia/Jakarta');
// Display cache
display_cache();
// Start buffer
ob_start();
// Create Router instance
$router = new \Bramus\Router\Router();
// Load class
$app = new App();
$admin = new Admin();
// Start
require_once BASEPATH . 'system/start.php';

