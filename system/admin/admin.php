<?php
if (!defined('BASEPATH')) die('Access Denied!');

class Admin {
	
	public $twig;
	
	function __construct() {
		$loader = new \Twig\Loader\FilesystemLoader(BASEPATH.'/system/admin/views');
        $this->twig = new \Twig\Environment($loader, [
                                'cache' => BASEPATH.'/cache/admin',
                            ]);
	}
	
	public function add_post() {
		
	}
	
	public function edit_post() {
		
	}
	
	public function render($page = null, $data = array()) {
		echo $this->twig->render($page.'.html', $data);
	}
	
}