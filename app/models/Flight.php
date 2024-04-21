<?php
namespace app\models;

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
}