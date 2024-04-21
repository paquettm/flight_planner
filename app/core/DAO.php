<?php
namespace app\core;

abstract class DAO{

	protected static $_connection;
	//connect to the database
	public static function connect(){
		self::$_connection = DBConnection::getInstance();
	}

	//if the function was called and not accessible it must require validation
	public static function __callStatic($method_name, $args){
		$called_class = get_called_class();
		if(method_exists($called_class, $method_name)){
			//call validation and then call the method
			//the first argument of this call should be the data
			if($args[0]->isValid())
			{
				return $called_class::$method_name(...$args);
			}
			else
			{
				return false;
			}
		}else{
			throw(new \Exception("No method {$method_name}!"));
		}
	}

	//must be protected to cause validation
	protected abstract static function insert($data);
	protected abstract static function update($data);
	//programmer should care to enforce other custom data modificaton
	// operations to also cause validation
}