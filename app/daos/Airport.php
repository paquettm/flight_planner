<?php
namespace app\daos;

class Airport extends \app\core\DAO{

	public static function get($code){
		$SQL = 'SELECT * FROM airport WHERE code = :code';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['code'=>$code]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Airport");
		return $STMT->fetch();
	}

	public static function find($term){
		$SQL = 'SELECT * FROM airport 
		WHERE code LIKE :term
		OR city_code LIKE :term
		OR name LIKE :term
		OR city LIKE :term
		OR country_code LIKE :term
		OR region_code LIKE :term';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['term'=>"%$term%"]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Airport");
		return $STMT->fetchAll();
	}

	public static function getAll(){
		$SQL = 'SELECT * FROM airport';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Airport");
		return $STMT->fetchAll();
	}

//not managing the data in this app
	protected static function insert($data){
		//TODO
	}

	protected static function update($data){
		//TODO
	}

	public static function delete($data){
		//TODO
	}

}