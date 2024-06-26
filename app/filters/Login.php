<?php
namespace app\filters;
//classes in this namespace will have an execute method
//the framework runs execute to ensure the filtering

#[\Attribute]
class Login extends \app\core\AccessFilter{

	function execute(){
		if(!isset($_SESSION['username'])){
			$_SESSION['redirect'] = $_SERVER['REQUEST_URI'];
			header('location:/User/index');
			return true; //I want to indicate to the framework that the user is filtered
		}
		return false;
	}

}