<?php
namespace app\controllers;

define('PLANNED', 0);
define('CONFIRMED',1);

//#[\app\filters\Login]
class Flight extends \app\core\Controller{

	public function index(){
		if(isset($_GET['action'])){
			$trip_type= $_GET['trip_type'];
			$start_date = $_GET['start_date'];
			$departure_airport = substr($_GET['departure_airport'],0,3);
			$arrival_airport = substr($_GET['arrival_airport'],0,3);
			$connections = $_GET['connections'];
			$layover_tolerance = $_GET['layover_tolerance']; //minutes needed for layover (may include baggage claim/recheck in certain cases)
			$stopover_tolerance = $_GET['stopover_tolerance']; //stop at a city while traveling

			if($trip_type=='departure'){//preparation for return trip
				$_SESSION['round_trip'] = ['start_date'=> $_GET['return_date'],
				'return_date'=> null,
				'departure_airport'=> $arrival_airport,
				'arrival_airport'=> $departure_airport,
				'connections'=> $connections,
				'layover_tolerance'=> $layover_tolerance,
				'stopover_tolerance'=> $stopover_tolerance,
				'trip_type'=>'return',
				'action'=>'Search'
				];
			}elseif ($trip_type == 'return') {
				// this is where we would set another session variable
				// in case updating the trip record would be preferable
				// to adding a new one
				// but the choice was made that as many trip segments
				// as desired could be stored in trip records for any user
			}

			$two_stop_paths = [];
			$one_stop_paths = [];

			$stopover = ($stopover_tolerance === "1");
			switch ($connections) {
				case '2':
					$two_stop_paths = \app\daos\Flight::get3FlightPaths($departure_airport, $arrival_airport, $layover_tolerance,$stopover);
				case '1':
					$one_stop_paths = \app\daos\Flight::get2FlightPaths($departure_airport, $arrival_airport, $layover_tolerance,$stopover);
				default:
					$direct_flights = \app\daos\Flight::getDirectFlights($departure_airport, $arrival_airport);
			}

			$trips = array_merge($direct_flights, $one_stop_paths, $two_stop_paths);

			usort($trips, "\app\models\Flight::compare");

			$this->view('Flight/searchResults',
				[	
					'trips'=>$trips,
					'start_date'=>$start_date,
					'departure_airport'=>$departure_airport,
					'arrival_airport'=>$arrival_airport,
					'trip_type'=>$trip_type
				]
			);
		}else{
			$departure_airport = $_GET['departure_airport']??'';
			$this->view('Flight/index',['departure_airport'=>$departure_airport]);
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
		// the choice could be made to update adding more flights to the trip here, instead of adding a new trip record
		if(isset($_SESSION['round_trip'])){
			header('location:/Flight/index?' . http_build_query($_SESSION['round_trip']));
			unset($_SESSION['round_trip']);
			return;
		}else
			header('location:/Flight/travelPlan');
	}

	public function TravelPlan(){
		$planned_trips = \app\daos\Trip::getForUser(get_user_id(),PLANNED);
		$confirmed_trips = \app\daos\Trip::getForUser(get_user_id(),CONFIRMED);
		$this->view('Flight/travelPlan',['planned_trips'=>$planned_trips,'confirmed_trips'=>$confirmed_trips]);
	}

	#[\app\filters\Login]
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