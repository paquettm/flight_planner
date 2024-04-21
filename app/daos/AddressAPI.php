<?php
namespace app\daos;

class AddressAPI extends \app\core\DAO{

	public static function find($postal){
		$SQL = 'SELECT * FROM AddressAPI WHERE postal = :postal';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['postal'=>$postal]);
		//TODO:add something here to make the return types cooler
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\AddressAPI");
		return $STMT->fetch();
	}

	//protected to force validation
	protected static function insert($data){
		$SQL = 'INSERT INTO AddressAPI(postal,result) VALUES(:postal,:result)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['postal'=>$data->postal,'result'=>$data->result]);
		return self::$_connection->lastInsertId();
	}
}