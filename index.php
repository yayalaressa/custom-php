<?php

// Define 
define('BASEPATH', dirname(__FILE__));
$config_file = 'config/config.ini';
// Require composer autoloader
require_once BASEPATH . '/system/vendor/autoload.php';
// vQmod
VQMod::bootup();
// Create Router instance
$router = new \Bramus\Router\Router();
// Class Theme
$theme = new Theme();
// VQMODDED Startup
require_once(VQMod::modCheck(BASEPATH . '/system/app.php'));

?>