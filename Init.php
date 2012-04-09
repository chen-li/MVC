<?php
header("Content-type:text/html;charset=utf-8"); 
!defined('ROOT_PATH') && define('ROOT_PATH', str_replace('\\', '/', dirname(__FILE__))); 
require ROOT_PATH . '/Core/Config.php';
require ROOT_PATH . '/Core/Controller.class.php';
require ROOT_PATH . '/Core/View.class.php';
require ROOT_PATH . '/Core/Model.class.php';
?>