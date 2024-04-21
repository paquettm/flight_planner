<?php 
namespace app\controllers;

class User extends \app\core\Controller{
	
	//TODO: Model with get, insert, exists
	//TODO: registration and login view

	function index(){//login here
		if(!isset($_POST['action'])){//there is no form being submitted
			$this->view('User/login');
		}else{//there is a form submitted
			$user = \app\daos\User::get($_POST['username']);
			if($user != false){
				if(password_verify($_POST['password'],$user->password_hash)){
					//yay! login - store that state in a session
					$_SESSION['username'] = $user->username;
					$_SESSION['user_id'] = $user->user_id;

					header('location:/User/secureplace');
				}else{
					//not the correct password
					$this->view('User/login','Incorrect username/password combination.');
				}
			}else{
				$this->view('User/login','Incorrect username/password combination.');
			}
		}
	}

	function register(){//register here
		if(!isset($_POST['action'])){//there is no form being submitted
			$this->view('User/register');
		}else{//there is a form submitted
			$newUser = new \app\models\User();
			$newUser->username = $_POST['username'];
			$newUser->password = $_POST['password'];
			$newUser->password_confirm = $_POST['password_confirm'];

			 if(!$newUser->exists() && $_POST['password'] == $_POST['password_confirm']){
			 	$newUser->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

			 	if($newUser->insert()){
					header('location:/User/index');
				 }
				 else
				 {
					header('location:/User/register?error=FAIL!');
				 }

			 }else{
				$this->view('User/register','The user account with that username already exists.');
			 }
		}
	}

	#[\app\filters\Login]
	function logout(){
		session_destroy();//deletes the session ID and all data
		header('location:/User/index');
	}

	//toy application
	//TODO: learn about access filtering
	
	#[\app\filters\Login]
	function secureplace(){
		echo 'You are logged in!<a href="/User/logout">Logout</a>';
	}

}