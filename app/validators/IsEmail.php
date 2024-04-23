<?php
namespace app\validators;
use \app\core\Validator;

#[\Attribute]
class IsEmail extends \app\core\Validator{
	function isValid($data){		
        return filter_var($data, FILTER_VALIDATE_EMAIL);
	}
}
