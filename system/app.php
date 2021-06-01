<?php

// This route handling function will only be executed when visiting http(s)://www.example.org/
$router->get('/', function() {
	$data['hello'] = 'Hello World!';
	render('home', $data);
});

// This route handling function will only be executed when visiting http(s)://www.example.org/
$router->get('/admin', function() {
	$data['hello'] = 'Hello Administrator!';
	view('home', $data);
});

// This route handling function will only be executed when visiting http(s)://www.example.org/about
$router->get('/about', function() {
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

?>