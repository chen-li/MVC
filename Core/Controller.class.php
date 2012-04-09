<?php
class Controller{
	/**
	 * a view object
	 * @var object
	 */
	protected $view = NULL;
	
	/**
	 * create a view object
	 * @return void
	 */
	public function __construct(){
		$this->view = new View();
	}
	
	/**
	 * assign the value to the view
	 * @param string|array $var
	 * @param string $value
	 * @return void
	 */
	public function assign($var, $value=''){
		$this->view->assign($var, $value);
	}
	/**
	 * display the view file
	 * @param string $file
	 * @return void
	 */
	public function display($file){
		$this->view->display($file);
	}
	/**
	 * load the model class and connect the DB
	 * @param $modelName
	 * @return object
	 */
	public function LoadModel($modelName){
		$modelFile = ROOT_PATH.'/Models/'.$modelName.'.class.php';
		!file_exists($modelFile) && exit('The Model '.$modelName.' does not exist');
		include($modelFile);
		$class = ucwords($modelName);
		!class_exists($class) && exit('The Model Class'.$modelName.' is missing');
		$model = new $class();
		return $model;
	}
	/**
	 * create the controller object and call the action
	 * @return void
	 */
	public function Run(){
		$this->Analysis();
		$control = $_GET['c'];
		$action = $_GET['a'];
		$controlFile = ROOT_PATH.'/Controllers/'.$control.'.class.php';
		if(!file_exists($controlFile)){
			exit('The Controller File '.$controlFile.' is missing');
		}
		include($controlFile);
		$class = ucwords($control);
		if(!class_exists($class)){
			exit('The Controller Class '.$class.' is missing');
		}
		$instance = new $class();
		if(!method_exists($instance, $action)){
			exit('The Method '.$action.' is missing'); 
		}
		$instance->$action();
	}
	/**
	 * format the url
	 * @return void
	 */
	protected function Analysis(){
		global $C;//defined in the Config.php
		if($C['URL_MODE'] == 1){//http://localhost/index.php?c=controller&a=action
			$control = !empty($_GET['c']) ? trim($_GET['c']) : '';
			$action = !empty($_GET['a']) ? trim($_GET['a']) : ''; 
		}else if($C['URL_MODE'] == 2){//http://localhost/index.php/controller/action/param
			if(isset($_SERVER['PATH_INFO'])){//get /controller/action/param
				$path = trim($_SERVER['PATH_INFO'], '/'); 
				$paths = explode('/', $path); 
				$control = array_shift($paths); 
				$action = array_shift($paths); 
			}
		}
		$_GET['c'] = $control = !empty($control)?$control:$C['DEFAULT_CONTROL'];
		$_GET['a'] = $action = !empty($action)?$action:$C['DEFAULT_ACTION'];
	}
}
?>