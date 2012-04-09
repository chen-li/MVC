<?php
class Welcome extends Controller
{
	/**
	 * execute the sql and pass the value to the view
	 * @return void
	 */
	public function index()
	{
		$model = $this->LoadModel('post');
		$res = $model->Query("SELECT * FROM posts");
		$row = $model->Fetch($res);
		print_r($row);
		$this->assign('title', 'Hello World');
		$this->assign('body', 'This is my own MVC');
		$this->display('index');
	}
}
?>