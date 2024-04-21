<?php
namespace app\core;

class Model{

	function isValid(){//aplication of all validators on the object properties
		$reflection = new \ReflectionObject($this);
		//find the properties
		$classProperties = $reflection->getProperties();
		foreach ($classProperties as $property) {
			$propertyAttributes = $property->getAttributes();
			foreach ($propertyAttributes as $attribute) {
				$test = $attribute->newInstance();
				$test->passObject($this);
				if(!$test->isValid($property->getValue($this)))
					return false;
			}
		}
		return true;
	}

	public function __call($method_name, $args){
		if(!method_exists($this, $method_name)){
			//forward the call to the Data Access Object
			$dao_class_name = str_replace(
				'\\models\\', 
				'\\daos\\', 
				get_class($this)
			);
			$args[] = $this;
			if(method_exists($dao_class_name, $method_name)){
				return $dao_class_name::$method_name(...$args);
			}else{
				throw(new \Exception("No method {$method_name}!"));
			}
		}
	}
}