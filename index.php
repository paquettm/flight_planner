<?php
//	echo Locale::getDefault();
	require_once('app/core/init.php');
/*
class Trip{
	public $start_date;
	public $flights;

	public function __construct(){
		$this->start_date = '2024-01-01';
		$this->flights = [];
		$flight = new \app\models\Flight();
		$flight->departure_time = '23:00:00';
		$flight->arrival_time = '1:00:00';
		$flight->departure_airport = 'YUL';
		$flight->arrival_airport = 'YVR';
		$this->flights[] = $flight;

		$flight = new \app\models\Flight();
		$flight->departure_time = '3:00:00';
		$flight->arrival_time = '1:00:00';
		$flight->departure_airport = 'YVR';
		$flight->arrival_airport = 'ORD';
		$this->flights[] = $flight;

	}
}

function flightTime($start_date, $flight){
	$departure_airport = $flight->getDepartureAirport();
	$arrival_airport = $flight->getArrivalAirport();

	$flight_start = new DateTime(
	    $start_date . " " . $flight->departure_time,
	    new DateTimeZone(
	        $departure_airport->timezone
	    )
	);

	$flight_end = new DateTime(
	    $start_date . " " . $flight->arrival_time,
	    new DateTimeZone(
	        $arrival_airport->timezone
	    )
	);

	//if flight time is negative, add a day (planes fly ~18 hours max)
	$flight_time = $flight_start->diff($flight_end);
	if ($flight_time->invert == 1){   
	    $flight_end = $flight_end->add(DateInterval::createFromDateString('1 day'));
	    $flight_time = $flight_start->diff($flight_end);
	}
	return [$flight_time,$flight_end];
}

$trip = new Trip();
$new_start_date = $trip->start_date;
foreach ($trip->flights as $index => $flight) {
	[$flight_time,$flight_end] = flightTime($new_start_date,$flight);
	$new_start_date = $flight_end->format('Y-m-d');
}
*/
	new \app\core\App();