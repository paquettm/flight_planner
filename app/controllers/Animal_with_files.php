<?php
namespace app\controllers;

class Animal extends \app\core\Controller{
	public function index(){
		$animalsJSON = file('animalList.txt');
		$this->view('Animal/index',$animalsJSON);
	}

	public function createInDB(){
		$myAnimal = new \app\models\Animal();
		var_dump($myAnimal);
	}

	public function create(){
		//notice that this controller method uses both the
		//Animal/create view (for the form) and the Animal/feedback
		//view to provide information on entered values.
		//Notice also that these get called at
		//http://localhost/Animal/create based on what is posted.
		if(!isset($_POST['action'])){	//display he view if I don't submit the form
			$this->view('Animal/create');
		}else{	//process the data
			//TODO: write the received data into a file			
			//create a string to store the 'name' and 'dob' data in the file
			$dataToWrite = ['name'=>$_POST['name'], 'dob'=>$_POST['dob']];//get the data
			//convert to a string
			$stringToWrite = json_encode($dataToWrite);

			$fileHandle = fopen('animalList.txt','a');
			flock($fileHandle, LOCK_EX);
			fwrite($fileHandle, $stringToWrite . "\n");//something missing here... 
			fclose($fileHandle);

			header('location:/Animal/index');
//			$this->view('Animal/feedback',$_POST);
		}
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