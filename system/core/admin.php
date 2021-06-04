<?php if (!defined('BASEPATH')) die('Access Denied!');

class Admin {

	private static $instance;
    public $theme_data = array();

	function __construct() {
		self::$instance = $this;
	}
	
	private function set($name, $value){
		$this->theme_data[$name] = $value;
	}

	private function load($theme = '', $view = '' , $view_data = array(), $return = FALSE)
	{  
		$this->set('content', view($view, $view_data, TRUE));	
		return view($theme, $this->theme_data, $return);
	}
		
	public function render($view = '', $data = array(), $return = FALSE)
	{
		if(config('minify.enable') == 'true') {
			$html = $this->load('system/admin/views/overview', 'system/admin/views/'.$view, $data, TRUE);
			echo Minifier::html($html);
		} else { 
			$this->load('system/admin/views/overview', 'system/admin/views/'.$view, $data, $return);
		}
	}
	
	public function model($model)
    {
       load_model($model, Admin::get_instance());
    }
    
	public function library($library)
    {
       load_library($library, Admin::get_instance());
    }
    
	public static function get_instance()
	{
		return self::$instance;
	}

}

