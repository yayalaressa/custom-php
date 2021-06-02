<?php

// Define 
define('BASEPATH', dirname(__FILE__));
// Require composer autoloader
require_once BASEPATH . '/system/vendor/autoload.php';
// Load the configuration file
config('source', BASEPATH . '/config/config.ini');
// Set the timezone
if (config('timezone')) date_default_timezone_set(config('timezone'));
else date_default_timezone_set('Asia/Jakarta');
// Display cache
display();
// Create Router instance
$router = new \Bramus\Router\Router();
// Load model Administrator
$admin = new Admin();
// Load model Application
$app = new App();
// Start
VQMod::bootup();
require_once(VQMod::modCheck(BASEPATH . '/system/start.php'));

?>