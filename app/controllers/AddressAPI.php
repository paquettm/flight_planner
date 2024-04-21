<?php
namespace app\controllers;

class AddressAPI extends \app\core\Controller{
	public function index(){
	}

	//access API and cache results
	public function inCanadaFromPostal($postal){
		$postal = substr($postal, 0,3);
		if(\strlen($postal) == 3){//this is a requirement for this service
			$addressInfoCache = \app\daos\AddressAPI::find($postal);//search cache
			if(!$addressInfoCache){ //get and cache if not present
				$result = \app\core\ExternalData::get('https://api.zippopotam.us/CA/' . $postal);
				$addressInfo->postal=$postal;
				$addressInfo->result = $result;
				$addressInfo->insert();
				echo $addressInfo->result;
			}else
				echo $addressInfoCache->result;
		}
	}
}