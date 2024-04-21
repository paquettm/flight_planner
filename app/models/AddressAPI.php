<?php
namespace app\models;

class AddressAPI extends \app\core\Model{

	#[\app\validators\NonEmpty]
	var $postal;
	#[\app\validators\NonEmpty]
	var $result;

}