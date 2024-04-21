<?php
namespace app\controllers;

//#[\app\filters\Login]
class Flight extends \app\core\Controller{


	private static function cmp($a, $b){
	    return ($a->total_price - $b->total_price);
	}

	public function index(){
		if(isset($_GET['action'])){
			$departure = $_GET['departure'];
			$arrival = $_GET['arrival'];
			$connections = $_GET['connections'];

			$two_stop_paths = [];
			$one_stop_paths = [];

			switch ($connections) {
				case '2':
					$two_stop_paths = \app\daos\Flight::get3FlightPaths($departure, $arrival);
				case '1':
					$one_stop_paths = \app\daos\Flight::get2FlightPaths($departure, $arrival);
				default:
					$direct_flights = \app\daos\Flight::getDirectFlights($departure, $arrival);
			}

			$trips = array_merge($direct_flights, $one_stop_paths, $two_stop_paths);

			usort($trips, "self::cmp");

			$this->view('Flight/searchResults',
//			$this->view('dataTester',
				[	
					'trips'=>$trips
				]
			);

		}else{
			$this->view('Flight/index');
		}
	}

	public function selectTrip(){
		$flightKeys = $_GET['flights'];
		$flights = json_decode($flightKeys);
		$tripFlights = [];
		foreach ($flights as $flight) {
			$flightObj = \app\daos\Flight::getFlight($flight->airline,$flight->number);
			$tripFlights[] = $flightObj;
		}
		echo json_encode($tripFlights);
	}

	public function create($client_id){
		if(!isset($_POST['action'])){	//display he view if I don't submit the form
			$myClient = \app\daos\Client::get($client_id);
			$this->view('Animal/create',$myClient);
		}else{	//process the data
			$newAnimal = new \app\models\Animal();
			$newAnimal->client_id = $client_id;
			$newAnimal->name=$_POST['name'];
			$newAnimal->dob=$_POST['dob'];
			$newAnimal->insert();
			header("location:/Animal/index/$client_id");
		}
	}

	public function update($animal_id){
		//TODO: update a specific record
		$animal = \app\daos\Animal::get($animal_id);//get the specific animal
		//TODO: check if the animal exists
		if(!isset($_POST['action'])){
			//show the view
			$this->view('Animal/update', $animal);
		}else{
			$animal->name=$_POST['name'];
			$animal->dob=$_POST['dob'];
			$animal->update();
			header('location:/Animal/index/' . $animal->client_id);
		}
	}

	public function delete($animal_id){
		$animal = \app\daos\Animal::get($animal_id);//get the specific animal
		$animal->delete();
		header('location:/Animal/index/' . $animal->client_id);
	}

	public function details($animal_id){
		$animal = \app\daos\Animal::get($animal_id);//get the specific animal
		$this->view('Animal/details', $animal);
	}

	public function contactInformation(){
		$fileHandle = fopen('contactInformation.txt', 'r');
		flock($fileHandle, LOCK_SH);
		$jsonData = fread($fileHandle, 1024);
		fclose($fileHandle);
		$dataObj = json_decode($jsonData);
		$this->view('Animal/contactInformation', $dataObj);
	}
}