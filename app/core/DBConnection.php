<?php 
namespace app\core;

class DBConnection{

	static $connection = null;

	private function __construct(){
		if(self::$connection == null){
			//fetch environment variables from .env
			$dotenv = \Dotenv\Dotenv::createImmutable(getcwd());
			$dotenv->load();
//			$dotenv->required(['db_host', 'db_name', 'db_user', 'db_pass'])->notEmpty();//all are needed and none should be empty
			$dotenv->required(['db_host', 'db_name', 'db_user'])->notEmpty();//all are needed and none should be empty
			$dotenv->required(['db_pass']);//allow empty password
			self::$connection = new \PDO("mysql:host=$_ENV[db_host];dbname=$_ENV[db_name]", $_ENV['db_user'], $_ENV['db_pass']);
		}
	}

	public static function getInstance(){
		new DBConnection();
		return self::$connection;
	}

}
