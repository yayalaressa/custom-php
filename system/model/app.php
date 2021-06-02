<?php
if (!defined('BASEPATH')) die('Access Denied!');

class App {

    public $twig;

    function __construct() {
        $loader = new \Twig\Loader\FilesystemLoader(BASEPATH.'/themes/default');
        $this->twig = new \Twig\Environment($loader, [
                            'cache' => BASEPATH.'/cache/site',
                        ]);
    }

    public function render($page = null, $data = array()) {
        echo $this->twig->render($page.'.html', $data);
    }
}

?>