<?php
if (!defined('BASEPATH')) die('Access Denied!');

// Index
$router->get('/', function() use($app) {
	$data['hello'] = 'Hello World!';
	$app->render('home', $data);
});

// Post
$router->get('/post(/[a-z0-9_-]+)?', function($slug = null) {
    if (!$slug) { echo 'Blog day overview'; return; }
    echo 'Post ' . htmlentities($slug) . ' detail';
});

// Profil
$router->get('/profile/{username}', function($username) {
    echo 'Profile #' . $username;
});

// Tag
$router->get('/tag(/[a-z0-9_.]+)?', function($tag) {
    echo 'Tag #' . $tag;
});

// Admin
$router->get('/admin', function() use($admin) {
	$data['hello'] = 'Hello Administrator!';
	$admin->render('home', $data); // admin render 
});

// Login
$router->get('/login', function() {
    echo 'About Page Contents';
});

// Middleware
$router->before('GET|POST', '/admin/.*', function() {
    if (!isset($_SESSION['user'])) {
        header('location: /login');
        exit();
    }
});

// Error Handling
$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo '404 Not Found';
});

// Run it!
$router->run();

?>