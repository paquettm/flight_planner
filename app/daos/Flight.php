<?php
namespace app\daos;

class Flight extends \app\core\DAO{

	private static function converter($data){
		$data = json_decode($data);
		$data->flights = array_map(function($d){return new \app\models\Flight($d);}, $data->flights);
		return $data;
	}

	public static function flightKeys($flights){
		$fn = fn($x) => ['airline'=>$x->airline,'number'=>$x->number];
		return json_encode(array_map($fn, $flights->flights));
	}

	public static function getDirectFlights($departure_airport, $arrival_airport){
		$SQL = "SELECT JSON_OBJECT(
    'flights', JSON_ARRAY(
    	JSON_OBJECT(
	        'airline', airline,
	        'number', number,
	        'departure_airport', departure_airport,
	        'departure_time', departure_time,
	        'arrival_airport', arrival_airport,
	        'arrival_time', arrival_time,
	        'price', price
	    )
	),
    'total_price', price
) as data
		FROM flight 
		WHERE departure_airport = :departure_airport 
		AND arrival_airport = :arrival_airport";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['departure_airport'=>$departure_airport,
						'arrival_airport'=>$arrival_airport]);
		return $STMT->fetchAll(\PDO::FETCH_FUNC,function($data){return self::converter($data);}
		);
		//return $STMT->fetchAll();
	}

	public static function get2FlightPaths($departure_airport, $arrival_airport){

    $SQL = "SELECT JSON_OBJECT(
    'flights', JSON_ARRAY(
    	JSON_OBJECT(
	        'airline', a.airline,
	        'number', a.number,
	        'departure_airport', a.departure_airport,
	        'departure_time', a.departure_time,
	        'arrival_airport', a.arrival_airport,
	        'arrival_time', a.arrival_time,
	        'price', a.price
	    ),
	    JSON_OBJECT(
	        'airline', b.airline,
	        'number', b.number,
	        'departure_airport', b.departure_airport,
	        'departure_time', b.departure_time,
	        'arrival_airport', b.arrival_airport,
	        'arrival_time', b.arrival_time,
	        'price', b.price
	    )
	),
    'total_price', a.price + b.price
) as data
FROM flight AS a
INNER JOIN flight AS b ON a.arrival_airport = b.departure_airport
WHERE a.departure_airport = :departure_airport
AND b.arrival_airport = :arrival_airport
AND a.arrival_time < b.departure_time";

		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['departure_airport'=>$departure_airport,
						'arrival_airport'=>$arrival_airport]);
		return $STMT->fetchAll(\PDO::FETCH_FUNC,function($data){return self::converter($data);}
		);
	}

	public static function get3FlightPaths($departure_airport, $arrival_airport){
		$SQL = "SELECT JSON_OBJECT(
    'flights', JSON_ARRAY(
    	JSON_OBJECT(
	        'airline', a.airline,
	        'number', a.number,
	        'departure_airport', a.departure_airport,
	        'departure_time', a.departure_time,
	        'arrival_airport', a.arrival_airport,
	        'arrival_time', a.arrival_time,
	        'price', a.price
	    ),
	    JSON_OBJECT(
	        'airline', b.airline,
	        'number', b.number,
	        'departure_airport', b.departure_airport,
	        'departure_time', b.departure_time,
	        'arrival_airport', b.arrival_airport,
	        'arrival_time', b.arrival_time,
	        'price', b.price
	    ),
	    JSON_OBJECT(
	        'airline', c.airline,
	        'number', c.number,
	        'departure_airport', c.departure_airport,
	        'departure_time', c.departure_time,
	        'arrival_airport', c.arrival_airport,
	        'arrival_time', c.arrival_time,
	        'price', c.price
	    )
	),
    'total_price', a.price + b.price + c.price
) as data
    FROM flight AS a 
    INNER JOIN flight AS b ON a.arrival_airport = b.departure_airport 
    INNER JOIN flight AS c ON b.arrival_airport = c.departure_airport 
    WHERE a.departure_airport = :departure_airport 
    AND c.arrival_airport = :arrival_airport 
    AND a.arrival_airport <> :arrival_airport
    AND b.arrival_airport <> :arrival_airport
    AND a.arrival_time < b.departure_time
    AND b.arrival_time < c.departure_time";
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['departure_airport'=>$departure_airport,
						'arrival_airport'=>$arrival_airport]);
		return $STMT->fetchAll(\PDO::FETCH_FUNC,function($data){return self::converter($data);}
		);
	}

	public function getDepartureAirport(){
		$SQL = 'SELECT * FROM airport WHERE code = :departure_airport';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['departure_airport'=>$this->departure_airport]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Airport");
		return $STMT->fetch();
	}

	public function getArrivalAirport(){
		$SQL = 'SELECT * FROM airport WHERE code = :arrival_airport';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['arrival_airport'=>$this->arrival_airport]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Airport");
		return $STMT->fetch();
	}

	public static function getFlight($airline, $number){
		$SQL = 'SELECT * FROM flight WHERE airline = :airline AND number = :number';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['airline'=>$airline,
						'number'=>$number]);
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Flight");
		return $STMT->fetch();
	}

	public static function getAll(){
		$SQL = 'SELECT * FROM flight';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute();
		//TODO:add something here to make the return types cooler
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Flight");
		return $STMT->fetchAll();
	}

	public static function getAllForAirline($airline){
		$SQL = 'SELECT * FROM flight WHERE airline=:airline';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['airline'=>$airline]);
		//TODO:add something here to make the return types cooler
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Flight");
		return $STMT->fetchAll();
	}

	public static function getAllForDepartureAirport($departure_airport){
		$SQL = 'SELECT * FROM flight WHERE departure_airport=:departure_airport';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['departure_airport'=>$departure_airport]);
		//TODO:add something here to make the return types cooler
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Flight");
		return $STMT->fetchAll();
	}

	public static function getAllForArrivalAirport($arrival_airport){
		$SQL = 'SELECT * FROM flight WHERE arrival_airport=:arrival_airport';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['arrival_airport'=>$arrival_airport]);
		//TODO:add something here to make the return types cooler
		$STMT->setFetchMode(\PDO::FETCH_CLASS, "app\models\Flight");
		return $STMT->fetchAll();
	}

//not managing the data in this app
	protected static function insert($data){
		/*$SQL = 'INSERT INTO animal(client_id,name,dob) VALUES(:client_id,:name,:dob)';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['client_id'=>$data->client_id,'name'=>$data->name,'dob'=>$data->dob]);*/
		//TODO
	}

	protected static function update($data){
		/*$SQL = 'UPDATE animal SET name = :name, dob = :dob WHERE animal_id = :animal_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['name'=>$data->name,'dob'=>$data->dob,'animal_id'=>$data->animal_id]);*/
		//TODO
	}

	public static function delete($data){
		/*$SQL = 'DELETE FROM animal WHERE animal_id = :animal_id';
		$STMT = self::$_connection->prepare($SQL);
		$STMT->execute(['animal_id'=>$data->animal_id]);*/
		//TODO
	}

}