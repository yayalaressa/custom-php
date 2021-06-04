<?php
if (!defined('BASEPATH')) die('Access Denied!');

// Middleware Admin
$router->before('GET|POST', '/admin/.*', function() {
    if (!isset($_SESSION['user'])) {
        header('location: /login');
        exit();
    }
});

// Index
$router->get('/', function() use($app) {
	ob_start('cache');
	
    $app->model('welcome_model');
    $data['message'] = $app->welcome_model->hello();
    $app->render('welcome_view', $data);
});

// Post
$router->get('/post(/[a-z0-9_-]+)?', function($slug = null) {
	// if no cache, callback cache
    ob_start('cache');
    
    if (!$slug) { echo 'Blog day overview'; return; }
    echo 'Post ' . htmlentities($slug) . ' detail';
});

// Profil
$router->get('/profile/{username}', function($username) {
	// if no cache, callback cache
    ob_start('cache');
    
    echo 'Profile #' . $username;
});

// Tag
$router->get('/tag(/[a-z0-9_.]+)?', function($tag) {
	// if no cache, callback cache
    ob_start('cache');
    
    echo 'Tag #' . $tag;
});

// Admin
$router->get('/admin/welcome', function() use($admin) {
    $admin->model('welcome_model');
    $data['message'] = $admin->welcome_model->hello();
    $admin->render('welcome_view', $data);
});

// Clear Cache
$router->get('/admin/clear_cache', function() use($admin) {
	clear_cache(); // clear cache
	$data['message'] = 'SUCCESS: Clear cache!';
    $admin->render('welcome_view', $data);
});

// Error Handling
$router->get('/api(/.*)?', function() {
    header('HTTP/1.1 404 Not Found');
    header('Content-Type: application/json');

    $jsonArray = array();
    $jsonArray['status'] = "404";
    $jsonArray['message'] = "route not defined";

    echo json_encode($jsonArray, JSON_PRETTY_PRINT);
});

$router->get('.*', function() use($app) {
    header('HTTP/1.1 404 Not Found');
    $app->render('404');
});

// Run it!
$router->run();
