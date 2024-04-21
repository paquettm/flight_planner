<?php
namespace app\models;

class Client extends \app\core\Model{

	public $client_id;
	#[\app\validators\NonEmpty]//definition of validators to apply on property
	#[\app\validators\Name]//definition of validators to apply on property
	public $first_name;
	#[\app\validators\Name]
	public $last_name;

}