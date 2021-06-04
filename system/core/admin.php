<?php if (!defined('BASEPATH')) die('Access Denied!');

class Admin {

	private static $instance;
    public $theme_data = array();

	function __construct() {
		self::$instance = $this;
	}
	
	public function library($library)
    {
        $library = strtolower($library);

		if (isset(self::$instance->$library))
        {
            error(500, 'ERROR: class ' . $library . ' is already exists!');
        }
        else
        {
            $filename = BASEPATH . 'system/libraries/' . $library . '.php';
            if (file_exists($filename))
            {
                require_once $filename;
                $class_name = ucfirst($library);
                if(class_exists($class_name)) {
                    self::$instance->$library = new $class_name();
                } else {
                    error(500, 'ERROR: class ' . $library . ' not found!');
                }
                
            }
            else
            {
                error(500, 'ERROR: file ' . $library . ' not found!');
            }
        }
    }

	public function model($model)
    {
        $model = strtolower($model);

    	if (isset(self::$instance->$model))
        {
            error(500, 'ERROR: class ' . $model . ' is already exists!');
        }
        else
        {
			$filename = BASEPATH . 'system/models/' . $model . '.php';
            if (file_exists($filename))
            {
                require_once BASEPATH . '/system/core/model.php';
                require_once $filename;
                $class_name = ucfirst($model);
                if(class_exists($class_name)) {
                    self::$instance->$model = new $class_name();
                } else {
                    error(500, 'ERROR: class ' . $model . ' not found!');
                }
                
            }
            else
            {
                error(500, 'ERROR: file ' . $model . ' not found!');
            }
        }
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

}

