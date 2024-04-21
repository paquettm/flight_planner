<?php
namespace app\validators;
use \app\core\Validator;

#[\Attribute]
class Name extends \app\core\Validator{
	function isValid($data){
		return preg_match('/\w+/u', $data) != false;
	}
}
