<?php
if (!defined('BASEPATH')) die('Access Denied!');

// Middleware Admin
$router->before('GET|POST', '/admin/.*', function() {
    if (!isset($_SESSION['user'])) {
        header('location: /login');
        exit();
    }
});

// Subrouting Admin
$router->mount('/admin', function() use ($router, $admin) {
	
	$router->get('/', function() use($admin) {
        $data['hello'] = 'Hello Administrator!';
        $admin->render('home', $data); // admin render 
    });
	
    $router->get('/add_post', function() {
        echo 'movies overview';
    });

    $router->get('/edit_post/(\d+)', function($id) {
        echo 'movie id ' . htmlentities($id);
    });
    
});

// Index
$router->get('/', function() use($app) {
	// if no cache, callback cache
    ob_start('cache');
        
	$data['hello'] = 'Hello World!';
	$app->render('home', $data);
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

// Login
$router->get('/login', function() {
    echo 'About Page Contents';
});

// Error Handling
$router->get('/api(/.*)?', function() {
    header('HTTP/1.1 404 Not Found');
    header('Content-Type: application/json');

    $jsonArray = array();
    $jsonArray['status'] = "404";
    $jsonArray['status_text'] = "route not defined";

    echo json_encode($jsonArray, JSON_PRETTY_PRINT);
});

$router->get('.*', function() {
    header('HTTP/1.1 404 Not Found');
    echo 'HTTP/1.1 404 Not Found';
});

// Run it!
$router->run();

?>