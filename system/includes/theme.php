<?php

// Render Frontend Twig Template v3
function render($page = null, $data = [])
{
	$loader = new \Twig\Loader\FilesystemLoader(BASEPATH.'/themes/default');
    $twig = new \Twig\Environment($loader, [
    'cache' => BASEPATH.'/cache/site',
    ]);
    
    echo $twig->render($page.'.html', $data);
}

// View Admin for Backend Twig Template v3
function view($page = null, $data = [])
{
	$loader = new \Twig\Loader\FilesystemLoader(BASEPATH.'/system/admin/views');
    $twig = new \Twig\Environment($loader, [
    'cache' => BASEPATH.'/cache/admin',
    ]);
    
    echo $twig->render($page.'.html', $data);
}

?>