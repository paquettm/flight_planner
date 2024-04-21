<?php
namespace app\validators;
use \app\core\Validator;

#[\Attribute]
class NonEmpty extends \app\core\Validator{
	function isValid($data){
		return !empty($data);
	}
}
