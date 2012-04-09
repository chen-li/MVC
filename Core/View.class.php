<?php
class View{
	/**
	 * the values can be set for the view in this array
	 * @var array
	 */
	protected $vars = array();
	
	/**
	 * merge the values to array $vars
	 * @param string|array $var
	 * @param string $value
	 * @return void
	 */
	public function assign($var, $value){
		if(is_array($var)){
			$this->vars = array_merge($this->vars, $var);
		}
		else{
			$this->vars[$var] = $value;
		}
	}
	
	/**
	 * render the view file
	 * @param string $file
	 * @return void
	 */
	public function display($file){
		$templateFile = ROOT_PATH.'/Views/'.$file.'.php';
		if(!file_exists($templateFile)){
			exit('The template file '.$file.' is missing');
		}
		include($templateFile);
	}
}
?>