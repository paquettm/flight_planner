<?php
namespace app\models;

use DateTime;
use DateTimeZone;
use DateInterval;

class Flight extends \app\core\Model{
    #[\app\validators\NonEmpty]
    public $airline;
    #[\app\validators\NonEmpty]
    public $number;
    #[\app\validators\NonEmpty]
    public $departure_airport;
    #[\app\validators\NonEmpty]
    public $departure_time;
    #[\app\validators\NonEmpty]
    public $arrival_airport;
    #[\app\validators\NonEmpty]
    public $arrival_time;
    #[\app\validators\NonEmpty]
    public $price;

    public function __construct($obj = null){
        if($obj != null){
            $this->airline = $obj->airline;
            $this->number = $obj->number;
            $this->departure_airport = $obj->departure_airport;
            $this->departure_time = $obj->departure_time;
            $this->arrival_airport = $obj->arrival_airport;
            $this->arrival_time = $obj->arrival_time;
            $this->price = $obj->price;
        }
    }

    public static function compare($a, $b){
        return ($a->total_price - $b->total_price);
    }

    public static function tripTime($flights, $start_date){
        $flight_time = null;
        $flight_end = null;
        $lastFlight = null;
        $absolute_time_ref = new Datetime('1970-01-01 00:00:00');
        $flight_time_counter = new Datetime('1970-01-01 00:00:00');
        
        $trip_start = new DateTime(
            $start_date . " " . $flights[0]->departure_time,
            new DateTimeZone(
                $flights[0]->getDepartureAirport()->timezone
            )
        );
        
        foreach ($flights as $index => $flight) {
            [$flight_time,$flight_end] = self::flightTime($flight,$start_date);
            $flight_time_counter->add($flight_time);
            $start_date = $flight_end->format('Y-m-d');
            $lastFlight = $flight;
        }

        //$trip_end = $flight_end;
        $total_trip_time = $trip_start->diff($flight_end);
        $total_flight_time = $absolute_time_ref->diff($flight_time_counter);

        return [$total_trip_time,$total_flight_time];
    }

    public static function flightTime($flight, $start_date){
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
}