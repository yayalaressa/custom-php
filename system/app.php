<?php
if (!defined('BASEPATH')) die('Access Denied!');

// Load the configuration file
config('source', $config_file);

// Index
$router->get('/', function() use($theme) {
	$data['hello'] = 'Hello World!';
	$theme->render('home', $data);
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
$router->get('/admin', function() use($theme) {
	$data['hello'] = 'Hello Administrator!';
	$theme->set('admin')->render('home', $data); // admin render 
});

// Login
$router->get('/login', function() {
    echo 'About Page Contents';
});

// Error Handling
$router->set404(function() {
    header('HTTP/1.1 404 Not Found');
    echo '404 Not Found';
});

// Middleware
$router->before('GET|POST', '/admin/.*', function() {
    if (!isset($_SESSION['user'])) {
        header('location: /auth/login');
        exit();
    }
});

// Run it!
$router->run();

?>