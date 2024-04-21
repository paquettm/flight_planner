<?php
namespace app\daos;

class Client extends \app\core\DAO{

	public static function get($client_id){
		$SQL = 'SELECT * FROM client WHERE client_id = :client_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['client_id'=>$client_id]);
		//TODO:add something here to make the return types cooler
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Client");
		return $STMT->fetch();
	}

	public static function getAll(){
		$SQL = 'SELECT * FROM client';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute();
		//TODO:add something here to make the return types cooler
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Client");
		return $STMT->fetchAll();
	}

	public static function getAnimals($data){
		$SQL = 'SELECT * FROM animal WHERE client_id=:client_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['client_id'=>$data->client_id]);
		//TODO:add something here to make the return types cooler
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Animal");
		return $STMT->fetchAll();
	}

	protected static function insert($data){
		if($data->isValid()){//call to validation
			$SQL = 'INSERT INTO client(first_name,last_name,notes,phone) VALUES(:first_name,:last_name,:notes,:phone)';
			$STMT = self::$_connection->prepare($SQL);
			$STMT->execute(['first_name'=>$data->first_name,'last_name'=>$data->last_name,'notes'=>$data->notes,'phone'=>$data->phone]);
		}	
	}

	protected static function update($data){
		if($data->isValid()){//call to validation
			$SQL = 'UPDATE client SET first_name = :first_name, last_name = :last_name, notes = :notes, phone = :phone WHERE client_id = :client_id';
			$STMT = self::$_connection->prepare($SQL);
			$STMT->execute(['first_name'=>$data->first_name,'last_name'=>$data->last_name,'notes'=>$data->notes,'phone'=>$data->phone,'client_id'=>$data->client_id]);
		}
	}

	public static function delete($client_id){
		$SQL = 'DELETE FROM client WHERE client_id = :client_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['client_id'=>$client_id]);
	}
}