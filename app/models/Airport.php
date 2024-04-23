<?php
namespace app\models;

class Airport extends \app\core\Model{
//CREATE TABLE `airport` (
public $code;//   `code` varchar(10) NOT NULL,
public $city_code;//   `city_code` varchar(10) NOT NULL,
public $name;//   `name` varchar(100) NOT NULL,
public $city;//   `city` varchar(100) NOT NULL,
public $country_code;//   `country_code` char(2) NOT NULL,
public $region_code;//   `region_code` varchar(10) NOT NULL,
public $latitude;//   `latitude` decimal(9,6) NOT NULL,
public $longitude;//   `longitude` decimal(9,6) NOT NULL,
public $timezone;//   `timezone` varchar(50) NOT NULL
// )
}