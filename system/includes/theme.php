<?php
if (!defined('BASEPATH')) die('Access Denied!');

// Twig Template Engine v3
class Theme {

    public $twig;

    function __construct() {
        $loader = new \Twig\Loader\FilesystemLoader(BASEPATH.'/themes/default');
        $this->twig = new \Twig\Environment($loader, [
                            'cache' => BASEPATH.'/cache/site',
                        ]);
    }

    public function set($set = null) {
        if($set == 'admin') {
            $loader = new \Twig\Loader\FilesystemLoader(BASEPATH.'/system/admin/views');
            $this->twig = new \Twig\Environment($loader, [
                                'cache' => BASEPATH.'/cache/admin',
                            ]);
            return $this;
        } else {
            error(500, 'Error rendering theme!');
        }
    }

    public function render($page = null, $data = array()) {
        echo $this->twig->render($page.'.html', $data);
    }
}

?>