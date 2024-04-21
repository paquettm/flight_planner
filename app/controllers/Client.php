<?php
namespace app\controllers;

#[\app\filters\Login]
class Client extends \app\core\Controller{
	public function index(){
		$clients = \app\daos\Client::getAll();
		$this->view('Client/index',$clients);
	}

	public function create(){
		if(!isset($_POST['action'])){	//display he view if I don't submit the form
			$this->view('Client/create');
		}else{	//process the data
			$newClient = new \app\models\Client();
			$newClient->first_name=$_POST['first_name'];
			$newClient->last_name=$_POST['last_name'];
			$newClient->notes=$_POST['notes'];
			$newClient->phone=$_POST['phone'];
			$newClient->insert();
			header('location:/Client/index');
		}
	}

	public function update($client_id){
		//TODO: update a specific record
		$client = \app\daos\Client::get($client_id);//get the specific client
		//TODO: check if the client exists
		if(!isset($_POST['action'])){
			//show the view
			$this->view('Client/update', $client);
		}else{
			$client->first_name=$_POST['first_name'];
			$client->last_name=$_POST['last_name'];
			$client->notes=$_POST['notes'];
			$client->phone=$_POST['phone'];
			$client->update();
			header('location:/Client/index');
		}
	}

	public function delete($client_id){//TODO: make sure to satisfy the issue for the constraint
		\app\daos\Client::delete($client_id);
		header('location:/Client/index');
	}

	public function details($client_id){
		$client = \app\daos\Client::get($client_id);//get the specific client
		$this->view('Client/details', $client);
	}

	public function contactInformation(){
		$fileHandle = fopen('contactInformation.txt', 'r');
		flock($fileHandle, LOCK_SH);
		$jsonData = fread($fileHandle, 1024);
		fclose($fileHandle);
		$dataObj = json_decode($jsonData);
		$this->view('Client/contactInformation', $dataObj);
	}
}