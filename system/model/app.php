<?php
if (!defined('BASEPATH')) die('Access Denied!');

class App {

    public $twig;

    function __construct() {
    	// Twig Template Engine v3
        $loader = new \Twig\Loader\FilesystemLoader(BASEPATH.'/themes/default');
        $this->twig = new \Twig\Environment($loader, [
                            'cache' => BASEPATH.'/cache/site',
                        ]);
    }
    
    public function add_post() {
    	
    }
    
    public function render($page = null, $data = array()) {
        echo $this->twig->render($page.'.html', $data);
    }
}

?>