<?php
namespace app\models;

//maybe we can group trips within an occasion or some other term
class Trip extends \app\core\Model{
	public $trip_id;
	public $user_id;
	public $start_date;
	public $flight_keys;
	public $purchased; //false if planning, true if purchased
}