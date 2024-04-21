<?php
namespace app\core;

class Controller{
	public function view($name, $data = []){
		if(is_array($data) && !array_is_list($data)){
			extract($data);
		}
		if(file_exists('app/views/' . $name . '.php')){
			global $localizations;
			global $lang;
			include('app/views/' . $name . '.php');
		}else
			echo 'app/views/' . $name . '.php does not exist';
	}
}
