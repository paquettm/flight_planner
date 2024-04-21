<?php
namespace app\validators;
use \app\core\Validator;

#[\Attribute]
class SameAs extends \app\core\Validator{
//The interface provides protected attributes for
// - the original model object as $this->obj and
// - the constructor parameter as $this->target
	function isValid($data){		
        return $data == $this->obj->{$this->target};
	}
}
