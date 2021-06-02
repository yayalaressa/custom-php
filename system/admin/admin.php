<?php
if (!defined('BASEPATH')) die('Access Denied!');

class Admin {
	
	public $twig;
	
	function __construct() {
		$loader = new \Twig\Loader\FilesystemLoader(BASEPATH.'/system/admin/views');
        $this->twig = new \Twig\Environment($loader);
	}
	
	public function add_post() {
		
	}
	
	public function edit_post() {
		
	}
	
	public function render($page = null, $data = array()) {
		// Page rendered time
    	$time_taken = (microtime(true) - $_SESSION['elapsed_time']);
    	$data['elapsed_time'] = round($time_taken,4);
        // Display
		echo $this->twig->render($page.'.html', $data);
	}
	
}