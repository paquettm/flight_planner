<?php
namespace app\daos;

class Trip extends \app\core\DAO{

	public static function flightKeys($data){
		return \app\daos\Flight::flightKeys($data);
	}

	public static function getArrival($data){
		$flights = $data->flights;
		$flight = $flights[count($flights)-1];
		return $flight->arrival_airport;
	}

	public static function get($trip_id){
		$SQL = 'SELECT * FROM trip WHERE trip_id = :trip_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['trip_id'=>$trip_id]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Trip");
		return $STMT->fetch();
	}

	public static function getForUser($user_id, $purchased = 0){
		$SQL = 'SELECT * 
		FROM trip 
		WHERE user_id = :user_id 
		AND purchased = :purchased';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['user_id'=>$user_id,
						'purchased'=>$purchased]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Trip");
		return $STMT->fetchAll();
	}

	public static function getFlights($data){
		$flight_keys = json_decode($data->flight_keys);
		$flights = array_map(fn($x) => \app\daos\Flight::getFlight($x->airline,$x->number), $flight_keys);
		$total_price = array_sum(array_map(fn($x) => $x->price, $flights));
		return [$flights,$total_price];
	}

	public static function getAll(){
		$SQL = 'SELECT * FROM trip';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute();
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Trip");
		return $STMT->fetchAll();
	}

	protected static function insert($data){
		$SQL = 'INSERT INTO trip (user_id,start_date,flight_keys,purchased) 
		VALUES (:user_id,:start_date,:flight_keys,:purchased) ON DUPLICATE KEY UPDATE flight_keys = :flight_keys';//throw duplicates away
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(
			['user_id'=>$data->user_id,
			'start_date'=>$data->start_date,
			'flight_keys'=>$data->flight_keys,
			'purchased'=>$data->purchased]
		);
		//below will be 0 on duplicate key update
		$data->trip_id = self::$_connection->lastInsertId();
	}

	public static function confirm($data){
		$data->purchased=1;
		self::update($data);
	}

	public static function updateUserId($old_user_id,$new_user_id){
		$SQL='UPDATE trip SET
		user_id = :new_user_id
		WHERE user_id = :old_user_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(
			[	
				'new_user_id'=>$new_user_id,
				'old_user_id'=>$old_user_id
			]
		);
	}

	protected static function update($data){
		$SQL='UPDATE trip SET
		purchased=:purchased
		WHERE user_id = :user_id
		AND flight_keys = :flight_keys
		AND start_date = :start_date';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(
			[	'purchased'=>$data->purchased,
				'user_id' =>$data->user_id,
				'flight_keys'=>$data->flight_keys,
				'start_date'=>$data->start_date
			]
		);
	}

	public static function delete($data){
		$SQL='DELETE FROM trip 
		WHERE user_id = :user_id
		AND flight_keys = :flight_keys
		AND start_date = :start_date';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(
			[
			'user_id' => $data->user_id,
			'flight_keys' => $data->flight_keys,
			'start_date' => $data->start_date
			]
		);
	}

}