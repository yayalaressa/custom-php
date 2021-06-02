<?php
if (!defined('BASEPATH')) die('Access Denied!');

class App {

    public $twig;

    function __construct() {
    	// Twig Template Engine v3
        $loader = new \Twig\Loader\FilesystemLoader(BASEPATH.'/themes/default');
        $this->twig = new \Twig\Environment($loader);
    }
    
    /* Member */
    public function login() {
    	
    }
    
    public function logout() {
    	
    }
    
    public function registration() {
    	
    }
    
    public function forgot_password() {
    	
    }
    
    public function activation() {
    	
    }
    
    public function reset_password() {
    	
    }
    
    /* Post */
    public function add_post() {
    	
    }
    
    public function delete_post() {
    	
    }
    
    public function edit_post() {
    	
    }
    
    public function update_post() {
    	
    }
    
    public function view_post() {
    	
    }
    
    /* Category */
    public function add_category() {
    	
    }
    
    public function delete_category() {
    	
    }
    
    public function edit_category() {
    	
    }
    
    public function update_category() {
    	
    }
    
    public function view_category() {
    	
    }
    
    /* Reply */
    public function add_reply() {
    	
    }
    
    public function delete_reply() {
    	
    }
    
    public function edit_reply() {
    	
    }
    
    public function update_reply() {
    	
    }
    
    public function view_reply() {
    	
    }
    
    /* Render */
    public function render($page = null, $data = array()) {
    	// Page rendered time
    	$time_taken = (microtime(true) - $_SERVER['REQUEST_TIME_FLOAT']);
    	$data['elapsed_time'] = round($time_taken,4);
        // Display
        $html = $this->twig->render($page.'.html', $data);
        if(config('minify.enable') == 'true') echo Minifier::html($html);
        else echo $html;
    }
    
}

?>