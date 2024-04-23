<?php
namespace app\models;

class User extends \app\core\Model{
	//TODO: define the properties for this class
	public $user_id;
	#[\app\validators\NonEmpty]//definition of validators to apply on property
	#[\app\validators\IsEmail]//definition of validators to apply on property
	public $username;
	#[\app\validators\NonEmpty]//definition of validators to apply on property
	public $password_hash;
	#[\app\validators\NonEmpty]//definition of validators to apply on property
	#[\app\validators\SameAs('password_confirm')]
	public $password;
	#[\app\validators\NonEmpty]//definition of validators to apply on property
	public $password_confirm;
}