<?php
spl_autoload_register(
	function($class_name){
		//for compatibility replace FQCN separator by DIRECTORY_SEPARATOR. 
		$class_name = str_replace('\\', DIRECTORY_SEPARATOR, $class_name);
		if(file_exists($class_name.'.php')){
			require_once($class_name . '.php');
			return true;
		}
		else
		{
			return false;
		}
	}
);