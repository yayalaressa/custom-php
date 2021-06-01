<?php

define('BASEPATH', dirname(__FILE__));

// Require composer autoloader
require_once BASEPATH . '/system/vendor/autoload.php';

// vQmod
require_once(BASEPATH . '/vqmod/vqmod.php');
VQMod::bootup();

// Create Router instance
$router = new \Bramus\Router\Router();

// VQMODDED Startup
require_once(VQMod::modCheck(BASEPATH . '/system/app.php'));

// Run it!
$router->run();

?>