<?php
namespace app\core;
//TODO: integrate error messaging interface as in other project
abstract class Validator{
	protected $obj;
	protected $target;
	public function __construct($target = null){
		$this->target = $target;
	}
	public function passObject($obj){
		$this->obj = $obj;
	}
	abstract function isValid($data);

}