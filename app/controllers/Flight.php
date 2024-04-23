<?php
namespace app\controllers;

define('PLANNED', 0);
define('CONFIRMED',1);

//#[\app\filters\Login]
class Flight extends \app\core\Controller{

	public function index(){
		if(isset($_GET['action'])){
			$start_date = $_GET['start_date'];
			$departure = substr($_GET['departure'],0,3);
			$arrival = substr($_GET['arrival'],0,3);
			$connections = $_GET['connections'];
			$layover_tolerance = $_GET['layover_tolerance']; //minutes needed for layover (may include baggage claim/recheck in certain cases)
			$two_stop_paths = [];
			$one_stop_paths = [];

			switch ($connections) {
				case '2':
					$two_stop_paths = \app\daos\Flight::get3FlightPaths($departure, $arrival, $layover_tolerance);
				case '1':
					$one_stop_paths = \app\daos\Flight::get2FlightPaths($departure, $arrival, $layover_tolerance);
				default:
					$direct_flights = \app\daos\Flight::getDirectFlights($departure, $arrival);
			}

			$trips = array_merge($direct_flights, $one_stop_paths, $two_stop_paths);

			usort($trips, "\app\models\Flight::compare");

			$this->view('Flight/searchResults',
				[	
					'trips'=>$trips
				]
			);
		}else{
			$departure = $_GET['start_airport']??'';
			$this->view('Flight/index',['departure'=>$departure]);
		}
	}

	public function selectTrip(){
		$flightKeys = $_GET['flights'];
		$trip = new \app\models\Trip();
		$trip->flight_keys = $flightKeys;
		$trip->user_id = get_user_id();
		$trip->start_date = $_SESSION['start_date']??date('Y-m-d');
		$trip->purchased = 0;
		$trip->insert();
		header('location:/Flight/travelPlan');
	}

	public function TravelPlan(){
		$planned_trips = \app\daos\Trip::getForUser(get_user_id(),PLANNED);
		$confirmed_trips = \app\daos\Trip::getForUser(get_user_id(),CONFIRMED);
		$this->view('Flight/travelPlan',['planned_trips'=>$planned_trips,'confirmed_trips'=>$confirmed_trips]);
	}

	public function deleteTrip(){
		$trip = new \app\models\Trip();
		$trip->start_date = $_GET['start_date'];
		$trip->flight_keys = $_GET['flights'];
		$trip->user_id = get_user_id();
		$trip->delete();
		header('location:/Flight/TravelPlan');
	}

	#[\app\filters\Login]
	public function confirmTrip(){
		$trip = new \app\models\Trip();
		$trip->start_date = $_GET['start_date'];
		$trip->flight_keys = $_GET['flights'];
		$trip->user_id = get_user_id();
		$trip->confirm();
		header('location:/Flight/TravelPlan');
	}

	public function findAirport($term){
		$airports = \app\daos\Airport::find($term);
		echo json_encode($airports);
	}
}