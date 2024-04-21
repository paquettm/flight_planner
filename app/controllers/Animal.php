<?php
namespace app\controllers;

#[\app\filters\Login]
class Animal extends \app\core\Controller{
	public function index($client_id){
		$myClient = \app\daos\Client::get($client_id);
		$animals = $myClient->getAnimals();
		$this->view('Animal/index',['client'=>$myClient,'animals'=>$animals]);//pass an array to the view
	}

	public function create($client_id){
		if(!isset($_POST['action'])){	//display he view if I don't submit the form
			$myClient = \app\daos\Client::get($client_id);
			$this->view('Animal/create',$myClient);
		}else{	//process the data
			$newAnimal = new \app\models\Animal();
			$newAnimal->client_id = $client_id;
			$newAnimal->name=$_POST['name'];
			$newAnimal->dob=$_POST['dob'];
			$newAnimal->insert();
			header("location:/Animal/index/$client_id");
		}
	}

	public function update($animal_id){
		//TODO: update a specific record
		$animal = \app\daos\Animal::get($animal_id);//get the specific animal
		//TODO: check if the animal exists
		if(!isset($_POST['action'])){
			//show the view
			$this->view('Animal/update', $animal);
		}else{
			$animal->name=$_POST['name'];
			$animal->dob=$_POST['dob'];
			$animal->update();
			header('location:/Animal/index/' . $animal->client_id);
		}
	}

	public function delete($animal_id){
		$animal = \app\daos\Animal::get($animal_id);//get the specific animal
		$animal->delete();
		header('location:/Animal/index/' . $animal->client_id);
	}

	public function details($animal_id){
		$animal = \app\daos\Animal::get($animal_id);//get the specific animal
		$this->view('Animal/details', $animal);
	}

	public function contactInformation(){
		$fileHandle = fopen('contactInformation.txt', 'r');
		flock($fileHandle, LOCK_SH);
		$jsonData = fread($fileHandle, 1024);
		fclose($fileHandle);
		$dataObj = json_decode($jsonData);
		$this->view('Animal/contactInformation', $dataObj);
	}
}