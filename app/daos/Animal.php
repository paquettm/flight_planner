<?php
namespace app\daos;

class Animal extends \app\core\DAO{

	public static function getOwner($data){
		$SQL = 'SELECT * FROM client WHERE client_id = :client_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['client_id'=>$data->client_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Client");
		return $STMT->fetch();
	}

	public static function get($animal_id){
		$SQL = 'SELECT * FROM animal WHERE animal_id = :animal_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['animal_id'=>$animal_id]);
		//TODO:add something here to make the return types cooler
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Animal");
		return $STMT->fetch();
	}

	public static function getAll(){
		$SQL = 'SELECT * FROM animal';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute();
		//TODO:add something here to make the return types cooler
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Animal");
		return $STMT->fetchAll();
	}

	public static function getAllForClient($client_id){
		$SQL = 'SELECT * FROM animal WHERE client_id=:client_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['client_id'=>$client_id]);
		//TODO:add something here to make the return types cooler
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Animal");
		return $STMT->fetchAll();
	}

	protected static function insert($data){
		$SQL = 'INSERT INTO animal(client_id,name,dob) VALUES(:client_id,:name,:dob)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['client_id'=>$data->client_id,'name'=>$data->name,'dob'=>$data->dob]);
	}

	protected static function update($data){
		$SQL = 'UPDATE animal SET name = :name, dob = :dob WHERE animal_id = :animal_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['name'=>$data->name,'dob'=>$data->dob,'animal_id'=>$data->animal_id]);
	}

	public static function delete($data){
		$SQL = 'DELETE FROM animal WHERE animal_id = :animal_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['animal_id'=>$data->animal_id]);
	}

}