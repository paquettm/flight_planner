<?php
namespace app\daos;

class User extends \app\core\DAO{

	public static function exists($data){ //returns false if the record does not exist and true otherwise
		return $data->get($data->username) != false;
	}

	public static function get($username){
		$SQL = 'SELECT * FROM user WHERE username = :username';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['username'=>$username]);
		//TODO:add something here to make the return types cooler
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\User");
		return $STMT->fetch();
	}

	protected static function insert($data){
		$SQL = 'INSERT INTO user(user_id,username,password_hash) VALUES(:user_id,:username,:password_hash)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$data->user_id,'username'=>$data->username,'password_hash'=>$data->password_hash]);
		return $STMT->rowCount();
	}

	protected static function update($data){
		$SQL = 'UPDATE user SET password_hash=:password_hash WHERE username=:username';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['username'=>$data->username,'password_hash'=>$data->password_hash]);
		return $STMT->rowCount();
	}

}