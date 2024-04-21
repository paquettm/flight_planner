<?php
namespace app\controllers;

class Test extends \app\core\Controller{

	function index(){
		$this->view('Test/AjaxForm');
	}

	function feedback(){
		foreach ($_GET as $key=>$value){
			echo "GET: $key => $value\n";
		}
		foreach ($_POST as $key=>$value){
			echo "POST: $key => $value\n";
		}
		echo "Request received from IP: ", $_SERVER['REMOTE_ADDR'];
	}
}