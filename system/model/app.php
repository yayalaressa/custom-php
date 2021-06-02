<?php
if (!defined('BASEPATH')) die('Access Denied!');

class App {

    public $twig;

    function __construct() {
    	// Twig Template Engine v3
        $loader = new \Twig\Loader\FilesystemLoader(BASEPATH.'/themes/default');
        $this->twig = new \Twig\Environment($loader);
    }
    
    public function add_post() {
    	
    }
    
    public function render($page = null, $data = array()) {
    	// Page rendered time
    	$time_taken = (microtime(true) - $_SESSION['elapsed_time']);
    	$data['elapsed_time'] = round($time_taken,4);
        // Display
        $html = $this->twig->render($page.'.html', $data);
        echo Minifier::html($html);
    }
}

?>